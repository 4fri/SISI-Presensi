@extends('layouts.app')

@section('content')
    @include('layouts.nav-header')
    @include('layouts.sidebar')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            {{-- <li class="breadcrumb-item"><a href="#">User Role</a></li> --}}
                            <li class="breadcrumb-item active">Edit Account</li>
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
                                <h3 class="card-title">Edit Account</h3>
                            </div>

                            <!-- form start -->
                            <form action="{{ route('update_profile_employee') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="card-body">
                                    {{-- <div class="form-group my-4">
                                        <label for="position_id">Employee Position <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control select-item @error('position_id') is-invalid @enderror"
                                            name="position_id">
                                            <option value="" hidden>Select Position...</option>
                                            @foreach ($positions as $position)
                                                <option value="{{ $position->id }}"
                                                    {{ old('position_id', $user->employee->position_id) == $position->id ? 'selected' : '' }}>
                                                    {{ $position->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('position_id')
                                            <div class="invalid-feedback">
                                                <strong><small>{{ $message }}</small></strong>
                                            </div>
                                        @enderror
                                    </div> --}}

                                    <div class="form-group my-4">
                                        <label for="IdCard">ID Card Number <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('id_card') is-invalid @enderror"
                                            name="id_card"
                                            value="{{ isset($user->employee) ? $user->employee->id_card : (old('id_card') != '' ? old('id_card') : '') }}"
                                            id="IdCard">
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
                                            name="phone_number"
                                            value="{{ isset($user->employee) ? $user->employee->phone_number : (old('phone_number') != '' ? old('phone_number') : '') }}"
                                            id="phone_number" placeholder="Enter correct phone_number">
                                        @error('phone_number')
                                            <div class="invalid-feedback">
                                                <strong><small>{{ $message }}</small></strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group my-4">
                                        <label for="photo">Photo Profile </label>
                                        <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                            name="photo" id="photo" placeholder="Enter correct photo">
                                        @error('photo')
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
    </div>
@endsection
