@extends('admin.layout.app')

@section('content')
    <div id="content">
        <div class="ui stackable two column grid">
            <div class="column">
                @include('admin.admin_role.header')
                <div class="ui breadcrumb">
                    <a href="{{route('admin.dash')}}" class="section">{{trans('common.breadcrumb.console')}}</a>
                    <i class="right chevron icon divider"></i>
                    <a href="{{route('admin_user_role.index')}}" class="section">{{trans('admin_role.manage')}}</a>
                    <i class="right chevron icon divider"></i>
                    <div class="active section">{{trans('admin_role.edit_user')}}</div>
                </div>
            </div>
        </div>
        <div class="ui hidden divider"></div>
        <div class="ui segment">
            <form method="post" action="{{route('admin_user_role.update',['id'=>$role->id])}}"
                  class="ui loadable form">
                <div class="required field">
                    <label class="required">{{trans('admin_role.table.name')}}</label>
                    <input type="text" name="name" value="{{old('name')?old('name'):$role->name}}"
                           placeholder="{{trans('admin_role.placeholder.input_user')}}">
                    @if($errors->first('name'))
                        <div class="ui visible error message">
                            {{$errors->first('name')}}
                        </div>
                    @endif
                </div>
                <div class="required field">
                    <label class="required">{{trans('admin_role.table.display_name')}}</label>
                    <input type="text" name="display_name"
                           value="{{old('display_name')?old('display_name'):$role->display_name}}"
                           placeholder="{{trans('admin_role.placeholder.input_display_name')}}">
                    @if($errors->first('display_name'))
                        <div class="ui visible error message">
                            {{$errors->first('display_name')}}
                        </div>
                    @endif
                </div>
                <div class="required field">
                    <label class="required">{{trans('admin_role.table.description')}}</label>
                    <input type="text" name="description"
                           value="{{old('description')?old('description'):$role->description}}"
                           placeholder="{{trans('admin_role.placeholder.input_description')}}">
                    @if($errors->first('description'))
                        <div class="ui visible error message">
                            {{$errors->first('description')}}
                        </div>
                    @endif
                </div>
                <div class="field">
                    <label class="required">{{trans('admin_role.permissions')}}</label>
                    @foreach ($permissions as $key=>$permission)
                        <div class="ui checkbox segment">
                            @if(count($role->permissions)>0)
                                <input {{count($role->permissions)>0&&in_array($permission->id,$perms)?'checked':''}}
                                       name="permission[]" type="checkbox" value="{{$permission->id}}">
                            @else
                                <input {{count(old('permission'))>0&&in_array($permission->id,old('permission'))?'checked':''}}
                                       name="permission[]" type="checkbox" value="{{$permission->id}}">
                            @endif
                            <label>{{$permission->display_name}}</label>
                        </div>
                    @endforeach
                    @if($errors->first('permission'))
                        <div class="ui visible error message">
                            {{$errors->first('permission')}}
                        </div>
                    @endif
                </div>
                <div class="ui basic segment">
                    <button class="ui primary button" type="submit">
                        {{trans('common.button.submit')}}
                    </button>
                    <a href="{{route('admin_user_role.index')}}" class="ui button">
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
    <script type="text/javascript">
        $('.ui.checkbox')
            .checkbox()
        ;
    </script>
@endsection
