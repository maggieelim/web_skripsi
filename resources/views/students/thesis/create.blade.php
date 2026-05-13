@extends('layouts.user_type.auth')

@section('content')
<div class="card shadow-sm">
    <div class="card-header pb-0">
        <h4>Upload Skripsi Baru</h4>
    </div>
    <div class="card-body pt-2">

        <form action="{{ url('/thesis') }}" method="POST">
            @csrf

            <div class="row">
                {{-- JUDUL SKRIPSI --}}
                <div class="col-md-12 mb-3">
                    <label class="form-label">Judul Skripsi</label>

                    <textarea name="title" class="form-control @error('title') is-invalid @enderror"
                        placeholder="Masukkan judul skripsi" required>{{ old('title') }}</textarea>
                </div>

                {{-- JENIS PENELITIAN --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jenis Penelitian</label>

                    <select name="research_type" class="form-control @error('research_type') is-invalid @enderror"
                        required>
                        <option value="">-- Pilih Jenis Penelitian --</option>

                        <option value="deskriptif" {{ old('research_type')=='deskriptif' ? 'selected' : '' }}>
                            Deskriptif
                        </option>

                        <option value="analitik" {{ old('research_type')=='analitik' ? 'selected' : '' }}>
                            Analitik
                        </option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        Dosen Pembimbing
                    </label>

                    <input type="text" class="form-control lecturer-search" list="lecturer_list"
                        placeholder="Cari Dosen Pembimbing" data-target="supervisor_id" autocomplete="off" required>

                    <input type="hidden" name="supervisor_id" id="supervisor_id" value="{{ old('supervisor_id') }}">
                </div>

                <datalist id="lecturer_list">
                    @foreach ($lecturers as $lecturer)
                    @if ($lecturer->user)
                    <option value="{{ $lecturer->user->name }}" data-id="{{ $lecturer->id }}">
                    </option>
                    @endif
                    @endforeach
                </datalist>

                {{-- LINK NASKAH --}}
                <div class="col-12 mb-3">
                    <label class="form-label">Naskah Tugas Akhir</label>

                    <input type="url" name="naskah" class="form-control @error('naskah') is-invalid @enderror"
                        value="{{ old('naskah') }}" placeholder="Masukkan link Google Drive naskah tugas akhir"
                        required>
                </div>

                {{-- LINK MANUSKRIP --}}
                <div class="col-12 mb-3">
                    <label class="form-label">Manuskrip Tugas Akhir</label>

                    <input type="url" name="manuscript" class="form-control @error('manuscript') is-invalid @enderror"
                        value="{{ old('manuscript') }}" placeholder="Masukkan link Google Drive manuskrip tugas akhir"
                        required>
                </div>

                {{-- LINK VIDEO --}}
                <div class="col-12 mb-4">
                    <label class="form-label">Video Presentasi</label>

                    <input type="url" name="video" class="form-control @error('video') is-invalid @enderror"
                        value="{{ old('video') }}" placeholder="Masukkan link Google Drive video presentasi" required>

                </div>

                {{-- BUTTON --}}
                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" id="submit-btn">
                        Upload Skripsi
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    const lecturers = @json(
        $lecturers
            ->filter(fn($l) => $l->user)
            ->map(fn($l) => [
                'id' => $l->id,
                'name' => $l->user->name
            ])
            ->values()
    );

    // autocomplete lecturer
    document.querySelectorAll('.lecturer-search').forEach(input => {

        input.addEventListener('input', function () {

            const selected = lecturers.find(
                lecturer => lecturer.name === this.value
            );

            const target = document.getElementById(
                this.dataset.target
            );

            target.value = selected ? selected.id : '';

        });

    });

    // loading submit button
    document.querySelector('form').addEventListener('submit', function () {

        const btn = document.getElementById('submit-btn');

        btn.innerText = 'Uploading...';
        btn.disabled = true;

    });

</script>
@endsection