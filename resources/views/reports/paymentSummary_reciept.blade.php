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

        use Carbon\Carbon;
        $current = Carbon::now('Asia/Manila');
        //echo date('mdY',strtotime($current));
        $receiptNumber = date('mdY',strtotime($current)).'-PMNT'.$P_Details->Payment_ID;
		?>
		<div class="container">
			<div class="row">
        <p>{{$receiptNumber}}</p>
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
                  @if($P_Details->From_Id != null)
                    <p><b>Paid by:</b> (CUST-{{$P_Details->From_Id}})-{{$P_Details->From_FName}}, {{$P_Details->From_LName}} </p>
                  @else
                    <p><b>Paid by:</b> {{$P_Details->From_FName}}, {{$P_Details->From_LName}} </p>
                  @endif
                    <p><b>Date Recieved:</b> {{date('M d, Y (H:i a)',strtotime($P_Details->Date_Obtained))}}</p>
                    <p><b>Type of Payment:</b> {{$P_Details->type}}</p>
                  @if($P_Details->type == 'CASH')
                  @elseif($P_Details->type == 'BANK')
                    <p><b>Deposite Slip Number:</b> {{$P_Details->deposite_SlipNum}}</p>
                    <p><b>Bank Name:</b> {{$P_Details->bank_name}}</p>
                  @elseif($P_Details->type == 'CHECK')
                    <p><b>Check Number:</b> {{$P_Details->check_Number}}</p>
                    <p><b>Bank Name:</b> {{$P_Details->bank_name}}</p>
                    <p><b>Date of check:</b> {{date('M d, Y',strtotime($P_Details->date_of_check))}}</p>
                    <p><b>Signed by:</b> {{$P_Details->asignatory}}</p>
                  @endif
                  <p style = "color:red;"><b>Total Amount of Debt:</b> Php {{number_format($P_Details->BALANCE,2)}}</p>
                  <p style = "color:green;"><b>Amount Paid:</b> Php {{number_format($P_Details->Amount,2)}} </p>
                  <p style = "color:green;"><b>Change:</b> Php {{number_format($P_Details->Amount-$P_Details->BALANCE,2)}}</p>
								</div>
							</div>
						</div>
		       </div>


					<div class = "row">
						<div class="receipt-header receipt-header-mid">
							<hr>
								<h4 class="fontx text-center">Payment Summary</h4>
								<table class="table table-hover table-bordered">
										<thead>
											<tr>
                        <th > Order ID</th>
                        <th > AmountofPurchase </th>
                        <th > Delivery Charge </th>
                        <th > VAT</th>
                        <th > Total Amount</th>
                        <th > Balance</th>
                        <th > Amount used from the Payment</th>
										</tr>
									</thead>
									<tbody>
                    @foreach($P_Settlements as $P_Det)
                    <tr>
                      <td>ORDR-{{$P_Det->Order_ID}}</td>
                      <td>Php {{number_format($P_Det->Amt,2)}}</td>
                      <td>Php {{number_format($P_Det->Del_Charge,2)}}</td>
                      <td>Php {{number_format($P_Det->vat,2)}}</td>
                      <td>Php {{number_format($P_Det->T_amt,2)}}</td>
                      <td>Php {{number_format($P_Det->Balance,2)}}</td>
                      <td>Php {{number_format($P_Det->Balance,2)}}</td>
                    </tr>
                    @endforeach
									</tbody>
								</table>
						</div>
					</div>


					<div class="row">
						<div class="receipt-header receipt-header-mid receipt-footer">
							<div class="col-xs-8 col-sm-8 col-md-8 text-left">
								<div class="receipt-right">
									<p><b>Date :</b>
										<?php
											echo date('M d, Y (h:i a)',strtotime($current));
										?>
									</p>
									<h5 style="color: rgb(140, 140, 140);">Thank you for Trusting Us!</h5>
								</div>
							</div>
							<hr>
							<h4><b>Important Note:</b><h4>
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
