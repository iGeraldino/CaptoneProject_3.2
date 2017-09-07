<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class shop_schedule extends Model
{
  protected $primaryKey = 'Schedule_ID';
  public $timestamps = true;
  protected $table = 'shop_schedule';
  protected $fillable = [
      'Order_ID', 'Customer_fname','Customer_lname','Date_of_Event','Time','Schedule_Type','schedule_status'
  ];
}
