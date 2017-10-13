<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\flower_details;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Session;
use \Cart;
use Auth;
class Specific_Order_Controller extends Controller
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
        if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
                        //
                        //$flower_Det = flower_details::find($request->FLowerList);
                        $AvailableFlowers = DB::select('call wonderbloomdb2.Viewing_Flowers_With_UpdatedPrice()');

                       // dd($flower_Det);
                       // $Order_ID = $request->orderID_Field;//gets the ID of the Order
                        //$Flower_ID = $request->FLowerList;//gets the ID of the flower
                        //these fields are for the conditions
                        //$Descision = $request->Decision_Field;
                        //$T_QTY = $request->QTY_Field;
                        //$original_Price = 0;
                        //$final_Unitprice = 0;
                        //$total_AMT = 0;

                         Cart::instance('Ordered_Flowers')->count();

                        $Flower_ID = $request->FLowerList;
                        $Original_Price = $request->OrigInputPrice_Field;
                        $order_ID = $request->orderID_Field;
                        $descision = $request->Decision_Field;//if it is N then there should be a new price
                        $New_Price = $request->NewPrice_Field;//new price set by the user
                        $Qty = $request->QTY_Field;
                        $image = $request->flower_image;

                        $flower_details = flower_details::find($Flower_ID);//search for details of specific flower
                        $Flower_name = $flower_details->flower_name;

                        if(Cart::instance('Ordered_Flowers')->count() == 0){
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

                                Cart::instance('Ordered_Flowers')
                                ->add(['id' => $Flower_ID, 'name' => $Flower_name, 'qty' => $Qty, 'price' => $derived_Sellingprice, 
                                'options' => ['orig_price' => $Original_Price,'T_Amt' => $final_total_Amount,'image'=>$image,'priceType'=>$descision]]);
                        }
                        else{
                            echo 'may laman';
                            $Insertion = 0;
                        foreach(Cart::instance('Ordered_Flowers')->content() as $row){
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
                                
                                Cart::instance('Ordered_Flowers')->update($row->rowId,['qty' => $TotalQty,'price' => $derived_Sellingprice,'options'=>['T_Amt' => $final_total_Amount,'orig_price' => $Original_Price,'image'=>$image,'priceType'=>$descision]]);
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

                                    Cart::instance('Ordered_Flowers')
                                    ->add(['id' => $Flower_ID, 'name' => $Flower_name, 'qty' => $Qty, 'price' => $derived_Sellingprice, 
                                    'options' => ['orig_price' => $Original_Price,'T_Amt' => $final_total_Amount,'image'=>$image,'priceType'=>$descision]]);
                            }
                    }//end of outer else

        Session::put('AddFlower_To_myOrder', 'Successful');
             return view('Orders.creationOfOrders')
             ->with('FlowerList',$AvailableFlowers);
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
        if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            $Exploded_ID = explode("_",$id);
            $flower_Det = DB::select('CALL specific_Flower_in_specific_order(?,?)',array($Exploded_ID[0],$Exploded_ID[1]));
            //echo('$Exploded_ID[0] = '. $Exploded_ID[0]);
           // echo('$Exploded_ID[1] = '. $Exploded_ID[1]);
            $orderFlowers = DB::select('CALL specific_Order_flower(?,?);',array($Exploded_ID[0],$Exploded_ID[1]));

            //dd($orderFlowers);

            return view('Orders.update_Qty_of_Flower_Specific_Order')
            ->with('flower_Det',$flower_Det)
            ->with('orderFlower',$orderFlowers);
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
        if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            $Exploded_ID = explode("_",$id);
           


            
            $Order_ID = $Exploded_ID[0];//gets the ID of the Order
            $Flower_ID = $Exploded_ID[1];//gets the ID of the flower
            //these fields are for the conditions
            $Descision = $request->Decision_Field;
            $T_QTY = $request->QTY_Field;
            $original_Price = 0;
            $final_Unitprice = 0;
            $total_AMT = 0;

            if($Descision == 'O'){
                $original_Price = $request->OrigInputPrice_Field;//gets the original price from the database because the decision is to get the original price not the new price set by the user  
                if($T_QTY >= $request->WholesaleQTY_Field){
                   //gets the wholesale price then multiply it to the qty set by the user
                   $final_Unitprice = $original_Price-(($original_Price*$request->Decrease_Field)/100);
                   $total_AMT = $final_Unitprice * $T_QTY;
                }//end of if
                else{
                    // gets the original price and multiplies it to the qty set by the user
                    $total_AMT = $original_Price * $T_QTY;
                }//end of else
            
            }

            else if($Descision == 'N'){
                $original_Price = $request->NewPrice_Field;//gets the new price from the database because the decision is to get the new price set by the user not the price computed by the system 
                $total_AMT = $original_Price * $T_QTY;//computes the total
            }
            

            $update_OrderDetails_of_Flower = DB::select('CALL updating_orderdetials_of_flower(?,?,?,?,?)',array($Order_ID,$Flower_ID,$T_QTY,$original_Price,$total_AMT));

                return redirect()->route('Sales_Order.edit',$id);
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
