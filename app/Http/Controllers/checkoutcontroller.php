<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Http\Requests;
use App\User;
use App\customer_details;
use Illuminate\Support\Facades\Db;
use Auth;
use App\sales_order;
use App\shop_schedule;
use App\order_details;
use App\sales_order_flowers;
use App\bouquet_details;
use App\bouquet_flowers;
use App\bouquet_acessories;
use App\sales_order_bouquet;
use App\sales_order_bouquet_flowers;
use App\sales_order_acessories;
use App\Neworder_details;
use Cart;
use Session;

class checkoutcontroller extends Controller
{
    public function checkingregistration(){

        $account = User::all();

        $cities = DB::table('cities')
        ->select('*')
        ->get();

        $province = DB::table('provinces')
          ->select('*')
        ->get();


        if(Auth::check() == 1){
          $details = customer_details::where('Cust_ID', '=' , Auth::user() -> Cust_ID)->get();
        }
        else{
          $details = customer_details::all();

        }

        $orderid = Session::get('orderid');

        if ( $orderid  == null ){

          return view('customer_side.pages.checkout')
          ->with('account', $account)
          ->with('city',$cities)
          ->with('province',$province)
          ->with('city2',$cities)
          ->with('province2',$province)
          ->with('city3',$cities)
          ->with('province3',$province)
          ->with('details', $details);

        }
        else{
          return redirect() -> route('geteditaccount');
        }



        //dd(Auth::user()->Cust_ID);


    }

    public function checkAccountRegistration(Request $request){

      $id = DB::table('customer_details')->insertGetId([

          'Cust_FName' => $request->input('fname'),
          'Cust_MName' => $request->input('mname'),
          'Cust_LName' => $request->input('lname'),
          'Contact_Num' => $request->input('contact'),
          'Email_Address' => $request-> input('signemail'),
          'Address_Line' => $request->input('address_Line'),
          'Baranggay' => $request->input('baranggay'),
          'Town' => $request->input('TownField'),
          'Province' => $request->input('ProvinceField')

      ]);


      $user = new User([
          'email' => $request -> input('signemail'),
          'password' => bcrypt($request -> input('password')),
          'Cust_ID' => $id,
          'username' => $request -> input('username'),
      ]);


      $user -> save();


      Auth::login($user);
      //$user -> save();

      //Auth::login($user);

      return redirect()-> route('checkingregistration');

      //dd($user);

    }

