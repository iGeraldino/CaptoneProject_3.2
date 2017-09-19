@extends('main')


@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<section class="content-header">
  <?php
  $SavingBouquetsessionValue = Session::get('Save_Bouqet_To_myOrder');
  Session::remove('Save_Bouqet_To_myOrder');//determines the addition of new flower

  $AddingFlowersessionValue = Session::get('AddFlower_To_myOrder');
  Session::remove('AddFlower_To_myOrder');//determines the addition of new flower

  $AddingOrdersessionValue = Session::get('Add_Order_ofCustomer');
  Session::remove('Add_Order_ofCustomer');//determines the addition of new flower

  $CancelOBQTsessionValue = Session::get('Buquet_Cancelation');
  Session::remove('Buquet_Cancelation');//determines the addition of new flower

    $Flower_Total_Amt = 0;
    $Bqt_Total_Amt = 0;
    $order_ID = 0;
  ?>

<div hidden>
  <input id = "Saving_BouquetSessionValue" value = "{{$SavingBouquetsessionValue}}">
  <input id = "Adding_FlowerSessionValue" value = "{{$AddingFlowersessionValue}}">
  <input id = "Adding_OrderSessionValue" value = "{{$AddingOrdersessionValue}}">
  <input id = "Cancel_BQTSessionValue" value = "{{$CancelOBQTsessionValue}}">

</div>
<!-- Tabs with icons on Card -->
                @foreach($TAmount_flowers as $TAmount_flowers)
                  <div hidden>
                    {{$TAmount_flowers->T_Amt }}
                    {{$Flower_Total_Amt = $TAmount_flowers->T_Amt }}
                  </div>
                @endforeach


                @foreach($TAmount_bouquet as $TAmount_bouquet)
                  <div hidden>
                    {{$TAmount_bouquet->T_Amt }}
                    {{$Bqt_Total_Amt = $TAmount_bouquet->T_Amt }}
                  </div>
                @endforeach

                <?php
                 $Order_Total_Amt = $Flower_Total_Amt + $Bqt_Total_Amt;
                ?>

               @foreach($Orders_Details as $Details)
                <h3><b>Details of Sales Order NO: ORDR-{{ $Details->sales_order_ID }}</b></h3>
                <div hidden>
                  {{$order_ID = $Details->sales_order_ID}}
                </div>

                <h4><b>Customer ID: </b> CUST-{{ $Details->customer_ID }}  ({{ $Details->Customer_Fname }} {{ $Details->Customer_MName }}, {{ $Details->Customer_LName }})</h4>
                <div class = 'row'>
                  <div class = 'col-md-6'>
                    <h4><b> Flower's Total Amount: </b> Php {{number_format($Flower_Total_Amt,2)}}</h4>
                    <h4><b> Bouquet's Total Amount: </b> Php {{number_format($Bqt_Total_Amt,2)}}</h4>
                  </div>
                  <div class = 'col-md-6'>
                    <h4><b> Order's Total Amount: </b> Php {{number_format($Order_Total_Amt,2)}}</h4>
                    <div hidden>
                      <input id = "finalAmount_Field" value = {{$Order_Total_Amt}}>
                    </div>
                  </div>
                </div>
