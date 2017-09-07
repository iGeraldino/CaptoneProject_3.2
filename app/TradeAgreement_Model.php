<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TradeAgreement_Model extends Model
{
    //
    public $timestamps = false;
	protected $table = 'trade_agreement';
   
    protected $primaryKey = 'Agreement_ID';

}
