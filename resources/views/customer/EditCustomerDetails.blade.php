@extends('main')

@section('content')

<div class="container" style="margin-top: 3%;">
	<div class="row" >
    <div class="col-xs-11">
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
          {!! Form::model($customerDetails,['route'=>['customers.update', $customerDetails->Cust_ID],'method'=>'PUT'])!!}
          <label>Name: </label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
              <input type="text" class="form-control" name="Cust_FNameField2" id="Cust_FNameField2"  placeholder="First Name..." Value = "{{$customerDetails->Cust_FName}}"  required/>
            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
              <input type="text" class="form-control" name="Cust_MNameField2" id="Cust_MNameField2" Value = "{{$customerDetails->Cust_MName}}"  placeholder="Middle Name..."/>
            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
              <input type="text" class="form-control" name="Cust_LNameField2" id="Cust_LNameField2" Value = "{{$customerDetails->Cust_LName}}" placeholder="Last Name..." required/>
          </div>
          <div class = "row">
            <div class = "col-md-4">
              <label>Type: </label>
              <input id = "custTypeLbl" value = "{{$customerDetails->Customer_Type}}" hidden></input>
            </div>
            <div class = "col-md-4">
              <label>Contact Number: </label>
            </div>
          </div>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
            <select class="form-control" name ="custTypeField2" id ="custTypeField2" >
                <option value ="C" > Single </option>
                <option value ="S" > Shop </option>
                <option value ="H" > Hotel </option>
            </select>
            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
            <input type="text" class="form-control" name="ContactNumField2" id="ContactNumField2"  placeholder="+639..." Value = "{{$customerDetails->Contact_Num}}" required/>
          </div>
          <div class="form-group" id = "hotelnameDiv2" hidden>
            <label for="HotelNameField">Hotel Name (for hotel customers):</label>
            <input type="text" class="form-control" id="HotelNameField2" name="HotelNameField2" Value = "{{$customerDetails->Hotel_Name}}" placeholder="Hotel Name here...">
          </div>
          <div class="form-group" id = "shopnameDiv2" hidden>
            <label for="ShopNameField">Shop Name (for shop customers):</label>
            <input type="text" class="form-control" id="ShopNameField2" name="ShopNameField2" Value = "{{$customerDetails->Shop_Name}}" placeholder="Shop Name here...">
          </div>
          <div class="form-group">
            <label for="emailField">Email address</label>
            <input type="email" class="form-control" id="emailField2" name="emailField2" Value = "{{$customerDetails->Email_Address}}" placeholder="Email here...">
          </div>

          <div class="form-group">
            <label for="addressField">Address Line</label>
            <input type="text" class="form-control" id="addressField2" name="addressField2" placeholder="Unit No. or House No.\Street\Baranggay\Town\Porvince" Value = "{{$customerDetails->Address_Line}}" required>
          </div>
          <div class = "form-group">
            <label>Baranggay: </label>
            <input type="text" class="form-control" name="BaranggayField2" id="BaranggayField2"  placeholder="Baranggay here..." Value = "{{$customerDetails->Baranggay}}" required/>
          </div>
          <div class = "row">
            <div class = "col-md-4">
              <label>Town: </label>
            </div>

            <div class = "col-md-4">
              <label>Province: </label>
            </div>
          </div>
          <div hidden>
              <input type="text" class="form-control" name="provinceID" id="provinceID" Value = "{{$customerDetails->Province}}"/>
              <input type="text" class="form-control" name="townID" id="townID" Value = "{{$customerDetails->Town}}"/>
          </div>
          <div class="input-group" id = "AdrsDiv">
            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
             <select class="form-control" name ="ProvinceField2" id ="ProvinceField2" >
                  @foreach($province as $prov)
                    <option value ="{{$prov->id}}" > {{$prov->name}} </option>
                  @endforeach
              </select>
              <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
              <select class="form-control" name ="TownField2" id ="TownField2" >
                  @foreach($city as $city)
                    <option value ="{{$city->id}}" data-tag = "{{$city->province_id}}"> {{$city->name}} </option>
                  @endforeach
              </select>
          </div>
          <!--Hidden for edit only-->
          <div class="modal-footer" id = "editFooter">
            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
              <div class="btn-group" role="group">
                <a type="button" href = "http://localhost:8000/customers" name = "cancelEditBtn" id = "cancelEditBtn" class="btn btn-default"  role="button">Cancel</a>
              </div>
              <div class="btn-group" role="group">
                 <button type = "submit" name = "saveChangesBtn" id = "saveChangesBtn" class = "btn btn-success Lush"><span class = "glyphicon glyphicon-floppy-save"></span> Save Changes</button>
              </div>
            </div>
          </div>
            {!! Form::close() !!}
            <!-- /.box-body -->
        </div>
      </div>
    </div>
  </div>