    public function userfinalCheckout(Request $request){ //Delivery


      $cust_id = Auth::user()->Cust_ID;
      $fname = $request->input('Cust_FName');
      $mname = $request->input('Cust_MName');
      $lname = $request->input('Cust_LName');
      $contact = $request->input('Cust_Number');
      $email = Auth::user()->email;
      $status = "PENDING";
      $type = "online";
      $check = 0;

      $sales_order = new sales_order([
                'customer_ID' => $cust_id,
                'Customer_Fname' => $fname,
                'Customer_Mname' => $mname,
                'Customer_Lname' => $lname,
                'Contact_Num' => $contact,
                'email_Address' => $email,
                'Status' => $status,
                'Type' => $type,

            ]);

      $sales_order -> save();



      // Shop Schedule

      $sales_order_ID = $sales_order -> sales_order_ID;

      foreach(Cart::instance('flowerwish')->content() as $row){

          $salesflower = new sales_order_flowers([

            'Sales_Order_ID' => $sales_order_ID,
            'Flower_ID' => $row -> id,
            'QTY' => $row->qty,
            'Unit_Price' => $row->price,
            'Total_Amt' => $row ->options->T_Amt,

          ]);
        $salesflower->save();
      }

      //order_details
      $deliveryadd = $request->input('Cust_AddrsLine');
      $deliverybrgy = $request->input('Cust_Brgy');
      $deliverycity = $request->input('Cust_city');
      $deliverprov = $request->input('Cust_prov');
      $recipientfname = $request->input('finalrecipient_FName');
      $recipientmname = $request->input('finalrecipient_MName');
      $recipientlname = $request->input('finalrecipient_LName');
      $paymentmethod = $request->input('Cust_paymentMethod');
      $orderdetailstatus = "PENDING";
      $orderdetailmethod = $request->input('Cust_shippingMethod');
      $orderdetailcontact = $request->input('finalrecipient_Number');
      $amount =  (str_replace(array(','), array(''), Cart::instance('finalboqcart')->subtotal()) + str_replace(array(','), array(''),
      Cart::instance('flowerwish')->subtotal()) );

      if($orderdetailmethod == 'delivery'){
            if($deliverprov == 47 AND $deliverycity == 969){
                $deliveryCharge = 0;
              }
            else if($deliverprov == 47 AND $deliverycity != 969){
               $deliveryCharge = 300;
              }
              else{
                $deliveryCharge = 0.0;
              }
      }else{
        $deliveryCharge = 0.0;
      }

      $vat = ($amount * .12) ;

      $orderdetails = new order_details([

        'Order_ID' => $sales_order_ID,
        'Delivery_Address' => $deliveryadd,
        'Delivery_Baranggay' => $deliverybrgy,
        'Delivery_City' => $deliverycity,
        'Delivery_Province' => $deliverprov,
        'Customer_ID' => $cust_id,
        'Recipient_Fname' => $recipientfname,
        'Recipient_Mname' => $recipientmname,
        'Recipient_Lname' => $recipientlname,
        'Status' => $orderdetailstatus,
        'Payment_Mode' => $paymentmethod,
        'Subtotal' => $amount ,
        'Delivery_Charge' => $deliveryCharge,
        'Total_Amt' => $amount + $vat,
        'email_Addresss' => $email,
        'Contact_Num' => $orderdetailcontact,
        'shipping_method' => $orderdetailmethod,
        'VAT' => $vat,
        'BALANCE'=> $deliveryCharge + $amount + $vat,
      ]);

      $orderdetails -> save();
      $lastid = $orderdetails->id;

        $deliverydate = date('Y/m/d',strtotime($request->Cust_Date));
        $deliverytime = date('Y/m/d H:i:s', strtotime($request->input('Cust_Time')));
        $Scheduletype = $request->input('Cust_shippingMethod');
        $schedulestatus = "PENDING";

      $shop_schedule = new shop_schedule([
        'Order_ID' => $sales_order_ID,
        'Customer_fname' => $fname,
        'Customer_lname' => $lname,
        'Date_of_Event' => $deliverydate,
        'Time' => $deliverytime,
        'Schedule_Type' => $Scheduletype,
        'shedule_status' => "P",
      ]);

      $shop_schedule -> save();
      //flower cart
      //bouquet cart

      if(Cart::instance('finalboqcart')->count() == 0){

        Cart::instance('flowerwish')->destroy();
        Cart::instance('finalboqcart')->destroy();
        Cart::instance('finalacccart')->destroy();
        Cart::instance('finalflowerbqt')->destroy();


          Session::put('orderid', $sales_order_ID);
          Return redirect() -> route('geteditaccount');

      }
      else{
        $validator = 0;
        $validator2 = 0;
        $bouquets = DB::table('bouquet_details')->get();
        $bouquetsF = DB::table('bouquet_flowers')->get();
        $bouquetsA = DB::table('bouquet_acessories')->get();
        $bouquetsSOF = DB::table('sales_order_bouquet_flowers')->get();
        $bouquetsSOA = DB::table('sales_order_acessories')->get();

        foreach(Cart::instance('finalboqcart')->content() as $row1){
          $validator = 0;

          foreach($bouquets as $bqt){
            if($row1->id == $bqt->bouquet_ID){
              //nageexist na
                $validator = 1;
                break;
            }
          }//end of looking for existing bqt

            if($validator == 1)
            {
              $salesboquet = new sales_order_bouquet([
                  'Order_ID' => $sales_order_ID,
                  'Bqt_ID' => $row1->id,
                  'Unit_Price' => $row1->price,
                  'QTY' => $row1->qty,
                  'Amt' => $row1->qty * $row1->price,
              ]);
              $salesboquet->save();
              foreach(Cart::instance('finalflowerbqt')->content() as $row1_1)
              {
                if($row1_1->options->Bqt_ID == $row1->id)
                {
                  foreach($bouquetsF as $bouquetsF2)
                  {
                    if($bouquetsF2->bouquet_ID == $row1_1->options->Bqt_ID
                    and $bouquetsF2->flower_id == $row1_1->id)
                    {
                      $flowerexistence = 0;
                      foreach($bouquetsSOF as $bouquetsSOF2)
                      {
                          if($bouquetsSOF2->Order_ID == $sales_order_ID
                          and $bouquetsSOF2->Bqt_ID == $row1_1->options->Bqt_ID
                          and  $bouquetsSOF2->Flower_ID == $row1_1->id
                          and $row1_1->options->Bqt_ID == $row1->id)
                          {
                            $flowerexistence = 1;
                            break;
                          }
                      }
                      if($flowerexistence == 0)
                      {
                        $salesbouquetflower = new sales_order_bouquet_flowers([
                            'Order_ID' => $sales_order_ID,
                            'Bqt_ID' => $row1->id,
                            'Flower_ID' => $row1_1->id,
                            'Price' => $row1_1->price,
                            'QTY' => $row1_1->qty,
                            'Total_Amt' => $row1_1->qty * $row1_1->price,
                        ]);
                        $salesbouquetflower->save();
                      }
                    }
                  }//search for existing flowers for the specific bqt
                }
              }//
              foreach(Cart::instance('finalacccart')->content() as $row1_2)
              {
                if($row1_2->options->Bqt_ID == $row1->id)
                {
                  foreach($bouquetsA as $bouquetsA2)
                  {
                    if($bouquetsA2->bouquet_ID == $row1_2->options->Bqt_ID
                    and $bouquetsA2->acessory_ID == $row1_2->id)
                    {
                      $acrsExistence = 0;
                      foreach($bouquetsSOA as $bouquetsSOA2)
                      {
                        if($bouquetsSOA2->Order_ID == $sales_order_ID
                        and $bouquetsSOA2->BQT_ID == $row1_2->options->Bqt_ID
                        and  $bouquetsSOA2->Acessories_ID == $row1_2->id
                        and $row1_2->options->Bqt_ID == $row1->id)
                        {
                          $acrsExistence = 1;
                          break;
                        }
                      }
                      if($acrsExistence == 0)
                      {
                        $salesbouquetacc = new sales_order_acessories([
                          'Order_ID' => $sales_order_ID,
                          'BQT_ID' => $row1->id,
                          'Acessories_ID' => $row1_2->id,
                          'Price' => $row1_2->price,
                          'QTY' => $row1_2->qty,
                          'Amt' => $row1_2->qty * $row1_2->price,
                        ]);
                        $salesbouquetacc->save();
                      }
                    }
                  }
                }
              }
            }


//-------------------------------------------------------------------------------------------------
       else if($validator != 1)
        {
             //create a new Bouquet
              $bouquet_details = new bouquet_details([
                'price' => $row1->price,
                'count_ofFlowers' => $row1->options->count,
                'Type' => "custom",
                'Order_ID' => $sales_order_ID,
              ]);

              $bouquet_details->save();
              $Newbouquet_ID = $bouquet_details->bouquet_ID;


              foreach(Cart::instance('finalflowerbqt')->content() as $row2)
              {
                if($row2->options->Bqt_ID == $row1->id)
                {
                  foreach($bouquetsF as $bouquetsF2_2_1)
                  {
                    $ExistingBqtFlwr = 0;
                    //echo $bouquetsF2_2_1->bouquet_ID."|".$Newbouquet_ID."|".$bouquetsF2_2_1->flower_id."|".$row2->id."--------\n";
                    if($bouquetsF2_2_1->bouquet_ID == $bouquet_details->bouquet_ID
                    AND $bouquetsF2_2_1->flower_id == $row2->id){
                      $ExistingBqtFlwr = 1;
                      break;
                    }
                  }
                  if($ExistingBqtFlwr == 0){
                    $bouquet_flowers = new bouquet_flowers([
                      'bouquet_ID' => $Newbouquet_ID,
                      'flower_id' => $row2->id,
                      'qty' => $row2->qty,
                    ]);

                    $bouquet_flowers->save();
                  }
               }
//---------------------------------------------------------------------------------------------------------------------------------
              }


              foreach(Cart::instance('finalacccart')->content() as $row3)
              {
                if($row3->options->Bqt_ID == $row1->id)
                {
                  foreach($bouquetsA as $bouquetsA2_1_2_1)
                  {
                    $ExistingBqtAcrs = 0;
                    if($bouquetsA2_1_2_1->bouquet_ID == $bouquet_details->bouquet_ID
                    AND $bouquetsA2_1_2_1->acessory_ID == $row3->id)
                    {
                      $ExistingBqtAcrs = 1;
                     break;
                    }
                  }
                  if($ExistingBqtAcrs == 0)
                  {
                    $bouquet_accessories = new bouquet_acessories([
                      'bouquet_ID' => $Newbouquet_ID,
                      'acessory_ID' => $row3->id,
                      'qty' => $row3->qty,
                    ]);
                    $bouquet_accessories->save();
                  }
                }
              }

              $bouquetsF = DB::table('bouquet_flowers')->get();
              $bouquetsA = DB::table('bouquet_acessories')->get();
              $bouquetsSOF = DB::table('sales_order_bouquet_flowers')->get();
              $bouquetsSOA = DB::table('sales_order_acessories')->get();


            //  foreach(Cart::instance('finalboqcart')->content() as $row4){

                //if($row4->id == $row1->id){
                  $salesboquet = new sales_order_bouquet([
                    'Order_ID' => $sales_order_ID,
                    'Bqt_ID' => $Newbouquet_ID,
                    'Unit_Price' => $row1->price,
                    'QTY' => $row1->qty,
                    'Amt' => $row1->qty * $row1->price,
                  ]);

                  $salesboquet->save();
                //}
              //}



                foreach(Cart::instance('finalflowerbqt')->content() as $row1_1_2)
                {
                  if($row1_1_2->options->Bqt_ID == $row1->id)
                  {
                    //dd($row1_1_2->options->Bqt_ID,$row1->id);
                    foreach($bouquetsF as $bouquetsF2_2)
                    {
                      if($bouquetsF2_2->bouquet_ID == $bouquet_details->bouquet_ID
                      and $bouquetsF2_2->flower_id == $row1_1_2->id)
                      {
                        //dd($bouquetsF2_2->bouquet_ID,$bouquet_details->bouquet_ID,$bouquetsF2_2->flower_id,$row1_1_2->id);
                        $salesbouquetflower = new sales_order_bouquet_flowers([
                            'Order_ID' => $sales_order_ID,
                            'Bqt_ID' => $Newbouquet_ID,
                            'Flower_ID' => $row1_1_2->id,
                            'Price' => $row1_1_2->price,
                            'QTY' => $row1_1_2->qty,
                            'Total_Amt' => $row1_1_2->qty * $row1_1_2->price,
                        ]);
                        $salesbouquetflower->save();
                      }
                    }//search for existing flowers for the specific bqt
                  }
                }//
                foreach(Cart::instance('finalacccart')->content() as $row1_2_2)
                {
                  if($row1_2_2->options->Bqt_ID == $row1->id)
                  {
                    foreach($bouquetsA as $bouquetsA2_2)
                    {
                      if($bouquetsA2_2->bouquet_ID == $bouquet_details->bouquet_ID
                      and $bouquetsA2_2->acessory_ID == $row1_2_2->id)
                      {
                        $salesbouquetacc = new sales_order_acessories([
                            'Order_ID' => $sales_order_ID,
                            'BQT_ID' => $Newbouquet_ID,
                            'Acessories_ID' => $row1_2_2->id,
                            'Price' => $row1_2_2->price,
                            'QTY' => $row1_2_2->qty,
                            'Amt' => $row1_2_2->qty * $row1_2_2->price,
                        ]);
                        $salesbouquetacc->save();
                      }
                    }
                  }
                }//
            }
        }


        Cart::instance('flowerwish')->destroy();
        Cart::instance('finalboqcart')->destroy();
        Cart::instance('finalacccart')->destroy();
        Cart::instance('finalflowerbqt')->destroy();

        Session::put('orderid', $sales_order_ID);
        Return redirect() -> route('geteditaccount');
      // dulo

    }
      //return redirect()->route('homepages');
    } // Para dun sa finalCheckout

