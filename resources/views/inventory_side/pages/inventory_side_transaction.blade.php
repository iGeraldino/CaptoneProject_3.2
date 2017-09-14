@extends('inventory_side_design')

@section('content')

	<div class="container" style="">
	  <div class = "container">
      <h2>INVENTORY TRANSACTIONS</h2>
      <h5 class="container">Check everything that is happenning inside your inventory</h5>
    </div>

<!-- TABLE-->
    </div>
        <div class="col-md-12">
          <div class="box">
          <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <th class="text-center"> Transaction ID </th>
                    <th class="text-center"> Name</th>
                    <th class="text-center"> Image</th>
                    <th class="text-center"> Type of Transaction </th>
                    <th class="text-center"> Batch_ID </th>
                    <th class="text-center"> Order_ID </th>
                    <th class="text-center"> Quantity </th>
                    <th class="text-center"> Unit_Cost</th>
                    <th class="text-center"> Selling_Price</th>
                    <th class="text-center"> Total Amount</th>
                    <th class="text-center"> Date</th>
                </thead>

                <tbody>
                
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        <!-- /.box -->
        </div>
      </div>
      <!-- /.col -->

    <!--MODAL FLOWER-->

    <div class="modal fade" id="flower" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #FFB3A7">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h5 class="modal-title" id="myModalLabel" style="padding-bottom: 10px;">Show by Flower</h5>
          </div>
          <div class="modal-body">
            <div class="col-sm-4">
              <div class="form-group label-floating">
                <label class="control-label">Flower ID</label>
                <input type="email" class="form-control">
              </div>
            </div>
            <div class="dropdown col-sm-4" style="margin-top: 25px;">
              <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown">Flower Name
              <span class="caret" ></span></button>
              <ul class="dropdown-menu">
                <li><a href="#">Mary</a></li>
                <li><a href="#">Rose</a></li>
                <li><a href="#">Dasiy</a></li>
              </ul>
            </div>


            <div class="row" >
              <div class="col-xs-12">
                <div class="box">
                <!-- /.box-header -->
                  <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                      <thead>
                          <th class="text-center"> Transaction ID </th>
                          <th class="text-center"> Flower ID </th>
                          <th class="text-center"> Name</th>
                          <th class="text-center"> Quantity </th>
                          <th class="text-center"> Date</th>
                      </thead>

                      <tbody>
                        <tr>  
                          <td> 1     </td>
                          <td>       </td>
                          <td>       </td>
                          <td>       </td>
                          <td>       </td>
                        </tr>
                        
                        <tr>    
                          <td> 2     </td>
                          <td>       </td>
                          <td>       </td>
                          <td>       </td>
                          <td>       </td>
                        </tr>

                        <tr>  
                          <td> 3     </td>
                          <td>       </td>
                          <td>       </td>
                          <td>       </td>
                          <td>       </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>
              <!-- /.box -->
              </div>
            </div>
            <!-- /.col -->
          </div>
          <br>
          <br>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-info btn-simple">Save changes</button>
          </div>
        </div>
      </div>
    </div>


    <!--MODAL DATE-->

    <div class="modal fade" id="date" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #FFB3A7">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h5 class="modal-title" id="myModalLabel" style="padding-bottom: 10px;">Add Agreement</h5>
          </div>
          <div class="modal-body">
            <div class="dropdown col-sm-4" style="margin-top: 25px;">
              <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown">List of Dates
              <span class="caret" ></span></button>
              <ul class="dropdown-menu">
                <li><a href="#">...</a></li>
                <li><a href="#">...</a></li>
                <li><a href="#">...</a></li>
              </ul>
            </div>


            <div class="row" >
              <div class="col-xs-12">
                <div class="box">
                <!-- /.box-header -->
                  <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                      <thead>
                          <th class="text-center"> Transaction ID </th>
                          <th class="text-center"> Flower ID </th>
                          <th class="text-center"> Flower Name</th>
                          <th class="text-center"> Quantity </th>
                          <th class="text-center"> Date</th>
                      </thead>

                      <tbody>
                        <tr>  
                          <td> 1     </td>
                          <td>       </td>
                          <td>       </td>
                          <td>       </td>
                          <td>       </td>
                        </tr>
                        
                        <tr>    
                          <td> 2     </td>
                          <td>       </td>
                          <td>       </td>
                          <td>       </td>
                          <td>       </td>
                        </tr>

                        <tr>  
                          <td> 3     </td>
                          <td>       </td>
                          <td>       </td>
                          <td>       </td>
                          <td>       </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>
              <!-- /.box -->
              </div>
            
            <!-- /.col -->
          </div>
          <br>
          <br>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-info btn-simple">Save changes</button>
          </div>
        </div>
      </div>
    </div>  

@endsection

@section('scripts')
  
@endsection
