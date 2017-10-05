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
use App\CustomerPayment;
use App\sales_order;
use \PDF;
use App\Newshop_Schedule;
use App\Neworder_details;
class quickorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cities = DB::table('cities')
          ->select('*')
          ->get();

        $province = DB::table('provinces')
          ->select('*')
          ->get();

        $salesOrders = DB::table('sales_order')
        ->select('*')
        ->get();

        $customers = DB::table('customer_details')
        ->select('*')
        ->get();

        $AvailableFlowers = DB::select('call wonderbloomdb2.Viewing_Flowers_With_UpdatedPrice()');

        $accessories = DB::select('CALL AvailableAcessories_Records()');

        $CustWith_TradeAgreement = DB::select("call View_Customers_withAgreement()");


        return view('Orders.quickorder')
        ->with('CustTradeAgreements',$CustWith_TradeAgreement)
        ->with('orders',$salesOrders)
        ->with('cust',$customers)
        ->with('city',$cities)
        ->with('city2',$cities)
        ->with('province',$province)
        ->with('accessories',$accessories)
        ->with('FlowerList',$AvailableFlowers);
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
        $custID = $request->FinalCustomer_ID;
        $custType = $request->customerType;
        $custStat = $request->customerStat;
        $Fname = $request->OrderedCustFname;
        $Mname = $request->OrderedCustMname;
        $Lname = $request->OrderedCustLname;
        $ContactNum = $request->OrderedCust_ContactNum;
        $email = $request->OrderedCust_email;
        $Amt_Paid = $request->Amt_PaidField;
        $Change = $request->Amt_ChangeField;

        echo  "<h3>custID = ".$custID ."</h3>";
        echo  "<h3>custType = ".$custType ."</h3>";
        echo  "<h3>custStat = ".$custStat ."</h3>";
        echo  "<h3>Fname = ".$Fname ."</h3>";
        echo "<h3><b>Mname = </b>".$Mname ."</h3>";
        echo "<h3><b>Lname = </b>".$Lname ."</h3>";
        echo "<h3><b>ContactNum = </b>".$ContactNum ."</h3>";
        echo "<h3><b>email = </b>".$email ."</h3>";
        echo "<h3><b>Amt_Paid = </b>".$Amt_Paid ."</h3>";
        echo "<h3><b>Change = </b>".$Change ."</h3>";


        $current = Carbon::now('Asia/Manila');
        $newCustID = array();
        $salesorder = new newSales_order;
        if($custID == " "){
          $salesorder->customer_ID = null;
        }else {
         $newCustID = explode("_",$custID);
          $salesorder->customer_ID = $newCustID[1];
        }
        $salesorder->cust_Type = $custType;
        $salesorder->Customer_Fname = $Fname;
        $salesorder->Customer_MName = $Mname;
        $salesorder->Customer_LName = $Lname;

        if($ContactNum == " "){
          $salesorder->Contact_Num = null;
        }else{
          $salesorder->Contact_Num = $ContactNum;
        }
        if($email == " "){
          $salesorder->email_Address = null;
        }else{
          $salesorder->email_Address = $email;
        }
        $salesorder->Status = 'CLOSED';
        $salesorder->Save();//creates a new CLOSED order

        //gets the Amount of purchase:
        $final_Amt = str_replace(',','',Cart::instance('TobeSubmitted_FlowersQuick')->subtotal()) + str_replace(',','',Cart::instance('TobeSubmitted_BqtQuick')->subtotal());
        //gets the amount of vat:
        if($custType == "H" Or $custType == "S"){
          $vatValue = $final_Amt * 0.12;
        }
        else{
          $vatValue = $final_Amt * 0.0;
        }
        //delivery charge:
        $DeliveryCharge = 0;
        //computes the total amount of purchase
        $TotalAmt = $final_Amt + $vatValue + $DeliveryCharge;
        //computes the change that the customer gets
        $Change  = $Amt_Paid - $TotalAmt;//check it later
