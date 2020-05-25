<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
  public function index(){
    $request_link = 'privacy-policy';

    include 'components/Common.php';

    /* Вывод */
    return view('privacy-policy', compact('request_link', 'lang_session', 'categories', 'cart_amount', 'cart_cost', 'cart_cost_old'));
  }
}
