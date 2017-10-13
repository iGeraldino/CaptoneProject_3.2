<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Cart;
use App\Http\Requests;
use Session;
use Auth;

class AddingAcessoriesto_OrderedBouquet_Controller extends Controller
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
        if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            $countofAcessories =  Cart::instance('OrderedBqt_Acessories')->count();

            $Acessory_ID = $request->AcessoryList;
            $Acessory_name = $request->Acessoryname_List;
            $Original_Price = $request->AcessoryOrigInputPrice_Field;
            $order_ID = $request->AcessoryorderID_Field;
            $descision = $request->AcessoryDecision_Field;//if it is N then there should be a new price
            $New_Price = $request->AcessoryNewPrice_Field;//new price set by the user
            $Qty = $request->AcessoryQTY_Field;
            $image = $request->AcessoryPic_List;

            echo '<h4><b>$Acessory_ID = </b>'.$Acessory_ID.'</h4>';
            echo '<h4><b>$Acessory_name = </b>'.$Acessory_name.'</h4>';
            echo '<h4><b>$Original_Price = </b>'.$Original_Price.'</h4>';
            echo '<h4><b>$order_ID = </b>'.$order_ID.'</h4>';
            echo '<h4><b>$descision = </b>'.$descision.'</h4>';
            echo '<h4><b>$New_Price = </b>'.$New_Price.'</h4>';
            echo '<h4><b>$Qty = </b>'.$Qty.'</h4>';
            echo '<h4><b>$image = </b>'.$image.'</h4>';

            if(Cart::instance('OrderedBqt_Acessories')->count() == 0){
                echo 'wala pang laman';
                    $final_total_Amount = 0;
                    $derived_Sellingprice = 0;
                    if($descision == 'O'){
                          $derived_Sellingprice = $Original_Price;
                          $final_total_Amount = $derived_Sellingprice * $Qty;
                    }//end of if
                    else{
                          $derived_Sellingprice = $New_Price;
                          $final_total_Amount = $New_Price * $Qty;
                    }//end of outer else(this is automatically understood that it is newPrice)

                    Cart::instance('OrderedBqt_Acessories')
                    ->add(['id' => $Acessory_ID, 'name' => $Acessory_name, 'qty' => $Qty, 'price' => $derived_Sellingprice,
                    'options' => ['orig_price' => $Original_Price,'T_Amt' => $final_total_Amount,'image'=>$image,'priceType'=>$descision]]);
            }
            else{
                echo 'may laman';
                $Insertion = 0;
                foreach(Cart::instance('OrderedBqt_Acessories')->content() as $row){
                    if($row->id == $Acessory_ID){
                        // echo $row->rowId;
                        //for existing item in the cart update a specific record
                        $TotalQty = $row->qty + $Qty;
                        $final_total_Amount = 0;
                        $derived_Sellingprice = 0;
                        if($descision == 'O'){
                              $derived_Sellingprice = $Original_Price;
                              $final_total_Amount = $derived_Sellingprice * $TotalQty;
                        }//end of if
                        else{
                              $derived_Sellingprice = $New_Price;
                              $final_total_Amount = $New_Price * $TotalQty;
                        }//end of outer else(this is automatically understood that it is newPrice)

                        Cart::instance('OrderedBqt_Acessories')->update($row->rowId,['qty' => $TotalQty,'price' => $derived_Sellingprice,'options'=>['T_Amt' => $final_total_Amount,'orig_price' => $Original_Price,'image'=>$image,'priceType'=>$descision]]);
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
                              $derived_Sellingprice = $Original_Price;
                              $final_total_Amount = $derived_Sellingprice * $Qty;
                        }//end of if
                        else{
                              $derived_Sellingprice = $New_Price;
                              $final_total_Amount = $New_Price * $Qty;
                        }//end of outer else(this is automatically understood that it is newPrice)

                        Cart::instance('OrderedBqt_Acessories')
                        ->add(['id' => $Acessory_ID, 'name' => $Acessory_name, 'qty' => $Qty, 'price' => $derived_Sellingprice,
                        'options' => ['orig_price' => $Original_Price,'T_Amt' => $final_total_Amount,'image'=>$image,'priceType'=>$descision]]);
                }
            }//end of outer else

            Session::put('Added_AcessoryToBQT_Order', 'Successful');
            return redirect()->route('Order.CreateaBouquet',$order_ID);
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

        if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
             $newQty = $request->AcQuantityField;
            $order_ID = $request->ID_Field;
            $descision = $request->Decision_Field;

           foreach(Cart::instance('OrderedBqt_Acessories')->content() as $row){
                if($row->id == $id){
                     echo $row->rowId;

                    $final_total_Amount = 0;
                    $derived_Sellingprice = 0;
                    $orig_Price = $row->options['orig_price'];
                    $image = $row->options['image'];

                    if($descision == 'O'){
                          $derived_Sellingprice = $row->options['orig_price'];
                          $final_total_Amount = $derived_Sellingprice * $newQty;
                    }//end of if
                    else{
                          $derived_Sellingprice = $row->price;
                          $final_total_Amount = $row->price * $newQty;
                    }//end of outer else(this is automatically understood that it is newPrice)



                    Cart::instance('OrderedBqt_Acessories')->update($row->rowId,['qty' => $newQty,'price' => $derived_Sellingprice,'options'=>['T_Amt' => $final_total_Amount,'orig_price' => $orig_Price ,'image'=>$image,'priceType'=>$descision]]);
                    $Insertion = 0;
                    break;
                }//end of if
            }//end of foreach
            Session::put('Update_AcessoryToBQT_Order', 'Successful');
            return redirect()->route('Order.CreateaBouquet',$order_ID);
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
