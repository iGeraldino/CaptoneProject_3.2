@extends('main')


@section('content')


	<section class="content">
	<div class="container" style="margin-top: 50px;">
			<div class="panel panel-primary">
					  <div class="panel-heading" style="background-color: #C93756">
			            <h3 class="panel-title">Update Acessories Details</h3>
			          </div>
			@foreach($FlowersDetails as $FlowersDetails)
				<?php 
					$bqt_ID = $FlowersDetails->Bouquet_ID;
					$flower_ID = $FlowersDetails->flower_ID;

					$Joined_ID = $bqt_ID.'_'.$flower_ID;
				?>

            		<br>
		              <div  Style = "margin-left: 32%;">

                      </div>
                      
		              <div hidden>
		              	<input id = "imageName"  name = "imageName" value = "{{$FlowersDetails->IMG}}">
		              </div>
	                  
	                    <div class = "row" style = "margin-left: 5%;">
	                      <div class = "col-md-5">
                            <div class="form-group label-floating">
                              <input type="text" class="form-control" value = "" name="Flowername" id="Flowername" maxlength = '50' required>
                             <img src= "{{ asset('flowerimage/'. $FlowersDetails->IMG)}}" id="imageBox" name="imageBox" class = "img-rounded img-raised img-responsive" style="max-width: 300px; max-height: 300px;" />
                            </div>
	                      </div>
	                      <div class="col-md-3" >
	                         <div class="form-group label-floating">
    	                          <label class="control-label">Flower Name</label>
	                              <input type="text" class="form-control" value = "{{$FlowersDetails->flower_name}}" name="Flowername" id="Flowername" maxlength = '50' required>
                             </div>
                            
                             <div class="form-group label-floating">
                              <label class="control-label">Price</label>
                              <input type="text" class="form-control" value = "Php {{$FlowersDetails->Final_SellingPrice}}" name="Price" id="Price" min = "0.00" step = '0.01' disabled>
                             </div>
                             
	                          <div class="form-group label-floating">
		                        <label class="control-label">Quantity:</label>
		                        <input type="text" class="form-control" value = "{{$FlowersDetails->QTY}} pcs." name="Qty" id="Qty" disabled required>
		                     </div>
	                         
	                         <div class="form-group label-floating">
                              <label class="control-label">Total Amount</label>
                              <input type="text" class="form-control" value = "Php {{$FlowersDetails->Total_Amount}}" name="TAmount" id="TAmount" disabled>
                             </div>
	                      </div>
	                      
	                   </div>

	                     <div class = "row control-label" style="color: #C93756; margin-left: 7%;">
		                     <div class = "col-md-3">
		                    	<span class="label" style="font-size: 100%; background-color: #F62459"><input id = "UpdateCheckbox" name = "UpdateCheckbox" type = "checkbox"/>Want to update the Qty?</span> 	
		                     </div>
		                     <div class = "col-md-1"></div>
		                     <div class = "col-md-7">
		                     	<div id = "QTY_Update_Div" hidden>
			       					  {!! Form::model($FlowersDetails, ['route'=>['bouqAddFlower.update', $Joined_ID],'method'=>'PUT','data-parsley-validate' => ''])!!} 
	                					<span class="label" style="margin-left: 5%; font-size: 100%; background-color: darkviolet">Add quantity to this item</span>

											<div class = "row" style = "margin-left: 5%;">

		                      					<div class="col-md-3" >
	                           						 <div class="form-group label-floating">
	                             						 <label class="control-label">New Quantity:</label>
	                             							 <input type="number" class="form-control" name="NewQTY" id="NewQTY" min = "1" step = '1' value = "{{ $FlowersDetails->QTY}}" required>
	                            					 </div>
		                      					</div>
		                      					<div class = "col-md-3">
		                      						<br>
		                     						<button type="submit" name = "AddQtyBtn" id = "AddQtyBtn" class="btn btn-default btn-sm" style="background-color: darkviolet;"  role="button">Update Qty</button>
		                     					</div>
		                     				</div><!--end of row-->
				       				{!! Form::close() !!}		                   	 
							    </div>
							 <div id = "editFooterdiv" >
	                        <div class="btn-group" role="group">
	                        <a type = "button" href="{{ route ('bouqAddFlower.show', $FlowersDetails->Bouquet_ID ) }}" class = "btn btn-default btn-default" > 
                            Return to Bouquet's Contents
                      		</a>
	                        </div>
	                      </div>
		                   </div>
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
      	$('#editFooterdiv').slideUp();
	    $('#QTY_Update_Div').slideDown();	
      }
      else{
      	$('#editFooterdiv').slideDown();
      	$('#QTY_Update_Div').slideUp();
      }
      
    });//end of function

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