<!--Start of Adding Modal Fade-->

                <div class = 'pull-right'>
                      <a id = 'ReturnBTN' href = "{{ route ('Sales_Qoutation.index') }}" name = 'ReturnBTN' class="btn btn-danger btn-tooltip btn-sm col-xs-offset-2"  data-toggle="tooltip" data-placement="bottom" title="This will bring you back to the list of orders" data-container="body"> <i class="material-icons"
                      style="padding-right: 5px;">
                      compare</i> Return to Bouquet List
                      </a>

                      <a id = 'CheckOutBTN' href = "{{ route ('order.ConfirmOrder',['order_ID'=>$order_ID]) }}" name = 'CheckOutBTN' class="btn btn-success btn-tooltip btn-sm col-xs-offset-2"  data-toggle="tooltip" data-placement="bottom" title="Click this button to checkout all the items that you have listed" data-container="body"> <i class="glyphicon glyphicon-ok-sign"
                      style="padding-right: 2px;">
                      compare</i> Proceed to checkout
                      </a>
                </div>


                <div class="modal fade" id="AddflowerModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                  <div class="modal-content">
                {!! Form::open(array('route' => 'Sales_Order.store', 'data-parsley-validate'=>'', 'method'=>'POST')) !!}
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                      <h3 class="modal-title" id="lineModalLabel">Add Flower for this Order</h3>
                    </div>
                  <!--form open here-->

                            <div class="modal-body">
                                    <!-- content goes here -->
                                    <div id = 'FLower_ListDiv' class = "row">
                                      <div class = "col-md-7">
                                        <select id = 'FLowerList' name = 'FLowerList' class = 'btn btn-primary btn-md'>
                                        <option value = "-1" disabled selected = ''>Please Choose 1 flower</option>
                                          @foreach($FlowerList as $Fdetails)
                                            <option value = '{{$Fdetails->flower_ID}}' data-tag ='{{$Fdetails->Final_SellingPrice}}'>
                                            {{$Fdetails->flower_name}}
                                            </option>
                                          @endforeach
                                         </select>
                                           <img src= "" id="imageBox" name="imageBox" class = "img-rounded img-raised img-responsive" style="max-width: 300px; max-height: 300px;" />
                                      </div>
                                      <div class = 'col-md-4'>
                                        <div>
                                           <div class="input-group">
                                            <label class = 'control-label'>Original Price:</label>
                                            <input type="text" class="form-control" name="ViewPrice_Field" id="ViewPrice_Field"  placeholder="" disabled/>
                                          </div>

                                          <div hidden> <!--start of hidden input field-->
                                            <input type="number" class="form-control" name="OrigInputPrice_Field" id="OrigInputPrice_Field" step = '0.01'/>

                                            <input type="text" class="form-control" name="orderID_Field" id="orderID_Field" value = "{{ $Details->sales_order_ID }}"/>

                                            <label>The decision</label>
                                            <input type="text" class="form-control" name="Decision_Field" id="Decision_Field" value = 'O'/>
                                          </div>      <!--end of hidden input field-->
                                        </div>

                                        <!--<div id = 'agreement_Div' hidden>
                                           <div class="input-group">
                                           <label>Agreement Price:</label>
                                            <input type="number" class="form-control" name="AgreementPrice_Field" id="AgreementPrice_Field"  placeholder="" disabled/>
                                          </div>
                                        </div> -->

                                        <div id = "divToggleBtn" class="togglebutton" hidden>
                                              <label>
                                                  <input type="checkbox" name = "NewPriceCheckBox" id = "NewPriceCheckBox">
                                                  New Price?
                                              </label>
                                        </div>


                                         <div id = 'NewPrice_Div' hidden>
                                           <div class="form-group label-floating">
                                            <label class = 'control-label'>New Price:</label>
                                            <input type="number" class="form-control" name="NewPrice_Field" id="NewPrice_Field" value = '1.00' step = "0.01"/>
                                           </div>
                                         </div>

                                          <div id = 'QTY_Div'>
                                           <div class="form-group label-floating">
                                            <label class = 'control-label'>Quantity:</label>
                                            <input type="number" class="form-control" name="QTY_Field" id="QTY_Field"  placeholder="" min = '1' required/>
                                          </div>
                                         </div>

                                        </div>
                                      </div>
                                    <div class = "row">
                                        <div class = "col-md-7">

                                        </div>
                                        <div class = "col-md-4">
                                            <div class="input-group">
                                              <label class = 'control-label'>Total Amount: </label>
                                              <input type="text" class="form-control" name="total_Amt" id="total_Amt"  placeholder="" disabled/>
                                            </div>
                                        </div>
                                    </div>
                              </div>
                            <div class="modal-footer">
                              <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                <div class="btn-group" role="group">
                                  <button type="button" class="btn btn-simple btn-default" data-dismiss="modal"  role="button">Close</button>
                                </div>
                                <div class="btn-group" role="group">
                                   <button type = "Submit" name = "AddFlowerBtn" id = "AddFlowerBtn" class = "btn btn-simple btn-success"><span class = "glyphicon glyphicon-floppy-save"></span> Add Flower</button>
                                </div>
                              </div>
                            </div>
                          </div>
                  {!! Form::close() !!}
                           <!--Form close here-->

                        </div>
                      </div>

                @endforeach
