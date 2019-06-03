@extends('web::layout.app')

@section('title')
    {{trans('user.title.password_reset')}}
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
                                    <form method="post" class="ui mini loadable form"
                                          action="{{route('user_password.reset')}}">
                                        <div class="required field">
                                            <label class="required">{{trans('auth.old_password')}}</label>
                                            <input type="password" name="old_password" value="">
                                            @if($errors->first('old_password'))
                                                <div class="ui visible error message">
                                                    {{$errors->first('old_password')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="required field">
                                            <label class="required">{{trans('auth.new_password')}}</label>
                                            <input type="password" name="new_password" value="">
                                            @if($errors->first('new_password'))
                                                <div class="ui visible error message">
                                                    {{$errors->first('new_password')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="required field">
                                            <label class="required">{{trans('auth.new_password_confirmation')}}</label>
                                            <input type="password" name="new_password_confirmation"
                                                   value="">
                                            @if($errors->first('new_password_confirmation'))
                                                <div class="ui visible error message">
                                                    {{$errors->first('new_password_confirmation')}}
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
