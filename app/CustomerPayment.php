<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerPayment extends Model
{
    //
    //public $timestamps = false;

    protected $table = 'customer_payment';
    protected $primaryKey = 'Payment_ID';
}