<!--end of ADDING FLOWER modal fade-->

            <div class="card card-nav-tabs">
              <div class="header"  style = 'background-color:darkviolet;'>
                <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                <div class="nav-tabs-navigation">
                  <div class="nav-tabs-wrapper">
                    <ul class="nav nav-tabs" data-tabs="tabs">
                      <li class="active">
                        <a href="#flowers" data-toggle="tab">
                          <i class="material-icons">local_florist</i>
                           Flowers
                        </a>
                      </li>
                      <li>
                        <a href="#bouquet" data-toggle="tab">
                          <i class="material-icons" style = "color:pink;">local_florist</i>
                          Bouquet
                        </a>
                      </li>
                  <!--<li>
                        <a href="#settings" data-toggle="tab">
                          <i class="material-icons">build</i>
                          Settings
                        </a>

                      </li>-->
                    </ul>
                  </div>
                </div>
              </div>
              <div class="content">
                <div class="tab-content text-center">
                  <div class="tab-pane active" id="flowers">
                    <div class = 'pull-left'>
                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#AddflowerModal">
                        Add flowers
                      </button>
                    </div>
                    <div class="box-body">
                      <table id="flowersTable" class="table table-bordered table-striped">
                        <thead>
                            <th> Flower ID </th>
                            <th> Flower Name</th>
                            <th> Unit Price </th>
                            <th> Quantity </th>
                            <th> Amount </th>
                            <th> Action </th>

                        </thead>
                        <tbody>
                          @foreach($Flowers as $flower)
                            <tr>
                              <td> {{$flower->Flower_ID}} </td>
                              <td> {{$flower->Flower_Name}} </td>
                              <td> Php {{$flower->unit_price}}     </td>
                              <td> {{$flower->QTY}} Pcs.      </td>
                              <td> Php {{$flower->Amt}}     </td>
                              <td align="center" >
                               <?php
                                  $joined_ID = $order_ID.'_'.$flower->Flower_ID;
                                  //gets the order_ID and Flower_ID then joins it then it to the edit function of the routes
                               ?>
                                <a type = "button" href="{{ route ('Sales_Order.edit', $joined_ID ) }}" class = "btn btn-primary btn-sm" ><span class = "glyphicon glyphicon-pencil"></span>
                                   Manage Order
                                </a>

                                <a type = "button" href="{{ route('Flowerorder.DelOrderFlowers',['order_ID'=>$order_ID,'flower_ID'=>$flower->Flower_ID,'QTY'=>$flower->QTY,'T_PRICE'=>$flower->Amt]) }}" name = "deleteBTN" id = "deleteBTN" class = "btn btn-danger btn-sm" >
                                  <span class = "glyphicon glyphicon-trash"></span>
                                   Delete
                                </a>

                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                  </div><!--END OF BOX-BODY-->

                  </div>

                  <div class="tab-pane" id="bouquet">
                    <div class = 'pull-left'>
                      <a type="button" href = "{{route('Order.CreateaBouquet',['Order_id'=>$order_ID])}}" class="btn btn-primary btn-sm"  >
                        Create Bouquet
                      </a>
                    </div>
                    <div class="box-body">
                      <table id="BouqTable" class="table table-bordered table-striped">
                        <thead>
                          <th> Bouquet ID </th>
                          <th> Unit Price</th>
                          <th> Quantity </th>
                          <th> Total Amount </th>
                          <th> Action </th>
                        </thead>
                        <tbody>
                            @foreach($Bouquets as $Bqts)
                              <tr>
                                  <td> BQT_{{$Bqts->Bqt_ID}} </td>
                                  <td> Php {{number_format($Bqts->Unit_Price,2)}} </td>
                                  <td> {{$Bqts->QTY}} pcs.</td>
                                  <td> Php {{number_format($Bqts->Amt,2)}} </td>
                                  <td align="center" >
                                    <button class="btn btn-info btn-sm"> View </button></a>
                                    <button class="btn btn-danger btn-sm"> Delete </button></a>
                                  </td>
                              </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Tabs with icons on Card -->
  </section>
    <!-- End Section Tabs -->
@endsection

