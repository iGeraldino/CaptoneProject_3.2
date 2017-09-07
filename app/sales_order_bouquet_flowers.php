<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sales_order_bouquet_flowers extends Model
{
  public $timestamps = false;
  protected $primaryKey = 'Order_ID';
  protected $fillable = [
      'Order_ID', 'Bqt_ID','Flower_ID','Price','QTY','Total_Amt'
  ];
}
