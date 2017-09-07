<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierPriceList_Model extends Model
{
    //
    public $timestamps = false;

    protected $table = 'supplier_flower_pricelist';

    protected $primaryKey = 'price_ID';
}
