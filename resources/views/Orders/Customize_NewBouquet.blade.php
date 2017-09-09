@extends('main')

@section('content')

<?php
//declaration of variable to to be used in determining the quantity of the existing

$Flower_Count = 0;
?>

                  @foreach(Cart::instance('OrderedBqt_Flowers')->content() as $Flowersrow)
                  <?php
                   $Flower_Count += $Flowersrow->qty;
                  ?>
                  @endforeach
                  <div hidden>
                  <br>
                    <input id = 'count_offlowers_Field' value = "{{$Flower_Count}}">
                  </div>
<h2><b>Customize your own Bouquet</b></h2>
 <?php
  $sessionValue = Session::get('Added_FlowerToBQT_Order');
  Session::remove('Added_FlowerToBQT_Order');//determines the addition of new flower

  $sessionAcValue = Session::get('Added_AcessoryToBQT_Order');
  Session::remove('Added_AcessoryToBQT_Order');//determines the addition of new acessory

  $sessionUpdateFValue = Session::get('Update_FlowerToBQT_Order');
  Session::remove('Update_FlowerToBQT_Order');//deteremines the qty update of flower*/

  $sessionUpdateAcValue = Session::get('Update_AcessoryToBQT_Order');
  Session::remove('Update_AcessoryToBQT_Order');//deteremines the qty update of acessories*/

  $sessionDelFlowerValue = Session::get('Deleted_FlowerfromBQT_Order');
  Session::remove('Deleted_FlowerfromBQT_Order');//determines the deletion of flower

  $sessionDelAcessoryValue = Session::get('Deleted_AcessoryfromBQT_Order');
  Session::remove('Deleted_AcessoryfromBQT_Order');//determines the deletion of Acessory

  $NewOrderDetailsRows = Session::get('newOrderSession');
  ?>

  <div hidden>
    <input id = "transtypefield" value = "{{$NewOrderDetailsRows[13]}}">
    <input id = "AddFlower_result" value = "{{$sessionValue}}">
    <input id = "AddAcessory_result" value = "{{$sessionAcValue}}">
    <input id = "UpdateFlower_result" value = "{{$sessionUpdateFValue}}">
    <input id = "UpdateAcessory_result" value = "{{$sessionUpdateAcValue}}">
    <input id = "DeleteFlower_result" value = "{{$sessionDelFlowerValue}}">
    <input id = "DeleteAcessory_result" value = "{{$sessionDelAcessoryValue}}">

  </div>

<div class = "row">
    <div class = "col-md-9">

      <span class="label" style="font-size: 120%; background-color: #F62459; margin-left: 10px;">feel free to choose a flower</span>
    </div>
    <div class = "col-md-3">
      <a href=" {{ route ('Order.CancelBouquetCreation') }}" class="btn btn-md btn-danger btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Upon clicking this button please be aware that everything you made here will now be cleared for you have cancelled the creation, and will redirect you to your specific order" data-container="body"><span class = "glyphicon glyphicon-remove"></span> Cancel bouquet creation </a>
    </div>
</div><!--end of row-->


