<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use \Cart;
use App\bouquet_details;
use Session;
use App\sales_order;
use \PDF;
use App\Newshop_Schedule;
use App\Neworder_details;
use Auth;
use Carbon\Carbon;

class OrderManagementController_Quick extends Controller
{
    //
    public function DeleteFlower_per_QuickOrder($flower_ID)
  {
        /*if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
     else{*/
      $AvailableFlowers = DB::select('call wonderbloomdb2.Viewing_Flowers_With_UpdatedPrice()');

      foreach(Cart::instance('QuickOrdered_Flowers')->content() as $row){
        if($row->id == $flower_ID){
          echo $row->id;
          Cart::instance('QuickOrdered_Flowers')->remove($row->rowId);
              Session::put('Deleted_Flowerfrom_QuickOrder', 'Successful');
        }
      }//end of function
              return redirect()-> back();
               //return view('Orders.creationOfOrders')
               //->with('FlowerList',$AvailableFlowers);
        //}
  }

  public function DeleteFlower_per_Bqt_SessionQuickOrder($flower_ID)
  {
        /*if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{*/
      echo $flower_ID;
      foreach(Cart::instance('QuickOrderedBqt_Flowers')->content() as $row){
        if($row->id == $flower_ID){
          echo $row->id;
          Cart::instance('QuickOrderedBqt_Flowers')->remove($row->rowId);
              Session::put('Deleted_FlowerfromBQT_QuickOrder', 'Successful');
        }
      }
      //echo 'hahaah';
          return redirect()-> back();
          //return redirect()->route('Order.CustomizeaBouquet');
      //}
  }//end of function


    public function DeleteAcessory_per_SessionBqt_QuickOrder($Acessory_ID)
  	{
      if(auth::check() == false){
          Session::put('loginSession','fail');
          return redirect() -> route('adminsignin');
      }
      else{
  			echo $Acessory_ID;
  			foreach(Cart::instance('QuickOrderedBqt_Acessories')->content() as $row){
  				if($row->id == $Acessory_ID){
  					Cart::instance('QuickOrderedBqt_Acessories')->remove($row->rowId);
  					Session::put('Deleted_AcessoryfromBQT_QuickOrder', 'Successful');
  				}
  			}
        return redirect()-> back();
      	}
  	}//end of function

    public function Clear_Cart()
    {
     if(auth::check() == false){
          Session::put('loginSession','fail');
          return redirect() -> route('adminsignin');
      }
      else{
        Cart::instance('QuickFinalBqt_Flowers')->destroy();
        Cart::instance('QuickFinalBqt_Acessories')->destroy();
        Cart::instance('QuickOrdered_Bqt')->destroy();
        Cart::instance('QuickOrdered_Flowers')->destroy();

        Session::put('QuickCartClearSession', 'Successful');
                return redirect()-> back();
        //returns to the creation of flowers
      }
    }//end of function


    public function Clear_Bouquet()
    {
      if(auth::check() == false){
          Session::put('loginSession','fail');
          return redirect() -> route('adminsignin');
      }
      else{

        Cart::instance('QuickOrderedBqt_Flowers')->destroy();
        Cart::instance('QuickOrderedBqt_Acessories')->destroy();

        Session::put('QuickBqtClearSession', 'Successful');
                return redirect()-> back();
        //returns to the creation of flowers
      }
    }//end of function


