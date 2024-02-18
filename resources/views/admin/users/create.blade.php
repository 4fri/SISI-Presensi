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
                            <li class="breadcrumb-item active">Create Users</li>
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
                                <h3 class="card-title">Create User</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('store_users') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group my-4">
                                        <label for="role_id">User Role <span class="text-danger">*</span></label>
                                        <select class="form-control select-item @error('role_id') is-invalid @enderror"
                                            name="role_id">
                                            <option value="" hidden>Select Role...</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                <strong><small>{{ $message }}</small></strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group my-4">
                                        <label for="userName">Name User <span class="text-danger">*</span></label>
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
