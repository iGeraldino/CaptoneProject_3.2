<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Db;
use Session;
use App\Http\Controllers\Controller;
use App\accessories;
use App\flower_details;
use App\bouquet_details;
use Cart;
use PDF;
use App;

class create_bouquet extends Controller
{
    public function floweracc() {
      $bouqacc = accessories::all();
      $bouqflower = DB::select("CALL Viewing_Flowers_With_UpdatedPrice()");

//      Cart::instance('tempflowercart')->destroy();xx
      return view('customer_side.pages.create_bouquet')
      ->with('bouqacc', $bouqacc)
      ->with('bouqflower', $bouqflower);

    }

    public function addflowerbouq(Request $request){

      $addflower = flower_details::find($request->input('ID'));
      $fp = $request->input('fp');
      $image = $addflower -> Image;
      $qty = $request->input('qty');
      $check = 0;

      if($request->input('qty') == null){
          return redirect('createbouquet');
          //error
        }
      else{
          $qty = $request -> input('qty');
          //no error
      }


      if(Cart::instance('tempflowercart')->count() == 0){
        //wala pang laman

        $final_total_Amount = 0;//for the finalprice to be inserted in the cart
        $derived_Sellingprice = 0;//for the price

        if($qty>=$addflower->QTY_of_Wholesale){
          $derived_Sellingprice = $fp - (($fp * $addflower->WholeSalePrice_Decrease)/100);
          //computes for the selling price that reached the required qty for wholesale pricing
          $final_total_Amount = $derived_Sellingprice * $qty;
        }//checks if the qty reached the Limit of the needed qty for wholesale
        else{
          $derived_Sellingprice = $fp;
          $final_total_Amount = $derived_Sellingprice * $qty;
        }//end of inner else

        Cart::instance('tempflowercart')
        ->add(['id' => $request->input('ID'),
        'name' => $addflower-> flower_name, 'qty' => $qty,
        'price' => $derived_Sellingprice,
        'options' => ['Orig_Amt'=>$fp,'T_Amt'=>$final_total_Amount,'image' =>  $image]]);
      }
      else{
        //may laman
        $insertion = 0;//to determine if you will be creating a new record
        foreach(Cart::instance('tempflowercart')->content() as $row){
            if($row->id == $request->input('ID')){
              //may kamuka
              $currentQty = $row->qty;
              $totqty = $currentQty + $qty;

              if($totqty>=$addflower->QTY_of_Wholesale){
                  $derived_Sellingprice = $fp - (($fp * $addflower->WholeSalePrice_Decrease)/100);
                  //computes for the selling price that reached the required qty for wholesale pricing
                  $final_total_Amount = $derived_Sellingprice * $totqty;
              }//checks if the qty reached the Limit of the needed qty for wholesale
              else{
                $derived_Sellingprice = $fp;
                $final_total_Amount = $derived_Sellingprice * $qty;
              }//end of inner else

              Cart::instance('tempflowercart')
              ->update($row->rowId,['id' => $request->input('ID'),
              'name' => $addflower-> flower_name, 'qty' => $totqty,
              'price' => $derived_Sellingprice, 'options' => ['Orig_Amt'=>$fp,'T_Amt'=>$final_total_Amount,'image' =>  $image]]);
              $insertion = 0;
              break;
            }
            else{
              //walang kamuka
              $insertion = 1;//means you must make a new record
            }
        }
        if($insertion == '1'){
          $final_total_Amount = 0;//for the finalprice to be inserted in the cart
          $derived_Sellingprice = 0;//for the price

          if($qty>=$addflower->QTY_of_Wholesale){
            $derived_Sellingprice = $fp - (($fp * $addflower->WholeSalePrice_Decrease)/100);
            //computes for the selling price that reached the required qty for wholesale pricing
            $final_total_Amount = $derived_Sellingprice * $qty;
          }//checks if the qty reached the Limit of the needed qty for wholesale
          else{
            $derived_Sellingprice = $fp;
            $final_total_Amount = $derived_Sellingprice * $qty;
          }//end of inner else

          Cart::instance('tempflowercart')
          ->add(['id' => $request->input('ID'),
          'name' => $addflower-> flower_name, 'qty' => $qty,
          'price' => $derived_Sellingprice,
          'options' => ['Orig_Amt'=>$fp,'T_Amt'=>$final_total_Amount,'image' =>  $image]]);
        }//end of insertion 1
      }//end of

      Session::put('Adding_FlowertoBouquetSession','Successful');
      return redirect('createbouquet');
    }

