<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pricelist extends Model
{
    //
		protected $primary_key = 'Price_ID';
		public $timestamps = false;
    protected $table = 'wb_dated_price';
}
