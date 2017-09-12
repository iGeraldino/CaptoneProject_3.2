@extends('reports_design')
@section('title', 'Order Summary(Delivery)')
@section('css')
    <link href="_CSS/index2.css" rel="stylesheet">
@endsection
@section('content')
  <div>
    <div id = "deliverySummaryDiv" style="margin-top: 50px;">
                     
                    <div class="row">
                      <div class="col-md-12">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h3 class="panel-title">Order Summary (Delivery)</h3>
                          </div>
                          <div class="panel-body">
                            <div class="col-md-8">
                              <div class="form-group">
                                            <input type="text" name="fullname" id="fullname" class="form-control input-lg" Value = "laman dapat nito yung full name ng nagorder" disabled>
                                        </div> 
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                            <input type="text" name="contact" id="contact" class="form-control input-lg" value="number ng nagorder" disabled>
                                        </div> 
                            </div>
                            <div class="col-md-4 ">
                              <div class="form-group">
                                            <input type="text" name="mode" id="mode" class="form-control input-lg" value="piniling payment method" disabled>
                                        </div> 
                            </div>
                            <div class="col-md-3 ">
                              <div class="form-group">
                                            <input type="textr" name="email" id="email" class="form-control input-lg" value ="Email Address ng nagorder" disabled>
                                        </div> 
                            </div>
                            <div class="col-md-5">
                              <p> <b> Note: Please send a picture of your Deposit Slip through our email-address. <a href="#"> See example!</a> </b></p>
                            </div>
                              <hr>
                            <div class = "col-md-12">
                              <h3 class="fontx text-left">Delivery Details</h3>
                              <hr class="colorgraph">

                              <div class = "row">
                                <div class = "col-md-8">
                                  <h5><b>Recipient Name:</b></h5>
                                  <input type="text" name="recipientName" id="recipientName" class="form-control input-lg" value="lagay full name ng reciepient na sinet ng customer" disabled>
                                </div>
                                <div class = "col-md-3">
                                  <h5><b>Recipient Contact Number:</b></h5>
                                  <input type="text" name="recipientName" id="recipientName" class="form-control input-lg" value="lagay Number ng recipient" disabled>
                                </div>
                              </div>
                              <div class = "row">
                                <div class = "col-md-6">
                                  <h5><b>Date to deliver:</b></h5>
                                  <input type="text" name="Summarydeliverydate" id="Summarydeliverydate" class="form-control input-lg" value="lagay date ng delivery" disabled>
                                </div>
                                <div class = "col-md-6">
                                  <h5><b>Time:</b></h5>
                                  <input type="text" name="SummarydeliveryTime" id="Summarydeliverytime" class="form-control input-lg" value="lagay time ng delivery" disabled>
                                </div>
                              </div>  
                              <div class = "row">
                                <div class = "col-md-12">
                                  <h5><b>Delivery Address:</b></h5>
                                  <input type="text" name="Summarydeliverydate" id="Summarydeliverydate" class="form-control input-lg" value="Complete delivery address dito" disabled>
                                </div>

                              </div>                                                            
                            </div>
                            <div class="col-md-12" style="margin-top: 40px;overflow-x:auto;">
                              <h3 class="fontx text-center">Flower Summary</h3>
                              <hr class="colorgraph">
                              <table class="table table-hover table-bordered">
                                  <thead>
                                    <tr>
                                      <th class="text-center">Flower ID</th>
                                      <th class="text-center">Name</th>
                                      <th class="text-center">Price</th>
                                      <th class="text-center">Qty</th>
                                      <th class="text-center">Total Amount</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td></td>
                                  </tr>
                                  <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                    <td></td>
                                  </tr>
                                  <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td></td>
                                    <td>@twitter</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                            <div class="col-md-12" style="margin-top: 40px;overflow-x:auto;">
                              <h3 class="fontx text-center">Bouquet Summary</h3>
                              <hr class="colorgraph">
                              <table class="table table-hover table-bordered">
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
                            </div>
                          </div>
                          <div class="col-md-offset-6">
                            <h3 class="fontx text"> TOTAL AMOUNT:</h3>
                          </div>
                          <br>
                          <p class="col-md-offset-1" style="color: red;"><b>Take Note: You must send the copy of your deposit slip (Amounting of 20% minimum of total amount)</b></p>
                          <p class="col-md-offset-1"><b>With regards to the order please wait for a call or an email from the company. This will be about the confirmation and other stuffs that you must prepare upon ordering.</b>
                            
                          </p>
                          <br>
                          <br>
                        </div>
                      </div>
                    </div>
                    </div>
        <div>
          <p>
            Visit us 1234 Dangwa St. Manila 
          </p>
          <p>
            Call us at 0907647389
          </p>
          <p>
            Email us at wonderbloomshop@mail.com
          </p>
        </div>
  </div>


@endsection