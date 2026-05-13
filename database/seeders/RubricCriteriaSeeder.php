<?php

namespace Database\Seeders;

use App\Models\Rubric;
use App\Models\RubricCriteria;
use Illuminate\Database\Seeder;

class RubricCriteriaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            /*
            |--------------------------------------------------------------------------
            | A1a
            |--------------------------------------------------------------------------
            */

            'A1a' => [

                0 => '
• Judul tidak relevan atau menyesatkan
• Tidak mencerminkan variabel penelitian
• Abstrak tidak tersedia atau sangat tidak lengkap
• Tidak mengikuti format ilmiah
                ',

                1 => '
Memenuhi 1-2 dari 5 kriteria

• Judul kurang mencerminkan inti penelitian
• Tidak spesifik terhadap variabel/desain
• Abstrak tidak lengkap (misalnya tanpa metode atau hasil)
• Struktur tidak jelas
• Banyak kesalahan bahasa
                ',

                2 => '
Memenuhi 3-4 dari 5 kriteria

• Judul relevan dan cukup spesifik tetapi kurang tajam/terlalu umum
• Panjang >20 kata atau masih ada istilah kurang baku
• Abstrak lengkap namun struktur IMRAD kurang runtut
• Bahasa cukup baik tetapi masih ada kesalahan minor
• Kata kunci kurang sinkron
                ',

                3 => '
Memenuhi semua kriteria berikut:

1. Judul sangat menarik, orisinal dan relevan dengan ilmu kedokteran
2. Kalimat judul mencerminkan inti penelitian dengan jelas dan spesifik
3. Panjang judul ≤20 kata, tidak ada singkatan tidak baku
4. Abstrak dalam Bahasa Indonesia dan Bahasa Inggris yang baik dan benar, lengkap dan runut mengikuti struktur IMRAD
5. Format abstrak 1 paragraf, panjang <300 kata, terdapat ≤5 kata kunci yang sinkron
                ',

            ],

            /*
            |--------------------------------------------------------------------------
            | A1b
            |--------------------------------------------------------------------------
            */

            'A1b' => [

                0 => '
• Tidak menyebutkan gap
• Rumusan masalah tidak jelas
• Tujuan tidak konsisten
• Hipotesis keliru atau tidak ada (pada studi analitik)
                ',

                1 => '
Memenuhi 1-2 dari 5 kriteria

• Latar belakang naratif tanpa data kuat
• Gap tidak jelas
• Rumusan masalah umum
• Tujuan tidak terukur
• Hipotesis tidak logis/tidak sinkron
                ',

                2 => '
Memenuhi 3-4 dari 5 kriteria

• Latar belakang cukup didukung data tetapi gap kurang tajam
• Referensi ada tetapi tidak seluruhnya terkini
• Hipotesis/logika penelitian cukup jelas namun belum operasional
• Tujuan cukup jelas tetapi belum sepenuhnya terukur
• Manfaat disebutkan tetapi kurang spesifik
                ',

                3 => '
Memenuhi semua kriteria berikut:

1. Latar belakang didukung data kuat, gap/kesenjangan jelas, ada kebaruan, referensi terkini ≤10 th
2. Rumusan masalah spesifik dan tajam
3. Hipotesis logis dan operasional (*wajib untuk penelitian analitik)
4. Tujuan umum dan khusus jelas dan terukur
5. Terdapat manfaat teoritis dan praktis
                ',
            ],

            /*
            |--------------------------------------------------------------------------
            | A1c
            |--------------------------------------------------------------------------
            */

            'A1c' => [

                0 => '
• Tidak mencerminkan variabel penelitian
• Tidak ada kerangka teori dan konsep
• Tidak berbasis referensi ilmiah
                ',

                1 => '
Memenuhi 1 dari 3 kriteria

• Hanya ringkasan literatur tanpa sintesis
• Referensi banyak yang usang
• Kerangka teori atau konsep tidak jelas
                ',

                2 => '
Memenuhi 2 dari 3 kriteria

• Referensi cukup relevan namun sintesis kurang mendalam
• Kerangka teori ada tetapi kurang konsisten
• Kerangka konsep ada namun hubungan variabel belum sepenuhnya jelas
                ',

                3 => '
Memenuhi semua kriteria berikut:

1. Kajian didukung referensi terkini, dielaborasi dan dilakukan sintesis kritis, meliputi semua variabel penelitian
2. Kerangka teori jelas dan konsisten dengan tinjauan pustaka
3. Kerangka konsep menunjukkan hubungan antar variabel dengan tepat
                ',
            ],

            /*
            |--------------------------------------------------------------------------
            | A1d
            |--------------------------------------------------------------------------
            */

            'A1d' => [

                0 => '
• Hasil tidak menjawab tujuan
• Data tidak jelas/tidak lengkap
• Tidak ada struktur penyajian
                ',

                1 => '
Memenuhi 1 dari 3 kriteria

• Hasil tidak sepenuhnya sesuai tujuan
• Narasi deskriptif sangat minim
• Penyajian tabel tidak sistematis
                ',

                2 => '
Memenuhi 2 dari 3 kriteria

• Hasil sesuai tujuan tetapi narasi kurang informatif
• Tabel/gambar ada tetapi kurang rapi atau berulang
• Beberapa hasil tidak dijelaskan dengan jelas
                ',

                3 => '
Memenuhi semua kriteria berikut:

1. Hasil sesuai dengan tujuan penelitian
2. Hasil disampaikan dalam narasi yang informatif
3. Penyajian data berupa tabel dan gambar yang jelas, ringkas, dan rapi
                ',
            ],

            /*
            |--------------------------------------------------------------------------
            | A1e
            |--------------------------------------------------------------------------
            */

            'A1e' => [

                0 => '
• Tidak ada pembahasan substantif
• Interpretasi keliru atau overclaim kausal
                ',

                1 => '
Memenuhi 1 dari 3 kriteria

• Hanya mengulang hasil tanpa interpretasi
• Minim referensi pembanding
• Tidak membahas keterbatasan
                ',

                2 => '
Memenuhi 2 dari 3 kriteria

• Interpretasi cukup tetapi belum mendalam
• Perbandingan studi lain ada tetapi kurang komprehensif
• Keterbatasan disebutkan tetapi tidak dianalisis kritis
                ',

                3 => '
Memenuhi semua kriteria berikut:

1. Interpretasi hasil mendalam dan kritis, sesuai dengan tujuan penelitian
2. Perbandingan hasil dengan studi lain yang relevan dijelaskan secara komprehensif, termasuk implikasi teori/praktis
3. Kelebihan/kebaruan dan keterbatasan penelitian dibahas jelas dan jujur
                ',
            ],

            /*
            |--------------------------------------------------------------------------
            | A1f
            |--------------------------------------------------------------------------
            */

            'A1f' => [

                0 => '
• Kesimpulan tidak menjawab tujuan
• Tidak ada saran
                ',

                1 => '
Memenuhi 1 dari 2 kriteria

• Kesimpulan tidak sepenuhnya sesuai hasil
• Saran tidak logis
                ',

                2 => '
Memenuhi 2 kriteria, tetapi salah satunya kurang tepat

• Kesimpulan menjawab sebagian besar tujuan
• Saran ada tetapi kurang aplikatif atau terlalu umum
                ',

                3 => '
Memenuhi semua kriteria berikut:

1. Kesimpulan menjawab semua tujuan khusus
2. Saran aplikatif dan logis
                ',
            ],

            /*
            |--------------------------------------------------------------------------
            | A2 - Metode Penelitian
            |--------------------------------------------------------------------------
            */

            'A2' => [

                0 => '
Memenuhi 1-2 dari 9 kriteria, atau memenuhi ≥3 kriteria tetapi desain penelitian salah
                ',

                1 => '
Memenuhi 3-5 dari 9 kriteria

• Beberapa komponen metode tidak lengkap
• Perhitungan sampel tidak jelas
• Definisi operasional tidak terukur
• Uji statistik kurang sesuai
                ',

                2 => '
Memenuhi 6-8 dari 9 kriteria

• Desain tepat tetapi ada kelemahan teknis (misalnya definisi operasional kurang lengkap)
• Perhitungan sampel ada tetapi kurang rinci
• Uji statistik disebutkan tetapi belum sepenuhnya tepat
• Ethical approval ada tetapi dokumentasi kurang jelas
                ',

                3 => '
Memenuhi semua kriteria berikut:

1. Desain penelitian tepat untuk menjawab tujuan khusus
2. Lokasi dan waktu jelas dan spesifik
3. Populasi dan sampel dinyatakan lengkap, disertai perhitungan besar sampel dan teknik sampling
4. Kriteria inklusi-eksklusi lengkap dan logis
5. Definisi operasional lengkap dan terukur
6. Instrumen valid dan sesuai
7. Alur penelitian dijelaskan secara runut dan lengkap
8. Ada ethical approval dan izin penelitian
9. Uji analisis data dinyatakan dengan tepat
                ',
            ],

            /*
            |--------------------------------------------------------------------------
            | A3 - Teknis Penulisan
            |--------------------------------------------------------------------------
            */

            'A3' => [

                0 => '
Tidak memenuhi 3 kriteria

• Tidak mengikuti Vancouver
• Bahasa tidak baku
• Struktur tidak sesuai pedoman
                ',

                1 => '
Memenuhi 1 dari 3 kriteria

• Banyak kesalahan sitasi
• Bahasa tidak konsisten
• Sistematika kurang sesuai
                ',

                2 => '
Memenuhi 2 dari 3 kriteria

• Mayoritas sitasi sesuai Vancouver tetapi ada kesalahan minor
• Bahasa cukup baik namun masih ada kesalahan ejaan
• Sistematika hampir sesuai pedoman
                ',

                3 => '
Memenuhi semua kriteria berikut:

1. Sitasi dan penulisan referensi seluruhnya sesuai dengan kaidah Vancouver
2. Bahasa Indonesia baku sesuai PUEBI, diksi konsisten, penulisan ejaan dan istilah ilmiah tepat
3. Sistematika sesuai pedoman Tugas Akhir FK Untar
                ',
            ],

            /*
            |--------------------------------------------------------------------------
            | B1 - Substansi Artikel Publikasi
            |--------------------------------------------------------------------------
            */

            'B1' => [

                0 => '
Artikel tidak sesuai format jurnal ilmiah
                ',

                1 => '
Memenuhi 1 dari 3 kriteria

• Struktur tidak lengkap
• Tidak mengikuti template jurnal
• Pembimbing tidak tercantum
                ',

                2 => '
Memenuhi 2 dari 3 kriteria

• Struktur artikel hampir lengkap
• Judul sesuai tetapi terlalu mirip skripsi
• Pembimbing tercantum tetapi tidak sebagai corresponding author
                ',

                3 => '
Memenuhi semua kriteria berikut:

1. Judul artikel sesuai penelitian, namun tidak identik dengan judul skripsi
2. Struktur artikel lengkap dan sesuai template jurnal
3. Mencantumkan dosen pembimbing sebagai penulis kedua dan corresponding author
                ',
            ],

            /*
            |--------------------------------------------------------------------------
            | B2 - Jurnal / Prosiding
            |--------------------------------------------------------------------------
            */

            'B2' => [

                0 => '
Artikel belum terpublikasi dan media bukan bidang kedokteran atau jurnal predator
                ',

                1 => '
Artikel belum terpublikasi, atau sudah terpublikasi di media kurang sesuai atau belum jelas kredibilitasnya
                ',

                2 => '
Artikel sudah terpublikasi di media sesuai bidang kedokteran dengan tingkat reputasi kurang
                ',

                3 => '
Memenuhi semua kriteria berikut:

1. Artikel sudah terpublikasi (dibuktikan dengan url)
2. Media publikasi sesuai bidang kedokteran dan kredibel (terakreditasi/bereputasi)
                ',
            ],

            /*
            |--------------------------------------------------------------------------
            | C - Penguasaan Materi
            |--------------------------------------------------------------------------
            */

            'C' => [

                0 => '
Tidak memahami konsep penelitian dan tidak mampu mempertahankan skripsi secara ilmiah
                ',

                1 => '
Menguasai sebagian kecil konsep dasar, tetapi kesulitan menjelaskan metodologi dan interpretasi statistik
                ',

                2 => '
Menguasai sebagian besar aspek, namun kurang tajam dalam analisis mendalam atau menjawab pertanyaan kritis
                ',

                3 => '
Menguasai seluruh aspek penelitian (konseptual maupun metodologis), dan mampu mempertahankan secara ilmiah
                ',
            ],

        ];

        foreach ($data as $rubricCode => $levels) {

            $rubric = Rubric::where('code', $rubricCode)->first();

            if (!$rubric) {
                continue;
            }

            foreach ($levels as $scoreLevel => $description) {

                RubricCriteria::updateOrCreate(
                    [
                        'rubric_id' => $rubric->id,
                        'score_level' => $scoreLevel,
                    ],
                    [
                        'description' => trim($description),
                    ]
                );
            }
        }
    }
}
