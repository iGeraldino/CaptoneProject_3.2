<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\TradeAgreement_Model;
use Session;
use Auth;

class Trade_Agreement_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Responsew
     */
    public function index()
    {
        //
        if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            $Agreements = DB::select("CALL CustomerWithTradeAgreements()");
            return view('customer.customer_trade_agreement')
            ->with('agreed',$Agreements);
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
        if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            $specificAgreements = TradeAgreement_Model::find($id);
           /* ->join('flower_details', 'customer_tradeagreement.flower_ID', '=', 'flower_details.flower_ID')->join('customer_details', 'customer_details.Cust_ID', '=', 'customer_tradeagreement.Customer_ID')->select('customer_tradeagreement.Agreement_ID as Agreement_ID','customer_tradeagreement.Customer_ID as Customer_ID','customer_details.Cust_FName as FName','customer_details.Cust_MName as MName', 'customer_details.Cust_LName as LName','customer_tradeagreement.Unit_Price as AgreedPrice','customer_tradeagreement.Starting_Date as SDate','customer_tradeagreement.Price_DueDate as EDate', 'customer_tradeagreement.Status as Status','flower_details.flower_id as Flower_ID','flower_details.Image as Image', 'flower_details.flower_name as Flower_Name','flower_details.Price as OrigPrice','flower_details.retail_Price as Retail_Price')->where('customer_tradeagreement.Agreement_ID', '=', $id)->get();
            */
            // return $specificAgreements;
            return view('customer.edit_tradeagreement')->with('details',$specificAgreements);
        }
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
            $updateTrade_Agreement = TradeAgreement_Model::find($id);

              $updateTrade_Agreement->Unit_Price = $request->input('newIDfield');      
              $updateTrade_Agreement->save();

            $specificAgreements = DB::table('customer_tradeagreement')
            ->join('flower_details', 'customer_tradeagreement.flower_ID', '=', 'flower_details.flower_ID')->join('customer_details', 'customer_details.Cust_ID', '=', 'customer_tradeagreement.Customer_ID')->select('customer_tradeagreement.Agreement_ID as Agreement_ID','customer_tradeagreement.Customer_ID as Customer_ID','customer_details.Cust_FName as FName','customer_details.Cust_MName as MName', 'customer_details.Cust_LName as LName','customer_tradeagreement.Unit_Price as AgreedPrice','customer_tradeagreement.Starting_Date as SDate','customer_tradeagreement.Price_DueDate as EDate', 'customer_tradeagreement.Status as Status','flower_details.flower_id as Flower_ID','flower_details.Image as Image', 'flower_details.flower_name as Flower_Name','flower_details.Price as OrigPrice','flower_details.retail_Price as Retail_Price')->where('customer_tradeagreement.Agreement_ID', '=', $id)->get();

            // return $specificAgreements;
            return view('customer.edit_tradeagreement')->with('details',$specificAgreements);
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
        if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            Session::put('DeletingSession',"Successful");
            $delAgreement = TradeAgreement_Model::find($id);
            $delAgreement->delete();

             return back();
         }
    }
}
