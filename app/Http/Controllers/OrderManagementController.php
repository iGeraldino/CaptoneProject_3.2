<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use \Cart;
use App\bouquet_details;
use Carbon\Carbon;
use Session;
use App\sales_order;
use \PDF;
use App\Newshop_Schedule;
use App\Neworder_details;
use Auth;
use App\CustomerDetails;
use App\Customer_Payment;
use App\order_details;
use App\shop_schedule;
use DateTime;


class OrderManagementController extends Controller
{

  public function generate_statement_Of_account($id){

  }


  public function DeleteLong_Bouquet($Bouquet_ID){


        $qtytofulfill = 0;

            foreach(Cart::instance('Ordered_Bqt')->content() as $Bqt){
              if($Bqt->id == $Bouquet_ID){
                Cart::instance('Ordered_Bqt')
                ->remove($Bqt->rowId);
              }
            }

            foreach(Cart::instance('FinalBqt_Flowers')->content() as $Flwr){
              if($Flwr->options->bqt_ID == $Bouquet_ID){
                Cart::instance('FinalBqt_Flowers')
                ->remove($Flwr->rowId);
              }
            }//

            foreach(Cart::instance('FinalBqt_Acessories')->content() as $Acrs){
              if($Acrs->options->bqt_ID == $Bouquet_ID){
                Cart::instance('FinalBqt_Acessories')
                ->remove($Acrs->rowId);
              }
            }//

            Session::put('Deleted_BouquetFrom_Order', 'Successful');
            return redirect()->back();

  }

