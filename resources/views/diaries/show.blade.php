@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
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
                            <button class="pull-left"><a href="/diary/{{$diary->id}}/edit">编辑</a></button>
                            <form action="/diary/{{$diary->id}}" method="post">
                                {{method_field('DELETE')}}
                                {{csrf_field()}}
                                {{--<span><a href="#">删除</a></span>--}}
                                <button class="btn-sm pull-right button-blue">删除</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h2>{{$diary->followers_count}}</h2>
                        <span>关注者</span>
                    </div>
                    @if(Auth::check())
                        <div class="panel-body">
                            {{--<a href="/diary/{{$diary->id}}/follow" class="btn btn-success"--}}
                               {{--class="btn btn-default {{Auth::user()->followed($diary->id) ? 'btn-success' : ''}}">--}}
                                {{--{{Auth::user()->followed($diary->id) ? '已关注' : '关注TA'}}--}}
                            {{--</a>--}}
                            <diary-follow-button :diary="{{$diary->id}}" :user="{{Auth::user()->id}}"></diary-follow-button>
                            <a href="#editor" class="btn btn-primary">发表评论</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
