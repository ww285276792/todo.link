<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>{{trans('auth.forget_password')}}</title>
    <link rel="stylesheet" type="text/css" href="{{asset('semantic/dist/semantic.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('semantic/dist/semantic.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('font-awesome/css/font-awesome.min.css')}}">
</head>
<body class="login">
<div class="ui middle aligned center aligned grid">
    <div class="column" style="width: 400px;">
        <form class="ui form" id="email-form" method="post" action="{{route('password.email')}}">
            <div class="ui segment main-content">
                <div class="ui grid">
                    <div class="column">
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="envelope icon"></i>
                                <input type="text" name="email" value="{{ old('email') }}"
                                       placeholder="{{trans('auth.email')}}">
                            </div>
                        </div>
                        @if ($errors->has('email'))
                            <div class="ui mini error visible message error-message">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                        @if (session('status'))
                            <div class="ui mini green visible message error-message">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div onclick="formSubmit()" class="ui fluid teal button">
                            {{trans('auth.send_email')}}
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

<script>
    function formSubmit() {
        document.getElementById("email-form").submit();
    }
</script>
</html>
