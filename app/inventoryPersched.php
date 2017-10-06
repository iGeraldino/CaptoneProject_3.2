<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inventoryPersched extends Model
{
    //
    protected $primaryKey = 'inventory_ID';
    public $timestamps = false;
    protected $table = 'inventory_persched';
}
