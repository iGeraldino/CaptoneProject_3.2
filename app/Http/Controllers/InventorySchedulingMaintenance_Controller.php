<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Session;
use Auth;

class InventorySchedulingMaintenance_Controller extends Controller
{
    //


	public function deleteFlowerOnSched($id,$flower_ID)
	{
		if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
			$Deleter_Flower = DB::select('call deleteFlower_from_Schedule(?,?)',array($id,$flower_ID));
			
	        
	        return redirect()->route('InventoryScheduling.show',$id);
	    }
	}//end of function


	public function cancelOrdersFromSupplier($id)
	{
		if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
			$Cancel_SupplySchedule = DB::select('call cancelScheduleofFlowerSupply(?)',array($id));
	        
	        return redirect()->route('InventoryScheduling.index');
	    }
	}//end of function
}

