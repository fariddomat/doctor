@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 m-x-auto pull-xs-none vamiddle">
            <div class="card-group ">
                <div class="card p-a-2">
                    <div class="card-block">

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <h1>Login</h1>
                            <div class="input-group m-b-1">
                                <span class="input-group-addon"><i class="icon-user"></i>
                                </span>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control en" placeholder="Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group m-b-2">
                                <span class="input-group-addon"><i class="icon-lock"></i>
                                </span>
                                <input type="password" name="password" class="form-control en" placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <button type="submit" class="btn btn-primary p-x-2">
                                        <i class="icon-login"></i>
                                        Login</button>
                                </div>

                            </div><div class="row">
                                <div class="col-xs-6"> do not have account?
                                    <a href="{{ route('register') }}" class="btn btn-primary p-x-2">
                                        <i class="icon-login"></i>
                                        Register</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card card-inverse card-primary p-y-3" style="width:44%">
                    <div class="card-block text-xs-center">
                        <div>
                            <h2>Doctor</h2>
                            <p>Login to dashboard</p>
                            <a href="{{ route('home') }}" class="btn btn-primary active m-t-1"> Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