    public function checkoutfinalpickup(Request $request){

      $cust_id = Auth::user()->Cust_ID;
      $fname = $request->input('finalCustomer_FName');
      $mname = $request->input('finalCustomer_MName');
      $lname = $request->input('finalCustomer_LName');
      $contact = $request->input('finalCustomer_Number');
      $email = Auth::user()->email;
      $status = "PENDING";
      $type = "online";

      $sales_order = new sales_order([
                'customer_ID' => $cust_id,
                'Customer_Fname' => $fname,
                'Customer_Mname' => $mname,
                'Customer_Lname' => $lname,
                'Contact_Num' => $contact,
                'email_Address' => $email,
                'Status' => $status,
                'Type' => $type,

            ]);

      $sales_order -> save();

      $sales_order_ID = $sales_order -> sales_order_ID;

      foreach(Cart::instance('flowerwish')->content() as $row){

          $salesflower = new sales_order_flowers([

            'Sales_Order_ID' => $sales_order_ID,
            'Flower_ID' => $row->id,
            'QTY' => $row->qty,
            'Unit_Price' => $row->price,
            'Total_Amt' => $row->options->T_Amt,

          ]);

        $salesflower->save();
      }

      $customer_ID = $request->input('customer_ID');
      $recipientfname = $request->input('finalCustomer_FName');
      $recipientmname = $request->input('finalCustomer_MName');
      $recipientlname = $request->input('finalCustomer_LName');
      $paymentmethod = $request->input('final_paymentMethod');
      $orderdetailstatus = "PENDING";
      $orderdetailmethod = $request->input('final_shippingMethod');
      $orderdetailcontact = $request->input('finalCustomer_Number');
      $amount =  (str_replace(array(','), array(''), Cart::instance('finalboqcart')->subtotal()) + str_replace(array(','), array(''),
      Cart::instance('flowerwish')->subtotal()) );

      $orderdetails = new order_details([

        'Order_ID' => $sales_order_ID,
        'Customer_ID' => $cust_id,
        'Recipient_Fname' => $recipientfname,
        'Recipient_Mname' => $recipientmname,
        'Recipient_Lname' => $recipientlname,
        'Status' => $orderdetailstatus,
        'Payment_Mode' => $paymentmethod,
        'Subtotal' => $amount ,
        'Delivery_Charge' => "0",
        'Total_Amt' => $amount,
        'email_Addresss' => $email,
        'Contact_Num' => $orderdetailcontact,
        'shipping_method' => $orderdetailmethod,
        'BALANCE'=> $amount,
      ]);

      $orderdetails->save();
      $lastid = $orderdetails->id;

      $deliverydate = date('Y/m/d',strtotime($request->finalPickup_Date));
      $deliverytime = date('Y/m/d H:i:s', strtotime($request->input('finalPickup_Time')));
      $Scheduletype = $request->input('final_shippingMethod');
      $schedulestatus = "PENDING";

      $shop_schedule = new shop_schedule([
        'Order_ID' => $sales_order_ID,
        'Customer_fname'=>$recipientfname,
        'Customer_lname'=>$recipientlname,
        'Date_of_Event' => $deliverydate,
        'Time' => $deliverytime,
        'Schedule_Type' => $Scheduletype,
        'shedule_status' => "P",
      ]);

      $shop_schedule -> save();

      if(Cart::instance('finalboqcart')->count() == 0){

        Cart::instance('flowerwish')->destroy();
        Cart::instance('finalboqcart')->destroy();
        Cart::instance('finalacccart')->destroy();
        Cart::instance('finalflowerbqt')->destroy();


          Session::put('orderid', $sales_order_ID);
          Return redirect() -> route('geteditaccount');

      }
      else{
        $validator = 0;
        $validator2 = 0;
        $bouquets = DB::table('bouquet_details')->get();
        $bouquetsF = DB::table('bouquet_flowers')->get();
        $bouquetsA = DB::table('bouquet_acessories')->get();
        $bouquetsSOF = DB::table('sales_order_bouquet_flowers')->get();
        $bouquetsSOA = DB::table('sales_order_acessories')->get();

        foreach(Cart::instance('finalboqcart')->content() as $row1){
          $validator = 0;

          foreach($bouquets as $bqt){
            if($row1->id == $bqt->bouquet_ID){
              //nageexist na
                $validator = 1;
                break;
            }
          }//end of looking for existing bqt

            if($validator == 1)
            {
              $salesboquet = new sales_order_bouquet([
                  'Order_ID' => $sales_order_ID,
                  'Bqt_ID' => $row1->id,
                  'Unit_Price' => $row1->price,
                  'QTY' => $row1->qty,
                  'Amt' => $row1->qty * $row1->price,
              ]);
              $salesboquet->save();
              foreach(Cart::instance('finalflowerbqt')->content() as $row1_1)
              {
                if($row1_1->options->Bqt_ID == $row1->id)
                {
                  foreach($bouquetsF as $bouquetsF2)
                  {
                    if($bouquetsF2->bouquet_ID == $row1_1->options->Bqt_ID
                    and $bouquetsF2->flower_id == $row1_1->id)
                    {
                      $flowerexistence = 0;
                      foreach($bouquetsSOF as $bouquetsSOF2)
                      {
                          if($bouquetsSOF2->Order_ID == $sales_order_ID
                          and $bouquetsSOF2->Bqt_ID == $row1_1->options->Bqt_ID
                          and  $bouquetsSOF2->Flower_ID == $row1_1->id
                          and $row1_1->options->Bqt_ID == $row1->id)
                          {
                            $flowerexistence = 1;
                            break;
                          }
                      }
                      if($flowerexistence == 0)
                      {
                        $salesbouquetflower = new sales_order_bouquet_flowers([
                            'Order_ID' => $sales_order_ID,
                            'Bqt_ID' => $row1->id,
                            'Flower_ID' => $row1_1->id,
                            'Price' => $row1_1->price,
                            'QTY' => $row1_1->qty,
                            'Total_Amt' => $row1_1->qty * $row1_1->price,
                        ]);
                        $salesbouquetflower->save();
                      }
                    }
                  }//search for existing flowers for the specific bqt
                }
              }//
              foreach(Cart::instance('finalacccart')->content() as $row1_2)
              {
                if($row1_2->options->Bqt_ID == $row1->id)
                {
                  foreach($bouquetsA as $bouquetsA2)
                  {
                    if($bouquetsA2->bouquet_ID == $row1_2->options->Bqt_ID
                    and $bouquetsA2->acessory_ID == $row1_2->id)
                    {
                      $acrsExistence = 0;
                      foreach($bouquetsSOA as $bouquetsSOA2)
                      {
                        if($bouquetsSOA2->Order_ID == $sales_order_ID
                        and $bouquetsSOA2->BQT_ID == $row1_2->options->Bqt_ID
                        and  $bouquetsSOA2->Acessories_ID == $row1_2->id
                        and $row1_2->options->Bqt_ID == $row1->id)
                        {
                          $acrsExistence = 1;
                          break;
                        }
                      }
                      if($acrsExistence == 0)
                      {
                        $salesbouquetacc = new sales_order_acessories([
                          'Order_ID' => $sales_order_ID,
                          'BQT_ID' => $row1->id,
                          'Acessories_ID' => $row1_2->id,
                          'Price' => $row1_2->price,
                          'QTY' => $row1_2->qty,
                          'Amt' => $row1_2->qty * $row1_2->price,
                        ]);
                        $salesbouquetacc->save();
                      }
                    }
                  }
                }
              }
            }


//-------------------------------------------------------------------------------------------------
       else if($validator != 1)
        {
             //create a new Bouquet
              $bouquet_details = new bouquet_details([
                'price' => $row1->price,
                'count_ofFlowers' => $row1->options->count,
                'Type' => "custom",
                'Order_ID' => $sales_order_ID,
              ]);

              $bouquet_details->save();
              $Newbouquet_ID = $bouquet_details->bouquet_ID;


              foreach(Cart::instance('finalflowerbqt')->content() as $row2)
              {
                if($row2->options->Bqt_ID == $row1->id)
                {
                  foreach($bouquetsF as $bouquetsF2_2_1)
                  {
                    $ExistingBqtFlwr = 0;
                    //echo $bouquetsF2_2_1->bouquet_ID."|".$Newbouquet_ID."|".$bouquetsF2_2_1->flower_id."|".$row2->id."--------\n";
                    if($bouquetsF2_2_1->bouquet_ID == $bouquet_details->bouquet_ID
                    AND $bouquetsF2_2_1->flower_id == $row2->id){
                      $ExistingBqtFlwr = 1;
                      break;
                    }
                  }
                  if($ExistingBqtFlwr == 0){
                    $bouquet_flowers = new bouquet_flowers([
                      'bouquet_ID' => $Newbouquet_ID,
                      'flower_id' => $row2->id,
                      'qty' => $row2->qty,
                    ]);

                    $bouquet_flowers->save();
                  }
               }
//---------------------------------------------------------------------------------------------------------------------------------
              }


              foreach(Cart::instance('finalacccart')->content() as $row3)
              {
                if($row3->options->Bqt_ID == $row1->id)
                {
                  foreach($bouquetsA as $bouquetsA2_1_2_1)
                  {
                    $ExistingBqtAcrs = 0;
                    if($bouquetsA2_1_2_1->bouquet_ID == $bouquet_details->bouquet_ID
                    AND $bouquetsA2_1_2_1->acessory_ID == $row3->id)
                    {
                      $ExistingBqtAcrs = 1;
                     break;
                    }
                  }
                  if($ExistingBqtAcrs == 0)
                  {
                    $bouquet_accessories = new bouquet_acessories([
                      'bouquet_ID' => $Newbouquet_ID,
                      'acessory_ID' => $row3->id,
                      'qty' => $row3->qty,
                    ]);
                    $bouquet_accessories->save();
                  }
                }
              }

              $bouquetsF = DB::table('bouquet_flowers')->get();
              $bouquetsA = DB::table('bouquet_acessories')->get();
              $bouquetsSOF = DB::table('sales_order_bouquet_flowers')->get();
              $bouquetsSOA = DB::table('sales_order_acessories')->get();


            //  foreach(Cart::instance('finalboqcart')->content() as $row4){

                //if($row4->id == $row1->id){
                  $salesboquet = new sales_order_bouquet([
                    'Order_ID' => $sales_order_ID,
                    'Bqt_ID' => $Newbouquet_ID,
                    'Unit_Price' => $row1->price,
                    'QTY' => $row1->qty,
                    'Amt' => $row1->qty * $row1->price,
                  ]);

                  $salesboquet->save();
                //}
              //}



                foreach(Cart::instance('finalflowerbqt')->content() as $row1_1_2)
                {
                  if($row1_1_2->options->Bqt_ID == $row1->id)
                  {
                    //dd($row1_1_2->options->Bqt_ID,$row1->id);
                    foreach($bouquetsF as $bouquetsF2_2)
                    {
                      if($bouquetsF2_2->bouquet_ID == $bouquet_details->bouquet_ID
                      and $bouquetsF2_2->flower_id == $row1_1_2->id)
                      {
                        //dd($bouquetsF2_2->bouquet_ID,$bouquet_details->bouquet_ID,$bouquetsF2_2->flower_id,$row1_1_2->id);
                        $salesbouquetflower = new sales_order_bouquet_flowers([
                            'Order_ID' => $sales_order_ID,
                            'Bqt_ID' => $Newbouquet_ID,
                            'Flower_ID' => $row1_1_2->id,
                            'Price' => $row1_1_2->price,
                            'QTY' => $row1_1_2->qty,
                            'Total_Amt' => $row1_1_2->qty * $row1_1_2->price,
                        ]);
                        $salesbouquetflower->save();
                      }
                    }//search for existing flowers for the specific bqt
                  }
                }//
                foreach(Cart::instance('finalacccart')->content() as $row1_2_2)
                {
                  if($row1_2_2->options->Bqt_ID == $row1->id)
                  {
                    foreach($bouquetsA as $bouquetsA2_2)
                    {
                      if($bouquetsA2_2->bouquet_ID == $bouquet_details->bouquet_ID
                      and $bouquetsA2_2->acessory_ID == $row1_2_2->id)
                      {
                        $salesbouquetacc = new sales_order_acessories([
                            'Order_ID' => $sales_order_ID,
                            'BQT_ID' => $Newbouquet_ID,
                            'Acessories_ID' => $row1_2_2->id,
                            'Price' => $row1_2_2->price,
                            'QTY' => $row1_2_2->qty,
                            'Amt' => $row1_2_2->qty * $row1_2_2->price,
                        ]);
                        $salesbouquetacc->save();
                      }
                    }
                  }
                }//
            }
        }


        Cart::instance('flowerwish')->destroy();
        Cart::instance('finalboqcart')->destroy();
        Cart::instance('finalacccart')->destroy();
        Cart::instance('finalflowerbqt')->destroy();


        Session::put('orderid', $sales_order_ID);
        Return redirect() -> route('geteditaccount');

    }

    }

