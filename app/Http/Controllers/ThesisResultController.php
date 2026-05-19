<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\SupervisorScore;
use App\Models\Thesis;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpWord\PhpWord;

class ThesisResultController extends Controller
{
    public function index()
    {
        $theses = Thesis::with([
            'student.user',
        ])
            ->whereIn('status', ['revision', 'passed', 'failed', 'completed', 'assessed'])
            ->latest()
            ->paginate(20);

        return view('admin.thesis.results', compact('theses'));
    }

    public function indexLecturer()
    {
        $user = Auth::user();
        $lecturer = Lecturer::where('user_id', $user->id)->firstOrFail();
        $theses = Thesis::with([
            'student.user',
            'examiners'
        ])
            ->whereIn('status', ['revision', 'passed', 'failed', 'completed'])
            ->whereHas('examiners', function ($query) use ($lecturer) {
                $query->where('lecturer_id', $lecturer->id);
            })->latest()
            ->paginate(20);
        return view('lecturer.assessment.results', compact('theses'));
    }

    public function show(string $id)
    {
        $thesis = Thesis::with([
            'student',
            'examiners.lecturer.user',
        ])->findOrFail($id);
        return view('admin.thesis.show', compact('thesis'));
    }

    public function submitFinalization(
        Request $request,
        $thesisId
    ) {
        $request->validate([
            'final_result' => [
                'required',
                'in:Lulus Tanpa Perbaikan,Lulus Dengan Perbaikan,Tidak Lulus'
            ]
        ]);

        $thesis = Thesis::findOrFail($thesisId);

        $status = match ($request->final_result) {

            'Lulus Tanpa Perbaikan' => 'passed',

            'Lulus Dengan Perbaikan' => 'revision',

            'Tidak Lulus' => 'failed',
        };

        $thesis->update([
            'final_result' => $request->final_result,
            'status' => $status
        ]);

        $bapPath = $this->generateBap($thesisId);
        $thesis->update([
            'bap_file' => $bapPath,
            'bap_sent_at' => now()
        ]);

        // kirim email

        return redirect()->route('results.lecturer')->with(
            'success',
            'Finalisasi sidang berhasil'
        );
    }
    private function generateBap(string $thesisId)
    {
        $thesis = Thesis::with([
            'student.user',
            'examiners.lecturer.user',
            'supervisorScore.lecturer.user'
        ])->findOrFail($thesisId);

        $ketua = $thesis->examiners
            ->where('role', 'ketua sidang')
            ->first();
        $finalScore = $thesis->final_score ?? 0;

        $result = $thesis->final_result ?? '—';

        $pdf = Pdf::loadView('pdf.bap', [
            'thesis' => $thesis,
            'finalScore' => $finalScore,
            'result' => $result,
            'ketua' => $ketua
        ]);

        $pdf->setPaper('A4', 'portrait');

        $fileName = 'BAP_' . $thesis->student->nim . '.pdf';

        $path = 'bap/' . $fileName;

        Storage::disk('public')->put(
            $path,
            $pdf->output()
        );

        return $path;
    }
}
