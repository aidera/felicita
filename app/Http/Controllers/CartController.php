<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Item;
use App\Cart;
use App\CartItem;
use App\Promocode;

class CartController extends Controller
{











  public function index(){
    $request_link = 'cart';

   
    include 'components/Common.php';


    if($user_cart != ''){
      $cart_lines = CartItem::where(['cart_id' => $user_cart['id']])->get();
      $cart_items = [];
      foreach($cart_lines as $cart_line){
        $a = Item::where('id', $cart_line['item_id'])->first();
        $a['choice_id'] = $cart_line['choice_id'];
        $a['amount'] = $cart_line['amount'];
        $cart_items[] = $a;
      }
    }else{
      $cart_lines = '';
      $cart_items = '';
    }

    

    


    /* Вывод */
    return view('cart', compact('request_link', 'lang_session', 'user_cart', 'categories', 'cart_amount', 'cart_cost', 'cart_cost_old', 'cart_lines', 'cart_items'));
  }













  public function add(Request $request){
    // Данные из запроса
    $input = $request->all();
    $item_id = $input['item'];
    $item_choice = $input['itemChoice'];

    // Берём куку корзины
    $cart_id = session('cart_id');

    // Если корзина пуста, то создаем новую строку в таблице "Корзина"
    if(is_null($cart_id) || $cart_id == ''){
      
      $cart_create = Cart::create();
      $cart_id = $cart_create->id;
      $cart_line = Cart::find($cart_id);
      session(['cart_id' => $cart_id]);

      $related_cart_create = CartItem::create(['item_id' => $item_id,'cart_id' => $cart_id,'choice_id' => $item_choice]);
      return response()->json(['product added'=>$item_id, 'amount'=>1]);
    // Иначе ищем существующие строки
    }else{
      $cart_line = Cart::find($cart_id);

      if(is_null($cart_line)){
        $cart_create = Cart::create();
        $cart_id = $cart_create->id;
        $cart_line = Cart::find($cart_id);
        session(['cart_id' => $cart_id]);
        $related_cart_create = CartItem::create(['item_id' => $item_id,'cart_id' => $cart_id,'choice_id' => $item_choice]);
        return response()->json(['product added'=>$item_id, 'amount'=>1]);
      }else{
        
        $cart_item_line = CartItem::where(['cart_id' => $cart_id, 'item_id' => $item_id, 'choice_id' => $item_choice]);
        
        // Если текущий item не существует в таблице, то создаем новую строку в таблице cart-item
        if(is_null($cart_item_line->first()) || $cart_item_line->first() == ''){
          $related_cart_create = CartItem::create(['item_id' => $item_id,'cart_id' => $cart_id,'choice_id' => $item_choice]);
          return response()->json(['product added'=>$item_id, 'amount'=>1]);
        }else{
          // Иначе ищем существующий и делаем +1
          $cart_item_data = $cart_item_line->first();
          $cart_item_line->update(['amount' => $cart_item_data['amount']+1]);
          return response()->json(['product added'=>$item_id, 'amount'=>$cart_item_data['amount']+1]);
        }
        
      }

    }
    

    // Отдаем ответ
    return response()->json(['product added'=>$item_id, 'amount'=>$cart_item_data['amount']+1]);

  }













