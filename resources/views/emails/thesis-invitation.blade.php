Kepada Yth.
<br>
{{ $examiner->lecturer->user->name }}, {{ $examiner->lecturer->gelar }}
<br>
di tempat
<br><br>
Dengan hormat,
<br>
Bersama ini kami mohon kesediaan menjadi {{ ucfirst($examiner->role) }} Sidang Skripsi pada:
<br>
Waktu:
{{ \Carbon\Carbon::parse($thesis->scheduled_date)
->locale('id')
->translatedFormat('l, d F Y H:i') }}
<br>
Lokasi: {{ $thesis->ruang }}
<br><br>

Terhadap Tugas Akhir mahasiswa dengan identitas:
<br>
Nama mahasiswa: {{ $thesis->student->user->name }}
<br>
NIM: {{ $thesis->student->nim }}
<br>
Judul Tugas Akhir: {{ $thesis->title }}
<br><br>
Berikut dokumen tugas akhir mahasiswa yang bersangkutan:
<br>
Naskah Tugas Akhir:
<br>
{{ $thesis->thesis_file }}
<br><br>
Naskah Manuskrip:
<br>
{{ $thesis->manuscript_file }}
<br><br>
Video Presentasi:
<br>
{{ $thesis->presentation_video }}
<br><br>
Skor Similaritas Tugas Akhir:
<br>
{{ $thesis->thesis_similarity }}
<br><br>
Skor Similaritas Manuskrip:
<br>
{{ $thesis->manuscript_similarity }}
<br><br>
Status Publikasi:
<br>
{{ $thesis->publication_status }}
<br><br>
Nama Jurnal:
<br>
{{ $thesis->journal_name }}
<br><br>
Peringkat Jurnal:
<br>
{{ $thesis->journal_rank }}
<br><br>

Proses penilaian dilakukan melalui link berikut:
<br>
{{ url('/assessment/'.$thesis->id) }}
<br><br>
Atas perhatian dan bantuannya, kami ucapkan terima kasih.
<br>
Koordinator dan Sekretaris Blok Skripsi