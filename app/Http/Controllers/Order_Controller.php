<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Carbon\Carbon;
use Session;
use Auth;
use App\Sales_Qoutation;
use \Cart;
use App\newSales_order;
use App\bouquet_details;
use App\Newshop_Schedule;
use App\Neworder_details;

class Order_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            if(auth::guard('admins')->user()->type == '1'){
                $cities = DB::table('cities')
                  ->select('*')
                  ->get();

                $province = DB::table('provinces')
                  ->select('*')
                  ->get();

                $ClosedsalesOrders = DB::table('sales_order')
                ->select('*')
                ->where('Status','CLOSED')
                ->get();

                $Pending_salesOrders = DB::table('sales_order')
                ->select('*')
                ->where('Status','PENDING')
                ->get();

                $Confirmed_salesOrders = DB::select('CALL confirmed_Orders()');

                $customers = DB::table('customer_details')
                ->select('*')
                ->get();



                //
                return view('Orders.Sales_Order_list')
                ->with('Dorders',$ClosedsalesOrders)
                ->with('Porders',$Pending_salesOrders)
                ->with('Corders',$Confirmed_salesOrders)
                ->with('cust',$customers)
                ->with('city',$cities)
                ->with('city2',$cities)
                ->with('province',$province);
            //}
            }
            else if(auth::guard('admins')->user()->type == '2'){
              $cities = DB::table('cities')
                ->select('*')
                ->get();

              $province = DB::table('provinces')
                ->select('*')
                ->get();

              $ClosedsalesOrders = DB::table('sales_order')
              ->select('*')
              ->where('Status','CLOSED')
              ->get();

              $Pending_salesOrders = DB::table('sales_order')
              ->select('*')
              ->where('Status','PENDING')
              ->get();

              $Confirmed_salesOrders = DB::select('CALL confirmed_Orders()');

              $customers = DB::table('customer_details')
              ->select('*')
              ->get();

              //
              return view('Orders.Sales_Order_list')
              ->with('Dorders',$ClosedsalesOrders)
              ->with('Porders',$Pending_salesOrders)
              ->with('Corders',$Confirmed_salesOrders)
              ->with('cust',$customers)
              ->with('city',$cities)
              ->with('city2',$cities)
              ->with('province',$province);
          //}
          }
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
        if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
                //
                $newQoutation = new Sales_Qoutation;

                    $Custid = '';
                    $Fname = '';
                    $MName = '';
                    $LName = '';
                    $Contact_Num = '';
                    $email_Address = '';
                    $DeliveryAddLine = '';
                    $brgy = '';
                    $prov = '';
                    $town = '';
                    $type = '';
                    $HotelName = $request->HotelNameList;
                    $ShopName = $request->ShopNameList;
                    $transType = '';

                echo 'customerstat = '.$request->customer_stat;

                if($request->customer_stat == 'new'){
                    $Custid = 'none';
                    $Fname = $request->Cust_FNameField;
                    $MName = $request->Cust_MNameField;
                    $LName = $request->Cust_LNameField;
                    $Contact_Num = $request->ContactNum_Field;
                    $email_Address = $request->email_Field;
                    $DeliveryAddLine = $request->Addrs_LineField;
                    $brgy = $request->brgyField;
                    $prov = $request->ProvinceField;
                    $town = $request->TownField;
                    $type = 'C';
                    $ShopName = 'none';
                    $HotelName = 'none';
                    $transType = $request->Trans_typeField;
                }//
                else if($request->customer_stat == 'old'){
                    $Custid = $request->idfield;
                    $Fname = $request->customerList_FName;
                    $MName = $request->customerList_MName;
                    $LName = $request->customerList_LName;
                    $Contact_Num = $request->Contact_NumList_LName;
                    $email_Address = $request->Email_AddList_LName;
                    $DeliveryAddLine = $request->Addrs_LineField;
                    $brgy = $request->brgyField;
                    $prov = $request->ProvinceField;
                    $town = $request->TownField2;
                    $transType = $request->Trans_typeField;
                    $type = $request->TypeList;
                    if ($type == 'C'){
                        $ShopName = 'none';
                        $HotelName = 'none';
                    }//end of if
                    else if ($type == 'H'){
                        $ShopName = 'none';
                        $HotelName = $request->HotelNameList;
                    }//end of else if
                    else if ($type == 'S'){
                        $ShopName = $request->ShopNameList;
                        $HotelName = 'none';
                    }//end of else if

                }

                $AvailableFlowers = DB::select('call wonderbloomdb2.Viewing_Flowers_With_UpdatedPrice()');

                $NewOrderDetails = array();
                $NewOrderDetailsRows = array();

                if ($request->session()->has('newOrderSession')){
                    //
                    //echo 'may sesssion';
                    Session::flush('newOrderSession');
                    $NewOrderDetails = collect([$Custid,$type,$Fname,$MName,$LName,$Contact_Num,$email_Address,$DeliveryAddLine,$brgy,$town,$prov,$HotelName,$ShopName,$transType]);

                    Session::put('newOrderSession', $NewOrderDetails);
                }
                else{
                      $NewOrderDetails = collect([$Custid,$type,$Fname,$MName,$LName,$Contact_Num,$email_Address,$DeliveryAddLine,$brgy,$town,$prov,$HotelName,$ShopName,$transType]);
                    //echo 'wlang session';
                    Session::put('newOrderSession',$NewOrderDetails);
                }
                $NewOrderDetailsRows = Session::get('newOrderSession');
                    //dd($NewOrderDetailsRows);

                //Session::flush('newOrderSession');

             Session::put('Add_Order_ofCustomer', 'Successful');
             return view('Orders.creationOfOrders')
             ->with('FlowerList',$AvailableFlowers);
          //  }
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
        if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            /*$Flowers = DB::table('flower_details')
            ->select('*')
            ->get();*/

            $AvailableFlowers = DB::select('CALL flowers_Not_in_the_Order_Yet(?)',array($id));
            $Sum_Flowers_PerOrder = DB::select('CALL Total_Amount_of_Flowers_per_Order(?)',array($id));
            $Sum_Bouquet_PerOrder = DB::select('CALL Total_Amt_Bouquet_per_Order(?)',array($id));

            $QTN_Details = DB::select('CALL salesorder_details(?)',array($id));
            $QTN_FLowers = DB::select('CALL salesorder_Flowers(?)',array($id));
            $QTN_Bouquet = DB::select('CALL salesorder_Bouquet(?)',array($id));
            $QTN_Acessories = DB::select('CALL salesorder_Acessories(?)',array($id));

            return view('Orders.Specific_SalesOrders')
            ->with('Orders_Details',$QTN_Details)
            ->with('Flowers',$QTN_FLowers)
            ->with('Bouquets',$QTN_Bouquet)
            ->with('Acessories',$QTN_Acessories)
            ->with('TAmount_flowers',$Sum_Flowers_PerOrder)
            ->with('TAmount_bouquet',$Sum_Bouquet_PerOrder)
            ->with('FlowerList',$AvailableFlowers);
        //}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  }
    public function edit($id)
    {
        //
        //

        if(auth::guard('admins')->user()->type == '1'){
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

          //dd($SalesOrder_flowers);

         //dd($NewOrder_SchedDetails);
          return view('Orders/viewDetails_ofSalesOrder')
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
        else if (auth::guard('admins')->user()->type == '2'){
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

          //dd($SalesOrder_flowers);

         //dd($NewOrder_SchedDetails);
          return view('Orders/viewDetails_ofSalesOrder')
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
        else if(auth::guard('admins')->user()->type == '3'){
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

          //dd($SalesOrder_flowers);

         //dd($NewOrder_SchedDetails);
          return view('Orders/viewDetails_ofSalesOrder')
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
