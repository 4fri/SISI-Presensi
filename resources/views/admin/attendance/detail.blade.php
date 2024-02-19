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
                            <li class="breadcrumb-item active">Attendance <b>{{ $employee->user->name }}</b></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="my-4 text-right">
                    <a class="btn btn-warning btn-sm" href="{{ route('payroll_attendances', $employee->id) }}">Payroll</a>
                </div>
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Attendance Detail</h3>
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
                                                    class="info-box-number text-center text-muted mb-0">{{ $employee->phone_number }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">ID Card Number</span>
                                                <span
                                                    class="info-box-number text-center text-muted mb-0">{{ $employee->id_card }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Employee Position</span>
                                                <span
                                                    class="info-box-number text-center text-muted mb-0">{{ $employee->position->name }}
                                                    - {{ $employee->position->salary }} -
                                                    {{ $employee->position->salary_note }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><strong>{{ $employee->user->name }}</strong> Attendance</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Check In</th>
                                        <th>Status</th>
                                        <th>Note</th>
                                        {{-- <th class="text-end">Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 1;
                                    @endphp
                                    @foreach ($attendance as $value)
                                        <tr>
                                            <td>{{ $count++ }}</td>
                                            <td>{{ date('D M Y - H:i:s', strtotime($value->check_in)) }}</td>
                                            <td>{{ $value->status }}</td>
                                            <td>{{ $value->note }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    {{-- <!-- /.card -->
                    <div class="container">
                        <div class="pagination d-flex">
                            <small>{{ $attendance->links() }}</small>
                        </div>
                    </div> --}}
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
@endsection
