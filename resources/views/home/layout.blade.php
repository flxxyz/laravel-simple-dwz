<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/bulma.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
</head>
<body>
<section class="hero is-success is-fullheight">
    <div class="hero-head">
        <header class="container">

        </header>
    </div>

    <div class="hero-body">
        <div class="container has-text-centered">
            <h1 class="title">ABC短网址</h1>
            <h2 class="subtitle">试试效率如何</h2>
            <form class="column">
                <div class="field is-grouped">
                    <div class="control is-expanded">
                        <input class="input is-flat" type="text" name="uri" id="uri" placeholder="粘贴你要缩短的网址..."
                               required>
                    </div>
                    <div class="control">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button id="btn" class="button is-white is-outlined">生成</button>
                    </div>
                </div>
            </form>
            <div class="notification is-warning is-hidden">
                <button class="delete"></button>
                <div class="field is-horizontal is-hidden success">
                    <div class="field-label is-normal">
                        <label class="label">短网址：</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <textarea class="short input">1234567890</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="msg">1234567890</p>
            </div>
        </div>
    </div>

    <div class="hero-foot">
        <footer class="column">
            <div class="container">
                <nav class="level is-mobile">
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading">生成</p>
                            <p class="title">
                                <a href="{{ url('top/new') }}">@yield('new', 0)</a>
                            </p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading">点击</p>
                            <p class="title">
                                <a href="{{ url('top/click') }}">@yield('click', 0)</a>
                            </p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading">查看</p>
                            <p class="title">
                                <a href="{{ url('top/show') }}">@yield('show', 0)</a>
                            </p>
                        </div>
                    </div>
                </nav>
                <div class="has-text-right">
                    <p>
                        <strong>use licensed <a href="http://test.dev/1lv6dbr" title="要tm什么身份证" target="_blank">WTFPL</a></strong> .
                    </p>
                </div>
            </div>
        </footer>
    </div>
</section>
@include('home.script')
</body>
</html>