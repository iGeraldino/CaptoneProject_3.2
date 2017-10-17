@extends('main')


@section('content')
<?php
     $UpdtSessionValue = Session::get('Update_FlowerfromSession_Supply');
     Session::remove('Update_FlowerfromSession_Supply');//determines the Addition of requested flowers
?>

<div hidden>
    <input id = "UpdateFlower_result" value = "{{$UpdtSessionValue}}">
</div>
	<section class="content">
	<div class="" style="margin-top: 2%;">
			<div class="panel panel-primary">
			  	<div class="panel-heading Subu">
	            	<h3 class="panel-title">Update Flower quantity</h3>
	          	</div>
            <br>
          <div  Style = "margin-left: 32%;">

          </div>

		              <div hidden>
		              	<input id = "imageName"  name = "imageName" value = "">
		              </div>

	                    <div class = "row" style = "margin-left: 5%;">
	                      <div class = "col-md-5">
                            <div class="form-group label-floating">
                             <img src= "{{ asset('flowerimage/'.$flower->options['image'])}}" id="imageBox" name="imageBox" class = "img-rounded img-raised img-responsive" style="max-width: 300px; max-height: 300px;" />
                            </div>
	                      </div>
	                      <br>
	                      <br>
	                      <br>
	                      <div class="col-md-3" >
	                         <div class="form-group label-floating">
    	                          <label class="control-label">Flower Name</label>
	                              <input type="text" class="form-control" value = "{{$flower->name}}" name="Flowername" id="Flowername" maxlength = '50' required disabled>
                             </div>

	                          <div class="form-group label-floating">
		                        <label class="control-label">Current Quantity:</label>
		                        <input type="text" class="form-control" value = " {{$flower->qty}} pcs." name="Qty" id="Qty" disabled required>
		                     </div>

	                      </div>

	                   </div>

	                     <div class = "row control-label" style="color: #C93756; margin-left: 7%;">
		                     <div class = "col-md-3">
		                    	<span class="label Inbox" style="font-size: 100%;"><input id = "UpdateCheckbox" name = "UpdateCheckbox" type = "checkbox"/>Want to update the Qty?</span>
		                     </div>
		                     <div class = "col-md-1"></div>
		                     <div class = "col-md-7">
		                     	<div id = "QTY_Update_Div" hidden>
		                     	<!--form open here-->
                     		{!! Form::model($flower, ['route'=>['InventoryScheduling_Flowers.update', $flower->id],'method'=>'PUT','data-parsley-validate' => ''])!!}
	                					<span class="label Inbox" style="margin-left: 5%; font-size: 100%;">Enter NEW QTY FOR THIS ITEM</span>

											<div class = "row" style = "margin-left: 5%;">

		                      					<div class="col-md-3" >
	                           						 <div class="form-group label-floating">
	                             						 <label class="control-label">New Quantity:</label>
	                             							 <input type="number" class="form-control" name="NewQTY" id="NewQTY" min = "1" step = '1' value = "{{$flower->qty}}" required>
	                            					 </div>
		                      					</div>
		                      					<div class = "col-md-3">
		                      						<br>
		                     						<button type="submit" name = "updateQtyBtn" id = "updateQtyBtn" class="btn btn-default btn-sm" style="background-color: darkviolet;"  role="button">Update Qty</button>
		                     					</div>
		                     				</div><!--end of row-->
		                    {!! Form::close() !!}
				       				<!--form close here-->
							    </div>
							 <div id = "editFooterdiv" >
	                        <div class="btn-group" role="group">
	                        <a type = "button" href="{{ route ('Inventory.ScheduleArrival') }}" class = "btn btn-default btn-default" >
                            Return to Bouquet's Contents
                      		</a>
	                        </div>
	                      </div>
		                   </div>
	                     </div>
						<br>

			</div>
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

 	if($('#UpdateFlower_result').val()=='Successful'){
             //Show popup
      swal("Take Note","Expected quantity of flower to be recieved has been successfully updated!","info");
    }


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
