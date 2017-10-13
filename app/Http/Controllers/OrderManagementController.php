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

class OrderManagementController extends Controller
{

  public function show_debts($id){
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

    return view('Orders.Manage_Payment_forDebts')
    ->with('cust',$customer)
    ->with('city',$cityname)
    ->with('prov',$provname)
    ->with('b_Orders',$balanced)
    ->with('debt',$debt);
    //to be continued
  }

  public function Show_Specific_customerWith_Debt($id){
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

  public function ShowSpecific_Confirmed_Orders($id,$type){
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
      ->with('Bqt_Acrs',$SalesOrder_BqtAccessories);
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

              return $pdf->download('sampleDelivery.pdf');
              return $pdf->download('sampleDelivery.pdf');

            //
  }


  public function ViewOrderSummary()
  {
    //for showing the checkout options of the order
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

    public function DeleteFlower_per_Order($flower_ID)
	{
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
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
}
    public function DeleteFlower_per_Bqt_Order($flower_ID,$order_ID)
	{
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{*/
			echo $flower_ID;
			foreach(Cart::instance('OrderedBqt_Flowers')->content() as $row){
				if($row->id == $flower_ID){
					echo $row->id;
					Cart::instance('OrderedBqt_Flowers')->remove($row->rowId);
		        	Session::put('Deleted_FlowerfromBQT_Order', 'Successful');
				}
			}
			return redirect()->route('Order.CreateaBouquet', $order_ID);//returns to the creation of flowers
		//}
	}//end of function
}
	public function DeleteFlower_per_Bqt_SessionOrder($flower_ID)
	{
        /*if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{*/
			echo $flower_ID;
			foreach(Cart::instance('OrderedBqt_Flowers')->content() as $row){
				if($row->id == $flower_ID){
					echo $row->id;
					Cart::instance('OrderedBqt_Flowers')->remove($row->rowId);
		        	Session::put('Deleted_FlowerfromBQT_Order', 'Successful');
				}
			}
			//echo 'hahaah';
          return redirect()-> route('Long_Sales_Order.index');
          //return redirect()->route('Order.CustomizeaBouquet');
	    //}
	}//end of function

}
    public function DeleteAcessory_per_Bqt_Order($Acessory_ID,$order_ID)
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
			return redirect()->route('Order.CreateaBouquet', $order_ID);//returns to the creation of flowers*/
		//}
	}//end of function

}
    public function DeleteAcessory_per_SessionBqt_Order($Acessory_ID)
	{
    if(auth::check() == false){
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
		/*if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{*/
			$AvailableFlowers = DB::select('call wonderbloomdb2.Viewing_Flowers_With_UpdatedPrice()');

			Cart::instance('OrderedBqt_Flowers')->destroy();

			Session::put('Buquet_Cancelation', 'Successful');
	    	 return view('Orders.creationOfOrders')
	     	->with('FlowerList',$AvailableFlowers);
	     //}

	}//end of function

}
	public function Cancel_and_Clear_Bqt_Order()
	{
		/*if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');//
      }
        else{
			$AvailableFlowers = DB::select('call wonderbloomdb2.Viewing_Flowers_With_UpdatedPrice()');

			Cart::instance('OrderedBqt_Flowers')->destroy();
			Cart::instance('OrderedBqt_Acessories')->destroy();

			Session::put('Buquet_Cancelation', 'Successful');
			return redirect()->route('Sales_Qoutation.show');//returns to the creation of flowers
		//}
	}//end of function
}
	public function Cancel_and_Clear_BqtSession_Order()
	{
    if(auth::check() == false){
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
     if(auth::check() == false){
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
      if(auth::check() == false){
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
    if(auth::check() == false){
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
        if(auth::check() == false){
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
	{//
		/*if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{*/

	          $cities = DB::table('cities')
	          ->select('*')
	          ->get();

	          $province = DB::table('provinces')
	          ->select('*')
	          ->get();

	        return view('Orders.confirmation_of_Order')
			->with('city',$cities)
	        ->with('province',$province);
    	//}
	}//end of function
}
	public function return_to_CreationOfOrder()
	{//
       if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
			       $AvailableFlowers = DB::select('call wonderbloomdb2.Viewing_Flowers_With_UpdatedPrice()');

			          return view('Orders.creationOfOrders')
	     	         ->with('FlowerList',$AvailableFlowers);
	     }
	}//end of function

}