<div class = "row" style = "">
        <div class = "col-md-6">
          <div class = 'panel-body' >
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><b>Choose Items to add to your bouquet</b></h3>
              </div>
              <div class="panel-body">
                <div class = "row">
                  <div class="radio">
                    <label>
                      <input type="radio" checked="" name="optionsToggle" id = "flowerBtn">
                      Choose Flowers
                    </label>
                    <label>
                      <input type="radio" name="optionsToggle" id = "acessoryBtn">
                      Choose Acessories
                    </label>
                  </div>
                </div><!--end of class row-->
                <div>
                  <!---->

                </div>
                <div>
                  <div id = 'FLower_ListDiv' class = "row">
    {!! Form::open(array('route' => 'OrdersSession_Bouquet.store', 'data-parsley-validate'=>'', 'files' => 'true', 'method'=>'POST')) !!}
                  <div class = "col-md-7">
                    <h5 style = "margin-left:2%;"><b>Add flowers to your Bouquet</b></h5>
                      <select id = 'FLowerList' name = 'FLowerList' class = 'btn btn-primary btn-md'>
                          <option value = "-1" disabled selected = ''>Please Choose 1 flower</option>
                        @foreach($flowers as $flowers)
                          <option value = "{{ $flowers->flower_ID}}" data-tag = "{{ $flowers->Final_SellingPrice}}"> FLWR_{{ $flowers->flower_ID}} - ({{ $flowers->flower_name}})</option>
                        @endforeach
                      </select>
                         <img src= "" id="imageBox" name="imageBox" class = "img-rounded img-raised img-responsive" style="max-width: 300px; max-height: 300px;" />
                           <select id = 'FlowerList2' name = 'FlowerList2'>
                            @foreach($flowers2 as $frows)
                              <option value = "{{ $frows->QTY}}" data-tag = "{{ $frows->flower_ID}}"> {{ $frows->QTY}}</option>
                            @endforeach
                           </select>
                         <div hidden>

                           <select id = 'flower_name' name = 'flower_name'>
                            @foreach($flowers2 as $frows)
                              <option value = "{{ $frows->flower_name}}" data-tag = "{{ $frows->flower_ID}}"> {{ $frows->flower_name}}</option>
                            @endforeach
                           </select>

                           <select id = 'flower_image' name = 'flower_image'>
                            @foreach($flowers3 as $FIrows)
                              <option value = "{{ $FIrows->IMG}}" data-tag = "{{ $FIrows->flower_ID}}"> {{ $FIrows->IMG}}</option>
                            @endforeach
                           </select>
                         </div>
                    </div>
                    <div class = 'col-md-4'>
                      <div>
                         <div class="input-group">
                          <label class = 'control-label'>Original Price:</label>
                          <input type="text" class="form-control" name="ViewPrice_Field" id="ViewPrice_Field"  placeholder="" disabled style = "margin-top:-20%;"/>
                        </div>
                        <div hidden> <!--start of hidden input field-->
                          <input type="number" class="form-control" name="OrigInputPrice_Field" id="OrigInputPrice_Field" step = '0.01'/>


                          <label>The decision</label>
                          <input type="text" class="form-control" name="Decision_Field" id="Decision_Field" value = 'O'/>
                        </div>      <!--end of hidden input field-->

                        <div id = 'availableQTYDIV' hidden>
                          <div  class="input-group" >
                            <label class = 'control-label'>Available Quantity:</label>
                            <input type="text" class="form-control" name="AvailableQty_Field" id="AvailableQty_Field" placeholder="" disabled/>
                          </div>
                        </div>

                      </div>

                      <!--<div id = 'agreement_Div' hidden>
                         <div class="input-group">
                         <label>Agreement Price:</label>
                          <input type="number" class="form-control" name="AgreementPrice_Field" id="AgreementPrice_Field"  placeholder="" disabled/>
                        </div>
                      </div> -->

                      <div id = "divToggleBtn" class="togglebutton" hidden>
                            <label>
                                <input type= "checkbox" name = "NewPriceCheckBox" id = "NewPriceCheckBox">
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
                      <div class = "row">
                            <div class="input-group">
                              <label class = 'control-label'>Total Amount: </label>
                              <input type="text" class="form-control" name="total_Amt" id="total_Amt"  placeholder="" disabled style = "margin-top:-20%;"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <div class="btn-group" role="group" aria-label="group button">
                        <div class="btn-group" role="group">
                           <button type = "Submit" name = "AddFlowerBtn" id = "AddFlowerBtn" class = "btn btn-simple btn-success">Add Flower <span class = "glyphicon glyphicon-arrow-right"></span></button>
                        </div>
                      </div>
                    </div>
            {!! Form::close() !!}
                  </div><!--end of class FLower_ListDiv-->

        <!--Start of Adding Acessory div-->
                  <div id = 'Acessory_ListDiv' class = "row" hidden>
                  {!! Form::open(array('route' => 'OrdersAcSession_Bouquet.store', 'data-parsley-validate'=>'', 'files' => 'true', 'method'=>'POST')) !!}
                    <div class = "col-md-7">
                    <h5 style = "margin-left:2%;"><b>Add acessories to your Bouquet</b></h5>
                      <select id = 'AcessoryList' name = 'AcessoryList' class = 'btn btn-primary btn-md'>
                        <option value = "-1" disabled selected = ''>Please Choose 1 Acessory</option>
                        @foreach($accessories as $accessories)
                          <option value = "{{$accessories->ACC_ID}}" data-tag = "{{$accessories->price}}" > ACRS_{{$accessories->ACC_ID}} - ({{$accessories->name}}) </option>
                        @endforeach
                       </select>
                         <img src= "" id="AcessoryimageBox" name="AcessoryimageBox" class = "img-rounded img-raised img-responsive" style="max-width: 300px; max-height: 300px;" />
                    </div>
                    <div hidden>
                      <select id = 'Acessoryname_List' name = 'Acessoryname_List' class = 'btn btn-primary btn-md'>
                        @foreach($accessories2 as $acRow)
                          <option value = "{{$acRow->name}}" data-tag = "{{$acRow->ACC_ID}}" > {{$acRow->image}}</option>
                        @endforeach
                        </select>

                        <select id = 'AcessoryPic_List' name = 'AcessoryPic_List' class = 'btn btn-primary btn-md'>
                        @foreach($accessories3 as $acRow2)
                          <option value = "{{$acRow2->image}}" data-tag = "{{$acRow2->ACC_ID}}" > {{$acRow2->name}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class = 'col-md-4'>
                      <div>
                         <div class="input-group">
                          <label class = 'control-label'>Original Price:</label>
                          <input type="text" class="form-control" name="AcessoryViewPrice_Field" id="AcessoryViewPrice_Field"  placeholder="" disabled style = "margin-top:-20%;"/>
                        </div>
                        <div hidden> <!--start of hidden input field-->
                          <input type="number" class="form-control" name="AcessoryOrigInputPrice_Field" id="AcessoryOrigInputPrice_Field" step = '0.01'/>


                          <label>The decision</label>
                          <input type="text" class="form-control" name="AcessoryDecision_Field" id="AcessoryDecision_Field" value = 'O'/>
                        </div>      <!--end of hidden input field-->
                      </div>

                      <!--<div id = 'agreement_Div' hidden>
                         <div class="input-group">
                         <label>Agreement Price:</label>
                          <input type="number" class="form-control" name="AgreementPrice_Field" id="AgreementPrice_Field"  placeholder="" disabled/>
                        </div>
                      </div> -->

                      <div id = "divToggleBtnforAcessories" class="togglebutton" hidden>
                            <label>
                                <input type="checkbox" name = "NewAcessoryPriceCheckBox" id = "NewAcessoryPriceCheckBox">
                                New Price?
                            </label>
                      </div>

                       <div id = 'NewPrice_DivforAcessories' hidden>
                         <div class="form-group label-floating">
                          <label class = 'control-label'>New Price:</label>
                          <input type="number" class="form-control" name="AcessoryNewPrice_Field" id="AcessoryNewPrice_Field" value = '1.00' step = "0.01"/>
                         </div>
                       </div>

                      <div id = 'QTY_Div'>
                         <div class="form-group label-floating">
                          <label class = 'control-label'>Quantity:</label>
                          <input type="number" class="form-control" name="AcessoryQTY_Field" id="AcessoryQTY_Field" placeholder="" min = '1' required/>
                        </div>
                      </div>

                      <div class = "row">
                            <div class="input-group">
                              <label class = 'control-label'>Total Amount: </label>
                              <input type="text" class="form-control" name="Acessorytotal_Amt" id="Acessorytotal_Amt"  placeholder="" disabled style = "margin-top:-20%;"/>
                            </div>
                        </div>
                      </div>

                    <div class="modal-footer">
                      <div class="btn-group" role="group" aria-label="group button">
                        <div class="btn-group" role="group">
                           <button type = "Submit" name = "AddAcessoryBtn" id = "AddAcessoryBtn" class = "btn btn-simple btn-success">Add Acessory <span class = "glyphicon glyphicon-arrow-right"></span></button>
                        </div>
                      </div>
                    </div>
            {!! Form::close() !!}
                  </div><!--end of class Acessory_ListDiv-->
                </div><!--end of class row-->
              </div><!--end of class panel body-->
            </div><!--end of class panel primary-->
          </div><!--end of class contaner-->
        </div><!-- end of left panel-->

        <div class="col-md-6" style = "margin-left: -2%; margin-top:1%;">
          <div class="panel">
                <div class="panel panel-info">
                  <div class="panel-heading">
                    <div class="panel-title">
                      <div class="row">
                        <div class="col-xs-6">
                          <h5><span class="glyphicon glyphicon-gift"></span> Bouquet Items</h5>
                        </div>
                          <div class="checkbox">
                            <label style = "color:white;">
                              <input type="checkbox" name="viewoptionsCheckboxes" id = "ViewFlowers_CheckBox">
                              View Flowers
                            </label>
                            <label style = "color:white;">
                              <input type="checkbox" name="viewoptionsCheckboxes" id = "ViewAcessories_CheckBox">
                              View Accessories
                            </label>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="panel-body">
                    <div id = "flowersCart_Div" hidden>

                  @foreach(Cart::instance('OrderedBqt_Flowers')->content() as $BQT_Flowers)
        {!! Form::model($BQT_Flowers, ['route'=>['OrdersSession_Bouquet.update', $BQT_Flowers->id],'method'=>'PUT'])!!}
                    <div class="row">
                      <div class="col-xs-1"><img class="img-rounded img-raised img-responsive" style="min-width: 50px; max-height: 50px;" src="{{ asset('flowerimage/'.$BQT_Flowers->options['image'])}}">
                      </div>
                      <div class="col-xs-3">
                        <h6 class="product-name"><strong>{{$BQT_Flowers->name}}</strong></h6>
                      </div>
                      <div class="col-xs-8">
                        <div class="col-xs-4" style = "color:red; margin-top:3%;">
                          <h7>Php {{number_format($BQT_Flowers->price,2)}}   <span class="text-muted"> x</span></h7>
                        </div>
                        <div class="col-md-2" style = "margin-top:-3%; margin-left:-10%;">
                          <input id = 'QuantityField' name = 'QuantityField' type="number" class="form-control input-sm" value="{{$BQT_Flowers->qty}}">
                        </div>
                        <div class="col-md-2"  hidden>

                          <input id = 'Decision_Field' name = 'Decision_Field' class="form-control input-sm" value="{{$BQT_Flowers->options['priceType']}}">
                        </div>
                        <div class="col-xs-4" style = "color:red; margin-top:3%;">
                          <h7><b>=</b> Php {{number_format($BQT_Flowers->price * $BQT_Flowers->qty,2)}}</h7>
                        </div>
                        <div class="col-xs-1" style = "margin-right:3%;">
                          <button type="submit" class="btn btn-primary btn-xs">
                            <span class="glyphicon glyphicon-edit"> </span>
                          </button>
                        </div>
        {!! Form::close() !!}
                        <div class="col-xs-1">
                          <a type="button" href="{{ route('BqtFlowerorderSessions.DelOrderFlowers',['flower_ID'=>$BQT_Flowers->id]) }}" class="btn btn-danger btn-xs">
                            <span class = "glyphicon glyphicon-trash"></span>
                          </a>
                        </div>
                      </div>
                    </div>
                    <hr>
                  @endforeach

                    </div><!--End of flowers in cart Div-->
                    <div class="col-xs-12">
                        <h5 class="text-right"><strong>(Flowers)Total Amount:</strong> Php {{Cart::instance('OrderedBqt_Flowers')->subtotal()}}</h4>
                    </div>
<hr>
                    <div id = "AcessoriesCart_Div" hidden>
                @foreach(Cart::instance('OrderedBqt_Acessories')->content() as $BQT_Acessories)

        {!! Form::model($BQT_Acessories, ['route'=>['OrdersAcSession_Bouquet.update', $BQT_Acessories->id],'method'=>'PUT'])!!}
<!--Form open here for update-->
                    <div class="row">
                      <div class="col-xs-1"><img class="img-rounded img-raised img-responsive" style="min-width: 50px; max-height: 50px;" src="{{ asset('accimage/'.$BQT_Acessories->options['image'])}}">
                      </div>
                      <div class="col-xs-3">
                        <h6 class="product-name"><strong>{{$BQT_Acessories->name}}</strong></h6>
                      </div>
                      <div class="col-xs-8">
                        <div class="col-xs-4" style = "color:red; margin-top:3%;">
                          <h7>Php {{number_format($BQT_Acessories->price,2)}}   <span class="text-muted"> x</span></h7>
                        </div>
                        <div class="col-md-2" style = "margin-top:-3%; margin-left:-10%;">
                          <input id = 'AcQuantityField' name = 'AcQuantityField' type="number" class="form-control input-sm" value="{{$BQT_Acessories->qty}}">
                        </div>
                        <div class="col-md-2"  hidden>
                          <input id = 'Ac_ID_Field' name = 'Ac_ID_Field' class="form-control input-sm" value="{{$BQT_Acessories->id}}">
                          <input id = 'Decision_Field' name = 'Decision_Field' class="form-control input-sm" value="{{$BQT_Acessories->options['priceType']}}">
                        </div>
                        <div class="col-xs-4" style = "color:red; margin-top:3%;">
                          <h7><b>=</b> Php {{number_format($BQT_Acessories->price * $BQT_Acessories->qty,2)}}</h7>
                        </div>
                        <div class="col-xs-1" style = "margin-right:3%;">
                          <button type="submit" class="btn btn-primary btn-xs">
                            <span class="glyphicon glyphicon-edit"> </span>
                          </button>
                        </div>
        {!! Form::close() !!}
<!--form close here for update-->
                        <div class="col-xs-1">
                          <a id = 'deleteAc_Btn' type="button" href="{{ route('Sessionorder.DelAcessories',['Acessory_ID'=>$BQT_Acessories->id]) }}" class="btn btn-danger btn-xs">
                            <span class = "glyphicon glyphicon-trash"></span>
                          </a>
                        </div>
                      </div>
                    </div>
                    <hr>
                  @endforeach
                    </div><!--End of Acessories in cart Div-->
                      <div class="col-xs-12">
                        <h5 class="text-right"><strong>(Acessoriess)Total Amount:</strong> Php {{Cart::instance('OrderedBqt_Acessories')->subtotal()}}</h5>
                      </div>
                  </div>
                  <div class="panel-footer">
                    <div class="row text-center">
                      <div class="col-xs-9">
                      <?php
                          $Flowers_subtotal = str_replace(array(','), array(''), Cart::instance('OrderedBqt_Flowers')->subtotal());
                          $Acessories_subtotal = str_replace(array(','), array(''), Cart::instance('OrderedBqt_Acessories')->subtotal());
                        ?>
                        <h4 class="text-left"><strong>Total Amount of Bouquet: </strong> Php {{number_format($Flowers_subtotal + $Acessories_subtotal,2)}}</h4>
                      </div>

                      <div class="col-xs-3" style = "margin-left:-10%;">
                        <a id = "saveBtn" type="button" href = "{{route('Bqtorder.saveNewBouquet')}}" class="btn btn-info btn-md"  data-toggle="tooltip" data-placement="bottom" title="This Button will save the bouquet that you have created, also please be noted that if your flowers are less than 12 this button will not submit your Bouquet" data-container="body">
                          Add to my Order
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </div><!--end of col-->
</div>
@endsection


@section('scripts')

<script>
/**/
 $(document).ready(function(){

  if($('#transtypefield').val() == 'quick'){

      $('#availableQTYDIV').prop('hidden',false);

      $('#FlowerList2 option').each(function(item){
        var element = $(this);
          console.log('element = '+element.data('tag'));
        $('#FlowerList option').each(function(item){
          var element2 = $(this);
          console.log('element = '+element.data('tag'));
          console.log('element2 = '+element2.val());
          if(element2.val() == element.data('tag')){
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


  if($('#DeleteAcessory_result').val()=='Successful'){
    //Show popup
    swal("Good!","Acessory has been removed!","success");
   }


  if($('#DeleteFlower_result').val()=='Successful'){
    //Show popup
    swal("Good!","Flower has been removed!","success");
   }


  if($('#UpdateFlower_result').val()=='Successful'){
    //Show popup
    swal("Good!","Flower's quantity has been updated!","success");
   }

  if($('#UpdateAcessory_result').val()=='Successful'){
    //Show popup
    swal("Good!","Acessory's quantity has been updated!","success");
   }

   if($('#AddFlower_result').val()=='Successful'){
    //Show popup
    swal("Good!","Flower has been successfully added to Bouquet!","success");
   }

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
