@extends('web::layout.app')

@section('title')
    {{trans('log.title.index')}}
@endsection

@section('content')
    <div class="log">
        <div class="ui container content">
            @include('web::common.message')
            <div class="ui stackable grid">
                <div class="sixteen wide column">
                    <div class="ui segment">
                        <div class="ui two column stackable grid">
                            @include('web::common.task_menu')
                            <div class="thirteen wide column">
                                @include('web::log.filter')
                                <br>
                                <div class="ui overflow-x-auto">
                                    <table class="ui unstackable table">
                                        <tbody>
                                        @forelse ($data as $item)
                                            <tr>
                                                <td>
                                                    <div class="ui feed">
                                                        <div class="event">
                                                            <div class="label">
                                                                <img src="{{$item->causer->avatar}}">
                                                            </div>
                                                            <div class="content">
                                                                <div class="date">
                                                                    {{$item->created_at->format('Y-m-d')}}
                                                                </div>
                                                                <div class="summary">
                                                                    {{$item->description}}
                                                                </div>
                                                            </div>
                                                        </div>
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
                                            @include('web::common.limit',['url'=>route('project_log.index',['uuid'=>\request()->route('uuid')])])
                                        @endif
                                    </div>
                                    <br><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
