<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\bouquet_details;
use Image;
use Session;
use Auth;
use \Cart;

class bouqcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            $bou = DB::select("CALL show_allDefaultBouquets()");
           return view('bouquet.addbouquet') -> with ('bou', $bou);
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
         return view('bouquet.addbouquet');
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
      //
      if(auth::guard('admins')->check() == false){
          Session::put('loginSession','fail');
          return redirect() -> route('adminsignin');
      }
      else{


        $bouquet_record = new bouquet_details;
        if($request -> hasFile('bouimg')){
            $image = $request -> file('bouimg');
            $filename = time() . '.' . $image -> getClientOriginalExtension();
            $location = public_path('bouquetimage/' . $filename);
            Image::make($image) ->save($location);

            $bouquet_record->image =$filename;
        }
            $bouquet_record->Type = 'default';
            $bouquet_record->save();
            $newBqt_ID = $bouquet_record->bouquet_ID;

        foreach(Cart::instance('AdminBqt_Flowers')->content() as $row){
          $addFlower_To_BQT_details_table = DB::select('CALL add_Flower_to_Bouquet(?,?,?)',array($newBqt_ID,$row->id,$row->qty));
        }//END OF FOREACH FLOWERS

        foreach(Cart::instance('AdminBqt_Acessories')->content() as $row2){
          $addFlower_To_BQT_details_table = DB::select('CALL add_Acessories_to_Bouquet(?,?,?)',array($newBqt_ID,$row2->id,$row2->qty));
        }

        Cart::instance('AdminBqt_Flowers')->destroy();
        Cart::instance('AdminBqt_Acessories')->destroy();

        Session::put('Save_Bouquet', 'Successful');
        return redirect()->route('bouquet.index');
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
             $bou = bouquet_details::all();
             return view('bouquet.addbouquet') -> with('bou', $bou);
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
        if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            $bou = bouquet_details::find($id);

            return view('bouquet.editbouquet')
            ->with('bou', $bou);
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
        if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
         $this->validate($request, array(
                    'price' => 'required',
                    'count' => 'required|max:11',
                ));

        $bou = bouquet_details::find($id);


        $bou->price = $request->input('price');
        $bou->count_ofFlowers = $request->input('count');


        //store

          $bou->save();
         return redirect()->route('bouquet.show', $bou->bouquet_ID);
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
