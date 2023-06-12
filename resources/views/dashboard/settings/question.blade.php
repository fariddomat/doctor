@extends('dashboard.layouts.site')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Frequently Asked Questions
            </div>
            <div class="card-block ">
                <form action="{{ route('dashboard.settings') }}" method="POST">
                    @csrf
                    @method('post')
                    @include('dashboard.layouts._error')

                    <div class="row pr-2 pl-2">

                        @for ($i = 1; $i <= 5; $i++)
                            <div class="form-group col-md-6">
                                <label for="question{{ $i }}" class="text-capitalize"> {{ $i }}
                                </label>

                                <div class="row">
                                    <label for="" class="col-md-2">Question?</label>
                                    <div class=" col-md-10 ">
                                        <input type="text" class="form-control" name="question_{{ $i }}"
                                            id="" value="{{ setting('question_' . $i) }}" aria-describedby="helpId"
                                            placeholder="">
                                    </div>
                                </div>


                                <div class="row">
                                    <label for="" class="col-md-2">Answer</label>
                                    <div class=" col-md-10 ">
                                        <textarea name="answer_{{ $i }}" class="form-control" id="" >

                                            {{ setting('answer_' . $i) }}
                                        </textarea>

                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                    {{-- client id --}}


                    <div class="form-group mr-2">
                        <button type="submit" class="btn btn-info">Save <i class="fa fa-plus"
                                aria-hidden="true"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
