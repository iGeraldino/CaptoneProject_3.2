@extends('main')

@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header" style="margin-top: 2%;">

<!-- line modal -->
    <div class="modal fade" id="newCust" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
          <h3 class="modal-title" id="lineModalLabel">Create New Customer Record</h3>

         <input type="text" id="emailvalidator" value="" hidden>
        </div>


      {!! Form::open(array('route' => 'customers.store', 'data-parsley-validate'=>'', 'method'=>'POST')) !!}
        <div class="modal-body">
          <!-- content goes here -->
          <div class="input-group">
            <label><b>NAME: </b></label>
            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
            <input type="text" class="form-control" name="Cust_FNameField" id="Cust_FNameField"  placeholder="First Name..." required/>
            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
            <input type="text" class="form-control" name="Cust_MNameField" id="Cust_MNameField"  placeholder="Middle Name..."/>
            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
            <input type="text" class="form-control" name="Cust_LNameField" id="Cust_LNameField"  placeholder="Last Name..." required/>

          </div>

          <div class = "row">
            <div class = "col-md-4">
              <label>Type: </label>
            </div>

            <div class = "col-md-4">
              <label>Contact NUmber: </label>
            </div>
          </div>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
            <select class="form-control" name ="custTypeField" id ="custTypeField" >
                <option value ="C" > Single </option>
                <option value ="S" > Shop </option>
                <option value ="H" > Hotel </option>
            </select>
            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
            <input type="text" class="form-control" name="ContactNumField" id="ContactNumField"  placeholder="+639..." required/>
          </div>

          <div class="form-group" id = "hotelnameDiv" hidden>
            <label for="HotelNameField">Hotel Name (for hotel customers):</label>
            <input type="text" class="form-control" id="HotelNameField" name="HotelNameField" placeholder="Hotel Name here...">
          </div>

          <div class="form-group" id = "shopnameDiv" hidden>
            <label for="ShopNameField">Shop Name (for shop customers):</label>
            <input type="text" class="form-control" id="ShopNameField" name="ShopNameField" placeholder="Shop Name here...">
          </div>

          <div class="form-group">
            <label for="emailField">Email address</label>
            <input type="email" class="form-control" id="emailField" name="emailField" placeholder="Email here...">
          </div>

          <div class="form-group">
            <label for="addressField">Address Line</label>
            <input type="text" class="form-control" id="addressField" name="addressField" placeholder="Unit No. or House No.\Street\Baranggay\Town\Porvince" required>
          </div>

          <div class = "form-group">
            <label>Baranggay: </label>
          <input type="text" class="form-control" name="BaranggayField" id="BaranggayField"  placeholder="Baranggay here..." required/>
          </div>

        <div class = "row">
          <div class = "col-md-6">
            <label>Province: </label>
          </div>
          <div class = "col-md-6">
            <label>Town: </label>
          </div>
        </div>
        <div class="input-group" id = "AdrsDiv">
          <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
          <select class="form-control" name ="ProvinceField" id ="ProvinceField" >
              @foreach($province as $prov)
                <option value ="{{$prov->id}}" > {{$prov->name}} </option>
              @endforeach
          </select>
          <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
          <select class="form-control" name ="TownField" id ="TownField" >
              @foreach($city as $city)
                <option value ="{{$city->id}}" data-tag = "{{$city->province_id}}"> {{$city->name}} </option>
              @endforeach
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <div class="btn-group" role="group" aria-label="group button">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal"  role="button">Close</button>
          </div>
          <div class="btn-group btn-delete hidden" role="group">
            <button id="delImage" class="btn btn-default btn-hover-red" data-dismiss="modal"  role="button">Delete</button>
          </div>
          <div class="btn-group" role="group">
             <button type = "submit" name = "AddBtn" class = "btn btn-simple btn-success"><span class = "glyphicon glyphicon-floppy-save"></span> Add Customer</button>
          </div>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
</section>

