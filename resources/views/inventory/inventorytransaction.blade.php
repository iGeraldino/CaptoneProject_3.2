 @extends('main')

@section('content')

	<div class="container" style="margin-top: 3%;">

<!-- TABLE-->
    </div>
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
                <h2 class="container">INVENTORY TRANSACTION</h2>
                <label class="container">CHECK EVERYTHING THAT IS HAPPENING INSIDE YOUR INVENTORY</label>
                <div class="col-md-1 col-md-offset-9" style="margin-top: -7%;">
                    <button type="button" class="btn btn-round btn-md Inbox" data-toggle="modal" data-target="#reports"> <i class="material-icons" >print</i>
                      Generate Reports
                    </button>
            </div>
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
                @foreach($transactions as $trans)
                  <tr>
                    <td class="text-center"> TRSCTN-{{ $trans->Trans_ID }} </td>
                    <td class="text-center"> {{ $trans->Name }} </td>
                    <td class="text-center">
                      @if($trans->TypeOfItem == 'Acessories')
                      <img class="img-rounded img-raised img-responsive" style="min-width: 50px; max-height: 50px;" src="{{ asset('accimage/'.$trans->img)}}">
                      @else
                      <img class="img-rounded img-raised img-responsive" style="min-width: 50px; max-height: 50px;" src="{{ asset('flowerimage/'.$trans->img)}}">
                      @endif
                     </td>
                    <td class="text-center">
                    <?php
                      if($trans->TypeOfChange == 'I'){
                        echo 'Inventory';
                      }
                      else if($trans->TypeOfChange == 'A'){
                        echo 'Adjustments';
                      }
                      else if($trans->TypeOfChange == 'O'){
                        echo 'Order';
                      }
                      else if($trans->TypeOfChange == 'S'){
                        echo 'Spoilage';
                      }
                    ?>
                    </td>
                    @if($trans->TypeOfItem == 'Acessories')
                    <td class="text-center"> N/A </td>
                    @else
                    <td class="text-center"> BATCH-{{ $trans->Batch_ID }} </td>
                    @endif

                    <td class="text-center">
                    <?php
                      if ($trans->order_ID == NULL){
                        echo 'N/A';
                      }else{
                        echo 'ORDR'.$trans->order_ID;
                      }
                    ?>  </td>
                    @if($trans->QTY < 0)
                      <td class="text-right" style = "color:red;">
                        <b> {{ $trans->QTY }} pcs. </b>
                      </td>
                    @else
                      <td class="text-right">
                        <b> {{ $trans->QTY }} pcs. </b>
                      </td>
                    @endif
                    <td class="text-center"> Php {{ number_format($trans->Unit_Cost,2) }} </td>
                    <td class="text-center">
                      <?php
                        if($trans->Selling_Price == NULL){
                          echo 'N/A';
                        }
                        else{
                         echo 'Php '.number_format($trans->Selling_Price,2);
                        }
                      ?>
                    </td>
                    @if($trans->T_Amt < 0)
                    <td class="text-center" style = "color:red;"> Php {{ number_format($trans->T_Amt,2) }} </td>
                    @else
                    <td class="text-center"> Php {{ number_format($trans->T_Amt,2) }} </td>
                    @endif
                    <td class="text-center"> {{ date('M d,Y (H:i a)',strtotime($trans->Date)) }} </td>
                  </tr>
              @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        <!-- /.box -->
        </div>
      </div>
      <!-- /.col -->

    <!-- REPORTS MODAL -->
    <!-- Modal Core -->
    <div class="modal fade" id="reports" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">GENERATE REPORTS</h4>
          </div>
          <div class="modal-body">
            <div class="col-md-12">
              <!-- Tabs with icons on Card -->
              <div class="card card-nav-tabs">
                <div class="header Sharp">
                  <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                  <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                      <ul class="nav nav-tabs" data-tabs="tabs">
                        <li class="active">
                          <a href="#date" data-toggle="tab">
                            <i class="material-icons">date_range</i>
                            By Date
                          </a>
                        </li>
                        @if($Itype == 'Flower')
                        <li>
                          <a href="#sales" data-toggle="tab">
                            <i class="material-icons">date_range</i>
                            Generate Sales Report
                          </a>
                        </li>
                        <li>
                          <a href="#batch" data-toggle="tab">
                            <i class="material-icons">assignment</i>
                            By Batch
                          </a>
                        </li>
                        <li>
                          <a href="#flowers" data-toggle="tab">
                            <i class="material-icons">filter_vintage</i>
                            By Flowers
                          </a>
                        </li>
                        @else
                        @endif
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="content">
                  <div class="tab-content text-center">
                    <div class="tab-pane active" id="date">
                      <div class = "row">
                        <div class="col-md-6 col-md-offset-2" style="margin-top: -6%;">
                          <!-- Date range -->
                    {!! Form::open(array('route' => 'flowerReport_Transaction.store', 'data-parsley-validate'=>'', 'files' => 'true', 'method'=>'POST')) !!}
                          <input type="text" value="byDate" name="Report_type" class="hidden">
                          <input type="text" value="{{$Itype}}" name="itemtype" class="hidden">
                          <div class="form-group">
                            <label class="pull-left"><h4>Date range:</h4></label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="trans_range" name = "trans_range">
                              <button type = "submit" id = "submt_rangeSalesBTN" class = "btn btn-md Lemon">Generate Report</button>
                            </div>
                            <!-- /.input group -->
                          </div>
                          <!-- /.form group -->

                            {!! Form::close() !!}
                        </div>
                      </div>
                      <br>
                      <br>
                      <hr>
                      <div class = "row">
                        <div class = "col-md-3"></div>
                        <div class = "col-md-6">
                          @if($Itype == 'Flower')
                          <p><b>*This part of this page will generate a report based on the date that you'll be choosing. The report that will be generated will focus on the flowers that are being taken in and out of the inventory.</b></p>
                          @else
                          <p><b>*This part of this page will generate a report based on the date that you'll be choosing. The report that will be generated will focus on the accessories that are being taken in and out of the inventory.</b></p>
                          @endif
                        </div>
                        <div class = "col-md-3"></div>
                      </div>
                    </div>
                    <div class="tab-pane" id="sales">
                      <div class = "row">
                        <div class="col-md-6 col-md-offset-2" style="margin-top: -6%;">
                          <!-- Date range -->
                    {!! Form::open(array('route' => 'Flwr_Salesreport.store', 'data-parsley-validate'=>'', 'files' => 'true', 'method'=>'POST')) !!}
                          <input type="text" value="byDate" name="Report_type" class="hidden">
                          <input type="text" value="{{$Itype}}" name="itemtype" class="hidden">
                          <div class="form-group">
                            <label class="pull-left"><h4>Date range:</h4></label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="trans_range2" name = "trans_range2">
                              <button type = "submit" id = "submt_rangeSALESBTN" class = "btn btn-md Lemon">Generate Report</button>
                            </div>
                            <!-- /.input group -->
                          </div>
                          <!-- /.form group -->

                            {!! Form::close() !!}
                        </div>
                      </div>
                      <br>
                      <br>
                      <hr>
                      <div class = "row">
                        <div class = "col-md-3"></div>
                        <div class = "col-md-6">
                          <p><b>*This part of this page will generate a sales report based on the date range that you'll be choosing. The report that will be generated will focus on the profit made with the flowers that are being sold to your beloved customers.</b></p>
                        </div>
                        <div class = "col-md-3"></div>
                      </div>
                    </div>
                    <div class="tab-pane" id="batch">
                      <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                        <div id = "">
                        {!! Form::open(array('route' => 'Flwrr_InvTransaction_batch.store', 'data-parsley-validate'=>'', 'files' => 'true', 'method'=>'POST')) !!}
                          <div id = "batch_Chooser">
                            <input type="text" value="byBatch" name="Report_type" class="hidden">
                            <input id = "batchList_Field" class = "form-control"  name="batchList_Field" list="batchList_ID" placeholder="Enter a batch of inventory " required/>
                            <input id = "batchList_Field1" class = "hidden form-control"  name="batchList_Field2"/>
                            <datalist id="batchList_ID">
                              <!--Foreach Loop data Here value = "Name" data-tag = "id"-->
                              @foreach($batch as $batches)
                                <option value="BATCH_{{$batches->Sched_ID}}" data -id = "{{$batches->Sched_ID}}">
                                  Recieved: {{date('M d,Y',strtotime($batches->Date_Obtained))}}
                                </option>
                              @endforeach
                              <!--Loop data Here-->
                            </datalist>
                          </div>
                          <!--  -->
                          <button type = "submit" id = "generateByBatchBTN" class = "btn btn-md Lemon" disabled>Generate Report</button>
                        {!! Form::close() !!}

                        </div>
                      </div>
                      <div><!--marvin palagay ng details dito--></div>
                      </div>
                    </div>
                    <div class="tab-pane" id="flowers">
                      <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                        <div id = "">
                        {!! Form::open(array('route' => 'Flwr_Inv_Transaction_batch.store', 'data-parsley-validate'=>'', 'files' => 'true', 'method'=>'POST')) !!}
                          <div id = "flower_Chooser">
                            <input type="text" value="byFlwr" name="Report_type" class="hidden">
                            <input id = "flowerList_Field" class = "form-control"  name="flowerList_Field" list="flwrList_ID" placeholder="Enter a flower ID " required/>
                            <input id = "flowerList_Field1" class = "hidden form-control"  name="flowerList_Field1"/>
                            <datalist id="flwrList_ID">
                              <!--Foreach Loop data Here value = "Name" data-tag = "id"-->
                              @foreach($flwr as $flwr)
                                <option value="FLWR-{{$flwr->flower_ID}}" data-id = "{{$flwr->flower_name}}">
                                  {{$flwr->flower_name}}
                                </option>
                              @endforeach
                              <!--Loop data Here-->
                            </datalist>
                          </div>
                          <!--  -->
                          <button type = "submit" id = "flwrgenerateByBatchBTN" class = "btn btn-md Lemon" disabled>Generate Report</button>
                        {!! Form::close() !!}

                        </div>
                      </div>
                      <div><!--marvin palagay ng details dito--></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Tabs with icons on Card -->
              <br><br>
            </div>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
