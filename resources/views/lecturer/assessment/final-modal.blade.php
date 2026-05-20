<div class="modal fade" id="finalizationModal{{ $thesis->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header pb-2">
                <h5 class="modal-title">
                    {{ $thesis->student->user->name }} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>

            <form method="POST" action="{{ route('assessment.finalization.submit', $thesis->id) }}">
                @csrf
                <div class="modal-body">
                    {{-- NILAI DOSEN PENGUJI --}}
                    <div class="mb-3">

                        <div class="fw-bold small">
                            Nilai Penguji
                        </div>

                        <div class="border rounded">

                            @foreach ($thesis->examiners->sortBy('role') as $examiner)

                            @php
                            $score = $examiner->lecturer?->supervisorScores
                            ?->where('thesis_id', $thesis->id)
                            ->first();
                            @endphp

                            <div class="d-flex justify-content-between align-items-center px-2 py-1 border-bottom">

                                <div>
                                    <div class="fw-semibold small">
                                        {{ ucfirst($examiner->role) }}
                                    </div>

                                    <div class="text-muted small">
                                        {{ $examiner->lecturer?->user?->name ?? '-' }}, {{ $examiner->lecturer?->gelar
                                        ?? '' }}
                                    </div>
                                </div>

                                <div class="fw-bold fs-6">
                                    {{ $score?->score ?? '-' }}
                                </div>

                            </div>

                            @endforeach

                        </div>

                    </div>

                    <div class="mb-3">
                        <div class="fw-bold small">
                            Nilai Akhir
                        </div>
                        <input type="text" class="form-control" value="{{ $thesis->final_score ?? '-' }}" readonly>
                    </div>

                    {{-- HASIL SIDANG --}}
                    <div>
                        <div class="fw-bold small">
                            Hasil Sidang
                        </div>

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

                <div class="modal-footer pb-0">
                    <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-sm bg-gradient-success">
                        Finalisasi
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>