/*
        echo 'tAmt = '.$TotalAmt.'<br>';
        echo $Amt_Paid.'<br>';
        echo $Change;
*/
        //make a record of invoice under this order
        $newInvoice = DB::select("CALL new_Invoice(?,?,?,?,?,?,?,?)",
        array($salesorder->sales_order_ID,$final_Amt,$DeliveryCharge,$vatValue,$TotalAmt,0,$current,'C'));

        //to be continued...
        //make a record of Customer_payment under that invoice and payment settlement
        $customerPayment = new CustomerPayment;
        $customerPayment->Amount = $Amt_Paid;
        $customerPayment->BALANCE = 0;
        $customerPayment->Date_Obtained = $current;
        if($custID == " "){
          $customerPayment->From_Id = null;
        }else {
          $customerPayment->From_Id = $custID;
        }
        $customerPayment->From_FName = $Fname;
        $customerPayment->From_LName = $Lname;
        $customerPayment->Type = "CASH";
        $customerPayment->save();

        //make a record of customer payment Settlement record
         $createPaymentSettlement = DB::select('CALL create_RecordPaymentSettlement(?,?,?,?)',
         array($salesorder->sales_order_ID,$customerPayment->Payment_ID,$Amt_Paid,$Change));

        //add the bouquet under the order ID
        //add the flowers under the bqt under the Order ID
        //add the accessories under the bqt under the Order_ID

        foreach(Cart::instance('TobeSubmitted_BqtQuick')->content() as $bqt){
            $BqttotalAmt = 0;
            $BqttotalCnt = 0;

            //compute the total amount flowers and accessories under that bouquet
            foreach(Cart::instance('TobeSubmitted_Bqt_FlowersQuick')->content() as $row3){
                if($bqt->id == $row3->options['bqt_ID']){
                  $BqttotalCnt += $row3->qty;//compute the total count of flowers under that bouquet
                  $BqttotalAmt += $row3->options['T_Amt'];//computes the total amount of flowers
                }
            }

            foreach(Cart::instance('QuickFinalBqt_Acessories')->content() as $row3_1){
                if($bqt->id == $row3_1->options['bqt_ID']){
                  $BqttotalAmt += $row3_1->options['T_Amt'];//computes the total amount of flowers
                }
            }

              $createBouquet = new bouquet_details;
              $createBouquet->price = $BqttotalAmt;
              $createBouquet->count_ofFlowers = $BqttotalCnt;
              $createBouquet->Type = 'custom';//
              $createBouquet->Order_ID = $salesorder->sales_order_ID;//submits the primary key of the newly created Salesorder
              $createBouquet->save();

            $PassBqt_toSalesOrder = DB::select('CALL insert_BqtToSales_orderBqt(?,?,?,?)'
            ,array($salesorder->sales_order_ID,$createBouquet->bouquet_ID,$BqttotalAmt,$bqt->qty));

            foreach(Cart::instance('TobeSubmitted_Bqt_FlowersQuick')->content() as $flwr){
              if($bqt->id == $flwr->options['bqt_ID']){
                $BqtFLowers_toOrder = DB::select("CALL add_Flower_to_Bouquet(?, ?, ?)", array($createBouquet->bouquet_ID,$flwr->id,$flwr->price));
                //
                $bqtFlowers_toSalesOrder = DB::select("CALL add_flowers_to_sales_OrderBqtFlowers(?,?,?,?,?)",
                array($salesorder->sales_order_ID,$createBouquet->bouquet_ID,$flwr->id,$flwr->price,$flwr->qty));//inserts the flowers into the salesorderbqt_flowers table
              }
            }//end of adding flowers to bqt
            foreach(Cart::instance('QuickFinalBqt_Acessories')->content() as $Acrs){
              if($bqt->id == $Acrs->options['bqt_ID']){
                $BqtAcrs_toOrder = DB::select("CALL add_Acessories_to_Bouquet(?, ?, ?)", array($createBouquet->bouquet_ID,$Acrs->id,$Acrs->price));
                //
                $bqtAccessories_toSalesOrder = DB::select("CALL add_accessories_to_sales_Order_Accessories(?,?,?,?,?)",
                array($salesorder->sales_order_ID,$createBouquet->bouquet_ID,$Acrs->id,$Acrs->price,$Acrs->qty));//inserts the flowers into the salesorderbqt_accessories table
              }
            }//end of adding flowers to bqt
          }


