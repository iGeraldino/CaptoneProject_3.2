@extends('main')


@section('content')


	<section class="content">
	<div class="container" style="margin-top: 50px;">
			<div class="panel panel-primary">
					  <div class="panel-heading" style="background-color: #C93756">
			            <h3 class="panel-title">Update Acessories Details</h3>
			          </div>
<?php
	$Flower_SellingPrice = 0;
  $updateQTYsessionValue = Session::get('update_O_FlowerQuickQty_Session');
  Session::remove('update_O_FlowerQuickQty_Session');//determines the addition of new flower
?>

			@foreach($flower_Det as $orderFlower)
				<?php
					 $flower_ID = $orderFlower->flower_ID;
						$OFlower_ID = '';
						$OFlower_name = '';
						$OFlower_qty = '';
						$OFlower_price = '';
						$OFlower_orig_price = '';
						$OFlower_image = '';
						$OFlower_decision = '';
						$OFlower_Tamt = '';

						foreach(Cart::instance('QuickOrdered_Flowers')->content() as $row){
							if($row->id == $batchDetails[1] AND $row->options->batchID == $batchDetails[0]){
								$OFlower_ID = $row->id;
								$OFlower_name = $row->name;
								$OFlower_qty = $row->qty;
								$OFlower_price = $row->price;
								$OFlower_orig_price = $row->options['orig_price'];
								$OFlower_new_price = $row->options['NewPrice'];
								$OFlower_image = $row->options['image'];
								$OFlower_decision = $row->options['priceType'];
								$OFlower_Tamt = $row->options['T_Amt'];
								$OFlower_batchID = $row->options['batchID'];
							}
						}//end of foreach;
				?>

            		<br>
		              <div  Style = "margin-left: 32%;">

                      </div>

		              <div hidden>
		              	<input id = "imageName"  name = "imageName" value = "{{$orderFlower->IMG}}">
                    <input id="UpdateQtyFlower_order_result" value = "{{$updateQTYsessionValue}}">
		              </div>

	                    <div class = "row" style = "margin-left: 5%;">
	                      <div class = "col-md-5">
                            <div class="form-group label-floating">
                             <img src= "{{ asset('flowerimage/'. $orderFlower->IMG)}}" id="imageBox" name="imageBox" class = "img-rounded img-raised img-responsive" style="max-width: 300px; max-height: 300px;" />
                            </div>
	                      </div>
	                      <div class="col-md-3" >


	                         <div class="form-group label-floating">
    	                          <label class="control-label">Flower Name</label>
	                              <input type="text" class="form-control" value = "(Batch-{{$OFlower_batchID}}) {{$orderFlower->flower_name}}" name="Flowername" id="Flowername" maxlength = '50' required disabled>
                             </div>

                             <div class="form-group label-floating">
                              <label class="control-label">Price Sold:</label>
                              <input type="text" class="form-control" value = "Php {{$OFlower_price}}" name="unit_Price" id="unit_Price" disabled>
                             </div>

	                        <div class="form-group label-floating">
		                        <label class="control-label">Quantity:</label>
		                        <input type="text" class="form-control" value = "{{$OFlower_qty}} pcs." name="Qty" id="Qty" disabled required>
		                       </div>

	                         <div class="form-group label-floating">
                              <label class="control-label">Total Amount</label>
                              <input type="text" class="form-control" value = "Php {{number_format($OFlower_price * $OFlower_qty,2)}}" name="TAmount" id="TAmount" disabled>
                            </div>

														<div class="form-group label-floating">
															 <label class="control-label">Available Quantity</label>
															 <input type="text" class="form-control" value = "{{$batchDetails[3]}} pcs" name="AvailableQTy" id="AvailableQTy" disabled>
														 </div>


	                      </div>

	                      <div class ="col-md-3" id = 'Update_Div' hidden><!--hidden-->
