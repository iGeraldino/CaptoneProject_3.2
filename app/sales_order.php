<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sales_order extends Model
{
  protected $primaryKey = 'sales_order_ID';
      protected $table = 'sales_order';

  protected $fillable = [
      'customer_ID', 'Customer_Fname','Customer_Mname',
      'Customer_Lname','Contact_Num','email_Address','Status','Type',
      'created_at','updated_at'
  ];

  public $timestamps = true;

}
