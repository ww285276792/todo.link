@extends('web::layout.app')

@section('title')
    {{trans('user.title.edit')}}
@endsection

@section('content')
    <div class="user">
        <div class="ui container content">
            @include('web::common.message')
            <div class="ui stackable grid">
                <div class="sixteen wide column">
                    <div class="ui segment">
                        <div class="ui two column stackable grid">
                            @include('web::common.user_menu')
                            <div class="thirteen wide column">
                                <div class="ui segment">
                                    <form method="post" class="ui mini loadable form" enctype="multipart/form-data"
                                          action="{{route('user_setting.update')}}">
                                        <div class="required field">
                                            <label>{{trans('user.table.name')}}</label>
                                            <input type="text" name="name"
                                                   value="{{old('name')?old('name'):$data->name}}">
                                            @if($errors->first('name'))
                                                <div class="ui visible error message">
                                                    {{$errors->first('name')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="field">
                                            <label>{{trans('user.table.email')}}</label>
                                            <input type="text" readonly name="email" value="{{$data->email}}">
                                        </div>
                                        <div class="field">
                                            <label>{{trans('user.table.avatar')}}</label>
                                            <div class="ui segment">
                                                <div class="image-div">
                                                <span class="image-span">
                                                    @if($data->avatar)
                                                        <img style="display: inline-block;" src="{{$data->avatar}}"
                                                             class="ui bottom aligned small bordered image"/>
                                                    @endif
                                                </span>
                                                    <label id="image-button" class="ui mini icon labeled button">
                                                        <i class="cloud upload icon"></i>
                                                        {{trans('common.button.chose_image')}}
                                                    </label>
                                                </div>
                                                <div style="display: none;">
                                                    <input id="image" type="file" name="avatar">
                                                </div>
                                            </div>
                                            @if($errors->first('avatar'))
                                                <div class="ui visible error message">
                                                    {{$errors->first('avatar')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ui basic segment">
                                            <button class="mini ui primary button" type="submit">
                                                {{trans('common.button.submit')}}
                                            </button>
                                        </div>
                                        {{csrf_field()}}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function () {
            $('#image-button').click(function () {
                $('#image').click();
            });

            $('#image').change(function () {
                displayUploadedImage(this);
            })
        });

        function displayUploadedImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image-div span').html('<img style="display: inline-block;" src="' + e.target.result + '"'
                        + 'class="ui bottom aligned small bordered image"/>');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
