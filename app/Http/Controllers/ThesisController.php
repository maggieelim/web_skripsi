<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\Student;
use App\Models\Thesis;
use App\Models\ThesisExaminer;
use Auth;
use Illuminate\Http\Request;

class ThesisController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('student')) {

            $student = $user->student;

            $theses = Thesis::with([
                'student.user',
            ])
                ->where('student_id', $student->id)
                ->latest()
                ->paginate(10);

            return view('students.thesis.index', compact('theses'));
        }

        // admin
        if ($user->hasRole('admin')) {
            $previewData = session('previewData');

            $theses = Thesis::with([
                'student.user',
            ])
                ->whereIn('status', ['draft', 'submitted', 'scheduled',])
                ->latest()
                ->paginate(20);

            return view('admin.thesis.index', compact('theses', 'previewData'));
        }
        if ($user->hasRole('lecturer')) {

            $theses = Thesis::with([
                'student.user',
                'examiners'
            ])
                ->whereHas('examiners', function ($query) use ($user) {
                    $query->where('lecturer_id', $user->lecturer->id);
                })
                ->latest()
                ->paginate(15);

            return view('lecturer.assessment.index', compact('theses'));
        }

        abort(403);
    }

    public function create()
    {
        $lecturers = Lecturer::with('user')->get();
        return view('students.thesis.create', compact('lecturers'));
    }

    public function edit(string $id)
    {
        $thesis = Thesis::findOrFail($id);
        return view('students.thesis.edit', compact('thesis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'research_type' => 'required|in:deskriptif,analitik',
            'supervisor_id' => 'required|exists:lecturers,id',
            'naskah' => 'required',
            'manuscript' => 'required',
            'video' => 'required',
        ]);

        $user = Auth::user();

        $student = Student::where('user_id', $user->id)->first();

        if (!$student) {
            return redirect()->back()
                ->with('error', 'Student profile not found');
        }

        $thesis = Thesis::create([
            'student_id' => $student->id,
            'title' => $request->title,
            'research_type' => $request->research_type,
            'thesis_file' => $request->naskah,
            'manuscript_file' => $request->manuscript,
            'presentation_video' => $request->video,
            'status' => 'submitted'
        ]);

        // otomatis jadi penguji 2 / pembimbing
        ThesisExaminer::create([
            'thesis_id' => $thesis->id,
            'lecturer_id' => $request->supervisor_id,
            'role' => 'penguji 2',
        ]);

        return redirect()
            ->route('thesis.index')
            ->with('success', 'Thesis submitted successfully');
    }

    public function show(string $id)
    {
        $user = Auth::user();
        $thesis = Thesis::with([
            'student.user',
            'examiners.lecturer.user',
            'supervisorScore.lecturer.user'
        ])->findOrFail($id);

        if ($user->hasRole('student')) {
            return view('students.thesis.show', compact('thesis', 'user'));
        }
        if ($user->hasRole('admin')) {
            return view('admin.thesis.show', compact('thesis'));
        }
        if ($user->hasRole('lecturer')) {
            return view('admin.thesis.show', compact('thesis'));
        }
        abort(403);
    }

    public function update(Request $request, string $id)
    {
        $thesis = Thesis::findOrFail($id);

        $request->validate([
            'title' => 'required|string',
            'research_type' => 'required|in:deskriptif,analitik',
            'naskah' => 'required',
            'manuscript' => 'required',
            'video' => 'required',
        ]);

        $thesis->update([
            'title' => $request->title,
            'research_type' => $request->research_type,
            'thesis_file' => $request->naskah,
            'manuscript_file' => $request->manuscript,
            'presentation_video' => $request->video
        ]);

        return redirect()->back()->with('success', 'Thesis updated successfully');
    }

    public function destroy(string $id)
    {
        Thesis::findOrFail($id)->delete();

        return redirect()->route('thesis.index')
            ->with('success', 'Thesis deleted successfully');
    }

    public function assignExaminers(Request $request, string $thesisId)
    {
        $request->validate([
            'examiners' => 'required|array',
            'examiners.*.lecturer_id' => 'required|exists:lecturers,id',
            'examiners.*.role' => 'required|in:penguji 1,penguji 2,ketua sidang',
            'date' => 'date|nullable',
            'title' => 'required'
        ]);

        $thesis = Thesis::findOrFail($thesisId);

        // Hapus existing examiner (biar clean)
        ThesisExaminer::where('thesis_id', $thesisId)->delete();

        foreach ($request->examiners as $examiner) {
            ThesisExaminer::createOrFirst([
                'thesis_id' => $thesis->id,
                'lecturer_id' => $examiner['lecturer_id'],
                'role' => $examiner['role']
            ]);
        }

        if ($request->date) {
            $thesis->update([
                'title' => $request->title,
                'ruang' => $request->ruang,
                'scheduled_date' => $request->date,
                'status' => 'scheduled',
                'invitation_email_sent' => false,
            ]);
        }
        return redirect()->route('thesis.index')->with('success', 'Examiners assigned successfully');
    }

    public function assign(string $id)
    {
        $thesis = Thesis::findOrFail($id);
        $lecturers = Lecturer::with('user')->get();
        return view('admin.thesis.assign', compact('thesis', 'lecturers'));
    }
}
