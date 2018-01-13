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

class longorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
/*
        $current = Carbon::now('Asia/Manila');

        //create a new Sales order first
       $createOrder = new newSales_order;

       //dd($CustID[1]);
        $createOrder->Customer_Fname = 'Gerardo';
        $createOrder->Customer_Mname = 'Reyes';
        $createOrder->Customer_Lname = 'Alvaran';
        $createOrder->Contact_Num = '09051515663';
        $createOrder->email_Address = 'gerry@gmail.com';
        $createOrder->created_at = $current;
        $createOrder->updated_at = $current;
        $createOrder->Status = 'PENDING';
        $createOrder->Type = 'WALK-IN';
        $createOrder->save();
*/
//        dd(auth::user());

        if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else if(auth::guard('admins')->user()->type == '1'){

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
            return view('Orders.longorder')
            ->with('orders',$salesOrders)
            ->with('cust',$customers)
            ->with('city',$cities)
            ->with('city2',$cities)
            ->with('province',$province)
            ->with('accessories',$accessories)
            ->with('FlowerList',$AvailableFlowers);
    
        }
        else if(auth::guard('admins')->user()->type == '2'){
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
