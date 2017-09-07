<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Pricelist;
use Session;
use Auth;
use Image;

class Pricelist_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            $Active_Price = DB::select('CALL active_PriceListmarkup()');
            $Inactive_Price = DB::select('CALL inactive_PriceListMarkup()');

            return view('flower.pricelist.creating_PriceList')
            ->with('activePrices',$Active_Price)
            ->with('inactivePrices',$Inactive_Price);
        }
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
            $endDate =  $request->Enddatepicker.' 23:59:59';
            $NewPrice = new Pricelist;
            $NewPrice->markUp_Percentage = $request->markUp;    
            $NewPrice->Start_Date = $request->Startdatepicker;
            $NewPrice->End_Date = $endDate;
            //echo 'ana maganda';
             //dd($NewPrice);
            $NewPrice->save();
           Session::put('Adding_newMarkUpSession', 'Successful');  
           return redirect()->route('Shop_Pricelist.index');
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
