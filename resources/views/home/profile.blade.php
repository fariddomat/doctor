@extends('layouts.site')
@section('title', 'Profile')
@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>{{ $user->name }} Profile</h2>
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>{{ $user->name }} Profile</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <section id="profile" class="profile">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-3">
                    <ul class="nav nav-tabs flex-column">
                        <li class="nav-item">
                            <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1"><i class="fa fa-user"></i>
                                Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-2"><i class="fa fa-calendar"></i>
                                Appointments</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('appointment') }}">
                                <i class="fa fa-calendar"></i> New Appointment
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                <i class="fa fa-lock"></i> Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-9">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="tab-1">
                            <div class="row gy-4">
                                <div class="col-lg-12 details">
                                    <h3>Edit Information</h3>
                                    <form action="{{ route('updateProfile') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        @if ($errors->any())
                                            @foreach ($errors->all() as $error)
                                                <p class="mb-0 text-danger">{{ $error }}</p>
                                            @endforeach
                                        @endif
                                        <div class="row mb-3">
                                            <label for="" class="col-lg-2">Name</label>
                                            <div class="col-lg-8">
                                                <input type="text" value="{{ $user->name }}" class="form-control "
                                                    name="name" id="">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="" class="col-lg-2">Email</label>
                                            <div class="col-lg-8">
                                                <input type="email" value="{{ $user->email }}" class="form-control "
                                                    name="email" id="">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="" class="col-lg-2">Mobile</label>
                                            <div class="col-lg-8">
                                                <input type="text" value="{{ $user->mobile }}" class="form-control "
                                                    name="mobile" id="">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="" class="col-lg-2">Password</label>
                                            <div class="col-lg-8">
                                                <input type="password" autocomplete="new-password" class="form-control "
                                                    name="password" id="">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="" class="col-lg-2">Confirm Password</label>
                                            <div class="col-lg-8">
                                                <input type="password" autocomplete="new-password" class="form-control "
                                                    name="password_confirmation" id="">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-2 offset-md-5">

                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-2">
                            <div class="row gy-4">
                                <div class="col-lg-12 details">
                                    <div class="card">
                                        <div class="card-header">
                                            <i class="fa fa-align-justify"></i> Appointment
                                        </div>
                                    <div class="card-block table-responsive">
                                        @if ($user->patient->appointments->count() > 0)
                                        <table id="dataTable" class="table table-striped display responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th class="none">Type</th>
                                                    <th class="none">User Message</th>
                                                    <th class="none">Doctor Report</th>
                                                    <th class="none">Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($user->patient->appointments as $index => $appointment)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $appointment->appointment_date }}</td>
                                                        <td>{{ $appointment->appointment_time }}</td>
                                                        <td>{{ $appointment->type->name }}</td>
                                                        <td>{{ $appointment->user_message }}</td>
                                                        <td>{{ $appointment->docotr_report }}</td>
                                                        <td>{{ $appointment->price }}</td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @else
                                            <h3 style="font-weight: 400">Sorry no record found !</h3>
                                        @endif
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End Departments Section -->

@endsection
