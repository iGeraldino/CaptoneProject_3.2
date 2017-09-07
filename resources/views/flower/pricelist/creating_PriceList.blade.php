@extends('main')

@section('content')
       <section class="content-header">
       <?php
        
          $SavingPriceSessionValue = Session::get('Adding_newMarkUpSession'); 
          Session::remove('Adding_newMarkUpSession');//determines the addition of new flower
       ?>
          <h3><b>Markup percentage of Wonderbloom's prices for flowers</b></h3>
          <input type = "text" class = "hidden" id = "addingSessionField" value = "{{$SavingPriceSessionValue}}">
              <button class="btn btn-primary" data-toggle="modal" data-target="#addingModal">
                Add new weekly Markup
              </button>
              <!-- Sart Modal -->
                <div class="modal fade" id="addingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      {!! Form::open(array('route' => 'Shop_Pricelist.store', 'data-parsley-validate'=>'', 'method'=>'POST')) !!}
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                          <i class="material-icons">clear</i>
                        </button>
                        <h4 class="modal-title">Add new weekly Markup Price</h4>
                      </div>
                      <div class="modal-body">
                      <!--put the input tags here-->
                        <div class = "row">
                          <div class = "col-md-6">
                            <div class="form-group label-floating">
                              <label class="control-label">Markup Percentage</label>
                              <input name = 'markUp' type="number" class="form-control" step = "0.1" value = "0.0" min = '0'>
                            </div>    
                          </div>
                        </div>
                        <div class = "row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Start Date: </label>
                                  <input type="date" class="form-control pull-right" id="Startdatepicker" name="Startdatepicker">
                            </div>
                         </div>
                         <div class="col-md-6">
                            <div class="form-group">
                              <label>End Date: </label>
                                  <input type="date" class="form-control pull-right" id="Enddatepicker" name="Enddatepicker">
                            </div>
                         </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success btn-simple">Save</button>
                      </div>
                      {!! Form::close() !!}
                    </div>
                  </div>
                </div>
                <!--  End Modal -->
            <div class="card card-nav-tabs card-plain">
              <div class="header header-danger">
                <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                <div class="nav-tabs-navigation">
                  <div class="nav-tabs-wrapper">
                    <ul class="nav nav-tabs" data-tabs="tabs">
                      <li class="active"><a href="#activePrice" data-toggle="tab">Active PriceLists</a></li>
                      <li><a href="#updates" data-toggle="tab">Inactive PriceLists</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="content">
                <div class="tab-content text-center">
                  <div class="tab-pane active" id="activePrice">
                    <table id="example2" class="table table-bordered table-striped">
                      <thead>
                          <th> Price_ID </th>
                          <th> Markup Percentage </th>
                          <th> Start Date</th>
                          <th> Due Date </th>
                          <th> Status </th>
                          <th> Action </th>
                      </thead>
                      <tbody>
                                        @foreach($activePrices as $Active)
                        <tr>  
                          <td> PRICE-{{ $Active->Price_ID }} </td>
                          <td> {{ $Active->markUp_Percentage }} % </td>
                          <td> {{ $Active->Start_Date }} </td>
                          <td> {{ $Active->End_Date }} </td>
                          <td> {{ $Active->Status }} </td>
                          <td align="center"> 
                                 
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewPrice{{ $Active->Price_ID }}">View</button>
                                      <!-- line modal -->
                                     <div class="modal fade" id="viewPrice{{ $Active->Price_ID }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                         <div class="modal-dialog">
                                            <div class="modal-content">
                                               <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                                <h3 class="modal-title" id="lineModalLabel">Price's Details</h3>
                                              </div>
                          <!--form open here-->
                                              <div class="modal-body"> 
                                            <!-- content goes here -->
                                                <div id = 'FLower_ListDiv' class = "row">
                                                  <div class = 'col-md-5'>
                                                    <div>
                                                      <h4>Price ID: PRC-{{ $Active->Price_ID }} </h4>
                                                    </div>

                                                      <div id = 'Startdate_Div'>
                                                       <div>
                                                        <label>Start Date:</label>
                                                       </div>
                                                       <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                                        <input type="text" class="form-control" name="Sdate_Field" id="Sdate_Field"  value="{{ $Active->Start_Date }}" disabled/>
                                                      </div>                            
                                                     </div>

                                                     <div id = 'Enddate_Div'>
                                                       <div>
                                                        <label>Due Date:</label>
                                                       </div>
                                                       <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                                        <input type="text" class="form-control" name="Edate_Field" id="Edate_Field"  value="{{ $Active->End_Date }}" disabled/>
                                                      </div>                            
                                                     </div>

                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="modal-footer">
                                                  <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                                    <div class="btn-group" role="group">
                                                      <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                                                    </div>
                                                    <div class="btn-group" role="group">
                                                       <button type = "submit" name = "AddBtn" class = "btn btn-primary btn-info"><span class = "glyphicon glyphicon-pencil"></span> Edit This Price</button>
                                          
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                   <!--Form close here--> 
                                        </div>

                                  <a type = "button" href="#" class = "btn btn-danger btn-sm" > 
                                    delete
                                  </a>

                                </td>

                              </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>
                  
                  <div class="tab-pane" id="updates">
                      <table id="example3" class="table table-bordered table-striped">
                          <thead>
                              <th> Price_ID </th>
                              <th> Markup Percentage </th>
                              <th> Start Date</th>
                              <th> Due Date </th>
                              <th> Status </th>
                              <th> Action </th>
                          </thead>

                          <tbody>

                          @foreach($inactivePrices as $Inactive)
                              <tr>  
                                  <td> PRICE-{{ $Inactive->Price_ID }} </td>
                                  <td> {{ $Inactive->markUp_Percentage }} % </td>
                                  <td> {{ $Inactive->Start_Date }} </td>
                                  <td> {{ $Inactive->End_Date }} </td>
                                  <td> {{ $Inactive->Status }} </td>
                                  <td align="center" > 
                                   
                                  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewCust">View</button>
                                        <!-- line modal -->
                                  </td>

                              </tr>
                            @endforeach
                          </tbody>
                 
                      </table>
                  </div>
                </div>
              </div>
            </div>