@endsection


@section('scripts')
<script>
  $(document).ready(function(){
  //  $("#TownField2").attr("disabled", "disabled");
    var provID = $('#provinceID').val();//eto yung galing sa database na value
    $('#ProvinceField2 option').each(function(){
      if ($(this).val() == provID){
        $(this).parent().val($(this).val());
      }
    });// end of function

    var cityID = $('#townID').val();
    $('#TownField2 option').each(function(){
      if ($(this).val() == cityID){
        $(this).parent().val($(this).val());
      }
    });// end of function

        $('#ProvinceField2').change(function(){
            var selected = $(this).val();
            //$("#TownField").removeAttr("disabled");
            $("#TownField option").each(function(item){
              // console.log(selecte d) ;
              var element =  $(this) ;
              //console.log(element.data("tag")) ;
              if (element.data("tag") != selected){
                element.hide() ;
              }
              else{
                element.show();
              }
            }) ;
           $("#TownField2").val($("#TownField option:visible:first").val());
           $("#TownField2").attr('required', true);
        });//end of function

        if( $('#custTypeLbl').val() == 'H' ){
          $('#custTypeField2 option[value=H]').prop('selected', true);
            $("#hotelnameDiv2").show();
            $("#HotelNameField2").attr('required', true);
            $("#shopnameDiv2").hide();
            $("#ShopNameField2").attr('required', false);

        }
        else if( $('#custTypeLbl').val() == 'S' ){
          $('#custTypeField2 option[value=S]').prop('selected', true);
            $("#hotelnameDiv2").hide();
            $("#HotelNameField2").attr('required', false);
            $("#shopnameDiv2").show();
            $("#ShopNameField2").attr('required', true);

        }
        else{
          $('#custTypeField2 option[value=C]').prop('selected', true);
            $("#hotelnameDiv2").hide();
            $("#HotelNameField2").attr('required', false);
            $("#shopnameDiv2").hide();
            $("#ShopNameField2").attr('required', false);
        }


        $("#custTypeField2").change(function(){
          if($('#custTypeField2').val() == 'H') {
              $("#hotelnameDiv2").slideDown();
              $("#HotelNameField2").attr('required', true);
              $("#shopnameDiv2").slideUp();
              $("#ShopNameField2").attr('required', false);

            }
          else if ($('#custTypeField2').val() == 'S'){
              $("#hotelnameDiv2").slideUp();
              $("#HotelNameField2").attr('required', false);
              $("#shopnameDiv2").slideDown();
              $("#ShopNameField2").attr('required', true);
            }
          else {
            var clear = '';
              $("#hotelnameDiv2").slideUp();
              $("#shopnameDiv2").slideUp();
              $("#HotelNameField2").attr('required', false);
              $("#ShopNameField2").attr('required', false);
              $("#HotelNameField2").val(clear);
              $("#ShopNameField2").val(clear);
            }
        });//end of function

      });
    </script>
@endsection
