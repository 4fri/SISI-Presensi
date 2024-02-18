@extends('layouts.app')

@section('content')
    @include('layouts.nav-header')
    @include('layouts.sidebar')

    <section>
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                {{-- <li class="breadcrumb-item"><a href="#">User Role</a></li> --}}
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <div class="col-12 col-sm-6 col-md-12 d-flex align-items-stretch flex-column">
                <div class="card bg-light d-flex flex-fill">
                    <div class="card-header text-muted border-bottom-0">
                        {{ $user->employee->position->name ?? '' }}
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-7">
                                <h2 class="lead"><b>{{ $user->name ?? '' }}</b></h2>
                                <p class="text-muted text-sm"><b>ID Number: {{ $user->employee->id_card }}</b> </p>
                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone
                                        #: {{ $user->employee->phone_number }}
                                    </li>
                                </ul>
                            </div>
                            <div class="col-5 text-center">
                                @if ($user->photo !== null)
                                    <img src="{{ asset('storage/' . $user->photo) }}" alt="user-avatar"
                                        class="img-rounded img-fluid w-25">
                                @else
                                    <i class="fas fa-user fa-5x"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-left">
                            <a href="{{ route('edit_profile_employee') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-pen"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
@endsection
