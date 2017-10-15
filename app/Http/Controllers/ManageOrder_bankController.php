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


class ManageOrder_bankController extends Controller
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
      $current = Carbon::now('Asia/Manila');

        //
        $Order_ID = $request->Order_ID2;
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
        $dateDeposited = $request->D_date;
        $amount = $request->D_Amount;


        //$NewSalesOrder = sales_order::find($id);
        $NewSalesOrder_details = Neworder_details::find($Order_ID);
        $Change = 0;

        if($amount >= $NewSalesOrder_details->Total_Amt){
          $Change = $amount - $NewSalesOrder_details->Total_Amt;
          $UpdateOrderDet = DB::select('CALL confirmOrder(?,?,?)',array($Order_ID,'P_FULL',0.00));//updated the status of the order details as well sa the salesorder status

          $newInvoice = DB::select("CALL new_Invoice(?,?,?,?,?,?,?,?)",
          array($Order_ID,$NewSalesOrder_details->Subtotal,$NewSalesOrder_details->Delivery_Charge,$NewSalesOrder_details->VAT,
          $NewSalesOrder_details->Total_Amt,0,$current,'PF'));

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
          $customerPayment->BALANCE = $NewSalesOrder_details->BALANCE;
          if($request -> hasFile('DSlipimg')){
              $image = $request->file('DSlipimg');
              $filename = time().'.' . $image->getClientOriginalExtension();
              $location = public_path('paymentPictures/' . $filename);
              Image::make($image)->save($location);
              $customerPayment->image = $filename;
          }
          $customerPayment->save();

          //make a record of customer payment Settlement record
           $createPaymentSettlement = DB::select('CALL create_RecordPaymentSettlement(?,?,?,?,?)',
           array($Order_ID,$customerPayment->Payment_ID,$amount,$amount,$Change));
           Session::put('ConfirmOrderSession','Successful');
        }//end of if
        else if($amount < $NewSalesOrder_details->Total_Amt){
          $Balance = $NewSalesOrder_details->Total_Amt - $amount;
          $UpdateOrderDet = DB::select('CALL confirmOrder(?,?,?)',array($Order_ID,'P_PARTIAL',$Balance));//updated the status of the order details as well sa the salesorder status
          $newInvoice = DB::select("CALL new_Invoice(?,?,?,?,?,?,?,?)",
          array($Order_ID,$NewSalesOrder_details->Subtotal,$NewSalesOrder_details->Delivery_Charge,$NewSalesOrder_details->VAT,
          $NewSalesOrder_details->Total_Amt,$Balance,$current,'PP'));

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
          $customerPayment->BALANCE = $NewSalesOrder_details->Total_Amt;
          if($request -> hasFile('DSlipimg')){
              $image = $request->file('DSlipimg');
              $filename = time().'.' . $image->getClientOriginalExtension();
              $location = public_path('paymentPictures/' . $filename);
              Image::make($image)->save($location);
              $customerPayment->image = $filename;
          }
          $customerPayment->save();

          //make a record of customer payment Settlement record
           $createPaymentSettlement = DB::select('CALL create_RecordPaymentSettlement(?,?,?,?,?)',
           array($Order_ID,$customerPayment->Payment_ID,$amount,$amount,0));
           Session::put('ConfirmOrderSession','Successful2');
        }
        return redirect()->route('dashboard');
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
        $current = Carbon::now('Asia/Manila');
          //
          $Order_ID = $request->Order_ID2;
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
          //$NewSalesOrder = sales_order::find($id);
          $NewSalesOrder_details = Neworder_details::find($id);

          if($NewSalesOrder_details->Status == 'BALANCED' OR $NewSalesOrder_details->Status == 'A_UNPAID'){
            $change = 0;
            $balance = 0;
              if($NewSalesOrder_details->Status == 'BALANCED'){
                $Status = '';
                $Stat = '';
                if($NewSalesOrder_details->BALANCE > $amount){
                  $Status = 'P_PARTIAL';
                  $Stat = 'PP';
                  $balance = $NewSalesOrder_details->BALANCE - $amount;
                  $change = 0.00;
                }elseif($NewSalesOrder_details->BALANCE <= $amount){
                  $Status = 'P_FULL';
                  $Stat = 'PF';
                  $balance = 0.00;
                  $change = 0.00;
                }
              }else if($NewSalesOrder_details->Status == 'A_UNPAID'){
                $Status = '';
                $Stat = '';
                if($NewSalesOrder_details->BALANCE > $amount){
                  $Status = 'A_P_PARTIAL';
                  $Stat = 'PP';
                  $balance = $NewSalesOrder_details->BALANCE - $amount;
                  $change = 0.00;
                }elseif($NewSalesOrder_details->BALANCE <= $amount){
                  $Status = 'CLOSED';
                  $Stat = 'C';
                  $balance = 0.00;
                  $change = 0.00;
                }
              }
              $UpdateOrderDet = DB::select('CALL confirmOrder(?,?,?)',array($id,$Status,$balance));//updated the status of the order details as well sa the salesorder status

              $newInvoice = DB::select("CALL update_BalAndstat_ofInvoice(?,?,?,?);",
              array($id,$current,$Stat,$change));
              //update the invoice

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
              $customerPayment->BALANCE = $NewSalesOrder_details->BALANCE;
              if($request -> hasFile('DSlipimg')){
                  $image = $request->file('DSlipimg');
                  $filename = time().'.' . $image->getClientOriginalExtension();
                  $location = public_path('paymentPictures/' . $filename);
                  Image::make($image)->save($location);
                  $customerPayment->image = $filename;
              }
              $customerPayment->save();

              //make a record of customer payment Settlement record
               $createPaymentSettlement = DB::select('CALL create_RecordPaymentSettlement(?,?,?,?,?)',
               array($id,$customerPayment->Payment_ID,$amount,$amount,$change));
               Session::put('PaymentCompletion_Session','Successful');

            return redirect()->back();
          }else if($NewSalesOrder_details->Status == 'A_P_PARTIAL' OR $NewSalesOrder_details->Status == 'P_PARTIAL'){
                      $change = 0;
                      $balance = 0;
                        if($NewSalesOrder_details->Status == 'A_P_PARTIAL'){
                          if($NewSalesOrder_details->BALANCE > $amount){
                            $Status = 'CLOSED';
                            $Stat = 'C';
                            $balance = $NewSalesOrder_details->BALANCE - $amount;
                            $change = 0.00;
                          }elseif($NewSalesOrder_details->BALANCE <= $amount){
                            $Status = 'P_PARTIAL';
                            $Stat = 'PP';
                            $balance = 0.00;
                            $change = 0.00;
                          }
                        }else if($NewSalesOrder_details->Status == 'P_PARTIAL'){
                          $Status = '';
                          $Stat = '';
                        }
                        $UpdateOrderDet = DB::select('CALL confirmOrder(?,?,?)',array($id,$Status,$balance));//updated the status of the order details as well sa the salesorder status

                        $newInvoice = DB::select("CALL update_BalAndstat_ofInvoice(?,?,?,?);",
                        array($id,$current,$Stat,$change));
                        //update the invoice

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
                        $customerPayment->BALANCE = $NewSalesOrder_details->BALANCE;
                        if($request -> hasFile('DSlipimg')){
                            $image = $request->file('DSlipimg');
                            $filename = time().'.' . $image->getClientOriginalExtension();
                            $location = public_path('paymentPictures/' . $filename);
                            Image::make($image)->save($location);
                            $customerPayment->image = $filename;
                        }
                        $customerPayment->save();

                        //make a record of customer payment Settlement record
                         $createPaymentSettlement = DB::select('CALL create_RecordPaymentSettlement(?,?,?,?,?)',
                         array($id,$customerPayment->Payment_ID,$amount,$amount,$change));
                         Session::put('PaymentCompletion_Session','Successful');

                      return redirect()->back();
                    }
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
