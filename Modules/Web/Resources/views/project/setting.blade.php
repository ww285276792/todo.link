@extends('web::layout.app')

@section('title')
    {{trans('project.title.setting')}}-{{$data->name}}
@endsection

@section('content')
    <div class="project">
        <div class="ui container content">
            @include('web::common.message')
            <div class="ui stackable grid">
                <div class="sixteen wide column">
                    <div class="ui segment">
                        <div class="ui two column stackable grid">
                            @include('web::common.task_menu')
                            <div class="thirteen wide column">
                                <div class="ui segment">
                                    <div class="ui stackable column grid">
                                        <div class="middle aligned column">
                                            <a data-content="{{trans('project.note.delete')}}" id="delete-btn"
                                               data-position="bottom right"
                                               onclick="del();" class="mini ui right floated red button">
                                                {{trans('project.button.delete')}}
                                            </a>
                                        </div>
                                    </div>
                                    <form id="delete-form"
                                          action="{{route('setting.destroy',['uuid'=>\request()->route('uuid'),'id'=>$data->id])}}"
                                          method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                        {{method_field('DELETE')}}
                                    </form>
                                    <form method="post" class="ui mini loadable form" enctype="multipart/form-data"
                                          action="{{route('setting.update',['uuid'=>\request()->route('uuid'),'id'=>$data->id])}}">
                                        <div class="required field">
                                            <label>{{trans('project.table.name')}}</label>
                                            <input type="text" name="name"
                                                   value="{{old('name')?old('name'):$data->name}}">
                                            @if($errors->first('name'))
                                                <div class="ui visible error message">
                                                    {{$errors->first('name')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="field">
                                            <label>{{trans('project.table.image')}}</label>
                                            <div class="ui segment">
                                                <div class="image-div">
                                                    <span class="image-span">
                                                        @if($data->logo)
                                                            <img style="display: inline-block;" src="{{$data->logo}}"
                                                                 class="ui bottom aligned small bordered image"/>
                                                        @endif
                                                    </span>
                                                    <label id="image-button" class="ui mini icon labeled button">
                                                        <i class="cloud upload icon"></i>
                                                        {{trans('common.button.chose_image')}}
                                                    </label>
                                                </div>
                                                <div style="display: none;">
                                                    <input id="image" type="file" name="image">
                                                </div>
                                            </div>
                                            @if($errors->first('avatar'))
                                                <div class="ui visible error message">
                                                    {{$errors->first('avatar')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="field">
                                            <label>{{trans('project.table.description')}}</label>
                                            <textarea
                                                    name="description">{{old('description')?old('description'):$data->description}}</textarea>
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
    <div class="ui mini modal" id="delete-modal">
        <div class="header">
            <i class="icon warning red sign"></i>
            {{trans('common.modal.delete_message')}}
        </div>
        <div class="content">
            <p>{{trans('common.modal.confirm_delete_message')}}</p>
        </div>
        <div class="actions">
            <div class="ui mini positive button">{{trans('common.button.confirm')}}</div>
            <div class="ui mini deny button">{{trans('common.button.cancle')}}</div>
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

            $('#delete-btn')
                .popup()
            ;
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

        function del(id) {
            $('#delete-modal')
                .modal({
                    closable: true,
                    onDeny: function () {
                    },
                    onApprove: function () {
                        document.getElementById('delete-form').submit();
                    }
                })
                .modal('show')
            ;
        }
    </script>
@endsection
