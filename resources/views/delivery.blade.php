@extends('layout')

@if($lang_session == 'ru')
    @section('title', 'FELICITA - Контакты и доставка')
    @section('keywords', 'контакты, адрес, телефон, доставка')
    @section('description', 'FELICITA - контакты, телефоны, доставка, адрес доставки. Киев и Киевская область.')
@else
    @section('title', 'FELICITA - Контакти і доставка')
    @section('keywords', 'контакти, адреса, телефон')
    @section('description', 'FELICITA - контакти, телефони, доставка, адресу доставки. Київ і Київська область.')
@endif
@section('img', './img/logo-og.png')
@section('robots', 'index, follow')






@section('content')



<section class="general-image" id="general-image_contacts">
    <div class="pre-img"></div>
    <div class="img"></div>
    <div class="banner-overlay"></div>
    <div class="page-container">

        @include('components.header-static')

        <!-- <div class="banner-text">
          @if ($lang_session == 'ru') 
          <h1>Доставка и оплата</h1>
          @else
          <h1>Доставка i оплата</h1>
          @endif
          <br>
          @if ($lang_session == 'ru') 
          <a class="bunner-button scrollto" href="/ru/">На главную</a>
          @else
          <a class="bunner-button scrollto" href="/ua/">На головну</a>
          @endif
      </div> -->
        <div class="contacts-container">

            <div class="delivery">
                @if ($lang_session == 'ru')
                <h1>Доставка и оплата</h1>
                Доставка производится БЕСПЛАТНО по городу Киев.
                <br><br>
                с 12:00 до 24:00
                <br><br>
                Перед выполнением заказа с Вами свяжется наш курьер для подтверждения заявки и согласования времени доставки.
                <br><br>
                Время доставки - от 30 до 120 минут.
                <br><br>
                Оплата производится наличными или переводом денег на карту Приват/Моно/Альфа банка.


                @else
                <h1>Доставка i оплата</h1>
                Доставка проводиться БЕЗКОШТОВНО по місту Київ.
                <br><br>
                з 12:00 до 24:00
                <br><br>
                Перед виконанням замовлення з Вами зв'яжеться наш кур'єр для підтвердження заявки і узгодження часу доставки.
                <br><br>
                Час доставки - від 30 до 120 хвилин.
                <br><br>
                Оплата здійснюється готівкою або переказом коштів на картку Приват/Моно/Альфа банку.

                @endif

            </div>

            <div class="phones">
                <a rel="nofollow" class="trigger-contacts-call" href="tel:+380934404001"><img src="/img/phone_black.svg" alt="FELICITA phone">
                    <p>+38 (093) 440-40-01</p>
                </a>
                <a title="Viber" class="trigger-contacts-call" href="viber://add?number=+380934404001"><img src="/img/viber_color.svg" alt="FELICITA Viber">
                    <p>+38 (093) 440-40-01</p>
                </a>
                <a title="WhatsApp" class="trigger-contacts-call" href="whatsapp://send?phone=+380934404001"><img src="/img/whatsapp_color.svg" alt="FELICITA WhatsApp">
                    <p>+38 (093) 440-40-01</p>
                </a>
            </div>
            <div class="socials">
                <a target="_blank" rel="nofollow" href="https://www.facebook.com/felicita.kitchen/"><img src="/img/facebook_color.svg" alt="FELICITA Facebook">
                    <p>Facebook</p>
                </a>
                <a target="_blank" rel="nofollow" href="https://www.instagram.com/_felicita.kitchen_/"><img src="/img/instagram_color.svg" alt="FELICITA Instagram">
                    <p>Instagram</p>
                </a>
            </div>

            <div class="map">
                @if ($lang_session == 'ru')
                <p>Возможен самовывоз по адресу: г.Киев, ул.Ревуцкого, д.42В</p>
                @else
                <p>Є можливість самовивозу за адресою: м.Київ, вул.Ревуцького, д.42В</p>
                @endif
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2543.2692202801036!2d30.649423815613858!3d50.39882007946828!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4c450b5da11b1%3A0x4f687a5381b3f4b8!2z0YPQuy4g0KDQtdCy0YPRhtC60L7Qs9C-LCA0MtCSLCDQmtC40LXQsiwgMDIwMDA!5e0!3m2!1sru!2sua!4v1586173172314!5m2!1sru!2sua" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>


        </div>

    </div>
</section>










@endsection