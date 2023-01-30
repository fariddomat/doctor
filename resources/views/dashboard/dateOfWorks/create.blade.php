@extends('dashboard.layouts.site')
@section('title')
    Create dateOfWork
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Create New Date of works
            </div>
            <div class="card-block ">
                <form action="{{ route('dashboard.dateOfWorks.store') }}" method="POST">
                    @csrf
                    @method('post')
                    @include('dashboard.layouts._error')


                    <div class="form-group">
                        <label for="name">Start Date</label>
                        <input type="date" class="form-control" name="start" id="start" value="{{ old('start') }}"
                            aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="name">End Date</label>
                        <input type="date" class="form-control" name="end" id="end" value="{{ old('end') }}"
                            aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="name">From Hour</label>
                        <input type="time" class="form-control" name="from" id="from" value="{{ old('from') }}"
                            aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="name">To Hour</label>
                        <input type="time" class="form-control" name="to" id="to" value="{{ old('to') }}"
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
