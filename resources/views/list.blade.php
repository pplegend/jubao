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

            <div class="card border-dark mb-3" style="max-width: 18rem; margin: 10px;">
                <div class="card-header">{{$result->title}}</div>
                <div class="card-body text-dark">
                    <p class="card-text">{{$result->body}}</p>
                </div>
                <div class="card-footer bg-transparent">查看详情</div>
            </div>
        @endforeach
    </div>


@endsection
