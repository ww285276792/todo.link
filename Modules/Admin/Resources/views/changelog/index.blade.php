@extends('admin.layout.app')

@section('content')
    <div id="content">
        @include('admin.common.message')
        <div class="ui stackable two column grid">
            <div class="column">
                @include('admin.changelog.header')
                <div class="ui breadcrumb">
                    <a href="{{route('admin.dash')}}" class="section">{{trans('common.breadcrumb.console')}}</a>
                    <i class="right chevron icon divider"></i>
                    <a href="{{route('admin_changelog.index')}}" class="section">{{trans('changelog.manage')}}</a>
                    <i class="right chevron icon divider"></i>
                    <div class="active section">{{trans('changelog.name')}}</div>
                </div>
            </div>
            <div class="middle aligned column">
                <a href="{{route('admin_changelog.create')}}" class="ui right floated primary button">
                    <i class="icon plus"></i>
                    {{trans('changelog.add_changelog')}}
                </a>
            </div>
        </div>
        <div class="ui hidden divider"></div>
        @include('admin.changelog.filter')
        <div class="ui hidden divider"></div>
        <div class="ui segment overflow-x-auto">
            <div class="ui two column fluid stackable grid">
                <div class="fourteen wide column">
                    {{$changelogs->links('vendor.pagination.semantic-ui-admin')}}
                </div>
                @include('admin.common.limit',['url'=>route('admin_changelog.index')])
            </div>
            <table class="ui sortable selectable stackable celled table">
                <thead>
                <tr>
                    <th>{{trans('common.table.number')}}</th>
                    <th>{{trans('changelog.table.version')}}</th>
                    <th>{{trans('changelog.table.date')}}</th>
                    <th>{{trans('common.table.created_at')}}</th>
                    <th>{{trans('common.table.manage')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($changelogs as $changelog)
                    <tr class="item">
                        <td>{{$changelog->id}}</td>
                        <td>{{$changelog->version}}</td>
                        <td>{{$changelog->date}}</td>
                        <td>{{$changelog->created_at}}</td>
                        <td>
                            @include('admin.common.action', ['data' => $changelog,'actions'=>['edit','delete'],'route'=>'admin_changelog'])
                        </td>
                    </tr>
                @empty
                    <tr class="item">
                        <td colspan="5"> {{trans('common.null_data')}}</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{$changelogs->links('vendor.pagination.semantic-ui-admin')}}
        </div>
    </div>
    <div class="ui modal">
        <div class="header">
            <i class="icon warning red sign"></i>
            {{trans('changelog.delete_changelog')}}
        </div>
        <div class="content">
            <p>{{trans('changelog.confirm_delete_changelog')}}</p>
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
