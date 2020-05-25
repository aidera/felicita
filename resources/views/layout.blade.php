<!DOCTYPE html>
<html>

<head>

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-K62SVHH');
    </script>
    <!-- End Google Tag Manager -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="robots" content="@yield('robots')">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#fbb03b">
    <meta name="msapplication-TileColor" content="#fbb03b">
    <meta name="theme-color" content="#fbb03b">

    <meta name="keywords" content="@yield('keywords')">
    <meta name="description" content="@yield('description')">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="FELICITA - доставка італійської кухні в Києві">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:url" content="{{$_SERVER['HTTP_HOST'].''.$_SERVER['REQUEST_URI']}}">
    @if ($lang_session == 'ru')
    <meta property="og:locale" content="ru_UA">
    <link rel="alternate" hreflang="ua_UA" href="{{$_SERVER['HTTP_HOST'].'/ua/'.$request_link}}">
    @else
    <meta property="og:locale" content="ua_UA">
    <link rel="alternate" hreflang="ru_UA" href="{{$_SERVER['HTTP_HOST'].'/ru/'.$request_link}}">
    @endif
    <link rel="canonical" hreflang="ua_UA" href="{{$_SERVER['HTTP_HOST'].'/ua/'.$request_link}}" />
    <meta property="og:image" content="@yield('img')">

    <!-- <link rel="stylesheet" href="/css/app.css"> -->
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">


    <title>@yield('title')</title>



</head>


<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K62SVHH" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->


    <div class="background-dish-container">
        <div class="background-dish background-dish-left"></div>
        <div class="background-dish background-dish-right"></div>
    </div>

    <div id="preloader"><img src="/img/logo.svg" alt="FELICITA логотип"></div>

    <div id="overlay"></div>

    <div id="cart_add-icon"><img src="/img/shopping-bag_white.svg" alt="FELICITA логотип"></div>


    <div id="agreement-popup">
        @if ($lang_session == 'ru')
        <p>Привет! Мы используем данные о посещениях для улушения качества сайта и сервиса компании. Подробнее <a rel="nofollow" href="/ru/privacy-policy">тут</a>.</p>
        @else
        <p>Наші вітання! Ми використовуємо дані про відвідування для покращення якості сайту і сервісу компанії. Детальніше <a rel="nofollow" href="/ua/privacy-policy">тут</a>.</p>
        @endif
        <div class="button close_agreement-popup">ОК</div>
    </div>



    @include('components.header')

    @yield('content')

    @include('components.footer')




    <!-- <script src="/js/app.js"></script> -->
    <script src="{{ elixir('js/app.js') }}"></script>
</body>

</html>