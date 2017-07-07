<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>最新 - ABC短网址</title>
    <link rel="stylesheet" href="{{ asset('css/bulma.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
</head>
<body>

<div class="hero is-medium is-success is-bold is-fullheight">
    <div class="hero-body">
        <div class="container">
            <h1 class="title">
                最新
            </h1>
            <h2 class="subtitle">
                展示最新生成的短网址
            </h2>
            <div class="notification has-text-centered">
                @foreach($data as $key => $item)
                <div class="notification {{ $item->aaa($key) }}">
                    <a href="/{{ \App\Link::find($item->link_id)->hash }}" target="_blank">{{ $item->title }}</a>
                </div>
                @endforeach
            </div>
            <footer class="container">
                <div class="tabs content is-centered">
                    <ul>
                        <li>
                            <a href="{{  url('/') }}">首页</a>
                        </li>
                        <li class="is-active" }}>
                            <a href="{{  Request::is('top/new') ? '#':url('top/new') }}">最新</a>
                        </li>
                        <li>
                            <a href="{{ Request::is('top/click') ? '#':url('top/click') }}">点击</a>
                        </li>
                        <li>
                            <a href="{{ Request::is('top/show') ? '#':url('top/show') }}">显示</a>
                        </li>
                    </ul>
                </div>
            </footer>
        </div>
    </div>
    <div class="hero-foot">
        <footer class="container">
            <div class="has-text-right">
                <p>
                    <strong>use licensed <a href="http://dwz.flxxyz.com/1lv6dbr" title="要tm什么身份证" target="_blank">WTFPL</a></strong> .
                </p>
            </div>
        </footer>
    </div>
</div>
</body>
</html>