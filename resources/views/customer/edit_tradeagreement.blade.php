@extends('main')


@section('content')
   
    <!-- Content Header (Page header) -->
  <section class="content-header">

  </section>



  <div class="container">
    <div class="row" >
        <div class="col-xs-11">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body" style = "width: 100%;">
              <div class = "row">
                <div class = "col-md-5">
                
                @foreach($details as $detail)
            {!! Form::model($detail,['route'=>['TradeAgreements.update', $detail->Agreement_ID],'method'=>'PUT'])!!} 
                  <h3><strong>Agreement ID: </strong> 
                  AGMT-{{ $detail->Agreement_ID }}</h3>
                  <h3> <strong>Customer ID:</strong> CUST-{{ $detail->Customer_ID }} </h3>
                </div>
                <div class = "col-md-5">  
                  <h3><strong>Agreement Status:</strong> ACTIVE</h3>
                </div>
              </div>
                  <h3> <strong>Customer Name:</strong> {{ $detail->MName }} {{ $detail->MName }} {{ $detail->LName }} </h3>

              <hr>
                <div class = "row">
                  <div class = 'col-md-3'>
                    <img class="img-responsive" height="90%" width="90%" alt="" src="http://placehold.it/320x320" />  
                  </div>

                  <div class = 'col-md-4'>
                    <h4><strong>Flower ID:</strong> {{ $detail->Flower_ID }}</h4>
                    <h4><strong>Flower Name:</strong> {{ $detail->Flower_Name }}</h4>
                    <h4><strong>Start Date:</strong> {{ $detail->SDate }}</h4>
                    <h4><strong>Due Date:</strong> {{ $detail->EDate }}</h4>
                  </div> <!--end of column-->

                  <div class = "col-md-4">
                    <h4><strong>Original Price:</strong>Php {{ Number_Format($detail->OrigPrice,2) }} </h4> 
                    <h4><strong>Agreed Price:</strong> Php {{ Number_Format($detail->AgreedPrice,2) }} </h4>
                    <hr>
                    <button id = "showFieldBtn" name = "showFieldBtn" class = "btn btn-info"><strong>Change the Price?</strong><span class = "glyphicon glyphicon-triangle-bottom"></span> </button> 
                    <div id = "newpriceDiv" hidden>
                      <button type = 'button' id = "hideFieldBtn" name = "hideFieldBtn" class = "btn btn-danger"><strong>Cancel</strong><span class = "glyphicon glyphicon-triangle-top"></span> </button>
                      <div  class = "row"> 
                          <div class = "col-md-4">
                            <h5><strong>New Price:</strong></h5>
                          </div>
                          <div class = "col-md-6 input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                            <input class = "form-control" id = "newIDfield" name = "newIDfield"  type = number min = '0.00'>
                          </div>
                      </div>
                    </div>
                  </div>   <!--end of column-->
                  
                </div>
                
              </div>

            <!--Hidden for edit only-->
            <div class="modal-footer" id = "editFooter">
              <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                <div class="btn-group" role="group">
                        <a type = "button" href="{{ route('customersTradeAgreement.show',$detail->Customer_ID) }}" class = "btn btn-default btn-default" > 
                            Return to customer's Agreements
                          </a>
                </div>
                <div class="btn-group" role="group">
                   <button type = "submit" name = "saveChangesBtn" id = "saveChangesBtn" class = "btn btn-success btn-success"><span class = "glyphicon glyphicon-floppy-save"></span> Save Changes</button>
                </div>
              </div>
            </div>
                   @endforeach 
            {!! Form::close() !!}
            <!-- /.box-body -->
          </div>
          </div>
        </div>
        <!-- /.col -->
      </div>


    
  </div>
@endsection


@section('scripts')
<script>
  $(document).ready(function(){
      
      $("#saveChangesBtn").attr("disabled", true);


        $('#showFieldBtn').click(function(){
          $('#newpriceDiv').slideDown();
          $("#saveChangesBtn").attr("disabled", false);
          $('#showFieldBtn').slideUp();

          $("#newIDfield").attr('required', true);
        });//end of function        

        $('#hideFieldBtn').click(function(){
          $('#newpriceDiv').slideUp();
          $('#showFieldBtn').slideDown();
          $("#saveChangesBtn").attr("disabled", true);

          $("#newIDfield").attr('required', false);
        });//end of function              
       
      });
    </script>
@endsection