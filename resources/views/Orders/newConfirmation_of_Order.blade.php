  <?php 
  $SavingBouquetsessionValue = Session::get('Save_Bouqet_To_myOrder'); 
  Session::remove('Save_Bouqet_To_myOrder');//determines the addition of new flower

  $AddingFlowersessionValue = Session::get('AddFlower_To_myOrder'); 
  Session::remove('AddFlower_To_myOrder');//determines the addition of new flower

  $AddingOrdersessionValue = Session::get('Add_Order_ofCustomer'); 
  Session::remove('Add_Order_ofCustomer');//determines the addition of new flower

  $CancelOBQTsessionValue = Session::get('Buquet_Cancelation'); 
  Session::remove('Buquet_Cancelation');//determines the addition of new flower

  $Order_DetailsSession = Session::get('newOrderSession');
    $Flower_Total_Amt = 0;
    $Bqt_Total_Amt = 0;
    $order_ID = 0;
    $NewOrderDetailsRows = Session::get('newOrderSession');
    echo '<h2> Session Id = '.Session::getId('newOrderSession').'</h2>';
    echo  '<h2> Customer_Id = '.$NewOrderDetailsRows[0];
    echo  '<h2> Customer_Fname = '.$NewOrderDetailsRows[1];
    echo  '<h2> Customer_Mname = '.$NewOrderDetailsRows[2];
    echo  '<h2> Customer_Lname = '.$NewOrderDetailsRows[3];
    echo  '<h2> Customer_Contact Number = '.$NewOrderDetailsRows[4];
    echo  '<h2> Email = '.$NewOrderDetailsRows[5];
    echo  '<hr>';

  ?>
