@extends('cashier_design')

@section('content')
   <?php
    use Carbon\Carbon;

    $current = Carbon::now('Asia/Manila');
   ?>
  <div style="margin-top: 50px;">

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box Shalala">
            <div class="inner">
              @foreach($spoiledFlowers as $spoiledFlowers)
              <h3>{{number_format($spoiledFlowers->spoiled,2)}} %</h3>
              @endforeach
              <p>Spoiled Flowers Percentage</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>

          </div>
        </div>
        <!-- ./col -->
      </div>

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box Lush">
            <div class="inner">
              @foreach($soldFlowers as $soldFlowers)
              <h3>{{number_format($soldFlowers->sold,2)}}<sup style="font-size: 20px">%</sup></h3>
              @endforeach
              <p>Flower Sold Percentage</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>

          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box Sulfur">
            <div class="inner">
              @foreach($cust_Account as $Account)
              <h3>{{$Account->count}}</h3>
              @endforeach

              <p>Customers with Account</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="/customers" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box Subu">
          <div class="inner">
            @foreach($orderscount as $count)
            <h3>{{$count->count}}</h3>
            @endforeach

            <p>New Orders</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="/Sales_Qoutation" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

<div class = "">
  <div class = "col-md-6">
    <div>
      <!-- AREA CHART -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Area Chart</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool buttonedit" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool buttonedit" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body chart-responsive">
          <!--<div class="chart" id="revenue-chart" style="height: 300px;"></div>-->
          <div id="myfirstchart" style="height: 250px;"></div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>

    <div>
      <div class="box">
        <div class="box-header Inbox">
          <h5 class="text-center" style="color: white;"><b>CRITICAL INVENTORY</b></h5>
        </div>
        <div class="box-body" style="overflow-x: auto;">
          <table id="criticalTBL" class="table table-bordered table-striped">
            <thead>
                <th class="text-center"> FLOWER ID</th>
                <th class="text-center"> FLOWER NAME </th>
                <th class="text-center"> QUANTITY LEFT</th>
            </thead>
            <tbody>
              @foreach($CriticalFLowers as $FLWR)
              <tr>
                <td class="text-center">FLWR-{{$FLWR->FLWR_ID}}</td>
                <td class="text-center"> {{$FLWR->Name}}</td>
                <td class="text-center" style = "color:red;"><b>{{$FLWR->QTY}} stems</b></td>
              </tr>
             @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    <!-- /.col -->
    </div>

    <div>
      <div class="box">
        <div class="box-header Shalala">
          <h5 class="text-center" style="color: white;"><b>FLOWERS EXPECTED TO SPOIL</b></h5>
        </div>
        <div class="box-body" style="overflow-x: auto;">
          <table id="spoiled_TBL" class="table table-bordered table-striped">
            <thead>
                <th class="text-center"> BATCH ID</th>
                <th class="text-center"> FLOWER ID </th>
                <th class="text-center"> NAME </th>
                <th class="text-center"> QUANTITY TO SPOIL</th>
                <th class="text-center"> DATE OF SPOILAGE</th>
                <th class="text-center"> ACTION</th>
            </thead>
            <tbody>
              @foreach($SpoiledFLowers as $FLowers)
              <tr>
                <td class="text-center">BATCH_{{$FLowers->Sched_ID}}</td>
                <td class="text-center">FLWR_{{$FLowers->Flower_ID}}</td>
                <td class="text-center">{{$FLowers->flwrName}}</td>
                <td class="text-right" style = "color:red"><b>{{$FLowers->QTY_Remaining}} stems</b> </td>
                <td class="text-right">{{date_format(date_create($FLowers->Date_to_Spoil),'M d, Y')}}</td>
                <td class="text-center"> <button  type="button" class="btn btn-just-icon Subu" rel="tooltip" title="VIEW" data-toggle="modal" data-target="#flowerModal{{$FLowers->Flower_ID}}" ><i class="material-icons">more_horiz</i></button>

                  <!-- Modal Core -->
                  <div class="modal fade" id="flowerModal{{$FLowers->Flower_ID}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">
                          <div class="col-md-6">
                            <h5 style="text-transform: uppercase;"><b>FlOWER NAME:{{$FLowers->flwrName}}</b></h5>
                          </div>
                          <div class="col-md-6">
                            <h5 class="">{{$FLowers->Flower_ID}}</h5>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-info btn-simple">Save</button>
                        </div>
                      </div>
                    </div>
                  </div>



                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
  <!-- /.col -->
    </div>


    <div>
      <div class="box">
        <div class="box-header Lush">
          <h5 class="text-center" style="color: white;"><b>ARRIVING FLOWERS</b></h5>
        </div>
        <div class="box-body" style="overflow-x: auto;">
          <table id="Arriving_tbl" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Sched ID </th>
              <th>Date Requested</th>
              <th>Date to Recieve </th>
              <th>Supplier </th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
            </thead>
          <tbody>
            <?php
              $current2 = date('M d, Y',strtotime($current));
            ?>
           <!--foreach here -->
           @foreach($arriving as $arriving)
              <tr>
                <td> SCHED-{{$arriving->Sched_Id}} </td>
                <td>{{date('M d, Y (h:i a)',strtotime($arriving->date_ordered))}}</td>
                <td>{{date('M d, Y',strtotime($arriving->Date))}}</td>
                <td>(SUPLR-{{$arriving->Supplier_ID}}){{$arriving->FName}} {{$arriving->MName}},{{$arriving->LName}} </td>
                @if($current2 != date('M d, Y',strtotime($arriving->Date)))
                 <td><span class = "btn btn-sm btn-danger">Late</span></td>
                @elseif($current2 == date('M d, Y',strtotime($arriving->Date)))
                 <td><span class = "btn btn-sm btn-primary">To be recieved</span></td>
                @endif
                <td align="center">
                   <button type = "button" class = "btn btn-just-icon Subu" rel="tooltip" title="VIEW" data-toggle="modal" data-target="#flowerdetModal{{$FLowers->Flower_ID}}"><i class="material-icons">search</i>
                   </button>
                </td>
              </tr>
            @endforeach
          <!--end foreach here-->
          </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    <!-- /.col -->
    </div>
  </div> <!--COL_MD_6-->


  <div class = "col-md-6">
    <div>
      <div class="box">
        <div class="box-header Subu">
          <h5 class="text-center" style="color: white;"><b>NEW ORDERS</b></h5>
        </div>
        <div class="box-body" style="overflow-x: auto;">
          <table id="NewOrder_TBL" class="table table-bordered table-striped">
            <thead>
                <th class="text-center"> ORDER ID</th>
                <th class="text-center"> CUSTOMER ID </th>
                <th class="text-center"> DATE CREATED</th>
                <th class="text-center"> STATUS</th>
                <th class="text-center"> ACTION</th>
            </thead>
            <tbody>
              @foreach($Porders as $Olist)
              <tr>
                  <td class="text-center"> ORDR_{{$Olist->sales_order_ID}}</td>
                  <td class="text-center"> {{$Olist->Customer_Fname}} {{$Olist->Customer_MName}}., {{$Olist->Customer_LName}} </td>
                  <td class="text-center"> <b>{{date_format(date_create($Olist->created_at),"M d, Y")}}</b> @ <b>{{date_format(date_create($Olist->created_at),"h:i a")}}</b> </td>
                  <td class="text-center" style="text-transform: uppercase; color:green;"><span class = "btn btn-sm btn-warning">  {{$Olist->Status}} </span></td>

                  <td class="text-center">
                    <a href = "{{route('SalesOrderManage.Order',['id'=>$Olist->sales_order_ID])}}" type="buttonedit" class="btn btn-just-icon Inbox" data-toggle="tooltip" title="MANAGE THIS ORDER" ><i class="material-icons">more_horiz</i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    <!-- /.col -->
      </div>

      <div>
        <div class="box">
          <div class="box-header Subu">
            <h5 class="text-center" style="color: white;"><b>ORDERS TO BE ACQUIRED With in 24 hrs</b></h5>
          </div>
          <div class="box-body" style="overflow-x: auto;">
            <table id="release24hr_TBL" class="table table-bordered table-striped" >
              <thead>
                  <th class="text-center"> Order ID</th>
                  <th class="text-center"> Customer Name </th>
                  <th class="text-center"> Shipping Method</th>
                  <th class="text-center"> Status</th>
                  <th class="text-center"> Date to Acquire</th>
                  <th class="text-center"> Actions</th>
              </thead>
              <tbody>
              @foreach($tobeAcquired as $T_Aorders)
                <tr>
                  <td>ORDR-{{$T_Aorders->Order_ID}}</td>
                  @if($T_Aorders->cust_ID!=null)
                    <td>(CUST-{{$T_Aorders->cust_ID}}) {{$T_Aorders->FName}} {{$T_Aorders->MName}}, {{$T_Aorders->LName}}</td>
                  @else
                    <td>{{$T_Aorders->FName}} {{$T_Aorders->MName}}, {{$T_Aorders->LName}}</td>
                  @endif
                  <td>{{$T_Aorders->Ship_Method}}</td>
                  @if($T_Aorders->Stat == 'P_PARTIAL')
                  <td class="text-center"><span class = "btn btn-sm btn-warning">Partially Paid</span></td>
                  @elseif($T_Aorders->Stat == 'P_FULL')
                  <td class="text-center"><span class = "btn btn-sm btn-info">Fully Paid</span></td>
                  @elseif($T_Aorders->Stat == "BALANCED")
                  <td class="text-center"><span class = "btn btn-sm btn-danger">No Payment Yet</span></td>
                  @endif
                  <td class="text-center">{{date("M d, Y @ h:i a",strtotime($T_Aorders->Date_to_Acquire))}}</td>
                  <td class = "text-center">
                    <a href = "{{route('order.Manage_Releasing_Order',['id'=>$T_Aorders->Order_ID,'type'=>'dash'])}}" type="buttonView" class="btn btn-just-icon Subu" data-toggle="tooltip" title="VIEW DETAILS" ><i class="material-icons">more_horiz</i></a>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      <!-- /.col -->
      </div>

      <div>
        <div class="box">
          <div class="box-header Subu">
            <h5 class="text-center" style="color: white;"><b>CONFIRMED ORDERS</b></h5>
          </div>
          <div class="box-body">
            <div class = "row">
              <div class = "col-md-6">
                <p><b>Orders with Balance</b></p>
                <table id="bal_TBL" class="table table-bordered table-striped">
                  <thead>
                      <th class="text-center"> Order ID</th>
                      <th class="text-center"> Status</th>
                      <th class="text-center"> Actions</th>
                  </thead>
                  <tbody>
                  @foreach($b_Orders as $B_Orders)
                    <tr>
                      <td>ORDR-{{$B_Orders->sales_order_ID}}</td>
                      @if($B_Orders->Status == 'BALANCED')
                      <td class="text-center"><span   class = "btn btn-sm btn-danger">No Payment Yet</span></td>
                      @elseif($B_Orders->Status == 'P_PARTIAL')
                      <td class="text-center"><span   class = "btn btn-sm btn-warning">Partially Paid</span></td>
                      @elseif($B_Orders->Status == 'A_UNPAID')
                      <td class="text-center"><span   class = "btn btn-sm btn-warning">Acquired Unpaid</span></td>
                      @elseif($B_Orders->Status == 'A_P_PARTIAL')
                      <td class="text-center"><span   class = "btn btn-sm btn-warning">Acquired Partially paid</span></td>
                      @endif
                      <td class = "text-center">
                         <a href = "{{route('order.Manage_Confirmed_Order',['id'=>$B_Orders->sales_order_ID,'type'=>'dash'])}}" type="buttonRelease" class="btn btn-just-icon Inbox" data-toggle="tooltip" title="MANAGE" ><i class="material-icons">more_horiz</i></a>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <div class = "col-md-6">
                <p><b>Orders Fully Paid</b></p>
                <table id="paid_TBL" class="table table-bordered table-striped">
                  <thead>
                      <th class="text-center"> Order ID</th>
                      <th class="text-center"> Status</th>
                      <th class="text-center"> Actions</th>
                  </thead>
                  <tbody>
                  @foreach($p_Orders as $P_orders)
                    <tr>
                      <td>ORDR-{{$P_orders->sales_order_ID}}</td>
                      <td class="text-center"><span   class = "btn btn-sm btn-info">Fully Paid</span></td>
                      <td class = "text-center">
                         <a href = "{{route('order.Manage_Confirmed_Order',['id'=>$P_orders->sales_order_ID,'type'=>'dash'])}}" type="buttonRelease" class="btn btn-just-icon Inbox" data-toggle="tooltip" title="MANAGE" ><i class="material-icons">more_horiz</i></a>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      <!-- /.col -->
      </div>

      <div>
        <div class="box">
          <div class="box-header Subu">
            <h5 class="text-center" style="color: white;"><b>HOTELS & SHOPS WITH DEBTS</b></h5>
          </div>
          <div class="box-body" style="overflow-x: auto;">
            <table id="Debtors_TBL" class="table table-bordered table-striped">
              <thead>
                  <th class="text-center"> Customer</th>
                  <th class="text-center"> Type</th>
                  <th class="text-center"> HOTEL/SHOP </th>
                  <th class="text-center"> Amount of Balance</th>
                  <th class="text-center"> Actions</th>
              </thead>
              <tbody>
              @foreach($debtors as $debtors_row)
                <tr>
                  @if($debtors_row->cust_ID!=null)
                    <td>(CUST-{{$debtors_row->cust_ID}}) {{$debtors_row->FName}} {{$debtors_row->MName}}, {{$debtors_row->LName}}</td>
                  @else
                    <td>{{$debtors_row->FName}} {{$debtors_row->MName}}, {{$debtors_row->LName}}</td>
                  @endif
                  @if($debtors_row->CType == 'H')
                  <td>Hotel</td>
                  <td>{{$debtors_row->H_name}}</td>
                  @elseif($debtors_row->CType == 'S')
                  <td>Shop</td>
                  <td>{{$debtors_row->S_name}}</td>
                  @endif
                  <td class="text-center" style = "color:red;"><b>Php {{number_format($debtors_row->Total_Debt,2)}}</b></td>
                  <td class = "text-center">
                     <a href = "{{route('SalesOrder.UnderCustomer',['id'=>$debtors_row->cust_ID])}}" type="buttonRelease" class="btn btn-just-icon Inbox" data-toggle="tooltip" title="MANAGE" ><i class="material-icons">more_horiz</i></a>
                  </td>
                </tr>
              @endforeach
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

