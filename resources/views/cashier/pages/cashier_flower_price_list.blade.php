@extends('cashier_design')

@section('content')
       <section class="content-header">
          <h3>MARKUP PERCENTAGE OF WONDERBLOOM'S PRICES FOR FLOWERS</h3>
          <input type = "text" class = "hidden" id = "addingSessionField" value = "">
              <div class="col-md-offset-9">
                <button class="btn twitch" data-toggle="modal" data-target="#addingModal">
                Add new weekly Markup
              </button>
              </div>
              <!-- Sart Modal -->
                <div class="modal fade" id="addingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                          <i class="material-icons">clear</i>
                        </button>
                        <h4 class="modal-title">Add new weekly Markup Price</h4>
                      </div>
                      <div class="modal-body">
                      <!--put the input tags here-->
                        <div class = "row">
                          <div class = "col-md-6">
                            <div class="form-group label-floating">
                              <label class="control-label">Markup Percentage</label>
                              <input name = 'markUp' type="number" class="form-control" step = "0.1" value = "0.0" min = '0'>
                            </div>    
                          </div>
                        </div>
                        <div class = "row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Start Date: </label>
                                  <input type="date" class="form-control pull-right" id="Startdatepicker" name="Startdatepicker">
                            </div>
                         </div>
                         <div class="col-md-6">
                            <div class="form-group">
                              <label>End Date: </label>
                                  <input type="date" class="form-control pull-right" id="Enddatepicker" name="Enddatepicker">
                            </div>
                         </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success btn-simple">Save</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!--  End Modal -->
            <div class="card card-nav-tabs card-plain">
              <div class="header Sharp">
                <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                <div class="nav-tabs-navigation">
                  <div class="nav-tabs-wrapper">
                    <ul class="nav nav-tabs" data-tabs="tabs">
                      <li class="active"><a href="#activePrice" data-toggle="tab">Active PriceLists</a></li>
                      <li><a href="#updates" data-toggle="tab">Inactive PriceLists</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="content">
                <div class="tab-content text-center">
                  <div class="tab-pane active" id="activePrice">
                    <table id="example2" class="table table-bordered table-striped">
                      <thead>
                          <th> Price_ID </th>
                          <th> Markup Percentage </th>
                          <th> Start Date</th>
                          <th> Due Date </th>
                          <th> Status </th>
                          <th> Action </th>
                      </thead>
                      <tbody>
                            
                      </tbody>
                    </table>
                  </div>
                  
                  <div class="tab-pane" id="updates">
                      <table id="example3" class="table table-bordered table-striped">
                          <thead>
                              <th> Price_ID </th>
                              <th> Markup Percentage </th>
                              <th> Start Date</th>
                              <th> Due Date </th>
                              <th> Status </th>
                              <th> Action </th>
                          </thead>

                          <tbody>

                        
                          </tbody>
                 
                      </table>
                  </div>
                </div>
              </div>
            </div>
</section>
@endsection



@section('scripts')
    <script>
   
    </script>
@endsection