  public function release_Order($id){

    //echo $id;
    $current = Carbon::now('Asia/Manila');

    $NewSalesOrder = sales_order::find($id);

    $NewSalesOrder_details = Neworder_details::find($id);

    $NewOrder_SchedDetails = DB::table('shop_schedule')
                               ->where('Order_ID', $id)
                               ->first();

    $SalesOrder_flowers = DB::select('CALL show_sales_Orders_Flowers(?)',array($id));
    $NewOrder_Bouquet = DB::table('sales_order_bouquet')
                                ->where('Order_ID', $id)
                                ->get();


    $SalesOrder_Bqtflowers = DB::select('CALL show_SalesOrder_Bqt_Flowers(?)',array($id));



    $SalesOrder_BqtAccessories = DB::select('CALL show_SalesOrder_Bqt_Accessories(?)',array($id));

    //dd($SalesOrder_BqtAccessories);
    $Flower_inInventory = DB::select('call wonderbloomdb2.Viewing_Flowers_With_UpdatedPrice()');
    $Acrs_inINventory = DB::select('call wonderbloomdb2.Acessories_Records()');

      $dateToacquire = date('m-d-Y H:i:s',strtotime($NewOrder_SchedDetails->Time));
      $dateNow = date('m-d-Y H:i:s',strtotime($current));

      //dd($dateToacquire.'------------------------'.$dateNow);
      if($dateToacquire > $dateNow){
        Session::put('ReleaseOrder_Session','Invalid');
        return redirect()->back();
      }

    //dd($Flower_inInventory);

    Cart::instance('flowersOnOrder')->destroy();
    Cart::instance('acessoriesOnOrder')->destroy();
    $total_Flowers = 0;
    $total_acrs = 0;

    foreach($SalesOrder_flowers as $flwr){
      Cart::instance('flowersOnOrder')->add(['id'=>$flwr->flwr_ID,
      'name'=>$flwr->name,'qty'=>$flwr->qty,'price'=>$flwr->Price,'options'=>[]]);
    }

    foreach($NewOrder_Bouquet as $bqt){
      foreach($SalesOrder_Bqtflowers as $Bflwr){
        //
        if($bqt->Bqt_ID == $Bflwr->BQT_ID){
          if(Cart::instance('flowersOnOrder')->count() < 1){
            Cart::instance('flowersOnOrder')->add(['id'=>$Bflwr->FLwr_ID,
            'name'=>$Bflwr->name,'qty'=>$Bflwr->qty*$bqt->QTY,'price'=>$Bflwr->price,'options'=>[]]);
          }else{
            foreach(Cart::instance('flowersOnOrder')->content() as $forders){
              $Nqty = 0;
              if($forders->id == $Bflwr->FLwr_ID){
                $Nqty = $forders->qty + ($Bflwr->qty*$bqt->QTY);
                Cart::instance('flowersOnOrder')->update($forders ->rowId,['qty'=>$Nqty]);
                break;
              }
              else{
                Cart::instance('flowersOnOrder')->add(['id'=>$Bflwr->FLwr_ID,
                'name'=>$Bflwr->name,'qty'=>$Bflwr->qty*$bqt->QTY,'price'=>$Bflwr->price,
                'options'=>[]]);
                break;
              }
            }
          }
        }
      }//end of foreach($SalesOrder_Bqtflowers as $Bflwr)

      foreach($SalesOrder_BqtAccessories as $acrs){
        if($bqt->Bqt_ID == $acrs->bqt_ID){
          if(Cart::instance('acessoriesOnOrder')->count < 1){
            Cart::instance('acessoriesOnOrder')->add(['id'=>$acrs->Acrs_ID,'name'=>$acrs->name,
            'qty'=>$acrs->qty*$bqt->QTY
            ,'price'=>$acrs->Price,'options'=>[]]);
          }else{
            foreach(Cart::instance('acessoriesOnOrder')->content() as $a_orders){
              $Nqty = 0;
              if($a_orders->id == $acrs->FLwr_ID){
                $Nqty = $a_orders->qty + ($acrs->qty*$bqt->QTY);
                Cart::instance('acessoriesOnOrder')->update($a_orders ->rowId,['qty'=>$Nqty]);
                break;
              }
              else{
                Cart::instance('acessoriesOnOrder')->add(['id'=>$acrs->Acrs_ID,'name'=>$acrs->name,
                'qty'=>$acrs->qty*$bqt->QTY
                ,'price'=>$acrs->Price,'options'=>[]]);
                break;
              }
            }
          }
        }
      }
    }//end of foreach($NewOrder_Bouquet as $bqt)

    //dd(Cart::instance('flowersOnOrder')->content());
    $acrsValidator = 0;
    $flwrValidator = 0;
    foreach(Cart::instance('acessoriesOnOrder')->content() as $Oacrs){
      foreach($Acrs_inINventory as $AcrsInventory){
        if($Oacrs->id == $AcrsInventory->ACC_ID){
          if($Oacrs->qty > $AcrsInventory->qty){
            $acrsValidator = 1;
            break;
          }
        }
      }
    }

    foreach(Cart::instance('flowersOnOrder')->content() as $Oflwr){
      foreach($Flower_inInventory as $flwr_row){
        if($flwr_row->flower_ID == $Oflwr->id){
          if($Oflwr->qty > $flwr_row->QTY){
            $flwrValidator = 1;
            break;
          }
        }
      }
    }


    if($flwrValidator == 1 AND $acrsValidator == 1){
      Session::put('ReleaseOrder_Session','Fail');
      return redirect()->back();
    }else if($flwrValidator == 0 AND $acrsValidator == 1){
      Session::put('ReleaseOrder_Session','Fail2');
      return redirect()->back();
    }else if($flwrValidator == 1 AND $acrsValidator == 0){
      Session::put('ReleaseOrder_Session','Fail3');
      return redirect()->back();
    }else{ //this will release the flowers and the accessories under the specific order
      $status = "";
      $stat = "";
      if($NewSalesOrder_details->Status == 'P_PARTIAL'){
        $status = "A_P_Partial";
        $stat = "APP";
      }else if($NewSalesOrder_details->Status == 'BALANCED'){
        $status = "A_UNPAID";
        $stat = "AU";
      }else if($NewSalesOrder_details->Status == 'P_FULL'){
        $status = "CLOSED";
        $stat = "C";
      }

      $UpdateOrderDet = DB::select('CALL confirmOrder(?,?,?)',array($id,$status,$NewSalesOrder_details->BALANCE));//updated the status of the order details as well sa the salesorder status
      $newInvoice = DB::select("CALL update_BalAndstat_ofInvoice(?,?,?,?);",
      array($id,$current,$stat,$NewSalesOrder_details->BALANCE));
      $UpdateShopSched=  DB::select('CALL  SetStatus_of_shopSchedule(?,?)',array('DONE',$id));

      foreach($SalesOrder_flowers as $flwr){
        $QTYToFulfill = $flwr->qty;
        $flowersInv = DB::select("CALL availableBatchOfFLowers(?)",array($flwr->flwr_ID));
        foreach($flowersInv as $flwrDet){
          if($flwrDet->QTY_Remaining == $QTYToFulfill){
            $SellFlowers = DB::select('CALL Sell_Flowers_PerBatch(?, ?, ?)',array($flwrDet->Sched_ID,$flwr->flwr_ID,$QTYToFulfill));
            $message = '';
            $message = 'Flowers sold Under the sales order ID: ORDR_'.$id.' through Long Ordering';

            $newInvTrans = DB::select('CALL Insert_OrderInventoryTrans(?,?,?,?,?,?,?,?,?,?)'
            ,array($flwr->flwr_ID,$QTYToFulfill,$flwrDet->Cost,$flwr->Price,$current,'O','Flower',$flwrDet->Sched_ID,$id,$message));
            break;
            //to be continued here
          }

          else if($flwrDet->QTY_Remaining < $QTYToFulfill){
            $SellFlowers = DB::select('CALL Sell_Flowers_PerBatch(?, ?, ?)',array($flwrDet->Sched_ID,$flwr->flwr_ID,$flwrDet->QTY_Remaining));
            $message = '';
            $message = 'Flowers sold Under the sales order ID: ORDR_'.$id.' through Long Ordering';

            $newInvTrans = DB::select('CALL Insert_OrderInventoryTrans(?,?,?,?,?,?,?,?,?,?)'
            ,array($flwr->flwr_ID,$flwrDet->QTY_Remaining,$flwrDet->Cost,$flwr->Price,$current,'O','Flower',$flwrDet->Sched_ID,$id,$message));
            $QTYToFulfill = $QTYToFulfill - $flwrDet->QTY_Remaining;
          }//end of the if which determines if the qty ordered is greater that the qty in the inventory this tells the system that the flower is not yet fulfilled

          else if($flwrDet->QTY_Remaining > $QTYToFulfill){
            $newQty_Remaining  = $flwrDet->QTY_Remaining - $QTYToFulfill;

            $SellFlowers = DB::select('CALL Sell_Flowers_PerBatch(?, ?, ?)',array($flwrDet->Sched_ID,$flwr->flwr_ID,$QTYToFulfill));
            $message = '';
            $message = 'Flowers sold Under the sales order ID: ORDR_'.$id.' through Long Ordering';


            $newInvTrans = DB::select('CALL Insert_OrderInventoryTrans(?,?,?,?,?,?,?,?,?,?)'
            ,array($flwr->flwr_ID,$QTYToFulfill,$flwrDet->Cost,$flwr->Price,$current,'O','Flower',$flwrDet->Sched_ID,$id,$message));
            $QTYToFulfill = $QTYToFulfill - $QTYToFulfill;
            break;
          }//end of else if that breaks from the inner loop when the flower ordered was lesser than the flwerin the specific batch...
        }//
      }//

      foreach($SalesOrder_Bqtflowers as $Flwr){
              $BqtQty = 0;
              foreach($NewOrder_Bouquet as $bqtcontent){
                if($bqtcontent->Bqt_ID == $Flwr->BQT_ID){
                  $BqtQty = $bqtcontent->QTY;
                }
              }
    //less the ordered flowers from the inventory
          for($ctr = 0; $ctr <= $BqtQty-1;$ctr++  ){
            $QTYToFulfill = $Flwr->qty;
            $flowersInv = DB::select("CALL availableBatchOfFLowers(?)",array($Flwr->FLwr_ID));
            foreach($flowersInv as $flwrDet){
              if($flwrDet->QTY_Remaining == $QTYToFulfill){
                $SellFlowers = DB::select('CALL Sell_Flowers_PerBatch(?, ?, ?)',array($flwrDet->Sched_ID,$Flwr->FLwr_ID,$QTYToFulfill));
                $message = '';
                $message = 'Flowers sold Under the bouquet on sales order ID: ORDR_'.$id.' through Long Ordering';

                $newInvTrans = DB::select('CALL Insert_OrderInventoryTrans(?,?,?,?,?,?,?,?,?,?)'
                ,array($Flwr->FLwr_ID,$QTYToFulfill,$flwrDet->Cost,$Flwr->price,$current,'O','Flower',$flwrDet->Sched_ID,$id,$message));
                break;
                //to be continued here
              }//end of if statement where the remaining flowers of this batch is equal to the flowers ordered

              else if($flwrDet->QTY_Remaining < $QTYToFulfill){

                $SellFlowers = DB::select('CALL Sell_Flowers_PerBatch(?, ?, ?)',array($flwrDet->Sched_ID,$Flwr->FLwr_ID,$flwrDet->QTY_Remaining));
                $message = '';
                $message = 'Flowers sold Under the sales order ID: ORDR_'.$id.' through Quick Ordering';

                $newInvTrans = DB::select('CALL Insert_OrderInventoryTrans(?,?,?,?,?,?,?,?,?,?)'
                ,array($Flwr->FLwr_ID,$flwrDet->QTY_Remaining,$flwrDet->Cost,$Flwr->price,$current,'O','Flower',$flwrDet->Sched_ID,$id,$message));
                $QTYToFulfill = $QTYToFulfill - $flwrDet->QTY_Remaining;
              }//end of the if which determines if the qty ordered is greater that the qty in the inventory this tells the system that the flower is not yet fulfilled

              else if($flwrDet->QTY_Remaining > $QTYToFulfill){
                $newQty_Remaining  = $flwrDet->QTY_Remaining - $QTYToFulfill;


                $SellFlowers = DB::select('CALL Sell_Flowers_PerBatch(?, ?, ?)',array($flwrDet->Sched_ID,$Flwr->FLwr_ID,$QTYToFulfill));
                $message = '';
                $message = 'Flowers sold Under the sales order ID: ORDR_'.$id.' through Quick Ordering';

                $newInvTrans = DB::select('CALL Insert_OrderInventoryTrans(?,?,?,?,?,?,?,?,?,?)'
                ,array($Flwr->FLwr_ID,$QTYToFulfill,$flwrDet->Cost,$Flwr->price,$current,'O','Flower',$flwrDet->Sched_ID,$id,$message));
                $QTYToFulfill = $QTYToFulfill - $QTYToFulfill;
                break;
              }//end of else if that breaks from the inner loop when the flower ordered was lesser than the flwerin the specific batch...
            }//end of inner foreach looking for the batches of flowers
          }//end of for
        }//end of foreach looking for the flowers under a each bouquets in the order

        $Acrs = DB::select('call AvailableAcessories_Records()');
        //dd($Acrs);
    foreach($SalesOrder_BqtAccessories as $AcrsDet){
          $BqtQty = 0;
          foreach($NewOrder_Bouquet as $bqtcontent){
            if($bqtcontent->Bqt_ID == $AcrsDet->bqt_ID){
              $BqtQty = $bqtcontent->QTY;
            }
          }
//less the ordered flowers from the inventory
      for($ctr = 0; $ctr <= $BqtQty-1;$ctr++){
        foreach($Acrs as $Acrs2){
          if($Acrs2->ACC_ID == $AcrsDet->Acrs_ID){
            $SellAcrs = DB::select('CALL Sell_AcrsFrom_Inventory(?, ?)',array($Acrs2->ACC_ID,$AcrsDet->qty));
            $message = '';
            $message = 'Accessories sold Under a bouquet in the sales order ID: ORDR_'.$id.' through Long Ordering';

            $newInvTrans2 = DB::select('CALL Insert_OrderInventoryTrans(?,?,?,?,?,?,?,?,?,?)'
            ,array($AcrsDet->Acrs_ID,$AcrsDet->qty,$Acrs2->price,$AcrsDet->Price,$current,'O','Acessories',null,$id,$message));
          }
        }//looping al of the acrs that are going to be used
      }
    }//end of foreach looking for the flowers under a each bouquets in the order

    }//

    Session::put('ReleaseOrder_Session','Successful');
    return redirect()->back();
    //looks for the total count of flowers in the order;
}//

