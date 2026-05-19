@extends('layouts.user_type.auth')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div
                class="card-header pb-0 d-flex flex-wrap flex-md-nowrap justify-content-between align-items-start gap-2">
                <div>
                    <h5 class="mb-0">List Tugas Akhir</h5>
                </div>
                <div class="d-flex flex-wrap justify-content-start justify-content-md-end gap-2 mt-2 mt-md-0">
                    <!-- Tombol toggle collapse -->
                    <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse"
                        data-bs-target="#filterCollapse" aria-expanded="false" aria-controls="filterCollapse">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>
            </div>

            <!-- Collapse Form -->
            <div class="collapse" id="filterCollapse">
                <form method="GET" action="{{ route('thesis.index') }}">
                    <div class="mx-3 my-2 py-2">
                        <div class="row g-2 align-items-end">
                            <div class="col-12 d-flex justify-content-end gap-2 mt-2">
                                <a href="{{ route('thesis.index') }}" class="btn btn-light btn-sm">Reset</a>
                                <button type="submit" class="btn btn-primary btn-sm">Apply</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
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
                                    Score</th>
                                <th class="text-center text-uppercase text-dark text-sm font-weight-bolder">
                                    Status</th>
                                <th class="text-center text-uppercase text-dark text-sm font-weight-bolder">
                                    Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($theses as $thesis)
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
                                    {{ $thesis->scheduled_date
                                    ? \Carbon\Carbon::parse($thesis->scheduled_date)->format('d M Y')
                                    : '-' }}
                                </td>

                                {{-- SCORE --}}
                                <td class="align-middle fw-bold text-center ">
                                    {{ $thesis->final_score ?? '-' }}
                                </td>

                                {{-- STATUS --}}
                                <td class="align-middle fw-bold text-center text-sm">
                                    {{ ucfirst($thesis->final_result) }}
                                </td>

                                <td class="align-middle text-center">
                                    @if ($thesis->bap_file)
                                    <a href="{{ asset('storage/' . $thesis->bap_file) }}" target="_blank"
                                        class="btn bg-gradient-info m-1 p-2 px-3">
                                        <i class="fas fa-download me-2"></i>
                                        BAP
                                    </a>
                                    @endif
                                    {{-- SHOW --}}
                                    <a href="{{ route('admin.results.show', $thesis->id) }}"
                                        class="btn bg-gradient-secondary m-1 p-2 px-3" title="Info">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center mt-3">
                        <x-pagination :paginator="$theses" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection