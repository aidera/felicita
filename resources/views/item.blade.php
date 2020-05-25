@extends('layout')

@if($lang_session == 'ru')
    @section('title', $item['title-ru'].' - Доставка в Киеве | FELICITA')
    @section('keywords', $item['title-ru'].', '.$item['title-ru'].' доставка, '.$item['title-ru'].' заказать, '.$item['title-ru'].' купить')
    @section('description', $item['title-ru'].'. '.$item['short-description-ru'])
@else
    @section('title', $item['title-ua'].' - Доставка в Киеве | FELICITA')
    @section('keywords', $item['title-ua'].', '.$item['title-ua'].' доставка, '.$item['title-ua'].' замовити, '.$item['title-ua'].' купити')
    @section('description', $item['title-ua'].'. '.$item['short-description-ua'])
@endif
@section('img', '/upload/items/'.$item['img'])
@section('robots', 'index, follow')




@section('content')

<?php
    $itemPriceArray = explode(";", $item['price']);
    $itemOldPriceArray = explode(";", $item['old-price']);
    $itemWeightArray = explode(";", $item['weight']);
    $itemChoiceCount = count($itemPriceArray);
?>


<!-- ОСНОВНОЙ ТОВАР -->
<div class="page-container">
    <section id="item" item-id="{{$item['id']}}" item-category-id="{{$item['category']}}" item-price="{{$item['price']}}" item-choice='0' item-title="{{ $item['title-ru'] }}" itemscope="" itemtype="http://schema.org/Product">
        <meta itemprop="sku" content="{{$item['id']}}" />
        <div class="general-item-info">






            <!-- Картинка -->
            <div class="img-container">
                <img itemprop="image" src="/upload/items/{{$item['img']}}" alt="{{$item['title-ru']}}">
                @if($item['new'] == 1)
                <div class="label-new">Новинка!</div>
                @endif
            </div>










            <!-- Описание -->
            <div class="headers-container">
                @if($lang_session == 'ru')
                <h1 itemprop="name">{{$item['title-ru']}}</h1>
                @if($item['not-cooked'] == '1')
                <strong><img src="/img/chef.svg" alt="">
                    <p>Для домашнего приготовления</p>
                </strong>
                @endif
                <div itemprop="description" class="description">{!! $item['description-ru'] !!}</div>
                @if($item['ingridients-ru'] != '')
                <div class="ingridients">Ингредиенты: <i>{{$item['ingridients-ru']}}</i></div>
                @endif
                @else
                <h1 itemprop="name">{{$item['title-ua']}}</h1>
                @if($item['not-cooked'] == '1')
                <strong><img src="/img/chef.svg" alt="">
                    <p>Для домашнього приготування</p>
                </strong>
                @endif
                <div itemprop="description" class="description">{!! $item['description-ua'] !!}</div>
                @if($item['ingridients-ua'] != '')
                <div class="ingridients">Інгредієнти: <i>{{$item['ingridients-ua']}}</i></div>
                @endif
                @endif



                <!-- Цены -->
                <div class="price-container" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                    @if($lang_session == 'ru')
                    <meta itemprop="url" content="/ru/menu/{{$item['link']}}" />
                    @else
                    <meta itemprop="url" content="/ua/menu/{{$item['link']}}" />
                    @endif
                    <div itemprop="seller" itemtype="http://schema.org/Organization" itemscope>
                        <meta itemprop="name" content="FELICITA" />
                    </div>


                    <meta itemprop="price" content="{{$itemPriceArray[0]}}" />
                    <meta itemprop="priceCurrency" content="UAH">
                    <ul>
                        @if($itemChoiceCount > 1)
                        @foreach($itemPriceArray as $itemPriceElemKey => $itemPriceElemValue)

                        <li class="price-elem clickable" choice-id='{{$itemPriceElemKey}}'>
                            <div class="c1">

                                @if($item['old-price'] != null)
                                @if($itemOldPriceArray[$itemPriceElemKey] != '' && $itemOldPriceArray[$itemPriceElemKey] != 'null')
                                <p class="old-price">{{$itemOldPriceArray[$itemPriceElemKey]}}</p>
                                <p class="currency">₴</p>
                                @endif
                                @endif

                            </div>
                            <div class="c2">
                                <p class="price">{{$itemPriceElemValue}}</p>
                                <p class="currency">₴</p>
                            </div>
                            <div class="c3">
                                <p class="weight">{{$itemWeightArray[$itemPriceElemKey]}}</p>
                                @if($item['weight-currency'] == '1')
                                <p class="weight-currency">г</p>
                                @else
                                <p class="weight-currency">мл</p>
                                @endif
                            </div>
                        </li>

                        @endforeach
                        @else

                        @foreach($itemPriceArray as $itemPriceElemKey => $itemPriceElemValue)

                        <li class="price-elem lone" choice-id='{{$itemPriceElemKey}}'>
                            <div class="c1">

                                @if($item['old-price'] != null)
                                @if($itemOldPriceArray[$itemPriceElemKey] != '' && $itemOldPriceArray[$itemPriceElemKey] != 'null')
                                <p class="old-price">{{$itemOldPriceArray[$itemPriceElemKey]}}</p>
                                <p class="currency">₴</p>
                                @endif
                                @endif

                            </div>
                            <div class="c2">
                                <p class="price">{{$itemPriceElemValue}}</p>
                                <p class="currency">₴</p>
                            </div>
                            <div class="c3">
                                <p class="weight">{{$itemWeightArray[$itemPriceElemKey]}}</p>
                                @if($item['weight-currency'] == '1')
                                <p class="weight-currency">г</p>
                                @else
                                <p class="weight-currency">мл</p>
                                @endif
                            </div>
                        </li>

                        @endforeach

                        @endif
                    </ul>



                    <meta itemprop="availability" content="https://schema.org/InStock" />

                </div>

                <div item-id="{{ $item['id'] }}" item-category-id="{{$item['category']}}" item-price="{{$item['price']}}" item-title="{{ $item['title-ru'] }}" item-choice='0' class="cart button cart_add-item cart-regulator">
                    <p>+</p>
                    @if($lang_session == 'ru')
                    <img src="/img/shopping-bag_white.svg" alt="FELICITA корзина">
                    <p>В корзину</p>
                    @else
                    <img src="/img/shopping-bag_white.svg" alt="FELICITA кошик">
                    <p>В кошик</p>
                    @endif
                </div>
            </div>
        </div>
        @if($item['related-items-sauces'] != '')
        <?php
        $itemSaucesArray = explode(";", $item['related-items-sauces']);
        ?>










        <!-- СОУСЫ И ДОБАВКИ -->
        <div class="other-offers">
            @if($lang_session == 'ru')
            <h2>Попробуйте c соусом и добавками!</h2>
            @else
            <h2>Спробуйте c соусом і добавками!</h2>
            @endif
            <div class="other-offers-container">


                @foreach ($itemSaucesArray as $itemSauce)
                @foreach ($items as $itemForSauce)

                <?php
                $itemCategoriesArray = explode(";", $itemForSauce['category']);
                $saucePriceArray = explode(";", $itemForSauce['price']);
                $sauceOldPriceArray = explode(";", $itemForSauce['old-price']);
                $sauceWeightArray = explode(";", $itemForSauce['weight']);
                $sauceChoiceCount = count($saucePriceArray);
                ?>

                @if($itemSauce == $itemForSauce['id'])
                @if($lang_session == 'ru')
                <a href="/ru/menu/{{$itemForSauce['link']}}" class="item" item-id="{{ $itemForSauce['id'] }}" item-price="{{ $itemForSauce['price'] }}" item-choice='0' item-category-id="{{ $itemForSauce['category'] }}" item-title="{{ $itemForSauce['title-ru'] }}">
                    <div class="item-img-container">
                        <img src="/upload/items/{{$itemForSauce['img']}}" alt="{{$itemForSauce['title-ru']}}">
                        @else
                        <a href="/ua/menu/{{$itemForSauce['link']}}" class="item" item-id="{{ $itemForSauce['id'] }}" item-price="{{ $itemForSauce['price'] }}" item-choice='0' item-category-id="{{ $itemForSauce['category'] }}" item-title="{{ $itemForSauce['title-ru'] }}">
                            <div class="item-img-container">
                                <img src="/upload/items/{{$itemForSauce['img']}}" alt="{{$itemForSauce['title-ua']}}">
                                @endif
                                @if($itemForSauce['new'] == 1)
                                <div class="label-new">Новинка!</div>
                                @endif
                            </div>
                            <meta itemprop="sku" content="{{$itemForSauce['id']}}" />
                            <div class="item-text-container">
                                @if($lang_session == 'ru')
                                <h3>{{$itemForSauce['title-ru']}}</h3>
                                @else
                                <h3>{{$itemForSauce['title-ua']}}</h3>
                                @endif
                            </div>
                            <div class="price-container" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                @if($lang_session == 'ru')
                                <meta itemprop="url" content="/ru/menu/{{$item['link']}}" />
                                @else
                                <meta itemprop="url" content="/ua/menu/{{$item['link']}}" />
                                @endif
                                <div itemprop="seller" itemtype="http://schema.org/Organization" itemscope>
                                    <meta itemprop="name" content="FELICITA" />
                                </div>


                                <meta itemprop="price" content="{{$saucePriceArray[0]}}" />
                                <meta itemprop="priceCurrency" content="UAH">
                                <ul>
                                    @if($sauceChoiceCount > 1)
                                    @foreach($saucePriceArray as $saucePriceElemKey => $saucePriceElemValue)

                                    <li class="price-elem clickable" choice-id='{{$saucePriceElemKey}}'>
                                        <div class="c1">
                                            @if($itemForSauce['old-price'] != null)
                                            @if($sauceOldPriceArray[$saucePriceElemKey] != '' && $sauceOldPriceArray[$saucePriceElemKey] != 'null')
                                            <p class="old-price">{{$sauceOldPriceArray[$saucePriceElemKey]}}</p>
                                            <p class="currency">₴</p>
                                            @endif
                                            @endif

                                        </div>
                                        <div class="c2">
                                            <p class="price">{{$saucePriceElemValue}}</p>
                                            <p class="currency">₴</p>
                                        </div>
                                        <div class="c3">
                                            <p class="weight">{{$sauceWeightArray[$saucePriceElemKey]}}</p>
                                            @if($itemForSauce['weight-currency'] == '1')
                                            <p class="weight-currency">г</p>
                                            @else
                                            <p class="weight-currency">мл</p>
                                            @endif
                                        </div>
                                    </li>

                                    @endforeach
                                    @else

                                    @foreach($saucePriceArray as $saucePriceElemKey => $saucePriceElemValue)

                                    <li class="price-elem lone" choice-id='{{$saucePriceElemKey}}'>
                                        <div class="c1">

                                            @if($itemForSauce['old-price'] != null)
                                            @if($sauceOldPriceArray[$saucePriceElemKey] != '' && $sauceOldPriceArray[$saucePriceElemKey] != 'null')
                                            <p class="old-price">{{$sauceOldPriceArray[$saucePriceElemKey]}}</p>
                                            <p class="currency">₴</p>
                                            @endif
                                            @endif

                                        </div>
                                        <div class="c2">
                                            <p class="price">{{$saucePriceElemValue}}</p>
                                            <p class="currency">₴</p>
                                        </div>
                                        <div class="c3">
                                            <p class="weight">{{$sauceWeightArray[$saucePriceElemKey]}}</p>
                                            @if($itemForSauce['weight-currency'] == '1')
                                            <p class="weight-currency">г</p>
                                            @else
                                            <p class="weight-currency">мл</p>
                                            @endif
                                        </div>
                                    </li>

                                    @endforeach

                                    @endif
                                </ul>



                                <meta itemprop="availability" content="https://schema.org/InStock" />

                            </div>
                            <div item-id="{{ $itemForSauce['id'] }}" item-category-id="{{$itemForSauce['category']}}" item-price="{{$itemForSauce['price']}}" item-choice='0' item-title="{{ $itemForSauce['title-ru'] }}" class="cart button cart_add-item cart-regulator">
                                <p>+</p>
                                @if($lang_session == 'ru')
                                <img src="/img/shopping-bag_white.svg" alt="FELICITA корзина">
                                <p>В корзину</p>
                                @else
                                <img src="/img/shopping-bag_white.svg" alt="FELICITA кошик">
                                <p>В кошик</p>
                                @endif
                            </div>

                        </a>

                        @endif

                        @endforeach
                        @endforeach

                    </div>


            </div>

            @endif


            <?php
            $itemCategoryArray = explode(";", $item['category']);
            $itemCategoryArrayCheck = in_array('7', $itemCategoryArray)
            ?>














            <!-- РЕЦЕПТЫ -->
            @if($item['recipe'] == '1')
            <div class="recipe-after">
                @if($lang_session == 'ru')
                <h2>Как правильно готовить равиоли дома</h2>
                <h3><img src="/img/clock.svg" alt="Время приготовления">
                    <p>Время приготовления - до 15 минут</p>
                </h3>
                @else
                <h2>Як правильно готувати равіолі вдома</h2>
                <h3><img src="/img/clock.svg" alt="Час приготування">
                    <p>Час приготування - до 15 хвилин</p>
                </h3>
                @endif
                <div class="recipe-text">
                    <ul>
                        <li>
                            <div class="img-block">
                                <ul>
                                    <li style="background-image:url(/upload/recipes-after/ravioli-1.jpg)"> <i>1</i> </li>
                                    <li style="background-image:url(/upload/recipes-after/ravioli-2.jpg)"> <i>2</i> </li>
                                    <li style="background-image:url(/upload/recipes-after/ravioli-3.jpg)"> <i>3</i> </li>
                                </ul>

                            </div>
                            <div class="text-block">
                                @if($lang_session == 'ru')
                                <i>1</i> Поставьте воду для кипения в расчете на 1 литр в 1 порцию равиоли (150г.), Но не менее 1,5 литра. Подсолите и накройте крышкой.
                                <br><br><i>2</i> Разогрейте сливочное масло, соус или добавку к равиоли в сковородке на медленном огне.
                                <br><br><i>3</i> Когда вода хорошо закипит опустите равиоли и прикройте полностью не крышкой.
                                <div class="additionaly">
                                    <b>Вариант А.</b> Рекомендуем поставить таймер на 2 минуты, если хотите попробовать равиоли «аль денте», то есть «на зубок» - первая стадия готовности равиоли к употреблению с характерной упругостью теста.
                                    <br><br><b>Вариант Б.</b> Поставьте таймер на 4 минуты в том случае, если вам не нравится «аль денте» или вы готовите для детей.
                                </div>
                                @else
                                <i>1</i> Поставте воду для кипіння у розрахунку 1 літр на 1 порцію равіолі (150г.) але не менш ніж 1,5 літри. Підсоліть та накрийте кришкою.
                                <br><br><i>2</i> Розігрійте вершкове масло, соус або добавку до равіолі у сковорідці на малому вогні.
                                <br><br><i>3</i> Коли вода добре закипить опустіть равіолі та прикрийте не повністю кришкою.
                                <div class="additionaly">
                                    <b>Варіант А.</b> Рекомендуємо поставити таймер на 2 хвилини, якщо бажаєте куштувати равіолі «аль денте», тобто «на зубок» - перша стадія готовності равіолі до вживання с характерною пружністю тіста.
                                    <br><br><b>Варіант Б.</b> Поставте таймер на 4 хвилини у тому разі якщо вам не подобається «аль денте» або ви готуєте для діточок.
                                </div>
                                @endif
                            </div>
                        </li>
                        <li>
                            <div class="img-block">
                                <ul>
                                    <li style="background-image:url(/upload/recipes-after/ravioli-4.jpg)"> <i>4</i> </li>
                                    <li style="background-image:url(/upload/recipes-after/ravioli-5.jpg)"> <i>5</i> </li>
                                    <li style="background-image:url(/upload/recipes-after/ravioli-6.jpg)"> <i>6</i> </li>
                                </ul>

                            </div>
                            <div class="text-block">
                                @if($lang_session == 'ru')
                                Усильте огонь на сковородке с соусом на максимум и дождитесь пока сварятся равиоли.
                                <br><br><i>4</i> С помощью шумовки достаньте равиоли и переложите их на сковородку.
                                <br><br><i>5</i> Помешивая готовьте 2 минуты, или пока не получите желаемую консистенцию соуса.
                                <br><br><i>6</i> Разложите по тарелкам и присыпьте пармезаном.
                                <br><br><i>Готово</i> Как говорят итальянцы - «Пронто!», что означает «Все к столу, кушать готово!»
                                @else
                                Посильте вогонь на сковорідці з соусом на максимум та дочекайтесь поки зваряться равіолі.
                                <br><br><i>4</i> За допомогою шумівки достаньте равіолі та перекладіть їх на сковорідку.
                                <br><br><i>5</i> Помішуючи готуйте 2 хвилини, або поки не отримаєте бажану консистенцію соуса.
                                <br><br><i>6</i> Розкладіть по тарілкам та присипте пармезаном.
                                <br><br><i>Готово</i> Як кажуть італійці - «Пронто!», що означає «Всі до столу, їсти готово!»
                                @endif
                            </div>
                        </li>
                    </ul>
                    <div class="lifehacks">
                        <ul>
                            @if($lang_session == 'ru')
                            <li><img src="/img/tick.svg" alt="done">
                                <p>Доставайте равиоли с заморозки за 5-10 минут до начала приготовления - долгое пребывание при комнатной температуре способствует их слипанию, а в последствии - возможных повреждений.</p>
                            </li>
                            <li><img src="/img/tick.svg" alt="done">
                                <p>Чтоб добиться более жидкой консистенции блюда - добавьте немного воды в которой варились равиоли.</p>
                            </li>
                            <li><img src="/img/tick.svg" alt="done">
                                <p>Если же не хватает густоты - просто добавьте немного пармезана. Он заберет на себя часть жидкости.</p>
                            </li>
                            @else
                            <li><img src="/img/tick.svg" alt="done">
                                <p>Діставайте равіолі з заморозки за 5-10 хвилин до початку приготування - довге перебування при кімнатній температурі сприяє їх злипанню, а в наслідку - можливих пошкоджень.</p>
                            </li>
                            <li><img src="/img/tick.svg" alt="done">
                                <p>Щоб домогтися більш рідкої консистенції страви - додайте трохи води в якій варилися равіолі.</p>
                            </li>
                            <li><img src="/img/tick.svg" alt="done">
                                <p>Якщо ж бракує густоти - просто додайте трішки пармезану. Він забере на себе частку рідини.</p>
                            </li>
                            @endif
                        </ul>
                    </div>


                </div>

            </div>
            @endif

            @if($item['recipe'] == '2')
            <div class="recipe-after">
                @if($lang_session == 'ru')
                <h2>Как правильно готовить тортеллини дома</h2>
                <h3><img src="/img/clock.svg" alt="Время приготовления">
                    <p>Время приготовления - до 15 минут</p>
                </h3>
                @else
                <h2>Як правильно готувати тортелліні вдома</h2>
                <h3><img src="/img/clock.svg" alt="Час приготування">
                    <p>Час приготування - до 15 хвилин</p>
                </h3>
                @endif
                <div class="recipe-text">
                    <ul>
                        <li>
                            <div class="img-block">
                                <ul>
                                    <li style="background-image:url(/upload/recipes-after/tortellini-1.jpg)"> <i>1</i> </li>
                                    <li style="background-image:url(/upload/recipes-after/tortellini-2.jpg)"> <i>2</i> </li>
                                    <li style="background-image:url(/upload/recipes-after/tortellini-3.jpg)"> <i>3</i> </li>
                                </ul>

                            </div>
                            <div class="text-block">
                                @if($lang_session == 'ru')
                                <i>1</i> Вылейте бульон из петуха в кастрюлю и добавьте ½ стакана питьевой воды или 1 полный стакан, если хотите более деликатный бульон.
                                <br><br><i>2</i> Доведите воду до кипения и добавьте тортеллини.
                                <br><br><i>3</i> Варите 2-3 минуты, а потом уберите кастрюлю с огня.
                                @else
                                <i>1</i> Вилийте бульйон з півня у каструлю та додайте ½ стакани питної води або 1 повний стакан, якщо бажаєте більш делікатний бульйон.
                                <br><br><i>2</i> Доведіть до кипіння та додайте тортелліні.
                                <br><br><i>3</i> Варіть 2-3 хвилини, а потім приберіть каструлю з вогню.
                                @endif
                            </div>
                        </li>
                        <li>
                            <div class="img-block">
                                <ul>
                                    <li style="background-image:url(/upload/recipes-after/tortellini-4.jpg)"> <i>4</i> </li>
                                    <li style="background-image:url(/upload/recipes-after/tortellini-5.jpg)"> <i>5</i> </li>
                                    <li style="background-image:url(/upload/recipes-after/tortellini-6.jpg)"> <i>готово</i> </li>
                                </ul>

                            </div>
                            <div class="text-block">
                                @if($lang_session == 'ru')
                                <i>4</i> Подайте к столу в глубокой тарелке.
                                <br><br><i>5</i> Посыпте тёртым пармиджано.
                                <br><br><i>Готово</i> Как говорят итальянцы - «Пронто!», что означает «Все к столу, кушать готово!»
                                @else
                                <i>4</i> Подайте до столу в глибокій тарілці.
                                <br><br><i>5</i> Посипте тертим парміджано.
                                <br><br><i>Готово</i> Як кажуть італійці - «Пронто!», що означає «Всі до столу, їсти готово!»
                                @endif
                            </div>
                        </li>
                    </ul>
                    <div class="lifehacks">
                        <ul>
                            @if($lang_session == 'ru')
                            <li><img src="/img/tick.svg" alt="done">
                                <p>Доставайте тортеллини с заморозки за 5-10 минут до начала приготовления - долгое пребывание при комнатной температуре способствует их слипанию, а в последствии - возможных повреждений.</p>
                            </li>
                            <li><img src="/img/tick.svg" alt="done">
                                <p>Если же не хватает густоты - просто добавьте немного пармезана. Он заберет на себя часть жидкости.</p>
                            </li>
                            @else
                            <li><img src="/img/tick.svg" alt="done">
                                <p>Діставайте тортелліні з заморозки за 5-10 хвилин до початку приготування - довге перебування при кімнатній температурі сприяє їх злипанню, а в наслідку - можливих пошкоджень.</p>
                            </li>
                            <li><img src="/img/tick.svg" alt="done">
                                <p>Якщо ж бракує густоти - просто додайте трішки пармезану. Він забере на себе частку рідини.</p>
                            </li>
                            @endif
                        </ul>
                    </div>


                </div>

            </div>
            @endif


            @if($item['recipe'] == '3')
            <div class="recipe-after">
                @if($lang_session == 'ru')
                <h2>Как правильно готовить десерт дома</h2>
                <h3><img src="/img/clock.svg" alt="Время приготовления">
                    <p>Время приготовления - до 20 минут</p>
                </h3>
                @else
                <h2>Як правильно готувати десерт вдома</h2>
                <h3><img src="/img/clock.svg" alt="Час приготування">
                    <p>Час приготування - до 20 хвилин</p>
                </h3>
                @endif
                <div class="recipe-text">
                    <ul>
                        <li>
                            <div class="img-block">
                                <ul>
                                    <li style="background-image:url(/upload/recipes-after/dessert-1.jpg)"> <i>1</i> </li>
                                    <li style="background-image:url(/upload/recipes-after/dessert-2.jpg)"> <i>2</i> </li>
                                    <li style="background-image:url(/upload/recipes-after/dessert-3.jpg)"> <i>3</i> </li>
                                </ul>

                            </div>
                            <div class="text-block">
                                @if($lang_session == 'ru')
                                <i>1</i> Разогрейте духовку до 220 °C.
                                <br><br><i>2</i> Достаньте шоколадный тортино из морозильника и откройте. Семифреддо оставьте в морозильнике.
                                <br><br><i>3</i> Поставьте тортино на противень посередине духовки. Установите таймер на 15 минут.
                                @else
                                <i>1</i> Розігрійте духовку до 220 °C.
                                <br><br><i>2</i> Дістаньте шоколадний тортіно з морозильника і відкрийте. Семіфреддо залиште в морозильнику.
                                <br><br><i>3</i> Поставте тортіно на деко посередині духовки. Встановіть таймер на 15 хвилин.
                                @endif
                            </div>
                        </li>
                        <li>
                            <div class="img-block">
                                <ul>
                                    <li style="background-image:url(/upload/recipes-after/dessert-4.jpg)"> <i>4</i> </li>
                                    <li style="background-image:url(/upload/recipes-after/dessert-6.jpg)"> <i>готово</i> </li>
                                </ul>

                            </div>
                            <div class="text-block">
                                @if($lang_session == 'ru')
                                <i>4</i> Достаньте и с помощью щипчиков или укутав пальцы в полотенце разорвите аллюминиевую форму вокруг десерта.
                                <br><br><i>Готово</i> Сервируйте горячий тортино и ледяной фруктовый семифреддо рядом и наслаждайтесь!
                                @else
                                <i>4</i> Дістаньте і за допомогою щипців або укутавши пальці в рушник розірвіть аллюмінієвую форму навколо десерту.
                                <br><br><i>Готово</i> Сервіруйте гарячий тортіно та льодяний фруктовий семіфреддо поруч та насолоджуйтесь!
                                @endif
                            </div>
                        </li>
                    </ul>
                    <div class="lifehacks">
                        <ul>
                            @if($lang_session == 'ru')
                            <li><img src="/img/tick.svg" alt="done">
                                <p>Последние ±2 минуты приготовления будут определяющими насколько десерт будет запеченный внутри. Минимум - 13 мин. Средне - 15 мин. Полностью - 17 мин.</p>
                            </li>
                            <li><img src="/img/tick.svg" alt="done">
                                <p>Результат может зависеть от характеристик вашей духовки и ее возраста, следите за приготовлением на финальных стадиях.</p>
                            </li>
                            @else
                            <li><img src="/img/tick.svg" alt="done">
                                <p>Останні ±2 хвилини приготування будуть визначальними наскільки десерт буде запечений всередині. Мінімум - 13 хв. Середньо - 15 хв. Повністю - 17 хв.</p>
                            </li>
                            <li><img src="/img/tick.svg" alt="done">
                                <p>Результат може залежати від характеристик вашої духовки і її віку. Пильнуйте за приготуванням на фінальних стадіях.</p>
                            </li>
                            @endif
                        </ul>
                    </div>


                </div>

            </div>
            @endif


            @if($item['recipe'] == '4')
            <div class="recipe-after">
                @if($lang_session == 'ru')
                <h2>Как правильно готовить лазанью дома</h2>
                <h3><img src="/img/clock.svg" alt="Время приготовления">
                    <p>Время приготовления - до 40 минут</p>
                </h3>
                @else
                <h2>Як правильно готувати лазанью вдома</h2>
                <h3><img src="/img/clock.svg" alt="Час приготування">
                    <p>Час приготування - до 40 хвилин</p>
                </h3>
                @endif
                <div class="recipe-text">
                    <ul>
                        <li>
                            <div class="img-block">
                                <ul>
                                    <li style="background-image:url(/upload/recipes-after/lasagna-1.jpg)"> <i>1</i> </li>
                                    <li style="background-image:url(/upload/recipes-after/lasagna-2.jpg)"> <i>2</i> </li>
                                    <li style="background-image:url(/upload/recipes-after/lasagna-3.jpg)"> <i>3</i> </li>
                                </ul>

                            </div>
                            <div class="text-block">
                                @if($lang_session == 'ru')
                                <i>1</i> Разморозьте лазанью.
                                <div class="additionaly">
                                    <b>Вариант А (рекомендуемый).</b> Достаньте лазанью из морозилки и дайте постяты ей 2 часа при комнатной температуре или в холодильнике на 3-4 часа.
                                    <br><br><b>Вариант Б (экспресс).</b> Поставьте замороженную лазанью в духовку и оставьте на 15 минут при 120 °C.
                                </div>
                                <br><br><i>2</i> Разогрейте духовку до 220 °C.


                                @else
                                <i>1</i> Розморозка лазаньї.
                                <div class="additionaly">
                                    <b>Варіант А (рекомендований).</b> Дістаньте лазанью з морозилки і дайте постояти їй 2 години при кімнатній температурі або в холодильнику на 3-4 години.
                                    <br><br><b>Варіант Б (експрес).</b> Поставте заморожену лазанью в духовку і залиште на 15 хвилин при 120 °C.
                                </div>
                                <br><br><i>2</i> Розігрійте духовку до 220 °C.
                                @endif
                            </div>
                        </li>
                        <li>
                            <div class="img-block">
                                <ul>
                                    <li style="background-image:url(/upload/recipes-after/lasagna-4.jpg)"> <i>4</i> </li>
                                    <li style="background-image:url(/upload/recipes-after/lasagna-5.jpg)"> <i>готово</i> </li>
                                </ul>

                            </div>
                            <div class="text-block">
                                @if($lang_session == 'ru')
                                <i>3</i> Снимите крышку с аллюминиевого контейнера, поставьте лазанью в духовку и запекайте лазанью 25 мин до румяной корочки вдоль бортиков.
                                <br><br><i>4</i> Приоткройте на несколько сантимертив духовку и дайте постоять 10 мин.
                                <br><br><i>Готово</i> Разорвав край алюминиевого контейнера сервируйте лазанью в тарелки. Приятного аппетита!
                                @else
                                <i>3</i> Зніміть кришку з аллюмінієвого контейнера, поставте лазанью в духовку та запікайте лазанью 25 хв до румьяної кірочки уздовж бортиків.
                                <br><br><i>4</i> Привідчиніть на декілька сантимертів духовку і дайте постояти 10 хв.
                                <br><br><i>Готово</i> Розірвавши край алюмінієвого контейнера сервіруйте лазанью в тарілки. Смачного!
                                @endif
                            </div>
                        </li>
                    </ul>
                    <div class="lifehacks">
                        <ul>
                            @if($lang_session == 'ru')
                            <li><img src="/img/tick.svg" alt="done">
                                <p>Результат может зависеть от характеристик вашей духовки и ее возраста, следите за приготовлением на финальных стадиях.</p>
                            </li>
                            @else
                            <li><img src="/img/tick.svg" alt="done">
                                <p>Результат може залежати від характеристик вашої духовки і її віку. Пильнуйте за приготуванням на фінальних стадіях.</p>
                            </li>
                            @endif
                        </ul>
                    </div>


                </div>

            </div>
            @endif


            @if($item['recipe'] == '5')
            <div class="recipe-after">
                @if($lang_session == 'ru')
                <h2>Как правильно готовить пельмечини</h2>
                <h3><img src="/img/clock.svg" alt="Время приготовления">
                    <p>Время приготовления - до 15 минут</p>
                </h3>
                @else
                <h2>Як правильно готувати пельмечіні вдома</h2>
                <h3><img src="/img/clock.svg" alt="Час приготування">
                    <p>Час приготування - до 15 хвилин</p>
                </h3>
                @endif
                <div class="recipe-text">
                    <ul>
                        <li>
                            <div class="img-block">
                                <ul>
                                    <li style="background-image:url(/upload/recipes-after/pelmecini-1.jpg)"> <i>1</i> </li>
                                    <li style="background-image:url(/upload/recipes-after/pelmecini-2.jpg)"> <i>2</i> </li>
                                    <li style="background-image:url(/upload/recipes-after/pelmecini-3.jpg)"> <i>3</i> </li>
                                </ul>

                            </div>
                            <div class="text-block">
                                @if($lang_session == 'ru')
                                <i>1</i> Поставьте воду в кастрюле на огонь и дождитесь когда она закипит.
                                <br><br><i>2</i> Положите пельмечини в воду.
                                <br><br><i>3</i> Подождите 3-5 минут.


                                @else
                                <i>1</i> Поставте воду в каструлі на вогонь і дочекайтеся коли вона закипить.
                                <br><br><i>2</i> Покладіть пельмечіні в воду.
                                <br><br><i>3</i> Зачекайте 3-5 хвилин.
                                @endif
                            </div>
                        </li>
                        <li>
                            <div class="img-block">
                                <ul>
                                    <li style="background-image:url(/upload/recipes-after/pelmecini-4.jpg)"> <i>готово</i> </li>
                                </ul>

                            </div>
                            <div class="text-block">
                                @if($lang_session == 'ru')
                                <i>Готово</i> Достаньте пельмечини с кастрюльки. Можно добавить масла и пармезана по вкусу. Приятного аппетита!
                                @else
                                <i>Готово</i> Дістаньте пельмечіні з каструльки. Можна додати масла і пармезану за смаком. Смачного!
                                @endif
                            </div>
                        </li>
                    </ul>
                    <div class="lifehacks">
                        <ul>
                            @if($lang_session == 'ru')
                            <li><img src="/img/tick.svg" alt="done">
                                <p>Доставайте пельмечини с заморозки за 5-10 минут до начала приготовления - долгое пребывание при комнатной температуре способствует их слипанию, а в последствии - возможных повреждений.</p>
                            </li>
                            <li><img src="/img/tick.svg" alt="done">
                                <p>Чтоб добиться более жидкой консистенции блюда - добавьте немного воды в которой варились пельмечини.</p>
                            </li>
                            <li><img src="/img/tick.svg" alt="done">
                                <p>Если же не хватает густоты - просто добавьте немного пармезана. Он заберет на себя часть жидкости.</p>
                            </li>
                            @else
                            <li><img src="/img/tick.svg" alt="done">
                                <p>Діставайте пельмечіні з заморозки за 5-10 хвилин до початку приготування - довге перебування при кімнатній температурі сприяє їх злипанню, а в наслідку - можливих пошкоджень.</p>
                            </li>
                            <li><img src="/img/tick.svg" alt="done">
                                <p>Щоб домогтися більш рідкої консистенції страви - додайте трохи води в якій варилися пельмечіні.</p>
                            </li>
                            <li><img src="/img/tick.svg" alt="done">
                                <p>Якщо ж бракує густоти - просто додайте трішки пармезану. Він забере на себе частку рідини.</p>
                            </li>
                            @endif
                        </ul>
                    </div>


                </div>

            </div>
            @endif






            @if($item['recipe'] == '6')
            <div class="recipe-after">
                @if($lang_session == 'ru')
                <h2>Как правильно готовить пасту дома</h2>
                <h3><img src="/img/clock.svg" alt="Время приготовления">
                    <p>Время приготовления - до 15 минут</p>
                </h3>
                @else
                <h2>Як правильно готувати пасту вдома</h2>
                <h3><img src="/img/clock.svg" alt="Час приготування">
                    <p>Час приготування - до 15 хвилин</p>
                </h3>
                @endif
                <div class="recipe-text">
                    <ul>
                        <li>
                            <div class="img-block">
                                <ul>
                                    <li style="background-image:url(/upload/recipes-after/pasta-1.jpg)"> <i>1</i> </li>
                                    <li style="background-image:url(/upload/recipes-after/pasta-2.jpg)"> <i>2</i> </li>
                                    <li style="background-image:url(/upload/recipes-after/pasta-3.jpg)"> <i>3</i> </li>
                                </ul>

                            </div>
                            <div class="text-block">
                                @if($lang_session == 'ru')
                                <i>1</i> Поставьте воду для кипения в расчете на 1 литр в 1 порцию пасты (120г.), Но не менее 1,5 литра. Подсолите и накройте крышкой.
                                <br><br><i>2</i> Разогрейте сливочное масло, соус или добавку к пасте в сковородке на медленном огне.
                                <br><br><i>3</i> Когда вода хорошо закипит опустите пасту и прикройте полностью не крышкой.
                                <div class="additionaly">
                                    <b>Вариант А.</b> Рекомендуем поставить таймер на 2 минуты, если хотите попробовать равиоли «аль денте», то есть «на зубок» - первая стадия готовности пасты к употреблению с характерной упругостью теста.
                                    <br><br><b>Вариант Б.</b> Поставьте таймер на 4 минуты в том случае, если вам не нравится «аль денте» или вы готовите для детей.
                                </div>
                                @else
                                <i>1</i> Поставте воду для кипіння у розрахунку 1 літр на 1 порцію пасти (120г.) але не менш ніж 1,5 літри. Підсоліть та накрийте кришкою.
                                <br><br><i>2</i> Розігрійте вершкове масло, соус або добавку до пасти у сковорідці на малому вогні.
                                <br><br><i>3</i> Коли вода добре закипить опустіть пасту та прикрийте не повністю кришкою.
                                <div class="additionaly">
                                    <b>Варіант А.</b> Рекомендуємо поставити таймер на 2 хвилини, якщо бажаєте куштувати пасту «аль денте», тобто «на зубок» - перша стадія готовності пасти до вживання с характерною пружністю тіста.
                                    <br><br><b>Варіант Б.</b> Поставте таймер на 4 хвилини у тому разі якщо вам не подобається «аль денте» або ви готуєте для діточок.
                                </div>
                                @endif
                            </div>
                        </li>
                        <li>
                            <div class="img-block">
                                <ul>
                                    <li style="background-image:url(/upload/recipes-after/pasta-4.jpg)"> <i>4</i> </li>
                                    <li style="background-image:url(/upload/recipes-after/pasta-5.jpg)"> <i>5</i> </li>
                                    <li style="background-image:url(/upload/recipes-after/pasta-6.jpg)"> <i>6</i> </li>
                                </ul>

                            </div>
                            <div class="text-block">
                                @if($lang_session == 'ru')
                                Усильте огонь на сковородке с соусом на максимум и дождитесь пока сварится паста.
                                <br><br><i>4</i> С помощью шумовки достаньте пасту и переложите её на сковородку.
                                <br><br><i>5</i> Помешивая готовьте 2 минуты, или пока не получите желаемую консистенцию соуса.
                                <br><br><i>6</i> Разложите по тарелкам и присыпьте пармезаном.
                                <br><br><i>Готово</i> Как говорят итальянцы - «Пронто!», что означает «Все к столу, кушать готово!»
                                @else
                                Посильте вогонь на сковорідці з соусом на максимум та дочекайтесь поки звариться паста.
                                <br><br><i>4</i> За допомогою шумівки достаньте пасту та перекладіть її на сковорідку.
                                <br><br><i>5</i> Помішуючи готуйте 2 хвилини, або поки не отримаєте бажану консистенцію соуса.
                                <br><br><i>6</i> Розкладіть по тарілкам та присипте пармезаном.
                                <br><br><i>Готово</i> Як кажуть італійці - «Пронто!», що означає «Всі до столу, їсти готово!»
                                @endif
                            </div>
                        </li>
                    </ul>
                    <div class="lifehacks">
                        <ul>
                            @if($lang_session == 'ru')
                            <li><img src="/img/tick.svg" alt="done">
                                <p>Доставайте пасту с заморозки за 5-10 минут до начала приготовления - долгое пребывание при комнатной температуре способствует её слипанию, а в последствии - возможных повреждений.</p>
                            </li>
                            <li><img src="/img/tick.svg" alt="done">
                                <p>Чтоб добиться более жидкой консистенции блюда - добавьте немного воды в которой варилась паста.</p>
                            </li>
                            <li><img src="/img/tick.svg" alt="done">
                                <p>Если же не хватает густоты - просто добавьте немного пармезана. Он заберет на себя часть жидкости.</p>
                            </li>
                            @else
                            <li><img src="/img/tick.svg" alt="done">
                                <p>Діставайте пасту з заморозки за 5-10 хвилин до початку приготування - довге перебування при кімнатній температурі сприяє її злипанню, а в наслідку - можливих пошкоджень.</p>
                            </li>
                            <li><img src="/img/tick.svg" alt="done">
                                <p>Щоб домогтися більш рідкої консистенції страви - додайте трохи води в якій варилася паста.</p>
                            </li>
                            <li><img src="/img/tick.svg" alt="done">
                                <p>Якщо ж бракує густоти - просто додайте трішки пармезану. Він забере на себе частку рідини.</p>
                            </li>
                            @endif
                        </ul>
                    </div>


                </div>

            </div>
            @endif







            @if($item['recipe'] == '7')
            <div class="recipe-after">
                @if($lang_session == 'ru')
                <h2>Как правильно готовить пьяду дома</h2>
                <h3><img src="/img/clock.svg" alt="Время приготовления">
                    <p>Время приготовления - до 10 минут</p>
                </h3>
                @else
                <h2>Як правильно готувати п'яду вдома</h2>
                <h3><img src="/img/clock.svg" alt="Час приготування">
                    <p>Час приготування - до 10 хвилин</p>
                </h3>
                @endif
                <div class="recipe-text">
                    <ul>
                        <li>
                            <div class="text-block">
                                @if($lang_session == 'ru')
                                Пьяду можно кушать и не готовля, однако поджаренная она гораздо вкуснее!
                                <br><br>Поджарьте на сковороде без масла (а лучше на гриле) каждую сторону в течение 3х минут - и вкусная итальянская закуска готова!
                                @else
                                П'яду можна їсти і не готуючи, проте підсмажена вона набагато смачніше!
                                <br><br>Підсмажте на сковороді без масла (а краще на грилі) кожну сторону протягом 3х хвилин - і смачна італійська закуска готова!
                                @endif
                            </div>
                        </li>
                        
                    </ul>
                    


                </div>

            </div>
            @endif






            
    </section>
</div>
<section id="items">
    <div class="page-container">

        @foreach ($item_categories as $category)
        <div class="category" id="category_{{$category['link']}}">
            @if ($lang_session == 'ru')
            <h2 class="header-separator">Блюда из категории: {{$category['title-ru']}}</h2>
            @else
            <h2 class="header-separator">Страви з категорії: {{$category['title-ua']}}</h2>
            @endif
            <div class="items-container">

                @foreach ($items as $item)
                <?php
                $itemCategoriesArray = explode(";", $item['category']);
                ?>
                @if(in_array($category['id'], $itemCategoriesArray))

                @include('components.card', ['item'=> $item])

                @endif

                @endforeach

            </div>
        </div>
        @endforeach



    </div>
</section>




@endsection