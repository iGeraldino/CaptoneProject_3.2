
@extends('main')

@section('content')
<?php
  $ManagingFlwr_session = Session::get('ManagingFlowerSession');
  Session::remove('ManagingFlowerSession');//determines the deletion of Acessory

  $EdittingFlwr_session = Session::get('editSession');
  Session::remove('editSession');//determines the deletion of Acessory


  //Cart::instance('Flowers_to_Arrive')->destroy();
  $CountofItemsOncart = 0;
  foreach(Cart::instance('Flowers_to_Arrive')->content() as $items){
    $CountofItemsOncart++;
  }

  $CountofFlowerstomanage = 0;
  foreach($SchedFlowers as $Sched_Flwr){
    $CountofFlowerstomanage++;
  }
 ?>
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <div hidden>
        <input id = "countToReach" value = "{{$CountofFlowerstomanage}}"/>
        <input id = "countDone" value = "{{$CountofItemsOncart}}"/>

        <input id = "EditingFlowerSessionfield" value = "{{$EdittingFlwr_session}}">
        <input id = "ManageFlowerSessionfield" value = "{{$ManagingFlwr_session}}">
      </div>
       <div class="col-xs-12" style="margin-top: 2%;">
        <div class="panel">
          <div class="panel-heading Subu">
            <h3 class="panel-title" style="color: white;">LIST OF FLOWERS THAT YOU REQUESTED FROM THE SUPPLIERS</h3>
          </div>
          <div class="panel-body">
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label"><b>SCHEDULE ID:</b></label>
                <span><b>RQST-{{$schedInfo->Sched_Id}}</b></span>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label"><b>SUPPLIER NAME:</b></label>
                <span><b>{{$schedInfo->FName}} {{$schedInfo->MName}}, {{$schedInfo->LName}}</b></span>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label"><b>DATE ORDERED:</b></label>
                <span><b>{{date('M d,Y', strtotime($schedInfo->date_ordered))}}</b></span>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label"><b>DATE TO BE DELIVERED:</b></label>
                <span><b>{{date('M d,Y', strtotime($schedInfo->Date))}}</span></b></span>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label"><b>Status:</b></label>
                <span><b>Arriving Now</span></b></span>
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
                          <div class="box-body" style="overflow-x: auto;">
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
                            @foreach(Cart::instance('Flowers_to_Arrive')->content() as $processed)
                                  <tr>
                                    <td class="text-center"> FLWR-{{$processed->id}}  </td>
                                    <td class="text-center"> {{$processed->name}} </td>
                                    <td class="text-center">  {{$processed->options->expected}} pcs </td>
                                    <td class="text-center">  {{$processed->qty}} pcs </td>
                                    <td class="text-center">  {{$processed->options->goodQty}} pcs </td>
                                    <td class="text-center">  {{$processed->options->spoiledQty}} pcs </td>
                                    <td class="text-center"> Php {{number_format($processed->price,2)}}</td>
                                   </tr>
                              @endforeach
                                  <!--end of foreach-->
                              </tbody>
                            </table>
                          </div>
                          <button id = "hidetbl_BTN" type="button" class="pull-left btn btn-round twitch btn-md"  data-toggle="tooltip" data-placement="bottom" title="This Button will hide the summary of the requests in for the inventory" data-container="body">
                            Hide Summary
                          </button>
                      </div>
                        <div id = "showBtn_Div" class = "col-md-6">
                          <button id = "showtbl_BTN" type="button" class="pull-right btn btn-round twitch btn-md"  data-toggle="tooltip" data-placement="bottom" title="This Button will show the summary of the requests in for the inventory" data-container="body">
                            Show Summary
                          </button>
                        </div>
          {!! Form::model($schedInfo, ['route'=>['InventoryScheduling.update', $schedInfo->Sched_Id],'method'=>'PUT','data-parsley-validate' => ''])!!}
                        <div class = "row col-md-12">
                          <div class="form-group col-md-6">
                            <label class="control-label" for = "DateRecieved_Field">Date recieved: </label>
                            <input id = "DateRecieved_Field" name = "DateRecieved_Field" type="date" class="form-control"
                            min = "{{date('Y-m-d', strtotime($schedInfo->Date))}}"
                            value = "{{date('Y-m-d', strtotime($schedInfo->Date))}}" required/>
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
        {!! Form::close() !!}
                  </div>
                </div>
              </div>


              <a id = "returnBtn" type="button" href = "{{route('Requests.Cancelmanaging')}}" class="pull-right btn btn-round twitch btn-md"  data-toggle="tooltip" data-placement="bottom" title="This Button redirect you to the list of flower requests from the supplier and will remove your progress" data-container="body">
                RETURN TO REQUEST LIST
              </a>
            </div>
          <div class="row" >
            <div class="col-xs-5">
              <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                  <h4><b>Flowers To be Managed: </b></h4>
                  <table id="flowersTable" class="table table-bordered table-striped">
                    <thead>
                        <th class="text-center"> Flower ID </th>
                        <th class="text-center"> Flower Name </th>
                        <th class="text-center"> Flower Image </th>
                        <th class="text-center"> Expected Quantity</th>
                        <th class="text-center"> Action </th>
                    </thead>
                    <tbody>
                    <!--foreach here-->

                  @foreach($SchedFlowers as $FlowersRow)
                    <?php
                    $EXIST = 0;
                      foreach(Cart::instance('Flowers_to_Arrive')->content() as $processed){
                        if($FlowersRow->flower_ID == $processed->id){
                          $EXIST = 1;
                        }
                      }
                      ?>
                      @if($EXIST == 1)
                      @else
                      <tr>
                          <td class="text-center"> FLWR-{{$FlowersRow->flower_ID}}  </td>
                          <td class="text-center"> {{$FlowersRow->flowerName}} </td>
                          <td align="center"> <img class="img-rounded img-raised img-responsive" style="min-width: 50px; max-height: 50px;" src="{{ asset('flowerimage/'.$FlowersRow->Img)}}"></td>
                          <td class="text-center"> {{$FlowersRow->QTY_Expected}} pcs </td>
                          <td align="center">
                              <button class="btn btn-primary" data-toggle="modal" data-target="#ViewDetModal{{$FlowersRow->flower_ID}}">
                                View
                              </button>
                          </td>

                            <!-- Modal Core -->
                            <div class="modal fade" id="ViewDetModal{{$FlowersRow->flower_ID}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel" style = "color:darkviolet;"><b>Details of Requested flower</b></h4>
                                  </div>
                                  <div class="modal-body">
                                    <div class = "row">
                                      <div class = "col-md-6">
                                        <!---->
                                        <img class="img-rounded img-raised img-responsive" style="min-width: 250px; max-height: 250px;" src="{{ asset('flowerimage/'.$FlowersRow->Img)}}">
                                      </div>
                                      <div class = "col-md-6">
                                        <!---->
                                        <h4><b>Flower ID: </b>FLWR-{{$FlowersRow->flower_ID}} </h4>
                                        <h4><b>Flower Name:</b> {{$FlowersRow->flowerName}} </h4>
                                        <h4><b>Expected Quantity:</b> {{$FlowersRow->QTY_Expected}} pcs </h4>
                                        <hr>
                                        <h4><b>Expected Date of Arrival:</b></h4>
                                        <h4 style = "color:darkviolet;"><b>{{date('M d,Y', strtotime($schedInfo->Date))}}<b></h4>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button style = "color:darkviolet;" type="button" class="btn btn-simple btn-primary" data-dismiss="modal">  Close
                                    </button>
                                    <a href = "{{route('Scheduled.SpecificFlower',['Sched_id'=>$schedInfo->Sched_Id,'Flwr_id'=>$FlowersRow->flower_ID])}}" type="button"
                                    class="btn btn-simple btn-success">  Manage Flower
                                    </a>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </tr>
                        @endif
                      @endforeach
                          <!--end of foreach-->


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
                    <div class="box-body" style="overflow-x: auto;">
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
                        @foreach(Cart::instance('Flowers_to_Arrive')->content() as $processed)
                              <tr>
                                <td class="text-center"> FLWR-{{$processed->id}}  </td>
                                <td class="text-center"> {{$processed->name}} </td>
                                <td class="text-center">  {{$processed->options->expected}} pcs </td>
                                <td class="text-center">  {{$processed->qty}} pcs </td>
                                <td class="text-center">  {{$processed->options->goodQty}} pcs </td>
                                <td class="text-center">  {{$processed->options->spoiledQty}} pcs </td>
                                <td class="text-center"> Php {{number_format($processed->price,2)}}</td>
                                <td align="center" >
                                    <a class="btn btn-primary" href ="{{route('Inventory_Flowers_toSession.edit',$processed->id)}}" >
                                      Edit
                                    </a>
                                </td>
                               </tr>
                          @endforeach
                              <!--end of foreach-->


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