@endsection
@section('scripts')

<script>
  Morris.Donut({
  element: 'myfirstchart',
  data:[

    @foreach($flowers as $flow)

    { label: '{{ $flow->flower_name }}', value: {{ $flow -> Quantity}} },
    @endforeach

  ],
  colors: [
    '#0BA462',
    '#39B580',
    '#67C69D',
    '#95D7BB'
  ],
  xkey:'Quantity',
  ykeys:['value'],
  labels:['value']
})


$(function () {

  $("#paid_TBL").DataTable({
    "lengthMenu": [3, 5, 10, 15, 20],
    "pageLength": 3
  });


  $("#bal_TBL").DataTable({
    "lengthMenu": [3, 5, 10, 15, 20],
    "pageLength": 3
  });

  $("#criticalTBL").DataTable({
    "lengthMenu": [3, 5, 10, 15, 20],
    "pageLength": 3
  });
  $("#spoiled_TBL").DataTable({
    "lengthMenu": [3, 5, 10, 15, 20],
    "pageLength": 3
  });
  $("#Arriving_tbl").DataTable({
    "lengthMenu": [3, 5, 10, 15, 20],
    "pageLength": 3
  });
  $("#NewOrder_TBL").DataTable({
    "lengthMenu": [3, 5, 10, 15, 20],
    "pageLength": 3
  });
  $("#release24hr_TBL").DataTable({
    "lengthMenu": [3, 5, 10, 15, 20],
    "pageLength": 3
  });
  $("#Debtors_TBL").DataTable({
    "lengthMenu": [3, 5, 10, 15, 20],
    "pageLength": 3
  });



});
</script>

