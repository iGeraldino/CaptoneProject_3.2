@extends('main')

@section('content')

<?php
  $AdjustmentStatValue = Session::get("Adjustment_status");
?>

<div hidden>
  <input id = "adjustmentSessionField" value = "{{$AdjustmentStatValue}}">
</div>

	<section class="content">
	<div class="container" style="margin-top: 50px;">
			<div class="panel panel-primary">
					  <div class="panel-heading" style="background-color: #C93756">
			            <h3 class="panel-title"><b>Manage Flower To be added to the Inventory</b></h3>
			          </div>

            		<br>
		              <div  Style = "margin-left: 32%;">
                  </div>
	                    <div class = "row" style = "margin-left: 5%;">
	                      <div class = "col-md-3">
                            <div class="form-group label-floating">
                             <img src= "{{asset('flowerimage/'.$FlowerDet[2])}}" id="imageBox" name="imageBox" class = "img-rounded img-raised img-responsive" style="max-width: 300px; max-height: 300px;" />
                            </div>
	                      </div>
	                      <div class="col-md-3" >
                          <h4><b>Request ID: </b>RQST-{{$FlowerDet[0]}}</h4>
                          <h4><b>Flower ID: </b>FLWR-{{$FlowerDet[1]}}</h4>
                          <h4><b>Flower Name: </b>{{$FlowerDet[3]}}</h4>
                          <h4><b>Date to Recieve: </b>{{$FlowerDet[5]}}</h4>
                          <h4><b>Date Recieved: </b>{{$FlowerDet[4]}}</h4>
                          <h4><b>Expected Quantity: </b> {{$FlowerDet[6]}} pcs.</h4>
                          <h4><b>Recieved Quantity: </b> {{$FlowerDet[7]}} pcs.</h4>
                          <h4><b>Good Quantity: </b> {{$FlowerDet[8]}} pcs.</h4>
                          <h4><b>Spoiled Quantity: </b> {{$FlowerDet[9]}} pcs.</h4>
                          <h4><b>Adjusted Recieved Quantity: </b> {{$FlowerDet[10]}} pcs.</h4>
                          <h4><b>Adjusted Good Quantity: </b> {{$FlowerDet[11]}} pcs.</h4>
                          <h4><b>Adjusted Spoiled Quantity: </b> {{$FlowerDet[12]}} pcs.</h4>
                        </div>
                        <div class="col-md-6 row" style = "margin-top: 3%;">
                      <!--form model here-->
                      {!! Form::model($FlowerDet, ['route'=>['Inventory_Flowers_toAdjustments.update', $FlowerDet[1]],'method'=>'PUT','data-parsley-validate' => ''])!!}
                          <div class = "col-md-6">

                            <div hidden>
                              <input id = "rqst_IDField" name = "rqst_IDField" value = "{{$FlowerDet[0]}}">
                              <input id = "flwr_IDField" name = "flwr_IDField" value = "{{$FlowerDet[1]}}">
                              <input id = "flwr_qtyField" name = "flwr_qtyField" value = "{{$FlowerDet[6]}}">
                            </div>
                            <div class="form-group label-floating">
                              <label class="control-label" for = "qtyRecieved_Field">Quantity Recieved (pcs): </label>
                              <input id = "qtyRecieved_Field" name = "qtyRecieved_Field" type="number" class="form-control" min = "0" required value = "{{$FlowerDet[7]}}"/>
                            </div>
                            <div class="form-group label-floating">
                              <label class="control-label" for = "qtySpoiled_Field">Quantity Spoiled (pcs): </label>
                              <input id = "qtySpoiled_Field" name = "qtySpoiled_Field" type="number" class="form-control" min = "0" value = "{{$FlowerDet[9]}}" required/>
                            </div>
                              <div class="form-group label-floating">
                                <label class="control-label" for = "qtySpoiled_Field">Quantity Good (pcs): </label>
                                <input id = "qtyGood_Field" name = "qtyGood_Field" type="number" class="form-control" min = "0" value = "{{$FlowerDet[8]}}"  disabled required/>
                                <input id = "Goodqty_Field" name = "Goodqty_Field" type="number" class="hidden" min = "0" value = "{{$FlowerDet[8]}}" required/>
                              </div>
                              <div>
                                <a href = "{{route('InventoryScheduling.edit',$FlowerDet[0])}}" id = "cancel_btn" type = "button" class = "btn btn-md btn-danger">Cancel</a>
                                <button id = "sbmt_btn" type = "submit" class = "btn btn-md btn-success">Submit</button>
                              </div>
                          </div>

                          {!! Form::close() !!}

                          <!--form close here-->
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

if($('#adjustmentSessionField').val()=='noChanges'){
           //Show popup
    swal("No Change","Sorry but you are attempting to make no changes into your request, therefore no adjustment was made!","error");
  }

 	if($('#adjustmentSessionField').val()=='Successful'){
             //Show popup
      swal("Please Take Note","Adjustments has been done, this means that inventory has been updated to the changes that you made in this page. If you wish to trace the changes you can see the inventory transactions!","info");
    }
    var maxVal = $('#qtyRecieved_Field').val();
    $("#qtySpoiled_Field").attr({"max" : maxVal});

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
