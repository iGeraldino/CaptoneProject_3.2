<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\inventoryPersched;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Session;

class spoiled_Monitoring_Controller extends Controller
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
       $current = Carbon::now('Asia/Manila');
        //this is to update the specific flower's batch that all of the flowers under that batch are all already expired
        $Inventory_ID = $request->inventory_IDField;
        $Flower_ID = $request->inventory_IDField;
        $Remaining = $request->flwr_qtyRemainingField;
        $Spoiled = $request->RealqtyToSpoil_Field;
        //dd($Spoiled);
        $batch = inventoryPersched::find($Inventory_ID);

        $SetSpoiled = DB::select('CALL Set_SpoiledOnBatch(?, ?)',array($Inventory_ID,$Spoiled));

        $spoiledQTY = 0 - $Spoiled;//for it to be negative
        $Spoiled_InvnetoryTrans  =  DB::select('CALL add_record_ofSpoiledInventory_Transaction(?,?,?,?,?,?,?,?)'
        ,array($batch->Sched_ID,$batch->Flower_ID,$spoiledQTY,$batch->Cost,$current,'S','Flower','Allin Spoiled of the remaining flower in the batch'));

        Session::put('SpoiledRecord','Successful');
        return redirect()->route('dashboard');
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
