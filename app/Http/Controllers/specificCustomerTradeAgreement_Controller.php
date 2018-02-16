<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\CustomerDetails;
use App\TradeAgreement_Model;
use Illuminate\Support\Facades\DB;
use Session;
use Image;
use Auth;

class specificCustomerTradeAgreement_Controller extends Controller
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
        if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
        $customerAgreement = new TradeAgreement_Model;

        $customerAgreement->Customer_ID = $request->custID;
        $customerAgreement->Customer_Type = $request->typeCust;
        //$customerAgreement->flower_ID = $request->FLowerIDfield;
        //$customerAgreement->Unit_Price = $request->APriceField;
        //$customerAgreement->Minimum_QTY = $request->Minimum_Field;
        $customerAgreement->Starting_Date = $request->SDateField;
        $customerAgreement->Ending_Date = $request->EDateField;
        $customerAgreement->Status = 'ACTIVE';

        $customerAgreement->save();


        Session::put('Adding_Agreement','Successful');
        //$customer_ID = $request->custID;
         return redirect()->back();
        //return view('customer.adding_tradeagreement')->with()
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
       // $FlowersTobeAgreed = DB::select("CALL availableFlowerID(?)",array($id));
        if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
                $CustomerDetails = CustomerDetails::find($id);

                $TradeAgreements = DB::table('trade_agreement')
                //->join('flower_details', 'customer_tradeagreement.flower_ID', '=', 'flower_details.flower_ID')
                ->select('*')
                ->where('trade_agreement.Customer_ID', '=', $id)
                ->where('trade_agreement.Status', '=', 'ACTIVE')
                ->get();

                $inactiveAgreements = DB::table('trade_agreement')
                //->join('flower_details', 'customer_tradeagreement.flower_ID', '=', 'flower_details.flower_ID')
                ->select('*')
                ->where('trade_agreement.Customer_ID', '=', $id)
                ->where('trade_agreement.Status', '=', 'INACTIVE')
                ->get();

               return view('customer.adding_tradeagreement')
               ->with('agreements',$TradeAgreements)
               ->with('Inativeagreements',$inactiveAgreements)
               ->with('CustomerDet',$CustomerDetails);
               //->with('flowerstoAgree',$FlowersTobeAgreed);
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
        //return view('customer.Edit_tradeagreement');
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
