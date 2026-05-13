@extends('layouts.user_type.auth')

@section('content')
<div class="card shadow-sm">
    <div class="card-header pb-0">
        <h4>Edit Tugas Akhir</h4>
    </div>
    <div class="card-body pt-2">

        <form action="{{ url('/thesis/' . $thesis->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                {{-- JUDUL SKRIPSI --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Judul Skripsi</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title', $thesis->title) }}" placeholder="Masukkan judul skripsi" required>
                </div>

                {{-- JENIS PENELITIAN --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jenis Penelitian</label>

                    <select name="research_type" class="form-control @error('research_type') is-invalid @enderror"
                        required>
                        <option value="">-- Pilih Jenis Penelitian --</option>

                        <option value="deskriptif" {{ old('research_type', $thesis->research_type)=='deskriptif' ?
                            'selected' : '' }}>
                            Deskriptif
                        </option>

                        <option value="analitik" {{ old('research_type', $thesis->research_type)=='analitik' ?
                            'selected' : '' }}>
                            Analitik
                        </option>
                    </select>
                </div>

                {{-- LINK NASKAH --}}
                <div class="col-12 mb-3">
                    <label class="form-label">Naskah Tugas Akhir</label>

                    <input type="url" name="naskah" class="form-control @error('naskah') is-invalid @enderror"
                        value="{{ old('naskah', $thesis->thesis_file) }}"
                        placeholder="Masukkan link Google Drive naskah tugas akhir" required>
                </div>

                {{-- LINK MANUSKRIP --}}
                <div class="col-12 mb-3">
                    <label class="form-label">Manuskript Tugas Akhir</label>

                    <input type="url" name="manuscript" class="form-control @error('manuscript') is-invalid @enderror"
                        value="{{ old('manuscript', $thesis->manuscript_file) }}"
                        placeholder="Masukkan link Google Drive manuskript tugas akhir" required>
                </div>

                {{-- LINK VIDEO --}}
                <div class="col-12 mb-4">
                    <label class="form-label">Video Presentasi</label>

                    <input type="url" name="video" class="form-control @error('video') is-invalid @enderror"
                        value="{{ old('video', $thesis->presentation_video) }}"
                        placeholder="Masukkan link Google Drive video presentasi" required>

                </div>

                {{-- BUTTON --}}
                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>

<script>
    document.querySelector('form').addEventListener('submit', function() {
    document.getElementById('submitBtn').innerText = 'Uploading...';
});
</script>
@endsection