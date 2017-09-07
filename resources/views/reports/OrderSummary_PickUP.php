<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title> Finalized Order Summary </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('_CSS/index2.css') }}">
    <link rel="stylesheet" href="{{asset('font-awesome-4.7.0/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{asset('admin/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/parsley.css')}}">
    <link rel="stylesheet" href="{{asset('css/sweetalert.css')}}">
    <link rel="stylesheet" href="{{asset ('fonts/assets.css')}}">
    <link rel="stylesheet" href="{{asset ('admin/plugins/datepicker/datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset ('admin/plugins/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset ('admin/plugins/timepicker/bootstrap-timepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset ('sweetalert-master/dist/sweetalert.css')}}">
  </head>
  <body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                  <div id = "pickupSummaryDiv">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="panel panel-info">
                          <div class="panel-heading">
                            <h3 class="panel-title">Order Summary (Pickup)</h3> 
                            <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                          </div>
                          <div class="panel-body">
                            <div class="col-md-4 ">
                              <div class="form-group">
                                            <input type="text" name="orderid" id="orderid" class="form-control input-lg" placeholder="Order ID" tabindex="2">
                                        </div> 
                            </div>
                            <div class="col-md-offset-2 col-md-4">
                              <div class="form-group">
                                            <input type="text" name="status" id="status" class="form-control input-lg" value ="Pending">
                                        </div> 
                            </div>
                            <div class="col-md-8">
                              <div class="form-group">
                                            <input type="text" name="fullname1" id="fullname1" class="form-control input-lg" value = "laman dapat nito yung fullname ng nagorder">
                                        </div> 
                            </div>
                            <br>
                            <div class="col-md-3 ">
                              <div class="form-group">
                                            <input type="Number" name="contact" id="contact" class="form-control input-lg" value ="number ng nagorder">
                                        </div> 
                            </div>
                            <div class="col-md-4 ">
                              <div class="form-group">
                                            <input type="text" name="mode" id="mode" class="form-control input-lg" value = "piniling payment method" tabindex="2">
                                        </div> 
                            </div>
                            <div class="col-md-3 ">
                              <div class="form-group">
                                            <input type="textr" name="email" id="email" class="form-control input-lg" value ="Email Address ng nagorder">
                                        </div> 
                            </div>
                            <div class="col-md-5">
                              <p> <b> Note: Please send a picture of your Deposit Slip through our email-address. <a href="#"> See example!</a> </b></p>
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
                            <h3 class="fontx text-center"> TOTAL AMOUNT:</h3>
                          </div>
                        </div>
                      </div>
                    </div>
                    </div>
  </body>
</html>