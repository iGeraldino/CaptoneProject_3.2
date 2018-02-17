<!DOCTYPE html>
<html>
<head>
	<title>Inventory Reports</title>
	<style type="text/css">
		.font {
			font-family: helvetica;
			font-size: 11px;
		}
		.font1 {
			font-family: helvetica;
			font-size: 11px;
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
			margin-left: 43%;
			padding-top: -2%;
			font-size: 20px;
		}

		.a5 {
			margin-top: 3%;
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

    <h4 class="a4"> Sales Report </h4>
		<h3 class="a5">Date: {{date('M d, Y',strtotime($start))}} - {{date('M d, Y',strtotime($end))}}</h3>

		<table class=" a2 a5 table-striped table-bordered" style="width: 100%;">
			<thead>
				 <tr>
					 	<th class="center color1 font">Date of transaction</th>
						<th class="center color1 font">BATCH ID</th>
			      <th class="center color1 font">FLOWER </th>
			      <th class="right color1 font">QUANTITY</th>
			      <th class="right color1 font">Unit Cost</th>
						<th class="right color1 font">Selling Price</th>
			      <th class="right color1 font">Profit</th>
						<th class="right color1 font">Total Cost</th>
						<th class="right color1 font">Total Profit</th>
						<th class="right color1 font">Revenue</th>
			    </tr>
			</thead>
			<tbody>
				<?php
					$TotalRevenue = 0;
					$TotalCost = 0;
					$TotalProfit = 0;
					$MarginGross = 0;
					$TotalLoss = 0;
				?>
				@if($trans == null)
					<tr>
						No Records Under the Set Date
				 </tr>
			   @else
					@foreach($trans as $row)
						<tr>
							@if($row->Profit< 0)
								<td class="font1 center" style = "color:red;"><b>{{date_format(date_create($row->Date),'m/d/y (h:i:s A)')}}</b></td>
								<td class="font1 center" style = "color:red;"><b>BATCH-{{$row->Batch_ID}}</b></td>
								<td class="font1 center" style = "color:red;"><b>(FLWR-{{$row->Item_ID}}) {{$row->flower_name}} </b></td>
								<td class="font1 right" style = "color:red;">{{$row->Qty_Sold}} pcs</td>
								<td class="font1 right" style = "color:red;">Php {{number_format($row->Cost,2)}}</td>
								<td class="font1 right" style = "color:red;">Php {{number_format($row->Selling_Price,2)}}</td>
	              <td class="font1 right" style = "color:red;">Php {{number_format($row->Profit,2)}}</td>
								<td class="font1 right" style = "color:red;">Php {{number_format($row->Total_Cost,2)}}</td>
								<td class="font1 right" style = "color:red;">Php {{number_format($row->Total_Profit,2)}}</td>
								<td class="font1 right" style = "color:red;">Php {{number_format($row->Revenue,2)}}</td>
							@else
								<td class="font1 center" style = "color:gray;"><b>{{date_format(date_create($row->Date),'m/d/y (h:i:s A)')}}</b></td>
								<td class="font1 center" style = "color:gray;"><b>BATCH-{{$row->Batch_ID}}</b></td>
								<td class="font1 center" style = "color:light-gray;"><b>(FLWR-{{$row->Item_ID}}) {{$row->flower_name}} </b></td>
								<td class="font1 right" style = "color:gray;">{{$row->Qty_Sold}} pcs</td>
								<td class="font1 right" style = "color:gray;">Php {{number_format($row->Cost,2)}}</td>
								<td class="font1 right" style = "color:blue;">Php {{number_format($row->Selling_Price,2)}}</td>
								<td class="font1 right" style = "color:green;">Php {{number_format($row->Profit,2)}}</td>
								<td class="font1 right" style = "color:green;">Php {{number_format($row->Total_Cost,2)}}</td>
								<td class="font1 right" style = "color:green;">Php {{number_format($row->Total_Profit,2)}}</td>
								<td class="font1 right" style = "color:green;">Php {{number_format($row->Revenue,2)}}</td>
							@endif
				    </tr>
							<?php
									$TotalCost += ($row->Cost * $row->Qty_Sold);
									$TotalRevenue += ($row->Selling_Price * $row->Qty_Sold);
								if($row->Selling_Price - $row->Cost > 0)
								{
									$TotalProfit +=  (($row->Selling_Price - $row->Cost)* $row->Qty_Sold);
								}
								else if($row->Selling_Price - $row->Cost < 0)
								{
									$TotalLoss += (($row->Selling_Price - $row->Cost)* $row->Qty_Sold);
								}

							?>
				    @endforeach
						<?php
							$MarginGross = (($TotalRevenue - $TotalCost)/$TotalRevenue)*100;
						?>
			    @endif
			</tbody>
			<div class = "right">
				<p style = "color: green"><b>Total cost: </b>Php {{number_format($TotalCost,2)}}</p>
				<p style = "color: green"><b>Total profit: </b>Php {{number_format($TotalProfit,2)}}</p>
				<p style = "color: red"><b>Total loss: </b>Php {{number_format($TotalLoss,2)}}</p>
				<p style = "color: green"><b>Total revenue: </b>Php {{number_format($TotalRevenue,2)}}</p>
				<p style = "color: green"><b>Gross Margin: </b> {{number_format($MarginGross,2)}} %</p>
			</div>
		</table>
	</body>
</html>
