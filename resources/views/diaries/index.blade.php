@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach($diaries as $diary)
                    <div class="media">
                        <div class="media-left">
                            <a href="">
                                <img width="48" src="{{$diary->user->avatar}}" alt="{{$diary->user->name}}">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="/diary/{{$diary->id}}"> {{$diary->title}}</a>
                            </h4>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
