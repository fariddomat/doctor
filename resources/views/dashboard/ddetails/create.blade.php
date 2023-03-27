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
                <i class="fa fa-align-justify"></i> Create New User
            </div>
            <div class="card-block ">
                @if ($doctors->count() == 0)
                    <h3>All Doctors have details, please back to index and edit if you want</h3>
                    <a href="{{ route('dashboard.users.index') }}" class="btn btn-outline-primary"><i class="fa fa-book"
                            aria-hidden="true"></i> Users</a>
                @else
                    <form action="{{ route('dashboard.ddetails.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        @include('dashboard.layouts._error')



                        <div class="form-group">
                            <label for="doctor">Doctor</label>
                            <select class="form-control" name="doctor_id" id="doctor_id">
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Spec</label>
                            <input type="text" class="form-control" name="spec" id="spec"
                                value="{{ old('spec') }}" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="name">Qout</label>
                            <input type="text" class="form-control" name="qout" id="qout"
                                value="{{ old('qout') }}" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group ">
                            <label for="name">Twitter</label>
                            <input type="text" class="form-control" name="twitter" id="twitter"
                                value="{{ old('twitter') }}" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group ">
                            <label for="name">Facebook</label>
                            <input type="text" class="form-control" name="facebook" id="facebook"
                                value="{{ old('facebook') }}" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group  ">
                            <label for="name">Instagram</label>
                            <input type="text" class="form-control" name="instagram" id="instagram"
                                value="{{ old('instagram') }}" aria-describedby="helpId" placeholder="">
                        </div>

                        <div class="form-group  ">
                            <label for="name">LinkedIn</label>
                            <input type="text" class="form-control" name="linkedIn" id="linkedIn"
                                value="{{ old('linkedIn') }}" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group ">
                            <label for="name">Whatsapp</label>
                            <input type="text" class="form-control" name="whatsapp" id="whatsapp"
                                value="{{ old('whatsapp') }}" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="name">Image</label>
                            <input type="file" class="form-control image" name="img" id="img"
                                aria-describedby="helpId" placeholder="">
                        </div>

                        <div class="form-group mb-3">
                            <img src="" style="width: 300px; display: none;" class="img-thumbnail image-preview"
                                alt="">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>
                                Create</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
