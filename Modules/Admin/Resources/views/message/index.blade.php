@extends('admin.layout.app')

@section('content')
    <div id="content">
        @include('admin.common.message')
        <div class="ui stackable two column grid">
            <div class="column">
                @include('admin.message.header')
                <div class="ui breadcrumb">
                    <a href="{{route('admin.dash')}}" class="section">{{trans('common.breadcrumb.console')}}</a>
                    <i class="right chevron icon divider"></i>
                    <a href="{{route('admin_message.index')}}" class="section">
                        {{trans('message.manage')}}
                    </a>
                    <i class="right chevron icon divider"></i>
                    <div class="active section">{{trans('message.name')}}</div>
                </div>
            </div>
        </div>
        <div class="ui hidden divider"></div>
        @include('admin.message.filter')
        <div class="ui hidden divider"></div>
        <div class="ui segment overflow-x-auto">
            <div class="ui two column fluid stackable grid">
                <div class="fourteen wide column">
                    {{$messages->links('vendor.pagination.semantic-ui-admin')}}
                </div>
                @include('admin.common.limit',['url'=>route('admin_message.index')])
            </div>
            <table class="ui sortable selectable stackable celled table">
                <thead>
                <tr>
                    <th>{{trans('common.table.number')}}</th>
                    <th>{{trans('message.table.user')}}</th>
                    <th>{{trans('message.table.content')}}</th>
                    <th>{{trans('common.table.created_at')}}</th>
                    <th>{{trans('common.table.manage')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($messages as $message)
                    <tr class="item">
                        <td>{{$message->id}}</td>
                        <td>{{$message->user->name}}</td>
                        <td>{!! $message->content !!}</td>
                        <td>{{$message->created_at}}</td>
                        <td>
                            @include('admin.common.action', ['data' => $message,'actions'=>['delete'],'route'=>'admin_message'])
                        </td>
                    </tr>
                @empty
                    <tr class="item">
                        <td colspan="5"> {{trans('common.null_data')}}</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{$messages->links('vendor.pagination.semantic-ui-admin')}}
        </div>
    </div>
    <div class="ui modal">
        <div class="header">
            <i class="icon warning red sign"></i>
            {{trans('message.delete_message')}}
        </div>
        <div class="content">
            <p>{{trans('message.confirm_delete_message')}}</p>
        </div>
        <div class="actions">
            <div class="ui negative button">{{trans('common.button.cancle')}}</div>
            <div class="ui positive button">{{trans('common.button.confirm')}}</div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function del(id) {
            $('.modal')
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
