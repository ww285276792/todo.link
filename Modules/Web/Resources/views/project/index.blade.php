@extends('web::layout.app')

@section('title')
    {{trans('project.title.index')}}
@endsection

@section('content')
    <div class="home">
        <div class="ui container content">
            @include('web::common.message')
            <div class="ui stackable grid">
                <div class="sixteen wide column">
                    <div class="ui segment" style="min-height: 40rem;">
                        <div class="ui stackable two column grid">
                            @include('web::project.filter')
                            <div class="middle aligned column">
                                <a href="{{route('project.create')}}" class="mini ui right floated teal button">
                                    <i class="plus icon"></i>
                                    {{trans('project.button.create')}}
                                </a>
                            </div>
                        </div>
                        <div class="ui five column grid projects">
                            @forelse ($data as $item)
                                <div class="column">
                                    <a href="{{route('project_dashboard.index',['uuid'=>$item->uuid])}}" title="{{$item->name}}">
                                        <div class="ui fluid card">
                                            <div class="image image-logo">
                                                <img style="" src="{{$item->logo}}">
                                            </div>
                                            <div class="content">
                                                {{$item->name}}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
