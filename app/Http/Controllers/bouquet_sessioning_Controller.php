<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class bouquet_sessioning_Controller extends Controller
{
    //
    public function saveCustomer_NewCustomized_Bqt(){

      $AvailableFlowers = DB::select('call wonderbloomdb2.Viewing_Flowers_With_UpdatedPrice()');

      /*Cart::instance('FinalBqt_Acessories')->destroy();
      Cart::instance('Ordered_Bqt')->destroy();
      Cart::instance('FinalBqt_Flowers')->destroy();*/

        $BQT_Flower_Count = 0;
        foreach(Cart::instance('OrderedBqt_Flowers')->content() as $row){
            $BQT_Flower_Count += $row->qty;
        }

              $Flowers_subtotal = str_replace(array(','), array(''), Cart::instance('OrderedBqt_Flowers')->subtotal());

              $Acessories_subtotal = str_replace(array(','), array(''), Cart::instance('OrderedBqt_Acessories')->subtotal());
   /*           echo '<h2><b>$Flowers_subtotal = </b>'.$Flowers_subtotal.'<\h2>';
              echo '<h2><b>$Acessories_subtotal = </b>'.$Acessories_subtotal.'<\h2>';
              echo '<h2><b>BOQUET_total = </b>'.number_format($Acessories_subtotal + $Flowers_subtotal,2).'<\h2>';
              echo '<h2><b>BOQUET Flower Count = </b>'.$BQT_Flower_Count.' pcs. <\h2>';
  */

              $BQT_Price = $Acessories_subtotal + $Flowers_subtotal;

        if(Cart::instance('Ordered_Bqt')->count() == 0){
            $bqt_Id = mt_rand();//generates a random id
            $bqtName = 'BQT_'.$bqt_Id;
            Cart::instance('Ordered_Bqt')
                 ->add(['id' => $bqt_Id, 'name' => $bqtName, 'qty' => 1, 'price' => $BQT_Price,
                    'options' => ['count' => $BQT_Flower_Count]]);
            /*
              foreach(Cart::instance('Ordered_Bqt')->content() as $bqt){
                echo '<div class = "row">';
                echo '<h1>The Bouquet Detais<h1><hr><br>';
                  echo '<h2><b> $bqt_ID = </b>'.$bqt->id.'</h2>';
                  echo '<h4><b> $bqt_name = </b>'.$bqt->name.'</h4>';
                  echo '<h4><b> $bqt_qty = </b>'.$bqt->qty.'</h4>';
                  echo '<h4><b> $bqt_price = </b>'.$bqt->price.'</h4>';
                  echo '<h4><b> $bqt_count = </b>'.$bqt->options['count'].'</h4>';
                  echo '</div>';
              }  */

                foreach(Cart::instance('OrderedBqt_Flowers')->content() as $row){
                //this foreach will transafer all of their content to another session
                      Cart::instance('FinalBqt_Flowers')
                      ->add(['id' => $row->id, 'name' => $row->name, 'qty' => $row->qty, 'price' => $row->price,
                      'options' => ['orig_price' => $row->options['orig_price'],'T_Amt' => $row->options['T_Amt'],
                      'image'=>$row->options['image'],'priceType'=>$row->options['priceType'], 'bqt_ID' => $bqt_Id]]);
                }//END OF INNER FOREACH of flower cart

               /* foreach(Cart::instance('FinalBqt_Flowers')->content() as $row){
                  echo '<div class = "row">';
                  echo '<div class = "col-md-5">';
                  echo '<h2><b> Flwr_ID = </b>'.$row->id.'</h2>';
                  echo '<h4><b> Flwr_name = </b>'.$row->name.'</h4>';
                  echo '<h4><b> Flwr_qty = </b>'.$row->qty.'</h4>';
                  echo '<h4><b> Flwr_price = </b>'.$row->price.'</h4>';
                  echo '</div>';
                  echo '<div class = "col-md-6">';
                  echo '<h2><b> Flwr_o_price = </b>'.$row->options['orig_price'].'</h2>';
                  echo '<h4><b> Flwr_image = </b>'.$row->options['image'].'</h4>';
                  echo '<h4><b> Flwr_type = </b>'.$row->options['priceType'].'</h4>';
                  echo '<h4><b> Flwr_T_Amt = </b>'.$row->options['T_Amt'].'</h4>';
                  echo '<h4><b> Flwr_bqtID = </b>'.$row->options['bqt_ID'].'</h4>';
                  echo '</div>';
                  echo '</div>';
                  echo '<hr><br>';
                }
                echo '<br><hr><br>';*/
                foreach(Cart::instance('OrderedBqt_Acessories')->content() as $Acrow){
                  Cart::instance('FinalBqt_Acessories')
                        ->add(['id' => $Acrow->id, 'name' => $Acrow->name, 'qty' => $Acrow->qty, 'price' => $Acrow->price,'options' => ['orig_price' => $Acrow->options['orig_price'],'T_Amt' => $Acrow->options['T_Amt'],'image'=>$Acrow->options['image'],'priceType'=>$Acrow->options['priceType'],'bqt_ID' => $bqt_Id]]);
                }//end of foreach of the acessories cart


                /*
                foreach(Cart::instance('FinalBqt_Acessories')->content() as $Acrow2){
                  echo '<div class = "row">';
                  echo '<div class = "col-md-5">';
                  echo '<h2><b> Acrs_ID = </b>'.$Acrow2->id.'</h2>';
                  echo '<h4><b> Acrs_name = </b>'.$Acrow2->name.'</h4>';
                  echo '<h4><b> Acrs_qty = </b>'.$Acrow2->qty.'</h4>';
                  echo '<h4><b> Acrs_price = </b>'.$Acrow2->price.'</h4>';
                  echo '</div>';
                  echo '<div class = "col-md-6">';
                  echo '<h2><b> Acrs_o_price = </b>'.$Acrow2->options['orig_price'].'</h2>';
                  echo '<h4><b> Acrs_image = </b>'.$Acrow2->options['image'].'</h4>';
                  echo '<h4><b> Acrs_type = </b>'.$Acrow2->options['priceType'].'</h4>';
                  echo '<h4><b> Acrs_T_Amt = </b>'.$Acrow2->options['T_Amt'].'</h4>';
                  echo '<h4><b> Acrs_bqtID = </b>'.$Acrow2->options['bqt_ID'].'</h4>';
                  echo '</div>';
                  echo '</div>';
                  echo '<hr><br>';
                }
              */
        }//end of if
        else{
          $newBqt_Id = '';
          foreach(Cart::instance('Ordered_Bqt')->content() as $row){
            $newBqt_Id = $row->id;
          }
          $newBqt_Id += 1;

          $newBqtName = 'BQT_'.$newBqt_Id;
            Cart::instance('Ordered_Bqt')
                 ->add(['id' => $newBqt_Id, 'name' => $newBqtName, 'qty' => 1, 'price' => $BQT_Price,
                    'options' => ['count' => $BQT_Flower_Count]]);

               /* foreach(Cart::instance('Ordered_Bqt')->content() as $bqt){
                echo '<div class = "row">';
                echo '<h1>The Bouquet Detais<h1><hr><br>';
                  echo '<h2><b> $bqt_ID = </b>'.$bqt->id.'</h2>';
                  echo '<h4><b> $bqt_name = </b>'.$bqt->name.'</h4>';
                  echo '<h4><b> $bqt_qty = </b>'.$bqt->qty.'</h4>';
                  echo '<h4><b> $bqt_price = </b>'.$bqt->price.'</h4>';
                  echo '<h4><b> $bqt_count = </b>'.$bqt->options['count'].'</h4>';
                  echo '</div>';
              }     */

                foreach(Cart::instance('OrderedBqt_Flowers')->content() as $row){
                //this foreach will transafer all of their content to another session
                      Cart::instance('FinalBqt_Flowers')
                      ->add(['id' => $row->id, 'name' => $row->name, 'qty' => $row->qty, 'price' => $row->price,'options' => ['orig_price' => $row->options['orig_price'],'T_Amt' => $row->options['T_Amt'],'image'=>$row->options['image'],'priceType'=>$row->options['priceType'], 'bqt_ID' => $newBqt_Id]]);
                }//END OF INNER FOREACH of flower cart

                foreach(Cart::instance('OrderedBqt_Acessories')->content() as $Acrow){
                  Cart::instance('FinalBqt_Acessories')
                        ->add(['id' => $Acrow->id, 'name' => $Acrow->name, 'qty' => $Acrow->qty, 'price' => $Acrow->price,'options' => ['orig_price' => $Acrow->options['orig_price'],'T_Amt' => $Acrow->options['T_Amt'],'image'=>$Acrow->options['image'],'priceType'=>$Acrow->options['priceType'],'bqt_ID' => $newBqt_Id]]);
            }//end of foreach of the acessories cart
          }//end of else

      Cart::instance('OrderedBqt_Flowers')->destroy();
      Cart::instance('OrderedBqt_Acessories')->destroy();
          Session::put('Save_Bouqet_To_myOrder', 'Successful');//sweet alert
          return view('Orders.creationOfOrders')
        ->with('FlowerList',$AvailableFlowers);//returns to the creation of orders
    }//end of function
}

