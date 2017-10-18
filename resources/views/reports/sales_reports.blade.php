<!DOCTYPE html>
<html>
<head>
	<title>Inventory Reports</title>
	<style type="text/css">
		.font {
			font-family: helvetica;
		}
		.a1 {
			text-align: center;
			margin-bottom: 5%;
		}

		.a2 {
			padding-top: -2%;
		}

		.a3 {
		}

		.a4 {
			margin-left: 50%;
			padding-top: -5%;
		}

		.a5 {
			margin-top: 10%;
		}

		table, th, td {
		    border: 1px solid black;
		    border-collapse: collapse;
		}

		.center {
			text-align: center;
		}

		.right {
			text-align: right;
		}

		.color1 {
			color: white;
			background-color: #DC654C;
		}
	</style>
</head>
	<body class="font">
		<h2 class="a1"> FLOWER TRANSACTION INVENTORY REPORT</h2>
		<h4 class="a2"> Wonderbloom Flowershop</h4>
		<h4 class="a2 a3"> Address: 1600 DIMASALANG, SAMPALOC MANILA</h4>
		<h4 class="a2 a3">Email: wonder.bloom@yahoo.com</h4>
		<h4 class="a2 a3"> Tel No:(02)567-3255</h4>
		<h4 class="a2 a3"> CP No: 09228026806</h4>
		@if($report_Type == 'byDate')
			<h3 class="a4">Date: {{date('M d, Y',strtotime($start))}} - {{date('M d, Y',strtotime($end))}}</h3>
		@elseif($report_Type == 'byBatch')
			<h3 class="a4">Transactions on the Batch ID: {{$batch}} </h3>
		@endif

		@if($type == "Accessory")
			<h4 class="a1"> Monitoring of the in and Out of the Accessories in the inventory</h4>
		@elseif($type == 'Flower')
			<h4 class="a1"> Monitoring of the in and Out of the flowers in the inventory</h4>
		@endif

		<table class=" a2 a5 table-striped table-bordered" style="width: 100%;">
			<thead>
				<tr>
			      <th class="center color1 font">TRANSACTION ID</th>
						<th class="center color1 font">BATCH ID</th>
			      <th class="center color1 font">ITEM ID</th>
			      <th class="center color1 font">QUANTITY</th>
			      <th class="center color1 font">TOTAL AMOUNT</th>
						<th class="center color1 font">DESCRIPTION</th>
			      <th class="center color1 font">ORDER ID</th>
			      <th class="center color1 font">DATE</th>
			    </tr>
			</thead>
			<tbody>
				@if($trans == null)
					<tr>
						No Records Under the Set Date
				 </tr>
			    @else
					@foreach($trans as $row)
					<tr>
								<td class="font center" style = "color:gray;"><b>TRANS-{{$row->Transaction_ID}}</b></td>
								@if($row->Batch_ID == null)
				      		<td class="font center" style = "color:gray;"><b>N/A</b></td>
								@else
									<td class="font center" style = "color:gray;"><b>BATCH-{{$row->Batch_ID}}</b></td>
								@endif
							@if($row->Item_Type == 'Flower')
				      	<td class="font center" style = "color:light-gray;"><b>FLWR-{{$row->Item_ID}}</b></td>
							@elseif($row->Item_Type == 'Acessories')
								<td class="font center" style = "color:light-gray;"><b>ACRS-{{$row->Item_ID}}</b></td>
							@endif
							@if($row->Quantity < 0)
				      	<td class="font center" style = "color:red;"><b>{{$row->Quantity}} pcs.</b></td>
							@elseif($row->Quantity >= 0)
								<td class="font center" style = "color:gray;"><b>{{$row->Quantity}} pcs.</b></td>
							@endif
				      <td class="font right">{{number_format($row->Total_Amt,2)}}</td>
				      @if($row->Type_of_changes == 'S')
				      	<td class="font center" style = "color:red;"><b>Spoilage</b></td>
				      @elseif($row->Type_of_changes == 'O')
				      	<td class="font center" style = "color:green;"><b>Order</b></td>
				 	  @elseif($row->Type_of_changes == 'I')
				      	<td class="font center" style = "color:blue;"><b>Inventory</b></td>
				 	  @elseif($row->Type_of_changes == 'A')
				      	<td class="font center" style = "color:blue;"><b>Adjustments</b></td>
				      @endif
							@if($row->order_ID == null)
								<td class="font center" style = "color:gray;"><b>N/A</b></td>
							@elseif($row->order_ID != null)
								<td class="font center" style = "color:gray;">ORDR-{{$row->order_ID}}</td>
							@endif
							<td class="font center">{{date('M d, Y (h:i a)',strtotime($row->Date))}}</td>
				    </tr>
				    @endforeach
			    @endif
			</tbody>
		</table>
	</body>
</html>
