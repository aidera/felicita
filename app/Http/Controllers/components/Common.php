<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Cart;
use App\CartItem;
use App\Item;
use Session;




  /* Настройки языка */
  if (\Request::is('ru*')) { 
    session(['lang' => 'ru']);
  }else{
    session(['lang' => 'ua']);
  }

  $lang_session = session('lang');


  /* Списки категорий */
  $categories = Category::where('_visible',1)->orderBy('priority', 'desc')->get();



  include 'CartRefresh.php';


  




?>