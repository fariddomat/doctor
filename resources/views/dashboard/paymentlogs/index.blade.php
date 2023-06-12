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
                    <button type="submit" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i>
                        Search</button>
                </div>
            </div>
        </form>
    </div>


    <div class="col-lg-12" style="margin-top: 15px">
        <div class="card  my-4">
            <div class="card-header  p-0 position-relative mt-n4 mx-3 z-index-2 mt-2">
                <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Payment Log</h6>
                </div>
            </div>
            <div class="card-block table-responsive">

                @if ($paymentlogs->count() > 0)
                    <table id="dataTable" class="table table-striped display responsive nowrap">
                        <thead>
                            <tr>
                                <th class="all">#</th>
                                <th class="all">Doctor</th>
                                <th class="all">Patient</th>
                                <th>Totalt Fee</th>
                                <th>Paid Fee</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paymentlogs as $index => $paymentlog)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $paymentlog->treatment->appointment->doctor_appointment->doctor->user->name }}</td>
                                    <td>{{ $paymentlog->treatment->appointment->patient->user->name }}</td>
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
