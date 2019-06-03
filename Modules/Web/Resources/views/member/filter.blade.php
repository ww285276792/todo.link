<div class="ui styled fluid accordion">
    <div class="title active">
        <i class="dropdown icon"></i>
        {{trans('member.search.title')}}
    </div>
    <div class="content active">
        <form id="search-form" class="ui mini loadable form" method="get"
              action="{{route('member.index',['uuid'=>\request()->route('uuid')])}}">
            <div class="two fields">
                <div class="field">
                    <label>{{trans('member.table.name')}}</label>
                    <input type="text" name="search[name]" value="{{Request::get('search')['name']}}">
                </div>
                <div class="field">
                    <label>{{trans('member.table.email')}}</label>
                    <input type="text" name="search[email]" value="{{Request::get('search')['email']}}">
                </div>
            </div>
            <button class="mini ui blue button" type="submit">
                {{trans('common.button.search')}}
            </button>
            <a href="{{route('member.index',['uuid'=>\request()->route('uuid')])}}" class="mini ui button">
                {{trans('common.button.clear_search')}}
            </a>
        </form>
    </div>
</div>
