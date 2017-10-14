<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bouquet_acessories extends Model
{
  protected $primaryKey = 'bouquet_ID';
  public $timestamps = false;

  protected $fillable = [
      'bouquet_ID', 'acessory_ID','qty'
  ];
}
