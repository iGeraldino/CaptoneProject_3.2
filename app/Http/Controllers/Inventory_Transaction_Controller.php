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
      if(auth::guard('admins')->check() == false){
          Session::put('loginSession','fail');
          return redirect() -> route('adminsignin');
      }
      else{
          $batches = DB::select('CALL list_of_batches()');
          $Flower_Transactions = DB::select('call Inventory_Transaction_in_Flowers()');
          $type = 'Flower';
         return view('inventory.inventorytransaction')
          ->with('batch',$batches)
          ->with('Itype',$type)
          ->with('transactions',$Flower_Transactions);
      }
    }

    //
    public function Inventory_Trans(){
      if(auth::guard('admins')->check() == false){
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
      if(auth::guard('admins')->check() == false){
          Session::put('loginSession','fail');
          return redirect() -> route('adminsignin');
      }
      else{
          $batches = DB::select('CALL list_of_batches()');
          $Acrs_Transactions = DB::select('call Inventory_Transaction_in_Acrs()');
          $type = 'Acessories';
          return view('inventory.inventorytransaction')
          ->with('batch',$batches)
          ->with('Itype',$type)
          ->with('transactions',$Acrs_Transactions);
      }
    }

}
