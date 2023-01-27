@extends('dashboard.layouts.site')
@section('title')
    Edit type
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Edit type
            </div>
            <div class="card-block ">
                <form action="{{ route('dashboard.types.update', $type->id) }}" method="POST">
                    @csrf
                    @method('put')
                    @include('dashboard.layouts._error')


                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $type->name) }}"
                            aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="email">Description</label>
                        <textarea name="description" id="" cols="30" rows="5" class="form-control">
                            {{ old('description', $type->description) }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="password">Price</label>
                        <input type="number" class="form-control" name="price" id="price"  value="{{ old('price', $type->price) }}" placeholder="">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>
                            Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
