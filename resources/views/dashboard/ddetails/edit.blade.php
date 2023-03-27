@extends('dashboard.layouts.site')
@section('title')
    Create Details
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Create New User
            </div>
            <div class="card-block ">
                <form action="{{ route('dashboard.ddetails.update' , $ddetail->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    @include('dashboard.layouts._error')



                    <div class="form-group">
                        <label for="doctor">Doctor : {{ $doctor->name }}</label>

                    </div>

                    <div class="form-group">
                        <label for="name">Spec</label>
                        <input type="text" class="form-control" name="spec" id="spec" value="{{ old('spec', $ddetail->spec) }}"
                            aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="name">Qout</label>
                        <input type="text" class="form-control" name="qout" id="qout" value="{{ old('qout', $ddetail->qout) }}"
                            aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group ">
                        <label for="name">Twitter</label>
                        <input type="text" class="form-control" name="twitter" id="twitter" value="{{ old('twitter', $ddetail->twitter) }}"
                            aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group ">
                        <label for="name">Facebook</label>
                        <input type="text" class="form-control" name="facebook" id="facebook" value="{{ old('facebook', $ddetail->facebook) }}"
                            aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group  ">
                        <label for="name">Instagram</label>
                        <input type="text" class="form-control" name="instagram" id="instagram" value="{{ old('instagram', $ddetail->instagram) }}"
                            aria-describedby="helpId" placeholder="">
                    </div>

                    <div class="form-group  ">
                        <label for="name">LinkedIn</label>
                        <input type="text" class="form-control" name="linkedIn" id="linkedIn" value="{{ old('linkedIn', $ddetail->linkedIn) }}"
                            aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group ">
                        <label for="name">Whatsapp</label>
                        <input type="text" class="form-control" name="whatsapp" id="whatsapp" value="{{ old('whatsapp', $ddetail->whatsapp) }}"
                            aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="name">Image</label>
                        <input type="file" class="form-control" name="img" id="img"
                            aria-describedby="helpId" placeholder="">
                            <img src="{{ asset('storage/images/'.$ddetail->img) }}" alt="">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i>
                            Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
