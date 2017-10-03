<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use \Cart;
use App\newSales_order;
use App\bouquet_details;
use App\Newshop_Schedule;
use App\Neworder_details;
use Session;
use Auth;
use Carbon\Carbon;

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

        $combined_date = $Del_DateLine." ".$Del_timeLine;
        $dateTime_to_beOut = date('Y-m-d h:i:s', strtotime($combined_date));
        //echo 'Date and time to get= '.date('Y-m-d h:i:s a', strtotime($newdate));
        $current = Carbon::now('Asia/Manila');

//create a new Sales order first
       $createOrder = new newSales_order;

         if($Existing_CustID == ""){
           $createOrder->customer_ID = NULL;
         }else {
           $CustID = explode("_",$Existing_CustID);
           $createOrder->customer_ID = $CustID[1];
         }

       //dd($CustID[1]);
        $createOrder->Customer_Fname = $Ordered_Fname;
        $createOrder->Customer_Mname = $Ordered_Mname;
        $createOrder->Customer_Lname = $Ordered_Lname;
        $createOrder->Contact_Num = $Ordered_Contact;
        $createOrder->email_Address = $Ordered_Email;
        $createOrder->created_at = $current;
        $createOrder->updated_at = $current;
        $createOrder->Status = 'PENDING';
        $createOrder->Type = 'WALK-IN';
        $createOrder->save();
//to be continued...

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
          ,array($createOrder->sales_order_ID,$createBouquet->bouquet_ID,$BqttotalAmt,$bqt->qty));

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
              $BqtAcrs_toOrder = DB::select("CALL add_Acessories_to_Bouquet(?, ?, ?)", array($createBouquet->bouquet_ID,$Acrs->id,$Acrs->price));
              //
              $bqtAccessories_toSalesOrder = DB::select("CALL add_accessories_to_sales_Order_Accessories(?,?,?,?,?)",
              array($createOrder->sales_order_ID,$createBouquet->bouquet_ID,$Acrs->id,$Acrs->price,$Acrs->qty));//inserts the flowers into the salesorderbqt_accessories table
            }
          }//end of adding flowers to bqt
        }

      $F_tamt = 0;
      $B_tamt = 0;
      $OrderTotal_Amt = 0;
      $F_tamt = str_replace(array(','), array(''), Cart::instance('TobeSubmitted_Flowers')->subtotal());
      $B_tamt = str_replace(array(','), array(''), Cart::instance('TobeSubmitted_Bqt')->subtotal());

      if($recipientID == ""){
        $finalR_ID = $recipientID;
      }else{
        if($recipientID == 'n/a'){
          $finalR_ID = 'n/a';
        }else{
          $R_ID = explode("_",$recipientID);
          $finalR_ID = $R_ID[1];
        }
      }

      $OrderTotal_Amt = $F_tamt + $B_tamt;

      $create_Order_Details = new Neworder_details;
      $create_Order_Details->Order_ID = $createOrder->sales_order_ID;
      $create_Order_Details->Delivery_Address = $Adrs_Line;
      $create_Order_Details->Delivery_Baranggay = $Brgy_Line;
      $create_Order_Details->Delivery_City = $city_Line;
      $create_Order_Details->Delivery_Province = $prove_Line;
      $create_Order_Details->Customer_ID = $finalR_ID;
      $create_Order_Details->Recipient_Fname = $recipientFname;
      $create_Order_Details->Recipient_Mname = $recipientMname;
      $create_Order_Details->Recipient_Lname = $recipientLname;
      $create_Order_Details->Status = 'PENDING';
      $create_Order_Details->Payment_Mode = $Payment_methodline;
      $create_Order_Details->shipping_method = $shipping_methodline;
      $create_Order_Details->Subtotal = $OrderTotal_Amt;
      $create_Order_Details->email_Addresss = $recipient_email;
      $create_Order_Details->Contact_Num = $recipient_Contact;
      $create_Order_Details->created_at = $current;
      $create_Order_Details->updated_at = $current;
      $create_Order_Details->save();


      $add_toShopSchedule = new Newshop_Schedule;
      $add_toShopSchedule->Order_ID = $createOrder->sales_order_ID;
      $add_toShopSchedule->Customer_fname = $Ordered_Fname;
      $add_toShopSchedule->Customer_lname = $Ordered_Lname;

      $add_toShopSchedule->Date_of_Event = $dateTime_to_beOut;
      $add_toShopSchedule->Time = $dateTime_to_beOut;
      $add_toShopSchedule->Schedule_Type = $shipping_methodline;
      $add_toShopSchedule->shedule_status = 'PENDING';
      $add_toShopSchedule->created_at = $current;
      $add_toShopSchedule->updated_at = $current;
      $add_toShopSchedule->save();

        Cart::instance('FinalBqt_Flowers')->destroy();
        Cart::instance('FinalBqt_Acessories')->destroy();
        Cart::instance('Ordered_Flowers')->destroy();
        Cart::instance('Ordered_Bqt')->destroy();

        Cart::instance('TobeSubmitted_Flowers')->destroy();
        Cart::instance('TobeSubmitted_Bqt')->destroy();
        Cart::instance('TobeSubmitted_Bqt_Flowers')->destroy();

       Session::put('newOrderMade_Session','Successful');
       return redirect()->route("Orders_Submit_LongOrder.show", $createOrder->sales_order_ID);
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

        $cities = DB::table('cities')
          ->select('*')
          ->get();

        $province = DB::table('provinces')
          ->select('*')
          ->get();

        $NewSalesOrder = newSales_order::find($id);
        $NewSalesOrder_details = Neworder_details::find($id);
        $SalesOrder_flowers = DB::select('CALL show_sales_Orders_Flowers(?)',array($id));

        $NewOrder_SchedDetails = DB::table('shop_schedule')
                                   ->where('Order_ID', $id)
                                   ->first();

        $NewOrder_Bouquet = DB::table('sales_order_bouquet')
                                    ->where('Order_ID', $id)
                                    ->get();

        $SalesOrder_Bqtflowers = DB::select('CALL show_SalesOrder_Bqt_Flowers(?)',array($id));

        $SalesOrder_BqtAccessories = DB::select('CALL show_SalesOrder_Bqt_Accessories(?)',array($id));

       //dd($NewOrder_SchedDetails);
        return view('Orders/finalorder')
        ->with('cities',$cities)
        ->with('provinces',$province)
        ->with('NewSalesOrder',$NewSalesOrder)
        ->with('NewSalesOrder_details',$NewSalesOrder_details)
        ->with('NewOrder_SchedDetails',$NewOrder_SchedDetails)
        ->with('SalesOrder_flowers',$SalesOrder_flowers)
        ->with('NewOrder_Bouquet',$NewOrder_Bouquet)
        ->with('SalesOrder_Bqtflowers',$SalesOrder_Bqtflowers)
        ->with('SalesOrder_BqtAccessories',$SalesOrder_BqtAccessories);

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
