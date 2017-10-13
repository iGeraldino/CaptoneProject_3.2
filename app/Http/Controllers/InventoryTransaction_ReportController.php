<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;

use \PDF;
use Carbon\Carbon;


class InventoryTransaction_ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $itemType = $request->itemtype;
        $date_range = $request->trans_range;

        $Flower = DB::select('call Inventory_Transaction_in_Flowers()');

        echo $date_range.'<br>'.'<br>';
        $dates = array();
        $dates = explode('-',$date_range);
        echo 'start date:'.$dates[0].'<br>';
        echo 'end date:'.$dates[1].'<br>';
        echo 'itemType: '.$itemType.'<br>';

         
        $trans = DB::select("CALL showInventoryTransaction_Per_type (?,?,?)",array(date('Y-m-d',strtotime($dates[0])),date('Y-m-d',strtotime($dates[1])),$itemType));
        //dd($trans);

        $pdf = \PDF::loadView("reports.sales_reports",['trans'=>$trans]);
        $current = Carbon::now('Asia/Manila');
        return $pdf->download('FlowerInventory_TransactionReport'.$current.'.pdf');

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
