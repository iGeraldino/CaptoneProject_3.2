<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AcessoriesInventory;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Auth;
use Session;

class AcessoriesTransaction_Controller extends Controller
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
        if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            //$acc = DB::select('call Specific_Acessory(?)',array($id));
            $acc = DB::table('accessories')
            ->join('accessories_inventory', 'accessories.Accesories_ID', '=', 'accessories_inventory.accesories_ID')
            ->select('accessories.Accesories_ID as ACC_ID','accessories.image as image', 'accessories.name as name',
                        'accessories.price as price', 'accessories_inventory.qty as qty')
            ->where('accessories.Accesories_ID',"=",$id)
            ->first();
            //dd($acc);
           return view('accessories.editaccess') -> with('acc', $acc);
        }
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
            $Item = AcessoriesInventory::find($id);
            //echo 'name = '.$Item->accesories_ID;
            //echo 'qty = '.$Item->qty;

            $additional = $request->AdditionalQTY;//gets the additional qty

            $oldQTY = $Item->qty;//gets the old qty
            $newQTY = $oldQTY + $additional;//adds the old and additional quantity

            $update = DB::select('CALL Add_QtyAcessory(?,?)',array($id,$newQTY));
            //dd($update);

            $newInventoryTransaction = DB::select('call additional_QTY_on_Acessories(?,?)',array($id,$additional));//recording the transaction for acessories

            //echo 'newQTY = '.$Item->qty;
            return redirect()->route('Acessory_ADD_Qty.show', $Item->accesories_ID);

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
