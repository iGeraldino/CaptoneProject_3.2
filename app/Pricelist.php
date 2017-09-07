<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pricelist extends Model
{
    //
	public $timestamps = false;
    protected $primary_key = 'Price_ID';
    protected $table = 'wb_dated_price';
}
