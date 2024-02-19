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
                            {{-- <li class="breadcrumb-item"><a href="#">User Role</a></li> --}}
                            <li class="breadcrumb-item active">Create Employees</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Create Employee</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('store_employees') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group my-4">
                                        <label for="position_id">Employee Position <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control select-item @error('position_id') is-invalid @enderror"
                                            name="position_id">
                                            <option value="" hidden>Select Position...</option>
                                            @foreach ($positions as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('position_id')
                                            <div class="invalid-feedback">
                                                <strong><small>{{ $message }}</small></strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group my-4">
                                        <label for="userName">Fullname <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" value="{{ old('name') }}" id="userName"
                                            placeholder="Enter user fullname">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                <strong><small>{{ $message }}</small></strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group my-4">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" id="email"
                                            placeholder="Enter correct email">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                <strong><small>{{ $message }}</small></strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group my-4">
                                        <label for="password">Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password" id="password">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                <strong><small>{{ $message }}</small></strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group my-4">
                                        <label for="id_card">ID Card Number <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('id_card') is-invalid @enderror"
                                            name="id_card" value="{{ old('id_card') }}" id="id_card">
                                        @error('id_card')
                                            <div class="invalid-feedback">
                                                <strong><small>{{ $message }}</small></strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group my-4">
                                        <label for="phone_number">Phone Number <span class="text-danger">*</span></label>
                                        <input type="number"
                                            class="form-control @error('phone_number') is-invalid @enderror"
                                            name="phone_number" value="{{ old('phone_number') }}" id="phone_number">
                                        @error('phone_number')
                                            <div class="invalid-feedback">
                                                <strong><small>{{ $message }}</small></strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
