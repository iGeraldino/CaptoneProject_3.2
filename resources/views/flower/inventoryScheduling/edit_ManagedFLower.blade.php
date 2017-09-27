@extends('main')


@section('content')
	<section class="content">
	<div class="container" style="margin-top: 50px;">
			<div class="panel panel-primary">
					  <div class="panel-heading" style="background-color: #C93756">
			            <h3 class="panel-title"><b>Edit Flower before adding it to the Inventory</b></h3>
			          </div>

            		<br>
		              <div  Style = "margin-left: 32%;">
                  </div>
	                    <div class = "row" style = "margin-left: 5%;">
	                      <div class = "col-md-3">
                            <div class="form-group label-floating">
                             <img src= "{{asset('flowerimage/'.$records[7])}}" id="imageBox" name="imageBox" class = "img-rounded img-raised img-responsive" style="max-width: 300px; max-height: 300px;" />
                            </div>
	                      </div>
	                      <div class="col-md-3" style = "margin-top: 5%;">
                          <h4><b>Request ID: </b>RQST-{{$ScheduleDet->Schedule_ID}}</h4>
                          <h4><b>Flower ID: </b>FLWR-{{$records[1]}}</h4>
                          <h4><b>Flower Name: </b>{{$records[2]}}</h4>
                          <h4><b>Date to Recieve: </b>{{$ScheduleDet->Date_of_Event}}</h4>
                          <h4><b>Expected Quantity: </b> {{$records[5]}} pcs.</h4>
                        </div>
                        <div class="col-md-6 row" style = "margin-top: 3%;">
                      <!--form model here-->
                      {!! Form::model($records, ['route'=>['Inventory_Flowers_toSession.update', $records[1]],'method'=>'PUT','data-parsley-validate' => ''])!!}
                          <div class = "col-md-6">
                            <div hidden>
                              <input id = "rqst_IDField" name = "rqst_IDField" value = "{{$ScheduleDet->Schedule_ID}}">
                              <input id = "flwr_IDField" name = "flwr_IDField" value = "{{$records[1]}}">
                              <input id = "flwr_qtyField" name = "flwr_qtyField" value = "{{$records[5]}}">
                            </div>
                            <div class="form-group label-floating">
                              <label class="control-label" for = "qtyRecieved_Field">Quantity Recieved (pcs): </label>
                              <input id = "qtyRecieved_Field" name = "qtyRecieved_Field" type="number" class="form-control" min = "0" required value = "{{$records[3]}}"/>
                            </div>
                            <div class="form-group label-floating">
                              <label class="control-label" for = "qtySpoiled_Field">Quantity Spoiled (pcs): </label>
                              <input id = "qtySpoiled_Field" name = "qtySpoiled_Field" type="number" class="form-control" min = "0" value = "{{$records[9]}}" required/>
                            </div>
                          </div>
                          <div class = "col-md-6">
                            <div class="form-group label-floating">
                              <label class="control-label" for = "qtySpoiled_Field">Quantity Good (pcs): </label>
                              <input id = "qtyGood_Field" name = "qtyGood_Field" type="number" class="form-control" min = "0" value = "{{$records[8]}}"  disabled required/>
                              <input id = "Goodqty_Field" name = "Goodqty_Field" type="number" class="hidden" min = "0" value = "{{$records[8]}}" required/>
                            </div>
                            <div class="form-group label-floating">
                              <label class="control-label" for = "Cost_Field">Cost (per Piece): </label>
                              <input id = "Cost_Field" name = "Cost_Field" type="number" step = "0.01" class="form-control" value = "{{number_format($records[4],2)}}" min = "1" required/>
                            </div>
                            <div class="form-group label-floating">
                              <label class="control-label" for = "lifeSpan_Field">Expected Life Span (days): </label>
                              <input id = "lifeSpan_Field" name = "lifeSpan_Field" type="number" class="form-control" value = "{{$records[6]}}" min = "1" required/>
                            </div>
                          </div>

                          <div class = "pull-right">
                            <a href = "{{route('InventoryArriving_Flowers.show',$ScheduleDet->Schedule_ID)}}" id = "cancel_btn" type = "button" class = "btn btn-md btn-danger">Cancel</a>
                            <button id = "sbmt_btn" type = "submit" class = "btn btn-md btn-success">Submit</button>
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

 	if($('#UpdateFlower_result').val()=='Successful'){
             //Show popup
      swal("Take Note","Expected quantity of flower to be recieved has been successfully updated!","info");
    }
    var maxVal = $('#qtyRecieved_Field').val();
    $("#qtySpoiled_Field").attr({"max" : maxVal});

    $("#qtyGood_Field").val(maxVal);
    $("#Goodqty_Field").val(maxVal);


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
