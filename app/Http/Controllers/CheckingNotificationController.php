<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use Requests;
//use Response;

class CheckingNotificationController extends Controller
{
    //
   public function New_Notification(){
     //$haha = "";
      if(Request::ajax())
      {
        return json_encode([
          'data' => DB::table('sales_order')
           ->where('read_seen','=','0')
           ->get();
        ]);
      }//eto kapag tinanggal ko to biglang magiging ok....
       //pero pag nandito tong if(Request::ajax()) saka siya mageerror
    }//end of  function
}//end of class
