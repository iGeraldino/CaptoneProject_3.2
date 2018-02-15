<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use \Cart;
use Auth;
use App\flower_details;
use App\shop_schedule;

class Add_Flwr_toSessionInventory_Cart_Controller extends Controller
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
      if(auth::guard('admins')->check() == false){
          Session::put('loginSession','fail');
          return redirect() -> route('adminsignin');
      }
      else{
        $Sched_ID = $request->rqst_IDField;
        $flower_ID = $request->flwr_IDField;
        $qtyRecieved = $request->qtyRecieved_Field;
        $qtySpoiled = $request->qtySpoiled_Field;
        $qtyGood = $request->Goodqty_Field;
        $cost = $request->Cost_Field;
        $life = $request->lifeSpan_Field;
        $expctdQTY = $request->flwr_qtyField;


        $flower_Det = flower_details::find($flower_ID);

        /*echo "<h3><b>Sched_ID = </b>".$Sched_ID."</h3>";
        echo "<h3><b>flower_ID = </b>".$flower_ID."</h3>";
        echo "<h3><b>qtyRecieved = </b>".$qtyRecieved." pcs.</h3>";
        echo "<h3><b>qtySpoiled = </b>".$qtySpoiled." pcs.</h3>";
        echo "<h3><b>qtyGood = </b>".$qtyGood." pcs.</h3>";
        echo "<h3><b>cost = </b>".$cost.".</h3>";
        echo "<h3><b>life = </b>".$life.".</h3>";*/

        Cart::instance('Flowers_to_Arrive')
        ->add(['id' => $flower_ID, 'name' => $flower_Det->flower_name,
        'qty' => $qtyRecieved, 'price' => $cost,
        'options' => ['Life_Span' => $life,'image'=>$flower_Det->Image,
        'expected'=>$expctdQTY,'goodQty'=>$qtyGood,'spoiledQty'=>$qtySpoiled,'sched_ID'=>$Sched_ID]]);

        //dd(  Cart::instance('Flowers_to_Arrive')->content() )
        Session::put('ManagingFlowerSession','Successful');
        return redirect()->route('InventoryArriving_Flowers.show',$Sched_ID);
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
        if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
          if(auth::guard('admins')->user()->type == '1')
          {
            $sched_Id ="";
            $flwr_ID = "";
            $flwr_name = "";
            $expected_QTY = "";
            $cost = "";
            $recvd_QTY = "";
            $good_QTY = "";
            $bad_QTY = "";
            $life_span = "";
            $image = "";

            $RECORD = array();

            foreach(Cart::instance('Flowers_to_Arrive')->content() as $Flowers){
              if($Flowers->id == $id){
                $sched_Id = $Flowers->options->sched_ID;
                $flwr_ID = $Flowers->id;
                $flwr_name = $Flowers->name;
                $recvd_QTY = $Flowers->qty;
                $cost = $Flowers->price;
                $expected_QTY = $Flowers->options->expected;
                $life_span = $Flowers->options->Life_Span;
                $image = $Flowers->options->image;
                $good_QTY = $Flowers->options->goodQty;
                $bad_QTY = $Flowers->options->spoiledQty;
                break;
              }
            }

            //dd(Cart::instance('Flowers_to_Edit')->content());

            $ScheduleDet = shop_schedule::find($sched_Id);

            $RECORD = collect([$sched_Id,$flwr_ID,$flwr_name,$recvd_QTY
            ,$cost,$expected_QTY,$life_span,$image,$good_QTY,$bad_QTY]);

            return view('flower.inventoryScheduling.edit_ManagedFLower')
            ->with('records',$RECORD)
            ->with('ScheduleDet',$ScheduleDet);
          }
          else if(auth::guard('admins')->user()->type == '3')
          {
            $sched_Id ="";
            $flwr_ID = "";
            $flwr_name = "";
            $expected_QTY = "";
            $cost = "";
            $recvd_QTY = "";
            $good_QTY = "";
            $bad_QTY = "";
            $life_span = "";
            $image = "";

            $RECORD = array();

            foreach(Cart::instance('Flowers_to_Arrive')->content() as $Flowers){
              if($Flowers->id == $id){
                $sched_Id = $Flowers->options->sched_ID;
                $flwr_ID = $Flowers->id;
                $flwr_name = $Flowers->name;
                $recvd_QTY = $Flowers->qty;
                $cost = $Flowers->price;
                $expected_QTY = $Flowers->options->expected;
                $life_span = $Flowers->options->Life_Span;
                $image = $Flowers->options->image;
                $good_QTY = $Flowers->options->goodQty;
                $bad_QTY = $Flowers->options->spoiledQty;
                break;
              }
            }

            //dd(Cart::instance('Flowers_to_Edit')->content());

            $ScheduleDet = shop_schedule::find($sched_Id);

            $RECORD = collect([$sched_Id,$flwr_ID,$flwr_name,$recvd_QTY
            ,$cost,$expected_QTY,$life_span,$image,$good_QTY,$bad_QTY]);

            return view('flower.inventoryScheduling.edit_ManagedFLower')
            ->with('records',$RECORD)
            ->with('ScheduleDet',$ScheduleDet);
          }
          else {
            {
              Session::put('loginSession','fail');
              return redirect() -> route('adminsignin');
            }
          }
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
        foreach(Cart::instance('Flowers_to_Arrive')->content() as $Flowers){
          if($Flowers->id == $id){
            Session::put("editSession","Successful");
            Cart::instance('Flowers_to_Arrive')
            ->update($Flowers->rowId,['name' => $Flowers->name,
            'qty' => $request->qtyRecieved_Field, 'price' => $request->Cost_Field,
            'options' => ['Life_Span' => $request->lifeSpan_Field,'image'=>$Flowers->options->image,
            'expected'=>$request->flwr_qtyField,'goodQty'=>$request->Goodqty_Field,
            'spoiledQty'=>$request->qtySpoiled_Field,
            'sched_ID'=>$Flowers->options->sched_ID]]);
            break;
          }
        }
        return redirect()->route('InventoryArriving_Flowers.show',$request->rqst_IDField);

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
