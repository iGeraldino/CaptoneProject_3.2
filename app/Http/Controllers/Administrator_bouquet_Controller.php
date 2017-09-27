<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon\Carbon;
use Session;
use App\bouquet_details;
use Auth;
use \Cart;
use Illuminate\Support\Facades\DB;


class Administrator_bouquet_Controller extends Controller
{
    //
    public function Creation_of_bouquet(){
      $AvailableFlowers = DB::select('call wonderbloomdb2.Viewing_Flowers_With_UpdatedPrice()');
      $accessories = DB::select('CALL Acessories_Records()');
      //
      return view('bouquet.creationof_Bouquet_ServerSide')
      ->with('accessories',$accessories)
      ->with('FlowerList',$AvailableFlowers);
    }

    public function DeleteFlower_per_AdminBqt_Session($flower_ID)
    {
          if(auth::check() == false){
              Session::put('loginSession','fail');
              return redirect() -> route('adminsignin');
          }
          else{
            foreach(Cart::instance('AdminBqt_Flowers')->content() as $row){
              if($row->id == $flower_ID){
                echo $row->id;
                   Cart::instance('AdminBqt_Flowers')->remove($row->rowId);
                    Session::put('Deleted_FlowerfromAdminBQT_Order', 'Successful');
              }
            }
            return redirect()->back();
        }
    }//end of function

    public function Clear_AdminBouquet()
    {
          if(auth::check() == false){
              Session::put('loginSession','fail');
              return redirect() -> route('adminsignin');
          }
          else{

        Cart::instance('AdminBqt_Flowers')->destroy();
        Cart::instance('AdminBqt_Acessories')->destroy();

        Session::put('AdminBqtClearSession', 'Successful');
                return redirect()->back();
        //returns to the creation of flowers
      }
    }//end of function

  public function DeleteAcessory_per_SessionAdminBqt($Acessory_ID)
  {
    if(auth::check() == false){
        Session::put('loginSession','fail');
        return redirect() -> route('adminsignin');
    }
    else{
      echo $Acessory_ID;
      foreach(Cart::instance('AdminBqt_Acessories')->content() as $row){
        if($row->id == $Acessory_ID){
          Cart::instance('AdminBqt_Acessories')->remove($row->rowId);
          Session::put('Deleted_AcessoryfromAdminBQT', 'Successful');
        }
      }
      return redirect()->back();
    }
  }//end of function

  public function saveAdminBqt(Request $request){

  }

}
