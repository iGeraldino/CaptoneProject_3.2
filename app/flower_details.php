<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class flower_details extends Model
{
    public $timestamps = false;

    protected $table = 'flower_details';
    protected $primaryKey = 'flower_ID';
}
