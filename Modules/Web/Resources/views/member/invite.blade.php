@extends('web::layout.app')

@section('title')
    {{trans('member.title.invite')}}
@endsection

@section('content')
    <div class="member">
        <div class="ui container content">
            @include('web::common.message')
            <div class="ui stackable grid">
                <div class="sixteen wide column">
                    <div class="ui segment">
                        <div class="ui two column stackable grid">
                            @include('web::common.task_menu')
                            <div class="thirteen wide column">
                                <div class="ui segment">
                                    <form method="post"
                                          action="{{route('member.invite_fresh',['uuid'=>\request()->route('uuid')])}}"
                                          class="ui mini loadable form">
                                        <div class="field">
                                            <label>{{trans('member.table.link')}}</label>
                                            <input style="width: 80%;" type="text" readonly name="link"
                                                   value="{!!route('user.join_form',['uuid'=>\request()->route('uuid'),'token'=>$token])!!}">
                                            <button class="mini ui primary button" type="submit">
                                                {{trans('member.button.reset_link')}}
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
