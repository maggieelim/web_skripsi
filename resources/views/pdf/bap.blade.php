<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        @page {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            margin: 0px;
            padding-right: 30px;
            padding-left: 30px;
        }

        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            vertical-align: top;
        }

        .score-table th,
        .score-table td {
            border: 1px solid #000;
            padding: 4px;
        }

        .score-table th {
            background: #f2f2f2;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        .signature {
            margin-top: 60px;
            width: 100%;
        }

        .signature td {
            border: none;
        }

        .signature-name {
            margin-top: 80px;
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div style="text-align: center; margin-bottom: 15px;">
        <img src="{{ public_path('assets/img/Heading.jpeg') }}" style="width: 100%;">
    </div>
    {{-- TITLE --}}
    <div class="title">
        BERITA ACARA UJIAN TUGAS AKHIR
    </div>

    {{-- INFORMASI MAHASISWA --}}
    <table class="info-table">
        <tr>
            <td width="18%">Nama</td>
            <td width="2%">:</td>
            <td>{{ $thesis->student->user->name }}</td>
        </tr>

        <tr>
            <td>NIM</td>
            <td>:</td>
            <td>{{ $thesis->student->nim }}</td>
        </tr>

        <tr>
            <td>Program Studi</td>
            <td>:</td>
            <td>Sarjana Kedokteran</td>
        </tr>

        <tr>
            <td>Fakultas</td>
            <td>:</td>
            <td>Kedokteran</td>
        </tr>

        <tr>
            <td>Judul Tugas Akhir</td>
            <td>:</td>
            <td>{{ $thesis->title }}</td>
        </tr>
    </table>

    <br>

    {{-- DESKRIPSI --}}
    <div style="margin-bottom: 15px;">
        Telah diuji pada tanggal
        <b>{{ \Carbon\Carbon::parse($thesis->scheduled_date)->translatedFormat('d F Y') }}</b>
        oleh Dewan Penguji Tugas Akhir, yang terdiri atas:
    </div>

    {{-- TABEL NILAI --}}
    <table class="score-table">
        <thead>
            <tr>
                <th width="28%"></th>
                <th width="42%">Nama</th>
                <th width="15%">Nilai</th>
                <th width="15%">Nilai Akhir</th>
            </tr>
        </thead>

        <tbody>
            @php
            $sortedScores = $thesis->supervisorScore->sortBy(function ($score) {
            $examiner = $score->thesis->examiners
            ->where('lecturer_id', $score->lecturer_id)
            ->first();

            if ($examiner?->role == 'ketua sidang') {
            return 0;
            } elseif ($examiner?->role == 'penguji 1') {
            return 1;
            } else {
            return 2;
            }
            });
            @endphp
            @foreach($sortedScores as $score)
            <tr>
                @php
                $examiner = $score->thesis->examiners
                ->where('lecturer_id', $score->lecturer_id)
                ->first();

                $role = $examiner?->role;
                @endphp

                <td>
                    @if ($role == 'ketua sidang')
                    Ketua Tim Penguji
                    @elseif ($role == 'penguji 1')
                    Penguji
                    @else
                    Penguji dan Pembimbing
                    @endif
                </td>

                <td>
                    {{ $score->lecturer->user->name }}, {{ $score->lecturer->gelar }}
                </td>

                <td class="text-center">
                    {{ number_format($score->score, 2) }}
                </td>

                @if($loop->first)
                <td rowspan="{{ $thesis->supervisorScore->count() }}" class="text-center"
                    style="vertical-align: middle; font-weight:bold;">
                    {{ number_format($thesis->final_score, 2) }}
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    {{-- HASIL --}}
    <table class="info-table">
        <tr>
            <td colspan="2">Tugas Akhir di atas dinyatakan:</td>
        </tr>
        <tr>
            <td width="5%">@if($result == 'Lulus Tanpa Perbaikan') ✔ @endif</td>
            <td>Lulus tanpa perbaikan</td>
        </tr>

        <tr>
            <td>@if($result == 'Lulus Dengan Perbaikan') ✔ @endif</td>
            <td>Lulus dengan perbaikan</td>
        </tr>

        <tr>
            <td>@if($result == 'Tidak Lulus') ✔ @endif</td>
            <td>Tidak lulus</td>
        </tr>
    </table>

    {{-- TTD --}}
    <table class="signature">
        <tr>
            <td class="text-center">
                Jakarta,
                {{ now()->translatedFormat('d F Y') }}
                <br>
                Ketua Dewan/Tim Penguji
                <br><br><br><br>
            </td>
        </tr>

        <tr>
            <td class="text-center">
                {{ $ketua->lecturer->user->name}}, {{ $ketua->lecturer->gelar }}
            </td>
        </tr>
    </table>
    <div style="position: fixed; bottom: 0; left: 0; right: 0; text-align: center;">
        <img src="{{ public_path('assets/img/Footer.jpeg') }}" style="width: 100%;">
    </div>
</body>

</html>