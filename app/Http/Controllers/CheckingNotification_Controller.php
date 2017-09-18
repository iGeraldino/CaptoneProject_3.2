<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CheckingNotification_Controller extends Controller
{
    //
    public function New_Notification()
    {
      if(Request::ajax())
      {
        return json_encode([
        'data' = DB::table('sales_order')
        ->('read_seen','=','0')->get();
      ]);
    }
  }
}
