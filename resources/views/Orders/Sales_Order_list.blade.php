
@extends('main')

@section('content')

    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h2> List of unconfirmed Orders</h2>
      <div class="col-md-8">
      <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#newCust"><i class="material-icons ">note_add</i>
        Create New Order
      </button>
      <br>
   <br>

    <!-- line modal -->
    <div class="modal fade" id="newCust" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
          <h3 class="modal-title" id="lineModalLabel">Create New Customer Record</h3>
        </div>

      <!--form open here-->
  {!! Form::open(array('route' => 'Sales_Qoutation.store', 'data-parsley-validate'=>'', 'method'=>'POST')) !!}
       {{ csrf_field() }}
        <div class="modal-body">
                <!-- content goes here -->
              <div class = 'row'>
                <div class="togglebutton col-md-6">
                  <label>
                    <input type="checkbox" id = 'OnetimecheckBox' name="OnetimecheckBox">
                    One Time Customer?
                  </label>
                </div>
                <div class="togglebutton col-md-6">
                  <label>
                    <input type="checkbox" id = 'QuickTransCheckBox' name="QuickTransCheckBox">
                    Quick Transaction?
                  </label>
                </div>
              </div>

                 <div hidden>
                 <input id = "Trans_typeField" name = "Trans_typeField" value = 'process' />
                 <input id = "customer_stat" name = "customer_stat" value = 'old' />
                 <input id = "current_Date" name = "current_Date" type = "date" />
                 <input id = "current_Time" name = "current_Time" type = "time" />
                </div>
                <div id = 'Customer_Chooser'>
                  <select id = 'customerList_ID' name = 'customerList_ID' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
                    <option value = '-1' selected disabled>Choose a Customer</option>
                    @foreach($cust as $Clist)
                      <option value = '{{$Clist->Cust_ID}}'> CUST-{{$Clist->Cust_ID}} ({{$Clist->Cust_FName}} {{$Clist->Cust_MName}} {{$Clist->Cust_LName}}) </option>
                    @endforeach
                  </select>
                </div>

                <div id = 'Customer_FNameDiv' hidden>
                  <select id = 'customerList_FName' name = 'customerList_FName' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
                    @foreach($cust as $Cdetails)
                      <option value = '{{$Cdetails->Cust_FName}}' data-tag ='{{$Cdetails->Cust_ID}}'>
                      {{$Cdetails->Cust_FName}}
                      </option>
                    @endforeach
                  </select>
                </div>

                <div id = 'Customer_MNameDiv' hidden>
                  <select id = 'customerList_MName' name = 'customerList_MName' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
                    @foreach($cust as $Cdetails)
                      <option value = '{{$Cdetails->Cust_MName}}' data-tag ='{{$Cdetails->Cust_ID}}'>
                      {{$Cdetails->Cust_MName}}
                      </option>
                    @endforeach
                  </select>
                </div>

                <div id = 'Customer_LNameDiv' hidden>
                  <select id = 'customerList_LName' name = 'customerList_LName' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
                    @foreach($cust as $Cdetails)
                      <option value = '{{$Cdetails->Cust_LName}}' data-tag ='{{$Cdetails->Cust_ID}}'>
                      {{$Cdetails->Cust_LName}}
                      </option>
                    @endforeach
                  </select>
                </div>

                <div id = 'Contact_NumDiv' hidden>
                  <select id = 'Contact_NumList_LName' name = 'Contact_NumList_LName' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
                    @foreach($cust as $Cdetails)
                      <option value = '{{$Cdetails->Contact_Num}}' data-tag ='{{$Cdetails->Cust_ID}}'>
                       {{$Cdetails->Contact_Num}}
                      </option>
                    @endforeach
                  </select>
                </div>

                <div id = 'type_Div' hidden>
                  <select id = 'TypeList' name = 'TypeList' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
                    @foreach($cust as $Cdetails)
                      <option value = '{{$Cdetails->Customer_Type}}' data-tag ='{{$Cdetails->Cust_ID}}'>
                       {{$Cdetails->Customer_Type}}
                      </option>
                    @endforeach
                  </select>
                </div>

                <div id = 'Email_AddDiv' hidden>
                  <select id = 'Email_AddList_LName' name = 'Email_AddList_LName' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
                    @foreach($cust as $Cdetails)
                      <option value = '{{$Cdetails->Email_Address}}' data-tag ='{{$Cdetails->Cust_ID}}'>
                       {{$Cdetails->Email_Address}}
                      </option>
                    @endforeach
                  </select>
                </div>

                <div id = 'AdressLine_Div' hidden>
                  <select id = 'AdressLineList' name = 'AdressLineList' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
                    @foreach($cust as $Cdetails)
                      <option value = '{{$Cdetails->Address_Line}}' data-tag ='{{$Cdetails->Cust_ID}}'>
                       {{$Cdetails->Address_Line}}
                      </option>
                    @endforeach
                  </select>

                  <select id = 'HotelNameList' name = 'HotelNameList' class = 'btn btn-primary btn-md'>
                    @foreach($cust as $Cdetails)
                      <option value = '{{$Cdetails->Hotel_Name}}' data-tag ='{{$Cdetails->Cust_ID}}'>
                       {{$Cdetails->Hotel_Name}}
                      </option>
                    @endforeach
                  </select>

                  <select id = 'ShopNameList' name = 'ShopNameList' class = 'btn btn-primary btn-md'>
                    @foreach($cust as $Cdetails)
                      <option value = '{{$Cdetails->Shop_Name}}' data-tag ='{{$Cdetails->Cust_ID}}'>
                       {{$Cdetails->Shop_Name}}
                      </option>
                    @endforeach
                  </select>

                  <select id = 'BrgyList' name = 'BrgyList' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
                    @foreach($cust as $Cdetails)
                      <option value = '{{$Cdetails->Baranggay}}' data-tag ='{{$Cdetails->Cust_ID}}'>
                       {{$Cdetails->Baranggay}}
                      </option>
                    @endforeach
                  </select>

                <div class = 'col-md-6'>
                  <select class="form-control" name ="ProvField" id ="ProvField" >
                    @foreach($cust as $Cdetails)
                      <option value ="{{$Cdetails->Province}}" data-tag = "{{$Cdetails->Cust_ID}}"> {{$Cdetails->Province}} </option>
                    @endforeach
                  </select>
                </div>

                <div class = 'col-md-6'>
                  <select name="CityField" id="CityField" class="form-control" disabled>
                    @foreach($cust as $Cdetails)
                      <option value ="{{$Cdetails->Town}}" data-tag = "{{$Cdetails->Cust_ID}}"> {{$Cdetails->Town}} </option>
                    @endforeach
                  </select>
                </div>
                </div>



                <div hidden>
                  <input id = 'idfield' name = 'idfield' class = 'form-control'>
                </div>

              <div class = "row">
                  <div class="col-sm-4">
                    <div  id = "Fnamedisplaydiv" class="form-group label-floating">
                      <label class="control-label">First Name</label>
                      <input type="text" class="form-control" name="Cust_FNameField" id="Cust_FNameField" disabled required/>
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div id = "Mnamedisplaydiv" class="form-group label-floating">
                      <label class="control-label">Middle Name</label>
                      <input type="text" class="form-control" name="Cust_MNameField" id="Cust_MNameField"/>
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div id = "Lnamedisplaydiv" class="form-group label-floating">
                      <label class="control-label">Last Name</label>
                      <input type="text" class="form-control" name="Cust_LNameField" id="Cust_LNameField" disabled required/>
                    </div>
                  </div>
              </div>

              <div class = "row">
                <div class="col-sm-4">
                    <div id = "Contactdisplaydiv" class="form-group label-floating">
                      <label class="control-label">Contact Number</label>
                      <input type="text" class="form-control" name="ContactNum_Field" id="ContactNum_Field" required/>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div id = "emailDisplayDiv" class="form-group label-floating">
                      <label class="control-label">Email Address</label>
                      <input type="text" class="form-control" name="email_Field" id="email_Field"  required/>
                    </div>
                </div>

                <div class="form-group col-sm-4">
                    <label class="control-label">Customer Type:</label>
                      <select class="form-control" names ="custTypeField" id ="custTypeField">
                          <option value ="C" > Single </option>
                          <option value ="S" > Shop </option>
                          <option value ="H" > Hotel </option>
                      </select>
                </div><!--end of row-->

              <div id = "HotelNamedisplaydiv" class = "row" hidden>
                <div  class="form-group col-md-7">
                      <label class="control-label">Hotel Name</label>
                      <input type="text" class="form-control" name="hotelNameField" id="hotelNameField" disabled/>
                </div>
              </div>

              <div id = "ShopNamedisplaydiv" class = "row" hidden>
                <div  class="form-group col-md-7">
                      <label class="control-label">Shop Name</label>
                      <input type="text" class="form-control" name="shopNameField" id="shopNameField" disabled/>
                </div>
              </div>

              <div class = "row">
                <div class="col-sm-7">
                    <div id = "AdrLinedisplaydiv" class="form-group label-floating">
                      <label class="control-label">Address line</label>
                      <input type="text" class="form-control" name="Addrs_LineField" id="Addrs_LineField" required/>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div id = "Brgydisplaydiv" class="form-group label-floating">
                      <label class="control-label">Baranggay</label>
                      <input type="text" class="form-control" name="brgyField" id="brgyField" required/>
                    </div>
                </div>
              </div><!--end of row-->


              <div class = "row">
                <div class = 'col-md-6'>
                  <select class="form-control" name ="ProvinceField" id ="ProvinceField">
                    @foreach($province as $prov)
                      <option value ="{{$prov->id}}" data-tag = "{{$prov->name}}"> {{$prov->name}} </option>
                    @endforeach
                  </select>
                </div>

                <div class = 'col-md-6'>
                  <select name="TownField" id="TownField" class="form-control" disabled>
                    @foreach($city as $city)
                      <option value ="{{$city->id}}" data-tag = "{{$city->province_id}}"> {{$city->name}} </option>
                    @endforeach
                  </select>
                </div>

                <div class = 'col-md-6' hidden>
                  <select name="TownField2" id="TownField2" class="form-control">
                    @foreach($city2 as $city2)
                      <option value ="{{$city2->id}}" data-tag = "{{$city2->province_id}}"> {{$city2->name}} </option>
                    @endforeach
                  </select>
                </div>

              </div><!--end of row-->

        </div>
        <br>
        <br>
        <div class="modal-footer">
          <div class="btn-group" role="group" aria-label="group button">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal"  role="button">Close</button>
            </div>
            <div class="btn-group" role="group">
               <button type = "submit" name = "AddBtn" class = "btn btn-success btn-simple"><span class = "glyphicon glyphicon-floppy-save"></span> Save and Proceed</button>

            </div>
          </div>
        </div>
          {!! Form::close() !!}
       <!--Form close here-->
      </div>
      </div>
    </div>
  </section>





        <div class="col-xs-12">
          <div class="box">

            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead style = 'color:darkviolet;'>
                    <th> Order ID </th>
                    <th> Customer_Name </th>
                    <th> Date Created</th>
                    <th> Status</th>
                    <th> Action </th>
                </thead>

                <tbody>


                    @foreach($orders as $Olist)
                    <tr>
                        <td> {{$Olist->sales_order_ID}}   </td>
                        <td> {{$Olist->Customer_Fname}} {{$Olist->Customer_MName}}., {{$Olist->Customer_LName}} </td>
                        <td> <b>{{date_format(date_create($Olist->created_at),"M d, Y")}}</b> @ <b>{{date_format(date_create($Olist->created_at),"h:i a")}}</b> </td>
                        <td>  {{$Olist->Status}} </td>
                        <td align="center" >


                               <a id = "manageBtn" type = "button" class = "btn btn-primary btn-sm" ><span class = "glyphicon glyphicon-pencil"></span>
                                Manage Order
                               </a>


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



  </div>
