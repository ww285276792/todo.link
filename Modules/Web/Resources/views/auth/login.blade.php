<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>{{trans('auth.login')}}</title>
    <link rel="stylesheet" type="text/css" href="{{asset('semantic/dist/semantic.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('semantic/dist/semantic.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('font-awesome/css/font-awesome.min.css')}}">
</head>
<body class="login">
<div class="ui middle aligned center aligned grid">
    <div class="column">
        <form class="ui form" id="login-form" method="post" action="{{route('login')}}">
            <div class="ui segment main-content">
                <div class="ui grid">
                    <div class="ten wide column">
                        @foreach ($errors->all() as $error)
                            @if ($loop->index==0)
                                <div class="ui mini error visible message error-message">
                                    <i class="fa fa-minus-circle"></i>
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        @endforeach
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
                        <div onclick="formSubmit()" class="ui fluid teal button">
                            {{trans('auth.login')}}
                        </div>
                        <div class="ui right aligned basic segment forget-segment">
                            <a style="color:#00b5ad" href="{{route('password.request')}}">
                                {{trans('auth.forget_password')}}?
                            </a>
                        </div>
                    </div>
                    <div class="six wide column segment">
                        <div class="ui basic segment register-segment">
                            <a href="{{route('register')}}" style="color:#00b5ad;">
                                {{trans('auth.register_account')}}<i class="chevron right icon"></i>
                            </a>
                        </div>
                        <div class="ui divider"></div>
                        <div class="ui basic segment" style="padding-top: 0;">
                            <a href="{{route('auth.github')}}"><i class="fa fa-github github-icon"></i></a>
                        </div>
                        <div class="ui vertical divider divider-or">or</div>
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

<script>
    function formSubmit() {
        document.getElementById("login-form").submit();
    }
</script>
</html>
