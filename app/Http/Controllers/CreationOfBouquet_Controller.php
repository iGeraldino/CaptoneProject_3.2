<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Requests;
use Auth;
use Session;

class CreationOfBouquet_Controller extends Controller
{
    //

    public function show_Order_BQT_CustomizationPage()
	{//this is for creation of a bouquet for order that is not yet saved in the database
		if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
				$flowers = 	DB::select('CALL wonderbloomdb2.Viewing_Flowers_With_UpdatedPrice()');
				$accessories = DB::select('CALL Acessories_Records()');

				return view('Orders.Customize_NewBouquet')
				->with('flowers',$flowers)
				->with('flowers2',$flowers)
				->with('flowers3',$flowers)
				->with('accessories',$accessories)
				->with('accessories2',$accessories)
				->with('accessories3',$accessories);
			//}
	}//end of function

    public function show_Bouquet_Order_CustomizationPage($Order_id)
	{//this is for creation of bouquet for existing order
		if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
			$flowers = 	DB::select('CALL wonderbloomdb2.Viewing_Flowers_With_UpdatedPrice()');
			$accessories = DB::select('CALL Acessories_Records()');

			return view('Orders.Create_Bouquet')
			->with('flowers',$flowers)
			->with('flowers2',$flowers)
			->with('flowers3',$flowers)
			->with('accessories',$accessories)
			->with('accessories2',$accessories)
			->with('accessories3',$accessories)
			->with('order_ID',$Order_id);
		//}
	}//end of function

}
