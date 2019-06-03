@extends('web::layout.app')

@section('title')
    {{trans('member.title.edit')}}
@endsection

@section('content')
    <div class="member">
        <div class="ui container content">
            <div class="ui stackable grid">
                <div class="sixteen wide column">
                    <div class="ui segment">
                        <div class="ui two column stackable grid">
                            @include('web::common.task_menu')
                            <div class="thirteen wide column">
                                <div class="ui segment">
                                    <form method="post" class="ui mini loadable form"
                                          action="{{route('member.role_update',['uuid'=>\request()->route('uuid'),'id'=>$user->id])}}">
                                        <div class="required field">
                                            <label>{{trans('member.table.name')}}</label>
                                            <input readonly="" type="text" name="title" value="{{$user->name}}">
                                        </div>
                                        <div class="field">
                                            <label>{{trans('member.table.role')}}</label>
                                            <div class="inline fields">
                                                @forelse ($roles as $role)
                                                    <div class="field">
                                                        <div class="ui radio checkbox">
                                                            @if(old('role'))
                                                                <input type="radio"
                                                                       {{old('role')==$role->id?'checked':''}} value="{{$role->name}}"
                                                                       name="role"
                                                                       tabindex="0" class="hidden">
                                                            @else
                                                                <input type="radio"
                                                                       {{$user->roles[0]->id==$role->id?'checked':''}} value="{{$role->name}}"
                                                                       name="role"
                                                                       tabindex="0" class="hidden">
                                                            @endif
                                                            <label>{{$role->description}}</label>
                                                        </div>
                                                    </div>
                                                @empty
                                                @endforelse
                                            </div>
                                        </div>
                                        <div class="ui basic segment">
                                            <button class="mini ui primary button" type="submit">
                                                {{trans('common.button.submit')}}
                                            </button>
                                            <a href="{{route('member.index',['uuid'=>\request()->route('uuid')])}}"
                                               class="mini ui button">
                                                {{trans('common.button.cancle')}}
                                            </a>
                                        </div>
                                        {{csrf_field()}}
                                        {{method_field('PUT')}}
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
