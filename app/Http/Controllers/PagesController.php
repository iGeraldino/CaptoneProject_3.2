<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Auth;
use Session;
use Charts;

use App\sales_order;
use App\shop_schedule;
use App\order_details;
use App\sales_order_flowers;
use App\bouquet_details;
use App\bouquet_flowers;
use App\bouquet_acessories;
use App\sales_order_bouquet;
use App\sales_order_bouquet_flowers;
use App\sales_order_acessories;
use App\Neworder_details;

use Carbon\Carbon;

class PagesController extends Controller
{
    //
	public function getSupplierList() {

		if(auth::guard('admins')->user()->type == '1'){
			if(auth::guard('admins')->check() == false){
							Session::put('loginSession','fail');
							return redirect() -> route('adminsignin');
					}
					else{
				return view('supplier/supplierlist');
			}
		}
		elseif (Auth::guard('admins')->user()->type == '2') {
			return redirect()->route('cashierdashboard');
		}
		elseif (Auth::guard('admins')->user()->type == '3') {

							return redirect()->route('warehousedashboard');
		}


	}
	public function getSupplierMoreDetails() {

				if(auth::guard('admins')->user()->type == '1'){
					if(auth::guard('admins')->check() == false){
			            Session::put('loginSession','fail');
			            return redirect() -> route('adminsignin');
			        }
			        else{
						return view('supplier/suppliermoredetails');
					}

					Session::put('Add_FlowertoSupplierSession','Successful');
			        return back();

				}
				elseif (Auth::guard('admins')->user()->type == '2') {
								return redirect()->route('cashierdashboard');
				}
				elseif (Auth::guard('admins')->user()->type == '3') {

									return redirect()->route('warehousedashboard');
				}

	}

	public function getCustomerList() {

				if(auth::guard('admins')->user()->type == '1'){
					if(auth::guard('admins')->check() == false){
							 Session::put('loginSession','fail');
							 return redirect() -> route('adminsignin');
					 }
					 else{
				 return view('customer/customerlist');
			 }
				}
				elseif (Auth::guard('admins')->user()->type == '2') {

									return redirect()->route('cashierdashboard');
				}
				elseif (Auth::guard('admins')->user()->type == '3') {

									return redirect()->route('warehousedashboard');
				}

		}//

	public function getSupplierPriceList() {

				if(auth::guard('admins')->user()->type == '1'){
					if(auth::guard('admins')->check() == false){
						 Session::put('loginSession','fail');
						 return redirect() -> route('adminsignin');
				 }
				 else{
			 return view('supplier/supplierpricelist');
		 }
				}
				elseif (Auth::guard('admins')->user()->type == '2') {
								return redirect()->route('cashierdashboard');
				}
				elseif (Auth::guard('admins')->user()->type == '3') {

									return redirect()->route('warehousedashboard');
				}

		}

	public function getAddingTradeAgreement() {

				if(auth::guard('admins')->user()->type == '1'){
					if(auth::guard('admins')->check() == false){
							Session::put('loginSession','fail');
							return redirect() -> route('adminsignin');
					}
					else{
				return view('customer/adding_tradeagreement');
			}
				}
				elseif (Auth::guard('admins')->user()->type == '2') {
								return redirect()->route('cashierdashboard');
				}
				elseif (Auth::guard('admins')->user()->type == '3') {

									return redirect()->route('warehousedashboard');
				}

		}//
	public function getCustomerTradeAgreement() {

				if(auth::guard('admins')->user()->type == '1'){
					if(auth::guard('admins')->check() == false){
							Session::put('loginSession','fail');
							return redirect() -> route('adminsignin');
					}
					else{
				return view('customer/customer_trade_agreement');
			}
				}
				elseif (Auth::guard('admins')->user()->type == '2') {
			return redirect()->route('cashierdashboard');
				}
				elseif (Auth::guard('admins')->user()->type == '3') {

									return redirect()->route('warehousedashboard');
				}

	}//

