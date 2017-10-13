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

class ManageOrder_checkController extends Controller
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
        //echo 'ang status mo ay balanced';
        $current = Carbon::now('Asia/Manila');

          //
          $Order_ID = $request->Order_ID3;
          $decision = $request->Decision_text3;
          $Minimum_Down = $request->SubtotalDown3;

          $fromId = $request->Currentcust_ID3;
          $fromFname = $request->Current_FName3;
          $fromLname = $request->Current_LName3;
          $nFname = $request->nf_namefield3;
          $nlname = $request->nl_namefield3;
          $asignatory = $request->asignatory;

          $bankname = $request->Bank_Name3;
          $checkNum = $request->check_Number;
          $dateofCheck = $request->check_date;
          $dateRecieved = $request->recieved_date;
          $timeRecieved = $request->recieved_time;
          $amount = $request->Check_Amount;



          //$NewSalesOrder = sales_order::find($id);
          $NewSalesOrder_details = Neworder_details::find($Order_ID);
          $Change = 0;

          if($amount >= $NewSalesOrder_details->Total_Amt){
            //dd($NewSalesOrder_details->Status);


            $Change = 0;
            $Newstatus = "";
            $Newstat = "";

            if($NewSalesOrder_details->Status == 'BALANCED'){
              $Newstatus = 'P_FULL';
              $Newstat = 'PF';
            }else if($NewSalesOrder_details->Status == 'A_UNPAID'){
              $Newstatus = 'CLOSED';
              $Newstat = 'C';
            }

            //dd('> or equal'.$Newstatus.'-------'.$Newstat);

            $UpdateOrderDet = DB::select('CALL confirmOrder(?,?,?)',array($Order_ID,$Newstatus,0.00));//updated the status of the order details as well sa the salesorder status

            $newInvoice = DB::select("CALL update_BalAndstat_ofInvoice(?,?,?,?);",
            array($Order_ID,$current,$Newstat,0.00));

            $customerPayment = new CustomerPayment;
            $customerPayment->check_Number = $checkNum;
            $customerPayment->asignatory = $asignatory;
            $customerPayment->Amount = $amount;
            $customerPayment->Amount_Used = $amount;
            $customerPayment->Date_Obtained = $dateRecieved;
            $customerPayment->date_of_check = $dateofCheck;
            if($decision == "N"){
              $customerPayment->From_Id = null;
              $customerPayment->From_FName = $nFname;
              $customerPayment->From_LName = $nlname;
            }else{
              $customerPayment->From_Id = $fromId;
              $customerPayment->From_FName = $fromFname;
              $customerPayment->From_LName = $fromLname;
            }

            $customerPayment->Type = "CHECK";
            $customerPayment->bank_name = $bankname;
            $customerPayment->BALANCE = $NewSalesOrder_details->BALANCE;
            if($request -> hasFile('Checkimg')){
                $image = $request->file('Checkimg');
                $filename = time().'.' . $image->getClientOriginalExtension();
                $location = public_path('paymentPictures/' . $filename);
                Image::make($image)->save($location);
                $customerPayment->image = $filename;
            }
            $customerPayment->save();

            //make a record of customer payment Settlement record
             $createPaymentSettlement = DB::select('CALL create_RecordPaymentSettlement(?,?,?,?,?)',
             array($Order_ID,$customerPayment->Payment_ID,$amount,$amount,$Change));
             if($Newstatus == 'P_FULL'){
               Session::put('PayDebtOrderSession','Successful');
             }else if($Newstatus == 'CLOSED'){
               Session::put('PayDebtOrderSession','Successful1');
             }
          }//end of if
          else if($amount < $NewSalesOrder_details->Total_Amt){
            $Balance = $NewSalesOrder_details->Total_Amt - $amount;

            $Newstatus = "";
            $Newstat = "";

            //dd($NewSalesOrder_details->Status);

            if($NewSalesOrder_details->Status == 'BALANCED'){
              $Newstatus = 'P_PARTIAL';
              $Newstat = 'PP';
            }else if($NewSalesOrder_details->Status == 'A_UNPAID'){
              $Newstatus = 'A_P_PARTIAL';
              $Newstat = 'APP';
            }

            //dd($Newstatus.'-------'.$Newstat);
            $UpdateOrderDet = DB::select('CALL confirmOrder(?,?,?)',array($Order_ID,$Newstatus,$Balance));//updated the status of the order details as well sa the salesorder status

            $newInvoice = DB::select("CALL update_BalAndstat_ofInvoice(?,?,?,?);",
            array($Order_ID,$current,$Newstat,$Balance));

            $customerPayment = new CustomerPayment;
            $customerPayment->check_Number = $checkNum;
            $customerPayment->asignatory = $asignatory;
            $customerPayment->Amount = $amount;
            $customerPayment->Amount_Used = $amount;
            $customerPayment->Date_Obtained = $dateRecieved;
            $customerPayment->date_of_check = $dateofCheck;
            if($decision == "N"){
              $customerPayment->From_Id = null;
              $customerPayment->From_FName = $nFname;
              $customerPayment->From_LName = $nlname;
            }else{
              $customerPayment->From_Id = $fromId;
              $customerPayment->From_FName = $fromFname;
              $customerPayment->From_LName = $fromLname;
            }

            $customerPayment->Type = "CHECK";
            $customerPayment->bank_name = $bankname;
            $customerPayment->BALANCE = $NewSalesOrder_details->BALANCE;
            if($request -> hasFile('Checkimg')){
                $image = $request->file('Checkimg');
                $filename = time().'.' . $image->getClientOriginalExtension();
                $location = public_path('paymentPictures/' . $filename);
                Image::make($image)->save($location);
                $customerPayment->image = $filename;
            }
            $customerPayment->save();

            //make a record of customer payment Settlement record
             $createPaymentSettlement = DB::select('CALL create_RecordPaymentSettlement(?,?,?,?,?)',
             array($Order_ID,$customerPayment->Payment_ID,$amount,$amount,0.00));
             if($Newstatus == 'P_PARTIAL'){
               Session::put('PayDebtOrderSession','Successful2');
             }else if($Newstatus == 'A_P_PARTIAL'){
               Session::put('PayDebtOrderSession','Successful3');
             }
          }
          return redirect()->back();
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
        echo 'ang status mo ay partially paid na';

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
