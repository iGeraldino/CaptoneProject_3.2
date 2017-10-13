
@extends('main')

@section('content')
<?php
  $ManagingFlwr_session = Session::get('ManagingFlowerSession');
  Session::remove('ManagingFlowerSession');//determines the deletion of Acessory

  $EdittingFlwr_session = Session::get('editSession');
  Session::remove('editSession');//determines the deletion of Acessory

 ?>
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <div hidden>
        <input id = "countToReach" value = ""/>
        <input id = "countDone" value = ""/>

        <input id = "EditingFlowerSessionfield" value = "">
        <input id = "ManageFlowerSessionfield" value = "">
      </div>
       <div class="col-xs-12" style="margin-top: 2%;">
        <div class="panel">
          <div class="panel-heading Subu">
            <h3 class="panel-title" style="color: white;"><b>LIST OF ORDERS THAT WITH DEBTS</b></h3>
          </div>
          <div class="panel-body">
						<div class = "row">
              <div class = "col-md-6">
								<p><b>Customer: </b>(CUST-{{$cust->Cust_ID}}) {{$cust->Cust_FName}} {{$cust->Cust_MName}}, {{$cust->Cust_LName}}</p>
								<p><b>Contact No: </b>{{$cust->Contact_Num}}</p>
								<p><b>Email: </b>{{$cust->Email_Address}}</p>

								@if($cust->Customer_Type == 'C')
									<p><b>Type: </b>Single Customer</p>
								@elseif($cust->Customer_Type == 'H')
									<p><b>Type: </b>Hotel</p>
									<p><b>Hotel Name: </b>{{$cust->Hotel_Name}}</p>
								@elseif($cust->Customer_Type == 'S')
									<p><b>Type: </b>S</p>
									<p><b>Shop Name: </b>{{$cust->Shop_Name}}</p>
								@endif
									<p><b>Address: </b>{{$cust->Address_Line}}, {{$cust->Baranggay}}, {{$city}}, {{$prov}}</p>



              </div>
              <div class = "Col-md-6 " style = "color:darkviolet;">
                <h5><b>Total Amount of Debt:</b> Php {{number_format($debt,2)}}</h>
              </div>
            </div>
            <div class="col-md-offset-8">
              <a id = "SaveBtn" type="button" data-target="#FinalModal" class="pull-right btn btn-round twitch btn-md"  data-toggle="modal" data-placement="bottom" title="This Button save all the progress that you've made in this session and add all the flowers in the inventory" data-container="body" disabled>
                Process Request
              </a>


              <!-- Modal Core -->
              <div class="modal fade" id="FinalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="myModalLabel" style = "color:darkviolet;"><b>Summary of request</b></h4>
                    </div>
                    <div class="modal-body">
                      <div id = "summaryDiv" hidden>
                        <table id="finalSummary_Tbl" class="table table-bordered table-striped">
                          <thead>
                              <th class="text-center"> ID </th>
                              <th class="text-center"> Name </th>
                              <th class="text-center"> Expected</th>
                              <th class="text-center"> Recieved</th>
                              <th class="text-center"> Good Qty</th>
                              <th class="text-center"> Spoiled Qty</th>
                              <th class="text-center"> Cost</th>
                          </thead>
                          <tbody>
                          <!--foreach here-->

                                <!--end of foreach-->
                            </tbody>
                          </table>
                          <button id = "hidetbl_BTN" type="button" class="pull-left btn btn-round twitch btn-md"  data-toggle="tooltip" data-placement="bottom" title="This Button will hide the summary of the requests in for the inventory" data-container="body">
                            Hide Summary
                          </button>
                      </div>
                        <div id = "showBtn_Div" class = "col-md-6">
                          <button id = "showtbl_BTN" type="button" class="pull-right btn btn-round twitch btn-md"  data-toggle="tooltip" data-placement="bottom" title="This Button will show the summary of the requests in for the inventory" data-container="body">
                            Show Summary
                          </button>
                        </div>

                        <div class = "row col-md-12">
                          <div class="form-group col-md-6">
                            <label class="control-label" for = "DateRecieved_Field">Date recieved: </label>
                            <input id = "DateRecieved_Field" name = "DateRecieved_Field" type="date" class="form-control"
                            min = ""
                            value = "" required/>
                          </div>
                          <div class="form-group col-md-6">
                            <label class="control-label" for = "TimeRecieved_Field">Time recieved: </label>
                            <input id = "TimeRecieved_Field" name = "TimeRecieved_Field" type="time" class="form-control" required/>
                          </div>
                        </div>
                    </div>
                    <div class = "row"></div>
                    <div class="modal-footer">
                      <button style = "color:darkviolet;" type="button" class="btn btn-simple btn-primary" data-dismiss="modal">  Close
                      </button>
                      <button type="submit" class="btn btn-simple btn-success">  Save Flowers to Inventory</button>
                    </div>

                  </div>
                </div>
              </div>

              <a href = "{{route('SalesOrder.UnderCustomer',['id'=>$cust->Cust_ID])}}" type="button" href = "" class="pull-right btn btn-round twitch btn-md"  data-toggle="tooltip" data-placement="bottom" title="This Button redirect you to the list of flower requests from the supplier and will remove your progress" data-container="body">
                Return to Customer Account
              </a>
            </div>
						<br>
          <div class="row" >
            <div class="col-xs-5">
              <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                  <h4><b>Flowers To be Managed: </b></h4>
                  <table id="flowersTable" class="table table-bordered table-striped">
                    <thead>
                        <th class="text-center"> Order ID </th>
                        <th class="text-center"> Status </th>
                        <th class="text-center"> Amount </th>
                        <th class="text-center"> Balance</th>
                        <th class="text-center"> Action </th>
                    </thead>
                    <tbody>
                    <!--foreach here-->

                    </tbody>

                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
                </div>

                <div class="col-xs-7">
                  <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                      <h4><b>Current Progress: </b></h4>
                      <table id="flowersToSaveTable" class="table table-bordered table-striped">
                        <thead>
                            <th class="text-center"> ID </th>
                            <th class="text-center"> Flower Name </th>
                            <th class="text-center"> Expected Quantity</th>
                            <th class="text-center"> Recieved Quantity</th>
                            <th class="text-center"> Good Quantity</th>
                            <th class="text-center"> Spoiled Quantity</th>
                            <th class="text-center"> Cost</th>
                            <th class="text-center"> Action </th>
                        </thead>
                        <tbody>
                        <!--foreach here-->
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
        </div>
  </div>
  </section>

