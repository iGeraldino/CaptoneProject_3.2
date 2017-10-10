
@extends('main')

@section('content')

  <div style="margin-top: 50px;">

  <?php
   $sessionLoginValue = Session::get('loginSession');
   Session::remove('loginSession');//determines the addition of new flower

  $sessionSpoiledValue = Session::get('SpoiledRecord');
  Session::remove('SpoiledRecord');//determines the addition of new flower

  $sessionConfirmValue = Session::get('ConfirmOrderSession');
  Session::remove('ConfirmOrderSession');

  $sessionConfirmCashValue = Session::get('ConfirmOrderSessionCash');
  Session::remove('ConfirmOrderSessionCash');

     use Carbon\Carbon;
     $current = Carbon::now('Asia/Manila');
  ?>

  <div hidden>
    <input id = "ConfirmValuefield" value = "{{$sessionConfirmValue}}">
    <input id = "CashConfirmationSessionfield" value = "{{$sessionConfirmCashValue}}">
    <input id = "LoggedInfield" value = "{{$sessionLoginValue}}">
    <input id = "SpoiledSessionfield" value = "{{$sessionSpoiledValue}}">

  </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box Subu">
            <div class="inner">
              <h3>150</h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="/Sales_Qoutation" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box Lush">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box Sulfur">
            <div class="inner">
              <h3>44</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="/customers" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box Shalala">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
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
          <div class="chart" id="revenue-chart" style="height: 300px;"></div>
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
        <div class="box-body">
          <table id="example2" class="table table-bordered table-striped">
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
        <div class="box-header Subu">
          <h5 class="text-center" style="color: white;"><b>UNPAID ORDERS</b></h5>
        </div>
        <div class="box-body">
          <table id="example2" class="table table-bordered table-striped">
            <thead>
                <th class="text-center"> ITEM ID</th>
                <th class="text-center"> NAME </th>
                <th class="text-center"> QUANTITY</th>
            </thead>
            <tbody>
              <td>1</td>
              <td class="text-center"> Christine Joy Aradia</td>
              <td></td>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    <!-- /.col -->
    </div>
  </div>
  <div class = "col-md-6">
    <div>
      <div class="box">
        <div class="box-header Subu">
          <h5 class="text-center" style="color: white;"><b>NEW ORDERS</b></h5>
        </div>
        <div class="box-body">
          <table id="example2" class="table table-bordered table-striped">
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
          <div class="box-header Shalala">
            <h5 class="text-center" style="color: white;"><b>FLOWERS EXPECTED TO SPOIL</b></h5>
          </div>
          <div class="box-body">
            <table id="example2" class="table table-bordered table-striped">
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
                  <td class="text-center"> <a href = "{{route('manageBatch.Spoiled',['ID'=>$FLowers->inventory_ID])}}" type="buttonedit" class="btn btn-just-icon Subu" data-toggle="tooltip" title="MANAGE" ><i class="material-icons">more_horiz</i></a></td>
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
          <div class="box-body">
            <table id="Arrivingtable" class="table table-bordered table-striped">
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
                     <a type = "button" href="{{ route('InventoryArriving_Flowers.show',$arriving->Sched_Id) }}" class = "btn btn-just-icon Subu" rel="tooltip" title="Manage"><i class="material-icons">search</i>
                     </a>
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

  </div>
</div>





@endsection
@section('scripts')

<script>



 if($("#ConfirmValuefield").val() == 'Successful'){
   swal("Order was Fully paid!","You have successfully confirmed a newly made order, please make it sure that it will be picked up or delivered to the customers on time, you can monitor these orders on the list of confirmed orders!","success");
 }else if($("#ConfirmValuefield").val() == 'Successful2'){
   swal("Order Partially Paid!","You have successfully confirmed a newly made order, please make it sure that it will be picked up or delivered to the customers on time, you can monitor these orders on the list of confirmed orders!","success");
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
