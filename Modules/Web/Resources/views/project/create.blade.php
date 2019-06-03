@extends('web::layout.app')

@section('title')
    {{trans('project.title.create')}}
@endsection

@section('content')
    <div class="project">
        <div class="ui container content">
            <div class="ui stackable grid">
                <div class="sixteen wide column">
                    <div class="ui segment" style="">
                        <form method="post" action="{{route('project.store')}}" class="ui mini loadable form"
                              enctype="multipart/form-data">
                            <div class="required field">
                                <label>{{trans('project.table.name')}}</label>
                                <input type="text" name="name" value="{{old('name')}}">
                                @if($errors->first('name'))
                                    <div class="ui visible error message">
                                        {{$errors->first('name')}}
                                    </div>
                                @endif
                            </div>
                            <div class="field">
                                <label>
                                    {{trans('project.table.image')}}
                                    ({{trans('project.note.image_mimes')}})
                                </label>
                                <div class="ui segment">
                                    <div class="image-div">
                                        <span class="image-span"></span>
                                        <label id="image-button" class="ui mini icon labeled button">
                                            <i class="cloud upload icon"></i>
                                            {{trans('common.button.chose_image')}}
                                        </label>
                                    </div>
                                    <div style="display: none;">
                                        <input id="image" type="file" name="image">
                                    </div>
                                </div>
                                @if($errors->first('image'))
                                    <div class="ui visible error message">
                                        {{$errors->first('image')}}
                                    </div>
                                @endif
                            </div>
                            <div class="field">
                                <label>{{trans('project.table.description')}}</label>
                                <textarea name="description">{{old('description')}}</textarea>
                            </div>
                            <div class="ui basic segment">
                                <button class="mini ui primary button" type="submit">
                                    {{trans('common.button.submit')}}
                                </button>
                                <a href="{{route('project.index')}}" class="mini ui button">
                                    {{trans('common.button.cancle')}}
                                </a>
                            </div>
                            {{csrf_field()}}
                        </form>
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
            });
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
