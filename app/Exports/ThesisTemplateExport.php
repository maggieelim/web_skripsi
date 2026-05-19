<?php

namespace App\Exports;

use App\Models\Lecturer;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ThesisTemplateExport implements WithHeadings, WithEvents
{
    public function headings(): array
    {
        return [
            'NIM',
            'Judul',
            'Jenis Penelitian',
            'Link TA',
            'Link Manuskrip',
            'Link Video',
            'Ketua Sidang',
            'Dosen Pembimbing',
            'Penguji',
            'Tanggal Sidang',
            'Ruang',
            'Similarity Skripsi',
            'Similarity Manuskrip',
            'Status Publikasi',
            'Nama Jurnal',
            'Peringkat Jurnal',
        ];
    }

    public function registerEvents(): array
    {
        return [

            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                /*
                |--------------------------------------------------------------------------
                | FREEZE PANE
                |--------------------------------------------------------------------------
                */

                $sheet->freezePane('B2');

                /*
                |--------------------------------------------------------------------------
                | STYLE HEADER
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle('A1:P1')->applyFromArray([

                    'font' => [
                        'bold' => true,
                        'size' => 10,
                        'color' => [
                            'rgb' => 'FFFFFF'
                        ],
                    ],

                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => '1F4E78'
                        ],
                    ],

                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'wrapText' => true,
                    ],

                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => '000000'
                            ],
                        ],
                    ],

                ]);

                /*
                |--------------------------------------------------------------------------
                | COLUMN WIDTH
                |--------------------------------------------------------------------------
                */

                $sheet->getColumnDimension('A')->setWidth(10); // NIM
                $sheet->getColumnDimension('B')->setWidth(35); // Judul
                $sheet->getColumnDimension('C')->setWidth(12); // Jenis Penelitian
                $sheet->getColumnDimension('D')->setWidth(25); // Link TA
                $sheet->getColumnDimension('E')->setWidth(25); // Link Manuskrip
                $sheet->getColumnDimension('F')->setWidth(25); // Link Video
                $sheet->getColumnDimension('G')->setWidth(20); // Ketua Sidang
                $sheet->getColumnDimension('H')->setWidth(20); // Dospem
                $sheet->getColumnDimension('I')->setWidth(20); // Penguji
                $sheet->getColumnDimension('J')->setWidth(15); // Tanggal Sidang
                $sheet->getColumnDimension('K')->setWidth(10); // Ruang
                $sheet->getColumnDimension('L')->setWidth(12); // Similarity Skripsi
                $sheet->getColumnDimension('M')->setWidth(12); // Similarity Manuskrip
                $sheet->getColumnDimension('N')->setWidth(15); // Status Publikasi
                $sheet->getColumnDimension('O')->setWidth(20); // Nama Jurnal
                $sheet->getColumnDimension('P')->setWidth(20); // Peringkat Jurnal

                /*
                |--------------------------------------------------------------------------
                | DROPDOWN DOSEN
                |--------------------------------------------------------------------------
                */

                $lecturers = Lecturer::with('user')
                    ->get()
                    ->pluck('user.name')
                    ->implode(',');

                foreach (['G', 'H', 'I'] as $column) {

                    for ($row = 2; $row <= 250; $row++) {

                        $validation = $sheet
                            ->getCell($column . $row)
                            ->getDataValidation();

                        $validation->setType(
                            DataValidation::TYPE_LIST
                        );

                        $validation->setErrorStyle(
                            DataValidation::STYLE_STOP
                        );

                        $validation->setAllowBlank(false);

                        $validation->setShowDropDown(true);

                        $validation->setShowInputMessage(true);

                        $validation->setShowErrorMessage(true);

                        $validation->setErrorTitle('Input tidak valid');

                        $validation->setError(
                            'Pilih nama dosen dari dropdown.'
                        );

                        $validation->setFormula1(
                            '"' . $lecturers . '"'
                        );
                    }
                }
            }
        ];
    }
}
