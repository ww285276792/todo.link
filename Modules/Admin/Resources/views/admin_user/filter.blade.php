<div class="ui styled fluid accordion">
    <div class="title active">
        <i class="dropdown icon"></i>
        {{trans('common.filter')}}
    </div>
    <div class="content active">
        <form id="search-form" method="get" action="{{route('admin_user.index')}}" class="ui loadable form">
            <div class="two fields">
                <div class="field">
                    <label>{{trans('admin_user.table.name')}}</label>
                    <input type="text" name="name" value="{{Request::get('name')}}">
                </div>
                <div class="field">
                    <label>{{trans('admin_user.table.email')}}</label>
                    <input type="text" name="email" value="{{Request::get('email')}}">
                </div>
            </div>
            <div class="two fields">
                <div class="field">
                    <label>{{trans('admin_role.name')}}</label>
                    <select name="role_id" class="ui fluid dropdown">
                        <option value="">{{trans('admin_role.name')}}</option>
                        @foreach ($roles as $role)
                            <option value="{{$role->id}}" {{Request::get('role_id')==$role->id?'selected':''}}>
                                {{$role->display_name}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="two fields"></div>
            <button onclick="event.preventDefault(); document.getElementById('search-form').submit();"
                    class="ui blue button" type="submit">
                <i class="icon search"></i>
                {{trans('common.button.search')}}
            </button>
            <a class="ui button" href="{{route('admin_user.index')}}">
                <i class="icon remove"></i>
                {{trans('common.button.clear_search')}}
            </a>
        </form>
    </div>
</div>
