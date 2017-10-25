@extends('main')

@section('content')

   <?php
    $final_Amt = str_replace(',','',Cart::instance('Ordered_Flowers')->subtotal()) + str_replace(',','',Cart::instance('Ordered_Bqt')->subtotal());

    $NewOrderDetailsRows = Session::get('newOrderSession');

   ?>


<div class = "container" style = "margin-top:4%;">
  <input class = "hidden"  id = "transtypefield" value = "{{$NewOrderDetailsRows[13]}}">

  <div class = "row">
      <div class = "col-md-9">
        <span class="label danger" style="font-size: 120%; background-color: darkviolet; margin-left: 10px;">Manage The Confirmation of Order</span>
      </div>
      <div class = "col-md-3">
        <a href="{{ route('return.orderCreation') }}" class="btn btn-md btn-danger btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="This button will cancel the confirmation and will reset the progress you've mde lead you back to the" data-container="body"><span class = "glyphicon glyphicon-remove"></span> Cancel Confirmation </a>
      </div>
  </div><!--end of row-->

  <div class = "row" id="order_SummaryDiv">
          <div class = "col-md-5">
              <div class="panel" style = "margin-top:2%;">
                <div class="panel panel-primary" id = "OrderDet_Div">
                    <div class="panel-heading">
                      <div class="panel-title">
                        <div class="row">
                          <div class="col-xs-6">
                            <h5><span class="glyphicon glyphicon-user"></span><b> Order details</b></h5>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="panel-body">
                      <div style = "margin-left:1%;">
                        <h4 style = "color:darkviolet;"><b>CUSTOMER INFORMATION:</b></h4>

                        <h5><b>Customer Name: </b></h5>
                        <hr>
                        <h4 style = "color:darkviolet;"><b>CONTACT INFORMATION:</b></h4>

                            <h5><b>Cont. Num: </b></h5>
                            <h5><b>Email Add: </b></h5>

                      </div>
                    </div><!--end of panel body-->
                    <div class="panel-footer" id = "footer1">
                      <div class="row text-center">
                       <a type="button" id = "CheckOutConfbtn" name = "CheckOutConfbtn" class="btn btn-simple btn-tooltip" data-toggle="tooltip" data-placement="right" title="This will show the Fields and options that you'll need to fill out to finish the transaction" data-container="body">Confirmation  <span class = "glyphicon glyphicon-chevron-up"></span></a>
                      </div>
                    </div>
                  </div>
                  <div class="panel-footer" id = "footer2" hidden>
                    <div class="row text-center">
                     <a type="button" id = "CancelCheckOutbtn" name = "CancelCheckOutbtn" class="btn btn-simple btn-tooltip" data-toggle="tooltip" data-placement="right" title="This will show the Fields and options that you'll need to fill out to finish the transaction" data-container="body">Order Details  <span class = "glyphicon glyphicon-chevron-down"></span></a>
                    </div>
                  </div>
                </div>

                <div class = "panel" id = "confirmation_Div" hidden>
                  <div class = 'panel panel-primary'>
                    <div class="panel-heading">
                      <div class="panel-title">
                        <div class="row">
                          <div class="col-xs-6">
                            <h5><span class="glyphicon glyphicon-credit-card"></span><b> Checkout</b></h5>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class = "panel-body">
                                          <!--form open here-->
                      <div id = "Quicktransaction_Div" hidden>
                        <h4><b>Payment Part </b></h4>
                        <hr>

                        <div class = "row">
                          <div class = "col-md-6">

                           <div hidden>
                            </div>


                              <h4><b>Total Amount:</b></h4>
                              <h5><b> Php {{number_format($final_Amt,2)}} </b></h5>
                          </div>
                          <div class = "col-md-6">
                            <div class="form-group label-floating">
                              <label class="control-label">Enter Amount Paid:</label>
                              <input type="number" class="form-control" name="AmountPaid" id="AmountPaid" required/>
                            </div>
                          </div>
                        </div>
                        <div class = "row">
                          <div class = "col-md-6 pull-right" >
                            <div class="form-group label-control">
                              <label class="control-label">Change</label>
                              <input type="number" class="form-control" value = "0.00" name="Change" id="Change" disabled/>
                            </div>
                          </div><!--end of column-->
                        </div><!--end of row-->
                        <div class = "pull-right">
                          <button id = "ProcessQuickBtn" class = "btn btn-md btn-primary"> Process <span class = "glyphicon glyphicon-saved"></span></button>
                        </div>
                    <!--form close here-->
                      </div><!--end of payment div-->
                      <div id = "longTrans">
                          <h4><b>Choose Shipping Method</b></h4>
                          <div class = "row">
                            <div class="radio">
                              <label>
                                <input type="radio" name="Sippingoptions" id = "Rdopickup" checked>
                                  Pick Up
                              </label>
                              <label>
                                <input type="radio" name="Sippingoptions" id = "Rdodelivery">
                                  Delivery
                              </label>
                            </div>
                          </div><!--end of row-->
                          </div>
                      <div id = "PickupDiv">
                      <h4><b>Pickup details: </b></h4>
                        <div class = "row">
                          <div class = "col-md-6">
                              <div class="form-group">
                                <label class="control-label">Delivery Date:</label>
                                <input type="Date" class="form-control" name="pickUpDate_field" id="pickUpDate_field" required/>
                              </div>
                          </div>
                          <div class = "col-md-6">
                              <div class="form-group">
                                <label class="control-label">Delivery Time:</label>
                                <input type="time" class="form-control" name="pickUpdate_field" id="pickUpdate_field" required/>
                              </div>
                          </div>
                        </div>
                        <div class = "pull-right">
                            <button id = "NextBtn1" class = "btn btn-md btn-primary">Next <span class = "glyphicon glyphicon-triangle-right"></span></button>
                          </div>
                      </div>
                      <div id = "PickupDiv2" hidden>
                        <h4><b>Payment Method: </b></h4>
                          <div class = "row">
                            <div class = "col-md-6">
                                <div class="form-group">
                                  <label class="control-label">Delivery Date:</label>
                                  <input type="Date" class="form-control" name="pickUpDate_field" id="pickUpDate_field" required/>
                                </div>
                            </div>
                            <div class = "col-md-6">
                                <div class="form-group">
                                  <label class="control-label">Delivery Time:</label>
                                  <input type="time" class="form-control" name="pickUpdate_field" id="pickUpdate_field" required/>
                                </div>
                            </div>
                          </div>
                            <div>
                              <button id = "BackBtn0" class = "btn btn-md btn-danger pull-left"> Back <span class = "glyphicon glyphicon-triangle-left"></span></button>

                              <button  id = "ProcessEndBtn0" class = "btn btn-md btn-primary pull-right"> Process <span class = "glyphicon glyphicon-saved"></span></button>
                            </div>
                      </div>

                      <div id = "delivery_Div" hidden>
                        <div id = "deliveryDiv_Part1">
                          <h4><b>Recipient Details:</b></h4>
                          <div class = "row">
                            <div class = "col-md-6">
                              <div class="form-group label-floating">
                                <label class="control-label">Recipient's Firstname</label>
                                <input type="text" class="form-control" name="RFname" id="RFname" maxlength = '20' required/>
                              </div>
                            </div><!--end of column-->
                            <div class = "col-md-6">
                              <div class="form-group label-floating">
                                <label class="control-label">Recipient's Lastname</label>
                                <input type="text" class="form-control" name="RLname" id="RLname" maxlength = '20' required/>
                              </div>
                            </div><!--end of column-->
                          </div><!--end of row-->
                          <div class = "row">
                            <div class = "col-md-6">
                              <div class="form-group label-floating">
                                <label class="control-label">Contact Number</label>
                                <input type="number" class="form-control" name="RContNum" id="RContNum" maxlength = '11' required/>
                              </div>
                            </div><!--end of column-->
                            <div class = "col-md-6">
                              <div class="form-group label-floating">
                                <label class="control-label">Email Address</label>
                                <input type="email" class="form-control" name="REmail" id="REmail" maxlength = '20'/>
                              </div>
                            </div><!--end of column-->
                          </div><!--end of row-->

                          <h4><b>Delivery Address:</b></h4>
                          <div class="form-group label-floating">
                            <label class="control-label">Address Line</label>
                            <input type="email" class="form-control" name="Address_Field" id="Address_Field" maxlength = '20'/>
                          </div>
                          <div class="row" id = "AdrsDiv">
                            <div class = "col-md-6">
                              <select class="btn btn-primary btn-sm" name ="ProvinceField" id ="ProvinceField" style = "margin-left:-1%;">
                                  <option value ="-1" data-tag ="-1" disabled selected> Choose one Province </option>
                                  @foreach($province as $prov)
                                    <option value ="{{$prov->id}}" > {{$prov->name}} </option>
                                  @endforeach
                              </select required>
                            </div>
                            <div class = "col-md-6">
                              <select disabled class="btn btn-primary btn-sm" name ="TownField" id ="TownField" style = "margin-left:-15%;">
                                  <option value ="-1" data-tag ="-1" disabled selected> Choose one City </option>
                                  @foreach($city as $city)
                                    <option value ="{{$city->id}}" data-tag = "{{$city->province_id}}"> {{$city->name}} </option>
                                 @endforeach
                              </select required >
                            </div>
                          </div>
                          <div class = "pull-right">
                            <button id = "NextBtn" class = "btn btn-md btn-primary">Next <span class = "glyphicon glyphicon-triangle-right"></span></button>
                          </div>
                        </div><!--end of part1-->

                        <div id = "deliveryDiv_Part2" hidden>
                          <div>
                            <h4><b>Payment Method:</b></h4>
                          </div>
                          <div class = "row">
                            <div class="radio">
                              <label>
                                <input type="radio" name="Paymentoptions" id = "cash" checked>
                                  Cash on Delivery
                              </label>
                              <label>
                                <input type="radio" name="Paymentoptions" id = "bank">
                                  Payment Through Bank
                              </label>
                            </div>
                          </div><!--end of row-->
                            <div>
                              <button id = "BackBtn" class = "btn btn-md btn-danger pull-left"> Back <span class = "glyphicon glyphicon-triangle-left"></span></button>

                              <button  id = "ProcessEndBtn" class = "btn btn-md btn-primary pull-right"> Process <span class = "glyphicon glyphicon-saved"></span></button>
                            </div>
                          </div>

                          <div id = "payment" hidden>
                            <div class = "row">
                              <div class = "col-md-6">
                                  <h4><b>Total Amount:</b></h4>
                                  <h5><b> Php {{number_format($final_Amt,2)}} </b></h5>
                              </div>
                              <div class = "col-md-6">
                                <div class="form-group label-floating">
                                  <label class="control-label">Enter Amount Paid:</label>
                                  <input type="number" class="form-control" name="AmountPaid" id="AmountPaid" required/>
                                </div>
                              </div>
                            </div>
                            <div class = "row">
                              <div class = "col-md-6 pull-right" >
                                <div class="form-group label-control">
                                  <label class="control-label">Change</label>
                                  <input type="number" class="form-control" value = "0.00" name="Change" id="Change" disabled/>
                                </div>
                              </div><!--end of column-->
                            </div><!--end of row-->
                            <div>
                              <button  id = "ProcessEndBtn2" class = "btn btn-md btn-primary pull-right"> Process <span class = "glyphicon glyphicon-saved"></span></button>
                            </div>
                          </div><!--end of payment div-->
                          <!--end of part2-->
                      </div><!--end of delivery details-->
                    </div>
                  </div>
                </div>
          </div><!-- end of left panel-->

          <div class="col-md-7" style = "margin-left: 0%; margin-top:1%;">
            <div class="panel">
                  <div class="panel panel-danger">
                    <div class="panel-heading">
                      <div class="panel-title">
                        <div class="row">
                          <div class="col-xs-6">
                            <h5><span class="glyphicon glyphicon-list-alt"></span> Order's Items</h5>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="panel-body">
                      <div id = "flowersCart_Div">
                      <!--looping of data here please-->
                      <h5><b>Flowers</b></h5>
                      <?php
                        $Flower_TAmt = 0;
                        $Total_Order_Amt = 0;
                      ?>

                    @foreach(Cart::instance('Ordered_Flowers')->content() as $Flwr)
                      <div class="row">
                        <div class="col-xs-1"><img class="img-rounded img-raised img-responsive" style="min-width: 50px; max-height: 50px;" src="{{ asset('flowerimage/'.$Flwr->options['image'])}}">
                        </div>
                        <div class="col-xs-2">
                          <h6 class="product-name"><strong>{{$Flwr->name}}</strong></h6>
                        </div>
                        <div class="col-xs-4" style = "color:red; margin-top:3%;">
                          <h7>Php {{number_format($Flwr->price,2)}}  <span class="text-muted"><b> x</b></span></h7>
                        </div>
                        <div class="col-md-2" style = "margin-top:3%; margin-left:-10%;">
                          <h7>{{$Flwr->qty}} pcs.</h7>
                        </div>
                        <div class="col-xs-4" style = "color:darkviolet; margin-top:3%;">
                          <h7><b>=</b> Php {{number_format($Flwr->qty*$Flwr->price,2)}}</h7>
                        </div>
                      </div>

                      @endforeach
                      <?php
                        $Flower_TAmt = str_replace(',','',Cart::instance('Ordered_Flowers')->subtotal());
                        $Total_Order_Amt += $Flower_TAmt;
                        ?>
                  <!--end foreach here-->
                  </div><!--End of flowers in cart Div-->
                      <div class="col-xs-12">
                          <h5 class="text-right" style = "color:darkviolet"><strong>(Flowers)Total Amount:</strong> Php {{$Flower_TAmt}}</h4>

                      </div>
                  <hr>
                    <div id = "BqtCart_Div">
                      <h5 ><b>Bouquets</b></h5>
  <!--loop of data here-->
  <?php
    $total_BQT_Price = 0;
  ?>
                    @foreach(Cart::instance('Ordered_Bqt')->content() as $Bqt)
  <!--Form open here for update-->
                      <div class="row">
                        <div class="col-xs-3">
                          <h6 class="product-name"><strong>Bouquet-{{$Bqt->id}}</strong></h6>
                        </div>
                          <div class="col-xs-4" style = "color:red; margin-top:3%;">
                            <h7>Php {{number_format($Bqt->price,2)}} <span class="text-muted"><b> x</b></span></h7>
                          </div>
                          <div class="col-md-2" style = "margin-top:3%; margin-left:-10%;">
                            <h7>{{$Bqt->qty}} pcs.<span class="text-muted"></h7>
                          </div>
                          <div class="col-xs-4" style = "color:red; margin-top:3%;">

                            <h7 style = "color:darkviolet"><b>=</b> Php {{number_format($Bqt->qty*$Bqt->price,2)}}</h7>
                          </div>
                      @endforeach
                      <?php

                        $total_BQT_Price = str_replace(',','',Cart::instance('Ordered_Bqt')->subtotal());
                        $Total_Order_Amt += $total_BQT_Price;
                        ?>
                      </div>
                    </div><!--End of Acessories in cart Div-->
                    <div>
                      <table id="BQT_Contents" class="table">
                        <thead>
                          <th class="text-center"> Bouquet ID </th>
                          <th class="text-center"> Item ID</th>
                          <th class="text-center"> Image </th>
                          <th class="text-center"> Description</th>
                          <th class="text-center"> Qty</th>
                          <th class="text-center"> Price</th>
                          <th class="text-center"> Amt </th>
                         </thead>

                        <tbody class = 'stripe'>
                        @foreach(Cart::instance('FinalBqt_Flowers')->content() as $Bqt_F)
                          <tr>
                            <td class="text-center"> Bouquet-{{$Bqt_F->options['bqt_ID']}} </td>
                            <td class="text-center"> {{$Bqt_F->id}} </td>
                            <td class="text-center">
                              <img class="img-rounded img-raised img-responsive" style="min-width: 25px; max-height: 25px;" src="{{ asset('flowerimage/'.$Bqt_F->options['image'])}}">
                            </td>
                            <td class="text-center"> {{$Bqt_F->name}} </td>
                            <td class="text-center"> {{$Bqt_F->qty}}  </td>
                            <td class="text-center">Php {{number_format($Bqt_F->price,2)}}</td>
                            <td class="text-center">Php {{number_format($Bqt_F->options['T_Amt'],2)}} </td>
                          </tr>
                        @endforeach
                        @foreach(Cart::instance('FinalBqt_Acessories')->content() as $Acrs)
                          <tr>
                            <td class="text-center"> Bouquet-{{$Acrs->options['bqt_ID']}} </td>
                            <td class="text-center"> {{$Acrs->name}} </td>
                            <td class="text-center">
                              <img class="img-rounded img-raised img-responsive" style="min-width: 25px; max-height: 25px;" src="{{ asset('accimage/'.$Acrs->options['image'])}}">
                            </td>
                            <td class="text-center"> {{$Acrs->name}} </td>
                            <td class="text-center"> {{$Acrs->qty}}  </td>
                            <td class="text-center">Php {{number_format($Acrs->price,2)}}</td>
                            <td class="text-center">Php {{number_format($Acrs->options['T_Amt'],2)}} </td>
                          </tr>
                        @endforeach
                        </tbody><!--end of table-->
                      </table>

                    </div><!--end of table div-->
                    <div class="col-xs-12">

                      <h5 class="text-right" style = "color:darkviolet"><strong>(Bouquet)Total Amount:</<strong> Php {{ $total_BQT_Price}}</h5>

                    </div>
                    </div>
                    <div class="panel-footer">
                      <div class="row text-center">
                        <div class="col-xs-9">
                          <h4 class="pull-left" style = 'color:darkviolet;'><strong>Total Amount of Order: </strong> Php  {{number_format($Total_Order_Amt,2)}}</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
          </div><!--end of col-->
  </div>
  <div id = "Checkout_div">

  </div>

