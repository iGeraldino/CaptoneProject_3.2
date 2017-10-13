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
		if(auth::guard('admins')->check() == false){
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
        if(auth::guard('admins')->check() == false){
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
		if(auth::guard('admins')->check() == false){
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


  public function ManageSpoiledFlowers($ID)
	{
		if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
    }
    else{//

      $Flower = DB::select('CALL viewSpecificInventory_ID(?);',array($ID));
      $Rqst_ID = "";
      $D_Recieved = "";
      $LifeSpan = "";

      $spoilageDate = "";

      $Flower_ID = "";

      $Qty_Recieved = "";
      $Qty_UpdatedRecieved = "";

      $Qty_InitialGood = "";
      $Qty_UpdatedInitialGood = "";

      $Qty_InitialSpoiled = "";
      $Qty_UpdatedInitialSpoiled = "";

      $Qty_Remaining = "";
      $Qty_Spoiled = "";
      $Qty_Sold = "";
      $Cost = "";

      $Name = "";
      $Img = "";
      $Inventory_ID = "";

      foreach($Flower as $Flower1){
        $Rqst_ID = $Flower1->Sched_ID;
        $D_Recieved = $Flower1->Date_Obtained;
        $LifeSpan = $Flower1->LifeSpan;

        $spoilageDate = $Flower1->Spoilagedate;

        $Flower_ID = $Flower1->flower_ID;

        $Qty_Recieved = $Flower1->Recieved_QTY;
        $Qty_UpdatedRecieved = $Flower1->UpdatedQtyR;

        $Qty_InitialGood = $Flower1->Good_QTY;
        $Qty_UpdatedInitialGood = $Flower1->UpdatedQtyG;

        $Qty_InitialSpoiled = $Flower1->InitialSpoiled_QTY;
        $Qty_UpdatedInitialSpoiled = $Flower1->UpdatedQtyS;

        $Qty_Remaining = $Flower1->QTY_Remaining;
        $Qty_Spoiled = $Flower1->QTY_Spoiled;
        $Qty_Sold = $Flower1->QTY_Sold;
        $Cost = $Flower1->Cost;

        $Name = $Flower1->flowerName;
        $Img = $Flower1->Img;
        $Inventory_ID = $Flower1->Inventory_ID;
      }

      $FlowerDet = collect([$Rqst_ID,
      $D_Recieved,
      $LifeSpan,
      $spoilageDate,
      $Flower_ID,
      $Qty_Recieved,
      $Qty_UpdatedRecieved,
      $Qty_InitialGood,
      $Qty_UpdatedInitialGood,
      $Qty_InitialSpoiled,
      $Qty_UpdatedInitialSpoiled,
      $Qty_Remaining,
      $Qty_Spoiled,
      $Qty_Sold,
      $Cost,
      $Name,
      $Img,
      $Inventory_ID]);

      return view('flower.flowerInventory.ManageFlowersTo_spoiled')
      ->with('records',$FlowerDet);

      dd($Flower);

		}
	}//end of function


	public function Cancel_requestTo_Supplier()
	{
        if(auth::guard('admins')->check() == false){
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
        if(auth::guard('admins')->check() == false){
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
