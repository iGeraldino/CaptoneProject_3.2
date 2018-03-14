@extends('customer_side_main')
@section('title', 'Edit Account')
@section('css')
    <link href="_CSS/design.css" rel="stylesheet">
    <link href="_CSS/register1.css" rel="stylesheet">
@endsection
@section('content')

<?php
  $newOrderSuccess = Session::get('orderSuccessful');
  Session::remove('orderSuccessful');
?>

	<div class="container" style="margin-top: 80px;">

    <input type = "text" id = "orderSuccessSession" value = "{{$newOrderSuccess}}" hidden>
        <div class="row">
            @foreach($details as $details)

            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked admin-menu" id="myTab">
                    <li id="profiles" class="active"><a href="#profile" data-target-id="profile"><i class="glyphicon glyphicon-user"></i> Profile</a></li>
                    <li id="order"><a href="#orders" data-target-id="orders"><i class="glyphicon glyphicon-log-out"></i> Orders</a></li>
                    <li><a href="#change-password" data-target-id="change-password"><i class="glyphicon glyphicon-lock"></i> Change Password</a></li>
                </ul>
            </div>

            <div class="col-md-9  admin-content" id="profile">
                <div class="panel panel-info" style="margin: 1em;">
                    <div class="panel-heading">
                        <h3 class="panel-title">Personal Information <a href="button" class="btn btn-default btn-sm col-md-offset-8" data-toggle="modal" data-target="#edit">Edit account</a></h3>
                    </div>
                    <div class="panel-body">
                        <div class="container">
                        	<div class="row">
                        		<div class="col-md-8">
						            <form role="form">
						                <h5 class="text-center fontx">My Personal Information</h5>
						                <hr class="colorgraph">
						                <div class="row">
						                	<div class="col-xs-12 col-sm-4 col-md-4" >
						                    	<div class="form-group">
						                      		<input type="text" name="fname" id="first_name" class="form-control input-lg" placeholder="First Name" tabindex="1" disabled="true" value="{{ $details -> Cust_FName }}">
						                    	</div>
						                  	</div>
						                  	<div class="col-xs-12 col-sm-4 col-md-4">
							                    <div class="form-group">
							                      	<input type="text" name="mname" id="middle_name" class="form-control input-lg" placeholder="Middle Name" tabindex="2" disabled="true" value="{{ $details -> Cust_MName }}">
							                    </div>
						                    </div>
						                    <div class="col-xs-12 col-sm-4 col-md-4">
						                    	 <div class="form-group">
						                      		<input type="text" name="lname" id="last_name" class="form-control input-lg" placeholder="Last Name" tabindex="3" disabled="true" value="{{ $details -> Cust_LName }}">
						                    	</div>
						                    </div>
						                	<div class="col-xs-12 col-sm-6 col-md-6">
						                    	<div class="form-group">
						                      		<input type="contact" name="contact" id="contact" class="form-control input-lg" placeholder="Contact Number" tabindex="7" disabled="true" value="{{ $details -> Contact_Num }}">
						                    	</div>
						                    </div>
						                  	<div class="col-xs-12 col-sm-6 col-md-6">
						                    	<div class="form-group">
						                      		<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="6" disabled="true" value="{{ $details -> Email_Address }}">
						                    	</div>
						                    </div>
						                 </div>
						            </form>
						        </div>
                        	</div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-info" style="margin: 1em;">
                    <div class="panel-heading">
                        <h3 class="panel-title">Billing Address</h3>
                    </div>
                    <div class="panel-body">
                        <div class="container">
                        	<div class="row">
                        		<div class="col-md-8">
						            <form role="form">
						                <h5 class="text-center fontx">Billing Address</h5>
						                <hr class="colorgraph">
						                <div class="row">
						                	<div class="col-xs-12 col-sm-6 col-md-6">
						                    	<div class="form-group">
						                      		<input type="text" name="addr_line" id="addr_line" class="form-control input-lg" placeholder="House No./Street Name" tabindex="2" disabled="true" value="{{ $details -> Address_Line }}">
						                    	</div>
						                    </div>
						                  	<div class="col-xs-12 col-sm-6 col-md-6">
						                    	<div class="form-group">
						                      		<input type="text" name="brgy" id="brgy" class="form-control input-lg" placeholder="Baranggay" tabindex="3" disabled="true" value="{{ $details -> Baranggay }}">
						                    	</div>
						                    </div>
                                <div hidden>
                                  <input id = "prov_ID" name = "prov_ID" value = "{{ $details -> Province }}">
                                  <input id = "town_ID" name = "town_ID" value = "{{ $details -> Town }}">
                                  <select class="form-control" name ="ProvinceField_Search" id ="ProvinceField_Search" disabled="true">
                                    @foreach($province as $prov2)
                                      <option value ="{{$prov2->id}}" data-tag = "{{$prov2->name}}"> {{$prov2->name}} </option>
                                    @endforeach
                                  </select>

                                  <select name="TownField_Search" id="TownField_Search" class="form-control" disabled="true">
                                    @foreach($cities as $cities2)
                                      <option value ="{{$cities2->id}}" data-tag = "{{$cities2->name}}"> {{$cities2->name}} </option>
                                    @endforeach
                                  </select>
                                </div>
						                    <div class="col-xs-12 col-sm-6 col-md-6">
						                    	<div class="form-group">
                                    <input type="text" name="TownField" id="TownField" class="form-control input-lg" placeholder="City" tabindex="2" disabled="true">
						                    	</div>
						                    </div>
						                  	<div class="col-xs-12 col-sm-6 col-md-6">
						                    	<div class="form-group">
                                    <input type="text" name="ProvinceField" id="ProvinceField" class="form-control input-lg" placeholder="Province" tabindex="2" disabled="true">
						                    	</div>
						                    </div>
						                </div>
						            </form>
						        </div>
                        	</div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-info" style="margin: 1em;">
                    <div class="panel-heading">
                        <h3 class="panel-title">Shipping Address</h3>
                    </div>
                    <div class="panel-body">
                        <div class="container">
                        	<div class="row">
                        		<div class="col-md-8">
						            <form role="form">
						                <h5 class="text-center fontx">Shipping Address</h5>
						                <hr class="colorgraph">
						                <div class="row">
						                	<div class="col-xs-12 col-sm-6 col-md-6">
						                    	<div class="form-group">
						                      		<input type="text" name="addr_line" id="addr_line" class="form-control input-lg" placeholder="House No./Street Name" tabindex="2" disabled="true" value="{{ $details -> Address_Line }}">
						                    	</div>
						                    </div>
						                  	<div class="col-xs-12 col-sm-6 col-md-6">
						                    	<div class="form-group">
						                      		<input type="text" name="brgy" id="brgy" class="form-control input-lg" placeholder="Baranggay" tabindex="3" disabled="true" value="{{ $details -> Baranggay }}">
						                    	</div>
						                    </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                  <div class="form-group">
                                    <input type="text" name="TownField2" id="TownField2" class="form-control input-lg" placeholder="City" tabindex="2" disabled="true">
                                  </div>
                                </div>
						                    <div class="col-xs-12 col-sm-6 col-md-6">
						                    	<div class="form-group">
						                      		<input type="text" name="ProvinceField2" id="ProvinceField2" class="form-control input-lg" placeholder="Province" tabindex="2" disabled="true">
						                    	</div>
						                    </div>
						                </div>
						            </form>
						        </div>
                        	</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9  admin-content" id="orders">
            	<div class="panel panel-info" style="margin: 1em;">
                    <div class="panel-heading">
                        <h3 class="panel-title">List Of Orders</h3>
                    </div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box">
                                  <div class="box-header" id="latest">

                                  <h3 class="box-title text-center" > Latest Order </h3>

                                  <div class="box-body table-responsive no-padding">
                                      <table id = "" class="table table-hover">
                                          <thead class="text-center">
                                          <tr>
                                              <th width="12%" class="text-center">Order Id</th>
                                              <th width="25%" class="text-center">Total Amount</th>
                                              <th width="10%" class="text-center">Action</th>

                                          </tr>
                                          </thead>
                                          <tbody>
                                          @foreach($latestorder as $latest)
                                          <tr class="text-center">

                                              <td>{{ $latest -> Order_ID }}</td>
                                              <td>Php. {{ number_format($latest -> Total_Amt,2) }}</td>
                                              <td> <a class="btn btn-primary" id="latestbutt" href="{{ route('printsummary', ['id' => $latest -> Order_ID])}}"> Print </a></td>

                                          </tr>
                                          @endforeach
                                          </tbody>
                                      </table>
                                  </div>


                                  </div>

                                    <div class="box-header" id="past">

                                    <h3 class="box-title text-center" >Past Orders</h3>


                                    <!-- /.box-header -->

                                    <div class="box-body table-responsive no-padding">
                                        <table id = "orderTbl" class="table table-hover">
                                            <thead class="text-center">
                                            <tr>
                                                <th width="12%" class="text-center">Order Id</th>
                                                <th width="25%" class="text-center">Total Amount</th>
                                                <th class="text-center">Payment Mode</th>
                                                <th class="text-center">Shipping Method</th>
                                                <th width="20%" class="text-center">Created At</th>
                                                <th width="10%" class="text-center">Status</th>
                                                <th width="10%" class="text-center"> Action </th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($pastorder as $past)
                                            <tr class="text-center">

                                                <td>{{ $past -> Order_ID }}</td>
                                                <td>Php. {{ number_format( $past -> Total_Amt,2) }}</td>
                                                <td>{{ $past -> Payment_Mode }}</td>
                                                <td>{{ $past -> shipping_method }}</td>
                                                <td> {{ $past -> created_at }}</td>
                                                <td>

                                                    @if ( strtoupper($past -> Status) == "PENDING" )

                                                        <span class="btn btn-md btn-warning"> Pending </span>

                                                        @elseif ( strToupper($past -> Status) == "CLOSED")

                                                        <span class="btn btn-md btn-success"> Closed </span>

                                                        @elseif ( strtoupper($past-> Status) == "P_FULL")

                                                        <span class="btn btn-md btn-primary"> Paid Full </span>

                                                        @elseif ( strToUpper($past-> Status) == "P_PARTIAL")

                                                        <span class="btn btn-md btn-info"> Paid Partial </span>

                                                        @elseif ( strToUpper($past-> Status) == "CANCELLED")

                                                        <span class="btn btn-md btn-danger"> Cancelled </span>

                                                        @elseif ( strToUpper($past-> Status) == "A_P_PARTIAL")

                                                        <span class="btn btn-md btn-warning"> Acquired Paid Partial </span>

                                                    @endif

                                                </td>
                                                <td> <a class="btn btn-primary" href="{{ route('printsummary', ['id' => $past -> Order_ID])}}"> Print </a></td>

                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.box-body -->
                                    </div>
                                </div>
                                <!-- /.box -->
                            </div>
                        </div>



		                    <a href="{{ route('customer_side.pages.flower') }}"  class="btn btn-primary btn-lg col-md-4 col-md-offset-4 text-center"> Start Shopping Now</a>

                    </div>
                </div>
            </div>
            <div class="col-md-9  admin-content" id="change-password">
                <div class="container">
                	<div class="row">
                		<div class="col-md-8">
				            <form role="form" method="post" action="{{ route('changepassword') }}">
				                <h5 class="text-center fontx">Edit Password</h5>
				                <hr class="colorgraph">
				                <div class="row">
				                	<div class="col-xs-12 col-sm-6 col-md-6">
				                    	<div class="form-group">
				                      		<input type="password" name="oldpassword" id="password" class="form-control input-lg" placeholder="Current Password" tabindex="4">
                                            <span style="color:red">{{ $errors->first('oldpassword') }}</span>
                                        </div>
				                    </div>
				                </div>
				                <div class="row">
				                  	<div class="col-xs-12 col-sm-6 col-md-6">
				                    	<div class="form-group">
				                      		<input type="password" name="newpassword" id="password" class="form-control input-lg" placeholder="New Password" tabindex="4">
				                    	    <span style="color:red">{{ $errors->first('newpassword') }}</span>
                                        </div>
				                    </div>

				                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                           <button class="btn btn-info" type="submit"> Submit </button>
                                        </div>
                                    </div>
                                </div>
                                {{ csrf_field() }}
				            </form>
				        </div>
                	</div>
                </div>
            </div>

            @endforeach
        </div>
	</div>


	<!-- MODAL -->
	<!-- Modal -->
	<div id="edit" class="modal fade" role="dialog">
	  	<div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Edit Account</h4>
	      </div>
	      <div class="modal-body">
	        <!-- CREATE -->

        <div class="container">
          <div class="row">
              <div class="col-md-6">
                  {!! Form::model($details, ['route'=>['posteditaccount', 'id' => $details->Cust_ID], 'method'=>'PUT'])!!}
                  <h4 class="text-center fontx">Edit Account</h4>
                <hr class="colorgraph">
                <div class="row">
                  <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="form-group">
                      <input type="text" name="fname" id="first_name" class="form-control input-lg" placeholder="First Name" tabindex="1" value="{{$details -> Cust_FName}}">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="form-group">
                      <input type="text" name="mname" id="middle_name" class="form-control input-lg" placeholder="Middle Name" tabindex="2" value="{{ $details -> Cust_MName}}">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="form-group">
                      <input type="text" name="lname" id="last_name" class="form-control input-lg" placeholder="Last Name" tabindex="3" value="{{ $details -> Cust_LName}}">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <input type="contact" name="contact" id="contact" class="form-control input-lg" placeholder="Contact Number" tabindex="7" value="{{ $details -> Contact_Num }}">
                </div>

                <div class="row">
                  <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                      <input type="text" name="addr_line" id="addr_line" class="form-control input-lg" placeholder="House No./Street Name" tabindex="2" value="{{ $details -> Address_Line }}">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                      <input type="text" name="brgy" id="brgy" class="form-control input-lg" placeholder="Baranggay" tabindex="3" value="{{ $details -> Baranggay}}">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                      <select name="Prov" id="Prov" class="form-control input-lg" tabindex="5" required>
                        <option value = "-1" data-tag = "-1" disabled selected> Choose Province</option>
                        @foreach($province as $prov)
                          <option   value ="{{$prov->id}}" > {{$prov->name}} </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                      <select name="Town" id="Town" class="form-control input-lg" tabindex="6" required>
                          <option value = "-1" data-tag = "-1" disabled selected> Choose City</option>
                          @foreach($cities as $city)
                            <option value ="{{$city->id}}" data-tag = "{{$city->province_id}}"> {{$city->name}} </option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                @foreach($account as $account)
                <div class="form-group">
                  <input type="email" name="email" id="email2" class="form-control input-lg" placeholder="Change Email Address" tabindex="6" value="{{ $account -> email }}">
                </div>
                <div class="form-group">
                  <input type="text" name="username" id="display_name" class="form-control input-lg" placeholder="New Username" tabindex="4" value="{{ $account -> username}}">
                </div>
                @endforeach
                <div class="modal-footer">
                  <button type="submit" id="savebutt" class="btn btn-success">Save</button>
                  <a type="button" class="btn btn-default" data-dismiss="modal">Close</a>
                </div>
                  {!! Form::close() !!}

              </div>
          </div>

        </div>
        <!-- CREATE END -->

	      </div>

	    </div>

	  </div>
	</div>

