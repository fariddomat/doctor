@extends('dashboard.layouts.site')
@section('title')
    Create type
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Create New type
            </div>
            <div class="card-block ">
                <form action="{{ route('dashboard.types.store') }}" method="POST">
                    @csrf
                    @method('post')
                    @include('dashboard.layouts._error')


                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}"
                            aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="email">Description</label>
                        <textarea name="description" id="" cols="30" rows="5" class="form-control">
                            {{ old('description') }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="password">Price</label>
                        <input type="number" class="form-control" name="price" id="price"  value="{{ old('price') }}" placeholder="">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info"><i class="fa fa-plus" aria-hidden="true"></i>
                            Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
