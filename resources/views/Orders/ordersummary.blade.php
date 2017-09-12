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
						<form id = "Customer_details_Form" name = "Customer_details_Form">
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
						 </div>

							<div id = "Customer_Chooser">
								<input id = "customerList_Field" class = "form-control"  name="customerList_ID" list="customerList_ID" placeholder="Enter Customer ID/ "/>
								<datalist id="customerList_ID">
									<!--Foreach Loop data Here value = "Name" data-tag = "id"-->
									@foreach($cust as $Cdetails)
								    <option value="CUST_{{$Cdetails->Cust_ID}}" data-id = "{{$Cdetails->Cust_ID}}">
											({{$Cdetails->Cust_FName}} {{$Cdetails->Cust_MName}} {{$Cdetails->Cust_LName}})
										</option>
									@endforeach
									<!--Loop data Here-->
								</datalist>
							</div>

							<div id = 'Customer_TradeDiv' hidden>
								<select id = 'TradeList' name = 'TradeList' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
									@foreach($CustTradeAgreements as $CTrade)
										<option value = 'CUST_{{$CTrade->Customer_ID}}' data-tag ='{{$CTrade->Agreement_ID}}'>
										{{$CTrade->Customer_ID}}
										</option>
									@endforeach
								</select>
							</div>

							<div id = 'Customer_FNameDiv' hidden>
								<select id = 'customerList_FName' name = 'customerList_FName' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
									@foreach($cust as $Cdetails)
										<option value = '{{$Cdetails->Cust_FName}}' data-tag ='CUST_{{$Cdetails->Cust_ID}}'>
										{{$Cdetails->Cust_FName}}
										</option>
									@endforeach
								</select>
							</div>

							<div id = 'Customer_MNameDiv' hidden>
								<select id = 'customerList_MName' name = 'customerList_MName' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
									@foreach($cust as $Cdetails)
										<option value = '{{$Cdetails->Cust_MName}}' data-tag ='CUST_{{$Cdetails->Cust_ID}}'>
										{{$Cdetails->Cust_MName}}
										</option>
									@endforeach
								</select>
							</div>

							<div id = 'Customer_LNameDiv' hidden>
								<select id = 'customerList_LName' name = 'customerList_LName' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
									@foreach($cust as $Cdetails)
										<option value = '{{$Cdetails->Cust_LName}}' data-tag ='CUST_{{$Cdetails->Cust_ID}}'>
										{{$Cdetails->Cust_LName}}
										</option>
									@endforeach
								</select>
							</div>

							<div id = 'Contact_NumDiv' hidden>
								<select id = 'Contact_NumList_LName' name = 'Contact_NumList_LName' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
									@foreach($cust as $Cdetails)
										<option value = '{{$Cdetails->Contact_Num}}' data-tag ='CUST_{{$Cdetails->Cust_ID}}'>
										 {{$Cdetails->Contact_Num}}
										</option>
									@endforeach
								</select>
							</div>

							<div id = 'type_Div' hidden>
								<select id = 'TypeList' name = 'TypeList' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
									@foreach($cust as $Cdetails)
										<option value = '{{$Cdetails->Customer_Type}}' data-tag ='CUST_{{$Cdetails->Cust_ID}}'>
										 {{$Cdetails->Customer_Type}}
										</option>
									@endforeach
								</select>
							</div>

							<div id = 'Email_AddDiv' hidden>
								<select id = 'Email_AddList_LName' name = 'Email_AddList_LName' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
									@foreach($cust as $Cdetails)
										<option value = '{{$Cdetails->Email_Address}}' data-tag ='CUST_{{$Cdetails->Cust_ID}}'>
										 {{$Cdetails->Email_Address}}
										</option>
									@endforeach
								</select>
							</div>

							<div id = 'AdressLine_Div' hidden>
								<select id = 'AdressLineList' name = 'AdressLineList' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
									@foreach($cust as $Cdetails)
										<option value = '{{$Cdetails->Address_Line}}' data-tag ='CUST_{{$Cdetails->Cust_ID}}'>
										 {{$Cdetails->Address_Line}}
										</option>
									@endforeach
								</select>

								<select id = 'HotelNameList' name = 'HotelNameList' class = 'btn btn-primary btn-md'>
									@foreach($cust as $Cdetails)
										<option value = '{{$Cdetails->Hotel_Name}}' data-tag ='CUST_{{$Cdetails->Cust_ID}}'>
										 {{$Cdetails->Hotel_Name}}
										</option>
									@endforeach
								</select>

								<select id = 'ShopNameList' name = 'ShopNameList' class = 'btn btn-primary btn-md'>
									@foreach($cust as $Cdetails)
										<option value = '{{$Cdetails->Shop_Name}}' data-tag ='CUST_{{$Cdetails->Cust_ID}}'>
										 {{$Cdetails->Shop_Name}}
										</option>
									@endforeach
								</select>

								<select id = 'BrgyList' name = 'BrgyList' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
									@foreach($cust as $Cdetails)
										<option value = '{{$Cdetails->Baranggay}}' data-tag ='CUST_{{$Cdetails->Cust_ID}}'>
										 {{$Cdetails->Baranggay}}
										</option>
									@endforeach
								</select>

							<div class = 'col-md-6'>
								<select class="form-control" name ="ProvField" id ="ProvField" >
									@foreach($cust as $Cdetails)
										<option value ="{{$Cdetails->Province}}" data-tag = "CUST_{{$Cdetails->Cust_ID}}"> {{$Cdetails->Province}} </option>
									@endforeach
								</select>
							</div>

							<div class = 'col-md-6'>
								<select name="CityField" id="CityField" class="form-control" disabled>
									@foreach($cust as $Cdetails)
										<option value ="{{$Cdetails->Town}}" data-tag = "CUST_{{$Cdetails->Cust_ID}}"> {{$Cdetails->Town}} </option>
									@endforeach
								</select>
							</div>
							</div>

							<div hidden>
								<input id = 'idfield' name = 'idfield' class = 'form-control'>
							</div>

							<div class="row">
								<div class="col-md-4">
									<div id = "Fnamedisplaydiv" class="form-group label-floating">
										<label class="control-label">First Name</label>
										<input type="text" class="form-control" name="Cust_FNameField" id="Cust_FNameField" disabled required>
									</div>
								</div>
								<div class="col-md-4">
									<div id = "Mnamedisplaydiv" class="form-group label-floating">
										<label class="control-label">Middle Name</label>
										<input type="text" class="form-control" name="Cust_MNameField" id="Cust_MNameField">
									</div>
								</div>
								<div class="col-md-4">
									<div id = "Lnamedisplaydiv" class="form-group label-floating">
										<label class="control-label">Last Name</label>
										<input type="text" class="form-control" name="Cust_LNameField" id="Cust_LNameField" disabled required>
									</div>
								</div>
							</div>
							<div class = "row">
                <div class="col-sm-4">
                    <div id = "Contactdisplaydiv" class="form-group label-floating">
                      <label class="control-label">Number</label>
                      <input type="text" class="form-control" name="ContactNum_Field" id="ContactNum_Field" required/>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div id = "emailDisplayDiv" class="form-group label-floating">
                      <label class="control-label">Email Address</label>
                      <input type="text" class="form-control" name="email_Field" id="email_Field"  required/>
                    </div>
                </div><!--end of column-->

                <div class="form-group col-sm-12">
                    <label class="control-label">Customer Type:</label>
                      <select class="form-control" names ="custTypeField" id ="custTypeField">
                          <option value ="C" > Single </option>
                          <option value ="S" > Shop </option>
                          <option value ="H" > Hotel </option>
                      </select>
                </div><!--end of column-->

	              <div id = "HotelNamedisplaydiv" class = "row" hidden>
	                <div  class="form-group col-md-7">
	                      <label class="control-label">Hotel Name</label>
	                      <input type="text" class="form-control" name="hotelNameField" id="hotelNameField" disabled/>
	                </div>
	              </div><!--end of row-->

	              <div id = "ShopNamedisplaydiv" class = "row" hidden>
	                <div  class="form-group col-md-7">
	                      <label class="control-label">Shop Name</label>
	                      <input type="text" class="form-control" name="shopNameField" id="shopNameField" disabled/>
	                </div>
	              </div><!--end of row-->

								<div class = "row">
	                <div class="col-sm-7">
	                    <div id = "AdrLinedisplaydiv" class="form-group label-floating">
	                      <label class="control-label">Address line</label>
	                      <input type="text" class="form-control" name="Addrs_LineField" id="Addrs_LineField" required/>
	                    </div>
	                </div>

	                <div class="col-sm-5">
	                    <div id = "Brgydisplaydiv" class="form-group label-floating">
	                      <label class="control-label">Baranggay</label>
	                      <input type="text" class="form-control" name="brgyField" id="brgyField" required/>
	                    </div>
	                </div>
	              </div><!--end of row-->

								<div class = "row">
	                <div class = 'col-md-6'>
	                  <select class="form-control" name ="ProvinceField" id ="ProvinceField">
	                    @foreach($province as $prov)
	                      <option value ="{{$prov->id}}" data-tag = "{{$prov->name}}"> {{$prov->name}} </option>
	                    @endforeach
	                  </select>
	                </div>

	                <div class = 'col-md-6'>
	                  <select name="TownField" id="TownField" class="form-control" disabled>
	                    @foreach($city as $city)
	                      <option value ="{{$city->id}}" data-tag = "{{$city->province_id}}"> {{$city->name}} </option>
	                    @endforeach
	                  </select>
	                </div>

	                <div class = 'col-md-6' hidden>
	                  <select name="TownField2" id="TownField2" class="form-control">
	                    @foreach($city2 as $city2)
	                      <option value ="{{$city2->id}}" data-tag = "{{$city2->province_id}}"> {{$city2->name}} </option>
	                    @endforeach
	                  </select>
	                </div>
	              </div><!--end of row-->

						<div class="pull-right">
							<button id = "Cust_Det_NextBtn" type="submit" class="btn btn-sm Lemon" disabled> Next</button>
						</div>
						</div>
					 </div>
				 </form>
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
										<input id = "PickupDate_Field" class="form-control" type="date" min = "<?php  ?>"/>
									</div>
									<div class="col-md-6">
										<h5>Time of Pickup</h5>
										<input id = "PickupTime_Field" class="form-control" type="time"/>
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
											<input type="checkbox" name="optionsCheckboxes" id = "UseCust_detBtn">
											Use Customer's Details
										</label>
									</div>
									<div id = "existing_Cust_Div">

									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group label-floating">
												<label class="control-label">First Name</label>
												<input id = "Dlvry_Fname_Field" type="text" class="form-control">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group label-floating">
												<label class="control-label">Middle Name</label>
												<input id = "Dlvry_Mname_Field" type="text" class="form-control">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group label-floating">
												<label class="control-label">Last Name</label>
												<input id = "Dlvry_Lname_Field" type="text" class="form-control">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group label-floating">
												<label class="control-label">Contact No</label>
												<input id = "Dlvry_ContactNum_Field" type="text" class="form-control">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group label-floating">
												<label class="control-label">Email Address</label>
												<input id = "Dlvry_Email_Field" type="email" class="form-control">
											</div>
										</div>
									</div>
									<h6><b>Delivery Details</b></h6>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group label-floating">
												<label class="control-label">Address Line</label>
												<input id = "Dlvry_AdrsLine_Field" type="text" class="form-control">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group label-floating">
												<label class="control-label">Baranggay</label>
												<input id = "Dlvry_Brgy_Field" type="text" class="form-control">
											</div>
										</div>
										<div class = 'col-md-6'>
		                  <select class="form-control" name ="Del_ProvinceField" id ="Del_ProvinceField">
												@foreach($provinces as $prov)
		                      <option value ="{{$prov->id}}" data-tag = "{{$prov->name}}"> {{$prov->name}} </option>
		                    @endforeach
		                  </select>
		                </div>

		                <div class = 'col-md-6'>
		                  <select name="Del_TownField" id="Del_TownField" class="form-control" disabled>
		                    @foreach($cities as $city)
		                      <option value ="{{$city->id}}" data-tag = "{{$city->province_id}}"> {{$city->name}} </option>
		                    @endforeach
		                  </select>
		                </div>
									</div>
									<h6><b>Delivery Date</b></h6>
									<div class="row">
										<div class="col-md-6">
											<h5>Date of Pickup</h5>
											<input id = "DeliveryDate_Field" class="datepicker form-control" type="date" />
										</div>
										<div class="col-md-6">
											<h5>Time of Pickup</h5>
											<input id = "DeliveryTime_Field" class = "form-control" type="time"/>
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
						</div><!--end of modal-->
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

			$("#UseCust_detBtn").click(function(){
				if($("#UseCust_detBtn").is(":checked")){
					//alert('I was Checked');
					var Fname = $("#Cust_FNameField").val();
					var Mname = $("#Cust_MNameField").val();
					var Lname = $("#Cust_LNameField").val();
					var ContactNum = $("#ContactNum_Field").val();
					var Email = $("#email_Field").val();
					var Fname = $('#HotelNamedisplaydiv').val();
					$('#ShopNamedisplaydiv').val();
					$("#custTypeField").val();
				}
				else
				{
					//alert('I was Unchecked');
				}
			});

      $('#ProvinceField').change(function(){
        $("#TownField").removeAttr("disabled");
        $("#TownField").attr('required', true);
              var selected = $(this).val();
              $("#TownField option").each(function(item){
               // console.log(selected) ;
                var element =  $(this) ;
                console.log(element.data("tag")) ;
                if (element.data("tag") != selected){
                  element.hide() ;
                }
                else{
                  element.show();
                }
              }) ;

            $("#TownField").val($("#TownField option:visible:first").val());
    });//end of function

   $("#TownField").change(function(){
          var element =  $(this) ;
          var CityLine = $("#TownField").val();

        $("#TownField2 option").each(function(item){
          var element =  $(this) ;
          if (element.val() != CityLine ){
            //element.hide() ;
          }
          else{
            $("#TownField2 option[value = "+CityLine+"]").prop('selected',true);
          }
        });//end of function
   });//end of function


    var newcust = 'old';

		$("#Cust_FNameField").attr('disabled',true);
		$("#Cust_MNameField").attr('disabled',true);
		$("#Cust_LNameField").attr('disabled',true);
		$("#ContactNum_Field").attr('disabled',true);
		$("#email_Field").attr('disabled',true);
		$('#HotelNamedisplaydiv').attr('disabled',true);
		$('#ShopNamedisplaydiv').attr('disabled',true);
		$("#custTypeField").attr('disabled',true);

		var TradeApplication_URL = "{{ url('Order.Apply_CustTradeAgreement') }}";
		var CurrentPrice_URL = "{{ url('Order.Remove_CustTradeAgreement') }}";

		$('#customerList_Field').change(function(){
				var CustID = $("#customerList_Field").val();
				var HaveTrade = 0;
				$('#TradeList option').each(function(item){
					if(CustID == $(this).val()){
						HaveTrade = 1;
						swal('Note:','This Customer seem to have an active Trade Agreement in the shop, if ypu wish to select this customer the amount of all the items that you set will be decreased by 10% from its current selling price','warning');
					}
				});
				var Found = 0;
				$('#customerList_ID option').each(function(item){
				  if(CustID == $(this).val()){
				    Found = 1;
				  }
				});

				if(HaveTrade == 1){
					//pag may trade agreement do this
					$.ajax({
							method: 'GET',
							url: typeof(TradeApplication_URL) != 'undefined' ? TradeApplication_URL : '',
							contentType: "application/json",
							success: function(){
									alert('May Agreements');
							},
							error: function(xhr, desc, err){
									console.log('There is an error:'+ err);
							}
					});
				}
				else if(HaveTrade != 1){
					$.ajax({
							method: 'GET',
							url: typeof(CurrentPrice_URL) != 'undefined' ? CurrentPrice_URL : '',
							contentType: "application/json",
							success: function(){
									alert('Walang Agreements');
							},
							error: function(xhr, desc, err){
									console.log('There is an error:'+ err);
							}
					});
				}

				if(Found == 1){
						$('#Cust_Det_NextBtn').attr("disabled",false);

				    //alert('found');
				    $("#Cust_Det_NextBtn").attr("disabled",false);
				    var selected = $(this).val();
				    var OptionFname;
				    var OptionMname;
				    var OptionLname;
				    var OptionEmail;
				    var OptionContactNum;
				    var OptionAddrLine;
				    var OptionBrgyLine;
				    var OptionProvLine;
				    var OptionCityLine;
				    var OptionTypeLine;
				    var OptionHotelnameLine;
				    var OptionShopnameLine;

				  //this is for outputing the values of fields so that the labels ae not overlapping to the values
				    $('#Fnamedisplaydiv').removeClass("form-group label-floating");
				    $('#Fnamedisplaydiv').addClass("form-group");
				    $('#Mnamedisplaydiv').removeClass("form-group label-floating");
				    $('#Mnamedisplaydiv').addClass("form-group");
				    $('#Lnamedisplaydiv').removeClass("form-group label-floating");
				    $('#Lnamedisplaydiv').addClass("form-group");
				    $('#AdrLinedisplaydiv').removeClass("form-group label-floating");
				    $('#AdrLinedisplaydiv').addClass("form-group");
				    $('#Brgydisplaydiv').removeClass("form-group label-floating");
				    $('#Brgydisplaydiv').addClass("form-group");
				    $('#Contactdisplaydiv').removeClass("form-group label-floating");
				    $('#Contactdisplaydiv').addClass("form-group");
				    $('#emailDisplayDiv').removeClass("form-group label-floating");
				    $('#emailDisplayDiv').addClass("form-group");


				    $("#ShopNameList option").each(function(item){
				      var element =  $(this) ;
				      if (element.data("tag") != selected){
				        //element.hide() ;
				      }
				      else{
				       OptionShopnameLine = element.val();

				        //element.show();
				        console.log(OptionTypeLine)
				      }
				    });//end of function

				    $("#HotelNameList option").each(function(item){
				      var element =  $(this) ;
				      if (element.data("tag") != selected){
				        //element.hide() ;
				      }
				      else{
				       OptionHotelnameLine = element.val();

				        //element.show();
				        console.log(OptionTypeLine)
				      }
				    });//end of function

				    $("#TypeList option").each(function(item){
				      var element =  $(this) ;
				      if (element.data("tag") != selected){
				        //element.hide() ;
				      }
				      else{
				       OptionTypeLine = element.val();
				      }
				    });//end of function

				    $("#custTypeField option").each(function(item){
				      var element =  $(this) ;
				      if (element.val() != OptionTypeLine){
				        //element.hide() ;
				      }
				      else{
				        $("#custTypeField option[value ="+OptionTypeLine+"]").prop('selected',true);
				      }
				    });//end of function

				        if(OptionTypeLine == 'H'){
				          $('#ShopNamedisplaydiv').slideUp();
				          $('#HotelNamedisplaydiv').slideDown();
				        }
				        else if(OptionTypeLine == 'S'){
				          $('#HotelNamedisplaydiv').slideUp();
				          $('#ShopNamedisplaydiv').slideDown();
				        }
				        else if(OptionTypeLine == 'C'){
				          $('#HotelNamedisplaydiv').slideUp();
				          $('#ShopNamedisplaydiv').slideUp();
				        }


				    $("#CityField option").each(function(item){
				      var element =  $(this) ;
				      if (element.data("tag") != selected){
				        //element.hide() ;
				      }
				      else{
				       OptionCityLine = element.val();
				        //element.show();
				      }
				    });//end of function

				    $("#ProvField option").each(function(item){
				      var element =  $(this) ;
				      if (element.data("tag") != selected){
				        //element.hide() ;
				      }
				      else{
				       OptionProvLine = element.val();
				        //element.show();
				      }
				    });//end of function


				    $("#ProvinceField option").each(function(item){
				      var element =  $(this) ;
				      if (element.val() != OptionProvLine){
				        //element.hide() ;
				      }
				      else{
				        $("#ProvinceField option[value = "+OptionProvLine+"]").prop('selected',true);
				      }
				    });//end of function

				    $("#TownField option").each(function(item){
				      var element =  $(this) ;
				      if (element.val() != OptionCityLine ){
				        //element.hide() ;
				      }
				      else{
				        $("#TownField option[value = "+OptionCityLine+"]").prop('selected',true);
				      }
				    });//end of function

				    $("#TownField2 option").each(function(item){
				      var element =  $(this) ;
				      if (element.val() != OptionCityLine ){
				        //element.hide() ;
				      }
				      else{
				        $("#TownField2 option[value = "+OptionCityLine+"]").prop('selected',true);
				      }
				    });//end of function


				    $("#BrgyList option").each(function(item){
				      var element =  $(this) ;
				      if (element.data("tag") != selected){
				        element.hide() ;
				      }
				      else{
				       OptionBrgyLine = element.val();
				        element.show();
				      }
				    });//end of function

				    $("#BrgyList option").each(function(item){
				      var element =  $(this) ;
				      if (element.data("tag") != selected){
				        element.hide() ;
				      }
				      else{
				       OptionBrgyLine = element.val();
				        element.show();
				      }
				    });//end of function

				    $("#AdressLineList option").each(function(item){
				      var element =  $(this) ;
				      if (element.data("tag") != selected){
				        element.hide() ;
				      }
				      else{
				       OptionAddrLine = element.val();
				        element.show();
				      }
				    });//end of function

				    $("#customerList_FName option").each(function(item){
				      var element =  $(this) ;
				      if (element.data("tag") != selected){
				        element.hide() ;
				      }
				      else{
				       OptionFname = element.val();
				        $("#customerList_FName option[data-tag = "+selected+"]").prop('selected',true);
				        //element.show();
				      }
				    });//end of function


				   $("#customerList_MName option").each(function(item){
				     // console.log(selected) ;
				      var element =  $(this) ;
				      //console.log(element.data("tag")) ;
				      if (element.data("tag") != selected){
				        element.hide() ;
				      }
				      else{
				       OptionMname = element.val();
				       $("#customerList_MName option[data-tag = "+selected+"]").prop('selected',true);
				       // element.show();
				      }
				    });//end of function



				   $("#customerList_LName option").each(function(item){
				     // console.log(selected) ;
				      var element =  $(this) ;
				      //console.log(element.data("tag")) ;
				      if (element.data("tag") != selected){
				        element.hide() ;
				      }
				      else{
				       OptionLname = element.val();
				       $("#customerList_LName option[data-tag = "+selected+"]").prop('selected',true);
				        //element.show();
				      }
				    });//end of function

				   $("#Contact_NumList_LName option").each(function(item){
				     // console.log(selected) ;
				      var element =  $(this) ;
				      //console.log(element.data("tag")) ;
				      if (element.data("tag") != selected){
				        element.hide() ;
				      }
				      else{
				       OptionContactNum = element.val();
				        element.show();
				      }
				    });//end of function

				   $("#Email_AddList_LName option").each(function(item){
				     // console.log(selected) ;
				      var element =  $(this) ;
				      //console.log(element.data("tag")) ;
				      if (element.data("tag") != selected){
				        element.hide() ;
				      }
				      else{
				       OptionEmail = element.val();
				        element.show();
				      }
				    });//end of function



				  $("#idfield").val(selected);
				  $("#Cust_FNameField").val(OptionFname);
				  $("#Cust_MNameField").val(OptionMname);
				  $("#Cust_LNameField").val(OptionLname);
				  $("#ContactNum_Field").val(OptionContactNum);
				  $("#email_Field").val(OptionEmail);
				  $("#Addrs_LineField").val(OptionAddrLine);
				  $("#brgyField").val(OptionBrgyLine);
				  $("#hotelNameField").val(OptionHotelnameLine);
				  $("#shopNameField").val(OptionShopnameLine);
				}
				else{
				  swal('Sorry!','The Customer Id or Customer Name that you entered does not exist','warning')
				  $("#Cust_Det_NextBtn").attr("disabled",true);
				}
	});//end of function


		$('#OnetimecheckBox').click(function(){
			if($('#OnetimecheckBox').is(':checked') == true){
				$('#Cust_Det_NextBtn').attr("disabled",false);
				$.ajax({
						method: 'GET',
						url: typeof(CurrentPrice_URL) != 'undefined' ? CurrentPrice_URL : '',
						contentType: "application/json",
						success: function(){
								alert('Walang Agreements');
						},
						error: function(xhr, desc, err){
								console.log('There is an error:'+ err);
						}
				});
					swal("take note: ","You will now be required to Enter information about a new customer","warning");
				$('#Customer_Chooser').slideUp(300);
				newcust = 'new';
					$('#customer_stat').val(newcust);
					$("#Cust_FNameField").attr('disabled',false);
					$("#Cust_MNameField").attr('disabled',false);
					$("#Cust_LNameField").attr('disabled',false);
					$("#ContactNum_Field").attr('disabled',false);
					$("#email_Field").attr('disabled',false);
					$("#ProvinceField").attr('disabled',false);
					$("#custTypeField").attr('disabled',false);

					$("#custTypeField option[value ='C']").prop('selected',true);
					$("#custTypeField").attr('disabled',true);

					$('#HotelNamedisplaydiv').slideUp();
					$('#ShopNamedisplaydiv').slideUp();

					$("#idfield").val(null);
					$("#Cust_FNameField").val(null);
					$("#Cust_MNameField").val(null);
					$("#Cust_LNameField").val(null);
					$("#ContactNum_Field").val(null);
					$("#email_Field").val(null);
					$("#Addrs_LineField").val(null);
					$("#brgyField").val(' ');

					$("#Cust_FNameField").attr('required',true);
					$("#Cust_LNameField").attr('required',true);
					$("#ContactNum_Field").attr('required',true);
					$("#email_Field").attr('required',true);
					$("#ContactNum_Field").attr('required',true);
					$("#Addrs_LineField").attr('required',true);
					$("#brgyField").attr('required',true);

			 }
			 else{
				 $('#Customer_Chooser').slideDown(300);
				 $('#Cust_Det_NextBtn').attr("disabled",true);
					newcust = 'old';
					$('#customer_stat').val(newcust);
					$("#Cust_FNameField").attr('disabled',true);
					$("#Cust_MNameField").attr('disabled',true);
					$("#Cust_LNameField").attr('disabled',true);
					$("#ContactNum_Field").attr('disabled',true);
					$("#email_Field").attr('disabled',true);
					$('#HotelNamedisplaydiv').attr('disabled',true);
					$('#ShopNamedisplaydiv').attr('disabled',true);
					$("#custTypeField").attr('disabled',true);

					swal("take note: ","You may choose from the existing customers in the system","info");
			 }
		});
		//end of functionx

			$(function(){
				 $("#Customer_details_Form").submit(function(event){
						 event.preventDefault();
						 $("#Customer_DetailsDiv").hide("fold");//closes the current step the proceeds to the next step
					 //resets the radio buttons
						 $("#PickUp_Rdo").attr('checked',false);
						 $('#Delivery_Rdo').attr('checked',false);
					 //close the open forms incase they are open
						 $('#pickUp_Div').hide("fold");
						 $('#Delivery_Div').hide("fold");
						 $("#ShippingMethod_Div").show("fold");
				 });
		 });//end of form
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
