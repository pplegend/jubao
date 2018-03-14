@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if (isset($qq))
                            <h1>{{ $qq->qq }} </h1>
                            <p>{{$qq->body}}</p>
                            <p>{{$qq->author}}</p>
                            <?php
                                $urls = json_decode($qq->url,true);
                                if($urls){
                                    foreach ($urls as $url){
                                        echo "<p> <img src='http://pic.namiyami.com/full/{$url}' /></p>";
                                    }
                                }
                                ?>
                            <a class="btn btn-primary" href="{{ route('qq.aduit',$qq->id) }}">通过</a>
                            <a class="btn btn-primary" href="{{ route('qq.notaduit',$qq->id) }}">不通过</a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
