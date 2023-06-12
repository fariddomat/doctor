@extends('dashboard.layouts.site')

@push('scripts')
<script src="{{asset('dashboard/js/about_image_preview.js')}}"></script>
@endpush
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
                            <input type="file" name="image[]" class="form-control-file image{{ $i }}">
                            <img src="{{ asset('home/images/gallery/image_'.$i.'.jpg') }}" style=" margin-top: 10px; max-width: 250px;height: 20vh;"class="img-thumbnail image{{ $i }}-preview "
                                alt="" >
                        </div>
                        @endfor

                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info">Update <i class="fa fa-save" aria-hidden="true"></i>
                            </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
