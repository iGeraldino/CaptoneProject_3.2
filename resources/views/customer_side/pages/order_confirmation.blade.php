@extends('customer_side_main')
@section('title', 'Checkout')
@section('css')
    <link href="_CSS/checkout1.css" rel="stylesheet">
@endsection
	<div class="container" style="margin-top: 10%;">
		<h3 class="fontx text-center">Summary</h3>
        <hr class="colorgraph">
        <p class="text-center" style = "color:red;"><b>* You have successfully completed all steps. Now All you need to do is Submit the order</b></p>
        <br>
        <br>

        <div>
        	<div class="row pull-right">
       			<div class = "col-md-6 ">
            		<a type="button" class="btn btn-success btn-lg"> Done </a>
       			</div>
       			<div class = 'col-md-6'>
        			<button type="submit"  class="btn btn-info btn-lg"> Print</button>
       			</div>
        	</div>
        </div>
        <div class="col-md-12">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Order Summary (Pickup)</h3>
					<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
				</div>
				<div class="panel-body">
					<div class="col-md-8">
  								<h5><b>Customer Name:</b></h5>
								<div class="form-group">
		                      		<input type="text" name="fullname1" id="fullname1" class="form-control input-lg"  disabled>
		                    	</div>
							</div>
							<br>
							<div class="col-md-3 ">
                              	<h5><b>Customer Cpntact:</b></h5>
								<div class="form-group">
		                      		<input type="text" name="contact1" id="contact1" class="form-control input-lg"  disabled>
		                    	</div>
							</div>
							<div class="col-md-4 ">
                            	<h5><b>Customer Mode of Payment:</b></h5>
								<div class="form-group">
		                      		<input type="text" name="mode1" id="mode1" class="form-control input-lg"  disabled>
		                    	</div>
							</div>
							<div class="col-md-3 ">
                              	<h5><b>Customer email:</b></h5>
								<div class="form-group">
		                      		<input type="textr" name="email1" id="email1" class="form-control input-lg" va disabled>
		                    	</div>
							</div>
							<div class="col-md-5">
								<p> <b> Note: Please send a picture of your Deposit Slip through our email-address. <a href="#"> See example!</a> </b></p>
							</div>
							<div class = "col-md-12">
								<h3 class="fontx text-left">Pickup Details</h3>
								<hr class="colorgraph">
								<div class = "row">
									<div class = "col-md-6">
										<h5><b>Date of pickup:</b></h5>
										<input type="text" name="SummarypickupDate" id="SummarypickupDate" class="form-control input-lg"  disabled>
									</div>
									<div class = "col-md-6">
										<h5><b>Time:</b></h5>
										<input type="text" name="SummarypickupTime" id="SummarypickupTime" class="form-control input-lg"  disabled>
									</div>
								</div>
							</div>
							<div class="col-md-12" style="margin-top: 40px;overflow-x:auto;">
								<h3 class="fontx text-center">Flower Summary</h3>
								<hr class="colorgraph">
								<table class="table table-hover table-bordered">
								  	<thead>
								    	<tr>
									      <th class="text-center">Flower ID</th>
									      <th class="text-center">Name</th>
									      <th class="text-center">Price</th>
									      <th class="text-center">Qty</th>
									      <th class="text-center">Total Amount</th>
										</tr>
								  	</thead>
								  	<tbody>
	                                	<tr>
	                                  		<th scope="row" class="text-center">id</th>
			                                    <td class="text-center">Name</td>
			                                    <td class="text-center">Price}</td>
			                                    <td class="text-center">Quantity</td>
			                                    <td class="text-center">Price</td>

	                                  </tr>

								  </tbody>
								</table>
							</div>
							<div class="col-md-12" style="margin-top: 40px;overflow-x:auto;">
								<h3 class="fontx text-center">Bouquet Summary</h3>
								<hr class="colorgraph">
								<table class="table table-hover table-bordered">
								  	<thead>
								    	<tr>
									      <th class="text-center">ID</th>
									      <th class="text-center">Item Name</th>
									      <th class="text-center">Price</th>
									      <th class="text-center">Qty</th>
									      <th class="text-center">Contents</th>
										</tr>
								  </thead>

                              <tbody>
                                 <tr>

		                            <th scope="row">id</th>
		                            <td>name</td>
		                            <td>price</td>
		                            <td>quantity</td>

                                    <td>
                                    <table class="table table-bordered" style="overflow-x:auto;">
                                    	<thead>
	                                        <th class="text-center">Item ID</th>
		                                    <th class="text-center">Item Name</th>
		                                    <th class="text-center">Price</th>
		                                    <th class="text-center">Qty</th>
		                                    <th class="text-center">Total Price</th>
	                                   </thead>

	                                   <tbody>
	                                    <th scope="row">id</th>
	                                      <td>name</td>
	                                      <td>price</td>
	                                      <td>qty</td>
	                                      <td>price</td>

	                                   </tbody>
		                                <tbody>
		                                  <th scope="row">id</th>
		                                    <td>name</td>
		                                    <td>price</td>
		                                    <td>qty</td>
		                                    <td>qty</td>

		                                </tbody>

                                	</table>
                                </td>
                            </tr>
                        </tbody>
					</table>
				</div>
			</div>
			<div class="col-md-offset-6">
					<h3 class="fontx text-center"> TOTAL AMOUNT: </h3>
				</div>
		</div>
	</div>
</div>

@section('content')