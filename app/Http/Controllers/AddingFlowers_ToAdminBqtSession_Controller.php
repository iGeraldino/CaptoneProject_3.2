<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon\Carbon;
use Session;
use Auth;
use App\flower_details;
use \Cart;
use Illuminate\Support\Facades\DB;


class AddingFlowers_ToAdminBqtSession_Controller extends Controller
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
      if(auth::check() == false){
          Session::put('loginSession','fail');
          return redirect() -> route('adminsignin');
      }
      else{
            Cart::instance('OrderedBqt_Flowers')->count();

            $Flower_ID = $request->BqtFlwrID_Field;
            $Original_Price = $request->BqtOrigInputPrice_Field;
            $Qty = $request->BqtQTY_Field;


            $flower_details = flower_details::find($Flower_ID);//search for details of specific flower

            if(Cart::instance('AdminBqt_Flowers')->count() == 0){
                //echo 'wala pang laman';
                    $final_total_Amount = 0;
                    $derived_Sellingprice = 0;

                        if($Qty >= $flower_details->QTY_of_Wholesale){
                          $derived_Sellingprice =
                            $Original_Price - (($Original_Price * $flower_details->WholeSalePrice_Decrease)/100);
                          //computes for the selling price that reached the required qty for wholesale pricing
                          $final_total_Amount = $derived_Sellingprice * $Qty;
                        }//checks if the qty reached the Limit of the needed qty for wholesale
                        else{
                          $derived_Sellingprice = $Original_Price;
                          $final_total_Amount = $derived_Sellingprice * $Qty;
                        }//end of inner else


                    Cart::instance('AdminBqt_Flowers')
                    ->add(['id' => $Flower_ID, 'name' => $flower_details->flower_name, 'qty' => $Qty, 'price' => $derived_Sellingprice,
                    'options' => ['Orig_Price'=>$Original_Price,'T_Amt' => $final_total_Amount,'image'=> $flower_details->Image]]);
            }
            else{
                //echo 'may laman';
                $Insertion = 0;
            foreach(Cart::instance('AdminBqt_Flowers')->content() as $row){
                if($row->id == $Flower_ID){
                    // echo $row->rowId;
                    //for existing item in the cart update a specific record
                    $TotalQty = $row->qty + $Qty;
                    $final_total_Amount = 0;
                    $derived_Sellingprice = 0;

                        if($TotalQty>=$flower_details->QTY_of_Wholesale){
                          $derived_Sellingprice =
                            $Original_Price - (($Original_Price * $flower_details->WholeSalePrice_Decrease)/100);
                          //computes for the selling price that reached the required qty for wholesale pricing
                           $final_total_Amount = $derived_Sellingprice * $TotalQty;
                        }//checks if the qty reached the Limit of the needed qty for wholesale
                        else{
                          $derived_Sellingprice = $Original_Price;
                          $final_total_Amount = $derived_Sellingprice * $TotalQty;
                        }//end of inner else

                    Cart::instance('AdminBqt_Flowers')->update($row->rowId,['qty' => $TotalQty,'price' => $derived_Sellingprice,
                    'options'=>['Orig_Price'=>$row->options->Orig_Price,'T_Amt' => $final_total_Amount,'image'=>$row->options->image]]);
                    $Insertion = 0;
                    break;
                }//end of if
                else{
                    //for none existing item in the cart create a new record
                    $Insertion = 1;//this indicates that there will be an insertion of new data
                }//end of else
            }//end of foreach
                if($Insertion == 1){
                  //echo 'wala pang laman';
                      $final_total_Amount = 0;
                      $derived_Sellingprice = 0;

                          if($Qty >= $flower_details->QTY_of_Wholesale){
                            $derived_Sellingprice =
                              $Original_Price - (($Original_Price * $flower_details->WholeSalePrice_Decrease)/100);
                            //computes for the selling price that reached the required qty for wholesale pricing
                            $final_total_Amount = $derived_Sellingprice * $Qty;
                          }//checks if the qty reached the Limit of the needed qty for wholesale
                          else{
                            $derived_Sellingprice = $Original_Price;
                            $final_total_Amount = $derived_Sellingprice * $Qty;
                          }//end of inner else

                      Cart::instance('AdminBqt_Flowers')
                      ->add(['id' => $Flower_ID, 'name' => $flower_details->flower_name, 'qty' => $Qty, 'price' => $derived_Sellingprice,
                      'options' => ['Orig_Price'=>$Original_Price,'T_Amt' => $final_total_Amount,'image'=> $flower_details->Image]]);
                }
        }//end of outer else

            Session::put('Added_FlowerToBQT_Order', 'Successful');
           return redirect()->back();
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
       if(auth::check() == false){
           Session::put('loginSession','fail');
           return redirect() -> route('adminsignin');
           Cart::instance('OrderedBqt_Flowers')->destroy();
       }
       else{
         $newQty = $request->QuantityField;
         $flower_details = flower_details::find($id);

        foreach(Cart::instance('AdminBqt_Flowers')->content() as $row){
             if($row->id == $id){
                 // echo $row->rowId
                 $final_total_Amount = 0;
                 $derived_Sellingprice = 0;
                 $orig_Price = $row->options['Orig_Price'];
                 $image = $row->options['image'];

                     if($newQty>=$flower_details->QTY_of_Wholesale){
                       $derived_Sellingprice =
                         $row->options['Orig_Price'] - (($row->options['Orig_Price'] * $flower_details->WholeSalePrice_Decrease)/100);
                       //computes for the selling price that reached the required qty for wholesale pricing
                       $final_total_Amount = $derived_Sellingprice * $newQty;
                     }//checks if the qty reached the Limit of the needed qty for wholesale
                     else{
                       $derived_Sellingprice = $row->options['Orig_Price'];
                       $final_total_Amount = $derived_Sellingprice * $newQty;
                     }//end of inner else

                 Cart::instance('AdminBqt_Flowers')->update($row->rowId,['qty' => $newQty,'price' => $derived_Sellingprice,
                 'options'=>['T_Amt' => $final_total_Amount,
                 'Orig_Price' => $orig_Price ,'image'=>$row->options->image]]);
                 $Insertion = 0;
                 break;
             }//end of if
             else{
               Session::put('Update_FlowerToAdminBQT_Order', 'NoChange');
                 //for none existing item in the cart create a new record
                 //$Insertion = 1;//this indicates that there will be an insertion of new data
             }//end of else
         }//end of foreach*/

         Session::put('Update_FlowerToAdminBQT_Order', 'Successful');
             return redirect()-> back();

       }//
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
