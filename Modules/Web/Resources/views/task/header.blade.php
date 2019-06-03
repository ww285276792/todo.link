<tr>
    <th>{{trans('task.table.title')}}</th>
    <th>
        <a href="{{route('task.index',
        array_merge(request()->input(),['uuid'=>\request()->route('uuid'),'sorting'=>['name'=>'status','desc'=>Request::get('sorting')['desc']=='desc'?'asc':'desc']]))}}">
            {{trans('task.table.status')}}
            @if (Request::get('sorting')['name'] === 'status')
                @if (Request::get('sorting')['desc'] === 'desc')
                    <i class="sort descending icon"></i>
                @else
                    <i class="sort ascending icon"></i>
                @endif
            @else
                <i class="sort icon"></i>
            @endif
        </a>
    </th>
    <th>{{trans('task.table.module')}}</th>
    <th width="5%">
        <a href="{{route('task.index',
        array_merge(request()->input(),['uuid'=>\request()->route('uuid'),'sorting'=>['name'=>'level_id','desc'=>Request::get('sorting')['desc']=='desc'?'asc':'desc']]))}}">
            {{trans('task.table.level')}}
            @if (Request::get('sorting')['name'] === 'level_id')
                @if (Request::get('sorting')['desc'] === 'desc')
                    <i class="sort descending icon"></i>
                @else
                    <i class="sort ascending icon"></i>
                @endif
            @else
                <i class="sort icon"></i>
            @endif
        </a>
    </th>
    <th>{{trans('task.table.assign')}}</th>
    <th>
        <a href="{{route('task.index',
        array_merge(request()->input(),['uuid'=>\request()->route('uuid'),'sorting'=>['name'=>'due_date','desc'=>Request::get('sorting')['desc']=='desc'?'asc':'desc']]))}}">
            {{trans('task.table.due_date')}}
            @if (Request::get('sorting')['name'] === 'due_date')
                @if (Request::get('sorting')['desc'] === 'desc')
                    <i class="sort descending icon"></i>
                @else
                    <i class="sort ascending icon"></i>
                @endif
            @else
                <i class="sort icon"></i>
            @endif
        </a>
    </th>
    <th width="10%">{{trans('common.table.action')}}</th>
</tr>