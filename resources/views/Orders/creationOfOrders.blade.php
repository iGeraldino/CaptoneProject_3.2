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

  $DeletionofFlowerOrderSessionValue = Session::get('Deleted_Flowerfrom_Order');
  Session::remove('Deleted_Flowerfrom_Order');//determines the deletion of a flower flower

    $NewOrderDetailsRows = Session::get('newOrderSession');
    $Flower_Total_Amt = 0;
    $Bqt_Total_Amt = 0;
    $order_ID = 0;

    $final_Amt = str_replace(',','',Cart::instance('Ordered_Flowers')->subtotal()) + str_replace(',','',Cart::instance('Ordered_Bqt')->subtotal());
  ?>


<div hidden>
  <input id = "transtypefield" value = "{{$NewOrderDetailsRows[13]}}">
  <input id = "Delete_FlowerSessionValue" value = "{{$DeletionofFlowerOrderSessionValue}}">
  <input id = "Saving_BouquetSessionValue" value = "{{$SavingBouquetsessionValue}}">
  <input id = "Adding_FlowerSessionValue" value = "{{$AddingFlowersessionValue}}">
  <input id = "Adding_OrderSessionValue" value = "{{$AddingOrdersessionValue}}">
  <input id = "Cancel_BQTSessionValue" value = "{{$CancelOBQTsessionValue}}">
</div>
<!-- Tabs with icons on Card -->
                <h4><b>Customer: </b> {{$NewOrderDetailsRows[2]}} {{$NewOrderDetailsRows[3]}},{{$NewOrderDetailsRows[4]}}</h4>
                <div class = 'row'>
                  <div class = 'col-md-6'>
                    <h4><b> Flower's Total Amount: </b> Php {{Cart::instance('Ordered_Flowers')->subtotal()}}</h4>
                    <h4><b> Bouquet's Total Amount: </b> Php {{Cart::instance('Ordered_Bqt')->subtotal()}}</h4>
                  </div>
                  <div class = 'col-md-6'>
                    <h4><b> Order's Total Amount: </b> Php {{number_format($final_Amt,2)}} </h4>
                    <div hidden>
                      <input id = "finalAmount_Field" value = "{{number_format($final_Amt,2)}}">
                    </div>
                  </div>
                </div>
<!--Start of Adding Modal Fade-->

                <div class = 'pull-right'>
                      <a id = 'ReturnBTN' href = "{{ route ('Sales_Qoutation.index') }}" name = 'ReturnBTN' class="btn btn-danger btn-tooltip btn-sm col-xs-offset-2"  data-toggle="tooltip" data-placement="bottom" title="This will clear all pf the progress that you've made, and will redirect you back to the list of orders" data-container="body"> <i class="material-icons" 
                      style="padding-right: 5px;">
                      compare</i> Cancel Creation of Order
                      </a>

                      <a id = 'CheckOutBTN' href = "{{ route ('order.ConfirmOrder') }}" name = 'CheckOutBTN' class="btn btn-success btn-tooltip btn-sm col-xs-offset-2"  data-toggle="tooltip" data-placement="bottom" title="Click this button to checkout all the items that you have listed" data-container="body"> <i class="glyphicon glyphicon-ok-sign" 
                      style="padding-right: 2px;">
                      </i> Proceed to checkout
                      </a>
                </div>


                <div class="modal fade" id="AddflowerModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                  <div class="modal-content">
                {!! Form::open(array('route' => 'Orders_Flowers.store', 'data-parsley-validate'=>'', 'method'=>'POST')) !!}
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
                                        <div hidden>
                                         <select id = 'FLowerList2' name = 'FLowerList2' class = 'btn btn-primary btn-md'>
                                          <option value = "-1" disabled selected = ''>Please Choose 1 flower</option>
                                            @foreach($FlowerList as $Fdetails)
                                              <option value = '{{$Fdetails->QTY}}' data-tag ='{{$Fdetails->flower_ID}}'> 
                                              {{$Fdetails->QTY}}
                                              </option>
                                            @endforeach  
                                         </select>  
                                        </div>
                                           <img src= "" id="imageBox" name="imageBox" class = "img-rounded img-raised img-responsive" style="max-width: 300px; max-height: 300px;" />
                                      </div>
                                      <div class = 'col-md-4'>
                                        <div>
                                          <div class="input-group">
                                            <label class = 'control-label'>Current Selling Price:</label>
                                            <input type="text" class="form-control" name="ViewPrice_Field" id="ViewPrice_Field"  placeholder="" disabled/>
                                          </div>
                                          
                                          <div id = 'availableQTYDIV' hidden>
                                            <div  class="input-group" >
                                              <label class = 'control-label'>Available Quantity:</label>
                                              <input type="text" class="form-control" name="AvailableQty_Field" id="AvailableQty_Field"  placeholder="" disabled/>
                                            </div>
                                          </div>

                                          <div> <!--start of hidden input field-->
                                            <input type="number" class="form-control" name="OrigInputPrice_Field" id="OrigInputPrice_Field" step = '0.01'/>

                                            <input type="text" class="form-control" name="orderID_Field" id="orderID_Field" value = ""/>

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
<!--LOOP YOUR SESSION CONTAINNING ALL OF THE FLOWERS ORDERED SEPARATELY-->
@foreach(Cart::instance('Ordered_Flowers')->content() as $Order_Flowers)
                            <tr>  
                              <td> {{$Order_Flowers->id}}  </td>
                              <td>  {{$Order_Flowers->name}} </td>
                              <td> Php   {{$Order_Flowers->price}}   </td>
                              <td>  {{$Order_Flowers->qty}} Pcs.    </td>
                              <td> Php {{number_format($Order_Flowers->qty * $Order_Flowers->price,2)}}     </td>
                              <td align="center" > 
                               <?php
                                  $joined_ID = 0;
                                  //gets the order_ID and Flower_ID then joins it then it to the edit function of the routes
                               ?>
                                <a type = "button" href="{{ route ('Orders_Flowers.edit', $Order_Flowers->id ) }}" class = "btn btn-primary btn-sm" ><span class = "glyphicon glyphicon-pencil"></span> 
                                   Edit order
                                </a> 

                                <a type = "button" href="{{ route('Flowerorder.DelOrderFlowers',['flower_ID'=>$Order_Flowers->id]) }}" name = "deleteBTN" id = "deleteBTN" class = "btn btn-danger btn-sm" > 
                                  <span class = "glyphicon glyphicon-trash"></span> 
                                   Delete
                                </a>

                              </td>
                            </tr>
                    @endforeach
