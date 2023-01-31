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
                            <label>Image 1</label>
                            <input type="file" name="cover1" class="form-control-file">
                            <img src="{{ asset('home/images/1.jpg') }}" style=" margin-top: 10px; max-width: 250px;"
                                alt="">
                        </div>
                        <div class="col-md-4">
                            <label>Image 2</label>
                            <input type="file" name="cover2" class="form-control-file">
                            <img src="{{ asset('home/images/2.jpg') }}" style=" margin-top: 10px; max-width: 250px;"
                                alt="">
                        </div>
                        <div class="col-md-4">
                            <label>Image 3</label>
                            <input type="file" name="cover3" class="form-control-file">
                            <img src="{{ asset('home/images/3.jpg') }}" style=" margin-top: 10px;max-width: 250px;"
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
