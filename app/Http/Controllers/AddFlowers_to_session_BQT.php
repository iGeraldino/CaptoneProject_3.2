<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Cart;
use App\flower_details;
use Session;
use Auth;

use App\Http\Requests;

class AddFlowers_to_session_BQT extends Controller
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
        /*if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
            Cart::instance('OrderedBqt_Flowers')->destroy();
        }
        else{     */
             Cart::instance('OrderedBqt_Flowers')->count();

            $Flower_ID = $request->BqtFlwrID_Field;
            $Original_Price = $request->BqtOrigInputPrice_Field;
           // $order_ID = $request->orderID_Field;
            $descision = $request->BqtDecision_Field;//if it is N then there should be a new price
            $New_Price = $request->BqtNewPrice_Field;//new price set by the user
            $Qty = $request->BqtQTY_Field;

            $flower_details = flower_details::find($Flower_ID);//search for details of specific flower
            $Flower_name = $flower_details->flower_name;
            $image = $flower_details->Image;

            if(Cart::instance('OrderedBqt_Flowers')->count() == 0){
                echo 'wala pang laman';
                    $final_total_Amount = 0;
                    $derived_Sellingprice = 0;
                    if($descision == 'O'){
                        if($Qty>=$flower_details->QTY_of_Wholesale){
                          $derived_Sellingprice =
                            $Original_Price - (($Original_Price * $flower_details->WholeSalePrice_Decrease)/100);
                          //computes for the selling price that reached the required qty for wholesale pricing
                          $final_total_Amount = $derived_Sellingprice * $Qty;
                        }//checks if the qty reached the Limit of the needed qty for wholesale
                        else{
                          $derived_Sellingprice = $Original_Price;
                          $final_total_Amount = $derived_Sellingprice * $Qty;
                        }//end of inner else
                    }//end of if
                    else{
                          $derived_Sellingprice = $New_Price;
                          $final_total_Amount = $New_Price * $Qty;
                    }//end of outer else(this is automatically understood that it is newPrice)

                    Cart::instance('OrderedBqt_Flowers')
                    ->add(['id' => $Flower_ID, 'name' => $Flower_name, 'qty' => $Qty, 'price' => $derived_Sellingprice,
                    'options' => ['orig_price' => $Original_Price,'T_Amt' => $final_total_Amount,'image'=>$image,'priceType'=>$descision]]);
            }
            else{
                echo 'may laman';
                $Insertion = 0;
            foreach(Cart::instance('OrderedBqt_Flowers')->content() as $row){
                if($row->id == $Flower_ID){
                    // echo $row->rowId;
                    //for existing item in the cart update a specific record
                    $TotalQty = $row->qty + $Qty;
                    $final_total_Amount = 0;
                    $derived_Sellingprice = 0;
                    if($descision == 'O'){
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
                    }//end of if
                    else{
                          $derived_Sellingprice = $New_Price;
                          $final_total_Amount = $New_Price * $TotalQty;
                    }//end of outer else(this is automatically understood that it is newPrice)

                    Cart::instance('OrderedBqt_Flowers')->update($row->rowId,['qty' => $TotalQty,'price' => $derived_Sellingprice,'options'=>['T_Amt' => $final_total_Amount,'orig_price' => $Original_Price,'image'=>$image,'priceType'=>$descision]]);
                    $Insertion = 0;
                    break;
                }//end of if
                else{
                    //for none existing item in the cart create a new record
                    $Insertion = 1;//this indicates that there will be an insertion of new data
                }//end of else
            }//end of foreach
                if($Insertion == 1){
                    echo 'wala pang kamuka';
                        $final_total_Amount = 0;
                        $derived_Sellingprice = 0;
                        if($descision == 'O'){
                            if($Qty>=$flower_details->QTY_of_Wholesale){
                              $derived_Sellingprice =
                                $Original_Price - (($Original_Price * $flower_details->WholeSalePrice_Decrease)/100);
                              //computes for the selling price that reached the required qty for wholesale pricing
                              $final_total_Amount = $derived_Sellingprice * $Qty;
                            }//checks if the qty reached the Limit of the needed qty for wholesale
                            else{
                              $derived_Sellingprice = $Original_Price;
                              $final_total_Amount = $derived_Sellingprice * $Qty;
                            }//end of inner else
                        }//end of if
                        else{
                              $derived_Sellingprice = $New_Price;
                              $final_total_Amount = $New_Price * $Qty;
                        }//end of outer else(this is automatically understood that it is newPrice)

                        Cart::instance('OrderedBqt_Flowers')
                        ->add(['id' => $Flower_ID, 'name' => $Flower_name, 'qty' => $Qty, 'price' => $derived_Sellingprice,
                        'options' => ['orig_price' => $Original_Price,'T_Amt' => $final_total_Amount,'image'=>$image,'priceType'=>$descision]]);
                }
        }//end of outer else

            Session::put('Added_FlowerToBQT_Order', 'Successful');
              return redirect()-> route('Long_Sales_Order.index');

            //return redirect()->route('Order.CustomizeaBouquet');
     // }//END OF MAIN ELSE

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

       /* if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
            Cart::instance('OrderedBqt_Flowers')->destroy();
        }
        else{  */
          $newQty = $request->QuantityField;
          $order_ID = $request->ID_Field;
          $descision = $request->Decision_Field;
          $flower_details = flower_details::find($id);

         foreach(Cart::instance('OrderedBqt_Flowers')->content() as $row){
              if($row->id == $id){
                  // echo $row->rowId
                  $final_total_Amount = 0;
                  $derived_Sellingprice = 0;
                  $orig_Price = $row->options['orig_price'];
                  $image = $row->options['image'];

                  if($descision == 'O'){
                      if($newQty>=$flower_details->QTY_of_Wholesale){
                        $derived_Sellingprice =
                          $row->options['orig_price'] - (($row->options['orig_price'] * $flower_details->WholeSalePrice_Decrease)/100);
                        //computes for the selling price that reached the required qty for wholesale pricing
                        $final_total_Amount = $derived_Sellingprice * $newQty;
                      }//checks if the qty reached the Limit of the needed qty for wholesale
                      else{
                        $derived_Sellingprice = $row->options['orig_price'];
                        $final_total_Amount = $derived_Sellingprice * $newQty;
                      }//end of inner else
                  }//end of if
                  else{
                        $derived_Sellingprice = $row->price;
                        $final_total_Amount = $row->price * $newQty;
                  }//end of outer else(this is automatically understood that it is newPrice)

                  Cart::instance('OrderedBqt_Flowers')->update($row->rowId,['qty' => $newQty,'price' => $derived_Sellingprice,'options'=>['T_Amt' => $final_total_Amount,'orig_price' => $orig_Price ,'image'=>$image,'priceType'=>$descision]]);
                  $Insertion = 0;
                  break;
              }//end of if
              else{
                  //for none existing item in the cart create a new record
                  $Insertion = 1;//this indicates that there will be an insertion of new data
              }//end of else
          }//end of foreach*/

          Session::put('Update_FlowerToBQT_Order', 'Successful');
              return redirect()-> route('Long_Sales_Order.index');

          //return redirect()->route('Order.CustomizeaBouquet');
        //}//
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
