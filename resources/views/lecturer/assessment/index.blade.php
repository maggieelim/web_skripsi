@extends('layouts.user_type.auth')

@section('content')

<div class="row">
    <div class="col-12">

        <div class="card border-0 shadow-sm">

            {{-- HEADER --}}
            <div class="card-header bg-white border-0 pb-3">

                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h5 class="mb-1 fw-bold">
                        List Tugas Akhir
                    </h5>
                    {{-- FILTER BUTTON --}}
                    <button class="btn btn-outline-secondary btn-sm mb-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#filterCollapse">

                        <i class="fas fa-filter me-1"></i>
                        Filter
                    </button>
                </div>
            </div>

            {{-- FILTER --}}
            <div class="collapse" id="filterCollapse">

                <form method="GET" action="{{ route('thesis.index') }}">

                    <div class="px-4 pb-3">

                        <div class="row g-3 align-items-end">

                            {{-- contoh filter nanti --}}
                            {{--
                            <div class="col-md-4">
                                <label class="form-label">
                                    Status
                                </label>

                                <select class="form-select" name="status">
                                    <option value="">Semua</option>
                                </select>
                            </div>
                            --}}

                            <div class="col-12 d-flex justify-content-end gap-2">
                                <a href="{{ route('thesis.index') }}" class="btn btn-light btn-sm mb-0">
                                    Reset
                                </a>
                                <button type="submit" class="btn btn-primary btn-sm mb-0">
                                    Apply
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            {{-- TABLE --}}
            <div class="card-body px-0 pt-0 pb-2">

                <div class="table-responsive">

                    <table class="table align-items-center mb-0">
                        @php
                        // Ambil semua parameter filter aktif, kecuali sort, dir, dan pagination
                        $filters = request()->except(['sort', 'dir', 'page']);
                        @endphp

                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-dark text-sm font-weight-bolder">
                                    Student</th>
                                <th class="text-center text-uppercase text-dark text-sm font-weight-bolder">
                                    Scheduled Date</th>
                                <th class="text-center text-uppercase text-dark text-sm font-weight-bolder">
                                    Status</th>
                                <th class="text-center text-uppercase text-dark text-sm font-weight-bolder">
                                    Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($theses as $thesis)
                            <tr>

                                {{-- STUDENT --}}
                                <td class="align-middle px-3">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold text-dark text-sm">
                                            {{ $thesis->student->user->name }}
                                        </span>

                                        <span class="text-muted fw-semibold text-sm">
                                            {{ $thesis->student->nim }}
                                        </span>
                                    </div>
                                </td>

                                {{-- DATE --}}
                                <td class="align-middle fw-bold text-center text-sm">
                                    {{ $thesis->scheduled_date ?
                                    \Carbon\Carbon::parse($thesis->scheduled_date)->format('d M Y') : '-' }}
                                </td>

                                {{-- STATUS --}}
                                <td class="align-middle fw-bold text-center text-sm">
                                    {{ ucfirst($thesis->status) }}
                                </td>

                                @php
                                $currentLecturer = auth()->user()->lecturer;

                                $isKetuaSidang = $thesis->examiners
                                ->where('lecturer_id', $currentLecturer?->id)
                                ->where('role', 'ketua sidang')
                                ->isNotEmpty();
                                @endphp

                                @if ($isKetuaSidang)
                                @include('lecturer.assessment.final-modal')
                                @endif
                                {{-- ACTION --}}
                                <td class="text-center">
                                    <a href="{{ route('assessment.show', $thesis->id) }}"
                                        class="btn bg-gradient-secondary m-1 p-2 px-3" title="Info">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    @if (in_array($thesis->status, ['assessed', 'ongoing','scheduled', 'submitted']))
                                    <a href="{{ route('assessment.form', $thesis->id) }}"
                                        class="btn bg-gradient-primary m-1 p-2 px-3">

                                        <i class="fas fa-pen me-1"></i>
                                        Input Assessment
                                    </a>
                                    @endif

                                    @if ($isKetuaSidang && $thesis->status === "assessed")
                                    <button type="button" class="btn bg-gradient-success m-1 p-2 px-3"
                                        data-bs-toggle="modal" data-bs-target="#finalizationModal{{ $thesis->id }}">
                                        <i class="fas fa-clipboard-check me-1"></i>
                                        Result
                                    </button>
                                    @endif
                                </td>
                            </tr>

                            @empty

                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    Data tugas akhir belum tersedia
                                </td>
                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- PAGINATION --}}
                <div class="d-flex justify-content-center mt-4 px-3">
                    <x-pagination :paginator="$theses" />
                </div>

            </div>

        </div>

    </div>
</div>
@endsection