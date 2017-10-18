<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

use \PDF;

class batchInv_Trans_controller extends Controller
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
        //
        $itemType = 'Flower';
        //$date_range = $request->trans_range;
        $batch = $request->batchList_Field;
        ///
        $Flower = DB::select('call Inventory_Transaction_in_Flowers()');

        //echo $date_range.'<br>'.'<br>';
        $dates = array();
        //$dates = explode('-',$date_range);
        //echo 'start date:'.$dates[0].'<br>';
        //echo 'end date:'.$dates[1].'<br>';
        //echo 'itemType: '.$itemType.'<br>';


        $trans = DB::select("CALL report_inventoryTransaction(?)",array($batch));
        $none =null;
        $current = Carbon::now('Asia/Manila');
        $pdf = \PDF::loadView("reports.sales_reports",['trans'=>$trans,'start'=>$current,'end'=>$none,'type'=>$itemType]);
        return $pdf->download('FlowerBatchInventory_TransactionReport'.$current.'.pdf');

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
