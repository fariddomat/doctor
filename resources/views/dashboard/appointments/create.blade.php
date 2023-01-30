@extends('dashboard.layouts.site')
@section('title')
    Create type
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Create New Appointment
            </div>
            <div class="card-block ">
                <form action="{{ route('dashboard.appointments.store') }}" method="POST">
                    @csrf
                    @method('post')
                    @include('dashboard.layouts._error')


                    <div class="form-group">
                        <label for="name">Patient</label>
                        <select name="user_id" id="" class="form-control">
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Type</label>
                        <select name="type_id" id="" class="form-control">
                            @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Appointment time</label>
                        <input type="time" class="form-control" name="appointment_time" id="appointment_time"  value="{{ old('appointment_time') }}" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="date">Appointment Date</label>
                        <input type="date" class="form-control" name="appointment_date" id="appointment_date"  value="{{ old('appointment_date') }}" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="password">Message</label>
                        <textarea name="user_message" id="user_message" cols="30" rows="2" class="form-control">{{ old('user_message') }}</textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>
                            Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
