<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RubricsTableSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('rubrics')->insert([
            // ===== A1 =====
            [
                'code' => 'A1',
                'name' => 'Substansi Skripsi',
                'parent_code' => null,
                'weight' => 0.3,
                'created_at' => $now,
                'updated_at' => $now
            ],

            [
                'code' => 'A1a',
                'name' => 'Judul dan Abstrak',
                'parent_code' => 'A1',
                'weight' => null,
                'created_at' => $now,
                'updated_at' => $now
            ],

            [
                'code' => 'A1b',
                'name' => 'Pendahuluan',
                'parent_code' => 'A1',
                'weight' => null,
                'created_at' => $now,
                'updated_at' => $now
            ],

            [
                'code' => 'A1c',
                'name' => 'Tinjauan Pustaka',
                'parent_code' => 'A1',
                'weight' => null,
                'created_at' => $now,
                'updated_at' => $now
            ],

            [
                'code' => 'A1d',
                'name' => 'Hasil Penelitian',
                'parent_code' => 'A1',
                'weight' => null,
                'created_at' => $now,
                'updated_at' => $now
            ],

            [
                'code' => 'A1e',
                'name' => 'Pembahasan',
                'parent_code' => 'A1',
                'weight' => null,
                'created_at' => $now,
                'updated_at' => $now
            ],

            [
                'code' => 'A1f',
                'name' => 'Kesimpulan dan Saran',
                'parent_code' => 'A1',
                'weight' => null,
                'created_at' => $now,
                'updated_at' => $now
            ],

            // ===== A2 =====
            [
                'code' => 'A2',
                'name' => 'Metode Penelitian',
                'parent_code' => null,
                'weight' => 0.2,
                'created_at' => $now,
                'updated_at' => $now
            ],

            // ===== A3 =====
            [
                'code' => 'A3',
                'name' => 'Teknis Penulisan',
                'parent_code' => null,
                'weight' => 0.1,
                'created_at' => $now,
                'updated_at' => $now
            ],

            // ===== B1 =====
            [
                'code' => 'B1',
                'name' => 'Substansi Artikel Publikasi',
                'parent_code' => null,
                'weight' => 0.2,
                'created_at' => $now,
                'updated_at' => $now
            ],

            // ===== B2 =====
            [
                'code' => 'B2',
                'name' => 'Jurnal / Prosiding',
                'parent_code' => null,
                'weight' => 0.1,
                'created_at' => $now,
                'updated_at' => $now
            ],

            // ===== C =====
            [
                'code' => 'C',
                'name' => 'Penguasaan Materi',
                'parent_code' => null,
                'weight' => 0.1,
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
