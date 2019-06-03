<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{asset('semantic/dist/semantic.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('semantic/dist/semantic.min.js')}}"></script>
</head>
@yield('style')
<body>

@include('web::common.menu')

@include('web::common.suggest_message')

@section('content')
@show

@yield('scripts')

<div class="ui tiny modal" id="suggest-modal">
    <div class="header">
        {{trans('suggest.title.index')}}
    </div>
    <div class="content">
        <form class="ui mini loadable form" id="suggest-form">
            <div class="required field">
                <textarea required id="description" name="description"
                          placeholder="{{trans('suggest.table.description')}}"></textarea>
                <div class="ui visible hidden error message suggest-error"></div>
            </div>
        </form>
    </div>
    <div class="actions">
        <div class="ui mini primary button" onclick="postsuggest()">{{trans('common.button.confirm')}}</div>
        <div class="ui mini deny button">{{trans('common.button.cancle')}}</div>
    </div>
</div>

<div id="fixed-div">
    <div class="ui small vertical basic icon buttons">
        <button class="ui button" id="go-top-button" onclick="goTop()"><i class="chevron up icon"></i></button>
        <button class="ui button" onclick="suggest()"><i class="envelope outline icon"></i></button>
    </div>
</div>
<script src="{{asset('assets/js/app.js')}}"></script>
<script>
    function suggest() {
        $('#suggest-modal')
            .modal({
                closable: true
            })
            .modal('show')
        ;
    }

    function postsuggest() {
        $('#suggest-form').addClass('loading');
        var data = {
            "description": $('#description').val()
        };

        $.ajax({
            type: "POST",
            url: "{{route('user_suggest.store')}}",
            data: data,
            datatype: "json",
            success: function (data) {
                if (data.code === 1) {
                    $(window).scrollTop(0);
                    $('#suggest-modal').modal('hide');
                    $('#suggest-content').text(data.message);
                    $('#suggest-message-div').show();
                    setTimeout(show, 5000);
                    function show() {
                        $('.message .close').click();
                    }
                } else {
                    $('#suggest-form').removeClass('loading');
                    $('.suggest-error').removeClass('hidden').text(data.message.description)
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("{{trans('common.system_exception')}}");
            }
        });
    }
</script>
</body>
</html>
