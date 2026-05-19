<?php

namespace App\Http\Controllers;

use App\Imports\ThesisImport;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\Thesis;
use App\Models\ThesisExaminer;
use App\Services\SemesterService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ThesisImportController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);

        Excel::import(
            new ThesisImport,
            $request->file('file')
        );

        return back()->with(
            'success',
            'Import berhasil'
        );
    }

    public function preview(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $rows = Excel::toCollection(
            null,
            $request->file('file')
        )->first();

        $previewData = [];

        foreach ($rows->skip(1) as $row) {

            $student = Student::where(
                'nim',
                trim($row[0])
            )->first();

            $ketuaSidang = Lecturer::whereHas(
                'user',
                fn($q) =>
                $q->whereRaw(
                    'LOWER(name) = ?',
                    [strtolower(trim($row[6]))]
                )
            )->first();

            $dospem = Lecturer::whereHas(
                'user',
                fn($q) =>
                $q->whereRaw(
                    'LOWER(name) = ?',
                    [strtolower(trim($row[7]))]
                )
            )->first();

            $penguji = Lecturer::whereHas(
                'user',
                fn($q) =>
                $q->whereRaw(
                    'LOWER(name) = ?',
                    [strtolower(trim($row[8]))]
                )
            )->first();

            $errors = [];

            if (!$student) {
                $errors[] = 'Mahasiswa tidak ditemukan';
            }

            if (!$ketuaSidang) {
                $errors[] = 'Ketua sidang tidak ditemukan';
            }

            if (!$dospem) {
                $errors[] = 'Pembimbing tidak ditemukan';
            }

            if (!$penguji) {
                $errors[] = 'Penguji tidak ditemukan';
            }
            if (!$row[3]) {
                $errors[] = 'Link TA tidak ditemukan';
            }
            if (!$row[4]) {
                $errors[] = 'Link Manuskrip tidak ditemukan';
            }
            if (!$row[5]) {
                $errors[] = 'Link Video tidak ditemukan';
            }

            $previewData[] = [
                'nim' => $row[0],
                'title' => $row[1],
                'thesis_file' => $row[3],
                'manuscript_file' => $row[4],
                'presentation_video' => $row[5],
                'student' => $student,
                'ketua' => $ketuaSidang,
                'dospem' => $dospem,
                'penguji' => $penguji,
                'date' => $row[9],
                'room' => $row[10] ?? null,
                'errors' => $errors
            ];
        }

        session()->put(
            'import_rows',
            json_encode($rows->toArray())
        );

        return redirect()
            ->route('thesis.index')
            ->with('previewData', $previewData);
    }

    public function store()
    {
        $rows = collect(
            json_decode(
                session('import_rows', '[]'),
                true
            )
        );

        if ($rows->isEmpty()) {

            return redirect()
                ->route('thesis.index')
                ->with('error', 'Data import tidak ditemukan');
        }

        $activeSemester = SemesterService::active();

        foreach ($rows->skip(1) as $row) {

            $student = Student::where(
                'nim',
                trim($row[0])
            )->first();

            if (!$student) {
                continue;
            }

            $ketuaSidang = Lecturer::whereHas(
                'user',
                fn($q) =>
                $q->whereRaw(
                    'LOWER(name) = ?',
                    [strtolower(trim($row[6]))]
                )
            )->first();

            $dospem = Lecturer::whereHas(
                'user',
                fn($q) =>
                $q->whereRaw(
                    'LOWER(name) = ?',
                    [strtolower(trim($row[7]))]
                )
            )->first();

            $penguji = Lecturer::whereHas(
                'user',
                fn($q) =>
                $q->whereRaw(
                    'LOWER(name) = ?',
                    [strtolower(trim($row[8]))]
                )
            )->first();

            if (
                !$ketuaSidang ||
                !$dospem ||
                !$penguji
            ) {
                continue;
            }

            $thesis = Thesis::updateOrCreate(
                [
                    'student_id' => $student->id,
                    'semester_id' => $activeSemester->id,
                ],
                [
                    'title' => trim($row[1]),
                    'research_type' => trim($row[2]),
                    'thesis_file' => trim($row[3]),
                    'manuscript_file' => trim($row[4]),
                    'presentation_video' => trim($row[5]),
                    'scheduled_date' => Carbon::createFromFormat(
                        'd/m/Y H.i',
                        trim($row[9])
                    ),
                    'status' => 'scheduled',
                    'ruang' => trim($row[10] ?? ''),
                    'thesis_similarity' => $row[11] ?? null,
                    'manuscript_similarity' => $row[12] ?? null,
                    'publication_status' => $row[13] ?? null,
                    'journal_name' => $row[14] ?? null,
                    'journal_rank' => $row[15] ?? null,
                ]
            );

            ThesisExaminer::updateOrCreate(
                [
                    'thesis_id' => $thesis->id,
                    'role' => 'ketua sidang',
                ],
                [
                    'lecturer_id' => $ketuaSidang->id,
                ]
            );

            ThesisExaminer::updateOrCreate(
                [
                    'thesis_id' => $thesis->id,
                    'role' => 'penguji 1',
                ],
                [
                    'lecturer_id' => $penguji->id,
                ]
            );

            ThesisExaminer::updateOrCreate(
                [
                    'thesis_id' => $thesis->id,
                    'role' => 'penguji 2',
                ],
                [
                    'lecturer_id' => $dospem->id,
                ]
            );
        }

        session()->forget([
            'import_rows',
            'previewData'
        ]);

        return redirect()
            ->route('thesis.index')
            ->with('success', 'Import berhasil');
    }
}
