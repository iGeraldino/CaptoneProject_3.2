 @extends('main')

@section('content')

	<div class="container" style="">

<!-- TABLE-->
    </div>
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
                <h2 class="container">INVENTORY TRANSACTION</h2>
                <label class="container">CHECK EVERYTHING THAT IS HAPPENING INSIDE YOUR INVENTORY</label>


              <div class="row">
                <div class="col-md-3 col-md-offset-6">
                    <button type="button" class="btn btn-round btn-md Subu" data-toggle="modal" data-target="#flower"> <i class="material-icons">filter_vintage</i>
                      Show  per Flower
                    </button>
                </div>

                <div class="col-md-1">
                    <button type="button" class="btn btn-round btn-md Inbox" data-toggle="modal" data-target="#date"> <i class="material-icons" >date_range</i>
                      Show per Date
                    </button>
                    <br>
                    <br>
                </div>
              </div>
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

    <!--MODAL FLOWER-->

    <div class="modal fade" id="flower" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
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
          <div class="modal-header">
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
  <script type="text/javascript">
          $(function () {
        $("#example2").DataTable();
        $('#pendingtable').DataTable({
          "paging": true,
          "info": true,
          "autoWidth": false
        });
      });
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
