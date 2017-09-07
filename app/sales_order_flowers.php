<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sales_order_flowers extends Model
{
    public $timestamps = false;
  protected $primaryKey = 'Sales_Order_ID';
    protected $fillable = [
        'Sales_Order_ID', 'Flower_ID','QTY','Unit_Price','Total_Amt'
    ];
}
