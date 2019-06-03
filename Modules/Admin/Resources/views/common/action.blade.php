@foreach ($actions as $action)
    @if ($action == 'edit')
        <a class="ui primary button" href="{{route($route.'.edit',['id'=>$data->id])}}">
            <i class="icon pencil"></i>
            {{trans('core::common.manage.edit')}}
        </a>
    @endif
    @if ($action == 'delete')
        <a class="ui red button" tabindex="0" onclick="del({{$data->id}});">
            <i class="icon trash"></i>
            {{trans('core::common.manage.delete')}}
        </a>
        <form id="delete-form-{{$data->id}}"
              action="{{route($route.'.destroy',['id'=>$data->id])}}" method="POST"
              style="display: none;">
            {{ csrf_field() }}
            {{method_field('DELETE')}}
        </form>
    @endif
@endforeach
