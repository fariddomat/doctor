@extends('dashboard.layouts.site')
@section('title')
    Edit type
@endsection
@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $('#appointment_date').on('change', function(e) {
                var appointment_date = e.target.value;
                $.ajax({
                    url: "{{ route('appointment.time') }}",
                    type: "POST",
                    data: {
                        appointment_date: appointment_date
                    },
                    success: function(data) {
                        $('#appointment_time').empty();
                        var i=0;
                        $.each(data.time, function(index,
                            t) {
                                i++;
                            $('#appointment_time').append('<option value="' +
                                t
                                .id + '">' + t.time + '</option>');
                        })
                        if (i == 0) {
                            $('#appointment_time').append('<option>No Times available</option>');
                        }
                    }
                })
            });
        });
    </script>
@endpush

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Edit Appointment
            </div>
            <div class="card-block ">
                <form action="{{ route('dashboard.appointments.update', $appointment->id) }}" method="POST">
                    @csrf
                    @method('put')
                    @include('dashboard.layouts._error')



                    <div class="form-group">
                        <label for="name">Patient</label>
                        <select name="user_id" id="" class="form-control">
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}" @if ($appointment->user_id == $user->id)
                                selected
                            @endif>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Type</label>
                        <select name="type_id" id="" class="form-control">
                            @foreach ($types as $type)
                            <option value="{{ $type->id }}" @if ($appointment->type_id == $type->id)

                            @endif>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Appointment Date</label>
                        <input type="date" class="form-control" name="appointment_date" id="appointment_date"  value="{{ old('appointment_date', $appointment->appointment_date) }}" placeholder="">
                    </div>
                    <select name="appointment_time"  id="appointment_time"   class="form-control">
                        <option value="{{ $appointment->doctor_appointment->daily_appointment_id }}">{{ $appointment->appointment_time }}</option>
                    </select>
                    <div class="form-group">
                        <label for="password">Message</label>
                        <textarea name="user_message" id="user_message" cols="30" rows="2" class="form-control">{{ old('user_message', $appointment->user_message) }}</textarea>
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
