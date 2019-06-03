@extends('admin.layout.app')

@section('content')
    <div id="content">
        <div class="ui stackable two column grid">
            <div class="column">
                @include('admin.admin_user.header')
                <div class="ui breadcrumb">
                    <a href="{{route('admin.dash')}}" class="section">{{trans('common.breadcrumb.console')}}</a>
                    <i class="right chevron icon divider"></i>
                    <a href="{{route('admin_user.index')}}" class="section">{{trans('admin_user.manage')}}</a>
                    <i class="right chevron icon divider"></i>
                    <div class="active section">{{trans('admin_user.edit_user')}}</div>
                </div>
            </div>
        </div>
        <div class="ui hidden divider"></div>
        <div class="ui segment">
            <form method="post" action="{{route('admin_user.update',['id'=>$user->id])}}" class="ui loadable form">
                <div class="required field">
                    <label class="required">{{trans('admin_user.table.name')}}</label>
                    <input type="text" name="name" value="{{old('name')?old('name'):$user->name}}"
                           placeholder="{{trans('admin_user.placeholder.input_user')}}">
                    @if($errors->first('name'))
                        <div class="ui visible error message">
                            {{$errors->first('name')}}
                        </div>
                    @endif
                </div>
                <div class="required field">
                    <label class="required">{{trans('admin_user.table.email')}}</label>
                    <input type="text" name="email" value="{{old('email')?old('email'):$user->email}}"
                           placeholder="{{trans('admin_user.placeholder.input_email')}}">
                    @if($errors->first('email'))
                        <div class="ui visible error message">
                            {{$errors->first('email')}}
                        </div>
                    @endif
                </div>
                <div class="required field">
                    <label class="required">{{trans('admin_user.table.password')}}</label>
                    <input type="password" name="password" value="{{old('password')}}"
                           placeholder="{{trans('admin_user.placeholder.input_password')}}">
                    @if($errors->first('password'))
                        <div class="ui visible error message">
                            {{$errors->first('password')}}
                        </div>
                    @endif
                </div>
                <div class="required field">
                    <label class="required">{{trans('admin_user.table.password_confirmation')}}</label>
                    <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}"
                           placeholder="{{trans('admin_user.placeholder.input_password_confirmation')}}">
                    @if($errors->first('password_confirmation'))
                        <div class="ui visible error message">
                            {{$errors->first('password_confirmation')}}
                        </div>
                    @endif
                </div>
                <div class="required field">
                    <label class="required">{{trans('admin_role.name')}}</label>
                    <select name="role_id" class="ui fluid dropdown">
                        @foreach ($roles as $role)
                            <option value="{{$role->id}}" {{count($user->roles)>0&&$user->roles[0]->id==$role->id?'selected':''}}>
                                {{$role->display_name}}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->first('role_id'))
                        <div class="ui visible error message">
                            {{$errors->first('role_id')}}
                        </div>
                    @endif
                </div>
                <div class="ui basic segment">
                    <button class="ui primary button" type="submit">
                        {{trans('common.button.submit')}}
                    </button>
                    <a href="{{route('admin_user.index')}}" class="ui button">
                        {{trans('common.button.cancle')}}
                    </a>
                </div>
                {{csrf_field()}}
                {{method_field('PUT')}}
            </form>
        </div>
    </div>
@endsection
