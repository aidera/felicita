@extends('layout')

@if($lang_session == 'ru')
    @section('title', 'FELICITA - Доставка итальянской кухни в Киеве')
    @section('keywords', 'FELICITA, доставка итальянской кухни, доставка пасты, доставка италии, доставка италия, ресторан итальянской куни, итальянский ресторан')
    @section('description', 'Быстрая доставка настоящей итальянской кухни: паста, равиоли, прошутто, спагетти. Специальные предложения для мероприятий. Попробуй Италию на вкус!')
@else
    @section('title', 'FELICITA - Доставка італійської кухні в Києві')
    @section('keywords', 'FELICITA, доставка італійської кухні, доставка пасти, доставка італії, доставка італія, ресторан італійської куни, італійський ресторан')
    @section('description', 'Швидка доставка справжньої італійської кухні: паста, равіоллі, прошутто, спагетті. Спеціальні пропозиції для заходів. Спробуй Італію на смак!')
@endif
@section('img', './img/logo-og.png')
@section('robots', 'index, follow')






@section('content')



<section class="general-image" id="general-image_index">
    <div class="pre-img"></div>
    <div class="img"></div>
    <div class="banner-overlay"></div>
    <div class="page-container">

        @include('components.header-static')
        <div class="banner-text">
            <h1>FELICITA</h1>
            <p>`</p>
            @if ($lang_session == 'ru')
            <h2>Доставка итальянской кухни в Киеве</h2>
            <a class="bunner-button scrollto" href="#items">Заказать</a>
            @else
            <h2>Доставка італійської кухні в Києві</h2>
            <a class="bunner-button scrollto" href="#items">Замовити</a>
            @endif
        </div>
    </div>
</section>



<section id="promos">
    <div class="page-container">

        <div class="promos-container">
            <div class="promo wide promo-3">
                <div class='img'></div>
            </div>
            <div class="promo wide promo-1">
                <div class='img'></div>
            </div>
            <div class="promo wide promo-2">
                <div class='img'></div>
            </div>
            
        </div>
            

    </div>
</section>


<section id="items">
    <div class="page-container">

        @foreach ($categories as $category)

        <div class="category" id="category_{{$category['link']}}">
            @if ($lang_session == 'ru')
            <h2 class="header-separator">{{$category['title-ru']}}</h2>
            @else
            <h2 class="header-separator">{{$category['title-ua']}}</h2>
            @endif
            @if($category['id'] == 7)
            <div class="ravioli-additional">
                <ul>
                    @if ($lang_session == 'ru')
                    <li>
                        <img src="/img/ravioli.svg" alt="Равиоли">
                        <p>Выбери равиоли, что тебе нравятся</p>
                    </li>
                    <li>
                        <img src="/img/sauce.svg" alt="Соус">
                        <p>Добавь желаемый соус или добавку.</p>
                    </li>
                    <li>
                        <img src="/img/chef.svg" alt="Готовить">
                        <p>Заказывай, получай и готовь наивкуснейшие равиоли дома!
                            Способ приготовления найдёшь по QR-коду на упаковке или на сайте</p>
                    </li>
                    @else
                    <li>
                        <img src="/img/ravioli.svg" alt="Равіолі">
                        <p>Обери равіолі, що тобі до смаку</p>
                    </li>
                    <li>
                        <img src="/img/sauce.svg" alt="Соус">
                        <p>Додай бажаний соус або добавку.</p>
                    </li>
                    <li>
                        <img src="/img/chef.svg" alt="Готувати">
                        <p>Замовляй, отримуй та готуй найсмачниші равіолі вдома!
                            Спосіб приготування знайдеш по QR-коду на упаковці або на сайті</p>
                    </li>
                    @endif
                </ul>
            </div>
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