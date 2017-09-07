@extends('main')

@section('content')

  <div class="container col-xs-12" style="margin-top: 50px;">
      <div>
        <div class="panel panel-primary">
          <div class="panel-heading" style="background-color: #26a69a">
            <h3 class="panel-title">Supplier Information</h3>
          </div>
          <div class="panel-body">
            {!! Form::model($supp,['route'=>['supplieradd.update', $supp->supplier_ID],'method'=>'PUT'])!!} 
                            <div class = 'row'>
                              <div class = 'col-md-4'>
                                <div class="form-group label-floating">
                                  <label class="control-label">First Name</label>
                                  <input type="text" class="form-control" value = "{{$supp->supplier_FName}}" name="suppFname" id="suppFname" maxlength = '15' required>
                                </div>
                              </div>

                              <div class = 'col-md-4'>
                                <div class="form-group label-floating">
                                  <label class="control-label">Middle Name</label>
                                  <input type="text" class="form-control" value = " {{$supp->supplier_MName}}" name="suppMname" id="suppMname" maxlength = '15'>
                                </div>
                              </div>                              

                              <div class = 'col-md-4'>
                                <div class="form-group label-floating">
                                  <label class="control-label">Last Name</label>
                                  <input type="text" class="form-control" value = "{{$supp->supplier_LName}}" name="suppLname" id="suppLname" maxlength = '20' required>
                                </div>
                              </div>
                            </div><!--end of row-->

                            <div class = 'row'>
                              <div class = 'col-md-4'>
                                <div class="form-group label-floating">
                                  <label class="control-label">Contact Number</label>
                                  <input type="text" class="form-control" value = "{{$supp->supplier_contactNum}}" name="contNo" id="contNo" maxlength = '13' required>
                                </div>
                              </div>
                              
                              <div class = 'col-md-3'>
                                <div class="form-group label-floating">
                                  <label class="control-label">telephone</label>
                                  <input type="telephone" class="form-control" value = "{{$supp->supplier_telNum}}" name="telNo" id="telNo" maxlength = '7'>
                                </div>
                              </div>                              

                              <div class = 'col-md-5'>
                                <div class="form-group label-floating">
                                  <label class="control-label">Email Address:</label>
                                  <input type="email" class="form-control" value = "{{$supp->supplier_emailadd}}" name="emailAdd" id="emailAdd" maxlength = '45' required>
                                </div>
                              </div>
                            </div><!--end of row-->
                            
                            <hr>
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"><strong>Supplier Address:</strong> </h5>  
                            </div><!--end of header-->

                            <div class = "row">
                              <div class = 'col-md-4' style = 'color:darkviolet;'>
                                  <input type="radio" name="supptype" id = 'IntlRDO' value="I">  <b>International</b>
                              </div>
                              <div class = 'col-md-4' style = 'color:darkviolet;'>
                                  <input type="radio" name="supptype" id = 'localRDO' value="L" > <b>Local</b>
                              </div>
                            </div><!--end of row-->

                            <div class = 'row'>
                              <div class = 'col-md-8'>
                                <div class="form-group label-floating">
                                  <label class="control-label">Address Line</label>
                                  <input type="text" class="form-control" value = "{{$supp->supplier_AddressLine}}" name="addline" id="addline" maxlength = '255' required>
                                </div>
                              </div>
                              
                              <div class = 'col-md-4'>
                                <div class="form-group label-floating">
                                  <label class="control-label">Baranggay</label>
                                  <input type="text" class="form-control" value = "{{$supp->Baranggay}}" name="brgy" id="brgy" maxlength = '35' required>
                                </div>
                              </div>                              
                            </div><!--end of row-->


                            <div class = 'row' id = 'localDiv' hidden>
                              <div class = 'col-md-6'>
                                <div class="form-group label-floating">
                                  <label class="control-label">Province</label>
                                  <select class="form-control" name ="ProvinceField" id ="ProvinceField" >
                                  @foreach($province as $prov)
                                    <option value ="{{$prov->id}}" data-tag = "{{$prov->name}}"> {{$prov->name}} </option>
                                  @endforeach
                                </select>
                                </div>
                              </div>
                              


                              <div class = 'col-md-6'>
                                <div class="form-group label-floating">
                                  <label class="control-label">Town</label>
                                    <select name="TownField" id="TownField" class="form-control" disabled>
                                      @foreach($city as $city)
                                        <option value ="{{$city->name}}" data-tag = "{{$city->province_id}}"> {{$city->name}} </option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>                              
                              </div><!--end of row-->

                              <div class = 'col-md-4' hidden>
                                <div class="form-group label-floating">
                                  <input type="text" class="form-control" value = "{{$supp->Type}}" name="supplierType_Field" id="supplierType_Field">
                                  <input type="text" class="form-control" value = "{{$supp->Province}}" name="supplierLocal_Prov" id="supplierLocal_Prov">
                                  <input type="text" class="form-control" value = "{{$supp->Town}}" name="supplierLocal_City" id="supplierLocal_City">
                                </div>
                              </div>

                            <div class = 'row' id = 'intlDiv' hidden>
                              <div class = 'col-md-6'>
                                <div class="form-group label-floating">
                                  <label class="control-label">Country</label>
                                  <select id="country" name="prov" class="form-control"></select>
                                </div>
                              </div>
                              
                              <div class = 'col-md-6'>
                                <div class="form-group label-floating">
                                  <select name="state" id="state" class="form-control"></select>
                                </div>
                              </div>                              
                          </div><!--end of row-->
                  <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Cancel</button>
                    </div>
                    <div class="btn-group" role="group">
                       <button type = "submit" name = "AddBtn" class = "btn btn-primary btn-success"><span class = "glyphicon glyphicon-floppy-save"></span> Save changes</button>
                    </div>
                  </div>
          </div>
        </div>
      </div>
  </div>

  </div>
 
