@extends('layouts.app')

@section('content')
        {{--@include('carousel')--}}
    <div class="row iamcenter">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @include('searchform')
    </div>
    <div class="row">
        @foreach ($results as $result)
            <div class="col-sm-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="card-title"><a href="#">{{$result->title}}</a></h5>

                    </div>
                    <div class="panel-body">
                        <p class="card-text">{{$result->body}}</p>
                    </div>
                </div>
            </div>

        @endforeach
    </div>


@endsection