</section>
@endsection



@section('scripts')
    <script>
    $('#example2').DataTable({

    });
    $('#example3').DataTable({

    });
      $(document).ready(function(){

        
        if($('#addingSessionField').val()=='Successful'){
         //Show popup
         swal("Good Job!:","You have successfully made a new markup price for your offered flowers!","success");
       }
   
        $('#datepicker').datepicker({
          autoclose: true
        });

        $("#FLowerIDfield").change(function(){

          var element =  $(this);
          //var  = element.val(); 
          var price = $('option:selected').attr( "data-tag" );
          //console.log(price) ; 
          $('#origPriceField').val(price);
          $('#origPriceField2').val(price);
          $('#RPriceField').val(price);
        });//end of function

        $("#decreaseField").change(function(){
          var element =  $(this);
          var selling_price = $('#RPriceField').val();
          var percentage  = element.val(); 
          var wholesalePrice = (selling_price * percentage)/100;
          var finalWholesalePrice = selling_price - wholesalePrice;
          //console.log(price) ; 
          $('#WholsalePrice_Field').val(finalWholesalePrice);
          $('#FinalWholsalePrice_Field').val(finalWholesalePrice);
        });//end of function

        $("#RPriceField").change(function(){
          var element =  $(this);
          var percentage = $('#decreaseField').val();
          var  selling_price = $("#RPriceField").val(); 
          var wholesalePrice = (selling_price * percentage)/100;
          var finalWholesalePrice = selling_price - wholesalePrice;
          //console.log(price) ; 
          $('#WholsalePrice_Field').val(finalWholesalePrice);
          $('#FinalWholsalePrice_Field').val(finalWholesalePrice);
        });//end of function

});



    </script>
@endsection
