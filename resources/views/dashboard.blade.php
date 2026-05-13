@extends('layouts.user_type.auth')

@section('content')

@hasrole('admin')
<div class="col-12">
  <h6 class="mb-3 text-uppercase">Users Overview</h6>
</div>
<div class="row">
  <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bolder">Total Admin</p>
              <h5 class="font-weight-bolder mb-0">
                {{ $totalAdmins }}
              </h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
              <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bolder">Total Lecturers</p>
              <h5 class="font-weight-bolder mb-0">
                {{ $totalLecturers }}
              </h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
              <i class="ni ni-hat-3 text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bolder">Total Students</p>
              <h5 class="font-weight-bolder mb-0">
                {{ $totalStudents }}
              </h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
              <i class="ni ni-badge text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row my-4">
  <div class="col-12">
    <h6 class="mb-3 text-uppercase">Semester Overview</h6>
  </div>

  {{-- Semester Aktif --}}
  <div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bolder">Semester Aktif</p>
              <h6 class="font-weight-bolder mb-0">
                {{ $activeSemester->semester_name }} {{ $activeSemester->academicYear->year_name }}
              </h6>
              @if(!empty($activeSemester))
              <p class="text-secondary mb-0">
                {{ $semesterStart }} - {{ $semesterEnd }}
              </p>
              @endif
            </div>
          </div>
          <div class="col-4 text-end d-flex align-items-stretch justify-content-end">
            <div class="bg-gradient-info border-radius-lg w-50 h-100 d-flex align-items-center justify-content-center">
              <i class="ni ni-calendar-grid-58 text-white fs-1 opacity-10"></i>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endhasrole

@hasrole('student')
<div class="col-12 mb-4">
  <div class="card shadow-sm border-0">
    <div class="card-body px-4 py-4 d-flex justify-content-between align-items-center">
      <div>
        <h5 class="text-uppercase fw-bold mb-1">Welcome to the Student Portal</h5>
      </div>
      <div
        class="bg-gradient-primary text-white shadow-lg d-flex align-items-center justify-content-center rounded-circle"
        style="width: 60px; height: 60px;">
        <i class="ni ni-hat-3 text-lg opacity-10"></i>
      </div>
    </div>
  </div>
</div>
@endhasrole
@hasexactroles('lecturer')
<div class="col-12 mb-4">
  <div class="card shadow-sm border-0">
    <div class="card-body px-4 py-4 d-flex justify-content-between align-items-center">

      <div>
        <h5 class="text-uppercase fw-bold mb-1">Welcome to the Lecturer Portal</h5>
      </div>

      <div
        class="bg-gradient-primary text-white shadow-lg d-flex align-items-center justify-content-center rounded-circle"
        style="width: 60px; height: 60px;">
        <i class="ni ni-single-copy-04 text-lg opacity-10"></i>
      </div>

    </div>
  </div>
</div>
@endhasexactroles


@endsection