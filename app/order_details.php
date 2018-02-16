<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order_details extends Model
{
  protected $primaryKey = 'Order_ID';
  public $timestamps = true;

  protected $fillable = [
      'Order_ID', 'Delivery_Address','Delivery_Baranggay','Delivery_City','Delivery_Province','Customer_ID','Recipient_Fname',
      'Recipient_Mname','Recipient_Lname','Status','Payment_Mode','Subtotal','Delivery_Charge',
      'Total_Amt','email_Addresss','Contact_Num','shipping_method','VAT','BALANCE','created_at','updated_at'

  ];

  public function setUpdatedAt($value)
  {
      // Do nothing.
  }
}