//add the flowers under the Order ID-----------------------------------------------------------------------------------------------------------------
        foreach(Cart::instance('TobeSubmitted_FlowersQuick')->content() as $Flwr){
//adds the ordered flowers into the sales order every loop
          $FLowers_toOrder = DB::select('CALL insert_Flowers_ofSales_Order(?,?,?,?,?)',
          array($salesorder->sales_order_ID,$Flwr->id,$Flwr->qty,
          $Flwr->price,$Flwr->options['T_Amt']));

//less the ordered flowers from the inventory
          $QTYToFulfill = $Flwr->qty;
          $flowersInv = DB::select("CALL availableBatchOfFLowers(?)",array($Flwr->id));
          foreach($flowersInv as $flwrDet){
            if($flwrDet->QTY_Remaining == $QTYToFulfill){
              $SellFlowers = DB::select('CALL Sell_Flowers_PerBatch(?, ?, ?)',array($flwrDet->Sched_ID,$Flwr->id,$QTYToFulfill));
              $message = '';
              $message = 'Flowers sold Under the sales order ID: ORDR_'.$salesorder->sales_order_ID.' through Quick Ordering';

              $newInvTrans = DB::select('CALL Insert_OrderInventoryTrans(?,?,?,?,?,?,?,?,?,?)'
              ,array($Flwr->id,'-'.$QTYToFulfill,$flwrDet->Cost,$Flwr->price,$current,'O','Flower',$flwrDet->Sched_ID,$salesorder->sales_order_ID,$message));
              break;
              //to be continued here
            }//end of if statement where the remaining flowers of this batch is equal to the flowers ordered

            else if($flwrDet->QTY_Remaining < $QTYToFulfill){

              $SellFlowers = DB::select('CALL Sell_Flowers_PerBatch(?, ?, ?)',array($flwrDet->Sched_ID,$Flwr->id,$flwrDet->QTY_Remaining));
              $message = '';
              $message = 'Flowers sold Under the sales order ID: ORDR_'.$salesorder->sales_order_ID.' through Quick Ordering';

              $newInvTrans = DB::select('CALL Insert_OrderInventoryTrans(?,?,?,?,?,?,?,?,?,?)'
              ,array($Flwr->id,'-'.$flwrDet->QTY_Remaining,$flwrDet->Cost,$Flwr->price,$current,'O','Flower',$flwrDet->Sched_ID,$salesorder->sales_order_ID,$message));
              $QTYToFulfill = $QTYToFulfill - $flwrDet->QTY_Remaining;
            }//end of the if which determines if the qty ordered is greater that the qty in the inventory this tells the system that the flower is not yet fulfilled

            else if($flwrDet->QTY_Remaining > $QTYToFulfill){
              $newQty_Remaining  = $flwrDet->QTY_Remaining - $QTYToFulfill;


              $SellFlowers = DB::select('CALL Sell_Flowers_PerBatch(?, ?, ?)',array($flwrDet->Sched_ID,$Flwr->id,$QTYToFulfill));
              $message = '';
              $message = 'Flowers sold Under the sales order ID: ORDR_'.$salesorder->sales_order_ID.' through Quick Ordering';

              $newInvTrans = DB::select('CALL Insert_OrderInventoryTrans(?,?,?,?,?,?,?,?,?,?)'
              ,array($Flwr->id,'-'.$QTYToFulfill,$flwrDet->Cost,$Flwr->price,$current,'O','Flower',$flwrDet->Sched_ID,$salesorder->sales_order_ID,$message));
              $QTYToFulfill = $QTYToFulfill - $QTYToFulfill;
              break;
            }//end of else if that breaks from the inner loop when the flower ordered was lesser than the flwerin the specific batch...
          }//end of inner foreach looking for the batches of flowers
        }//end of foreach looking for the flowers under the order
//end of adding the flowers under the order into the database and recording it into the inventory transactions-----------------------------------------------------------------------------

