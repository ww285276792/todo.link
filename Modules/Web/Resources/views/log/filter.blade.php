<div class="ui styled fluid accordion">
    <div class="title active">
        <i class="dropdown icon"></i>
        {{trans('log.search.title')}}
    </div>
    <div class="content active">
        <form id="search-form" class="ui mini loadable form" method="get"
              action="{{route('project_log.index',['uuid'=>\request()->route('uuid')])}}">
            <div class="three fields">
                <div class="field">
                    <label>{{trans('log.table.member')}}</label>
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
            </div>
            <button class="mini ui blue button" type="submit">
                {{trans('common.button.search')}}
            </button>
            <a href="{{route('project_log.index',['uuid'=>\request()->route('uuid')])}}" class="mini ui button">
                {{trans('common.button.clear_search')}}
            </a>
        </form>
    </div>
</div>
