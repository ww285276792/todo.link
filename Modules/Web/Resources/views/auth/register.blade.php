<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>{{trans('auth.register')}}</title>
    <link rel="stylesheet" type="text/css" href="{{asset('semantic/dist/semantic.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('semantic/dist/semantic.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('font-awesome/css/font-awesome.min.css')}}">
</head>
<body class="login">
<div class="ui middle aligned center aligned grid">
    <div class="column" style="width: 400px;">
        <form class="ui form" id="register-form" method="post" action="{{route('register')}}">
            <div class="ui segment main-content">
                <div class="ui grid">
                    <div class="column">
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="user icon"></i>
                                <input type="text" name="name" value="{{ old('name') }}"
                                       placeholder="{{trans('user.table.name')}}">
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="envelope icon"></i>
                                <input type="text" name="email" value="{{ old('email') }}"
                                       placeholder="{{trans('auth.email')}}">
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="lock icon"></i>
                                <input type="password" name="password" value="{{ old('password') }}"
                                       placeholder="{{trans('auth.password')}}">
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="lock icon"></i>
                                <input type="password" name="password_confirmation"
                                       placeholder="{{trans('auth.password_confirmation')}}">
                            </div>
                        </div>
                        @if (count($errors) > 0)
                            <div class="ui mini error visible message error-message">
                                {{ $errors->first() }}
                            </div>
                        @endif
                        <button type="submit" class="ui fluid teal button">
                            {{trans('auth.register')}}
                        </button>
                        <div class="ui right aligned basic segment forget-segment">
                            <a style="color:#00b5ad" href="{{route('login')}}">
                                {{trans('auth.login')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {{ csrf_field() }}
        </form>
    </div>
</div>
<img class="bg-one" src="{{asset('static/images/bb1.png')}}">
<img class="bg-two" src="{{asset('static/images/bb2.png')}}">
</body>
</html>
