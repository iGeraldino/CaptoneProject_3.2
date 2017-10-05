@extends('main')

@section('content')
	<?php
		$final_Amt = str_replace(',','',Cart::instance('TobeSubmitted_FlowersQuick')->subtotal()) + str_replace(',','',Cart::instance('TobeSubmitted_BqtQuick')->subtotal());
    $Cust_Det = Session::get('newCustomerDetails');
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

            @if($Cust_Det[2] != "")
              @if($Cust_Det[4] != "")
                <p><b>Customer: </b>({{$Cust_Det[2]}}) {{$Cust_Det[3]}} {{$Cust_Det[4]}}, {{$Cust_Det[5]}}</p>
              @else
                <p><b>Customer: </b>({{$Cust_Det[2]}}) {{$Cust_Det[3]}} {{$Cust_Det[4]}} {{$Cust_Det[5]}}</p>
              @endif
            @else
              <p><b>Customer: </b>{{$Cust_Det[3]}} {{$Cust_Det[4]}}, {{$Cust_Det[5]}}</p>
            @endif

            <p><b>Contact Number: </b>{{$Cust_Det[6]}}</p>
            <p><b>Contact Email: </b>{{$Cust_Det[7]}}</p>

            @if($Cust_Det[8] == 'C')
              <p><b>Customer Type: </b>Simple Customer</p>
            @elseif($Cust_Det[8] == 'H')
              <p><b>Customer Type: </b>Hotel</p>
              <p><b>Hotel Name: </b>{{$Cust_Det[9]}}</p>
							<p style = "color:red">*please take note that shops and hotels will have 12% vat</p>
            @elseif($Cust_Det[8] == 'S')
              <p><b>Customer Type: </b>Shop</p>
              <p><b>Shop Name: </b>{{$Cust_Det[10]}}</p>
							<p style = "color:red">*please take note that shops and hotels will have 12% vat</p>
            @endif
						<div class = "text-right" style = "color:darkviolet;">
							<p><b>Total Amount of Purchase:</b> Php {{number_format($final_Amt,2)}}</p>
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
							  @foreach(Cart::instance('TobeSubmitted_FlowersQuick')->content() as $Flwr)
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
							<h7 style = "color:darkviolet;"><b>(Flower) Total: Php {{Cart::instance('TobeSubmitted_FlowersQuick')->subtotal()}}</b></h7>
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
							  @foreach(Cart::instance('TobeSubmitted_BqtQuick')->content() as $Bqt)
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
                                 @foreach(Cart::instance('TobeSubmitted_Bqt_FlowersQuick')->content() as $row1)
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
                                 @foreach(Cart::instance('QuickFinalBqt_Acessories')->content() as $row2)
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
							<h7 style = "color:darkviolet;"><b>(Bouquet) Total: Php {{Cart::instance('TobeSubmitted_BqtQuick')->subtotal()}}</b></h7>
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
						<!---start of pickup Payment method div-->
							<div id = "PickUp_Payment_MethodDiv">
									<div class="panel-body">
										<h5 class="text-center">Payment Process: </h5>
                    <hr>
                    <div class = "row">
                      <div class = "col-md-6">
                        <h5><b>Amount: </b></h5>
                      </div>
                      <div class = "col-md-6">
                        <h5 class = "text-right">Php {{number_format($final_Amt,2)}}</h5>
                      </div>
                    </div>
                    @if($Cust_Det[8] == 'H' Or $Cust_Det[8] == 'S')
                    <div class = "row">
                      <div class = "col-md-6">
                        <h5><b>Vat(12%): </b></h5>
                      </div>
                      <div class = "col-md-6">
                        <h5 class = "text-right">Php {{number_format($final_Amt*0.12,2)}}</h5>
                      </div>
                    </div>
                    <div class = "row">
                      <div class = "col-md-6">
                        <h5><b>Total Amount: </b></h5>
                      </div>
                      <div class = "col-md-6">
                        <h5 class = "text-right" style = "color:red">Php {{number_format($final_Amt+($final_Amt*0.12),2)}}</h5>
                      </div>
                    </div>
                    @else
                    <div class = "row">
                      <div class = "col-md-6">
                        <h5><b>Vat(12%): </b></h5>
                      </div>
                      <div class = "col-md-6">
                        <h5 class = "text-right">Php {{number_format($final_Amt*0.0,2)}}</h5>
                      </div>
                    </div>
                    <div class = "row">
                      <div class = "col-md-6">
                        <h5><b>Total Amount: </b></h5>
                      </div>
                      <div class = "col-md-6">
                        <h5 class = "text-right" style = "color:red">Php {{number_format($final_Amt+($final_Amt*0.0),2)}}</h5>
                      </div>
                    </div>
                    @endif
                    <hr>

                    <?php
                    $minimum = 0;
                    $vat = 0;
                     if($Cust_Det[8] == 'H' || $Cust_Det[8] == 'S'){
                       $vat = $final_Amt*0.12;
                       $minimum =  $final_Amt+$vat;
                     }
                     else{
                       $minimum =  $final_Amt+$vat;
                     }
                    ?>
                    <div class = "row">
                      <div class = "col-md-6"></div>
                      <input class = "hidden" value = "{{$final_Amt}}" id = "Amtfield" name = "Amt">
                      <input class = "hidden" value = "{{$vat}}" id = "vatfield" name = "vat">
                      <input class = "hidden" value = "{{$minimum}}" id = "totalAmtfield" name = "totalAmtfield">
                      <div class = "col-md-6">
                        <div class="form-group label-floating">
                          <label class="control-label">Enter Payment:</label>
                          <input type="number" class="form-control" name="paymentField" id="paymentField" step = "0.1" required min = "{{$minimum}}"/>
                        </div>
                      </div>
                    </div>

                    <div class = "row">
                      <div class = "col-md-6"></div>

                      <div class = "col-md-6">
                        <div class="form-group">
                          <label class="control-label">Change:</label>
                          <input type="number" class="form-control" name="changefield" id="changefield" value = "0.00" disabled/>
                          <input type="number" class="hidden form-control" name="changefield2" id="changefield2" value = "0.00"/>
                        </div>
                      </div>
                    </div>
									</div>
                  <div class = "panel-footer">
                    <a href = "{{route('Quick_Sales_Order.index')}}" class="btn btn-danger btn-tooltip" data-toggle="tooltip" data-placement="left" title="This will Reset the progress you've made in this page, and will redirect you to the previous step" data-container="body">Cancel</a>

                    <button id = "process_Btn" data-toggle = "modal" data-target="#PROCESS_MODAL" class = "btn btn-md btn-success" disabled><i class = "glyphicon glyphicon-ok-circle"></i> Process Order</button>
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
	           {!! Form::open(array('route' => 'Quick_Sales_Order.store', 'data-parsley-validate'=>'', 'method'=>'POST')) !!}
						      <div class="modal-body">
										<div hidden>
											<!--for sales order table's attributes-->
											<input id = "FinalCustomer_ID" name = "FinalCustomer_ID" type = "text" value = "{{$Cust_Det[2]}}"/>
											<input id = "customerType" name = "customerType" type = "text" value = "{{$Cust_Det[8]}}"/>
											<input id = "customerStat" name = "customerStat" type = "text" value = "{{$Cust_Det[1]}}"/>
											<input id = "OrderedCustFname" name = "OrderedCustFname" type = "text" value = "{{$Cust_Det[3]}}"/>
											<input id = "OrderedCustMname" name = "OrderedCustMname" type = "text" value = "{{$Cust_Det[4]}}"/>
											<input id = "OrderedCustLname" name = "OrderedCustLname" type = "text" value = "{{$Cust_Det[5]}}"/>
											<input id = "OrderedCust_ContactNum" name = "OrderedCust_ContactNum" type = "text" value = "{{$Cust_Det[6]}}"/>
                      <input id = "OrderedCust_email" name = "OrderedCust_email" type = "text" value = "{{$Cust_Det[7]}}"/>
                      <input id = "Amt_PaidField" name = "Amt_PaidField" type = "text"/>
											<input id = "Amt_ChangeField" name = "Amt_ChangeField" type = "text"/>
										</div>

                        @if($Cust_Det[2] != "")
                          @if($Cust_Det[4] != "")
                            <h6><b>Customer: </b>({{$Cust_Det[2]}}) {{$Cust_Det[3]}} {{$Cust_Det[4]}}, {{$Cust_Det[5]}}</h6>
                          @else
                            <h6><b>Customer: </b>({{$Cust_Det[2]}}) {{$Cust_Det[3]}} {{$Cust_Det[4]}} {{$Cust_Det[5]}}</h6>
                          @endif
                        @else
                          <h6><b>Customer: </b>{{$Cust_Det[3]}} {{$Cust_Det[4]}}, {{$Cust_Det[5]}}</h6>
                        @endif
                        @if($Cust_Det[8] == 'H' Or $Cust_Det[8] == 'S')
                        <h6><b>Hotel Name: </b>{{$Cust_Det[3]}} {{$Cust_Det[4]}}, {{$Cust_Det[5]}}</h6>
                        @endif
                        @if($Cust_Det[8] == 'H')
                          <h6><b>Customer Type: </b>Hotel</h6>
                          <h6><b>Hotel Name: </b>{{$Cust_Det[9]}}</h6>
                        @elseif($Cust_Det[8] == 'S')
                         <h6><b>Customer Type: </b>Hotel</h6>
                         <h6><b>Hotel Name: </b>{{$Cust_Det[10]}}</h6>
                        @elseif($Cust_Det[8] == 'C')
                         <h6><b>Customer Type: </b>Simple Customer</h6>
                        @endif

                        @if($Cust_Det[6] != "")
												  <h6><b>Contact No: </b>{{$Cust_Det[6]}}</h6>
                        @else
                          <h6><b>Contact No: </b>n/a</h6>
                        @endif


                        @if($Cust_Det[7] != "")
												  <h6><b>Email Address: </b>{{$Cust_Det[7]}}</h6>
                        @else
                          <h6><b>Email Address: </b>n/a</h6>
                        @endif
                        <hr>
										<div class = "row">
						        	<div class = "col-md-6">
											</div>
											<div id = "total_Amt_value" class = "col-md-6">
                        <b>Amount:</b><h7 style = "color:red" class = "pull-right">  {{number_format($final_Amt,2)}}</h7>
                        <br>
												<b>VAT(12%):</b><h7 style = "color:red" class = "pull-right">  {{number_format($vat,2)}}</h7>
                        <br>
                        <b>Total Amount:</b><h7 style = "color:red" class = "pull-right"> {{number_format($minimum,2)}}</h7>
                        <hr>
                        <div id = "midiateDiv"></div>

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

    $("#process_Btn").attr("disabled",true);

    ///var TAmt = $("#totalAmtfield").val();

    $("#paymentField").change(function(){
			var TAmt = $("#totalAmtfield").val();
      var val = $("#paymentField").val();
      var change = 0;
      change = val - TAmt;
      var newChange = change.toFixed(2);
      $("#changefield").val(newChange);
      $("#changefield2").val(newChange);

      /*if($("#paymentField").val() <= 0){
        $("#process_Btn").attr("disabled",true);
      }
      else if ($("#paymentField").val() < TAmt){
        $("#process_Btn").attr("disabled",true);
      }
			else if($("#paymentField").val() >= TAmt){
				$("#process_Btn").attr("disabled",false);
			}*/
			if(newChange < 0){
				$("#process_Btn").attr("disabled",true);
			}
			else if(newChange >= 0){
				$("#process_Btn").attr("disabled",false);
			}

    });

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


		$('#process_Btn').click(function(){
			$('#orderSubmit_Btn').attr('disabled','disabled');
			$('#importantCheckBox').attr('checked',false);
        var change = $("#changefield2").val();
        var newChange = parseFloat(change).toFixed(2);
        var payment = $("#paymentField").val();
        $("#Amt_PaidField").val(payment);
        $("#Amt_ChangeField").val(newChange);
        $("#paymentDiv").remove();
        $("#midiateDiv").append('<div id = "paymentDiv"><b>Amount Paid:</b><h7 class ="pull-right"> '+payment+'</h7><br><b>Change:</b><h7 class ="pull-right"> '+newChange+'</h7></div>');
		});

	});//end of document ready
  </script>

@endsection
