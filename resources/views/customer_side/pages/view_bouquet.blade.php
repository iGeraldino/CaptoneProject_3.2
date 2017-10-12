@extends('customer_side_main')
@section('title', 'Bouquets')
@section('css')
    <link href="_CSS/bouquetss.css" rel="stylesheet">
@endsection
@section('content')

	<div class="container" style="margin-top: 7%;">
		<div class="col-md-6">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h4 class="panel-title"> Bouquet Details</h4>
				</div>
				<div class="panel-body">
					<h4> Total price of Bouquet</h4>
					<div class="box">
			          <div class="box-body" style="overflow-x: auto;">
			            <table id="" class="table table-bordered table-striped">
			              <thead>
			                  <th class="text-center"> Acessories ID</th>
			                  <th class="text-center"> Accessories</th>
			                  <th class="text-center"> HOTEL/SHOP </th>
			                  <th class="text-center"> Amount of Balance</th>
			                  <th class="text-center"> Actions</th>
			              </thead>
			              <tbody>
			              	<td>aaaaa</td>
			              	<td>aaaaa</td>
			              	<td>aaaaa</td>
			              	<td>aaaaa</td>
			              	<td>aaaaa</td>
			              </tbody>
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
			                  <th class="text-center"> Flowers</th>
			                  <th class="text-center"> HOTEL/SHOP </th>
			                  <th class="text-center"> Amount of Balance</th>
			                  <th class="text-center"> Actions</th>
			              </thead>
			              <tbody>
			              	<td>aaaaa</td>
			              	<td>aaaaa</td>
			              	<td>aaaaa</td>
			              	<td>aaaaa</td>
			              	<td>aaaaa</td>
			              </tbody>
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
						<h4>Price of Bouquet</h4>
						<div class="row">
							<div class="col-md-3">
								<h5>Quantity</h5>
							</div>
							<div class="col-md-4">
							  <div class="input-group">
							    <input type="number" class="form-control" value="1">
							  </div>
							</div>
						</div>
						<div class="row" style="margin-top: 3%;">
							<div class="col-md-3">
								<h5>Total Amount</h5>
							</div>
							<div class="col-md-5">
							  <div class="input-group">
							    <input type="number" class="form-control" disabled>
							  </div>
							</div>
						</div>
						<div class="row" style="margin-top: 13%; margin-left: 5%;">
							
								<button type="submit" class="btn btn-sm btn-success"> Submit </button>
								<button type="" class="btn btn-sm btn-danger"> Back </button>
							
						</div>
					</div>
					<div class="col-md-6">
						<img class="img-responsive img-rounded" src="images/flower/pic3.jpg" alt="bouquet" width="304" height="236">
					</div>
				</div>
			</div>
		</div>
	</div>


@endsection