  public function show_Order_ToRelease($id,$type){
    if(auth::guard('admins')->user()->type == '1'){
      $cities = DB::table('cities')
        ->select('*')
        ->get();

      $province = DB::table('provinces')
        ->select('*')
        ->get();
        $cityname = "";
        $provname = "";
      $NewSalesOrder = sales_order::find($id);

      $NewSalesOrder_details = Neworder_details::find($id);
      foreach($cities as $city){
        if($city->id == $NewSalesOrder_details->Delivery_City){
            $cityname = $city->name;
            break;
        }
      }
      foreach($province as $prov){
        if($prov->id == $NewSalesOrder_details->Delivery_Province){
            $provname = $prov->name;
            break;
        }
      }


      $NewOrder_SchedDetails = DB::table('shop_schedule')
                                 ->where('Order_ID', $id)
                                 ->first();

      $SalesOrder_flowers = DB::select('CALL show_sales_Orders_Flowers(?)',array($id));
      $NewOrder_Bouquet = DB::table('sales_order_bouquet')
                                  ->where('Order_ID', $id)
                                  ->get();

      $SalesOrder_Bqtflowers = DB::select('CALL show_SalesOrder_Bqt_Flowers(?)',array($id));
      //dd($NewOrder_Bouquet);

      $SalesOrder_BqtAccessories = DB::select('CALL show_SalesOrder_Bqt_Accessories(?)',array($id));

      $payments = DB::select('CALL Breakdown_ofPayment_underTheorder(?)',array($id));


      $Shop_Schedule = shop_schedule::where('Order_ID', $id)->get();
      $now = Carbon::now()->timezone('Asia/Manila');
      $datenow = $now -> format('Y-m-d H:i:s');

      $hourdiff = "";

      foreach($Shop_Schedule as $shopsched){
        $time = $shopsched->Time;
        $hourdiff = number_format((strtotime($datenow) - strtotime($time))/3600, 0);
      }

        return view('Orders.Order_Torelease')
        ->with('fromtype',$type)
        ->with('payments',$payments)
        ->with('cityname',$cityname)
        ->with('provname',$provname)
        ->with('cities',$cities)
        ->with('province',$province)
        ->with('SalesOrder',$NewSalesOrder)
        ->with('Sched_Details',$NewOrder_SchedDetails)
        ->with('OrderDetails',$NewSalesOrder_details)
        ->with('Flowers',$SalesOrder_flowers)
        ->with('Bouquet',$NewOrder_Bouquet)
        ->with('Bqt_Flowers',$SalesOrder_Bqtflowers)
        ->with('Bqt_Acrs',$SalesOrder_BqtAccessories)
        ->with('hourdiff', $hourdiff);
    }
    else if(auth::guard('admins')->user()->type == '2'){
      $cities = DB::table('cities')
        ->select('*')
        ->get();

      $province = DB::table('provinces')
        ->select('*')
        ->get();
        $cityname = "";
        $provname = "";
      $NewSalesOrder = sales_order::find($id);

      $NewSalesOrder_details = Neworder_details::find($id);
      foreach($cities as $city){
        if($city->id == $NewSalesOrder_details->Delivery_City){
            $cityname = $city->name;
            break;
        }
      }
      foreach($province as $prov){
        if($prov->id == $NewSalesOrder_details->Delivery_Province){
            $provname = $prov->name;
            break;
        }
      }


      $NewOrder_SchedDetails = DB::table('shop_schedule')
                                 ->where('Order_ID', $id)
                                 ->first();

      $SalesOrder_flowers = DB::select('CALL show_sales_Orders_Flowers(?)',array($id));
      $NewOrder_Bouquet = DB::table('sales_order_bouquet')
                                  ->where('Order_ID', $id)
                                  ->get();

      $SalesOrder_Bqtflowers = DB::select('CALL show_SalesOrder_Bqt_Flowers(?)',array($id));
      //dd($NewOrder_Bouquet);

      $SalesOrder_BqtAccessories = DB::select('CALL show_SalesOrder_Bqt_Accessories(?)',array($id));

      $payments = DB::select('CALL Breakdown_ofPayment_underTheorder(?)',array($id));


            $Shop_Schedule = shop_schedule::where('Order_ID', $id)->get();
            $now = Carbon::now()->timezone('Asia/Manila');
            $datenow = $now -> format('Y-m-d H:i:s');

            $hourdiff = "";

            foreach($Shop_Schedule as $shopsched){
              $time = $shopsched->Time;
              $hourdiff = number_format((strtotime($datenow) - strtotime($time))/3600, 0);
            }

        return view('Orders.Order_Torelease')
        ->with('fromtype',$type)
        ->with('payments',$payments)
        ->with('cityname',$cityname)
        ->with('provname',$provname)
        ->with('cities',$cities)
        ->with('province',$province)
        ->with('SalesOrder',$NewSalesOrder)
        ->with('Sched_Details',$NewOrder_SchedDetails)
        ->with('OrderDetails',$NewSalesOrder_details)
        ->with('Flowers',$SalesOrder_flowers)
        ->with('Bouquet',$NewOrder_Bouquet)
        ->with('Bqt_Flowers',$SalesOrder_Bqtflowers)
        ->with('Bqt_Acrs',$SalesOrder_BqtAccessories)
        ->with('hourdiff', $hourdiff);
   }
  }

  public function print_paymentSummary($id){

    $current = Carbon::now('Asia/Manila');
    $payment_Details = Customer_Payment::find($id);

    $p_settlements = DB::select('CALL payment_Settlements(?)',array($id));
    //dd($p_settlements);

    $pdf = \PDF::loadView("reports\paymentSummary_reciept",['P_Settlements'=>$p_settlements,'P_Details'=>$payment_Details]);

    return $pdf->download($current.'-PMNT'.$id.'paymentReciept.pdf');
  }

  public function remove_ordertopay($id){
    $ERROR = 0;
      foreach(Cart::instance('ordersTopay')->content() as $ord){
        if($ord->id == $id){
          Session::put('settingSession','Deleted');
          Cart::instance('ordersTopay')->remove($ord->rowId);
          return redirect()->back();
          break;
        }else{
          $ERROR = 1;
        }
      }

      if($ERROR == 1){
        Session::put('settingSession','Error');
        return redirect()->back();
      }
  }

