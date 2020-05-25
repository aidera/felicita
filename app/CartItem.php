<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;

class CartItem extends Model
{
  //
  protected $fillable = [ 
                          'cart_id', 
                          'item_id', 
                          'choice_id',
                          'price',
                          'amount',
                          'created_at',
                          'updated_at'
                      ];
  protected $guarded = ['id'];
}
