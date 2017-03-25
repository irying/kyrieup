@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$diary->title}}
                        @foreach($diary->tags as $tag)
                            <span class="tag">{{$tag->name}}</span>
                        @endforeach
                    </div>
                    <div class="panel-body">
                        {!! $diary->content !!}
                    </div>
                    <div class="actions" >
                        @if(Auth::check() && Auth::user()->owns($diary))
                            <span class="edit"><a href="/diary/{{$diary->id}}/edit">编辑</a></span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
