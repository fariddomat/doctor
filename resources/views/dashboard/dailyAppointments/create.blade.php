@extends('dashboard.layouts.site')
@section('title')
     Daily Appointment
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Manage Daily Appointment For << {{ $dayOfWork->day }} >>
            </div>
            <div class="card-block ">
                <form action="{{ route('dashboard.dailyAppointments.store', ['id'=>$dayOfWork->id]) }}" method="POST">
                    @csrf
                    @method('post')
                    @include('dashboard.layouts._error')


                    <div class="form-group">
                        <label for="name">From</label>
                        <input type="time" class="form-control" name="from" id="from" value="{{ old('from') }}"
                            aria-describedby="helpId" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="time">To</label>
                        <input type="time" class="form-control" name="to" id="to" value="{{ old('to') }}"
                            aria-describedby="helpId" placeholder="">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>
                            Create</button>
                    </div>
                </form>
            </div>
            <div class="card-block table-responsive">

                @if ($dailyAppointment->count() > 0)
                    <table id="dataTable" class="table table-striped display responsive nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Time</th>
                                <th>Action</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dailyAppointment as $index => $dayOfWork)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $dayOfWork->time }}</td>

                                    <td>

                                        <form action="{{ route('dashboard.dailyAppointments.destroy', $dayOfWork->id) }}"
                                            method="POST" style="display: inline-block">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger delete"
                                                style="display: inline-block"><i class="fa fa-trash"
                                                    aria-hidden="true"></i> Delete</button>
                                        </form>



                                    </td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                @else
                    <h3 style="font-weight: 400">Sorry no record found !</h3>
                @endif
            </div>
        </div>
    </div>
@endsection
