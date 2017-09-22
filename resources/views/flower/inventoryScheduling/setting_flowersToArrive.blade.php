
@extends('main')

@section('content')
   
    <!-- Content Header (Page header) -->
  <section class="content-header">
      
       <div class="col-xs-12" style="margin-top: 2%;">
        <div class="panel">
          <div class="panel-heading Subu">
            <h3 class="panel-title" style="color: white;">LIST OF FLOWERS THAT YOU REQUESTED FROM THE SUPPLIERS</h3>
          </div>
          <div class="panel-body">
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label"><b>SCHEDULE ID:</b></label>
                <span><b>CUST-{{$schedInfo->Sched_Id}}</b></span>
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
            <div class="col-md-offset-8">
              <a id = "returnBtn" type="button" href = "{{route('InventoryScheduling.index')}}" class="pull-right btn btn-round twitch btn-md"  data-toggle="tooltip" data-placement="bottom" title="This Button redirect you to the list of flower requests from the supplier" data-container="body">
                RETURN TO REQUEST LIST
              </a>
            </div>
          <div class="row" >
            <div class="col-xs-12">
              <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
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
                      <tr>  
                          <td class="text-center"> FLWR-{{$FlowersRow->flower_ID}}  </td>
                          <td class="text-center"> {{$FlowersRow->flowerName}} </td>
                          <td align="center"> <img class="img-rounded img-raised img-responsive" style="min-width: 50px; max-height: 50px;" src="{{ asset('flowerimage/'.$FlowersRow->Img)}}"></td>
                          <td class="text-center"> {{$FlowersRow->QTY_Expected}} pcs </td>
                          <td align="center" > 
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
                                  </div>
                                </div>
                              </div>
                            </div>
                                  
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
        $("#flowersTable").DataTable();
        $('#pendingtable').DataTable({
          "paging": true,
          "info": true,
          "autoWidth": false
        });
      });
  </script>
    <script>
      $(document).ready(function(){

        var date = new Date();      
        var currentDate = date.toISOString().slice(0,10);
        var currentTime = date.getHours() + ':' + date.getMinutes();

        document.getElementById('current_Date').value = currentDate;
        document.getElementById('current_Time').value = currentTime;

              $("#Cust_FNameField").attr('disabled',false);
              $("#Cust_MNameField").attr('disabled',false);
              $("#Cust_LNameField").attr('disabled',false);
              $("#ContactNum_Field").attr('disabled',false);
              $("#email_Field").attr('disabled',false);



        $('#OnetimecheckBox').click(function(){
          $('#Customer_Chooser').fadeToggle(300);
          if($('#OnetimecheckBox').is(':checked') == true){
            console.log('pasok');
              $("#idfield").val(' ');
              $("#Cust_FNameField").val(' ');
              $("#Cust_MNameField").val(' ');
              $("#Cust_LNameField").val(' ');
              $("#ContactNum_Field").val(' ');
              $("#email_Field").val(' ');

              $("#Cust_FNameField").attr('disabled',false);
              $("#Cust_MNameField").attr('disabled',false);
              $("#Cust_LNameField").attr('disabled',false);
              $("#ContactNum_Field").attr('disabled',false);
              $("#email_Field").attr('disabled',false);

              $("#Cust_FNameField").attr('required',true);
              $("#Cust_LNameField").attr('required',true);
              $("#ContactNum_Field").attr('required',true);
              $("#email_Field").attr('required',true);

              $("#Cust_FNameField").attr('placeholder','First Name...');
              $("#Cust_MNameField").attr('placeholder','Middle Name...');
              $("#Cust_LNameField").attr('placeholder',':Last Name...');
              $("#ContactNum_Field").attr('placeholder','09...');
              $("#email_Field").attr('placeholder','email address here...');

           }
        }); 
        //end of functionx

        
        $("#FLowerIDfield").change(function(){
          var element =  $(this);
          var price = $('option:selected').attr( "data-tag" );
          $('#origPriceField').val(price);
        });//end of function
        

        $('#customerList_ID').change(function(){
            var selected = $(this).val();
            var OptionFname;
            var OptionMname;
            var OptionLname;
            var OptionEmail;
            var OptionContactNum;
            
            $("#customerList_FName option").each(function(item){
              var element =  $(this) ; 
              if (element.data("tag") != selected){
                element.hide() ; 
              }
              else{
               OptionFname = element.val(); 
                element.show();
              }
            });//end of function


           $("#customerList_MName option").each(function(item){
             // console.log(selected) ;  
              var element =  $(this) ; 
              //console.log(element.data("tag")) ; 
              if (element.data("tag") != selected){
                element.hide() ; 
              }
              else{
               OptionMname = element.val(); 
                element.show();
              }
            });//end of function 

           $("#customerList_LName option").each(function(item){
             // console.log(selected) ;  
              var element =  $(this) ; 
              //console.log(element.data("tag")) ; 
              if (element.data("tag") != selected){
                element.hide() ; 
              }
              else{
               OptionLname = element.val(); 
                element.show();
              }
            });//end of function

           $("#Contact_NumList_LName option").each(function(item){
             // console.log(selected) ;  
              var element =  $(this) ; 
              //console.log(element.data("tag")) ; 
              if (element.data("tag") != selected){
                element.hide() ; 
              }
              else{
               OptionContactNum = element.val(); 
                element.show();
              }
            });//end of function

           $("#Email_AddList_LName option").each(function(item){
             // console.log(selected) ;  
              var element =  $(this) ; 
              //console.log(element.data("tag")) ; 
              if (element.data("tag") != selected){
                element.hide() ; 
              }
              else{
               OptionEmail = element.val(); 
                element.show();
              }
            });//end of function 

           

          $("#idfield").val(selected);
          $("#Cust_FNameField").val(OptionFname);
          $("#Cust_MNameField").val(OptionMname);
          $("#Cust_LNameField").val(OptionLname);
          $("#ContactNum_Field").val(OptionContactNum);
          $("#email_Field").val(OptionEmail);

        });//end of function

      });
    </script>
@endsection\
