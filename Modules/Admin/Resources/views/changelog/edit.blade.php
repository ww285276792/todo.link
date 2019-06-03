@extends('admin.layout.app')

@include('vendor.ueditor.assets')

@section('content')
    <div id="content">
        <div class="ui stackable two column grid">
            <div class="column">
                @include('admin.changelog.header')
                <div class="ui breadcrumb">
                    <a href="{{route('admin.dash')}}" class="section">{{trans('common.breadcrumb.console')}}</a>
                    <i class="right chevron icon divider"></i>
                    <a href="{{route('admin_changelog.index')}}" class="section">{{trans('changelog.manage')}}</a>
                    <i class="right chevron icon divider"></i>
                    <div class="active section">{{trans('changelog.edit_changelog')}}</div>
                </div>
            </div>
        </div>
        <div class="ui hidden divider"></div>
        <div class="ui segment">
            <form method="post" action="{{route('admin_changelog.update',['id'=>$changelog->id])}}"
                  class="ui loadable form">
                <div class="required field">
                    <label class="required">{{trans('changelog.table.version')}}</label>
                    <input type="text" name="version" value="{{old('version')?old('version'):$changelog->version}}"
                           placeholder="{{trans('changelog.placeholder.input_version')}}">
                    @if($errors->first('version'))
                        <div class="ui visible error message">
                            {{$errors->first('version')}}
                        </div>
                    @endif
                </div>
                <div class="required field">
                    <label class="required">{{trans('changelog.table.date')}}</label>
                    <input value="{{old('date')?old('date'):$changelog->date}}" type="date" name="date">
                    @if($errors->first('date'))
                        <div class="ui visible error message">
                            {{$errors->first('date')}}
                        </div>
                    @endif
                </div>
                <div class="required field">
                    <label class="required">{{trans('changelog.table.content')}}</label>
                    <script id="container" name="content" type="text/plain">
                        @if (old('content'))
                            {!! old('content') !!}
                        @else
                            {!! $changelog->content !!}
                        @endif
                    </script>
                    @if($errors->first('content'))
                        <div class="ui visible error message">
                            {{$errors->first('content')}}
                        </div>
                    @endif
                </div>
                <div class="ui basic segment">
                    <button class="ui primary button" type="submit">
                        {{trans('common.button.submit')}}
                    </button>
                    <a href="{{route('admin_changelog.index')}}" class="ui button">
                        {{trans('common.button.cancle')}}
                    </a>
                </div>
                {{csrf_field()}}
                {{method_field('PUT')}}
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container', {
            initialFrameHeight: 250,//设置编辑器高度
            scaleEnabled: true
        });

        ue.ready(function () {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
    </script>
@endsection