	public function getSpecificCustomerAgreement() {

				if(auth::guard('admins')->user()->type == '1'){
					if(auth::guard('admins')->check() == false){
            	Session::put('loginSession','fail');
            	return redirect() -> route('adminsignin');
        	}
        	else{
				return view('customer/specific_customer_agreement');
			}
				}
				elseif (Auth::guard('admins')->user()->type == '2') {
			return redirect()->route('cashierdashboard');
				}
				elseif (Auth::guard('admins')->user()->type == '3') {

									return redirect()->route('warehousedashboard');
				}

		}

	public function getOtherViewOfCustAgreement() {

				if(auth::guard('admins')->user()->type == '1'){
					if(auth::guard('admins')->check() == false){
									Session::put('loginSession','fail');
									return redirect() -> route('adminsignin');
							}
							else{
						return view('customer/other_viewofcustagreement');
						}

				}
				elseif (Auth::guard('admins')->user()->type == '2') {
			return redirect()->route('cashierdashboard');
				}
				elseif (Auth::guard('admins')->user()->type == '3') {

									return redirect()->route('warehousedashboard');
				}

		}

	public function getInventoryTransaction() {

				if(auth::guard('admins')->user()->type == '1'){
					if(auth::guard('admins')->check() == false){
									Session::put('loginSession','fail');
									return redirect() -> route('adminsignin');
							}
					 else{
						return view('inventory/inventorytransaction');
					}
				}
				elseif (Auth::guard('admins')->user()->type == '2') {
			return redirect()->route('cashierdashboard');
				}
				elseif (Auth::guard('admins')->user()->type == '3') {

									return redirect()->route('warehousedashboard');
				}

		}

