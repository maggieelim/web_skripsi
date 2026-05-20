@extends('layouts.user_type.auth')

@section('content')
{{-- HEADER --}}
<div class="card shadow-sm border-0 mb-3">
    <div class="card-body py-2">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-1">
            <div>
                <h6 class="mb-0 fw-bold text-dark">
                    {{ $thesis->student->user->name }}
                </h6>
                <small class="text-muted">NIM: {{ $thesis->student->nim }}</small>
            </div>
            <span class="badge bg-gradient-info">{{ ucfirst($thesis->research_type) }}</span>
        </div>

        <hr class="my-1">

        <div>
            <small class="text-uppercase fw-bold text-muted">Judul</small>
            <p class="mb-0 small">{{ $thesis->title }}</p>
        </div>

    </div>
</div>
<form method="POST" action="{{ route('assessment.submit-final', $thesis->id) }}">
    @csrf

    @if(!$isRevisionPage)

    @foreach ($rubrics as $rubric)
    <div class="card shadow-sm ">

        {{-- HEADER RUBRIC --}}
        <div class="card-header p-2 bg-gradient-dark">
            <h6 class="text-white mb-0">
                {{ $rubric->code }}
                -
                {{ $rubric->name }}
            </h6>
        </div>

        <div class="card-body p-0 m-0">
            {{-- TABLE CRITERIA --}}
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead class="table-light">
                        <tr class="text-center align-middle">

                            <th class="text-center text-uppercase text-dark text-sm font-weight-bolder" width="7%">
                                Nilai
                            </th>

                            @foreach ($rubric->criteria->sortBy('score_level') as $criteria)
                            <th class="text-center text-uppercase text-dark text-sm font-weight-bolder" width="21%">
                                {{ $criteria->score_level }}
                            </th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <th class="bg-light text-center text-uppercase text-dark text-sm font-weight-bolder">
                                Kriteria
                            </th>

                            @foreach ($rubric->criteria->sortBy('score_level') as $criteria)
                            <td class="px-2 text-wrap text-dark" style="
                    vertical-align: top;
                    font-size: 15px;
                     ">

                                {!! nl2br(e(preg_replace('/^\s+|\n{2,}/', "\n", trim($criteria->description)))) !!}
                            </td>
                            @endforeach

                        </tr>

                        {{-- PILIH NILAI --}}
                        <tr>

                            <th class="text-center text-uppercase text-dark text-sm font-weight-bolder bg-light">
                                Pilih
                                Nilai
                            </th>

                            @for ($i = 0; $i <= 3; $i++) <td class="text-center align-middle bg-light">

                                <div class="form-check d-flex justify-content-center ">

                                    <input class="form-check-input score-radio" type="radio"
                                        name="scores[{{ $rubric->id }}]" value="{{ $i }}"
                                        data-rubric="{{ $rubric->id }}" id="score_{{ $rubric->id }}_{{ $i }}" {{
                                        isset($scores[$rubric->id]) &&
                                    $scores[$rubric->id] == $i ? 'checked' : '' }}
                                    required
                                    >

                                </div>

                                </td>
                                @endfor
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>
    @endforeach
    @endif
    @if($isRevisionPage)

    <div class="card">

        <div class="card-header p-2 bg-gradient-dark">
            <h6 class="text-white mb-0">
                Catatan Perbaikan
            </h6>
        </div>

        <div class="card-body pt-2">

            <div class="mb-3">
                <label class="form-label text-sm fw-bold">
                    1. Substansi
                </label>

                <textarea name="substance_note" class="form-control"
                    rows="2">{{ $notes->substance_note ?? '' }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label text-sm fw-bold">
                    2. Metodologi
                </label>

                <textarea name="methodology_note" class="form-control"
                    rows="2">{{ $notes->methodology_note ?? '' }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label text-sm fw-bold">
                    3. Teknis Penulisan
                </label>

                <textarea name="writing_note" class="form-control" rows="2">{{ $notes->writing_note ?? '' }}</textarea>
            </div>

        </div>

    </div>

    @endif
    {{-- PAGINATION --}}
    <div class="d-flex justify-content-center gap-2 flex-wrap mt-3">

        @for($i = 1; $i <= $totalPages; $i++) <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}"
            class="btn btn-sm {{ $page == $i ? 'bg-gradient-dark text-white' : 'btn-outline-dark' }}">
            {{ $i }}
            </a>
            @endfor
    </div>
    <div class="text-end">
        <button type="submit" class="btn bg-gradient-success">
            Submit Final Penilaian
        </button>
    </div>
    <div class="text-end">
        <span id="save-status" class="text-sm text-success fw-bold">
        </span>
    </div>

</form>
<script>
    document.addEventListener('DOMContentLoaded', function () {

    const radios = document.querySelectorAll('.score-radio');

    radios.forEach(radio => {

        radio.addEventListener('change', function () {

            const rubricId = this.dataset.rubric;
            const score = this.value;

            const status = document.getElementById('save-status');

            status.innerHTML = 'Saving...';

            fetch("{{ route('assessment.autosave', $thesis->id) }}", {

                method: 'POST',

                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },

                body: JSON.stringify({
                    rubric_id: rubricId,
                    score: score
                })

            })
            .then(response => response.json())
            .then(data => {

                status.innerHTML = '✓ Nilai tersimpan';

                setTimeout(() => {
                    status.innerHTML = '';
                }, 2000);

            })
            .catch(error => {

                status.innerHTML = '✕ Gagal menyimpan';

                console.error(error);

            });

        });

    });

});

</script>


@endsection