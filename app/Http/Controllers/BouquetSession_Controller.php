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
        foreach(Cart::instance('QuickOrdered_Bqt')->content() as $Bqt){
          if($Bqt->id == $id){
            $oldqty = $Bqt->qty;
            Cart::instance('QuickOrdered_Bqt')
            ->update($Bqt->rowId,['name'=>$Bqt->name,'qty' => $newQty,'price' => $Bqt->price,'options'=>['count' => $Bqt->options->count]]);
            Session::put('Update_Bouqet_To_myQuickOrder', 'Successful');
          }
        }

$qtytofulfill = 0;


        foreach(Cart::instance('overallFLowers')->content() as $inCartflowers){
          if($inCartflowers->id == $id){
            if($oldqty == $newQty){
              $qtytofulfill = $oldqty - $newQty;
              $newQty2 = $inCartflowers->qty - $ordereFlwr->qty;
              Cart::instance('overallFLowers')->update($inCartflowers->rowId,['qty' => $oldqty]);
            }
            else if($oldqty > $newQty){
              $qtytofulfill = $oldqty- $newQty
              for($ctr = 0;$ctr<= $qtytofulfill-1;$ctr++){
                $newQty2 = $inCartflowers->qty - $ordereFlwr->qty;//to be continued
                Cart::instance('overallFLowers')->update($inCartflowers->rowId,['qty' => $oldqty]);
              }

            }
            else if ($oldqty < $newQty){
              $qtytofulfill = $newQty - $oldqty;
            }
          }//
        }

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
