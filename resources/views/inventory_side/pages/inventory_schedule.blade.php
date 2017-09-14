@extends('inventory_side_design')


@section('content')
    
    <div class="container">
      <h2>MAKE SCHEDULE OF ARRIVAL OF FLOWERS IN YOUR INVENTORY</h2>
    <a type="button" class="btn twitch btn-lg " data-toggle="modal" data-target="#AddModal">
    Schedule an Order
    </a>
    </div>
    <!-- Sart Modal -->
    <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="material-icons">clear</i>
            </button>
            <h4 class="modal-title">Modal title</h4>
          </div>
          <div class="modal-body">
            <!-- Modal Content here-->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group label-static">
                  <label class="control-label">What date Do you want it to arrive?</label>
                  <input type="date" id = "datetoArriveField" name = "datetoArriveField" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group label-static">
                  <label class="control-label">What date Do you want it to arrive?</label>
                  <select  id = 'supplierField' name = 'supplierField' class="btn btn-primary btn-md" >
                    <option value = '-1'>Please Choose One Supplier</option>
                   </select>
                </div>
              </div>
            </div>
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-simple btn-success">Proceed to Choosing Flowers</button>
          </div>
        </div>
      </div>
    </div>
    <!--  End Modal -->
      <div class="container col-xs-12">
            <!-- Tabs with icons on Card -->
            <div class="card card-nav-tabs">
              <div class="header Sharp">
                <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                <div class="nav-tabs-navigation">
                  <div class="nav-tabs-wrapper">
                    <ul class="nav nav-tabs" data-tabs="tabs">
                      <li class="active">
                        <a href="#pending" data-toggle="tab">
                          <i class="material-icons">face</i>
                          Pending
                        </a>
                      </li>
                      <li>
                        <a href="#done" data-toggle="tab">
                          <i class="material-icons">chat</i>
                          Done
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="content-header">
                <div class="tab-content text-center">
                  <div class="tab-pane active" id="pending">                 
                    <div class="box">
                      <!-- /.box-header -->
                      <div class="box-body">
                        <table id="pendingtable" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                            <th>Schedule ID </th>
                            <th>Date to Recieve </th>
                            <th>Date Requested</th>
                            <th>Supp_ID</th>
                            <th>Supplier_Name </th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                          </thead>
                        <tbody>
                        </tbody>
                       </table>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                  </div>
                      <!-- end of tab pain -->
                  <div class="tab-pane" id="done">
                    <div class="box">
                      <!-- /.box-header -->
                      <div class="box-body">
                        <table id="donetable" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                            <th>Schedule ID </th>
                            <th>Date to Recieve </th>
                            <th>Date Requested</th>
                            <th>Supp_ID</th>
                            <th>Supplier_Name </th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
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
              </div>
            </div>
        </div>
  </section>
    <!-- End Section Tabs -->
@endsection

@section('scripts')

  <script type="text/javascript">
         
  </script>

@endsection