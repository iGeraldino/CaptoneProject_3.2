<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Auth;
use Session;


class PagesController extends Controller
{
    //
	public function getSupplierList() {
		if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
			return view('supplier/supplierlist');
		}
	}//

	public function getSupplierMoreDetails() {
		if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
			return view('supplier/suppliermoredetails');
		}
	}//

	public function getCustomerList() {
		    if(auth::check() == false){
            	Session::put('loginSession','fail');
            	return redirect() -> route('adminsignin');
        	}
        	else{
				return view('customer/customerlist');
			}
		}//

	public function getSupplierPriceList() {
	        if(auth::check() == false){
	            Session::put('loginSession','fail');
	            return redirect() -> route('adminsignin');
	        }
	        else{			
				return view('supplier/supplierpricelist');
			}
		}

	public function getAddingTradeAgreement() {
        	if(auth::check() == false){
            	Session::put('loginSession','fail');
            	return redirect() -> route('adminsignin');
        	}
        	else{		
				return view('customer/adding_tradeagreement');
			}
		}//
	public function getCustomerTradeAgreement() {
        if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
			return view('customer/customer_trade_agreement');
		}
	}//

	public function getSpecificCustomerAgreement() {
	        if(auth::check() == false){
            	Session::put('loginSession','fail');
            	return redirect() -> route('adminsignin');
        	}
        	else{
				return view('customer/specific_customer_agreement');
			}
		}

	public function getOtherViewOfCustAgreement() {
		if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
			return view('customer/other_viewofcustagreement');
			}
		}

	public function getInventoryTransaction() {
		  if(auth::check() == false){
	            Session::put('loginSession','fail');
	            return redirect() -> route('adminsignin');
	        }
	     else{
				return view('inventory/inventorytransaction');
			}
		}

	public function getDashboard() {

		if(auth::check() == false){
			Session::put('loginSession','invalid');
			return redirect() -> route('adminsignin');
		}
		else{
			Session::put('loginSession','good');
			return view('dashboard');
		
		}

		}

	public function getHome() {
			return view('customer_side/pages/home');
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
			return view('login/login_page');
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

	public function getCashierPage() {
			return view('cashier/pages/cashierpage');
		}

	public function getCashierDashboard() {
			return view('cashier/pages/cashier_dashboard');
		}

	public function getCashierSalesOrder() {
			return view('cashier/pages/cashier_sales_order');
		}

	public function getCashierQuickOrder() {
			return view('cashier/pages/cashier_quick_order');
		}

	public function getCashierLongOrder() {
			return view('cashier/pages/cashier_long_order');
		}

	public function getCashierCustomerList() {
			return view('cashier/pages/cashier_customer_list');
		}

	public function getCashierCustomerTradeAgreement() {
			return view('cashier/pages/cashier_customer_trade_agreement');
		}

	public function getCashierFlowerList() {
			return view('cashier/pages/cashier_flower_list');
		}

	public function getCashierInventoryTransaction() {
			return view('cashier/pages/cashier_inventory_transaction');
		}

	public function getCashierFlowerPriceList() {
			return view('cashier/pages/cashier_flower_price_list');
		}
}



