@extends('layout')

@if($lang_session == 'ru')
    @section('title', 'FELICITA - О нас')
    @section('keywords', 'о нас, о ресторане, о кухне, о компании')
    @section('description', 'FELICITA - не просто ресторан, а настоящая итальянская семья. Самые лучшие ингридиенты и самые лучшие повара.')
@else
    @section('title', 'FELICITA - Про нас')
    @section('keywords', 'про нас, про ресторані, про кухню, про компанії')
    @section("description", "FELICITA - не просто ресторан, а справжня італійська сім'я. Найкращі інгредієнти і найкращі кухарі.")
@endif
@section('img', './img/logo-og.png')
@section('robots', 'index, follow')






@section('content')



<section class="general-image" id="general-image_about">
    <div class="pre-img"></div>
    <div class="img"></div>
    <div class="banner-overlay"></div>
    <div class="page-container">

        @include('components.header-static')

        <div class="banner-text">
            @if ($lang_session == 'ru')
            <h1>О нас</h1>
            <h2>Приветствуем тебя!</h2>
            <b>И добро пожаловать на нашу кухню</b>
            @else
            <h1>Про нас</h1>
            <h2>Вітаємо тебе!</h2>
            <b>І ласкаво просимо на нашу кухню</b>
            @endif
        </div>

    </div>
</section>
<section id="about-section-2">
    <div class="page-container">
        <div class="block-continer block-continer_1">
            <div class="about-section_block about-section_block_1">
                <div class="img-container">
                    <img src="/img/about/section-family.jpg" alt="family">
                </div>
                <div class="text-container">
                    @if ($lang_session == 'ru')
                    Мы – твоя новая итальянская семья!
                    <br>
                    Именно так... ведь в семье главное что? Правильно!
                    <br><br>
                    Счастье!
                    <br><br>
                    А счастье на итальянском – <i class="special">
                        <p class="text">FELICITA</p>
                        <p class="apostr">'</p>
                    </i>
                    @else
                    Ми – твоя нова італійська сім’я!
                    <br>
                    Саме так... бо що в сім’Ї головне? Правильно!
                    <br><br>
                    Щастя!
                    <br><br>
                    А щастя на італійській – <i class="special">
                        <p class="text">FELICITA</p>
                        <p class="apostr">'</p>
                    </i>
                    @endif
                </div>
            </div>
        </div>
        <div class="block-continer block-continer_2">
            <div class="about-section_block about-section_block_2">

                <div class="text-container">
                    @if ($lang_session == 'ru')
                    На нашей домашней кухне мы воплощаем качественные продукты, традициях и любовь - в итальянские равиоли, и привозим все к тебе домой.
                    @else
                    На нашій домашній кухні ми втілюємо якісні продукти, традіціЇ та любов - у італійські равіолі, та привозимо все до тебе додому.
                    @endif
                </div>
                <div class="img-container">
                    <img src="/img/about/section-ravioli.jpg" alt="ravioli">
                </div>
            </div>
        </div>
        <div class="block-continer block-continer_3">
            <div class="about-section_block about-section_block_3">
                <div class="img-container">
                    <img src="/img/about/section-grandma.jpg" alt="grandma">
                </div>
                <div class="text-container">
                    @if ($lang_session == 'ru')
                    Але ми вважаємо цього не достатньо і попіклувалися, щоб наші страви смакували на твоєму столі також гарно, як у італійської бабусі десь-там в Тоскані чи на Сицилії.
                    <br><br>
                    Ото-ж отримаєш просту та швидку інструкцію як приготувати кулінарний шедевр з наших інгредієнтів та пригостити сім’ю та друзів.
                    <br><br>
                    І потім нехай тільки хтось спробує сказати що це не ти готував ;)
                    @else
                    Але ми вважаємо цього не достатньо і попіклувалися, щоб наші страви смакували на твоєму столі також гарно, як у італійської бабусі десь-там в Тоскані чи на Сицилії. Ото-ж отримаєш просту та швидку інструкцію як приготувати кулінарний шедевр з наших інгредієнтів та пригостити сім’ю та друзів. І потім нехай тільки хтось спробує сказати що це не ти готував ;)
                    @endif
                </div>
            </div>
        </div>
    </div>


