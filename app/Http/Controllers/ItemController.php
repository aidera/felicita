<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Item;

class ItemController extends Controller
{
  public function item($itemlink){
    $request_link = 'menu/'.$itemlink;

    include 'components/Common.php';

    /* Товары */
    $items = Item::where('_visible',1)->orderBy('priority', 'desc')->get();
    
    /* Текущий товар */
    $item = Item::where('link', $itemlink)->first();

    
    
    
    /* Вывод */
    //если товар введен правильно/неправильно
    if($item != null){

      /* Списки категорий для вывода похожих товаров */
      $item_categories = explode(", ", $item['category']);
      $item_categories = Category::whereIn('id', $item_categories)->get();

      return view('item', compact('request_link', 'lang_session', 'item', 'items', 'item_categories', 'categories', 'cart_amount', 'cart_cost', 'cart_cost_old'));
    }else{
      return view('errors.404');
    }
      
  }
}