<!--eND LOOPING YOUR SESSION CONTAINING ALL OF THE FLOWERS HERE-->

                        </tbody>
                    </table>
                  </div><!--END OF BOX-BODY-->

                  </div>

                  <div class="tab-pane" id="bouquet">
                    <div class = 'pull-left'>
                      <a type="button" href = "{{route('Order.CustomizeaBouquet')}}" class="btn btn-primary btn-sm"  >
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

<!--LOOP YOUR SESSION HOLDING YOUR FLOWERS HERE--> 
                  @foreach(Cart::instance('Ordered_Bqt')->content() as $BQTrow)
                              <tr>  
                                  <td> BQT_{{$BQTrow->id}}</td>
                                  <td> Php {{number_format($BQTrow->price,2)}} </td>
                                  <td> {{$BQTrow->qty}} pcs.</td>
                                  <td> Php {{number_format($BQTrow->qty*$BQTrow->price,2)}} </td>
                                  <td align="center" > 
                                    <button class="btn btn-info btn-sm"> View </button></a>
                                    <button class="btn btn-danger btn-sm"> Delete </button></a>
                                  </td>
                              </tr>
                  @endforeach
<!--END LOOPING YOUR SESSION HOLDING YOUR FLOWERS HERE--> 
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
    
    if($('#transtypefield').val() == 'quick'){
      $('#availableQTYDIV').prop('hidden',false);
      $('#FlowerList2 option').each(function(item){
        var element = $(this);
        $('#FlowerList option').each(function(item){
          var element2 = $(this);

          if(element2.val() == element.data('tag')){
          console.log('element = '+element.data('tag'));
          console.log('element2 = '+element2.val());
             if(element.val() == 0){
              element2.hide();
             }//
             else{

              element2.show();
             
             }//
          }//
        });
      });

        $("#FLowerList").change(function(){
          var element3 =  $("#FLowerList").val();

            $('#FlowerList2 option').each(function(item){
                  var element4 = $(this);
                  if(element3 == element4.data('tag')){
                    console.log(element3);
                    console.log(element4.data('tag'));
                    element4.prop('selected',true);
                    $('#AvailableQty_Field').val(element4.val());
                  }//
              });
          });//
    }
    else if($('#transtypefield').val() != 'quick'){
     $('#availableQTYDIV').prop('hidden',true);
    }

      if($('#Delete_FlowerSessionValue').val()=='Successful'){
         //Show popup
         swal("Good Job!:","Deletion of flower was Successfully done","success");
       }
   
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
          $('#ReturnBTN').attr('disabled',false);
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