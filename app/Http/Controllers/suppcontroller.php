<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\supplier_details;
use Illuminate\Support\Facades\DB;
use Session;
use Auth;
 
class suppcontroller extends Controller
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
            // echo '<html><h5>hello world;</h5></html>';
            $cities = DB::table('cities')
              ->select('*')
              ->get();

            $province = DB::table('provinces')
              ->select('*')
              ->get();

            $supp = supplier_details::all();
            return view('supplier.supplierlist')
            ->with ('supp', $supp)
            ->with ('province', $province)
            ->with ('city', $cities);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.supplierlist');
   
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

                        'suppFname' => 'required|max:15',
                        'suppMname' => 'max:15',
                        'suppLname' => 'required|max:20', 
                        'contNo' => 'required|max:13',
                        'telNo' => 'max:7',
                        'emailAdd' => 'max:45',
                        'addline' => 'required|max:255',
                        'brgy' => 'required|max:35',
                       // 'prov' => 'required',
                       // 'state' => 'required',
                    ));


            //store
                $supp = new supplier_details;

                $SuppType = $request->supplierType_Field;

                if($SuppType == 'L'){
                    $supp->Province = $request->supplierLocal_Prov;  
                    $supp->Town = $request->supplierLocal_City;
                    $supp->Type = "Local";
                }
                else if($SuppType == 'I'){
                    $supp->Province = $request->prov;
                    $supp->Town = $request->state;
                    $supp->Type = "International";
                }


                $supp->supplier_FName = $request->suppFname;
                $supp->supplier_MName = $request->suppMname;
                $supp->supplier_LName = $request->suppLname;
                $supp->supplier_contactNum = $request->contNo;
                $supp->supplier_telNum = $request->telNo;
                $supp->supplier_emailadd = $request->emailAdd;
                $supp->supplier_AddressLine = $request->addline;
                $supp->Baranggay = $request->brgy;
                
            //saving

                $supp->save();

            //redirect
             /*   echo ' {FName = '.$request->suppFname.' }'. ' {MName = '.$request->suppMname.' }'.' {LName = '.$request->suppLname.' }'.
                '{Contact Number = '.$request->contNo.' }'.'{Tel Number = '.$request->TelNo.' }'. '{email = '.$request->emailAdd.' }'.
                '{Brgy = '.$request->brgy.' }'.'{type = '.$SuppType.' }'. ' {Local Province = '.$request->supplierLocal_Prov.' }'. ' {Local City = '.$request->supplierLocal_City.' }'. ' {Intl Province = '.$request->prov.' }'. ' {Intl City = '.$request->state.' }';*/

                return redirect()->route('supplieradd.index');
            }
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
        if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            $supplierlist = supplier_details::all();

            return view('supplier.supplierlist') -> with('supp', $supplierlist);
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
            $supplier = supplier_details::find($id);
            $cities = DB::table('cities')
              ->select('*')
              ->get();

              $province = DB::table('provinces')
              ->select('*')
              ->get();
            return view('supplier.editsupplier')
            ->with ('province', $province)
            ->with ('supp', $supplier)
            ->with ('city', $cities);
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
            $this->validate($request, array(

                        'suppFname' => 'required|max:15',
                        'suppMname' => 'max:15',
                        'suppLname' => 'required|max:20', 
                        'contNo' => 'required|max:13',
                        'telNo' => 'max:7',
                        'emailAdd' => 'max:45',
                        'addline' => 'required|max:255',
                        'brgy' => 'required|max:35',
                       // 'prov' => 'required',
                       // 'state' => 'required',
                    ));


            //store
                $supp = supplier_details::find($id);

                $SuppType = $request->supplierType_Field;

                if($SuppType == 'L'){
                    $supp->Province = $request->supplierLocal_Prov;  
                    $supp->Town = $request->supplierLocal_City;
                    $supp->Type = "Local";
                }
                else if($SuppType == 'I'){
                    $supp->Province = $request->prov;
                    $supp->Town = $request->state;
                    $supp->Type = "International";
                }


                $supp->supplier_FName = $request->suppFname;
                $supp->supplier_MName = $request->suppMname;
                $supp->supplier_LName = $request->suppLname;
                $supp->supplier_contactNum = $request->contNo;
                $supp->supplier_telNum = $request->telNo;
                $supp->supplier_emailadd = $request->emailAdd;
                $supp->supplier_AddressLine = $request->addline;
                $supp->Baranggay = $request->brgy;
                
            //saving

                $supp->save();

            //redirect
             /*   echo ' {FName = '.$request->suppFname.' }'. ' {MName = '.$request->suppMname.' }'.' {LName = '.$request->suppLname.' }'.
                '{Contact Number = '.$request->contNo.' }'.'{Tel Number = '.$request->TelNo.' }'. '{email = '.$request->emailAdd.' }'.
                '{Brgy = '.$request->brgy.' }'.'{type = '.$SuppType.' }'. ' {Local Province = '.$request->supplierLocal_Prov.' }'. ' {Local City = '.$request->supplierLocal_City.' }'. ' {Intl Province = '.$request->prov.' }'. ' {Intl City = '.$request->state.' }';*/

                return redirect()->route('supplieradd.index');
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
