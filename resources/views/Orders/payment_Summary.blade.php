@extends('main')

@section('content')
	<?php

    $final_Amt = 0;

		$paidSessionVal = Session::get('PaymentCompletion_Session');
		Session::remove('PaymentCompletion_Session');

		use Carbon\Carbon;

		$current = Carbon::now('Asia/Manila');
	?>
	<div hidden>
		<input type = "text" value = "{{$paidSessionVal}}" id = "payFieldSession">
	</div>

	<div class="container">
		<div class="row">
      <div class="col-md-5">
        <div class="panel" style="margin-top: 24%; margin-left: -5%;">
          <div class="panel-heading  Sharp">
            <div class="panel-title">
              <h6 style="color: white"><span class="glyphicon glyphicon-user text-center" style="color: white;"></span>
                <b>Payment details</b></h6>
            </div>
          </div>

          <div class = "panel-body">
            @if($P_Details->From_Id != null)
              <p><b>Paid by:</b> (CUST-{{$P_Details->From_Id}})-{{$P_Details->From_FName}}, {{$P_Details->From_LName}} </p>
            @else
              <p><b>Paid by:</b> {{$P_Details->From_FName}}, {{$P_Details->From_LName}} </p>
            @endif
              <p><b>Date Recieved:</b> {{date('M d, Y (H:i a)',strtotime($P_Details->Date_Obtained))}}</p>
              <p><b>Type of Payment:</b> {{$P_Details->type}}</p>
            @if($P_Details->type == 'CASH')
            @elseif($P_Details->type == 'BANK')
              <img src="{{ asset('flowerimage/'.$P_Details->image)}}" class="img-rounded img-responsive img-raised">
              <p><b>Deposite Slip Number:</b> {{$P_Details->deposite_SlipNum}}</p>
              <p><b>Bank Name:</b> {{$P_Details->bank_name}}</p>
            @elseif($P_Details->type == 'CHECK')
              <img src="{{ asset('flowerimage/'.$P_Details->image)}}" class="img-rounded img-responsive img-raised">
              <p><b>Check Number:</b> {{$P_Details->check_Number}}</p>
              <p><b>Bank Name:</b> {{$P_Details->bank_name}}</p>
              <p><b>Date of check:</b> {{date('M d, Y',strtotime($P_Details->date_of_check))}}</p>
              <p><b>Signed by:</b> {{$P_Details->asignatory}}</p>
            @endif
            <p><b>Total Amount of Debt:</b> Php {{number_format($P_Details->BALANCE,2)}}</p>
            <p><b>Amount Paid:</b> Php {{number_format($P_Details->Amount,2)}} </p>
            <p><b>Change:</b> Php {{number_format($P_Details->Amount-$P_Details->BALANCE,2)}}</p>

            <div class = "btn-group pull-right">
                <button class = "btn btn-md btn-primary">Return to dashboard</button>
                <a  href = "{{route('Payment.GenerateReceipt',['id'=>$P_Details->Payment_ID])}}" class = "btn btn-md btn-success">Print Reciept</a>
            </div>
          </div>
        </div>
      </div>
			<div class="col-md-6" style="margin-left: -7px;">
				<div class="title container" style="margin-top: 5%;">
					<h3><b>PAYMENT SUMMARY</b></h3>
				</div>

				<div class="panel" style="margin-top: 3%">
					<div class="panel-heading  Sharp">
						<div class="panel-title">
        			<div class="row">
          				<div class="col-xs-6">
            				<h6 style="color: white"><span class="glyphicon glyphicon-user" style="color: white;"></span> <b>Payment Summary</b></h6>
          				</div>
        			</div>
      			</div>
					</div>
					<div class="panel-body">
            <p style = "color:red"><b>This is the breakdown odf all the orders paid by the Customer under his statement of account</b></p>
									<div id = "balance_TBLDIV">
											<div class="box-body" style="overflow-x: auto;">
												<table id="paid_TBL" class="table table-bordered table-striped">
													<thead>
															<th class="text-center"> Order ID</th>
															<th class="text-center"> AmountofPurchase </th>
															<th class="text-center"> Delivery Charge </th>
															<th class="text-center"> VAT</th>
															<th class="text-center"> Total Amount</th>
                              <th class="text-center"> Balance</th>
                              <th class="text-center"> Amount used from the Payment</th>
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
											<!-- /.box-body -->
										<!-- /.box -->
								<!-- /.col -->
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
        $('#paid_TBL').DataTable({
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
		if($('#payFieldSession').val() == 'Successful'){
			swal('Payment Saved!','The payment of the customer has been successfully recorded under the order Id that have debts','success');
		}

	});//end of document ready
  </script>

@endsection
