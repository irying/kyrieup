@extends('layouts.app')

@section('content')
    @include('vendor.ueditor.assets')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">写日志</div>

                    <div class="panel-body">
                        <form action="/diary/{{$diary->id}}" method="post">
                            {{method_field('PATCH')}}
                            {!! csrf_field() !!}
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title">标题</label>
                                <input type="text" name="title" value="{{ $diary->title }}" class="form-control" placeholder="标题" id="title">
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <select name="tags[]" class="js-example-basic-multiple form-control" multiple="multiple">
                                    @foreach($diary->tags as $tag)
                                        <option value="{{$tag->id}}" selected="selected">{{$tag->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                <!-- 编辑器容器 -->
                                <script id="container" name="content" type="text/plain">
                                    {!! $diary->content !!}
                                </script>
                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button class="btn btn-success pull-right" type="submit">发布</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('js')
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function () {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
        //            $(".js-example-basic-multiple").select2();
        $(document).ready(function () {
            function formatTag (tag) {
                return "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'>" +
                tag.name ? tag.name : "Laravel"   +
                    "</div></div></div>";
            }

            function formatTagSelection (tag) {
                return tag.name || tag.text;
            }

            $(".js-example-basic-multiple").select2({
                tags: true,
                placeholder: '选择相关话题',
                minimumInputLength: 2,
                ajax: {
                    url: '/api/tags',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function (data, params) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                templateResult: formatTag,
                templateSelection: formatTagSelection,
                escapeMarkup: function (markup) { return markup; }
            });
        })
    </script>
@endsection
@endsection
