@extends('dashboard.layouts.site')
@section('title')
    Manage Users
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
                    @if (Auth::user()->hasRole('admin'))
                        <a href="{{ route('dashboard.users.create') }}" class="btn btn-info"><i
                                class="fa fa-plus" aria-hidden="true"></i> Create</a>
                    @endif

                </div>
            </div>
        </form>
    </div>


    <div class="col-lg-12" style="margin-top: 15px">
        <div class="card  my-4">
            <div class="card-header  p-0 position-relative mt-n4 mx-3 z-index-2 mt-2">
                <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Patients</h6>
                </div>
            </div>
            <div class="card-block table-responsive">

                @if ($users->count() > 0)
                    <table id="dataTable" class="table table-striped display responsive nowrap">
                        <thead>
                            <tr>
                                <th class="">#</th>
                                <th class="all">Name</th>
                                <th class="none">Email</th>
                                <th class="all">Appointments</th>
                                <th class="none">Age</th>
                                <th class="none">Address</th>
                                <th class="none">Details</th>

                                <th class="none">Rank</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if (Auth::user()->hasRole('doctor'))
                                            @if ($user->patient)
                                                {{ $user->patient->appointments()->withTrashed()->whenUser(Auth::id())->count() }}
                                            @endif
                                        @else
                                            @if ($user->patient)
                                                {{ $user->patient->appointments->count() }}
                                            @endif
                                        @endif

                                    </td>
                                    <td>{{ $user->patient->age }}</td>
                                    <td>{{ $user->patient->address }}</td>
                                    <td>{{ $user->patient->details }}</td>
                                    <td>
                                        <form action="{{ route('dashboard.patients.rank', $user->patient->id) }}"
                                            method="post">
                                            @csrf
                                            <br>score : <br><input name="rank" class="form-control" type="number"
                                                min="1" max="5"
                                                value="{{ old('rank', $user->patient->rank) }}"><br>
                                            rank Details
                                            <textarea name="rank_details" class="form-control" id="" cols="" rows="">{{ old('rank', $user->patient->rank_details) }}</textarea>
                                            <br>
                                            @if (Auth::user()->hasRole('secr'))
                                                <button type="submit" class="btn btn-sm btn-info">Rank</button>
                                            @endif
                                        </form>

                                    </td>
                                    <td>

                                        <a href="{{ route('dashboard.patients.show', $user->patient->id) }}"
                                            class="btn btn-success" style="display: inline-block"><i
                                                class="fa fa-book"></i> Show</a>


                                        @if (Auth::user()->hasRole(['admin', 'secr']))
                                            @if ($user->status == 'active')
                                                <form action="{{ route('dashboard.users.ban', $user->id) }}" method="POST"
                                                    style="display: inline-block">
                                                    @csrf
                                                    @method('post')
                                                    <button type="submit" class="btn btn-info ban"
                                                        style="display: inline-block"><i class="fa fa-ban"
                                                            aria-hidden="true"></i> Ban</button>
                                                </form>
                                            @else
                                                <form action="{{ route('dashboard.users.unban', $user->id) }}"
                                                    method="POST" style="display: inline-block">
                                                    @csrf
                                                    @method('post')
                                                    <button type="submit" class="btn btn-success unBan"
                                                        style="display: inline-block"><i class="fa fa-ban"
                                                            aria-hidden="true"></i> UnBan</button>
                                                </form>
                                            @endif
                                        @endif


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="text-center m-auto">{{ $users->appends(request()->query())->links() }}</div>
                @else
                    <h3 style="font-weight: 400">Sorry no record found !</h3>
                @endif
            </div>
        </div>
    </div>
@endsection