<script>
 if($("#ConfirmValuefield").val() == 'Successful'){
   swal("Order was Fully paid!","You have successfully confirmed a newly made order, please make it sure that it will be picked up or delivered to the customers on time, you can monitor these orders on the list of confirmed orders!","success");
 }else if($("#ConfirmValuefield").val() == 'Successful2'){
   swal("Order Partially Paid!","You have successfully confirmed a newly made order, please make it sure that it will be picked up or delivered to the customers on time, you can monitor these orders on the list of confirmed orders!","success");
 }else if($("#ConfirmValuefield").val() == 'Paylater'){
   swal("Note!","You have successfully confirmed a newly made order, but please be noted that the order has not been paid yet even with 20% downpayment. The order was added to the debt of the customer, you can send them a statement of account through email or letters if you wish to remind them about the collection of their payments","info");
 }

if($("#CashConfirmationSessionfield").val() == 'Successful'){
  swal("Order was Fully paid!","You have successfully confirmed a newly made order, please make it sure that it will be picked up or delivered to the customers on time, you can monitor these orders on the list of confirmed orders!","success");
}else if($("#CashConfirmationSessionfield").val() == 'Successful2'){
  swal("Order Partially Paid!","You have successfully confirmed a newly made order, please make it sure that it will be picked up or delivered to the customers on time, you can monitor these orders on the list of confirmed orders!","success");
}



  if($("#SpoiledSessionfield").val() == 'Successful'){
   swal("Take Note!","You have successfully recorded the spoiled flower under a specific batch, what you have done can no longer be changed!","success");
  }
  else if($("#SpoiledSessionfield").val() == 'Successful2'){
   swal("Take Note!","You have successfully recorded that there are partially spoiled flower under a specific batch, what you have done can no longer be changed!","success");
  }

  if($("#LoggedInfield").val()=='good'){
    //Show popup
    //swal("Welcome to the admin side!","You have successfully logged in!","success");
   }

    if($("#LoggedInfield").val()=='fail'){
    //Show popup
    //swal("Sorry!","the session might have already been ","warning");
   }

   // AREA CHART
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      data: [
        {y: '2011 Q1', item1: 2666, item2: 2666},
        {y: '2011 Q2', item1: 2778, item2: 2294},
        {y: '2011 Q3', item1: 4912, item2: 1969},
        {y: '2011 Q4', item1: 3767, item2: 3597},
        {y: '2012 Q1', item1: 6810, item2: 1914},
        {y: '2012 Q2', item1: 5670, item2: 4293},
        {y: '2012 Q3', item1: 4820, item2: 3795},
        {y: '2012 Q4', item1: 15073, item2: 5967},
        {y: '2013 Q1', item1: 10687, item2: 4460},
        {y: '2013 Q2', item1: 8432, item2: 5713}
      ],
      xkey: 'y',
      ykeys: ['item1', 'item2'],
      labels: ['Item 1', 'Item 2'],
      lineColors: ['#a0d0e0', '#3c8dbc'],
      hideHover: 'auto'
    });

</script>
@endsection
