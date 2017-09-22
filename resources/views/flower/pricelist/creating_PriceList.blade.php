@extends('main')

@section('content')
       <section class="content-header">
       <?php
         $deletingPriceSessionValue = Session::get('Delete_MarkUpSession');
         Session::remove('Delete_MarkUpSession');//determines the addition of new flower

          $SavingPriceSessionValue = Session::get('Adding_newMarkUpSession');
          Session::remove('Adding_newMarkUpSession');//determines the addition of new flower

          $EditingPriceSessionValue = Session::get('Editing_MarkUpSession');
          Session::remove('Editing_MarkUpSession');//determines the addition of new flower
       ?>
          

          <input type = "text" class = "hidden" id = "deleteSessionField" value = "{{$deletingPriceSessionValue}}">
          <input type = "text" class = "hidden" id = "addingSessionField" value = "{{$SavingPriceSessionValue}}">
          <input type = "text" class = "hidden" id = "editSessionField" value = "{{$EditingPriceSessionValue}}">
              
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
            <div class="panel" style="margin-top: 2%">
              <div class="panel-body">
                <div class="col-md-6">
                  <h3>MARKUP PERCENTAGE OF WONDERBLOOM'S PRICES FROM FLOWERS</h3>
                </div>
                <div class="col-md-offset-9">
                  <button class="btn btn-round twitch" data-toggle="modal" data-target="#addingModal">
                    Add new weekly Markup <i class="material-icons">add_circle</i>
                  </button>
                </div>
                <div class="card card-nav-tabs">
              <div class="header Sharp">
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
              <div class="content-header">
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
                          <div hidden>
                            <input class = "ID_Field" value = "{{ $Active->Price_ID }}">
                            <input class = "markup_Field" value = "{{ $Active->markUp_Percentage }}">
                            <input class = "status_Field" value = "{{ $Active->Status }}">
                            <input class = "Start_Field" value = "{{date('Y-m-d',strtotime($Active->Start_Date))}}">
                            <input class = "End_Field" value = "{{date('Y-m-d',strtotime($Active->End_Date)) }}">
                          </div>

                          <td> PRICE-{{ $Active->Price_ID }} </td>
                          <td> {{ $Active->markUp_Percentage }} % </td>
                          <td> {{date('M d, Y',strtotime($Active->Start_Date))   }} </td>
                          <td> {{date('M d, Y @ h:s a',strtotime($Active->End_Date))  }} </td>
                          <td> {{ $Active->Status }} </td>
                          <td align="center">
                            <button type="button" class="btn btn-just-icon Subu Agrmt_btn" rel="tooltip" title="VIEW" data-toggle="modal" data-target="#viewPrice"><i class="material-icons">search</i></button>
                              <a type = "button" href="{{route('Price.delete',['id'=>$Active->Price_ID])}}" class = "btn btn-just-icon Shalala" rel="tooltip" title="DELETE" >
                                <i class="material-icons">delete</i>
                              </a>
                          </td>
                        </tr>
                          @endforeach
                      </tbody>
                    </table>
                    <!-- line modal -->
                   <div class="modal fade" id="viewPrice" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                       <div class="modal-dialog">
                          <div class="modal-content">
                             <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                              <h3 class="modal-title" id="lineModalLabel">Markup's Details</h3>
                            </div>
        <!--form open here-->
        {!! Form::model($Active, ['route'=>['Shop_Pricelist.update', $Active->Price_ID],'method'=>'PUT'])!!}

                            <div class="modal-body">
                          <!-- content goes here -->
                          <div>
                            <h4 id = "Markup_IDDiv"></h4>
                          </div>
                              <div id = 'FLower_ListDiv' class = "row">
                                  <div hidden>
                                    <input type = 'text' id = "Agrmt_ID" name = "Agrmt_ID">
                                    <input type = 'text' id = "Mark_Up" name = "Mark_Up">
                                  </div>
                                  <div class = "col-md-6">
                                      <div class="form-group">
                                        <label>Start Date: </label>
                                            <input type="date" class="form-control text-center" name="Sdate_Field" id="Sdate_Field" disabled/>
                                      </div>

                                     <div class="form-group">
                                       <label>Due Date:</label>
                                       <input type="date" class="form-control text-center" name="Edate_Field" id="Edate_Field" disabled/>
                                     </div>
                                  </div>
                                  <div class = "col-md-6">
                                    <div class="form-group">
                                      <label>Markup Percentage:</label>
                                      <input type="number" step = "0.1" min = "0" class="form-control text-center" name="upValue_Field" id="upValue_Field" disabled/>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6 col-md-offset-6">
                                  <div class="checkbox">
                                    <label style = "color:red;">
                                      <input type="checkbox" name="importantCheckBox" id = "importantCheckBox">
                                      <span>Check if you want to update details of this markup</span>
                                    </label>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                  <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                                  </div>
                                  <div class="btn-group" role="group">
                                     <button type = "submit" id = "Edit_Btn" class = "btn btn-primary btn-info"><span class = "glyphicon glyphicon-pencil" disabled></span> Edit This Price</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                 <!--Form close here-->
                      </div>
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
                                  <td> {{ date('M d, Y',strtotime($Inactive->Start_Date)) }} </td>
                                  <td> {{ date('M d, Y @ h:s a',strtotime($Inactive->End_Date)) }} </td>
                                  <td> {{ $Inactive->Status }} </td>
                                  <td align="center" >

                                  <button type="button" class="btn btn-just-icon Subu" data-toggle="modal" data-target="#viewCust" rel="tooltip" title="VIEW" ><i class="material-icons">search</i></button>
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
              </div>
            </div>
            
