<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newshop_Schedule extends Model
{
    //
    protected $primaryKey = 'Schedule_ID';
    public $timestamps = true;
    protected $table = 'shop_schedule';
}
