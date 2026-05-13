Kepada Yth.
<br>
{{ $examiner->lecturer->user->name }}, {{ $examiner->lecturer->gelar }}
<br>
di tempat
<br><br>
Dengan hormat,
<br>
Bersama dengan ini kami memohon bantuannya sebagai {{ ucfirst($examiner->role) }} untuk melakukan penilaian tugas akhir
dari mahasiswa Fakultas Kedokteran Universitas Tarumanagara melalui prosedur Desk review dengan identitas sebagai
berikut:
<br>
Nama Mahasiswa yang diuji: {{ $thesis->student->user->name }}
<br>
NIM: {{ $thesis->student->nim }}
<br>
Judul Tugas Akhir: {{ $thesis->title }}
<br><br>
Berikut kami lampirkan dokumen dari tugas akhir mahasiswa yang bersangkutan:
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
Untuk proses penilaian dapat dilakukan melalui link berikut:
<br>
{{ url('/assessment/'.$thesis->id) }}
<br><br>
Atas perhatian dan bantuannya, kami ucapkan terima kasih.
<br>
Koordinator dan Sekretaris Blok Skripsi