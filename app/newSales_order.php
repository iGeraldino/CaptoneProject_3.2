<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class newSales_order extends Model
{
    //
    protected $primaryKey = 'sales_order_ID';
        protected $table = 'sales_order';


    public $timestamps = false;

}