@endsection

@section('scripts')
<script language="javascript">
            populateCountries("country", "state");
            populateCountries("country2");
</script>

<script>
 $(document).ready(function(){
    if($('#supplierType_Field').val()=='International'){
      $('#IntlRDO').attr('checked',true);
      $('#localDiv').hide();
      $('#intlDiv').slideDown();

      $("#country").attr('required', true);
      $("#state").attr('required', true);
      $("#TownField").attr('required', false);
      $("#ProvinceField").attr('required', false);
    }//end of if
    else if($('#supplierType_Field').val()=='Local'){
      $('#localRDO').attr('checked',true);
      $('#localDiv').slideDown();
      $('#intlDiv').hide(); 

      $("#TownField").attr('required', true);
      $("#ProvinceField").attr('required', true);
      $("#state").attr('required', false);
      $("#prov").attr('required', false); 
    }//end of else if


    $('#IntlRDO').click(function(){
      $('#intlDiv').slideDown();
      $('#localDiv').slideUp();
      var SuppType = 'I';
      $('#supplierType_Field').val(SuppType);
      $("#country").attr('required', true);
      $("#state").attr('required', true);
      $("#TownField").attr('required', false);
      $("#ProvinceField").attr('required', false);
      //var clearString = " ";
    });//end of function

    $('#localRDO').click(function(){
      $('#intlDiv').slideUp();
      $('#localDiv').slideDown();
      var SuppType = 'L';
      $('#supplierType_Field').val(SuppType);
      $("#TownField").attr('required', true);
      $("#ProvinceField").attr('required', true);
      $("#state").attr('required', false);
      $("#prov").attr('required', false);

      var CurrentProv = $("#ProvinceField").val();
      $("#ProvinceField option").each(function(item){
        var element =  $(this) ;
        if (element.val() == CurrentProv){
         //$(element).attr('selected',true)
         $("#supplierLocal_Prov").val(element.data("tag"));
         //console.log('current prov: '+ element.data("tag"));
        }
      }); //end of function
     
      //Setting the current City of the Supplier
      var CurrentCity = $("#TownField").val();
      //console.log('CurrentCity: ' + CurrentCity);
      $("#supplierLocal_City").val(CurrentCity);
    });//end of function

//Setting the current Province of the Supplier
      var CurrentProv = $("#supplierLocal_Prov").val();
      $("#ProvinceField option").each(function(item){
        var element =  $(this) ;
        if (element.data("tag") == CurrentProv){
         $(element).attr('selected',true)
        }
      }); //end of function
     
//Setting the current City of the Supplier
      var CurrentCity = $("#supplierLocal_City").val();
      $("#TownField option").each(function(item){
        var element =  $(this) ;
        if (element.val() == CurrentCity){
         $(element).attr('selected',true)
        }
      }); //end of function

     //Setting the current State of the Supplier
     $("#country option").each(function(item){
        var element =  $(this) ;
        if (element.val() == CurrentProv){
         $(element).attr('selected',true)
        }
      }); //end of function
   
     
    $('#ProvinceField').change(function(){
          $("#TownField").removeAttr("disabled");
          $("#TownField").attr('required', true);
          var clearString = " ";
          $("#supplierLocal_City").val(clearString);//resets the value of the text field

          //getting the element of the Province's dropdown
                  var Province = "";// = ProvElement.data("tag");//gets the datatag of the chosen element
                 // $("#supplierLocal_Prov").val(Province);//changes the value of the text field
                  var selected = $(this).val();
                  

                 $("#ProvinceField option").each(function(item){
                    //console.log(selected) ;  
                    var element =  $(this) ;
                    if (element.val() == selected){
                     Province = $(element).data("tag");
                     //console.log("Province = " + Province);
                      $("#supplierLocal_Prov").val(Province);//changes the value of the text field
                    }
                  }); //end of function
                  
                  $("#TownField option").each(function(item){
                    //console.log(selected) ;  
                    var element =  $(this) ; 
                    //console.log('Data_TAG: ' + element.data("tag")) ; 
                    if (element.data("tag") != selected){
                      var towntag = element.data("tag");
                      //console.log('town data Tag: ' + towntag);
                      element.hide() ; 
                    }
                    else{
                      element.show();
                    }
                  }) ; //end of function
                $("#TownField").val($("#TownField option:visible:first").val());
        });//end of function

        $('#TownField').change(function(){
          //getting the element of the TownField's dropdown
                  var selected = $(this).val();//gets the datatag of the chosen element
                 $("#supplierLocal_City").val(selected);//changes the value of the text field
               
        });//end of function

 });
</script>

@endsection