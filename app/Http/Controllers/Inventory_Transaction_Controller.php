<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
USE Auth;
use Image;
use App\Http\Requests;

class Inventory_Transaction_Controller extends Controller
{
  //
    public function FlowerInventory_Trans(){
      if(auth::check() == false){
          Session::put('loginSession','fail');
          return redirect() -> route('adminsignin');
      }
      else{
          $Flower_Transactions = DB::select('call Inventory_Transaction_in_Flowers()');
         return view('inventory.inventorytransaction')
          ->with('transactions',$Flower_Transactions);
      }
    }

    //
    public function FlowerInventory_Trans(){
      if(auth::check() == false){
          Session::put('loginSession','fail');
          return redirect() -> route('adminsignin');
      }
      else{
          $Flower_Transactions = DB::select('call Inventory_Transaction_in_Flowers()');
         return view('inventory.inventorytransaction')
          ->with('transactions',$Flower_Transactions);
      }
    }

    //
    public function AcrsInventory_Trans(){
      if(auth::check() == false){
          Session::put('loginSession','fail');
          return redirect() -> route('adminsignin');
      }
      else{
          $Acrs_Transactions = DB::select('call Inventory_Transaction_in_Acrs()');
          return view('inventory.inventorytransaction')
          ->with('transactions',$Acrs_Transactions);
      }
    }

}
