@extends('main')

@section('content')
	
	<div class="container">
		<div class="row">
			<div class="col-md-" style="margin-left: -7px;">
				<div class="title container" style="margin-top: 5%;">
					<h3>WONDERBLOOM FLOWERSHOP ORDERING</h3>
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-6">
					<h6 class="container"><b>Congartulations! You have successfully made an order</b></h6>
				</div>
				<div class="col-md-3 col-md-offset-3">
					<a href="#" type="button" class="btn btn-sm Lemon"> Done</a>
					<a href="#" type="button" class="btn btn-sm Beach"> Print</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12">
		<div class="panel" style="margin-top: 3%">
			<div class="panel-heading  Sharp">
				<div class="panel-title">
					<div class="row">
		  				<div class="col-xs-12">
		    				<h6 style="color: white"><span class="glyphicon glyphicon-user" style="color: white;"></span> <b>Order Summary</b></h6>
		  				</div>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="col-md-6">
					<h6><b>Order ID:</b></h6>
				</div>
				<div class="col-md-6">
					<h6><b>Order Type:</b></h6>
				</div>
				<div class="col-md-6">
					<h6><b>Customer Name:</b></h6>
				</div>
				<div class="col-md-6">
					<h6><b>Status:</b></h6>
				</div>
				<div class="col-md-6">
					<h6><b>Shipping Method:</b></h6>
				</div>
				<div class="col-md-6">
					<h6><b>Payment Method:</b></h6>
				</div>
				<div class="col-md-12">
					<h6><b>Delivery Address:</b></h6>
				</div>
				<div class="col-md-12">
					<h6><b>Delivery Date:</b></h6>
				</div>
				<div class="col-md-12">
					<h6><b>Pickup Date:</b></h6>
				</div>
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
				<h6 class="text-right"><b>Total Amount:____________</b></h6>
			</div>
		</div>
	</div>
	
	
	

@endsection