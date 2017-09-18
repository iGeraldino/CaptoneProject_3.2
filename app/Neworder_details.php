<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Neworder_details extends Model
{
    //
    protected $primaryKey = 'Order_ID';
    public $timestamps = false;
    protected $table = 'order_details';

}
