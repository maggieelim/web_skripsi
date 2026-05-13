@extends('layouts.user_type.auth')

@section('content')
<div class="card border-0 shadow-sm">
    {{-- HEADER --}}
    <div class="card-header bg-white border-bottom p-3 pb-2">
        <div class="d-flex justify-content-between align-items-start ">
            <h5 class="fw-semibold mb-1">
                {{ $thesis->student->user->name }}
            </h5>
            <span class="badge bg-info px-3 py-2">
                {{ ucfirst($thesis->research_type) }}
            </span>
        </div>
    </div>

    <div class="card-body pt-3">
        {{-- INFORMASI MAHASISWA --}}
        <div class="mb-3">
            <div class="row g-4">
                <div class="col-md-4">
                    <label class="text-muted small text-uppercase d-block mb-1">
                        NIM
                    </label>
                    <span class="fw-medium">
                        {{ $thesis->student->nim }}
                    </span>
                </div>

                <div class="col-md-4">
                    <label class="text-muted small text-uppercase d-block mb-1">
                        Tanggal Sidang
                    </label>
                    <span class="fw-medium">
                        {{ $thesis->scheduled_date
                        ? \Carbon\Carbon::parse($thesis->scheduled_date)->format('d M Y • H:i')
                        : 'Belum dijadwalkan' }}
                    </span>
                </div>

                @php
                $supervisor = $thesis->examiners
                ->where('role', 'penguji 2')
                ->first();
                @endphp

                <div class="col-md-4">
                    <label class="text-muted small text-uppercase d-block mb-1">
                        Dosen Pembimbing
                    </label>

                    <span class="fw-medium">
                        {{ $supervisor?->lecturer?->user?->name ?? 'Belum ditentukan' }}, {{
                        $supervisor->lecturer->gelar }}
                    </span>
                </div>
            </div>
        </div>

        @if (in_array($thesis->status, ['draft', 'scheduled', 'submitted']))
        {{-- TIM PENGUJI --}}
        <div class="mb-3">
            <h6 class="fw-semibold">
                Tim Penguji
            </h6>
            <div class="row g-3">
                @foreach ($thesis->examiners->sortBy('role') as $examiner)
                <div class="col-md-4">
                    <div class="p-2 bg-light rounded">
                        <div class="text-muted small mb-1">
                            {{ Str::ucfirst($examiner->role) }}
                        </div>
                        <div class="fw-medium">
                            {{ $examiner->lecturer->user->name }}, {{ $examiner->lecturer->gelar }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        {{-- JUDUL --}}
        <div class="mb-3">
            <h6 class="fw-semibold mb-0">
                Judul Tugas Akhir
            </h6>
            <p class="text-dark mb-0">
                {{ $thesis->title }}
            </p>
        </div>

        {{-- DOKUMEN --}}
        <div class="mb-3">
            <h6 class="fw-semibold ">
                Dokumen Tugas Akhir
            </h6>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="p-2 border rounded bg-white">
                        <a href="{{ $thesis->thesis_file }}" target="_blank"
                            class=" text-uppercase text-decoration-underline fw-bold">
                            Naskah Tugas Akhir
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-2 border rounded bg-white">
                        <a href="{{ $thesis->manuscript_file }}" target="_blank"
                            class=" text-uppercase text-decoration-underline fw-bold">
                            Manuskrip
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-2 border rounded bg-white">
                        <a href="{{ $thesis->presentation_video }}" target="_blank"
                            class=" text-uppercase text-decoration-underline fw-bold">
                            Video Presentasi
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @if (!in_array($thesis->status, ['draft', 'scheduled', 'submitted']))
        {{-- HASIL SIDANG --}}
        <div class="mb-2">
            <h6 class="fw-semibold">
                Hasil Sidang
            </h6>

            <div class="row g-3 mb-3">
                {{-- NILAI AKHIR --}}
                <div class="col-md-4">
                    <div class="border rounded p-3 text-center bg-white h-100">
                        <div class="text-muted small mb-2">
                            Nilai Akhir
                        </div>

                        <div class="h3 fw-semibold mb-0">
                            {{ $thesis->final_score ?? '—' }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="border rounded p-3 text-center bg-white h-100">
                        <div class="text-muted small mb-2">
                            Hasil Akhir
                        </div>

                        <div class="h5 fw-semibold mb-0">
                            {{ $thesis->final_result ?? '—' }}
                        </div>
                    </div>
                </div>

                {{-- BAP --}}
                <div class="col-md-4">
                    <div class="border rounded p-3 text-center bg-white h-100">

                        <div class="text-muted small mb-2">
                            Berita Acara
                        </div>

                        @if ($thesis->bap_file)
                        <a href="{{ asset('storage/' . $thesis->bap_file) }}" target="_blank"
                            class="btn btn-sm bg-gradient-dark">
                            Download BAP
                        </a>
                        @else
                        <div class="text-muted">
                            Belum tersedia
                        </div>
                        @endif

                    </div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                @foreach ($thesis->examiners->sortBy('role') as $examiner)

                @php
                $score = $examiner->lecturer->supervisorScores
                ->where('thesis_id', $thesis->id)
                ->first();

                $revisionNote = $thesis->revisionNotes
                ->where('lecturer_id', $examiner->lecturer_id)
                ->first();
                @endphp

                <div class="col-md-4">
                    <div class="p-3 border rounded bg-white h-100">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-muted small mb-1">
                                    {{ Str::ucfirst($examiner->role) }}
                                </div>

                                {{-- NAMA DOSEN --}}
                                <div class="fw-medium mb-2">
                                    {{ $examiner->lecturer->user->name }},
                                    {{ $examiner->lecturer->gelar }}
                                </div>
                            </div>
                            {{-- SCORE --}}
                            <div class="fw-bold h4 mb-3">
                                {{ $score?->score ?? '-' }}
                            </div>
                        </div>
                        {{-- REVISION NOTE --}}
                        @if($revisionNote)
                        <div class="border-top pt-2">

                            <div class="mb-2">
                                <div class="small text-muted fw-bold">
                                    Substansi
                                </div>
                                @if($revisionNote->substance_note)
                                <div class="small text-dark">
                                    {{ $revisionNote->substance_note }}
                                </div>
                                @else
                                <div class="small text-dark">
                                    -
                                </div>
                                @endif
                            </div>

                            <div class="mb-2">
                                <div class="small text-muted fw-bold">
                                    Metodologi
                                </div>
                                @if($revisionNote->methodology_note)
                                <div class="small text-dark">
                                    {{ $revisionNote->methodology_note }}
                                </div>
                                @else
                                <div class="small text-dark">
                                    -
                                </div>
                                @endif
                            </div>

                            <div>
                                <div class="small text-muted fw-bold">
                                    Teknis Penulisan
                                </div>
                                @if($revisionNote->writing_note)
                                <div class="small text-dark">
                                    {{ $revisionNote->writing_note }}
                                </div>
                                @else
                                <div class="small text-dark">
                                    -
                                </div>
                                @endif
                            </div>

                        </div>
                        @endif

                    </div>
                </div>

                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection