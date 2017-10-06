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

	public function Manage_FlowerTo_Adjust($Sched_id,$Flwr_id)
	{
		if(auth::check() == false){
						Session::put('loginSession','fail');
						return redirect() -> route('adminsignin');
				}
				else{
					$Flower = DB::select('CALL viewSpecificFlower_PerSched(?,?);',array($Sched_id,$Flwr_id));
					$Rqst_ID = "";
					$Flower_ID = "";
					$Img = "";
					$Name = "";
					$D_Recieved = "";
					$D_Expected = "";
					$Qty_Expected = "";
					$Qty_Recieved = "";
					$Qty_Good = "";
					$Qty_Spoiled = "";
					$AQty_Recieved = "";
					$AQty_Good = "";
					$AQty_Spoiled = "";

					foreach($Flower as $Flower1){
						$Rqst_ID = $Flower1->Sched_ID;
						$Flower_ID = $Flower1->flower_ID;
						$Img = $Flower1->Img;
						$Name = $Flower1->flowerName;
						$D_Recieved = $Flower1->Date_Obtained;
						$D_Expected = $Flower1->Date_To_Recieve;
						$Qty_Expected = $Flower1->QTY_Expected;
						$Qty_Recieved = $Flower1->Recieved_QTY;
						$Qty_Good = $Flower1->Good_QTY;
						$Qty_Spoiled = $Flower1->Spoiled_QTY;
						$AQty_Recieved = $Flower1->Adjusted_QTYRecieved;
						$AQty_Good = $Flower1->Adjusted_QTYGood;
						$AQty_Spoiled = $Flower1->Adjusted_QTYSpoiled;
					}

					$FlowerDet = collect([$Rqst_ID ,$Flower_ID ,$Img ,$Name ,
					$D_Recieved ,$D_Expected ,$Qty_Expected ,$Qty_Recieved ,
					$Qty_Good ,$Qty_Spoiled,$AQty_Recieved,$AQty_Good,$AQty_Spoiled]);

					return view('flower.inventoryScheduling.Make_Adjustments')
					->with('FlowerDet',$FlowerDet);
			}
	}//end of function

	public function Save_FlowerTo_Inventory(Request $request,$id)
	{

	}//end of function


}
