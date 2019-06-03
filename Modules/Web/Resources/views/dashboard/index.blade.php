@extends('web::layout.app')

@section('title')
    {{trans('dashboard.title.index')}}
@endsection

@section('content')
    <div class="dashboard">
        <div class="ui container content">
            <div class="ui stackable grid">
                <div class="sixteen wide column">
                    <div class="ui segment">
                        <div class="ui two column stackable grid">
                            @include('web::common.task_menu')
                            <div class="thirteen wide column">
                                <div class="ui segment">
                                    <div class="ui stackable five column grid">
                                        <div class="column">
                                            <a href="{{route('task.index',['uuid'=>\request()->route('uuid')])}}"
                                               class="ui fluid card">
                                                <div class="content">
                                                    <div class="center aligned header">
                                                        {{$taskFinishedCount}}
                                                        /
                                                        {{$taskCount}}
                                                    </div>
                                                    <div class="center aligned description">
                                                        {{trans('dashboard.title.task_total')}}
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="column">
                                            <a href="{{route('task.index',['uuid'=>\request()->route('uuid'),'search[status]'=>'postponed'])}}"
                                               class="ui fluid card">
                                                <div class="content">
                                                    <div class="center aligned header">
                                                        {{$taskPostponedCount}}
                                                    </div>
                                                    <div class="center aligned description">
                                                        {{trans('dashboard.title.postponed_task_total')}}
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="column">
                                            <a href="{{route('task.index',['uuid'=>\request()->route('uuid'),'search[assign_id]'=>$userId])}}"
                                               class="ui fluid card">
                                                <div class="content">
                                                    <div class="center aligned header">
                                                        {{$selfTaskFinishedCount}}
                                                        /
                                                        {{$selfTaskCount}}
                                                    </div>
                                                    <div class="center aligned description">
                                                        {{trans('dashboard.title.self_task_total')}}
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="column">
                                            <a href="{{route('member.index',['uuid'=>\request()->route('uuid')])}}"
                                               class="ui fluid card">
                                                <div class="content">
                                                    <div class="center aligned header">
                                                        {{$memberCount}}
                                                    </div>
                                                    <div class="center aligned description">
                                                        {{trans('dashboard.title.member')}}
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ui grid">
                                        <div class="eight wide column">
                                            <table class="ui small selectable unstackable table">
                                                <thead>
                                                <tr>
                                                    <th>{{trans('dashboard.title.latest_task')}}</th>
                                                    <th width="20%" class="right aligned">
                                                        <a href="{{route('task.index',['uuid'=>\request()->route('uuid')])}}">
                                                            {{trans('dashboard.title.more')}}
                                                        </a>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse ($tasks as $task)
                                                    <tr>
                                                        <td>
                                                            <a href="{{route('task.edit',['uuid'=>\request()->route('uuid'),'id'=>$task->id])}}">
                                                                {{$task->title}}
                                                            </a>
                                                        </td>
                                                        <td class="right aligned">
                                                            {{$task->assignUser?$task->assignUser->name:''}}
                                                        </td>
                                                    </tr>
                                                @empty
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="eight wide column">
                                            <table class="ui small selectable unstackable table">
                                                <thead>
                                                <tr>
                                                    <th>{{trans('dashboard.title.latest_log')}}</th>
                                                    <th class="right aligned">
                                                        <a href="{{route('project_log.index',['uuid'=>\request()->route('uuid')])}}">
                                                            {{trans('dashboard.title.more')}}
                                                        </a>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse ($logs as $log)
                                                    <tr>
                                                        <td colspan="2">
                                                            {{$log->description}}
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
        </div>
    </div>
@endsection
