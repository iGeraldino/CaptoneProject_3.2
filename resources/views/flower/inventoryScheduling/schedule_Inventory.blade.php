@extends('main')


@section('content')

<?php
  $sessionOrderrequetValue = Session::get('requestOrder_Session'); 
  Session::remove('requestOrder_Session');//determines the deletion of Acessory

  $sessionSaveOrderRequestValue = Session::get('Save_requestOrder_Session'); 
  Session::remove('Save_requestOrder_Session');//determines the deletion of Acessory

  
?>

 <div hidden>
    <input id = "requestSessionfield" value = "{{$sessionOrderrequetValue}}">
    <input id = "requestSessionDone" value = "{{$sessionSaveOrderRequestValue}}">
  </div>
<section class="content-header">

    
  <!--  <a href=" {{ route ('floweradd.create') }} " class="btn btn-primary btn-lg"> Schedule an Order </a>

-->
    <!-- Sart Modal -->
    <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="material-icons">clear</i>
            </button>
            <h4 class="modal-title">Modal title</h4>
          </div>
          <div class="modal-body">
  {!! Form::open(array('route' => 'InventoryScheduling.store', 'data-parsley-validate'=>'', 'files' => 'true', 'method'=>'POST')) !!}
            <!-- Modal Content here-->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group label-static">
                  <label class="control-label">What date Dou you want it to arrive?</label>
                  <input type="date" id = "datetoArriveField" name = "datetoArriveField" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group label-static">
                  <label class="control-label">What date Dou you want it to arrive?</label>
                  <select  id = 'supplierField' name = 'supplierField' class="btn btn-primary btn-md" >
                    <option value = '-1'>Please Choose One Supplier</option>
                  @foreach($supp as $supp)
                    <option value="{{$supp->supplier_ID}}">{{$supp->supplier_ID}} - ({{$supp->supplier_FName}} {{$supp->supplier_MName}},{{$supp->supplier_LName}})</option>
                  @endforeach
                   </select>
                </div>
              </div>
            </div>
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-simple btn-success">Proceed to Choosing Flowers</button>
          </div>
 {!! Form::close() !!}
        </div>
      </div>
    </div>
    <!--  End Modal -->

      <div class="panel" style="margin-top: 2%">
        <div class="panel-body">
          <div class="col-md-6">
            <h3>MAKE SCHEDULE OF ARRIVAL OF FLOWERS IN YOUR INVENTORY</h3>
          </div>
          <div class="col-md-offset-9">
            <button type="button" class="btn btn-round btn-md twitch" data-toggle="modal" data-target="#AddModal">
              Schedule an Order <i class="material-icons">add_circle</i>
            </button>
          </div>

          <!-- Tabs with icons on Card -->
          <div class="card card-nav-tabs">
          <div class="header Sharp">
            <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
            <div class="nav-tabs-navigation">
              <div class="nav-tabs-wrapper">
                <ul class="nav nav-tabs" data-tabs="tabs">
                  <li class="active">
                    <a href="#pending" data-toggle="tab">
                      <i class="material-icons">face</i>
                      Pending
                    </a>
                  </li>
                  <li>
                    <a href="#done" data-toggle="tab">
                      <i class="material-icons">chat</i>
                      Done
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="content-header">
            <div class="tab-content text-center">
              <div class="tab-pane active" id="pending">                 
                <div class="box">
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="pendingtable" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Schedule ID </th>
                        <th>Date to Recieve </th>
                        <th>Date Requested</th>
                        <th>Supp_ID</th>
                        <th>Supplier_Name </th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                      </thead>
                    <tbody>
                     <!--foreach here -->    
                    @foreach($schedInv as $sched)   
                        <tr>
                          <th> SCHED-{{$sched->Sched_Id}} </th>
                          <th>{{$sched->Date}}</th>
                          <th>{{$sched->date_ordered}}</th>
                          <th>SUPP-{{$sched->Supplier_ID}}</th>
                          <th>{{$sched->FName}} {{$sched->MName}},{{$sched->LName}} </th>
                          <th>{{$sched->Status}}</th>
                          <td align="center"> 
                             <a type = "button" href="{{ route('InventoryScheduling.show',$sched->Sched_Id) }}" class = "btn btn-just-icon Subu" rel="tooltip" title="MORE"> <i class="material-icons">more_horiz</i>
                             
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
              </div>
                  <!-- end of tab pain -->
              <div class="tab-pane" id="done">
                <div class="box">
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="donetable" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Schedule ID </th>
                        <th>Date to Recieve </th>
                        <th>Date Requested</th>
                        <th>Supp_ID</th>
                        <th>Supplier_Name </th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                      </thead>
                    <tbody>
                     <!--foreach here -->    
                    @foreach($doneschedInv as $donesched)   
                        <tr>
                          <th> SCHED-{{$donesched->Sched_Id}} </th>
                          <th>{{$donesched->Date}}</th>
                          <th>{{$donesched->date_ordered}}</th>
                          <th>SUPP-{{$donesched->Supplier_ID}}</th>
                          <th>{{$donesched->FName}} {{$donesched->MName}},{{$donesched->LName}} </th>
                          <th>{{$donesched->Status}}</th>
                          <td align="center"> 
                             <a type = "button" href="{{ route('InventoryScheduling.show',$donesched->Sched_Id) }}" class = "btn btn-just-icon Subu" rel="tooltip" title="VIEW"><i class="material-icons">search</i>
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
              </div>
            </div>
          </div>
          </div>

        </div>
      </div>
      
  </section>
    <!-- End Section Tabs -->
@endsection

@section('scripts')

  <script type="text/javascript">
          $(function () {
        $("#example1").DataTable();
        $('#pendingtable').DataTable({
          "paging": true,
          "info": true,
          "autoWidth": false
        });
        $('#donetable').DataTable({
          "paging": true,
          "info": true,
          "autoWidth": false
        });
        $('#cancelledtable').DataTable({
          "paging": true,
          "info": true,
          "autoWidth": false
        });
      });
  </script>

  <script>
 $('document').ready(function(){


  if($('#requestSessionfield').val()=='failure'){
    //Show popup
    swal("Warning!","The session might have been cleared or have already ended, Please try creating a new request","warning");
   }

  if($('#requestSessionDone').val()=='Successful'){
    //Show popup
    swal("Success!","The request was succesfully made and added to the list of scheduled request of flowers from suppliers","success");
   }




    /*$.ajax({
      type:'get',
      url: "{{ url("/InventoryScheduling") }}",
      dataType: 'json',
      success: function(response){
        option = "";

        for(ctr = 0; ctr < response.data.length; ctr++)
        {
          option += `<option value="`+ response.data[ctr].supplier_ID +`">`+ response.data[ctr].supplier_ID +`</option>`; 
          console.log(option);
        }

        $('#supplierField').append(option);
      }
    });//END OF AJAX*/
  });
  </script>

@endsection