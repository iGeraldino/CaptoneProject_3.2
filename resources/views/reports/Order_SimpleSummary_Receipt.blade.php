<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<style type="text/css">
		.text-danger strong {
		    		color: #9f181c;
				}
				.receipt-main {
					background: #ffffff none repeat scroll 0 0;
					border-bottom: 12px solid #333333;
					border-top: 12px solid #9f181c;
					margin-top: 50px;
					margin-bottom: 50px;
					padding: 40px 30px !important;
					position: relative;
					box-shadow: 0 1px 21px #acacac;
					color: #333333;
					font-family: open sans;
				}
				.receipt-main p {
					color: #333333;
					font-family: open sans;
					line-height: 1.42857;
				}
				.receipt-footer h1 {
					font-size: 15px;
					font-weight: 400 !important;
					margin: 0 !important;
				}
				.receipt-main::after {
					background: #414143 none repeat scroll 0 0;
					content: "";
					height: 5px;
					left: 0;
					position: absolute;
					right: 0;
					top: -13px;
				}
				.receipt-main thead {
					background: #414143 none repeat scroll 0 0;
				}
				.receipt-main thead th {
					color:#fff;
				}
				.receipt-right h5 {
					font-size: 16px;
					font-weight: bold;
					margin: 0 0 7px 0;
				}
				.receipt-right p {
					font-size: 12px;
					margin: 0px;
				}
				.receipt-right p i {
					text-align: center;
					width: 18px;
				}
				.receipt-main td {
					padding: 9px 20px !important;
				}
				.receipt-main th {
					padding: 13px 20px !important;
				}
				.receipt-main td {
					font-size: 13px;
					font-weight: initial !important;
				}
				.receipt-main td p:last-child {
					margin: 0;
					padding: 0;
				}
				.receipt-main td h2 {
					font-size: 20px;
					font-weight: 900;
					margin: 0;
					text-transform: uppercase;
				}
				.receipt-header-mid .receipt-left h1 {
					font-weight: 100;
					margin: 34px 0 0;
					text-align: right;
					text-transform: uppercase;
				}
				.receipt-header-mid {
					margin: 24px 0;
					overflow: hidden;
				}

				#container {
					background-color: #dcdcdc;
				}
		</style>
	</head>
	<body>
		<?php
			$totalAmt_Bqt = 0;
			$Total_AmtFlwr = 0;
		?>
		<div class="container">
			<div class="row">

		        <div class="receipt-main">
		         <div class="row">
			    			<div class="receipt-header">
								<div class="col-xs-6 col-sm-6 col-md-6 text-right">
									<div class="receipt-right">
										<h5>WONDER BLOOM Flowershop.</h5>
										<p>+6391-7572-9859 <i class="fa fa-phone"></i></p>
										<p>wonderbloom@gmail.com <i class="fa fa-envelope-o"></i></p>
										<p>123 Dimasalang St., Sampaloc, Manila <i class="fa fa-location-arrow"></i></p>
									</div>
								</div>
							</div>
		        </div>

					<div class="row">
						<div class="receipt-header receipt-header-mid">
							<div class="col-xs-8 col-sm-8 col-md-8 text-left">
								<div class="receipt-right">
									<h4><b>Order Number: </b><small>ORDR_{{$NewSalesOrder->sales_order_ID}}</small></h4>
									<h4><b>Order Status: </b><small> <span style = "color:red">{{$NewSalesOrder->Status}}</span></small></h4>
									<h5><b>Charge to:</b> <small>{{$NewSalesOrder->Customer_Fname}} {{$NewSalesOrder->Customer_MName}}, {{$NewSalesOrder->Customer_LName}}</small></h5>
									<p><b>Mobile :</b> {{$NewSalesOrder->Contact_Num}}</p>
									<p><b>Email :</b> {{$NewSalesOrder->email_Address}}</p>
									@if($NewSalesOrder_details != Null)
									<p><b>Payment Method :</b> {{$NewSalesOrder_details->Payment_Mode}}</p>

									@if($NewSalesOrder_details->shipping_method == "delivery")
										<p><b>Shipping Method :</b> {{$NewSalesOrder_details->shipping_method}}</p>
										<p><b>Recipient Name :</b> {{$NewSalesOrder->Customer_Fname}} {{$NewSalesOrder->Customer_MName}}, {{$NewSalesOrder->Customer_LName}}</p>
										<p><b>Delivery Address :</b> {{$NewSalesOrder_details->Delivery_Address}}, {{$NewSalesOrder_details->Delivery_Baranggay}}, {{$city}},{{$province}}</p>
										<p><b>Delivery Date :</b>
											<?php
												echo $dateTime_to_beOut = date('M d, Y @ h:i a',strtotime($NewOrder_SchedDetails->Time));
												//echo 'Date and time to get= '.date('Y-m-d h:i:s a', strtotime($newdate));
											?>
										</p>
									@else
										<p><b>Shipping Method :</b> {{$NewSalesOrder_details->shipping_method}}</p>
										<p><b>Pickup Date :</b>
											<?php
												echo $dateTime_to_beOut = date('M d, Y @ h:i a',strtotime($NewOrder_SchedDetails->Time));
												//echo 'Date and time to get= '.date('Y-m-d h:i:s a', strtotime($newdate));
											?>
										</p>
									@endif
									@else

									@endif
								</div>
							</div>
						</div>
		       </div>


					<div class = "row">
						<div class="receipt-header receipt-header-mid">
							@if($SalesOrder_flowers != NULL)
							<hr>
								<h4 class="fontx text-center">Flower Summary</h4>
								<table class="table table-hover table-bordered">
										<thead>
											<tr>
												<th class="text-center">Item Description</th>
												<th class="text-center">Item Price</th>
												<th class="text-center">Quantity</th>
												<th class="text-center">Total Amount</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$Total_AmtFlwr = 0;
										?>
										@foreach($SalesOrder_flowers as $flwr)
										<tr>
											<td>{{$flwr->name}}</td>
											<td>Php {{number_format($flwr->Price,2)}}</td>
											<td>{{$flwr->qty}} pcs</td>
											<td style = "color:red;">Php {{number_format($flwr->Tamt,2)}}</td>
										</tr>
											<?php
												$total = 0;
												$total = $flwr->Price*$flwr->qty;
												$Total_AmtFlwr += $total;
											?>
										@endforeach
									</tbody>
								</table>

							@else
							<!--nothing-->
							@endif

							@if($NewOrder_Bouquet != NULL)
							<hr>
							<h4 class="fontx text-center">Bouquet Summary</h4>
							<table class="table table-hover table-bordered table-striped">
									<thead>
										<tr>
											<th class="text-center">Item Description</th>
											<th class="text-center">Item Price</th>
											<th class="text-center">Quantity</th>
											<th class="text-center">Total Amount</th>
									</tr>
								</thead>
								<tbody>
								<?php
									$totalAmt_Bqt = 0;
								?>
								@foreach($NewOrder_Bouquet as $Bqt)
									<tr>
										<th scope="row">BQT-{{$Bqt->Bqt_ID}}</th>
										<td>Php {{number_format($Bqt->Unit_Price,2)}}</td>
										<td>{{$Bqt->QTY}}</td>
										<td style = "color:red;">Php {{Number_format($Bqt->QTY * $Bqt->Unit_Price,2)}}</td>
									</tr>
										 @foreach($SalesOrder_Bqtflowers as $row1)
											@if($Bqt->Bqt_ID == $row1->BQT_ID)
												<tr>
													<td>{{ $row1 -> name}}</td>
													<td>Php {{ number_format($row1->price,2)}}</td>
													<td>{{ $row1 -> qty}} pcs.</td>
													<td style = "color:red;">Php {{Number_format($row1 -> price * $row1 -> qty,2)}}</td>
												</tr>
											@endif
										 @endforeach
										 @foreach($SalesOrder_BqtAccessories as $row2)
										@if($Bqt->Bqt_ID == $row2->bqt_ID)
											<tr>
												<td>{{ $row2 -> name}}</td>
												<td>Php {{ Number_format($row2 -> Price,2)}}</td>
												<td>{{ $row2 -> qty}}</td>
												<td style = "color:red;">Php {{ Number_format($row2 -> Price * $row2 -> qty,2)}}</td>
											</tr>
										@endif
										@endforeach
										<?php
										$totalAmt_Bqt +=  $Bqt->QTY*$Bqt->Unit_Price;
										?>
									@endforeach
								</tbody>
							</table>
						</div>
							@else
							@endif
							<div class="receipt-right">
									<h5 style = "margin-top:-20%">Transaction Breakdown:</h5>
									<p  style = "margin-top:-20%"><b>(Flower) Amount:</b>  Php {{number_format($Total_AmtFlwr,2)}}</p>
									<p  style = "margin-top:-20%"><b>(Bouquet) Amount:</b> Php {{number_format($totalAmt_Bqt,2)}}</p>
									<p  style = "margin-top:-20%"><b>Amount of Purchase:</b> Php {{number_format($NewSalesOrder_details->Subtotal,2)}}</p>
									<hr style = "margin-top:-20%">
									<h6 style = "margin-top:-20%">OTHER CHARGES:</h6>
									<p  style = "margin-top:-30%"><b>Delivery Charge:</b> Php {{number_format($NewSalesOrder_details->Delivery_Charge,2)}}</p>
									<p style = "margin-top:-30%"><b>Amount of Vat(12%):</b> Php {{number_format($NewSalesOrder_details->VAT,2)}}</p>
									<hr style = "margin-top:-20%">
									<p style = "color:red;"><b>Total Amount: </b>Php {{ number_format($NewSalesOrder_details->Total_Amt,2) }}</p>
							</div>
						</div>
					</div>


					<div class="row">
						<div class="receipt-header receipt-header-mid receipt-footer">
							<div class="col-xs-8 col-sm-8 col-md-8 text-left">
								<div class="receipt-right">
									<p><b>Date :</b>
										<?php
											use Carbon\Carbon;
											$current = Carbon::now('Asia/Manila');
											echo date('M d, Y (h:i a)',strtotime($current));
										?>
									</p>
									<h5 style="color: rgb(140, 140, 140);">Thank you for Trusting Us!</h5>
								</div>
							</div>
							<hr>
							<h4><b>Please take note:</b><h4>
								<p class="left"><span style = "color:red;">*</span>You must send the copy of your deposit slip (Amounting of 20% minimum of total amount)</p>
								<p class="left"><span style = "color:red;">*</span>If you failed to submit or give us atleast the 20% of the total amount of items purchased, then the order will not be acknowledged.</p>
								<p class="left"><span style = "color:red;">*</span>With regards to the order please wait for a call or an email from the company. This will be about the confirmation and other stuff that you must prepare to complete the transaction.</p>
								<p class="left"><span style = "color:red;">*</span>If you would like to cancel the order, please cancel it immediately by calling us or sending us an email.</p>
								<p class="left"><span style = "color:red;">*</span>Items under this order cannot be changed.</p>
								<p class="left"><span style = "color:red;">*</span>Delivery Charge are not applied to your transaction,this will depend upon the negotiation that will be made between you and the company by the time that you recieve a call.</p>
							<div class="col-xs-4 col-sm-4 col-md-4">

							</div>
						</div>
		       </div>

		        </div>
			</div>
		</div>
	</body>
</html>
