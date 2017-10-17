<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Cart;
use Session;
use Auth;

class BouquetSession_Controller extends Controller
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
        $newQty = $request->BouqQuantityField;
        $derived_Sellingprice = 0;
        $oldqty = 0;
        $AvailableFlowers = DB::select('call wonderbloomdb2.Viewing_Flowers_With_UpdatedPrice()');


      //-------------------------------------------------------------sends the data to the session cart.
              Cart::instance('BatchesofFLowers')->destroy();
              $batches_ofFlowers = DB::select('CALL breakdownBatchOf_Available_Flowers()');
              foreach($batches_ofFlowers as $batch){
                  $batchID = $batch->Batch.'_'.$batch->flower_ID;
                  $batchname = 'batch-'.$batch->Batch.'_'.$batch->Name;

                  Cart::instance('BatchesofFLowers')->add(['id'=>$batchID,'name' =>$batchname,
                   'qty'=> $batch->QTYRemaining, 'price' => $batch->SellingPrice,'options'=>['qtyR'=>$batch->QTYRemaining]]);
              }

       //------------------------------------------------------------------------deducts all of the flowers that are in the cart from the flowers available in the list
              foreach(Cart::instance('BatchesofFLowers')->content() as $batches){
                $batchID = explode('_',$batches->id);
                $qtyremaining =  $batches->options->qtyR;
                foreach(Cart::instance('QuickOrdered_Flowers')->content() as $flwr){
                  if($flwr->id == $batchID[1] AND $flwr->options->batchID == $batchID[0]){
                    $newQty = 0;
                    $qtyremaining = $qtyremaining - $flwr->qty;
                    Cart::instance('BatchesofFLowers')->update($batches->rowId,['options'=>['qtyR'=>$qtyremaining]]);
                  }//end of if the flower and batch id is equal to the flower that is in the list
                }//end of foreach that loops the flowers under that specific bouquet

                foreach(Cart::instance('QuickOrderedBqt_Flowers')->content() as $Unset_bqtFlwr){
                  if($Unset_bqtFlwr->id == $batchID[1] AND $Unset_bqtFlwr->options->batchID == $batchID[0]){
                    $newQty = 0;
                    $qtyremaining = $qtyremaining - $Unset_bqtFlwr->qty;
                    Cart::instance('BatchesofFLowers')->update($batches->rowId,['options'=>['qtyR'=>$qtyremaining]]);
                  }//end of if the flower id and the batch id is equal to the flower in the list of available flowers
                }//end of foreach that searches for the flowers under this order

                if(Cart::instance('QuickOrdered_Bqt')->count() > 0){
                  foreach(Cart::instance('QuickOrdered_Bqt')->content() as $Bqt){
                    foreach(Cart::instance('QuickFinalBqt_Flowers')->content() as $bqtFlwr){
                      if($Bqt->id == $bqtFlwr->options->bqt_ID){
                        if($bqtFlwr->id == $batchID[1] AND $bqtFlwr->options->batchID == $batchID[0]){
                          $newQty = 0;
                          $qtyremaining = $qtyremaining - ($bqtFlwr->qty * $Bqt->qty);
                          Cart::instance('BatchesofFLowers')->update($batches->rowId,['options'=>['qtyR'=>$qtyremaining]]);
                        }//end of if the flower under the bouet is equal to the flower _
                      }//loops the flowers under a specific bqt
                    }//end of searching for flowers under the bouquets
                  }//end of searching for bouquets
                }//if there is a content of the bqt_cart
              }//end of foreach that loop all of the flowers available in the database


        //dd(Cart::instance('overallFLowers')->content());





        foreach(Cart::instance('QuickOrdered_Bqt')->content() as $Bqt){
          if($Bqt->id == $id){
            $oldqty = $Bqt->qty;//for validations's use only this is to determine whether the new qty is not equal to the previous qty

            if($oldqty == $newQty){
              Session::put('Update_Bouqet_To_myQuickOrder', 'Fail');
              return redirect()->back();
            }
            else if($oldqty < $newQty){
              foreach(Cart::instance('QuickFinalBqt_Flowers')->content() as $flowers){
                if($Bqt->id == $flowers->options->bqt_ID){
                  $QtybeUseed = $flowers->qty;
                  $added_QTY = $newQty - $oldqty;
                  $flowerincart = 0;
                  //---------------------------------------------------------------------------------checks if the values entered are still abled to be added to the cart
                  foreach(Cart::instance('BatchesofFLowers')->content() as $batches){
                    $batchID = explode('_',$batches->id);
                    dd($flowers->options->batchID,$flowers->id);
                    if($flowers->options->batchID == $batchID[0] AND $flowers->id == $batchID[1]){
                      if($added_QTY*$QtybeUseed > $batches->options->qtyR){

                        $sessionVal = 'Fail_'.$totalPossible.'_'.$Aflwrs->flower_ID.'_'.$Aflwrs->flower_name.'_'.$Aflwrs->QTY.'_'.$originalQtyinOrd.'_'.$oldqty.'_'.$newQty;
                        Session::put('BqtCount_UpdateSession',$sessionVal);
                        return redirect()->back();
                        break;
                      }
                    }
                  }
                }//end of if($Bqt->id == $flowers->options->bqt_ID) determines if the flower was under that specific bqt
              }//end of quickfinalBqt_flower
              Cart::instance('QuickOrdered_Bqt')
              ->update($Bqt->rowId,['name'=>$Bqt->name,'qty' => $newQty,'price' => $Bqt->price,'options'=>['count' => $Bqt->options->count]]);
              Session::put('Update_Bouqet_To_myQuickOrder', 'Successful');
            }//
            elseif($oldqty > $newQty){
              Cart::instance('QuickOrdered_Bqt')
              ->update($Bqt->rowId,['name'=>$Bqt->name,'qty' => $newQty,'price' => $Bqt->price,'options'=>['count' => $Bqt->options->count]]);
              Session::put('Update_Bouqet_To_myQuickOrder', 'Successful');
            }//
          }
        }

        $qtytofulfill = 0;

        return redirect()->back();

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
