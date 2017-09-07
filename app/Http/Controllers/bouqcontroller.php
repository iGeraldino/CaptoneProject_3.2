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

class bouqcontroller extends Controller
{
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
            $bou = DB::table('bouquet_details')
            ->select('*')
            ->where('type','!=','custom')
            ->get();
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
        if(auth::check() == false){
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

        //store
        if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            $bou = new bouquet_details;

            $bou->count_ofFlowers = $request->count;
            $bou->price = $request->price;

        //Saving Image

            if($request -> hasFile('bouimg')){
                $image = $request -> file('bouimg');
                $filename = time() . '.' . $image -> getClientOriginalExtension();
                $location = public_path('bouquetimage/' . $filename);
                Image::make($image) -> resize(800, 400) -> save($location);

                $bou -> image = $filename;
            }

        //

            $bou->save();

        //redirect

            return redirect()->route('bouquet.show', $bou->bouquet_ID);
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
        if(auth::check() == false){
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
        if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
             $bou = bouquet_details::find($id);

            return view('bouquet.editbouquet') -> with('bou', $bou);
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
        if(auth::check() == false){
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
