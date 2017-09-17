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


//create a new Sales order first
        $createOrder = new sales_order;

        if($Existing_CustID == ""){
          $createOrder->customer_ID = NULL;
        }else {
          $createOrder->customer_ID = $Existing_CustID;
        }
        $createOrder->Customer_Fname = $Ordered_Fname;
        $createOrder->Customer_Mname = $Ordered_Mname;
        $createOrder->Customer_Lname = $Ordered_Lname;
        $createOrder->Contact_Num = $Ordered_Contact;
        $createOrder->email_Address = $Ordered_Email;
        $createOrder->Status = 'PENDING';
        $createOrder->Type = 'WALK-IN';
        $createOrder->save();



//then insert the items under that sales order using its primary key
  //insert the flowers under that orderinto the database
        foreach(Cart::instance('TobeSubmitted_Flowers')->content() as $Ordered_Flowers){
              $FLowers_toOrder = DB::select('CALL insert_Flowers_ofSales_Order(?,?,?,?,?)',
              array($createOrder->sales_order_ID,$Ordered_Flowers->id,$Ordered_Flowers->qty,
              $Ordered_Flowers->price,$Ordered_Flowers->options['T_Amt']));
        }

//create a bouquet under that sales order
      foreach(Cart::instance('TobeSubmitted_Bqt')->content() as $bqt){
          $BqttotalAmt = 0;
          $BqttotalCnt = 0;
          //compute the total amount flowers and accessories under that bouquet
          foreach(Cart::instance('TobeSubmitted_Bqt_Flowers')->content() as $row3){
              if($bqt->id == $row3->options['bqt_ID']){
                $BqttotalCnt += $row3->qty;//compute the total count of flowers under that bouquet
                $BqttotalAmt += $row3->options['T_Amt'];//computes the total amount of flowers
              }
          }
          foreach(Cart::instance('FinalBqt_Acessories')->content() as $row3_1){
              if($bqt->id == $row3_1->options['bqt_ID']){
                $BqttotalAmt += $row3_1->options['T_Amt'];//computes the total amount of flowers
              }
          }

          $createBouquet = new bouquet_details;
          $createBouquet->price = $BqttotalAmt;
          $createBouquet->count_ofFlowers = $BqttotalCnt;
          $createBouquet->Type = 'custom';//
          $createBouquet->Order_ID = $createOrder->sales_order_ID;//submits the primary key of the newly created Salesorder
          $createBouquet->save();

          $PassBqt_toSalesOrder = DB::select('CALL insert_BqtToSales_orderBqt(?,?,?,?)'
          ,array($createOrder->sales_order_ID,$createBouquet->bouquet_ID,$BqttotalAmt,$bqt->qty))

          foreach(Cart::instance('TobeSubmitted_Bqt_Flowers')->content() as $flwr){
            if($bqt->id == $flwr->options['bqt_ID']){
              $BqtFLowers_toOrder = DB::select("CALL add_Flower_to_Bouquet(?, ?, ?)", array($createBouquet->bouquet_ID,$flwr->id,$flwr->price));
              //
              $bqtFlowers_toSalesOrder = DB::select("CALL add_flowers_to_sales_OrderBqtFlowers(?,?,?,?,?)",
              array($createOrder->sales_order_ID,$createBouquet->bouquet_ID,$flwr->id,$flwr->price,$flwr->qty));//inserts the flowers into the salesorderbqt_flowers table
            }
          }//end of adding flowers to bqt
          foreach(Cart::instance('FinalBqt_Acessories')->content() as $Acrs){
            if($bqt->id == $Acrs->options['bqt_ID']){
              $BqtAcrs_toOrder = DB::select("CALL add_Acessories_to_Bouquet(BQT_ID, ACSRS_ID, QTY)", array($createBouquet->bouquet_ID,$Acrs->id,$Acrs->price));
              //
              $bqtAccessories_toSalesOrder = DB::select("CALL add_accessories_to_sales_Order_Accessories(?,?,?,?,?)",
              array($createOrder->sales_order_ID,$createBouquet->bouquet_ID,$Acrs->id,$Acrs->price,$Acrs->qty));//inserts the flowers into the salesorderbqt_accessories table
            }
          }//end of adding flowers to bqt
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