@endsection

@section('script')
<script type="text/javascript">

  $(function () {
    $('#orderTbl').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "order" : [[3, "asc"]],
      "info": true,
      "autoWidth": false,
      "lengthMenu" : [5,10,15,20],
      "pageLength" : 5
    });
  });
</script>
	<script type="text/javascript">

      $(document).ready(function()
      {
        var Acct_ProvID = $('#prov_ID').val();
        var Acct_TownID = $('#town_ID').val();
//for setting the province and the city's select tag into the id that were obtained from the database---------------------
      $('#prov option').each(function(item){
          var element = $(this);
          if(element.val() == Acct_ProvID){
            $(this).parent().val($(this).val());
          }
      });

      $('#Town option').each(function(item){
          var element = $(this);
          if(element.val() == Acct_TownID){
            $(this).parent().val($(this).val());
          }
      });


//for getting the name of the province and town---------------------------------------------------------------------------

        var Prov_Name = "";
        var Town_Name = "";

        $("#ProvinceField_Search option").each(function(item){
          var element =  $(this) ;
          if (element.val() != Acct_ProvID){
            //element.hide() ;
          }
          else{
            Prov_Name = element.data("tag");
          }
        });//end of function

        $("#TownField_Search option").each(function(item){
          var element =  $(this) ;
          if (element.val() != Acct_TownID ){
            //element.hide() ;
          }
          else{
            Town_Name = element.data("tag");
          }
        });//end of function\

        $("#TownField").val(Town_Name);
        $("#ProvinceField").val(Prov_Name);
        $("#ProvinceField2").val(Prov_Name);
        $("#TownField2").val(Town_Name);

          $("#Town").attr('disabled',true);

        $('#Prov').change(function(){
          $("#Town").removeAttr("disabled");
          $("#Town").attr('required', true);
                  var selected = $(this).val();
                  $("#Town option").each(function(item){
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

                $("#Town").val($("#Town option:visible:first").val());


        });//end of function


        var navItems = $('.admin-menu li > a');
        var navListItems = $('.admin-menu li');
        var allWells = $('.admin-content');
        var allWellsExceptFirst = $('.admin-content:not(:first)');
        allWellsExceptFirst.hide();
        navItems.click(function(e)
        {
            e.preventDefault();
            navListItems.removeClass('active');
            $(this).closest('li').addClass('active');
            allWells.hide();
            var target = $(this).attr('data-target-id');
            $('#' + target).show();
          });

          var orderid = 0{{ Session::get('orderid') }};



        if (orderid == 0){

          $('#latest').hide();

        }

        else{


          $('#past').hide();

          $( "#order" ).addClass( "active" );

          $('#profiles').removeClass('active');
            allWells.hide();
          $('#orders').show();

        }

        $('#latestbutt').click(function(){

          $('#past').hide();
          location.reload();

        });

        if($("#orderSuccessSession").val() == 'Successful'){
          swal("Order was Successfully Sent!","You have successfully sent your Order to our shop pleae wait for a call or text from our employee regarding your order,Thank you God bless","success");
        }





        }); // Document Function


	</script>

@endsection