  public function add_ordertopay($id){
    $NewSalesOrder_details = Neworder_details::find($id);
      //dd($NewSalesOrder_details);


      foreach(Cart::instance('ordersTopay')->content() as $ord){
        if($ord->id == $id){
          Session::put('settingSession','Fail');
          return redirect()->back();
          break;
        }
      }

      Cart::instance('ordersTopay')
      ->add(['id' => $id, 'name' => 'ORDR-'.$id,
      'qty' => 1, 'price' => $NewSalesOrder_details->BALANCE,
      'options' => ['t_amt' => $NewSalesOrder_details->Total_Amt,'status'=>$NewSalesOrder_details->Status]]);
      Session::put('settingSession','Successful');

      return redirect()->back();
  }

  public function show_debts($id){
        if(auth::guard('admins')->user()->type == '1'){
          $cities = DB::table('cities')
          ->select('*')
          ->get();

          $province = DB::table('provinces')
          ->select('*')
          ->get();

          $provname = "";
          $cityname = "";

          $customer = CustomerDetails::find($id);
          foreach($province as $prov){
            if($customer->Province == $prov->id){
              $provname = $prov->name;
              break;
            }
          }
          foreach($cities as $city){
            if($customer->Province == $city->id){
               $cityname = $city->name;
              break;
            }
          }

          $balanced = DB::select('CALL Customer_DebtedOrders(?)',array($id));
          $pending = DB::select('CALL customer_pendingOrders(?)',array($id));
          $closed_Cancel = DB::select('CALL closed_and_Cancelled_Orders(?)',array($id));
          $full = DB::select('CALL fully_paidOrders(?)',array($id));

          $debtDetails = DB::select('CALL specific_Customer_Debt(?)',array($id));

          $debt = 0;
          foreach($debtDetails as $debtDetails){
            $debt = $debtDetails->Total_Debt;
          }
          //dd($customer);

          //dd($balanced);

          return view('Orders.Manage_Payment_forDebts')
          ->with('cust',$customer)
          ->with('city',$cityname)
          ->with('prov',$provname)
          ->with('b_Orders',$balanced)
          ->with('debt',$debt);
          //to be continued
        }
        else if(auth::guard('admins')->user()->type == '2'){
          $cities = DB::table('cities')
          ->select('*')
          ->get();

          $province = DB::table('provinces')
          ->select('*')
          ->get();

          $provname = "";
          $cityname = "";

          $customer = CustomerDetails::find($id);
          foreach($province as $prov){
            if($customer->Province == $prov->id){
              $provname = $prov->name;
              break;
            }
          }
          foreach($cities as $city){
            if($customer->Province == $city->id){
               $cityname = $city->name;
              break;
            }
          }

          $balanced = DB::select('CALL Customer_DebtedOrders(?)',array($id));
          $pending = DB::select('CALL customer_pendingOrders(?)',array($id));
          $closed_Cancel = DB::select('CALL closed_and_Cancelled_Orders(?)',array($id));
          $full = DB::select('CALL fully_paidOrders(?)',array($id));

          $debtDetails = DB::select('CALL specific_Customer_Debt(?)',array($id));

          $debt = 0;
          foreach($debtDetails as $debtDetails){
            $debt = $debtDetails->Total_Debt;
          }
          //dd($customer);

          //dd($balanced);

          return view('Orders.Manage_Payment_forDebts')
          ->with('cust',$customer)
          ->with('city',$cityname)
          ->with('prov',$provname)
          ->with('b_Orders',$balanced)
          ->with('debt',$debt);
          //to be continued
        }

  }

  public function Show_Specific_customerWith_Debt($id){
    if(auth::guard('admins')->user()->type == '1'){
      //echo $id;
      $cities = DB::table('cities')
      ->select('*')
      ->get();

      $province = DB::table('provinces')
      ->select('*')
      ->get();

      $provname = "";
      $cityname = "";

      $customer = CustomerDetails::find($id);
      foreach($province as $prov){
        if($customer->Province == $prov->id){
          $provname = $prov->name;
          break;
        }
      }
      foreach($cities as $city){
        if($customer->Province == $city->id){
           $cityname = $city->name;
          break;
        }
      }

      $balanced = DB::select('CALL Customer_DebtedOrders(?)',array($id));
      $pending = DB::select('CALL customer_pendingOrders(?)',array($id));
      $closed_Cancel = DB::select('CALL closed_and_Cancelled_Orders(?)',array($id));
      $full = DB::select('CALL fully_paidOrders(?)',array($id));

      $debtDetails = DB::select('CALL specific_Customer_Debt(?)',array($id));

      $debt = 0;
      foreach($debtDetails as $debtDetails){
        $debt = $debtDetails->Total_Debt;
      }

      return view('Orders.Customers_Orders_WithDebt')
      ->with('cust',$customer)
      ->with('city',$cityname)
      ->with('prov',$provname)
      ->with('b_Orders',$balanced)
      ->with('pending',$pending)
      ->with('closed',$closed_Cancel)
      ->with('full',$full)
      ->with('debtDetails',$debtDetails)
      ->with('debt',$debt);
      //to be continued
    }
    else if(auth::guard('admins')->user()->type == '2'){
      //echo $id;
      $cities = DB::table('cities')
      ->select('*')
      ->get();

      $province = DB::table('provinces')
      ->select('*')
      ->get();

      $provname = "";
      $cityname = "";

      $customer = CustomerDetails::find($id);
      foreach($province as $prov){
        if($customer->Province == $prov->id){
          $provname = $prov->name;
          break;
        }
      }
      foreach($cities as $city){
        if($customer->Province == $city->id){
           $cityname = $city->name;
          break;
        }
      }

      $balanced = DB::select('CALL Customer_DebtedOrders(?)',array($id));
      $pending = DB::select('CALL customer_pendingOrders(?)',array($id));
      $closed_Cancel = DB::select('CALL closed_and_Cancelled_Orders(?)',array($id));
      $full = DB::select('CALL fully_paidOrders(?)',array($id));

      $debtDetails = DB::select('CALL specific_Customer_Debt(?)',array($id));

      $debt = 0;
      foreach($debtDetails as $debtDetails){
        $debt = $debtDetails->Total_Debt;
      }

      return view('Orders.Customers_Orders_WithDebt')
      ->with('cust',$customer)
      ->with('city',$cityname)
      ->with('prov',$provname)
      ->with('b_Orders',$balanced)
      ->with('pending',$pending)
      ->with('closed',$closed_Cancel)
      ->with('full',$full)
      ->with('debtDetails',$debtDetails)
      ->with('debt',$debt);
      //to be continued
    }

  }

