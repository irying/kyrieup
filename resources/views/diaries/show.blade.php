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
                            <diary-follow-button diary="{{$diary->id}}"></diary-follow-button>
                            <a href="#editor" class="btn btn-primary pull-right">发表评论</a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-8 col-md-offset-1">
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h5>关于作者</h5>
                    </div>
                    <div class="panel-body">
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img width="36" src="{{$diary->user->avatar}}" alt="{{$diary->user->name}}">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a href="">
                                        {{$diary->user->name}}
                                    </a>
                                </h4>
                            </div>
                            <div class="user-statics">
                                <div class="statics-item text-center">
                                    <div class="statics-text">日志</div>
                                    <div class="statics-count">{{$diary->user->diaries_count}}</div>
                                </div>
                                <div class="statics-item text-center">
                                    <div class="statics-text">关注</div>
                                    <div class="statics-count">{{$diary->user->followings_count}}</div>
                                </div>
                                <div class="statics-item text-center">
                                    <div class="statics-text">粉丝</div>
                                    <div class="statics-count">{{$diary->user->followers_count}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(Auth::check())
                        <div class="panel-body">
                            {{--<a href="/diary/{{$diary->id}}/follow" class="btn btn-success"--}}
                            {{--class="btn btn-default {{Auth::user()->followed($diary->id) ? 'btn-success' : ''}}">--}}
                            {{--{{Auth::user()->followed($diary->id) ? '已关注' : '关注TA'}}--}}
                            {{--</a>--}}
                            <user-follow-button user="{{$diary->user_id}}"></user-follow-button>
                            {{--<a href="#editor" class="btn btn-primary pull-right">发送私信</a>--}}
                            <send-message></send-message>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
