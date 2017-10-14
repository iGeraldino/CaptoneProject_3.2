<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomerPayment;
use App\Http\Requests;
use Carbon\Carbon;
use App\Newshop_Schedule;
use App\Neworder_details;
use Illuminate\Support\Facades\DB;
use Session;
use Auth;
use Image;
use \Cart;
use App\Customer_Payment;


class Bank_MultipleOrder_PaymentController extends Controller
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
        //echo 'hahah';
        $current = Carbon::now('Asia/Manila');

          //
          $decision = $request->Decision_text2;
          $Minimum_Down = $request->SubtotalDown2;

          $fromId = $request->Currentcust_ID2;
          $fromFname = $request->Current_FName2;
          $fromLname = $request->Current_LName2;
          $nFname = $request->nf_namefield2;
          $nlname = $request->nl_namefield2;

          $bankname = $request->Bank_Name;
          $SlipNum = $request->slip_Number;
          $dateDeposited = $request->D_date;
          $amount = $request->D_Amount;

          $BalanceTobepaid = str_replace(',','',Cart::instance('ordersTopay')->subtotal());

          //$NewSalesOrder = sales_order::find($id);
          $customerPayment = new CustomerPayment;
          $customerPayment->Amount = $amount;
          $customerPayment->Amount_Used = $amount;
          $customerPayment->Date_Obtained = $current;
          if($decision == "N"){
            $customerPayment->From_Id = null;
            $customerPayment->From_FName = $nFname;
            $customerPayment->From_LName = $nlname;
          }else{
            $customerPayment->From_Id = $fromId;
            $customerPayment->From_FName = $fromFname;
            $customerPayment->From_LName = $fromLname;
          }

          $customerPayment->Type = "BANK";
          $customerPayment->bank_name = $bankname;
          $customerPayment->BALANCE = $BalanceTobepaid;

          if($request -> hasFile('DSlipimg')){
              $image = $request->file('DSlipimg');
              $filename = time().'.' . $image->getClientOriginalExtension();
              $location = public_path('paymentPictures/' . $filename);
              Image::make($image)->save($location);
              $customerPayment->image = $filename;
          }
          $customerPayment->save();


        foreach(Cart::instance('ordersTopay')->content() as $orders){

          $NewSalesOrder_details = Neworder_details::find($orders->id);
          $Balance = 0.00;//gets the balance even they paid greater but uses partial of the payment only
          $status = '';
          $stat = '';
          if($NewSalesOrder_details->Status == 'BALANCED' OR $NewSalesOrder_details->Status == 'P_PARTIAL'){
            $status = 'P_FULL';
            $stat = 'PF';
          }
          else if($NewSalesOrder_details->Status == 'A_UNPAID' OR $NewSalesOrder_details->Status == 'A_P_PARTIAL'){
            $status = 'CLOSED';
            $stat = 'C';
          }


            $UpdateOrderDet = DB::select('CALL confirmOrder(?,?,?)',array($orders->id,$status,0.00));//updated the status of the order details as well sa the salesorder status

            $newInvoice = DB::select("CALL update_BalAndstat_ofInvoice(?,?,?,?);",
            array($orders->id,$current,$stat,0.00));
            //update the invoice

            //make a record of customer payment Settlement record
             $createPaymentSettlement = DB::select('CALL create_RecordPaymentSettlement(?,?,?,?,?)',
             array($orders->id,$customerPayment->Payment_ID,$amount,$orders->price,0.00));
             Session::put('PaymentCompletion_Session','Successful');
           }
           Cart::instance('ordersTopay')->destroy();
           return redirect()->route('ManageMultipleOrder_Bank.show',$customerPayment->Payment_ID);
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
        //Cart::instance('ordersTopay')->destroy();
        $payment_Details = Customer_Payment::find($id);
        //dd($payment_Details);
        $p_settlements = DB::select('CALL payment_Settlements(?)',array($id));
        //dd($p_settlements);
       return view('orders.payment_Summary')
        ->with('P_Settlements',$p_settlements)
        ->with('P_Details',$payment_Details);
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
