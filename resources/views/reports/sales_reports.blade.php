<!DOCTYPE html>
<html>
<head>
	<title>Inventory Reports</title>
	<style type="text/css">
		.font {
			font-family: helvetica;
		}
		.a1 {
			margin-left: 40%;
			margin-bottom: 5%;
		}

		.a2 {
			margin-left: 10%;
		}

		.a3 {
			margin-top: -1.5%;
		}

		.a4 {
			margin-left: 50%;
			margin-top: -7%;
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
		<h1 class="a1"> SALES REPORT</h1>
		<h4 class="a2"> Wonderbloom Flowershop</h4>
		<h4 class="a2 a3"> Address: 1600 DIMASALANG, SAMPALOC MANILA</h4>
		<h4 class="a2 a3">Email: wonder.bloom@yahoo.com</h4>
		<h4 class="a2 a3"> Tel No:(02)567-3255</h4>
		<h4 class="a2 a3"> CP No: 09228026806</h4>
		<h3 class="a4">Date:  </h3>

		<table class=" a2 a5 table-striped table-bordered" style="width: 80%;">
			<thead>
				<tr>
			      <th class="center color1 font">DATE</th>
			      <th class="center color1 font">COMPANY</th>
			      <th class="center color1 font">AMOUNT</th>
			      <th class="center color1 font">COST</th>
			      <th class="center color1 font">REVENUE</th>
			    </tr>
			</thead>
			<tbody>
				@if($trans == null)
					<tr>
						NO Records Under the Set Date
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