    public function addacc_bouqsession(Request $request){

      $addacc = accessories::find($request->input('ID'));
      $fp = $request->input('fp2');
      $qty = $request->input('qty');
      $image = $addacc->image;

      if($request->input('qty') == null){

          return redirect('createbouquet');

        }
      else{

          $qty = $request -> input('qty');

      }

      if(Cart::instance('tempacccart')->count() == 0){
        //walang laman
        $final_total_Amount = 0;
        $final_total_Amount = $qty * $fp;
        Cart::instance('tempacccart')
        ->add(['id' => $request->input('ID'), 'name' => $addacc->name,
        'qty' => $qty, 'price' => $fp, 'options' => ['orig_price' => $fp,
        'T_Amt' => $final_total_Amount,'image' =>  $image]]);
      }
      else{
        //may laman
        $insertion = 0;
        foreach(Cart::instance('tempacccart')->content() as $row){

            if($row->id == $request->ID){
              //may kamuka
              echo 'magkamuka  '.'$request->ID = '.$request->ID.'__$row_id'.$row->id;
              $final_total_Amount = 0;
              $totqty = $row->qty + $qty;
              $final_total_Amount = $totqty * $fp;

              //Cart::instance('tempacccart')->destroy();
              Cart::instance('tempacccart')->update($row->rowId,['id' => $request->ID,
              'name' => $row->name, 'qty' => $totqty,
              'price' => $row->price, 'options' => ['orig_price' => $row->options->orig_price,
              'T_Amt' => $final_total_Amount,'image' => $row->options->image]]);
              $insertion = 0;
              break;

            }
            else{
              $insertion = 1;
              //walang kamuka
            }
        }
          if($insertion == '1'){
            $final_total_Amount = 0;
            $final_total_Amount = $qty * $fp;
         Cart::instance('tempacccart')
            ->add(['id' => $request->input('ID'), 'name' => $addacc->name,
            'qty' => $qty, 'price' => $fp, 'options' => ['orig_price' => $fp,
            'T_Amt' => $final_total_Amount,'image' =>  $image]]);
          }
        }

        Session::put('Adding_AcctoBouquetSession','Successful');

    return redirect('createbouquet');

    }


    public function Updating_FLower_inTempBoquet(Request $request, $id){

       $addflower = flower_details::find($id);

        $qty = $request->input('quantity');

        foreach(Cart::instance('tempflowercart')->content() as $row){

          if($row->id == $id){
//            Cart::instance('tempflowercart')->update($row->rowId, ['qty' => $qty]); // Will update the name
            $final_total_Amount = 0;//for the finalprice to be inserted in the cart
            $derived_Sellingprice = 0;//for the price

            if($qty >= $addflower->QTY_of_Wholesale){
              $derived_Sellingprice = $row->options['Orig_Amt'] - (($row->options['Orig_Amt'] * $addflower->WholeSalePrice_Decrease)/100);
              //computes for the selling price that reached the required qty for wholesale pricing
              $final_total_Amount = $derived_Sellingprice * $qty;
            }//checks if the qty reached the Limit of the needed qty for wholesale
            else{
              $derived_Sellingprice = $row->options['Orig_Amt'];
              $final_total_Amount = $derived_Sellingprice * $qty;
            }//end of inner else

            Cart::instance('tempflowercart')
            ->update($row->rowId,['id' => $row->id,
            'name' => $row->name, 'qty' => $qty,
            'price' => $derived_Sellingprice, 'options' => ['Orig_Amt'=>$row->options['Orig_Amt'],'T_Amt'=>$final_total_Amount,'image' =>$row->options['image']]]);
          }
        }


        Session::put('Updating_FlowertoBouquetSession','Successful');

        return back();
    }

    public function deleteFlower_In_Bqt_Sesssion($id){

      //echo $id;
      foreach(Cart::instance('tempflowercart')->content() as $row){
        if($row->id == $id){
          Cart::instance('tempflowercart')->remove($row->rowId);
        }
      }

      Session::put('Delete_FlowertoBouquetSession','Successful');
      return back();
    }

    public function deleteAcrs_In_Bqt_Sesssion($id){

      //echo $id;
      foreach(Cart::instance('tempacccart')->content() as $row){
        if($row->id == $id){
          Cart::instance('tempacccart')->remove($row->rowId);
        }
      }
      Session::put('Delete_AcctoBouquetSession','Successful');
      return back();
    }


