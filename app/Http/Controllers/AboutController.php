<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
  public function index(){
    $request_link = 'about';

    include 'components/Common.php';

    /* Вывод */
    return view('about', compact('request_link', 'lang_session', 'categories', 'cart_amount', 'cart_cost', 'cart_cost_old'));
  }
}
