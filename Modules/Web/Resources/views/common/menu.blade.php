@inject('project', 'Modules\Project\Services\ProjectService')

<div class="ui teal borderless inverted menu nav">
    <div class="ui container">
        <div class="ui dropdown item">
            <a href="{{route('project_dashboard.index',['uuid'=>\request()->route('uuid')])}}">
                {{$project->getProjectName()}}
            </a>
            @if($project->getProjectName())
                <i class="dropdown icon"></i>
            @endif
            <div class="menu">
                @forelse ($project->getOtherProject() as $item)
                    <a href="{{route('project_dashboard.index',['uuid'=>$item->uuid])}}" class="item">
                        {{$item->name}}
                    </a>
                @empty
                @endforelse
            </div>
        </div>
        <div class="right menu">
            @guest
            <a href="{{route('login')}}" class="item">{{trans('auth.login')}}</a>
            @else
                <div class="ui dropdown item">
                    <img width="35" class="ui circular  image" src="{{Auth::user()->avatar}}">
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <a href="{{route('user_setting.edit')}}" class="item">
                            {{trans('menu.web.user_setting')}}
                        </a>
                        <a href="{{route('project.index')}}" class="item">
                            {{trans('menu.web.projects')}}
                        </a>
                        <a onclick="logout()" class="item">{{trans('menu.web.logout')}}</a>
                    </div>
                    <form class="logoutform" action="{{ route('logout') }}" method="POST">
                        {{ csrf_field() }}
                    </form>
                </div>
                @endguest
        </div>
    </div>
</div>
