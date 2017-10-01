@extends('main')


@section('content')
  <section class="content-header">

		<!-- Modal -->
		<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel"> Adding Accessories</h5>
		       
		      </div>
		      <div class="modal-body">

              <div class="form-group" Style = "margin-left: 31%;">
                <img src= "{{ asset('img/'.'addfile.ico')}}" id="imageBox" name="imageBox" style="max-width: 200px; max-height: 200px;" />
              </div>

		      		{!! Form::open(array('route' => 'acc.store', 'data-parsley-validate'=>'', 'files' => 'true')) !!}

                    <label>Item Image: </label>
                    <div class="input-group">
                      <input class ="uploader" type="file" accept="image/*" name = "accimg" id = "accimg" onchange="preview_image(event)" style = "margin-top: 2%;">
                    </div>
                    <div class="input-group" hidden>
                      <img class ="uploader" type="file" accept="image/*" name = "flowerimg2" id = "flowerimg2" value = "{{ asset('img/'.'addfile.ico')}}" src = "{{ asset('img/'.'addfile.ico')}}" hidden/>
                    </div>

                    <div class = "row">
                      <div class = "col-md-5">
                        <label for="WholesaleQTY">Item Name:</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                          <input type='text' name ="accname" id ="accname" class = "form-control "  maxlength = '50' required/>           
                        </div> 
                      </div>
                      <div class="form-group col-md-5">
                        <label for="price">Price:</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                          <input type='number' name ="price" id ="price" class = "form-control " step='0.01' placeholder='0.00' min = '0.00' required/>
                        </div>
                      </div>
                      </div>
                      <br>
                        <br>
                     <div class="modal-footer" id = "editFooter">
                      <div class="btn-group " role="group" aria-label="group button">
                        <div class="btn-group" role="group">
                          <button type="button" name = "cancelEditBtn" data-dismiss="modal" id = "cancelEditBtn" class="btn btn-danger btn-simple"  role="button">Cancel</button>
                        </div>
                        <div class="btn-group" role="group">
                           <button type = "submit" name = "AddBtn" id = "AddBtn" class = "btn btn-success btn-simple"><span class = "glyphicon glyphicon-floppy-save"></span> Add Accessories</button>
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
              <div class="col-md-8">
                <h3><b>LIST OF ACCESSORIES BEING OFFERRED BY THE SHOP</b></h3>
              </div>
              <div class="col-md-4">
                <button type="button" class="btn btn-round btn-md pull-right twitch" data-toggle="modal" data-target="#AddModal">
                <i class="material-icons md-24"> add_circle</i>  Add Accessories  
                  </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="sam" class="table table-bordered table-striped">
                <thead>
                <tr>
                      
                        <th class="text-center"> ACCESSORIES ID </th>
                        <th class="text-center"> NAME </th>
                        <th class="text-center"> IMAGE </th>
                        <th class="text-center"> PRICE </th>
                        <th class="text-center"> QUANTITY </th>
                        <th class="text-center"> ACTION </th>

                </tr>
                </thead>
           		<tbody>

           		 @foreach ($acc as $acce)
           				<tr>
                    <th class="text-center">ITM-{{ $acce->ACC_ID }}</th>
                    <th class="text-center">{{ $acce -> name }}</th>
                    <th align="center"><img src="{{ asset('accimage/'. $acce -> image)}}" style="min-width: 80px; max-height: 50px; margin-left: 100px;">
                    <th class="text-center">Php {{number_format($acce -> price,2)  }}</th>
                    <th class="text-center">{{ $acce -> qty }} pcs</th>
                    <td align="center" > 
                          <a data-toggle="modal" href="#acessoryModal{{$acce->ACC_ID}}"> 
                          <button rel="tooltip" title="VIEW" class="btn btn-just-icon Subu"> <i class="material-icons md-24"> edit</i></i> </button></a>
                           {!! Form::open(['route' => ['acc.destroy',$acce->ACC_ID],'method'=>'DELETE']) !!}
                          <button rel="tooltip" title="DELETE" type = "submit" name = "DelBtn" class="btn btn-just-icon Shalala"> <i class="material-icons md-24">delete</i></button>
                          {!! Form::close() !!}
                        </td> 

                        <div id="acessoryModal{{$acce->ACC_ID}}" class="modal fade">
                                    <div class="modal-dialog text-center" style = "width: 40%;" >
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Acessory's Details</h4>
                                            </div>

                                            <div class="modal-body">
                                              <img src = "{{ asset('accimage/'. $acce -> image)}}" class = "img_responsive" style = "max-width:300px; margin-top: 3%; margin-left: 7%;">
                                                
                                                <p><strong>ITM-{{$acce->ACC_ID}}: </strong> </p>
                                                <p class="text-warning"><strong>Item name: </strong> {{$acce->name}} </p>
                                                <p class="text-warning"><strong>PRICE:</strong> Php {{number_format($acce->price,2)}} </p>
                                                <p class="text-warning"><strong>Qty onhand: </strong> {{$acce->qty}} </p>
                                            </div>
                                            <div class="modal-footer" id = "editFooter">
                                              <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                                <div class="btn-group" role="group">
                                                  <button type="button" name = "cancelEditBtn" data-dismiss="modal" id = "cancelEditBtn" 
                                                  class="btn btn-default"  role="button">Cancel</button>
                                                </div>
                                                <div class="btn-group" role="group">
                                                    <a type = "button" href="{{ route('acc.edit',$acce->ACC_ID) }}" class = "btn btn-success btn-info" ><span class = "glyphicon glyphicon-pencil"></span> 
                                                      Edit Item
                                                    </a>
                                                 
                                                </div>
                                              </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                          <!--end of modal-->
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