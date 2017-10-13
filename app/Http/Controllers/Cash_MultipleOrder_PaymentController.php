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


class Cash_MultipleOrder_PaymentController extends Controller
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
        //echo 'wahaahhaahha';
        $current = Carbon::now('Asia/Manila');

          //
          $decision = $request->Decision_text;
          $cust_ID = $request->Currentcust_ID;
          $currentFname = $request->Current_FName;
          $currentLname = $request->Current_LName;
          $nFname = $request->nf_namefield;
          $nLname = $request->nl_namefield;

          $amt_Paid = $request->payment_field;
          $amt_Paid2 = $request->payment;
          $change = $request->changeField;

          $value = collect([
            $decision ,
            $cust_ID ,
            $currentFname ,
            $currentLname ,
            $nLname ,
            $nLname ,
            $amt_Paid ,
            $amt_Paid2 ,
            $change
          ]);
        //dd($value);

        $BalanceTobepaid = str_replace(',','',Cart::instance('ordersTopay')->subtotal());

        $customerPayment = new CustomerPayment;
        $customerPayment->Amount = $amt_Paid2;
        $customerPayment->Amount_Used = $amt_Paid2;
        $customerPayment->Date_Obtained = $current;
        if($decision == "N"){
          $customerPayment->From_Id = null;
          $customerPayment->From_FName = $nFname;
          $customerPayment->From_LName = $nLname;
        }else{
          $customerPayment->From_Id = $cust_ID;
          $customerPayment->From_FName = $currentFname;
          $customerPayment->From_LName = $currentLname;
        }
        $customerPayment->Type = "CASH";
        $customerPayment->BALANCE = $BalanceTobepaid;
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
              $UpdateOrderDet = DB::select('CALL confirmOrder(?,?,?)',array($orders->id,$status,0));//updated the status of the order details as well sa the salesorder status
              $newInvoice = DB::select("CALL update_BalAndstat_ofInvoice(?,?,?,?);",
              array($orders->id,$current,$stat,0.00));

              $amtused = str_replace(',','',$orders->price);

              //make a record of customer payment settlement record
              $Derived_Change = $amt_Paid2 - $amtused;
              $createPaymentSettlement = DB::select('CALL create_RecordPaymentSettlement(?,?,?,?,?)',
              array($orders->id,$customerPayment->Payment_ID,$amt_Paid2,$orders->price,$Derived_Change));
              Session::put('CashMulti_Payment_CompletionSession','Successful');
            }
            return redirect()->back();

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
