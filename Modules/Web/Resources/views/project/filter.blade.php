<div class="column">
    <form method="get" action="{{route('project.index')}}" class="ui mini form">
        <div class="ui action left icon input">
            <i class="search icon"></i>
            <input name="name" value="{{Request::get('name')}}" type="text"
                   placeholder="{{trans('project.search.placeholder')}}">
            <button type="submit" class="mini ui teal button">{{trans('project.button.search')}}</button>
        </div>
    </form>
</div>
