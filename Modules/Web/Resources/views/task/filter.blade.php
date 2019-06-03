<div class="ui styled fluid accordion">
    <div class="title active">
        <i class="dropdown icon"></i>
        {{trans('task.search.title')}}
    </div>
    <div class="content active">
        <form id="search-form" class="ui mini loadable form" method="get"
              action="{{route('task.index',['uuid'=>\request()->route('uuid')])}}">
            <div class="four fields">
                <div class="field">
                    <label>{{trans('task.table.title')}}</label>
                    <input type="text" name="title" value="{{Request::get('title')}}">
                </div>
                <div class="field">
                    <label>{{trans('task.table.status')}}</label>
                    <div class="ui selection dropdown">
                        <input type="hidden" name="status" value="{{Request::get('status')}}">
                        <i class="dropdown icon"></i>
                        <div class="default text"></div>
                        <div class="menu">
                            <div class="item" data-value="">
                                {{trans('common.ext.all')}}
                            </div>
                            <div class="item" data-value="open">
                                {{trans('task.status.open')}}
                            </div>
                            <div class="item" data-value="finished">
                                {{trans('task.status.finished')}}
                            </div>
                            <div class="item" data-value="postponed">
                                {{trans('task.status.postponed')}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label>{{trans('task.table.module')}}</label>
                    <div class="ui selection dropdown">
                        <input type="hidden" name="module_id" value="{{Request::get('module_id')}}">
                        <i class="dropdown icon"></i>
                        <div class="default text"></div>
                        <div class="menu">
                            <div class="item" data-value="">
                                {{trans('common.ext.all')}}
                            </div>
                            @forelse ($modules as $module)
                                <div class="item" data-value="{{$module->id}}">
                                    {{$module->name}}
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label>{{trans('task.table.level')}}</label>
                    <div class="ui selection dropdown">
                        <input type="hidden" name="level_id" value="{{Request::get('level_id')}}">
                        <i class="dropdown icon"></i>
                        <div class="default text"></div>
                        <div class="menu">
                            <div class="item" data-value="">
                                {{trans('common.ext.all')}}
                            </div>
                            @forelse ($levels as $level)
                                <div class="item" data-value="{{$level->id}}">
                                    {{$level->name}}
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="four fields">
                <div class="field">
                    <label>{{trans('task.table.assign')}}</label>
                    <div class="ui selection dropdown">
                        <input type="hidden" name="assign_id" value="{{Request::get('assign_id')}}">
                        <i class="dropdown icon"></i>
                        <div class="default text"></div>
                        <div class="menu">
                            <div class="item" data-value="">
                                {{trans('common.ext.all')}}
                            </div>
                            @forelse ($members as $member)
                                <div class="item" data-value="{{$member->id}}">
                                    <img class="ui mini avatar image" src="{{$member->avatar}}">
                                    {{Auth::user()->id==$member->id?$member->name.'（'.trans('common.ext.self').'）':$member->name}}
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label class="required">{{trans('task.table.tag')}}</label>
                    <div class="ui fluid multiple search selection dropdown">
                        <input type="hidden" name="tags" value="{{Request::get('tags')}}">
                        <i class="dropdown icon"></i>
                        <input class="search" autocomplete="off" tabindex="0" style="width: 5px;">
                        <span class="sizer" style=""></span>
                        <div class="default text"></div>
                        <div class="menu transition hidden" tabindex="-1">
                            @forelse ($tags as $tag)
                                <div class="item selected" data-value="{{$tag->id}}" data-text="{{$tag->name}}">
                                    {{$tag->name}}
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label class="required">{{trans('task.table.due_date')}}</label>
                    <input type="date" name="due_date" value="{{Request::get('due_date')}}">
                </div>
            </div>
            <button class="mini ui blue button" type="submit">
                {{trans('common.button.search')}}
            </button>
            <a href="{{route('task.index',['uuid'=>\request()->route('uuid')])}}" class="mini ui button">
                {{trans('common.button.clear_search')}}
            </a>
        </form>
    </div>
</div>
