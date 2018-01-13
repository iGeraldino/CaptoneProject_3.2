<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Carbon\Carbon;
use Session;
use Auth;
use App\Sales_Qoutation;
use \Cart;


class quickOrderProcess_Controller extends Controller
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
        
        if(auth::guard('admins')->user()->type == '1'){
            
        
        
        $transatype = $request->Trans_typeField;
        $CustStat = $request->customer_stat;
        $CustID = $request->idfield;
        $CustFname = $request->Cust_FNameField2;
        $CustMname = $request->Cust_MNameField2;
        $CustLname = $request->Cust_LNameField2;
        $CustContact = $request->ContactNum_Field2;
        $CustEmail = $request->email_Field2;
        $CustType = $request->custTypeFieldVal;
        $CustHotel = $request->hotelNameField2;
        $CustShop = $request->shopNameField2;

      /*  echo '<h3><b>$transatype = </b>'.$transatype.'</h3>';
        echo '<h3><b>$CustStat = </b>'.$CustStat.'</h3>';
        echo '<h3><b>$CustID = </b>'.$CustID.'</h3>';
        echo '<h3><b>$CustFname = </b>'.$CustFname.'</h3>';
        echo '<h3><b>$CustMname = </b>'.$CustMname.'</h3>';
        echo '<h3><b>$CustLname = </b>'.$CustLname.'</h3>';
        echo '<h3><b>$CustContact = </b>'.$CustContact.'</h3>';
        echo '<h3><b>$CustEmail = </b>'.$CustEmail.'</h3>';
        echo '<h3><b>$CustType = </b>'.$CustType.'</h3>';
        echo '<h3><b>$CustHotel = </b>'.$CustHotel.'</h3>';
        echo '<h3><b>$CustShop = </b>'.$CustShop.'</h3>';

*/
        Session::remove('newCustomerDetails');
        $CustomerDetails = collect([$transatype,$CustStat,$CustID,$CustFname,$CustMname,
        $CustLname,$CustContact,$CustEmail,$CustType,$CustHotel,$CustShop]);
        //dd($CustomerDetails);
        Session::put('newCustomerDetails', $CustomerDetails);
        return view('Orders.quickOrderSummary');
        }
        else if(auth::guard('admins')->user()->type == '2'){
            $transatype = $request->Trans_typeField;
        $CustStat = $request->customer_stat;
        $CustID = $request->idfield;
        $CustFname = $request->Cust_FNameField2;
        $CustMname = $request->Cust_MNameField2;
        $CustLname = $request->Cust_LNameField2;
        $CustContact = $request->ContactNum_Field2;
        $CustEmail = $request->email_Field2;
        $CustType = $request->custTypeFieldVal;
        $CustHotel = $request->hotelNameField2;
        $CustShop = $request->shopNameField2;

      /*  echo '<h3><b>$transatype = </b>'.$transatype.'</h3>';
        echo '<h3><b>$CustStat = </b>'.$CustStat.'</h3>';
        echo '<h3><b>$CustID = </b>'.$CustID.'</h3>';
        echo '<h3><b>$CustFname = </b>'.$CustFname.'</h3>';
        echo '<h3><b>$CustMname = </b>'.$CustMname.'</h3>';
        echo '<h3><b>$CustLname = </b>'.$CustLname.'</h3>';
        echo '<h3><b>$CustContact = </b>'.$CustContact.'</h3>';
        echo '<h3><b>$CustEmail = </b>'.$CustEmail.'</h3>';
        echo '<h3><b>$CustType = </b>'.$CustType.'</h3>';
        echo '<h3><b>$CustHotel = </b>'.$CustHotel.'</h3>';
        echo '<h3><b>$CustShop = </b>'.$CustShop.'</h3>';

*/
        Session::remove('newCustomerDetails');
        $CustomerDetails = collect([$transatype,$CustStat,$CustID,$CustFname,$CustMname,
        $CustLname,$CustContact,$CustEmail,$CustType,$CustHotel,$CustShop]);
        //dd($CustomerDetails);
        Session::put('newCustomerDetails', $CustomerDetails);
        return view('Orders.quickOrderSummary');
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
