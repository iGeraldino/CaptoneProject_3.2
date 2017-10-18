<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Session;
use Auth;
use \Cart;
use App\flower_details;


class session_BQTController extends Controller
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
        $new_Qty = $request->BouqQuantityField;
        //dd($new_Qty);
        $derived_Sellingprice = 0;
        $oldqty = 0;
        $AvailableFlowers = DB::select('call wonderbloomdb2.Viewing_Flowers_With_UpdatedPrice()');


        //dd(Cart::instance('overallFLowers')->content());


        foreach(Cart::instance('Ordered_Bqt')->content() as $Bqt2){
          if($Bqt2->id == $id){
            $oldqty = $Bqt2->qty;//for validations's use only this is to determine whether the new qty is not equal to the previous qty
            if($oldqty == $new_Qty){
              Session::put('LongUpdate_Bouqet_To_myQuickOrder', 'Fail');
              return redirect()->back();
            }
            else{
//dd($flwrValidator,$AcrsValidator);
              Cart::instance('Ordered_Bqt')
              ->update($Bqt2->rowId,['name'=>$Bqt2->name,'qty' => $new_Qty,
              'price' => $Bqt2->price,'options'=>['count' => $Bqt2->options->count]]);
              Session::put('LongUpdate_Bouqet_To_myQuickOrder', 'Successful');
              return redirect()->back();
            }//
          }//this means that the bouquet was found
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
