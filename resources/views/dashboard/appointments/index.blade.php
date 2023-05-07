@extends('dashboard.layouts.site')
@section('title')
    Manage appointments
@endsection
@section('styles')
    <style>
        td {
            min-width: 120px;
        }
    </style>
@endsection
@section('content')

    <div class="col-lg-12">
        <form action="">
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <select name="status" class="form-control" id="">
                            <option value="">Select Status</option>
                            <option value="pending" {{ request()->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="accept"  {{ request()->status == 'accept' ? 'selected' : '' }}>Accept</option>
                            <option value="done"  {{ request()->status == 'done' ? 'selected' : '' }}>Done</option>
                            <option value="reject"  {{ request()->status == 'reject' ? 'selected' : '' }}>Reject</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i>
                        Filter</button>
                    <a href="{{ route('dashboard.appointments.create') }}" class="btn btn-outline-primary"><i
                            class="fa fa-plus" aria-hidden="true"></i> Create</a>

                </div>
            </div>
        </form>
    </div>


    <div class="col-lg-12" style="margin-top: 15px">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Appointment
            </div>
            <div class="card-block table-responsive">

                @if ($appointments->count() > 0)
                    <table id="dataTable" class="table table-striped display responsive nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Doctor</th>
                                <th>Patient</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th class="none">Message</th>
                                <th class="none">Report</th>
                                <th class="none">Fee</th>
                                <th class="none">Action</th>
                                <th class="none">Status Log</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $index => $appointment)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $appointment->doctor_appointment->doctor->user->name }}</td>
                                    <td>{{ $appointment->patient->user->name }}</td>
                                    <td>{{ $appointment->type->name }}</td>
                                    <td>{{ $appointment->status }}</td>
                                    <td>{{ $appointment->appointment_date }}</td>
                                    <td>{{ $appointment->appointment_time }}</td>
                                    <td>{{ $appointment->user_message }}</td>
                                    <td>
                                        @if ($appointment->treatment)
                                            {{ $appointment->treatment->report }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($appointment->treatment)
                                            {{ $appointment->treatment->fee }}
                                            @if ($appointment->treatment->Paid == 1)
                                                <span class="text-success">( Paid )</span>
                                            @else
                                                <span class="text-warning">( Not Paid )</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if ($appointment->status == 'pending')
                                        <a href="{{ route('dashboard.appointments.status', ['id'=>$appointment->id, 'status'=>'accept']) }}"
                                            class="btn btn-sm btn-outline-success" style="display: inline-block"><i
                                                class="fa fa-check"></i> Accept</a>

                                                <a href="{{ route('dashboard.appointments.status', ['id'=>$appointment->id, 'status'=>'reject']) }}"
                                                    class="btn btn-sm btn-outline-danger" style="display: inline-block"><i
                                                        class="fa fa-ban"></i> Reject</a>

                                        @endif

                                        <a href="{{ route('dashboard.appointments.show', $appointment->id) }}"
                                            class="btn btn-sm btn-outline-primary" style="display: inline-block"><i
                                                class="fa fa-book"></i> Report</a>

                                        @if ($appointment->status != 'cancel' && $appointment->status != 'reject' && $appointment->status != 'done')

                                        <a href="{{ route('dashboard.appointments.edit', $appointment->id) }}"
                                            class="btn btn-sm btn-outline-warning" style="display: inline-block"><i
                                                class="fa fa-edit"></i> Edit</a>


                                        <form action="{{ route('dashboard.appointments.destroy', $appointment->id) }}"
                                            method="POST" style="display: inline-block">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-outline-danger delete"
                                                style="display: inline-block"><i class="fa fa-trash" aria-hidden="true"></i>
                                                Cancel</button>
                                        </form>
                                        @endif

                                        @if ($appointment->treatment)
                                            @if (!$appointment->treatment->Paid)
                                                <a href="{{ route('dashboard.paymentlog.create', ['id' => $appointment->id]) }}"
                                                    class="btn btn-sm btn-outline-primary"> $ Pay</a>
                                            @endif
                                        @endif

                                    </td>
                                    <td>
                                        <table class="mt-3">
                                            @foreach ($appointment->statuses->reverse() as $status)
                                            <tr>

                                            <td>

                                                <h5 class="mt-1">{{ $status->status }} </h5>
                                            </td>
                                            <td>
                                                <span class="text-primary bold">  {{ $status->created_at->diffForHumans() }}</span>
                                            </td>
                                            </tr>
                                            @endforeach
                                        </table>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="text-center m-auto">{{ $appointments->appends(request()->query())->links() }}</div>
                @else
                    <h3 style="font-weight: 400">Sorry no record found !</h3>
                @endif
            </div>
        </div>
    </div>
@endsection