//less the bqt flowers flowers from the inventroy-------------------------------------------------------------------------------------------------------------------------------------------

        foreach(Cart::instance('TobeSubmitted_Bqt_FlowersQuick')->content() as $Flwr){
          $BqtQty = 0;
          foreach(Cart::instance('TobeSubmitted_BqtQuick')->content() as $bqtcontent){
            if($bqtcontent->id == $Flwr->options->bqt_ID){
              $BqtQty = $bqtcontent->qty;
            }
          }
//less the ordered flowers from the inventory
      for($ctr = 0; $ctr <= $BqtQty-1;$ctr++  ){
        $QTYToFulfill = $Flwr->qty;
        $flowersInv = DB::select("CALL availableBatchOfFLowers(?)",array($Flwr->id));
        foreach($flowersInv as $flwrDet){
          if($flwrDet->QTY_Remaining == $QTYToFulfill){
            $SellFlowers = DB::select('CALL Sell_Flowers_PerBatch(?, ?, ?)',array($flwrDet->Sched_ID,$Flwr->id,$QTYToFulfill));
            $message = '';
            $message = 'Flowers sold Under the bouquet on sales order ID: ORDR_'.$salesorder->sales_order_ID.' through Quick Ordering';

            $newInvTrans = DB::select('CALL Insert_OrderInventoryTrans(?,?,?,?,?,?,?,?,?,?)'
            ,array($Flwr->id,'-'.$QTYToFulfill,$flwrDet->Cost,$Flwr->price,$current,'O','Flower',$flwrDet->Sched_ID,$salesorder->sales_order_ID,$message));
            break;
            //to be continued here
          }//end of if statement where the remaining flowers of this batch is equal to the flowers ordered

          else if($flwrDet->QTY_Remaining < $QTYToFulfill){

            $SellFlowers = DB::select('CALL Sell_Flowers_PerBatch(?, ?, ?)',array($flwrDet->Sched_ID,$Flwr->id,$flwrDet->QTY_Remaining));
            $message = '';
            $message = 'Flowers sold Under the sales order ID: ORDR_'.$salesorder->sales_order_ID.' through Quick Ordering';

            $newInvTrans = DB::select('CALL Insert_OrderInventoryTrans(?,?,?,?,?,?,?,?,?,?)'
            ,array($Flwr->id,'-'.$flwrDet->QTY_Remaining,$flwrDet->Cost,$Flwr->price,$current,'O','Flower',$flwrDet->Sched_ID,$salesorder->sales_order_ID,$message));
            $QTYToFulfill = $QTYToFulfill - $flwrDet->QTY_Remaining;
          }//end of the if which determines if the qty ordered is greater that the qty in the inventory this tells the system that the flower is not yet fulfilled

          else if($flwrDet->QTY_Remaining > $QTYToFulfill){
            $newQty_Remaining  = $flwrDet->QTY_Remaining - $QTYToFulfill;


            $SellFlowers = DB::select('CALL Sell_Flowers_PerBatch(?, ?, ?)',array($flwrDet->Sched_ID,$Flwr->id,$QTYToFulfill));
            $message = '';
            $message = 'Flowers sold Under the sales order ID: ORDR_'.$salesorder->sales_order_ID.' through Quick Ordering';

            $newInvTrans = DB::select('CALL Insert_OrderInventoryTrans(?,?,?,?,?,?,?,?,?,?)'
            ,array($Flwr->id,'-'.$QTYToFulfill,$flwrDet->Cost,$Flwr->price,$current,'O','Flower',$flwrDet->Sched_ID,$salesorder->sales_order_ID,$message));
            $QTYToFulfill = $QTYToFulfill - $QTYToFulfill;
            break;
          }//end of else if that breaks from the inner loop when the flower ordered was lesser than the flwerin the specific batch...
        }//end of inner foreach looking for the batches of flowers
      }//end of for
    }//end of foreach looking for the flowers under a each bouquets in the order

        $Acrs = DB::select('call AvailableAcessories_Records()');
        //dd($Acrs);
    foreach(Cart::instance('QuickFinalBqt_Acessories')->content() as $AcrsDet){
          $BqtQty = 0;
          foreach(Cart::instance('TobeSubmitted_BqtQuick')->content() as $bqtcontent){
            if($bqtcontent->id == $AcrsDet->options->bqt_ID){
              $BqtQty = $bqtcontent->qty;
            }
          }
//less the ordered flowers from the inventory
      for($ctr = 0; $ctr <= $BqtQty-1;$ctr++  ){
        foreach($Acrs as $Acrs2){
          if($Acrs2->ACC_ID == $AcrsDet->id){
            $SellAcrs = DB::select('CALL Sell_AcrsFrom_Inventory(?, ?)',array($Acrs2->ACC_ID,$AcrsDet->qty));
            $message = '';
            $message = 'Accessories sold Under a bouquet in the sales order ID: ORDR_'.$salesorder->sales_order_ID.' through Quick Ordering';

            $newInvTrans2 = DB::select('CALL Insert_OrderInventoryTrans(?,?,?,?,?,?,?,?,?,?)'
            ,array($AcrsDet->id,'-'.$AcrsDet->qty,$Acrs2->price,$AcrsDet->price,$current,'O','Acessories',null,$salesorder->sales_order_ID,$message));
          }
        }//looping al of the acrs that are going to be used
      }
    }//end of foreach looking for the flowers under a each bouquets in the order


        Cart::instance('Flower_Inventory')->destroy();
        $FLowers_Qty = DB::select('CALL Show_TotalQTY_Perflowersin_Inventory()');
        //dd($FLowers_Qty);
        foreach($FLowers_Qty as $FLowersINV){
            Cart::instance('Flower_Inventory')->add(['id'=>$FLowersINV->Id,'qty'=>$FLowersINV->QtyRemaining,'name'=>$FLowersINV->Name,'price'=>0.00,'options'=>['image'=>$FLowersINV->Img]]);
        }

