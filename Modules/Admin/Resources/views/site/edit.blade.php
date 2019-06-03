@extends('admin.layout.app')

@include('vendor.ueditor.assets')

@section('content')
    <div id="content">
        @include('admin.common.message')
        <div class="ui stackable two column grid">
            <div class="column">
                @include('admin.site.header')
                <div class="ui breadcrumb">
                    <a href="{{route('admin.dash')}}" class="section">{{trans('common.breadcrumb.console')}}</a>
                    <i class="right chevron icon divider"></i>
                    <div class="active section">{{trans('site.edit_site')}}</div>
                </div>
            </div>
        </div>
        <div class="ui hidden divider"></div>
        <div class="ui segment">
            <form method="post" action="{{route('admin_setting_site.update',['id'=>$site->id])}}"
                  class="ui loadable form" enctype="multipart/form-data">
                <div class="field">
                    <label class="required">
                        {{trans('site.table.image')}}（{{trans('common.image_type')}}）
                    </label>
                    <div class="ui segment">
                        <label id="image-button" class="ui icon labeled button">
                            <i class="cloud upload icon"></i>
                            {{trans('common.chose_image')}}
                        </label>
                        <div style="display: none;">
                            <input id="image" type="file" name="image">
                        </div>
                        <div class="image-div">
                            @if ($site->image)
                                <img src="{{asset('storage/'.$site->image->path)}}"
                                     class="ui small bordered image"/>
                            @endif
                        </div>
                    </div>
                    @if($errors->first('image'))
                        <div class="ui visible error message">
                            {{$errors->first('image')}}
                        </div>
                    @endif
                </div>
                <div class="required field">
                    <label class="required">{{trans('site.table.author')}}</label>
                    <input type="text" name="author" value="{{old('author')?old('author'):$site->author}}"
                           placeholder="{{trans('site.placeholder.input_author')}}">
                    @if($errors->first('author'))
                        <div class="ui visible error message">
                            {{$errors->first('author')}}
                        </div>
                    @endif
                </div>
                <div class="required field">
                    <label class="required">{{trans('site.table.author_description')}}</label>
                    <script id="container" name="author_description" type="text/plain">
                        @if (old('author_description'))
                            {!! old('author_description') !!}
                        @else
                            {!! $site->author_description !!}
                        @endif
                    </script>
                    @if($errors->first('author_description'))
                        <div class="ui visible error message">
                            {{$errors->first('author_description')}}
                        </div>
                    @endif
                </div>
                <div class="required field">
                    <label class="required">{{trans('site.table.site_description')}}</label>
                    <script id="container2" name="site_description" type="text/plain">
                        @if (old('site_description'))
                            {!! old('site_description') !!}
                        @else
                            {!! $site->site_description !!}
                        @endif
                    </script>
                    @if($errors->first('site_description'))
                        <div class="ui visible error message">
                            {{$errors->first('site_description')}}
                        </div>
                    @endif
                </div>
                <div class="required field">
                    <label class="required">{{trans('site.table.is_comment')}}</label>
                    <div class="inline field ui segment">
                        <div class="ui toggle checkbox">
                            <input {{$site->is_comment==1?'checked':''}}
                                   type="checkbox" tabindex="0" name="is_comment"
                                   value="1" class="hidden">
                        </div>
                    </div>
                    @if($errors->first('is_comment'))
                        <div class="ui visible error message">
                            {{$errors->first('is_comment')}}
                        </div>
                    @endif
                </div>
                <div class="required field">
                    <label class="required">{{trans('site.table.is_message')}}</label>
                    <div class="inline field ui segment">
                        <div class="ui toggle checkbox">
                            <input {{$site->is_message==1?'checked':''}}
                                   type="checkbox" tabindex="0" name="is_message"
                                   value="1" class="hidden">
                        </div>
                    </div>
                    @if($errors->first('is_message'))
                        <div class="ui visible error message">
                            {{$errors->first('is_message')}}
                        </div>
                    @endif
                </div>
                <div class="ui basic segment">
                    <button class="ui primary button" type="submit">
                        {{trans('common.button.submit')}}
                    </button>
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
        var ue1 = UE.getEditor('container', {
            initialFrameHeight: 250,//设置编辑器高度
            scaleEnabled: true
        });

        ue1.ready(function () {
            ue1.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });

        var ue2 = UE.getEditor('container2', {
            initialFrameHeight: 250,//设置编辑器高度
            scaleEnabled: true
        });

        ue2.ready(function () {
            ue2.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });

        $('.ui.checkbox')
            .checkbox()
        ;

        $(function () {
            $('#image-button').click(function () {
                $('#image').click();
            });
            $('#image').change(function () {
                displayUploadedImage(this);
            });
        });

        function displayUploadedImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var image = $(input).parent().siblings('.image');

                    if (image.length > 0) {
                        image.attr('src', e.target.result);
                    } else {
                        var img = $('<img class="ui small bordered image"/>');
                        img.attr('src', e.target.result);
                        $(input).parent().parent().children('.image-div').html(img);
                    }
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
