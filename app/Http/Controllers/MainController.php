<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Item;
use Session;


class MainController extends Controller
{
  public function index_redirect(){


    if (\Request::is('/ru/*')) { 
      session(['lang' => 'ru']);
      return redirect('/ru');
    }else{
      if(session('lang') == 'ru'){
        session(['lang' => 'ru']);
        return redirect('/ru');
      }else{
        session(['lang' => 'ua']);
        return redirect('/ua');
      }
    }

    $lang_session = session('lang');
      

  }


  public function index(){

    $request_link = '';

    include 'components/Common.php';

    /* Товары */
    $items = Item::where('_visible',1)->orderBy('priority', 'desc')->get();
    

    /* Вывод */
    return view('index', compact('request_link', 'lang_session', 'items', 'categories', 'cart_amount', 'cart_cost', 'cart_cost_old'));
  }



    
    
    
}
