@extends('dashboard.layouts.site')
@section('title')
    Make Report
@endsection
@section('content')
    <div class="col-lg-6">
        <div class="card ">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Report Appointment
            </div>
            <div class="card-block ">
                <div class="form-group row">
                    <label for="name" class="col-md-4">Patient : </label>
                    <label for="name" class="col-md-4">{{ $appointment->user->name }}</label>

                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-4">Type : </label>
                    <label for="name" class="col-md-4">{{ $appointment->type->name }}</label>
                </div>
                <div class="form-group row">
                    <label for="date" class="col-md-4">Appointment time</label>
                    <label for="date" class="col-md-4">{{ $appointment->appointment_time }}</label>
                </div>
                <div class="form-group row">
                    <label for="date" class="col-md-4">Appointment Date</label>
                    <label for="date" class="col-md-4">{{ $appointment->appointment_date }}</label>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-4">Message</label>
                    <label for="" class="col-md-4">{{ $appointment->user_message }}</label>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card ">
            <div class="card-header">
                <i class="fa fa-align-justify"></i>Docotr Report
            </div>
            <div class="card-block ">
                <form action="{{ route('dashboard.appointments.update', $appointment->id) }}" method="POST">
                    @csrf
                    @method('put')
                    @include('dashboard.layouts._error')



                    <div class="form-group ">
                        <label for="name">Report </label>
                        <textarea name="docotr_report" id="" cols="30" rows="5" class="form-control">{{ old('docotr_report', $appointment->docotr_report) }}</textarea>
                    </div>
                    <div class="form-group ">
                        <label for="name">Price </label>
                        <input type="number" name="price" value="{{ old('price',$appointment->price) }}" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>
                            Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
