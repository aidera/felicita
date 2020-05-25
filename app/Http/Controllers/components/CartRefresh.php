<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Cart;
use App\CartItem;
use App\Item;
use Session;




  /* Корзина */
  $cart_amount = 0;
  $cart_cost = 0;
  $cart_cost_old = 0;
  $cart_id = session('cart_id');
  $user_cart = '';

  if(!is_null($cart_id)) {
    $user_cart = Cart::find($cart_id);
    if($user_cart){
      $related_items = CartItem::where(['cart_id' => $cart_id])->get();
      foreach($related_items as $cart_elem){
        // Определяем item в строке корзины
        $item = Item::where(['id'=>$cart_elem['item_id']])->first();
        
        // Определяем его выбираемые свойства
        $itemPriceArray = explode(";", $item['price']);
        $itemOldPriceArray = explode(";", $item['old-price']);
        $itemWeightArray = explode(";", $item['weight']);
        $itemChoiceCount = count($itemPriceArray);

        // Определяем цену из выбираемых свойств
        $item_price = $itemPriceArray[$cart_elem['choice_id']];
        
        if(count($itemOldPriceArray)<=1){
          if($itemOldPriceArray[0] == null || $itemOldPriceArray[0] == '' || $itemOldPriceArray[0] == 'null'){
            $item_old_price = null;
          }else{
            $item_old_price = $itemOldPriceArray[0];
          }
        }else{
          $item_old_price = $itemOldPriceArray[$cart_elem['choice_id']];
        }
        
        if($item_old_price == '' || $item_old_price == null || $item_old_price == 'null'){
          $item_old_price = $item_price;
        }

        // Плюсуем цены и количество
        $cart_cost = $cart_cost+$item_price*$cart_elem['amount'];
        $cart_cost_old = $cart_cost_old+$item_old_price*$cart_elem['amount'];
        $cart_amount = $cart_amount+$cart_elem['amount'];
      } 
    }else{
      $user_cart = '';
      $related_items = '';
    }
  }

  




?>