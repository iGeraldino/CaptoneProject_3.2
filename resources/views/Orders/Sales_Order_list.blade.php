
@extends('main')

@section('content')

    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h2> List of unconfirmed Orders</h2>
      <div class="col-md-8">

      <br>
   <br>
  </section>





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
                                    </div>
                                    </div>
                                </div>
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
