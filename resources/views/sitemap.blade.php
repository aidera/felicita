@extends('layout')

@if($lang_session == 'ru')
    @section('title', 'FELICITA - Карта сайта')
    @section('keywords', 'карта сайта, сайтмеп, сайтмап, sitemap')
    @section('description', 'FELICITA - карта сайта с полным списком товаров и страниц.')
@else
    @section('title', 'FELICITA - Карта сайту')
    @section('keywords', 'карта сайту, сайтмеп, сайтмап, sitemap')
    @section('description', 'FELICITA - карта сайту з повним списком товарів і сторінок.')
@endif
@section('img', './img/logo-og.png')
@section('robots', 'index, follow')






@section('content')



<section class="general-image" id="general-image_sitemap">
    <div class="pre-img"></div>
    <div class="img"></div>
    <div class="banner-overlay"></div>
    <div class="page-container">

        @include('components.header-static')

        <div class="banner-text">
            @if ($lang_session == 'ru')
            <h1>Карта сайта</h1>
            @else
            <h1>Карта сайту</h1>
            @endif
            <br>
            @if ($lang_session == 'ru')
            <a class="bunner-button scrollto" href="/ru/">На главную</a>
            @else
            <a class="bunner-button scrollto" href="/ua/">На головну</a>
            @endif
        </div>
        <div class="sitemap-links-container">
            <ul>
                @if ($lang_session == 'ru')
                <li><a href="/ru/"> Меню</a></li>
                @else
                <li><a href="/ua/"> Меню</a></li>
                @endif
                <ul>
                    @foreach ($categories as $category)
                    <ul class="sitemap-category" id="category_{{$category['link']}}">
                        @if ($lang_session == 'ru')
                        <li class="sitemap-header-separator">{{$category['title-ru']}}</li>
                        @else
                        <li class="sitemap-header-separator">{{$category['title-ua']}}</li>
                        @endif
                        <ul class="sitemap-items-container">

                            @foreach ($items as $item)
                            <?php
                            $itemCategoriesArray = explode(";", $item['category']);
                            ?>
                            @if(in_array($category['id'], $itemCategoriesArray))
                            @if ($lang_session == 'ru')
                            <li><a href="/ru/menu/{{$item['link']}}">{{$item['title-ru']}}</a></li>
                            @else
                            <li><a href="/ua/menu/{{$item['link']}}">{{$item['title-ua']}}</a></li>
                            @endif
                            @endif

                            @endforeach

                        </ul>
                    </ul>
                    @endforeach
                </ul>
                @if ($lang_session == 'ru')
                <!-- <li><a href="/ru/delivery">Доставка</a></li> -->
                <li><a href="/ru/about">О нас</a></li>
                <li><a href="/ru/delivery">Доставка и оплата</a></li>
                <li><a rel="nofollow" href="/ru/privacy-policy">Политика конфиденциальности</a></li>
                <li><a rel="nofollow" href="/ru/terms-of-use">Пользовательское соглашение</a></li>
                @else
                <!-- <li><a href="/ua/delivery">Доставка</a></li> -->
                <li><a href="/ua/about">Про нас</a></li>
                <li><a href="/ua/delivery">Доставка i оплата</a></li>
                <li><a rel="nofollow" href="/ua/privacy-policy">Політика конфіденційності</a></li>
                <li><a rel="nofollow" href="/ua/terms-of-use">Угода з користувачем</a></li>
                @endif



            </ul>
        </div>

    </div>
</section>










@endsection