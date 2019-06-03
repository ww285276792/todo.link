@inject('project', 'Modules\Project\Services\ProjectService')

<div class="three wide column" style="min-height: 40rem;">
    <div class="ui vertical menu" style="width: auto;">
        @can('show_dashboard'.$pid)
            <a href="{{route('project_dashboard.index',['uuid'=>\request()->route('uuid')])}}"
               class="item {{str_contains(Route::currentRouteName(),'project_dashboard')?'active':''}}">
                {{trans('menu.web.dashboard')}}
            </a>
        @endcan
        @can('list_tasks'.$pid)
            <a href="{{route('task.index',['uuid'=>\request()->route('uuid')])}}"
               class="item {{str_contains(Route::currentRouteName(),'task')?'active':''}}">
                {{trans('menu.web.tasks')}}
                <div class="ui yellow label">{{$project->getTaskCount()}}</div>
            </a>
        @endcan
        @can('list_logs'.$pid)
            <a href="{{route('project_log.index',['uuid'=>\request()->route('uuid')])}}"
               class="item {{str_contains(Route::currentRouteName(),'project_log')?'active':''}}">
                {{trans('menu.web.logs')}}
            </a>
        @endcan
        @can('list_progress'.$pid)
            <a href="{{route('project_progress.index',['uuid'=>\request()->route('uuid')])}}"
               class="item {{str_contains(Route::currentRouteName(),'project_progress')?'active':''}}">
                {{trans('menu.web.progress')}}
            </a>
        @endcan
        @can('list_members'.$pid)
            <a href="{{route('member.index',['uuid'=>\request()->route('uuid')])}}"
               class="item {{str_contains(Route::currentRouteName(),'member')?'active':''}}">
                {{trans('menu.web.members')}}
            </a>
        @endcan
        <div class="ui dropdown item">
            {{trans('menu.web.setting')}}
            <i class="dropdown icon"></i>
            <div class="menu">
                @can('update_settings'.$pid)
                    <a href="{{route('setting.edit',['uuid'=>\request()->route('uuid')])}}"
                       class="item {{str_contains(Route::currentRouteName(),'setting.edit')?'active':''}}">
                        {{trans('menu.web.setting')}}
                    </a>
                @endcan
                @can('list_modules'.$pid)
                    <a href="{{route('setting_module.index',['uuid'=>\request()->route('uuid')])}}"
                       class="item {{str_contains(Route::currentRouteName(),'setting_module')?'active':''}}">
                        {{trans('menu.web.modules')}}
                    </a>
                @endcan
                @can('list_tags'.$pid)
                    <a href="{{route('setting_tag.index',['uuid'=>\request()->route('uuid')])}}"
                       class="item {{str_contains(Route::currentRouteName(),'setting_tag')?'active':''}}">
                        {{trans('menu.web.tags')}}
                    </a>
                @endcan
            </div>
        </div>
    </div>
</div>