  public function plus(Request $request){

    // Данные из запроса
    $input = $request->all();
    $item_id = $input['item'];
    $item_choice = $input['itemChoice'];

    // Берём куку корзины
    $cart_id = session('cart_id');

    // Если корзина пуста, то создаем новую строку в таблице "Корзина"
    if(is_null($cart_id) || $cart_id == ''){
      
      $cart_create = Cart::create();
      $cart_id = $cart_create->id;
      $cart_line = Cart::find($cart_id);
      session(['cart_id' => $cart_id]);

      $related_cart_create = CartItem::create(['item_id' => $item_id,'cart_id' => $cart_id,'choice_id' => $item_choice]);

    // Иначе ищем существующие строки
    }else{
      $cart_line = Cart::find($cart_id);
      

      if(is_null($cart_line)){
        $cart_create = Cart::create();
        $cart_id = $cart_create->id;
        $cart_line = Cart::find($cart_id);
        session(['cart_id' => $cart_id]);
        $related_cart_create = CartItem::create(['item_id' => $item_id,'cart_id' => $cart_id,'choice_id' => $item_choice]);
      }else{
        
        
        $cart_item_line = CartItem::where(['cart_id' => $cart_id, 'item_id' => $item_id, 'choice_id' => $item_choice]);
        
        
        // Если текущий item не существует в таблице, то возвращаем ошибку
        if(is_null($cart_item_line->first()) || $cart_item_line->first() == ''){
          return response()->json(['no product to plus'=>$item_id]);
        }else{
          // Иначе ищем существующий и делаем +1
          $cart_item_data = $cart_item_line->first();
          $cart_item_line->update(['amount' => $cart_item_data['amount']+1]);
        }
      
      }

      
    }

    return response()->json(['product plused'=>$item_id,'amount'=>$cart_item_data['amount']+1]);

  }

  
















  public function minus(Request $request){

    // Данные из запроса
    $input = $request->all();
    $item_id = $input['item'];
    $item_choice = $input['itemChoice'];

    // Берём куку корзины
    $cart_id = session('cart_id');

    // Если корзина пуста, то создаем новую строку в таблице "Корзина"
    if(is_null($cart_id) || $cart_id == ''){
      
      $cart_create = Cart::create();
      $cart_id = $cart_create->id;
      $cart_line = Cart::find($cart_id);
      session(['cart_id' => $cart_id]);

      $related_cart_create = CartItem::create(['item_id' => $item_id,'cart_id' => $cart_id,'choice_id' => $item_choice]);

    // Иначе ищем существующие строки
    }else{
      $cart_line = Cart::find($cart_id);  

      if(is_null($cart_line)){
        $cart_create = Cart::create();
        $cart_id = $cart_create->id;
        $cart_line = Cart::find($cart_id);
        session(['cart_id' => $cart_id]);
        $related_cart_create = CartItem::create(['item_id' => $item_id,'cart_id' => $cart_id,'choice_id' => $item_choice]);
      }else{
    
        $cart_item_line = CartItem::where(['cart_id' => $cart_id, 'item_id' => $item_id, 'choice_id' => $item_choice]);
        
        // Если текущий item не существует в таблице, то возвращаем ошибку
        if(is_null($cart_item_line->first()) || $cart_item_line->first() == ''){
          return response()->json(['no product to minus'=>$item_id]);
        }else{
          // Иначе ищем существующий и делаем -1
          $cart_item_data = $cart_item_line->first();
          if($cart_item_data['amount'] <= 1){
            $cart_item_line->delete();
          }else{
            $cart_item_line->update(['amount' => $cart_item_data['amount']-1]);
          }
          
        }
      
      }

      
    }

    return response()->json(['product minused'=>$item_id,'amount'=>$cart_item_data['amount']-1]);


  }














  public function remove(Request $request){

    // Данные из запроса
    $input = $request->all();
    $item_id = $input['item'];
    $item_choice = $input['itemChoice'];

    // Берём куку корзины
    $cart_id = session('cart_id');

    // Если корзина пуста, то создаем новую строку в таблице "Корзина"
    if(!is_null($cart_id) || $cart_id != ''){
      $cart_line = Cart::find($cart_id);
      $cart_item_line = CartItem::where(['cart_id' => $cart_id, 'item_id' => $item_id, 'choice_id' => $item_choice])->delete();
    }

    return response()->json(['product deleted'=>$item_id,'amount'=>0]);

  }














  public function check(Request $request){

    include 'components/CartRefresh.php';

    // Отдаем ответ
    return response()->json(['cart amount'=>$cart_amount, 'cart cost'=>$cart_cost, 'cart cost old'=>$cart_cost_old]);

  }
}
