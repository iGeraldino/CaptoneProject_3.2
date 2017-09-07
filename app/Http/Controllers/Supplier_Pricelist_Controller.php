<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\flower_details;
use App\supplier_details;
use App\SupplierPriceList_Model;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Session;
use Auth;

class Supplier_Pricelist_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        ;//for specific price list
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
        if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            $newPrice = new SupplierPriceList_Model;

            $newPrice->supplier_ID = $request->Supp_IDField;
            $newPrice->flower_ID = $request->FlowersField;
            $newPrice->price = $request->PriceField;
            //$newPrice->start_Date = $request->SDateField;
            //$newPrice->end_Date = $request->EDateField;

            $newPrice->save();

            //echo $newePrice->price_ID;
            return redirect()->route("supplierMoreDetails.show", $request->Supp_IDField);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
                //
                $flowerlist = DB::table('flower_details')
                ->select('*')
                ->get();
                $Prices = DB::select('call Pricelist_PerSupplier(?)',array($id));
                
                $supplier = DB::table('supplier_details')
                ->where('supplier_ID','=',$id)
                ->first();
                //dd($flowerlist);
               return view('supplier.suppliermoredetails')
               ->with('supp', $supplier)
               ->with('flowers',$flowerlist)
               ->with('PriceList',$Prices);
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
