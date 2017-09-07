@extends('main')


@section('content')


	<section class="content">
	<div style="margin-top: 20px;">
			<div class="panel panel-primary">
					  <div class="panel-heading" style="background-color: #26A69A">
			            <h3 class="panel-title">Update Acessories Details</h3>
			          </div>

            {!! Form::model($acc,['route'=>['acc.update', $acc->ACC_ID],'method'=>'PUT'])!!} 
            		<br>
		              <div  Style = "margin-left: 32%;">
		                <img src= "{{ asset('accimage/'.$acc -> image)}}" id="imageBox" name="imageBox" style="max-width: 450px; max-height: 450px;" />
		                <div>
                      	 	<label for = 'flowerimg'>Accessories Image: </label>
                    	 	<div class="input-group">
                      	 	<input class ="uploader" type="file" accept="image/*" name = "Accimg" id = "Accimg" onchange="preview_image(event)" style = "margin-top: 2%;">
		             	 	</div>
		                </div>
                      </div>
                      
		              <div hidden>
		              	<input id = "imageName"  name = "imageName" value = "{{$acc -> image}}">
		              </div>
	                    <div class = "row" style = "margin-left: 5%;">
	                      <div class = "col-md-5">
                            <div class="form-group label-floating">
                              <label class="control-label">Acessories' Name</label>
                              <input type="text" class="form-control" value = "{{$acc->name}}" name="Acname" id="Acname" maxlength = '50' required>
                            </div>
	                      </div>
	                      <div class="col-md-3" >
                            <div class="form-group label-floating">
                              <label class="control-label">Price</label>
                              <input type="number" class="form-control" value = "{{number_format($acc->price,2)}}" name="Price" id="Price" min = "0.00" step = '0.01' required>
                            </div>
	                      </div>
	                      <div class="col-md-3" >
	                          <div class="form-group label-floating">
		                        <label class="control-label">Quantity Onhand:</label>
		                        <input type="text" class="form-control" value = "{{$acc->qty}}" name="QtyOnHand" id="QtyOnHand" disabled required>
		                     </div>
	                     </div>
	                   </div>

	                     <div class = "row control-label" style="color: #C93756; margin-left: 7%;">
		                     <div class = "col-md-3">
		                    	<span class="label" style="font-size: 100%; "><input id = "UpdateCheckbox" name = "UpdateCheckbox" type = "checkbox"/>Want to update the Qty?</span> 	
		                     </div>
	                     </div>
						
						<br>
	                     <div class="modal-footer" id = "editFooterdiv">
	                      <div class="btn-group" role="group" aria-label="group button">
	                        <div class="btn-group" role="group">
	                        <a type = "button" href="{{ route('acc.index') }}" class = "btn btn-danger btn-simple" > 
                            Return to Acessories' List
                      		</a>
	                        </div>
	                        <div class="btn-group" role="group">
	                           <button type = "submit" name = "UpdtBtn" id = "UpdtBtn" class = "btn btn-success btn-simple"><span class = "glyphicon glyphicon-floppy-save"></span> Update Item</button>
	                        </div>
	                      </div>
	                    </div>
				{!! Form::close() !!}

					<div id = "QTY_Update_Div" hidden>
			         {!! Form::model($acc, ['route'=>['Acessory_ADD_Qty.update', $acc->ACC_ID],'method'=>'PUT','data-parsley-validate' => ''])!!} 
							<hr>
	                		<span class="label" style="margin-left: 8.2%; font-size: 100%; ">Add quantity to this item</span>

							 <div class = "row" style = "margin-left: 10%;">
		                      <div class = "col-md-2">
	                            <div class="form-group label-floating">
	                              <label class="control-label">Quantity Onhand:</label>
	                              <input type="text" class="form-control" value = "{{$acc->qty}}" name="QtyOnHand" id="QtyOnHand" disabled required>
	                            </div>
		                      </div>

		                      <div class="col-md-3" >
	                            <div class="form-group label-floating">
	                              <label class="control-label">Additional Quantity:</label>
	                              <input type="number" class="form-control" name="AdditionalQTY" id="AdditionalQTY" min = "1" step = '1' required>
	                            </div>
		                      </div>
		                      <div class = "col-md-3">
		                      	<br>
		                     		<button type="submit" name = "AddQtyBtn" id = "AddQtyBtn" class="btn btn-default btn-sm" style="background-color: darkviolet;"  role="button">Add Qty <i class="material-icons">add_circle_outline</i></button>
		                     </div>
		                     </div><!--end of row-->
				       {!! Form::close() !!}		                   	 
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