    	public function saveNewCustomized_Bqt(){
            if(auth::check() == false){
                Session::put('loginSession','fail');
                return redirect() -> route('adminsignin');
            }
            else{
    			$AvailableFlowers = DB::select('call wonderbloomdb2.Viewing_Flowers_With_UpdatedPrice()');

    				$BQT_Flower_Count = 0;
    				foreach(Cart::instance('QuickOrderedBqt_Flowers')->content() as $row){
    						$BQT_Flower_Count += $row->qty;
    				}

    			    $Flowers_subtotal = str_replace(array(','), array(''), Cart::instance('QuickOrderedBqt_Flowers')->subtotal());

    	            $Acessories_subtotal = str_replace(array(','), array(''), Cart::instance('QuickOrderedBqt_Acessories')->subtotal());

    	            $BQT_Price = $Acessories_subtotal + $Flowers_subtotal;

    				if(Cart::instance('QuickOrdered_Bqt')->count() == 0){
    						$bqt_Id = mt_rand();//generates a random id
    						$bqtName = 'BQT_'.$bqt_Id;
    						Cart::instance('QuickOrdered_Bqt')
    				         ->add(['id' => $bqt_Id, 'name' => $bqtName, 'qty' => 1, 'price' => $BQT_Price,
    				         		'options' => ['count' => $BQT_Flower_Count]]);

    				        foreach(Cart::instance('QuickOrderedBqt_Flowers')->content() as $row){
    						    //this foreach will transafer all of their content to another session
    			                Cart::instance('QuickFinalBqt_Flowers')
    			                ->add(['id' => $row->id, 'name' => $row->name, 'qty' => $row->qty, 'price' => $row->price,'options' => ['orig_price' => $row->options['orig_price'],'T_Amt' => $row->options['T_Amt'],'image'=>$row->options['image'],
                          'priceType'=>$row->options['priceType'], 'bqt_ID' => $bqt_Id]]);
    				        }//END OF INNER FOREACH of flower cart

    				        foreach(Cart::instance('QuickOrderedBqt_Acessories')->content() as $Acrow){
    					        Cart::instance('QuickFinalBqt_Acessories')
    		                		->add(['id' => $Acrow->id, 'name' => $Acrow->name, 'qty' => $Acrow->qty, 'price' => $Acrow->price,'options' => ['orig_price' => $Acrow->options['orig_price'],'T_Amt' => $Acrow->options['T_Amt'],'image'=>$Acrow->options['image'],'priceType'=>$Acrow->options['priceType'],'bqt_ID' => $bqt_Id]]);
    				        }//end of foreach of the acessories cart
    				}//end of if
    				else{
    					$newBqt_Id = '';
    					foreach(Cart::instance('QuickOrdered_Bqt')->content() as $row){
    						$newBqt_Id = $row->id;
    					}
    					$newBqt_Id += 1;
    					$newBqtName = 'BQT_'.$newBqt_Id;
    						Cart::instance('QuickOrdered_Bqt')
    				         ->add(['id' => $newBqt_Id, 'name' => $newBqtName, 'qty' => 1, 'price' => $BQT_Price,
    				         		'options' => ['count' => $BQT_Flower_Count]]);

    				        foreach(Cart::instance('QuickOrderedBqt_Flowers')->content() as $row){
    						    //this foreach will transafer all of their content to another session
    			                Cart::instance('QuickFinalBqt_Flowers')
    			                ->add(['id' => $row->id, 'name' => $row->name, 'qty' => $row->qty, 'price' => $row->price,'options' => ['orig_price' => $row->options['orig_price'],'T_Amt' => $row->options['T_Amt'],'image'=>$row->options['image'],'priceType'=>$row->options['priceType'], 'bqt_ID' => $newBqt_Id]]);
    				        }//END OF INNER FOREACH of flower cart

    				        foreach(Cart::instance('QuickOrderedBqt_Acessories')->content() as $Acrow){
    					        Cart::instance('QuickFinalBqt_Acessories')
    		                		->add(['id' => $Acrow->id, 'name' => $Acrow->name, 'qty' => $Acrow->qty, 'price' => $Acrow->price,'options' => ['orig_price' => $Acrow->options['orig_price'],'T_Amt' => $Acrow->options['T_Amt'],'image'=>$Acrow->options['image']
                            ,'priceType'=>$Acrow->options['priceType'],'bqt_ID' => $newBqt_Id]]);
    						}//end of foreach of the acessories cart
    					}//end of else

    			Cart::instance('QuickOrderedBqt_Flowers')->destroy();
    			Cart::instance('QuickOrderedBqt_Acessories')->destroy();
    	        Session::put('Save_Bouqet_To_myQuickOrder', 'Successful');
              return redirect()-> back();
        }
    	}//end of function

      public function Delete_Bouquet($Bouquet_ID){
        foreach(Cart::instance('QuickOrdered_Bqt')->content() as $Bqt){
          if($Bqt->id == $Bouquet_ID){
            Cart::instance('QuickOrdered_Bqt')
            ->remove($Bqt->rowId);
          }
        }

        foreach(Cart::instance('QuickFinalBqt_Flowers')->content() as $Flwr){
          if($Flwr->options->bqt_ID == $Bouquet_ID){
            Cart::instance('QuickFinalBqt_Flowers')
            ->remove($Flwr->rowId);
          }
        }//

        foreach(Cart::instance('QuickFinalBqt_Acessories')->content() as $Acrs){
          if($Acrs->options->bqt_ID == $Bouquet_ID){
            Cart::instance('QuickFinalBqt_Acessories')
            ->remove($Acrs->rowId);
          }
        }//

        Session::put('Deleted_BouquetFrom_QuickOrder', 'Successful');
        return redirect()->back();
      }


      public function PrintReciept($id){

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
        $current = Carbon::now('Asia/Manila');


                $NewSalesOrder = sales_order::find($id);
                //$NewSalesOrder_details = Neworder_details::find($id);
                $SalesOrder_flowers = DB::select('CALL show_sales_Orders_Flowers(?)',array($id));


                $NewOrder_Bouquet = DB::table('sales_order_bouquet')
                                            ->where('Order_ID', $id)
                                            ->get();

                $SalesOrder_Bqtflowers = DB::select('CALL show_SalesOrder_Bqt_Flowers(?)',array($id));

                $SalesOrder_BqtAccessories = DB::select('CALL show_SalesOrder_Bqt_Accessories(?)',array($id));

                //dd($NewOrder_SchedDetails);
                /*  $pdf = PDF::loadView("reports\QuickOrder_Reciept",['NewSalesOrder'=>$NewSalesOrder,'InvoiceDetails'=>$InvoiceDetails,
                  'SalesOrder_flowers'=>$SalesOrder_flowers,'NewOrder_Bouquet'=>$NewOrder_Bouquet,
                  'SalesOrder_Bqtflowers'=>$SalesOrder_Bqtflowers,'SalesOrder_BqtAccessories'=>$SalesOrder_BqtAccessories]);
*/
                  //return $pdf->stream();
                //  return $pdf->download('ORDR_'.$id.'_'.$current.'Reciept.pdf');
                  return PDF::loadView("reports\QuickOrder_Reciept",['NewSalesOrder'=>$NewSalesOrder,'InvoiceDetails'=>$InvoiceDetails,
                  'SalesOrder_flowers'=>$SalesOrder_flowers,'NewOrder_Bouquet'=>$NewOrder_Bouquet,
                  'SalesOrder_Bqtflowers'=>$SalesOrder_Bqtflowers,'SalesOrder_BqtAccessories'=>$SalesOrder_BqtAccessories])
                  ->download('ORDR_'.$id.'_'.$current.'Reciept.pdf');

                //
      }
}
