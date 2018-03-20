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
    <div class="row" id="jubaophone_list">
        @foreach ($results as $result)
                <div class="card">
                    <div class="front">
                        {{$result->body}}
                    </div>
                    <div class="back">
                        {{$result->title}}
                    </div>
                </div>
        @endforeach
        <?php echo $results->render(); ?>
    </div>
</div>
@endsection
