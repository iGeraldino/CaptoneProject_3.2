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
							<div class="togglebutton">
								<label>
							    	<input type="checkbox" id = 'OnetimecheckBox' name="OnetimecheckBox">
									One Time Customer?
								</label>
							</div>

							<div hidden>
							<input id = "Trans_typeField" name = "Trans_typeField" value = 'process' />
							<input id = "customer_stat" name = "customer_stat" value = 'old' />
							<input id = "current_Date" name = "current_Date" type = "date" />
							<input id = "current_Time" name = "current_Time" type = "time" />
						 </div>

							<div id = "Customer_Chooser">
								<input class = "form-control"  name="customerList_ID" list="customerList_ID" placeholder="Select Existing Customers"/>
								<datalist id="customerList_ID">
									<!--Foreach Loop data Here value = "Name" data-tag = "id"-->
									@foreach($cust as $Cdetails)
								    <option value="{{$Cdetails->Cust_FName}} {{$Cdetails->Cust_MName}} {{$Cdetails->Cust_LName}}" data-tag = "{{$Cdetails->Cust_ID}}">
									@endforeach
									<!--Loop data Here-->
								</datalist>
							</div>

							<div id = 'Customer_FNameDiv' hidden>
								<select id = 'customerList_FName' name = 'customerList_FName' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
									@foreach($cust as $Cdetails)
										<option value = '{{$Cdetails->Cust_FName}}' data-tag ='{{$Cdetails->Cust_ID}}'>
										{{$Cdetails->Cust_FName}}
										</option>
									@endforeach
								</select>
							</div>

							<div id = 'Customer_MNameDiv' hidden>
								<select id = 'customerList_MName' name = 'customerList_MName' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
									@foreach($cust as $Cdetails)
										<option value = '{{$Cdetails->Cust_MName}}' data-tag ='{{$Cdetails->Cust_ID}}'>
										{{$Cdetails->Cust_MName}}
										</option>
									@endforeach
								</select>
							</div>

							<div id = 'Customer_LNameDiv' hidden>
								<select id = 'customerList_LName' name = 'customerList_LName' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
									@foreach($cust as $Cdetails)
										<option value = '{{$Cdetails->Cust_LName}}' data-tag ='{{$Cdetails->Cust_ID}}'>
										{{$Cdetails->Cust_LName}}
										</option>
									@endforeach
								</select>
							</div>

							<div id = 'Contact_NumDiv' hidden>
								<select id = 'Contact_NumList_LName' name = 'Contact_NumList_LName' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
									@foreach($cust as $Cdetails)
										<option value = '{{$Cdetails->Contact_Num}}' data-tag ='{{$Cdetails->Cust_ID}}'>
										 {{$Cdetails->Contact_Num}}
										</option>
									@endforeach
								</select>
							</div>

							<div id = 'type_Div' hidden>
								<select id = 'TypeList' name = 'TypeList' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
									@foreach($cust as $Cdetails)
										<option value = '{{$Cdetails->Customer_Type}}' data-tag ='{{$Cdetails->Cust_ID}}'>
										 {{$Cdetails->Customer_Type}}
										</option>
									@endforeach
								</select>
							</div>

							<div id = 'Email_AddDiv' hidden>
								<select id = 'Email_AddList_LName' name = 'Email_AddList_LName' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
									@foreach($cust as $Cdetails)
										<option value = '{{$Cdetails->Email_Address}}' data-tag ='{{$Cdetails->Cust_ID}}'>
										 {{$Cdetails->Email_Address}}
										</option>
									@endforeach
								</select>
							</div>

							<div id = 'AdressLine_Div' hidden>
								<select id = 'AdressLineList' name = 'AdressLineList' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
									@foreach($cust as $Cdetails)
										<option value = '{{$Cdetails->Address_Line}}' data-tag ='{{$Cdetails->Cust_ID}}'>
										 {{$Cdetails->Address_Line}}
										</option>
									@endforeach
								</select>

								<select id = 'HotelNameList' name = 'HotelNameList' class = 'btn btn-primary btn-md'>
									@foreach($cust as $Cdetails)
										<option value = '{{$Cdetails->Hotel_Name}}' data-tag ='{{$Cdetails->Cust_ID}}'>
										 {{$Cdetails->Hotel_Name}}
										</option>
									@endforeach
								</select>

								<select id = 'ShopNameList' name = 'ShopNameList' class = 'btn btn-primary btn-md'>
									@foreach($cust as $Cdetails)
										<option value = '{{$Cdetails->Shop_Name}}' data-tag ='{{$Cdetails->Cust_ID}}'>
										 {{$Cdetails->Shop_Name}}
										</option>
									@endforeach
								</select>

								<select id = 'BrgyList' name = 'BrgyList' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
									@foreach($cust as $Cdetails)
										<option value = '{{$Cdetails->Baranggay}}' data-tag ='{{$Cdetails->Cust_ID}}'>
										 {{$Cdetails->Baranggay}}
										</option>
									@endforeach
								</select>

							<div class = 'col-md-6'>
								<select class="form-control" name ="ProvField" id ="ProvField" >
									@foreach($cust as $Cdetails)
										<option value ="{{$Cdetails->Province}}" data-tag = "{{$Cdetails->Cust_ID}}"> {{$Cdetails->Province}} </option>
									@endforeach
								</select>
							</div>

							<div class = 'col-md-6'>
								<select name="CityField" id="CityField" class="form-control" disabled>
									@foreach($cust as $Cdetails)
										<option value ="{{$Cdetails->Town}}" data-tag = "{{$Cdetails->Cust_ID}}"> {{$Cdetails->Town}} </option>
									@endforeach
								</select>
							</div>
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
									<a id = "Shipping_PickUp_BackBtn" type="button" class="btn btn-sm Love"> Back</a>
									<a id = "Ship_PickUp_NextBtn" type="button" class="btn btn-sm Lemon"> Next</a>
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
									<a id = "Shipping_Delivery_BackBtn" type="button" class="btn btn-sm Love"> Back</a>
									<a id = "Ship_Delivery_NextBtn" type="button" class="btn btn-sm Lemon"> Next</a>
								</div>
								</div>
							</div>
						</div><!-- end of shipping method div-->
						<!---start of pickup Payment method div-->
							<div id = "PickUp_Payment_MethodDiv" hidden>
									<div class="panel-body">
										Pickup
										<h5 class="text-center">Payment Method</h5>
										<div class="col-md-6">
											<label>
										    	<div class="radio">
													<label>
														<input type="radio" name="optionsRadios" checked="true" id = "PickUpCashRdo">
														Cash
													</label>
												</div>
											</label>
										</div>
										<div class="col-md-6">
											<label>
										    	<div class="radio">
													<label>
														<input type="radio" name="optionsRadios" id = "PickUpBankRdo">
														Bank
													</label>
												</div>
											</label>
										</div>
									</div>
									<div id = "Pickup_cashDetails_Div" hidden>
										<h6><b>Method Details</b></h6>
										<textarea class="form-control" placeholder="Details" rows="3">Cash Pickup</textarea>
										<div class="panel-footer">
											<a id = "paymentMethod_PickUpCashBackBtn" type="button" class="btn btn-sm Love"> Back</a>
											<a id = "process_PickUpCashBtn"  data-toggle="modal" data-target="#cashmodal" class="btn btn-sm Lemon"> Process</a>
										</div>
									</div>
									<div id = "Pickup_BankDetails_Div" hidden>
										<h6><b>Method Details</b></h6>
										<textarea class="form-control" placeholder="Details" rows="3">bank Pickup</textarea>
										<div class="panel-footer">
											<a id = "paymentMethod_PickUpBankBackBtn" type="button" class="btn btn-sm Love"> Back</a>
											<a id = "process_PickUpBankBtn" data-toggle="modal" data-target="#cashmodal" class="btn btn-sm Lemon"> Process</a>
										</div>
									</div>
									<div id = "Pickup_PayLaterDetails_Div" hidden>
										<h6><b>Method Details</b></h6>
										<textarea class="form-control" placeholder="Details" rows="3">PayLater Pickup</textarea>
										<div class="panel-footer">
											<a id = "paymentMethod_PickUpPayLaterBackBtn" type="button" class="btn btn-sm Love"> Back</a>
											<a id = "process_PickUpPayLaterBtn" data-toggle="modal" data-target="#cashmodal" class="btn btn-sm Lemon"> Process</a>
										</div>
									</div>
							</div>
							<!---start of Delivery Payment method div-->
							<div id = "Delivery_Payment_MethodDiv" hidden>
									<div class="panel-body">
										delivery
										<h5 class="text-center">Payment Method</h5>
										<div class="col-md-6">
											<label>
										    	<div class="radio">
													<label>
														<input type="radio" name="optionsRadios" id = "DeliveryCashRdo">
														Cash
													</label>
												</div>
											</label>
										</div>
										<div class="col-md-6">
											<label>
										    	<div class="radio">
													<label>
														<input type="radio" name="optionsRadios" id = "DeliveryBankRdo">
														Bank
													</label>
												</div>
											</label>
										</div>
									</div>
									<div id = "Delivery_cashDetails_Div" hidden>
										<h6><b>Method Details</b></h6>
										<textarea class="form-control" placeholder="Details" rows="3">Cash Delivery</textarea>
										<div class="panel-footer">
											<a id = "paymentMethod_DeliveryCashBackBtn" type="button" class="btn btn-sm Love"> Back</a>
											<a id = "process_DeliveryCashBtn" data-toggle="modal" data-target="#cashmodal" class="btn btn-sm Lemon"> Process</a>
										</div>
									</div>
									<div id = "Delivery_bankDetails_Div" hidden>
										<h6><b>Method Details</b></h6>
										<textarea class="form-control" placeholder="Details" rows="3">Bank Delivery</textarea>
										<div class="panel-footer">
											<a id = "paymentMethod_DeliveryBankBackBtn" type="button" class="btn btn-sm Love"> Back</a>
											<a id = "process_DeliveryCashBtn" data-toggle="modal" data-target="#cashmodal" class="btn btn-sm Lemon"> Process</a>
										</div>
									</div>
									<div id = "Delivery_PayLaterDetails_Div" hidden>
										<h6><b>Method Details</b></h6>
										<textarea class="form-control" placeholder="Details" rows="3">PayLater Delivery</textarea>
										<div class="panel-footer">
											<a id = "paymentMethod_DeliveryPayLaterBackBtn" type="button" class="btn btn-sm Love"> Back</a>
											<a id = "process_DeliveryCashBtn" data-toggle="modal" data-target="#payLatermodal" class="btn btn-sm Lemon"> Process</a>
										</div>
									</div>
							</div>
						</div><!--Payment Method Div-->
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
	  		$("#Customer_DetailsDiv").hide("fold");//closes the current step the proceeds to the next step
			//resets the radio buttons
				$("#PickUp_Rdo").attr('checked',false);
				$('#Delivery_Rdo').attr('checked',false);
			//close the open forms incase they are open
				$('#pickUp_Div').hide("fold");
				$('#Delivery_Div').hide("fold");
	  		$("#ShippingMethod_Div").show("fold");
	  	});
