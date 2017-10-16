<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Cart;
use App\flower_details;
use Session;
use Auth;

use App\Http\Requests;


class AddFlowers_to_session_QuickBQT extends Controller
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
          Cart::instance('OrderedBqt_Flowers')->destroy();
      }
      else{

        Cart::instance('QuickOrderedBqt_Flowers')->count();

       $Flower_ID = $request->BqtFlwrID_Field;
       $Original_Price = $request->BqtOrigInputPrice_Field;
      // $order_ID = $request->orderID_Field;
       $Rbatch_ID = $request->Bqtbatch_IDField;

       $descision = $request->BqtDecision_Field;//if it is N then there should be a new price
       $New_Price = $request->BqtNewPrice_Field;//new price set by the user
       $Qty = $request->BqtQTY_Field;

       //dd($Qty);

       $flower_details = flower_details::find($Flower_ID);//search for details of specific flower
       $Flower_name = $flower_details->flower_name;
       $image = $flower_details->Image;


      //-------------------------------------------------------------sends the data to the session cart.
            Cart::instance('BatchesofFLowers')->destroy();
            $batches_ofFlowers = DB::select('CALL breakdownBatchOf_Available_Flowers()');
            foreach($batches_ofFlowers as $batch){
                $batchID = $batch->Batch.'_'.$batch->flower_ID;
                $batchname = 'batch-'.$batch->Batch.'_'.$batch->Name;

                Cart::instance('BatchesofFLowers')->add(['id'=>$batchID,'name' =>$batchname,
                 'qty'=> $batch->QTYRemaining, 'price' => $batch->SellingPrice,'options'=>['qtyR'=>$batch->QTYRemaining]]);
            }

     //------------------------------------------------------------------------deducts all of the flowers that are in the cart from the flowers available in the list
            foreach(Cart::instance('BatchesofFLowers')->content() as $batches){
              $batchID = explode('_',$batches->id);
              $qtyremaining =  $batches->options->qtyR;
              foreach(Cart::instance('QuickOrdered_Flowers')->content() as $flwr){
                if($flwr->id == $batchID[1] AND $flwr->options->batchID == $batchID[0]){
                  $newQty = 0;
                  $qtyremaining = $qtyremaining - $flwr->qty;
                  Cart::instance('BatchesofFLowers')->update($batches->rowId,['options'=>['qtyR'=>$qtyremaining]]);
                }//end of if the flower and batch id is equal to the flower that is in the list
              }//end of foreach that loops the flowers under that specific bouquet

              foreach(Cart::instance('QuickOrderedBqt_Flowers')->content() as $Unset_bqtFlwr){
                if($Unset_bqtFlwr->id == $batchID[1] AND $Unset_bqtFlwr->options->batchID == $batchID[0]){
                  $newQty = 0;
                  $qtyremaining = $qtyremaining - $Unset_bqtFlwr->qty;
                  Cart::instance('BatchesofFLowers')->update($batches->rowId,['options'=>['qtyR'=>$qtyremaining]]);
                }//end of if the flower id and the batch id is equal to the flower in the list of available flowers
              }//end of foreach that searches for the flowers under this order

              if(Cart::instance('QuickOrdered_Bqt')->count() > 0){
                foreach(Cart::instance('QuickOrdered_Bqt')->content() as $Bqt){
                  foreach(Cart::instance('QuickFinalBqt_Flowers')->content() as $bqtFlwr){
                    if($Bqt->id == $bqtFlwr->options->bqt_ID){
                      if($flwr->id == $batchID[1] AND $flwr->options->batchID == $batchID[0]){
                        $newQty = 0;
                        $qtyremaining = $qtyremaining - ($bqtFlwr->qty * $Bqt->qty);
                        Cart::instance('BatchesofFLowers')->update($batches->rowId,['options'=>['qtyR'=>$qtyremaining]]);
                      }//end of if the flower under the bouet is equal to the flower _
                    }//loops the flowers under a specific bqt
                  }//end of searching for flowers under the bouquets
                }//end of searching for bouquets
              }//if there is a content of the bqt_cart
            }//end of foreach that loop all of the flowers available in the database

    //---------------------------------------------------------------------------------checks if the values entered are still abled to be added to the cart
        foreach(Cart::instance('BatchesofFLowers')->content() as $batches){
          $batchID = explode('_',$batches->id);
          if($Rbatch_ID == $batchID[0] AND $Flower_ID == $batchID[1]){
            if($Qty > $batches->options->qtyR){
              Session::put('AddingFlowerTocartSession','Fail');
              return redirect()-> back();
            }
          }
        }
      //dd(Cart::instance('overallFLowers')->content());


        //  $AvailableFlowers = DB::select('call wonderbloomdb2.Viewing_Flowers_With_UpdatedPrice()');


          if(Cart::instance('QuickOrderedBqt_Flowers')->count() == 0){
              echo 'wala pang laman';
                  $final_total_Amount = 0;
                  $derived_Sellingprice = 0;
                  if($descision == 'O'){
                      if($Qty>=$flower_details->QTY_of_Wholesale){
                        $derived_Sellingprice = $Original_Price - ($Original_Price * 0.10);
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

                        if($Original_Price >= $New_Price){
                          if($Qty >= $flower_details->QTY_of_Wholesale){
                            $derived_Sellingprice = $Original_Price - ($Original_Price * 0.10);
                            $final_total_Amount = $derived_Sellingprice * $Qty;
                            if($Original_Price == $New_Price){
                              $descision = 'O';
                            }
                          }//checks if the qty reached the Limit of the needed qty for wholesale
                          else{
                            $derived_Sellingprice = $Original_Price;
                            $final_total_Amount = $derived_Sellingprice * $Qty;
                          }//end of inner else
                        }else if($Original_Price < $New_Price){
                          $derived_Sellingprice = $New_Price;
                          $final_total_Amount = $New_Price * $Qty;
                        }
                  }//end of outer else(this is automatically understood that it is newPrice)

                  Cart::instance('QuickOrderedBqt_Flowers')
                  ->add(['id' => $Flower_ID, 'name' => $Flower_name, 'qty' => $Qty,
                  'price' => $derived_Sellingprice,
                  'options' => ['orig_price' => $Original_Price,'T_Amt' => $final_total_Amount,
                  'image'=>$image,'priceType'=>$descision,'batchID'=>$Rbatch_ID]]);
          }else{
              echo 'may laman';
              $Insertion = 0;
          foreach(Cart::instance('QuickOrderedBqt_Flowers')->content() as $row){
              if($row->id == $Flower_ID AND $row->options->batchID == $Rbatch_ID){
                  // echo $row->rowId;
                  //for existing item in the cart update a specific record
                  $TotalQty = $row->qty + $Qty;
                  $final_total_Amount = 0;
                  $derived_Sellingprice = 0;
                  if($descision == 'O'){
                      if($TotalQty>=$flower_details->QTY_of_Wholesale){
                        $derived_Sellingprice =
                          $Original_Price - ($Original_Price * 0.10);
                        //computes for the selling price that reached the required qty for wholesale pricing
                        $final_total_Amount = $derived_Sellingprice * $TotalQty;
                      }//checks if the qty reached the Limit of the needed qty for wholesale
                      else{
                        $derived_Sellingprice = $Original_Price;
                        $final_total_Amount = $derived_Sellingprice * $TotalQty;
                      }//end of inner else
                  }//end of if
                  else{
                        if($Original_Price >= $New_Price){
                          if($Qty >= $flower_details->QTY_of_Wholesale){
                            $derived_Sellingprice = $Original_Price - ($Original_Price * 0.10);
                            $final_total_Amount = $derived_Sellingprice * $Qty;
                            if($Qty == $flower_details->QTY_of_Wholesale){
                              $descision = 'O';
                            }
                          }//checks if the qty reached the Limit of the needed qty for wholesale
                          else{
                            $derived_Sellingprice = $Original_Price;
                            $final_total_Amount = $derived_Sellingprice * $Qty;
                          }//end of inner else
                        }else if($Original_Price < $New_Price){
                          $derived_Sellingprice = $New_Price;
                          $final_total_Amount = $New_Price * $TotalQty;
                        }
                  }//end of outer else(this is automatically understood that it is newPrice)

                  Cart::instance('QuickOrderedBqt_Flowers')->update($row->rowId,['qty' => $TotalQty,
                  'price' => $derived_Sellingprice,'options'=>['T_Amt' => $final_total_Amount,
                  'orig_price' => $Original_Price,'image'=>$image,'priceType'=>$descision,
                  'batchID'=>$row->options->batchID]]);
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
                              $Original_Price - ($Original_Price * 0.10);
                            //computes for the selling price that reached the required qty for wholesale pricing
                            $final_total_Amount = $derived_Sellingprice * $Qty;
                          }//checks if the qty reached the Limit of the needed qty for wholesale
                          else{
                            $derived_Sellingprice = $Original_Price;
                            $final_total_Amount = $derived_Sellingprice * $Qty;
                          }//end of inner else
                      }//end of if
                      else{
                            if($Original_Price >= $New_Price){
                              if($Qty >= $flower_details->QTY_of_Wholesale){
                                $derived_Sellingprice = $Original_Price - ($Original_Price * 0.10);
                                $final_total_Amount = $derived_Sellingprice * $Qty;
                                if($Qty == $flower_details->QTY_of_Wholesale){
                                  $descision = 'O';
                                }
                              }//checks if the qty reached the Limit of the needed qty for wholesale
                              else{
                                $derived_Sellingprice = $Original_Price;
                                $final_total_Amount = $derived_Sellingprice * $Qty;
                              }//end of inner else
                            }else if($Original_Price < $New_Price){
                              $derived_Sellingprice = $New_Price;
                              $final_total_Amount = $New_Price * $Qty;
                            }
                      }//end of outer else(this is automatically understood that it is newPrice)
                      Cart::instance('QuickOrderedBqt_Flowers')
                      ->add(['id' => $Flower_ID, 'name' => $Flower_name, 'qty' => $Qty,
                      'price' => $derived_Sellingprice,
                      'options' => ['orig_price' => $Original_Price,
                      'T_Amt' => $final_total_Amount,'image'=>$image,'priceType'=>$descision,'batchID'=>$Rbatch_ID]]);
              }
            }//end of outer else

            //dd(Cart::instance('QuickOrderedBqt_Flowers')->content());
            Session::put('Added_FlowerToBQT_QuickOrder', 'Successful');
            return redirect()->back();

          }//END OF MAIN ELSE

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
       if(auth::guard('admins')->check() == false){
           Session::put('loginSession','fail');
           return redirect() -> route('adminsignin');
           Cart::instance('OrderedBqt_Flowers')->destroy();
       }
       else{
         $newQty = $request->QuantityField;
         $Rbatch_ID = $request->batch_Field;
         $descision = $request->Decision_Field;
         $flower_details = flower_details::find($id);
         $oldQty = 0;


                   $AvailableFlowers = DB::select('call wonderbloomdb2.Viewing_Flowers_With_UpdatedPrice()');

                   //-------------------------------------------------------------sends the data to the session cart.
                         Cart::instance('BatchesofFLowers')->destroy();
                         $batches_ofFlowers = DB::select('CALL breakdownBatchOf_Available_Flowers()');
                         foreach($batches_ofFlowers as $batch){
                             $batchID = $batch->Batch.'_'.$batch->flower_ID;
                             $batchname = 'batch-'.$batch->Batch.'_'.$batch->Name;

                             Cart::instance('BatchesofFLowers')->add(['id'=>$batchID,'name' =>$batchname,
                              'qty'=> $batch->QTYRemaining, 'price' => $batch->SellingPrice,'options'=>['qtyR'=>$batch->QTYRemaining]]);
                         }

                  //------------------------------------------------------------------------deducts all of the flowers that are in the cart from the flowers available in the list
                         foreach(Cart::instance('BatchesofFLowers')->content() as $batches){
                           $batchID = explode('_',$batches->id);
                           $qtyremaining =  $batches->options->qtyR;
                           foreach(Cart::instance('QuickOrdered_Flowers')->content() as $flwr){
                             if($flwr->id == $batchID[1] AND $flwr->options->batchID == $batchID[0]){
                               $newQty = 0;
                               $qtyremaining = $qtyremaining - $flwr->qty;
                               Cart::instance('BatchesofFLowers')->update($batches->rowId,['options'=>['qtyR'=>$qtyremaining]]);
                             }//end of if the flower and batch id is equal to the flower that is in the list
                           }//end of foreach that loops the flowers under that specific bouquet

                           foreach(Cart::instance('QuickOrderedBqt_Flowers')->content() as $Unset_bqtFlwr){
                             if($Unset_bqtFlwr->id == $batchID[1] AND $Unset_bqtFlwr->options->batchID == $batchID[0]){
                               $newQty = 0;
                               $qtyremaining = $qtyremaining - $Unset_bqtFlwr->qty;
                               Cart::instance('BatchesofFLowers')->update($batches->rowId,['options'=>['qtyR'=>$qtyremaining]]);
                             }//end of if the flower id and the batch id is equal to the flower in the list of available flowers
                           }//end of foreach that searches for the flowers under this order

                           if(Cart::instance('QuickOrdered_Bqt')->count() > 0){
                             foreach(Cart::instance('QuickOrdered_Bqt')->content() as $Bqt){
                               foreach(Cart::instance('QuickFinalBqt_Flowers')->content() as $bqtFlwr){
                                 if($Bqt->id == $bqtFlwr->options->bqt_ID){
                                   if($flwr->id == $batchID[1] AND $flwr->options->batchID == $batchID[0]){
                                     $newQty = 0;
                                     $qtyremaining = $qtyremaining - ($bqtFlwr->qty * $Bqt->qty);
                                     Cart::instance('BatchesofFLowers')->update($batches->rowId,['options'=>['qtyR'=>$qtyremaining]]);
                                   }//end of if the flower under the bouet is equal to the flower _
                                 }//loops the flowers under a specific bqt
                               }//end of searching for flowers under the bouquets
                             }//end of searching for bouquets
                           }//if there is a content of the bqt_cart
                         }//end of foreach that loop all of the flowers available in the database

                 //---------------------------------------------------------------------------------checks if the values entered are still abled to be added to the cart
                     foreach(Cart::instance('BatchesofFLowers')->content() as $batches){
                       $batchID = explode('_',$batches->id);
                       if($Rbatch_ID == $batchID[0] AND $id == $batchID[1]){
                         if($newQty > $batches->options->qtyR){
                           Session::put('AddingFlowerTocartSession','Fail');
                           return redirect()-> back();
                         }
                       }
                     }
                   //dd(Cart::instance('overallFLowers')->content());R




        foreach(Cart::instance('QuickOrderedBqt_Flowers')->content() as $row){
          //dd(Cart::instance('QuickOrderedBqt_Flowers')->content());
             if($row->id == $id AND $Rbatch_ID == $row->options->batchID){
                $idOfRow = $row->rowId;
                echo $idOfRow.'<br>';

               //dd($Rbatch_ID);
                 // echo $row->rowId
                 $final_total_Amount = 0;
                 $derived_Sellingprice = 0;
                 $orig_Price = $row->options['orig_price'];
                 $image = $row->options['image'];
                 $oldQty = $row->qty;//for editing purposes only
                 if($oldQty == $newQty){
                   Session::put('Update_FlowerToBQT_QuickOrder', 'Fail');
                   return redirect()->back();
                 }else{
                   if($newQty > $oldQty){
                     $qtyadded = $newQty - $oldQty;
                    foreach($AvailableFlowers as $Aflwrs){
                      if($Aflwrs->flower_ID == $id){
                        if($qtyadded > $Aflwrs->QTY){
                          Session::put('Update_FlowerToBQT_QuickOrder', 'Fail2');
                          return redirect()->back();
                        }else{
                          foreach(Cart::instance('overallFLowers')->content() as $flwr){
                            //dd($Aflwrs->flower_ID);
                            $qtyWhenAdded = 0;
                            if($flwr->id == $Aflwrs->flower_ID){
                              $qtyWhenAdded = $flwr->qty + $newQty;
                              if($qtyWhenAdded > $Aflwrs->QTY){
                                //dd($qtyWhenAdded,$Aflwrs->QTY);
                                Session::put('Update_FlowerToBQT_QuickOrder', 'Fail2');
                                return redirect()->back();
                              }//determines if the inventory cannot sustain the order anymore....
                            }//end of inner if
                          }
                        }
                      }
                    }//end of main foreach
                    if($descision == 'O'){
                      dd('hi1');
                      if($newQty>=$flower_details->QTY_of_Wholesale){
                        $derived_Sellingprice =
                        $row->options['orig_price'] - ($row->options['orig_price'] * 0.10);
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

                    echo $idOfRow.'<br>';
                    Cart::instance('QuickOrderedBqt_Flowers')->update($row->rowId,['qty' => $newQty,
                    'price' => $derived_Sellingprice,'options'=>['T_Amt' => $final_total_Amount,
                    'orig_price' => $orig_Price ,'image'=>$image,'priceType'=>$descision,'batchID'=>$row->options->batchID]]);
                    Session::put('Update_FlowerToBQT_QuickOrder', 'Successful');

                    $Insertion = 0;
                    break;
                   }else{
                     if($descision == 'O'){

                       if($newQty>=$flower_details->QTY_of_Wholesale){

                         $derived_Sellingprice =
                         $row->options['orig_price'] - ($row->options['orig_price'] * 0.10);
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
                                                dd('hi2');
                     }//end of outer else(this is automatically understood that it is newPrice)

                     echo $idOfRow.'<br>';
                     Cart::instance('QuickOrderedBqt_Flowers')->update($row->rowId,['qty' => $newQty,
                     'price' => $derived_Sellingprice,'options'=>['T_Amt' => $final_total_Amount,
                     'orig_price' => $orig_Price ,'image'=>$image,'priceType'=>$descision,'batchID'=>$row->options->batchID]]);
                     Session::put('Update_FlowerToBQT_QuickOrder', 'Successful');

                     $Insertion = 0;
                     break;
                   }
                 }
             }//end of if
         }//end of foreach*/

             return redirect()-> back();

         //return redirect()->route('Order.CustomizeaBouquet');
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
