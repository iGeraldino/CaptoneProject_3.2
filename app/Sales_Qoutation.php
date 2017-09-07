<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales_Qoutation extends Model
{
    //
	public $timestamps = false;

    protected $table = 'sales_order';

    protected $primaryKey = 'sales_order_ID';
}
