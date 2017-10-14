@extends('main')

@section('content')
	<?php

    $final_Amt = 0;

		use Carbon\Carbon;

		$current = Carbon::now('Asia/Manila');
	?>

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
