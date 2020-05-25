<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Order;
use App\Cart;
use App\Item;
use App\CartItem;
use App\OrderItem;
use App\Category;
use App\Promocode;
use Carbon\Carbon;
use Session;
use Mail;

class OrderController extends Controller
{









  public function send(Request $request){
    
    include 'components/Common.php';


    // Данные из запроса
    $input = $request->all();


    // Берём куку корзины
    $cart_id = session('cart_id');

    /* Списки промокодов */
    $promocodes = Promocode::get();

    // Проверка отправленных данных
    if(
      $input['userName'] == null 
      || $input['userPhone'] == null 
      // || $input['userEmail'] == null 
      || $input['userStreet'] == null 
      || $input['userHouse'] == null 
    ){
      return view('errors.503');
    }else{
      if(is_null($cart_id)){
        return view('errors.503');
      }else{

        // Галочка "Отправить в ближаешее время" 
        $delivery_time = 'now';
        if($input["userSoon"] != true){
          $delivery_time = $input["userDate"]." | ".$input["userTime"];
        }

        // Создаем заказ на основе post-данных
        $order_line = Order::create([
          // 'session'=>$cart_id,
          'cart_id'=>$cart_id,
          'status'=>'sended',
          'cost'=>$input['cost'],
          'user_name'=>$input['userName'], 
          'user_phone'=>$input['userPhone'], 
          'user_email'=>$input['userEmail'], 
          'user_delivery-type'=>$input['userDeliveryType'], 
          'user_address-city'=>'Киев', 
          'user_address-street'=>$input['userStreet'], 
          'user_address-house'=>$input['userHouse'], 
          'user_address-flor'=>$input['userFlor'], 
          'user_address-flat'=>$input['userFlat'], 
          'user_delivery-time'=>$delivery_time, 
          'user_promo'=>$input['userPromo'],
          'user_comment'=>$input['userComment']
        ]);

        

        // Ищем все связанные с корзиной товары
        $order_cart = CartItem::where('cart_id', $cart_id)->get();

        $date = Carbon::now();
        $date = $date->toDateTimeString();
        foreach($order_cart as $line){
          // Копируем связь корзина-товар в связь заказ-товар
          OrderItem::create([
            'order_id'=>$line->cart_id,
            'item_id'=>$line->item_id,
            'choice_id'=>$line->choice_id,
            'amount'=>$line->amount,
            'created_at'=>$date,
            'updated_at'=>$date,
          ]);
        }
        
        $item_order = OrderItem::where('order_id', $cart_id)->get();
        foreach($item_order as $cart_elem){
          $items[] = Item::where(['id'=>$cart_elem['item_id']])->first();
        }

        $order_info = [$order_line, $items, $item_order];

        // Удаляем корзину и всё что с ней связано
        Cart::where('id', $cart_id)->delete();
        CartItem::where('cart_id', $cart_id)->delete();
        session()->forget('cart_id');
        // Session::forget('cart_id');

      }












      

      // Предопределяем нужные переменніе
      $mail_to_items = '';
      $order_cart_cost = 0;
      $order_cart_cost_old = 0;
      $order_cart_amount = 0;

      
      foreach($item_order as $cart_elem){

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
        $order_cart_cost = $order_cart_cost+$item_price*$cart_elem['amount'];
        $order_cart_cost_old = $order_cart_cost_old+$item_old_price*$cart_elem['amount'];
        $order_cart_amount = $order_cart_amount+$cart_elem['amount'];

        if($item['weight-currency'] == 1){
          $item_weight='г';
        }else{
          $item_weight='мл';
        }

        // Создаем строчку в письме
        $mail_to_items = $mail_to_items.'<div style="padding-top: 20px;padding-bottom: 20px;border-top:1px solid #EFEFEF">
          <div style="margin-right: 0px; margin-bottom: 0px; width: 150px;height: 150px;overflow:hidden;position: relative; display: inline-block; vertical-align: middle;">
            <img style="position: absolute;top: 0;left:0;height: 100%;width: 100%;object-fit: cover;max-width: 200px; max-height: 200px" src="https://felicita.kitchen/upload/items/'.$item['img-thumb'].'" alt="">
          </div>
          <div style="width:330px;padding-left: 20px; display: inline-block; vertical-align: middle;">
            <h2 style="display:inline-block;width:320px;margin-top:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Helvetica, Arial, sans-serif;margin-bottom:20px;line-height:1.25;font-size:28px;" >'.$item['title-ua'].' - '.$itemWeightArray[$cart_elem['choice_id']].''.$item_weight.'</h2>
            <p style="display:inline-block;width:320px;margin-top:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Helvetica, Arial, sans-serif;line-height:1.65;font-size:16px;font-weight:normal;margin-bottom:20px;">Ціна: '.$item_price.' грн.</p>
            <p style="display:inline-block;width:320px;margin-top:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Helvetica, Arial, sans-serif;line-height:1.65;font-size:16px;font-weight:normal;margin-bottom:20px;">Кількість: '.$cart_elem['amount'].'</p>
              
          </div>
        </div>';
        

          
      } 
      $promoCheck = false;
      $promoType = 0;
      $promoNumber = 0;
      foreach($promocodes as $promocode){
        if($promocode['code'] == $order_line['user_promo']){
          $promoCheck = true;
          $promoType = $promocode['type'];
          $promoNumber = $promocode['number'];
          break;
        }

      }

      if($promoCheck === true){
        if($promoType == 1){
          $promoText = '<br>Знижка за промокодом "'.$promocode['code'].'" - '.$promoNumber.'%';
        }
        
      }else{
        $promoText = '';
      }

      $deliveryAllInfo = '';
      $deliveryDiscount = 0;
      $deliveryDiscountText = '';
      if($order_line['user_delivery-type'] == 'deliver'){
        $deliveryAllInfo = 'місто '.$order_line['user_address-city'].', 
                            вулиця '.$order_line['user_address-street'].', 
                            будинок '.$order_line['user_address-house'];
        if($order_line['user_address-flor'] != ''){
          $deliveryAllInfo = $deliveryAllInfo.', поверх '.$order_line['user_address-flor'];
        }
        if($order_line['user_address-flat'] != ''){
          $deliveryAllInfo = $deliveryAllInfo.', приміщення '.$order_line['user_address-flat'];
        }
      }else if($order_line['user_delivery-type'] == 'self'){
        $deliveryAllInfo = 'самовивіз за адресою вул.Ревуцького 42в';
        $deliveryDiscount = 10;
      }

      if($deliveryDiscount != 0){
        $deliveryDiscountText = '<br>Знижка за самовивіз - '.$deliveryDiscount.'%';
      }


      $finalPrice = $order_cart_cost - ($order_cart_cost/100*$promoNumber);
      $finalPrice = $finalPrice - ($finalPrice/100*$deliveryDiscount);
      $finalPrice = round($finalPrice);
      $finalPriceText = '<br>Разом до сплати: <b>'.$finalPrice.'</b>грн.';

    



      /* Письмо-уведомление АДМИНУ об удачном заказе */

      $mail_to_admin = '
      <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml" style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family: Helvetica, Arial, sans-serif;line-height:1.65;" >
      <head style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family: Helvetica, Arial, sans-serif;line-height:1.65;" >
          
        <meta name="viewport" content="width=device-width" style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Helvetica, Arial, sans-serif;line-height:1.65;" />
      
      </head>
      <body style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Helvetica, Arial, sans-serif;line-height:1.65;width:100% !important;height:100%;background-color:#efefef;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;" >
      <table class="body-wrap" style="margin-top:0px;margin-bottom:0px;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Helvetica, Arial, sans-serif;line-height:1.65;width:100% !important;height:100%;background-color:#efefef;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;" >
        <tr style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Helvetica, Arial, sans-serif;line-height:1.65;" >
          <td class="container" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Helvetica, Arial, sans-serif;line-height:1.65;display:block !important;clear:both !important;margin-top:0 !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:580px !important;" >
  

            <table style="margin-top:50px;margin-bottom:50px;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Helvetica, Arial, sans-serif;line-height:1.65;width:100% !important;border-collapse:collapse;" >
              <tr style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Helvetica, Arial, sans-serif;line-height:1.65;" >
                <td align="center" class="masthead" style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;font-size:100%;font-family:Helvetica, Arial, sans-serif;line-height:1.65;padding-top:20px;padding-bottom:20px;padding-right:0;padding-left:0;background-color:#FBB03B;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;color:white;" >
                  <img src="https://felicita.kitchen/img/logo-circle.png" style="background-color: white;border-radius: 100px;width: 80px;height 80px;" alt="">
                </td>
              </tr>
              <tr style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Helvetica, Arial, sans-serif;line-height:1.65;" >
                <td class="content" style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;font-size:100%;font-family:Helvetica, Arial, sans-serif;line-height:1.65;background-color:white;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:30px;padding-bottom:30px;padding-right:35px;padding-left:35px;" >

                  <p style="text-align: left;margin-top:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Helvetica, Arial, sans-serif;line-height:1.65;font-size:16px;font-weight:normal;margin-bottom:20px;" >
                  Замовлення №<b>'.$order_line['id'].'</b> на суму <b>'.$order_cart_cost.'</b>грн. 
                  '.$promoText.'
                  '.$deliveryDiscountText.'
                  '.$finalPriceText.'
                  <br><br>
                  <i>Ім\'я замовника:</i> '.$order_line['user_name'].' '.$order_line['user_surname'].'<br>
                  <i>Телефон:</i> '.$order_line['user_phone'].'<br>
                  <i>Пошта:</i> '.$order_line['user_email'].'<br>
                  <i>Доставка:</i> '.$deliveryAllInfo.'<br>
                  <i>Коли:</i> '.$order_line['user_delivery-time'].'<br>
                  <i>Промокод:</i> '.$order_line['user_promo'].'<br>
                  <i>Коментар:</i> '.$order_line['user_comment'].'
                  
                  </p><br>

                  '.$mail_to_items.'

                  <table style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Helvetica, Arial, sans-serif;line-height:1.65;width:100% !important;border-collapse:collapse;" >
                    <tr style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Helvetica, Arial, sans-serif;line-height:1.65;" >
                      <td align="center" style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Helvetica, Arial, sans-serif;line-height:1.65;" >
                        <p style="margin-top:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Helvetica, Arial, sans-serif;line-height:1.65;font-size:16px;font-weight:normal;margin-bottom:20px;" >
                          <a href="#" class="button" style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Helvetica, Arial, sans-serif;line-height:1.65;text-decoration:none;display:inline-block;color:white;background-color:#C1272D;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;border-style:solid;border-color:#C1272D;border-width:10px 20px 8px;font-weight:bold;border-radius:4px;" >Перейти на сайт</a>
                        </p>
                      </td>
                    </tr>
                  </table>

                </td>
              </tr>
            </table>
  
          </td>
        </tr>
      </table>
      </body>
      </html>';

      $headersAdmin  = 'MIME-Version: 1.0' . "\r\n";
      $headersAdmin .= 'Content-type: text/html; charset=utf-8' . "\r\n";
      // $headersAdmin .= 'To: FELICITA <order@felicita.kitchen>' . "\r\n";
      $headersAdmin .= 'From: FELICITA <order@felicita.kitchen>' . "\r\n";
      mail(
        'order@felicita.kitchen, novikserj@gmail.com', 
        'Новая заявка', 
        $mail_to_admin, 
        $headersAdmin
      );







      /* Письмо-уведомление Пользователю об удачном заказе */

      if($order_line['user_email'] != ''){

        $mail_to_user = '
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family: Helvetica, Arial, sans-serif;line-height:1.65;" >
        <head style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family: Helvetica, Arial, sans-serif;line-height:1.65;" >
            
          <meta name="viewport" content="width=device-width" style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Helvetica, Arial, sans-serif;line-height:1.65;" />
        
        </head>
        <body style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Helvetica, Arial, sans-serif;line-height:1.65;width:100% !important;height:100%;background-color:#efefef;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;" >
        <table class="body-wrap" style="margin-top:0px;margin-bottom:0px;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Helvetica, Arial, sans-serif;line-height:1.65;width:100% !important;height:100%;background-color:#efefef;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;" >
          <tr style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Helvetica, Arial, sans-serif;line-height:1.65;" >
            <td class="container" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Helvetica, Arial, sans-serif;line-height:1.65;display:block !important;clear:both !important;margin-top:0 !important;margin-bottom:0 !important;margin-right:auto !important;margin-left:auto !important;max-width:580px !important;" >
    

              <table style="margin-top:50px;margin-bottom:50px;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Helvetica, Arial, sans-serif;line-height:1.65;width:100% !important;border-collapse:collapse;" >
                <tr style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Helvetica, Arial, sans-serif;line-height:1.65;" >
                  <td align="center" class="masthead" style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;font-size:100%;font-family:Helvetica, Arial, sans-serif;line-height:1.65;padding-top:20px;padding-bottom:20px;padding-right:0;padding-left:0;background-color:#FBB03B;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;color:white;" >
                    <img src="https://felicita.kitchen/img/logo-circle.png" style="background-color: white;border-radius: 100px;width: 80px;height 80px;" alt="">
                  </td>
                </tr>
                <tr style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Helvetica, Arial, sans-serif;line-height:1.65;" >
                  <td class="content" style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;font-size:100%;font-family:Helvetica, Arial, sans-serif;line-height:1.65;background-color:white;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;padding-top:30px;padding-bottom:30px;padding-right:35px;padding-left:35px;" >

                    <p style="text-align: left;margin-top:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Helvetica, Arial, sans-serif;line-height:1.65;font-size:16px;font-weight:normal;margin-bottom:20px;" >
                    Дякуємо, '.$order_line['user_name'].'! <br>
                    Замовлення №<b>'.$order_line['id'].'</b> на суму <b>'.$order_cart_cost.'</b>грн. прийняте. 
                    '.$promoText.'
                    '.$deliveryDiscountText.'
                    '.$finalPriceText.'
                    <br>
                    
                    </p>

                    '.$mail_to_items.'

                    <table style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Helvetica, Arial, sans-serif;line-height:1.65;width:100% !important;border-collapse:collapse;" >
                      <tr style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Helvetica, Arial, sans-serif;line-height:1.65;" >
                        <td align="center" style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Helvetica, Arial, sans-serif;line-height:1.65;" >
                          <p style="margin-top:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:Helvetica, Arial, sans-serif;line-height:1.65;font-size:16px;font-weight:normal;margin-bottom:20px;" >
                            <a href="#" class="button" style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-size:100%;font-family:Helvetica, Arial, sans-serif;line-height:1.65;text-decoration:none;display:inline-block;color:white;background-color:#C1272D;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;border-style:solid;border-color:#C1272D;border-width:10px 20px 8px;font-weight:bold;border-radius:4px;" >Перейти на сайт</a>
                          </p>
                        </td>
                      </tr>
                    </table>

                  </td>
                </tr>
              </table>
    
            </td>
          </tr>
        </table>
        </body>
        </html>';

        $headersUser  = 'MIME-Version: 1.0' . "\r\n";
        $headersUser .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        // $headersUser .= 'To: FELICITA <order@felicita.kitchen>' . "\r\n";
        $headersUser .= 'From: FELICITA <order@felicita.kitchen>' . "\r\n";
        mail(
          $order_line['user_email'], 
          'Замовлення прийняте!', 
          $mail_to_user, 
          $headersUser
        );

      }









      // Вывод ответа от сервера
      return $order_info;


    }

  }



















  public function thankyou(Request $request){
    $request_link = 'thankyou';

    include 'components/Common.php';

    /* Вывод */
    return view('thankyou', compact('request_link', 'lang_session', 'categories', 'cart_amount', 'cart_cost', 'cart_cost_old'));

  }
}
