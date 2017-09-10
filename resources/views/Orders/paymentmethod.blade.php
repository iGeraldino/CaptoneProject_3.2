@extends('main')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8" style="margin-left: -7px;">
				<div class="title container" style="margin-top: 5%;">
					<h3>WONDERBLOOM FLOWERSHOP ORDERING</h3>
				</div>
				<div class="panel" style="margin-top: 3%">
					<div class="panel-heading  Sharp">
						<div class="panel-title">
                			<div class="row">
                  				<div class="col-xs-6">
                    				<h6 style="color: white"><span class="glyphicon glyphicon-user" style="color: white;"></span> <b>Order Summary</b></h6>
                  				</div>
                			</div>
              			</div>
					</div>
					<div class="panel-body">
						<div class="col-md-12" style="margin-top: 40px;overflow-x:auto;">
							<h3 class="fontx text-center">Flower Summary</h3>
							<hr>
							<table class="table table-hover table-bordered">
							  	<thead>
							    	<tr>
								      <th class="text-center">Flower ID</th>
								      <th class="text-center">Name</th>
								      <th class="text-center">Image</th>
								      <th class="text-center">Price</th>
								      <th class="text-center">Qty</th>
								      <th class="text-center">Total Amount</th>
									</tr>
							  </thead>
							  <tbody>
							    <tr>
							      <th scope="row">1</th>
							      <td>Mark</td>
							      <td>Otto</td>
							      <td>@mdo</td>
							      <td></td>
							      <td></td>
							    </tr>
							    <tr>
							      <th scope="row">2</th>
							      <td>Jacob</td>
							      <td>Thornton</td>
							      <td>@fat</td>
							      <td></td>
							      <td></td>
							    </tr>
							  </tbody>
							</table>
						</div>
						<hr>
						<div class="col-md-4 col-md-offset-7">
							<b>(Flower) Total Amount: PHP</b>
						</div>
						<div class="col-md-12" style="margin-top: 40px;overflow-x:auto;">
							<h3 class="fontx text-center">Bouquet Summary</h3>
							<hr>
							<table class="table table-hover table-bordered">
							  	<thead>
							    	<tr>
								      <th class="text-center">Flower ID</th>
								      <th class="text-center">Name</th>
								      <th class="text-center">Image</th>
								      <th class="text-center">Price</th>
								      <th class="text-center">Qty</th>
								      <th class="text-center">Total Amount</th>
									</tr>
							  </thead>
							  <tbody>
							    <tr>
							      <th scope="row">1</th>
							      <td>Mark</td>
							      <td>Otto</td>
							      <td>@mdo</td>
							      <td></td>
							      <td></td>
							    </tr>
							    <tr>
							      <th scope="row">2</th>
							      <td>Jacob</td>
							      <td>Thornton</td>
							      <td>@fat</td>
							      <td></td>
							      <td></td>
							    </tr>
							  </tbody>
							</table>
						</div>
						<div class="col-md-4 col-md-offset-7">
							<b>(Bouquet) Total Amount: PHP</b>
						</div>
					</div>
					<div class="panel-footer">

					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel" style="margin-top: 35%; margin-left: -5%;">
					<div class="panel-heading  Sharp">
						<div class="panel-title">
                			<h6 style="color: white"><span class="glyphicon glyphicon-user text-center" style="color: white;"></span> <b>Order Processing</b></h6>
              			</div>
					</div>
					<div class="panel-body">
						<h5 class="text-center">Payment Method</h5>
						<div class="col-md-6">
							<label>
						    	<div class="radio">
									<label>
										<input type="radio" name="optionsRadios" checked="true">
										Cash
									</label>
								</div>
							</label>
						</div>
						<div class="col-md-6">
							<label>
						    	<div class="radio">
									<label>
										<input type="radio" name="optionsRadios">
										Bank
									</label>
								</div>
							</label>
						</div>
						<h6><b>Method Details</b></h6>
						<textarea class="form-control" placeholder="Details" rows="3"></textarea>
					</div>
					<div class="panel-footer">
						<a href="" type="button" class="btn btn-sm Love"> Back</a>
						<a data-toggle="modal" data-target="#cashmodal" class="btn btn-sm Lemon"> Process</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--MODAL-->

	<!-- Modal Core -->
	<div class="modal fade" id="cashmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title" id="myModalLabel">Order Details</h4>
	      </div>
	      <div class="modal-body">
	        <h6>Customer name:</h6>
	        <h6>Address</h6>
	        <h6>Contact No:</h6>
	        <h6>Email Add:</h6>
	        <h6>Shipping Method:</h6>
	        <h6>Payment Method:</h6>
	        <h6>Total Amount:</h6>
	        <div class="col-md-6">
				<h6>Date of Pickup</h6>
				<input class="datepicker form-control" type="text" value="03/12/2016"/>
			</div>
			<div class="col-md-6">
				<h6>Time of Pickup</h6>
			</div>
			<div class="col-md-6 col-md-offset-6">
				<div class="checkbox">
					<label>
						<input type="checkbox" name="optionsCheckboxes">
						<p><b>Note:</b> that if you check this box,you are sure for this order details</p>
					</label>
				</div>
			</div>
	      </div>
	      <div class="modal-footer">
	      <br> <br> <br> <br> <br> <br> <br> <br>
	        <a type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</a>
	        <a href="/finalorder" type="button" class="btn btn-info btn-simple">Process Order</a>
	      </div>
	    </div>
	  </div>
	</div>
@endsection

@section('scripts')
	<script type="text/javascript">
		$( document ).ready(function() {
   			 $('.datepicker').datepicker({
				weekStart:1
			});
		});
	</script>

@endsection
