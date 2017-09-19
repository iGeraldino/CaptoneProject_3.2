
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
              <table id="example2" class="table table-bordered table-striped">
                <thead style = 'color:darkviolet;'>
                    <th> Order ID </th>
                    <th> Customer_Name </th>
                    <th> Date Created</th>
                    <th> Status</th>
                    <th> Action </th>
                </thead>

                <tbody>
                    @foreach($orders as $Olist)
                    <tr>
                        <td> {{$Olist->sales_order_ID}}   </td>
                        <td> {{$Olist->Customer_Fname}} {{$Olist->Customer_MName}}., {{$Olist->Customer_LName}} </td>
                        <td> <b>{{date_format(date_create($Olist->created_at),"M d, Y")}}</b> @ <b>{{date_format(date_create($Olist->created_at),"h:i a")}}</b> </td>
                        <td>  {{$Olist->Status}} </td>
                        <td align="center" >

                               <a id = "manageBtn" type = "button" class = "btn btn-primary btn-sm" ><span class = "glyphicon glyphicon-pencil"></span>
                                Manage Order
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
