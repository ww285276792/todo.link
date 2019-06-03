@extends('web::layout.app')

@section('title')
    {{trans('progress.title.index')}}
@endsection

@section('content')
    <div class="progress">
        <div class="ui container content">
            <div class="ui stackable grid">
                <div class="sixteen wide column">
                    <div class="ui segment">
                        <div class="ui two column stackable grid">
                            @include('web::common.task_menu')
                            <div class="thirteen wide column">
                                <div class="ui center aligned container">
                                    {{trans('progress.note.header_msg',['total'=>$taskCount,'finished'=>$taskFinishedCount])}}
                                </div>
                                <div class="ui top attached tabular menu">
                                    <a class="item active" data-tab="first">
                                        {{trans('progress.title.module')}}
                                    </a>
                                    <a class="item" data-tab="second">
                                        {{trans('progress.title.member')}}
                                    </a>
                                </div>
                                <div class="ui bottom attached tab segment active" data-tab="first">
                                    <table class="ui very basic table">
                                        <tbody>
                                        @forelse ($modules as $module)
                                            <tr>
                                                <td width="12%">
                                                    <a href="{{route('task.index',['uuid'=>\request()->route('uuid'),'module_id'=>$module->id])}}">
                                                        {{$module->name}}
                                                    </a>
                                                </td>
                                                <td width="10%">
                                                    {{$module->task_finished_count}}
                                                    /
                                                    {{$module->task_total_count}}
                                                </td>
                                                <td>
                                                    <div class="ui orange progress"
                                                         data-percent="{{$module->task_total_count>0?($module->task_finished_count/$module->task_total_count)*100:''}}">
                                                        <div class="bar">
                                                            <div class="progress">
                                                                @if($module->task_finished_count==0)
                                                                    0%
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="ui bottom attached tab segment" data-tab="second">
                                    <table class="ui very basic table">
                                        <tbody>
                                        @forelse ($users as $user)
                                            <tr>
                                                <td width="20%">
                                                    <a href="{{route('task.index',['uuid'=>\request()->route('uuid'),'assign_id'=>$user->id])}}">
                                                        <img class="ui mini avatar image" src="{{$user->avatar}}">
                                                        {{$user->name}}
                                                    </a>
                                                </td>
                                                <td width="10%">
                                                    {{$user->task_finished_count}}
                                                    /
                                                    {{$user->task_total_count}}
                                                </td>
                                                <td>
                                                    <div class="ui orange progress"
                                                         data-percent="{{$user->task_total_count>0?($user->task_finished_count/$user->task_total_count)*100:''}}">
                                                        <div class="bar">
                                                            <div class="progress">
                                                                @if($user->task_finished_count==0)
                                                                    0%
                                                                @endif
                                                            </div>
                                                        </div>
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
@endsection
