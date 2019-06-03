<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('semantic/dist/semantic.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('font-awesome/css/font-awesome.min.css')}}">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('semantic/dist/semantic.min.js')}}"></script>
    <title>todo.link</title>
    <style>
        body {
            background: #f0f2f5;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 36px;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="ui teal borderless inverted menu nav">
    <div class="ui container">
        <div class="left menu">
            <div class="ui dropdown item" tabindex="0">
                <a href="{{route('home')}}">Todo.link</a>
            </div>
        </div>
    </div>
</div>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title">
            <h2 style="font-weight: normal;" class="ui header">基于项目的易用、便捷、开源任务管理系统</h2>
            <a href="{{route('project.index')}}" class="ui big teal right labeled icon button">
                <i class="right arrow icon"></i>
                进入项目
            </a>
        </div>
    </div>
</div>
<div class="ui inverted vertical footer segment">
    <div class="ui center aligned container">
        <div class="ui stackable inverted grid">
            <div class="four wide column"></div>
            <div class="four wide column">
                <h5 class="ui inverted header">联系我</h5>
                <div class="ui inverted link list">
                    <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=285276792&site=qq&menu=yes" class="item">
                        QQ
                    </a>
                    <a target="_blank" href="https://github.com/ww285276792/todo.link" class="item">
                        Github
                    </a>
                </div>
            </div>
            <div class="four wide column">
                <h5 class="ui inverted header">友情链接</h5>
                <div class="ui inverted link list">
                    <a target="_blank" href="https://laravel.com" class="item">Laravel</a>
                    <a target="_blank" href="http://www.ui.cn" class="item">UI中国</a>
                </div>
            </div>
            <div class="four wide column"></div>
        </div>
    </div>
</div>
</body>
</html>
