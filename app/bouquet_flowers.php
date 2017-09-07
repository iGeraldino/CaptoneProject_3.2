<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bouquet_flowers extends Model
{
  protected $primaryKey = 'bouquet_ID';
  public $timestamps = false;

  protected $fillable = [
      'bouquet_ID', 'flower_id','qty'
  ];
}
