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

		.color1 {
			color: white;
			background-color: #10085b;
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
		<h3 class="a4">Date:</h3>

		<table class=" a2 a5 table-striped table-bordered" style="width: 100%;">
			<thead>
				<tr>
			      <th class="center color1 font">TRANSACTION ID</th>
			      <th class="center color1 font">ITEM ID</th>
			      <th class="center color1 font">QUANTITY</th>
			      <th class="center color1 font">TOTAL AMOUNT</th>
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
				      <td class="font center">{{$row->Transaction_ID}}</td>
				      <td class="font center">{{$row->Item_ID}}</td>
				      <td class="font center">{{$row->Quantity}}</td>
				      <td class="font center">{{$row->Total_Amt}}</td>
				      <td class="font center">{{$row->Date}}</td>
				    </tr>
				    @endforeach
			    @endif
			</tbody>
		</table>
	</body>
</html>
