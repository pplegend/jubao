@extends('layouts.app')

@section('content')
    <div class="container">
        {{--@include('carousel')--}}
        <div class="row">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @include('searchform')
        </div>
        <div class="row">
            @foreach ($results as $result)
                <p>{{$result->title}}  {{$result->body}}</p>
            @endforeach
        </div>
    </div>
@endsection
