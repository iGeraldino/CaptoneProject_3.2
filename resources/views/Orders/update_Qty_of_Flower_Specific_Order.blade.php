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


?>

			@foreach($flower_Det as $orderFlower)
				<?php
					$Order_ID = $orderFlower->Qtn_ID;
					$flower_ID = $orderFlower->Flower_ID;

					$Joined_ID = $Order_ID.'_'.$flower_ID;
				?>

            		<br>
		              <div  Style = "margin-left: 32%;">

                      </div>

		              <div hidden>
		              	<input id = "imageName"  name = "imageName" value = "{{$orderFlower->Img}}">
		              </div>

	                    <div class = "row" style = "margin-left: 5%;">
	                      <div class = "col-md-5">
                            <div class="form-group label-floating">
                             <img src= "{{ asset('flowerimage/'. $orderFlower->Img)}}" id="imageBox" name="imageBox" class = "img-rounded img-raised img-responsive" style="max-width: 300px; max-height: 300px;" />
                            </div>
	                      </div>
	                      <div class="col-md-3" >
	                         <div class="form-group label-floating">
    	                          <label class="control-label">Flower Name</label>

                                <input type="text" class="form-control" value = "{{$orderFlower->Flower_Name}}" name="Flowername" id="Flowername" maxlength = '50' required>
                             </div>

                             <div class="form-group label-floating">
                              <label class="control-label">Price</label>
                              <input type="text" class="form-control" value = "Php {{$orderFlower->unit_price}}" name="unit_Price" id="unit_Price" disabled>
                             </div>

	                          <div class="form-group label-floating">
		                        <label class="control-label">Quantity:</label>
		                        <input type="text" class="form-control" value = "{{$orderFlower->QTY}} pcs." name="Qty" id="Qty" disabled required>
		                     </div>

	                         <div class="form-group label-floating">
                              <label class="control-label">Total Amount</label>
                              <input type="text" class="form-control" value = "Php {{$orderFlower->Amt}}" name="TAmount" id="TAmount" disabled>
                             </div>
	                      </div>

	                      <div class ="col-md-3" id = 'Update_Div' hidden><!--hidden-->
	               {!! Form::model($orderFlower, ['route'=>['Sales_Order.update', $Joined_ID],'method'=>'PUT','data-parsley-validate' => ''])!!}
                            <div>
                              <div class="form-group label-floating">
                             	<label class="control-label">Original Price</label>
                              	 <input type="text" class="form-control" name="ViewPrice_Field" id="ViewPrice_Field"  value = "Php {{number_format($orderFlower->Original_Final_SellingPrice,2)}}" disabled/>
                             </div>

                              <div hidden> <!--start of hidden input field-->
                                <input type="number" class="form-control" name="OrigInputPrice_Field" id="OrigInputPrice_Field" step = '0.01' value = "{{$orderFlower->Original_Final_SellingPrice}}"/>

                                <input type="text" class="form-control" name="orderID_Field" id="orderID_Field" value = "{{ $Order_ID }}"/>

                                <label>The decision</label>
                                <input type="text" class="form-control" name="Decision_Field" id="Decision_Field" value = 'O'/>

                                <label>The WholesaleQTY</label>
                                <input type="text" class="form-control" name="WholesaleQTY_Field" id="WholesaleQTY_Field" value = '{{$orderFlower->WSale_QTY}}'/>

                                <label>The Decrease</label>
                                <input type="text" class="form-control" name="Decrease_Field" id="Decrease_Field" value = '{{$orderFlower->Percent_decrease}}'/>
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
                                 value = '{{$orderFlower->unit_price}}' step = "0.01"/>
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
		                       			<a type = "button" href="{{ route ('Sales_Qoutation.show', $Order_ID ) }}" class = "btn btn-default btn-default" >
	                            			Return to Bouquet's Contents
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
            populateCountries("country", "state");
            populateCountries("country2");
</script>

<script>
 $(document).ready(function(){

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
        //end of functionx





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
