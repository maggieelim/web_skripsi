@extends('layouts.user_type.auth')
@section('content')
@include('admin.thesis.preview')

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
                    <button class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#importModal">
                        Import Excel
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

                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-dark text-sm font-weight-bolder">
                                    Mahasiswa</th>
                                <th class="text-center text-uppercase text-dark text-sm font-weight-bolder">
                                    Tanggal</th>
                                <th class="text-center text-uppercase text-dark text-sm font-weight-bolder">
                                    Ketua Sidang</th>
                                <th class="text-center text-uppercase text-dark text-sm font-weight-bolder">
                                    Pembimbing</th>
                                <th class="text-center text-uppercase text-dark text-sm font-weight-bolder">
                                    Penguji</th>
                                <th class="text-center text-uppercase text-dark text-sm font-weight-bolder">
                                    Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($theses as $thesis)
                            <tr>

                                {{-- STUDENT --}}
                                <td class="align-middle ps-2">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold text-dark text-sm">
                                            {{ $thesis->student?->user?->name ?? '-' }}
                                        </span>

                                        <span class="text-muted fw-semibold text-sm">
                                            {{ $thesis->student?->nim ?? '-' }}
                                        </span>
                                    </div>
                                </td>

                                {{-- DATE --}}
                                <td class="align-middle fw-bold text-center text-sm">
                                    {{ $thesis->scheduled_date
                                    ? \Carbon\Carbon::parse($thesis->scheduled_date)->format('d M Y')
                                    : '-' }}
                                </td>

                                {{-- EXAMINER --}}

                                <td class="align-middle fw-bold text-center text-sm">
                                    {{ optional(
                                    $thesis->examiners
                                    ->where('role', 'ketua sidang')
                                    ->first()
                                    )->lecturer?->user?->name ?? '-' }}
                                </td>

                                <td class="align-middle fw-bold text-center text-sm">
                                    {{ optional(
                                    $thesis->examiners
                                    ->where('role', 'penguji 2')
                                    ->first()
                                    )->lecturer?->user?->name ?? '-' }}
                                </td>
                                <td class="align-middle fw-bold text-center text-sm">
                                    {{ optional(
                                    $thesis->examiners
                                    ->where('role', 'penguji 1')
                                    ->first()
                                    )->lecturer?->user?->name ?? '-' }}
                                </td>

                                <td class="align-middle text-center">

                                    {{-- SHOW --}}
                                    <a href="{{ route('thesis.show', $thesis->id) }}"
                                        class="btn bg-gradient-secondary m-1 p-2 px-3" title="Info">
                                        <i class="fas fa-info-circle"></i>
                                    </a>

                                    {{-- ASSIGN --}}
                                    <a href="{{ route('admin.thesis.assign', $thesis->id) }}"
                                        class="btn bg-gradient-warning m-1 p-2 px-3" title="assign">
                                        <i class="fas fa-user-plus"></i>
                                    </a>
                                    @if($thesis->status == 'scheduled')
                                    @if(!$thesis->invitation_email_sent)

                                    <form action="{{ route('admin.thesis.send-email', $thesis->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf

                                        <button type="submit" class="btn btn-primary m-1 px-3 p-2"> <i
                                                class="fa-solid fa-envelope"></i>
                                            {{-- Send --}}
                                        </button>

                                    </form>
                                    @else
                                    <span class="badge bg-success">
                                        <i class="fa-solid fa-envelope me-1"></i> Sent
                                    </span>
                                    @endif
                                    @else
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    Data tidak ditemukan
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- PAGINATION --}}
                    <div class="d-flex justify-content-center mt-3">
                        <x-pagination :paginator="$theses" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- IMPORT MODAL --}}
<div class="modal fade" id="importModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.thesis.import.preview') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">
                        Import Excel
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">
                    <input type="file" name="file" class="form-control" accept=".xlsx,.xls,.csv" required>
                </div>

                <div class="modal-footer">
                    <a href="{{ route('admin.thesis.download') }}" class="btn btn-primary btn-sm">
                        Template
                    </a>
                    <button type="submit" class="btn btn-sm bg-gradient-info">
                        Preview Import
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection