@extends('main')

@section('content')
	<?php

    $final_Amt = 0;

		use Carbon\Carbon;

		$current = Carbon::now('Asia/Manila');

	?>

	<div class="container">
		<div class="row">
			<div class="col-md-12" style="margin-left: -7px;">
				<div class="title container" style="margin-top: 5%;">
					<h3><b>CUSTOMER'S SALES ORDERS</b></h3>
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
							<!--<a class = "btn btn-md Subu">Generate Statement of Account</a>-->
							<a href = "{{route('SalesOrder.Debts',['id'=>$cust->Cust_ID])}}" class = "btn btn-md twitch">Set Payment for Multiple Debts</a>
						</div>

						<div style="margin-top: 50px;">
					        <div class="col-lg-3 col-xs-6">
					          <!-- small box -->
					          <div class="small-box Subu">
					            <div class="inner">
					              <h6><b>Newly made orders</b></h6>

					            </div>
					            <div class="icon">
					              <i class="ion ion-bag"></i>
					            </div>
					            <a id = "pendingBtn" type = "button" class="small-box-footer">View Details <i class="fa fa-arrow-circle-right"></i></a>
					          </div>
					        </div>
					        <!-- ./col -->
					        <div class="col-lg-3 col-xs-6">
					          <!-- small box -->
					          <div class="small-box Lush">
					            <div class="inner">
					              <h6><b>CLOSED ORDERS</b></h6>
					            </div>
					            <div class="icon">
					              <i class="ion ion-close-circled"></i>
					            </div>
											<a id = "ClosedBtn" type = "button" class="small-box-footer">View Details <i class="fa fa-arrow-circle-right"></i></a>
					          </div>
					        </div>
					        <!-- ./col -->
					        <div class="col-lg-3 col-xs-6">
					          <!-- small box -->
					          <div class="small-box Sulfur">
					            <div class="inner">

					              <h6><b>ORDERS WITH BALANCE</b></h6>
					            </div>
					            <div class="icon">
					              <i class="ion ion-clipboard"></i>
					            </div>
					            <a id = "balancedBtn" class="small-box-footer">View Details <i class="fa fa-arrow-circle-right"></i></a>
					          </div>
					        </div>
					        <!-- ./col -->
					        <div class="col-lg-3 col-xs-6">
					          <!-- small box -->
					          <div class="small-box Shalala">
					            <div class="inner">
					            	<h6><b>ORDERS READY TO BE RELEASED</b></h6>
					            </div>
					            <div class="icon">
					              <i class="ion ion-android-checkmark-circle"></i>
					            </div>
											<a id = "fullBtn" class="small-box-footer">View Details <i class="fa fa-arrow-circle-right"></i></a>
					          </div>
					        </div>
					        <!-- ./col -->
					      </div>

								<div class = "col-md-12">
									<div id = "balance_TBLDIV" hidden>
										<div class="box">
											<div class="box-header Sulfur">
												<h5 class="text-center" style="color: white;"><b>ORDERS WITH BALANCE</b></h5>
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
																<td><span class = "btn btn-sm btn-danger">No Payment Yet</span></td>
															@endif
															<td>Php {{number_format($b_Orders->Total_Amt,2)}}</td>
															<td>Php {{number_format($b_Orders->BALANCE,2)}}</td>
															<td>
																	<a href = "{{route('order.Manage_Confirmed_Order',['id'=>$b_Orders->Order_ID,'type'=>'debts'])}}" type="buttonedit" class="btn btn-just-icon Subu" data-toggle="tooltip" title="Add Payment" ><i class="material-icons">more_horiz</i></a>
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
											<div class="box-header Subu">
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
																<td class="text-center">
																	<a href = "{{route('order.Manage_Confirmed_Order',['id'=>$pending->Order_ID,'type'=>'debts'])}}" type="buttonedit" class="btn btn-just-icon Subu" data-toggle="tooltip" title="Add Payment" ><i class="material-icons">more_horiz</i></a>


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

									<div id = "closed_TBLDIV" hidden>
										<div class="box">
											<div class="box-header Lush">
												<h5 class="text-center" style="color: white;"><b>CLOSED & CANCELED ORDERS</b></h5>
											</div>
											<div class="box-body" style="overflow-x: auto;">
												<table id="spoiled_TBL" class="table table-bordered table-striped">
													<thead>
															<th class="text-center"> Order ID</th>
															<th class="text-center"> Date Created </th>
															<th class="text-center"> Status</th>
															<th class="text-center"> Amount</th>
															<th class="text-center"> ACTION</th>
													</thead>
													<tbody>
														@foreach($closed as $closed)
														<tr>
															<td>ORDR-{{$closed->Order_ID}}</td>
															<td>{{$closed->date_created}}</td>
															@if($closed->Stat == "CANCELLED")
																<td><span class = "btn btn-sm btn-danger">Cancelled</span></td>
															@elseif($closed->Stat == 'CLOSED')
																<td><span class = "btn btn-sm btn-success">Closed</span></td>
															@endif
															<td>Php {{number_format($closed->Total_Amt,2)}}</td>
																<td class="text-center">
																	<a href = "{{route('order.Manage_Confirmed_Order',['id'=>$closed->Order_ID,'type'=>'debts'])}}" type="buttonedit" class="btn btn-just-icon Subu" data-toggle="tooltip" title="View Details" ><i class="material-icons">more_horiz</i></a>
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

									<div id = "full_TBLDIV" hidden>
										<div class="box">
											<div class="box-header Shalala">
												<h5 class="text-center" style="color: white;"><b>FULLY PAID ORDERS</b></h5>
											</div>
											<div class="box-body" style="overflow-x: auto;">
												<table id="spoiled_TBL" class="table table-bordered table-striped">
													<thead>
															<th class="text-center"> Order ID</th>
															<th class="text-center"> Date Created </th>
															<th class="text-center"> Status</th>
															<th class="text-center"> Amount</th>
															<th class="text-center"> ACTION</th>
													</thead>
													<tbody>
														@foreach($full as $full)
														<tr>
															<td>ORDR-{{$full->Order_ID}}</td>
															<td>{{$full->date_created}}</td>
															<td><span class = "btn btn-sm btn-info">Fully Paid</span></td>
															<td>Php {{number_format($full->Total_Amt,2)}}</td>
															<td class="text-center">
																 <a href = "{{route('order.Manage_Confirmed_Order',['id'=>$full->Order_ID,'type'=>'debts'])}}" type="buttonedit" class="btn btn-just-icon Subu" data-toggle="tooltip" title="Add Payment" ><i class="material-icons">more_horiz</i></a>
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
