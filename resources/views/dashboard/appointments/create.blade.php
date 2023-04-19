@extends('dashboard.layouts.site')
@section('title')
    Create type
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
                        <label for="name">Date</label>
                        <input type="date" id="appointment_date" name="appointment_date" class="form-control datepicker" id="date"
                            placeholder="Appointment Date" data-rule="minlen:4"
                            data-msg="Please enter at least 4 chars">
                        <div class="validate"></div>
                    </div>

                    <div class="form-group">
                        <label for="name">Time</label>
                        <select name="appointment_time"  id="appointment_time"   class="form-control">
                            <option value="">Please select date</option>
                        </select>
                        <div class="validate"></div>
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
