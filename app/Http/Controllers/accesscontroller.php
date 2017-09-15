<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\accessories;
use App\AcessoriesInventory;
use Illuminate\Support\Facades\DB;
use Image;
use Session;
use Auth;

class accesscontroller extends Controller{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            $acc = DB::select('CALL Acessories_Records()');
            /*$acc = DB::table('accessories')
            ->join('accessories_inventory', 'accessories.Accesories_ID', '=', 'accessories_inventory.accesories_ID')
            ->select('accessories.Accesories_ID as ACC_ID','accessories.image as image', 'accessories.name as name',
                        'accessories.price as price', 'accessories_inventory.qty as qty')
            ->get();*/
            //dd($acc);
            return view('accessories.addaccess')->with('acc', $acc);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            return view('accessories.addaccess');
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
        if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            $this->validate($request, array(

                    'accname' => 'required|max:50',
                    'price' => 'required',
                   // 'accimg' => 'image|max:8388'
                ));

        //store

            $acc = new accessories;

            $acc->name = $request->accname;
            $acc->price = $request->price;

        //Saving Image


            if($request -> hasFile('accimg')){

                $image = $request -> file('accimg');
                $filename = time(). '.' . $image -> getClientOriginalExtension();
                $location = public_path('accimage/' . $filename);
                Image::make($image)-> save($location);

                $acc -> Image = $filename;
            }
            //saving to tha database
            $acc->save();

            //makes a new record at accessories table
            $accInventory = new AcessoriesInventory;
            //gets the id of the newly made record in the accessories table
            $accInventory->accesories_ID = $acc->Accesories_ID;
            $accInventory->qty = 0;

            $accInventory->save();

        //redirect

            return redirect()->route('acc.index');
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
         //$acc = accessories::all();

         //return view('accessories.addaccess') -> with('acc', $acc);
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
             //
            //$acc = DB::select('call Specific_Acessory(?)',array($id));
            $acc = DB::table('accessories')
            ->join('accessories_inventory', 'accessories.Accesories_ID', '=', 'accessories_inventory.accesories_ID')
            ->select('accessories.Accesories_ID as ACC_ID','accessories.image as image', 'accessories.name as name',
                        'accessories.price as price', 'accessories_inventory.qty as qty')
            ->where('accessories.Accesories_ID',"=",$id)
            ->first();
            //dd($acc);
           return view('accessories.editaccess') -> with('acc', $acc);
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
        //$this->validate($request, array(
          //          'price' => 'required',
            //    ));
        if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            $acc = accessories::find($id);

            $acc->name = $request->Acname;
            $acc->price = $request->Price;


            if($request -> hasFile('Accimg')){
                    $image = $request->file('Accimg');
                    $filename = time().'.' . $image->getClientOriginalExtension();
                    $location = public_path('flowerimage/' . $filename);
                    Image::make($image)->resize(500, 100)->save($location);
                    //$flower->Image = $filename;
                    $oldFile = $acc->image;
                    Storage::delete('/flowerimage/'.$oldFile);
                $Update_Acc = DB::select('Call Update_Acessories_Details(?,?,?,?)',array($id,$request->Acname,$filename,$request->Price));
                }
            else{
                $Update_Acc = DB::select('Call Update_Acessories_Details(?,?,?,?)',array($id,$request->Acname,$request->imageName,$request->Price));
                }

            //store
            //echo ('image is : '.$request->imageName);
            //$Update_Acc = DB::select('Call Update_Acessories_Details(?,?,?,?)',array($id,$request->Acname,$request->imageName,$request->Price));
             return redirect()->route('acc.edit', $acc->Accesories_ID);
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
        if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            /*$delItem = accessories::find($id);
            $delItem->delete();*/
            $delItem = DB::select('CALL deactivate_Acessory(?)',array($id));

            Session::flash('success','The Item was succesfully deleted.');
            return redirect()->route('acc.index');
        }

    }
}
