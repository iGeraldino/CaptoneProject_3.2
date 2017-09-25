<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Session;
use Auth;
use \Cart;

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

	public function cancelmanaging_RequestedFlowers()
	{
		if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
					Cart::instance('Flowers_to_Arrive')->destroy();
					Session::put("Manage_Session","none");
	        return redirect()->route('InventoryScheduling.index');
	    }
	}//end of function

	public function Manage_FlowerTo_Submit($Sched_id,$Flwr_id)
	{
		if(auth::check() == false){
						Session::put('loginSession','fail');
						return redirect() -> route('adminsignin');
				}
				else{
					$Flower = DB::select('call viewSpecificFlower_PerSched(?,?)',array($Sched_id,$Flwr_id));

					return view('flower.inventoryScheduling.managing_SpecificFlower_PerOrder')
					->with('Flower',$Flower);
			}
	}//end of function

	public function Save_FlowerTo_Inventory(Request $request,$id)
	{

	}//end of function


}
