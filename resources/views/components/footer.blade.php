<footer>
    <div class="page-container">
        <div class="content">
            <div class="logo-container">

                @if (\Request::is('ru') || \Request::is('ua'))
                <a href="#general-image_index"><img src="/img/logo.svg" alt="FELICITA логотип" class="logo"></a>
                @else
                @if($lang_session == 'ru')
                <a href="/ru/"><img src="/img/logo.svg" alt="FELICITA логотип" class="logo"></a>
                @else
                <a href="/ua/"><img src="/img/logo.svg" alt="FELICITA логотип" class="logo"></a>
                @endif
                @endif

            </div>
            <div class="menu-container">
                @if (\Request::is('ru'))
                <a class="scrollto" href="#promos">
                    <p>Акции</p>
                </a>
                @foreach ($categories as $category)
                <a class="scrollto" href="#category_{{$category['link']}}">
                    <p>{{$category['title-ru']}}</p>
                </a>
                @endforeach
                <a class="scrollto" href="/ru/about">
                    <p>О нас</p>
                </a>
                <a class="scrollto" href="/ru/delivery">
                    <p>Доставка и оплата</p>
                </a>
                <a rel="nofollow" href="/ru/privacy-policy">
                    <p>Политика конфеденциальности</p>
                </a>
                <a rel="nofollow" href="/ru/terms-of-use">
                    <p>Пользовательское соглашение</p>
                </a>
                <a href="/ru/sitemap">
                    <p>Карта сайта</p>
                </a>
                @elseif (\Request::is('ua'))
                <a class="scrollto" href="#promos">
                    <p>Акції</p>
                </a>
                @foreach ($categories as $category)
                <a class="scrollto" href="#category_{{$category['link']}}">
                    <p>{{$category['title-ua']}}</p>
                </a>
                @endforeach
                <a href="/ua/about">
                    <p>Про нас</p>
                </a>
                <a href="/ua/delivery">
                    <p>Доставка i оплата</p>
                </a>
                <a rel="nofollow" href="/ua/privacy-policy">
                    <p>Політика конфіденційності</p>
                </a>
                <a rel="nofollow" href="/ua/terms-of-use">
                    <p>Угода з користувачем</p>
                </a>
                <a href="/ua/sitemap">
                    <p>Карта сайту</p>
                </a>
                @else
                @if($lang_session == 'ru')
                <a href="/ru/#promos">
                    <p>Акции</p>
                </a>
                @foreach ($categories as $category)
                <a href="/ru/#category_{{$category['link']}}">
                    <p>{{$category['title-ru']}}</p>
                </a>
                @endforeach
                <a href="/ru/about">
                    <p>О нас</p>
                </a>
                <a href="/ru/delivery">
                    <p>Доставка и оплата</p>
                </a>
                <a rel="nofollow" href="/ru/privacy-policy">
                    <p>Политика конфеденциальности</p>
                </a>
                <a rel="nofollow" href="/ru/terms-of-use">
                    <p>Пользовательское соглашение</p>
                </a>
                <a href="/ru/sitemap">
                    <p>Карта сайта</p>
                </a>
                @else
                <a class="scrollto" href="/ua/#promos">
                    <p>Акції</p>
                </a>
                @foreach ($categories as $category)
                <a href="/ua/#category_{{$category['link']}}">
                    <p>{{$category['title-ua']}}</p>
                </a>
                @endforeach
                <a href="/ua/about">
                    <p>Про нас</p>
                </a>
                <a href="/ua/delivery">
                    <p>Доставка i оплата</p>
                </a>
                <a rel="nofollow" href="/ua/privacy-policy">
                    <p>Політика конфіденційності</p>
                </a>
                <a rel="nofollow" href="/ua/terms-of-use">
                    <p>Угода з користувачем</p>
                </a>
                <a href="/ua/sitemap">
                    <p>Карта сайту</p>
                </a>
                @endif
                @endif
            </div>
            <div class="others-container">
                <div class="phone">
                    <a rel="nofollow" class="trigger-contacts-call" href="tel:+380934404001">+38 (093) 440-40-01</a>
                </div>
                <div class="socials">
                    <a target="_blank" rel="nofollow" href="https://www.facebook.com/felicita.kitchen/"><img src="/img/facebook_white.svg" alt="FELICITA Facebook"></a>
                    <a target="_blank" rel="nofollow" href="https://www.instagram.com/_felicita.kitchen_/"><img src="/img/instagram_white.svg" alt="FELICITA Instagram"></a>
                </div>
            </div>
        </div>
    </div>
</footer>