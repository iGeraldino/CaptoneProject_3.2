<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerDetails extends Model
{
    //

    public $timestamps = false;

    protected $primaryKey = 'Cust_ID';
    protected $table = 'customer_details';

}