</section>
@endsection



@section('scripts')
    <script>
    /*$('#example2').DataTable({

    });
    $('#example3').DataTable({

    });*/
      $(document).ready(function(){

        $('#importantCheckBox').click(function(){

        });

        if($('#importantCheckBox').is(":checked")){
          $('#Edit_Btn').attr('disabled',false);
          $('#Sdate_Field').attr('disabled',false);
          $('#Edate_Field').attr('disabled',false);
          $('#upValue_Field').attr('disabled',false);
  			}

  			$('#importantCheckBox').click(function(){
  				if($('#importantCheckBox').is(":checked")){
            $('#Edit_Btn').attr('disabled',false);
            $('#Sdate_Field').attr('disabled',false);
            $('#Edate_Field').attr('disabled',false);
            $('#upValue_Field').attr('disabled',false);

  				}
  				else{
  					$('#Edit_Btn').attr('disabled','disabled');
            $('#Edit_Btn').attr('disabled','disabled');
            $('#Sdate_Field').attr('disabled','disabled');
            $('#Edate_Field').attr('disabled','disabled');
            $('#upValue_Field').attr('disabled','disabled');

  				}
  			});
        $(document).on('click', '.Agrmt_btn', function(){
          $('#Edit_Btn').attr('disabled','disabled');
          $('#Edit_Btn').attr('disabled','disabled');
          $('#Sdate_Field').attr('disabled','disabled');
          $('#Edate_Field').attr('disabled','disabled');
          $('#upValue_Field').attr('disabled','disabled');
    			$('#importantCheckBox').attr('checked',false);
    			var index = $('.Agrmt_btn').index(this);

    			var Agrmt_ID = $('.ID_Field').eq(index).val();
          var markup = $('.markup_Field').eq(index).val();
    			var status = $('.status_Field').eq(index).val();
    			var s_date = $('.Start_Field').eq(index).val();
    			var e_date = $('.End_Field').eq(index).val();

    			$('#Agrmt_ID').val(Agrmt_ID);
          $('#Mark_Up').val(markup);
    			$('#upValue_Field').val(markup);
          $('#Sdate_Field').val(s_date);
          $('#Edate_Field').val(e_date);

          $('#Mrk_ID').remove();
    			$('#Markup_IDDiv').after('<h5 id = "Mrk_ID"><b>PRICE-'+Agrmt_ID+'</b></h5>');
    			//alert(Flwr_IMG+ "---" +Flwr_Name +'----' + Flwr_ID + '---' +  Flwr_Price);
    		});



        if($('#editSessionField').val()=='Successful'){
         //Show popup
         swal("Good Job!:","You have successfully updated the markup details for your flowers!","info");
        }

        if($('#deleteSessionField').val()=='Successful'){
         //Show popup
         swal("Good Job!:","You have successfully deleted the markup price!","success");
       }

        if($('#addingSessionField').val()=='Successful'){
         //Show popup
         swal("Good Job!:","You have successfully made a new markup price for your flowers!","success");
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
