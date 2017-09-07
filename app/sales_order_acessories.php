<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sales_order_acessories extends Model
{
  public $timestamps = false;
  protected $primaryKey = 'Order_ID';
  protected $fillable = [
      'Order_ID', 'BQT_ID','Acessories_ID','Price','QTY','Amt'
  ];
}
