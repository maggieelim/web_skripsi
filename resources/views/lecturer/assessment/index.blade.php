@extends('layouts.user_type.auth')

@section('content')

<div class="row">
    <div class="col-12">

        <div class="card border-0 shadow-sm">

            {{-- HEADER --}}
            <div class="card-header bg-white border-0 pb-3">

                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <div class="d-flex flex-column flex-md-row align-items-md-center gap-2">
                        <h5 class="mb-1 fw-bold">
                            List Tugas Akhir
                        </h5>
                        @if ($semesterId)
                        @php
                        $selectedSemester = $semesters->firstWhere('id', $semesterId);
                        @endphp
                        <x-semester-badge :semester="$selectedSemester" :activeSemester="$activeSemester" />
                        @endif
                    </div>
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
                <form method="GET" action="{{ route('assessment.index') }}">

                    <div class="mx-3 my-2 py-2">

                        <div class="row g-2 align-items-end">

                            {{-- SEMESTER --}}
                            <div class="col-md-3">
                                <label class="form-label mb-1">
                                    Semester
                                </label>

                                <select name="semester_id" class="form-select">
                                    @foreach ($semesters as $semester)
                                    <option value="{{ $semester->id }}" {{ (request('semester_id') ?
                                        request('semester_id')==$semester->id
                                        : $activeSemester?->id == $semester->id)
                                        ? 'selected'
                                        : ''
                                        }}>

                                        {{ $semester->semester_name }}-{{ $semester->academicYear->year_name }}

                                        @if($activeSemester && $semester->id == $activeSemester->id)
                                        (Aktif)
                                        @endif
                                    </option>
                                    @endforeach

                                </select>
                            </div>

                            {{-- STATUS --}}
                            <div class="col-md-3">
                                <label class="form-label mb-1">
                                    Status
                                </label>
                                <select name="status" class="form-select">
                                    <option value="">
                                        -- Semua Status --
                                    </option>
                                    <option value="scheduled" {{ request('status')=='scheduled' ? 'selected' : '' }}>
                                        Scheduled
                                    </option>
                                    <option value="ongoing" {{ request('status')=='ongoing' ? 'selected' : '' }}>
                                        Ongoing
                                    </option>
                                    <option value="assessed" {{ request('status')=='assessed' ? 'selected' : '' }}>
                                        Assessed
                                    </option>
                                </select>
                            </div>

                            {{-- NIM --}}
                            <div class="col-md-3">
                                <label class="form-label mb-1">
                                    NIM
                                </label>

                                <input type="text" name="nim" class="form-control" value="{{ request('nim') }}"
                                    placeholder="NIM">
                            </div>

                            {{-- NAMA --}}
                            <div class="col-md-3">
                                <label class="form-label mb-1">
                                    Nama Mahasiswa
                                </label>

                                <input type="text" name="name" class="form-control" value="{{ request('name') }}"
                                    placeholder="Nama mahasiswa">
                            </div>

                            {{-- BUTTON --}}
                            <div class="col-12 d-flex justify-content-end gap-2 mt-2">
                                <a href="{{ route('assessment.index', ['reset' => true]) }}"
                                    class="btn btn-light btn-sm">Reset</a>
                                <button type="submit" class="btn btn-primary btn-sm">Apply</button>
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