<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\supplier_details;
use App\Shop_ScheduleModel;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Session;
use \Cart;
use Auth;

class manageArriving_FLowers_controller extends Controller
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
        if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            //
            //$Sched_Info = DB::select('call specific_inventory_schedule_Info(?)',array($id));
            $Sched_Info = DB::table('shop_schedule')
            ->select('shop_schedule.Schedule_ID as Sched_Id','shop_schedule.Date_of_Event as Date',
                        'shop_schedule.Schedule_Type as type', 'shop_schedule.shedule_status as Status',
                        'shop_schedule.supplier_ID as Supplier_ID','shop_schedule.created_at as date_ordered',
                        'supplier_details.supplier_FName as FName','supplier_details.supplier_MName as MName',
                        'supplier_details.supplier_LName as LName')
            ->join('supplier_details', 'supplier_details.supplier_ID', '=', 'shop_schedule.supplier_ID')
            ->where('shop_schedule.Schedule_ID','=',$id)
            ->first();

            $Flowers = DB::table('flower_details')
            ->select('*')
            ->get();

            $flowersPersched = DB::select('call viewFlowers_PerSched(?)',array($id));

            return view('flower.inventoryScheduling.ManageFlowers_toArrive')
            ->with('FlowerList',$Flowers)
            ->with('SchedFlowers',$flowersPersched)
            ->with('schedInfo',$Sched_Info);
        }
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
