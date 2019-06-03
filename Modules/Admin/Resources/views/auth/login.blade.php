<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>{{trans('admin::auth.login')}}</title>
    <link rel="stylesheet" type="text/css" href="{{asset('semantic/dist/semantic.min.css')}}">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('semantic/dist/semantic.min.js')}}"></script>
    <style type="text/css">
        body {
            background-image: url({{asset('static/images/adminbg.jpg')}});
            background-position: center center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        body > .grid {
            height: 100%;
        }

        .column {
            max-width: 450px;
        }
    </style>
</head>
<body>
<div class="ui middle aligned center aligned grid">
    <div class="column">
        <form method="post" action="{{route('admin.login')}}" class="ui large loadable form">
            <div class="ui stacked segment">
                <div class="field">
                    @foreach ($errors->all() as $error)
                        @if ($loop->index==0)
                            <div class="ui visible error message">{{ $error }}</div>
                        @endif
                    @endforeach
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" name="email" value="{{ old('email') }}"
                               placeholder="{{trans('admin::auth.account')}}">
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="password" placeholder="{{trans('admin::auth.password')}}">
                    </div>
                </div>
                <div class="field">
                    <div class="two fields">
                        <div class="field">
                            <input type="text" name="captcha" placeholder="{{trans('admin::auth.captcha')}}">
                        </div>
                        <div class="field">
                            <img style="cursor: pointer" class="captcha" src="{{$src}}" width="100%" height="38">
                        </div>
                    </div>
                </div>
                <button class="ui fluid large teal button" type="submit">{{trans('admin::auth.login')}}</button>
            </div>
            {{ csrf_field() }}
        </form>
    </div>
</div>

<script>
    $('.captcha').click(function () {
        $.get("{{route('get_captcha')}}", function (data, status) {
            $('.captcha').attr('src', data);
        });
    });

    $('form.loadable button').on('click', function () {
        return $(this).closest('form').addClass('loading');
    });
</script>
</body>
</html>