    public function guestfinalpickup(Request $request){

        $fname = $request->input('finalCustomer_FName');
        $mname = $request->input('finalCustomer_MName');
        $lname = $request->input('finalCustomer_LName');
        $contact = $request->input('finalCustomer_Number');
        $email = $request->guestemail;
        $status = "PENDING";
        $type = "online";

        $sales_order = new sales_order([
            'Customer_Fname' => $fname,
            'Customer_Mname' => $mname,
            'Customer_Lname' => $lname,
            'Contact_Num' => $contact,
            'email_Address' => $email,
            'Status' => $status,
            'Type' => $type,
        ]);

        $sales_order -> save();

        $sales_order_ID = $sales_order->sales_order_ID;

        foreach(Cart::instance('flowerwish')->content() as $row){

            $salesflower = new sales_order_flowers([

                'Sales_Order_ID' => $sales_order_ID,
                'Flower_ID' => $row -> id,
                'QTY' => $row -> qty,
                'Unit_Price' => $row -> price,
                'Total_Amt' => $row -> options -> T_Amt,

            ]);

            $salesflower->save();
        }

        $customer_ID = $request->input('customer_ID');
        $recipientfname = $request->input('finalCustomer_FName');
        $recipientmname = $request->input('finalCustomer_MName');
        $recipientlname = $request->input('finalCustomer_LName');
        $paymentmethod = $request->input('final_paymentMethod');
        $orderdetailstatus = "PENDING";
        $orderdetailmethod = $request->input('final_shippingMethod');
        $orderdetailcontact = $request->input('finalCustomer_Number');
        $amount =  (str_replace(array(','), array(''), Cart::instance('finalboqcart')->subtotal()) + str_replace(array(','), array(''),
                Cart::instance('flowerwish')->subtotal()) );

        $orderdetails = new order_details([

            'Order_ID' => $sales_order_ID,
            'Recipient_Fname' => $recipientfname,
            'Recipient_Mname' => $recipientmname,
            'Recipient_Lname' => $recipientlname,
            'Status' => $orderdetailstatus,
            'Payment_Mode' => $paymentmethod,
            'Subtotal' => $amount ,
            'Delivery_Charge' => "0",
            'Total_Amt' => $amount,
            'email_Addresss' => $email,
            'Contact_Num' => $orderdetailcontact,
            'shipping_method' => $orderdetailmethod,

        ]);

        $orderdetails->save();
        $lastid = $orderdetails -> id;

        $deliverydate = date('Y/m/d',strtotime($request -> finalPickup_Date));
        $deliverytime = date('Y/m/d H:i:s', strtotime($request->input('finalPickup_Time')));
        $Scheduletype = $request->input('final_shippingMethod');
        $schedulestatus = "PENDING";

        $shop_schedule = new shop_schedule([
            'Order_ID' => $sales_order_ID,
            'Date_of_Event' => $deliverydate,
            'Time' => $deliverytime,
            'Schedule_Type' => $Scheduletype,
            'shedule_status' => "P",
        ]);

        $shop_schedule -> save();

        if(Cart::instance('finalboqcart')->count() == 0){

            Cart::instance('flowerwish')->destroy();
            Cart::instance('finalboqcart')->destroy();
            Cart::instance('finalacccart')->destroy();
            Cart::instance('finalflowerbqt')->destroy();


            Return redirect() -> route('guestorder', ['id' => $sales_order_ID]);
        }

        else{



          foreach(Cart::instance('finalboqcart')->content() as $row1){

            $bouquet_details = new bouquet_details([

              'price' => $row1-> price,
              'count_ofFlowers' => $row1->options->count,
              'Type' => "custom",
              'Order_ID' => $sales_order_ID,
            ]);

            $bouquet_details->save();
            $bouquet_ID = $bouquet_details -> bouquet_ID;

          }

          foreach(Cart::instance('finalflowerbqt')->content() as $row2){

            $bouquet_flowers = new bouquet_flowers([

              'bouquet_ID' => $bouquet_ID,
              'flower_id' => $row2->id,
              'qty' => $row2->qty,

            ]);

            $bouquet_flowers->save();

          }

          foreach(Cart::instance('finalacccart')->content() as $row3){

            $bouquet_accessories = new bouquet_acessories([
              'bouquet_ID' => $bouquet_ID,
              'acessory_ID' => $row3->id,
              'qty' => $row3->qty,

            ]);

            $bouquet_accessories->save();

          }


          foreach(Cart::instance('finalboqcart')->content() as $row4){

            $salesboquet = new sales_order_bouquet([

              'Order_ID' => $sales_order_ID,
              'Bqt_ID' => $bouquet_ID,
              'Unit_Price' => $row4->price,
              'QTY' => $row4->qty,
              'Amt' => $row4->qty * $row4->price,
              ]);

              $salesboquet->save();


            }

            foreach(Cart::instance('finalflowerbqt')->content() as $row5){

              $salesbouquetflower = new sales_order_bouquet_flowers([

              'Order_ID' => $sales_order_ID,
              'Bqt_ID' => $bouquet_ID,
              'Flower_ID' => $row5->id,
              'Price' => $row5->price,
              'QTY' => $row5->qty,
              'Total_Amt' => $row5->qty * $row5->price,

              ]);

              $salesbouquetflower->save();

            }

            foreach(Cart::instance('finalacccart')->content() as $row6){

              $salesbouquetacc = new sales_order_acessories([

              'Order_ID' => $sales_order_ID,
              'BQT_ID' => $bouquet_ID,
              'Acessories_ID' => $row6->id,
              'Price' => $row6->price,
              'QTY' => $row6->qty,
              'Amt' => $row6->qty * $row6->price,

              ]);

              $salesbouquetacc->save();

            }
            Cart::instance('flowerwish')->destroy();
            Cart::instance('finalboqcart')->destroy();
            Cart::instance('finalacccart')->destroy();
            Cart::instance('finalflowerbqt')->destroy();


            Return redirect() -> route('guestorder', ['id' => $sales_order_ID]);

        }


    }

