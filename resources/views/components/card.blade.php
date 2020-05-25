<?php
$itemPriceArray = explode(";", $item['price']);
$itemOldPriceArray = explode(";", $item['old-price']);
$itemWeightArray = explode(";", $item['weight']);
$itemChoiceCount = count($itemPriceArray);
?>

@if($lang_session == 'ru')
<a href="/ru/menu/{{$item['link']}}" itemscope itemtype="http://schema.org/Product" class="item" item-id="{{ $item['id'] }}" item-price="{{ $itemPriceArray[0] }}" item-choice='0' item-category-id="{{ $item['category'] }}" item-title="{{ $item['title-ru'] }}">
    @else
    <a href="/ua/menu/{{$item['link']}}" itemscope itemtype="http://schema.org/Product" class="item" item-id="{{ $item['id'] }}" item-price="{{ $itemPriceArray[0] }}" item-choice='0' item-category-id="{{ $item['category'] }}" item-title="{{ $item['title-ru'] }}">
        @endif
        <meta itemprop="sku" content="{{$item['id']}}" />

        @if($lang_session == 'ru')
        <div class="img-container">
            <img itemprop="image" src="/upload/items/{{$item['img-thumb']}}" alt="{{$item['title-ru']}}">
            @if($item['new'] == 1)
            <div class="label-new">Новинка!</div>
            @endif
        </div>

        <div class="text-container">
            <h3 itemprop="name">{{ $item['title-ru'] }}</h3>
            <meta itemprop="description" content="{{$item['short-description-ru']}}" />
            @if($item['not-cooked'] == '1')
            <strong><img src="/img/chef.svg" alt="">
                <p>Для домашнего приготовления</p>
            </strong>
            @endif

            <?php
            $item_new_decription = mb_strimwidth($item['short-description-ru'], 0, 85, "...");
            ?>
            <div class="description">{{ $item_new_decription }}</div>

            @else
            <div class="img-container">
                <img itemprop="image" src="/upload/items/{{$item['img-thumb']}}" alt="{{$item['title-ua']}}">
                @if($item['new'] == 1)
                <div class="label-new">Новинка!</div>
                @endif
            </div>

            <div class="text-container">
                <h3 itemprop="name">{{ $item['title-ua'] }}</h3>
                <meta itemprop="description" content="{{$item['short-description-ua']}}" />
                @if($item['not-cooked'] == '1')
                <strong><img src="/img/chef.svg" alt="">
                    <p>Для домашнього приготування</p>
                </strong>
                @endif

                <?php
                $item_new_decription = mb_strimwidth($item['short-description-ua'], 0, 85, "...");
                ?>
                <div class="description">{{ $item_new_decription }}</div>

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
                <!-- @if($item['old-price'] != '' && $item['old-price'] != null && $item['old-price'] != $item['price']) -->
                <!-- <div class="price crossed"><div class="price-crossed-container"> <p class="price-numbers" >{{ $item['price'] }}</p><p class="curency">грн.</p><div class="line"></div></div></div>
      <div class="old-price"><p class="price-numbers" itemprop="price" content="{{$item['old-price']}}">{{ $item['old-price'] }}</p><p class="curency" itemprop="priceCurrency" content="UAH">грн.</p></div> -->
                <!-- @else -->
                <!-- <div class="price"><p class="price-numbers" itemprop="price" content="{{$item['price']}}">{{ $item['price'] }}</p><p class="curency" itemprop="priceCurrency" content="UAH">грн.</p></div> -->
                <!-- @endif -->


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


            <div item-id="{{ $item['id'] }}" item-category-id="{{$item['category']}}" item-choice='0' item-price="{{ $itemPriceArray[0] }}" item-title="{{ $item['title-ru'] }}" class="cart button cart_add-item cart-regulator">
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