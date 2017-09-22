
@extends('main')

@section('content')
   <?php Session::start();
     $deleteSessionValue = Session::get('Deleted_FlowerfromSession_Supply');
     Session::remove('Deleted_FlowerfromSession_Supply');//determines the deletion of requested flowers

     $AddSessionValue = Session::get('Add_Flower_ToSession_Supply');
     Session::remove('Add_Flower_ToSession_Supply');//determines the Addition of requested flowers

   ?>
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h2> List of Flowers to Order</h2>

        <div hidden>
            <input id = "AddFlower_result" value = "{{$AddSessionValue}}">
            <input id = "DelFlower_result" value = "{{$deleteSessionValue}}">
        </div>


       <div class="container" style="margin-top: 50px;">
        <div class="panel panel-primary">
          <div class="panel-heading" style="background-color: #C93756">
            <h3 class="panel-title">Scheduled Inventory Delivery</h3>
          </div>
          <div class="panel-body">
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label">Schedule ID: </label>
                <span class="label" style="font-size: 100%; background-color: #F62459">CUST-{{$SuppDet->supplier_ID}}</span>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label">Supplier Name: </label>
                <span class="label" style="font-size: 100%; background-color: #F62459">{{$SuppDet->supplier_FName}} {{$SuppDet->supplier_MName}}, {{$SuppDet->supplier_LName}}</span>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label">Date to be Delivered</label>
                <span class="label" style="font-size: 100%; background-color: #F62459">{{$Schedule_details['0']}}</span>
              </div>
            </div>
          </div>
        </div>
  </div>


    <div class="col-md-8 ">
      <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#newFlower">
        Order Flower
      </button>

      <a href="{{route('InventorySched.Save_requestCreated')}}" class="btn btn-md btn-success btn-tooltip pull-right" data-toggle="tooltip" data-placement="bottom" title="Upon clicking this button please be aware that everything you made in this page will now be saved and monitored by the system for, you will be redirected to the main page of requests for inventory" data-container="body"><span class = "glyphicon glyphicon-floppy-save"></span>  Save the request </a>


      <a href=" {{ route ('InventorySched.Cancel_requestCreation') }}" class="btn btn-md btn-danger btn-tooltip pull-right" data-toggle="tooltip" data-placement="bottom" title="Upon clicking this button please be aware that everything you made in this page will now be reset for you have cancelled the creation, and will redirect you to the main page of requests for inventory" data-container="body"><span class = "glyphicon glyphicon-remove"></span> Cancel request creation </a>

      <br>
      <br>
    </div>
          <div class="modal fade" id="newFlower" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                      <h3 class="modal-title" id="lineModalLabel">Add Flower for this Qoutation</h3>
                    </div>
                  <!--form open here-->
                      {!! Form::open(array('route' => 'InventoryScheduling_Flowers.store', 'data-parsley-validate'=>'', 'method'=>'POST')) !!}

                            <div class="modal-body">
                                    <!-- content goes here -->
                                    <div id = 'FLower_ListDiv' class = "row">
                                      <div class = "col-md-7">
                                        <select id = 'FLowerList' name = 'FLowerList' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID" required>
                                            <option value = '-1' data-tag ='-1' disabled selected>Please Choose one Flower </option>
                                          @foreach($FlowerList as $Fdetails)
                                            <option value = '{{$Fdetails->flower_ID}}' data-tag ='{{$Fdetails->F_Image}}'>
                                            {{$Fdetails->Flwr_Name}}
                                            </option>
                                          @endforeach
                                        </select>
                                         <img class="img-responsive" height="70%" width="70%" alt="" src="http://placehold.it/320x320" />
                                      </div>
                                      <div class = 'col-md-4'>
                                        <div class="form-group label-floating">

                                        </div>
                                        <div class="form-group label-floating">
                                            <label for = "QTY_Field" class="control-label">Desired Quantity:</label>
                                            <input type="number" class="form-control" name="QTY_Field" id="QTY_Field"  placeholder="" required/>
                                        </div>
                                      </div>
                                      <div hidden>
                                        <input id = "SchedID_field" name = "SchedID_field" value = "">
                                      </div>
                                   </div>
                              </div>
                            <div class="modal-footer">
                              <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                <div class="btn-group" role="group">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal"  role="button">Cancel</button>
                                </div>
                                <div class="btn-group" role="group">
                                   <button type = "submit" name = "AddBtn" class = "btn btn-primary btn-success"><span class = "glyphicon glyphicon-floppy-save"></span> Add to list</button>

                                </div>
                              </div>
                            </div>
                            </div>
                              {!! Form::close() !!}
                           <!--Form close here-->
                          </div>
                          </div>
  </section>



  <div class="container">
    <div class="row" >
        <div class="col-xs-12">
          <div class="box">

            <!-- /.box-header -->
            <div class="box-body">
              <table id="flowersTable" class="table table-bordered table-striped">
                <thead>
                    <th> Flower ID </th>
                    <th> Flower Name </th>
                    <th> Flower Image </th>
                    <th> Expected Quantity</th>
                    <th> Action </th>
                </thead>
                <tbody>

              <!--foreach here-->
              @foreach(Cart::instance('Schedule_Flowers')->content() as $FlowersRow)
                    <tr>
                        <td> FLWR-{{$FlowersRow->id}}  </td>
                        <td> {{$FlowersRow->name}}</td>
                        <td>
                          <img class="img-rounded img-raised img-responsive" style="min-width: 50px; max-height: 50px;" src="{{ asset('flowerimage/'.$FlowersRow->options['image'])}}">
                        </td>
                        <td> {{$FlowersRow->qty}} stems </td>
                        <td align="center" >
                               <a type = "button" href="{{route('InventoryScheduling_Flowers.edit',['id' => $FlowersRow->id])}}" class = "btn btn-info btn-sm" ><span class = "glyphicon glyphicon-pencil"></span>
                                edit Qty
                               </a>
                            <a type = "button" href="{{route('InventorySched.RemoveFlower',['flower_Id'=>$FlowersRow->id])}}" name = "deleteBTN" id = "deleteBTN"
                             class = "btn btn-danger btn-sm" >
                             Delete
                            </a>

                        </td>

                      </tr>
                  @endforeach
                    <!--end of foreach-->
              </div>
            </div>
          </div>


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
@endsection


@section('scripts')
  <script type="text/javascript">
          $(function () {
        $("#flowersTable").DataTable();
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

/*
        $("#FLowerList").change(function(){
          var element3 =  $("#FLowerList").val();
                //console.log('element3 = '+element3);
            $('#FlowerList2 option').each(function(item){
                var element4 = $(this);
                console.log('element3 = '+element3);
                  if(element3 == element4.data('tag')){
                    console.log(element3);
                    console.log(element4.data('tag'));
                    element4.prop('selected',true);
                  }//
              });
          });//
        */
        $("#FLowerIDfield").change(function(){
          var element =  $(this);
          var price = $('option:selected').attr( "data-tag" );
          $('#origPriceField').val(price);
        });//end of function
      });
    </script>
@endsection