//Prints Reciept--------------------------------------------------------------------------------------------------------------------

  //return $pdf->download('sampleDelivery.pdf');
  //return $pdf->stream();

  Cart::instance('TobeSubmitted_FlowersQuick')->destroy();
  Cart::instance('TobeSubmitted_BqtQuick')->destroy();
  Cart::instance('TobeSubmitted_Bqt_FlowersQuick')->destroy();

  Cart::instance('QuickOrdered_Flowers')->destroy();

  Cart::instance('QuickOrdered_Bqt')->destroy();
  Cart::instance('QuickFinalBqt_Flowers')->destroy();
  Cart::instance('QuickFinalBqt_Acessories')->destroy();

  Session::put('QuickOrderDone','Successful');
  return redirect()->route("Quick_Sales_Order.show", $salesorder->sales_order_ID);
  //return redirect()->route('Quick_Sales_Order.index');

    }//

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
      $SalesOrder_flowers = DB::select('CALL show_sales_Orders_Flowers(?)',array($id));

      $NewOrder_Bouquet = DB::table('sales_order_bouquet')
                                  ->where('Order_ID', $id)
                                  ->get();

      $SalesOrder_Bqtflowers = DB::select('CALL show_SalesOrder_Bqt_Flowers(?)',array($id));

      $SalesOrder_BqtAccessories = DB::select('CALL show_SalesOrder_Bqt_Accessories(?)',array($id));

      $PaymentAndInvoiceDetails = DB::select('CALL show_InvoiceandPayment_Details(?)',array($id));
      $InvoiceDetails = array();
      foreach($PaymentAndInvoiceDetails as $row){
        $InvoiceDetails = collect([$row->Invoice_ID,$row->Payment_ID,
        $row->AmountPaid,$row->ChangeVal,
        $row->DateofPayment,$row->Cust_ID,
        $row->FName,$row->Lname,
        $row->TypeOfPayment,$row->payment_balance,
        $row->AmountofPurchase,$row->Del_Charge,$row->Vat,
        $row->invoice_Balance,$row->InvoiceStat,$row->Tamt]);
      }

     //dd($NewOrder_SchedDetails);
      return view('Orders/quickOrder_FinalView')
      ->with('invoice',$InvoiceDetails)
      ->with('NewSalesOrder',$NewSalesOrder)
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
