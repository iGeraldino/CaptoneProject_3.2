@extends('main')

@section('content')
	<?php
		$final_Amt = str_replace(',','',Cart::instance('Ordered_Flowers')->subtotal()) + str_replace(',','',Cart::instance('Ordered_Bqt')->subtotal());
	?>

	<div class="container">
		<div class="row">
			<div class="col-md-8" style="margin-left: -7px;">
				<div class="title container" style="margin-top: 5%;">
					<h3><b>WONDERBLOOM FLOWERSHOP ORDERING</b></h3>
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
						<div class = "text-right" style = "color:darkviolet;">
							<h5><b>Total Amount:</b> Php {{number_format($final_Amt,2)}}</h5>
						</div>
						<div class="col-md-12" style="margin-top: 10px;overflow-x:auto;">
							<h3 class="fontx text-center">Flower Summary</h3>
							<hr>
							<table class="table table-hover table-bordered table-striped">
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
							  @foreach(Cart::instance('Ordered_Flowers')->content() as $Flwr)
							    <tr>
							      <th scope="row">1</th>
							      <td>{{$Flwr->name}}</td>
							      <td><img class="img-rounded img-raised img-responsive" style="min-width: 40px; max-height: 40px;" src="{{ asset('flowerimage/'.$Flwr->options['image'])}}"></td>
							      <td class = "text-right" style = "color:red;"> Php 	{{number_format($Flwr->price,2)}}</td>
							      <td class = "text-right"> {{$Flwr->qty}} pcs. </td>
							      <td class = "text-right" style = "color:red;">Php {{number_format($Flwr->qty*$Flwr->price,2)}}</td>
							    </tr>
			                   @endforeach
							  </tbody>
							</table>
						</div>
						<hr>
						<div class="col-md-4 col-md-offset-7">
							<h7 style = "color:darkviolet;"><b>(Flower) Total: Php {{Cart::instance('Ordered_Flowers')->subtotal()}}</b></h7>
						</div>
						<div class="col-md-12" style="margin-top: 10px;overflow-x:auto;">
							<h3 class="fontx text-center">Bouquet Summary</h3>
							<hr>
							<table class="table table-hover table-bordered table-striped">
							  	<thead>
							    	<tr>
								      <th class="text-center">Item ID</th>
								      <th class="text-center">Price</th>
								      <th class="text-center">Qty</th>
								      <th class="text-center">Total</th>
								      <th class="text-center">Contents</th>
									</tr>
							  </thead>
							  <tbody>
							  @foreach(Cart::instance('Ordered_Bqt')->content() as $Bqt)
							    <tr>
							      <th scope="row">BQT-{{$Bqt->id}}</th>
							      <td>Php {{number_format($Bqt->price,2)}}</td>
							      <td>{{$Bqt->qty}}</td>
							      <td>Php {{Number_format($Bqt->qty * $Bqt->price,2)}}</td>
							      <td>
									<table class="table table-bordered" style="overflow-x:auto;">
                                       <thead>
	                                    	<th class="text-center">Item ID</th>
	                                    	<th class="text-center">Item Name</th>
	                                    	<th class="text-center">Image</th>
	                                    	<th class="text-center">Price</th>
	                                    	<th class="text-center">Qty</th>
	                                    	<th class="text-center">Total Price</th>
		                                </thead>
                                   		<tbody>
                                 @foreach(Cart::instance('FinalBqt_Flowers')->content() as $row1)
                                	@if($Bqt->id == $row1 -> options -> bqt_ID)
	                            		<tr>
	                            			<th scope="row">{{$row1 -> id}}</th>
	                              			<td>{{ $row1 -> name}}</td>
	                              			<td><img class="img-rounded img-raised img-responsive" style="min-width: 40px; max-height: 40px;" src="{{ asset('flowerimage/'.$row1->options['image'])}}">
	                              			</td>
	                              			<td>Php {{ $row1 -> price}}</td>
	                              			<td>{{ $row1 -> qty}}</td>
	                              			<td>Php {{Number_format($row1 -> price * $row1 -> qty,2)}}</td>
	                               		</tr>
                              	 	@endif
                                 @endforeach
                                 @foreach(Cart::instance('FinalBqt_Acessories')->content() as $row2)
                             		@if($Bqt->id == $row2 -> options -> bqt_ID)
	                             		<tr>
	                          				<th scope="row">{{$row2 -> id}}</th>
	                            			<td>{{ $row2 -> name}}</td>
	                            			<td><img class="img-rounded img-raised img-responsive" style="min-width: 40px; max-height: 40px;" src="{{ asset('accimage/'.$row2->options['image'])}}">
	                            			</td>
	                            			<td>Php {{ Number_format($row2 -> price,2)}}</td>
	                            			<td>{{ $row2 -> qty}}</td>
	                            			<td>Php {{ Number_format($row2 -> price * $row2 -> qty,2)}}</td>
	                            		</tr>
                            		@endif
                              @endforeach
                                </tbody>

                                </table>

							      </td>
							    </tr>
							    @endforeach
							  </tbody>
							</table>
						</div>
						<div class="col-md-4 col-md-offset-7">
							<h7 style = "color:darkviolet;"><b>(Bouquet) Total: Php {{Cart::instance('Ordered_Bqt')->subtotal()}}</b></h7>
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
					<div id = "Customer_DetailsDiv">
						<div class="panel-body">
							<h5 class="text-center">Customer Details</h5>
							<div class="togglebutton col-md-6">
								<label>
							    	<input type="checkbox" checked="">
									One Time Customer?
								</label>
							</div>

							<div class="col-md-4 dropdown" style="margin-left: -5%;">
								<a href="#" class="btn btn-simple dropdown-toggle" data-toggle="dropdown">
							    	Choose Customer
							    	<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li><a href="#">...</a></li>
									<li><a href="#">...</a></li>
									<li><a href="#">...</a></li>
								</ul>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group label-floating">
										<label class="control-label">First Name</label>
										<input type="email" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group label-floating">
										<label class="control-label">Last Name</label>
										<input type="email" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group label-floating">
										<label class="control-label">Contact No</label>
										<input type="email" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group label-floating">
										<label class="control-label">Email Address</label>
										<input type="email" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group label-floating">
										<label class="control-label">Address Line</label>
										<input type="email" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group label-floating">
										<label class="control-label">Baranggay</label>
										<input type="email" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<a href="#" class="btn btn-simple dropdown-toggle" data-toggle="dropdown">
							    	Province
							    	<b class="caret"></b>
									</a>
									<ul class="dropdown-menu">
										<li><a href="#">...</a></li>
										<li><a href="#">...</a></li>
										<li><a href="#">...</a></li>
									</ul>
								</div>
								<div class="col-md-6">
									<a href="#" class="btn btn-simple dropdown-toggle" data-toggle="dropdown">
							    	City
							    	<b class="caret"></b>
									</a>
									<ul class="dropdown-menu">
										<li><a href="#">...</a></li>
										<li><a href="#">...</a></li>
										<li><a href="#">...</a></li>
									</ul>
								</div>
							</div>
						<div class="pull-right">
							<button id = "Cust_Det_NextBtn" type="button" class="btn btn-sm Lemon"> Next</button>
						</div>
						</div>

					</div><!--Customer Detais Div-->

					<!-- start of Shipping method div-->
					<div id = "ShippingMethod_Div" hidden>
						<div class="panel-body">
							<h5 class="text-center">Shipping Method</h5>
							<div class = "row">
								<div class="col-md-6">
									<label>
								    	<div class="radio">
											<label>
												<input type="radio" name="optionsRadios" id = "PickUp_Rdo">
												Pick Up
											</label>
										</div>
									</label>
								</div>
								<div class="col-md-6">
									<label>
								    	<div class="radio">
											<label>
												<input type="radio" name="optionsRadios"  id = "Delivery_Rdo">
												Delivery
											</label>
										</div>
									</label>
								</div>
							</div>
							<div id = "pickUp_Div" hidden>
								<div class = "row">
									<div class="col-md-6">
										<h5>Date of Pickup</h5>
										<input class="form-control" type="date"/>
									</div>
									<div class="col-md-6">
										<h5>Time of Pickup</h5>
									</div>
								</div>
								<div class = "pull-right">
									<a id = "" type="button" class="btn btn-sm Love"> Back</a>
									<a id = "Ship_PickUp_NextBtn" href="" type="button" class="btn btn-sm Lemon"> Next</a>
								</div>
							</div>
							<div id = "Delivery_Div" hidden>
								<h6><b>Recipient Information</b></h6>
									<div class="checkbox">
										<label>
											<input type="checkbox" name="optionsCheckboxes">
											Use Customer's Details
										</label>
									</div>
									<div id = "existing_Cust_Div">

									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group label-floating">
												<label class="control-label">First Name</label>
												<input type="email" class="form-control">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group label-floating">
												<label class="control-label">Last Name</label>
												<input type="email" class="form-control">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group label-floating">
												<label class="control-label">Contact No</label>
												<input type="email" class="form-control">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group label-floating">
												<label class="control-label">Email Address</label>
												<input type="email" class="form-control">
											</div>
										</div>
									</div>
									<h6><b>Delivery Details</b></h6>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group label-floating">
												<label class="control-label">Address Line</label>
												<input type="email" class="form-control">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group label-floating">
												<label class="control-label">Baranggay</label>
												<input type="email" class="form-control">
											</div>
										</div>
										<div class="col-md-6">
											<a href="#" class="btn btn-simple dropdown-toggle" data-toggle="dropdown">
									    	Province
									    	<b class="caret"></b>
											</a>
											<ul class="dropdown-menu">
												<li><a href="#">...</a></li>
												<li><a href="#">...</a></li>
												<li><a href="#">...</a></li>
											</ul>
										</div>
										<div class="col-md-6">
											<a href="#" class="btn btn-simple dropdown-toggle" data-toggle="dropdown">
									    	City
									    	<b class="caret"></b>
											</a>
											<ul class="dropdown-menu">
												<li><a href="#">...</a></li>
												<li><a href="#">...</a></li>
												<li><a href="#">...</a></li>
											</ul>
										</div>
									</div>
									<h6><b>Delivery Date</b></h6>
									<div class="row">
										<div class="col-md-6">
											<h5>Date of Pickup</h5>
											<input class="datepicker form-control" type="text" value="03/12/2016"/>
										</div>
										<div class="col-md-6">
											<h5>Time of Pickup</h5>
										</div>
									</div>
								<div class = "pull-right">
									<a type="button" class="btn btn-sm Love"> Back</a>
									<a id = "Ship_Delivery_NextBtn" href="" type="button" class="btn btn-sm Lemon"> Next</a>
								</div>
								</div>
							</div><!-- end of shipping method div-->
						</div>

					</div><!--Customer Detais Div-->


				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')

  <script type="text/javascript">
      $(function () {
        $("#example2").DataTable();
        $('#BouqTable').DataTable({
          "paging": true,
          "info": true,
          "autoWidth": true
        });
        $('#flowersTable').DataTable({
          "paging": true,
          "info": true,
          "autoWidth": true
        });
        $('#cancelledtable').DataTable({
          "paging": true,
          "info": true,
          "autoWidth": false
        });
      });
  </script>

  <script>
  $('document').ready(function(){
  	$("#Cust_Det_NextBtn").click(function(){
				//alert('hello');
	  		$("#Customer_DetailsDiv").hide("fold");
	  		$("#ShippingMethod_Div").show("fold");
	  	});

		$("#PickUp_Rdo").click(function(){
			$('#pickUp_Div').show("fold");
			$('#Delivery_Div').hide("fold");
		});

		$("#Delivery_Rdo").click(function(){
			$('#pickUp_Div').hide("fold");
			$('#Delivery_Div').show("fold");
		});



	});//end of document ready
  </script>

@endsection