<!--form open here-->
{!! Form::model($OFlower_ID, ['route'=>['QuickOrders_Flowers.update', $OFlower_ID],'method'=>'PUT'])!!}
                            <div>
                              <div class="form-group label-floating">
                             	<label class="control-label">Original Price</label>
                              	 <input type="text" class="form-control" name="ViewPrice_Field" id="ViewPrice_Field"  value = "Php {{number_format($batchDetails[4],2)}}" disabled/>
                             </div>

                              <div hidden> <!--start of hidden input field-->
                                <input type="number" class="form-control" name="OrigInputPrice_Field" id="OrigInputPrice_Field" step = '0.01' value = "{{$batchDetails[4]}}"/>

                                <label>The decision</label>
                                <input type="text" class="form-control" name="Decision_Field" id="Decision_Field" value = 'O'/>

                                <label>The WholesaleQTY</label>
                                <input type="text" class="form-control" name="WholesaleQTY_Field" id="WholesaleQTY_Field" value = '{{$orderFlower->QTY_Wholesale}}'/>

                                <label>The Decrease</label>
                                <input type="text" class="form-control" name="Decrease_Field" id="Decrease_Field" value = '{{$orderFlower->Decrease}}'/>
                              </div>      <!--end of hidden input field-->
                            </div>

                            <div id = "divToggleBtn" class="togglebutton">
                                  <label>
                                      <input type="checkbox" name = "NewPriceCheckBox" id = "NewPriceCheckBox">
                                      New Price?
                                  </label>
                            </div>


                             <div id = 'NewPrice_Div' hidden>
                               <div class="form-group label-floating">
                                <label class = 'control-label'>New Price:</label>
                                <input type="number" class="form-control" name="NewPrice_Field" id="NewPrice_Field"
                                 value = '{{$orderFlower->Final_SellingPrice}}' step = "0.01"/>
                               </div>
                             </div>

                             <div id = 'QTY_Div'>
                               <div class="form-group label-floating">
                                <label class = 'control-label'>Quantity:</label>
                                <input type="number" class="form-control" name="QTY_Field" id="QTY_Field"  placeholder="" min = '1' required/>
                              </div><!--end of form-group -->
                             </div><!--end of QTY_DIV-->

                            <div class="input-group">
                              <label class = 'control-label'>Total Amount: </label>
                              <input type="text" class="form-control" name="total_Amt" id="total_Amt"  placeholder="" disabled/>
                            </div>

				       		<div class = "btn-group">
				       			<button type="submit" name = "AddQtyBtn" id = "AddQtyBtn" class="btn btn-default btn-sm" style="background-color: darkviolet;"  role="button">Update Order</button>
				       		</div>
       		        {!! Form::close() !!}
<!--form close here-->
                           </div><!--end of column-->

                          </div>

                         <div class = "row control-label" style="color: #C93756; margin-left: 7%;">
		                     <div class = "col-md-3">
		                    	<span class="label" style="font-size: 100%; background-color: #F62459"><input id = "UpdateCheckbox" name = "UpdateCheckbox" type = "checkbox"/>Want to update the details?</span>
		                     </div>
		                     <div class = "col-md-1"></div>
		                     <div class = "col-md-7">
								<div id = "editFooterdiv" >
		                       		<div class="btn-group" role="group">
		                       			<a type = "button" href="{{route('Quick_Sales_Order.index')}}" class = "btn btn-default btn-default" >
	                            			Return to Creation of Order
	                      				</a>
		                       		</div>
		                      	</div>
		                   	</div>
	                    </div>
	                   </div><!--end of panel-->

	                </div>
					<br>
			</div>
			@endforeach
		</div>
	</section>
@endsection
@section('scripts')
<script language="javascript">

</script>

<script>
 $(document).ready(function(){


   if($('#UpdateQtyFlower_order_result').val()=='Successful'){
    //Show popup
    swal("Good!","Ordered quantity has been successfully updated!","success");
	}else if($('#UpdateQtyFlower_order_result').val()=='Fail2'){
	     //Show popup
			 swal("The quantity requested was greater than the available quantity!","The quantity that you entered has exceeded the available flowers in the inventory. Therefore, no changes has been made!","warning");
	}else if($('#UpdateQtyFlower_order_result').val()=='Fail3'){
	     //Show popup
			 swal("Cannot add flower to order!","The request exceeded the available flowers in the inventory, you cannot add the flower that your requested in your order. This is for the reason that the inventory cannot sustain it anymore!","error");
	}

    $('#UpdateCheckbox').click(function(){
    	//console.log('pasok');
      if($('#UpdateCheckbox').is(":checked")){
	    $('#Update_Div').slideDown();
      }
      else{
      	$('#Update_Div').slideUp();
      }

    });//end of function

    	   $('#QTY_Field').change(function(){
           var NewTAmt =  $('#OrigInputPrice_Field').val() * $("#QTY_Field").val();
           var FinalTAmt = 'Php '+ NewTAmt;
           $('#total_Amt').val(FinalTAmt);
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
        });
        //end of function
 });
   function preview_image(event)
  {
   var reader = new FileReader();
   reader.onload = function()
   {
    var output = document.getElementById('imageBox');
    output.src = reader.result;
   }
   reader.readAsDataURL(event.target.files[0]);
  }
</script>

@endsection
