<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermsOfUseController extends Controller
{
  public function index(){
    $request_link = 'terms-of-use';

    include 'components/Common.php';

    /* Вывод */
    return view('terms-of-use', compact('request_link', 'lang_session', 'categories', 'cart_amount', 'cart_cost', 'cart_cost_old'));
  }
}
