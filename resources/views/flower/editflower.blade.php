@extends('main')


@section('content')


	<section class="content">
	<div class="container" style="margin-top: 50px;">
			<div class="panel panel-primary">
					  <div class="panel-heading" style="background-color: #C93756">
			            <h3 class="panel-title">Update Acessories Details</h3>
			          </div>
            		<br>
			         {!! Form::model($flower, ['route'=>['floweradd.update', $flower->flower_ID],'method'=>'PUT','data-parsley-validate'=>''])!!} 
		              <div hidden>
		              	<input id = "imageName"  name = "imageName" value = "{{$flower->Image}}">
		              </div>
	                  
	                    <div class = "row" style = "margin-left: 5%;">
	                      <div class = "col-md-5">
                            <div class="form-group label-floating">
                             <img src= "{{ asset('flowerimage/'. $flower->Image)}}" id="imageBox" name="imageBox" class = "img-rounded img-raised img-responsive" style="max-width: 300px; max-height: 300px;" />
                            </div>
	                      </div>
	                      <div class="col-md-3" >
	                         <div class="form-group label-floating">
    	                          <label class="control-label">Flower Name</label>
	                              <input type="text" class="form-control" value = "{{$flower->flower_name}}" name="flowername" id="flowername" maxlength = '50' required>
                             </div>
                           
                             
	                          <div class="form-group label-floating">
		                        <label class="control-label">Description</label>
		                        <input type="text" class="form-control" value = "{{$flower->Description}}" name="desc" id="Qty" required>
		                     </div>
	                         
	                         <div class="form-group label-floating">
                              <label class="control-label">Wholesale Qty</label>
                              <input type="number" class="form-control" value = "{{$flower->QTY_of_Wholesale}}" name="QTY" step= '1' id="QTY">
                             </div>

                             <div class="form-group label-floating">
                              <label class="control-label">Default Price</label>
                              <input type="number" class="form-control" value = "{{number_format($flower->Initial_Price,2)}}" name="price" step= '0.1' id="price" >
                             </div>
	                      </div>
	                   </div>
	                                     <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                    <div class="btn-group" role="group">
                      <a type="button" href = "{{ route ('floweradd.index') }}" class="btn btn-default" data-dismiss="modal"  role="button">Cancel</a>
                    </div>
                    <div class="btn-group" role="group">
                       <button type = "submit" name = "AddBtn" class = "btn btn-primary btn-success"><span class = "glyphicon glyphicon-floppy-save"></span> Save changes</button>
                    </div>
                  </div>
	                </div>
						<br>
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