    public function guestdeliver(Request $request){

        $fname = $request->input('Cust_FName');
        $mname = $request->input('Cust_MName');
        $lname = $request->input('Cust_LName');
        $contact = $request->input('Cust_Number');
        $email = $request->deliveremail;
        $status = "PENDING";
        $type = "online";
        $check = 0;

        $sales_order = new sales_order([
            'Customer_Fname' => $fname,
            'Customer_Mname' => $mname,
            'Customer_Lname' => $lname,
            'Contact_Num' => $contact,
            'email_Address' => $email,
            'Status' => $status,
            'Type' => $type,

        ]);

        $sales_order -> save();



        // Shop Schedule

        $sales_order_ID = $sales_order -> sales_order_ID;

        foreach(Cart::instance('flowerwish')->content() as $row){

            $salesflower = new sales_order_flowers([

                'Sales_Order_ID' => $sales_order_ID,
                'Flower_ID' => $row -> id,
                'QTY' => $row -> qty,
                'Unit_Price' => $row -> price,
                'Total_Amt' => $row -> options -> T_Amt,

            ]);
            $salesflower->save();
        }

        //order_details
        $deliveryadd = $request->input('Cust_AddrsLine');
        $deliverybrgy = $request->input('Cust_Brgy');
        $deliverycity = $request->input('Cust_city');
        $deliverprov = $request->input('Cust_prov');
        $recipientfname = $request->input('finalrecipient_FName');
        $recipientmname = $request->input('finalrecipient_MName');
        $recipientlname = $request->input('finalrecipient_LName');
        $paymentmethod = $request->input('Cust_paymentMethod');
        $orderdetailstatus = "PENDING";
        $orderdetailmethod = $request->input('Cust_shippingMethod');
        $orderdetailcontact = $request->input('finalrecipient_Number');
        $amount =  (str_replace(array(','), array(''), Cart::instance('finalboqcart')->subtotal()) + str_replace(array(','), array(''),
                Cart::instance('flowerwish')->subtotal()) );

        if($orderdetailmethod == 'delivery'){
            if($deliverprov == 47 AND $deliverycity == 969){
                $deliveryCharge = 0;
            }
            else if($deliverprov == 47 AND $deliverycity != 969){
                $deliveryCharge = 300;
            }
            else{
                $deliveryCharge = 0.0;
            }
        }else{
            $deliveryCharge = 0.0;
        }

        $vat = ($amount * .12) ;

        $orderdetails = new order_details([

            'Order_ID' => $sales_order_ID,
            'Delivery_Address' => $deliveryadd,
            'Delivery_Baranggay' => $deliverybrgy,
            'Delivery_City' => $deliverycity,
            'Delivery_Province' => $deliverprov,
            'Recipient_Fname' => $recipientfname,
            'Recipient_Mname' => $recipientmname,
            'Recipient_Lname' => $recipientlname,
            'Status' => $orderdetailstatus,
            'Payment_Mode' => $paymentmethod,
            'Subtotal' => $amount ,
            'Delivery_Charge' => $deliveryCharge,
            'Total_Amt' => $amount + $vat,
            'email_Addresss' => $email,
            'Contact_Num' => $orderdetailcontact,
            'shipping_method' => $orderdetailmethod,
            'VAT' => $vat,

        ]);



        $orderdetails -> save();


        $lastid = $orderdetails->id;

        $deliverydate = date('Y/m/d',strtotime($request -> Cust_Date));
        $deliverytime = date('Y/m/d H:i:s', strtotime($request->input('Cust_Time')));
        $Scheduletype = $request->input('Cust_shippingMethod');
        $schedulestatus = "PENDING";

        $shop_schedule = new shop_schedule([
            'Order_ID' => $sales_order_ID,
            'Customer_fname' => $fname,
            'Customer_lname' => $lname,
            'Date_of_Event' => $deliverydate,
            'Time' => $deliverytime,
            'Schedule_Type' => $Scheduletype,
            'shedule_status' => "P",
        ]);

        $shop_schedule -> save();


        //flower cart



        //bouquet cart

        if(Cart::instance('finalboqcart')->count() == 0){

            Cart::instance('flowerwish')->destroy();
            Cart::instance('finalboqcart')->destroy();
            Cart::instance('finalacccart')->destroy();
            Cart::instance('finalflowerbqt')->destroy();


            Return redirect() -> route('guestorder', ['id' => $sales_order_ID]);


        }

        else{


            foreach(Cart::instance('finalboqcart')->content() as $row1){

                $bouquet_details = new bouquet_details([

                    'price' => $row1-> price,
                    'count_ofFlowers' => $row1->options->count,
                    'Type' => "custom",
                    'Order_ID' => $sales_order_ID,
                ]);

                $bouquet_details->save();
                $bouquet_ID = $bouquet_details -> bouquet_ID;

            }

            foreach(Cart::instance('finalflowerbqt')->content() as $row2){

                $bouquet_flowers = new bouquet_flowers([

                    'bouquet_ID' => $bouquet_ID,
                    'flower_id' => $row2->id,
                    'qty' => $row2->qty,

                ]);

                $bouquet_flowers->save();

            }

            foreach(Cart::instance('finalacccart')->content() as $row3){

                $bouquet_accessories = new bouquet_acessories([
                    'bouquet_ID' => $bouquet_ID,
                    'acessory_ID' => $row3->id,
                    'qty' => $row3->qty,

                ]);

                $bouquet_accessories->save();

            }


            foreach(Cart::instance('finalboqcart')->content() as $row4){

                $salesboquet = new sales_order_bouquet([

                    'Order_ID' => $sales_order_ID,
                    'Bqt_ID' => $bouquet_ID,
                    'Unit_Price' => $row4->price,
                    'QTY' => $row4->qty,
                    'Amt' => $row4->qty * $row4->price,
                ]);

                $salesboquet->save();


            }

            foreach(Cart::instance('finalflowerbqt')->content() as $row5){

                $salesbouquetflower = new sales_order_bouquet_flowers([

                    'Order_ID' => $sales_order_ID,
                    'Bqt_ID' => $bouquet_ID,
                    'Flower_ID' => $row5->id,
                    'Price' => $row5->price,
                    'QTY' => $row5->qty,
                    'Total_Amt' => $row5->qty * $row5->price,

                ]);

                $salesbouquetflower->save();

            }

            foreach(Cart::instance('finalacccart')->content() as $row6){

                $salesbouquetacc = new sales_order_acessories([

                    'Order_ID' => $sales_order_ID,
                    'BQT_ID' => $bouquet_ID,
                    'Acessories_ID' => $row6->id,
                    'Price' => $row6->price,
                    'QTY' => $row6->qty,
                    'Amt' => $row6->qty * $row6->price,

                ]);

                $salesbouquetacc->save();

            }

            Cart::instance('flowerwish')->destroy();
            Cart::instance('finalboqcart')->destroy();
            Cart::instance('finalacccart')->destroy();
            Cart::instance('finalflowerbqt')->destroy();


            Return redirect() -> route('guestorder', ['id' => $sales_order_ID]);
            // dulo

        }

    }

