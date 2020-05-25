<div id="banner-menu">
    <div class="banner-menu1">
        @if (\Request::is('ru'))
        <ul>
            <li><a class="scrollto" href="#promos">Акции</a></li>
            <li class="drop-down">
                <a class="scrollto" href="#promos">Меню</a>
                <img src="/img/arrow-down_white.svg" alt="Меню">
                <ul>
                    @foreach ($categories as $category)
                    <li><a class="scrollto" href="#category_{{$category['link']}}">{{$category['title-ru']}}</a></li>
                    @endforeach
                </ul>
            </li>
            <li><a href="/ru/about">О нас</a></li>
            <li><a href="/ru/delivery">Доставка и оплата</a></li>
        </ul>
        @elseif (\Request::is('ua'))
        <ul>
            <li><a class="scrollto" href="/ua/#promos">Акції</a></li>
            <li class="drop-down">
                <a class="scrollto" href="#promos">Меню</a>
                <img src="/img/arrow-down_white.svg" alt="Меню">
                <ul>
                    @foreach ($categories as $category)
                    <li><a class="scrollto" href="#category_{{$category['link']}}">{{$category['title-ua']}}</a></li>
                    @endforeach
                </ul>
            </li>
            <li><a href="/ua/about">Про нас</a></li>
            <li><a href="/ua/delivery">Доставка i оплата</a></li>
        </ul>
        @else
        @if($lang_session == 'ru')
        <ul>
            <li><a href="/ru/#promos">Акции</a></li>
            <li class="drop-down">
                <a href="/ru/#promos">Меню</a>
                <img src="/img/arrow-down_white.svg" alt="Меню">
                <ul>
                    @foreach ($categories as $category)
                    <li><a href="/ru/#category_{{$category['link']}}">{{$category['title-ru']}}</a></li>
                    @endforeach
                </ul>
            </li>
            <li><a href="/ru/about">О нас</a></li>
            <li><a href="/ru/delivery">Доставка и оплата</a></li>
        </ul>
        @else
        <ul>
            <li><a href="/ua/#promos">Акції</a></li>
            <li class="drop-down">
                <a href="/ua/#promos">Меню</a>
                <img src="/img/arrow-down_white.svg" alt="Меню">
                <ul>
                    @foreach ($categories as $category)
                    <li><a href="/ua/#category_{{$category['link']}}">{{$category['title-ua']}}</a></li>
                    @endforeach
                </ul>
            </li>
            <li><a href="/ua/about">Про нас</a></li>
            <li><a href="/ua/delivery">Доставка i оплата</a></li>
        </ul>
        @endif
        @endif
    </div>
    <div class="banner-menu2">
        @if ($lang_session == 'ru')
        <a rel="nofollow" href="/ru/cart">Корзина (<b class="cart-text cart-amount">{{$cart_amount}}</b>)</a>
        @else
        <a rel="nofollow" href="/ua/cart">Кошик (<b class="cart-text cart-amount">{{$cart_amount}}</b>)</a>
        @endif
        <a rel="nofollow" class="trigger-contacts-call" href="tel:+380934404001">+38 (093) 440-40-01</a>
    </div>
</div>
<div class="bunner-lang-controller">
    @if($lang_session == 'ru')
    <a href="/ua/{{$request_link}}">УКР</a>
    <p>|</p>
    <a href="/ru/{{$request_link}}" class="active">РУС</a>
    @else
    <a href="/ua/{{$request_link}}" class="active">УКР</a>
    <p>|</p>
    <a href="/ru/{{$request_link}}">РУС</a>
    @endif
</div>