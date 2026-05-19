<?php

namespace App\Imports;

use App\Models\Lecturer;
use App\Models\Student;
use App\Models\Thesis;
use App\Models\ThesisExaminer;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ThesisImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $rows->skip(1)->each(function ($row) {
            $student = Student::where(
                'nim',
                $row[0]
            )->first();

            if (!$student) {
                return;
            }
            $ketuaSidang = Lecturer::whereHas(
                'user',
                fn($q) => $q->where(
                    'name',
                    $row[6]
                )
            )->first();

            $dospem = Lecturer::whereHas(
                'user',
                fn($q) => $q->where(
                    'name',
                    $row[7]
                )
            )->first();

            $examiner = Lecturer::whereHas(
                'user',
                fn($q) => $q->where(
                    'name',
                    $row[8]
                )
            )->first();

            if (!$dospem || !$examiner || !$ketuaSidang) {
                return;
            }

            $thesis = Thesis::create([
                'student_id' => $student->id,
                'title' => $row[1],
                'research_type' => $row[2],
                'thesis_file' => $row[3],
                'manuscript_file' => $row[4],
                'presentation_video' => $row[5],
                'scheduled_date' => Carbon::parse($row[9]),
                'status' => 'scheduled',
                'ruang' => $row[10]
            ]);

            ThesisExaminer::create([
                'thesis_id' => $thesis->id,
                'lecturer_id' => $examiner->id,
                'role' => 'penguji 1'
            ]);

            ThesisExaminer::create([
                'thesis_id' => $thesis->id,
                'lecturer_id' => $ketuaSidang->id,
                'role' => 'ketua sidang'
            ]);

            ThesisExaminer::create([
                'thesis_id' => $thesis->id,
                'lecturer_id' => $dospem->id,
                'role' => 'penguji 2'
            ]);
        });
    }
}
