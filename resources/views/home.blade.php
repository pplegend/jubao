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
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <?php echo $results->render(); ?>
        </div>
    </div>
@endsection


