<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CustomerDetails;
use App\cityModel;
use App\provincesModel;
use Illuminate\Support\Facades\DB;
use Session;
use Image;
use Auth;

class customerListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //$turnOnEventScheduler = DB::select("SET GLOBAL event_scheduler = OFF;");
      $turnOnEventScheduler = DB::select("SET GLOBAL event_scheduler = ON;");

      if(auth::guard('admins')->check() == false){
        Session::put('loginSession','fail');
        return redirect() -> route('AdminLogin');
      }
      else{
        //\
        //$cities = cityModel::all();
          $cities = DB::table('cities')
          ->select('*')
          ->get();

          $province = DB::table('provinces')
          ->select('*')
          ->get();

        $customerDetails = DB::select('CALL showCustomerdetails_WithoutAcct()');
        $custAccts = DB::select('CALL showCustomerswith_ExistingAccts()');
        
        return view('customer/customerlist')
        ->with('accts',$custAccts)
        ->with('customers',$customerDetails)
        ->with('city',$cities)
        ->with('province',$province);
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
        $turnOnEventScheduler = DB::select("SET GLOBAL event_scheduler = ON;");

          if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
         $customerDetails = CustomerDetails::all();
        return view('customer/customerlist')->with('customers',$customerDetails);
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
      $turnOnEventScheduler = DB::select("SET GLOBAL event_scheduler = ON;");

        if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
          $customerDetails = new CustomerDetails;

          $customerDetails->Cust_FName = $request->Cust_FNameField;
          $customerDetails->Cust_MName = $request->Cust_MNameField;
          $customerDetails->Cust_LName = $request->Cust_LNameField;
          $customerDetails->Contact_Num = $request->ContactNumField;
          $customerDetails->Email_Address = $request->emailField;
          $customerDetails->Address_Line = $request->addressField;
          $customerDetails->Baranggay = $request->BaranggayField;
          $customerDetails->Town = $request->TownField;
          $customerDetails->Province = $request->ProvinceField;
          $customerDetails->Hotel_Name = $request->HotelNameField;
          $customerDetails->Shop_Name = $request->ShopNameField;
          $customerDetails->Customer_Type = $request->custTypeField;

          $customerDetails->save();

          //echo $customerDetails->Cust_ID;
       //return view('customer/customerlist')->with('customers',$customerDetails);
        return redirect()->route("customers.show", $customerDetails->Cust_ID);
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
      $turnOnEventScheduler = DB::select("SET GLOBAL event_scheduler = ON;");

        //
      if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
          $cities = DB::table('cities')
          ->select('*')
          ->get();

          $province = DB::table('provinces')
          ->select('*')
          ->get();
         $customerDetails = CustomerDetails::all();
        return view('customer/customerlist')->with('customers',$customerDetails)->with('city',$cities)
        ->with('province',$province);
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
      $turnOnEventScheduler = DB::select("SET GLOBAL event_scheduler = ON;");

        //
        if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
         $cities = DB::table('cities')
          ->select('*')
          ->get();

          $province = DB::table('provinces')
          ->select('*')
          ->get();



        $customerDetails = CustomerDetails::find($id);
        $type = $customerDetails -> Customer_Type;

        return view('customer.EditCustomerDetails')->with('customerDetails',$customerDetails)->with('city',$cities)
        ->with('province',$province)->with('type', $type);
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
      $turnOnEventScheduler = DB::select("SET GLOBAL event_scheduler = ON;");

        //
        if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
          $updatecustomerDetails = CustomerDetails::find($id);

          $updatecustomerDetails->Cust_FName = $request->input('Cust_FNameField2');
          $updatecustomerDetails->Cust_MName = $request->input('Cust_MNameField2');
          $updatecustomerDetails->Cust_LName = $request->input('Cust_LNameField2');
          $updatecustomerDetails->Contact_Num = $request->input('ContactNumField2');
          $updatecustomerDetails->Email_Address = $request->input('emailField2');
          $updatecustomerDetails->Address_Line = $request->input('addressField2');
          $updatecustomerDetails->Baranggay = $request->input('BaranggayField2');
          $updatecustomerDetails->Town = $request->input('TownField2');
          $updatecustomerDetails->Province = $request->input('ProvinceField2');
          $updatecustomerDetails->Hotel_Name = $request->input('HotelNameField2');
          $updatecustomerDetails->Shop_Name = $request->input('ShopNameField2');
          $updatecustomerDetails->Customer_Type = $request->input('custTypeField2');

          $updatecustomerDetails->save();

          return redirect()->route('customers.show',$updatecustomerDetails->Cust_ID);
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