    public function updateaccessories(Request $request, $id){
        $newQty = $request->quantity;

        foreach(Cart::instance('tempacccart')->content() as $row){
            if($row->id == $id){
                $final_total_Amount = 0;
                $final_total_Amount = $newQty * $row->options->orig_price;
                Cart::instance('tempacccart')->update($row->rowId,['id' => $id,
                    'name' => $row->name, 'qty' => $newQty,
                    'price' => $row->options->orig_price, 'options' => ['orig_price' => $row->options->orig_price,
                        'T_Amt' => $final_total_Amount,'image' =>  $row->options->image]]);
            }//end of if
        }//end of foreach
        //Session::put('Update_AcessoryToBQT_Order', 'Successful');
        //return redirect()->route('Order.CustomizeaBouquet');
        Session::put('Update_AcctoBouquetSession','Successful');
        return back();
    }



    public function finalcheck(Request $request) {



      $BQT_Flower_Count = 0;
      foreach(Cart::instance('tempflowercart')->content() as $row){
          $BQT_Flower_Count += $row->qty;

      }

      $Flowers_subtotal = str_replace(array(','), array(''), Cart::instance('tempflowercart')->subtotal());

      $Acessories_subtotal = str_replace(array(','), array(''), Cart::instance('tempacccart')->subtotal());
/*           echo '<h2><b>$Flowers_subtotal = </b>'.$Flowers_subtotal.'<\h2>';
      echo '<h2><b>$Acessories_subtotal = </b>'.$Acessories_subtotal.'<\h2>';
      echo '<h2><b>BOQUET_total = </b>'.number_format($Acessories_subtotal + $Flowers_subtotal,2).'<\h2>';
      echo '<h2><b>BOQUET Flower Count = </b>'.$BQT_Flower_Count.' pcs. <\h2>';
*/

      $BQT_Price = $Acessories_subtotal + $Flowers_subtotal;


      if(Cart::instance('finalboqcart')->count() == 0){
        $bqt_Id = mt_rand();//generates a random id
        $bqtname = 'BQT-'. $bqt_Id;

        Cart::instance('finalboqcart')
             ->add(['id' => $bqt_Id, 'name' => $bqtname, 'qty' => 1, 'price' => $BQT_Price,
                'options' => ['count' => $BQT_Flower_Count]]);

        foreach(cart::instance('tempflowercart')->content() as $row){


          Cart::instance('finalflowerbqt')->add(['id' => $row->id, 'name' => $row->name, 'qty' => $row->qty, 'price' => $row->price ,'options' => ['Orig_Amt' => $row->options ->Orig_Amt, 'T_Amt' => $row ->options->T_Amt , 'image'
            => $row->options->image, 'Bqt_ID' => $bqt_Id]]);

        } // for flowers to final flowers boquet

        foreach(cart::instance('tempacccart')->content() as $row){

          Cart::instance('finalacccart')->add(['id' => $row->id, 'name' => $row->name, 'qty' => $row->qty, 'price' => $row->price ,'options' => ['Orig_Amt' => $row->options ->Orig_Amt, 'T_Amt' => $row ->options->T_Amt , 'image'
           => $row->options->image, 'Bqt_ID' => $bqt_Id]]);


        }


      } //end of if

      else{
        $newBqt_Id = '';
        foreach(Cart::instance('finalboqcart')->content() as $row){
          $newBqt_Id = $row->id;
        }
        $newBqt_Id += 1;

        $newBqtName = 'BQT-'.$newBqt_Id;
          Cart::instance('finalboqcart')
               ->add(['id' => $newBqt_Id, 'name' => $newBqtName, 'qty' => 1, 'price' => $BQT_Price,
                  'options' => ['count' => $BQT_Flower_Count]]);

        foreach(cart::instance('tempflowercart')->content() as $row){


          Cart::instance('finalflowerbqt')->add(['id' => $row->id, 'name' => $row->name, 'qty' => $row->qty, 'price' => $row->price ,'options' => ['Orig_Amt' => $row->options ->Orig_Amt, 'T_Amt' => $row ->options->T_Amt , 'image'
            => $row->options->image, 'Bqt_ID' => $newBqt_Id]]);

        } // for flowers to final flowers boquet

        foreach(cart::instance('tempacccart')->content() as $row){

          Cart::instance('finalacccart')->add(['id' => $row->id, 'name' => $row->name, 'qty' => $row->qty, 'price' => $row->price ,'options' => ['Orig_Amt' => $row->options ->Orig_Amt, 'T_Amt' => $row ->options->T_Amt , 'image'
           => $row->options->image, 'Bqt_ID' => $newBqt_Id]]);


        }


      }
      Cart::instance('tempflowercart')->destroy();
      Cart::instance('tempacccart')->destroy();

      return redirect('addtocart');

    }


