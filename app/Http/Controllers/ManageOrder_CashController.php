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

class ManageOrder_CashController extends Controller
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
        $Order_ID = $request->Order_ID;
        $decision = $request->Decision_text;
        $cust_ID = $request->Currentcust_ID;
        $currentFname = $request->Current_FName;
        $currentLname = $request->Current_LName;
        $nFname = $request->nf_namefield;
        $nLname = $request->nl_namefield;

        $amt_Paid = $request->payment_field;
        $amt_Paid2 = $request->payment;
        $amt_Used = $request->PartialField;
        $change = $request->changeField;

        $value = collect([
          $Order_ID ,
          $decision ,
          $cust_ID ,
          $currentFname ,
          $currentLname ,
          $nLname ,
          $nLname ,
          $amt_Paid ,
          $amt_Paid2 ,
          $amt_Used ,
          $change
        ]);
        //  dd($value);

        $NewSalesOrder_details = Neworder_details::find($Order_ID);
        if($amt_Paid2 >= $NewSalesOrder_details->Total_Amt){
          if($amt_Used > 0){
            $Derived_Change = $amt_Paid2 - $amt_Used;
            $Balance = $NewSalesOrder_details->Total_Amt - $amt_Used;//gets the balance even they paid greater but uses partial of the payment only
            $UpdateOrderDet = DB::select('CALL confirmOrder(?,?,?)',array($Order_ID,'P_PARTIAL',$Balance));//updated the status of the order details as well sa the salesorder status

            $newInvoice = DB::select("CALL new_Invoice(?,?,?,?,?,?,?,?)",
            array($Order_ID,$NewSalesOrder_details->Subtotal,$NewSalesOrder_details->Delivery_Charge,$NewSalesOrder_details->VAT,
            $NewSalesOrder_details->Total_Amt,$Balance,$current,'PP'));

            $customerPayment = new CustomerPayment;
            $customerPayment->Amount = $amt_Paid2;
            $customerPayment->Amount_Used = $amt_Used;
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
            $customerPayment->BALANCE = $NewSalesOrder_details->Total_Amt;
            $customerPayment->save();

            //make a record of customer payment settlement record
            $createPaymentSettlement = DB::select('CALL create_RecordPaymentSettlement(?,?,?,?,?)',
            array($Order_ID,$customerPayment->Payment_ID,$amt_Paid2,$amt_Used,$Derived_Change));
            Session::put('ConfirmOrderSessionCash','Successful2');
        }//if they used partial payment only
        else if($amt_Used == 0 OR $amt_Used < 1){
          $Derived_Change =  $amt_Paid2 - $NewSalesOrder_details->Total_Amt;
          $Balance = 0;//gets the balance even they paid greater but uses partial of the payment only
          $UpdateOrderDet = DB::select('CALL confirmOrder(?,?,?)',array($Order_ID,'P_FULL',$Balance));//updated the status of the order details as well sa the salesorder status

          $newInvoice = DB::select("CALL new_Invoice(?,?,?,?,?,?,?,?)",
          array($Order_ID,$NewSalesOrder_details->Subtotal,$NewSalesOrder_details->Delivery_Charge,$NewSalesOrder_details->VAT,
          $NewSalesOrder_details->Total_Amt,$Balance,$current,'PF'));

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
          $customerPayment->BALANCE = $NewSalesOrder_details->Total_Amt;
          $customerPayment->save();

          //make a record of customer payment settlement record
          $createPaymentSettlement = DB::select('CALL create_RecordPaymentSettlement(?,?,?,?,?)',
          array($Order_ID,$customerPayment->Payment_ID,$amt_Paid2,$amt_Paid2,$Derived_Change));
          Session::put('ConfirmOrderSessionCash','Successful');
        }
      }//end of if
      else if($amt_Paid2 < $NewSalesOrder_details->Total_Amt){
          if($amt_Used > 0){
            $Derived_Change = $amt_Paid2 - $amt_Used;
            $Balance = $NewSalesOrder_details->Total_Amt - $amt_Used;//gets the balance even they paid greater but uses partial of the payment only
            $UpdateOrderDet = DB::select('CALL confirmOrder(?,?,?)',array($Order_ID,'P_PARTIAL',$Balance));//updated the status of the order details as well sa the salesorder status

            $newInvoice = DB::select("CALL new_Invoice(?,?,?,?,?,?,?,?)",
            array($Order_ID,$NewSalesOrder_details->Subtotal,$NewSalesOrder_details->Delivery_Charge,$NewSalesOrder_details->VAT,
            $NewSalesOrder_details->Total_Amt,$Balance,$current,'PP'));

            $customerPayment = new CustomerPayment;
            $customerPayment->Amount = $amt_Paid2;
            $customerPayment->Amount_Used = $amt_Used;
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
            $customerPayment->BALANCE = $NewSalesOrder_details->Total_Amt;
            $customerPayment->save();

            //make a record of customer payment settlement record
            $createPaymentSettlement = DB::select('CALL create_RecordPaymentSettlement(?,?,?,?,?)',
            array($Order_ID,$customerPayment->Payment_ID,$amt_Paid2,$amt_Used,$Derived_Change));
            Session::put('ConfirmOrderSessionCash','Successful2');
        }//if they used partial payment only
        else if($amt_Used == 0 OR $amt_Used < 1){
          $Derived_Change =  0;
          $Balance = $NewSalesOrder_details->Total_Amt - $amt_Paid2;//gets the balance even they paid greater but uses partial of the payment only
          $UpdateOrderDet = DB::select('CALL confirmOrder(?,?,?)',array($Order_ID,'P_PARTIAL',$Balance));//updated the status of the order details as well sa the salesorder status

          $newInvoice = DB::select("CALL new_Invoice(?,?,?,?,?,?,?,?)",
          array($Order_ID,$NewSalesOrder_details->Subtotal,$NewSalesOrder_details->Delivery_Charge,$NewSalesOrder_details->VAT,
          $NewSalesOrder_details->Total_Amt,$Balance,$current,'PP'));

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
          $customerPayment->BALANCE = $NewSalesOrder_details->Total_Amt;
          $customerPayment->save();

          //make a record of customer payment settlement record
          $createPaymentSettlement = DB::select('CALL create_RecordPaymentSettlement(?,?,?,?,?)',
          array($Order_ID,$customerPayment->Payment_ID,$amt_Paid2,$amt_Paid2,$Derived_Change));
          Session::put('ConfirmOrderSessionCash','Successful2');
        }
      }
      return redirect()->route('dashboard');
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
          $Order_ID = $request->Order_ID;
          $decision = $request->Decision_text;
          $cust_ID = $request->Currentcust_ID;
          $currentFname = $request->Current_FName;
          $currentLname = $request->Current_LName;
          $nFname = $request->nf_namefield;
          $nLname = $request->nl_namefield;

          $amt_Paid = $request->payment_field;
          $amt_Paid2 = $request->payment;
          $amt_Used = $request->PartialField;
          $change = $request->changeField;

          $value = collect([
            $Order_ID ,
            $decision ,
            $cust_ID ,
            $currentFname ,
            $currentLname ,
            $nLname ,
            $nLname ,
            $amt_Paid ,
            $amt_Paid2 ,
            $amt_Used ,
            $change
          ]);
          //  dd($value);

          $NewSalesOrder_details = Neworder_details::find($Order_ID);
          if($amt_Paid2 >= $NewSalesOrder_details->BALANCE){
              if($amt_Used > 0){
                $Derived_Change = $amt_Paid2 - $amt_Used;
                $Balance = 0.00;//gets the balance even they paid greater but uses partial of the payment only
                $UpdateOrderDet = DB::select('CALL confirmOrder(?,?,?)',array($Order_ID,'P_FULL',$Balance));//updated the status of the order details as well sa the salesorder status

                $newInvoice = DB::select("CALL update_BalAndstat_ofInvoice(?,?,?,?);",
                array($id,$current,'PF',0.00));
                //update the invoice

                $customerPayment = new CustomerPayment;
                $customerPayment->Amount = $amt_Paid2;
                $customerPayment->Amount_Used = $amt_Used;
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
                $customerPayment->BALANCE = $NewSalesOrder_details->BALANCE;
                $customerPayment->save();

                //make a record of customer payment settlement record
                $createPaymentSettlement = DB::select('CALL create_RecordPaymentSettlement(?,?,?,?,?)',
                array($id,$customerPayment->Payment_ID,$amt_Paid2,$amt_Used,$Derived_Change));
                Session::put('CashPayment_CompletionSession','Successful');
            }//if they used partial payment only
            else if($amt_Used == 0 OR $amt_Used < 1){
              $Derived_Change =   $NewSalesOrder_details->BALANCE - $amt_Paid2;
              $Balance = 0;//gets the balance even they paid greater but uses partial of the payment only
              $UpdateOrderDet = DB::select('CALL confirmOrder(?,?,?)',array($Order_ID,'P_FULL',$Balance));//updated the status of the order details as well sa the salesorder status

              $newInvoice = DB::select("CALL update_BalAndstat_ofInvoice(?,?,?,?);",
              array($id,$current,'PF',0.00));
              //update the invoice

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
              $customerPayment->BALANCE = $NewSalesOrder_details->BALANCE;
              $customerPayment->save();

              //make a record of customer payment settlement record
              $createPaymentSettlement = DB::select('CALL create_RecordPaymentSettlement(?,?,?,?,?)',
              array($id,$customerPayment->Payment_ID,$amt_Paid2,$amt_Paid2,$Derived_Change));
              Session::put('CashPayment_CompletionSession','Successful');
            }
        }//end of if
        else if($amt_Paid2 < $NewSalesOrder_details->BALANCE){
          if($NewSalesOrder_details->Status == 'BALANCED' OR $NewSalesOrder_details->Status == 'A_UNPIAD'){
            $Status = "";
            $Stat = "";
            if($NewSalesOrder_details->Status == 'BALANCED'){
              $Status = "P_PARTIAL";
              $Stat = "PP";
            }else if($NewSalesOrder_details->Status == 'A_UNPAID'){
              $Status = "A_P_PARTIAL";
              $Stat = "APP";
            }

            if($amt_Paid2 >= $NewSalesOrder_details->BALANCE*0.20){
              if($amt_Used > 0){
                $Derived_Change = $amt_Paid2 - $amt_Used;
                $Balance = $NewSalesOrder_details->BALANCE - $amt_Used;//gets the balance even they paid greater but uses partial of the payment only
                $UpdateOrderDet = DB::select('CALL confirmOrder(?,?,?)',array($Order_ID,$Status,$Balance));//updated the status of the order details as well sa the salesorder status

                $newInvoice = DB::select("CALL update_BalAndstat_ofInvoice(?,?,?,?);",
                array($id,$current,$Stat,$Derived_Change));
                //update the invoice

                $customerPayment = new CustomerPayment;
                $customerPayment->Amount = $amt_Paid2;
                $customerPayment->Amount_Used = $amt_Used;
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
                $customerPayment->BALANCE = $NewSalesOrder_details->BALANCE;
                $customerPayment->save();

                //make a record of customer payment settlement record
                $createPaymentSettlement = DB::select('CALL create_RecordPaymentSettlement(?,?,?,?,?)',
                array($id,$customerPayment->Payment_ID,$amt_Paid2,$amt_Used,$Derived_Change));
                Session::put('CashPayment_CompletionSession','Successful');
            }//if they used partial payment only
            else if($amt_Used == 0 OR $amt_Used < 1){
              $Derived_Change =  $NewSalesOrder_details->BALANCE - $amt_Paid2;
              $Balance = 0;//gets the balance even they paid greater but uses partial of the payment only
              $UpdateOrderDet = DB::select('CALL confirmOrder(?,?,?)',array($Order_ID,$Status, $Balance - $amt_Paid2));//updated the status of the order details as well sa the salesorder status

              $newInvoice = DB::select("CALL update_BalAndstat_ofInvoice(?,?,?,?);",array($id,$current,$Stat,$Balance - $amt_Paid2));
              //update the invoice

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
              $customerPayment->BALANCE = $NewSalesOrder_details->BALANCE;
              $customerPayment->save();

              //make a record of customer payment settlement record
              $createPaymentSettlement = DB::select('CALL create_RecordPaymentSettlement(?,?,?,?,?)',
              array($id,$customerPayment->Payment_ID,$amt_Paid2,$amt_Paid2,$Derived_Change));
              Session::put('CashPayment_CompletionSession','Successful');
            }
          }else{
            Session::put('CashPayment_CompletionSession','Fail');
            return redirect()->back();
          }
        }else{
          //kapag hinid BALANCED or A_UNPAID
        }
      }
      return redirect()->back();
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
