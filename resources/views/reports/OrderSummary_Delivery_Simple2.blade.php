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
				<h5 class = "left"><b>ORDR_{{$orderid}}</b></h5>
	    	<h5 class="left"><b>FULL NAME:</b> </h5>
	    	<h5 class="left"><b>CONTACT NO:</b> </h5>
	    	<h5 class="left"><b>EMAIL:</b> </h5>
	    	<h5 class="left">PAYMENT METHOD: </h5>
	   		<hr>
	    	<h3 class="left"><b>DELIVERY DETAILS </b></h3>
	    	<h5 class="left"><b>RECIPIENT NAME: </b> </h5>
	    	<h5 class="left"><b>RECIPIENT CONTACT NO: </b> </h5>
	    	<h5 class="left"><b>DATE OF DELIVERY: </b>
				</h5>
	    	<h5 class="left"><b>DELIVERY ADDRESS:</b></h5>
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

					?>

					<tr class = "left2">
						<td scope="row" ></td>
						<td></td>
						<td>Php </td>
						<td>pcs</td>
						<td style = "color:red;"></td>
					</tr>
						<?php

						?>
				</tbody>
		   </table>
			 <div class="text-right" style = "color:red;">
				 <b>(Flower) Total Amount: PHP </b>
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



								<tr>
									<td>BQT-</td>
									<td>Php </td>
									<td></td>
									<td style = "color:red;">Php </td>
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

																<tr>
																	  <td ></td>
																		<td></td>
																		<td>Php</td>
																		<td> pcs.</td>
																		<td style = "color:red;">Php </td>
																	</tr>



																<tr>
																	<td>ACRS-</td>
																	<td></td>
																	<td>Php </td>
																	<td></td>
																	<td style = "color:red;">Php </td>
																</tr>

															</tbody>
														</table>
									</td>
								</tr>
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