<div class="col-xs-12">
  <div class="panel">
    <div class="panel-heading Subu">
      <h3 class="panel-title" style="color: white;">.</h3>
    </div>
    <div class="panel-body">
      <div class="col-md-9">
        <h3>LIST OF CUSTOMERS</h3>
      </div>
      <div class="col-md-offset-5">
        <button type="button" class="btn btn-primary btn-md btn-round col-md-offset-6 twitch" data-toggle="modal" data-target="#newCust">
          <i class="material-icons md-24"> add_circle_outline</i> Add New Customer
        </button>
      </div>
      <div class="col-md-12">
        <!-- Tabs with icons on Card -->
        <div class="card card-nav-tabs">
          <div class="header Sharp">
            <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
            <div class="nav-tabs-navigation">
              <div class="nav-tabs-wrapper">
                <ul class="nav nav-tabs" data-tabs="tabs">
                  <li  class="active">
                    <a href="#withaccount" data-toggle="tab">
                      <i class="material-icons">assignment_return</i>
                      Customer with Account
                    </a>
                  </li>
                  <li>
                    <a href="#withoutaccount" data-toggle="tab">
                      <i class="material-icons">assignment_returned</i>
                      Customer without an Account
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="content">
            <div class="tab-content text-center">
              <div class="tab-pane  active" id="withaccount">
                <div class="col-xs-12">
                  <div class="box">
                    <div class="box-header">
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="withaccts" class="table table-bordered table-striped">
                        <thead style="color: #6e48aa">
                            <th class="text-center"> ID </th>
                            <th class="text-center"> NAME </th>
                            <th class="text-center"> TYPE </th>
                            <th class="text-center"> PHONE NUMBER</th>
                            <th class="text-center"> EMAIL ADDRESS</th>
                            <th class="text-center"> ADDRESS</th>
                            <th class="text-center"> ACTION</th>
                        </thead>

                        <tbody>
                          @foreach($accts as $customerDetailsrow)
                            <tr>
                              <td> CUST-{{$customerDetailsrow->Cust_ID}}     </td>
                              <td> {{$customerDetailsrow->Cust_FName}} {{$customerDetailsrow->Cust_MName}}, {{$customerDetailsrow->Cust_LName}} </td>
                              <td>
                                <?php
                                  if($customerDetailsrow->Customer_Type == 'C'){
                                    echo 'Single';
                                  }
                                  else if($customerDetailsrow->Customer_Type == 'H'){
                                    echo 'Hotel';
                                  }
                                  else if($customerDetailsrow->Customer_Type == 'S'){
                                    echo 'Shop';
                                  }
                                  else{
                                    echo 'n\a';
                                  }
                                ?>
                              </td>
                              <td> {{$customerDetailsrow->Contact_Num}}       </td>
                              <td> {{$customerDetailsrow->Email_Address}}       </td>
                              <td>    {{$customerDetailsrow->Address_Line}}  </td>
                              <td align="center" >
                                <button type="button" rel="tooltip" title="VIEW" class="btn Subu btn-sm btn-just-icon" data-toggle="modal" data-target="#viewCust{{$customerDetailsrow->Cust_ID}}"><i class="material-icons">search</i></button>
                                <!-- line modal -->
                                <div class="modal fade" id="viewCust{{$customerDetailsrow->Cust_ID}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" rel="tooltip" title="close"
                                        id = "closeXBtn" name = "closeXBtn" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only"><i class="material-icons">delete</i></span></button>
                                        <h3 class="modal-title" id="lineModalLabel">Customer's Details</h3>
                                      </div>
                                      <div class="modal-body" id = "infoBodyDiv">
                                        <!-- content goes here -->
                                        <h5>
                                          <bold>Customer ID:</bold>
                                            CUST-{{$customerDetailsrow->Cust_ID}}
                                        </h5>
                                        <h5>
                                          <bold>Customer Name:</bold>
                                          {{$customerDetailsrow->Cust_FName}} {{$customerDetailsrow->Cust_MName}}, {{$customerDetailsrow->Cust_LName}}
                                        </h5>
                                        <h5>
                                          Type: <?php
                                            if($customerDetailsrow->Customer_Type == 'C'){
                                              echo 'Single';
                                            }
                                            else if($customerDetailsrow->Customer_Type == 'H'){
                                              echo 'Hotel';
                                            }
                                            else if($customerDetailsrow->Customer_Type == 'S'){
                                              echo 'Shop';
                                            }
                                            else{
                                              echo 'n\a';
                                            }
                                          ?>
                                        </h5>
                                        <h5>
                                         Contact Number: {{$customerDetailsrow->Contact_Num}}
                                        </h5>

                                        <h5>
                                         Email Address: {{$customerDetailsrow->Email_Address}}
                                        </h5>

                                        <h5>
                                         Address: {{$customerDetailsrow->Address_Line}}
                                        </h5>
                                        <h5>
                                         Hotel Name:
                                         <?php
                                          if($customerDetailsrow->Hotel_Name == " " or $customerDetailsrow->Hotel_Name == NULL){
                                            echo 'Not aviailable';
                                          }
                                          else{
                                            echo $customerDetailsrow->Hotel_Name;
                                          }
                                         ?>
                                        </h5>
                                        <h5>
                                         Shop Name:
                                         <?php
                                          if($customerDetailsrow->Shop_Name == " " or $customerDetailsrow->Shop_Name == NULL){
                                            echo 'Not aviailable';
                                          }
                                          else{
                                            echo $customerDetailsrow->Shop_Name;
                                          }
                                         ?>
                                        </h5>
                                      </div>
                                      <div class="modal-footer" id = "infoFooter">
                                        <div class="btn-group " role="group" aria-label="group button">
                                          <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal"  role="button">Close</button>
                                          </div>
                                          <div class="btn-group" role="group">
                                             <a type = "button" href="{{ route('customers.edit',$customerDetailsrow->Cust_ID) }}" class = "btn   btn-success btn-simple">
                                                Edit Details
                                              </a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <a type = "button" href="{{ route('customersTradeAgreement.show',$customerDetailsrow->Cust_ID) }}" class = "btn btn-sm Inbox btn-just-icon" rel="tooltip" title="ADD TRADE AGREEMENT" >
                                 <i class="material-icons">add_circle</i>
                                </a>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
                <!-- /.col -->

              </div>
              <div class="tab-pane" id="withoutaccount">
                <div class="col-xs-12">
                  <div class="box">
                    <div class="box-header">
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="Noaccts" class="table table-bordered table-striped">
                        <thead style="color: #6e48aa">
                            <th class="text-center"> ID </th>
                            <th class="text-center"> NAME </th>
                            <th class="text-center"> TYPE </th>
                            <th class="text-center"> PHONE NUMBER</th>
                            <th class="text-center"> EMAIL ADDRESS</th>
                            <th class="text-center"> ADDRESS</th>
                            <th class="text-center"> ACTION</th>
                        </thead>

                        <tbody>
                          @foreach($customers as $customerDetailsrow)
                            <tr>
                              <td> CUST-{{$customerDetailsrow->Cust_ID}}     </td>
                              <td> {{$customerDetailsrow->Cust_FName}} {{$customerDetailsrow->Cust_MName}}, {{$customerDetailsrow->Cust_LName}} </td>
                              <td>
                                <?php
                                  if($customerDetailsrow->Customer_Type == 'C'){
                                    echo 'Single';
                                  }
                                  else if($customerDetailsrow->Customer_Type == 'H'){
                                    echo 'Hotel';
                                  }
                                  else if($customerDetailsrow->Customer_Type == 'S'){
                                    echo 'Shop';
                                  }
                                  else{
                                    echo 'n\a';
                                  }
                                ?>
                              </td>
                              <td> {{$customerDetailsrow->Contact_Num}}       </td>
                              <td> {{$customerDetailsrow->Email_Address}}       </td>
                              <td>    {{$customerDetailsrow->Address_Line}}  </td>
                              <td align="center" >
                                <button type="button" rel="tooltip" title="VIEW" class="btn Subu btn-sm btn-just-icon" data-toggle="modal" data-target="#viewCust{{$customerDetailsrow->Cust_ID}}"><i class="material-icons">search</i></button>
                                <!-- line modal -->
                                <div class="modal fade" id="viewCust{{$customerDetailsrow->Cust_ID}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" rel="tooltip" title="close"
                                        id = "closeXBtn" name = "closeXBtn" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only"><i class="material-icons">delete</i></span></button>
                                        <h3 class="modal-title" id="lineModalLabel">Customer's Details</h3>
                                      </div>
                                      <div class="modal-body" id = "infoBodyDiv">
                                        <!-- content goes here -->
                                        <h5>
                                          <bold>Customer ID:</bold>
                                            CUST-{{$customerDetailsrow->Cust_ID}}
                                        </h5>
                                        <h5>
                                          <bold>Customer Name:</bold>
                                          {{$customerDetailsrow->Cust_FName}} {{$customerDetailsrow->Cust_MName}}, {{$customerDetailsrow->Cust_LName}}
                                        </h5>
                                        <h5>
                                          Type: <?php
                                            if($customerDetailsrow->Customer_Type == 'C'){
                                              echo 'Single';
                                            }
                                            else if($customerDetailsrow->Customer_Type == 'H'){
                                              echo 'Hotel';
                                            }
                                            else if($customerDetailsrow->Customer_Type == 'S'){
                                              echo 'Shop';
                                            }
                                            else{
                                              echo 'n\a';
                                            }
                                          ?>
                                        </h5>
                                        <h5>
                                         Contact Number: {{$customerDetailsrow->Contact_Num}}
                                        </h5>

                                        <h5>
                                         Email Address: {{$customerDetailsrow->Email_Address}}
                                        </h5>

                                        <h5>
                                         Address: {{$customerDetailsrow->Address_Line}}
                                        </h5>
                                        <h5>
                                         Hotel Name:
                                         <?php
                                          if($customerDetailsrow->Hotel_Name == " " or $customerDetailsrow->Hotel_Name == NULL){
                                            echo 'Not aviailable';
                                          }
                                          else{
                                            echo $customerDetailsrow->Hotel_Name;
                                          }
                                         ?>
                                        </h5>
                                        <h5>
                                         Shop Name:
                                         <?php
                                          if($customerDetailsrow->Shop_Name == " " or $customerDetailsrow->Shop_Name == NULL){
                                            echo 'Not aviailable';
                                          }
                                          else{
                                            echo $customerDetailsrow->Hotel_Name;
                                          }
                                         ?>
                                        </h5>
                                      </div>
                                      <div class="modal-footer" id = "infoFooter">
                                        <div class="btn-group " role="group" aria-label="group button">
                                          <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal"  role="button">Close</button>
                                          </div>
                                          <div class="btn-group" role="group">
                                             <a type = "button" href="{{ route('customers.edit',$customerDetailsrow->Cust_ID) }}" class = "btn   btn-success btn-simple">
                                                Edit Details
                                              </a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <a type = "button" href="{{ route('customersTradeAgreement.show',$customerDetailsrow->Cust_ID) }}" class = "btn btn-sm Inbox btn-just-icon" rel="tooltip" title="ADD TRADE AGREEMENT" >
                                 <i class="material-icons">add_circle</i>
                                </a>
                                <a type="button" href="{{ route('addcustaccount',$customerDetailsrow->Cust_ID)}}" class="btn btn-just-icon twitch" rel="tooltip" title="Add To Customer Account" href="/create_account"> <i class="material-icons">add</i></a>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
                <!-- /.col -->

              </div>
            </div>
          </div>
        </div>
        <!-- End Tabs with icons on Card -->
      </div>
    </div>
  </div>
