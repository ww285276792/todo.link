@extends('web::layout.app')

@section('title')
    {{trans('module.title.index')}}
@endsection

@section('content')
    <div class="module">
        <div class="ui container content">
            @include('web::common.message')
            <div class="ui stackable grid">
                <div class="sixteen wide column">
                    <div class="ui segment">
                        <div class="ui two column stackable grid">
                            @include('web::common.task_menu')
                            <div class="thirteen wide column">
                                <a href="{{route('setting_module.create',['uuid'=>\request()->route('uuid')])}}"
                                   class="mini ui teal button">
                                    {{trans('module.button.create')}}
                                </a>
                                <br><br>
                                <div class="ui overflow-x-auto">
                                    <table class="ui small sortable selectable stackable celled table">
                                        <thead>
                                        <tr>
                                            <th>{{trans('module.table.name')}}</th>
                                            <th width="20%">{{trans('common.table.created_at')}}</th>
                                            <th width="20%">{{trans('common.table.action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse ($data as $item)
                                            <tr class="item">
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->created_at}}</td>
                                                <td>
                                                    <div class="ui mini basic icon buttons">
                                                        <a href="{{route('setting_module.edit',['uuid'=>\request()->route('uuid'),'id'=>$item->id])}}"
                                                           title="{{trans('common.button.edit')}}" class="ui button">
                                                            <i class="edit outline icon"></i>
                                                        </a>
                                                        <a title="{{trans('common.button.delete')}}"
                                                           onclick="del({{$item->id}});" class="ui button">
                                                            <i class="fa fa-trash-o"></i>
                                                        </a>
                                                        <form id="delete-form-{{$item->id}}"
                                                              action="{{route('setting_module.destroy',['uuid'=>\request()->route('uuid'),'id'=>$item->id])}}"
                                                              method="POST"
                                                              style="display: none;">
                                                            {{ csrf_field() }}
                                                            {{method_field('DELETE')}}
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
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
