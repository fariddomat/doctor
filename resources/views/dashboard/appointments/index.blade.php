@extends('dashboard.layouts.site')
@section('title')
    Manage appointments
@endsection
@section('styles')
<style>
    td{
        min-width: 120px;
    }
</style>

@endsection
@section('content')

                <div class="col-lg-12" >
                    <form action="">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="search" id="search" autofocus
                                        value="{{ request()->search }}" aria-describedby="helpId" placeholder="search">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"
                                        aria-hidden="true"></i>
                                    Search</button>
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
                                            <th>Patient</th>
                                            <th>Type</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Report</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($appointments as $index => $appointment)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $appointment->user->name }}</td>
                                                <td>{{ $appointment->type->name }}</td>
                                                <td>{{ $appointment->appointment_date }}</td>
                                                <td>{{ $appointment->appointment_time }}</td>
                                                <td>{{ $appointment->docotr_report }}</td>
                                                <td>{{ $appointment->price }}</td>
                                                <td>

                                                    <a href="{{ route('dashboard.appointments.show', $appointment->id) }}"
                                                        class="btn btn-sm btn-outline-success" style="display: inline-block"><i
                                                            class="fa fa-book"></i> Report</a>

                                                    <a href="{{ route('dashboard.appointments.edit', $appointment->id) }}"
                                                        class="btn btn-sm btn-outline-warning" style="display: inline-block"><i
                                                            class="fa fa-edit"></i> Edit</a>


                                                    <form action="{{ route('dashboard.appointments.destroy', $appointment->id) }}"
                                                        method="POST" style="display: inline-block">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger delete"
                                                            style="display: inline-block"><i class="fa fa-trash"
                                                                aria-hidden="true"></i> Delete</button>
                                                    </form>



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