//once that you are at the shipping method there are 2 choices:
//Pickup--------------------------------------------------------------------------------------------------------------
		$("#PickUp_Rdo").click(function(){
			$('#pickUp_Div').show("fold");
			$('#Delivery_Div').hide("fold");
		});

		//nextButton of pickup
		$("#Ship_PickUp_NextBtn").click(function(){
			$("#ShippingMethod_Div").hide("fold");//close this step then proceeds to the next step
		//close the open forms incase they are open
			$("#Delivery_cashDetails_Div").hide();
			$("#Delivery_bankDetails_Div").hide();
			$("#Delivery_PayLaterDetails_Div").hide();
			$('#Delivery_Payment_MethodDiv').hide("fold");//hides the delivery payment method incase it's open
		//close the open forms incase they are open
			$("#Pickup_cashDetails_Div").hide();
			$("#Pickup_BankDetails_Div").hide();
			$("#Pickup_PayLaterDetails_Div").hide();
			$('#PickUp_Payment_MethodDiv').show("fold");
		});

		//backButton of pickup
		$("#Shipping_PickUp_BackBtn").click(function(){
			$("#ShippingMethod_Div").hide("fold");
			$("#Customer_DetailsDiv").show("fold");
		});

	//Pickup Payment Method:-----------------------------------------------------------------------------------------------
		//PickUp Cash method
				$("#PickUpCashRdo").click(function(){//Cash Radio Button
					$("#Pickup_BankDetails_Div").hide("fold");
					$("#Pickup_PayLaterDetails_Div").hide("fold");
					$("#Pickup_cashDetails_Div").show("fold");
				});

				$("#paymentMethod_PickUpCashBackBtn").click(function(){
					$('#PickUp_Payment_MethodDiv').hide("fold");
					$("#PickUp_Rdo").attr('checked',false);
					$('#Delivery_Rdo').attr('checked',false);
					$('#pickUp_Div').hide("fold");
					$('#Delivery_Div').hide("fold");
					$('#ShippingMethod_Div').show("fold");
				});

		//PickUp bank Method
				$("#PickUpBankRdo").click(function(){//bank Radio Button
					$("#Pickup_cashDetails_Div").hide("fold");
					$("#Pickup_PayLaterDetails_Div").hide("fold");
					$("#Pickup_BankDetails_Div").show("fold");
				});

				$("#paymentMethod_PickUpBankBackBtn").click(function(){
					$('#PickUp_Payment_MethodDiv').hide("fold");
					$("#PickUp_Rdo").attr('checked',false);
					$('#Delivery_Rdo').attr('checked',false);
					$('#pickUp_Div').hide("fold");
					$('#Delivery_Div').hide("fold");
					$('#ShippingMethod_Div').show("fold");
				});

		//PickUp Pay Later Method
		//PayLater Radio Button
				$("#paymentMethod_PickUpPayLaterBackBtn").click(function(){
					$('#PickUp_Payment_MethodDiv').hide("fold");
					$("#PickUp_Rdo").attr('checked',false);
					$('#Delivery_Rdo').attr('checked',false);
					$('#pickUp_Div').hide("fold");
					$('#Delivery_Div').hide("fold");
					$('#ShippingMethod_Div').show("fold");
				});


