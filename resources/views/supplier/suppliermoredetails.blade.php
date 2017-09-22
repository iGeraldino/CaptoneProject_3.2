@extends('main')

@section('content')

  <div class="" style="margin-top: 50px;">
    <div class="col-xs-12">
      <div class="panel">
          <div class="panel-heading Subu">
            <h3 class="panel-title">Supplier More Details</h3>
          </div>
          <div class="panel-body">
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label"><B>SUPPLIER ID:</B> </label>
                <span><b>CUST-{{$supp->supplier_ID}}</b></span>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label"><b>FULL NAME: </b></label>
                <span style="font-size: 100%; text-transform: uppercase;"><b>{{$supp->supplier_FName}} {{$supp->supplier_MName}}, {{$supp->supplier_LName}}</b></span>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label"><b>EMAIL ADDRESS: </b></label>
                <span style="font-size: 100%;"><b>{{$supp->supplier_emailadd}}</b></span>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label"><b>CONTACT NUMBER:</b></label>
                <span style="font-size: 100%;"><b>{{$supp->supplier_contactNum}}</b></span>
              </div>
            </div>


            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label"><b>TELEPHONE NUMBER:</b></label>
                <span style="font-size: 100%;"><b>{{$supp->supplier_telNum}}</b></span>
              </div>
            </div>

            <div class = "row">
              <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label"><b>ADDRESS: </b></label>
              </div>
                <span style="font-size: 100%;"><b>{{$supp->supplier_AddressLine}}, <br>{{$supp->Baranggay}}, {{$supp->Town}}, {{$supp->Province}}</b></span>
              </div>
            </div>
            <br>
            <div class="col-md-offset-9">
             <button class="btn btn-round btn-md twitch"  style = " margin-left: 5%; background-color: #C93756;" data-toggle="modal" data-target="#AddModal"> Add New Price <i class="material-icons">add_circle</i></button>
            </div>
            <!-- Start of Table-->
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table">
                <thead>
                    <th class="text-center"> PRICE ID </th>
                    <th class="text-center"> FLOWER NAME </th>
                    <th class="text-center"> IMAGE</th>
                    <th class="text-center"> PRICE </th>
                    <th class="text-center"> ACTION </th>
                </thead>

                <tbody>
                 @foreach($PriceList as $price)
                    <tr>  
                      <th class="text-center"> {{$price->Price_ID}}     </th>
                      <th class="text-center"> {{$price->flower_name}}  </th>
                      <th class="text-center" align="center"><img  class = "img-rounded img-responsive img-raised" src="{{ asset('flowerimage/'. $price->Img)}}" style="max-width: 50px; max-height: 50px; margin-left: 100px;">
                      </th>
                      <th> Php {{number_format($price->price,2)}}  </th>
                      <th  class="text-center"> 
                        <button type="button" rel="tooltip" title="EDIT" class="btn btn-just-icon twitch"> 
                          <i class="material-icons">mode_edit</i>
                        </button>
                      </th>
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
        </div>
    </div>
  </div>

        <div class="row container">
<<<<<<< Updated upstream
                  
       
=======
        <button class="btn btn-primary btn-md col-md-offset-1"  style = " margin-left: 5%; background-color: #C93756;" data-toggle="modal" data-target="#AddModal"> Set Flower</button>

>>>>>>> Stashed changes
        <!-- Start of Modal -->

          <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"> <strong>Adding Supplier</strong> </h5>

                </div>
                <div class="modal-body">
                    {!! Form::open(array('route' => 'supplierMoreDetails.store', 'data-parsley-validate'=>'', 'method' => 'POST')) !!}
                            <div class = 'row'>
                              <div class = 'col-md-6'>
                                  <select name="FlowersField" id="FlowersField" class="btn btn-default btn-sm col-md-offset-1" style="font-size: 100%; background-color: darkviolet;">
                                        <option value = '-1' selected disabled>choose a flower</option>
                                      @foreach($flowers as $flowers)
                                        <option value ="{{$flowers->flower_ID}}" data-tag = "{{$flowers->Image}}"> FLOWR-{{$flowers->flower_ID}}-({{$flowers->flower_name}})  </option>
                                      @endforeach
                                    </select>
                                    <br>
                                    <br>
                              </div>
                              <div class = "col-xs-1" ></div>
                              <div hidden> <input name = "Supp_IDField" id = "Supp_IDField" value = "{{$supp->supplier_ID}}"/> </div>
                              <img src= "{{ asset('img/'.'addfile.ico')}}" id="imageBox" name="imageBox" style=" margin-left:15%; max-width: 200px; max-height: 200px;" />
                              <div class = "col-md-5" hidden>
                                <div class="form-group label-floating">
                                  <label class="control-label">Price: </label>
                                  <input type="number" class="form-control" name="PriceField" id="PriceField" min = '0.00' step = '0.1'>
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
                       <button type = "submit" name = "AddBtn" class = "btn btn-primary btn-success"><span class = "glyphicon glyphicon-floppy-save"></span> Save and Proceed</button>
                    </div>
                  </div>
                </div>
            {!! Form::close() !!}

              </div>
            </div>
          </div>


        <!-- End of Modal -->
      </div>


<<<<<<< Updated upstream
    
=======
    <!-- Start of Table-->
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table">
                <thead>
                    <th> Flower ID </th>
                    <th> Flower Name </th>
                    <th> Image</th>
                    <th> Action </th>
                </thead>

                <tbody>
                 @foreach($PriceList as $price)
                    <tr>
                      <th> FLWR-{{$price->flower_ID}}     </th>
                      <th> {{$price->flower_name}}  </th>
                      <th align="center"><img  class = "img-rounded img-responsive img-raised" src="{{ asset('flowerimage/'. $price->Img)}}" style="max-width: 50px; max-height: 50px; margin-left: 100px;">
                      </th>
                      <th align="center">
                        <button type="button" rel="tooltip" title="Edit" class="btn btn-info btn-xs">
                          <i class="glyphicon glyphicon-edit"></i>
                        </button>
                      </th>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
>>>>>>> Stashed changes
  </div>
@endsection

@section('scripts')
<script>


 $(document).ready(function(){
    $('#FlowersField').change(function(){
          //$("#imageBox").removeAttr("disabled");
          //getting the element of the Province's dropdown
                 var Image = "";
                 // $("#supplierLocal_Prov").val(Province);//changes the value of the text field
                  var selected = $(this).val();
                 $("#FlowersField option").each(function(item){
                    //console.log(selected) ;
                    var element =  $(this) ;
                    if (element.val() == selected){
                      var img = $(element).data('tag');
                     //Image = "{{ asset('flowerimage/'." + img + ")}}";
                     console.log("" + img + "");
                      $("#imageBox").attr("src",img);//changes the value of the text field
                     var Imageboxvalue = $("#imageBox").attr('src');//changes the value of the text field
                     console.log(Imageboxvalue);
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

 });
</script>
@endsection
