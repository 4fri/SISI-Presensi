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
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div class="col-12 col-sm-6 col-md-12 d-flex align-items-stretch flex-column">
            <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                    {{ $user->employee->position->name ?? "Haven't got a position yet" }}
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <h2 class="lead"><b>{{ $user->name ?? '' }}</b></h2>
                        <p class="text-muted text-sm"><b>ID Number: {{ $user->employee->id_card ?? '' }}</b> </p>
                        <p class="text-muted text-sm"><b>Total Attendance: {{ count($attendances) ?? '' }}</b> </p>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone
                                #: {{ $user->employee->phone_number ?? '' }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-left">
                        <form action="{{ route('check_in') }}" method="POST">
                            @csrf
                            <button class="btn btn-primary btn-sm">Check in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card -->
@endsection
