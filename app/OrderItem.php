<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{

  protected $fillable = [ 
    'order_id', 
    'item_id', 
    'choice_id',
    'price',
    'amount',
    'created_at',
    'updated_at'
  ];
  protected $guarded = ['id'];
}
