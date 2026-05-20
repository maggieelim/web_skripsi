<?php

namespace App\Http\Controllers;

use App\Models\Rubric;
use App\Models\RubricScore;
use App\Models\SupervisorScore;
use App\Models\Thesis;
use App\Models\ThesisRevisionNote;
use Auth;
use DB;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $lecturer = $user->lecturer;
        if (!$lecturer) {
            return back()->with('error', 'You are not a lecturer');
        }
        $theses = Thesis::with([
            'student.user',
        ])->whereIn('status', ['scheduled', 'ongoing', 'assessed'])
            ->whereHas('examiners', function ($query) use ($lecturer) {
                $query->where('lecturer_id', $lecturer->id);
            })
            ->latest()
            ->paginate(15);

        $theses->getCollection()->transform(function ($thesis) {
            $thesis->all_assessed = $this->allExaminersSubmitted($thesis->id);

            return $thesis;
        });

        return view('lecturer.assessment.index', compact('theses'));
    }

    public function form(Request $request, string $thesisId)
    {
        $lecturer = Auth::user()->lecturer;

        if (!$lecturer) {
            return back()->with('error', 'You are not a lecturer');
        }

        $thesis = Thesis::with(
            'student.user',
            'examiners.lecturer.user'
        )->findOrFail($thesisId);

        $isExaminer = $thesis->examiners()
            ->where('lecturer_id', $lecturer->id)
            ->exists();

        if (!$isExaminer) {
            return back()->with(
                'error',
                'You are not assigned as an examiner for this thesis'
            );
        }

        $perPage = 1;

        $allRubrics = Rubric::with('criteria')
            ->where('code', '!=', 'A1')
            ->orderBy('code')
            ->get();

        $rubricCount = $allRubrics->count();

        // +1 untuk halaman revisi
        $totalPages = $rubricCount + 1;

        $page = $request->get('page', 1);

        // apakah halaman revisi?
        $isRevisionPage = $page == $totalPages;

        $rubrics = collect();

        if (!$isRevisionPage) {
            $rubrics = $allRubrics
                ->slice(($page - 1) * $perPage, $perPage)
                ->values();
        }

        $scores = RubricScore::where('thesis_id', $thesisId)
            ->where('lecturer_id', $lecturer->id)
            ->pluck('score', 'rubric_id');

        $notes = ThesisRevisionNote::where(
            'thesis_id',
            $thesisId
        )
            ->where('lecturer_id', $lecturer->id)
            ->first();

        return view(
            'lecturer.assessment.form',
            compact(
                'thesis',
                'rubrics',
                'scores',
                'notes',
                'page',
                'totalPages',
                'isRevisionPage'
            )
        );
    }

    public function autoSave(Request $request, string $thesisId)
    {
        $request->validate([
            'rubric_id' => 'required|exists:rubrics,id',
            'score' => 'required|integer|min:0|max:3'
        ]);

        $thesis = Thesis::with('examiners')->findOrFail($thesisId);

        $lecturer = Auth::user()->lecturer;

        $isExaminer = $thesis->examiners()
            ->where('lecturer_id', $lecturer->id)
            ->exists();

        if (!$isExaminer) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        RubricScore::updateOrCreate(
            [
                'thesis_id' => $thesisId,
                'lecturer_id' => $lecturer->id,
                'rubric_id' => $request->rubric_id
            ],
            [
                'score' => $request->score
            ]
        );

        // $thesis->update([
        //     'status' => 'ongoing'
        // ]);
        return response()->json([
            'success' => true,
            'message' => 'Score tersimpan'
        ]);
    }

    public function submitFinal(Request $request, $thesisId)
    {
        $lecturer = Auth::user()->lecturer;

        if (!$lecturer) {
            return back()->with(
                'error',
                'You are not a lecturer'
            );
        }

        $thesis = Thesis::findOrFail($thesisId);

        $isExaminer = $thesis->examiners()
            ->where('lecturer_id', $lecturer->id)
            ->exists();

        if (!$isExaminer) {
            return back()->with(
                'error',
                'Anda bukan penguji skripsi ini'
            );
        }

        $requiredRubrics = Rubric::where('code', '!=', 'A1')->count();

        $filledScores = RubricScore::where('thesis_id', $thesisId)
            ->where('lecturer_id', $lecturer->id)
            ->count();

        if ($filledScores < $requiredRubrics) {
            return back()->with(
                'error',
                'Semua rubric harus diisi'
            );
        }

        $thesis->update([
            'status' => 'ongoing'
        ]);

        $request->validate([
            'substance_note' => 'nullable|string',
            'methodology_note' => 'nullable|string',
            'writing_note' => 'nullable|string',
        ]);

        ThesisRevisionNote::updateOrCreate(
            [
                'thesis_id' => $thesisId,
                'lecturer_id' => $lecturer->id
            ],
            [
                'substance_note' => $request->substance_note,
                'methodology_note' => $request->methodology_note,
                'writing_note' => $request->writing_note,
                'is_submitted' => true
            ]
        );

        $this->calculateSupervisorScore(
            $thesisId,
            $lecturer->id
        );

        if ($this->allExaminersSubmitted($thesisId)) {

            DB::transaction(function () use ($thesisId, $thesis) {

                $this->calculateFinalScore($thesisId);

                $thesis->update([
                    'status' => 'assessed'
                ]);
            });

            return back()->with(
                'success',
                'Semua penilai telah submit. Nilai akhir berhasil dihitung.'
            );
        }

        return back()->with(
            'success',
            'Penilaian berhasil disubmit'
        );
    }

    private function calculateSupervisorScore(
        string $thesisId,
        string $lecturerId
    ) {

        $scores = RubricScore::with('rubric:id,code')
            ->where('thesis_id', $thesisId)
            ->where('lecturer_id', $lecturerId)
            ->get();

        if ($scores->isEmpty()) {
            return;
        }

        $grouped = $scores->groupBy(function ($item) {
            return $item->rubric->code;
        });

        $a1Codes = ['A1a', 'A1b', 'A1c', 'A1d', 'A1e', 'A1f'];

        $a1Scores = collect($a1Codes)->map(function ($code) use ($grouped) {
            return optional($grouped->get($code)?->first())->score ?? 0;
        });

        $a1Avg = $a1Scores->avg();

        $a2 = optional($grouped->get('A2')?->first())->score ?? 0;
        $a3 = optional($grouped->get('A3')?->first())->score ?? 0;
        $b1 = optional($grouped->get('B1')?->first())->score ?? 0;
        $b2 = optional($grouped->get('B2')?->first())->score ?? 0;
        $c  = optional($grouped->get('C')?->first())->score ?? 0;

        $weightedScore =
            ($a1Avg * 0.3) +
            ($a2 * 0.2) +
            ($a3 * 0.1) +
            ($b1 * 0.2) +
            ($b2 * 0.1) +
            ($c  * 0.1);

        $total = round(($weightedScore / 3) * 100, 2);

        SupervisorScore::updateOrCreate(
            [
                'thesis_id' => $thesisId,
                'lecturer_id' => $lecturerId
            ],
            [
                'score' => $total
            ]
        );
    }
    /**
     * AUTO HITUNG NILAI AKHIR
     */
    private function calculateFinalScore(string $thesisId)
    {
        $scores = SupervisorScore::where(
            'thesis_id',
            $thesisId
        )->pluck('score');

        if ($scores->isEmpty()) {
            return;
        }

        $finalScore = round($scores->avg(), 2);

        Thesis::findOrFail($thesisId)->update([
            'final_score' => $finalScore
        ]);
    }

    private function allExaminersSubmitted(string $thesisId): bool
    {
        $thesis = Thesis::with('examiners')->findOrFail($thesisId);

        $examinerIds = $thesis->examiners
            ->pluck('lecturer_id');

        $submittedCount = ThesisRevisionNote::where(
            'thesis_id',
            $thesisId
        )
            ->whereIn('lecturer_id', $examinerIds)
            ->where('is_submitted', true)
            ->count();

        return $submittedCount === $examinerIds->count();
    }

    public function finalizeResult(Request $request, $thesisId)
    {
        $request->validate([
            'final_result' => [
                'required',
                'in:Lulus Tanpa Perbaikan,Lulus Dengan Perbaikan,Tidak Lulus'
            ]
        ]);

        $thesis = Thesis::findOrFail($thesisId);

        $thesis->update([
            'final_result' => $request->final_result,
            'status' => match ($request->final_result) {
                'Tidak Lulus' => 'failed',
                default => 'passed'
            }
        ]);

        // generate bap
        // kirim email
    }
}
