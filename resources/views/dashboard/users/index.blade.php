@extends('dashboard.layouts.site')
@section('title')
    Manage Users
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
                                <div class="form-group">
                                    <select name="role_id" class="form-control">
                                        <option value="">role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                {{ request()->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"
                                        aria-hidden="true"></i>
                                    Search</button>
                                    <a href="{{ route('dashboard.users.create') }}" class="btn btn-outline-primary"><i
                                            class="fa fa-plus" aria-hidden="true"></i> Create</a>

                            </div>
                        </div>
                    </form>
                </div>


                <div class="col-lg-12" style="margin-top: 15px">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Users
                        </div>
                        <div class="card-block table-responsive">

                            @if ($users->count() > 0)
                                <table class="table table-striped ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $index => $user)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td style="display: inline-block">
                                                    @foreach ($user->roles as $role)
                                                        <span class="badge badge-primary">{{ $role->name }}</span>
                                                    @endforeach
                                                </td>
                                                <td>

                                                    <a href="{{ route('dashboard.users.edit', $user->id) }}"
                                                        class="btn btn-outline-warning" style="display: inline-block"><i
                                                            class="fa fa-edit"></i> Edit</a>


                                                    <form action="{{ route('dashboard.users.destroy', $user->id) }}"
                                                        method="POST" style="display: inline-block">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-outline-danger delete"
                                                            style="display: inline-block"><i class="fa fa-trash"
                                                                aria-hidden="true"></i> Delete</button>
                                                    </form>

                                                    @if ($user->status == 'active')
                                                        <form action="{{ route('dashboard.users.ban', $user->id) }}"
                                                            method="POST" style="display: inline-block">
                                                            @csrf
                                                            @method('post')
                                                            <button type="submit" class="btn btn-outline-info"
                                                                style="display: inline-block"><i class="fa fa-ban"
                                                                    aria-hidden="true"></i> Ban</button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('dashboard.users.unban', $user->id) }}"
                                                            method="POST" style="display: inline-block">
                                                            @csrf
                                                            @method('post')
                                                            <button type="submit" class="btn btn-outline-success"
                                                                style="display: inline-block"><i class="fa fa-ban"
                                                                    aria-hidden="true"></i> UnBan</button>
                                                        </form>
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
