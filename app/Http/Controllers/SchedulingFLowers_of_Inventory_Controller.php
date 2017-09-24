<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\flower_details;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Session;
use \Cart;
use Auth;

class SchedulingFLowers_of_Inventory_Controller extends Controller
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
        if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
                $Flower_ID = $request->FLowerList;
                $Qty = $request->QTY_Field;
                $flower_details = flower_details::find($Flower_ID);//search for details of specific flower
                $defaultprice = '0.00';
                $Flower_name = $flower_details->flower_name;
                $image = $flower_details->Image;

            $Schedule_details = Session::get('newScheduleSession');
            if($Schedule_details == null){
                Session::put('requestOrder_Session','failure');
                return redirect()->route('InventoryScheduling.index');
            }else{
                if(Cart::instance('Schedule_Flowers')->count() == 0){
                    echo 'wala pang laman';

                    Cart::instance('Schedule_Flowers')
                    ->add(['id' => $Flower_ID, 'name' => $Flower_name, 'qty' => $Qty, 'price' => $defaultprice,
                    'options' => ['image'=>$image]]);
                    Session::put('Add_Flower_ToSession_Supply', 'Successful1');
                }
                else{
                    echo 'may laman';
                    $Insertion = 0;
                    foreach(Cart::instance('Schedule_Flowers')->content() as $row){
                        if($row->id == $Flower_ID){
                            //for existing item in the cart update a specific record
                            $TotalQty = $row->qty + $Qty;

                            Cart::instance('Schedule_Flowers')->update($row->rowId,['qty' => $TotalQty,'price' => $defaultprice,'options'=>['image'=>$image]]);
                            $Insertion = 0;
                            break;
                            Session::put('Add_Flower_ToSession_Supply', 'Successful2');
                        }//end of if
                        else{
                            //for none existing item in the cart create a new record
                            $Insertion = 1;//this indicates that there will be an insertion of new data
                        }//end of else
                    }//end of foreach
                if($Insertion == 1){
                        echo 'wala pang kamuka';
                            Cart::instance('Schedule_Flowers')
                            ->add(['id' => $Flower_ID, 'name' => $Flower_name, 'qty' => $Qty, 'price' => $defaultprice,
                            'options' => ['image'=>$image]]);
                            Session::put('Add_Flower_ToSession_Supply', 'Successful1');
                    }//
                else{
                            Session::put('Add_Flower_ToSession_Supply', 'Successful2');
                }
            }//end of outer else
            return redirect()->route('Inventory.ScheduleArrival');
            }
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
        if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            $Schedule_details = Session::get('newScheduleSession');
            if($Schedule_details == null){
                Session::put('requestOrder_Session','failure');
                return redirect()->route('InventoryScheduling.index');
            }else{
                $flower = array();
                foreach(Cart::instance('Schedule_Flowers')->content() as $row){
                        if($row->id == $id){
                         $flower = Cart::instance('Schedule_Flowers')->get($row->rowId);
                            //Session::put('Deleted_FlowerfromSession_Supply', 'Successful');
                        }
                    }
                    //dd($flower);
                    return view('flower.inventoryScheduling.edit_Flower_on_listofOrder')
                    ->with('flower',$flower);
            }//
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
        if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            $Schedule_details = Session::get('newScheduleSession');
            if($Schedule_details == null){
                Session::put('requestOrder_Session','failure');
                return redirect()->route('InventoryScheduling.index');
            }else{
                $QTY = $request->NewQTY;

                foreach(Cart::instance('Schedule_Flowers')->content() as $row){
                    if($row->id == $id){
                         Cart::instance('Schedule_Flowers')->update($row->rowId,['qty' => $QTY,'price' => $row->price,'options'=>['image'=>$row->options['image']]]);
                     Session::put('Update_FlowerfromSession_Supply', 'Successful');
                    }
                }
                return redirect()->route('InventoryScheduling_Flowers.edit',$id);
            }//
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
