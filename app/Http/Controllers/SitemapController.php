<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Item;

class SitemapController extends Controller
{









  public function index(){
    $request_link = 'sitemap';

    include 'components/Common.php';

    /* Товары */
    $items = Item::where('_visible',1)->orderBy('priority', 'desc')->get();

    /* Вывод */
    return view('sitemap', compact('request_link', 'lang_session','items', 'categories', 'cart_amount', 'cart_cost', 'cart_cost_old'));
  }






  public function example(){

    /* Товары */
    $items = Item::orderBy('priority', 'desc')->get();

    /* Вывод */
    return view('sitemap-example', compact('items'));


  }








}
