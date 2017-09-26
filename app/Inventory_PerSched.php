<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory_PerSched extends Model
{
    //
    protected $primaryKey = 'inventory_ID';
    public $timestamps = false;
    protected $table = 'inventory_persched';
}
