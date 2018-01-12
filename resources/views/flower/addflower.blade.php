@extends('main')


@section('content')
	<section class="content-header">

		<!-- Modal -->
		<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel"> Adding Flower </h5>

		      </div>
		      <div class="modal-body">

              <div class="form-group" Style = "margin-left: 31%;">
                <img src= "{{ asset('img/'.'addfile.ico')}}" id="imageBox" name="imageBox" style="max-width: 200px; max-height: 200px;" />
              </div>

		      		{!! Form::open(array('route' => 'floweradd.store', 'data-parsley-validate'=>'', 'files' => 'true', 'method'=>'POST')) !!}
                    <label for = 'flowerimg'>Flower Image: </label>
                    <div class="input-group">
                      <input class ="uploader" type="file" accept="image/*" name = "flowerimg" id = "flowerimg" onchange="preview_image(event)" style = "margin-top: 2%;">
                    </div>
                    <div class="input-group" hidden>
                      <img class ="uploader" type="file" accept="image/*" name = "flowerimg2" id = "flowerimg2" value = "{{ asset('img/'.'addfile.ico')}}" src = "{{ asset('img/'.'addfile.ico')}}" hidden/>
                    </div>

                      <div class="form-group label-floating">
                        <label class="control-label">Flower Name</label>
                        <input type="text" class="form-control" name="flowername" id="flowername" maxlength = '30' required/>
                      </div>

                      <div class="form-group label-floating">
                        <label class = "control-label" for = "desc">Flower Description: </label>
                        <input type="text" class="form-control" name="desc" id="desc" maxlength = '255'/>
                      </div>


                    <div class = "row">
                      <div class = "col-md-4">
                        <div class="form-group label-floating">
                          <label class = "control-label" for="WholesaleQTY">Whole Sale QTY:</label>
                          <input type='number' name ="WholesaleQTY" id ="WholesaleQTY" class = "form-control " step='1'  min = '12' required/>
                        </div>
                      </div>
                      <div class = "col-md-4">
                          <div class="form-group label-floating">
                            <label class = "control-label" for="life">Default Price:</label>
                            <input type='number' name ="initialprice" id ="initialprice" class = "form-control " step='0.1' min = '10.00' required/>
                          </div>
                      </div>
                    </div><!--end of row-->

                     <div class="modal-footer" id = "editFooter">
                      <div class="btn-group " role="group" aria-label="group button">
                        <div class="btn-group" role="group">
                          <button type="button" name = "cancelEditBtn" data-dismiss="modal" id = "cancelEditBtn" class="btn btn-danger btn-simple"  role="button">Cancel</button>
                        </div>
                        <div class="btn-group" role="group">
                           <button type = "submit" name = "AddBtn" id = "AddBtn" class = "btn btn-success btn-success btn-simple"><span class = "glyphicon glyphicon-floppy-save"></span> Create Flower</button>
                        </div>
                      </div>
                    </div>
		        		{!! Form::close() !!}


		      </div>

		    </div>
		  </div>
		</div>

	</section>

	<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="col-md-10">
                <h3>FLOWERS THAT ARE BEING OFFERED BY THE SHOP</h3>
              </div>
              <div class="col-md-offset-5">
                <button type="button" class="btn btn-round btn-md twitch" data-toggle="modal" data-target="#AddModal">
              Add Flower <i class="material-icons">add_circle</i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="sam" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Flower ID </th>
                  <th>Flower Name </th>
                  <th>Flower Image </th>
                  <th>Current Price</th>
                  <th>Quantity onhand</th>
                  <th>Actions</th>

                </tr>
                </thead>
           		<tbody>

           			@foreach ($flower as $flow)

           				<tr>

           					<th>FLWR-{{ $flow -> flower_ID }}</th>
           					<th>{{ $flow -> flower_name }}</th>
                    <th align = "center"><img src="{{ asset('flowerimage/'. $flow -> IMG)}}" class ="img-rounded img-raised img-responsive" style="min-width: 80px; max-height: 80px;">
                    </th>
           					<th>Php {{ number_format($flow -> Final_SellingPrice,2) }}/pc</th>
           					<th>{{ $flow -> QTY }} PCS.</th>
           					<td align="center">
                        <a href=" {{ route ('floweradd.edit', $flow -> flower_ID ) }} " class="btn btn-just-icon Subu" rel="tooltip" title="VIEW"> <i class="material-icons">search</i> </a>
           					    <a href=" {{ route('inv.viewFlowerInventory',['flower_ID'=>$flow -> flower_ID]) }}" class="btn btn-just-icon btn-info" rel="tooltip" title="SEE INVENTORY"> <i class="material-icons">more_horiz</i> </a>
           					</td>

           				</tr>


           			@endforeach

           		</tbody>
               </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

@endsection

@section('scripts')

	<script>
	  $(function () {
	    $("#example1").DataTable();
	    $('#sam').DataTable({
	      "paging": true,
	      "info": true,
	      "autoWidth": false
	    });
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

  $(document).ready(function(){

    var session = ""
		var data = '@Session["success"]';
    console.log('session is = '+session);
   if(session!=null){
    //Show popup
    console.log('may laman si session');
   }
   else{
    //Show loginpage
    console.log('walang laman si session');

   }
  });//END OF READY FUNCTION
	</script>

@endsection
