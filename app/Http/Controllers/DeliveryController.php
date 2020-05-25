<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeliveryController extends Controller
{
  public function index(){
    $request_link = 'delivery';

    include 'components/Common.php';

    /* Вывод */
    return view('delivery', compact('request_link', 'lang_session', 'categories', 'cart_amount', 'cart_cost', 'cart_cost_old'));
  }
}
