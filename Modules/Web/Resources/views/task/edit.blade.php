@extends('web::layout.app')

@section('title')
    {{trans('task.title.edit')}}-{{$data->title}}
@endsection

@section('content')
    <div class="task">
        <div class="ui container content">
            <div class="ui stackable grid">
                <div class="sixteen wide column">
                    <div class="ui segment">
                        <div class="ui two column stackable grid">
                            @include('web::common.task_menu')
                            <div class="thirteen wide column">
                                <div class="ui segment">
                                    <form method="post" class="ui mini loadable form"
                                          action="{{route('task.update',['uuid'=>\request()->route('uuid'),'id'=>$data->id])}}">
                                        <div class="required field">
                                            <label>{{trans('task.table.title')}}</label>
                                            <input type="text" name="title"
                                                   value="{{old('title')?old('title'):$data->title}}">
                                            @if($errors->first('title'))
                                                <div class="ui visible error message">
                                                    {{$errors->first('title')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="required field">
                                            <label>{{trans('task.table.module')}}</label>
                                            <div class="ui selection dropdown">
                                                <input type="hidden" name="module_id"
                                                       value="{{old('module_id')?old('module_id'):$data->module_id}}">
                                                <i class="dropdown icon"></i>
                                                <div class="default text"></div>
                                                <div class="menu">
                                                    @forelse ($modules as $module)
                                                        <div class="item" data-value="{{$module->id}}">
                                                            {{$module->name}}
                                                        </div>
                                                    @empty
                                                    @endforelse
                                                </div>
                                            </div>
                                            @if($errors->first('module_id'))
                                                <div class="ui visible error message">
                                                    {{$errors->first('module_id')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="field">
                                            <label>{{trans('task.table.description')}}</label>
                                            <textarea
                                                    name="description">{{old('description')?old('description'):$data->description}}</textarea>
                                        </div>
                                        <div class="field">
                                            <label>{{trans('task.table.level')}}</label>
                                            <div class="inline fields">
                                                @forelse ($levels as $level)
                                                    <div class="field">
                                                        <div class="ui radio checkbox">
                                                            @if(old('level_id'))
                                                                <input type="radio"
                                                                       {{old('level_id')==$level->id?'checked':''}} value="{{$level->id}}"
                                                                       name="level_id"
                                                                       tabindex="0" class="hidden">
                                                            @else
                                                                <input type="radio"
                                                                       {{$data->level_id==$level->id?'checked':''}} value="{{$level->id}}"
                                                                       name="level_id"
                                                                       tabindex="0" class="hidden">
                                                            @endif
                                                            <label>{{$level->name}}</label>
                                                        </div>
                                                    </div>
                                                @empty
                                                @endforelse
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label>{{trans('task.table.assign')}}</label>
                                            <div class="ui selection dropdown">
                                                <input type="hidden" name="assign_id"
                                                       value="{{old('assign_id')?old('assign_id'):$data->assign_id}}">
                                                <i class="dropdown icon"></i>
                                                <div class="default text"></div>
                                                <div class="menu">
                                                    @forelse ($members as $member)
                                                        <div class="item" data-value="{{$member->id}}">
                                                            <img class="ui mini avatar image" src="{{$member->avatar}}">
                                                            {{Auth::user()->id==$member->id?$member->name.'（'.trans('common.ext.self').'）':$member->name}}
                                                        </div>
                                                    @empty
                                                    @endforelse
                                                </div>
                                            </div>
                                            @if($errors->first('assign_id'))
                                                <div class="ui visible error message">
                                                    {{$errors->first('assign_id')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="field">
                                            <label>{{trans('task.table.due_date')}}</label>
                                            <input value="{{old('due_date')?old('due_date'):$data->due_date}}"
                                                   type="date"
                                                   name="due_date">
                                            @if($errors->first('due_date'))
                                                <div class="ui visible error message">
                                                    {{$errors->first('due_date')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="field">
                                            <label>{{trans('task.table.tag')}}</label>
                                            @foreach ($tags as $key=>$tag)
                                                <div class="ui checkbox">
                                                    @if(count(old('tag'))>0)
                                                        <input name="tag[]" value="{{$tag->id}}" type="checkbox"
                                                               class="hidden"
                                                                {{count(old('tag'))>0&&in_array($tag->id,old('tag'))?'checked':''}}>
                                                    @else
                                                        <input {{count($data->tags)>0&&in_array($tag->id,$otags)?'checked':''}}
                                                               name="tag[]" type="checkbox" value="{{$tag->id}}">
                                                    @endif
                                                    <label>{{$tag->name}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="ui basic segment">
                                            <button class="mini ui primary button" type="submit">
                                                {{trans('common.button.submit')}}
                                            </button>
                                            <a href="{{route('task.index',['uuid'=>\request()->route('uuid')])}}"
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