@endsection


@section('scripts')
    <script>
      $(document).ready(function(){

        $('#manageBtn').click(function(){
          swal("Sorry :( ","this function is currently under development","info")
        });

        var date = new Date();
        var currentDate = date.toISOString().slice(0,10);
        var currentTime = date.getHours() + ':' + date.getMinutes();
        var newcust = 'old';
        document.getElementById('current_Date').value = currentDate;
        document.getElementById('current_Time').value = currentTime;

        $("#Cust_FNameField").attr('disabled',true);
        $("#Cust_MNameField").attr('disabled',true);
        $("#Cust_LNameField").attr('disabled',true);
        $("#ContactNum_Field").attr('disabled',true);
        $("#email_Field").attr('disabled',true);
        $('#HotelNamedisplaydiv').attr('disabled',true);
        $('#ShopNamedisplaydiv').attr('disabled',true);
        $("#custTypeField").attr('disabled',true);

        $('#OnetimecheckBox').click(function(){

          if($('#OnetimecheckBox').is(':checked') == true){

              swal("take note: ","You will now be required to Enter information about a new customer","warning");
            $('#Customer_Chooser').slideUp(300);
            newcust = 'new';
              $('#customer_stat').val(newcust);
              $("#Cust_FNameField").attr('disabled',false);
              $("#Cust_MNameField").attr('disabled',false);
              $("#Cust_LNameField").attr('disabled',false);
              $("#ContactNum_Field").attr('disabled',false);
              $("#email_Field").attr('disabled',false);
              $("#ProvinceField").attr('disabled',false);
              $("#custTypeField").attr('disabled',false);

              $("#custTypeField option[value ='C']").prop('selected',true);
              $("#custTypeField").attr('disabled',true);

              $('#HotelNamedisplaydiv').slideUp();
              $('#ShopNamedisplaydiv').slideUp();

              $("#idfield").val(' ');
              $("#Cust_FNameField").val(' ');
              $("#Cust_MNameField").val(' ');
              $("#Cust_LNameField").val(' ');
              $("#ContactNum_Field").val(' ');
              $("#email_Field").val(' ');
              $("#Addrs_LineField").val(' ');
              $("#brgyField").val(' ');

              $("#Cust_FNameField").attr('required',true);
              $("#Cust_LNameField").attr('required',true);
              $("#ContactNum_Field").attr('required',true);
              $("#email_Field").attr('required',true);
           }
           else{
             $('#Customer_Chooser').slideDown(300);
              newcust = 'old';
              $('#customer_stat').val(newcust);
              $("#Cust_FNameField").attr('disabled',true);
              $("#Cust_MNameField").attr('disabled',true);
              $("#Cust_LNameField").attr('disabled',true);
              $("#ContactNum_Field").attr('disabled',true);
              $("#email_Field").attr('disabled',true);
              $('#HotelNamedisplaydiv').attr('disabled',true);
              $('#ShopNamedisplaydiv').attr('disabled',true);
              $("#custTypeField").attr('disabled',true);

              swal("take note: ","You may choose from the existing customers in the system","info");
           }
        });
        //end of functionx

      $('#QuickTransCheckBox').click(function(){
          if($('#QuickTransCheckBox').is(':checked') == true){
            $('#Trans_typeField').val('quick');
            swal("take note: ","by turning on the quick transaction, you be will forced you to pick ony the flowers that are available in the system right now, and will require you to finish the transaction right now","warning");
           }
           else{
            $('#Trans_typeField').val('process');
            swal("take note: ","You have turned off the quick transaction, you can oreder flowers that are not available right now in the system but other conditions may occur","info");
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
            var OptionAddrLine;
            var OptionBrgyLine;
            var OptionProvLine;
            var OptionCityLine;
            var OptionTypeLine;
            var OptionHotelnameLine;
            var OptionShopnameLine;

//this is for outputing the values of fields so that the labels ae not overlapping to the values
            $('#Fnamedisplaydiv').removeClass("form-group label-floating");
            $('#Fnamedisplaydiv').addClass("form-group");
            $('#Mnamedisplaydiv').removeClass("form-group label-floating");
            $('#Mnamedisplaydiv').addClass("form-group");
            $('#Lnamedisplaydiv').removeClass("form-group label-floating");
            $('#Lnamedisplaydiv').addClass("form-group");
            $('#AdrLinedisplaydiv').removeClass("form-group label-floating");
            $('#AdrLinedisplaydiv').addClass("form-group");
            $('#Brgydisplaydiv').removeClass("form-group label-floating");
            $('#Brgydisplaydiv').addClass("form-group");
            $('#Contactdisplaydiv').removeClass("form-group label-floating");
            $('#Contactdisplaydiv').addClass("form-group");
            $('#emailDisplayDiv').removeClass("form-group label-floating");
            $('#emailDisplayDiv').addClass("form-group");


            $("#ShopNameList option").each(function(item){
              var element =  $(this) ;
              if (element.data("tag") != selected){
                //element.hide() ;
              }
              else{
               OptionShopnameLine = element.val();

                //element.show();
                console.log(OptionTypeLine)
              }
            });//end of function

            $("#HotelNameList option").each(function(item){
              var element =  $(this) ;
              if (element.data("tag") != selected){
                //element.hide() ;
              }
              else{
               OptionHotelnameLine = element.val();

                //element.show();
                console.log(OptionTypeLine)
              }
            });//end of function

            $("#TypeList option").each(function(item){
              var element =  $(this) ;
              if (element.data("tag") != selected){
                //element.hide() ;
              }
              else{
               OptionTypeLine = element.val();
              }
            });//end of function

            $("#custTypeField option").each(function(item){
              var element =  $(this) ;
              if (element.val() != OptionTypeLine){
                //element.hide() ;
              }
              else{
                $("#custTypeField option[value ="+OptionTypeLine+"]").prop('selected',true);
              }
            });//end of function

                if(OptionTypeLine == 'H'){
                  $('#ShopNamedisplaydiv').slideUp();
                  $('#HotelNamedisplaydiv').slideDown();
                }
                else if(OptionTypeLine == 'S'){
                  $('#HotelNamedisplaydiv').slideUp();
                  $('#ShopNamedisplaydiv').slideDown();
                }
                else if(OptionTypeLine == 'C'){
                  $('#HotelNamedisplaydiv').slideUp();
                  $('#ShopNamedisplaydiv').slideUp();
                }


            $("#CityField option").each(function(item){
              var element =  $(this) ;
              if (element.data("tag") != selected){
                //element.hide() ;
              }
              else{
               OptionCityLine = element.val();
                //element.show();
              }
            });//end of function

            $("#ProvField option").each(function(item){
              var element =  $(this) ;
              if (element.data("tag") != selected){
                //element.hide() ;
              }
              else{
               OptionProvLine = element.val();
                //element.show();
              }
            });//end of function


            $("#ProvinceField option").each(function(item){
              var element =  $(this) ;
              if (element.val() != OptionProvLine){
                //element.hide() ;
              }
              else{
                $("#ProvinceField option[value = "+OptionProvLine+"]").prop('selected',true);
              }
            });//end of function

            $("#TownField option").each(function(item){
              var element =  $(this) ;
              if (element.val() != OptionCityLine ){
                //element.hide() ;
              }
              else{
                $("#TownField option[value = "+OptionCityLine+"]").prop('selected',true);
              }
            });//end of function

            $("#TownField2 option").each(function(item){
              var element =  $(this) ;
              if (element.val() != OptionCityLine ){
                //element.hide() ;
              }
              else{
                $("#TownField2 option[value = "+OptionCityLine+"]").prop('selected',true);
              }
            });//end of function


            $("#BrgyList option").each(function(item){
              var element =  $(this) ;
              if (element.data("tag") != selected){
                element.hide() ;
              }
              else{
               OptionBrgyLine = element.val();
                element.show();
              }
            });//end of function

            $("#BrgyList option").each(function(item){
              var element =  $(this) ;
              if (element.data("tag") != selected){
                element.hide() ;
              }
              else{
               OptionBrgyLine = element.val();
                element.show();
              }
            });//end of function

            $("#AdressLineList option").each(function(item){
              var element =  $(this) ;
              if (element.data("tag") != selected){
                element.hide() ;
              }
              else{
               OptionAddrLine = element.val();
                element.show();
              }
            });//end of function

            $("#customerList_FName option").each(function(item){
              var element =  $(this) ;
              if (element.data("tag") != selected){
                element.hide() ;
              }
              else{
               OptionFname = element.val();
                $("#customerList_FName option[data-tag = "+selected+"]").prop('selected',true);
                //element.show();
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
               $("#customerList_MName option[data-tag = "+selected+"]").prop('selected',true);
               // element.show();
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
               $("#customerList_LName option[data-tag = "+selected+"]").prop('selected',true);
                //element.show();
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
          $("#Addrs_LineField").val(OptionAddrLine);
          $("#brgyField").val(OptionBrgyLine);
          $("#hotelNameField").val(OptionHotelnameLine);
          $("#shopNameField").val(OptionShopnameLine);
        });//end of function



          $('#ProvinceField').change(function(){
            $("#TownField").removeAttr("disabled");
            $("#TownField").attr('required', true);
                  var selected = $(this).val();
                  $("#TownField option").each(function(item){
                   // console.log(selected) ;
                    var element =  $(this) ;
                    console.log(element.data("tag")) ;
                    if (element.data("tag") != selected){
                      element.hide() ;
                    }
                    else{
                      element.show();
                    }
                  }) ;

                $("#TownField").val($("#TownField option:visible:first").val());
        });//end of function

       $("#TownField").change(function(){
              var element =  $(this) ;
              var CityLine = $("#TownField").val();

            $("#TownField2 option").each(function(item){
              var element =  $(this) ;
              if (element.val() != CityLine ){
                //element.hide() ;
              }
              else{
                $("#TownField2 option[value = "+CityLine+"]").prop('selected',true);
              }
            });//end of function
       });//end of function



      $(function () {
//        $("#example1").DataTable();

        $('#example2').DataTable({
/*          "paging": true,
          "lengthChange": false,
          "ordering": true,
          "info": true,
          "autoWidth": false*/
        });
      });
      });
    </script>
@endsection\
