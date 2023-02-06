@extends('dashboard.layouts.site')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Services
            </div>
            <div class="card-block ">
                <form action="{{ route('dashboard.settings') }}" method="POST">
                    @csrf
                    @method('post')
                    @include('dashboard.layouts._error')

                    <div class="row pr-2 pl-2">

                        @for ($i = 1; $i <= 6; $i++)
                            <div class="form-group col-md-6">
                                <label for="service_{{ $i }}" class="text-capitalize"> Service {{ $i }}
                                </label>
                                <div class="row">
                                    <label for="" class="col-md-2">Icon</label>
                                    <div class=" col-md-10 ">
                                        <input type="text" class="form-control" name="service_icon_{{ $i }}"
                                            id="" value="{{ setting('service_icon_' . $i) }}" aria-describedby="helpId"
                                            placeholder="">
                                    </div>
                                </div>

                                <div class="row">
                                    <label for="" class="col-md-2">Title</label>
                                    <div class=" col-md-10 ">
                                        <input type="text" class="form-control" name="service_title_{{ $i }}"
                                            id="" value="{{ setting('service_title_' . $i) }}" aria-describedby="helpId"
                                            placeholder="">
                                    </div>
                                </div>


                                <div class="row">
                                    <label for="" class="col-md-2">Content</label>
                                    <div class=" col-md-10 ">
                                        <input type="text" class="form-control" name="service_content_{{ $i }}"
                                            id="" value="{{ setting('service_content_' . $i) }}" aria-describedby="helpId"
                                            placeholder="">
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                    {{-- client id --}}


                    <div class="form-group mr-2">
                        <button type="submit" class="btn btn-primary">Save <i class="fa fa-plus"
                                aria-hidden="true"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
