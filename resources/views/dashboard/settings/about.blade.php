@extends('dashboard.layouts.site')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> About Website
            </div>
            <div class="card-block ">
                <form action="{{ route('dashboard.settings') }}" method="POST">
                    @csrf
                    @method('post')
                    @include('dashboard.layouts._error')

                    <div class="row pr-2 pl-2">
                        <div class="col-md-6">
                            {{-- Site Name --}}
                            <div class="form-group">
                                <label for="site_name" class="text-capitalize">Website Name</label>
                                <input type="text" class="form-control" name="site_name" id="site_name"
                                    value="{{ setting('site_name') }}" aria-describedby="helpId" placeholder="">
                            </div>
                            {{-- Site title --}}
                            <div class="form-group">
                                <label for="site_title" class="text-capitalize">title</label>
                                <input type="text" class="form-control" name="site_title" id="site_title"
                                    value="{{ setting('site_title') }}" aria-describedby="helpId" placeholder="">
                            </div>
                            {{-- Site about --}}
                            <div class="form-group">
                                <label for="site_about" class="text-capitalize">About</label>
                                <textarea name="site_about" class="form-control" id="" cols="30" rows="10">
                                        {{ setting('site_about') }}
                                    </textarea>
                            </div>

                            <div class="form-group">
                                <label for="site_about_doctor" class="text-capitalize">About Doctor</label>
                                <textarea name="site_about_doctor" class="form-control" id="" cols="30" rows="10">
                                        {{ setting('site_about_doctor') }}
                                    </textarea>
                            </div>

                        </div>
                        <div class="col-md-6">


                            {{-- Site Email --}}
                            <div class="form-group">
                                <label for="site_email" class="text-capitalize">Email</label>
                                <input type="email" class="form-control" name="site_email" id="site_email"
                                    value="{{ setting('site_email') }}" aria-describedby="helpId" placeholder="">
                            </div>
                            {{-- Site Phone --}}
                            <div class="form-group">
                                <label for="site_phone" class="text-capitalize">Phone</label>
                                <input type="text" class="form-control" name="site_phone" id="site_phone"
                                    value="{{ setting('site_phone') }}" aria-describedby="helpId" placeholder="">
                            </div>
                            {{-- Site location --}}
                            <div class="form-group">
                                <label for="site_location" class="text-capitalize">Location</label>
                                <textarea name="site_location" class="form-control" id="" cols="30" rows="10">
                                    {{ setting('site_location') }}
                                </textarea>
                            </div>

                            <div class="form-group">
                                <label for="site_why_choose" class="text-capitalize">Why choose us?</label>
                                <textarea name="site_why_choose" class="form-control" id="" cols="30" rows="10">
                                        {{ setting('site_why_choose') }}
                                    </textarea>
                            </div>
                        </div>
                    </div>


                    <div class="form-group mr-2">
                        <button type="submit" class="btn btn-primary">Save <i class="fa fa-plus"
                                aria-hidden="true"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Striped rows end -->
@endsection