  public function ShowSpecific_Confirmed_Orders($id,$type){
      if(auth::guard('admins')->user()->type == '1'){
        $cities = DB::table('cities')
          ->select('*')
          ->get();

        $province = DB::table('provinces')
          ->select('*')
          ->get();
          $cityname = "";
          $provname = "";
        $NewSalesOrder = sales_order::find($id);

        $NewSalesOrder_details = Neworder_details::find($id);

        foreach($cities as $city){
          if($NewSalesOrder_details == null){
            $cityname = 'N/A';
          }else{
            if($city->id == $NewSalesOrder_details->Delivery_City){
              $cityname = $city->name;
              break;
            }
          }
        }
        foreach($province as $prov){
          if($NewSalesOrder_details == null){
            $provname = 'N/A';
          }else{
            if($prov->id == $NewSalesOrder_details->Delivery_Province){
              $provname = $prov->name;
              break;
            }
          }
        }


        $NewOrder_SchedDetails = DB::table('shop_schedule')
                                   ->where('Order_ID', $id)
                                   ->first();

        $SalesOrder_flowers = DB::select('CALL show_sales_Orders_Flowers(?)',array($id));
        $NewOrder_Bouquet = DB::table('sales_order_bouquet')
                                    ->where('Order_ID', $id)
                                    ->get();

        $SalesOrder_Bqtflowers = DB::select('CALL show_SalesOrder_Bqt_Flowers(?)',array($id));
        //dd($NewOrder_Bouquet);

        $SalesOrder_BqtAccessories = DB::select('CALL show_SalesOrder_Bqt_Accessories(?)',array($id));

        $payments = DB::select('CALL Breakdown_ofPayment_underTheorder(?)',array($id));

        $Shop_Schedule = shop_schedule::where('Order_ID', $id)->get();

        $now = Carbon::now()->timezone('Asia/Manila');
        $datenow = $now -> format('Y-m-d H:i:s');

        $hourdiff = "";

        foreach($Shop_Schedule as $shopsched){
          $time = $shopsched->Time;
          $hourdiff = number_format((strtotime($datenow) - strtotime($time))/3600, 0);
        }
        //dd($hourdiff);



          return view('Orders.manageSpecific_ConfirmedOrder')
          ->with('fromtype',$type)
          ->with('payments',$payments)
          ->with('cityname',$cityname)
          ->with('provname',$provname)
          ->with('cities',$cities)
          ->with('province',$province)
          ->with('SalesOrder',$NewSalesOrder)
          ->with('Sched_Details',$NewOrder_SchedDetails)
          ->with('OrderDetails',$NewSalesOrder_details)
          ->with('Flowers',$SalesOrder_flowers)
          ->with('Bouquet',$NewOrder_Bouquet)
          ->with('Bqt_Flowers',$SalesOrder_Bqtflowers)
          ->with('Bqt_Acrs',$SalesOrder_BqtAccessories)
          ->with('hourdiff', $hourdiff);
      }
      else if(auth::guard('admins')->user()->type == '2'){
        $cities = DB::table('cities')
          ->select('*')
          ->get();

        $province = DB::table('provinces')
          ->select('*')
          ->get();
          $cityname = "";
          $provname = "";
        $NewSalesOrder = sales_order::find($id);

        $NewSalesOrder_details = Neworder_details::find($id);

        foreach($cities as $city){
          if($NewSalesOrder_details == null){
            $cityname = 'N/A';
          }else{
            if($city->id == $NewSalesOrder_details->Delivery_City){
              $cityname = $city->name;
              break;
            }
          }
        }
        foreach($province as $prov){
          if($NewSalesOrder_details == null){
            $provname = 'N/A';
          }else{
            if($prov->id == $NewSalesOrder_details->Delivery_Province){
              $provname = $prov->name;
              break;
            }
          }
        }


        $NewOrder_SchedDetails = DB::table('shop_schedule')
                                   ->where('Order_ID', $id)
                                   ->first();

        $SalesOrder_flowers = DB::select('CALL show_sales_Orders_Flowers(?)',array($id));
        $NewOrder_Bouquet = DB::table('sales_order_bouquet')
                                    ->where('Order_ID', $id)
                                    ->get();

        $SalesOrder_Bqtflowers = DB::select('CALL show_SalesOrder_Bqt_Flowers(?)',array($id));
        //dd($NewOrder_Bouquet);

        $SalesOrder_BqtAccessories = DB::select('CALL show_SalesOrder_Bqt_Accessories(?)',array($id));

        $payments = DB::select('CALL Breakdown_ofPayment_underTheorder(?)',array($id));

        $Shop_Schedule = shop_schedule::where('Order_ID', $id)->get();

        $now = Carbon::now()->timezone('Asia/Manila');
        $datenow = $now -> format('Y-m-d H:i:s');

        foreach($Shop_Schedule as $shopsched){

          $time = $shopsched >Time;
        }

        $hourdiff = number_format( strtotime($datenow) - (strtotime($time))/3600, 0);


          return view('Orders.manageSpecific_ConfirmedOrder')
          ->with('fromtype',$type)
          ->with('payments',$payments)
          ->with('cityname',$cityname)
          ->with('provname',$provname)
          ->with('cities',$cities)
          ->with('province',$province)
          ->with('SalesOrder',$NewSalesOrder)
          ->with('Sched_Details',$NewOrder_SchedDetails)
          ->with('OrderDetails',$NewSalesOrder_details)
          ->with('Flowers',$SalesOrder_flowers)
          ->with('Bouquet',$NewOrder_Bouquet)
          ->with('Bqt_Flowers',$SalesOrder_Bqtflowers)
          ->with('Bqt_Acrs',$SalesOrder_BqtAccessories)
          ->with('hourdiff', $hourdiff);
      }
  }

    //
  public function PaylaterSpecific_Order($id){
    $current = Carbon::now('Asia/Manila');

      $NewSalesOrder_details = Neworder_details::find($id);
      $UpdateOrderDet = DB::select('CALL confirmOrder(?,?,?)',array($id,'BALANCED',$NewSalesOrder_details->Total_Amt));//updated the status of the order details as well sa the salesorder status

      $newInvoice = DB::select("CALL new_Invoice(?,?,?,?,?,?,?,?)",
      array($id,$NewSalesOrder_details->Subtotal,$NewSalesOrder_details->Delivery_Charge,$NewSalesOrder_details->VAT,
      $NewSalesOrder_details->Total_Amt,$NewSalesOrder_details->Total_Amt,$current,'B'));
      Session::put('ConfirmOrderSession','Paylater');
      return redirect()->route('dashboard');
  }

