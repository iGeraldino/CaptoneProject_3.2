<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\flower_details;
use Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Session;
use Auth;

class flowercontroller extends Controller
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
            $flower = DB::select('CALL Viewing_Flowers_With_UpdatedPrice()');
           // dd($flower);
            return view('flower.addflower')
            -> with ('flower', $flower);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
          $flower = DB::select('CALL Viewing_Flowers_With_UpdatedPrice()');
         // dd($flower);
          return view('flower.addflower')
          -> with ('flower', $flower);
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
                    // get the current time  - 2015-12-19 10:10:54
                    $current = Carbon::now();
                        $flower = new flower_details;

                        $flower->flower_name = $request->flowername;
                        $flower->Description = $request->desc;
                        $flower->Initial_Price = $request->initialprice;
                        $flower->date_created = $current;
                        $flower->QTY_of_Wholesale = $request->WholesaleQTY;


                    //Saving Image
                        if($request -> hasFile('flowerimg')){
                            $image = $request->file('flowerimg');
                            $filename = time().'.' . $image->getClientOriginalExtension();
                            $location = public_path('flowerimage/' . $filename);
                            Image::make($image)->save($location);
                            $flower->Image = $filename;
                        }
                    //
                        $flower->save();

                            $max_BatchID = DB::table('inventory_persched')
                            ->Max('Sched_ID');

                            $RecordEmptyFlower = DB::select('CALL Add_Empty_Recordto_LatestBatch(?,?)',array(null,$flower->flower_ID));
                            //dd($RecordEmptyFlower);
                    //redirect
                            Session::flash('success','The flower has been Succesfully Created!');

                        return redirect()->route('floweradd.index');
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
            $flower = flower_details::all();

            return view('flower.addflower') -> with('flower', $flower);
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
            $flower = flower_details::find($id);

            //dd($flower);
            return view('flower.editflower') -> with('flower', $flower);
        }
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

        if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            $this->validate($request, array(
                        'desc' => 'max:255',
                        //'price' => 'required',
                        //'life' => 'required',
                        //'retail' => 'required'
                    ));

            $flower = flower_details::find($id);

            $flower->flower_name = $request->input('flowername');
            $flower->Description = $request->input('desc');
            //$flower->life_span = $request->input('life');
            $flower->QTY_of_Wholesale = $request->input('QTY');
            $flower->Initial_Price = $request->input('price');

            //store
              $flower->save();
             return redirect()->route('floweradd.show', $flower->id);
            //redirect
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
