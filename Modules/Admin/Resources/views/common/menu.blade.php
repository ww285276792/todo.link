<div class="item">
    <div>{{trans('admin_menu.manage_tag')}}</div>
    <div class="menu">
        <a class="item {{str_contains(Route::currentRouteName(),'admin_tag')?'active':''}}"
           href="{{route('admin_tag.index')}}">
            <i class="icon tags"></i>
            {{trans('admin_menu.tag')}}
        </a>
    </div>
</div>
