@extends('layouts.site')
@section('title', 'Appointment')
@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Appointment</h2>
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Appointment</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page">
        <div class="container">
            <!-- ======= Appointment Section ======= -->
            <section id="appointment" class="appointment section-bg">
                <div class="container">

                    <div class="section-title">
                        <h2>Make an Appointment</h2>
                    </div>

                    <form action="{{ route('postAppointment') }}" method="post" role="form" class="php-email-form">
                        @csrf
                        @method('POST')
                        <div class="row">
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <p class="mb-0 text-danger">{{ $error }}</p>
                                @endforeach
                            @endif
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <div class="col-md-3 form-group mt-3">
                                <select name="doctor_id" id="doctor_id" class="form-select">
                                    <option value="">Select Doctor</option>
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                    @endforeach
                                </select>
                                <div class="validate">

                                </div>
                            </div>
                            <div class="col-md-3 form-group mt-3">
                                <select name="type_id" id="type_id" class="form-select">
                                    <option value="">Select Type</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                <div class="validate">

                                </div>
                            </div>
                            <div class="col-md-3 form-group mt-3">
                                <input type="date" name="appointment_date" class="form-control datepicker" id="date"
                                    placeholder="Appointment Date" data-rule="minlen:4"
                                    data-msg="Please enter at least 4 chars">
                                <div class="validate"></div>
                            </div>

                            <div class="col-md-3 form-group mt-3">
                                <input type="time" name="appointment_time" class="form-control datepicker" id="date"
                                    placeholder="Appointment Time" data-rule="minlen:4"
                                    data-msg="Please enter at least 4 chars">
                                <div class="validate"></div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <textarea class="form-control" name="user_message" rows="5" placeholder="Message (Optional)"></textarea>
                            <div class="validate"></div>
                        </div>
                        <div class="mb-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your appointment request has been sent successfully. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Make an Appointment</button></div>
                    </form>

                </div>
            </section><!-- End Appointment Section -->

        </div>
    </section>
@endsection
