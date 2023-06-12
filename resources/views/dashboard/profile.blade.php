@extends('dashboard.layouts.site')
@section('title')
    Edit Profile
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Update Profile
            </div>
            <div class="card-block ">
                <form action="{{ route('dashboard.updateProfile') }}" method="POST">
                    @csrf
                    @method('post')
                    @include('dashboard.layouts._error')

                    <div class="form-group">
                        <label for="name">Role</label>
                        <label for="name">
                            {{ $user->roles->first()->name }}
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name"
                            value="{{ old('name', $user->name) }}" aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email"
                            value="{{ old('email', $user->email) }}" aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder=""
                            autocomplete="new-password">
                    </div>
                    <div class="form-group">
                        <label for="password_c">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_c"
                            autocomplete="new-password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info"><i class="fa fa-plus" aria-hidden="true"></i>
                            Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
