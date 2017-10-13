@extends('main')

@section('content')
	<?php

    $final_Amt = 0;

		use Carbon\Carbon;

		$current = Carbon::now('Asia/Manila');

	?>

	<div class="container">
		<div class="row">
			<div class="col-md-8" style="margin-left: -7px;">
				<div class="title container" style="margin-top: 5%;">
					<h3><b>CUSTOMER'S ACCOUNT</b></h3>
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
            <div class = "row">
              <div class = "col-md-6">
								<p><b>Customer: </b>(CUST-{{$cust->Cust_ID}}) {{$cust->Cust_FName}} {{$cust->Cust_MName}}, {{$cust->Cust_LName}}</p>
								<p><b>Contact No: </b>{{$cust->Contact_Num}}</p>
								<p><b>Email: </b>{{$cust->Email_Address}}</p>

								@if($cust->Customer_Type == 'C')
									<p><b>Type: </b>Single Customer</p>
								@elseif($cust->Customer_Type == 'H')
								  <p><b>Type: </b>Hotel</p>
									<p><b>Hotel Name: </b>{{$cust->Hotel_Name}}</p>
								@elseif($cust->Customer_Type == 'S')
									<p><b>Type: </b>S</p>
									<p><b>Shop Name: </b>{{$cust->Shop_Name}}</p>
								@endif
									<p><b>Address: </b>{{$cust->Address_Line}}, {{$cust->Baranggay}}, {{$city}}, {{$prov}}</p>



              </div>
              <div class = "Col-md-6 " style = "color:darkviolet;">
									<h4><b>Total Amount of Debt: </b>Php {{number_format($debt,2)}}</h4>
              </div>
            </div>
						<div class = "btn-group text-center">
							<a class = "btn btn-md btn-info">Generate Statement of Account</a>
							<a href = "route('SalesOrder.Debts',['id'=>cust->Cust_ID])" class = "btn btn-md btn-primary">Set Payment for Multiple Orders</a>
						</div>

								<div class = "col-md-12">
									<div id = "balance_TBLDIV" hidden>
										<div class="box">
											<div class="box-header Shalala">
												<h5 class="text-center" style="color: white;"><b>ORDERS WITh BALANCE</b></h5>
											</div>
											<div class="box-body" style="overflow-x: auto;">
												<table id="spoiled_TBL" class="table table-bordered table-striped">
													<thead>
															<th class="text-center"> Order ID</th>
															<th class="text-center"> Date Created </th>
															<th class="text-center"> Shipping Method </th>
															<th class="text-center"> Status</th>
															<th class="text-center"> Amount</th>
															<th class="text-center"> Balance</th>
															<th class="text-center"> ACTION</th>
													</thead>
													<tbody>
														@foreach($b_Orders as $b_Orders)
														<tr>
															<td>ORDR-{{$b_Orders->Order_ID}}</td>
															<td>{{$b_Orders->date_created}}</td>
															<td>{{$b_Orders->Ship_Method}}</td>
															@if($b_Orders->Stat == 'P_PARTIAL')
																<td><span class = "btn btn-sm btn-warning">Partially Paid</span></td>
															@elseif($b_Orders->Stat == 'A_UNPAID')
																<td><span class = "btn btn-sm btn-danger">Acquired without paymnent</span></td>
															@elseif($b_Orders->Stat == 'A_P_PARTIAL')
																<td><span class = "btn btn-sm btn-danger">Acquired partially paid</span></td>
															@elseif($b_Orders->Stat == 'BALANCED')
																<td><span class = "btn btn-sm btn-danger">Acquired partially paid</span></td>
															@endif
															<td>Php {{number_format($b_Orders->Total_Amt,2)}}</td>
															<td>Php {{number_format($b_Orders->BALANCE,2)}}</td>
															<td>
																<td class="text-center"> <a href = "" type="buttonedit" class="btn btn-just-icon Subu" data-toggle="tooltip" title="Add Payment" ><i class="material-icons">more_horiz</i></a></td>
															</td>
														</tr>
														@endforeach
													</tbody>
												</table>
											</div>
											<!-- /.box-body -->
										</div>
										<!-- /.box -->
								<!-- /.col -->
									</div>
									<div id = "pending_TBLDIV" hidden>
										<div class="box">
											<div class="box-header Shalala">
												<h5 class="text-center" style="color: white;"><b>NEWLY MADE ORDERS</b></h5>
											</div>
											<div class="box-body" style="overflow-x: auto;">
												<table id="spoiled_TBL" class="table table-bordered table-striped">
													<thead>
															<th class="text-center"> Order ID</th>
															<th class="text-center"> Date Created </th>
															<th class="text-center"> Shipping Method </th>
															<th class="text-center"> Status</th>
															<th class="text-center"> Amount</th>
															<th class="text-center"> Balance</th>
															<th class="text-center"> ACTION</th>
													</thead>
													<tbody>
														@foreach($pending as $pending)
														<tr>
															<td>ORDR-{{$pending->Order_ID}}</td>
															<td>{{$pending->date_created}}</td>
															<td>{{$pending->Ship_Method}}</td>
															<td><span class = "btn btn-sm btn-warning">Pending</span></td>
															<td>Php {{number_format($pending->Total_Amt,2)}}</td>
															<td>Php {{number_format($pending->BALANCE,2)}}</td>
															<td>
																<td class="text-center"> <a href = "" type="buttonedit" class="btn btn-just-icon Subu" data-toggle="tooltip" title="Add Payment" ><i class="material-icons">more_horiz</i></a></td>
															</td>
														</tr>
														@endforeach
													</tbody>
												</table>
											</div>
											<!-- /.box-body -->
										</div>
										<!-- /.box -->
								<!-- /.col -->
									</div>
								</div>

					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel" style="margin-top: 35%; margin-left: -5%;">
					<div class="panel-heading  Sharp">
						<div class="panel-title">
              <h6 style="color: white"><span class="glyphicon glyphicon-user text-center" style="color: white;"></span>
                <b>Manage the order Now</b></h6>
            </div>
					</div>
          <div class = "panel-body">
            <p><b>Total Purchase:</b> Php </p>
            <p><b>Vat(12%):</b> Php </p>
            <p><b>Delivery Charge:</b> Php </p>
						<p><b>Total Amount:</b> Php </p>

            <hr>
            <div class="radio">
              <p class = "text-left"><b>Choose From the following:</b></p>
              <label>
                <input type="radio" name="optionsPayment" id = "cashRdo">
                Pay via Cash
              </label>
              <label>
                <input type="radio" name="optionsPayment" id = "bankRdo">
                Pay via Bank
              </label>
            </div>

            <hr>
					<div id = "paylaterDiv" hidden>
						<h5>This function is only available for <b>Hotel</b> and <b>Shop owner</b> customers. In this function, the order will be delivered to the customer without any downpayment but will be listed as one of the debts of the customer with the Wonderbloom shop</h5>
						<div class="checkbox">
							<label  style = "color:red;">
								<input type="checkbox" name="later_ShowSubmitButton" id = "later_ShowSubmitButton">
								<b>*Important:</b> by checking this, you are sure that you are going to set this order as confirmed even without any payment.
							</label>
						</div>
						<div id = "laterSbmt_BtnDIV" hidden>
							<a href = "" id = "laterSBMT" type = "button" class = "btn btn-md btn-success" disabled>Yes, Pay it Later</a>
						</div>
					</div>

          <div id = "cashPaymentDiv" hidden>
          {!! Form::open(array('route' => 'ManageOrder_Cash.store', 'data-parsley-validate'=>'', 'method'=>'POST')) !!}
              <h6><b>Pay through Cash:</b></h6>
                <b>Details of Person who gave the payment:</b>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="samePersonCheckBox" id = "samePersonCheckBox">
                    Same Person who placed the order
                  </label>
                </div>
                <div hidden>
									<input type = "text" id = "Order_ID"  name = "Order_ID" value = ""/>
                  <input type = "text" id = "Currentcust_ID" name = "Currentcust_ID" value = ""/>
                  <input type = "text" id = "Decision_text" name = "Decision_text" value = "N"/>
                  <input type = "text" id = "Current_FName" name = "Current_FName" value = ""/>
                  <input type = "text" id = "Current_LName" name = "Current_LName" value = ""/>
                  <input type = "text" id = "SubtotalDown" name = "SubtotalDown" value = ""/>
                </div>
                <div class = "row">

                  <div class = "col-md-6">
                    <div id = "fnameDiv" class="form-group label-floating">
                      <label class="control-label">First Name</label>
                      <input  name = "nf_namefield" id = "nf_namefield" type="text" class="form-control text-right" required/>
                      <input name = "f_namefield" id = "f_namefield" type="text" class="hidden form-control text-right" value = ""/>
                      <span class="form-control-feedback">
                      </span>
                    </div>
                  </div>
                  <div class = "col-md-6">
                    <div id = "lnameDiv" class="form-group label-floating">
                      <label class="control-label">Last Name</label>
                      <input name = "nl_namefield" id = "nl_namefield" type="text" class="form-control text-right" required/>
                      <input name = "l_namefield" id = "l_namefield" type="text" class="hidden form-control text-right" value = ''/>
                      <span class="form-control-feedback">
                      </span>
                    </div>
                  </div>
                </div>
                <hr>
              <div class = "row">
                <div class = "col-md-6">
                </div>
                <div class = "col-md-6">
                  <div class="form-group label-floating">
                    <label class="control-label">Amount of Purchase</label>
                      <input type="text" class="form-control text-right" value = "Php " disabled/>
                      <input type="number" class="hidden form-control text-right" value = ""/>
                    <span class="form-control-feedback">
                    </span>
                  </div>
                  <div class="form-group label-floating">
                    <label class="control-label">(12%)VAT</label>
                      <input type="text" class="form-control text-right" value = "Php " disabled/>
                      <input type="number" class="hidden form-control text-right" value = ""/>
                    <span class="form-control-feedback">
                    </span>
                  </div>
                  <div class="form-group label-control">
                    <label class="control-label">Delivery Charge</label>
                      <input type="text" class="form-control text-right" value = "Php " disabled/>
                      <input type="number" class="hidden form-control text-right" value = ""/>
                    <span class="form-control-feedback">
                    </span>
                  </div>

                  <div class="form-group label-control">
                    <label class="control-label">Total Amount</label>
                    <input type="text" id = "display_balanceField" class="form-control text-right" value = "Php " disabled/>
                    <span class="form-control-feedback">
                    </span>
                  </div>
                  <div class="form-group label-control">
                    <label class="control-label">Total Amount</label>
                    <input type="text" id = "display_balanceField" class="form-control text-right" value = "Php " disabled/>
                    <span class="form-control-feedback">
                    </span>
                  </div>
                  <div class="form-group label-control">
                    <label class="control-label">Balance</label>
                    <input type="text" id = "display_balanceField" class="form-control text-right" value = "Php " disabled/>
                    <span class="form-control-feedback">
                    </span>
                  </div>
									<input type="number" id = "balanceField" name = "balanceField" type="number" step = "1.0" class="hidden form-control text-right" value = ""/>
                </div>
              </div>
              <div id = "partialCheckbox_DIV" class="checkbox">
                <label  style = "color:red;">
                  <input type="checkbox" name="partial_PaymentCheckBox" id = "partial_PaymentCheckBox">
                   Use only the partial of the entered payment
                </label>
              </div>
              <div class = "row">
                <div class = "col-md-6">
                  <div class="form-group label-floating">
                    <label class="control-label">Enter Amount Paid</label>
                      <input id = "payment_field" name = "payment_field" type="number" step = "0.01" class="form-control" min = "<?php

                          $min = 0 * 0.20;

                        echo $min;
                       ?>" required/>
											 <input id = "payment" name = "payment" type="number" step = "0.01" class="hidden form-control">
                    <span class="form-control-feedback">
                    </span>
                  </div>
                  <div class="form-group label-control">
                    <label class="control-label">Change</label>
                      <input id = "DisplaychangeField" type="text" class="form-control" disabled value = "Php 0.00"/>
                      <input id = "changeField" name = "changeField" type="text" class="hidden form-control" />
                    <span class="form-control-feedback">
                    </span>
                  </div>
                </div>

                <div class = "col-md-6">
                  <div id = "partialDiv" class="form-group label-floating" hidden>
                    <label class="control-label">Partial</label>
                      <input id = "PartialField" name = "PartialField" type="number" step = "0.01" value = "0.00" class="form-control" />
                    <span class="form-control-feedback">
                    </span>
                  </div>
                </div>
              </div>
              <div class="checkbox">
                <label  style = "color:red;">
                  <input type="checkbox" name="cash_ShowSubmitButton" id = "cash_ShowSubmitButton">
                  *important: by checking this, you are sure about the amount that you entered.
                </label>
              </div>
              <div id = "cashSbmt_BtnDIV" hidden>
                <button id = "cashSBMT" type = "submit" class = "btn btn-md btn-success" disabled>submit payment</button>
              </div>
              {!! Form::close() !!}
            </div>


            <div id = "bankPaymentDiv" hidden>
					{!! Form::open(array('route' => 'ManageOrder_Bank.store', 'data-parsley-validate'=>'', 'files' => 'true' , 'method'=>'POST')) !!}
							<b>Details of Person who gave the payment:</b>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="samePersonCheckBox2" id = "samePersonCheckBox2">
									Same Person who placed the order
								</label>
							</div>

							<div hidden>
								<input type = "text" id = "Order_ID2"  name = "Order_ID2" value = ""/>
								<input type = "text" id = "Currentcust_ID2" name = "Currentcust_ID2"  value = ""/>
								<input type = "text" id = "Decision_text2"  name = "Decision_text2" value = "N"/>
								<input type = "text" id = "Current_FName2"  name = "Current_FName2" value = ""/>
								<input type = "text" id = "Current_LName2"  name = "Current_LName2" value = ""/>
								<input type = "text" id = "SubtotalDown2"  name = "SubtotalDown2" value = ""/>
							</div>

							<div class = "row">
								<div class = "col-md-6">
									<div id = "fnameDiv2" class="form-group label-floating">
										<label class="control-label">First Name</label>
										<input  name = "nf_namefield2" id = "nf_namefield2" type="text" class="form-control text-right" required/>
										<input name = "f_namefield2" id = "f_namefield2" type="text" class="hidden form-control text-right" value = ""/>
										<span class="form-control-feedback">
										</span>
									</div>
								</div>

								<div class = "col-md-6">
									<div id = "lnameDiv2" class="form-group label-floating">
										<label class="control-label">Last Name</label>
										<input name = "nl_namefield2" id = "nl_namefield2" type="text" class="form-control text-right" required/>
										<input name = "l_namefield2" id = "l_namefield2" type="text" class="hidden form-control text-right" value = ''/>
										<span class="form-control-feedback">
										</span>
									</div>
								</div>

							</div>
							<hr>

							<p><b>Pay through Bank Deposite<b></p>

							<div class="form-group" Style = "margin-left: 20%;">
                <img src= "{{ asset('img/'.'addfile.ico')}}" id="imageBox" name="imageBox" style="max-width: 200px; max-height: 200px;" />
              </div>

							<label for = 'flowerimg'>Slip Image: </label>
							<div class="input-group">
								<input class ="uploader" type="file" accept="image/*" name = "DSlipimg" id = "DSlipimg" onchange="preview_image(event)"  style = "margin-top: 2%;" required>
							</div>
							<div class="input-group" hidden>
								<img class ="uploader" type="file" accept="image/*" name = "DSlipimg2" id = "DSlipimg2" value = "{{ asset('img/'.'addfile.ico')}}" src = "{{ asset('img/'.'addfile.ico')}}" hidden/>
							</div>

							<div class = "row">
								<div class = "col-md-6">
									<div id = "partialDiv" class="form-group label-floating">
										<label class="control-label">Bank Name</label>
										<input name = "Bank_Name" id = "Bank_Name" type="text" class="form-control" required maxlength= "40" required/>
										<span class="form-control-feedback">
										</span>
									</div>
								</div>

								<div class = "col-md-6">
									<div id = "partialDiv" class="form-group label-floating">
										<label class="control-label">Deposit Slip Number</label>
										<input name = "slip_Number" id = "slip_Number" type="text" class="form-control" maxlength= "20" required/>
										<span class="form-control-feedback">
										</span>
									</div>
								</div>
							</div>

							<div class = "row">
								<div class = "col-md-6">
									<div id = "partialDiv" class="form-group label-control">
										<label class="control-label">Date Deposited</label>
										<input name = "D_date" id = "D_date" min = "" max = "" value = "" type="date" class="form-control" reqired/>
										<span class="form-control-feedback">
										</span>
									</div>
								</div>

								<div class = "col-md-6">
									<div id = "partialDiv" class="form-group label-control">
										<label class="control-label">Amount Deposited</label>
											<input name = "D_Amount" id = "D_Amount" type="number" step = "0.01" min = "" value = "" class="form-control" required/>
										<span class="form-control-feedback">
										</span>
									</div>
								</div>
							</div>
							<div class="checkbox">
								<label  style = "color:red;">
									<input type="checkbox" name="bank_ShowSubmitButton" id = "bank_ShowSubmitButton">
									*important: by checking this, you are sure about the amount that you entered.
								</label>
							</div>
							<div id = "bankSbmt_BtnDIV" hidden>
								<button id = "bankSBMT" type = "submit" class = "btn btn-md btn-success" disabled>Submit payment</button>
							</div>
					{!! Form::close() !!}
            </div>
          </div>
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
			function preview_image(event)
		  {
		   var reader = new FileReader();
		   reader.onload = function()
		   {
		    var output = document.getElementById('imageBox');
		    output.src = reader.result;
		   }
		   reader.readAsDataURL(event.target.files[0]);
		  }

  </script>

  <script>
  $(document).ready(function(){



		$('#fullBtn').click(function(){
			$('#balance_TBLDIV').hide("fold");
			$('#pending_TBLDIV').hide("fold");
			$('#closed_TBLDIV').hide("fold");
			$('#full_TBLDIV').show("fold");
		});

		$('#ClosedBtn').click(function(){
			$('#balance_TBLDIV').hide("fold");
			$('#pending_TBLDIV').hide("fold");
			$('#full_TBLDIV').hide("fold");
			$('#closed_TBLDIV').show("fold");
		});


		$('#pendingBtn').click(function(){
			$('#closed_TBLDIV').hide("fold");
			$('#balance_TBLDIV').hide("fold");
			$('#full_TBLDIV').hide("fold");
			$('#pending_TBLDIV').show("fold");
		});

		$('#balancedBtn').click(function(){
			$('#closed_TBLDIV').hide("fold");
			$('#pending_TBLDIV').hide("fold");
			$('#full_TBLDIV').hide("fold");
			$('#balance_TBLDIV').show("fold");
		});

		$('#laterRdo').click(function(){
			$('#cashPaymentDiv').hide("fold");
			$('#bankPaymentDiv').hide("fold");
			$('#paylaterDiv').show("fold");
		});

		$('#bankRdo').click(function(){
			$('#cashPaymentDiv').hide("fold");
			$('#paylaterDiv').hide("fold");
			$('#bankPaymentDiv').show("fold");
		});

		$('#cashRdo').click(function(){
			$('#paylaterDiv').hide("fold");
			$('#bankPaymentDiv').hide("fold");
			$('#cashPaymentDiv').show("fold");
		});

		$('#checkRdo').click(function(){
			$('#bankPaymentDiv').hide("fold");
			$('#cashPaymentDiv').hide("fold");
			$('#chequePaymentDiv').show("fold");
		});

    $('#samePersonCheckBox2').click(function(){
      if($('#samePersonCheckBox2').is(":checked")){
        $('#Decision_text2').val("O");
        $('#fnameDiv2').removeClass("form-group label-floating");
        $('#fnameDiv2').addClass("form-group label-control");
        $('#lnameDiv2').removeClass("form-group label-floating");
        $('#lnameDiv2').addClass("form-group label-control");
      	$("#nf_namefield2").val($('#Current_FName').val());
        $("#nl_namefield2").val($('#Current_LName').val());
        $("#nf_namefield2").attr('disabled',true);
        $("#nl_namefield2").attr('disabled',true);
      }else{
        $('#Decision_text2').val("N");
        $('#fnameDiv2').removeClass("form-group label-control");
        $('#fnameDiv2').addClass("form-group label-floating");
        $('#lnameDiv2').removeClass("form-group label-control");
        $('#lnameDiv2').addClass("form-group label-floating");
        $("#nf_namefield2").val(null);
        $("#nl_namefield2").val(null);
        $("#nf_namefield2").attr('disabled',false);
        $("#nl_namefield2").attr('disabled',false);
      }
    });

	$('#samePersonCheckBox').click(function(){
		if($('#samePersonCheckBox').is(":checked")){
				$('#Decision_text').val("O");
				$('#fnameDiv').removeClass("form-group label-floating");
				$('#fnameDiv').addClass("form-group label-control");
				$('#lnameDiv').removeClass("form-group label-floating");
				$('#lnameDiv').addClass("form-group label-control");
				$("#nf_namefield").val($('#Current_FName').val());
				$("#nl_namefield").val($('#Current_LName').val());
				$("#nf_namefield").attr('disabled',true);
				$("#nl_namefield").attr('disabled',true);
			}else{
				$('#Decision_text').val("N");
				$('#fnameDiv').removeClass("form-group label-control");
				$('#fnameDiv').addClass("form-group label-floating");
				$('#lnameDiv').removeClass("form-group label-control");
				$('#lnameDiv').addClass("form-group label-floating");
				$("#nf_namefield").val(null);
				$("#nl_namefield").val(null);
				$("#nf_namefield").attr('disabled',false);
				$("#nl_namefield").attr('disabled',false);
			}
		});

    if($('#payment_field').val() == "" || $('#payment_field').val() == null){
      $('#partialCheckbox_DIV').hide();
    }

    var DownPayment = $('#SubtotalDown').val();
		var change = 0;

    $('#payment_field').change(function(){

			$('#payment').val($(this).val());

			if($(this).val() == null || $(this).val() == "" || parseFloat($(this).val()) == 0){
				change = 0 - $('#balanceField').val();
				$('#partialCheckbox_DIV').hide();
        $('#changeField').val(change.toFixed(2));
				$('#DisplaychangeField').val('Php '+change.toFixed(2));
			}
      else if(parseFloat($(this).val()) < parseFloat(DownPayment)){
         change = parseFloat($(this).val()) - parseFloat(DownPayment);

        $('#partialCheckbox_DIV').hide();
        $('#changeField').val(change.toFixed(2));
				$('#DisplaychangeField').val('Php '+change.toFixed(2));
      }
      else if(parseFloat($(this).val()) > parseFloat(DownPayment)){
			 change = 0;

        $('#partialCheckbox_DIV').show();
        $('#changeField').val(change.toFixed(2));
        var payment = $('#payment_field').val();
        var balance = $('#balanceField').val();

      if(parseFloat(balance) > parseFloat(payment)){
          change = 0;
           $('#changeField').val(change.toFixed(2));
					 $('#DisplaychangeField').val('Php '+change.toFixed(2));
         }
				 else if(parseFloat(balance) < parseFloat(payment)){
					 change = $(this).val() - $('#balanceField').val();
						$('#changeField').val(change.toFixed(2));
					 $('#DisplaychangeField').val('Php '+change.toFixed(2));
				 }
				 else if(parseFloat(balance) == parseFloat(payment)){
					 alert('equal ang balance at payment');
					 change = 0;
            $('#changeField').val(change.toFixed(2));
 					 $('#DisplaychangeField').val('Php '+change.toFixed(2));
				 }
      }
      else if(parseFloat($('#payment_field').val()) == parseFloat(DownPayment)){
        var change = parseFloat($('#payment_field').val()) - parseFloat(DownPayment);
        $('#partialCheckbox_DIV').hide();
        $('#changeField').val(change.toFixed(2));
				$('#DisplaychangeField').val('Php '+change.toFixed(2));
      }
    });

		$('#PartialField').change(function(){
				var payment = parseFloat($('#payment_field').val());
				var changeval = 0;
				changeval = payment - parseFloat($(this).val());

				$('#changeField').val(changeval.toFixed(2));
				$('#DisplaychangeField').val('Php '+changeval.toFixed(2));
		});




    $('#partial_PaymentCheckBox').click(function(){
			if($('#partial_PaymentCheckBox').is(":checked")){
        $('#partialDiv').show("fold");
        $('#payment_field').attr("disabled",true);
        $('#PartialField').attr("required",true);
        var maximum = $('#payment_field').val() - 1;//for the maximum value of partial_field
        $("#PartialField").attr('max',maximum);
        $("#PartialField").attr('min',DownPayment);
			}else{
				var resetval = 0;
				$('#DisplaychangeField').val('Php '+resetval.toFixed(2));
				$('#changeField').val(resetval.toFixed(2));
				$("#PartialField").val(resetval.toFixed(2));
				$("#PartialField").removeAttr('max');
				$("#PartialField").removeAttr('min');
        $('#PartialField').attr("required",false);
        $('#payment_field').attr("disabled",false);
        $('#partialDiv').hide("fold");
			}
		});

    $('#cash_ShowSubmitButton').click(function(){
			if($('#cash_ShowSubmitButton').is(":checked")){
				//$('#bank_ShowSubmitButton').attr('checked',false);
        $('#cashSbmt_BtnDIV').show("fold");
        $('#cashSBMT').attr("disabled",false);
			}else{
        $('#cashSBMT').attr("disabled",true);
        $('#cashSbmt_BtnDIV').hide("fold");
			}
		});



		$('#bank_ShowSubmitButton').click(function(){
			if($('#bank_ShowSubmitButton').is(":checked")){
        $('#bankSbmt_BtnDIV').show("fold");
        $('#bankSBMT').attr("disabled",false);
			}else{
        $('#bankSBMT').attr("disabled",true);
        $('#bankSbmt_BtnDIV').hide("fold");
			}
		});

		$('#later_ShowSubmitButton').click(function(){
			if($('#later_ShowSubmitButton').is(":checked")){
        $('#laterSbmt_BtnDIV').show("fold");
        $('#laterSBMT').attr("disabled",false);
			}else{
        $('#laterSBMT').attr("disabled",true);
        $('#laterSbmt_BtnDIV').hide("fold");
			}
		});



	});//end of document ready
  </script>

@endsection
