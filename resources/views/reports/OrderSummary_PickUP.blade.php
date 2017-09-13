@extends('reports_design')
@section('title', 'Order Summary(Pickup)')
@section('content')
  <div id = "pickupSummaryDiv">
    <h3 class="text-center">ORDER SUMMARY (PICKUP)</h3>
  </div>
  <br> <br><br> <br>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h4><b>ORDER ID:</b></h4>
      </div>
      <div class="col-md-4 col-md-offset-3">
        <h4><b>ORDER STATUS:</b></h4>
      </div>
      <div class="col-md-4">
        <h4><b>FULL NAME:</b></h4>
      </div>
      <div class="col-md-4 col-md-offset-3">
        <h4><b>CONTACT NUMBER:</b></h4>
      </div>
      <div class="col-md-4">
        <h4><b>EMAIL:</b></h4>
      </div>
      <div class="col-md-4">
        <h4><b>PAYMENT METHOD:</b></h4>
      </div>
      <div class="col-md-4">
        <h5><b>Note: Please send a picture of your Deposit Slip through our email-address.</b></h5>
      </div>
    </div>
    <br> <br><br> <br>
    <h3 class="text-center">FLOWER SUMMARY</h3>
    <hr>
    <div>
      <table class="table table-bordered" style="width:100%">
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
    </div>
    <br> <br><br> <br>
    <h3 class="text-center">BOUQUET SUMMARY</h3>
      <hr>
        <table class="table table-bordered" style="overflow-x:auto;">
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
                <table class="table table-bordered" style="overflow-x:auto;">
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
                <table class="table table-bordered" style="overflow-x:auto;">
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
    <div class="col-md-offset-6">
      <h3 class="fontx text-center"> TOTAL AMOUNT:</h3>
    </div> 
  </div>      
  <br> <br>

@endsection