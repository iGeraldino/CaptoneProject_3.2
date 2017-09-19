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


use Cart;
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
          $details = customer_details::where('Cust_ID', '=' , Auth::user()->Cust_ID)->get();
        }
        else{
          $details = customer_details::all();
        }

        return view('customer_side.pages.checkout')
        ->with('account', $account)
        ->with('city',$cities)
        ->with('province',$province)
        ->with('city',$cities)
        ->with('province',$province)
        ->with('city2',$cities)
        ->with('province2',$province)
        ->with('city3',$cities)
        ->with('province3',$province)
        ->with('details', $details)
        ->with('details1', $details);


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

      $user = new User ([

          'email' => $request -> input('signemail'),
          'password' => bcrypt($request -> input('password')),
          'username' => $request -> input('username'),
          'Cust_ID' => $id,
      ]);


      $user -> save();


      Auth::login($user);

      return redirect()-> route('checkingregistration');

    }


    public function userfinalCheckout(Request $request){

      $cust_id = Auth::user()->Cust_ID;
      $fname = $request->input('Cust_FName');
      $mname = $request->input('Cust_MName');
      $lname = $request->input('Cust_LName');
      $contact = $request->input('Cust_Number');
      $email = Auth::user()->email;
      $status = "pending";
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
        echo $sales_order_ID;
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
      $orderdetailstatus = "pending";
      $orderdetailmethod = $request->input('Cust_shippingMethod');
      $orderdetailcontact = $request->input('finalrecipient_Number');
      $amount =  (str_replace(array(','), array(''), Cart::instance('finalboqcart')->subtotal()) + str_replace(array(','), array(''),
      Cart::instance('flowerwish')->subtotal()) );

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
        'Delivery_Charge' => "0",
        'Total_Amt' => $amount,
        'email_Addresss' => $email,
        'Contact_Num' => $orderdetailcontact,
        'shipping_method' => $orderdetailmethod,

      ]);

      $orderdetails->save();

      $deliverydate = Carbon::createFromFormat('d/m/Y', $request->input('Cust_Date'));
      $deliverytime = $request->input('Cust_Time');
      $Scheduletype = $request->input('Cust_shippingMethod');
      $schedulestatus = "pending";

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
                'QTY' => $row4->options->count,
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


      return redirect()->route('homepages');

    } // Para dun sa finalCheckout

    public function checkoutfinalpickup(Request $request){

      $cust_id = Auth::user()->Cust_ID;
      $fname = $request->input('finalCustomer_FName');
      $mname = $request->input('finalCustomer_MName');
      $lname = $request->input('finalCustomer_LName');
      $contact = $request->input('finalCustomer_Number');
      $email = Auth::user()->email;
      $status = "pending";
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
            'Flower_ID' => $row -> id,
            'QTY' => $row -> qty,
            'Unit_Price' => $row -> price,
            'Total_Amt' => $row -> options -> T_Amt,

          ]);

        $salesflower->save();
      }

      $customer_ID = $cust_id;
      $recipientfname = $request->input('finalCustomer_FName');
      $recipientmname = $request->input('finalCustomer_MName');
      $recipientlname = $request->input('finalCustomer_LName');
      $paymentmethod = $request->input('final_paymentMethod');
      $orderdetailstatus = "pending";
      $orderdetailmethod = $request->input('final_shippingMethod');
      $orderdetailcontact = $request->input('finalCustomer_Number');
      $amount =  (str_replace(array(','), array(''), Cart::instance('finalboqcart')->subtotal()) + str_replace(array(','), array(''),
      Cart::instance('flowerwish')->subtotal()) );

      $orderdetails = new order_details([

        'Order_ID' => $sales_order_ID,
        'Customer_ID' => $customer_ID,
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

      $deliverydate = Carbon::createFromFormat('d/m/Y', $request->input('finalPickup_Date'));
      $deliverytime = $request->input('finalPickup_Time');
      $Scheduletype = $request->input('final_shippingMethod');
      $schedulestatus = "pending";

      $shop_schedule = new shop_schedule([
        'Order_ID' => $sales_order_ID,
        'Date_of_Event' => $deliverydate,
        'Time' => $deliverytime,
        'Schedule_Type' => $Scheduletype,
        'shedule_status' => "P",
      ]);

      $shop_schedule -> save();

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
                'QTY' => $row4->options->count,
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


      return redirect()->route('homepages');



    }//end



}
