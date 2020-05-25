<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;

class Order extends Model
{
  // public function items(){
  //     return $this->belongsToMany(Item::class)->withPivot('amount')->withTimestamps();
  // }
  // protected $primaryKey = 'id';
  protected $fillable = [ 'session', 
                          'cart_id', 
                          'status', 
                          'user_name',
                          'user_phone',
                          'user_email',
                          'user_delivery-type', 
                          'user_address-city',
                          'user_address-street',
                          'user_address-house',
                          'user_address-flor',
                          'user_address-flat',
                          'user_delivery-time',
                          'user_promo',
                          'cost',
                          'user_comment',
                      ];
  protected $guarded = ['id'];


}
