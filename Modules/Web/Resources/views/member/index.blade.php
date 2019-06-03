@extends('web::layout.app')

@section('title')
    {{trans('member.title.index')}}
@endsection

@section('content')
    <div class="member">
        <div class="ui container content">
            @include('web::common.message')
            <div class="ui stackable grid">
                <div class="sixteen wide column">
                    <div class="ui segment">
                        <div class="ui two column stackable grid">
                            @include('web::common.task_menu')
                            <div class="thirteen wide column">
                                @can('invite_members'.$pid)
                                    <a href="{{route('member.invite',['uuid'=>\request()->route('uuid')])}}"
                                       class="mini ui teal button">
                                        {{trans('member.button.invite')}}
                                    </a>
                                    <br><br>
                                @endcan
                                @include('web::member.filter')
                                <br>
                                <div class="ui overflow-x-auto">
                                    <table class="ui small sortable selectable stackable celled table">
                                        <thead>
                                        <tr>
                                            <th>{{trans('member.table.name')}}</th>
                                            <th>{{trans('member.table.email')}}</th>
                                            <th>{{trans('member.table.role')}}</th>
                                            <th width="20%">{{trans('common.table.action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse ($data as $item)
                                            <tr class="item">
                                                <td>
                                                    <img class="ui avatar image" src="{{$item->avatar}}">
                                                    <span>{{$item->name}}</span>
                                                </td>
                                                <td>{{$item->email}}</td>
                                                <td>
                                                    {{$item->roles[0]['description']}}
                                                </td>
                                                <td>
                                                    <div class="ui mini basic icon buttons">
                                                        @can('update_members'.$pid)
                                                            <a href="{{route('member.role_edit',['uuid'=>\request()->route('uuid'),'id'=>$item->id])}}"
                                                               title="{{trans('common.button.edit')}}"
                                                               class="ui button">
                                                                <i class="edit outline icon"></i>
                                                            </a>
                                                        @endcan
                                                        @can('delete_members'.$pid)
                                                            <a title="{{trans('common.button.delete')}}"
                                                               onclick="del({{$item->id}});" class="ui button">
                                                                <i class="fa fa-trash-o"></i>
                                                            </a>
                                                            <form id="delete-form-{{$item->id}}"
                                                                  action="{{route('member.destroy',['uuid'=>\request()->route('uuid'),'id'=>$item->id])}}"
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
                                            @include('web::common.limit',['url'=>route('member.index',['uuid'=>\request()->route('uuid')])])
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ui mini modal">
        <div class="header">
            <i class="icon warning red sign"></i>
            {{trans('member.modal.remove_message')}}
        </div>
        <div class="content">
            <p>{{trans('member.modal.confirm_remove_message')}}</p>
        </div>
        <div class="actions">
            <div class="ui mini positive button">{{trans('common.button.confirm')}}</div>
            <div class="ui mini deny button">{{trans('common.button.cancle')}}</div>
        </div>
    </div>
    <div class="ui mini modal delete-modal" id="delete-modal">
        <div class="header">
            <i class="icon warning red sign"></i>
            {{trans('member.modal.remove_message')}}
        </div>
        <div class="content">
            <p>{{trans('member.modal.confirm_remove_message')}}</p>
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
