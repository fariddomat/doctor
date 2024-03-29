@extends('dashboard.layouts.site')
@section('title')
    Make Report
@endsection
@section('content')
<div class="row">

    <div class="col-lg-6">
        <div class="card ">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Report Appointment
            </div>
            <div class="card-block ">
                <div class="form-group row">
                    <label for="name" class="col-md-4">Patient : </label>
                    <label for="name" class="col-md-4">{{ $appointment->patient->user->name }}</label>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-4">Patient Rank: </label>
                    <label for="name" class="col-md-4">{{ $appointment->patient->rank }}
                        @if ($appointment->patient->rank_details)
                            - {{ $appointment->patient->rank_details }}
                        @endif
                    </label>
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

                <hr>

                <div class="form-group row">
                    <label for="" class="col-md-4">Age</label>
                    <label for="" class="col-md-4">{{ $appointment->patient->age }}</label>
                </div>

                <div class="form-group row">
                    <label for="" class="col-md-4">Address</label>
                    <label for="" class="col-md-4">{{ $appointment->patient->address }}</label>
                </div>

                <div class="form-group row">
                    <label for="" class="col-md-4">Details</label>
                    <label for="" class="col-md-4">{{ $appointment->patient->details }}</label>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card ">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Docotr Report
            </div>
            <div class="card-block ">
                <form action="{{ route('dashboard.treatments.store', ['appointment_id' => $appointment->id]) }}"
                    method="POST">
                    @csrf
                    @method('post')
                    @include('dashboard.layouts._error')



                    <div class="form-group ">
                        <label for="name">Report </label>
                        <textarea name="report" id="" cols="30" rows="5" class="form-control">
                            @if ($appointment->treatment)
                        {{ old('report', $appointment->treatment->report) }}
                        @else
                        {{ old('report') }}
                        @endif
                        </textarea>
                    </div>
                    @if ($appointment->treatment)
                        <div class="form-group ">
                            <label for="name">Fee
                                @if ($appointment->treatment)
                                    @if ($appointment->treatment->Paid == 1)
                                        <span class="text-success">( Paid )</span>
                                    @endif
                                @endif
                            </label>
                            <input type="number" name="fee" value="{{ $appointment->treatment->fee }}" id=""
                                class="form-control">
                        </div>
                    @else
                        <div class="form-group ">
                            <label for="name">Fee
                            </label>
                            <input type="number" min="{{ $appointment->type->price }}" name="fee"
                                value="{{ old('fee', $appointment->type->price) }}" id="" class="form-control">
                        </div>
                    @endif


                    @if (!$appointment->treatment)
                        <div class="form-group ">
                            <label for="name">Paid Fee amount</label>
                            <input type="number" name="amount" id="" class="form-control">
                        </div>
                    @endif
                    <div class="form-group ">
                        <label for="name">Note (optional)</label>
                        <textarea name="note" id="" class="form-control"> @if ($appointment->treatment)
                        {{ old('note', $appointment->treatment->note) }}
                        @else
                        {{ old('note') }}
                        @endif
                        </textarea>
                    </div>
                    @if (!$appointment->treatment)
                        @if (Auth::user()->hasRole('doctor'))
                            @if ($appointment->status == 'accept')
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info"><i class="fa fa-plus"
                                            aria-hidden="true"></i>
                                        Save</button>
                                </div>
                            @else
                                Appointment {{ $appointment->status }}
                            @endif
                        @endif
                    @endif

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
