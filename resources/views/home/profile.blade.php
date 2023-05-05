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
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-2"><i class="fa fa-edit"></i>
                                Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-3"><i class="fa fa-calendar"></i>
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
                                    <h3>Edit Information</h3>
                                    <form action="{{ route('updatePatient') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        @if ($errors->any())
                                            @foreach ($errors->all() as $error)
                                                <p class="mb-0 text-danger">{{ $error }}</p>
                                            @endforeach
                                        @endif
                                        <input type="hidden" name="id" value="{{ $user->patient->id }}">
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <div class="row mb-3">
                                            <label for="" class="col-lg-2">Your Rank</label>
                                            <label for="" class="col-lg-8">{{ $user->patient->rank }}
                                                @if ($user->patient->rank_details)

                                                 - {{ $user->patient->rank_details }}
                                                @endif</label>

                                        </div>
                                        <div class="row mb-3">
                                            <label for="" class="col-lg-2">Age</label>
                                            <div class="col-lg-8">
                                                <input type="number" min="1" max="100"
                                                    value="{{ $user->patient->age }}" class="form-control "
                                                    name="age" id="">
                                            </div>
                                        </div>


                                        <div class="row mb-3">
                                            <label for="" class="col-lg-2">Address</label>
                                            <div class="col-lg-8">
                                                <textarea name="address" id="" cols="" rows="" class="form-control">{{ $user->patient->address }}</textarea>
                                            </div>
                                        </div>


                                        <div class="row mb-3">
                                            <label for="" class="col-lg-2">Details</label>
                                            <div class="col-lg-8">
                                                <textarea name="details" id="" cols="" rows="" class="form-control">{{ $user->patient->details }}</textarea>
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

                        <div class="tab-pane" id="tab-3">
                            <div class="row gy-4">
                                <div class="col-lg-12 details">
                                    <div class="card">
                                        <div class="card-header">
                                            <i class="fa fa-align-justify"></i> Appointment
                                        </div>
                                        <div class="card-block table-responsive">
                                            @if ($appointments->count() > 0)
                                                <table id="dataTable"
                                                    class="table table-striped display responsive nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Doctor</th>
                                                            <th>Date</th>
                                                            <th>Time</th>
                                                            <th>Status</th>
                                                            <th class="none">Type</th>
                                                            <th class="none">User Message</th>
                                                            <th class="none">Doctor Report</th>
                                                            <th class="none">Fee</th>
                                                            <th class="none">Un Paid Fee</th>
                                                            <th class="none">Action</th>
                                                            <th class="none">Status Log</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($appointments as $index => $appointment)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $appointment->doctor_appointment->doctor->user->name }}
                                                                </td>
                                                                <td>{{ $appointment->appointment_date }}</td>
                                                                <td>{{ $appointment->appointment_time }}</td>
                                                                <td>{{ $appointment->status }}</td>
                                                                <td>{{ $appointment->type->name }}</td>
                                                                <td>{{ $appointment->user_message }}</td>

                                                                @if ($appointment->treatment)
                                                                    <td>
                                                                        {{ $appointment->treatment->report }}</td>

                                                                    <td>{{ $appointment->treatment->fee }}</td>
                                                                    <td>{{ $appointment->treatment->unpaid_amount }}</td>
                                                                @else
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                @endif
                                                                <td>
                                                                    @if ($appointment->status != 'done' && $appointment->status != 'reject'  && $appointment->status != 'cancel')
                                                                        <a href="{{ route('updateAppointment', $appointment->id) }}"
                                                                            class="btn btn-sm btn-outline-warning"
                                                                            style="display: inline-block"><i
                                                                                class="fa fa-edit"></i> Edit</a>


                                                                        <form
                                                                            action="{{ route('cancelAppointment', $appointment->id) }}"
                                                                            method="POST" style="display: inline-block">
                                                                            @csrf
                                                                            @method('delete')
                                                                            <button type="submit"
                                                                                class="btn btn-sm btn-outline-danger delete"
                                                                                style="display: inline-block"><i
                                                                                    class="fa fa-trash"
                                                                                    aria-hidden="true"></i>
                                                                                Cancel</button>
                                                                        </form>
                                                                    @endif



                                                                </td>
                                                                <td>
                                                                    <table class="table table-striped " class="mt-3">
                                                                        @foreach ($appointment->statuses->reverse() as $status)
                                                                            <tr>

                                                                                <td>

                                                                                    <h5 class="mt-1">
                                                                                        {{ $status->status }} </h5>
                                                                                </td>
                                                                                <td>
                                                                                    <span class="text-primary bold">
                                                                                        {{ $status->created_at->diffForHumans() }}</span>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </table>

                                                                </td>
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
