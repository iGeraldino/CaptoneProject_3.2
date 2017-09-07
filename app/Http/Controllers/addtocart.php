<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Db;
use Session;
use Cart;
use App\flower_details;

class addtocart extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //$cart = Cart::content();

      return view('customer_side.pages.cart');
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
      $product = flower_details::find($request->input('id'));

      $id = $request->input('id');
      $name = $product->flower_name;
      $qty = $request -> input('quantity');
      $price = $request -> input('fp');
      $img = $request -> input('pic');


      if($request->input('quantity') == null){

        return redirect('product/'.$id);

        }
      else{
          $qty = $request -> input('quantity');
          //no error
      }

      if(Cart::instance('flowerwish')->count() == 0){
        //wala pang laman

        $final_total_Amount = 0;//for the finalprice to be inserted in the cart
        $derived_Sellingprice = 0;//for the price

        if($qty>=$product->QTY_of_Wholesale){
          $derived_Sellingprice = $price - (($price * $product->WholeSalePrice_Decrease)/100);
          //computes for the selling price that reached the required qty for wholesale pricing
          $final_total_Amount = $derived_Sellingprice * $qty;
        }//checks if the qty reached the Limit of the needed qty for wholesale
        else{
          $derived_Sellingprice = $price;
          $final_total_Amount = $derived_Sellingprice * $qty;
        }//end of inner else

        Cart::instance('flowerwish')
        ->add(['id' => $request->input('id'),
        'name' => $product-> flower_name, 'qty' => $qty,
        'price' => $derived_Sellingprice,
        'options' => ['Orig_Amt'=>$price,'T_Amt'=>$final_total_Amount,'image' =>  $img]]);
      } // end of if
      else{
        //may laman
        $insertion = 0;//to determine if you will be creating a new record
        foreach(Cart::instance('flowerwish')->content() as $row){
            if($row->id == $request->input('id')){
              //may kamuka
              $currentQty = $row->qty;
              $totqty = $currentQty + $qty;

              if($totqty>=$product->QTY_of_Wholesale){
                  $derived_Sellingprice = $price - (($price * $product->WholeSalePrice_Decrease)/100);
                  //computes for the selling price that reached the required qty for wholesale pricing
                  $final_total_Amount = $derived_Sellingprice * $totqty;
              }//checks if the qty reached the Limit of the needed qty for wholesale
              else{
                $derived_Sellingprice = $price;
                $final_total_Amount = $derived_Sellingprice * $qty;
              }//end of inner else

              Cart::instance('flowerwish')
              ->update($row->rowId,['id' => $request->input('id'),
              'name' => $product-> flower_name, 'qty' => $totqty,
              'price' => $derived_Sellingprice, 'options' => ['Orig_Amt'=>$price,'T_Amt'=>$final_total_Amount,'image' =>  $img]]);
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

          if($qty>=$product->QTY_of_Wholesale){
            $derived_Sellingprice = $price - (($price * $product->WholeSalePrice_Decrease)/100);
            //computes for the selling price that reached the required qty for wholesale pricing
            $final_total_Amount = $derived_Sellingprice * $qty;
          }//checks if the qty reached the Limit of the needed qty for wholesale
          else{
            $derived_Sellingprice = $price;
            $final_total_Amount = $derived_Sellingprice * $qty;
          }//end of inner else

          Cart::instance('flowerwish')
          ->add(['id' => $request->input('id'),
          'name' => $product-> flower_name, 'qty' => $qty,
          'price' => $derived_Sellingprice,
          'options' => ['Orig_Amt'=>$price,'T_Amt'=>$final_total_Amount,'image' =>  $img]]);
        }//end of insertion 1
      }//end of

        return redirect('addtocart');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
      $cart = Cart::content();

      return view('customer_side.pages.cart') ->with('cart', $cart);
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

           $qty = $request->input('quantity');


           foreach(Cart::instance('finalCart')->content() as $row){

            if($row -> rowId == $id){

              Cart::instance('finalCart')->update($id, ['qty' => $qty]); // Will update the name

            }


           }

           return back();



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function flowerUpdate(Request $request, $id){

      $addflower = flower_details::find($id);

       $qty = $request->input('quantity');

       foreach(Cart::instance('flowerwish')->content() as $row){

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

           Cart::instance('flowerwish')
           ->update($row->rowId,['id' => $row->id,
           'name' => $row->name, 'qty' => $qty,
           'price' => $derived_Sellingprice, 'options' => ['Orig_Amt'=>$row->options['Orig_Amt'],'T_Amt'=>$final_total_Amount,'image' =>$row->options['image']]]);
         }
       }

       return back();

    }

    public function boqupdate(Request $request, $id){

      $qty = $request->input('quantity');

      foreach(Cart::instance('finalboqcart')->content() as $row){



          if($row->id == $id){

            Cart::instance('finalboqcart')->update($row->rowId, ['qty' => $qty]);

          }




      }
      return back();

    }


}
