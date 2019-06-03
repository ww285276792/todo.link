<div class="three wide column" style="min-height: 40rem;">
    <div class="ui vertical menu" style="width: auto;">
        <a href="{{route('user_setting.edit')}}"
           class="item {{str_contains(Route::currentRouteName(),'user_setting')?'active':''}}">
            基本资料
        </a>
        <a href="{{route('user_password.reset')}}"
           class="item {{str_contains(Route::currentRouteName(),'user_password')?'active':''}}">
            修改密码
        </a>
    </div>
</div>
