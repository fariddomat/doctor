@extends('dashboard.layouts.site')
@section('title')
    Create User
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Create New User
            </div>
            <div class="card-block ">
                <form action="{{ route('dashboard.users.store') }}" method="POST">
                    @csrf
                    @method('post')
                    @include('dashboard.layouts._error')


                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}"
                            aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}"
                            aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="password_c">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_c"
                            placeholder="">
                    </div>
                    {{-- Roles --}}
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" name="role_id" id="role_id">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        {{-- <a href="{{ route('dashboard.roles.create') }}">Create new Role</a> --}}
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info"><i class="fa fa-plus" aria-hidden="true"></i>
                            Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