  public function ManageSpecific_Order($id){
  if(auth::guard('admins')->user()->type == '1'){
    $cities = DB::table('cities')
      ->select('*')
      ->get();

    $province = DB::table('provinces')
      ->select('*')
      ->get();
      $cityname = "";
      $provname = "";
    $NewSalesOrder = sales_order::find($id);

    $NewSalesOrder_details = Neworder_details::find($id);
    foreach($cities as $city){
      if($city->id == $NewSalesOrder_details->Delivery_City){
          $cityname = $city->name;
          break;
      }
    }
    foreach($province as $prov){
      if($prov->id == $NewSalesOrder_details->Delivery_Province){
          $provname = $prov->name;
          break;
      }
    }
    //2





    $NewOrder_SchedDetails = DB::table('shop_schedule')
                               ->where('Order_ID', $id)
                               ->first();

    $SalesOrder_flowers = DB::select('CALL show_sales_Orders_Flowers(?)',array($id));
    $NewOrder_Bouquet = DB::table('sales_order_bouquet')
                                ->where('Order_ID', $id)
                                ->get();

    $SalesOrder_Bqtflowers = DB::select('CALL show_SalesOrder_Bqt_Flowers(?)',array($id));
    //dd($NewOrder_Bouquet);

    $SalesOrder_BqtAccessories = DB::select('CALL show_SalesOrder_Bqt_Accessories(?)',array($id));

      return view('Orders.ManageSpecificOrder')
      ->with('cityname',$cityname)
      ->with('provname',$provname)
      ->with('cities',$cities)
      ->with('province',$province)
      ->with('SalesOrder',$NewSalesOrder)
      ->with('Sched_Details',$NewOrder_SchedDetails)
      ->with('OrderDetails',$NewSalesOrder_details)
      ->with('Flowers',$SalesOrder_flowers)
      ->with('Bouquet',$NewOrder_Bouquet)
      ->with('Bqt_Flowers',$SalesOrder_Bqtflowers)
      ->with('Bqt_Acrs',$SalesOrder_BqtAccessories);

  }
  else if(auth::guard('admins')->user()->type == '2'){
    $cities = DB::table('cities')
      ->select('*')
      ->get();

    $province = DB::table('provinces')
      ->select('*')
      ->get();
      $cityname = "";
      $provname = "";
    $NewSalesOrder = sales_order::find($id);

    $NewSalesOrder_details = Neworder_details::find($id);
    foreach($cities as $city){
      if($city->id == $NewSalesOrder_details->Delivery_City){
          $cityname = $city->name;
          break;
      }
    }
    foreach($province as $prov){
      if($prov->id == $NewSalesOrder_details->Delivery_Province){
          $provname = $prov->name;
          break;
      }
    }
    //2





    $NewOrder_SchedDetails = DB::table('shop_schedule')
                               ->where('Order_ID', $id)
                               ->first();

    $SalesOrder_flowers = DB::select('CALL show_sales_Orders_Flowers(?)',array($id));
    $NewOrder_Bouquet = DB::table('sales_order_bouquet')
                                ->where('Order_ID', $id)
                                ->get();

    $SalesOrder_Bqtflowers = DB::select('CALL show_SalesOrder_Bqt_Flowers(?)',array($id));
    //dd($NewOrder_Bouquet);

    $SalesOrder_BqtAccessories = DB::select('CALL show_SalesOrder_Bqt_Accessories(?)',array($id));

      return view('Orders.ManageSpecificOrder')
      ->with('cityname',$cityname)
      ->with('provname',$provname)
      ->with('cities',$cities)
      ->with('province',$province)
      ->with('SalesOrder',$NewSalesOrder)
      ->with('Sched_Details',$NewOrder_SchedDetails)
      ->with('OrderDetails',$NewSalesOrder_details)
      ->with('Flowers',$SalesOrder_flowers)
      ->with('Bouquet',$NewOrder_Bouquet)
      ->with('Bqt_Flowers',$SalesOrder_Bqtflowers)
      ->with('Bqt_Acrs',$SalesOrder_BqtAccessories);

  }
  else if(auth::guard('admins')->user()->type == '3'){
    $cities = DB::table('cities')
      ->select('*')
      ->get();

    $province = DB::table('provinces')
      ->select('*')
      ->get();
      $cityname = "";
      $provname = "";
    $NewSalesOrder = sales_order::find($id);

    $NewSalesOrder_details = Neworder_details::find($id);
    foreach($cities as $city){
      if($city->id == $NewSalesOrder_details->Delivery_City){
          $cityname = $city->name;
          break;
      }
    }
    foreach($province as $prov){
      if($prov->id == $NewSalesOrder_details->Delivery_Province){
          $provname = $prov->name;
          break;
      }
    }
    //2





    $NewOrder_SchedDetails = DB::table('shop_schedule')
                               ->where('Order_ID', $id)
                               ->first();

    $SalesOrder_flowers = DB::select('CALL show_sales_Orders_Flowers(?)',array($id));
    $NewOrder_Bouquet = DB::table('sales_order_bouquet')
                                ->where('Order_ID', $id)
                                ->get();

    $SalesOrder_Bqtflowers = DB::select('CALL show_SalesOrder_Bqt_Flowers(?)',array($id));
    //dd($NewOrder_Bouquet);

    $SalesOrder_BqtAccessories = DB::select('CALL show_SalesOrder_Bqt_Accessories(?)',array($id));

      return view('Orders.ManageSpecificOrder')
      ->with('cityname',$cityname)
      ->with('provname',$provname)
      ->with('cities',$cities)
      ->with('province',$province)
      ->with('SalesOrder',$NewSalesOrder)
      ->with('Sched_Details',$NewOrder_SchedDetails)
      ->with('OrderDetails',$NewSalesOrder_details)
      ->with('Flowers',$SalesOrder_flowers)
      ->with('Bouquet',$NewOrder_Bouquet)
      ->with('Bqt_Flowers',$SalesOrder_Bqtflowers)
      ->with('Bqt_Acrs',$SalesOrder_BqtAccessories);

  }


  }

  public function PrintReciept($id){

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

      //dd($NewOrder_SchedDetails);
        $pdf = \PDF::loadView("reports\Order_SimpleSummary_Receipt",['city'=>$cityName,'province'=>$provName,'NewSalesOrder'=>$NewSalesOrder,
      'NewOrder_SchedDetails'=>$NewOrder_SchedDetails,'SalesOrder_flowers'=>$SalesOrder_flowers,'NewOrder_Bouquet'=>$NewOrder_Bouquet,
        'SalesOrder_Bqtflowers'=>$SalesOrder_Bqtflowers,'SalesOrder_BqtAccessories'=>$SalesOrder_BqtAccessories,'NewSalesOrder_details'=>$NewSalesOrder_details]);

        return $pdf->download('LongOrderTransaction_Summary.pdf');
      //
  }


  public function ViewOrderSummary()
  {
    //for showing the checkout options of the order

      if(auth::guard('admins')->user()->type == '1'){



      $cities = DB::table('cities')
      ->select('*')
      ->get();

    $province = DB::table('provinces')
      ->select('*')
      ->get();

    $customers = DB::table('customer_details')
    ->select('*')
    ->get();
    $CustWith_TradeAgreement = DB::select("call View_Customers_withAgreement()");

    return view('orders/ordersummary')
    ->with('CustTradeAgreements',$CustWith_TradeAgreement)
    ->with('cust',$customers)
    ->with('city',$cities)
    ->with('cities',$cities)
    ->with('cities2',$cities)
    ->with('provinces',$province)
    ->with('provinces2',$province)
    ->with('city2',$cities)
    ->with('province',$province);

      }
      else if (auth::guard('admins')->user()->type == '2'){

             $cities = DB::table('cities')
      ->select('*')
      ->get();

    $province = DB::table('provinces')
      ->select('*')
      ->get();

    $customers = DB::table('customer_details')
    ->select('*')
    ->get();
    $CustWith_TradeAgreement = DB::select("call View_Customers_withAgreement()");

    return view('orders/ordersummary')
    ->with('CustTradeAgreements',$CustWith_TradeAgreement)
    ->with('cust',$customers)
    ->with('city',$cities)
    ->with('cities',$cities)
    ->with('cities2',$cities)
    ->with('provinces',$province)
    ->with('provinces2',$province)
    ->with('city2',$cities)
    ->with('province',$province);


      }

  }

  public function DeleteFlower_per_Order($flower_ID)
	{

	        $AvailableFlowers = DB::select('call wonderbloomdb2.Viewing_Flowers_With_UpdatedPrice()');

			foreach(Cart::instance('Ordered_Flowers')->content() as $row){
				if($row->id == $flower_ID){
					echo $row->id;
					Cart::instance('Ordered_Flowers')->remove($row->rowId);
		        	Session::put('Deleted_Flowerfrom_Order', 'Successful');
				}
			}//end of function
              return redirect()-> route('Long_Sales_Order.index');
	             //return view('Orders.creationOfOrders')
	             //->with('FlowerList',$AvailableFlowers);
       	//}
      }
    public function DeleteFlower_per_Bqt_Order($flower_ID,$order_ID)
	{
          //  Session::put('loginSession','fail');
          //  return redirect() -> route('adminsignin');
        //}
        //else{*/
			echo $flower_ID;
			foreach(Cart::instance('OrderedBqt_Flowers')->content() as $row){
				if($row->id == $flower_ID){
					echo $row->id;
					Cart::instance('OrderedBqt_Flowers')->remove($row->rowId);
		        	Session::put('Deleted_FlowerfromBQT_Order', 'Successful');
				}
			}
			return redirect()->route('Order.CreateaBouquet', $order_ID);//returns to the creation of flowers
	}//end of function

