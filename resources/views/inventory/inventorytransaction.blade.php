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
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="content">
                  <div class="tab-content text-center">
                    <div class="tab-pane active" id="date">
                      <div class="col-md-6" style="margin-top: -6%;">
                        <!-- Date range -->
                  {!! Form::open(array('route' => 'flowerReport_Transaction.store', 'data-parsley-validate'=>'', 'files' => 'true', 'method'=>'POST')) !!}
                        <input type="text" value="{{$Itype}}" name="itemtype" class="hidden">
                        <div class="form-group">
                          <label class="pull-left"><h4>Date range:</h4></label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="trans_range" name = "trans_range">
                            <button type = "submit" id = "submt_rangeBTN" class = "btn btn-md Lemon">Generate Report</button>
                          </div>
                          <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                          {!! Form::close() !!}
                      </div>
                    </div>
                    <div class="tab-pane" id="batch">
                      <div class="row">
                        <div class="col-md-4">
                        <div id = "">
                          <input id = "BatchID_Field" class = "form-control"  name="Batch_ID" list="Batch_ID" placeholder="Enter Batch ID"/>
                          

                          <!--  -->



                          <button type = "submit" id = "" class = "btn btn-md Lemon">Generate Report</button>
                        </div>
                      </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="flowers">
                      <div class="col-md-6">
                        <div id = "">
                          <input id = "" class = "form-control"  name="" list="" placeholder="Enter Flower"/>
                          <datalist id="customerList_ID">
                          </datalist>
                        </div>
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
            <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-info btn-simple">Save</button>
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
  </script>
  <script>
      $('document').ready(function(){
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
