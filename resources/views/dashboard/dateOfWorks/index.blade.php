@extends('dashboard.layouts.site')
@section('title')
    Manage dateOfWorks
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
                                    <a href="{{ route('dashboard.dateOfWorks.create') }}" class="btn btn-outline-primary"><i
                                            class="fa fa-plus" aria-hidden="true"></i> Create</a>

                            </div>
                        </div>
                    </form>
                </div>


                <div class="col-lg-12" style="margin-top: 15px">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Date of works
                        </div>
                        <div class="card-block table-responsive">

                            @if ($dateOfWorks->count() > 0)
                                <table id="dataTable" class="table table-striped display responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Action</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dateOfWorks as $index => $dateOfWork)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $dateOfWork->start }}</td>
                                                <td>{{ $dateOfWork->end }}</td>
                                                <td>{{ $dateOfWork->from }}</td>
                                                <td>{{ $dateOfWork->to }}</td>

                                                <td>

                                                    <a href="{{ route('dashboard.dateOfWorks.edit', $dateOfWork->id) }}"
                                                        class="btn btn-outline-warning" style="display: inline-block"><i
                                                            class="fa fa-edit"></i> Edit</a>


                                                    <form action="{{ route('dashboard.dateOfWorks.destroy', $dateOfWork->id) }}"
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

                                <div class="text-center m-auto">{{ $dateOfWorks->appends(request()->query())->links() }}</div>
                            @else
                                <h3 style="font-weight: 400">Sorry no record found !</h3>
                            @endif
                        </div>
                    </div>
                </div>
@endsection
