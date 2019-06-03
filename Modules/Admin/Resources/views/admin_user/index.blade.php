@extends('admin.layout.app')

@section('content')
    <div id="content">
        @include('admin.common.message')
        <div class="ui stackable two column grid">
            <div class="column">
                @include('admin.admin_user.header')
                <div class="ui breadcrumb">
                    <a href="{{route('admin.dash')}}" class="section">{{trans('common.breadcrumb.console')}}</a>
                    <i class="right chevron icon divider"></i>
                    <a href="{{route('admin_user.index')}}" class="section">{{trans('admin_user.manage')}}</a>
                    <i class="right chevron icon divider"></i>
                    <div class="active section">{{trans('admin_user.name')}}</div>
                </div>
            </div>
            <div class="middle aligned column">
                <a href="{{route('admin_user.create')}}" class="ui right floated primary button">
                    <i class="icon plus"></i>
                    {{trans('admin_user.add_user')}}
                </a>
            </div>
        </div>
        <div class="ui hidden divider"></div>
        @include('admin.admin_user.filter')
        <div class="ui hidden divider"></div>
        <div class="ui segment overflow-x-auto">
            <div class="ui two column fluid stackable grid">
                <div class="fourteen wide column">
                    {{$users->links('vendor.pagination.semantic-ui-admin')}}
                </div>
                @include('admin.common.limit',['url'=>route('admin_user.index')])
            </div>
            <table class="ui sortable selectable stackable celled table">
                <thead>
                <tr>
                    <th>{{trans('common.table.number')}}</th>
                    <th>{{trans('admin_user.table.name')}}</th>
                    <th>{{trans('admin_user.table.email')}}</th>
                    <th>{{trans('common.table.created_at')}}</th>
                    <th>{{trans('common.table.manage')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($users as $user)
                    <tr class="item">
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>
                            @include('admin.common.action', ['data' => $user,'actions'=>['edit','delete'],'route'=>'admin_user'])
                        </td>
                    </tr>
                @empty
                    <tr class="item">
                        <td colspan="5"> {{trans('common.null_data')}}</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{$users->links('vendor.pagination.semantic-ui-admin')}}
        </div>
    </div>
    <div class="ui modal">
        <div class="header">
            <i class="icon warning red sign"></i>
            {{trans('admin_user.delete_user')}}
        </div>
        <div class="content">
            <p>{{trans('admin_user.confirm_delete_user')}}</p>
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
