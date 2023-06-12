@extends('dashboard.layouts.site')
@section('title')
   Log
@endsection
@section('content')


                <div class="col-lg-12" style="margin-top: 15px">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Log
                        </div>
                        <div class="card-block table-responsive">

                            @if ($logs->count() > 0)
                                <table id="dataTable" class="table table-striped display responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Type</th>
                                            <th>User</th>
                                            <th>Log</th>
                                            <th>date</th>
                                            <th>Action</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($logs as $index => $log)
                                            <tr>
                                                <td>{{ $index+1 }}</td>
                                                <td class="bg-{{ $log->type }}">{{ $log->type }}</td>
                                                <td>{{ $log->user->name }}</td>
                                                <td>{{ $log->log }}</td>
                                                <td>{{ $log->created_at->diffForHumans() }}</td>
                                                <td>
                                                    @if ($log->url)

                                                    <a href="{{ $log->url }}"
                                                        class="btn btn-warning" style="display: inline-block"><i
                                                            class="fa fa-edit"></i> Show</a>

                                                    @endif

                                                </td>


                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="text-center m-auto">{{ $logs->links() }}</div>
                            @else
                                <h3 style="font-weight: 400">Sorry no record found !</h3>
                            @endif
                        </div>
                    </div>
                </div>
@endsection
