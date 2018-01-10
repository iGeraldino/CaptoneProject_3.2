@extends('customer_side_main')
@section('title', 'Checkout')
@section('css')
    <link href="_CSS/checkout1.css" rel="stylesheet">
@endsection

@section('content')
	<div class="container" style="margin-top: 5%;">
		<h2 class="fontx text-center"><b>Summary of Transaction</b></h2>
        <hr class="colorgraph">
        <p class="text-left" style = "color:red;"><b>* Congratulations!, You have successfully completed all steps. Now All you need to do to wait  </b></p>
        <p class="text-left" style = "color:red;"><b> for the confirmation msg of the shop owner, either through text,email, or call</b></p>
        <p class="text-left" style = "color:red;"><b>* Thank you for choosing us, we hope that you enjoyed the services of our shop  </b></p>
        <br>

    <div>
    	<div class="button-group pull-right">
        	<a href="{{ route('homepages') }}"type="button" class="btn btn-success btn-lg"> Done </a>
    			<a href="{{ route('guestprint', ['id' => $NewSalesOrder_details -> Order_ID]) }}" type="submit" id="Print"  class="btn btn-info btn-lg"> Print</a>
    	</div>
    </div>
    <br>
    <br>
    <br>
    <div>
			<div class="panel panel-info">
				<div class="panel-heading">
					@if($NewSalesOrder_details->shipping_method == "delivery")
						<h3 class="panel-title">Order Summary (Delivery)</h3>
					@else
					<h3 class="panel-title">Order Summary (Pickup)</h3>
					@endif
				</div>
				<div class="panel-body">
					<div class="col-md-8">
  								<h5><b>Customer Name:</b></h5>
								<div class="form-group">
		                      		<input type="text" name="fullname1" id="fullname1" class="form-control input-lg" value="{{$NewSalesOrder->Customer_Fname}} {{$NewSalesOrder->Customer_MName}}, {{$NewSalesOrder->Customer_LName}}"  disabled>
		                    	</div>
							</div>
							<br>
							<div class="col-md-3 ">
                              	<h5><b>Customer Contact:</b></h5>
								<div class="form-group">
		                      		<input type="text" name="contact1" id="contact1" class="form-control input-lg" value="{{$NewSalesOrder->Contact_Num}}" disabled>
		                    	</div>
							</div>
							<div class="col-md-4 ">
                            	<h5><b>Customer Mode of Payment:</b></h5>
								<div class="form-group">
		                      		<input type="text" name="mode1" id="mode1" class="form-control input-lg" value="{{$NewSalesOrder_details->Payment_Mode}}"  disabled>
		                    	</div>
							</div>
							<div class="col-md-3 ">
                              	<h5><b>Customer email:</b></h5>
								<div class="form-group">
		                      		<input type="text" name="email1" id="email1" class="form-control input-lg" value="{{$NewSalesOrder->email_Address}}" disabled>
		                    	</div>
							</div>
							<div class="col-md-5">
								<p> <b> Note: Please send a picture of your Deposit Slip through our email-address. <a href="#"> See example!</a> </b></p>
							</div>
							@if($NewSalesOrder_details->shipping_method == "delivery")
						<div class = "col-md-12">
							<h3 class="fontx text-left">Delivery Details</h3>
							<hr class="colorgraph">

							<div class = "row">
								<div class = "col-md-8">
									<h5><b>Recipient Name:</b></h5>
									<input type="text" name="recipientName" id="recipientName" value="{{$NewSalesOrder_details->Recipient_Fname}} {{$NewSalesOrder_details->Recipient_Mname}} , {{$NewSalesOrder_details->Recipient_Lname}}" class="form-control input-lg"  disabled>
								</div>
								<div class = "col-md-3">
									<h5><b>Recipient Contact Number:</b></h5>
									<input type="text" name="reccontact" value="{{$NewSalesOrder->Contact_Num}}" id="reccontact" class="form-control input-lg"  disabled>
								</div>
							</div>
							<div class = "row">
								<div class = "col-md-6">
									<h5><b>Date to deliver:</b></h5>
									<input type="text" name="devdate" value="<?php
                                    echo $dateTime_to_beOut = date('M d, Y ',strtotime($NewOrder_SchedDetails->Date_of_Event));
                                    //echo 'Date and time to get= '.date('Y-m-d h:i:s a', strtotime($newdate));
                                    ?>" id="devdate" class="form-control input-lg" value="" disabled>
								</div>
								<div class = "col-md-6">
									<h5><b>Time:</b></h5>
									<input type="text" name="devtime" value="<?php
                                    echo $dateTime_to_beOut = date('h:i a',strtotime($NewOrder_SchedDetails->Time));
                                    //echo 'Date and time to get= '.date('Y-m-d h:i:s a', strtotime($newdate));
                                    ?>" id="devtime" class="form-control input-lg"   disabled>
								</div>
							</div>
							<div class = "row">
								<div class = "col-md-12">
									<h5><b>Delivery Address:</b></h5>
									<input type="text" name="delivadd" value="{{$NewSalesOrder_details->Delivery_Address}}, {{$NewSalesOrder_details->Delivery_Baranggay}}, {{$city}},{{$province}}" id="delivadd" class="form-control input-lg"  disabled>
								</div>

							</div>
						</div>

					@else

							<div class = "col-md-12">

								<h3 class="fontx text-left">Pickup Details</h3>
								<hr class="colorgraph">
								<div class = "row">
									<div class = "col-md-6">
										<h5><b>Date of pickup:</b></h5>
										<input type="text"  value="<?php
                                        echo $dateTime_to_beOut = date('M d, Y ',strtotime($NewOrder_SchedDetails->Date_of_Event));
                                        //echo 'Date and time to get= '.date('Y-m-d h:i:s a', strtotime($newdate));
                                        ?>" name="SummarypickupDate" id="SummarypickupDate" class="form-control input-lg"  disabled>
									</div>
									<div class = "col-md-6">
										<h5><b>Time:</b></h5>
										<input type="text" value="<?php
                                        echo $dateTime_to_beOut = date('h:i a',strtotime($NewOrder_SchedDetails->Time));
                                        //echo 'Date and time to get= '.date('Y-m-d h:i:s a', strtotime($newdate));
                                        ?>
												" name="SummarypickupTime" id="SummarypickupTime" class="form-control input-lg"  disabled>
									</div>
								</div>
							</div>
					@endif
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
								  	<tbody class="text-center">
									@foreach($SalesOrder_flowers as $flwr)
										<tr>
											<td>{{$flwr->flwr_ID}}</td>
											<td>{{$flwr->name}}</td>
											<td>Php {{number_format($flwr->Price,2)}}</td>
											<td>{{$flwr->qty}} pcs</td>
											<td >Php {{number_format($flwr->Tamt,2)}}</td>
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

                              <tbody>
                                 <tr>
								 @foreach($NewOrder_Bouquet as $Bqt)
										 <th scope="row">BQT-{{$Bqt->Bqt_ID}}</th>
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
												   <td>{{ $row1 -> FLwr_ID }}</td>
												   <td>{{ $row1 -> name}}</td>
												   <td>Php {{ number_format($row1->price,2)}}</td>
												   <td>{{ $row1 -> qty}} pcs.</td>
												   <td style = "color:red;">Php {{Number_format($row1 -> price * $row1 -> qty,2)}}</td>
											   </tr>
										   @endif
									   @endforeach
	                                   </tbody>
		                                <tbody>
										@foreach($SalesOrder_BqtAccessories as $row2)
											@if($Bqt->Bqt_ID == $row2->bqt_ID)
												<tr>
													<td> {{ $row2 -> Acrs_ID }}</td>
													<td>{{ $row2 -> name}}</td>
													<td>Php {{ Number_format($row2 -> Price,2)}}</td>
													<td>{{ $row2 -> qty}}</td>
													<td style = "color:red;">Php {{ Number_format($row2 -> Price * $row2 -> qty,2)}}</td>
												</tr>
											@endif
										@endforeach
									@endforeach
		                                </tbody>

                                	</table>
                                </td>
                            </tr>
                        </tbody>
					</table>
				</div>
			</div>
			<div class="col-md-offset-6 pull-right">
        <h4 class="fontx text-left"><b>Pirchase Amount:</b> PHP  {{ number_format($NewSalesOrder_details -> Subtotal,2) }}</h4>
					<h4 class="fontx text-left"><b>VAT:</b> PHP  {{ number_format($NewSalesOrder_details -> Subtotal * .12,2) }}</h4>
					<h4 class="fontx text-left"><b>Delivery Charge:</b> PHP {{ number_format($NewSalesOrder_details -> Delivery_Charge,2) }} </h4>
          <h4 class="fontx text-left"><b>TOTAL AMOUNT:</b> PHP {{ number_format($NewSalesOrder_details -> Total_Amt + $NewSalesOrder_details -> Delivery_Charge,2) }} </h4>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')

	<script>


       $('#print').click(function(){

           $('#print').hide();

	   });

	</script>


@endsection
