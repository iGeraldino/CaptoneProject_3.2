@extends('customer_side_main')
@section('title', 'Checkout')
@section('css')
    <link href="_CSS/checkout1.css" rel="stylesheet">
@endsection

@section('content')
  	<!--checkout starts here -->

        <div class="container" style="margin-top: 50px;">
			<div class="row">
				<section>
		        <div class="wizard">
		            <div class="wizard-inner" id="step">
		                <div class="connecting-line"></div>
		                <ul class="nav nav-tabs" role="tablist">

		                    <li role="presentation" class="active">
		                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
		                            <span class="round-tab">
		                                <i class="glyphicon glyphicon-file"></i>
		                            </span>
		                        </a>
		                    </li>

		                    <li role="presentation" class="disabled">
		                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
		                            <span class="round-tab">
		                                <i class="glyphicon glyphicon-pencil"></i>
		                            </span>
		                        </a>
		                    </li>
		                    <li role="presentation" class="disabled">
		                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
		                            <span class="round-tab">
		                                <i class="glyphicon glyphicon-send"></i>
		                            </span>
		                        </a>
		                    </li>

		                    <li role="presentation" class="disabled">
		                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
		                            <span class="round-tab">
		                                <i class="glyphicon glyphicon-ok"></i>
		                            </span>
		                        </a>
		                    </li>
		                </ul>
		            </div>

		            <form role="form">

  	                <div class="tab-content">
		                    <div class="tab-pane active" role="tabpanel" id="step1">
		                        <h3 class="fontx text-center">New Customer</h3>
		                        <p class="text-center fontxx">By creating an account, you can shop faster and  be up to date on an order's status. </p>
		                        <div class="row">
                        @if(Auth::check() == 1)

                          <button type="button" class="btn btn-primary next-step" style="margin-left: 44%;">Save and continue</button>

                        @elseif(Auth::check() == 0)

                        <div class="funkyradio text-center fontxx">
								        <div class="funkyradio-default">
								            <input type="radio" name="radio" id="registerRdoBtn" checked/>
								            <label for="radio1">Register Account</label>
								        </div>

								        <div class="funkyradio-default fontxx">
								            <input type="radio" name="radio" id="guestRdoBtn" />
								            <label for="radio2">Guest Checkout</label>
								        </div>
								        </div>

      							     <p class="text-center fontxx">Already have an account? <a href="{{ route('customer_side.pages.signin') }}" type="button"> Sign in now!</a> </p>
                       @endif
							    </div>

							     <div id="loginshowdiv" hidden="" class="row">
					                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
					                    <form method="POST" action="{{ route('customer_side.pages.signin') }}">
					                        <fieldset>
					                            <h2 class="text-center fontx">Sign In</h2>
					                            <hr class="colorgraph">
					                            <div class="form-group">
					                                <input type="text" name="email" id="email" class="form-control input-lg fontxx" placeholder="Email Address">
					                            </div>
					                            <div class="form-group">
					                                <input type="password" name="password" id="password" class="form-control input-lg fontxx" placeholder="Password">
					                            </div>
					                            <hr class="colorgraph">
					                            <div class="row">
					                                <div class="col-xs-6 col-sm-6 col-md-6">
					                                    <button type="submit"  class="btn btn-lg btn-success btn-block fontxx" > Sign in </button>
					                                </div>
					                                <div class="col-xs-6 col-sm-6 col-md-6">
					                                    <a href="register.php" class="btn btn-lg btn-primary btn-block fontxx">Register</a>
					                                </div>
					                            </div>
												{{ csrf_field() }}
					                            <a href="" class="btn btn-link pull-right fontxx">Forgot Password?</a>
					                        </fieldset>
					                    </form>
					                    <br>
					                </div>
					            </div>

					        	<div id="signUpshowdiv" hidden="" class="row">
					                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
					                    <form method="post" action="{{ route('checkRegistration') }}">
					                        <fieldset>
								                <h2 class="text-center fontx">Make an Account</h2>
								                <hr class="colorgraph">
								                <div class="row">
								                  <div class="col-xs-12 col-sm-4 col-md-4">
								                    <div class="form-group">
								                      <input type="text" name="fname" id="first_name" class="form-control input-lg" placeholder="First Name" tabindex="1">
								                    </div>
								                  </div>
								                  <div class="col-xs-12 col-sm-4 col-md-4">
								                    <div class="form-group">
								                      <input type="text" name="mname" id="middle_name" class="form-control input-lg" placeholder="Middle Name" tabindex="2">
								                    </div>
								                  </div>
								                  <div class="col-xs-12 col-sm-4 col-md-4">
								                    <div class="form-group">
								                      <input type="text" name="lname" id="last_name" class="form-control input-lg" placeholder="Last Name" tabindex="2">
								                    </div>
								                  </div>
								                </div>
								                <div class="form-group">
								                  <input type="contact" name="contact" id="contact" class="form-control input-lg" placeholder="Contact Number" tabindex="3">
								                </div>
								                <!--start of customer Address-->
								                <hr>
												<h4 class="text-center fontx">Customer Address</h4>
												<div class = "row">
									                <div class="col-md-6">
									                  <input type="contact" name="address_Line" id="address_Line" class="form-control input-lg" placeholder="House No./Street Name" tabindex="4">
									                </div>

									                <div class="col-md-6">
									                  <input type="contact" name="baranggay" id="baranggay" class="form-control input-lg" placeholder="Baranggay" tabindex="4">
									                </div>
												</div>

												<div class = "row">
									                <div class="form-group col-md-6">
									                  <select name="ProvinceField" id="ProvinceField" class="form-control input-lg" tabindex="5" required>
									                  	<option value = "-1" data-tag = "-1" disabled selected> Choose Province</option>
									                  @foreach($province as $prov)
								                        <option value ="{{$prov->id}}" > {{$prov->name}} </option>
								                      @endforeach
									                  </select>
									                </div>

									                <div class="form-group col-md-6">
									                  <select name="TownField" id="TownField" class="form-control input-lg" tabindex="6" required>
									                  	<option value = "-1" data-tag = "-1" disabled selected> Choose City</option>
									                  @foreach($city as $city)
								                        <option value ="{{$city->id}}" data-tag = "{{$city->province_id}}"> {{$city->name}} </option>
								                      @endforeach
									                  </select>
									                </div>
												</div>
								                <!--end of customer Address-->


								                <!--start of Acct Info-->
								                <hr>
												<h4 class="text-center fontx">Account Information</h4>
                                <div class="form-group">
								                  <input type="email" name="signemail" id="signemail" class="form-control input-lg" placeholder="Email Address" tabindex="7">
                                  <h5 hidden id="erroremail" style="color: Red;">Invalid Username</h5>
                                </div>
								                <div class="form-group">
								                  <input type="text" name="username" id="username" class="form-control input-lg" placeholder="Username" tabindex="8">
                                  <h5 hidden id="errorusername" style="color: Red;">Invalid Username</h5>
                                </div>
								                <div class="row">
								                  <div class="col-xs-12 col-sm-6 col-md-6">
								                    <div class="form-group">
								                      <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="9">
								                    </div>
								                  </div>
								                  <div class="col-xs-12 col-sm-6 col-md-6">
								                    <div class="form-group">
								                      <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="Confirm Password" tabindex="10">
								                    </div>
								                  </div>
								                </div>
								                <!--start of Acct Info-->

								                <hr class="colorgraph">
								                <div class="row">

                                  <div class="col-xs-12 col-md-12">

								                  	<button type="submit" id="registerbutt" class="btn btn-success btn-block btn-lg fontxx">Register Account</button><!--kapag nasubmit mo na tong button na to kelangan ay maglogin na agad at magderetso sa step 2, kapag di pa nakalogin-->
                                  </div>
								                </div>
								                {{ csrf_field() }}
					                        </fieldset>
					                    </form>
					                    <br>
					                </div>
					            </div>
					            <br>
					            <br>
					            <br>

