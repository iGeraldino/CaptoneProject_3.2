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
                  $flowerincart = 0;
                  foreach(Cart::instance('overallFLowers')->content() as $inCartflowers){
                    if($flowers->id == $inCartflowers->id){
                      $flowerincart = $inCartflowers->qty;
                    }
                  }//end of looking for the current flower of the loop in the overallFlowers
                  foreach($AvailableFlowers as $Aflwrs){
                    if($Aflwrs->flower_ID == $flowers->id){
                      $qtytofulfill = $newQty - $oldqty;
                      $totalPossible = $flowerincart + ($qtytofulfill*$QtybeUseed);
                      $originalQtyinOrd = $oldqty*$QtybeUseed;
                      if($totalPossible > $Aflwrs->QTY){
                        $sessionVal = 'Fail_'.$totalPossible.'_'.$Aflwrs->flower_ID.'_'.$Aflwrs->flower_name.'_'.$Aflwrs->QTY.'_'.$originalQtyinOrd.'_'.$oldqty.'_'.$newQty;
                        Session::put('BqtCount_UpdateSession',$sessionVal);
                        return redirect()->back();
                        break;
                      }//
                    }//
                  }//end of foreach
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



          foreach(Cart::instance('overallFLowers')->content() as $inCartflowers){
            $flowerincart = $inCartflowers->qty;
            $QtybeUseed = 0;
            $flowerId = 0;
            //looks for the flower under the bouquet to be updated
            foreach(Cart::instance('QuickFinalBqt_Flowers')->content() as $quickbqtFLower){
              if($quickbqtFLower->id == $inCartflowers->id AND $quickbqtFLower->options->bqt_ID == $id){
                //dd($quickbqtFLower->options->bqt_ID,$id);
                $flowerId = $quickbqtFLower->id;
                $QtybeUseed = $quickbqtFLower->qty;
              }
            }


            if($inCartflowers->id == $flowerId){
              if($oldqty == $newQty){
                //$qtytofulfill = $oldqty - $newQty;
                //$newQty2 = $inCartflowers->qty - $ordereFlwr->qty;
               //echo($oldqty.'pasok sa unang if');
                Cart::instance('overallFLowers')->update($inCartflowers->rowId,['qty' => $oldqty]);
              }
              else if($oldqty > $newQty){
                $qtytofulfill = $oldqty - $newQty;
                for($ctr = 0;$ctr<= $qtytofulfill-1;$ctr++){
                  $flowerincart = $flowerincart - $QtybeUseed;//to be continued
                  //echo($flowerincart.'pasok sa unang else if');
                 Cart::instance('overallFLowers')->update($inCartflowers->rowId,['qty' => $flowerincart]);
                }

              }
              else if ($oldqty < $newQty){
                $qtytofulfill = $newQty - $oldqty;

                for($ctr = 0;$ctr<= $qtytofulfill-1;$ctr++){
                  $flowerincart += $QtybeUseed;//to be continued
                  //echo($flowerincart.'pasok sa 2nd else if');
                  Cart::instance('overallFLowers')->update($inCartflowers->rowId,['qty' => $flowerincart]);
                }
              }
            }//
          }//end of looping the flowers in the cart




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
