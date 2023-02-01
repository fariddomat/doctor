@extends('dashboard.layouts.site')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i>Webiste Images
            </div>
            <div class="card-block ">

                <form action="{{ route('dashboard.updateImages') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    @include('dashboard.layouts._error')

                    <div class="row">


                        <div class="col-md-4">
                            <label>Icon Image</label>
                            <input type="file" name="icon" class="form-control-file">
                            <img src="{{ asset('home/images/icon.jpg') }}" style=" margin-top: 10px; max-width: 250px;"
                                alt="">
                        </div>
                        <div class="col-md-4">
                            <label>Cover Image</label>
                            <input type="file" name="cover" class="form-control-file">
                            <img src="{{ asset('home/images/cover.jpg') }}" style=" margin-top: 10px; max-width: 250px;"
                                alt="">
                        </div>
                        <div class="col-md-4">
                            <label>Doctor</label>
                            <input type="file" name="doctor" class="form-control-file">
                            <img src="{{ asset('home/images/doctor.jpg') }}" style=" margin-top: 10px;max-width: 250px;"
                                alt="">
                        </div>


                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update <i class="fa fa-save" aria-hidden="true"></i>
                            </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
