@extends('main')


@section('content')
	<section class="content">
		<div class="" style="margin-top: 2%;">
			<div class="panel panel-primary">
				<div class="panel-heading Subu">
			        <h3 class="panel-title"><b>Manage Flower To be added to the Inventory</b></h3>
			    </div>
            	<br>
		        <div  Style = "margin-left: 32%;">
                </div>
                <div class = "row" style = "margin-left: 5%;">
                  	<div class = "col-md-3">
                  		<div class="form-group label-floating">
                     		<img src = "{{asset('flowerimage/'.$records[16])}}" id="imageBox" name="imageBox" class = "img-rounded img-raised img-responsive" style = "max-width: 
                     		300px; max-height: 300px;"/>
                  		</div>
						<h4><b>Request ID: </b>RQST-{{$records[0]}}</h4>
						<h4><b>Flower ID: </b>FLWR-{{$records[4]}}</h4>
						<h4><b>Name: </b>{{$records[15]}}</h4>
						<h4><b>Unit Cost: </b> {{$records[14]}} pcs.</h4>
                  	</div>
                  	<div class="col-md-5" style = "margin-top: 2%;">
                  		<h4><b>Recieved Quantity: </b> {{$records[5]}} pcs.</h4>
                  		<h4><b>Updated Recieved QTY: </b> {{$records[6]}} pcs.</h4>
						<h4><b>Initial Good: </b> {{$records[7]}} pcs.</h4>
						<h4><b>Updated Good QTY: </b> {{$records[8]}} pcs.</h4>
						<h4><b>Initial Spoiled QTY: </b> {{$records[9]}} pcs.</h4>
						<h4><b>Updated Spoiled QTY: </b> {{$records[10]}} pcs.</h4>
						<h4><b>QTY Remaining: </b> {{$records[11]}} pcs.</h4>
						<h4><b>QTY Spoiled: </b> {{$records[12]}} pcs.</h4>
						<h4><b>QTY Sold: </b> {{$records[13]}} pcs.</h4>
                	</div>
                	<div class="col-md-4 row" style = "margin-top: 3%;">
              		<!--form model here-->
						<div class = "pull-right">
							<a href = "{{route('dashboard')}}" id = "cancel_btn" type = "button" class = "btn btn-round Shalala">Return to the List</a>
						</div>
                  		<div id = "AllinDiv" class = "col-md-12">
							{!! Form::open(array('route' => 'InventorySpoilage.store', 'data-parsley-validate'=>'', 'method'=>'POST')) !!}
							<br>
							<br>
							<br>
	                        <div hidden>
	                          <input id = "inventory_IDField" name = "inventory_IDField" value = "{{$records[17]}}">
	                          <input id = "flwr_IDField" name = "flwr_IDField" value = "{{$records[1]}}">
	                          <input id = "flwr_qtyRemainingField" name = "flwr_qtyRemainingField" value = "{{$records[11]}}">
	                        </div>
                    		<div class="form-group label-floating">
                      			<label class="control-label" for = "qtyRecieved_Field">Expected Number of Spoilage: </label>
								<input id = "qtyToSpoil_Field" name = "qtyToSPoil_Field" type="text" class="form-control" value = "{{$records[11]}} pcs." disabled/>
                      			<input id = "RealqtyToSpoil_Field" name = "RealqtyToSpoil_Field" type="number" class = "hidden form-control" min = "0" required value = "{{$records[11]}}" />
                    		</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="SubmitallCheckBox" id = "SubmitallCheckBox">
									Yes, All of these flowers are spoiled already
								</label>
							</div>
							<div id = "submitBtnDiv" class = "pull-right" hidden>
								<button id = "sbmtAll_btn" type = "submit" class="btn btn-md btn-success btn-tooltip" data-toggle="tooltip" data-placement="bottom" title = "Click this button if you are sure that it is the right spoilage number that is in this batch of he flower, for you cannot change what you've entered here after you click this button" data-container="body"><span class = "glyphicon glyphicon-ok"> Submit</span></button>
							</div>
							{!! Form::close() !!}
                 		</div>
						<button id = "showPartialBtn" type="button" class="btn btn-sm btn-default btn-tooltip" data-toggle="tooltip" data-placement="left" title="This button will show a form that will ask you the real number of spoiled flowers in this batch" data-container="body">NO, There are only part of it that are spoiled <span class = "glyphicon glyphicon-triangle-bottom"></span></button>

                  		<div id = "PartialDiv" class = "col-md-12" hidden>
							{!! Form::model($records, ['route'=>['InventorySpoilage.update', $records[17]],'method'=>'PUT','data-parsley-validate' => ''])!!}
							
							<button id = "hidepartialBtn" type="button" class="btn btn-sm btn-default btn-tooltip" data-toggle="tooltip" data-placement="left" title="This button will show the previous form" data-container="body">All of the remaining flowers are spoiled <span class = "glyphicon glyphicon-triangle-top"></span></button>
							<div hidden>
								<input id = "inventory_IDField" name = "inventory_IDField" value = "{{$records[17]}}">
								<input id = "flwr_IDField" name = "flwr_IDField" value = "{{$records[1]}}">
								<input id = "flwr_qtyRemainingField" name = "flwr_qtyRemainingField" value = "{{$records[11]}}">
							</div>
                    		<div class="form-group label-floating">
                      			<label class="control-label" for = "qtySpoiled_Field">Expected Number of Spoilage: </label>
                      			<input id = "ExpectedNumber_Field" name = "ExpectedNumber_Field" type="text" class="form-control" value = "{{$records[11]}} pcs."  disabled/>
                      			<input id = "Expected_Field" name = "Expected_Field" type="number" class="hidden" min = "0" value = "{{$records[11]}}" required/>
                    		</div>
                    		<div class="form-group label-floating">
                      			<label class="control-label" for = "lifeSpan_Field">Number of Spoiled: </label>
                      			<input id = "Spoiled_Field" name = "Spoiled_Field" type="number" class="form-control" value = "{{$records[11]-1}}" max = "{{$records[11]-1}}" min = "1" required/>
                    		</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="SubmitPartialCheckBox" id = "SubmitPartialCheckBox">
									Yes, I'm sure that this is the spoiled quantity
								</label>
							</div>
							<div id = "submitPartialBtnDiv" class = "pull-right" hidden>
								<button id = "sbmtPartial_btn" type = "submit" class="btn btn-md btn-success btn-tooltip" data-toggle="tooltip" data-placement="bottom" title = "Click this button if you are sure that it is the right spoilage number that is in this batch of he flower, for you cannot change what you've entered here after you click this button" data-container="body"><span class = "glyphicon glyphicon-ok"> Submit</span></button>
							</div>
							{!! Form::close() !!}
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
    var maxVal = $('#qtyRecieved_Field').val();
    $("#qtySpoiled_Field").attr({"max" : maxVal});

    $("#qtyGood_Field").val(maxVal);
    $("#Goodqty_Field").val(maxVal);


		$('#SubmitPartialCheckBox').click(function(){
			if($('#SubmitPartialCheckBox').is(":checked")){
				$('#submitPartialBtnDiv').show("fold");
				$('#hidepartialBtn').hide("fold");
			}else{
				$('#submitPartialBtnDiv').hide("fold");
				$('#hidepartialBtn').show("fold");
			}
		});

		$('#SubmitallCheckBox').click(function(){
			if($('#SubmitallCheckBox').is(":checked")){
				$('#submitBtnDiv').show("fold");
				$('#showPartialBtn').hide("fold");
			}else{
				$('#submitBtnDiv').hide("fold");
				$('#showPartialBtn').show("fold");
			}
		});

		$('#showPartialBtn').click(function(){
			$('#showPartialBtn').hide("fold");
			$('#AllinDiv').slideUp();
			$('#PartialDiv').slideDown();
		});

		$('#hidepartialBtn').click(function(){
			$('#PartialDiv').slideUp();
			$('#showPartialBtn').slideDown();
			$('#AllinDiv').slideDown();
		});


    $('#qtyRecieved_Field').change(function(){
      var rcvd_qty = $(this).val();
      var spld_qty = $("#qtySpoiled_Field").val();
      var goodqty = rcvd_qty - spld_qty;
      $("#qtyGood_Field").val(goodqty);
      $("#Goodqty_Field").val(goodqty);

      var maxVal = $(this).val();
      $("#qtySpoiled_Field").attr({"max" : maxVal});
    });

    $('#qtySpoiled_Field').change(function(){
      var spld_qty = $(this).val();
      var rcvd_qty = $("#qtyRecieved_Field").val();
      var goodqty = rcvd_qty - spld_qty;
      $("#qtyGood_Field").val(goodqty);
      $("#Goodqty_Field").val(goodqty);
      var maxVal = $('#qtyRecieved_Field').val();
      $("#qtySpoiled_Field").attr({"max" : maxVal});
    });

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
