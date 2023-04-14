@extends('dashboard.layouts.site')
@section('title')
    Create dateOfWork
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Create New Day of works
            </div>
            <div class="card-block ">
                <form action="{{ route('dashboard.dayOfWorks.store') }}" method="POST">
                    @csrf
                    @method('post')
                    @include('dashboard.layouts._error')


                    <div class="form-group">
                        <label for="name">Day</label>
                        <input type="text" class="form-control" name="day" id="day" value="{{ old('day') }}"
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
