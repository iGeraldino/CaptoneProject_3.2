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
        $accessories = DB::select('CALL Acessories_Records()');

        return view('Orders.quickorder')
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
