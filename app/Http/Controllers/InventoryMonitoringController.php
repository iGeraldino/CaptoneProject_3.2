<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\flower_details;
use \Cart;
use Auth;
use Session;
use App\supplier_details;
use App\Shop_ScheduleModel;

class InventoryMonitoringController extends Controller
{
    //
    public function viewInventory_per_Flower($flower_ID)
	{
		if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
			$flower_Details = flower_details::find($flower_ID);
			$View_FlowerInventory = DB::select('call Detailed_Inventory_Per_Flower(?)',array($flower_ID));
	        //dd($View_FlowerInventory);
	        return view('flower.flowerInventory.batch_Inventory')->with('flowers',$View_FlowerInventory)
	        ->with('flowerDet',$flower_Details);
	       }
	}//end of function

	public function View_AddingFlowers_for_Arrival()
	{
        if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
    			$Schedule_details = Session::get('newScheduleSession');
    			if($Schedule_details == null){
    				Session::put('requestOrder_Session','failure');
    				return redirect()->route('InventoryScheduling.index');
    			}else{
    				$SupplierDet = supplier_details::find($Schedule_details[1]);
    				//dd($SupplierDet);
    				//dd($Schedule_details[1]);
    				$Flowers = DB::select('Call call_flowers_in_Supplier_PriceList(?)', array($Schedule_details[1]));
    				 return view('flower.inventoryScheduling.adding_Flowers_toArrive_for_the_Schedule')
    				 ->with('Schedule_details',$Schedule_details)
    				 ->with('FlowerList',$Flowers)
    				 ->with('SuppDet',$SupplierDet);
    			}
		     }
	}//end of function

	public function Delete_requestedflower_insession_toarrive($flower_Id)
	{
		if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
			$Schedule_details = Session::get('newScheduleSession');
			if($Schedule_details == null){
				Session::put('requestOrder_Session','failure');
				return redirect()->route('InventoryScheduling.index');
			}else{
			foreach(Cart::instance('Schedule_Flowers')->content() as $row){
				if($row->id == $flower_Id){
					Cart::instance('Schedule_Flowers')->remove($row->rowId);
					Session::put('Deleted_FlowerfromSession_Supply', 'Successful');
				}
			}

				return redirect()->route('Inventory.ScheduleArrival');
			}
		}
	}//end of function



	public function Cancel_requestTo_Supplier()
	{
        if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
			Cart::instance('Schedule_Flowers')->destroy();
			Session::remove('newScheduleSession');
			//Session::destroy();
			return redirect()->route('InventoryScheduling.index');
		}
	}//end of function



	public function save_requestFrom_Supplier()
	{
        if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
			//Cart::instance('Schedule_Flowers')->destroy();
			//Session::remove('newScheduleSession');
			//Session::destroy();
			$Schedule_details = Session::get('newScheduleSession');
			if($Schedule_details == null){
				Session::put('requestOrder_Session','failure');
				return redirect()->route('InventoryScheduling.index');
			}else{
			//dd($Schedule_details);
			  $NewSched = new  Shop_ScheduleModel;
	          $NewSched->Date_of_Event = $Schedule_details['0'];
	          $NewSched->supplier_ID = $Schedule_details['1'];
	          $NewSched->Schedule_Type = "I";
	          $NewSched->save();

	          foreach(Cart::instance('Schedule_Flowers')->content() as $row){
	          	DB::select('CALL add_Flowers_For_ScheduledFlowers_From_Supplier(?,?,?)',array($NewSched->Schedule_ID,$row->id,$row->qty));
	          }

	          //echo $NewSched->Schedule_ID;
				     Cart::instance('Schedule_Flowers')->destroy();
	          	Session::remove('newScheduleSession');

				Session::put('Save_requestOrder_Session','Successful');

			 return redirect()->route('InventoryScheduling.index');
			}
        }
	}//end of function



}
