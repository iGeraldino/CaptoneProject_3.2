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
    public function Apply_Trade_Agreement()
    {
      //for bqtFlowers--------------------------------------------------------------------------------
        $NewFlowerPrice = 0;//updates the price
        $NewTAmt = 0;//updates the options->TAmnt
        $AGRMT_TYPE = "AGRMT";//updates the priceType
      //this foreach will transafer all of their content to another session
        Cart::instance('TobeSubmitted_Flowers')->destroy();
        Cart::instance('TobeSubmitted_Bqt')->destroy();
        Cart::instance('TobeSubmitted_Bqt_Flowers')->destroy();

        foreach(Cart::instance('FinalBqt_Flowers')->content() as $row){
              $FlowerDet = DB::select('call wonderbloomdb2.Specific_Flower_withUpdated_Price(?)',array($row->id));
              foreach($FlowerDet as $Flower){
                $CurrentSellingPrice = $Flower->Final_SellingPrice;
              }

              $NewFlowerPrice = $CurrentSellingPrice - ($CurrentSellingPrice * 0.10);
              $NewTAmt = $NewFlowerPrice * $row->qty;

              Cart::instance('TobeSubmitted_Bqt_Flowers')
              ->add(['id' => $row->id, 'name' => $row->name, 'qty' => $row->qty, 'price' => $NewFlowerPrice,
              'options' => ['orig_price' => $row->options['orig_price'],
              'T_Amt' => $NewTAmt,'image'=>$row->options['image'],
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


//ahhhaha

      $NewFlowerPrice2 = 0;//updates the price
      $NewTAmt2 = 0;//updates the options->TAmnt
      foreach(Cart::instance('Ordered_Flowers')->content() as $row4){
        $FlowerDet2 = DB::select('call wonderbloomdb2.Specific_Flower_withUpdated_Price(?)',array($row4->id));
        foreach($FlowerDet2 as $Flower2){
          $CurrentSellingPrice2 = $Flower2->Final_SellingPrice;
        }

        $NewFlowerPrice2 = $CurrentSellingPrice2 - ($CurrentSellingPrice2 * 0.10);
        $NewTAmt2 = $NewFlowerPrice2 * $row4->qty;

        Cart::instance('TobeSubmitted_Flowers')
        ->add(['id' => $row4->id, 'name' => $row4->name, 'qty' => $row4->qty, 'price' => $NewFlowerPrice2,
        'options' => ['orig_price' => $row4->options['orig_price'],'T_Amt' => $NewTAmt2,
        'image'=>$row4->options['image'],'priceType'=>$AGRMT_TYPE]]);
      }//end of ordered flowers

      //return json_encode(['data' => Cart::instance('TobeSubmitted_Bqt_Flowers')->content()]);
    }//end of function

    public function Apply_Price_Made_OnOrder_Creation()
    {
      //for bqtFlowers--------------------------------------------------------------------------------
      //this foreach will transafer all of their content to another session
        Cart::instance('TobeSubmitted_Flowers')->destroy();
        Cart::instance('TobeSubmitted_Bqt')->destroy();
        Cart::instance('TobeSubmitted_Bqt_Flowers')->destroy();

      foreach(Cart::instance('FinalBqt_Flowers')->content() as $row){
              Cart::instance('TobeSubmitted_Bqt_Flowers')
              ->add(['id' => $row->id, 'name' => $row->name,
              'qty' => $row->qty, 'price' => $row->price,
              'options' => ['orig_price' => $row->options['orig_price'],
              'T_Amt' => $row->options['T_Amt'],'image'=>$row->options['image'],
              'priceType'=>$row->options['priceType'], 'bqt_ID' =>$row->options['bqt_ID']]]);
      }//END OF INNER FOREACH of flower cart

        $BqttotalAmt = 0;
        $BqttotalCnt = 0;
      foreach(Cart::instance('Ordered_Bqt')->content() as $row2){
            Cart::instance('TobeSubmitted_Bqt')
             ->add(['id' => $row2->id, 'name' => $row2->name, 'qty' => $row2->qty, 'price' => $row2->price,
                'options' => ['count' => $row2->options['count']]]);
      }//end of order bqt

      foreach(Cart::instance('Ordered_Flowers')->content() as $row4){
        Cart::instance('TobeSubmitted_Flowers')
        ->add(['id' => $row4->id, 'name' => $row4->name, 'qty' => $row4->qty, 'price' => $row4->price,
        'options' => ['orig_price' => $row4->options['orig_price'],'T_Amt' => $row4->options['T_Amt'],
        'image'=>$row4->options['image'],'priceType'=>$row4->options['priceType']]]);
      }//end of ordered flowers
/*
    //  return json_encode(['data' => Cart::instance('TobeSubmitted_Bqt_Flowers')->content()]);
    echo '<div class = "row"><div class ="col-md-6">';
    echo '<h3>Bouquet Flowers nung inapply yung trade agreement</h3>
    <table class="table table-hover table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center">Bqt ID</th>
            <th class="text-center">Item_ID</th>
            <th class="text-center">Item_Name</th>
            <th class="text-center">CurrentSelling_Price</th>
            <th class="text-center">Discounted Price</th>
            <th class="text-center">Qty</th>
            <th class="text-center">Total</th>
            <th class="text-center">PriceType</th>
        </tr>
      </thead>
      <tbody>';
      foreach(Cart::instance('TobeSubmitted_Bqt_Flowers')->content() as $bqtLWR){
        echo'<tr>
          <th scope="row">'.$bqtLWR->options->bqt_ID.'</th>
          <td>FLWR-'.$bqtLWR->id.'</td>
          <td>'.$bqtLWR->name.'</td>
          <td class = "text-right" style = "color:red;">.
             Php '. number_format($bqtLWR->options->orig_price,2).
           '</td>
          <td class = "text-right" style = "color:red;">.
             Php '. number_format($bqtLWR->price,2).
           '</td>
          <td class = "text-right">'.$bqtLWR->qty .'pcs.</td>
          <td class = "text-right" style = "color:red;">Php '.number_format($bqtLWR->options->T_Amt,2).'</td>
          <td class = "text-right" style = "color:red;">'.$bqtLWR->options->priceType.'</td>
        </tr>';
      }
      echo'</tbody></table>';

      echo '</div><div class ="col-md-6">
      <h3>Bouquet FLowers na minanipulate ag price sa pagorder</h3>
      <table class="table table-hover table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center">Bqt ID </th>
              <th class="text-center">Item_ID </th>
              <th class="text-center">Item_Name </th>
              <th class="text-center">CurrentSelling_Price </th>
              <th class="text-center">Price_Made Upon Order </th>
              <th class="text-center">Qty </th>
              <th class="text-center">Total </th>
              <th class="text-center">PriceType </th>
          </tr>
        </thead>
        <tbody>';
        foreach(Cart::instance('FinalBqt_Flowers')->content() as $bqtLWR2){
          echo '<tr>
            <th scope="row">'.$bqtLWR2->options->bqt_ID.'</th>2
            <td>FLWR-'.$bqtLWR2->id.'</td>
            <td>'.$bqtLWR2->name.'</td>
            <td class = "text-right" style = "color:red;">.
               Php '. number_format($bqtLWR2->options->orig_price,2).
             '</td>
            <td class = "text-right" style = "color:red;">.
               Php '. number_format($bqtLWR2->price,2).
             '</td>
            <td class = "text-right">'.$bqtLWR2->qty .'pcs.</td>
            <td class = "text-right" style = "color:red;">Php '.number_format($bqtLWR2->options->T_Amt,2).'</td>
            <td class = "text-right" style = "color:red;">'.$bqtLWR2->options->priceType.'</td>
          </tr>';
        }
        echo '</tbody></table></div></div>';
*/

    }//end of function

    public function Apply_Trade_Agreement_QuickOrder()
    {
      //for bqtFlowers--------------------------------------------------------------------------------
        $NewFlowerPrice = 0;//updates the price
        $NewTAmt = 0;//updates the options->TAmnt
        $AGRMT_TYPE = "AGRMT";//updates the priceType
      //this foreach will transafer all of their content to another session
        Cart::instance('TobeSubmitted_FlowersQuick')->destroy();
        Cart::instance('TobeSubmitted_BqtQuick')->destroy();
        Cart::instance('TobeSubmitted_Bqt_FlowersQuick')->destroy();

        foreach(Cart::instance('QuickFinalBqt_Flowers')->content() as $row){
              $FlowerDet = DB::select('call wonderbloomdb2.Specific_Flower_withUpdated_Price(?)',array($row->id));
              foreach($FlowerDet as $Flower){
                $CurrentSellingPrice = $Flower->Final_SellingPrice;
              }

              $NewFlowerPrice = $CurrentSellingPrice - ($CurrentSellingPrice * 0.10);
              $NewTAmt = $NewFlowerPrice * $row->qty;

              Cart::instance('TobeSubmitted_Bqt_FlowersQuick')
              ->add(['id' => $row->id, 'name' => $row->name, 'qty' => $row->qty, 'price' => $NewFlowerPrice,
              'options' => ['orig_price' => $row->options['orig_price'],
              'T_Amt' => $NewTAmt,'image'=>$row->options['image'],
              'priceType'=>$AGRMT_TYPE, 'bqt_ID' =>$row->options['bqt_ID']]]);
        }//END OF INNER FOREACH of flower cart

        $BqttotalAmt = 0;
        $BqttotalCnt = 0;
      foreach(Cart::instance('QuickOrdered_Bqt')->content() as $row2){
        $BqttotalAmt = 0;
        $BqttotalCnt = 0;
        foreach(Cart::instance('TobeSubmitted_Bqt_FlowersQuick')->content() as $row3){
            if($row2->id == $row3->options['bqt_ID']){
              $BqttotalCnt += $row3->qty;
              $BqttotalAmt += $row3->options['T_Amt'];
            }
        }
        foreach(Cart::instance('QuickFinalBqt_Acessories')->content() as $row3_1){
            if($row2->id == $row3_1->options['bqt_ID']){
              $BqttotalAmt += $row3_1->options['T_Amt'];
            }
        }
            Cart::instance('TobeSubmitted_BqtQuick')
             ->add(['id' => $row2->id, 'name' => $row2->name, 'qty' => $row2->qty, 'price' => $BqttotalAmt,
                'options' => ['count' => $BqttotalCnt]]);
      }//end of order bqt


  //ahhhaha

      $NewFlowerPrice2 = 0;//updates the price
      $NewTAmt2 = 0;//updates the options->TAmnt
      foreach(Cart::instance('QuickOrdered_Flowers')->content() as $row4){
        $FlowerDet2 = DB::select('call wonderbloomdb2.Specific_Flower_withUpdated_Price(?)',array($row4->id));
        foreach($FlowerDet2 as $Flower2){
          $CurrentSellingPrice2 = $Flower2->Final_SellingPrice;
        }

        $NewFlowerPrice2 = $CurrentSellingPrice2 - ($CurrentSellingPrice2 * 0.10);
        $NewTAmt2 = $NewFlowerPrice2 * $row4->qty;

        Cart::instance('TobeSubmitted_FlowersQuick')
        ->add(['id' => $row4->id, 'name' => $row4->name, 'qty' => $row4->qty, 'price' => $NewFlowerPrice2,
        'options' => ['orig_price' => $row4->options['orig_price'],'T_Amt' => $NewTAmt2,
        'image'=>$row4->options['image'],'priceType'=>$AGRMT_TYPE]]);
      }//end of ordered flowers
  /*
      echo '<div class = "row"><div class ="col-md-6">';
      echo '<h3>Bouquet Flowers nung inapply yung trade agreement</h3>
      <table class="table table-hover table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center">Bqt ID</th>
              <th class="text-center">Item_ID</th>
              <th class="text-center">Item_Name</th>
              <th class="text-center">CurrentSelling_Price</th>
              <th class="text-center">Discounted Price</th>
              <th class="text-center">Qty</th>
              <th class="text-center">Total</th>
              <th class="text-center">PriceType</th>
          </tr>
        </thead>
        <tbody>';
        foreach(Cart::instance('TobeSubmitted_Bqt_Flowers')->content() as $bqtLWR){
          echo'<tr>
            <th scope="row">'.$bqtLWR->options->bqt_ID.'</th>
            <td>FLWR-'.$bqtLWR->id.'</td>
            <td>'.$bqtLWR->name.'</td>
            <td class = "text-right" style = "color:red;">.
               Php '. number_format($bqtLWR->options->orig_price,2).
             '</td>
            <td class = "text-right" style = "color:red;">.
               Php '. number_format($bqtLWR->price,2).
             '</td>
            <td class = "text-right">'.$bqtLWR->qty .'pcs.</td>
            <td class = "text-right" style = "color:red;">Php '.number_format($bqtLWR->options->T_Amt,2).'</td>
            <td class = "text-right" style = "color:red;">'.$bqtLWR->options->priceType.'</td>
          </tr>';
        }
        echo'</tbody></table>';

        echo '</div><div class ="col-md-6">
        <h3>Bouquet FLowers na minanipulate ag price sa pagorder</h3>
        <table class="table table-hover table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center">Bqt ID </th>
                <th class="text-center">Item_ID </th>
                <th class="text-center">Item_Name </th>
                <th class="text-center">CurrentSelling_Price </th>
                <th class="text-center">Price_Made Upon Order </th>
                <th class="text-center">Qty </th>
                <th class="text-center">Total </th>
                <th class="text-center">PriceType </th>
            </tr>
          </thead>
          <tbody>';
          foreach(Cart::instance('FinalBqt_Flowers')->content() as $bqtLWR2){
            echo '<tr>
              <th scope="row">'.$bqtLWR2->options->bqt_ID.'</th>2
              <td>FLWR-'.$bqtLWR2->id.'</td>
              <td>'.$bqtLWR2->name.'</td>
              <td class = "text-right" style = "color:red;">.
                 Php '. number_format($bqtLWR2->options->orig_price,2).
               '</td>
              <td class = "text-right" style = "color:red;">.
                 Php '. number_format($bqtLWR2->price,2).
               '</td>
              <td class = "text-right">'.$bqtLWR2->qty .'pcs.</td>
              <td class = "text-right" style = "color:red;">Php '.number_format($bqtLWR2->options->T_Amt,2).'</td>
              <td class = "text-right" style = "color:red;">'.$bqtLWR2->options->priceType.'</td>
            </tr>';
          }
          echo '</tbody></table></div></div>';
  */

      //return json_encode(['data' => Cart::instance('TobeSubmitted_Bqt_Flowers')->content()]);
    }//end of function

    public function Apply_Price_Made_OnOrder_CreationQuickOrder()
    {
      //for bqtFlowers--------------------------------------------------------------------------------
      //this foreach will transafer all of their content to another session
        Cart::instance('TobeSubmitted_FlowersQuick')->destroy();
        Cart::instance('TobeSubmitted_BqtQuick')->destroy();
        Cart::instance('TobeSubmitted_Bqt_FlowersQuick')->destroy();

      foreach(Cart::instance('QuickFinalBqt_Flowers')->content() as $row){
              Cart::instance('TobeSubmitted_Bqt_FlowersQuick')
              ->add(['id' => $row->id, 'name' => $row->name,
              'qty' => $row->qty, 'price' => $row->price,
              'options' => ['orig_price' => $row->options['orig_price'],
              'T_Amt' => $row->options['T_Amt'],'image'=>$row->options['image'],
              'priceType'=>$row->options['priceType'], 'bqt_ID' =>$row->options['bqt_ID']]]);
      }//END OF INNER FOREACH of flower cart

        $BqttotalAmt = 0;
        $BqttotalCnt = 0;
      foreach(Cart::instance('QuickOrdered_Bqt')->content() as $row2){
            Cart::instance('TobeSubmitted_BqtQuick')
             ->add(['id' => $row2->id, 'name' => $row2->name, 'qty' => $row2->qty, 'price' => $row2->price,
                'options' => ['count' => $row2->options['count']]]);
      }//end of order bqt

      foreach(Cart::instance('QuickOrdered_Flowers')->content() as $row4){
        Cart::instance('TobeSubmitted_FlowersQuick')
        ->add(['id' => $row4->id, 'name' => $row4->name, 'qty' => $row4->qty, 'price' => $row4->price,
        'options' => ['orig_price' => $row4->options['orig_price'],'T_Amt' => $row4->options['T_Amt'],
        'image'=>$row4->options['image'],'priceType'=>$row4->options['priceType']]]);
      }//end of ordered flowers
/*
    //  return json_encode(['data' => Cart::instance('TobeSubmitted_Bqt_Flowers')->content()]);
    echo '<div class = "row"><div class ="col-md-6">';
    echo '<h3>Bouquet Flowers nung inapply yung trade agreement</h3>
    <table class="table table-hover table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center">Bqt ID</th>
            <th class="text-center">Item_ID</th>
            <th class="text-center">Item_Name</th>
            <th class="text-center">CurrentSelling_Price</th>
            <th class="text-center">Discounted Price</th>
            <th class="text-center">Qty</th>
            <th class="text-center">Total</th>
            <th class="text-center">PriceType</th>
        </tr>
      </thead>
      <tbody>';
      foreach(Cart::instance('TobeSubmitted_Bqt_Flowers')->content() as $bqtLWR){
        echo'<tr>
          <th scope="row">'.$bqtLWR->options->bqt_ID.'</th>
          <td>FLWR-'.$bqtLWR->id.'</td>
          <td>'.$bqtLWR->name.'</td>
          <td class = "text-right" style = "color:red;">.
             Php '. number_format($bqtLWR->options->orig_price,2).
           '</td>
          <td class = "text-right" style = "color:red;">.
             Php '. number_format($bqtLWR->price,2).
           '</td>
          <td class = "text-right">'.$bqtLWR->qty .'pcs.</td>
          <td class = "text-right" style = "color:red;">Php '.number_format($bqtLWR->options->T_Amt,2).'</td>
          <td class = "text-right" style = "color:red;">'.$bqtLWR->options->priceType.'</td>
        </tr>';
      }
      echo'</tbody></table>';

      echo '</div><div class ="col-md-6">
      <h3>Bouquet FLowers na minanipulate ag price sa pagorder</h3>
      <table class="table table-hover table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center">Bqt ID </th>
              <th class="text-center">Item_ID </th>
              <th class="text-center">Item_Name </th>
              <th class="text-center">CurrentSelling_Price </th>
              <th class="text-center">Price_Made Upon Order </th>
              <th class="text-center">Qty </th>
              <th class="text-center">Total </th>
              <th class="text-center">PriceType </th>
          </tr>
        </thead>
        <tbody>';
        foreach(Cart::instance('FinalBqt_Flowers')->content() as $bqtLWR2){
          echo '<tr>
            <th scope="row">'.$bqtLWR2->options->bqt_ID.'</th>2
            <td>FLWR-'.$bqtLWR2->id.'</td>
            <td>'.$bqtLWR2->name.'</td>
            <td class = "text-right" style = "color:red;">.
               Php '. number_format($bqtLWR2->options->orig_price,2).
             '</td>
            <td class = "text-right" style = "color:red;">.
               Php '. number_format($bqtLWR2->price,2).
             '</td>
            <td class = "text-right">'.$bqtLWR2->qty .'pcs.</td>
            <td class = "text-right" style = "color:red;">Php '.number_format($bqtLWR2->options->T_Amt,2).'</td>
            <td class = "text-right" style = "color:red;">'.$bqtLWR2->options->priceType.'</td>
          </tr>';
        }
        echo '</tbody></table></div></div>';
*/

    }//end of function


}
