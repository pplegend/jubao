@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if (isset($pz))
                            <h1>{{ $pz->title }} </h1>
                            <p>{{$pz->body}}</p>
                            <p>{{$pz->author}}</p>
                            <?php
                            $urls = json_decode($pz->url,true);
                            if($urls){
                                foreach ($urls as $url){
                                    echo "<p> <img src='http://pic.namiyami.com/full/{$url}' /></p>";
                                }
                            }
                            ?>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
