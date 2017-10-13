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
use Carbon\Carbon;


class InventoryScheduling_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\m_responsekeys(conn, identifier)
     */
    public function index()
    {
        //
        if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
           /* if(Request::ajax())
            {
                return json_encode([
                    'data' => supplier_details::all()
                ]);
            }*/
            Cart::instance('Flowers_to_Arrive')->destroy();
            $supplierdata = supplier_details::all();

            $schedule = DB::select('CALL inventory_Schedules()');

            $doneschedule = DB::select('CALL doneinventory_Schedules()');
            $canceledschedule = DB::select('CALL canceledinventory_Schedules()');
            $arriving = DB::select('CALL view_Arriving_Inventory()');
            //dd($arriving);
           return view('flower.inventoryScheduling.schedule_Inventory')
           ->with('arriving',$arriving)
           ->with('schedInv',$schedule)
           ->with('doneschedInv',$doneschedule)
           ->with('canceledschedInv',$canceledschedule)
           ->with('supp',$supplierdata);
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
        if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
         return view('flower.inventoryScheduling.Create_Schedule');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
                    //
                    //Cart::instance('Schedule_Arrival');
                      $Date_of_Event = $request->datetoArriveField;
                      $suplr_ID = explode("_", $request->supplierField_Input);
                      //echo $suplr_ID[1];
                      $supplier_ID = $suplr_ID[1];
                      $Schedule_Type = "I";


                    $NewScheduleDetails = collect([$Date_of_Event,$supplier_ID,$Schedule_Type]);

                    Session::put('newScheduleSession', $NewScheduleDetails);
                    /*$NewSched = new  Shop_ScheduleModel;
                      $NewSched->Date_of_Event = $request->datetoArriveField;
                      $NewSched->supplier_ID = $request->supplierField;
                      $NewSched->Schedule_Type = "I";
                    */
                   //echo $request->supplierField;
                      // dd($NewScheduleDetails);
                    Session::put('AddingFlower_ArrivalSession','Successful');
                    return redirect()->route('Inventory.ScheduleArrival');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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

            return view('flower.inventoryScheduling.setting_flowersToArrive')
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

            return view('flower.inventoryScheduling.ViewFlowers_ToAdjust')
            ->with('FlowerList',$Flowers)
            ->with('SchedFlowers',$flowersPersched)
            ->with('schedInfo',$Sched_Info);
        }

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
        if(auth::guard('admins')->check() == false){
                Session::put('loginSession','fail');
                return redirect() -> route('adminsignin');
            }
            else{
              //$current = Carbon::now('Asia/Manila');

              $dateArrived = date('Y-m-d', strtotime($request->DateRecieved_Field));
              $timeArrived = date('H:i:s', strtotime($request->TimeRecieved_Field));

              $datetime = $dateArrived.' '.$timeArrived;
              $current = Carbon::now('Asia/Manila');

              $updateShopSchedule = DB::select('CALL update_Scheduled_Inventory(?,?,?)',array($id,$current,$datetime));


              foreach(CART::instance('Flowers_to_Arrive')->content() as $row){
                $update_Scheduled_flowers =DB::select('CALL update_ScheduledFlowers_From_suppliers(?, ?, ?, ?, ?, ?)',
                array($row->id,$id,$row->qty,$row->options->spoiledQty,$row->options->goodQty,$datetime));//to be continued

                $insertbatchFlowers = DB::select("CALL add_newBatch_Flowers(?,?,?,?,?,?,?,?)"
                ,array($id,$datetime,$row->options->Life_Span,$row->id,$row->qty,
                $row->options->goodQty,$row->options->spoiledQty,$row->price));

                  if($row->options->spoiledQty > 0){//determines if there are initially spoiled quantity in upon arrival
                    $addtransaction = DB::select('CALL add_record_ofInventory_Transaction(?,?,?,?,?,?,?)',
                    array($id,$row->id,$row->options->goodQty,$row->price,$datetime,'I','Flower'));

                    $negativeQty = '-'.$row->options->spoiledQty;//for negative qty only

                    $addNegativetransaction = DB::select('CALL add_record_ofInventory_Transaction(?,?,?,?,?,?,?)',
                    array($id,$row->id,$negativeQty,$row->price,$datetime,'S','Flower'));
                  }else if($row->options->spoiledQty == 0){//means that there are no initially spoiled quantity in upon arrival
                    $addtransaction = DB::select('CALL add_record_ofInventory_Transaction(?,?,?,?,?,?,?)',
                    array($id,$row->id,$row->options->goodQty,$row->price,$datetime,'I','Flower'));

                    $addNegativetransaction = DB::select('CALL add_record_ofInventory_Transaction(?,?,?,?,?,?,?)',
                    array($id,$row->id,$row->options->spoiledQty,$row->price,$datetime,'I','Flower'));
                  }//end of else if
              }
              CART::instance('Flowers_to_Arrive')->destroy();
              Session::put("Manage_Session","done");
              return redirect()->route('InventoryScheduling.index');
          }
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
