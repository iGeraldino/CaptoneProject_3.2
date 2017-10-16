@extends('customer_side_main')
@section('title', 'Bouquets')
@section('css')
    link href="_CSS/bouquetss.css" rel="stylesheet">
@endsection
@section('content')

	<div class="container" style="margin-top: 7%;">
		@foreach($bouquetdetails as $bouq)
		@endforeach
		<div class="col-md-6">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h4 class="panel-title"> Bouquet Details</h4>
				</div>
				<div class="panel-body">
					<h4> Total price of Bouquet : Php {{ $TotalPrice }} </h4>
					<h5>Boquet ID {{ $bouq -> bouquet_ID }}</h5>
					<h5>Total number of flowers : {{ $totalflowers }} Flowers </h5>
					<h5>Total number of acccessories : {{ $totalaccessories }} Accessories </h5>
					<div class="box">
			          <div class="box-body" style="overflow-x: auto;">
			            <table id="" class="table table-bordered table-striped">
			              <thead>
			                  <th class="text-center"> Acessories ID</th>
			                  <th class="text-center"> Accessories Image</th>
			                  <th class="text-center"> Accessories Name</th>
			                  <th class="text-center"> Quantity</th>
			                  <th class="text-center"> Price</th>
							  <th class="text-center"> Total Amount</th>
			              </thead>
							@foreach($bouquetaccessories as $asd)
							<tbody>
							<td>{{ $asd -> Acessory_ID  }}</td>
							<td><img src="{{ asset('accimage/'. $asd -> IMG) }}" style="width: 70px; height: 70px;"></img></td>
			              	<td>{{ $asd -> Name }}</td>
			              	<td>{{ $asd -> QTY }}</td>
							<td>{{ $asd -> Price }}</td>
							<td>{{ $asd -> Total_Amt }}</td>
							</tbody>
							@endforeach

						</table>
			          </div>
			          <!-- /.box-body -->
			        </div>
			        <!-- /.box -->
			        <div class="box ">
			          <div class="box-body">
			            <table id="" class="table table-bordered " style="overflow-x: auto;">
			              <thead>
			                  <th class="text-center"> Flower ID</th>
			                  <th class="text-center"> Flower Image</th>
			                  <th class="text-center"> Flower Name</th>
			                  <th class="text-center"> Flower Quantity</th>
			                  <th class="text-center"> Flower Price</th>
							  <th class="text-center"> Flower Total Amount</th>
			              </thead>
							@foreach($bouquetflowers as $flowers)
			              <tbody>
			              	<td>{{$flowers -> flower_ID}}</td>
							<td><img src="{{ asset('flowerimage/'. $flowers -> IMG) }}" style="width: 70px; height: 70px;"></img></td>
							<td>{{ $flowers -> flower_name }}</td>
			              	<td>{{ $flowers -> QTY }}</td>
			              	<td>{{ $flowers -> Final_SellingPrice }}</td>
							<td>{{ $flowers -> Total_Amount }}</td>
			              </tbody>
							@endforeach
			            </table>
			          </div>
			          <!-- /.box-body -->
			        </div>
			        <!-- /.box -->
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h4 class="panel-title"> Bouquet Details</h4>
				</div>
				<div class="panel-body">
					<div class="col-md-6">
						<form method="post" action="{{ route('adddefaultboq') }}">
						<h4>Price of Bouquet</h4>
							<input type="number" class="form-control hidden"   name ="totalcount" value="{{ $totalflowers + $totalaccessories }}">

							<input type="text" value="{{ $bouq -> bouquet_ID }}" name="boqid" class="hidden">
							<div class="row">
							<div class="col-md-3">
								<h5>Quantity</h5>
							</div>
							<div class="col-md-6">
							  <div class="input-group">
							    <input type="number" class="form-control" value="" name="quantity" id = "quantity" min="1" autocomplete="off">
							  </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<h5>Total Amount</h5>
							</div>
							<div class="col-md-6" style="margin-top: 5%;">
				              <div class="input-group">
								  <div hidden>
								  <input type="number" class="form-control" id="totalprice"  name ="total" value="{{ $TotalPrice }}">
								  </div>
				                <input type="number" class="form-control" id="total"  disabled>
				              </div>
				             </div>
						</div>
						<div class="row" style="margin-top: 13%; margin-left: 5%;">
							<button type="submit" id="submitboq" class="btn btn-sm btn-success"> Submit </button>
							<button type="" class="btn btn-sm btn-danger"> Back </button>
						</div>
							{{ csrf_field() }}
						</form>
					</div>
					<div class="col-md-6">
						<img class="img-responsive img-rounded" src="{{ asset('bouquetimage/'. $bouq -> image) }}" alt="bouquet image" width="304" height="236">
					</div>
				</div>
			</div>
		</div>
	</div>


@endsection
@section('script')
	<script>

        $(document).ready(function () {

            var totalprice = parseInt($('#totalprice').val());
            var quan = parseInt($('#quantity').val());
            var total =  parseInt(totalprice)*parseInt(quan);

            $('#total').val(parseInt(total));


            $('#quantity').change(function(){

                if($('#quantity').val() == ""){

                    $('#submitboq').attr('disabled',true);

                }
				else {

                    var totalprice = parseInt($('#totalprice').val());
                    var quan = parseInt($('#quantity').val());
                    var total = parseInt(totalprice) * parseInt(quan);

                    $('#total').val(parseInt(total));

                    $('#submitboq').attr('disabled', false);
                }

            });

			if($('#quantity').val() == ""){

				$('#submitboq').attr('disabled',true);

			}

			});

        </script>
@endsection