@extends('dashboard.layouts.site')
@section('title')
    Create Details
@endsection

@push('scripts')
<script src="{{asset('dashboard/js/image_preview.js')}}"></script>
@endpush
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Edit Doctor Info
            </div>
            <div class="card-block ">
                <form action="{{ route('dashboard.doctors.update' , $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    @include('dashboard.layouts._error')



                    <div class="form-group">
                        <label for="doctor">Doctor : {{ $doctor->user->name }}</label>

                    </div>

                    <div class="form-group">
                        <label for="name">Spec</label>
                        <input type="text" class="form-control" name="spec" id="spec" value="{{ old('spec', $doctor->spec) }}"
                            aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="name">Qout</label>
                        <input type="text" class="form-control" name="qout" id="qout" value="{{ old('qout', $doctor->qout) }}"
                            aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group ">
                        <label for="name">Twitter</label>
                        <input type="text" class="form-control" name="twitter" id="twitter" value="{{ old('twitter', $doctor->twitter) }}"
                            aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group ">
                        <label for="name">Facebook</label>
                        <input type="text" class="form-control" name="facebook" id="facebook" value="{{ old('facebook', $doctor->facebook) }}"
                            aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group  ">
                        <label for="name">Instagram</label>
                        <input type="text" class="form-control" name="instagram" id="instagram" value="{{ old('instagram', $doctor->instagram) }}"
                            aria-describedby="helpId" placeholder="">
                    </div>

                    <div class="form-group  ">
                        <label for="name">LinkedIn</label>
                        <input type="text" class="form-control" name="linkedIn" id="linkedIn" value="{{ old('linkedIn', $doctor->linkedIn) }}"
                            aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group ">
                        <label for="name">Whatsapp</label>
                        <input type="text" class="form-control" name="whatsapp" id="whatsapp" value="{{ old('whatsapp', $doctor->whatsapp) }}"
                            aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="name">Image</label>
                        <input type="file" class="form-control image" name="img" id="img"
                            aria-describedby="helpId" placeholder="">
                            {{-- <img src="" alt=""> --}}
                    </div>

                    <div class="form-group mb-3">
                        <img src="{{ asset('storage/images/'.$doctor->img) }}" style="width: 300px;" class="img-thumbnail image-preview"
                            alt="">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info"><i class="fa fa-edit" aria-hidden="true"></i>
                            Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
