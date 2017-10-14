<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer_Payment extends Model
{
    //
    public $timestamps = false;

    protected $primaryKey = 'Payment_ID';
    protected $table = 'customer_payment';

}
