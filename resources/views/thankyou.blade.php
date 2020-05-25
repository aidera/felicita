@extends('layout')


@if($lang_session == 'ru')
    @section('title', 'FELICITA - Спасибо за Ваш заказ!')
    @section('keywords', 'спасибо, спасибо за ваш заказ, спасибо за заказ, заказ FELICITA')
    @section('description', 'Быстрая доставка настоящей итальянской кухни: паста, равиолли, прошутто, спагетти. Специальные предложения для мероприятий. Попробуй Италию на вкус!')
@else
    @section('title', 'FELICITA - Дякуємо за Ваше замовлення!')
    @section('keywords', 'дякуємо, дякуємо за ваше замовлення, дякуємо за замовлення, замовлення FELICITA')
    @section('description', 'Швидка доставка справжньої італійської кухні: паста, равіолі, прошутто, спагетті. Спеціальні пропозиції для заходів. Спробуй Італію на смак!')
@endif
@section('img', './img/logo-og.png')
@section('robots', 'noindex')
@section('content')





<div id="thankyou-container">
    @if($lang_session == 'ru')
    <img src="/img/smile.svg" alt="FELICITA - спасибо за заказ">
    <h2>Спасибо!</h2>
    <p>Ваш заказ оформлен</p>
    <a class="button" href="/ru/">На главную</a>
    @else
    <img src="/img/smile.svg" alt="FELICITA - дякуємо за замовлення">
    <h2>Дякуємо!</h2>
    <p>Ваше замовлення оформлено</p>
    <a class="button" href="/ua/">На головну</a>
    @endif
</div>









@endsection