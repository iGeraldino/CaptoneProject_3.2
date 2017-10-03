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
						<form id = "Customer_details_Form" name = "Customer_details_Form" method = "POST">
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
								<!--form here-->
								<form id = "PickupOrder_details_Form" name = "PickupOrder_details_Form" method = "POST">
								<div class = "row">
									<div class="col-md-6">
										<h5>Date of Pickup</h5>
										<input id = "PickupDate_Field" class="form-control" type="date" required/>
									</div>
									<div class="col-md-6">
										<h5>Time of Pickup</h5>
										<input id = "PickupTime_Field" class="form-control" type="time" required/>
									</div>
								</div>
								<div class = "pull-right">
									<a id = "Shipping_PickUp_BackBtn" type="button" class="btn btn-sm Love"> Back</a>
									<button id = "Ship_PickUp_NextBtn" type="submit" class="btn btn-sm Lemon"> Next</button>
								</div>
							</form>
								<!--end form here-->
							</div>
							<div id = "Delivery_Div" hidden>
								<!--form here-->
								<form id = "DeliveryOrder_details_Form" name = "DeliveryOrder_details_Form" method = "POST">
								<h6><b>Recipient Information</b></h6>
									<div class="checkbox">
										<label>
											<input type="checkbox" name="optionsCheckboxes" id = "UseCust_detBtn">
											Use Customer's Details
										</label>
									</div>

									<div class="row">
										<div class = "hidden">
											<input id = 'Descision_Field' name= 'Descision_Field' value = 'no'>
										</div>
										<div class="col-md-4">
											<div id = "Dlvry_Fname_Div" class="form-group label-floating">
												<label class="control-label">First Name</label>
												<input id = "Dlvry_Fname_Field" type="text" class="form-control" required>
											</div>
										</div>
										<div class="col-md-4">
											<div  id = "Dlvry_Mname_Div" class="form-group label-floating">
												<label class="control-label">Middle Name</label>
												<input id = "Dlvry_Mname_Field" type="text" class="form-control" >
											</div>
										</div>
										<div class="col-md-4">
											<div id = "Dlvry_Lname_Div" class="form-group label-floating">
												<label class="control-label">Last Name</label>
												<input id = "Dlvry_Lname_Field" type="text" class="form-control" required>
											</div>
										</div>
										<div class="col-md-6">
											<div id = "Dlvry_Contact_Div" class="form-group label-floating">
												<label class="control-label">Contact No</label>
												<input id = "Dlvry_ContactNum_Field" type="text" class="form-control" required>
											</div>
										</div>
										<div class="col-md-6">
											<div id = "Dlvry_Email_Div" class="form-group label-floating">
												<label class="control-label">Email Address</label>
												<input id = "Dlvry_Email_Field" type="email" class="form-control" required>
											</div>
										</div>
									</div>
									<h6><b>Delivery Details</b></h6>
									<div class="row">
										<div class="col-md-6">
											<div id = "Dlvry_AdrsLine_Div" class="form-group label-floating">
												<label class="control-label">Address Line</label>
												<input id = "Dlvry_AdrsLine_Field" type="text" class="form-control" required>
											</div>
										</div>
										<div class="col-md-6">
											<div id = "Dlvry_Brgy_Div"  class="form-group label-floating">
												<label class="control-label">Baranggay</label>
												<input id = "Dlvry_Brgy_Field" type="text" class="form-control" required>
											</div>
										</div>
									</div>
									<div class = "row">
										<div class = 'col-md-6'>
		                  <select class="form-control" name ="Del_ProvinceField" id ="Del_ProvinceField" required>
												@foreach($provinces as $prov)
		                      <option value ="{{$prov->id}}" data-tag = "{{$prov->name}}"> {{$prov->name}} </option>
		                    @endforeach
		                  </select>
		                </div>

		                <div class = 'col-md-6'>
		                  <select  name="Del_TownField" id="Del_TownField" class="form-control" disabled required>
		                    @foreach($cities as $city)
		                      <option value ="{{$city->id}}" data-tag = "{{$city->province_id}}"> {{$city->name}} </option>
		                    @endforeach
		                  </select>
		                </div>

										<div class = 'col-md-6' hidden>
											<select  name="Del_TownField_2" id="Del_TownField_2" class="form-control" disabled required>
												@foreach($cities2 as $city2)
													<option value ="{{$city2->id}}" data-tag = "{{$city2->name}}"> {{$city2->name}} </option>
												@endforeach
											</select>
										</div>
									</div>
									<div class = "row">
										<h6><b>Delivery Date</b></h6>
										<div class="row">
											<div class="col-md-6">
												<h5>Date of Delivery</h5>
												<input id = "DeliveryDate_Field" class="form-control" type="date"
													value = "<?php
														$min = new DateTime();
														$min->modify("+2 days");
														$max = new DateTime();
														echo $min->format("Y-m-d");
														?>" min ="<?php
															$min = new DateTime();
															$min->modify("+2 days");
															$max = new DateTime();
															echo $min->format("Y-m-d");
															?>"  required/>
											</div>

											<div class="col-md-6">
												<h5>Time of Delivery</h5>
												<input id = "DeliveryTime_Field" class = "form-control" type="time" required/>
											</div>
										</div>
										<div class = "pull-right">
											<a id = "Shipping_Delivery_BackBtn" type="button" class="btn btn-sm Love"> Back</a>
											<button id = "Ship_Delivery_NextBtn" type="submit" class="btn btn-sm Lemon"> Next</button><!--upon submission prevent default-->
										</div>
									</div>
								</form>
								</div><!---->
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
										<div class="panel-footer">
										<textarea class="form-control" placeholder="Details" rows="3">Cash Pickup</textarea>
											<a id = "paymentMethod_PickUpCashBackBtn" type="button" class="btn btn-sm Love"> Back</a>
											<button id = "process_PickUpCashBtn"  data-toggle="modal" data-target="#PROCESS_MODAL" class="btn btn-sm Lemon"> Process</button>
										</div>
									</div>
									<div id = "Pickup_BankDetails_Div" hidden>
										<h6><b>Method Details</b></h6>
										<textarea class="form-control" placeholder="Details" rows="3">bank Pickup</textarea>
										<div class="panel-footer">
											<a id = "paymentMethod_PickUpBankBackBtn" type="button" class="btn btn-sm Love"> Back</a>
											<button id = "process_PickUpBankBtn" data-toggle="modal" data-target="#PROCESS_MODAL" class="btn btn-sm Lemon"> Process</button>
										</div>
									</div>
									<div id = "Pickup_PayLaterDetails_Div" hidden>
										<h6><b>Method Details</b></h6>
										<textarea class="form-control" placeholder="Details" rows="3">PayLater Pickup</textarea>
										<div class="panel-footer">
											<a id = "paymentMethod_PickUpPayLaterBackBtn" type="button" class="btn btn-sm Love"> Back</a>
											<button id = "process_PickUpPayLaterBtn" data-toggle="modal" data-target="#PROCESS_MODAL" class="btn btn-sm Lemon"> Process</button>
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
											<button id = "process_DeliveryCashBtn" data-toggle="modal" data-target="#PROCESS_MODAL" class="btn btn-sm Lemon"> Process</button>
										</div>
									</div>
									<div id = "Delivery_bankDetails_Div" hidden>
										<h6><b>Method Details</b></h6>
										<textarea class="form-control" placeholder="Details" rows="3">Bank Delivery</textarea>
										<div class="panel-footer">
											<a id = "paymentMethod_DeliveryBankBackBtn" type="button" class="btn btn-sm Love"> Back</a>
											<button id = "process_DeliveryBankBtn" data-toggle="modal" data-target="#PROCESS_MODAL" class="btn btn-sm Lemon"> Process</button>
										</div>
									</div>
									<div id = "Delivery_PayLaterDetails_Div" hidden>
										<h6><b>Method Details</b></h6>
										<textarea class="form-control" placeholder="Details" rows="3">PayLater Delivery</textarea>
										<div class="panel-footer">
											<a id = "paymentMethod_DeliveryPayLaterBackBtn" type="button" class="btn btn-sm Love"> Back</a>
											<button id = "process_DeliveryCashBtn" data-toggle="modal" data-target="#payLatermodal" class="btn btn-sm Lemon"> Process</button>
										</div>
									</div>
							</div>
						</div><!--Payment Method Div-->
					</div><!--Customer Detais Div-->

						<!--MODAL-->

						<!-- Modal Core -->
						<div class="modal fade" id="PROCESS_MODAL" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title" id="myModalLabel"><b>Order Details</b></h4>
						      </div>
									<div hidden>
										<div class = 'col-md-6'>
		                  <select class="form-control" name ="ProvinceField_Search" id ="ProvinceField_Search">
		                    @foreach($provinces2 as $prov2)
		                      <option value ="{{$prov2->id}}" data-tag = "{{$prov2->name}}"> {{$prov2->name}} </option>
		                    @endforeach
		                  </select>
		                </div>

		                <div class = 'col-md-6'>
		                  <select name="TownField_Search" id="TownField_Search" class="form-control" disabled>
		                    @foreach($cities2 as $cities2)
		                      <option value ="{{$cities2->id}}" data-tag = "{{$cities2->name}}"> {{$cities2->name}} </option>
		                    @endforeach
		                  </select>
		                </div>
									</div>
	           {!! Form::open(array('route' => 'Orders_Submit_LongOrder.store', 'data-parsley-validate'=>'', 'method'=>'POST')) !!}
						      <div class="modal-body">
										<div>
											<!--for sales order table's attributes-->
											<input id = "FinalCustomer_ID" name = "FinalCustomer_ID" type = "text"/>
											<input id = "customerType" name = "customerType" type = "text"/>
											<input id = "customerStat" name = "customerStat" type = "text"/>
											<input id = "OrderedCustFname" name = "OrderedCustFname" type = "text"/>
											<input id = "OrderedCustMname" name = "OrderedCustMname" type = "text"/>
											<input id = "OrderedCustLname" name = "OrderedCustLname" type = "text"/>
											<input id = "OrderedCust_ContactNum" name = "OrderedCust_ContactNum" type = "text"/>
											<input id = "OrderedCust_email" name = "OrderedCust_email" type = "text"/>
											<!--for order details table's attriubutes if the order is delivery-->
											<input id = "recipientID" name = "recipientID" type = "text"/>
											<input id = "recipientFname" name = "recipientFname" type = "text"/>
											<input id = "recipientMname" name = "recipientMname" type = "text"/>
											<input id = "recipientLname" name = "recipientLname" type = "text"/>
											<input id = "recipient_ContactNum" name = "recipient_ContactNum" type = "text"/>
											<input id = "recipient_email" name = "recipient_email" type = "text"/>
											<input id = "Adrs_Line" name = "Adrs_Line" type = "text"/>
											<input id = "Brgy_Line" name = "Brgy_Line" type = "text"/>
											<input id = "prove_Line" name = "prove_Line" type = "text"/>
											<input id = "city_Line" name = "city_Line" type = "text"/>
											<input id = "shipping_methodline" name = "shipping_methodline" type = "text"/>
											<input id = "Payment_methodline" name = "Payment_methodline" type = "text"/>
											<!--for order details table's attriubutes if the order is either delivery or pickup-->
											<input id = "Del_DateLine" name = "Del_DateLine" type = "text"/>
											<input id = "Del_timeLine" name = "Del_timeLine" type = "text"/>
										</div>

										<div class = "row">
											<div id = "nameLabel_Div" class = "col-md-6">
												<h6><b>Customer name:</b></h6>
											</div>
										</div>
										<div class = "row">
											<div id = "AddressLabel_Div" class = "col-md-6">
												<h6><b>Address:</b></h6>
											</div>
										</div>
										<div class = "row">
											<div id = "ContactLabel_Div" class = "col-md-6">
												<h6><b>Contact No:</b></h6>
											</div>
										</div>
										<div class = "row">
											<div id = "emailLabel_Div" class = "col-md-6">
												<h6><b>Email Add:</b></h6>
											</div>
										</div>
										<div class = "row">
											<div id = "ShippingLabel_Div" class = "col-md-6">
												<h6><b>Shipping Method:</b></h6>
											</div>
										</div>
										<div class = "row">
											<div id = "PaymentLabel_Div" class = "col-md-6">
												<h6><b>Payment Method:</b></h6>
											</div>
										</div>
										<div hidden id = "pickup_Modal_BodyDiv">
											<h4 class = "text-center"><b>Pickup Details</b><h4>
											<div class = "row">
												<div id = "pickup_dateDiv" class="col-md-6">
													<h6><b>Date of Pickup:</b></h6>
												</div>
											</div>
											<div class = "row">
												<div id = "pickup_timeDiv" class="col-md-6">
													<h6><b>Time of Pickup:</b></h6>
												</div>
											</div>
										</div><!---->

										<div hidden id = "delivery_Modal_BodyDiv">
									<!--start of contact info-->
									<h4 class = "text-center"><b>Delivery Details</b><h4>
											<div class = "row">
												<div id = "Recipient_nameLabel_Div" class = "col-md-6">
													<h6><b>Recipient name:</b></h6>
												</div>
											</div>
												<div class = "row">
													<div id = "Recipient_ContactLabel_Div" class = "col-md-6">
														<h6><b>Contact No:</b></h6>
													</div>
												</div>
												<div class = "row">
													<div id = "Recipient_emailLabel_Div" class = "col-md-6">
														<h6><b>Email Add:</b></h6>
													</div>
												</div>
									<!--end of contact info-->
											<div class = "row">
												<div id = "DelAddressLabel_Div" class = "col-md-6">
													<h6><b>Delivery Address</b></h6>
												</div>
											</div>

									<!--Delivery date-->
												<div class = "row">
													<div id = "DelDateLabel_Div" class = "col-md-6">
														<h6><b>Date of delivery:</b></h6>
													</div>
												</div>
												<div class = "row">
													<div id = "DelTimeLabel_Div" class = "col-md-6">
														<h6><b>Time of Delivery:</b></h6>
													</div>
												</div>
									<!--end for delivery date-->
										</div>
										<div class = "row">
						        	<div id = "total_Amt_Div" class = "col-md-6">
												<h6><b>Total Amount:</b></h6>
											</div>
											<div id = "total_Amt_value" class = "col-md-6">
												<h7 style = "color:red"> Php {{number_format($final_Amt,2)}}</h7>
											</div>
										</div>

										<div class="col-md-6 col-md-offset-6">
											<div class="checkbox">
												<label style = "color:red;">
													<input type="checkbox" name="importantCheckBox" id = "importantCheckBox"  >
													<p><b>Note:</b> if you check this box,you are sure for this order details</p>
												</label>
											</div>
										</div>
						      </div>
						      <div class="modal-footer">
						      	<br> <br> <br> <br> <br> <br> <br> <br>
						        <a type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</a>
										<!--href="/finalorder"-->
									  <button id = "orderSubmit_Btn" name = "orderSubmit_Btn"
										type="submit" class="btn btn-info btn-simple" disabled>Process Order</button>
						      </div>
							{!! Form::close() !!}
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
  $(document).ready(function(){

			if($('#importantCheckBox').is(":checked")){
				$('#orderSubmit_Btn').attr("disabled",false);
			}

			$('#importantCheckBox').click(function(){
				if($('#importantCheckBox').is(":checked")){
					$('#orderSubmit_Btn').attr("disabled",false);
				}
				else{
					$('#orderSubmit_Btn').attr('disabled','disabled');
				}
			});

		$('#process_PickUpCashBtn').click(function(){
			$('#orderSubmit_Btn').attr('disabled','disabled');
			$('#importantCheckBox').attr('checked',false);
			var ordered_CustStat = $('#customer_stat').val();
			var ordered_Fname = $('#Cust_FNameField').val();
			var ordered_Mname = $('#Cust_MNameField').val();
			var ordered_Lname = $('#Cust_LNameField').val();
			var ordered_Contact = $('#ContactNum_Field').val();
			var ordered_Email = $('#email_Field').val();
			var ordered_AdrsLine = $('#Addrs_LineField').val();
			var ordered_brgy = $('#brgyField').val();
			var ordered_prov = $('#ProvinceField').val();
			var ordered_town = $('#TownField').val();
			//---------------------------------
			var Recpnt_Fname = $('#Dlvry_Fname_Field').val();
			var Recpnt_Mname = $('#Dlvry_Mname_Field').val();
			var Recpnt_Lname = $('#Dlvry_Lname_Field').val();
			var Recpnt_Contact = $('#Dlvry_ContactNum_Field').val();
			var Recpnt_Email = $('#Dlvry_Email_Field').val();
			var Recpnt_AdrsLine = $('#Dlvry_AdrsLine_Field').val();
			var Recpnt_Brgy = $('#Dlvry_Brgy_Field').val();

			var Recpnt_ProvID = $('#Del_ProvinceField').val();
			var Recpnt_TownID = $('#Del_TownField').val();
			var Recpnt_Prov = null;
			var Recpnt_Town = null;
			$("#ProvinceField_Search option").each(function(item){
				var element =  $(this) ;
				if (element.val() != Recpnt_ProvID){
					//element.hide() ;
				}
				else{
					Recpnt_Prov = element.data("tag");
				}
			});//end of function

			$("#TownField_Search option").each(function(item){
				var element =  $(this) ;
				if (element.val() != Recpnt_TownID ){
					//element.hide() ;
				}
				else{
					Recpnt_Town = element.data("tag");
				}
			});//end of function

			//---------------------------------
			$('#customerStat').val(ordered_CustStat);
			if($('#Descision_Field').val() == 'yes'){
				if($('#customerStat').val() == 'old'){
					//
					var customer_ID = $('#FinalCustomer_ID').val();
					$('#recipientID').val(customer_ID);
				}else{
					var nothing = 'n/a';
					$('#recipientID').val(nothing);
				}
			}else if ($('#Descision_Field').val() == 'no'){
				var nothing = 'n/a';
				$('#recipientID').val(nothing);
			}

			$('#OrderedCustFname').val(ordered_Fname);
			$('#OrderedCustMname').val(ordered_Mname);
			$('#OrderedCustLname').val(ordered_Lname);
			$('#OrderedCust_ContactNum').val(ordered_Contact);
			$('#OrderedCust_email').val(ordered_Email);

			//-----------------------------------
			$('#recipientFname').val(Recpnt_Fname);
			$('#recipientMname').val(Recpnt_Mname);
			$('#recipientLname').val(Recpnt_Lname);
			$('#recipient_ContactNum').val(Recpnt_Contact);
			$('#recipient_email').val(Recpnt_Email);
			$('#Adrs_Line').val(Recpnt_AdrsLine);
			$('#Brgy_Line').val(Recpnt_Brgy);
			$('#prove_Line').val(Recpnt_ProvID);
			$('#city_Line').val(Recpnt_TownID);


			var provname = "";
			var cityname = "";
			var provID = $('#prove_Line').val();
			var cityID = $('#city_Line').val();
			var shipMethod = $('#shipping_methodline').val();
			var payMethod = $('#Payment_methodline').val();

			$("#ProvinceField_Search option").each(function(item){
				var element =  $(this) ;
				if (element.val() != provID){
					//element.hide() ;
				}
				else{
					provname = element.data("tag");
				}
			});//end of function

			$("#TownField_Search option").each(function(item){
				var element =  $(this) ;
				if (element.val() != cityID ){
					//element.hide() ;
				}
				else{
					cityname = element.data("tag");
				}
			});//end of function

			var datetoget = $('#Del_DateLine').val();
			var timetoget = $('#Del_timeLine').val();

			$('#nameValue_Div').remove();
			$('#AddressValue_Div').remove();
			$('#ContactValue_Div').remove();
			$('#emailValue_Div').remove();
			$('#ShippingValue_Div').remove();
			$('#PaymentValue_Div').remove();
			$('#pickup_dateValue_Div').remove();
			$('#pickup_timeValue_Div').remove();
			$('#Recipient_nameValue_Div').remove();
			$('#Recipient_ContactValue_Div').remove();
			$('#Recipient_emailValue_Div').remove();
			$('#DelAddressValue_Div').remove();
			$('#DelDateValue_Div').remove();
			$('#DelTimeValue_Div').remove();

			$("#nameLabel_Div").after('<div id = "nameValue_Div" class = "col-md-6">'+ordered_Fname+' '+ordered_Mname+', '+ordered_Lname+'</div>');
			$("#AddressLabel_Div").after('<div id = "AddressValue_Div" class = "col-md-6">'+ordered_AdrsLine+', '+ordered_brgy+', '+cityname+', '+provname+'</div>');
			$("#ContactLabel_Div").after('<div id = "ContactValue_Div" class = "col-md-6">'+ordered_Contact+'</div>');
			$("#emailLabel_Div").after('<div id = "emailValue_Div" class = "col-md-6">'+ordered_Email+'</div>');
			$("#ShippingLabel_Div").after('<div id = "ShippingValue_Div" class = "col-md-6">'+shipMethod+'</div>');
			$("#PaymentLabel_Div").after('<div id = "PaymentValue_Div" class = "col-md-6">'+payMethod+'</div>');
			$("#pickup_dateDiv").after('<div id = "pickup_dateValue_Div" class = "col-md-6">'+datetoget+'</div>');
			$("#pickup_timeDiv").after('<div id = "pickup_timeValue_Div" class = "col-md-6">'+timetoget+'</div>');

			$("#Recipient_nameLabel_Div").after('<div id = "Recipient_nameValue_Div" class = "col-md-6">'+Recpnt_Fname+' '+Recpnt_Mname+', '+Recpnt_Lname+'</div>');
			$("#Recipient_ContactLabel_Div").after('<div id = "Recipient_ContactValue_Div" class = "col-md-6">'+Recpnt_Contact+'</div>');
			$("#Recipient_emailLabel_Div").after('<div id = "Recipient_emailValue_Div" class = "col-md-6">'+Recpnt_Email+'</div>');

			$("#DelAddressLabel_Div").after('<div id = "DelAddressValue_Div" class = "col-md-6">'+Recpnt_AdrsLine+', '+Recpnt_Brgy+', '+Recpnt_Town+', '+Recpnt_Prov+'</div>');
			$("#DelDateLabel_Div").after('<div id = "DelDateValue_Div" class = "col-md-6">'+datetoget+'</div>');
			$("#DelTimeLabel_Div").after('<div id = "DelTimeValue_Div" class = "col-md-6">'+timetoget+'</div>');
		});

		$('#process_PickUpBankBtn').click(function(){
			$('#orderSubmit_Btn').attr('disabled','disabled');
			$('#importantCheckBox').attr('checked',false);
			var ordered_CustStat = $('#customer_stat').val();
			var ordered_Fname = $('#Cust_FNameField').val();
			var ordered_Mname = $('#Cust_MNameField').val();
			var ordered_Lname = $('#Cust_LNameField').val();
			var ordered_Contact = $('#ContactNum_Field').val();
			var ordered_Email = $('#email_Field').val();
			var ordered_AdrsLine = $('#Addrs_LineField').val();
			var ordered_brgy = $('#brgyField').val();
			var ordered_prov = $('#ProvinceField').val();
			var ordered_town = $('#TownField').val();
			//---------------------------------
			var Recpnt_Fname = $('#Dlvry_Fname_Field').val();
			var Recpnt_Mname = $('#Dlvry_Mname_Field').val();
			var Recpnt_Lname = $('#Dlvry_Lname_Field').val();
			var Recpnt_Contact = $('#Dlvry_ContactNum_Field').val();
			var Recpnt_Email = $('#Dlvry_Email_Field').val();
			var Recpnt_AdrsLine = $('#Dlvry_AdrsLine_Field').val();
			var Recpnt_Brgy = $('#Dlvry_Brgy_Field').val();

			var Recpnt_ProvID = $('#Del_ProvinceField').val();
			var Recpnt_TownID = $('#Del_TownField').val();
			var Recpnt_Prov = null;
			var Recpnt_Town = null;
			$("#ProvinceField_Search option").each(function(item){
				var element =  $(this) ;
				if (element.val() != Recpnt_ProvID){
					//element.hide() ;
				}
				else{
					Recpnt_Prov = element.data("tag");
				}
			});//end of function

			$("#TownField_Search option").each(function(item){
				var element =  $(this) ;
				if (element.val() != Recpnt_TownID ){
					//element.hide() ;
				}
				else{
					Recpnt_Town = element.data("tag");
				}
			});//end of function

			//---------------------------------
			$('#customerStat').val(ordered_CustStat);
			if($('#Descision_Field').val() == 'yes'){
				if($('#customerStat').val() == 'old'){
					//
					var customer_ID = $('#FinalCustomer_ID').val();
					$('#recipientID').val(customer_ID);
				}else{
					var nothing = 'n/a';
					$('#recipientID').val(nothing);
				}
			}else if ($('#Descision_Field').val() == 'no'){
				var nothing = 'n/a';
				$('#recipientID').val(nothing);
			}

			$('#OrderedCustFname').val(ordered_Fname);
			$('#OrderedCustMname').val(ordered_Mname);
			$('#OrderedCustLname').val(ordered_Lname);
			$('#OrderedCust_ContactNum').val(ordered_Contact);
			$('#OrderedCust_email').val(ordered_Email);

			//-----------------------------------
			$('#recipientFname').val(Recpnt_Fname);
			$('#recipientMname').val(Recpnt_Mname);
			$('#recipientLname').val(Recpnt_Lname);
			$('#recipient_ContactNum').val(Recpnt_Contact);
			$('#recipient_email').val(Recpnt_Email);
			$('#Adrs_Line').val(Recpnt_AdrsLine);
			$('#Brgy_Line').val(Recpnt_Brgy);
			$('#prove_Line').val(Recpnt_ProvID);
			$('#city_Line').val(Recpnt_TownID);


			var provname = "";
			var cityname = "";
			var provID = $('#prove_Line').val();
			var cityID = $('#city_Line').val();
			var shipMethod = $('#shipping_methodline').val();
			var payMethod = $('#Payment_methodline').val();

			$("#ProvinceField_Search option").each(function(item){
				var element =  $(this) ;
				if (element.val() != provID){
					//element.hide() ;
				}
				else{
					provname = element.data("tag");
				}
			});//end of function

			$("#TownField_Search option").each(function(item){
				var element =  $(this) ;
				if (element.val() != cityID ){
					//element.hide() ;
				}
				else{
					cityname = element.data("tag");
				}
			});//end of function

			var datetoget = $('#Del_DateLine').val();
			var timetoget = $('#Del_timeLine').val();

			$('#nameValue_Div').remove();
			$('#AddressValue_Div').remove();
			$('#ContactValue_Div').remove();
			$('#emailValue_Div').remove();
			$('#ShippingValue_Div').remove();
			$('#PaymentValue_Div').remove();
			$('#pickup_dateValue_Div').remove();
			$('#pickup_timeValue_Div').remove();
			$('#Recipient_nameValue_Div').remove();
			$('#Recipient_ContactValue_Div').remove();
			$('#Recipient_emailValue_Div').remove();
			$('#DelAddressValue_Div').remove();
			$('#DelDateValue_Div').remove();
			$('#DelTimeValue_Div').remove();

			$("#nameLabel_Div").after('<div id = "nameValue_Div" class = "col-md-6">'+ordered_Fname+' '+ordered_Mname+', '+ordered_Lname+'</div>');
			$("#AddressLabel_Div").after('<div id = "AddressValue_Div" class = "col-md-6">'+ordered_AdrsLine+', '+ordered_brgy+', '+cityname+', '+provname+'</div>');
			$("#ContactLabel_Div").after('<div id = "ContactValue_Div" class = "col-md-6">'+ordered_Contact+'</div>');
			$("#emailLabel_Div").after('<div id = "emailValue_Div" class = "col-md-6">'+ordered_Email+'</div>');
			$("#ShippingLabel_Div").after('<div id = "ShippingValue_Div" class = "col-md-6">'+shipMethod+'</div>');
			$("#PaymentLabel_Div").after('<div id = "PaymentValue_Div" class = "col-md-6">'+payMethod+'</div>');
			$("#pickup_dateDiv").after('<div id = "pickup_dateValue_Div" class = "col-md-6">'+datetoget+'</div>');
			$("#pickup_timeDiv").after('<div id = "pickup_timeValue_Div" class = "col-md-6">'+timetoget+'</div>');

			$("#Recipient_nameLabel_Div").after('<div id = "Recipient_nameValue_Div" class = "col-md-6">'+Recpnt_Fname+' '+Recpnt_Mname+', '+Recpnt_Lname+'</div>');
			$("#Recipient_ContactLabel_Div").after('<div id = "Recipient_ContactValue_Div" class = "col-md-6">'+Recpnt_Contact+'</div>');
			$("#Recipient_emailLabel_Div").after('<div id = "Recipient_emailValue_Div" class = "col-md-6">'+Recpnt_Email+'</div>');

			$("#DelAddressLabel_Div").after('<div id = "DelAddressValue_Div" class = "col-md-6">'+Recpnt_AdrsLine+', '+Recpnt_Brgy+', '+Recpnt_Town+', '+Recpnt_Prov+'</div>');
			$("#DelDateLabel_Div").after('<div id = "DelDateValue_Div" class = "col-md-6">'+datetoget+'</div>');
			$("#DelTimeLabel_Div").after('<div id = "DelTimeValue_Div" class = "col-md-6">'+timetoget+'</div>');
		});

//
			$('#process_DeliveryBankBtn').click(function(){
				$('#orderSubmit_Btn').attr('disabled','disabled');
				$('#importantCheckBox').attr('checked',false);
				var ordered_CustStat = $('#customer_stat').val();
				var ordered_Fname = $('#Cust_FNameField').val();
				var ordered_Mname = $('#Cust_MNameField').val();
				var ordered_Lname = $('#Cust_LNameField').val();
				var ordered_Contact = $('#ContactNum_Field').val();
				var ordered_Email = $('#email_Field').val();
				var ordered_AdrsLine = $('#Addrs_LineField').val();
				var ordered_brgy = $('#brgyField').val();
				var ordered_prov = $('#ProvinceField').val();
				var ordered_town = $('#TownField').val();
				//---------------------------------
				var Recpnt_Fname = $('#Dlvry_Fname_Field').val();
				var Recpnt_Mname = $('#Dlvry_Mname_Field').val();
				var Recpnt_Lname = $('#Dlvry_Lname_Field').val();
				var Recpnt_Contact = $('#Dlvry_ContactNum_Field').val();
				var Recpnt_Email = $('#Dlvry_Email_Field').val();
				var Recpnt_AdrsLine = $('#Dlvry_AdrsLine_Field').val();
				var Recpnt_Brgy = $('#Dlvry_Brgy_Field').val();

				var Recpnt_ProvID = $('#Del_ProvinceField').val();
				var Recpnt_TownID = $('#Del_TownField').val();
				var Recpnt_Prov = null;
				var Recpnt_Town = null;
				$("#ProvinceField_Search option").each(function(item){
					var element =  $(this) ;
					if (element.val() != Recpnt_ProvID){
						//element.hide() ;
					}
					else{
						Recpnt_Prov = element.data("tag");
					}
				});//end of function

				$("#TownField_Search option").each(function(item){
					var element =  $(this) ;
					if (element.val() != Recpnt_TownID ){
						//element.hide() ;
					}
					else{
						Recpnt_Town = element.data("tag");
					}
				});//end of function

				//---------------------------------
				$('#customerStat').val(ordered_CustStat);
				if($('#Descision_Field').val() == 'yes'){
					if($('#customerStat').val() == 'old'){
						//
						var customer_ID = $('#FinalCustomer_ID').val();
						$('#recipientID').val(customer_ID);
					}else{
						var nothing = 'n/a';
						$('#recipientID').val(nothing);
					}
				}else if ($('#Descision_Field').val() == 'no'){
					var nothing = 'n/a';
					$('#recipientID').val(nothing);
				}

				$('#OrderedCustFname').val(ordered_Fname);
				$('#OrderedCustMname').val(ordered_Mname);
				$('#OrderedCustLname').val(ordered_Lname);
				$('#OrderedCust_ContactNum').val(ordered_Contact);
				$('#OrderedCust_email').val(ordered_Email);

				//-----------------------------------
				$('#recipientFname').val(Recpnt_Fname);
				$('#recipientMname').val(Recpnt_Mname);
				$('#recipientLname').val(Recpnt_Lname);
				$('#recipient_ContactNum').val(Recpnt_Contact);
				$('#recipient_email').val(Recpnt_Email);
				$('#Adrs_Line').val(Recpnt_AdrsLine);
				$('#Brgy_Line').val(Recpnt_Brgy);
				$('#prove_Line').val(Recpnt_ProvID);
				$('#city_Line').val(Recpnt_TownID);


				var provname = "";
				var cityname = "";
				var provID = $('#prove_Line').val();
				var cityID = $('#city_Line').val();
				var shipMethod = $('#shipping_methodline').val();
				var payMethod = $('#Payment_methodline').val();

				$("#ProvinceField_Search option").each(function(item){
					var element =  $(this) ;
					if (element.val() != provID){
						//element.hide() ;
					}
					else{
						provname = element.data("tag");
					}
				});//end of function

				$("#TownField_Search option").each(function(item){
					var element =  $(this) ;
					if (element.val() != cityID ){
						//element.hide() ;
					}
					else{
						cityname = element.data("tag");
					}
				});//end of function

				var datetoget = $('#Del_DateLine').val();
				var timetoget = $('#Del_timeLine').val();

				$('#nameValue_Div').remove();
				$('#AddressValue_Div').remove();
				$('#ContactValue_Div').remove();
				$('#emailValue_Div').remove();
				$('#ShippingValue_Div').remove();
				$('#PaymentValue_Div').remove();
				$('#pickup_dateValue_Div').remove();
				$('#pickup_timeValue_Div').remove();
				$('#Recipient_nameValue_Div').remove();
				$('#Recipient_ContactValue_Div').remove();
				$('#Recipient_emailValue_Div').remove();
				$('#DelAddressValue_Div').remove();
				$('#DelDateValue_Div').remove();
				$('#DelTimeValue_Div').remove();

				$("#nameLabel_Div").after('<div id = "nameValue_Div" class = "col-md-6">'+ordered_Fname+' '+ordered_Mname+', '+ordered_Lname+'</div>');
				$("#AddressLabel_Div").after('<div id = "AddressValue_Div" class = "col-md-6">'+ordered_AdrsLine+', '+ordered_brgy+', '+cityname+', '+provname+'</div>');
				$("#ContactLabel_Div").after('<div id = "ContactValue_Div" class = "col-md-6">'+ordered_Contact+'</div>');
				$("#emailLabel_Div").after('<div id = "emailValue_Div" class = "col-md-6">'+ordered_Email+'</div>');
				$("#ShippingLabel_Div").after('<div id = "ShippingValue_Div" class = "col-md-6">'+shipMethod+'</div>');
				$("#PaymentLabel_Div").after('<div id = "PaymentValue_Div" class = "col-md-6">'+payMethod+'</div>');
				$("#pickup_dateDiv").after('<div id = "pickup_dateValue_Div" class = "col-md-6">'+datetoget+'</div>');
				$("#pickup_timeDiv").after('<div id = "pickup_timeValue_Div" class = "col-md-6">'+timetoget+'</div>');

				$("#Recipient_nameLabel_Div").after('<div id = "Recipient_nameValue_Div" class = "col-md-6">'+Recpnt_Fname+' '+Recpnt_Mname+', '+Recpnt_Lname+'</div>');
				$("#Recipient_ContactLabel_Div").after('<div id = "Recipient_ContactValue_Div" class = "col-md-6">'+Recpnt_Contact+'</div>');
				$("#Recipient_emailLabel_Div").after('<div id = "Recipient_emailValue_Div" class = "col-md-6">'+Recpnt_Email+'</div>');

				$("#DelAddressLabel_Div").after('<div id = "DelAddressValue_Div" class = "col-md-6">'+Recpnt_AdrsLine+', '+Recpnt_Brgy+', '+Recpnt_Town+', '+Recpnt_Prov+'</div>');
				$("#DelDateLabel_Div").after('<div id = "DelDateValue_Div" class = "col-md-6">'+datetoget+'</div>');
				$("#DelTimeLabel_Div").after('<div id = "DelTimeValue_Div" class = "col-md-6">'+timetoget+'</div>');
			});


				$('#process_DeliveryCashBtn').click(function(){
					$('#orderSubmit_Btn').attr('disabled','disabled');
					$('#importantCheckBox').attr('checked',false);
					var ordered_CustStat = $('#customer_stat').val();
					var ordered_Fname = $('#Cust_FNameField').val();
					var ordered_Mname = $('#Cust_MNameField').val();
					var ordered_Lname = $('#Cust_LNameField').val();
					var ordered_Contact = $('#ContactNum_Field').val();
					var ordered_Email = $('#email_Field').val();
					var ordered_AdrsLine = $('#Addrs_LineField').val();
					var ordered_brgy = $('#brgyField').val();
					var ordered_prov = $('#ProvinceField').val();
					var ordered_town = $('#TownField').val();
					//---------------------------------
					var Recpnt_Fname = $('#Dlvry_Fname_Field').val();
					var Recpnt_Mname = $('#Dlvry_Mname_Field').val();
					var Recpnt_Lname = $('#Dlvry_Lname_Field').val();
					var Recpnt_Contact = $('#Dlvry_ContactNum_Field').val();
					var Recpnt_Email = $('#Dlvry_Email_Field').val();
					var Recpnt_AdrsLine = $('#Dlvry_AdrsLine_Field').val();
					var Recpnt_Brgy = $('#Dlvry_Brgy_Field').val();

					var Recpnt_ProvID = $('#Del_ProvinceField').val();
					var Recpnt_TownID = $('#Del_TownField').val();
					var Recpnt_Prov = null;
					var Recpnt_Town = null;
					$("#ProvinceField_Search option").each(function(item){
						var element =  $(this) ;
						if (element.val() != Recpnt_ProvID){
							//element.hide() ;
						}
						else{
							Recpnt_Prov = element.data("tag");
						}
					});//end of function

					$("#TownField_Search option").each(function(item){
						var element =  $(this) ;
						if (element.val() != Recpnt_TownID ){
							//element.hide() ;
						}
						else{
							Recpnt_Town = element.data("tag");
						}
					});//end of function

					//---------------------------------
					$('#customerStat').val(ordered_CustStat);
					if($('#Descision_Field').val() == 'yes'){
						if($('#customerStat').val() == 'old'){
							//
							var customer_ID = $('#FinalCustomer_ID').val();
							$('#recipientID').val(customer_ID);
						}else{
							var nothing = 'n/a';
							$('#recipientID').val(nothing);
						}
					}else if ($('#Descision_Field').val() == 'no'){
						var nothing = 'n/a';
						$('#recipientID').val(nothing);
					}

					$('#OrderedCustFname').val(ordered_Fname);
					$('#OrderedCustMname').val(ordered_Mname);
					$('#OrderedCustLname').val(ordered_Lname);
					$('#OrderedCust_ContactNum').val(ordered_Contact);
					$('#OrderedCust_email').val(ordered_Email);

					//-----------------------------------
					$('#recipientFname').val(Recpnt_Fname);
					$('#recipientMname').val(Recpnt_Mname);
					$('#recipientLname').val(Recpnt_Lname);
					$('#recipient_ContactNum').val(Recpnt_Contact);
					$('#recipient_email').val(Recpnt_Email);
					$('#Adrs_Line').val(Recpnt_AdrsLine);
					$('#Brgy_Line').val(Recpnt_Brgy);
					$('#prove_Line').val(Recpnt_ProvID);
					$('#city_Line').val(Recpnt_TownID);

					var provname = "";
					var cityname = "";
					var provID = $('#prove_Line').val();
					var cityID = $('#city_Line').val();
					var shipMethod = $('#shipping_methodline').val();
					var payMethod = $('#Payment_methodline').val();

					$("#ProvinceField_Search option").each(function(item){
						var element =  $(this) ;
						if (element.val() != provID){
							//element.hide() ;
						}
						else{
							provname = element.data("tag");
						}
					});//end of function

					$("#TownField_Search option").each(function(item){
						var element =  $(this) ;
						if (element.val() != cityID ){
							//element.hide() ;
						}
						else{
							cityname = element.data("tag");
						}
					});//end of function

					var datetoget = $('#Del_DateLine').val();
					var timetoget = $('#Del_timeLine').val();

					$('#nameValue_Div').remove();
					$('#AddressValue_Div').remove();
					$('#ContactValue_Div').remove();
					$('#emailValue_Div').remove();
					$('#ShippingValue_Div').remove();
					$('#PaymentValue_Div').remove();
					$('#pickup_dateValue_Div').remove();
					$('#pickup_timeValue_Div').remove();
					$('#Recipient_nameValue_Div').remove();
					$('#Recipient_ContactValue_Div').remove();
					$('#Recipient_emailValue_Div').remove();
					$('#DelAddressValue_Div').remove();
					$('#DelDateValue_Div').remove();
					$('#DelTimeValue_Div').remove();

					$("#nameLabel_Div").after('<div id = "nameValue_Div" class = "col-md-6">'+ordered_Fname+' '+ordered_Mname+', '+ordered_Lname+'</div>');
					$("#AddressLabel_Div").after('<div id = "AddressValue_Div" class = "col-md-6">'+ordered_AdrsLine+', '+ordered_brgy+', '+cityname+', '+provname+'</div>');
					$("#ContactLabel_Div").after('<div id = "ContactValue_Div" class = "col-md-6">'+ordered_Contact+'</div>');
					$("#emailLabel_Div").after('<div id = "emailValue_Div" class = "col-md-6">'+ordered_Email+'</div>');
					$("#ShippingLabel_Div").after('<div id = "ShippingValue_Div" class = "col-md-6">'+shipMethod+'</div>');
					$("#PaymentLabel_Div").after('<div id = "PaymentValue_Div" class = "col-md-6">'+payMethod+'</div>');
					$("#pickup_dateDiv").after('<div id = "pickup_dateValue_Div" class = "col-md-6">'+datetoget+'</div>');
					$("#pickup_timeDiv").after('<div id = "pickup_timeValue_Div" class = "col-md-6">'+timetoget+'</div>');

					$("#Recipient_nameLabel_Div").after('<div id = "Recipient_nameValue_Div" class = "col-md-6">'+Recpnt_Fname+' '+Recpnt_Mname+', '+Recpnt_Lname+'</div>');
					$("#Recipient_ContactLabel_Div").after('<div id = "Recipient_ContactValue_Div" class = "col-md-6">'+Recpnt_Contact+'</div>');
					$("#Recipient_emailLabel_Div").after('<div id = "Recipient_emailValue_Div" class = "col-md-6">'+Recpnt_Email+'</div>');

					$("#DelAddressLabel_Div").after('<div id = "DelAddressValue_Div" class = "col-md-6">'+Recpnt_AdrsLine+', '+Recpnt_Brgy+', '+Recpnt_Town+', '+Recpnt_Prov+'</div>');
					$("#DelDateLabel_Div").after('<div id = "DelDateValue_Div" class = "col-md-6">'+datetoget+'</div>');
					$("#DelTimeLabel_Div").after('<div id = "DelTimeValue_Div" class = "col-md-6">'+timetoget+'</div>');
				});

					$(function(){
						 $("#PickupOrder_details_Form").submit(function(event){
								 event.preventDefault();
								 //alert('pickup');
								 $('#pickup_Modal_BodyDiv').show();
								 $('#delivery_Modal_BodyDiv').hide();
								 //--------------------------------------
								 var date = $('#PickupDate_Field').val();
								 var time = $('#PickupTime_Field').val();
								 //
								 $('#Del_DateLine').val(date);
								 $('#Del_timeLine').val(time);

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
					});//end of form

					$(function(){
						 $("#DeliveryOrder_details_Form").submit(function(event){
								event.preventDefault();
								$('#pickup_Modal_BodyDiv').hide();
								$('#delivery_Modal_BodyDiv').show();
								var date = $('#DeliveryDate_Field').val();
								var time = $('#DeliveryTime_Field').val();

								$('#Del_DateLine').val(date);
								$('#Del_timeLine').val(time);

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
									//alert('gerald');
						 });
				 });//end of form


				 $(function(){
						$("#Customer_details_Form").submit(function(event){
								event.preventDefault();
								var CustType = $('#custTypeField').val()
								var CustStatus = $('#customer_stat').val()

								$('#customerType').val(CustType);
								$('#customerStat').val(CustStatus);
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


			if($("#UseCust_detBtn").is(":checked")){
				var descVal = 'yes';
				$('#Descision_Field').val(descVal);
				if($('#customer_stat').val() == 'old'){
					var customer_ID = $('#FinalCustomer_ID').val();
					$('#recipientID').val(customer_ID);
				}else if($('#customer_stat').val() == 'new'){
					var nothing = 'n/a';
					$('#recipientID').val(nothing);
				}//
			}else{
				var descVal = 'no';
				$('#Descision_Field').val(descVal);
				var nothing = 'n/a';
				$('#recipientID').val(nothing);
			}//

			$("#UseCust_detBtn").click(function(){
				if($("#UseCust_detBtn").is(":checked")){
					//alert('I was Checked');
					//customer_stat this is the id of the field that determines whether the customer is new or old
					var descVal = 'yes';
					$('#Descision_Field').val(descVal);
					if($('#customer_stat').val() == 'old'){
						var customer_ID = $('#FinalCustomer_ID').val();
						$('#recipientID').val(customer_ID);
					}else if($('#customer_stat').val() == 'new'){
						var nothing = 'n/a';
						$('#recipientID').val(nothing);
					}

					var Fname = $("#Cust_FNameField").val();
					var Mname = $("#Cust_MNameField").val();
					var Lname = $("#Cust_LNameField").val();
					var ContactNum = $("#ContactNum_Field").val();
					var Email = $("#email_Field").val();
					var Cust_Type = $("#custTypeField").val();
					var Adrs_Line = $('#Addrs_LineField').val();
					var brgy = $('#brgyField').val();
					var Prov = $('#ProvinceField').val();
					var Town = $('#TownField').val();


					$("#Dlvry_Fname_Field").val(Fname);
					$("#Dlvry_Mname_Field").val(Mname);
					$("#Dlvry_Lname_Field").val(Lname);
					$("#Dlvry_ContactNum_Field").val(ContactNum);
					$("#Dlvry_Email_Field").val(Email);
					$("#Dlvry_AdrsLine_Field").val(Adrs_Line);
					$("#Dlvry_Brgy_Field").val(brgy);
					$("#Del_ProvinceField option[value =" + Prov + "]").prop('selected',true);

					$("#Del_TownField option[value =" + Town + "]").prop('selected',true);

					$('#Dlvry_Fname_Div').removeClass("form-group label-floating");
					$('#Dlvry_Fname_Div').addClass("form-group");
					$('#Dlvry_Mname_Div').removeClass("form-group label-floating");
					$('#Dlvry_Mname_Div').addClass("form-group");
					$('#Dlvry_Lname_Div').removeClass("form-group label-floating");
					$('#Dlvry_Lname_Div').addClass("form-group");
					$('#Dlvry_Contact_Div').removeClass("form-group label-floating");
					$('#Dlvry_Contact_Div').addClass("form-group");
					$('#Dlvry_Email_Div').removeClass("form-group label-floating");
					$('#Dlvry_Email_Div').addClass("form-group");
					$('#Dlvry_AdrsLine_Div').removeClass("form-group label-floating");
					$('#Dlvry_AdrsLine_Div').addClass("form-group");
					$('#Dlvry_Brgy_Div').removeClass("form-group label-floating");
					$('#Dlvry_Brgy_Div').addClass("form-group");
				}
				else
				{
					//alert('nothing');
					var descVal = 'no';
					$('#Descision_Field').val(descVal);
					var nothing = 'n/a';
					$('#recipientID').val(nothing);
					$("#Dlvry_Fname_Field").val(null);
					$("#Dlvry_Mname_Field").val(null);
					$("#Dlvry_Lname_Field").val(null);
					$("#Dlvry_ContactNum_Field").val(null);
					$("#Dlvry_Email_Field").val(null);
					$("#Dlvry_AdrsLine_Field").val(null);
					$("#Dlvry_Brgy_Field").val(null);

					$('#Dlvry_Fname_Div').removeClass("form-group");
					$('#Dlvry_Fname_Div').addClass("form-group label-floating");
					$('#Dlvry_Mname_Div').removeClass("form-group");
					$('#Dlvry_Mname_Div').addClass("form-group label-floating");
					$('#Dlvry_Lname_Div').removeClass("form-group");
					$('#Dlvry_Lname_Div').addClass("form-group label-floating");
					$('#Dlvry_Contact_Div').removeClass("form-group");
					$('#Dlvry_Contact_Div').addClass("form-group label-floating");
					$('#Dlvry_Email_Div').removeClass("form-group");
					$('#Dlvry_Email_Div').addClass("form-group label-floating");
					$('#Dlvry_AdrsLine_Div').removeClass("form-group");
					$('#Dlvry_AdrsLine_Div').addClass("form-group label-floating");
					$('#Dlvry_Brgy_Div').removeClass("form-group");
					$('#Dlvry_Brgy_Div').addClass("form-group label-floating");
				}
			});

			$('#Del_ProvinceField').change(function(){
        $("#Del_TownField").removeAttr("disabled");
        $("#Del_TownField").attr('required', true);
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

            $("#Del_TownField").val($("#Del_TownField option:visible:first").val());
    });//end of function

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
									//alert('May Agreements');
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
									//alert('Walang Agreements');
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

						$('#FinalCustomer_ID').val(selected);
						console.log($('#FinalCustomer_ID').val());

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
					$('#FinalCustomer_ID').val(null);
					//this is for outputing the values of fields so that the labels ae not overlapping to the values
						$('#Fnamedisplaydiv').removeClass("form-group");
						$('#Fnamedisplaydiv').addClass("form-group label-floating");
						$('#Mnamedisplaydiv').removeClass("form-group");
						$('#Mnamedisplaydiv').addClass("form-group label-floating");
						$('#Lnamedisplaydiv').removeClass("form-group");
						$('#Lnamedisplaydiv').addClass("form-group label-floating");
						$('#AdrLinedisplaydiv').removeClass("form-group");
						$('#AdrLinedisplaydiv').addClass("form-group label-floating");
						$('#Brgydisplaydiv').removeClass("form-group");
						$('#Brgydisplaydiv').addClass("form-group label-floating");
						$('#Contactdisplaydiv').removeClass("form-group");
						$('#Contactdisplaydiv').addClass("form-group label-floating");
						$('#emailDisplayDiv').removeClass("form-group");
						$('#emailDisplayDiv').addClass("form-group label-floating");

						$("#idfield").val(null);
						$("#Cust_FNameField").val(null);
						$("#Cust_MNameField").val(null);
						$("#Cust_LNameField").val(null);
						$("#ContactNum_Field").val(null);
						$("#email_Field").val(null);
						$("#Addrs_LineField").val(null);
						$("#brgyField").val(null);

				  swal('Sorry!','The Customer Id or Customer Name that you entered does not exist','warning')
				  $("#Cust_Det_NextBtn").attr("disabled",true);
				}
	});//end of function


		$('#OnetimecheckBox').click(function(){
			if($('#OnetimecheckBox').is(':checked') == true){
				$('#FinalCustomer_ID').val(null);
				$('#Cust_Det_NextBtn').attr("disabled",false);
				$.ajax({
						method: 'GET',
						url: typeof(CurrentPrice_URL) != 'undefined' ? CurrentPrice_URL : '',
						contentType: "application/json",
						success: function(){
								//alert('Walang Agreements');
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
					$("#brgyField").val(null);

					$("#Cust_FNameField").attr('required',true);
					$("#Cust_LNameField").attr('required',true);
					$("#ContactNum_Field").attr('required',true);
					$("#email_Field").attr('required',true);
					$("#ContactNum_Field").attr('required',true);
					$("#Addrs_LineField").attr('required',true);
					$("#brgyField").attr('required',true);

					$('#Fnamedisplaydiv').removeClass("form-group");
					$('#Fnamedisplaydiv').addClass("form-group label-floating");
					$('#Mnamedisplaydiv').removeClass("form-group");
					$('#Mnamedisplaydiv').addClass("form-group label-floating");
					$('#Lnamedisplaydiv').removeClass("form-group");
					$('#Lnamedisplaydiv').addClass("form-group label-floating");
					$('#AdrLinedisplaydiv').removeClass("form-group");
					$('#AdrLinedisplaydiv').addClass("form-group label-floating");
					$('#Brgydisplaydiv').removeClass("form-group");
					$('#Brgydisplaydiv').addClass("form-group label-floating");
					$('#Contactdisplaydiv').removeClass("form-group");
					$('#Contactdisplaydiv').addClass("form-group label-floating");
					$('#emailDisplayDiv').removeClass("form-group");
					$('#emailDisplayDiv').addClass("form-group label-floating");
			 }
			 else{
				 var CustID = $("#customerList_Field").val();
				 $('#FinalCustomer_ID').val(CustID);//for checking again
				 $('#FinalCustomer_ID').val(null);
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

//once that you are at the shipping method there are 2 choices:
//Pickup--------------------------------------------------------------------------------------------------------------
		$("#PickUp_Rdo").click(function(){
			var shippingValue = "pickup";
			$('#shipping_methodline').val(shippingValue);
			$('#pickUp_Div').show("fold");
			$('#Delivery_Div').hide("fold");
		});



		//backButton of pickup
		$("#Shipping_PickUp_BackBtn").click(function(){
			$("#ShippingMethod_Div").hide("fold");
			$("#Customer_DetailsDiv").show("fold");
		});

	//Pickup Payment Method:-----------------------------------------------------------------------------------------------
		//PickUp Cash method
				$("#PickUpCashRdo").click(function(){//Cash Radio Button
					//alert('cash pickup');
					var paymentValue = "cash";
					$('#Payment_methodline').val(paymentValue);
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
					var paymentValue = "bank";
					$('#Payment_methodline').val(paymentValue);
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
			var shippingValue = "delivery";
			$('#shipping_methodline').val(shippingValue);
			$('#pickUp_Div').hide("fold");
			$('#Delivery_Div').show("fold");
		});
		//nextButton of pickup


		//backButton of Delivery
		$("#Shipping_Delivery_BackBtn").click(function(){
			$("#ShippingMethod_Div").hide("fold");
			$("#Customer_DetailsDiv").show("fold");
		});


			//Delivery Payment Method:-----------------------------------------------------------------------------------------------
				//Delivery Cash method
						$("#DeliveryCashRdo").click(function(){//Cash Radio Button
							var paymentValue = "cash";
							$('#Payment_methodline').val(paymentValue);
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
							var paymentValue = "bank";
							$('#Payment_methodline').val(paymentValue);
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
