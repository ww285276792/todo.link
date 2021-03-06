@extends('web::layout.app')

@section('title')
    {{trans('tag.title.create')}}
@endsection

@section('content')
    <div class="tag">
        <div class="ui container content">
            <div class="ui stackable grid">
                <div class="sixteen wide column">
                    <div class="ui segment">
                        <div class="ui two column stackable grid">
                            @include('web::common.task_menu')
                            <div class="thirteen wide column">
                                <div class="ui segment">
                                    <form method="post" class="ui mini loadable form"
                                          action="{{route('setting_tag.store',['uuid'=>\request()->route('uuid')])}}">
                                        <div class="required field">
                                            <label>{{trans('tag.table.name')}}</label>
                                            <input type="text" name="name" value="{{old('name')}}">
                                            @if($errors->first('name'))
                                                <div class="ui visible error message">
                                                    {{$errors->first('name')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="required field">
                                            <label>{{trans('common.table.sort')}}</label>
                                            <input type="number" name="sort" value="{{old('sort')?old('sort'):1}}">
                                            @if($errors->first('sort'))
                                                <div class="ui visible error message">
                                                    {{$errors->first('sort')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ui basic segment">
                                            <button class="mini ui primary button" type="submit">
                                                {{trans('common.button.submit')}}
                                            </button>
                                            <a href="{{route('setting_tag.index',['uuid'=>\request()->route('uuid')])}}"
                                               class="mini ui button">
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
            </div>
        </div>
    </div>
@endsection
