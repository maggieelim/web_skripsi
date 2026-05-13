@extends('layouts.user_type.auth')

@section('content')
<div class="card border-0 shadow-sm">
    {{-- HEADER --}}
    <div class="card-header bg-white border-bottom pb-3">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
            <h4 class="fw-semibold mb-1">
                {{ $thesis->student->user->name }}
            </h4>
            <span class="badge bg-info px-3 py-2">
                {{ ucfirst($thesis->research_type) }}
            </span>
        </div>
    </div>

    <div class="card-body pt-4">
        {{-- INFORMASI MAHASISWA --}}
        <div class="mb-4">
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

                <div class="col-md-4">
                    <label class="text-muted small text-uppercase d-block mb-1">
                        Dosen Pembimbing
                    </label>
                    <span class="fw-medium">
                        {{ $thesis->examiners
                        ->where('role', 'penguji 2')
                        ->first()?->lecturer?->user?->name ?? 'Belum ditentukan' }}
                    </span>
                </div>
            </div>
        </div>

        {{-- JUDUL --}}
        <div class="mb-4">
            <h6 class="fw-semibold mb-2">
                Judul Tugas Akhir
            </h6>
            <p class="text-dark mb-0">
                {{ $thesis->title }}
            </p>
        </div>

        {{-- DOKUMEN --}}
        <div class="mb-4">
            <h6 class="fw-semibold mb-3">
                Dokumen Tugas Akhir
            </h6>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="p-3 border rounded bg-white">
                        <label class="text-muted small text-uppercase d-block mb-1">
                            Naskah Tugas Akhir
                        </label>
                        <a href="{{ $thesis->thesis_file }}" target="_blank" class="small">
                            Download PDF →
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 border rounded bg-white">
                        <label class="text-muted small text-uppercase d-block mb-1">
                            Manuskrip
                        </label>
                        <a href="{{ $thesis->manuscript_file }}" target="_blank" class="small">
                            Download File →
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 border rounded bg-white">
                        <label class="text-muted small text-uppercase d-block mb-1">
                            Video Presentasi
                        </label>
                        <a href="{{ $thesis->presentation_video }}" target="_blank" class="small">
                            Tonton Video →
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- HASIL SIDANG --}}
        @if (in_array($thesis->status, ['revision', 'passed', 'failed', 'completed']))
        <div class="row g-3 mb-3">
            @foreach ($thesis->examiners->sortBy('role') as $examiner)

            @php
            $revisionNote = $thesis->revisionNotes
            ->where('lecturer_id', $examiner->lecturer_id)
            ->first();
            @endphp

            <div class="col-md-4">
                <div class="p-3 border rounded bg-white h-100">
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
        @endif
    </div>
</div>
@endsection