<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use \Cart;
use App\bouquet_details;
use Session;
use Auth;
class OrderManagementController extends Controller
{
    //

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
    ->with('provinces',$province)
    ->with('city2',$cities)
    ->with('province',$province);

  }

    public function DeleteFlower_per_Order($flower_ID)
	{
        /*if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
	   else{*/
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
			return redirect()->route('Order.CreateaBouquet', $order_ID);//returns to the creation of flowers
		//}
	}//end of function

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


    public function DeleteAcessory_per_Bqt_Order($Acessory_ID,$order_ID)
	{
        /*if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{*/
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


    public function DeleteAcessory_per_SessionBqt_Order($Acessory_ID)
	{
        /*if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{*/
			echo $Acessory_ID;
			foreach(Cart::instance('OrderedBqt_Acessories')->content() as $row){
				if($row->id == $Acessory_ID){
					Cart::instance('OrderedBqt_Acessories')->remove($row->rowId);
					Session::put('Deleted_AcessoryfromBQT_Order', 'Successful');
				}
			}
      return redirect()-> route('Long_Sales_Order.index');

	     //   return redirect()->route('Order.CustomizeaBouquet');
			//returns to the creation of bouquet*/
    	//}
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


	public function Cancel_and_Clear_Bqt_Order()
	{
		/*if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');//
        else{*/
			$AvailableFlowers = DB::select('call wonderbloomdb2.Viewing_Flowers_With_UpdatedPrice()');

			Cart::instance('OrderedBqt_Flowers')->destroy();
			Cart::instance('OrderedBqt_Acessories')->destroy();

			Session::put('Buquet_Cancelation', 'Successful');
			return redirect()->route('Sales_Qoutation.show');//returns to the creation of flowers
		//}
	}//end of function

	public function Cancel_and_Clear_BqtSession_Order()
	{
        /*if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{*/
	        $AvailableFlowers = DB::select('call wonderbloomdb2.Viewing_Flowers_With_UpdatedPrice()');

			Cart::instance('OrderedBqt_Flowers')->destroy();
			Cart::instance('OrderedBqt_Acessories')->destroy();
			Cart::instance('Ordered_Bqt')->destroy();

			Session::put('Buquet_Cancelation', 'Successful');
			     return view('Orders.creationOfOrders')
	             ->with('FlowerList',$AvailableFlowers);
			return redirect()->route('Sales_Qoutation.show');//returns to the creation of flowers
		//}
	}//end of function


    public function Clear_Cart()
    {
          /*if(auth::check() == false){
              Session::put('loginSession','fail');
              return redirect() -> route('adminsignin');
          }
          else{*/

        Cart::instance('FinalBqt_Flowers')->destroy();
        Cart::instance('FinalBqt_Acessories')->destroy();
        Cart::instance('Ordered_Bqt')->destroy();
        Cart::instance('Ordered_Flowers')->destroy();

        Session::put('CartClearSession', 'Successful');
                return redirect()-> route('Long_Sales_Order.index');
        //returns to the creation of flowers
      //}
    }//end of function


    public function Clear_Bouquet()
    {
          /*if(auth::check() == false){
              Session::put('loginSession','fail');
              return redirect() -> route('adminsignin');
          }
          else{*/

        Cart::instance('OrderedBqt_Flowers')->destroy();
        Cart::instance('OrderedBqt_Acessories')->destroy();

        Session::put('BqtClearSession', 'Successful');
                return redirect()-> route('Long_Sales_Order.index');
        //returns to the creation of flowers
      //}
    }//end of function

	public function saveCustomized_Bqt($order_ID)
	{
        /*if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{*/
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
		//}
	}//end of function




	public function saveNewCustomized_Bqt(){
        /*if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{*/
			$AvailableFlowers = DB::select('call wonderbloomdb2.Viewing_Flowers_With_UpdatedPrice()');

			/*Cart::instance('FinalBqt_Acessories')->destroy();
			Cart::instance('Ordered_Bqt')->destroy();
			Cart::instance('FinalBqt_Flowers')->destroy();*/

				$BQT_Flower_Count = 0;
				foreach(Cart::instance('OrderedBqt_Flowers')->content() as $row){
						$BQT_Flower_Count += $row->qty;
				}

			    $Flowers_subtotal = str_replace(array(','), array(''), Cart::instance('OrderedBqt_Flowers')->subtotal());

	            $Acessories_subtotal = str_replace(array(','), array(''), Cart::instance('OrderedBqt_Acessories')->subtotal());
	 /*           echo '<h2><b>$Flowers_subtotal = </b>'.$Flowers_subtotal.'<\h2>';
	            echo '<h2><b>$Acessories_subtotal = </b>'.$Acessories_subtotal.'<\h2>';
	            echo '<h2><b>BOQUET_total = </b>'.number_format($Acessories_subtotal + $Flowers_subtotal,2).'<\h2>';
	            echo '<h2><b>BOQUET Flower Count = </b>'.$BQT_Flower_Count.' pcs. <\h2>';
	*/

	            $BQT_Price = $Acessories_subtotal + $Flowers_subtotal;

				if(Cart::instance('Ordered_Bqt')->count() == 0){
						$bqt_Id = mt_rand();//generates a random id
						$bqtName = 'BQT_'.$bqt_Id;
						Cart::instance('Ordered_Bqt')
				         ->add(['id' => $bqt_Id, 'name' => $bqtName, 'qty' => 1, 'price' => $BQT_Price,
				         		'options' => ['count' => $BQT_Flower_Count]]);
						/*
				    	foreach(Cart::instance('Ordered_Bqt')->content() as $bqt){
				    		echo '<div class = "row">';
				    		echo '<h1>The Bouquet Detais<h1><hr><br>';
				        	echo '<h2><b> $bqt_ID = </b>'.$bqt->id.'</h2>';
				        	echo '<h4><b> $bqt_name = </b>'.$bqt->name.'</h4>';
				        	echo '<h4><b> $bqt_qty = </b>'.$bqt->qty.'</h4>';
				        	echo '<h4><b> $bqt_price = </b>'.$bqt->price.'</h4>';
				        	echo '<h4><b> $bqt_count = </b>'.$bqt->options['count'].'</h4>';
				        	echo '</div>';
				    	}  */

				        foreach(Cart::instance('OrderedBqt_Flowers')->content() as $row){
						    //this foreach will transafer all of their content to another session
			                Cart::instance('FinalBqt_Flowers')
			                ->add(['id' => $row->id, 'name' => $row->name, 'qty' => $row->qty, 'price' => $row->price,'options' => ['orig_price' => $row->options['orig_price'],'T_Amt' => $row->options['T_Amt'],'image'=>$row->options['image'],
                      'priceType'=>$row->options['priceType'], 'bqt_ID' => $bqt_Id]]);
				        }//END OF INNER FOREACH of flower cart

				       /* foreach(Cart::instance('FinalBqt_Flowers')->content() as $row){
				        	echo '<div class = "row">';
				        	echo '<div class = "col-md-5">';
				        	echo '<h2><b> Flwr_ID = </b>'.$row->id.'</h2>';
				        	echo '<h4><b> Flwr_name = </b>'.$row->name.'</h4>';
				        	echo '<h4><b> Flwr_qty = </b>'.$row->qty.'</h4>';
				        	echo '<h4><b> Flwr_price = </b>'.$row->price.'</h4>';
				        	echo '</div>';
				        	echo '<div class = "col-md-6">';
				        	echo '<h2><b> Flwr_o_price = </b>'.$row->options['orig_price'].'</h2>';
				        	echo '<h4><b> Flwr_image = </b>'.$row->options['image'].'</h4>';
				        	echo '<h4><b> Flwr_type = </b>'.$row->options['priceType'].'</h4>';
				        	echo '<h4><b> Flwr_T_Amt = </b>'.$row->options['T_Amt'].'</h4>';
				        	echo '<h4><b> Flwr_bqtID = </b>'.$row->options['bqt_ID'].'</h4>';
				        	echo '</div>';
				        	echo '</div>';
				        	echo '<hr><br>';
				        }
				        echo '<br><hr><br>';*/
				        foreach(Cart::instance('OrderedBqt_Acessories')->content() as $Acrow){
					        Cart::instance('FinalBqt_Acessories')
		                		->add(['id' => $Acrow->id, 'name' => $Acrow->name, 'qty' => $Acrow->qty, 'price' => $Acrow->price,'options' => ['orig_price' => $Acrow->options['orig_price'],'T_Amt' => $Acrow->options['T_Amt'],'image'=>$Acrow->options['image'],'priceType'=>$Acrow->options['priceType'],'bqt_ID' => $bqt_Id]]);
				        }//end of foreach of the acessories cart


				        /*
				        foreach(Cart::instance('FinalBqt_Acessories')->content() as $Acrow2){
				        	echo '<div class = "row">';
				        	echo '<div class = "col-md-5">';
				        	echo '<h2><b> Acrs_ID = </b>'.$Acrow2->id.'</h2>';
				        	echo '<h4><b> Acrs_name = </b>'.$Acrow2->name.'</h4>';
				        	echo '<h4><b> Acrs_qty = </b>'.$Acrow2->qty.'</h4>';
				        	echo '<h4><b> Acrs_price = </b>'.$Acrow2->price.'</h4>';
				        	echo '</div>';
				        	echo '<div class = "col-md-6">';
				        	echo '<h2><b> Acrs_o_price = </b>'.$Acrow2->options['orig_price'].'</h2>';
				        	echo '<h4><b> Acrs_image = </b>'.$Acrow2->options['image'].'</h4>';
				        	echo '<h4><b> Acrs_type = </b>'.$Acrow2->options['priceType'].'</h4>';
				        	echo '<h4><b> Acrs_T_Amt = </b>'.$Acrow2->options['T_Amt'].'</h4>';
				        	echo '<h4><b> Acrs_bqtID = </b>'.$Acrow2->options['bqt_ID'].'</h4>';
				        	echo '</div>';
				        	echo '</div>';
				        	echo '<hr><br>';
				        }
				    	*/
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

				       /* foreach(Cart::instance('Ordered_Bqt')->content() as $bqt){
				    		echo '<div class = "row">';
				    		echo '<h1>The Bouquet Detais<h1><hr><br>';
				        	echo '<h2><b> $bqt_ID = </b>'.$bqt->id.'</h2>';
				        	echo '<h4><b> $bqt_name = </b>'.$bqt->name.'</h4>';
				        	echo '<h4><b> $bqt_qty = </b>'.$bqt->qty.'</h4>';
				        	echo '<h4><b> $bqt_price = </b>'.$bqt->price.'</h4>';
				        	echo '<h4><b> $bqt_count = </b>'.$bqt->options['count'].'</h4>';
				        	echo '</div>';
				    	}     */

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
        //return view('Orders.creationOfOrders')
	     	//->with('FlowerList',$AvailableFlowers);//returns to the creation of orders
     //}
	}//end of function



	public function ConfrimOrder()
	{//
		/*if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{*/
			/*$order_Details = DB::select('CALL salesorder_details(?)',array($order_ID));
			$salesorder_Acessories = DB::select('CALL acessories_per_Specifici_Order(?);',array($order_ID));
			$salesorder_Bouquet = DB::select('CALL salesorder_Bouquet(?)',array($order_ID));
			$flowers_per_specific_BQTorder = DB::select('CALL flowers_per_specific_BQTorder(?)',array($order_ID));
			$salesorder_Flowers = DB::select('CALL salesorder_Flowers(?)',array($order_ID));
	          $Total_AmtBQT = DB::table('sales_order_bouquet')
	          ->select(DB::raw('SUM(Unit_Price*QTY) as Amt'))
	          ->where('Order_ID','=',$order_ID)
	          ->get();

	          $Total_AmtFLWR = DB::table('sales_order_flowers')
	          ->select(DB::raw('SUM(Unit_Price*QTY) as Amt'))
	          ->where('Sales_Order_ID','=',$order_ID)
	          ->get();
	*/
	          $cities = DB::table('cities')
	          ->select('*')
	          ->get();

	          $province = DB::table('provinces')
	          ->select('*')
	          ->get();

			//return view('Orders.newConfirmation_of_Order');
			/*return view('Orders.confirmation_of_Order')
			->with('Total_AmtFLWR',$Total_AmtFLWR)
			->with('Total_AmtFLWR1',$Total_AmtFLWR)
			->with('Total_AmtBQT',$Total_AmtBQT)
			->with('Total_AmtBQT1',$Total_AmtBQT)
			->with('Flwr',$salesorder_Flowers)
			->with('Bqt',$salesorder_Bouquet)
			->with('Bqt_F',$flowers_per_specific_BQTorder)
			->with('Order_det',$order_Details)
			->with('Acrs',$salesorder_Acessories)
			->with('city',$cities)
	        ->with('province',$province);*/
	        return view('Orders.confirmation_of_Order')
			->with('city',$cities)
	        ->with('province',$province);
    	//}
	}//end of function

	public function return_to_CreationOfOrder()
	{//
       /* if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{*/
			$AvailableFlowers = DB::select('call wonderbloomdb2.Viewing_Flowers_With_UpdatedPrice()');

			return view('Orders.creationOfOrders')
	     	->with('FlowerList',$AvailableFlowers);
	     //}
	}//end of function

}