//Delivery---------------------------------------------------------------------------------------------------------------
		$("#Delivery_Rdo").click(function(){
			$('#pickUp_Div').hide("fold");
			$('#Delivery_Div').show("fold");
		});
		//nextButton of pickup
		$("#Ship_Delivery_NextBtn").click(function(){
			$("#ShippingMethod_Div").hide("fold");//close this step then proceeds to the next step
		//close the open forms incase they are open
			$("#Pickup_cashDetails_Div").hide();
			$("#Pickup_BankDetails_Div").hide();
			$("#Pickup_PayLaterDetails_Div").hide();
			$('#PickUp_Payment_MethodDiv').hide("fold");//hides the pickup payment method incase it's open
		//close the open forms incase they are open
			$("#Delivery_cashDetails_Div").hide();
			$("#Delivery_bankDetails_Div").hide();
			$("#Delivery_PayLaterDetails_Div").hide();
			$('#Delivery_Payment_MethodDiv').show("fold");
		});

		//backButton of Delivery
		$("#Shipping_Delivery_BackBtn").click(function(){
			$("#ShippingMethod_Div").hide("fold");
			$("#Customer_DetailsDiv").show("fold");
		});


			//Delivery Payment Method:-----------------------------------------------------------------------------------------------
				//Delivery Cash method
						$("#DeliveryCashRdo").click(function(){//Cash Radio Button
							$("#Delivery_bankDetails_Div").hide("fold");
							$("#Delivery_PayLaterDetails_Div").hide("fold");
							$("#Delivery_cashDetails_Div").show("fold");
						});

						$("#paymentMethod_DeliveryCashBackBtn").click(function(){
							$('#Delivery_Payment_MethodDiv').hide("fold");
							$("#PickUp_Rdo").attr('checked',false);
							$('#Delivery_Rdo').attr('checked',false);
							$('#pickUp_Div').hide("fold");
							$('#Delivery_Div').hide("fold");
							$('#ShippingMethod_Div').show("fold");
						});

				//Delivery bank Method
						$("#DeliveryBankRdo").click(function(){//bank Radio Button
							$("#Delivery_cashDetails_Div").hide("fold");
							$("#Delivery_PayLaterDetails_Div").hide("fold");
							$("#Delivery_bankDetails_Div").show("fold");
						});

						$("#paymentMethod_DeliveryBankBackBtn").click(function(){
							$('#Delivery_Payment_MethodDiv').hide("fold");
							$("#PickUp_Rdo").attr('checked',false);
							$('#Delivery_Rdo').attr('checked',false);
							$('#pickUp_Div').hide("fold");
							$('#Delivery_Div').hide("fold");
							$('#ShippingMethod_Div').show("fold");
						});

				//Delivery Pay Later Method
				//PayLater Radio Button
						$("#paymentMethod_PickUpPayLaterBackBtn").click(function(){
							$('#Delivery_Payment_MethodDiv').hide("fold");
							$("#PickUp_Rdo").attr('checked',false);
							$('#Delivery_Rdo').attr('checked',false);
							$('#pickUp_Div').hide("fold");
							$('#Delivery_Div').hide("fold");
							$('#ShippingMethod_Div').show("fold");
						});


	});//end of document ready
  </script>

@endsection