    public function getViewBouquet($id) {

        $bouquet = db::table('bouquet_details')->where('bouquet_ID', $id)->get();
        $bouquetflowers =  db::select('call flowers_PerSpecificBouquet(?)', array($id));
        $bouquetaccessories = db::select('call acessories_PerBouquet(?)', array($id));

        $totalflowers = 0;
        $totalaccessories = 0;
        $accessories_ID = 0;
        $price1 = 0;
        $price2 = 0;
        $price3 = 0;

        foreach($bouquetflowers as $bouquetflowers123){

            $totalflowers += $bouquetflowers123 -> QTY ;
            $price1 += $bouquetflowers123 -> Total_Amount;
        }

        foreach($bouquetaccessories as $bouquetaccessories123){

            $totalaccessories += $bouquetaccessories123 -> QTY;
            $price2 += $bouquetaccessories123 -> Total_Amt;

        }

        $price3 = $price1 + $price2;






        //dd($bouquet);

        return view('customer_side/pages/view_bouquet')
            ->with(['bouquetdetails' => $bouquet, 'totalflowers' => $totalflowers, 'totalaccessories' => $totalaccessories,
            'bouquetflowers' => $bouquetflowers, 'bouquetaccessories' => $bouquetaccessories, 'TotalPrice' => $price3]);
    }

    public function defaultboqadd(Request $request){

        $totalprice = $request -> total;
        $totalcount = $request -> totalcount;
        $quantity = $request -> quantity;
        $id = $request -> boqid;

        $bouquetflowers =  db::select('call flowers_PerSpecificBouquet(?)', array($id));
        $bouquetaccessories = db::select('call acessories_PerBouquet(?)', array($id));


        if(Cart::instance('finalboqcart')->count() == 0) {
            //$bqt_Id = mt_rand();//generates a random id
            //$bqtname = 'BQT-' . $bqt_Id;

            Cart::instance('finalboqcart')
                ->add(['id' => $id, 'name' => 'BQT-'.$id, 'qty' => $quantity, 'price' => $totalprice,
                    'options' => ['count' => $totalcount]]);

            foreach ($bouquetflowers as $flowers) {
                Cart::instance('finalflowerbqt')->add(['id' => $flowers->flower_ID, 'name' => $flowers->flower_name,
                'qty' => $flowers->QTY, 'price' => $flowers->Final_SellingPrice,
                'options' => ['Orig_Amt' => $flowers->Final_SellingPrice, 'T_Amt' => $flowers->Total_Amount, 'image'
                => $flowers->IMG, 'Bqt_ID' => $id]]);
            }

            foreach($bouquetaccessories as $access){
                Cart::instance('finalacccart')->add(['id' => $access->Acessory_ID, 'name' => $access->Name,
                'qty' => $access->QTY, 'price' => $access->Price ,
                'options' => ['Orig_Amt' => $access->Price, 'T_Amt' => $access ->Total_Amt , 'image'
                => $access -> IMG, 'Bqt_ID' => $id]]);
            }

        }
        else{
            $validator = 0;
            $newBqt_Id = '';
            foreach(Cart::instance('finalboqcart')->content() as $row){
              if($row->id == $id)
              {
                  Cart::instance('finalboqcart')->update($row->rowId,['qty'=>$row->qty + $quantity,
                  'price'=>$row->price, 'options'=>['count' => $totalcount]]);
                  $validator = 1;
              }
                //$newBqt_Id = $row->id;
            }
            if($validator == 0)
            {
                Cart::instance('finalboqcart')
                    ->add(['id' => $id, 'name' => 'BQT-'.$id, 'qty' => $quantity, 'price' => $totalprice,
                        'options' => ['count' => $totalcount]]);

                foreach ($bouquetflowers as $flowers) {
                    Cart::instance('finalflowerbqt')->add(['id' => $flowers->flower_ID, 'name' => $flowers->flower_name,
                    'qty' => $flowers->QTY, 'price' => $flowers->Final_SellingPrice,
                    'options' => ['Orig_Amt' => $flowers->Final_SellingPrice, 'T_Amt' => $flowers->Total_Amount, 'image'
                    => $flowers->IMG, 'Bqt_ID' => $id]]);
                }//

                foreach($bouquetaccessories as $access){
                    Cart::instance('finalacccart')->add(['id' => $access->Acessory_ID, 'name' => $access->Name,
                    'qty' => $access->QTY, 'price' => $access->Price ,
                    'options' => ['Orig_Amt' => $access->Price, 'T_Amt' => $access ->Total_Amt , 'image'
                    => $access -> IMG, 'Bqt_ID' => $id]]);
                }//
            }
        }

        return redirect('addtocart');

    }






}
