<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Session;
use Auth;
use \Cart;
use App\flower_details;


class Manage_Flowers_on_Session_QuickOrder_Controller extends Controller
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
        $R_batch_ID = $request->batch_IDField;
        $R_flwr_ID = $request->FlwrID_Field;
        $decision = $request->Decision_Field;
        $Original_Price = $request->OrigInputPrice_Field;
        $newInputted_price = $request->NewPrice_Field;
        $Qty = $request->QTY_Field;

        $flower_details = flower_details::find($R_flwr_ID);
        //dd($decision,$Original_Price,$newInputted_price);

          //dd(Cart::instance('overallFLowers')->content());
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
        if($R_batch_ID == $batchID[0] AND $R_flwr_ID == $batchID[1]){
          if($Qty > $batches->options->qtyR){
            Session::put('AddingFlowerTocartSession','Fail');
            return redirect()-> back();
          }
        }
      }


        if(Cart::instance('QuickOrdered_Flowers')->count() == 0){
          echo 'wala pang laman';
              $derived_Sellingprice = 0;
              $final_total_Amount = 0;
              if($decision == 'O'){
                  if($Qty >= $flower_details->QTY_of_Wholesale){
                    $derived_Sellingprice = $Original_Price - ($Original_Price * 0.10);
                    $final_total_Amount = $derived_Sellingprice * $Qty;
                  }//checks if the qty reached the Limit of the needed qty for wholesale
                  else{
                    $derived_Sellingprice = $Original_Price;
                    $final_total_Amount = $derived_Sellingprice * $Qty;
                  }//end of inner else
              }//end of if
              else if ($decision == 'N'){
                if($Original_Price < $newInputted_price){
                  if($Qty >= $flower_details->QTY_of_Wholesale){
                    $derived_Sellingprice = $newInputted_price - ($newInputted_price * 0.10);
                    $final_total_Amount = $derived_Sellingprice * $Qty;
                    if($Original_Price == $newInputted_price){
                      $decision = 'O';
                    }
                  }//checks if the qty reached the Limit of the needed qty for wholesale
                  else{
                    $derived_Sellingprice = $newInputted_price;
                    $final_total_Amount = $derived_Sellingprice * $Qty;
                  }//end of inner else
                }else if($Original_Price > $newInputted_price){
                  $derived_Sellingprice = $newInputted_price;
                  $final_total_Amount = $newInputted_price * $Qty;
                }
              }//end of outer else(this is automatically understood that it is newPrice)

              Cart::instance('QuickOrdered_Flowers')
              ->add(['id' => $R_flwr_ID,
              'name' => $flower_details->flower_name,
              'qty' => $Qty,
              'price' => $derived_Sellingprice,
              'options' => ['orig_price' => $Original_Price,
              'NewPrice'=>$newInputted_price,
              'T_Amt' => $final_total_Amount,
              'image'=>$flower_details->Image,
              'priceType'=>$decision,
              'batchID'=>$R_batch_ID]]);
        }else{
          echo 'may laman';
          $Insertion = 0;
          foreach(Cart::instance('QuickOrdered_Flowers')->content() as $row){
            if($row->id == $R_flwr_ID AND $row->options->batchID == $R_batch_ID){
              // echo $row->rowId;
              //for existing item in the cart update a specific record
              $TotalQty = $row->qty + $Qty;
              $derived_Sellingprice = 0;
              $final_total_Amount = 0;
              if($decision == 'O'){
                  if($Qty >= $flower_details->QTY_of_Wholesale){
                    $derived_Sellingprice = $Original_Price - ($Original_Price * 0.10);
                    $final_total_Amount = $derived_Sellingprice * $Qty;
                  }//checks if the qty reached the Limit of the needed qty for wholesale
                  else{
                    $derived_Sellingprice = $Original_Price;
                    $final_total_Amount = $derived_Sellingprice * $Qty;
                  }//end of inner else
              }//end of if
              else if ($decision == 'N'){
                if($Original_Price < $newInputted_price){
                  if($Qty >= $flower_details->QTY_of_Wholesale){
                    $derived_Sellingprice = $newInputted_price - ($newInputted_price * 0.10);
                    $final_total_Amount = $derived_Sellingprice * $Qty;
                    if($Original_Price == $newInputted_price){
                      $decision = 'O';
                    }
                  }//checks if the qty reached the Limit of the needed qty for wholesale
                  else{
                    $derived_Sellingprice = $Original_Price;
                    $final_total_Amount = $derived_Sellingprice * $Qty;
                  }//end of inner else
                }else if($Original_Price > $newInputted_price){
                  $derived_Sellingprice = $newInputted_price;
                  $final_total_Amount = $newInputted_price * $Qty;
                }
              }//end of outer else(this is automatically understood that it is newPrice)

              Cart::instance('QuickOrdered_Flowers')->update($row->rowId,['qty' => $TotalQty,'price' => $derived_Sellingprice,
              'options'=>['T_Amt' =>$final_total_Amount,'orig_price' =>$Original_Price,'NewPrice'=>$newInputted_price,
              'image'=>$row->options->image,'priceType'=>$decision,
              'batchID'=>$row->options->batchID]]);
              $Insertion = 0;
              break;
            }//equal yung flwr at batch na pinili ko
            else{
                //for none existing item in the cart create a new record
              $Insertion = 1;
            }//end of else
          }//end of foreach
          if($Insertion == 1){
              echo 'wala pang kamuka';
              $derived_Sellingprice = 0;
              $final_total_Amount = 0;
              if($decision == 'O'){
                  if($Qty >= $flower_details->QTY_of_Wholesale){
                    $derived_Sellingprice = $Original_Price - ($Original_Price * 0.10);
                    $final_total_Amount = $derived_Sellingprice * $Qty;
                  }//checks if the qty reached the Limit of the needed qty for wholesale
                  else{
                    $derived_Sellingprice = $Original_Price;
                    $final_total_Amount = $derived_Sellingprice * $Qty;
                  }//end of inner else
              }//end of if
              else if ($decision == 'N'){
                if($Original_Price < $newInputted_price){
                  if($Qty >= $flower_details->QTY_of_Wholesale){
                    $derived_Sellingprice = $newInputted_price - ($newInputted_price * 0.10);
                    $final_total_Amount = $derived_Sellingprice * $Qty;
                    if($Original_Price == $newInputted_price){
                      $decision = 'O';
                    }
                  }//checks if the qty reached the Limit of the needed qty for wholesale
                  else{
                    $derived_Sellingprice = $newInputted_price;
                    $final_total_Amount = $derived_Sellingprice * $Qty;
                  }//end of inner else
                }else if($Original_Price > $newInputted_price){
                  $derived_Sellingprice = $newInputted_price;
                  $final_total_Amount = $newInputted_price * $Qty;
                }
              }//end of outer else(this is automatically understood that it is newPrice)

              Cart::instance('QuickOrdered_Flowers')
              ->add(['id' => $R_flwr_ID, 'name' => $flower_details->flower_name, 'qty' => $Qty, 'price' => $derived_Sellingprice,
              'options' => ['orig_price' => $Original_Price,'NewPrice'=>$newInputted_price,'T_Amt' => $final_total_Amount,
              'image'=>$flower_details->Image,'priceType'=>$decision,'batchID'=>$R_batch_ID]]);
                }//means that there are no co existing flower and batch in the cart
              }//means that there is an existing data in the cart


        Session::put('AddFlower_To_myQuickOrder', 'Successful');
        return redirect()-> back();
    }//end of else main auth....
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
    $FlowerBatch_ID = explode('_',$id);
    //dd($FlowerBatch_ID);
      //$FlowerBatch_ID[0] = batch ID
      //$FlowerBatch_ID[1] = flower ID
    $batches_ofFlowers = DB::select('CALL breakdownBatchOf_Available_Flowers()');

    $flower_Det = DB::select('CALL Specific_Flower_withUpdated_Price(?)',array($FlowerBatch_ID[1]));
    $AvailableFlowers = DB::select  ('call wonderbloomdb2.Viewing_Flowers_With_UpdatedPrice()');
    $QTYAvailable = 0;

