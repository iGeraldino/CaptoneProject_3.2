<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use \Cart;
use App\bouquet_details;
use Session;
use Auth;
class Ordering_with_TradeAgreement_Controller extends Controller
{
    //
    public function Apply_Trade_Agreement($order_ID)
    {
      //for bqtFlowers--------------------------------------------------------------------------------
        $NewFlowerPrice = 0;//updates the price
        $NewTAmt = 0;//updates the options->TAmnt
        $AGRMT_TYPE = "AGRMT";//updates the priceType
      //this foreach will transafer all of their content to another session
        Cart::instance('TobeSubmitted_Flowers')->destroy()
        Cart::instance('TobeSubmitted_Bqt')->destroy()
        Cart::instance('TobeSubmitted_Bqt_Flowers')->destroy()

        foreach(Cart::instance('FinalBqt_Flowers')->content() as $row){
              $FlowerDet = DB::select('call wonderbloomdb2.Specific_Flower_withUpdated_Price(?)',$row->id);
              foreach($FlowerDet as $Flower){
                $CurrentSellingPrice = $Flower->Final_SellingPrice;
              }

              $NewFlowerPrice = $CurrentSellingPrice - ($CurrentSellingPrice*.10);
              $NewTAmt = $NewFlowerPrice * $row->qty;

              Cart::instance('TobeSubmitted_Bqt_Flowers')
              ->add(['id' => $row->id, 'name' => $row->name, 'qty' => $row->qty, 'price' => $NewFlowerPrice,'options' => ['orig_price' => $row->options['orig_price'],'T_Amt' => $NewTAmt,'image'=>$row->options['image'],
              'priceType'=>$AGRMT_TYPE, 'bqt_ID' =>$row->options['bqt_ID']]]);
        }//END OF INNER FOREACH of flower cart

        $BqttotalAmt = 0;
        $BqttotalCnt = 0;
      foreach(Cart::instance('Ordered_Bqt')->content() as $row2){
        $BqttotalAmt = 0;
        $BqttotalCnt = 0;
        foreach(Cart::instance('TobeSubmitted_Bqt_Flowers')->content() as $row3){
            if($row2->id == $row3->options['bqt_ID']){
              $BqttotalCnt += $row3->qty;
              $BqttotalAmt += $row3->options['T_Amt'];
            }
        }
        foreach(Cart::instance('FinalBqt_Acessories')->content() as $row3_1){
            if($row2->id == $row3_1->options['bqt_ID']){
              $BqttotalAmt += $row3_1->options['T_Amt'];
            }
        }
            Cart::instance('TobeSubmitted_Bqt')
             ->add(['id' => $row2->id, 'name' => $row2->name, 'qty' => $row2->qty, 'price' => $BqttotalAmt,
                'options' => ['count' => $BqttotalCnt]]);
      }//end of order bqt

      $NewFlowerPrice2 = 0;//updates the price
      $NewTAmt2 = 0;//updates the options->TAmnt
      foreach(Cart::instance('Ordered_Flowers')->content() as $row4){
        $FlowerDet2 = DB::select('call wonderbloomdb2.Specific_Flower_withUpdated_Price(?)',$row4->id);
        foreach($FlowerDet2 as $Flower2){
          $CurrentSellingPrice2 = $Flower2->Final_SellingPrice;
        }

        $NewFlowerPrice2 = $CurrentSellingPrice2 - ($CurrentSellingPrice2*.10);
        $NewTAmt2 = $NewFlowerPrice2 * $row4->qty;

        Cart::instance('TobeSubmitted_Flowers')
        ->add(['id' => $row4->id, 'name' => $row4->name, 'qty' => $row4->qty, 'price' => $NewFlowerPrice2,
        'options' => ['orig_price' => $row4->options['Original_Price'],'T_Amt' => $NewTAmt2,
        'image'=>$row4->options['image'],'priceType'=>$AGRMT_TYPE]]);
      }//end of ordered flowers
    }//end of function

}