</div>

@endsection


@section('scripts')

<script>
/**/
 $(function () {

     // $("#example1").DataTable();
      $('#BQT_Contents').DataTable({
        "paging": true,
       // "info": true,
       // "autoWidth": false
      });
    });

 $(document).ready(function(){

//alert($('#transtypefield').val());
    if($('#transtypefield').val() == 'quick'){
      $('#deliveryDiv_Part2').hide();
      $('#deliveryDiv_Part1').hide();
      $('#PickupDiv2').hide();
      $('#PickupDiv').hide();
      $('#longTrans').hide();
      $('#Quicktransaction_Div').show("fold");
    }

    $('#BackBtn').click(function(){
      $('#deliveryDiv_Part2').hide();
      $('#deliveryDiv_Part1').show();
    });


    $('#BackBtn0').click(function(){
      $('#PickupDiv2').hide("fold");
      $('#PickupDiv').show("fold");
    });



    $('#NextBtn').click(function(){
      $('#deliveryDiv_Part2').show();
      $('#deliveryDiv_Part1').hide();
    });

    $('#NextBtn1').click(function(){
      $('#PickupDiv2').show("fold");
      $('#PickupDiv').hide("fold");
    });

    $('#CancelCheckOutbtn').click(function(){
        $('#OrderDet_Div').slideDown();
        $('#footer1').slideDown();
        $('#footer2').slideUp();
        $('#confirmation_Div').slideUp();
    });

    $('#CheckOutConfbtn').click(function(){
        $('#OrderDet_Div').slideUp();
        $('#footer2').slideDown();
        $('#confirmation_Div').slideDown();
    });

    $('#QuickTrans_BTN').click(function(){
      if($('#QuickTrans_BTN').is(':checked') == true){
        $('#Quicktransaction_Div').slideDown();
        $('#delivery_Div').slideUp();
       }//end
       else{
          $('#Quicktransaction_Div').slideUp();
          $('#delivery_Div').slideDown();
       }//end
    });

      $("#TownField").attr("disabled",true);

      $('#ProvinceField').change(function(){
        $("#TownField").attr("disabled",false);
        $("#TownField").attr('required', true);
                  var selected = $(this).val();
                  $("#TownField option").each(function(item){
                   // console.log(selected) ;
                    var element =  $(this) ;
                    console.log(element.data("tag")) ;
                    if (element.data("tag") != selected){
                      element.hide() ;
                    }
                    else{
                      element.show();
                    }
                  }) ;

                $("#TownField").val($("#TownField option:visible:first").val());
        });//end of function

  if($('#AddAcessory_result').val()=='Successful'){
    //Show popup
    swal("Good!","Acessory has been successfully added to your Bouquet!","success");
   }


        if($('#count_offlowers_Field').val()<12){
          $('#saveBtn').attr('disabled',true);
          $('#saveBtn').click(function(){
            return false;
         });
        }//determines if the bouquet is at its limit


        if($('#ViewFlowers_CheckBox').is(":checked")){
            $('#flowersCart_Div').slideDown();
          }//if the checkbutton is clicked by default, the there must be a display of the items on cart
        if($('#ViewAcessories_CheckBox').is(":checked")){
            $('#AcessoriesCart_Div').slideDown();
          }//if the checkbutton is clicked by default, the there must be a display of the items on cart

        $('#ViewFlowers_CheckBox').click(function(){
          if($('#ViewFlowers_CheckBox').is(":checked")){
            $('#flowersCart_Div').slideDown();
          }
          else{
            $('#flowersCart_Div').slideUp();
          }
        });

        $('#ViewAcessories_CheckBox').click(function(){
          if($('#ViewAcessories_CheckBox').is(":checked")){
            $('#AcessoriesCart_Div').slideDown();
          }
          else{
            $('#AcessoriesCart_Div').slideUp();
          }
        });

        $('#flowerBtn').click(function(){
          $('#FLower_ListDiv').slideDown();
          $('#FLower_ListDiv').after($('#Acessory_ListDiv'));
          $('#Acessory_ListDiv').slideUp();
          $('#Acessory_ListDiv').before($('#FLower_ListDiv'));
        });

        $('#acessoryBtn').click(function(){
          $('#FLower_ListDiv').slideUp();
          $('#FLower_ListDiv').before($('#Acessory_ListDiv'));
          $('#Acessory_ListDiv').slideDown();
          $('#Acessory_ListDiv').after($('#FLower_ListDiv'));
        });

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

        if($("#AcessoryList option").val() == '-1'){
          $('#AddAcessoryBtn').attr('disabled',true);
        }

        $("#FLowerList").change(function(){
          $('#AddFlowerBtn').attr('disabled',false);
          $('#divToggleBtn').slideDown();
          var element =  $(this);
          var price = 'Php' + ' ' + $('option:selected').attr( "data-tag" );
          var price2 = $('option:selected').attr( "data-tag" );
          $('#ViewPrice_Field').val(price);
          $('#OrigInputPrice_Field').val(price2);

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

          $("#flower_name option").each(function(item){
            var f_element = $(this);
            if(f_element.data('tag') == element.val()){
              f_element.attr('selected',true);
            }//this sets the name of the flower to the other field
          });
          $("#flower_image option").each(function(item){
            var fi_element = $(this);
            if(fi_element.data('tag') == element.val()){
              fi_element.attr('selected',true);
            }//this sets the name of the flower to the other field
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
               var DefPrice = '1.00';
              $('#NewPrice_Field').attr('required',false);
              $('#NewPrice_Field').val(DefPrice);
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
        });  //end of functionx


        $("#AcessoryList").change(function(){
          $('#AddAcessoryBtn').attr('disabled',false);
          $('#divToggleBtnforAcessories').slideDown();
          var element =  $(this);
          var price = 'Php' + ' ' + $('option:selected').attr( "data-tag" );
          var price2 = $('option:selected').attr( "data-tag" );
          $('#AcessoryViewPrice_Field').val(price);
          $('#AcessoryOrigInputPrice_Field').val(price2);

          $('#AcessoryOrigInputPrice_Field').change(function(){
           var NewTAmt =  $('#AcessoryOrigInputPrice_Field').val() * $("#AcessoryQTY_Field").val();
           var FinalTAmt = 'Php '+ NewTAmt;
           $('#Acessorytotal_Amt').val(FinalTAmt);
          });

          $('#AcessoryQTY_Field').change(function(){
           var NewTAmt =  $('#AcessoryOrigInputPrice_Field').val() * $("#AcessoryQTY_Field").val();
           var FinalTAmt = 'Php '+ NewTAmt;
           $('#Acessorytotal_Amt').val(FinalTAmt);
          });

          $("#Acessoryname_List option").each(function(item){
            var A_element = $(this);
            if(A_element.data('tag') == element.val()){
              A_element.attr('selected',true);
            }//this sets the name of the flower to the other field
          });
          $("#AcessoryPic_List option").each(function(item){
            var Ai_element = $(this);
            if(Ai_element.data('tag') == element.val()){
              Ai_element.attr('selected',true);
            }//this sets the name of the flower to the other field
          });
        });//end of function


          $('#NewAcessoryPriceCheckBox').click(function(){
            var AcessoryDescision = '';
          //$('#Customer_Chooser').fadeToggle(300);
          if($('#NewAcessoryPriceCheckBox').is(':checked') == true){
              console.log('pasok');
               AcessoryDescision = 'N';
               console.log(AcessoryDescision);

              $('#NewPrice_DivforAcessories').slideDown();
              $('#AcessoryNewPrice_Field').attr('required',true);
              $('#AcessoryDecision_Field').val(AcessoryDescision);
                $('#AcessoryNewPrice_Field').change(function(){
                 var NewTAmt =  $('#AcessoryNewPrice_Field').val() * $("#AcessoryQTY_Field").val();
                 var FinalTAmt = 'Php '+ NewTAmt;
                 $('#Acessorytotal_Amt').val(FinalTAmt);
                });

                $('#AcessoryQTY_Field').change(function(){
                 var NewTAmt =  $('#AcessoryNewPrice_Field').val() * $("#AcessoryQTY_Field").val();
                 var FinalTAmt = 'Php '+ NewTAmt;
                 $('#Acessorytotal_Amt').val(FinalTAmt);
                });
           }//end of if
           else{
            $('#NewPrice_DivforAcessories').slideUp();
               Descision = 'O';
               var Defaultprice = '1.00';
              $('#AcessoryNewPrice_Field').attr('required',false);
              $('#AcessoryNewPrice_Field').val(Defaultprice);
              $('#AcessoryDecision_Field').val(AcessoryDescision);

              $('#AcessoryQTY_Field').change(function(){
               var NewTAmt =  $('#AcessoryOrigInputPrice_Field').val() * $("#AcessoryQTY_Field").val();
               var FinalTAmt = 'Php '+ NewTAmt;
               $('#Acessorytotal_Amt').val(FinalTAmt);
              });
        }
      });

          $("#Rdopickup").click(function(){
            $("#PickupDiv").show("fold");
            $("#delivery_Div").hide("fold");
          });

          $("#Rdodelivery").click(function(){
            $("#PickupDiv").hide("fold");
            $("#PickupDiv2").hide("fold");
            $("#delivery_Div").show("fold");
          });

//scripts for avoiding invalid characters in a number field
      $('#NewPrice_Field').live('keypress', function(key) {
        if(key.charCode < 48 || key.charCode > 57) return false;
      });


      $('#AcessoryNewPrice_Field').live('keypress', function(key) {
        if(key.charCode < 48 || key.charCode > 57) return false;
      });

      $('#QTY_Field').live('keypress', function(key) {
        if(key.charCode < 48 || key.charCode > 57) return false;
      });

      $('#AcessoryQTY_Field').live('keypress', function(key) {
        if(key.charCode < 48 || key.charCode > 57) return false;
      });
//end of scripts

 });
</script>
@endsection
