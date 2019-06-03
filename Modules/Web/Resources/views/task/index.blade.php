@extends('web::layout.app')

@section('title')
    {{trans('task.title.index')}}
@endsection

@section('style')
    <style>
        .finished-icon {
            color: #00b5ad;
        }

        .postponed-span {
            color: red;
        }

        .finished-span {
            color: #00b5ad;
        }
    </style>
@endsection

@section('content')
    <div class="task">
        <div class="ui container content">
            @include('web::common.message')
            <div class="ui stackable grid">
                <div class="sixteen wide column">
                    <div class="ui segment">
                        <div class="ui two column stackable grid">
                            @include('web::common.task_menu')
                            <div class="thirteen wide column">
                                @can('create_tasks'.$pid)
                                    <a href="{{route('task.create',['uuid'=>\request()->route('uuid')])}}"
                                       class="mini ui teal button">
                                        {{trans('task.button.create')}}
                                    </a>
                                    <br><br>
                                @endcan
                                @include('web::task.filter')
                                <br>
                                <div class="ui overflow-x-auto">
                                    <table class="ui small sortable selectable stackable celled table">
                                        <thead>
                                        @include('web::task.header')
                                        </thead>
                                        <tbody>
                                        @forelse ($data as $item)
                                            <tr class="item">
                                                <td width="25%">
                                                    <a href="{{route('task.edit',['uuid'=>\request()->route('uuid'),'id'=>$item->id])}}">
                                                        @if ($item->status === 'finished')
                                                            <span class="finished-span">
                                                                (
                                                                {{$item->finishUser->name}},
                                                                {{\Carbon\Carbon::parse($item->finish_datetime)->format('m月d日')}}
                                                                )
                                                            </span>
                                                        @else
                                                            @if ($item->due_date && $item->due_date < date('Y-m-d'))
                                                                <span class="postponed-span">({{trans('task.status.postponed')}}
                                                                    )</span>
                                                            @endif
                                                        @endif
                                                        {{$item->title}}
                                                    </a>
                                                </td>
                                                <td>
                                                    @if ($item->status === 'open')
                                                        <span class="ui yellow label">
                                                            {{trans('task.status.open')}}
                                                        </span>
                                                    @elseif ($item->status === 'finished')
                                                        <span class="ui teal label">
                                                            {{trans('task.status.finished')}}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>{{$item->module?$item->module->name:''}}</td>
                                                <td width="5%">
                                                    {{$item->level?$item->level->name:''}}
                                                </td>
                                                <td>
                                                    {{$item->assignUser?$item->assignUser->name:''}}
                                                </td>
                                                <td width="15%">{{$item->due_date}}</td>
                                                <td>
                                                    <div class="ui mini basic icon buttons">
                                                        @can('set_status_tasks'.$pid)
                                                            @if ($item->status === 'open')
                                                                <a href="{{route('task.set_status',['uuid'=>\request()->route('uuid'),'status'=>'finished','id'=>$item->id])}}"
                                                                   title="{{trans('task.button.finish')}}"
                                                                   class="ui button">
                                                                    <i class="check circle outline icon"></i>
                                                                </a>
                                                            @endif
                                                            @if ($item->status === 'finished')
                                                                <a href="{{route('task.set_status',['uuid'=>\request()->route('uuid'),'status'=>'open','id'=>$item->id])}}"
                                                                   title="{{trans('task.button.open')}}"
                                                                   class="ui button">
                                                                    <i class="check circle icon finished-icon"></i>
                                                                </a>
                                                            @endif
                                                        @endcan
                                                        @can('update_tasks'.$pid)
                                                            <a href="{{route('task.edit',['uuid'=>\request()->route('uuid'),'id'=>$item->id])}}"
                                                               title="{{trans('common.button.edit')}}"
                                                               class="ui button">
                                                                <i class="edit outline icon"></i>
                                                            </a>
                                                        @endcan
                                                        @can('delete_tasks'.$pid)
                                                            <a title="{{trans('common.button.delete')}}"
                                                               onclick="del({{$item->id}});" class="ui button">
                                                                <i class="fa fa-trash-o"></i>
                                                            </a>
                                                            <form id="delete-form-{{$item->id}}"
                                                                  action="{{route('task.destroy',['uuid'=>\request()->route('uuid'),'id'=>$item->id])}}"
                                                                  method="POST"
                                                                  style="display: none;">
                                                                {{ csrf_field() }}
                                                                {{method_field('DELETE')}}
                                                            </form>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                        </tbody>
                                    </table>
                                    <div class="ui two column fluid stackable grid">
                                        @if ($data->hasPages())
                                            <div class="fourteen wide column">
                                                {{$data->links('vendor.pagination.semantic-ui-admin')}}
                                            </div>
                                            @include('web::common.limit',['url'=>route('task.index',['uuid'=>\request()->route('uuid')])])
                                        @endif
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ui mini modal" id="delete-modal">
        <div class="header">
            <i class="icon warning red sign"></i>
            {{trans('common.modal.delete_message')}}
        </div>
        <div class="content">
            <p>{{trans('common.modal.confirm_delete_message')}}</p>
        </div>
        <div class="actions">
            <div class="ui mini positive button">{{trans('common.button.confirm')}}</div>
            <div class="ui mini deny button">{{trans('common.button.cancle')}}</div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function del(id) {
            $('#delete-modal')
                .modal({
                    closable: true,
                    onDeny: function () {
                    },
                    onApprove: function () {
                        document.getElementById('delete-form-' + id).submit();
                    }
                })
                .modal('show')
            ;
        }
    </script>
@endsection
