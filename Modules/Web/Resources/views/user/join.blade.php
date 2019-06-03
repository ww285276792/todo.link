@extends('web::layout.app')

@section('title')
    {{trans('user.title.join')}}
@endsection

@section('content')
    <div class="join" style="min-height: 25rem;">
        <div style="margin-top: 10rem;" class="ui middle aligned center aligned grid">
            <div class="column" style="width: 400px;">
                <form class="ui form" method="post"
                      action="{{route('user.join',['uuid'=>\request()->route('uuid'),'token'=>$token])}}">
                    <div class="ui segment main-content">
                        <div class="ui grid">
                            <div class="column">
                                <div class="field">
                                    <div class="ui left icon input">
                                        {{$project->name}}
                                    </div>
                                </div>
                                <button type="submit" class="ui fluid teal button">
                                    {{trans('user.button.join_project')}}
                                </button>
                            </div>
                        </div>
                    </div>
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
@endsection
