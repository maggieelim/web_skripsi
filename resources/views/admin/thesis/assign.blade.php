@extends('layouts.user_type.auth')

@section('content')

@php
$examiner1 = $thesis->examiners->where('role', 'penguji 1')->first();
$examiner2 = $thesis->examiners->where('role', 'penguji 2')->first();
$chairman = $thesis->examiners->where('role', 'ketua sidang')->first();
@endphp

<div class="d-flex gap-3">
    <div class="card border-0 shadow-sm col-md-8">
        {{-- HEADER --}}
        <div class="card-header bg-white border-0 mb-0 pb-0">
            <h6 class="mb-0 pb-0 fw-bold text-dark">
                Assign Penguji Tugas Akhir
            </h6>
        </div>

        <div class="card-body mt-0 pt-2">
            {{-- INFORMASI MAHASISWA --}}
            <div class="mb-3 row">
                <div class="col-md-8">
                    <label class="text-xs text-uppercase fw-bold mb-2">
                        Nama Mahasiswa
                    </label>

                    <div class="px-1 fw-semibold text-dark">
                        {{ $thesis->student->user->name }}
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="text-xs text-uppercase fw-bold mb-2">
                        NIM
                    </label>

                    <div class="px-1 fw-semibold text-dark">
                        {{ $thesis->student->nim }}
                    </div>
                </div>
            </div>

            {{-- JUDUL --}}
            <div class="mb-3">
                <h6 class="mb-0 fw-bold">
                    Judul Tugas Akhir
                </h6>

                <p class="text-dark px-1 fw-semibold">
                    {{ $thesis->title }}
                </p>
            </div>
            {{-- DOKUMEN --}}
            <div class="mb-3">
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

            {{-- SIMILARITY --}}
            <div class="mb-3">
                <h6 class="fw-bold mb-3">
                    Similarity
                </h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="p-2 border rounded bg-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class=" text-muted text-uppercase fw-bold ">
                                    Similarity Skripsi
                                </div>
                                <div class="fw-bold text-dark">
                                    {{ rtrim(rtrim(number_format($thesis->thesis_similarity * 100, 2), '0'), '.') }}%
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="p-2 border rounded bg-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class=" text-muted text-uppercase fw-bold ">
                                    Similarity Manuskrip
                                </div>
                                <div class="fw-bold text-dark">
                                    {{ rtrim(rtrim(number_format($thesis->manuscript_similarity * 100, 2), '0'), '.')
                                    }}%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PUBLIKASI --}}
            <div class="mb-2">

                <h6 class="fw-bold mb-3">
                    Informasi Publikasi
                </h6>
                <div class="row g-3">

                    <div class="col-md-3">

                        <div class="p-3 border rounded bg-white">

                            <label class="text-muted small text-uppercase d-block mb-1">
                                Status
                            </label>

                            <div class="fw-semibold text-dark">

                                {{ $thesis->publication_status ?? '-' }}

                            </div>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="p-3 border rounded bg-white">

                            <label class="text-muted small text-uppercase d-block mb-1">
                                Nama Jurnal
                            </label>

                            <div class="fw-semibold text-dark">

                                {{ $thesis->journal_name ?? '-' }}

                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="p-3 border rounded bg-white">

                            <label class="text-muted small text-uppercase d-block mb-1">
                                Peringkat
                            </label>

                            <div class="fw-semibold text-dark">

                                {{ $thesis->journal_rank ?? '-' }}

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="card border-0 shadow-sm col-md-4">
        <form action="{{ route('admin.thesis.assign-examiners', $thesis->id) }}" method="POST">
            @csrf

            <div class="card-body pt-3">
                {{-- TIM PENGUJI --}}
                <h6 class="mb-0 fw-bold">
                    Tim Penguji
                </h6>
                <div class="row g-2">
                    <div class="col-md-12">
                        <label class="form-label fw-bold">
                            Judul
                        </label>

                        <textarea name="title" class="form-control" rows="2"
                            placeholder="Judul">{{ old('title', $thesis->title ?? '') }}</textarea>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-bold">
                            Tanggal Sidang
                        </label>

                        <input type="datetime-local" name="date" class="form-control"
                            value="{{ old('date', $thesis->scheduled_date ? \Carbon\Carbon::parse($thesis->scheduled_date)->format('Y-m-d\TH:i') : '') }}"
                            placeholder="Tanggal Sidang">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">
                            Ruang
                        </label>
                        <input type="text" name="ruang" class="form-control" value="{{ old('ruang', $thesis->ruang) }}"
                            placeholder="Ruang">
                    </div>
                    {{-- PENGUJI 1 --}}
                    <div class="col-md-12">
                        <label class="form-label fw-bold">
                            Penguji 1
                        </label>

                        <input type="text" class="form-control lecturer-search" list="lecturer_list"
                            placeholder="Cari Penguji 1" data-target="examiner1_id"
                            value="{{ optional($examiner1->lecturer ?? null)?->user?->name }}" required>

                        <input type="hidden" name="examiners[0][lecturer_id]" id="examiner1_id"
                            value="{{ optional($examiner1)->lecturer_id }}">

                        <input type="hidden" name="examiners[0][role]" value="penguji 1">
                    </div>

                    {{-- PENGUJI 2 --}}
                    <div class="col-md-12">
                        <label class="form-label fw-bold">
                            Penguji 2
                        </label>

                        <input type="text" class="form-control lecturer-search" list="lecturer_list"
                            placeholder="Cari Penguji 2" data-target="examiner2_id"
                            value="{{ optional($examiner2->lecturer ?? null)?->user?->name }}" required>

                        <input type="hidden" name="examiners[1][lecturer_id]" id="examiner2_id"
                            value="{{ optional($examiner2)->lecturer_id }}">

                        <input type="hidden" name="examiners[1][role]" value="penguji 2">
                    </div>

                    {{-- PENGUJI 3 --}}
                    <div class="col-md-12">
                        <label class="form-label fw-bold">
                            Ketua Sidang
                        </label>

                        <input type="text" class="form-control lecturer-search" list="lecturer_list"
                            placeholder="Cari Ketua Sidang" data-target="chairman_id"
                            value="{{ optional($chairman->lecturer ?? null)?->user?->name }}" required>

                        <input type="hidden" name="examiners[2][lecturer_id]" id="chairman_id"
                            value="{{ optional($chairman)->lecturer_id }}">

                        <input type="hidden" name="examiners[2][role]" value="ketua sidang">
                    </div>
                </div>

                {{-- BUTTON --}}
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn bg-gradient-primary px-4" id="submitBtn">
                        <i class="fas fa-save me-2"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<datalist id="lecturer_list">
    @foreach ($lecturers as $lecturer)
    @if ($lecturer->user)
    <option value="{{ $lecturer->user->name }}" data-id="{{ $lecturer->id }}">
    </option>
    @endif
    @endforeach
</datalist>

<script>
    document.querySelector('form').addEventListener('submit', function () {
        const btn = document.getElementById('submitBtn');

        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
        btn.disabled = true;
    });

    const lecturers = @json(
        $lecturers
            ->filter(fn($l) => $l->user)
            ->map(fn($l) => [
                'id' => $l->id,
                'name' => $l->user->name
            ])
            ->values()
    );

    document.querySelectorAll('.lecturer-search').forEach(input => {
        input.addEventListener('input', function () {
            const selected = lecturers.find(
                lecturer => lecturer.name === this.value
            );

            const target = document.getElementById(this.dataset.target);
            target.value = selected ? selected.id : '';
        });
    });
</script>

@endsection