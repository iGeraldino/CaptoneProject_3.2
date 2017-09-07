@extends('main')


@section('content')

	<section class="content-header">
  <br>
  <br>
  <h2>List of Bouquets in the shop</h2>
	<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#AddModal">
  Add Bouquet
		</button>

		<!-- Modal -->
		<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel"> Adding Bouquet </h5>
		       
		      </div>
		      <div class="modal-body">


              {!! Form::open(array('route' => 'bouquet.store', 'data-parsley-validate'=>'', 'files' => 'true')) !!}

                 <div class="form-group" Style = "margin-left: 31%;">
                    <img src= "{{ asset('img/'.'addfile.ico')}}" id="imageBox" name="imageBox" style="max-width: 200px; max-height: 200px;" />
                  </div>


		      				  <label>Item Image: </label>
                    <div class="input-group">
                      <input class ="uploader" type="file" accept="image/*" name = "accimg" id = "accimg" onchange="preview_image(event)" style = "margin-top: 2%;">
                    </div>
                    <div class="input-group" hidden>
                      <img class ="uploader" type="file" accept="image/*" name = "flowerimg2" id = "bouimg" value = "{{ asset('img/'.'addfile.ico')}}" src = "{{ asset('img/'.'addfile.ico')}}" hidden/>
                    </div>

                    <div class = "row">
                      <div class = "col-md-6">
                        <div class="form-group label-floating">
                          <label class="control-label">Price</label>
                          <input type="number" class="form-control" name="price" id="price" min = '1' required/>
                        </div>
                      </div>
                      <div class = "col-md-6">
                        <div class="form-group label-floating">
                          <label class="control-label">Count of Flowers:</label>
                          <input type="number" class="form-control" name="count" id="count" min = "1" required/>
                        </div>
                      </div>
                    </div>

                     <div class="modal-footer" id = "editFooter">
                      <div class="btn-group " role="group" aria-label="group button">
                        <div class="btn-group" role="group">
                          <button type="button" name = "cancelEditBtn" data-dismiss="modal" id = "cancelEditBtn" class="btn btn-danger btn-simple"  role="button">Cancel</button>
                        </div>
                        <div class="btn-group" role="group">
                           <button type = "submit" name = "AddBtn" id = "AddBtn" class = "btn btn-success btn-success btn-simple"><span class = "glyphicon glyphicon-floppy-save"></span> Create Bouquet</button>
                        </div>
                      </div>
                    </div>

		        		{!! Form::close() !!}



		      </div>
		    
		    </div>
		  </div>
		</div>

	</section>

	<section class="content">X
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Bouquet List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="sam" class="table table-bordered table-striped">
                <thead>
                <tr>
                      
                        <th> Bouquet ID </th>
                        <th> Bouquet Image </th>
                        <th> Bouquet Flower Count </th>
                        <th> Action </th>
                      

                </tr>
                </thead>
           		<tbody>

               @foreach ($bou as $bouq)

                  <tr>

                    <th>{{ $bouq -> bouquet_ID }}</th>
                   
                    <th align="center"><img src="{{ asset('bouquetImage/'. $bouq -> image)}}" style="min-width: 150px; max-height: 120px; margin-left: 100px;">
                    <th>{{ $bouq -> count_ofFlowers }} pcs. </th>
                    
                    <td align="center">
                    
                    <a href=" {{ route ('bouqAddFlower.show', $bouq -> bouquet_ID ) }} " class="btn btn-md btn-primary"> More Details</a>

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
	</script>

@endsection