@section('scripts')

  <script type="text/javascript">
      $(function () {
        $("#example2").DataTable();
        $('#BouqTable').DataTable({
          "paging": true,
          "info": true,
          "autoWidth": true
        });
        $('#flowersTable').DataTable({
          "paging": true,
          "info": true,
          "autoWidth": true
        });
        $('#cancelledtable').DataTable({
          "paging": true,
          "info": true,
          "autoWidth": false
        });
      });
  </script>

  <script>
  $('document').ready(function(){

      if($('#Cancel_BQTSessionValue').val()=='Successful'){
         //Show popup
         swal("Take Note:","Creation of bouquet was cancelled the progress of ceation will be reset","success");
       }

      if($('#Adding_OrderSessionValue').val()=='Successful'){
         //Show popup
         swal("Good Job!","Customer's details was obtained, you may now proceed to adding your desired items","success");
       }

      if($('#Saving_BouquetSessionValue').val()=='Successful'){
         //Show popup
         swal("Good Job!","Bouquet has been successfully made!","success");
       }

      if($('#Adding_FlowerSessionValue').val()=='Successful'){
         //Show popup
         swal("Good Job!","Flower has been successfully added to order!","success");
       }

        if($('#finalAmount_Field').val() == 0){
          $('#ReturnBTN').attr('disabled',true);
          $('#CheckOutBTN').attr('disabled',true);
        }

        $('#newPrice_Btn').click(function(){
          $('#NewPrice_Div').slideDown();
          $('#newPrice_Btn').slideUp();
        }); //end of function
        $('#CancelPrice_Btn').click(function(){
          $('#newPrice_Btn').slideDown();
          $('#NewPrice_Div').slideUp();
        });
        //end of functionx

        if($("#FLowerList option").val() == '-1'){
          $('#AddFlowerBtn').attr('disabled',true);
        }

        $('#OrigInputPrice_Field').change(function(){
           var NewTAmt =  $('#OrigInputPrice_Field').val() * $("#QTY_Field").val();
           var FinalTAmt = 'Php '+ NewTAmt;
           $('#total_Amt').val(FinalTAmt);
            $('#QTY_Field').change(function(){
           var NewTAmt =  $('#OrigInputPrice_Field').val() * $("#QTY_Field").val();
           var FinalTAmt = 'Php '+ NewTAmt;
           $('#total_Amt').val(FinalTAmt);
          });
        });

        $("#FLowerList").change(function(){
          $('#AddFlowerBtn').attr('disabled',false);
          $('#divToggleBtn').slideDown();
          var element =  $(this);
          var price = 'Php' + ' ' + $('option:selected').attr( "data-tag" );
          var price2 = $('option:selected').attr( "data-tag" );
          $('#ViewPrice_Field').val(price);
          $('#OrigInputPrice_Field').val(price2);

          $(
            '#OrigInputPrice_Field').change(function(){
           var NewTAmt =  $('#OrigInputPrice_Field').val() * $("#QTY_Field").val();
           var FinalTAmt = 'Php '+ NewTAmt;
           $('#total_Amt').val(FinalTAmt);
          });

          $('#QTY_Field').change(function(){
           var NewTAmt =  $('#OrigInputPrice_Field').val() * $("#QTY_Field").val();
           var FinalTAmt = 'Php '+ NewTAmt;
           $('#total_Amt').val(FinalTAmt);
          });
        });//end of function

        $('#NewPriceCheckBox').click(function(){
            var Descision = '';
          //$('#Customer_Chooser').fadeToggle(300);
          if($('#NewPriceCheckBox').is(':checked') == true){
            console.log('pasok');
             Descision = 'N';
               console.log(Descision);

            $('#NewPrice_Div').slideDown();
            $('#NewPrice_Field').attr('required',true);
            $('#Decision_Field').val(Descision);
              $('#NewPrice_Field').change(function(){
               var NewTAmt =  $('#NewPrice_Field').val() * $("#QTY_Field").val();
               var FinalTAmt = 'Php '+ NewTAmt;
               $('#total_Amt').val(FinalTAmt);
              });

              $('#QTY_Field').change(function(){
               var NewTAmt =  $('#NewPrice_Field').val() * $("#QTY_Field").val();
               var FinalTAmt = 'Php '+ NewTAmt;
               $('#total_Amt').val(FinalTAmt);
              });
           }
           else{
            $('#NewPrice_Div').slideUp();
               Descision = 'O';
              $('#NewPrice_Field').attr('required',false);
              $('#Decision_Field').val(Descision);

              $('#OrigInputPrice_Field').change(function(){
               var NewTAmt =  $('#OrigInputPrice_Field').val() * $("#QTY_Field").val();
               var FinalTAmt = 'Php '+ NewTAmt;
               $('#total_Amt').val(FinalTAmt);
              });

              $('#QTY_Field').change(function(){
               var NewTAmt =  $('#OrigInputPrice_Field').val() * $("#QTY_Field").val();
               var FinalTAmt = 'Php '+ NewTAmt;
               $('#total_Amt').val(FinalTAmt);
              });
           }
        }); //end of functionx

  });
  </script>

@endsection
