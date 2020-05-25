<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <link rel="icon" href="/favicon.ico" type="image/x-icon">

  <meta name="keywords" content="error 503">
  <meta name="description" content="Ошибка 503">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="FELICITA - доставка італійської кухні в Києві">
  <meta property="og:title" content="Сторінку не знайдено - Помилка 503">
  <meta property="og:description" content="Сторінку не знайдено - Помилка 503')">
  <meta property="og:url" content="{{$_SERVER['HTTP_HOST'].''.$_SERVER['REQUEST_URI']}}">
  <meta property="og:image" content="/img/logo-og.png">
  
  <link rel="stylesheet" href="/css/app.css">
  
  
  <title>Сторінку не знайдено - Помилка 504</title>
</head>


<body>
  <div id="preloader"><img src="/img/logo.svg" alt="FELICITA логотип"></div>
  <div id="overlay"></div>


  <section id="error-page">
    <img src="/img/logo.svg" alt="Сторінку не знайдено - Помилка 503">
    <h1>Відповідь від сервера прийшов невірний</h1>
    <a href="/" class="button">На головну</a>
  </section>

  
  <script src="/js/app.js"></script>
  </body>
</html>




