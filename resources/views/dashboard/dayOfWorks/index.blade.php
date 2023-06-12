@extends('dashboard.layouts.site')
@section('title')
    Manage dayOfWorks
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
                                <button type="submit" class="btn btn-info"><i class="fa fa-search"
                                        aria-hidden="true"></i>
                                    Search</button>
                                    <a href="{{ route('dashboard.dayOfWorks.create') }}" class="btn btn-info"><i
                                            class="fa fa-plus" aria-hidden="true"></i> Create</a>

                            </div>
                        </div>
                    </form>
                </div>


                <div class="col-lg-12" style="margin-top: 15px">
                    <div class="card  my-4">
                        <div class="card-header  p-0 position-relative mt-n4 mx-3 z-index-2 mt-2">
                            <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Day Of Works</h6>
                            </div>
                        </div>
                        <div class="card-block table-responsive">

                            @if ($dayOfWorks->count() > 0)
                                <table id="dataTable" class="table table-striped display responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="all">Day</th>
                                            <th class="">Time</th>
                                            <th class="">Action</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dayOfWorks as $index => $dayOfWork)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $dayOfWork->day }}</td>
                                                <td>

                                                    <a href="{{ route('dashboard.dailyAppointments.create', ['id'=>$dayOfWork->id]) }}"
                                                        class="btn btn-info" style="display: inline-block"><i
                                                            class="fa fa-clock"></i> Set</a>

                                                </td>
                                                <td>

                                                    <a href="{{ route('dashboard.dayOfWorks.edit', $dayOfWork->id) }}"
                                                        class="btn btn-warning" style="display: inline-block"><i
                                                            class="fa fa-edit"></i> Edit</a>


                                                    <form action="{{ route('dashboard.dayOfWorks.destroy', $dayOfWork->id) }}"
                                                        method="POST" style="display: inline-block">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger delete"
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
