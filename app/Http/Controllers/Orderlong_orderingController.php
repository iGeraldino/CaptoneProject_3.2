<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use \Cart;
use App\sales_order;
use App\bouquet_details;
use Session;
use Auth;
class Orderlong_orderingController extends Controller
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
        $Existing_CustID = $request->FinalCustomer_ID;
        $Existing_CustType = $request->customerType;//single,hotel,or shop
        $Existing_CustStat = $request->customerStat;//old or new customer
        $Ordered_Fname = $request->OrderedCustFname;//name who ordered
        $Ordered_Mname = $request->OrderedCustMname;//name who ordered
        $Ordered_Lname = $request->OrderedCustLname;//name who ordered
        $Ordered_Contact = $request->OrderedCust_ContactNum;//number who ordered
        $Ordered_Email = $request->OrderedCust_email;//email who ordered
        $recipientID = $request->recipientID;//name who ordered
        $recipientFname = $request->recipientFname;//name who ordered
        $recipientMname = $request->recipientMname;//name who ordered
        $recipientLname = $request->recipientLname;//name who ordered
        $recipient_Contact = $request->recipient_ContactNum;//contact number
        $recipient_email = $request->recipient_email;//email
        $Adrs_Line = $request->Adrs_Line;//adrsline
        $Brgy_Line = $request->Brgy_Line;//brgy
        $prove_Line = $request->prove_Line;//province
        $city_Line = $request->city_Line;//city
        $shipping_methodline = $request->shipping_methodline;//shipping method
        $Payment_methodline = $request->Payment_methodline;//payment Method
        $Del_DateLine = $request->Del_DateLine;//date
        $Del_timeLine = $request->Del_timeLine;//Time

        $creatOrder = new sales_order;

        if($Existing_CustID == ""){
          $creatOrder->customer_ID = NULL;
        }else {
          $creatOrder->customer_ID = $Existing_CustID;
        }
        $creatOrder->Customer_Fname = $Ordered_Fname;
        $creatOrder->Customer_Mname = $Ordered_Mname;
        $creatOrder->Customer_Lname = $Ordered_Lname;
        $creatOrder->Contact_Num = $Ordered_Contact;
        $creatOrder->email_Address = $Ordered_Email;
        $creatOrder->Status = 'PENDING';
        $creatOrder->Type = 'WALK-IN';
        $creatOrder->save();

        foreach(Cart::instance('TobeSubmitted_Flowers')->content() as $Ordered_Flowers){
              $FLowers_toOrder = DB::select('CALL insert_Flowers_ofSales_Order(?,?,?,?,?)',
              array($creatOrder->sales_order_ID,$Ordered_Flowers->id,$Ordered_Flowers->qty,
              $Ordered_Flowers->price,$Ordered_Flowers->options['T_Amt']));
        }

        foreach(Cart::instance('TobeSubmitted_Bqt')->content()){
          $createBouquet = new bouquet_details;
          $FLowers_toOrder = DB::select("CALL add_Flower_to_Bouquet(?, ?, ?)", array());
        }

//to be continued...
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
