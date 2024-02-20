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
                            <li class="breadcrumb-item active">Create Off Works</li>
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
                                <h3 class="card-title">Create Off Work</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('store_off_work') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group my-4">
                                        <label for="date_off">Date Off <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('date_off') is-invalid @enderror"
                                            name="date_off" value="{{ old('date_off') }}" id="date_off"
                                            placeholder="Enter date...">
                                        @error('date_off')
                                            <div class="invalid-feedback">
                                                <strong><small>{{ $message }}</small></strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group my-4">
                                        <label for="description">Description <span class="text-danger">*</span></label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"
                                            placeholder="Enter description" cols="30" rows="3"></textarea>
                                        @error('description')
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