//------------------gets the data about the specific flower of a specific batch
      $batchDetails = array();
      foreach($batches_ofFlowers as $batches){
        if($FlowerBatch_ID[0] == $batches->Batch and $FlowerBatch_ID[1] == $batches->flower_ID){
          array_push($batchDetails,$batches->Batch,$batches->flower_ID,$batches->Name,
          $batches->QTYRemaining,$batches->SellingPrice);
          break;
        }//
      }//
      //dd($batchDetails);

    foreach($AvailableFlowers as $AFlowers){
      if($AFlowers->flower_ID == $id){
          $QTYAvailable = $AFlowers->QTY;
      }
    }

  //dd($flower_Det);
    return view('Orders.updateQty_QuickOrdered_Flower')
    ->with('batchDetails',$batchDetails)
    ->with('flower_Det',$flower_Det)
    ->with('QTYAvailable',$QTYAvailable);
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
      // dd(Cart::instance('overallFLowers')->content());

            $newQty = $request->QTY_Field;
            $New_Price = $request->NewPrice_Field;
            $decision = $request->Decision_Field;
            $batch_ID  = $request->BatchID_Field;
//dd($id);
            $flower_details = flower_details::find($id);
            $image = '';
            $rowidofRecord = '';
            $Original_Price = '';
            $final_total_Amount = 0;
            $derived_Sellingprice = 0;
            $oldQty = 0;
               // echo 'may laman';
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
                   if($batch_ID == $batchID[0] AND $id == $batchID[1]){
                     if($newQty > $batches->options->qtyR){
                       Session::put('update_O_FlowerQuickQty_Session','Fail2');
                       return redirect()->back();
                     }
                   }
                 }

                 foreach(Cart::instance('QuickOrdered_Flowers')->content() as $row){
                     if($row->id == $id  AND $batch_ID == $row->options->batchID){
                         $rowidofRecord = $row->rowId;
                         //for existing item in the cart update a specific record
                         //$TotalQty = $row->qty + $Qty;
                         $final_total_Amount = 0;
                         $derived_Sellingprice = 0;
                         $Original_Price = $row->options['orig_price'];
                         $image = $row->options['image'];
                         $oldQty = $row->qty;
                         if($decision == 'O'){
                             if($newQty >= $flower_details->QTY_of_Wholesale){
                               $derived_Sellingprice = $Original_Price - (($Original_Price * $flower_details->WholeSalePrice_Decrease)/100);
                               //computes for the selling price that reached the required qty for wholesale pricing
                               $final_total_Amount = $derived_Sellingprice * $newQty;
                             }//checks if the qty reached the Limit of the needed qty for wholesale
                             else{
                               $derived_Sellingprice = $Original_Price;
                               $final_total_Amount = $derived_Sellingprice * $newQty;
                             }//end of inner else
                         }//end of if
                         else if($decision == 'N'){
                             if($New_Price >= $Original_Price){
                               if($newQty >= $flower_details->QTY_of_Wholesale){
                                 $derived_Sellingprice = $New_Price - ($New_Price * 0.10);
                                 //computes for the selling price that reached the required qty for wholesale pricing
                                 $final_total_Amount = $derived_Sellingprice * $newQty;
                               }//checks if the qty reached the Limit of the needed qty for wholesale
                               else{
                                 $derived_Sellingprice = $New_Price;
                                 $final_total_Amount = $derived_Sellingprice * $newQty;
                               }//end of inner else
                             }else{
                                 $derived_Sellingprice = $Original_Price;
                                 $final_total_Amount = $derived_Sellingprice * $newQty;
                             }
                         }//end of outer else(this is automatically understood that it is newPrice)
                         Cart::instance('QuickOrdered_Flowers')->update($rowidofRecord,['qty' => $newQty,
                         'price' => $derived_Sellingprice,'options'=>['T_Amt' => $final_total_Amount,
                         'orig_price' => $Original_Price,'NewPrice'=>$New_Price,
                         'image'=>$image,'priceType'=>$decision,'batchID'=>$batch_ID]]);

                     }//end of if
                   //echo '$Original_Price  = '.$Original_Price;
                 }

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
