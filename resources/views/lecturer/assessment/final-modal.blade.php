<div class="modal fade" id="finalizationModal{{ $thesis->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    Finalisasi Sidang
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="{{ route('assessment.finalization.submit', $thesis->id) }}">
                @csrf

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            Mahasiswa
                        </label>

                        <input type="text" class="form-control" value="{{ $thesis->student->user->name }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            Nilai Akhir
                        </label>

                        <input type="text" class="form-control" value="{{ $thesis->final_score ?? '-' }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            Hasil Sidang
                        </label>

                        <select name="final_result" class="form-control" required>
                            <option value="">
                                -- Pilih Hasil --
                            </option>

                            <option value="Lulus Tanpa Perbaikan" {{ $thesis->final_result == 'Lulus Tanpa Perbaikan' ?
                                'selected' : '' }}
                                >
                                Lulus Tanpa Perbaikan
                            </option>

                            <option value="Lulus Dengan Perbaikan" {{ $thesis->final_result == 'Lulus Dengan Perbaikan'
                                ? 'selected' : '' }}
                                >
                                Lulus Dengan Perbaikan
                            </option>

                            <option value="Tidak Lulus" {{ $thesis->final_result == 'Tidak Lulus' ? 'selected' : '' }}
                                >
                                Tidak Lulus
                            </option>

                        </select>
                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn bg-gradient-success">
                        Finalisasi
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>