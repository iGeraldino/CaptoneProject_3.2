@extends('main')

@section('content')

<?php
	$Successession = Session::get('newOrderMade_Session');
	Session::remove('newOrderMade_Session');

  $DoneOrderSession = Session::get('QuickOrderDone');
  Session::remove('QuickOrderDone');
?>


	<div class="container">
		<div class="row">
			<div class="col-md-" style="margin-left: -7px;">
				<div class="title container" style="margin-top: 5%;">
					<h3>WONDERBLOOM FLOWERSHOP ORDERING</h3>
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-6">
					<h6 class="container"><b>Congartulations! You have successfully made an order</b></h6>
				</div>
				<div class="col-md-3 col-md-offset-3">
					<a href="/Quick_Sales_Order" type="button" class="btn btn-sm Lemon"> Done</a>
					<a href="{{route('QuickOrder.GenerateReceipt',['id'=>$NewSalesOrder->sales_order_ID])}}" type="button" class="btn btn-sm Beach"> Print</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12">
		<div class="panel" style="margin-top: 3%">
			<div class="panel-heading  Sharp">
				<div class="panel-title">
					<div class="row">
		  				<div class="col-xs-12">
		    				<h6 style="color: white"><span class="glyphicon glyphicon-user" style="color: white;"></span> <b>Order Summary</b></h6>
		  				</div>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="col-md-6">
					<h6><b>Order ID: </b>ORDR_{{$NewSalesOrder->sales_order_ID}}</h6>
				</div>
				<div class="col-md-6">
					<h6><b>Order Type: </b>{{$NewSalesOrder->Type}}</h6>
				</div>
				<div class="col-md-6">
					<h6><b>Customer Name: </b>{{$NewSalesOrder->Customer_Fname}} {{$NewSalesOrder->Customer_MName}}, {{$NewSalesOrder->Customer_LName}}</h6>
				</div>
				<div class="col-md-6">
          @if($NewSalesOrder->Status == 'CLOSED')
					 <h6 style = "color:green"><b>Status: </b>{{$NewSalesOrder->Status}}</h6>
          @else
           <h6><b>Status: </b>{{$NewSalesOrder->Status}}</h6>
          @endif
				</div>
        <div class="col-md-6">
          @if($NewSalesOrder->Status == 'CLOSED')
           <h6 style = "color:green"><b>Status: </b>{{$NewSalesOrder->Status}}</h6>
          @else
           <h6><b>Status: </b>{{$NewSalesOrder->Status}}</h6>
          @endif
        </div>

				<div hidden>
					<input type = "text" id = "NewOrderSession_Value" name = "NewOrderSession_Value" value ="{{$Successession}}">
          <input id = "NewOrderDone_result" value = "{{$DoneOrderSession}}">
				</div>

				<div class="col-md-12" style="margin-top: 40px;overflow-x:auto;">
					<h3 class="fontx text-center">Flower Summary</h3>
					<hr>
					<table class="table table-hover table-bordered">
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
							<?php
								$Total_AmtFlwr = 0;
							?>
							@foreach($SalesOrder_flowers as $flwr)
					    <tr>
					      <th scope="row">FLWR-{{$flwr->flwr_ID}}</th>
					      <td>{{$flwr->name}}</td>
					      <td>
									<img class="img-rounded img-raised img-responsive" style="min-width: 40px; max-height: 40px;"
									src="{{ asset('flowerimage/'.$flwr->Img)}}">
								</td>
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
				</div>
				<hr>
				<div class="col-md-4 col-md-offset-7" style = "color:red;">
					<b>(Flower) Total Amount: PHP {{number_format($Total_AmtFlwr,2)}}</b>
				</div>
				<div class="col-md-12" style="margin-top: 40px;overflow-x:auto;">
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
						<?php
							$totalAmt_Bqt = 0;
							$tamt_BQT = 0;
						?>
						@foreach($NewOrder_Bouquet as $Bqt)
							<tr>
								<th scope="row">BQT-{{$Bqt->Bqt_ID}}</th>
								<td>Php {{number_format($Bqt->Unit_Price,2)}}</td>
								<td>{{$Bqt->QTY}}</td>
								<td style = "color:red;">Php {{Number_format($Bqt->QTY * $Bqt->Unit_Price,2)}}</td>
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
												 @foreach($SalesOrder_Bqtflowers as $row1)
															@if($Bqt->Bqt_ID == $row1->BQT_ID)
															<tr>
																<th scope="row">{{$row1 ->FLwr_ID}}</th>
																	<td>{{ $row1 -> name}}</td>
																	<td><img class="img-rounded img-raised img-responsive"
																		style="min-width: 40px; max-height: 40px;"
																		src="{{ asset('flowerimage/'.$row1->Img)}}">
																	</td>
																	<td>Php {{ number_format($row1->price,2)}}</td>
																	<td>{{ $row1 -> qty}} pcs.</td>
																	<td style = "color:red;">Php {{Number_format($row1 -> price * $row1 -> qty,2)}}</td>
																</tr>
															@endif
													@endforeach
													@foreach($SalesOrder_BqtAccessories as $row2)
														@if($Bqt->Bqt_ID == $row2->bqt_ID)
															<tr>
																<th scope="row">ACRS-{{$row2 -> Acrs_ID}}</th>
																<td>{{ $row2 -> name}}</td>
																<td><img class="img-rounded img-raised img-responsive"
																	style="min-width: 40px; max-height: 40px;"
																	src="{{ asset('accimage/'.$row2->Img)}}">
																</td>
																<td>Php {{ Number_format($row2 -> Price,2)}}</td>
																<td>{{ $row2 -> qty}}</td>
																<td style = "color:red;">Php {{ Number_format($row2 -> Price * $row2 -> qty,2)}}</td>
															</tr>
														@endif

                            <?php
                              $tamt_BQT = $Bqt->QTY * $Bqt->Unit_Price;
                            ?>
													@endforeach

														</tbody>
													</table>
								</td>
							</tr>
              <?php
                $totalAmt_Bqt += $tamt_BQT;
              ?>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="col-md-4 col-md-offset-7" style = "color:red;">
					<b>(Bouquet) Total Amount: PHP {{number_format($totalAmt_Bqt,2)}}</b>
				</div>
			</div>
			<div class="panel-footer">

        <div class = "row">
          <div class = "col-md-7">
          </div>
          <div class = "col-md-4">
            <div class = "row">
              <div class = "col-md-7">
                <b>Amount of Flowers: </b>
              </div>
              <div class = "col-md-4">
                <div class ="col-md-6">
                  <h4  style = "color:red">Php </h4>
                </div>
                <div class ="pull-right col-md-6 text-right">
                  <h4  style = "color:red;">{{ number_format($Total_AmtFlwr,2) }}</h4>
                </div>

              </div>
            </div>
            <div class = "row">
              <div class = "col-md-7" style = "margin-top:-30p">
                <b>Amount of Bouquet: </b>
              </div>
              <div class = "col-md-4" style = "margin-top:-30p">
                <div class ="col-md-6">
                  <h4  style = "color:red">Php </h4>
                </div>
                <div class ="pull-right col-md-6 text-right">
                  <h4  style = "color:red;">{{ number_format($totalAmt_Bqt,2) }}</h4>
                </div>

              </div>
            </div>
            <div class = "row">
              <div class = "col-md-7" style = "margin-top:-30p">
                <b>Amount of Purchase: </b>
              </div>
              <div class = "col-md-4" style = "margin-top:-30p">
                <div class ="col-md-6">
                  <h4  style = "color:red;">Php </h4>
                </div>
                <div class ="pull-right col-md-6 text-right">
                  <h4  style = "color:red;">{{ number_format($invoice[10],2) }}</h4>
                </div>

              </div>
            </div>
            <div class = "row">
              <div class = "col-md-7" style = "margin-top:-30p">
                <b>Amount of Vat(12%): </b>
              </div>
              <div class = "col-md-4" style = "margin-top:-30p">
                <div class ="col-md-6">
                  <h4  style = "color:red;">Php </h4>
                </div>
                <div class ="pull-right col-md-6 text-right">
                  <h4  style = "color:red;">{{ number_format($invoice[12],2) }}</h4>
                </div>

              </div>
            </div>
            <div class = "row">
              <div class = "col-md-7" style = "margin-top:-30p">
                <b>Delivery Fee: </b>
              </div>
              <div class = "col-md-4" style = "margin-top:-30p">
                <div class ="col-md-6">
                  <h4  style = "color:red;">Php</h4>
                </div>
                <div class ="pull-right col-md-6 text-right">
                  <h4  style = "color:red;">{{ number_format($invoice[11],2) }}</h4>
                </div>

              </div>
            </div>
          <hr>
            <div class = "row">
              <div class = "col-md-7" style = "margin-top:-30p">
                <b>Total Amount: </b>
              </div>
              <div class = "col-md-4" style = "margin-top:-30p">
                <div class ="col-md-6">
                  <h4  style = "color:red;">Php</h4>
                </div>
                <div class ="pull-right col-md-6 text-right">
                  <h4  style = "color:red;">{{ number_format($invoice[15],2) }}</h4>
                </div>

              </div>
            </div>
            <hr>
            <div class = "row">
              <div class = "col-md-7" style = "margin-top:-30p">
                <b>Amount Paid: </b>
              </div>
              <div class = "col-md-4" style = "margin-top:-30p">
                <div class ="col-md-6">
                  <h4  style = "color:red;">Php</h4>
                </div>
                <div class ="pull-right col-md-6 text-right">
                  <h4  style = "color:red;">{{ number_format($invoice[2],2) }}</h4>
                </div>

              </div>
            </div>
            <div class = "row">
              <div class = "col-md-7" style = "margin-top:-30p">
                <b>Change: </b>
              </div>
              <div class = "col-md-4" style = "margin-top:-30p">
                <div class ="col-md-6">
                  <h4  style = "color:red;">Php</h4>
                </div>
                <div class ="pull-right col-md-6 text-right">
                  <h4  style = "color:red;">{{ number_format($invoice[3],2) }}</h4>
                </div>

              </div>
            </div>
        </div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')
	<script>
		$('document').ready(function(){

      if($('#NewOrderDone_result').val()=='Successful'){
        //Show popup
        swal("Congratulations!","New Order was succesfully done!","success");
       }

			if($("#NewOrderSession_Value").val() == "Successful"){
				swal('Congratulations',"The order was successfully Submitted!","success");
			}

			if($("#ship_method").val() == "delivery"){
				$("#pickup_dateDIV").hide();
				$("#delivery_det_DIV").show();
			}else if ($("#ship_method").val() == "pickup"){
				$("#delivery_det_DIV").hide();
				$("#pickup_dateDIV").show();
			}
			var Recpnt_ProvID = $('#prov_ID').val();
			var Recpnt_TownID = $('#city_ID').val();
			var Recpnt_Prov = "";
			var Recpnt_Town = "";

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
			});//end of function\
			var Adrs = $("#Del_Adrs").val();
			var Brgy = $("#Del_Brgy").val();

			$("#Del_addressDIV").replaceWith('<div id = "Del_addressDIV2" class="col-md-12"><h6><b>Delivery Address: </b>'+Adrs+','+Brgy+','+Recpnt_Town+', '+Recpnt_Prov+'</h6></div>');
		});
	</script>

@endsection
