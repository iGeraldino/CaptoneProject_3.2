
@extends('main')

@section('content')

    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h2 class="container"> LIST OF ORDERS</h2>
      <div class="col-md-8">
   <br>
  </section>

    <div class="col-md-12">
      <!-- Tabs with icons on Card -->
      <div class="card card-nav-tabs">
        <div class="header Sharp">
          <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
          <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
              <ul class="nav nav-tabs" data-tabs="tabs">
                <li class="active">
                  <a href="#pending" data-toggle="tab">
                    <i class="material-icons">assignment_return</i>
                    Pending
                  </a>
                </li>
                <li>
                  <a href="#partial" data-toggle="tab">
                    <i class="material-icons">assignment_returned</i>
                    Confirmed
                  </a>
                </li>
                <li>
                  <a href="#closed" data-toggle="tab">
                    <i class="material-icons">assignment_turned_in</i>
                    Closed
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="content">
          <div class="tab-content text-center">
            <div class="tab-pane active" id="pending">
              <div class="col-xs-12">
          <div class="box">

            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped table-hover">
                <thead style="color: #6e48aa">
                    <th class="text-center"> ORDER ID </th>
                    <th class="text-center"> CUSTOMER NAME </th>
                    <th class="text-center"> DATE CREATED</th>
                    <th class="text-center"> STATUS</th>
                    <th class="text-center"> ACTION </th>
                </thead>

                <tbody>
                    @foreach($orders as $Olist)
                    <tr>
                        <td class="text-center"> {{$Olist->sales_order_ID}}   </td>
                        <td class="text-center"> {{$Olist->Customer_Fname}} {{$Olist->Customer_MName}}., {{$Olist->Customer_LName}} </td>
                        <td class="text-center"> <b>{{date_format(date_create($Olist->created_at),"M d, Y")}}</b> @ <b>{{date_format(date_create($Olist->created_at),"h:i a")}}</b> </td>
                        <td class="text-center" style="text-transform: uppercase;">  {{$Olist->Status}} </td>
                        <td align="center" >

                               <a id = "manageBtn" type = "button" data-toggle="tooltip" title="Manage Orders" class = "btn btn-primary btn-just-icon twitch" ><i class="material-icons">mode_edit</i>
                               </a>
                        </td>

                      </tr>
                      @endforeach
                </tbody>
              </table>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        <!-- /.col -->
      </div>
  </div>
            </div>
            <div class="tab-pane" id="partial">
              <div class="col-xs-12">
                <div class="box">
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                      <thead>
                          <th class="text-center"> Order ID </th>
                          <th class="text-center"> Customer_Name </th>
                          <th class="text-center"> Date Created</th>
                          <th class="text-center"> Status</th>
                      </thead>
                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              <!-- /.col -->
              </div>
            </div>
            <div class="tab-pane" id="closed">
              <div class="col-xs-12">
                <div class="box">
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                      <thead>
                          <th class="text-center"> Order ID </th>
                          <th class="text-center"> Customer_Name </th>
                          <th class="text-center"> Date Created</th>
                          <th class="text-center"> Status</th>
                      </thead>
                      <tbody>
                        <td>1</td>
                        <td> Christine Joy Aradia</td>
                        <td></td>
                        <td>UTANG</td>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              <!-- /.col -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Tabs with icons on Card -->

    </div>

@endsection


@section('scripts')
    <script>
      $(document).ready(function(){

        $('#manageBtn').click(function(){
          swal("Sorry :( ","this function is currently under development","info")
        });

      $(function () {
        $('#example2').DataTable({
/*          "paging": true,
          "lengthChange": false,
          "ordering": true,
          "info": true,
          "autoWidth": false*/
        });
      });
      });
    </script>
@endsection\
