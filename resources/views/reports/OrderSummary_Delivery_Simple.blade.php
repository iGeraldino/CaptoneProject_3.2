<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<style type="text/css">
			.center {
				margin-left: 30%;
			}

			.left {
				margin-left: 10%;
			}

			.left2{
				margin-left: 20%;
			}

			.right {
				margin-left: 60%;
				margin-top: -10%;
			}

			table {
						width: 70%;
						margin:0;
						border:1px solid;

				}
		</style>
	</head>
	<body>
		<div id = "pickupSummaryDiv">
				<h3 class="center">WonderBloom Flowershop</h3>
			  <h3 class="center">WonderBloom Flowershop</h3>
				<hr>
	    	<h3 class="center">ORDER SUMMARY (DELIVERY)</h3>
				<h5 class = "left"><b>ORDR_{{$NewSalesOrder->sales_order_ID}}</b></h5>
	    	<h5 class="left"><b>FULL NAME:</b> {{$NewSalesOrder->Customer_Fname}} {{$NewSalesOrder->Customer_MName}}, {{$NewSalesOrder->Customer_LName}}</h5>
	    	<h5 class="left"><b>CONTACT NO:</b> {{$NewSalesOrder->Contact_Num}}</h5>
	    	<h5 class="left"><b>EMAIL:</b> {{$NewSalesOrder->email_Address}}</h5>
	    	<h5 class="left">PAYMENT METHOD: {{$NewSalesOrder_details->Payment_Mode}}</h5>
	   		<hr>
	    	<h3 class="left"><b>DELIVERY DETAILS </b></h3>
	    	<h5 class="left"><b>RECIPIENT NAME: </b> {{$NewSalesOrder->Customer_Fname}} {{$NewSalesOrder->Customer_MName}}, {{$NewSalesOrder->Customer_LName}}</h5>
	    	<h5 class="left"><b>RECIPIENT CONTACT NO: </b> {{$NewSalesOrder->contact_Num}}</h5>
	    	<h5 class="left"><b>DATE OF DELIVERY: </b>
					<?php
						echo $dateTime_to_beOut = date('M d, Y @ h:i a',strtotime($NewOrder_SchedDetails->Time));
						//echo 'Date and time to get= '.date('Y-m-d h:i:s a', strtotime($newdate));
					?></h5>
	    	<h5 class="left"><b>DELIVERY ADDRESS:</b> {{$NewSalesOrder_details->Delivery_Address}}, {{$NewSalesOrder_details->Delivery_Baranggay}}, {{$city}},{{$province}}</h5>
	    	<br> <br> <br>
	    	<h3 class="center"> FLOWER SUMMARY</h3>
	    	<br>
	    	<table class="table table-bordered left">
					<thead>
						<tr>
							<th class="text-center left2">Flower ID</th>
							<th class="text-center left2">Name</th>
							<th class="text-center left2">Price</th>
							<th class="text-center left2">Qty</th>
							<th class="text-center left2">Total Amount</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$Total_AmtFlwr = 0;
					?>
					@foreach($SalesOrder_flowers as $flwr)
					<tr class = "left2">
						<td scope="row" >FLWR-{{$flwr->flwr_ID}}</td>
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
			 <div class="text-right" style = "color:red;">
				 <b>(Flower) Total Amount: PHP {{number_format($Total_AmtFlwr,2)}}</b>
			 </div>
			 <hr>
		        <br> <br> <br> <br>
		     <h3 class="center">BOUQUET SUMMARY</h3>

		        <br> <br>
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
							<?php
								$totalAmt_Bqt = 0;
							?>
							@foreach($NewOrder_Bouquet as $Bqt)
								<tr>
									<td>BQT-{{$Bqt->Bqt_ID}}</td>
									<td>Php {{number_format($Bqt->Unit_Price,2)}}</td>
									<td>{{$Bqt->QTY}}</td>
									<td style = "color:red;">Php {{Number_format($Bqt->QTY * $Bqt->Unit_Price,2)}}</td>
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
															 @foreach($SalesOrder_Bqtflowers as $row1)
																@if($Bqt->Bqt_ID == $row1->BQT_ID)
																<tr>
																	  <td >{{$row1 ->FLwr_ID}}</td>
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
																	<td>ACRS-{{$row2 -> Acrs_ID}}</td>
																	<td>{{ $row2 -> name}}</td>
																	<td>Php {{ Number_format($row2 -> Price,2)}}</td>
																	<td>{{ $row2 -> qty}}</td>
																	<td style = "color:red;">Php {{ Number_format($row2 -> Price * $row2 -> qty,2)}}</td>
																</tr>
																@endif
															<?php
																$totalAmt_Bqt += $Bqt->QTY*$Bqt->Unit_Price;
															?>
														@endforeach
															</tbody>
														</table>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
		        <br> <br> <br> <br>
		        <h3 class="right">TOTAL AMOUNT:</h3>
		        <br> <br> <br>
		        <p class="left"><b>Take Note: You must send the copy of your deposit slip (Amounting of 20% minimum of total amount)</b></p>
    			<p class="left"><b>With regards to the order please wait for a call or an email from the company. This will be about the confirmation and other stuffs that you must prepare upon ordering.</b></p>
			</div>
	</body>
</html>