<!--for guest checkout-->

					        	<div id="Guestshowdiv" hidden="" class="row">
					                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
					                    <form  id="guest_form" name="guest_form" method="POST">
					                        <fieldset>
								                <h2 class="text-center fontx">Provide Customer Information</h2>
								                <hr class="colorgraph">
								                <div class="row">
								                  <div class="col-xs-12 col-sm-4 col-md-4">
								                    <div class="form-group">
								                      <input type="text" name="Guest_Fname" id="Guest_Fname" class="form-control input-lg" placeholder="First Name" tabindex="1" required/>
								                    </div>
								                  </div>
								                  <div class="col-xs-12 col-sm-4 col-md-4">
								                    <div class="form-group">
								                      <input type="text" name="Guest_Mname" id="Guest_Mname" class="form-control input-lg" placeholder="Middle Name" tabindex="2" required/>
								                    </div>
								                  </div>
								                  <div class="col-xs-12 col-sm-4 col-md-4">
								                    <div class="form-group">
								                      <input type="text" name="Guest_Lname" id="Guest_Lname" class="form-control input-lg" placeholder="Last Name" tabindex="3" required/>
								                    </div>
								                  </div>
								                </div>
								                <div class="form-group">
								                  <input type="contact" name="Guest_contact" id="Guest_contact" class="form-control input-lg" placeholder="Contact Number" tabindex="4" required/>
								                </div>

								                <div class="form-group">
								                  <input type="email" name="Guest_email" id="Guest_email" class="form-control input-lg" placeholder="Email Address" tabindex="5" required/>
								                </div>
								                <!--start of customer Address-->
								                <hr>
												<h4 class="text-center fontx">Customer Address</h4>
												<div class = "row">
									                <div class="col-md-6">
									                  <input type="contact" name="Guestaddress_Line" id="Guestaddress_Line" class="form-control input-lg" placeholder="House No./Street Name" tabindex="6" required>
									               </div>

									                <div class="col-md-6">
									                  <input type="contact" name="Guest_baranggay" id="Guest_baranggay" class="form-control input-lg" placeholder="Baranggay" tabindex="7" required>
									                </div>
												</div>

												<div class = "row">
									                <div class="form-group col-md-6">
									                  <select name="ProvinceField0" id="ProvinceField0" class="form-control input-lg" tabindex="5" required>
									                  	<option value = "-1" data-tag = "-1" disabled selected> Choose Province</option>
									                  @foreach($province3 as $prov)
								                        <option value ="{{$prov->id}}" > {{$prov->name}} </option>
								                      @endforeach
									                  </select>
									                </div>

									                <div class="form-group col-md-6">
									                  <select name="TownField0" id="TownField0" class="form-control input-lg" tabindex="6" required>
									                  	<option value = "-1" data-tag = "-1" disabled selected> Choose City</option>
									                  @foreach($city3 as $city)
								                        <option value ="{{$city->id}}" data-tag = "{{$city->province_id}}"> {{$city->name}} </option>
								                      @endforeach
									                  </select>
									                </div>
												</div>
								                <!--end of customer Address-->

								                <hr class="colorgraph">
								                <div class="row">
								                  <div class="center pull-right">
														<button id = 'savBtnAcct' type="submit" class="btn btn-primary next-step text-center">Save and continue</button>
								                  </div>
								                </div>
								                {{ csrf_field() }}
					                        </fieldset>
					                    </form>
					                    <br>
					                </div>
					            </div>
					            <ul>
			                	<ul>
		                    </div>
		                    <div class="tab-pane" role="tabpanel" id="step2">


		                    	<div hidden="">
		                    		<input id="optionfield" type="text" name="">
		                    	</div>
		                        <div class="row">
		                        	<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		                        		<h2 class="text-center fontx">Choose From the following</h2>
							            <hr class="colorgraph">
							            <div class="row">
								            <div class="col-md-offset-2 col-md-4">
								            	<div class="">
								            		<a id="pickupshow" href="#" type="button" class="btn btn-default btn-lg btn-app"> <i class="material-icons">shopping_basket</i> Pickup</a>
								            	</div>
								            </div>
								            <div class="col-md-offset-2 col-md-4">
								            	<div class="">
								            		<button id="deliveryshow" type="button" class="btn btn-default btn-lg btn-app"><i class="material-icons">directions_car</i> Deliver</button>
                                <input type="hidden" id="count" value="{{ (str_replace(array(','), array(''), Cart::instance('finalboqcart')->subtotal()) + str_replace(array(','), array(''),
                                Cart::instance('flowerwish')->subtotal()) ) }}">
								            	</div>
								            </div>
								        </div>
								        <br>
								        <br>
								        <br>
		                        	</div>
					              	<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
					              		<div id="deliveryshowdiv" hidden="">
						              		<form role="form">
								                <h3 class="text-center fontx">Delivery Details</h2>
								                <hr class="colorgraph">


								                <!--Maghahide to kapag ang pinili ay guest checkout pero once na nakalogin automatic na nakacheck to at laman ng mga fields ay ang mga details ng user's acct., tanging yung delivery date at time lang ang naka enabled kapag inuncheck to ay magkiclear yung fields for delivery details at maeenabled-->
														<div id="useMyAcctDetailsDiv">
															<label>
																<input type="checkbox" name="UseMydetailsCheckboxe" id="UseMydetailsCheckboxe">
																		Use my Account's Details
															</label>
														</div>

														<div id="guestDetails">
															<label>
																<input type="checkbox" name="guestDetailscheck" id="guestDetailscheck">
																		Use my Account's Details
															</label>
														</div>


								                <label for="" class="text-center fontx">Recipient Details</label>

								                <div class="row">
								                	<div class="col-xs-12 col-sm-4 col-md-4">
								                    	<div class="form-group">
								                      		<input type="text" name="R_first_name" id="R_first_name" class="form-control input-lg" placeholder="First Name" tabindex="1">
								                    	</div>
								                    </div>
									                <div class="col-xs-12 col-sm-4 col-md-4">
									                    <div class="form-group">
									                      	<input type="text" name="R_mid_name" id="R_mid_name" class="form-control input-lg" placeholder="Middle Name" tabindex="2">
									                    </div>
									                </div>
									                <div class="col-xs-12 col-sm-4 col-md-4">
									                    <div class="form-group">
									                      	<input type="text" name="R_last_name" id="R_last_name" class="form-control input-lg" placeholder="Last Name" tabindex="2">
									                    </div>
									                </div>
						               			</div>
						             			<div class="col-xs-12 col-sm-12 col-md 12">
									                <div class="form-group">
									                	<input type="number" name="R_contact" id="R_contact" class="form-control input-lg" placeholder="Contact Number" tabindex="7">
									                </div>
									            </div>
									            <br>

								                <label for="" class="text-center fontx">Address Line</label>
								                <div class="row">
								                  	<div class="col-xs-12 col-md-6 col-sm-6">
								                    	<div class="form-group">
								                      	<input type="text" name="R_DeliveryAddressLine" id="R_DeliveryAddressLine" class="form-control input-lg" placeholder="Lot/Unit No/Street" tabindex="4">
								                    	</div>
								                	</div>
								                  	<div class="col-xs-12 col-md-6 col-sm-6">
								                    	<div class="form-group">
								                      	<input type="text" name="R_DeliveryBrgy" id="R_DeliveryBrgy" class="form-control input-lg" placeholder="Baranggay" tabindex="4">
								                    	</div>
								                	</div>
							                	</div>
							                	<div class="row">
							                		<div class="col-xs-12 col-sm-6 col-md-6">
							                			<label for="" class="text-center fontx">Province</label>
							                		</div>
							                		<div class="col-xs-12 col-sm-6 col-md-6">
							                			<label for="" class="text-center fontx">City/Municipality</label>
							                		</div>
							                	</div>
								                <div class="row">
							                  		<div class="col-xs-12 col-sm-6 col-md-6">
							                    		<div class="form-group">
							                      			<select name="DeliveryProvinceField" id="DeliveryProvinceField" class="form-control fontxx" required>
									                  				<option value = "-1" data-tag = "-1" disabled selected> Choose Province</option>
												                @foreach($province2 as $prov)
											                        <option value ="{{$prov->id}}" > {{$prov->name}} </option>
											                  @endforeach
									                  		</select>
							                    		</div>
							                  		</div>
							                  		<div class="col-xs-12 col-sm-6 col-md-6">
							                    		<div class="form-group">
							                        		<select name="DeliveryTownField" id="DeliveryTownField" class="form-control fontxx" required>
											                  		<option value = "-1" data-tag = "-1" disabled selected> Choose City</option>
											                  	@foreach($city2 as $city)
										                        	<option value ="{{$city->id}}" data-tag = "{{$city->province_id}}"> {{$city->name}} </option>
											                    @endforeach
											                     </select>
							                    		</div>
							                  		</div>
									            </div>
									            <div class="row">
									            	<div class="col-xs-12 cold-md-12 col-sm-12">
									            		<div class="box box-primary">
										            <div class="box-header">
										            </div>
										            <div class="box-body">
										              <!-- Date -->
										              	<div class="col-md-6">
											              	<div class="form-group">
											                	<label>Date of Delivery</label>

											                	<div class="input-group date">
											                 	 	<div class="input-group-addon">
											                    		<i class="fa fa-calendar"></i>
											                  		</div>
											                  		<input type="text" class="form-control pull-right" id="to">
											                	</div>
											                	<!-- /.input group -->
											              	</div>
											             </div>
										              	<div class="col-md-6">
										              		<!-- time Picker -->
												            <div class="bootstrap-timepicker">
												                <div class="form-group">
												                	<label>Time Of delivery:</label>
													                <div class="input-group">
													                    <input type="text" id="timepicker1" class="form-control timepicker">
													                    <div class="input-group-addon">
													                    	<i class="fa fa-clock-o"></i>
													                    </div>
													                </div>
												            	</div>
												         	</div>
												        </div>
										            </div>
										        </div>
									            	</div>

									            </div>
							                </form>
							            </div>
						                <div id="pickupshowdiv" hidden="">
							                <h3 class="text-center fontx">Pick Up Details</h2>
								            <hr class="colorgraph">
								            <div class="col-md-12">
										        <div class="box box-primary">
										            <div class="box-header">
										             	<h3 class="box-title">Date of Pickup</h3>
										            </div>
										            <div class="box-body">
										              <!-- Date -->
										              	<div class="col-md-6">
											              	<div class="form-group">
											                	<label>Date:</label>

											                	<div class="input-group date">
											                 	 	<div class="input-group-addon">
											                    		<i class="fa fa-calendar"></i>
											                  		</div>
											                  		<input type="text" class="form-control pull-right" id="datepicker2">
											                	</div>
											                	<!-- /.input group -->
											              	</div>
											             </div>
										              	<div class="col-md-6">
										              		<!-- time Picker -->
												            <div class="bootstrap-timepicker">
												                <div class="form-group">
												                	<label>Time:</label>
													                <div class="input-group">
													                    <input type="text" name="timepicker2" id="timepicker2" class="form-control timepicker">
													                    <div class="input-group-addon">
													                    	<i class="fa fa-clock-o"></i>
													                    </div>
													                </div>
												            	</div>
												         	</div>
												        </div>
										            </div>
										        </div>
										    </div>
								        </div>
						            </div>
						        </div>
						        <br>
						        <br>
						        <br>
		                        <ul class="list-inline center">
		                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
		                            <li><button id = 'PickUpDeliverybtn' type="button" class="btn btn-primary next-step" onclick="getData()">Save and continue</button></li>
		                        </ul>
		                    </div>
		                    <div class="tab-pane" role="tabpanel" id="step3">
		                    	<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		                    		<div id="pickuppayment" hidden>
				                        <h3 class="fontx text-center">Payment Options (Pick Up)</h3>
				                        <hr class="colorgraph">
				                        <div class="funkyradio text-center fontxx">
									        <div class="funkyradio-default col-md-4">
									            <input type="radio" name="radio" id="radio1" />
									            <label for="radio1">Bank Deposit</label>
									        </div>
									        <div class="funkyradio-default fx">
									            <input type="radio" name="radio" id="radio2" />
									            <label for="radio2">Cash</label>
									        </div>

									        <div class="row">
												<div class="col-md-12">
													<div class="panel panel-info">
														<div class="panel-heading">
															<h3 class="panel-title">Option Details</h3>
															<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
														</div>
														<div class="panel-body">
															Panel content
															<br>
															<br>
														</div>
													</div>
												</div>
											</div>
									        <br>
									        <br>
									    </div>
									    <ul class="list-inline center" style="margin-top: 50px;">
				                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
				                            <li><button type="button" id="step3button" class="btn btn-primary next-step">Save and continue</button></li>
				                        </ul>
									</div>
									<div id="deliverypayment" hidden>
								        <h3 class="fontx text-center">Payment Options (Delivery)</h3>
				                        <hr class="colorgraph">
				                        <div class="funkyradio text-center fontxx">
									        <div class="funkyradio-default col-md-4">
									            <input type="radio" name="radio" id="radiocod"/>
									            <label for="radiocod">Cash on Delivery</label>
									        </div>
									        <div class="funkyradio-default fx">
									            <input type="radio" name="radio" id="radiobk" />
									            <label for="radiobk">Bank Deposit</label>
									        </div>

									        <div class="row">
												<div class="col-md-12">
													<div class="panel panel-info">
														<div class="panel-heading">

                          		<h3 class="panel-title">Option Details</h3>
															<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
														</div>
														<div class="panel-body">
															Panel content
															<br>
															<br>
														</div>
													</div>
												</div>
											</div>
									        <br>
									        <br>
									    </div>
				                        <ul class="list-inline center" style="margin-top: 50px;">
				                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
				                            <li><button type="button" id="paydelivery" class="btn btn-primary next-step">Save and continue</button></li>
				                        </ul>
				                    </div>
			                    </div>
		                    </div>
		                    <div class="tab-pane" role="tabpanel" id="complete">
		                        <div class="col-xs-12 ">
			                        <h3 class="fontx text-center">Summary</h3>
			                        <hr class="colorgraph">
			                        <p class="text-center" style = "color:red;"><b>* You have successfully completed all steps. Now All you need to do is Submit the order</b></p>
			                        <br>
			                        <br>
			                        <div id = "pickupSummaryDiv">
											<!--Form() open dito-->
                      <form method="post" action="{{ route('checkoutfinalpickup') }}">
											<div class="row pull-right">
												<div hidden><!-- dapat ay hidden tong div na to Jom para lang to sa pagsubmit ng details sa controller -->
													<!--ito yung isasubmit mo sa form open mo para makuha mo yung details na kelangan mo for order_details na table ilagay mo to sa route na pang delivery lang ang sinesave at iba rin ang routes ng pang pickup lang ang sinesave

													paano magkakalaman ito?
													steps: lagyan ng javascript ang mga buttons at fields sa step 2 ng checkout, kapag onchange ng mga required fields sa delivery details ay magiging ganun din ang values ng mga fields dito

													pag naclick yung cash on delivery na radio button ay magiging value ng input na may id na final_paymentmethod ay 'cash'

													pag naclick yung Bank Deposite na radio button ay magiging value ng input na may id na final_paymentmethod ay 'bank'
													-->

                          <!-- JOMECHAEL POGI -->

													 <input id = 'finalPickup_Date' name = 'finalPickup_Date'>
													 <input id = 'finalPickup_Time' name = 'finalPickup_Time'>

													 <input id = 'cust_type' name = 'cust_type' ><!-- pag guest ang lalagay mo dito ay guest means walang acct. tong si customer-->
													 <input id = 'customer_ID' name = 'customer_ID' ><!-- pag guest ang lalagay mo dito ay none-->

														<!-- pag guest ang lalagay mo dito sa mga fields nato ay yung laman ng fields na sinagutan mo sa providecustomer information pero pag hindi guest ay yung details ng customer na nakalogin or details ng iniregister ng customer sa registration-->

													 <input id = 'finalCustomer_FName' name = 'finalCustomer_FName'>
													 <input id = 'finalCustomer_MName' name = 'finalCustomer_MName'>
													 <input id = 'finalCustomer_LName' name = 'finalCustomer_LName'>
													 <input id = 'finalCustomer_Number' name = 'finalCustomer_Number'>
													 <input id = 'final_paymentMethod' name = 'final_paymentMethod'><!--cash /bank-->
													 <input id = 'final_shippingMethod' name = 'final_shippingMethod' value = 'pickup'> <!--Take note: kapag isesave naman sa shop_schedule na table tong order na to, ang magiging schedule type ay 'order_Pickup'-->

												</div>

				                       			<div class = "col-md-6 ">
					                        		<a type="button" class="btn btn-danger btn-lg prev-step"> Edit Order Details</a><!--redirects you to the previous steps-->
				                       			</div>
				                       			<div class = 'col-md-6'>
				                        			<button type="submit" id ="pickupsubmit" class="btn btn-success btn-lg"> Submit My Order</button><!-- call a route that saves order for delivery only,
						                        		 Saves the the orders to the database, generates a pdf of the order summary the design is same with this summary and hides the Edit Order Details buttons-->
				                       			</div>
                                    <div class = 'col-md-6'>
				                        			<button type="submit" id ="pickupsubmit" class="btn btn-success btn-lg"> </button><!-- call a route that saves order for delivery only,
						                        		 Saves the the orders to the database, generates a pdf of the order summary the design is same with this summary and hides the Edit Order Details buttons-->
				                       			</div>
				                        	</div>
                                  {{csrf_field()}}
                              </form>
											<!--Form() close dito-->
			                        <div class="row">
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
                                  @foreach(Cart::instance('flowerwish')->content() as $row)

                                  <tr>
                                  <th scope="row" class="text-center">{{ $row -> id }}</th>
                                    <td class="text-center">{{ $row -> name }}</td>
                                    <td class="text-center">₱ {{ $row -> price }}</td>
                                    <td class="text-center">{{ $row -> qty}} Pcs</td>
                                    <td class="text-center">₱ {{ $row -> price * $row-> qty }}</td>

                                  </tr>
                                  @endforeach

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
                              </thead>
                               @foreach(Cart::instance('finalboqcart')->content() as $row)

                              <tbody>
                                 <tr>

                                  <th scope="row">{{$row -> id}}</th>
                                  <td>{{$row -> name}}</td>
                                  <td>{{$row -> price}}</td>
                                  <td>{{$row -> qty}}</td>

                                   <td>
                                    <table class="table table-bordered" style="overflow-x:auto;">
                                       <thead>


                                        <th class="text-center">Item ID</th>
                                    <th class="text-center">Item Name</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Total Price</th>
                                   </thead>
                                    @foreach(Cart::instance('finalflowerbqt')->content() as $row1)

                                   <tbody>
                                        @if($row->id == $row1 -> options -> Bqt_ID)
                                    <th scope="row">{{$row1 -> id}}</th>
                                      <td>{{ $row1 -> name}}</td>
                                      <td>{{ $row1 -> price}}</td>
                                      <td>{{ $row1 -> qty}}</td>
                                      <td>{{ $row1 -> price * $row1 -> qty}}</td>
                                       @endif

                                   </tbody>
                                 @endforeach
                                 @foreach(Cart::instance('finalacccart')->content() as $row2)

                                 <tbody>
                                     @if($row->id == $row2 -> options -> Bqt_ID)
                                  <th scope="row">{{$row2 -> id}}</th>
                                    <td>{{ $row2 -> name}}</td>
                                    <td>{{ $row2 -> price}}</td>
                                    <td>{{ $row2 -> qty}}</td>
                                    <td>{{ $row2 -> price * $row2 -> qty}}</td>
                                    @endif

                                </tbody>
                              @endforeach

                                </table>
                                  </td>



                               </tr>
                              </tbody>
                             @endforeach
																	</table>
															      </td>
															    </tr>

															  </tbody>
															</table>
														</div>
													</div>
													<div class="col-md-offset-6">
														<h3 class="fontx text-center"> TOTAL AMOUNT: {{(number_format (str_replace(array(','), array(''), Cart::instance('finalboqcart')->subtotal()) + str_replace(array(','), array(''),
                            Cart::instance('flowerwish')->subtotal()), 0 ))}}</h3>
													</div>
												</div>
											</div>
										</div>
										</div>
										<div id = "deliverySummaryDiv">
                      <form method="post" action="{{ route('checkoutfinal')}}">

											<!--Form() open dito-->
											<div class="row pull-right">
												<div  hidden><!-- dapat ay hidden tong div na to Jom para lang to sa pagsubmit ng details sa controller -->
													<!--ito yung isasubmit mo sa form open mo para makuha mo yung details na kelangan mo for order_details na table ilagay mo to sa route na pang delivery lang ang sinesave at iba rin ang routes ng pang pickup lang ang sinesave

													paano magkakalaman ito?
													steps: lagyan ng javascript ang mga buttons at fields sa step 2 ng checkout, kapag onchange ng mga required fields sa delivery details ay magiging ganun din ang values ng mga fields dito

													pag naclick yung cash on delivery na radio button ay magiging value ng input na may id na final_paymentmethod ay 'cash'

													pag naclick yung Bank Deposite na radio button ay magiging value ng input na may id na final_paymentmethod ay 'bank'
													-->

                          <!-- POGI TALGA SI JOMECHAEL -->

													<!-- pag guest ang lalagay mo dito sa mga fields nato ay yung laman ng fields na sinagutan mo sa providecustomer information pero pag hindi guest ay yung details ng customer na nakalogin or details ng iniregister ng customer sa registration-->

													 <input id = 'Cust_FName' name = 'Cust_FName'>
													 <input id = 'Cust_MName' name = 'Cust_MName'>
													 <input id = 'Cust_LName' name = 'Cust_LName'>
													 <input id = 'Cust_Number' name = 'Cust_Number'>

													 <input id = 'Cust_AddrsLine' name = 'Cust_AddrsLine'>
													 <input id = 'Cust_Brgy' name = 'Cust_Brgy'>
													 <input id = 'Cust_prov' name = 'Cust_prov'>
													 <input id = 'Cust_city' name = 'Cust_city'>

													 <input id = 'Cust_Date' name = 'Cust_Date'>
													 <input id = 'Cust_Time' name = 'Cust_Time'>

													 <input id = 'finalrecipient_FName' name = 'finalrecipient_FName'>
													 <input id = 'finalrecipient_MName' name = 'finalrecipient_MName'>
													 <input id = 'finalrecipient_LName' name = 'finalrecipient_LName'>
													 <input id = 'finalrecipient_Number' name = 'finalrecipient_Number'>
													 <input id = 'Cust_paymentMethod' name = 'Cust_paymentMethod'><!--cash kapag COD-->
													 <input id = 'Cust_shippingMethod' name = 'Cust_shippingMethod' value = 'delivery'> <!--Take note: kapag isesave naman sa shop_schedule na table tong order na to, ang magiging schedule type ay 'order_Delivery'-->

												</div>

				                       			<div class = "col-md-6 ">
					                        		<a type="button" class="btn btn-danger btn-lg prev-step"> Edit Order Details</a><!--redirects you to the previous steps-->
				                       			</div>
				                       			<div class = 'col-md-6'>
				                        			<button type="submit" class="btn btn-success btn-lg" id="deliverysubmit"> Submit My Order</button><!-- call a route that saves order for delivery only,
						                        		 Saves the the orders to the database, generates a pdf of the order summary the design is same with this summary and hides the Edit Order Details buttons-->
				                       			</div>
                                  </div>
                                    {{csrf_field()}}

                      </form>
											<!--Form() close dito-->

										<div class="row">
											<div class="col-md-12">
												<div class="panel panel-info">
													<div class="panel-heading">
														<h3 class="panel-title">Order Summary (Delivery)</h3>
														<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
													</div>
													<div class="panel-body">
														<div class="col-md-8">
                                <h5><b>Customer Name:</b></h5>
															<div class="form-group">

									                      		<input type="text" name="fullname" id="fullname" class="form-control input-lg"  disabled>
									             </div>
														</div>
														<div class="col-md-3">
                                <h5><b>Customer Number:</b></h5>
															<div class="form-group">
									                      		<input type="text" name="cust_contact" id="cust_contact" class="form-control input-lg"  disabled>
									            </div>
														</div>
														<div class="col-md-4 ">
                              <h5><b>Customer Mode:</b></h5>
															<div class="form-group">
									                      		<input type="text" name="cust_mode" id="cust_mode" class="form-control input-lg"  disabled>
									            </div>
														</div>
														<div class="col-md-3 ">
                              <h5><b>Customer Email:</b></h5>
															<div class="form-group">
									                      		<input type="textr" name="cust_email" id="cust_email" class="form-control input-lg"  disabled>
									            </div>
														</div>
														<div class="col-md-5">
															<p> <b> Note: Please send a picture of your Deposit Slip through our email-address. <a href="#"> See example!</a> </b></p>
														</div>
															<hr>
														<div class = "col-md-12">
															<h3 class="fontx text-left">Delivery Details</h3>
															<hr class="colorgraph">

															<div class = "row">
																<div class = "col-md-8">
																	<h5><b>Recipient Name:</b></h5>
																	<input type="text" name="recipientName" id="recipientName" class="form-control input-lg"  disabled>
																</div>
																<div class = "col-md-3">
																	<h5><b>Recipient Contact Number:</b></h5>
																	<input type="text" name="reccontact" id="reccontact" class="form-control input-lg"  disabled>
																</div>
															</div>
															<div class = "row">
																<div class = "col-md-6">
																	<h5><b>Date to deliver:</b></h5>
																	<input type="text" name="devdate" id="devdate" class="form-control input-lg" value="" disabled>
																</div>
																<div class = "col-md-6">
																	<h5><b>Time:</b></h5>
																	<input type="text" name="devtime" id="devtime" class="form-control input-lg"   disabled>
																</div>
															</div>
															<div class = "row">
																<div class = "col-md-12">
																	<h5><b>Delivery Address:</b></h5>
																	<input type="text" name="delivadd" id="delivadd" class="form-control input-lg"  disabled>
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
                                  @foreach(Cart::instance('flowerwish')->content() as $row)

                                  <tr>
                                  <th scope="row" class="text-center">{{ $row -> id }}</th>
															      <td class="text-center">{{ $row -> name }}</td>
															      <td class="text-center">₱ {{ $row -> price }}</td>
															      <td class="text-center">{{ $row -> qty}} Pcs</td>
															      <td class="text-center">₱ {{ $row -> price * $row-> qty }}</td>

															    </tr>
                                    @endforeach
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
                                @foreach(Cart::instance('finalboqcart')->content() as $row)

															  <tbody>
                                  <tr>

															      <th scope="row">{{$row -> id}}</th>
															      <td>{{$row -> name}}</td>
															      <td>{{$row -> price}}</td>
															      <td>{{$row -> qty}}</td>

                                    <td>
															      	<table class="table table-bordered" style="overflow-x:auto;">
                                        <thead>


       	 																<th class="text-center">Item ID</th>
																	    <th class="text-center">Item Name</th>
																	    <th class="text-center">Price</th>
																	    <th class="text-center">Qty</th>
																	    <th class="text-center">Total Price</th>
																	   </thead>
                                     @foreach(Cart::instance('finalflowerbqt')->content() as $row1)

																	   <tbody>
                                         @if($row->id == $row1 -> options -> Bqt_ID)
																	   	<th scope="row">{{$row1 -> id}}</th>
																	      <td>{{ $row1 -> name}}</td>
																	      <td>{{ $row1 -> price}}</td>
																	      <td>{{ $row1 -> qty}}</td>
																	      <td>{{ $row1 -> price * $row1 -> qty}}</td>
                                        @endif

                                    </tbody>
                                  @endforeach
                                  @foreach(Cart::instance('finalacccart')->content() as $row2)

                                  <tbody>
                                      @if($row->id == $row2 -> options -> Bqt_ID)
                                   <th scope="row">{{$row2 -> id}}</th>
                                     <td>{{ $row2 -> name}}</td>
                                     <td>{{ $row2 -> price}}</td>
                                     <td>{{ $row2 -> qty}}</td>
                                     <td>{{ $row2 -> price * $row2 -> qty}}</td>
                                     @endif

                                 </tbody>
                               @endforeach

																	</table>
															      </td>



															   </tr>
															  </tbody>
                              @endforeach

															</table>
														</div>
													</div>
													<div class="col-md-offset-6">
														<h3 class="fontx text"> TOTAL AMOUNT: {{(number_format (str_replace(array(','), array(''), Cart::instance('finalboqcart')->subtotal()) + str_replace(array(','), array(''),
                            Cart::instance('flowerwish')->subtotal()), 0 ))}}</h3>
													</div>
													<p class="text-center"><b>Take Note: You must send the copy of your deposit slip (Amounting of 20% minimum of total amount)</b></p>
												</div>
											</div>
										</div>
										</div>

			                    </div>
		                    </div>
		                    <div class="clearfix"></div>
		                </div>
		            </form>
		        </div>
		    </section>
		   </div>
		</div>
		@endsection
		@section('script')
			<script>
		    	$(document).ready(function () {

          var email = $("#signemail").val();
          console.log(email);
          if(email == "hello@yahoo.com"){
            $("#registerbutt").attr('disabled', true);
          }


          $("#TownField").attr('disabled',true);
					$("#TownField0").attr('disabled',true);
					$("#DeliveryTownField").attr('disabled',true);

					$('#ProvinceField0').change(function(){
			          $("#TownField0").removeAttr("disabled");
			          $("#TownField0").attr('required', true);
			                  var selected = $(this).val();
			                  $("#TownField0 option").each(function(item){
			                   // console.log(selected) ;
			                    var element =  $(this) ;
			                    //console.log(element.data("tag")) ;
			                    if (element.data("tag") != selected){
			                      element.hide() ;
			                    }
			                    else{
			                      element.show();
			                    }
			                  }) ;

			                $("#TownField0").val($("#TownField0 option:visible:first").val());

			        });//end of function

					$('#ProvinceField').change(function(){
			          $("#TownField").removeAttr("disabled");
			          $("#TownField").attr('required', true);
			                  var selected = $(this).val();
			                  $("#TownField option").each(function(item){
			                   // console.log(selected) ;
			                    var element =  $(this) ;
			                    //console.log(element.data("tag")) ;
			                    if (element.data("tag") != selected){
			                      element.hide() ;
			                    }
			                    else{
			                      element.show();
			                    }
			                  }) ;

			                $("#TownField").val($("#TownField option:visible:first").val());

			        });//end of function


					$('#DeliveryProvinceField').change(function(){
			          $("#DeliveryTownField").removeAttr("disabled");
			          $("#DeliveryTownField").attr('required', true);
			                  var selected = $(this).val();
			                  $("#DeliveryTownField option").each(function(item){
			                   // console.log(selected) ;
			                    var element =  $(this) ;
			                    //console.log(element.data("tag")) ;
			                    if (element.data("tag") != selected){
			                      element.hide() ;
			                    }
			                    else{
			                      element.show();
			                    }
			                  }) ;

			                $("#DeliveryTownField").val($("#DeliveryTownField option:visible:first").val());

			        });//end of function

					$('#pickupshow').click (function (){
						var OptionValue = 'pickup';
						$('#optionfield').val (OptionValue);
						$('#pickuppayment').show("fold");
						$('#deliverypayment').hide("fold");
						$('#deliveryshowdiv').hide("fold");
						$('#deliverySummaryDiv').hide("fold");
						$('#pickupSummaryDiv').show("fold");
                        $('#guestDetails').hide();
					});


					$('#deliveryshow').click (function (){
						var OptionValue = 'delivery';
						$('#optionfield').val (OptionValue);
						$('#deliverypayment').show("fold");
						$('#pickuppayment').hide("fold");
						$('#pickupshowdiv').hide("fold");
						$('#pickupSummaryDiv').hide("fold");
						$('#deliverySummaryDiv').show("fold");
                        $('#guestDetails').hide	();
					});

					$("#guestRdoBtn").click(function(){
						$("#loginshowdiv").hide("fold");
						$("#signUpshowdiv").hide("fold");
						$("#Guestshowdiv").show("fold");
						$("#savBtnAcct").show("fold");
						$("#useMyAcctDetailsDiv").hide();
						$('#guestDetails').show();
					});

					$("#registerRdoBtn").click(function(){
						$("#loginshowdiv").hide("fold");
						$("#signUpshowdiv").show("fold");
						$("#savBtnAcct").hide("fold");
						$("#Guestshowdiv").hide("fold");
						$("#useMyAcctDetailsDiv").hide();
						$("#guestDetails").hide();
					});

					$("#loginshow").click (function(){
						$("#loginshowdiv").toggle("fold");
						$("#signUpshowdiv").hide("fold");
						$("#savBtnAcct").hide("fold");
						$("#Guestshowdiv").hide("fold");
						$("#useMyAcctDetailsDiv").show();
					});

					$("#pickupshow").click (function(){
						$("#deliveryshowdiv").hide("fold");
						$("#pickupshowdiv").show("fold");
					});

					$("#deliveryshow").click (function(){
						$("#deliveryshowdiv").show("fold");
						$("#pickupshowdiv").hide("fold");
					});
		    		//Date picker
				    $('#to').datepicker({
				      autoclose: true
				    });
            $('#datepicker2').datepicker({
             autoclose: true
           });

				    //Timepicker
				    $(".timepicker").timepicker({
				      showInputs: false
				    });

				    $(document).on('click', '.panel-heading span.clickable', function(e){
					    var $this = $(this);
						if(!$this.hasClass('panel-collapsed')) {
							$this.parents('.panel').find('.panel-body').slideUp();
							$this.addClass('panel-collapsed');
							$this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
						} else {
							$this.parents('.panel').find('.panel-body').slideDown();
							$this.removeClass('panel-collapsed');
							$this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
						}
					})

				    //Initialize tooltips
				    $('.nav-tabs > li a[title]').tooltip();

				    //Wizard
				    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

				        var $target = $(e.target);

				        if ($target.parent().hasClass('disabled')) {
				            return false;
				        }
				    });

				    $(".next-step").click(function (e) {

				        var $active = $('.wizard .nav-tabs li.active');
				        $active.next().removeClass('disabled');
				        nextTab($active);

				    });
				    $(".prev-step").click(function (e) {

				        var $active = $('.wizard .nav-tabs li.active');
				        prevTab($active);

				    });


				});

				function nextTab(elem) {
				    $(elem).next().find('a[data-toggle="tab"]').click();
				}
				function prevTab(elem) {
				    $(elem).prev().find('a[data-toggle="tab"]').click();
				}

        // Registering

        $('#PickUpDeliverybtn').attr('disabled', true);

        if($("#count").val() <= 3000){
          $('#deliveryshow').attr('disabled', true);
        }

        else{

          $('#deliveryshow').attr('disabled', false);


        $("#deliveryshow").click(function(){


        $("#UseMydetailsCheckboxe").click(function(){ // WITH USER

            $('#PickUpDeliverybtn').attr('disabled', true);




          if($('#UseMydetailsCheckboxe').is(':checked') == true){



            @foreach($details as $det)

              var firstName =  "{{ $det -> Cust_FName}}";
              var middlename = "{{ $det -> Cust_MName}}";
              var lastname = "{{ $det -> Cust_LName}}";
              var contact = Number("{{ $det -> Contact_Num}}");
              var addline = "{{$det -> Address_Line}}";
              var brgy = "{{ $det -> Baranggay}}";
              var Prov = "{{ $det -> Province}}";
              var town = "{{ $det -> Town}}";
              var email = "{{ $det -> Email_Address}}";

            @endforeach

            $('#DeliveryProvinceField option[value ='+Prov+']').attr("selected","selected")
            $('#DeliveryTownField option[value ='+town+']').attr("selected","selected")

			  var e = document.getElementById("DeliveryTownField");
			  var c = document.getElementById("DeliveryProvinceField");
            	var townies = e.options[e.selectedIndex].text;
            	var prownies = c.options[c.selectedIndex].text;


              $('#R_first_name').val(firstName);
            $('#R_mid_name').val(middlename);
            $('#R_last_name').val(lastname);
            $('#R_contact').val(contact);
            $('#R_DeliveryAddressLine').val(addline);
            $('#R_DeliveryBrgy').val(brgy);

            $(function() {
              $( "#to" ).datepicker({ dateFormat: 'yy-mm-dd' });
                $("#to").on("change",function(){
                    var selected = $(this).val();

                    if($('#to').val() == selected){

                      if($('#UseMydetailsCheckboxe').is(':checked') == true){


                        $('#PickUpDeliverybtn').attr('disabled', false);


                        $("#PickUpDeliverybtn").click(function(){

                          var deliverdate = $('#to').val();
                          var delivertime = $('#timepicker1').val();

                          $('#paydelivery').attr('disabled',true);

                        $('#radiocod').click(function(){
                          if($('#radiocod').is(':checked') == true){

                            $("#paydelivery").click(function() {
                              document.getElementById('Cust_FName').value = firstName;
                              document.getElementById('Cust_MName').value = middlename;
                              document.getElementById('Cust_LName').value = lastname;
                              document.getElementById('Cust_Number').value = contact;
                              document.getElementById('Cust_AddrsLine').value = addline;
                              document.getElementById('Cust_Brgy').value = brgy;
                              document.getElementById('Cust_prov').value = Prov;
                              document.getElementById('Cust_city').value = town;
                              document.getElementById('Cust_Date').value = deliverdate;
                              document.getElementById('Cust_Time').value = delivertime;
                              document.getElementById('finalrecipient_FName').value = firstName;
                              document.getElementById('finalrecipient_MName').value = middlename;
                              document.getElementById('finalrecipient_LName').value = lastname;
                              document.getElementById('finalrecipient_Number').value = contact;
                              document.getElementById('Cust_paymentMethod').value = "cash";

                              document.getElementById('fullname').value = firstName +" "+ middlename +". "+ lastname;
                              document.getElementById('cust_contact').value = contact;
                              document.getElementById('cust_mode').value = "Cash On Delivery";
                              document.getElementById('cust_email').value = email;
                              document.getElementById('recipientName').value = firstName +" "+ middlename +". "+ lastname;
                              document.getElementById('reccontact').value = contact;

                              document.getElementById('devdate').value = deliverdate;
                              document.getElementById('devtime').value = delivertime;
                              document.getElementById('delivadd').value = addline +" "+  brgy +" "+ townies +" "+ prownies;


                            });

                            $('#paydelivery').attr('disabled', false);



                          }
                        });

                          $('#radiobk').click(function(){
                            if($('#radiobk').is(':checked') == true){

                              $("#paydelivery").click(function() {
                                document.getElementById('Cust_FName').value = firstName;
                                document.getElementById('Cust_MName').value = middlename;
                                document.getElementById('Cust_LName').value = lastname;
                                document.getElementById('Cust_Number').value = contact;
                                document.getElementById('Cust_AddrsLine').value = addline;
                                document.getElementById('Cust_Brgy').value = brgy;
                                document.getElementById('Cust_prov').value = Prov;
                                document.getElementById('Cust_city').value = town;
                                document.getElementById('Cust_Date').value = deliverdate;
                                document.getElementById('Cust_Time').value = delivertime;
                                document.getElementById('finalrecipient_FName').value = firstName;
                                document.getElementById('finalrecipient_MName').value = middlename;
                                document.getElementById('finalrecipient_LName').value = lastname;
                                document.getElementById('finalrecipient_Number').value = contact;
                                document.getElementById('Cust_paymentMethod').value = "bank";

                                document.getElementById('fullname').value = firstName +" "+ middlename +". "+ lastname;
                                document.getElementById('cust_contact').value = contact;
                                document.getElementById('cust_mode').value = "Bank";
                                document.getElementById('cust_email').value = email;
                                document.getElementById('recipientName').value = firstName +" "+ middlename +". "+ lastname;
                                document.getElementById('reccontact').value = contact;

                                document.getElementById('devdate').value = deliverdate;
                                document.getElementById('devtime').value = delivertime;
                                document.getElementById('delivadd').value = addline +" "+  brgy +" "+ townies +" "+ prownies;


                              });

	                          $('#paydelivery').attr('disabled', false);



                            }
                          });

                        });

                    }

                    else {

                        $('#PickUpDeliverybtn').attr('disabled', true);


                    }

                  }
                  else{
		               $('#PickUpDeliverybtn').attr('disabled', true);

                  }


              });







            }); // Dulo


          }

          else{

            var prov = "-1";
            var town = "-1";

            $('#DeliveryProvinceField option[value ='+Prov+']').attr("selected","selected")
            $('#DeliveryTownField option[value ='+town+']').attr("selected","selected")

            $('#R_first_name').val(firstName);
            $('#R_mid_name').val(middlename);
            $('#R_last_name').val(lastname);
            $('#R_contact').val(contact);
            $('#R_DeliveryAddressLine').val(addline);
            $('#R_DeliveryBrgy').val(brgy);


          }


        });

      });

    }



        $(function() {
          $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });
            $("#datepicker2").on("change",function(){
              var selected2 = $(this).val();

              if($('#datepicker2').val() == selected2){

                $('#PickUpDeliverybtn').attr('disabled', false);

                @foreach($details as $det1)

                  var firstName =  "{{ $det1 -> Cust_FName}}";
                  var middlename = "{{ $det1 -> Cust_MName}}";
                  var lastname = "{{ $det1 -> Cust_LName}}";
                  var contact = Number("{{ $det1 -> Contact_Num}}");
                  var addline = "{{$det1 -> Address_Line}}";
                  var brgy = "{{ $det1 -> Baranggay}}";
                  var Prov = "{{ $det1 -> Province}}";
                  var town = "{{ $det1 -> Town}}";
                  var email = "{{ $det1 -> Email_Address}}";

                @endforeach




                var deliverdate2 = $('#datepicker2').val();
                var delivertime2 = $('#timepicker2').val();
              	$('#step3button').attr('disabled', true);

                $("#PickUpDeliverybtn").click(function(){

                  $('#radio1').click(function(){


                    if($('#radio1').is(':checked') == true){

                      $("#step3button").click(function() {

                        document.getElementById('finalPickup_Date').value = deliverdate2;
                        document.getElementById('finalPickup_Time').value = delivertime2;

                          document.getElementById('cust_type').value = "User";
                          document.getElementById('customer_ID').value = "";


                        document.getElementById('finalCustomer_FName').value = firstName;
                        document.getElementById('finalCustomer_MName').value = middlename;
                        document.getElementById('finalCustomer_LName').value = lastname;
                        document.getElementById('finalCustomer_Number').value = contact;
                        document.getElementById('final_paymentMethod').value = "Bank";

                        document.getElementById('fullname1').value = firstName +" "+ middlename +". "+ lastname;
                        document.getElementById('contact1').value = contact;
                        document.getElementById('mode1').value = "Bank";
                        document.getElementById('email1').value = email;

                        document.getElementById('SummarypickupDate').value = deliverdate2;
                        document.getElementById('SummarypickupTime').value = delivertime2;








                      }); // step3button

                   	$('#step3button').attr('disabled', false);


                    } // if else

                  }); // Radio

                  $('#radio2').click(function(){
                    if($('#radio2').is(':checked') == true){

                      $("#step3button").click(function() {

                        document.getElementById('finalPickup_Date').value = deliverdate2;
                        document.getElementById('finalPickup_Time').value = delivertime2;

                          document.getElementById('cust_type').value = "User";
                          document.getElementById('customer_ID').value = "";

                        document.getElementById('finalCustomer_FName').value = firstName;
                        document.getElementById('finalCustomer_MName').value = middlename;
                        document.getElementById('finalCustomer_LName').value = lastname;
                        document.getElementById('finalCustomer_Number').value = contact;
                        document.getElementById('final_paymentMethod').value = "Cash";

                        document.getElementById('fullname1').value = firstName +" "+ middlename +". "+ lastname;
                        document.getElementById('contact1').value = contact;
                        document.getElementById('mode1').value = "Cash";
                        document.getElementById('email1').value = email;

                        document.getElementById('SummarypickupDate').value = deliverdate2;
                        document.getElementById('SummarypickupTime').value = delivertime2;








                      }); // step3button


                   	$('#step3button').attr('disabled', false);

                    } // if else

                  });


                }); //PickUpDeliverybtn


              }



            });

          });

		/*		$(function(){

					$('#guest_form').submit(function(event){

						event.preventDefault();
						alert('haahahh');
                        var fname = document.getElementById('Guest_Fname').value;
                        var mname = document.getElementById('Guest_Mname').value;
                        var lname = document.getElementById('Guest_Lname').value;
                        var contact = document.getElementById('Guest_contact').value;
                        var email = document.getElementById('Guest_email').value;
                        var addline = document.getElementById('Guestaddress_Line').value;
                        var brgy = document.getElementById('Guest_baranggay').value;
                        var prov = document.getElementById('ProvinceField0').value;
                        var town = document.getElementById('TownField0').value;
                    });

				});
*/
                $(function(){
                    $("#guest_form").submit(function(event){
                        event.preventDefault();
								alert('ahhahhaa');
                    });
                });//end of form










		    </script>
		@endsection
