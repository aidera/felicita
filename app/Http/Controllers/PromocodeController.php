<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Promocode;

class PromocodeController extends Controller
{


  public function check(Request $request){

    // Данные из запроса
    $input = $request->all();

    $currentValue = $input['promo'];

    /* Списки промокодов */
    $promocodes = Promocode::get();

    $answer = 0;
    $foundPromo = '';

    // Проверка промокода
    foreach($promocodes as $promocode){
      if($currentValue == $promocode['code']){
        $answer = 1;
        $foundPromo = $promocode;
        break;
      }
    }

    if($answer == 1){
      return $foundPromo;
    }else{
      return 0;
    }

    

  }

}
