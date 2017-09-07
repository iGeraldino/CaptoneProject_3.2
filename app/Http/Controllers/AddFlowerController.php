<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\flower_details;
use Session;
use Auth;


class AddFlowerController extends Controller
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
            $flower = flower_details::all();
        
            return view ('flower/flowerlist')->with('flower', $flower);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            $this->validate($request, array(

                    'flowername' => 'required|max:40',
                    'desc' => 'max:255',
                    'price' => 'required',
                    'life' => 'required',
                    'retail' => 'required'


                ));

        //store

            $add = new flower_details;

            $add->flower_name = $request->flowername;
            $add->Description = $request->desc;
            $add->Price = $request->price;
            $add->life_span = $request->life;
           // $add->retail_Price = $request->retail;

            $add->save();

            Session::flash('success', 'The flower has been successfully added.');


        //redirect

            return redirect()->route('flower.show', $add->id);
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
            $flower = flower_details::all();
            return view('flower.flowerlist')->with('flower', $flower);
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
            $flower = flower_details::all();
            return view('flower/flowershow') -> with('flower', $flower);
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
