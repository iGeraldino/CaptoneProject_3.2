<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bouquet_details extends Model
{
   protected $primaryKey = 'bouquet_ID';
   public $timestamps = false;
   protected $fillable = [
       'price', 'count_ofFlowers','Type','Order_ID'
   ];
}
