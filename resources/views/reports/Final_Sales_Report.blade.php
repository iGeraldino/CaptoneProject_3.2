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

    <h4 class="a4"> Sales Report </h4>
		<h3 class="a5">Date: {{date('M d, Y',strtotime($start))}} - {{date('M d, Y',strtotime($end))}}</h3>
    @foreach($totalProfit as $totalProfit)
    <p class="a4" style = "color:green"><b>TOTAL PROFIT: </b> Php {{number_format($totalProfit->TOTAL_PROFIT,2)}}</p>
    @endforeach

		<table class=" a2 a5 table-striped table-bordered" style="width: 100%;">
			<thead>
				<tr>
						<th class="center color1 font">BATCH ID</th>
			      <th class="center color1 font">FLOWER </th>
			      <th class="center color1 font">QUANTITY</th>
			      <th class="center color1 font">Unit Cost</th>
						<th class="center color1 font">Selling Price</th>
			      <th class="center color1 font">Profit</th>
			      <th class="center color1 font">Total Profit</th>
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
							<td class="font center" style = "color:gray;"><b>BATCH-{{$row->Batch}}</b></td>
				      <td class="font center" style = "color:light-gray;"><b>(FLWR-{{$row->item_ID}}) {{$row->name}} </b></td>
              <td class="font center" style = "color:gray;">{{$row->QTY}} pcs</td>
              <td class="font center" style = "color:gray;">Php {{number_format($row->unit_COST,2)}}</td>
              <td class="font center" style = "color:blue;">Php {{number_format($row->selling_Price,2)}}</td>
              <td class="font center" style = "color:green;">Php {{number_format($row->profit,2)}}</td>
							<td class="font center" style = "color:green;">Php {{number_format($row->TOTAL_PROFIT,2)}}</td>
				    </tr>
				    @endforeach
			    @endif
			</tbody>
		</table>
	</body>
</html>