	public function DeleteFlower_per_Bqt_SessionOrder($flower_ID)
	{
      if(auth::guard('admins')->check() == false){
          Session::put('loginSession','fail');
          return redirect() -> route('adminsignin');
      }
      else{
  			echo $flower_ID;
  			foreach(Cart::instance('OrderedBqt_Flowers')->content() as $row){
  				if($row->id == $flower_ID){
  					echo $row->id;
  					Cart::instance('OrderedBqt_Flowers')->remove($row->rowId);
  		        	Session::put('Deleted_FlowerfromBQT_Order', 'Successful');
				}
			}
          return redirect()-> route('Long_Sales_Order.index');
          //return redirect()->route('Order.CustomizeaBouquet');
	    }
	}//end of function


    public function DeleteAcessory_per_Bqt_Order($Acessory_ID,$order_ID)
	{
      if(auth::guard('admins')->check() == false){
              Session::put('loginSession','fail');
              return redirect() -> route('adminsignin');
      }else{
        			echo $Acessory_ID;
        			foreach(Cart::instance('OrderedBqt_Acessories')->content() as $row){
        				if($row->id == $Acessory_ID){
        					Cart::instance('OrderedBqt_Acessories')->remove($row->rowId);
        					Session::put('Deleted_AcessoryfromBQT_Order', 'Successful');
  				        }
  			       }
  			return redirect()->route('Order.CreateaBouquet', $order_ID);//returns to the creation of flowers*/
  	   }//end of function
  }

  public function DeleteAcessory_per_SessionBqt_Order($Acessory_ID)
	{
    if(auth::guard('admins')->check() == false){
        Session::put('loginSession','fail');
        return redirect() -> route('adminsignin');
    }
    else{
			echo $Acessory_ID;
			foreach(Cart::instance('OrderedBqt_Acessories')->content() as $row){
				if($row->id == $Acessory_ID){
					Cart::instance('OrderedBqt_Acessories')->remove($row->rowId);
					Session::put('Deleted_AcessoryfromBQT_Order', 'Successful');
				}
			}
      return redirect()-> route('Long_Sales_Order.index');
    	}
	}//end of function


