@extends('dashboard.layouts.site')
@section('title')
    Edit dateOfWork
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Edit Date of works
            </div>
            <div class="card-block ">
                <form action="{{ route('dashboard.dateOfWorks.update', $dateOfWork->id) }}" method="POST">
                    @csrf
                    @method('put')
                    @include('dashboard.layouts._error')

                    <div class="form-group">
                        <label for="name">Doctor</label>
                        <select name="doctor_id" id="" class="form-control">
                            @foreach ($doctors as $doctor)
                            <option value="{{ $doctor->id }}" @if ($doctor->id == $dateOfWork->doctor_id)
                                selected
                            @endif>{{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Start Date</label>
                        <input type="date" class="form-control" name="start" id="start" value="{{ old('start',$dateOfWork->start) }}"
                            aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="name">End Date</label>
                        <input type="date" class="form-control" name="end" id="end" value="{{ old('end', $dateOfWork->end) }}"
                            aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="name">From Hour</label>
                        <input type="time" class="form-control" name="from" id="from" value="{{ old('from', $dateOfWork->from) }}"
                            aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="name">To Hour</label>
                        <input type="time" class="form-control" name="to" id="to" value="{{ old('to', $dateOfWork->to) }}"
                            aria-describedby="helpId" placeholder="">
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
