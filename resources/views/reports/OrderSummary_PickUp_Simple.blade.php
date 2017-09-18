<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<style type="text/css">
			.center {
				margin-left: 40%;
			}

			.left {
				margin-left: 10%;
			}

			.right {
				margin-left: 60%;
				margin-top: -3%;
			}

			table, th, td {
				    border: 1px solid black;
				}
		</style>
	</head>
	<body>
		<div id = "pickupSummaryDiv">
	    	<h3 class="center">ORDER SUMMARY (PICKUP)</h3>
	    	<br> <br> <br>
	    	<h4 class="left">ORDER ID:</h4>
	    	<h4 class="right">ORDER STATUS:</h4>
	    	<h4 class="left">FULL NAME:</h4>
	    	<h4 class="right">CONTACT NO:</h4>
	    	<h4 class="left">EMAIL:</h4>
	    	<h4 class="right">PAYMENT METHOD:</h4>
	    	<br> <br> <br>
	    	<h3 class="center"> FLOWER SUMMARY</h3>
	    	<br> <br>
	    	<table class="table table-bordered left" style="width:80%; overflow-x: auto;">
		        <tr>
		          <th>Flower ID</th>
		          <th>Name</th> 
		          <th>Price</th>
		          <th>Quantity</th>
		          <th>Total Amount</th>
		        </tr>
		        <tr>
		          <td>Jill</td>
		          <td>Smith</td> 
		          <td>50</td>
		          <td>Jackson</td> 
		          <td>94</td>
		        </tr>
		     </table>

		        <br> <br> <br> <br>
		     <h3 class="center">BOUQUET SUMMARY</h3>

		        <br> <br> 
		        <table class="table table-bordered left" style="overflow-x:auto; width: 80%;">
		          <thead>
		            <tr>
		              <th class="text-center">ID</th>
		              <th class="text-center">Item Name</th>
		              <th class="text-center">Price</th>
		              <th class="text-center">Qty</th>
		              <th class="text-center">Contents</th>
		            </tr>
		          </thead>
		          <tbody>
		            <tr>
		              <th scope="row">1</th>
		              <td>Mark</td>
		              <td>Otto</td>
		              <td>@mdo</td>
		              <td>
		                <table class="table table-bordered" style="overflow-x:auto; width: 100%">
		                  <thead>
		                    <th class="text-center">Item ID</th>
		                    <th class="text-center">Item Name</th>
		                    <th class="text-center">Price</th>
		                    <th class="text-center">Qty</th>
		                    <th class="text-center">Total Price</th>
		                  </thead>
		                  <tbody>
		                    <th scope="row">1</th>
		                      <td>Mark</td>
		                      <td>Otto</td>
		                      <td>@mdo</td>
		                      <td></td>
		                  </tbody>
		                </table>
		              </td>
		            </tr>
		            <tr>
		              <th scope="row">2</th>
		              <td>Jacob</td>
		              <td>Thornton</td>
		              <td>@fat</td>
		              <td>
		                <table class="table table-bordered" style="overflow-x:auto; width: 100%;">
		                  <thead>
		                  <th class="text-center">Item ID</th>
		                <th class="text-center">Item Name</th>
		                <th class="text-center">Price</th>
		                <th class="text-center">Qty</th>
		                <th class="text-center">Total Price</th>
		               </thead>
		               <tbody>
		                <th scope="row">1</th>
		                  <td>Mark</td>
		                  <td>Otto</td>
		                  <td>@mdo</td>
		                  <td></td>
		               </tbody>
		            </table>
		             </td>
		            </tr>
		            <tr>
		              <th scope="row">3</th>
		              <td>Larry</td>
		              <td>the Bird</td>
		              <td>@twitter</td>
		              <td></td>
		            </tr>
		          </tbody>
		        </table>
		        <br> <br> <br> <br>
		        <h3 class="right">TOTAL AMOUNT:</h3>
			</div>
	</body>
</html>