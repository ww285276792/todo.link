<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="{{asset('semantic/dist/semantic.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/app.css')}}">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('semantic/dist/semantic.min.js')}}"></script>
</head>
@yield('style')
<body class="pushable">
<div class="ui sidebar vertical inverted accordion menu visible left" id="sidebar">
    <a class="item"><b>后台管理</b></a>
    @include('admin::common.menu')
</div>
<div class="ui fixed inverted menu" style="height: 43px!important;">
    <a class="icon item" id="sidebar-toggle" title="Toggle sidebar">
        <i class="sidebar icon"></i>
    </a>
    <div class="item">
        {{--<form id="k-form" method="get" action="{{route('admin_article.index')}}" style="margin-bottom:0;">--}}
            {{--<div class="ui inverted transparent icon input">--}}
                {{--<input type="text" value="{{Request::get('title')}}" name="title"--}}
                       {{--placeholder="{{trans('common.search.keyword')}}">--}}
                {{--<i onclick="event.preventDefault(); document.getElementById('k-form').submit();"--}}
                   {{--class="search link icon"></i>--}}
            {{--</div>--}}
        {{--</form>--}}
    </div>
    <div class="ui left floated dividing empty item"></div>
    <div class="ui right floated dividing empty item"></div>
    <div class="ui floated dropdown item">
        {{ auth('admin')->user()->name }}
        <i class="dropdown icon"></i>
        <div class="menu">
            <a href="{{route('admin_password.reset')}}" class="item">
                <i class="user icon"></i>
                {{trans('auth.reset_password')}}
            </a>
            <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="item">
                <i class="sign out icon"></i>
                {{trans('auth.logout')}}
            </a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
</div>
<div class="pusher">
    <div class="full height" id="wrapper">
        @yield('content')
    </div>
</div>
@yield('scripts')
<script src="{{asset('assets/admin/js/app.js')}}"></script>
</body>
</html>
