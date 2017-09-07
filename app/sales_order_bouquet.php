<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sales_order_bouquet extends Model
{
  public $timestamps = false;
  protected $primaryKey = ['Order_ID','Bqt_ID'];
  public $incrementing = false;
  protected $fillable = [
      'Order_ID', 'Bqt_ID','Unit_Price','QTY','Amt'
  ];
    protected $table = 'sales_order_bouquet';
}
