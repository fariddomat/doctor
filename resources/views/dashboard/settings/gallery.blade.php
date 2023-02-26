@extends('dashboard.layouts.site')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i>Webiste Images
            </div>
            <div class="card-block ">

                <form action="{{ route('dashboard.updateGallery') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    @include('dashboard.layouts._error')

                    <div class="row">

                        @for ($i=1; $i<=8 ; $i++)

                        <div class="col-md-3">
                            <label>Image {{ $i }}</label>
                            <input type="file" name="image[]" class="form-control-file">
                            <img src="{{ asset('home/images/gallery/image_'.$i.'.jpg') }}" style=" margin-top: 10px; max-width: 250px;"
                                alt="">
                        </div>
                        @endfor

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