</section>

<section id="about-section-3">
    <div class="img" style="background-image: url(/img/about/section-bottles.jpg)"></div>
    <div class="banner-overlay"></div>
    <div class="page-container">

        <div class="banner-text">
            @if ($lang_session == 'ru')
            <p>У нас нет секретов!
                <br><br>
                Тесто готовим из настоящей итальянской био муки и яиц высшого сорту с ферм, которые не используют вредные добавки и антибиотики, ведь среди нас есть и маленькие любители равиолек.
                <br><br>
                Ну что говорить – делаем как для своей настоящей семьи!
                <br><br>
                Если индейка и мясо – только отборное, если рыба – только свежак.
                А пармезан? – Конечно, итальянский, настоящий. Бабушка передавала ... Ээхх... аж во рту взмокло от голода ...
            </p>
            @else
            <p>В нас немає вид тебе секретів!
                <br><br>
                Тісто готуємо з якісної італійської біо муки та з яєць вищого сорту від ферм, які не використовують шкідливі добавки та антибіотики адже серед нас і маленькі шанувальники равіольок.
                <br><br>
                Та що казати – робимо як для своєї справжньої сім’ї!
                <br><br>
                Якщо індичка та м’ясо – тільки відбірне, якщо риба – тільки свіжак.
                А пармезан? – Звісно, італійський, справжнісінький. Бабуся передавала... Еехх... аж в роті змокло від голоду…
            </p>
            @endif
        </div>

    </div>
</section>

<section id="about-section-3">
    <div class="page-container">
        <div class="block-continer block-continer_1">
            <div class="about-section_block about-section_block_1">
                <div class="img-container">
                    <img src="/img/about/section-sauce.jpg" alt="sauce">
                </div>
                <div class="text-container">
                    @if ($lang_session == 'ru')
                    Выбирай свои равиоли и не забудь подсказать нам Какой соус тебе более подходит.
                    <br><br>
                    А если даже не знаешь - мы подскажем. Держи 3 разных и найди свою любимую комбинацию!

                    @else
                    Обирай свої равіолі та не забудь підказати нам який соус тобі більше смакує.
                    <br><br>
                    А якщо навіть гадки не маєш – ми підкажемо. Тримай 3 різних і знайди свою улюблену комбінацію!
                    @endif
                </div>
            </div>
        </div>
        <div class="block-continer block-continer_2">
            <div class="about-section_block about-section_block_2">

                <div class="text-container">
                    @if ($lang_session == 'ru')
                    Ну что? Хочешь без перцу чили или поострее?
                    <br><br>
                    Ещё немного пармезанчику?
                    <br><br>
                    Скажи нам - мы угощаем!
                    @else
                    Ну що? Хочеш без перцю чилі чи погостріше?
                    <br><br>
                    Ще трішки пармезанчику?
                    <br><br>
                    Скажи нам – ми пригощаємо!
                    @endif
                </div>
                <div class="img-container">
                    <img src="/img/about/section-parmesan.jpg" alt="parmesan">
                </div>
            </div>
        </div>

    </div>


</section>

<section id="about-section-5">
    <div class="img" style="background-image: url('/img/about/last.jpg')"></div>
    <div class="banner-overlay"></div>
    <div class="page-container">

        <div class="banner-text">
            @if ($lang_session == 'ru')
            <strong>А теперь "Буон Аппетито, амико", как говорят в Италии! <br> Пробуй и пиши нам обязательно, как тебе.</strong>
            <h2><b>FELICITA<i>`</i></b> <br>
                <p>в каждый дом!<p>
            </h2>
            <a class="bunner-button" href="/ru/">На главную</a>
            @else
            <strong>А тепер "Буон Аппетіто, аміко", як кажуть в Iталії! <br> Куштуй та пиши нам обов’язково як тобі.</strong>
            <h2><b>FELICITA<i>`</i></b> <br>
                <p>у кожен дім!<p>
            </h2>
            <a class="bunner-button scrollto" href="/ua/">На головну</a>
            @endif



        </div>

    </div>
</section>










@endsection