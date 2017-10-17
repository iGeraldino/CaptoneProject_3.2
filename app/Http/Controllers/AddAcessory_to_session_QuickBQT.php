<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Cart;
use Auth;
use App\Http\Requests;
use Session;

class AddAcessory_to_session_QuickBQT extends Controller
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
          $accessories = DB::select('CALL AvailableAcessories_Records()');

          $countofAcessories =  Cart::instance('OrderedBqt_Acessories')->count();

          $Acessory_ID = $request->AcrsID_Field;
          $Acessory_name = $request->AcrsName_Field;
          $Original_Price = $request->AcessoryOrigInputPrice_Field;
          //$order_ID = $request->AcessoryorderID_Field;
          $descision = $request->AcessoryDecision_Field;//if it is N then there should be a new price
          $New_Price = $request->AcessoryNewPrice_Field;//new price set by the user
          $Qty = $request->AcessoryQTY_Field;
          $image = $request->Acrs_Image_Field;



    //-------------------------------------------------------------sends the data to the session cart.
          Cart::instance('AllofAcrs')->destroy();
          foreach($accessories as $Acrs){
              Cart::instance('AllofAcrs')->add(['id'=>$Acrs->ACC_ID,'name' =>$Acrs->name,
               'qty'=> $Acrs->qty, 'price' => $Acrs->price,'options'=>['qtyR'=>$Acrs->qty]]);
          }

          //dd(Cart::instance('AllofAcrs')->content());

          foreach(Cart::instance('AllofAcrs')->content() as $acrs){
            $qtyRemaining = $acrs->options->qtyR;
            foreach(Cart::instance('QuickOrderedBqt_Acessories')->content() as $a_row){
              if($a_row->id == $acrs->id){
                $qtyRemaining = $qtyRemaining - $a_row->qty;
                Cart::instance('AllofAcrs')->update($acrs->rowId,['options'=>['qtyR'=>$qtyRemaining]]);
              }
            }

            foreach(Cart::instance('QuickOrdered_Bqt')->content() as $row){
              foreach(Cart::instance('QuickFinalBqt_Flowers')->content() as $Acrow){
                if($Acrow->options->bqt_ID == $row->id){
                  $qtyRemaining = $qtyRemaining - ($Acrow->qty*$row->qty);
                  Cart::instance('AllofAcrs')->update($row->rowId,['options'=>['qtyR'=>$qtyremaining]]);
                }
              }//end of foreach of the acessories cart
            }
          }

          foreach(Cart::instance('AllofAcrs')->content() as $R_acrs){
            if($R_acrs->id == $Acessory_ID){
              if($Qty > $R_acrs->options->qtyR){
                Session::put('Added_AcessoryToBQT_QuickOrder', 'Fail');
                return redirect()->back();
              }
            }
          }

//dd(Cart::instance('AllofAcrs')->content());

          //dd(Cart::instance('AllofAcrs')->content());
          if(Cart::instance('QuickOrderedBqt_Acessories')->count() == 0){
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

                  Cart::instance('QuickOrderedBqt_Acessories')
                  ->add(['id' => $Acessory_ID, 'name' => $Acessory_name, 'qty' => $Qty, 'price' => $derived_Sellingprice,
                  'options' => ['orig_price' => $Original_Price,'T_Amt' => $final_total_Amount,'image'=>$image,'priceType'=>$descision]]);
          }
          else{
              echo 'may laman';
              $Insertion = 0;
              foreach(Cart::instance('QuickOrderedBqt_Acessories')->content() as $row){
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

                      Cart::instance('QuickOrderedBqt_Acessories')->update($row->rowId,['qty' => $TotalQty,'price' => $derived_Sellingprice,'options'=>['T_Amt' => $final_total_Amount,'orig_price' => $Original_Price,'image'=>$image,'priceType'=>$descision]]);
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

                      Cart::instance('QuickOrderedBqt_Acessories')
                      ->add(['id' => $Acessory_ID, 'name' => $Acessory_name, 'qty' => $Qty, 'price' => $derived_Sellingprice,
                      'options' => ['orig_price' => $Original_Price,'T_Amt' => $final_total_Amount,'image'=>$image,'priceType'=>$descision]]);
              }
          }//end of outer else

          Session::put('Added_AcessoryToBQT_QuickOrder', 'Successful');
            return redirect()-> back();
          //return redirect()->route('Order.CustomizeaBouquet');
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
          $accessories = DB::select('CALL AvailableAcessories_Records()');


          //-------------------------------------------------------------sends the data to the session cart.
                Cart::instance('AllofAcrs')->destroy();
                foreach($accessories as $Acrs){
                    Cart::instance('AllofAcrs')->add(['id'=>$Acrs->ACC_ID,'name' =>$Acrs->name,
                     'qty'=> $Acrs->qty, 'price' => $Acrs->price,'options'=>['qtyR'=>$Acrs->qty]]);
                }

                //dd(Cart::instance('AllofAcrs')->content());

                foreach(Cart::instance('AllofAcrs')->content() as $acrs){
                  $qtyRemaining = $acrs->options->qtyR;
                  foreach(Cart::instance('QuickOrderedBqt_Acessories')->content() as $a_row){
                    if($a_row->id == $acrs->id){
                      $qtyRemaining = $qtyRemaining - $a_row->qty;
                      Cart::instance('AllofAcrs')->update($acrs->rowId,['options'=>['qtyR'=>$qtyRemaining]]);
                    }
                  }

                  foreach(Cart::instance('QuickOrdered_Bqt')->content() as $row){
                    foreach(Cart::instance('QuickFinalBqt_Flowers')->content() as $Acrow){
                      if($Acrow->options->bqt_ID == $row->id){
                        $qtyRemaining = $qtyRemaining - ($Acrow->qty*$row->qty);
                        Cart::instance('AllofAcrs')->update($row->rowId,['options'=>['qtyR'=>$qtyremaining]]);
                      }
                    }//end of foreach of the acessories cart
                  }
                }
                //dd(Cart::instance('AllofAcrs')->content());
                $oldQTY = 0;
                foreach(Cart::instance('QuickOrderedBqt_Acessories')->content() as $row){
                  if($id == $row->id){
                    $oldQTY = $row->qty;
                  }
                }


                foreach(Cart::instance('AllofAcrs')->content() as $R_acrs){
                  if($R_acrs->id == $id){
                    if($oldQTY < $newQty){
                      $qtyadded = $newQty - $oldQTY;
                      if($qtyadded > $R_acrs->options->qtyR){
                        Session::put('Added_AcessoryToBQT_QuickOrder', 'Fail');
                        return redirect()->back();
                      }
                    }
                  }
                }


         foreach(Cart::instance('QuickOrderedBqt_Acessories')->content() as $row){
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



                  Cart::instance('QuickOrderedBqt_Acessories')->update($row->rowId,['qty' => $newQty,
                  'price' => $derived_Sellingprice,
                  'options'=>['T_Amt' => $final_total_Amount,
                  'orig_price' => $orig_Price ,
                  'image'=>$image,'priceType'=>$descision]]);

                  $Insertion = 0;
                  break;
              }//end of if
          }//end of foreach
          Session::put('Update_AcessoryToBQT_QuickOrder', 'Successful');
          return redirect()-> back();
          //return redirect()->route('Order.CustomizeaBouquet');
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