	public function Cancel_and_ClearFlower_per_Bqt_Order($order_ID)
	{
		if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
			$AvailableFlowers = DB::select('call wonderbloomdb2.Viewing_Flowers_With_UpdatedPrice()');

			Cart::instance('OrderedBqt_Flowers')->destroy();

			Session::put('Buquet_Cancelation', 'Successful');
	    	 return view('Orders.creationOfOrders')
	     	->with('FlowerList',$AvailableFlowers);
	     }

	}//end of function




	public function Cancel_and_Clear_Bqt_Order()
	{
		if(auth::guard('admins')->check() == false){
        Session::put('loginSession','fail');
        return redirect() -> route('adminsignin');//
      }
    else{
			$AvailableFlowers = DB::select('call wonderbloomdb2.Viewing_Flowers_With_UpdatedPrice()');

			Cart::instance('OrderedBqt_Flowers')->destroy();
			Cart::instance('OrderedBqt_Acessories')->destroy();

			Session::put('Buquet_Cancelation', 'Successful');
			return redirect()->route('Sales_Qoutation.show');//returns to the creation of flowers
	   }//end of function
  }

	public function Cancel_and_Clear_BqtSession_Order()
	{
    if(auth::guard('admins')->check() == false){
        Session::put('loginSession','fail');
        return redirect() -> route('adminsignin');
    }
    else{
	        $AvailableFlowers = DB::select('call wonderbloomdb2.Viewing_Flowers_With_UpdatedPrice()');

			Cart::instance('OrderedBqt_Flowers')->destroy();
			Cart::instance('OrderedBqt_Acessories')->destroy();
			Cart::instance('Ordered_Bqt')->destroy();

			Session::put('Buquet_Cancelation', 'Successful');
			     return view('Orders.creationOfOrders')
	             ->with('FlowerList',$AvailableFlowers);
			return redirect()->route('Sales_Qoutation.show');//returns to the creation of flowers
		}
	}//end of function


    public function Clear_Cart()
    {
     if(auth::guard('admins')->check() == false){
          Session::put('loginSession','fail');
          return redirect() -> route('adminsignin');
      }
      else{
        Cart::instance('FinalBqt_Flowers')->destroy();
        Cart::instance('FinalBqt_Acessories')->destroy();
        Cart::instance('Ordered_Bqt')->destroy();
        Cart::instance('Ordered_Flowers')->destroy();

        Session::put('CartClearSession', 'Successful');
                return redirect()-> route('Long_Sales_Order.index');
        //returns to the creation of flowers
      }
    }//end of function


    public function Clear_Bouquet()
    {
      if(auth::guard('admins')->check() == false){
          Session::put('loginSession','fail');
          return redirect() -> route('adminsignin');
      }
      else{

        Cart::instance('OrderedBqt_Flowers')->destroy();
        Cart::instance('OrderedBqt_Acessories')->destroy();

        Session::put('BqtClearSession', 'Successful');
                return redirect()-> route('Long_Sales_Order.index');
        //returns to the creation of flowers
      }
    }//end of function

	public function saveCustomized_Bqt($order_ID)
	{

    if(auth::guard('admins')->check() == false){
          Session::put('loginSession','fail');
          return redirect() -> route('adminsignin');
      }
      else{
				$BQT_Flower_Count = 0;
				foreach(Cart::instance('OrderedBqt_Flowers')->content() as $row){
						$BQT_Flower_Count += $row->qty;
				}
			    $Flowers_subtotal = str_replace(array(','), array(''), Cart::instance('OrderedBqt_Flowers')->subtotal());


	            $Acessories_subtotal = str_replace(array(','), array(''), Cart::instance('OrderedBqt_Acessories')->subtotal());
	            echo '<h2><b>$Flowers_subtotal = </b>'.$Flowers_subtotal.'<\h2>';
	            echo '<h2><b>$Acessories_subtotal = </b>'.$Acessories_subtotal.'<\h2>';
	            echo '<h2><b>BOQUET_total = </b>'.number_format($Acessories_subtotal + $Flowers_subtotal,2).'<\h2>';
	            echo '<h2><b>BOQUET Flower Count = </b>'.$BQT_Flower_Count.' pcs. <\h2>';
		//add a record for the bouqeut_details table and bouquest_flowers table and then add that bouquet_ID to the sales orderBouquet,as well as the flowers to the sales_order_bouquet_flowers

	    //create a bouquet record first
	            $BQT_Price = $Acessories_subtotal + $Flowers_subtotal;

	            $bouquet_record = new bouquet_details;

	            $bouquet_record->count_ofFlowers = $BQT_Flower_Count;
	            $bouquet_record->price = $BQT_Price;
	            $bouquet_record->Type = 'custom';
	            $bouquet_record->Order_ID = $order_ID;

	            $bouquet_record->save();
	            $newBqt_ID = $bouquet_record->bouquet_ID;
	            echo '<h2><b>$newBqt_ID = </b>'.$newBqt_ID.' <\h2>';

	    //after creating a new bouquet please make sure that you will add it to the specific order it was made for
	            $insertBQT_to_theOrder = DB::select('CALL insert_CreatedBqt_to_mySalesOrder(?, ?, ?, ?)',array($order_ID,$newBqt_ID,$BQT_Price,1));

	    //then add flowers to that bouquet with the help of the ID of the newly created bouquet
	           foreach(Cart::instance('OrderedBqt_Flowers')->content() as $OrderedFlowerrow){
						//adds the flowers that are in the session inside the bouquet_flowers table
						$addFlower_To_BQT_details_table = DB::select('CALL add_Flower_to_Bouquet(?,?,?)',array($newBqt_ID,$OrderedFlowerrow->id,$OrderedFlowerrow->qty));

						//adds the flowers that are in the session inside the sales_order_bouquet_flowers table
						$addFlowersTo_Ordered_Bouquet = DB::select('CALL add_theflowers_Of_SpecificOrderedBQT(?, ?, ?, ?, ?)',array($order_ID,$newBqt_ID,$OrderedFlowerrow->id,$OrderedFlowerrow->price,$OrderedFlowerrow->qty));
				}//end of foreach

				foreach(Cart::instance('OrderedBqt_Acessories')->content() as $OrderedAcessoriesRow){
					//adds the flowers that are in the session inside the bouquet_acessories table
					$addFlower_To_BQT_details_table = DB::select('CALL add_Acessories_to_Bouquet(?,?,?)',array($newBqt_ID,$OrderedAcessoriesRow->id,$OrderedAcessoriesRow->qty));

					//adds the acessories in the seeion into the sales_order_acessories table
					$addAcessoriesTo_Ordered_Bouquet = DB::select('CALL add_theAcessories_Of_SpecificOrderedBQT(?, ?, ?, ?, ?);',array($order_ID,$newBqt_ID,$OrderedAcessoriesRow->id,$OrderedAcessoriesRow->price,$OrderedAcessoriesRow->qty));
				}//end of row

				Cart::instance('OrderedBqt_Flowers')->destroy();
				Cart::instance('OrderedBqt_Acessories')->destroy();

			Session::put('Save_Bouqet_To_myOrder', 'Successful');
			return redirect()->route('Sales_Qoutation.show', $order_ID);//returns to the creation of flowers
		}
	}//end of function




	public function saveNewCustomized_Bqt(){
        if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
			$AvailableFlowers = DB::select('call wonderbloomdb2.Viewing_Flowers_With_UpdatedPrice()');

				$BQT_Flower_Count = 0;
				foreach(Cart::instance('OrderedBqt_Flowers')->content() as $row){
						$BQT_Flower_Count += $row->qty;
				}

			    $Flowers_subtotal = str_replace(array(','), array(''), Cart::instance('OrderedBqt_Flowers')->subtotal());

	            $Acessories_subtotal = str_replace(array(','), array(''), Cart::instance('OrderedBqt_Acessories')->subtotal());

	            $BQT_Price = $Acessories_subtotal + $Flowers_subtotal;

				if(Cart::instance('Ordered_Bqt')->count() == 0){
						$bqt_Id = mt_rand();//generates a random id
						$bqtName = 'BQT_'.$bqt_Id;
						Cart::instance('Ordered_Bqt')
				         ->add(['id' => $bqt_Id, 'name' => $bqtName, 'qty' => 1, 'price' => $BQT_Price,
				         		'options' => ['count' => $BQT_Flower_Count]]);

				        foreach(Cart::instance('OrderedBqt_Flowers')->content() as $row){
						    //this foreach will transafer all of their content to another session
			                Cart::instance('FinalBqt_Flowers')
			                ->add(['id' => $row->id, 'name' => $row->name, 'qty' => $row->qty, 'price' => $row->price,'options' => ['orig_price' => $row->options['orig_price'],'T_Amt' => $row->options['T_Amt'],'image'=>$row->options['image'],
                      'priceType'=>$row->options['priceType'], 'bqt_ID' => $bqt_Id]]);
				        }//END OF INNER FOREACH of flower cart

				        foreach(Cart::instance('OrderedBqt_Acessories')->content() as $Acrow){
					        Cart::instance('FinalBqt_Acessories')
		                		->add(['id' => $Acrow->id, 'name' => $Acrow->name, 'qty' => $Acrow->qty, 'price' => $Acrow->price,'options' => ['orig_price' => $Acrow->options['orig_price'],'T_Amt' => $Acrow->options['T_Amt'],'image'=>$Acrow->options['image'],'priceType'=>$Acrow->options['priceType'],'bqt_ID' => $bqt_Id]]);
				        }//end of foreach of the acessories cart
				}//end of if
				else{
					$newBqt_Id = '';
					foreach(Cart::instance('Ordered_Bqt')->content() as $row){
						$newBqt_Id = $row->id;
					}
					$newBqt_Id += 1;
					$newBqtName = 'BQT_'.$newBqt_Id;
						Cart::instance('Ordered_Bqt')
				         ->add(['id' => $newBqt_Id, 'name' => $newBqtName, 'qty' => 1, 'price' => $BQT_Price,
				         		'options' => ['count' => $BQT_Flower_Count]]);

				        foreach(Cart::instance('OrderedBqt_Flowers')->content() as $row){
						    //this foreach will transafer all of their content to another session
			                Cart::instance('FinalBqt_Flowers')
			                ->add(['id' => $row->id, 'name' => $row->name, 'qty' => $row->qty, 'price' => $row->price,'options' => ['orig_price' => $row->options['orig_price'],'T_Amt' => $row->options['T_Amt'],'image'=>$row->options['image'],'priceType'=>$row->options['priceType'], 'bqt_ID' => $newBqt_Id]]);
				        }//END OF INNER FOREACH of flower cart

				        foreach(Cart::instance('OrderedBqt_Acessories')->content() as $Acrow){
					        Cart::instance('FinalBqt_Acessories')
		                		->add(['id' => $Acrow->id, 'name' => $Acrow->name, 'qty' => $Acrow->qty, 'price' => $Acrow->price,'options' => ['orig_price' => $Acrow->options['orig_price'],'T_Amt' => $Acrow->options['T_Amt'],'image'=>$Acrow->options['image'],'priceType'=>$Acrow->options['priceType'],'bqt_ID' => $newBqt_Id]]);
						}//end of foreach of the acessories cart
					}//end of else

			Cart::instance('OrderedBqt_Flowers')->destroy();
			Cart::instance('OrderedBqt_Acessories')->destroy();
	        Session::put('Save_Bouqet_To_myOrder', 'Successful');
          return redirect()-> route('Long_Sales_Order.index');
    }
	}//end of function



	public function ConfrimOrder()
	{
    //
		if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{

	          $cities = DB::table('cities')
	          ->select('*')
	          ->get();

	          $province = DB::table('provinces')
	          ->select('*')
	          ->get();

            return view('Orders.confirmation_of_Order')
                ->with('city', $cities)
                ->with('province', $province);
            //}
        }
    }//end of function

	public function return_to_CreationOfOrder()
	{//
       if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
			       $AvailableFlowers = DB::select('call wonderbloomdb2.Viewing_Flowers_With_UpdatedPrice()');

			          return view('Orders.creationOfOrders')
	     	         ->with('FlowerList',$AvailableFlowers);
	     }
	}//end of function

  public function Order_Cancellation($id){

      $Sales_Order = sales_order::find($id);
      $Order_Details = order_details::find($id);
      $Shop_Schedule = db::table('shop_schedule')->where('Order_ID', $id)->Select('shedule_status')->get();


      $statusdetails = "CANCELLED";
      $statusinvoice = "CA";

      $Sales_Order -> Status = $statusdetails;
      $Order_Details -> Status = $statusdetails;

      $Sales_Order -> save();
      $Order_Details -> save();
      $shopsave = db::table('shop_schedule')->where('Order_ID', $id)->update(['shedule_status' => $statusdetails]);
      $invoice = db::table('customer_invoice')->where('invoice_ID', $id)->update(['Status' => $statusinvoice]);

      return redirect() -> back();



  }//end of function

}
