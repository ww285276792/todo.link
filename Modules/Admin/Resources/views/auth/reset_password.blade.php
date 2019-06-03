@extends('admin::layout.app')

@section('content')
    <div id="content">
        @include('admin::common.message')
        <div class="ui stackable two column grid">
            <div class="column">
                @include('admin::auth.header')
                <div class="ui breadcrumb">
                    <a href="{{route('admin.dash')}}" class="section">{{trans('admin::common.breadcrumb.console')}}</a>
                    <i class="right chevron icon divider"></i>
                    <div class="active section">{{trans('auth.reset_password')}}</div>
                </div>
            </div>
        </div>
        <div class="ui hidden divider"></div>
        <div class="ui segment">
            <form method="post" action="{{route('admin_password.reset')}}" class="ui loadable form">
                <div class="required field">
                    <label class="required">{{trans('auth.old_password')}}</label>
                    <input type="password" name="old_password" value="{{old('old_password')}}"
                           placeholder="{{trans('auth.old_password')}}">
                    @if($errors->first('old_password'))
                        <div class="ui visible error message">
                            {{$errors->first('old_password')}}
                        </div>
                    @endif
                </div>
                <div class="required field">
                    <label class="required">{{trans('auth.new_password')}}</label>
                    <input type="password" name="new_password" value="{{old('new_password')}}"
                           placeholder="{{trans('auth.new_password')}}">
                    @if($errors->first('new_password'))
                        <div class="ui visible error message">
                            {{$errors->first('new_password')}}
                        </div>
                    @endif
                </div>
                <div class="required field">
                    <label class="required">{{trans('auth.new_password_confirmation')}}</label>
                    <input type="password" name="new_password_confirmation"
                           value="{{old('new_password_confirmation')}}"
                           placeholder="{{trans('auth.new_password_confirmation')}}">
                    @if($errors->first('new_password_confirmation'))
                        <div class="ui visible error message">
                            {{$errors->first('new_password_confirmation')}}
                        </div>
                    @endif
                </div>
                <div class="ui basic segment">
                    <button class="ui primary button" type="submit">
                        {{trans('admin::common.button.submit')}}
                    </button>
                    <a href="{{route('admin.dash')}}" class="ui button">
                        {{trans('admin::common.button.cancle')}}
                    </a>
                </div>
                {{csrf_field()}}
            </form>
        </div>
    </div>
@endsection
