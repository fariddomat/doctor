@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-5 m-x-auto pull-xs-none vamiddle">
        <div class="card">

            <form method="POST" action="{{ route('register') }}">
                @csrf

            <div class="card-block p-a-2">
                <h1>Register New User</h1>
                <div class="input-group m-b-1">
                    <span class="input-group-addon"><i class="icon-user"></i>
                    </span>
                    <input type="text" name="name" class="form-control" placeholder="Username">

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="input-group m-b-1">
                    <span class="input-group-addon">@</span>
                    <input type="email" name="email" class="form-control en" placeholder="Email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="input-group m-b-1">
                    <span class="input-group-addon"><i class="icon-lock"></i>
                    </span>
                    <input type="password" name="password" class="form-control en" placeholder="Password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="input-group m-b-2">
                    <span class="input-group-addon"><i class="icon-lock"></i>
                    </span>
                    <input type="password" name="password_confirmation" class="form-control en" placeholder="Confirm Password">
                </div>
                <button type="submit" class="btn btn-block btn-success">
                    <i class="icon-user-follow"></i>
                    Register</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
