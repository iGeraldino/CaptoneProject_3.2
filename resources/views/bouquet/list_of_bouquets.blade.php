@extends('main')
@section('content')
	<div class="container" style="margin-top: 50px;">


      	<div class="col-md-6 ">
        	<span class="label" style="font-size: 15px; background-color: #F62459">List of Bouquets</span>
      	</div>

	      <br>
	      <br>
	    <div class="col-md-6">
        	<button class="btn btn-default btn-sm" data-toggle="modal" data-target="#addbouquet">
                <i class="glyphicon glyphicon-plus-sign"></i> Create New Bouquet
          	</button>
    	</div>
    </div>

    	<!-- Start of Table-->
	  	<div class="row container">
	      	<div class="col-md-12">
	        	<div class="box">
	          		<!-- /.box-header -->
	          		<div class="box-body">
	            		<table id="example2" class="table">
	              			<thead> 
			                    <th class="text-center"> Bouquet ID </th>
			                    <th class="text-center"> Image</th>
			                    <th class="text-center"> Count of Flower</th>
			                    <th class="text-center"> Price</th>
			                    <th class="text-center"> Action </th>
				            </thead>

	                	<tbody>
	                  		<tr>  
		                    	<td> 1     </td>
		                    	<td>       </td>
		                    	<td>       </td>
		                    	<td>       </td>
	                    		<td align="center"> 
	                      			<button type="button" rel="tooltip" title="Manage" class="btn btn-simple btn-success btn-lg">
	                        			<i class="glyphicon glyphicon-edit"></i>
	                      			</button></a>
	                      			<button type="button" rel="tooltip" title="Edit Customer" class="btn btn-simple btn-danger btn-lg"> 
	                        			<i class="glyphicon glyphicon-remove"></i>
	                      			</button></a>
	                    		</td>
		                  	</tr>

		                  	<tr>  
		                    	<td> 2     </td>
		                    	<td>       </td>
		                    	<td>       </td>
		                    	<td>       </td>
	                    		<td align="center"> 
	                      			<button type="button" rel="tooltip" title="Manage" class="btn btn-simple btn-success btn-lg">
	                        			<i class="glyphicon glyphicon-edit"></i>
	                      			</button></a>
	                      			<button type="button" rel="tooltip" title="Edit Customer" class="btn btn-simple btn-danger btn-lg"> 
	                        			<i class="glyphicon glyphicon-remove"></i>
	                      			</button></a>
	                    		</td>
		                  	</tr>

	                  		<tr>  
		                    	<td> 3     </td>
		                    	<td>       </td>
		                    	<td>       </td>
		                    	<td>       </td>
	                    		<td align="center"> 
	                      			<button type="button" rel="tooltip" title="Manage" class="btn btn-simple btn-success btn-lg">
	                        			<i class="glyphicon glyphicon-edit"></i>
	                      			</button></a>
	                      			<button type="button" rel="tooltip" title="Edit Customer" class="btn btn-simple btn-danger btn-lg"> 
	                        			<i class="glyphicon glyphicon-remove"></i>
	                      			</button></a>
	                    		</td>
		                  	</tr>
		                </tbody>
	            	</table>
	          	</div>
	          <!-- /.box-body -->
	        </div>
	        <!-- /.box -->
	      </div>
	    </div>

	    <!-- Modal Core -->
		<div class="modal fade" id="addbouquet" tabindex="-1" role="dialog" aria-labelledby="addbouquet" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">Add Bouquet</h4>
		      </div>
		      <div class="modal-body">
				<div class="col-sm-offset-2 col-xs-6">
					<div class="form-group label-floating">
						<label class="control-label">Enter Counf of Flower</label>
						<input type="number" class="form-control">
					</div>
				</div>
		      </div>

		      <br>
		      <br>
		      <br>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Cancel</button>
		        <button type="button" class="btn btn-success btn-simple">Proceed</button>
		      </div>
		    </div>
		  </div>
		</div>

@endsection
