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
            @if(isset($results))
                <p>{{$results->title}}  {{$results->body}}</p>
                <?php
                $urls = json_decode($results->url,true);
                if($urls){
                    foreach ($urls as $url){
                        echo "<p> <img src='http://pic.namiyami.com/full/{$url}' /></p>";
                    }
                }
                ?>
            @else
                <p>没有找到相关纪录</p>
            @endif
        </div>
@endsection
