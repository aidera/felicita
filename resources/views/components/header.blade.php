<header>



    <div id="fixed-menu">
        <div class="line-1">
            <div class="page-container">

                <div class="lang-controller">
                    @if($lang_session == 'ru')
                    <a href="/ua/{{$request_link}}">УКР</a>
                    <p>•</p>
                    <a href="/ru/{{$request_link}}" class="active">РУС</a>
                    @else
                    <a href="/ua/{{$request_link}}" class="active">УКР</a>
                    <p>•</p>
                    <a href="/ru/{{$request_link}}">РУС</a>
                    @endif
                </div>

                @if( $cart_amount > 0 )
                <a rel="nofollow" href="/{{$lang_session}}/cart" class="button cart">
                    @else
                    <a rel="nofollow" href="/{{$lang_session}}/cart" class="button cart disabled">
                        @endif
                        @if($lang_session == 'ru')
                        <img src="/img/shopping-bag_white.svg" alt="FELICITA корзина">
                        <p>Корзина (<b class="cart-text cart-amount">{{$cart_amount}}</b>)</p>
                        @else
                        <img src="/img/shopping-bag_white.svg" alt="FELICITA кошик">
                        <p>Кошик (<b class="cart-text cart-amount">{{$cart_amount}}</b>)</p>
                        @endif
                    </a>

                    <a rel="nofollow" href="tel:+380934404001" class="button phone trigger-contacts-call">
                        <p>+38 (093) 440-40-01</p>
                    </a>

            </div>
        </div>

        <div class="line-2">
            <div class="page-container">
                <nav>
                    <div class="logo nav-part">
                        @if($lang_session == 'ru')
                        <a href="/ru"><img src="/img/logo.svg" alt="FELICITA логотип"></a>
                        @else
                        <a href="/ua"><img src="/img/logo.svg" alt="FELICITA логотип"></a>
                        @endif
                    </div>
                    <div class="menu-list nav-part">

                        @if (\Request::is('ru'))
                        <ul>
                            <li><a class="scrollto" href="#promos">
                                    <p>Акции</p>
                                </a></li>
                            <li class="drop-down">
                                <a class="scrollto" href="#promos">
                                    <p>Меню</p><img src="/img/arrow-down_black.svg" alt="Меню">
                                </a>
                                <ul>
                                    @foreach ($categories as $category)
                                    <li><a class="scrollto" href="#category_{{$category['link']}}">
                                            <p>{{$category['title-ru']}}</p>
                                        </a></li>
                                    @endforeach
                                    </a>
                                </ul>
                            </li>
                            <li><a href="/ru/about">
                                    <p>О нас</p>
                                </a></li>
                            <li><a href="/ru/delivery">
                                    <p>Доставка и оплата</p>
                                </a></li>
                        </ul>
                        @elseif (\Request::is('ua'))
                        <ul>
                            <li><a class="scrollto" href="#promos">
                                    <p>Акції</p>
                                </a></li>
                            <li class="drop-down">
                                <a class="scrollto" href="#promos">
                                    <p>Меню</p><img src="/img/arrow-down_black.svg" alt="Меню">
                                </a>
                                <ul>
                                    @foreach ($categories as $category)
                                    <li><a class="scrollto" href="#category_{{$category['link']}}">
                                            <p>{{$category['title-ua']}}</p>
                                        </a></li>
                                    @endforeach
                                    </a>
                                </ul>
                            </li>
                            <li><a href="/ua/about">
                                    <p>Про нас</p>
                                </a></li>
                            <li><a href="/ua/delivery">
                                    <p>Доставка i оплата</p>
                                </a></li>
                        </ul>
                        @else
                        @if($lang_session == 'ru')
                        <ul>
                            <li><a href="/ru/#promos">
                                    <p>Акции</p>
                                </a></li>
                            <li class="drop-down">
                                <a href="/ru/#promos">
                                    <p>Меню</p><img src="/img/arrow-down_black.svg" alt="Меню">
                                </a>
                                <ul>
                                    @foreach ($categories as $category)
                                    <li><a href="/ru/#category_{{$category['link']}}">
                                            <p>{{$category['title-ru']}}</p>
                                        </a></li>
                                    @endforeach
                                    </a>
                                </ul>
                            </li>
                            <li><a href="/ru/about">
                                    <p>О нас</p>
                                </a></li>
                            <li><a href="/ru/delivery">
                                    <p>Доставка и оплата</p>
                                </a></li>
                        </ul>
                        @else
                        <ul>
                            <li><a href="/ua/#promos">
                                    <p>Акції</p>
                                </a></li>
                            <li class="drop-down">
                                <a href="/ua/#promos">
                                    <p>Меню</p><img src="/img/arrow-down_black.svg" alt="Меню">
                                </a>
                                <ul>
                                    @foreach ($categories as $category)
                                    <li><a href="/ua/#category_{{$category['link']}}">
                                            <p>{{$category['title-ua']}}</p>
                                        </a></li>
                                    @endforeach
                                    </a>
                                </ul>
                            </li>
                            <li><a href="/ua/about">
                                    <p>Про нас</p>
                                </a></li>
                            <li><a href="/ua/delivery">
                                    <p>Доставка i оплата</p>
                                </a></li>
                        </ul>
                        @endif
                        @endif
                    </div>
                </nav>
            </div>
        </div>
    </div>



















    <div id="fixed-menu-mobile">
        @if($lang_session == 'ru')
        <a href="/ru" class="logo"><img src="/img/logo.svg" alt="FELICITA" /></a>
        @else
        <a href="/ua" class="logo"><img src="/img/logo.svg" alt="FELICITA" /></a>
        @endif
        <div class="burger fixed-menu-mobile_switcher"><img src="/img/menu_black.svg" alt="FELICITA бургер-меню" /></div>
        @if( $cart_amount > 0 )
        <div class="cart">
            @else
            <div class="cart disabled">
                @endif
                @if($lang_session == 'ru')
                <a rel="nofollow" href="/ru/cart"><img src="/img/shopping-bag_white.svg" alt="FELICITA корзина">
                    <p>Корзина (<b class="cart-text cart-amount">{{$cart_amount}}</b>)</p>
                </a>
                @else
                <a rel="nofollow" href="/ua/cart"><img src="/img/shopping-bag_white.svg" alt="FELICITA кошик">
                    <p>Кошик (<b class="cart-text cart-amount">{{$cart_amount}}</b>)</p>
                </a>
                @endif
            </div>
        </div>



        <div id="fixed-menu-mobile_list">
            <div class="container">
                <div class="lang-controller">
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
                <div class="fixed-menu-mobile_switcher fixed-menu-mobile_close"><img src="/img/close_black.svg" alt="close" /></div>
                <!-- @if($lang_session == 'ru')
      <div class="logo"><a href="/ru"><img src="/img/logo.svg" alt="FELICITA логотип"/></a></div>
      @else
      <div class="logo"><a href="/ua"><img src="/img/logo.svg" alt="FELICITA логотип"/></a></div>
      @endif -->
                <nav class="menu-list">

                    @if (\Request::is('ru'))
                    <ul>
                        <li><a href="/ru">
                                <p>Главная</p>
                            </a></li>
                        <li><a class="scrollto" href="#promos">
                                <p>Акции</p>
                            </a></li>
                        <li class="drop-down">
                            <a>
                                <p>Меню</p><img src="/img/arrow-down_black.svg" alt="Меню">
                            </a>
                            <ul class="undermenu">
                                <li class="back"><a><img src="/img/arrow-down_black.svg" alt="Меню">
                                        <p>Назад</p>
                                    </a></li>
                                @foreach ($categories as $category)
                                <li><a class="scrollto" href="#category_{{$category['link']}}">
                                        <p>{{$category['title-ru']}}</p>
                                    </a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="/ru/about">
                                <p>О нас</p>
                            </a></li>
                        <li><a href="/ru/delivery">
                                <p>Доставка и оплата</p>
                            </a></li>
                    </ul>
                    @elseif (\Request::is('ua'))
                    <ul>
                        <li><a href="/ua">
                                <p>Головна</p>
                            </a></li>
                        <li><a class="scrollto" href="#promos">
                                <p>Акції</p>
                            </a></li>
                        <li class="drop-down">
                            <a>
                                <p>Меню</p><img src="/img/arrow-down_black.svg" alt="Меню">
                            </a>
                            <ul class="undermenu">
                                <li class="back"><a><img src="/img/arrow-down_black.svg" alt="Меню">
                                        <p>Назад</p>
                                    </a></li>
                                @foreach ($categories as $category)
                                <li><a class="scrollto" href="#category_{{$category['link']}}">
                                        <p>{{$category['title-ua']}}</p>
                                    </a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="/ua/about">
                                <p>Про нас</p>
                            </a></li>
                        <li><a href="/ua/delivery">
                                <p>Доставка i оплата</p>
                            </a></li>
                    </ul>
                    @else
                    @if($lang_session == 'ru')
                    <ul>
                        <li><a href="/ru">
                                <p>Главная</p>
                            </a></li>
                        <li><a href="/ru/#promos">
                                <p>Акции</p>
                            </a></li>
                        <li class="drop-down">
                            <a>
                                <p>Меню</p><img src="/img/arrow-down_black.svg" alt="Меню">
                            </a>
                            <ul class="undermenu">
                                <li class="back"><a><img src="/img/arrow-down_black.svg" alt="Меню">
                                        <p>Назад</p>
                                    </a></li>
                                @foreach ($categories as $category)
                                <li><a href="/ru/#category_{{$category['link']}}">
                                        <p>{{$category['title-ru']}}</p>
                                    </a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="/ru/about">
                                <p>О нас</p>
                            </a></li>
                        <li><a href="/ru/delivery">
                                <p>Доставка и оплата</p>
                            </a></li>
                    </ul>
                    @else
                    <ul>
                        <li><a href="/ua">
                                <p>Головна</p>
                            </a></li>
                        <li><a href="/ua/#promos">
                                <p>Акції</p>
                            </a></li>
                        <li class="drop-down">
                            <a>
                                <p>Меню</p><img src="/img/arrow-down_black.svg" alt="Меню">
                            </a>
                            <ul class="undermenu">
                                <li class="back"><a><img src="/img/arrow-down_black.svg" alt="Меню">
                                        <p>Назад</p>
                                    </a></li>
                                @foreach ($categories as $category)
                                <li><a href="/ua/#category_{{$category['link']}}">
                                        <p>{{$category['title-ua']}}</p>
                                    </a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="/ua/about">
                                <p>Про нас</p>
                            </a></li>
                        <li><a href="/ua/delivery">
                                <p>Доставка i оплата</p>
                            </a></li>
                    </ul>
                    @endif
                    @endif
                </nav>
                <div class="phone2">
                    <a rel="nofollow" class="trigger-contacts-call" href="tel:+380934404001">+38 (093) 440-40-01</a>
                </div>
            </div>
        </div>

</header>