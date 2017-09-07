<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\bouquet_details;
use Auth;

class BouquetMaintenanceController extends Controller
{
    //
    public function DeleteFlower_per_Bouquet($bouquet_ID,$flower_ID,$QTY,$T_PRICE)
	{
		if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
			$oldQTY = 0;
			$oldPRICE = 0;
			$Deleter_Flower = DB::select('call del_Flower_From_Bouquet_Flowers(?,?)',array($bouquet_ID,$flower_ID));
	        //echo($bouquet_ID.'  / '.$flower_ID);
	        $BQT_Details = bouquet_details::find($bouquet_ID);
			
			$newQTY = $BQT_Details->count_ofFlowers - $QTY;
			$newFPrice = $BQT_Details->price - $T_PRICE;

			$update_BQT_PRICE_AND_QTY = DB::select('CALL update_BQT_price_and_QTY(?,?,?)',array($bouquet_ID,$newFPrice,$newQTY));

	        return redirect()->route('bouqAddFlower.show',$bouquet_ID);
    	}
	}//end of function

	public function DeleteAcessories_per_Bouquet($bouquet_ID,$acessory_ID)
	{
		if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
			$Deleter_Flower = DB::select('call del_acessory_From_Bouquet_Acessories(?,?)',array($bouquet_ID,$acessory_ID));
	        echo($bouquet_ID.'  / '.$acessory_ID);
	        return redirect()->route('bouqAddFlower.show',$bouquet_ID);
	    }
	}//end of function
}
