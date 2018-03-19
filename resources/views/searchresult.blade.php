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
            @if(isset($results))
                <p>{{$results->title}}  {{$results->body}}</p>
            @else
                <p>没有找到相关纪录</p>
            @endif
        </div>
    </div>
@endsection