@endsection


@section('scripts')
  <script type="text/javascript">
    $(function () {
        $("#finalSummary_Tbl").DataTable();
        $("#flowersTable").DataTable();

        $("#flowersToSaveTable").DataTable();

        $('#pendingtable').DataTable({
          "paging": true,
          "info": true,
          "autoWidth": false
        });
      });
  </script>
    <script>
      $(document).ready(function(){

        $('#SaveBtn').click(function(){
          $('#summaryDiv').hide("fold");
          $('#showBtn_Div').show("fold");
        });
        $('#showtbl_BTN').click(function(){
          $('#showBtn_Div').hide("fold");
          $('#summaryDiv').show("fold");
        });

        $('#hidetbl_BTN').click(function(){
          $('#summaryDiv').hide("fold");
          $('#showBtn_Div').show("fold");
        });


        var count_toManage = $('#countToReach').val();
        var count_Done = $('#countDone').val();
        if(count_toManage == count_Done){
          $("#SaveBtn").attr("disabled",false);
        }else{
          $("#SaveBtn").attr("disabled",true);
        }

        if($('#ManageFlowerSessionfield').val()=='Successful'){
          //Show popup
          swal("Success!","The flower was succesfully managed!","success");
         }

         if($('#EditingFlowerSessionfield').val()=='Successful'){
           //Show popup
           swal("Success!","The flower was succesfully updated!","success");
          }



      });
    </script>
@endsection\
