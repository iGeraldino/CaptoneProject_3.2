<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\NewOrders;

class newSales_order extends Model
{
    //
    protected $primaryKey = 'sales_order_ID';
        protected $table = 'sales_order';


    public $timestamps = false;

    public static function boot(){
       parent::boot();
        static::created(function($order)
       {
         event(new NewOrders($order));
       });
    }


}
