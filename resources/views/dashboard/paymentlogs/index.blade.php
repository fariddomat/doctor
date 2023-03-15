@extends('dashboard.layouts.site')
@section('title')
    Manage Payment
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
                        <input type="text" class="form-control" name="search" id="search" autofocus
                            value="{{ request()->search }}" aria-describedby="helpId" placeholder="search">
                    </div>
                </div>

                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i>
                        Search</button>
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

                @if ($paymentlogs->count() > 0)
                    <table id="dataTable" class="table table-striped display responsive nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Doctor</th>
                                <th>Patient</th>
                                <th>Totalt Fee</th>
                                <th>Paid Fee</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paymentlogs as $index => $paymentlog)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $paymentlog->treatment->appointment->doctor->name }}</td>
                                    <td>{{ $paymentlog->treatment->appointment->user->name }}</td>
                                    <td>{{ $paymentlog->treatment->fee }}</td>
                                    <td>{{ $paymentlog->amount }}</td>
                                    <td>{{ $paymentlog->created_at->diffForHumans() }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="text-center m-auto">{{ $paymentlogs->appends(request()->query())->links() }}</div>
                @else
                    <h3 style="font-weight: 400">Sorry no record found !</h3>
                @endif
            </div>
        </div>
    </div>
@endsection