	public function getDashboard() {

				if(auth::guard('admins')->user()->type == '1'){

/*			$charts = Charts::new('line','highcharts')
			->setTitle('My website users')
			->setLabels('ES','FR','RU')
			->setValues(100,50,25)
			->setElementLabel("Total Users");
*/
		$spoiledFlowers = DB::select('CALL spoiledFlowr_percentage()');
		$soldFlowers = DB::select('CALL percentageSold()');
		$orderscount = DB::select("SELECT COUNT(*) as 'count' from sales_order
    WHERE Status IN ('PENDING','pending')");

			/*			$charts = Charts::new('line','highcharts')
						->setTitle('My website users')
						->setLabels('ES','FR','RU')
						->setValues(100,50,25)
						->setElementLabel("Total Users");
			*/
					$orderscount = DB::select("SELECT COUNT(*) as 'count' from sales_order
					WHERE Status IN ('PENDING','pending')");

					$cust_Account = DB::select("SELECT COUNT(*) as 'count' FROM users");

						//dd($orderscount);

						$Pending_salesOrders = DB::table('sales_order')
						->select('*')
						->where('Status','PENDING')
						->get();

						$arriving = DB::select('CALL view_Arriving_Inventory()');

						$CriticalFLowers = DB::select('CALL viewCritical_FLowersQuantity()');

			$order_Paid = DB::select('CALL fullyPaid_Orders()');
			$orderWith_Bal = DB::select('CALL withBalance_Orders()');
			//
			$SpoiledFLowers = DB::select('CALL Spoiled_Flowers()');
			return view('dashboard')
			 ->with('spoiledFlowers',$spoiledFlowers)
			 ->with('soldFlowers',$soldFlowers)
			 ->with('cust_Account',$cust_Account)
			 ->with('orderscount',$orderscount)
			 ->with('p_Orders',$order_Paid)
			 ->with('b_Orders',$orderWith_Bal)
			 ->with('debtors',$Customers_WithDebts)
			 ->with('tobeAcquired',$tobeAcquired_Orders)
			 ->with('CriticalFLowers',$CriticalFLowers)
       ->with('arriving',$arriving)
			 ->with('Porders',$Pending_salesOrders)
			 ->with('SpoiledFLowers',$SpoiledFLowers);
			 //->with('charts',$charts);
		}

				elseif (Auth::guard('admins')->user()->type == '2') {
			return redirect()->route('cashierdashboard');
				}
				elseif (Auth::guard('admins')->user()->type == '3') {
								return redirect()->route('warehousedashboard');
				}



		}

	public function getHome() {

			$flowers = db::table('sales_order_flowers')
								->join('sales_order_bouquet_flowers', 'sales_order_flowers.Flower_ID', '=' ,'sales_order_bouquet_flowers.Flower_ID')
								->select('sales_order_flowers.Flower_ID', Db::raw('sum(sales_order_flowers.QTY) as Quantity'))
								->groupBy('sales_order_flowers.Flower_ID')
								->orderBy('sales_order_flowers.QTY', 'asc')
								->take(6)
								->get();


			$flowprice = db::select("call Viewing_Flowers_With_UpdatedPrice()");


			session::remove('orderid');


			return view('customer_side/pages/home')->with(['flowers' => $flowers, 'flowprice' => $flowprice]);

		}

		public function getFlowers() {
			return view('customer_side/pages/flower');
		}

		public function getBouquets() {
			return view('customer_side/pages/bouquet');
		}

		public function getDeco() {
			return view('customer_side/pages/deco');
		}

		public function getCart() {
			return view('customer_side/pages/cart');
		}

		public function getCheckout() {
		  		$cities = DB::table('cities')
          ->select('*')
          ->get();

          $province = DB::table('provinces')
          ->select('*')
          ->get();

			return view('customer_side/pages/checkout')
				->with('city3',$cities)
        		->with('province3',$province)
				->with('city2',$cities)
        		->with('province2',$province)
				->with('city',$cities)
        		->with('province',$province);
		}

		public function getAbout() {
			return view('customer_side/pages/about');
		}

		public function getContact() {
			return view('customer_side/pages/contact');
		}

		public function getLogin() {
			return view('customer_side/pages/loginx');
		}

		public function getRegister() {

              $cities = DB::table('cities')
              ->select('*')
              ->get();

              $province = DB::table('provinces')
              ->select('*')
              ->get();

			return view('customer_side/pages/register')
			  ->with('city',$cities)
              ->with('province',$province);
		}

		public function getWedding() {
			return view('customer_side/pages/wedding');
		}
		public function getProductDetail() {
			return view('customer_side/pages/productdetail');
		}

		public function getCreateBouquet() {
			return view('customer_side/pages/create_bouquet');
		}

	public function getLoginPage() {

        $admin = auth() ->guard('admins');


            if($admin->check() == true){
                return redirect()->route('dashboard');

            }
            else{
                return view('login/login_page');
            }
		}

	public function getQuickOrder() {
			return view('orders/quickorder');
		}

	public function getLongOrder() {
			return view('orders/longorder');
		}

	public function getOrderSummary() {
			return view('orders/ordersummary');
		}

	public function getShippingMethod() {
			return view('orders/shippingmethod');
		}

	public function getPaymentMethod() {
			return view('orders/paymentmethod');
		}

	public function getFinalOrder() {
			return view('orders/finalorder');
		}

	public function getEditAccount() {
			return view('customer_side/pages/editaccount');
		}

	public function getOrderSummaryPickUp() {
			return view('reports/OrderSummary_PickUP');
		}

	public function getOrderSummaryDelivery() {
			return view('reports/OrderSummary_Delivery');
		}

		//Cashier
	public function getCashierPage() {
			return view('cashier/pages/cashierpage');
		}

	public function getCashierDashboard() {

			if (Auth::guard('admins')->user()->type == '2') {




			$Pending_salesOrders = DB::table('sales_order')
			->select('*')
			->where('Status','PENDING')
			->get();

			$arriving = DB::select('CALL view_Arriving_Inventory()');

			$CriticalFLowers = DB::select('CALL viewCritical_FLowersQuantity()');

			$tobeAcquired_Orders = DB::select('CALL view_Orders_tobeReleased_within24hrs()');
			$Customers_WithDebts = DB::select('CALL show_Customers_With_Debt()');

			$order_Paid = DB::select('CALL fullyPaid_Orders()');
			$orderWith_Bal = DB::select('CALL withBalance_Orders()');
			//
			$SpoiledFLowers = DB::select('CALL Spoiled_Flowers()');
			return view('cashier/pages/cashier_dashboard')
			 ->with('p_Orders',$order_Paid)
			 ->with('b_Orders',$orderWith_Bal)
			 ->with('debtors',$Customers_WithDebts)
			 ->with('tobeAcquired',$tobeAcquired_Orders)
			 ->with('CriticalFLowers',$CriticalFLowers)
       ->with('arriving',$arriving)
			 ->with('Porders',$Pending_salesOrders)
			 ->with('SpoiledFLowers',$SpoiledFLowers);
			 //->with('charts',$charts);

		 }
		 elseif (Auth::guard('admins')->user()->type == '1') {
			 return redirect()->route('dashboard');

		 }
		 elseif (Auth::guard('admins')->user()->type == '3') {
			 return redirect()->route('warehousedashboard');
		 }
		}

	public function getCashierSalesOrder() {
			$cities = DB::table('cities')
              ->select('*')
              ->get();

            $province = DB::table('provinces')
              ->select('*')
              ->get();

            $ClosedsalesOrders = DB::table('sales_order')
            ->select('*')
            ->where('Status','CLOSED')
            ->get();

            $Pending_salesOrders = DB::table('sales_order')
            ->select('*')
            ->where('Status','PENDING')
            ->get();

            $Confirmed_salesOrders = DB::select('CALL confirmed_Orders()');

            $customers = DB::table('customer_details')
            ->select('*')
            ->get();



            //
            return view('cashier/pages/cashier_sales_order')
            ->with('Dorders',$ClosedsalesOrders)
            ->with('Porders',$Pending_salesOrders)
            ->with('Corders',$Confirmed_salesOrders)
            ->with('cust',$customers)
            ->with('city',$cities)
            ->with('city2',$cities)
            ->with('province',$province);

						if (Auth::guard('admins')->user()->type == '2') {

					 }
					 elseif (Auth::guard('admins')->user()->type == '1') {
						 return redirect()->route('dashboard');

					 }
					 elseif (Auth::guard('admins')->user()->type == '3') {
						 return redirect()->route('warehousedashboard');
					 }
		}

	public function getCashierQuickOrder() {

		if (Auth::guard('admins')->user()->type == '2') {
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

				$batches_ofFlowers = DB::select('CALL breakdownBatchOf_Available_Flowers()');

				//dd($batches_ofFlowers);

				$AvailableFlowers = DB::select('call wonderbloomdb2.Viewing_AvailableFlowers_With_UpdatedPrice()');

				$accessories = DB::select('CALL AvailableAcessories_Records()');

				$CustWith_TradeAgreement = DB::select("call View_Customers_withAgreement()");



				return view('cashier/pages/cashier_quick_order')
				->with('batches',$batches_ofFlowers)
				->with('CustTradeAgreements',$CustWith_TradeAgreement)
				->with('orders',$salesOrders)
				->with('cust',$customers)
				->with('city',$cities)
				->with('city2',$cities)
				->with('province',$province)
				->with('accessories',$accessories)
				->with('FlowerList',$AvailableFlowers);


		}
		elseif (Auth::guard('admins')->user()->type == '1') {
		return redirect()->route('dashboard');

		}
		elseif (Auth::guard('admins')->user()->type == '3') {
		return redirect()->route('warehousedashboard');
		}
		}

	public function getCashierLongOrder() {
		if (Auth::guard('admins')->user()->type == '2') {
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
						$accessories = DB::select('CALL Acessories_Records()');

						//
						return view('cashier/pages/cashier_long_order')
						->with('orders',$salesOrders)
						->with('cust',$customers)
						->with('city',$cities)
						->with('city2',$cities)
						->with('province',$province)
						->with('accessories',$accessories)
						->with('FlowerList',$AvailableFlowers);

		}
		elseif (Auth::guard('admins')->user()->type == '1') {
		return redirect()->route('dashboard');

		}
		elseif (Auth::guard('admins')->user()->type == '3') {
		return redirect()->route('warehousedashboard');
		}
	}

	public function getCashierCustomerList() {

		if (Auth::guard('admins')->user()->type == '2') {
			$cities = DB::table('cities')
					->select('*')
					->get();

					$province = DB::table('provinces')
					->select('*')
					->get();

				$customerDetails = DB::select('CALL showCustomerdetails_WithoutAcct()');
				$custAccts = DB::select('CALL showCustomerswith_ExistingAccts()');

				return view('cashier/pages/cashier_customer_list')
				->with('accts',$custAccts)
				->with('customers',$customerDetails)
				->with('city',$cities)
				->with('province',$province);

		}
		elseif (Auth::guard('admins')->user()->type == '1') {
		return redirect()->route('dashboard');

		}
		elseif (Auth::guard('admins')->user()->type == '3') {
		return redirect()->route('warehousedashboard');
		}
	}
	public function getCashierCustomerTradeAgreement() {

		if (Auth::guard('admins')->user()->type == '2') {
			$Agreements = DB::select("CALL CustomerWithTradeAgreements()");
						return view('cashier/pages/cashier_customer_trade_agreement')
						->with('agreed',$Agreements);

		}
		elseif (Auth::guard('admins')->user()->type == '1') {
		return redirect()->route('dashboard');

		}
		elseif (Auth::guard('admins')->user()->type == '3') {
		return redirect()->route('warehousedashboard');
		}
	}

	public function getCashierFlowerList() {
		if (Auth::guard('admins')->user()->type == '2') {
			$flower = DB::select('CALL Viewing_Flowers_With_UpdatedPrice()');
					 // dd($flower);
						return view('cashier/pages/cashier_flower_list')
						-> with ('flower', $flower);


		}
		elseif (Auth::guard('admins')->user()->type == '1') {
		return redirect()->route('dashboard');

		}
		elseif (Auth::guard('admins')->user()->type == '3') {
		return redirect()->route('warehousedashboard');
		}
	}

	public function getCashierInventoryTransaction() {
			if (Auth::guard('admins')->user()->type == '2') {
				return view('cashier/pages/cashier_inventory_transaction');

			}
			elseif (Auth::guard('admins')->user()->type == '1') {
			return redirect()->route('dashboard');

			}
			elseif (Auth::guard('admins')->user()->type == '3') {
			return redirect()->route('warehousedashboard');
			}
		}

	public function getCashierFlowerPriceList() {
						if (Auth::guard('admins')->user()->type == '2') {
							$Active_Price = DB::select('CALL active_PriceListmarkup()');
	            $Inactive_Price = DB::select('CALL inactive_PriceListMarkup()');

	            return view('cashier/pages/cashier_flower_price_list')
	            ->with('activePrices',$Active_Price)
	            ->with('inactivePrices',$Inactive_Price);

						}
						elseif (Auth::guard('admins')->user()->type == '1') {
						return redirect()->route('dashboard');

						}
						elseif (Auth::guard('admins')->user()->type == '3') {
						return redirect()->route('warehousedashboard');
						}
		}

		//

	public function getOrderSummaryPickUpDesign() {
			return view('reports/OrderSummary_PickUP_Design');
		}

	public function getOrderSummaryDeliveryDesign() {
			return view('reports/OrderSummary_Delivery_Design');
		}

	public function getInventoryDashboard()
    {

        if (Auth::guard('admins')->user()->type == '3') {


            $Pending_salesOrders = DB::table('sales_order')
                ->select('*')
                ->where('Status', 'PENDING')
                ->get();

            $arriving = DB::select('CALL view_Arriving_Inventory()');

            $CriticalFLowers = DB::select('CALL viewCritical_FLowersQuantity()');

            $tobeAcquired_Orders = DB::select('CALL view_Orders_tobeReleased_within24hrs()');
            $Customers_WithDebts = DB::select('CALL show_Customers_With_Debt()');

            $order_Paid = DB::select('CALL fullyPaid_Orders()');
            $orderWith_Bal = DB::select('CALL withBalance_Orders()');
            //
            $SpoiledFLowers = DB::select('CALL Spoiled_Flowers()');
            return view('inventory_side/pages/inventory_dashboard')
                ->with('p_Orders', $order_Paid)
                ->with('b_Orders', $orderWith_Bal)
                ->with('debtors', $Customers_WithDebts)
                ->with('tobeAcquired', $tobeAcquired_Orders)
                ->with('CriticalFLowers', $CriticalFLowers)
                ->with('arriving', $arriving)
                ->with('Porders', $Pending_salesOrders)
                ->with('SpoiledFLowers', $SpoiledFLowers);
            //->with('charts',$charts);]
        } elseif (Auth::guard('admins')->user()->type == '1') {

            return redirect()->route('dashboard');

        }

        elseif(Auth::guard('admins')->user()->type == '2'){

            return redirect()->route('cashierdashboard');
        }
    }

	public function getInventorySalesOrder() {

		if (Auth::guard('admins')->user()->type == '3') {


	        $cities = DB::table('cities')
              ->select('*')
              ->get();

            $province = DB::table('provinces')
              ->select('*')
              ->get();

            $ClosedsalesOrders = DB::table('sales_order')
            ->select('*')
            ->where('Status','CLOSED')
            ->get();

            $Pending_salesOrders = DB::table('sales_order')
            ->select('*')
            ->where('Status','PENDING')
            ->get();

            $Confirmed_salesOrders = DB::select('CALL confirmed_Orders()');

            $customers = DB::table('customer_details')
            ->select('*')
            ->get();



            //
            return view('inventory_side/pages/inventory_sales_order')
            ->with('Dorders',$ClosedsalesOrders)
            ->with('Porders',$Pending_salesOrders)
            ->with('Corders',$Confirmed_salesOrders)
            ->with('cust',$customers)
            ->with('city',$cities)
            ->with('city2',$cities)
            ->with('province',$province);

				} elseif (Auth::guard('admins')->user()->type == '1') {

						return redirect()->route('dashboard');

				}

				elseif(Auth::guard('admins')->user()->type == '2'){

						return redirect()->route('cashierdashboard');
				}
		}

	public function getInventoryFlowerList() {

			if(Auth::guard('admins')->user()->type == '3'){

			$flower = DB::select('CALL Viewing_Flowers_With_UpdatedPrice()');
           // dd($flower);
            return view('inventory_side/pages/inventory_flower_list')
            -> with ('flower', $flower);
					} elseif (Auth::guard('admins')->user()->type == '1') {

							return redirect()->route('dashboard');

					}

					elseif(Auth::guard('admins')->user()->type == '2'){

							return redirect()->route('cashierdashboard');
					}
		}


	public function getInventorySideTransaction() {
			if(Auth::guard('admins')->user()->type == '3'){
				return view('inventory_side/pages/inventory_side_transaction');

			} elseif (Auth::guard('admins')->user()->type == '1') {

							return redirect()->route('dashboard');

					}

					elseif(Auth::guard('admins')->user()->type == '2'){

							return redirect()->route('cashierdashboard');
					}
		}

	public function getInventorySchedule() {
			if(Auth::guard('admins')->user()->type == '3'){
				return view('inventory_side/pages/inventory_schedule');

			} elseif (Auth::guard('admins')->user()->type == '1') {

							return redirect()->route('dashboard');

					}

					elseif(Auth::guard('admins')->user()->type == '2'){

							return redirect()->route('cashierdashboard');
					}
		}

	public function getInventoryFlowerPriceList() {
			if(Auth::guard('admins')->user()->type == '3'){
				return view('inventory_side/pages/inventory_flower_price_list');

			} elseif (Auth::guard('admins')->user()->type == '1') {

							return redirect()->route('dashboard');

					}

					elseif(Auth::guard('admins')->user()->type == '2'){

							return redirect()->route('cashierdashboard');
					}
		}

	public function getOrderSummaryPickUpSimple() {
			return view('reports/OrderSummary_PickUp_Simple');
		}

	public function getOrderSummaryDeliverySimple() {
			return view('reports/OrderSummary_Delivery_Simple');
		}

	public function getLandingPage() {
			return view('login/landing_page');
		}

	public function getManageAccount() {
			return view('login/manage_account');
		}

	public function getCreateAccount() {
			return view('customer/create_account');
		}



	public function getSalesReport() {
			return view('reports/sales_reports');
		}

	public function getInventoryReportsBatch() {
			return view('reports/inventory_reports_batch');
		}

	public function getSignupPage() {

	        $code = db::table('admins')->select('Random_Code')->get();
            $signcode = "";
            $validator = "";

	        if($code == null){

	            $signcode = "1234";
                $validator = 0;

            }
            else{

	            $signcode = '';
	            $validator = 1;


            }


			return view('login/signup_page')->with(['signcode' => $signcode, 'validator' => $validator]);
		}

	public function getInventoryReportsFlower() {
			return view('reports/inventory_reports_flower');
		}
	public function getOrderConfirmation($id) {

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

        $current = Carbon::now('Asia/Manila')->toDateString();

        return view('customer_side/pages/order_confirmation', ['city'=>$cityName,'province'=>$provName,'NewSalesOrder'=>$NewSalesOrder,
            'NewOrder_SchedDetails'=>$NewOrder_SchedDetails,'SalesOrder_flowers'=>$SalesOrder_flowers,'NewOrder_Bouquet'=>$NewOrder_Bouquet,
            'SalesOrder_Bqtflowers'=>$SalesOrder_Bqtflowers,'SalesOrder_BqtAccessories'=>$SalesOrder_BqtAccessories,'NewSalesOrder_details'=>$NewSalesOrder_details]);
		}

		public function guestprint($id){
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

            $current = Carbon::now('Asia/Manila')->toDateString();


            Session::remove('orderid');

            $pdf = \PDF::loadView("reports\Customer_Side_OrderSummary",['city'=>$cityName,'province'=>$provName,'NewSalesOrder'=>$NewSalesOrder,
                'NewOrder_SchedDetails'=>$NewOrder_SchedDetails,'SalesOrder_flowers'=>$SalesOrder_flowers,'NewOrder_Bouquet'=>$NewOrder_Bouquet,
                'SalesOrder_Bqtflowers'=>$SalesOrder_Bqtflowers,'SalesOrder_BqtAccessories'=>$SalesOrder_BqtAccessories,'NewSalesOrder_details'=>$NewSalesOrder_details]);

            return $pdf->download('GUESTRECEIPT-'.$id.'-'.$current.'.pdf');
        }

	public function getInventorySideFlowerTransaction() {

			$Flower_Transactions = DB::select('call Inventory_Transaction_in_Flowers()');
          $type = 'Flower';
         return view('inventory_side/pages/inventory_side_flower_transaction')
          ->with('Itype',$type)
          ->with('transactions',$Flower_Transactions);
		}

	public function getInventorySideAccTransaction() {

		$Acrs_Transactions = DB::select('call Inventory_Transaction_in_Acrs()');
          $type = 'Acessories';
          return view('inventory_side/pages/inventory_side_acc_transaction')
          ->with('Itype',$type)
          ->with('transactions',$Acrs_Transactions);
		}
}
