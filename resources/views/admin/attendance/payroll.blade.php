@extends('layouts.app')


@section('content')
    @include('layouts.nav-header')

    @include('layouts.sidebar')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Payroll <b>{{ $employee->user->name ?? '' }}</b></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><b>{{ $employee->user->name ?? '' }} </b>Payroll Detail</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
                                <div class="row">
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">No Telephone</span>
                                                <span
                                                    class="info-box-number text-center text-muted mb-0">{{ $employee->phone_number ?? '' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">ID Card Number</span>
                                                <span
                                                    class="info-box-number text-center text-muted mb-0">{{ $employee->id_card ?? '' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Employee Position</span>
                                                <span
                                                    class="info-box-number text-center text-muted mb-0">{{ $employee->position->name ?? '' }}
                                                    - {{ $employee->position->salary ?? '' }} -
                                                    {{ $employee->position->salary_note ?? '' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Attendance</span>
                                                <span
                                                    class="info-box-number text-center text-muted mb-0">{{ $attendanceHadir ?? '' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Total Not Present</span>
                                                <span
                                                    class="info-box-number text-center text-muted mb-0">{{ $attendanceTidakHadir ?? '' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Attendance Pay Cut</span>
                                                <span
                                                    class="info-box-number text-center text-muted mb-0">{{ $attendancePayCut ?? '' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Total Payment</span>
                                                <span
                                                    class="info-box-number text-center text-muted mb-0">{{ $totalPay ?? '' }}
                                                    - {{ $currentMonthName ?? '' }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <form action="{{ route('store_payroll_attendances', $employee->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group mt-4">
                                            <div class="row">
                                                <label>Status Payment <span class="text-danger">*</span></label>
                                                <div class="col-6">
                                                    <select
                                                        class="form-control select-item @error('status_payment') is-invalid @enderror"
                                                        name="status_payment">
                                                        <option value="" hidden>Select Status...</option>
                                                        <option value="Already paid"
                                                            {{ old('status_payment', $employee->payroll->status) == 'Already paid' ? 'selected' : '' }}>
                                                            Already paid</option>
                                                        <option value="Not yet paid"
                                                            {{ old('status_payment', $employee->payroll->status) == 'Not yet paid' ? 'selected' : '' }}>
                                                            Not yet paid</option>
                                                    </select>
                                                    @error('status_payment')
                                                        <div class="invalid-feedback">
                                                            <strong><small>{{ $message }}</small></strong>
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    @role('admin')
                                                        <button type="submit" class="btn btn-outline-primary">Submit</button>
                                                    @endrole
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

        </section>
        <!-- /.content -->
    </div>
@endsection
