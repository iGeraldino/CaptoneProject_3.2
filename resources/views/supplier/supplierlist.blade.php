
@extends('main')

@section('content')

   <div class="container">
      <h2>List of Suppliers</h2>
      <div class="row container">
        <button class="btn btn-primary btn-sm col-xs-offset-2" data-toggle="modal" data-target="#AddModal"> <i class="material-icons" style="padding-right: 5px;">add_circle</i>Add New Supplier </button>

        <!-- Start of Modal -->

          <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"> <strong>Adding Supplier</strong> </h5>  
                </div>
                <div class="modal-body">

                   

                    {!! Form::open(array('route' => 'supplieradd.store', 'data-parsley-validate'=>'')) !!}
                            <div class = 'row'>
                              <div class = 'col-md-4'>
                                <div class="form-group label-floating">
                                  <label class="control-label">First Name</label>
                                  <input type="text" class="form-control" name="suppFname" id="suppFname" maxlength = '15' required>
                                </div>
                              </div>

                              <div class = 'col-md-4'>
                                <div class="form-group label-floating">
                                  <label class="control-label">Middle Name</label>
                                  <input type="text" class="form-control" name="suppMname" id="suppMname" maxlength = '15'>
                                </div>
                              </div>                              

                              <div class = 'col-md-4'>
                                <div class="form-group label-floating">
                                  <label class="control-label">Last Name</label>
                                  <input type="text" class="form-control" name="suppLname" id="suppLname" maxlength = '20' required>
                                </div>
                              </div>
                            </div><!--end of row-->

                            <div class = 'row'>
                              <div class = 'col-md-4'>
                                <div class="form-group label-floating">
                                  <label class="control-label">Contact Number</label>
                                  <input type="text" class="form-control" name="contNo" id="contNo" maxlength = '13' required>
                                </div>
                              </div>
                              
                              <div class = 'col-md-3'>
                                <div class="form-group label-floating">
                                  <label class="control-label">telephone</label>
                                  <input type="telephone" class="form-control" name="telNo" id="telNo" maxlength = '7'>
                                </div>
                              </div>                              

                              <div class = 'col-md-5'>
                                <div class="form-group label-floating">
                                  <label class="control-label">Email Address:</label>
                                  <input type="email" class="form-control" name="emailAdd" id="emailAdd" maxlength = '45' required>
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
                                  <input type="radio" name="supptype" id = 'localRDO' value="L"> <b>Local</b>
                              </div>
                            </div><!--end of row-->

                            <div class = 'row'>
                              <div class = 'col-md-8'>
                                <div class="form-group label-floating">
                                  <label class="control-label">Address Line</label>
                                  <input type="text" class="form-control" name="addline" id="addline" maxlength = '255' required>
                                </div>
                              </div>
                              
                              <div class = 'col-md-4'>
                                <div class="form-group label-floating">
                                  <label class="control-label">Baranggay</label>
                                  <input type="text" class="form-control" name="brgy" id="brgy" maxlength = '35' required>
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
                                  <input type="text" class="form-control" name="supplierType_Field" id="supplierType_Field">
                                  <input type="text" class="form-control" name="supplierLocal_Prov" id="supplierLocal_Prov">
                                  <input type="text" class="form-control" name="supplierLocal_City" id="supplierLocal_City">
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
                </div>
                <div class="modal-footer">
                  <div class="btn-group " role="group" aria-label="group button">
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal"  role="button">Close</button>
                    </div>
                    <div class="btn-group" role="group">
                       <button type = "submit" name = "AddBtn" class = "btn btn-success btn-simple"><span class = "glyphicon glyphicon-floppy-save"></span> Save and Proceed</button>
                    </div>
                  </div>
                </div>
            {!! Form::close() !!}

              </div>
            </div>
          </div>


        <!-- End of Modal -->
        
      </div>
   </div>
    
    <br>


      
        <div class="col-xs-12">
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="sam" class="table table-bordered table-striped">
                <thead>
                <tr>
                      
                    <th> Supplier ID </th>
                    <th> Name</th>
                    <th> Phone Number</th>
                    <th> Tel Number </th>
                    <th> Email Address</th>
                    <th> Address</th>
                    <th> Action </th>

                </tr>
                </thead>
                    <tbody>
                        @foreach ($supp as $sup)
                        <tr>
                          <td> SUPLR-{{ $sup -> supplier_ID }} </td>
                          <td> {{ $sup -> supplier_LName . ',' . $sup -> supplier_FName . ' ' . $sup -> supplier_MName }} </td>
                          <td> {{ $sup -> supplier_contactNum }} </td>
                          <td> {{ $sup -> supplier_telNum }} </td>
                          <td> {{ $sup -> supplier_emailadd }} </td>
                          <td> {{ $sup -> supplier_AddressLine . ' ' . $sup -> Baranggay . ' ' . $sup -> Town . ',' . $sup -> Province }}</td>
                          <td align="center">
                             <!--<a href=" {{ route ('supplieradd.edit', $sup -> supplier_ID ) }} " class="btn btn-xs btn-info"> View </a>-->
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewSPLR{{$sup -> supplier_ID}}">View</button>
                              <!-- line modal -->
                                <div class="modal fade" id="viewSPLR{{$sup -> supplier_ID}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close"
                                        id = "closeXBtn" name = "closeXBtn" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                        <span class="label" style="font-size: 20px; background-color: #26a69a">Supplier Information</span>
                                      </div>
                                        
                                      <div class="modal-body" id = "infoBodyDiv">  
                                        <!-- content goes here -->
                                          <div class = "row">
                                          <div class = "col-xs-1"></div>
                                          <div class = "col-md-2">
                                            <span class="label" style="font-size: 100%; background-color: #26a69a">Supplier ID</span>
                                          </div>
                                          <div class = "col-md-7" style = "font-size: 18px; ">
                                           <b>SUPLR-{{ $sup -> supplier_ID }}</b>
                                          </div>  
                                        </div> <!--end of row-->
                                        
                                        <br>

                                        <div class = "row">
                                          <div class = "col-xs-1"></div>
                                          <div class = "col-md-2">
                                            <span class="label" style="font-size: 100%; background-color: #26a69a">Supplier Name</span>
                                          </div>
                                          <div class = "col-md-7" style = "font-size: 18px; ">
                                           <b>{{ $sup -> supplier_LName . ',' . $sup -> supplier_FName . ' ' . $sup -> supplier_MName }}</b>
                                          </div>  
                                        </div> <!--end of row-->
                                        
                                        <br>
                                        
                                        <div class = "row">
                                          <div class = "col-xs-1"></div>
                                          <div class = "col-md-2">
                                            <span class="label" style="font-size: 100%; background-color: #26a69a">Contact No</span>
                                          </div>
                                          <div class = "col-md-7" style = "font-size: 18px; ">
                                           <b>{{ $sup -> supplier_contactNum }}</b>
                                          </div>  
                                        </div> <!--end of row-->
                                        
                                        <br>

                                        <div class = "row">
                                          <div class = "col-xs-1"></div>
                                          <div class = "col-md-2">
                                            <span class="label" style="font-size: 100%; background-color: #26a69a">Telephone No</span>
                                          </div>
                                          <div class = "col-md-7" style = "font-size: 18px; ">
                                           <b>{{ $sup -> supplier_telNum }}</b>
                                          </div> 
                                        </div> <!--end of row-->

                                        <br>

                                        <div class = "row">
                                          <div class = "col-xs-1"></div>
                                          <div class = "col-md-3">
                                            <span class="label" style="font-size: 100%; background-color: #26a69a">Email Address</span>
                                          </div>
                                          <div class = "col-md-7" style = "font-size: 18px; ">
                                           <b>{{ $sup -> supplier_emailadd }}</b>
                                          </div> 
                                        </div> <!--end of row-->

                                        <br>

                                        <div class = "row">
                                          <div class = "col-xs-1"></div>
                                          <div class = "col-md-3">
                                            <span class="label" style="font-size: 100%; background-color: #26a69a">Type</span>
                                          </div>
                                          <div class = "col-md-7" style = "font-size: 18px; ">
                                           <b>{{ $sup -> Type }} Supplier</b>
                                          </div> 
                                        </div> <!--end of row-->                                        

                                        <br>

                                        <div class = "row">
                                          <div class = "col-xs-1"></div>
                                          <div class = "col-md-3">
                                            <span class="label" style="font-size: 100%; background-color: #26a69a">Address</span>
                                          </div>
                                          <div class = "col-md-7" style = "font-size: 18px; ">
                                           <b>{{ $sup -> supplier_AddressLine . ' ' . $sup -> Baranggay . ' ' . $sup -> Town . ',' . $sup -> Province }}</b>
                                          </div> 
                                        </div> <!--end of row-->                                        

                                      </div>

                                 
                                      <div class="modal-footer" id = "infoFooter">
                                        <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                          <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                                          </div>
                                          <div class="btn-group" role="group">
                                             <a type = "button" href="{{ route('supplieradd.edit',$sup -> supplier_ID) }}" class = "btn   btn-primary btn-info" ><span class = "glyphicon glyphicon-pencil"></span> 
                                                Edit Details
                                              </a>
                                                 
                                          </div>
                                        </div>
                                      </div>

                                    </div>
                                    </div>
                                </div>
                                 <a type = "button" href="{{ route('supplierMoreDetails.show',$sup -> supplier_ID) }}" class = "btn btn-success btn-sm" >
                                  More
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
        </div>
        <!-- /.col -->
      



 
@endsection

@section('scripts')
<script language="javascript">
            populateCountries("country", "state");
            populateCountries("country2");
</script>

<script type="text/javascript">
        $(function () {
      $("#example1").DataTable();
      $('#sam').DataTable({
        "paging": true,
        "info": true,
        "autoWidth": false
      });
    });
</script>

<script>
 $(document).ready(function(){
    $('#IntlRDO').click(function(){
      $('#intlDiv').slideDown();
      $('#localDiv').slideUp();
      var SuppType = 'I';
      $('#supplierType_Field').val(SuppType);
      $("#state").attr('required', true);
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
    });//end of function

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

