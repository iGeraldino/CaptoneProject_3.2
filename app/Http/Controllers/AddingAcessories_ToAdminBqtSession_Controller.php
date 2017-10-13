<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Cart;
use App\Http\Requests;
use Session;
use Auth;

class AddingAcessories_ToAdminBqtSession_Controller extends Controller
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
          $countofAcessories =  Cart::instance('AdminBqt_Acessories')->count();

          $Acessory_ID = $request->AcrsID_Field;
          $Acessory_name = $request->AcrsName_Field;
          $Original_Price = $request->AcessoryOrigInputPrice_Field;
          $Qty = $request->AcessoryQTY_Field;
          $image = $request->Acrs_Image_Field;

          if(Cart::instance('AdminBqt_Acessories')->count() == 0){
              echo 'wala pang laman';
                  $final_total_Amount = 0;
                  $derived_Sellingprice = 0;

                        $derived_Sellingprice = $Original_Price;
                        $final_total_Amount = $derived_Sellingprice * $Qty;

                  Cart::instance('AdminBqt_Acessories')
                  ->add(['id' => $Acessory_ID, 'name' => $Acessory_name, 'qty' => $Qty, 'price' => $derived_Sellingprice,
                  'options' => ['orig_price' => $Original_Price,'T_Amt' => $final_total_Amount,'image'=>$image]]);
          }
          else{
              echo 'may laman';
              $Insertion = 0;
              foreach(Cart::instance('AdminBqt_Acessories')->content() as $row){
                  if($row->id == $Acessory_ID){
                      // echo $row->rowId;
                      //for existing item in the cart update a specific record
                      $TotalQty = $row->qty + $Qty;
                      $final_total_Amount = 0;
                      $derived_Sellingprice = 0;

                            $derived_Sellingprice = $Original_Price;
                            $final_total_Amount = $derived_Sellingprice * $TotalQty;


                      Cart::instance('AdminBqt_Acessories')->update($row->rowId,['qty' => $TotalQty,'price' => $derived_Sellingprice,
                      'options'=>['T_Amt' => $final_total_Amount,'orig_price' => $row->options->orig_price,'image'=>$row->options->image]]);
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

                            $derived_Sellingprice = $Original_Price;
                            $final_total_Amount = $derived_Sellingprice * $Qty;

                      Cart::instance('AdminBqt_Acessories')
                      ->add(['id' => $Acessory_ID, 'name' => $Acessory_name, 'qty' => $Qty, 'price' => $derived_Sellingprice,
                      'options' => ['orig_price' => $Original_Price,'T_Amt' => $final_total_Amount,'image'=>$image]]);
              }
          }//end of outer else

          Session::put('Added_AcessoryToAdminBQT_Order', 'Successful');
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
        //
        if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
             $newQty = $request->AcQuantityField;

           foreach(Cart::instance('AdminBqt_Acessories')->content() as $row){
                if($row->id == $id){
                     //echo $row->rowId;

                    $final_total_Amount = 0;
                    $derived_Sellingprice = 0;
                    $orig_Price = $row->options['orig_price'];
                    $image = $row->options['image'];

                          $derived_Sellingprice = $row->options['orig_price'];
                          $final_total_Amount = $derived_Sellingprice * $newQty;


                    Cart::instance('AdminBqt_Acessories')->update($row->rowId,['qty' => $newQty,'price' => $derived_Sellingprice,
                    'options'=>['T_Amt' => $final_total_Amount,
                    'orig_price' => $orig_Price ,
                    'image'=>$image]]);
                }//end of if
            }//end of foreach
            Session::put('Update_AcessoryToAdminBQT_Order', 'Successful');
            return redirect()->back();
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
