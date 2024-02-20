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
                            <li class="breadcrumb-item active">Off Work</li>
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
                            @role('employee')
                                <a class="btn btn-primary btn-sm" href="{{ route('create_off_work') }}">Add</a>
                            @endrole
                        </div>

                        <form class="form-inline mb-4">
                            <div class="form-group input-group-lg">
                                <input class="form-control" name="search" type="search"
                                    placeholder="Search name or id card" aria-label="Search">
                            </div>
                        </form>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Off Work</h3>
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
                                            <th>Date Off Work</th>
                                            <th>Description</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($offWorks as $value)
                                            @php
                                                $count = 1;

                                                if ($value->status === 1) {
                                                    $status = 'Accepted';
                                                } elseif ($value->status === 2) {
                                                    $status = 'Rejected';
                                                } else {
                                                    $status = 'Waiting';
                                                }

                                            @endphp
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>{{ $value->employee->user->name ?? '' }}</td>
                                                <td>{{ $value->employee->position->name ?? '' }}</td>
                                                <td>{{ $value->employee->id_card ?? '' }}</td>
                                                <td>{{ date('d M Y', strtotime($value->date_off)) }}</td>
                                                <td>{{ $value->description }}</td>
                                                <td>
                                                    <form action="{{ route('update_off_work', $value->id) }}" method="POST"
                                                        class="status-form"
                                                        onsubmit="return confirm('Are you sure you want to update this status?');">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="d-flex align-items-center">
                                                            <select class="form-select status-dropdown" name="status"
                                                                data-employee-id="{{ $value->id }}" {{ $prop_status }}>
                                                                <option value="1"
                                                                    {{ $value->status === 1 ? 'selected' : '' }}>
                                                                    Accepted
                                                                </option>
                                                                <option value="2"
                                                                    {{ $value->status === 2 ? 'selected' : '' }}>
                                                                    Rejected
                                                                </option>
                                                                <option value="0"
                                                                    {{ $value->status === 0 ? 'selected' : '' }}>
                                                                    Waiting
                                                                </option>
                                                            </select>
                                                            @role('admin')
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-sm ms-2">Update</button>
                                                            @endrole
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <div class="container">
                            <div class="pagination d-flex">
                                <small>{{ $offWorks->links() }}</small>
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