</div>



  <!-- CREATE ACCOUNT MODAL -->

  <!-- Modal Core -->
    <div class="modal fade" id="createaccount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel" class="text-center">CREATEEEEs ACCOUNT</h4>
          </div>
          <div class="modal-body">
            <div class="">
              <div class="row">
                <div class="col-xs-6">
                  <div class="form-group label-floating">
                    <label class="control-label">Username:</label>
                    <input type="email" class="form-control">
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="form-group label-floating">
                    <label class="control-label">Email:</label>
                    <input type="email" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-6">
                  <div class="form-group label-floating">
                    <label class="control-label">Password:</label>
                    <input type="email" class="form-control">
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="form-group label-floating">
                    <label class="control-label">Confirm Password:</label>
                    <input type="email" class="form-control">
                  </div>
                </div>
              </div>
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
<script type = "text/javascript">
$(function () {
  $("#withaccts").DataTable({
    "lengthMenu": [3, 5, 10, 15, 20],
    "pageLength": 5
    });

    $("#Noaccts").DataTable({
      "lengthMenu": [3, 5, 10, 15, 20],
      "pageLength": 5
      });
  });

</script>
<script type = "text/javascript">
      $(document).ready(function(){
        $("#TownField").attr("disabled", true);

        $("#custTypeField").change(function(){

          if($('#custTypeField').val() == 'H') {
              $("#hotelnameDiv").slideDown();
              $("#HotelNameField").attr('required', true);
              $("#shopnameDiv").slideUp();
              $("#ShopNameField").attr('required', false);
            }

          else if ($('#custTypeField').val() == 'S'){
              $("#hotelnameDiv").slideUp();
              $("#HotelNameField").attr('required', false);
              $("#shopnameDiv").slideDown();
              $("#ShopNameField").attr('required', true);

            }
          else {
              $("#hotelnameDiv").slideUp();
              $("#shopnameDiv").slideUp();
              $("#HotelNameField").attr('required', false);
              $("#ShopNameField").attr('required', false);

            }
        });//end of function


        $("#custTypeField2").change(function(){
          var clearValue = " ";
              $("#HotelNameField2").val(clearValue);
              $("#ShopNameField2").val(clearValue);


          if($('#custTypeField2').val() == 'H') {
              $("#hotelnameDiv2").slideDown();
              $("#HotelNameField2").attr('required', true);
              $("#HotelNameField2").val(' ');
              $("#shopnameDiv2").slideUp();
              $("#ShopNameField2").attr('required', false);
              $("#ShopNameField2").val(' ');

            }
          else if ($('#custTypeField2').val() == 'S'){
              $("#hotelnameDiv2").slideUp();
              $("#HotelNameField2").attr('required', false);
              $("#hotelnameDiv2").val(' ');
              $("#shopnameDiv2").slideDown();
              $("#ShopNameField2").attr('required', true);
              $("#ShopNameField2").val(' ');

            }
          else {
              $("#hotelnameDiv2").slideUp();
              $("#shopnameDiv2").slideUp();
              $("#hotelnameDiv2").attr('required', false);
              $("#hotelnameDiv2").val(' ');
              $("#shopnameDiv2").attr('required', false);
              $("#shopnameDiv2").val(' ');
            }
        });//end of function

        $('#ProvinceField').change(function(){
          $("#TownField").removeAttr("disabled");
          $("#TownField").attr('required', true);
                  var selected = $(this).val();
                  $("#TownField option").each(function(item){
                   // console.log(selected) ;
                    var element =  $(this) ;
                    //console.log(element.data("tag")) ;
                    if (element.data("tag") != selected){
                      element.hide() ;
                    }
                    else{
                      element.show();
                    }
                  }) ;

                $("#TownField").val($("#TownField option:visible:first").val());

        });//end of function

        if ( {{ session()->get('user_signup')}} == '1'){

          swal({title: "Customer Account is not created",
          text:"Email is existing. Please edit the Customer Email Before this Customer will have account", type: "error"},
          function(){

            {{ session()->forget('user_signup')}};

          }

          );



        }
        else{
          swal({title: "Good job!", text:"Customer account is created", type: "success"},
          function(){
            {{ session()->forget('user_signup')}};
          });
        }
      });

    </script>
@endsection
