@extends('layout')

@if($lang_session == 'ru')
    @section('title', 'Корзина | FELICITA - Доставка итальянской кухни в Киеве')
    @section('keywords', 'корзина, корзина товаров, корзина покупок, онлайн корзина')
    @section('description', 'Корзина товаров FELICITA. Быстрая доставка настоящей итальянской кухни: паста, равиолли, прошутто, спагетти. Попробуй Италию на вкус!')
@else
    @section('title', 'Кошик | FELICITA - Доставка італійської кухні в Києві')
    @section('keywords', 'кошик, кошик товарів, кошик покупок, онлайн кошик')
    @section('description', 'Кошик товарів FELICITA. Швидка доставка справжньої італійської кухні: паста, равіоллі, прошутто, спагетті. Спробуй Італію на смак!')
@endif
@section('img', './img/logo-og.png')
@section('robots', 'noindex')



@section('content')


@if($user_cart != '' && $cart_amount > 0)
<div id="cart">
    <div class="page-container">
        <div id="cart-form" name="cart-form">
            {{csrf_field()}}
            <div class="container">
                <div id="item-info">
                    @if($lang_session == 'ru')
                    <h1 class="header-separator">Корзина</h1>
                    @else
                    <h1 class="header-separator">Кошик</h1>
                    @endif
                    <ul>

                        @foreach ($cart_items as $item)

                        <?php
                        $itemPriceArray = explode(";", $item['price']);
                        $itemOldPriceArray = explode(";", $item['old-price']);
                        $itemWeightArray = explode(";", $item['weight']);
                        $itemChoiceCount = count($itemPriceArray);
                        $itemOldPriceArrayCount = count($itemOldPriceArray);
                        $checkOldPrice = true;
                        if ($itemChoiceCount == $itemOldPriceArrayCount) {
                            $checkOldPrice = true;
                        } else {
                            $checkOldPrice = false;
                        }
                        $itemChoice = $item['choice_id'];
                        $itemWeightCurrencyText = '';
                        if ($item['weight-currency'] == '1') {
                            $itemWeightCurrencyText = 'г';
                        } else {
                            $itemWeightCurrencyText = 'мл';
                        }
                        ?>

                        <li id="cart-items">
                            @if($lang_session == 'ru')
                            <a class="cart-item" item-id="{{ $item['id'] }}" item-price="{{ $itemPriceArray[0] }}" item-choice="{{$itemChoice}}" item-category-id="{{ $item['category'] }}" item-title="{{ $item['title-ru'] }}" href="/ru/menu/{{$item['link']}}">
                                @else
                                <a class="cart-item" item-id="{{ $item['id'] }}" item-price="{{ $itemPriceArray[0] }}" item-choice="{{$itemChoice}}" item-category-id="{{ $item['category'] }}" item-title="{{ $item['title-ru'] }}" href="/ua/menu/{{$item['link']}}">
                                    @endif
                                    <div class="img-container">
                                        @if($lang_session == 'ru')
                                        <img src="/upload/items/{{ $item['img-thumb'] }}" alt="{{$item['title-ru']}}">
                                        @else
                                        <img src="/upload/items/{{ $item['img-thumb'] }}" alt="{{$item['title-ua']}}">
                                        @endif
                                    </div>
                                    <div class="text-container">
                                        @if($lang_session == 'ru')
                                        <h3>{{ $item['title-ru'] }} ({{$itemWeightArray[$itemChoice].''.$itemWeightCurrencyText}})</h3>
                                        @else
                                        <h3>{{ $item['title-ua'] }} ({{$itemWeightArray[$itemChoice].''.$itemWeightCurrencyText}})</h3>
                                        @endif


                                        @if($checkOldPrice === true)
                                        @if($itemOldPriceArray[$itemChoice] != '' && $itemOldPriceArray[$itemChoice] != 'null')
                                        <p class="old-price crossed">{{$itemOldPriceArray[$itemChoice]}}₴</p>
                                        @endif
                                        @endif
                                        <p class="price big">{{ $itemPriceArray[$itemChoice] }}₴</p>

                                    </div>
                                    <div class="regulators">
                                        <div class="plus-minus">
                                            <div item-id="{{ $item['id'] }}" item-price="{{ $itemPriceArray[0] }}" item-choice="{{$itemChoice}}" item-category-id="{{ $item['category'] }}" item-title="{{ $item['title-ru'] }}" class="button_minus cart_minus-item cart-page-button cart-regulator">-</div>
                                            <div class="count item-amount">{{ $item['amount'] }}</div>
                                            <div item-id="{{ $item['id'] }}" item-price="{{ $itemPriceArray[0] }}" item-choice="{{$itemChoice}}" item-category-id="{{ $item['category'] }}" item-title="{{ $item['title-ru'] }}" class="button_plus cart_plus-item cart-page-button cart-regulator">+</div>
                                        </div>
                                        <div class="delete">
                                            @if($lang_session == 'ru')
                                            <div item-id="{{ $item['id'] }}" item-price="{{ $itemPriceArray[0] }}" item-choice="{{$itemChoice}}" item-category-id="{{ $item['category'] }}" item-title="{{ $item['title-ru'] }}" class="cross button cart_remove-item cart-page-button cart-regulator">Убрать</div>
                                            @else
                                            <div item-id="{{ $item['id'] }}" item-price="{{ $itemPriceArray[0] }}" item-choice="{{$itemChoice}}" item-category-id="{{ $item['category'] }}" item-title="{{ $item['title-ru'] }}" class="cross button cart_remove-item cart-page-button cart-regulator">Вилучити</div>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                        </li>
                        @endforeach
                    </ul>

                    <div class="additional">
                        @if($lang_session == 'ru')
                        <img src="/img/sauce.svg" alt="Соус">
                        <p>Вы не забыли <a href="/ru/#category_sauces">соус или добавку?</a> С ними вкуснее!</p>
                        @else
                        <img src="/img/sauce.svg" alt="Соус">
                        <p>Ви не забули <a href="/ua/#category_sauces">соус або добавку?</a> З ними смачніше!</p>
                        @endif
                    </div>
                    <div class="delivery">
                        <b>Доставка:</b>
                        <!-- <p class="delicery-cost-container"><b class="delivery-cost">0</b> грн.</p> -->
                        @if($lang_session == 'ru')
                        <p class="delivery-cost-container"><b class="delivery-cost">БЕСПЛАТНО</b></p>
                        @else
                        <p class="delivery-cost-container"><b class="delivery-cost">БЕЗКОШТОВНО</b></p>
                        @endif
                    </div>
                    <div class="promo">
                        <b>Промокод:</b>
                        @if($lang_session == 'ru')
                        <p class="promo-cost-container"><b class="promo-cost">СКИДКА - 0%</b></p>
                        @else
                        <p class="promo-cost-container"><b class="promo-cost">ЗНИЖКА - 0%</b></p>
                        @endif
                    </div>
                    <div class="endprice">

                        @if($lang_session == 'ru')
                        <b>Стоимость:</b>
                        @else
                        <b>Вартість:</b>
                        @endif


                        @if($cart_cost_old != null && $cart_cost_old != '' && $cart_cost_old != $cart_cost)
                        <p class="crossed endprice-regulator">
                            <b class="cart-cost-old">{{$cart_cost_old}}</b>₴
                        </p>
                        @endif
                        <p class="endprice-regulator">
                            <b class="cart-cost">{{$cart_cost}}</b>₴
                        </p>

                    </div>
                    <div id="anchor-low-cost" class="low-cost-error">
                        @if($lang_session == 'ru')
                        <p>Простите, но минимальная стоимость заказа 150 грн :(</p>
                        @else
                        <p>Вибачте, але мінімальна вартість замовлення 150 грн :(</p>
                        @endif
                    </div>
                    
                </div>
                <div id="order-info">
                    @if($lang_session == 'ru')
                    <h2 class="header-separator">Персональные данные</h2>
                    @else
                    <h2 class="header-separator">Персональні дані</h2>
                    @endif
                    <div class="block block-person">
                        <div class="input-container fancy-input">
                            @if($lang_session == 'ru')
                            <label for="cart-form_input_name">*Как к Вам обращаться?</label>
                            @else
                            <label for="cart-form_input_name">*Як до Вас звертатися?</label>
                            @endif
                            <input required type="text" name="cart-form_input_name" id="cart-form_input_name">
                        </div>
                        <div class="input-container fancy-input">
                            <label for="cart-form_input_phone">*Телефон</label>
                            <input required type="text" class="input-phone" name="cart-form_input_phone" id="cart-form_input_phone">
                        </div>
                        <div class="input-container fancy-input">
                            <label for="cart-form_input_email">Email</label>
                            <input type="email" name="cart-form_input_email" id="cart-form_input_email">
                        </div>

                    </div>

                    @if($lang_session == 'ru')
                    <h2 class="header-separator">Получение</h2>
                    @else
                    <h2 class="header-separator">Отримання</h2>
                    @endif
                    <div class="block block-choose-delivery">
                        <div class="choose-delivery_container radio-input">
                            <input class="choose-delivery_regulator choose-delivery_1" checked type="radio" id="input_choose-delivery_1" name="cart-form_input_choose-delivery_switcher_input" value="deliver">
                            @if($lang_session == 'ru')
                            <label class="choose-delivery_regulator choose-delivery_1" for="input_choose-delivery_1">Доставка (бесплатно)</label>
                            @else
                            <label class="choose-delivery_regulator choose-delivery_1" for="input_choose-delivery_1">Доставка (безкоштовно)</label>
                            @endif
                        </div>
                        <div class="choose-delivery_container radio-input">
                            <input class="choose-delivery_regulator choose-delivery_2" type="radio" id="input_choose-delivery_2" name="cart-form_input_choose-delivery_switcher_input" value="self">
                            @if($lang_session == 'ru')
                            <label class="choose-delivery_regulator choose-delivery_2" for="input_choose-delivery_2">Самовывоз (скидка 10%)</label>
                            @else
                            <label class="choose-delivery_regulator choose-delivery_2" for="input_choose-delivery_2">Самовивіз (знижка 10%)</label>
                            @endif
                        </div>

                    </div>
                    <div class="block block-address">
                        <div class="input-container fancy-input">
                            @if($lang_session == 'ru')
                            <p>Киев</p>
                            @else
                            <p>Київ</p>
                            @endif
                            <!-- <label for="cart-form_input_address-city">*Город</label> -->
                            <!-- <input required type="text" id="cart-form_input_address-city"> -->
                        </div>

                        <div class="input-container fancy-input">
                            @if($lang_session == 'ru')
                            <label for="cart-form_input_address-street">*Улица</label>
                            @else
                            <label for="cart-form_input_address-street">*Вулиця</label>
                            @endif
                            <input required type="text" name="cart-form_input_address-street" id="cart-form_input_address-street">
                        </div>
                        <div class="input-container fancy-input">
                            @if($lang_session == 'ru')
                            <label for="cart-form_input_address-house">*Дом</label>
                            @else
                            <label for="cart-form_input_address-house">*Будинок</label>
                            @endif
                            <input required type="text" class="short" name="cart-form_input_address-house" id="cart-form_input_address-house">
                        </div>
                        <div class="input-container fancy-input">
                            @if($lang_session == 'ru')
                            <label for="cart-form_input_address-flor">Этаж</label>
                            @else
                            <label for="cart-form_input_address-flor">Поверх</label>
                            @endif
                            <input type="text" class="short" name="cart-form_input_address-flor" id="cart-form_input_address-flor">
                        </div>
                        <div class="input-container fancy-input">
                            @if($lang_session == 'ru')
                            <label for="cart-form_input_address-flat">Помещение</label>
                            @else
                            <label for="cart-form_input_address-flat">Приміщення</label>
                            @endif
                            <input type="text" class="short" name="cart-form_input_address-flat" id="cart-form_input_address-flat">
                        </div>
                    </div>
                    <div class="block block-address-self">
                        @if($lang_session == 'ru')
                        <p>Самовывоз по адресу: <b>г.Киев, ул.Ревуцкого, дом 42в</b></p>
                        @else
                        <p>Самовивіз за адресою: <b>м.Київ, вул.Ревуцького, будинок 42в</b></p>
                        @endif
                    </div>
                    @if($lang_session == 'ru')
                    <h2 class="header-separator">Время и дата доставки</h2>
                    @else
                    <h2 class="header-separator">Час і дата доставки</h2>
                    @endif
                    <div class="block block-time">
                        <div class="input-container fancy-input">
                            @if($lang_session == 'ru')
                            <p>Привести в ближайшее время?</p>
                            @else
                            <p>Привести найближчим часом?</p>
                            @endif
                            <div class="switch-btn" id="cart-form_input_deliver-time_switcher">
                                <input class="hiddeninput" name="cart-form_input_deliver-time_switcher_input" id="cart-form_input_deliver-time_switcher_input" type="hidden" name="cart-form_input_deliver-time" value="true">
                                @if($lang_session == 'ru')
                                <p class="switch-btn-notes true">Да</p>
                                <p class="switch-btn-notes false">Нет</p>
                                @else
                                <p class="switch-btn-notes true">Так</p>
                                <p class="switch-btn-notes false">Нi</p>
                                @endif
                            </div>
                        </div>
                        <div class="block_deliver-time-choose">
                            <div class="input-container fancy-input">
                                <?php
                                $today = new DateTime('today');
                                $today = $today->format('Y-m-d');
                                $tomorrow = new DateTime('tomorrow');
                                $tomorrow = $tomorrow->format('Y-m-d');
                                $aftertomorrow = new DateTime('+2 day');
                                $aftertomorrow = $aftertomorrow->format('Y-m-d');
                                ?>
                                <select name="cart-form_input_deliver-date" id="cart-form_input_deliver-date">
                                    @if($lang_session == 'ru')
                                    <option value="{{ $today }}">Сегодня</option>
                                    <option value="{{ $tomorrow }}">Завтра</option>
                                    <option value="{{ $aftertomorrow }}">Послезавтра</option>
                                    @else
                                    <option value="{{ $today }}">Сьогодні</option>
                                    <option value="{{ $tomorrow }}">Завтра</option>
                                    <option value="{{ $aftertomorrow }}">Післязавтра</option>
                                    @endif

                                </select>
                            </div>
                            <div class="input-container fancy-input">
                                <select name="cart-form_input_deliver-time" class="short" id="cart-form_input_deliver-time">
                                    <option value="10:00">10:00</option>
                                    <option value="10:30">10:30</option>
                                    <option value="11:00">11:00</option>
                                    <option value="11:30">11:30</option>
                                    <option value="12:00">12:00</option>
                                    <option value="12:30">12:30</option>
                                    <option value="13:00">13:00</option>
                                    <option value="13:30">13:30</option>
                                    <option value="14:00">14:00</option>
                                    <option value="14:30">14:30</option>
                                    <option value="15:00">15:00</option>
                                    <option value="15:30">15:30</option>
                                    <option value="16:00">16:00</option>
                                    <option value="16:30">16:30</option>
                                    <option value="17:00">17:00</option>
                                    <option value="17:30">17:30</option>
                                    <option value="18:00">18:00</option>
                                    <option value="18:30">18:30</option>
                                    <option value="19:00">19:00</option>
                                    <option value="19:30">19:30</option>
                                    <option value="20:00">20:00</option>
                                    <option value="20:30">20:30</option>
                                    <option value="21:00">21:00</option>
                                    <option value="21:30">21:30</option>
                                    <option value="22:00">22:00</option>
                                    <option value="22:30">22:30</option>
                                    <option value="23:00">23:00</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    @if($lang_session == 'ru')
                    <h2 class="header-separator">Завершение</h2>
                    @else
                    <h2 class="header-separator">Завершення</h2>
                    @endif
                    <div class="block block-comment">
                        <div class="input-container fancy-input">
                            <label for="cart-form_input_promo">Промокод</label>
                            <input type="text" name="cart-form_input_promo" id="cart-form_input_promo">
                        </div>
                        <div class="input-container fancy-input">
                            @if($lang_session == 'ru')
                            <label for="cart-form_input_comment">Комментарий</label>
                            @else
                            <label for="cart-form_input_comment">Коментар</label>
                            @endif
                            <input type="text" class="large" name="cart-form_input_comment" id="cart-form_input_comment">
                        </div>
                    </div>
                    <div class="block block-error">
                        <p class="error-message"></p>
                    </div>
                </div>
            </div>
            @if($lang_session == 'ru')
            <button id="cart-form_submit" class="button disable" value="Заказать">Заказать</button>
            @else
            <button id="cart-form_submit" class="button disable" value="Замовити">Замовити</button>
            @endif
            <div class="submit-loader"><img src="/img/loader.svg" alt="loader"></div>
            @if($lang_session == 'ru')
            <div id="submit-agreement">Нажимая кнопку "Заказать" я соглашаюсь с <a target="_blank" href="http://felicita-custom.loc/ru/terms-of-use">правилами</a> сайта</div>
            @else
            <div id="submit-agreement">Натискаючи кнопку "Замовити" я погоджуюся з <a target="_blank" href="http://felicita-custom.loc/ua/terms-of-use">правилами</a> сайту</div>
            @endif
        </div>
    </div>
</div>
@else
<div id="message-container">
    @if($lang_session == 'ru')
    <img src="/img/cart-empty.png" alt="FELICITA - пустая корзина">
    <h2>Корзина пуста</h2>
    <a class="button" href="/ru/">На главную</a>
    @else
    <img src="/img/cart-empty.png" alt="FELICITA - кошик порожній">
    <h2>Кошик порожній</h2>
    <a class="button" href="/ua/">На головну</a>
    @endif


</div>
@endif


@endsection