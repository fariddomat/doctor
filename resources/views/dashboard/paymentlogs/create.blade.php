@extends('dashboard.layouts.site')
@section('title')
    Create New Payment
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Create New Payment
            </div>
            <div class="card-block ">
                <form action="{{ route('dashboard.paymentlog.store', ['id'=> $appointment->id]) }}" method="POST">
                    @csrf
                    @method('post')
                    @include('dashboard.layouts._error')

                    <div class="form-group">
                        <label for="name">Patient Name : </label>
                        <label for="name">{{ $appointment->patient->user->name }}</label>
                    </div>

                    <div class="form-group">
                        <label for="name">Total Fee : </label>
                        <label for="name">{{ $appointment->treatment->fee }}</label>
                    </div>
                    <div class="form-group">
                        <label for="name">Un Paid Fee : </label>
                        <label for="name"><span class="text-warning">{{ $appointment->treatment->unpaid_amount }}</span></label>
                    </div>

                    <div class="form-group">
                        <label for="name">Amount</label>
                        <input type="number" class="form-control" name="amount" id="amount" value="{{ old('amount') }}"
                            aria-describedby="helpId" placeholder="">
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
