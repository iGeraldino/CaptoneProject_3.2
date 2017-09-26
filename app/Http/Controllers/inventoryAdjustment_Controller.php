<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\supplier_details;
use App\Shop_ScheduleModel;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Session;
use \Cart;
use Auth;
use App\Inventory_PerSched;
use Carbon\Carbon;


class inventoryAdjustment_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      //
      if(auth::check() == false){
              Session::put('loginSession','fail');
              return redirect() -> route('adminsignin');
          }
          else{
            //$dateArrived = date('Y-m-d', strtotime($request->DateRecieved_Field));
            //$timeArrived = date('H:i:s', strtotime($request->TimeRecieved_Field));
            $current = Carbon::now('Asia/Manila');
            //$datetime = $dateArrived.' '.$timeArrived;
            $Sched_id = $request->rqst_IDField;
            $Flower = DB::select('CALL viewSpecificFlower_PerSched(?,?);',array($Sched_id,$id));

            $QTYRem ="";
            $Cost = "";
            $QTY_Spoil = "";
            $Batch_Flower = DB::select('CALL view_Specific_Batch_Fower(?, ?)',array($Sched_id,$id));
            foreach($Batch_Flower as $Batch_Flower1){
              $QTY_Spoil = $Batch_Flower1->QTY_Spoiled;
              $QTYRem = $Batch_Flower1->QTY_Remaining;
              $Cost = $Batch_Flower1->Cost;
            }

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
  					}


            $I_QTYRecieved = $request->qtyRecieved_Field;
            $I_QTYSpoiled = $request->qtySpoiled_Field;
            $I_QTYGood = $request->Goodqty_Field;

            $newGood = "";
            $newSpoiled = "";
            $newRecieved = "";
            $newRemaining = "";


            if($I_QTYRecieved == $Qty_Recieved AND $I_QTYSpoiled == $Qty_Spoiled AND $I_QTYGood == $Qty_Good){
              Session::put("Adjustment_status","noChanges");
              return redirect()->back();
            }
            else{
              if($I_QTYRecieved == $Qty_Recieved){
                if($I_QTYSpoiled > $Qty_Spoiled){
                  $newGood = $Qty_Good - ($I_QTYSpoiled - $Qty_Spoiled);//decreses the good_qty by the increase in qty spoiled
                  $newRemaining = $QTYRem - ($I_QTYSpoiled - $Qty_Spoiled);//decreases the qty remaining by the increase in the qty spoiled
                  $decrease = $Qty_Spoiled - $I_QTYSpoiled;
                  $newSpoiled = $QTY_Spoil + ($I_QTYSpoiled - $Qty_Spoiled);

                  $updateFromSupplier = DB::select("CALL adjustment_flowersFromSuppliers (?,?,?,?,?)",
                  array($Sched_id,$id,$I_QTYRecieved,$I_QTYSpoiled,$newGood));

                  $updateInv = DB::select("CALL adjust_inventory_Persched(?, ?, ?, ?, ?,?,?);",
                  array($Sched_id,$id,$I_QTYRecieved,$newGood,$I_QTYSpoiled,$newRemaining,$newSpoiled));

                  $addtransaction = DB::select('CALL add_record_ofInventory_Transaction(?,?,?,?,?,?,?)',
                  array($Sched_id,$id,$decrease,$Cost,$current,'A','Flower'));
                }//end of if($I_QTYSpoiled > $Qty_Spoiled)
                else if($I_QTYSpoiled < $Qty_Spoiled){
                  $newGood = $Qty_Good + ($Qty_Spoiled - $I_QTYSpoiled);//increases the good_qty by the decrease in qty spoiled
                  $newRemaining = $QTYRem + ($Qty_Spoiled - $I_QTYSpoiled);//increases the qty remaining by the decrease in the qty spoiled
                  $increase = $Qty_Spoiled - $I_QTYSpoiled ;//gets the increase of that may be applied to the good quantity
                  $newSpoiled = $QTY_Spoil - ($Qty_Spoiled - $I_QTYSpoiled);//decreases the spoiled quantity in the inventory per sched by the decrese of the spoiled

                  $updateFromSupplier = DB::select("CALL adjustment_flowersFromSuppliers (?,?,?,?,?)",
                  array($Sched_id,$id,$I_QTYRecieved,$I_QTYSpoiled,$newGood));

                  $updateInv = DB::select("CALL adjust_inventory_Persched(?, ?, ?, ?, ?,?,?);",
                  array($Sched_id,$id,$I_QTYRecieved,$newGood,$I_QTYSpoiled,$newRemaining,$newSpoiled));

                  $addtransaction = DB::select('CALL add_record_ofInventory_Transaction(?,?,?,?,?,?,?)',
                  array($Sched_id,$id,$increase,$Cost,$current,'A','Flower'));
                }//end of else if($I_QTYSpoiled < $Qty_Spoiled)
              }//end of if($I_QTYRecieved == $Qty_Recieved)
              else if($I_QTYRecieved > $Qty_Recieved){
                  if($I_QTYGood > $Qty_Good AND $I_QTYSpoiled == $Qty_Spoiled){
                    $newRemaining = $QTYRem + ($I_QTYGood - $Qty_Good);//increases the qty remaining by the decrease in the qty spoiled
                    $increase = $I_QTYGood - $Qty_Good ;//gets the increase of that may be applied to the good quantity

                    $updateFromSupplier = DB::select("CALL adjustment_flowersFromSuppliers (?,?,?,?,?)",
                    array($Sched_id,$id,$I_QTYRecieved,$Qty_Spoiled,$I_QTYGood));

                    $updateInv = DB::select("CALL adjust_inventory_Persched(?, ?, ?, ?, ?,?,?);",
                    array($Sched_id,$id,$I_QTYRecieved,$I_QTYGood,$Qty_Spoiled,$newRemaining,$QTY_Spoil));

                    $addtransaction = DB::select('CALL add_record_ofInventory_Transaction(?,?,?,?,?,?,?)',
                    array($Sched_id,$id,$increase,$Cost,$current,'A','Flower'));
                  }//end if($I_QTYGood > $Qty_Good AND $I_QTYSpoiled == $Qty_Spoiled)------------------------------------------
                  else if($I_QTYGood == $Qty_Good AND $I_QTYSpoiled > $Qty_Spoiled){
                    $increase = $I_QTYRecieved - $Qty_Recieved ;//gets the increase of that may be applied to the good quantity
                    $decrease = $Qty_Spoiled - $I_QTYSpoiled ;//gets the increase of that may be applied to the good quantity
                    $newSpoiled = $QTY_Spoil + ($I_QTYSpoiled - $Qty_Spoiled);

                    $updateFromSupplier = DB::select("CALL adjustment_flowersFromSuppliers (?,?,?,?,?)",
                    array($Sched_id,$id,$I_QTYRecieved,$I_QTYSpoiled,$I_QTYGood));

                    $updateInv = DB::select("CALL adjust_inventory_Persched(?, ?, ?, ?, ?,?,?);",
                    array($Sched_id,$id,$I_QTYRecieved,$I_QTYGood,$I_QTYSpoiled,$QTYRem,$newSpoiled));

                    $addtransaction = DB::select('CALL add_record_ofInventory_Transaction(?,?,?,?,?,?,?)',
                    array($Sched_id,$id,$increase,$Cost,$current,'A','Flower'));

                    $addtransaction = DB::select('CALL add_record_ofInventory_Transaction(?,?,?,?,?,?,?)',
                    array($Sched_id,$id,$decrease,$Cost,$current,'A','Flower'));

                  }//end of else if($I_QTYGood == $Qty_Good AND $I_QTYSpoiled > $Qty_Spoiled)
                  else if($I_QTYGood > $Qty_Good AND $I_QTYSpoiled > $Qty_Spoiled){
                    $increase = $I_QTYRecieved - $Qty_Recieved;
                    $decrease = $Qty_Spoiled - $I_QTYSpoiled ;//gets the increase of that may be applied to the good quantity

                    $newGood = $QTYRem + ($I_QTYGood - $Qty_Good );
                    $newSpoiled = $QTY_Spoil + ($I_QTYSpoiled - $Qty_Spoiled);

                    $updateFromSupplier = DB::select("CALL adjustment_flowersFromSuppliers (?,?,?,?,?)",
                    array($Sched_id,$id,$I_QTYRecieved,$I_QTYSpoiled,$I_QTYGood));

                    $updateInv = DB::select("CALL adjust_inventory_Persched(?, ?, ?, ?, ?,?,?);",
                    array($Sched_id,$id,$I_QTYRecieved,$I_QTYGood,$I_QTYSpoiled,$newGood,$newSpoiled));

                    $addtransaction = DB::select('CALL add_record_ofInventory_Transaction(?,?,?,?,?,?,?)',
                    array($Sched_id,$id,$increase,$Cost,$current,'A','Flower'));

                    $addtransaction = DB::select('CALL add_record_ofInventory_Transaction(?,?,?,?,?,?,?)',
                    array($Sched_id,$id,$decrease,$Cost,$current,'A','Flower'));
                  }//end of else if($I_QTYGood > $Qty_Good AND $I_QTYSpoiled > $Qty_Spoiled)
                  else if($I_QTYGood < $Qty_Good AND $I_QTYSpoiled > $Qty_Spoiled){
                    $increase = $I_QTYRecieved - $Qty_Recieved;//
                    $decrease = $Qty_Spoiled - $I_QTYSpoiled ;//gets the increase of that may be applied to the good quantity

                    $newGood = $QTYRem - ($Qty_Good - $I_QTYGood);//+3-2;
                    $newSpoiled = $QTY_Spoil + ($I_QTYSpoiled - $Qty_Spoiled);

                    $updateFromSupplier = DB::select("CALL adjustment_flowersFromSuppliers (?,?,?,?,?)",
                    array($Sched_id,$id,$I_QTYRecieved,$I_QTYSpoiled,$I_QTYGood));

                    $updateInv = DB::select("CALL adjust_inventory_Persched(?, ?, ?, ?, ?,?,?);",
                    array($Sched_id,$id,$I_QTYRecieved,$I_QTYGood,$I_QTYSpoiled,$newGood,$newSpoiled));

                    $addtransaction = DB::select('CALL add_record_ofInventory_Transaction(?,?,?,?,?,?,?)',
                    array($Sched_id,$id,$increase,$Cost,$current,'A','Flower'));

                    $addtransaction = DB::select('CALL add_record_ofInventory_Transaction(?,?,?,?,?,?,?)',
                    array($Sched_id,$id,$decrease,$Cost,$current,'A','Flower'));
                  }//end of else if($I_QTYGood < $Qty_Good AND $I_QTYSpoiled > $Qty_Spoiled)
                  else if($I_QTYGood > $Qty_Good AND $I_QTYSpoiled < $Qty_Spoiled){
                    $increase = $I_QTYRecieved - $Qty_Recieved;//
                    $increaseFromSpoiled = $Qty_Spoiled - $I_QTYSpoiled ;//gets the increase of that may be applied to the good quantity

                    $newGood = $QTYRem + ($I_QTYGood - $Qty_Good);//+3-2;
                    $newSpoiled = $QTY_Spoil - ($Qty_Spoiled - $I_QTYSpoiled);

                    $updateFromSupplier = DB::select("CALL adjustment_flowersFromSuppliers (?,?,?,?,?)",
                    array($Sched_id,$id,$I_QTYRecieved,$I_QTYSpoiled,$I_QTYGood));

                    $updateInv = DB::select("CALL adjust_inventory_Persched(?, ?, ?, ?, ?,?,?);",
                    array($Sched_id,$id,$I_QTYRecieved,$I_QTYGood,$I_QTYSpoiled,$newGood,$newSpoiled));

                    $addtransaction = DB::select('CALL add_record_ofInventory_Transaction(?,?,?,?,?,?,?)',
                    array($Sched_id,$id,$increase,$Cost,$current,'A','Flower'));

                    $addtransaction = DB::select('CALL add_record_ofInventory_Transaction(?,?,?,?,?,?,?)',
                    array($Sched_id,$id,$increaseFromSpoiled,$Cost,$current,'A','Flower'));
                  }//end of else if($I_QTYGood > $Qty_Good AND $I_QTYSpoiled < $Qty_Spoiled)
              }//end of else if($I_QTYRecieved > $Qty_Recieved)
              else if($I_QTYRecieved < $Qty_Recieved){
                if($I_QTYSpoiled > $Qty_Spoiled){
                  $decrease = $I_QTYRecieved - $Qty_Recieved;//
                  $decreaseFromSpoiled = $Qty_Spoiled - $I_QTYSpoiled;//gets the increase of that may be applied to the good quantity

                  $newGood = $QTYRem - ($Qty_Good - $I_QTYGood);//+3-2;
                  $newSpoiled = $QTY_Spoil + ($I_QTYSpoiled - $Qty_Spoiled);

                  $updateFromSupplier = DB::select("CALL adjustment_flowersFromSuppliers (?,?,?,?,?)",
                  array($Sched_id,$id,$I_QTYRecieved,$I_QTYSpoiled,$I_QTYGood));

                  $updateInv = DB::select("CALL adjust_inventory_Persched(?, ?, ?, ?, ?,?,?);",
                  array($Sched_id,$id,$I_QTYRecieved,$I_QTYGood,$I_QTYSpoiled,$newGood,$newSpoiled));

                  $addtransaction = DB::select('CALL add_record_ofInventory_Transaction(?,?,?,?,?,?,?)',
                  array($Sched_id,$id,$decrease,$Cost,$current,'A','Flower'));

                  $addtransaction = DB::select('CALL add_record_ofInventory_Transaction(?,?,?,?,?,?,?)',
                  array($Sched_id,$id,$decreaseFromSpoiled,$Cost,$current,'A','Flower'));
                }//end of if($I_QTYSpoiled > $Qty_Spoiled)
                else if($I_QTYSpoiled < $Qty_Spoiled){
                  $decrease = $I_QTYRecieved - $Qty_Recieved;//
                  $increase = $Qty_Spoiled - $I_QTYSpoiled;//gets the increase of that may be applied to the good quantity

                  $newGood = $QTYRem + ($Qty_Spoiled - $I_QTYSpoiled);//+3-2;
                  $newSpoiled = $QTY_Spoil - ($Qty_Spoiled - $I_QTYSpoiled);

                  $updateFromSupplier = DB::select("CALL adjustment_flowersFromSuppliers (?,?,?,?,?)",
                  array($Sched_id,$id,$I_QTYRecieved,$I_QTYSpoiled,$I_QTYGood));

                  $updateInv = DB::select("CALL adjust_inventory_Persched(?, ?, ?, ?, ?,?,?);",
                  array($Sched_id,$id,$I_QTYRecieved,$I_QTYGood,$I_QTYSpoiled,$newGood,$newSpoiled));

                  $addtransaction = DB::select('CALL add_record_ofInventory_Transaction(?,?,?,?,?,?,?)',
                  array($Sched_id,$id,$decrease,$Cost,$current,'A','Flower'));

                  $addtransaction = DB::select('CALL add_record_ofInventory_Transaction(?,?,?,?,?,?,?)',
                  array($Sched_id,$id,$increase,$Cost,$current,'A','Flower'));
                }
              }//end of else if($I_QTYRecieved > $Qty_Recieved)
            }//end of else

            Session::put("Adjustment_status","Successful");
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
