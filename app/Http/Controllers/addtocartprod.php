<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Db;
use Session;
use Cart;
use App\flower_details;

class addtocartprod extends Controller
{
    public function deleteprod($id){
      foreach(Cart::instance('flowerwish')->content() as $row){

        if($row->id == $id){

          Cart::instance('flowerwish')->remove($row->rowId,$id);


        }


      }
      return back();
    }

    public function deletboq($id){

      foreach(Cart::instance('finalBoqCart')->content() as $row){

        if($row->id == $id){
          Cart::instance('finalBoqCart')->remove($row->rowId);
        }
      }
      return back();

    }


    public function deletboquet($id){

      foreach(Cart::instance('finalboqcart')->content() as $row){

        if($row->id == $id){

          Cart::instance('finalboqcart')->remove($row->rowId,$id);


        }


      }
      return back();

    }

}
