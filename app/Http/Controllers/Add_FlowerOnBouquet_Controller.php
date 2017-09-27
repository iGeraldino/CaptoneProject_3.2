<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Auth;

class Add_FlowerOnBouquet_Controller extends Controller
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
        if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            $Bouquet_ID = $request->BQT_ID_Field;
            $Fower_ID = $request->flowersField;
            $QTY = $request->QtyField;

            $TAmt= $request->final_BQTAamount + ($request->InputFlowerPriceField * $QTY);
            $TQTY = $request->Flower_Count_Field + $QTY;

            $AddNewFlowerTo_Bouquet = DB::select('CALL add_Flower_to_Bouquet(?,?,?)',array($Bouquet_ID,$Fower_ID,$QTY));
            return redirect()->route("bouqAddFlower.show", $Bouquet_ID);
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
        if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            $Bouquet_Details = DB::table('bouquet_details')
            ->select('*')
            ->where('bouquet_ID','=',$id)
            ->first();
            $bouq_Flower_Count = DB::select('CALL count_of_flowers_per_bouquet(?)',array($id));
            $bouq_Acessory_Count = DB::select('CALL count_of_acessories_per_bouquet(?)',array($id));
            //->where('bouquet_ID','=',$id);

            //dd($bouq_Flower_Count);

            $CountUnsetFlowers = DB::select('CALL COUNT_OF_AvailableFlowers_PerBouquet(?)',array($id));
            $CountUnsetAcessories = DB::select('CALL COUNT_OF_AvailableAcessories_PerBouquet(?)',array($id));
            $unsetAcessories = DB::select('CALL acessories_not_InSpecific_Bouquet_Yet(?)',array($id));
            $unsetFlowers = DB::select('CALL flowers_not_InSpecific_Bouquet_Yet(?)',array($id));
            $bouquetAcessories = DB::select('CALL Acessories_PerBouquet(?)',array($id));
            $bouquetFlowers = DB::select('call flowers_PerSpecificBouquet(?)',array($id));
            //dd($bouquetFlowers);
            //dd($CountUnsetFlowers,$CountUnsetAcessories);

            return view('bouquet.specific_bouquet_details')
            ->with('CountFlower',$CountUnsetFlowers)
            ->with('CountAcessories',$CountUnsetAcessories)
            ->with('BouquetDet',$Bouquet_Details)
            ->with('UnsetAcessories',$unsetAcessories)
            ->with('UnsetFlowers',$unsetFlowers)
            ->with('BouqFlowers',$bouquetFlowers)
            ->with('BouqAcessoriess',$bouquetAcessories)
            ->with('bouq_Flower_Count',$bouq_Flower_Count)
            ->with('bouq_Acessory_Count',$bouq_Acessory_Count);
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
        if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            $Exploded_ID = explode("_",$id);
            //echo('$Exploded_ID[0] = '. $Exploded_ID[0]);
            //echo('$Exploded_ID[1] = '. $Exploded_ID[1]);
            $bouquetFlowers = DB::select('CALL specific_Flower_of_Specific_Bouquet(?,?);',array($Exploded_ID[0],$Exploded_ID[1]));

            //dd($bouquetFlowers);

           return view('bouquet.update_qty_per_flower_per_Bouquet')
            ->with('FlowersDetails',$bouquetFlowers);
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
            $Exploded_ID = explode("_",$id);
            $QTY = $request->NewQTY;

           /* $BQT_Details = DB::table("bouquet_details")
            ->select('*')
            ->where('bouquet_ID','=',$Exploded_ID[0]);

            $newFinalQTY = $BQT_Details + $QTY*/

            //update the bqt qty and price here

            //echo ('Quantity = '.$QTY);
            //echo('$Exploded_ID[0] = '. $Exploded_ID[0]);
            //echo('$Exploded_ID[1] = '. $Exploded_ID[1]);

            $bouquetFlowers = DB::select('CALL  update_QTY_of_Flower_Per_Bouquet(?,?,?);',array($Exploded_ID[0],$Exploded_ID[1],$QTY));

            return redirect()->route('bouqAddFlower.edit',$id);
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