    public function PrintSummary($id){

                    $cities = DB::table('cities')
                    ->select('*')
                    ->get();

                $province = DB::table('provinces')
                    ->select('*')
                    ->get();

                $NewSalesOrder = sales_order::find($id);
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

                $cityName = "";
                $provName = "";

                foreach($cities as $city){
                    if($NewSalesOrder_details->Delivery_City == $city->id){
                        $cityName = $city->name;
                    }
                }
                foreach($province as $prov){
                    if($prov->id == $NewSalesOrder_details->Delivery_Province){
                        $provName = $prov->name;
                    }
                }

                $current = Carbon::now('Asia/Manila')->toDateString();


                Session::remove('orderid');

                $pdf = \PDF::loadView("reports\Customer_Side_OrderSummary",['city'=>$cityName,'province'=>$provName,'NewSalesOrder'=>$NewSalesOrder,
                    'NewOrder_SchedDetails'=>$NewOrder_SchedDetails,'SalesOrder_flowers'=>$SalesOrder_flowers,'NewOrder_Bouquet'=>$NewOrder_Bouquet,
                    'SalesOrder_Bqtflowers'=>$SalesOrder_Bqtflowers,'SalesOrder_BqtAccessories'=>$SalesOrder_BqtAccessories,'NewSalesOrder_details'=>$NewSalesOrder_details]);

                return $pdf->download('RECEIPT-'.$id.'-'.$current.'.pdf');

    }




}
