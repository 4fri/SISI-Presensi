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
                            <li class="breadcrumb-item active">Employee</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3 text-end">
                            <a class="btn btn-primary btn-sm" href="{{ route('create_employees') }}">Add</a>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Employee</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped table-responsive-xl">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Fullname</th>
                                            <th>Position</th>
                                            <th>ID NUMBER</th>
                                            <th>Phone Number</th>
                                            <th>Email</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employees as $value)
                                            @php
                                                $count = 1;

                                                if ($value->status === 1) {
                                                    $status = 'Active';
                                                } elseif ($value->status === 2) {
                                                    $status = 'Travel Permit';
                                                } else {
                                                    $status = 'Off Work';
                                                }

                                            @endphp
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>{{ $value->user->name ?? '' }}</td>
                                                <td>{{ $value->position->name ?? '' }}</td>
                                                <td>{{ $value->id_card ?? '' }}</td>
                                                <td>{{ $value->phone_number ?? '' }}</td>
                                                <td>{{ $value->user->email ?? '' }}</td>
                                                <td class="text-center">{{ $status }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <div class="container">
                            <div class="pagination d-flex">
                                <small>{{ $employees->links() }}</small>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