@endsection

@section('scripts')
  <script type="text/javascript">
          $(function () {
        //$("#example2").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "info": true,
          "autoWidth": true
        });
      });
      //Date range picker
      $('#trans_range').daterangepicker();
      $('#trans_range2').daterangepicker();
  </script>
  <script>
      $(document).ready(function(){


                  $('#flowerList_Field').change(function(){
                      $('#flowerList_Field1').val($(this).val());
                    var batchID = $("#flowerList_Field").val();
                    var Found = 0;
            				$('#flwrList_ID option').each(function(item){
            					if(batchID == $(this).val()){
            						   Found = 1;   //swal('Note:','','')
                           $('#flwrgenerateByBatchBTN').attr('disabled',false);
                           $('#flwrgenerateByBatchBTN').show('fold');
            					}
            				});
                    if(Found == 0 ){
                      $('#flwrgenerateByBatchBTN').attr('disabled',true);
                      $('#flwrgenerateByBatchBTN').hide('fold');
                        swal('Flower does not Exist!','the batch that you enetered is not existing, please try again later','error');

                    }
                  });


          $('#batchList_Field').change(function(){
              $('#batchList_Field1').val($(this).val());
            var batchID = $("#batchList_Field").val();
            var Found = 0;
    				$('#batchList_ID option').each(function(item){
    					if(batchID == $(this).val()){
    						   Found = 1;   //swal('Note:','','')
                   $('#generateByBatchBTN').attr('disabled',false);
                   $('#generateByBatchBTN').show('fold');
    					}
    				});
            if(Found == 0 ){
              $('#generateByBatchBTN').attr('disabled',true);
              $('#generateByBatchBTN').hide('fold');
                swal('Batch does not Exist!','the batch that you enetered is not existing, please try again later','error');

            }
          });


          if($('#DelFlower_result').val()=='Successful'){
             //Show popup
           swal("Good!","Flower has been successfully removed from the list of order!","info");
          }

          if($('#AddFlower_result').val()=='Successful1'){
             //Show popup
           swal("Good!","Flower has been successfully added to the list of order!","success");
          }

          if($('#AddFlower_result').val()=='Successful2'){
             //Show popup
           swal("Good!","Existing Flower in the list has been successfully updated in terms of quantity!","info");
          }

      });
    </script>
@endsection
