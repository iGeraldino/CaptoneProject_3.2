@extends('main')


@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<section class="content-header">
<div hidden>
	@foreach($CountFlower as $CountFlower)
		<input id = 'countFlowerField' name= 'countFlowerField' value = "{{$CountFlower->COUNT}}"/>
	@endforeach
	
  @foreach($CountAcessories as $CountAcessories)
		<input id = 'countAcessoryField' name = 'countAcessoryField'  value = "{{$CountAcessories->COUNT}}"/>
	@endforeach
</div>

<h2><b>Bouquet's Flowers and Other Items</b></h2>

<div class = "row">
  <div class = "col-md-6">
  <?php 
    $tCount_of_Flowers = 0;
  ?>
    @foreach($bouq_Flower_Count as $bouq_Flower_Count)
      <h4>
        <b>Total count of flowers: </b>{{$bouq_Flower_Count->Flower_Count}} stems
      </h4>
      <div hidden>
        {{ $tCount_of_Flowers = $bouq_Flower_Count->Flower_Count}}
      </div>
    @endforeach

    @foreach($bouq_Acessory_Count as $bouq_Acessory_Count)
      <h4>
        <b>Total count of acessories: </b>{{$bouq_Acessory_Count->Acessories_Count}} pcs
      </h4>
    @endforeach
  </div>
  <div class = "col-md-6">   
    <div hidden>
      <?php 
        $final_FAmount =0;
        $final_AAmount =0;
        $final_BAmount =0;
      ?>
      @foreach($BouqFlowers as $BFlowers)
        {{$final_FAmount += $BFlowers->Total_Amount}}
      @endforeach

      @foreach($BouqAcessoriess as $BAcessoriess)   
          {{$final_AAmount += $BAcessoriess->Total_Amt}}
      @endforeach 
        <input value = "{{number_format($final_FAmount + $final_AAmount,2)}}">
    </div>
    <h4>
      <b>Total_Amount of Bouquet: </b>Php {{number_format($final_FAmount + $final_AAmount,2)}}

      <?php
        $final_BAmount = $final_FAmount + $final_AAmount;
      ?>
    </h4>
  </div>
</div>

<div class="row container">
      <div  class = "col-md-9">
        <button id = 'addFlwrBTN' name = 'addFlwrBTN' class="btn btn-primary btn-sm col-xs-offset-2" data-toggle="modal" data-target="#AddFlowerModal"> <i class="material-icons" style="padding-right: 5px;">add_circle</i>Add Flowers </button>

        <button id = 'addAcsrBTN' name = 'addAcsrBTN' class="btn btn-primary btn-sm col-xs-offset-2"  data-toggle="modal" data-target="#AddItemModal"> <i class="material-icons" style="padding-right: 5px;">compare</i> Add Acessories</button>
      </div>
      
      <div class = "col-md-1"></div>

      <div class = "col-md-2">
        <a id = 'ReturnBTN' href = "{{ route ('bouquet.index') }}" name = 'ReturnBTN' class="btn btn-danger btn-tooltip btn-sm col-xs-offset-2"  data-toggle="tooltip" data-placement="bottom" title="This will bring you back to the list of bouquets" data-container="body"> <i class="material-icons" style="padding-right: 5px;">compare</i> Return to Bouquet List</a>
      </div>
</div>

  <!--  <a href=" {{ route ('floweradd.create') }} " class="btn btn-primary btn-lg"> Schedule an Order </a>

-->
    <!-- Sart Modal -->
    <div class="modal fade" id="AddFlowerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="material-icons">clear</i>
            </button>
            <h4 class="modal-title">Add New Flowers</h4>
          </div>
          <div class="modal-body">
  {!! Form::open(array('route' => 'bouqAddFlower.store', 'data-parsley-validate'=>'', 'files' => 'true', 'method'=>'POST')) !!}
            <!-- Modal Content here-->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group label-floating">
                	<div hidden><!--HIDDEN DIV HERE-->
						        <input  id = 'BQT_ID_Field' name = 'BQT_ID_Field' value = '{{$BouquetDet->bouquet_ID}}'>	
                    <input id = "final_BQTAamount" name = "final_BQTAamount" value = "{{$final_FAmount + $final_AAmount}}">
                    <input id = 'Flower_Count_Field' name = 'Flower_Count_Field' value = '{{$tCount_of_Flowers}}'>
                    <input id = 'InputFlowerPriceField' name = 'InputFlowerPriceField' value = '0'>
                	</div>
                  <label class="control-label">Flowers</label>
                  <select  id = 'flowersField' name = 'flowersField' class="btn btn-primary btn-md" >
                    <option value = '-1'  selected="true" disabled>Please Choose One Flower</option>
                    @foreach($UnsetFlowers as $UFlowers)
                    <option value = '{{$UFlowers->flower_ID}}' data-tag = "{{$UFlowers->Final_SellingPrice}}"> {{$UFlowers->flower_ID}}-({{$UFlowers->flower_name}})
                     </option>
                    @endforeach
                   </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group label-static">
                  <label class="control-label">Flower Price:</label>
                  <input type="text" id = 'FlowerPriceField' name = "FlowerPriceField" class="form-control" disabled>
                </div>
               
                <div class="form-group label-floating">
                  <label class="control-label">Quantity:</label>
                  <input type="number" id = "QtyField" name = "QtyField" class="form-control" min = '1' required>
                </div>
              </div>
            </div>
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Cancel</button>
            <button type="submit" id = 'ProceedBTN' name = 'ProceedBTN' class="btn btn-simple btn-success">Add Flower</button>
          </div>
 {!! Form::close() !!}
        </div>
      </div>
    </div>
    <!--  End Modal -->

    <!-- Sart Modal -->
    <div class="modal fade" id="AddItemModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="material-icons">clear</i>
            </button>
            <h4 class="modal-title">Add Neew Acessories</h4>
          </div>
          <div class="modal-body">
  {!! Form::open(array('route' => 'bouqAddAcessories.store', 'data-parsley-validate'=>'', 'files' => 'true', 'method'=>'POST')) !!}
            <!-- Modal Content here-->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group label-static">
                	<div hidden>
  						      <input  id = 'BQT_ID_Field2' name = 'BQT_ID_Field2' value = '{{$BouquetDet->bouquet_ID}}'>	
                    <input id = "final_BQTAamount2" name = "final_BQTAamount2" value = "{{number_format($final_FAmount + $final_AAmount,2)}}">
                    <input id = 'Acessory_Count_Field' name = 'Flower_Count_Field' value = '{{$tCount_of_Flowers}}'>
                    <input id = 'InputAcessoryPriceField' name = 'InputFlowerPriceField' value = '0'>
                  </div>
                  <label class="control-label">Flowers</label>
                <select  id = 'acessoriesSELECT_Field' name = 'acessoriesSELECT_Field' class="btn btn-primary btn-md" >
                    <option value = '-1' selected="true" disabled>Please Choose One Flower</option>
                    @foreach($UnsetAcessories as $UAcessories)
                      <option value = '{{$UAcessories->Accesories_ID}}' data-tag = "{{$UAcessories->price}}"> ITM-{{$UAcessories->Accesories_ID}}-({{$UAcessories->name}})
                     </option><!--may bug pa dito-->
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                 <div class="form-group label-static" hidden>
                  <label class="control-label">Acessory Price:</label>
                  <input type="text" id = 'AcessoryPriceField' name = "AcessoryPriceField" class="form-control" disabled>
                </div>
                <div class="form-group label-floating">
                  <label class="control-label">Quantity:</label>
                  <input type="number" id = "AcQtyField" name = "AcQtyField" min = 1 class="form-control" required>
                </div>
              </div>
            </div>
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Cancel</button>
            <button type="submit" id = "Add_Acessory_BTN" name = "Add_Acessory_BTN" class="btn btn-simple btn-success">Add Acessory</button>
          </div>
 {!! Form::close() !!}
        </div>
      </div>
    </div>
    <!--  End Modal -->

      <div class="container">
            <!-- Tabs with icons on Card -->
            <div class="card card-nav-tabs" >
              <div class="header" style = 'background-color:darkviolet;'>
                <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                <div class="nav-tabs-navigation">
                  <div class="nav-tabs-wrapper">
                    <ul class="nav nav-tabs" data-tabs="tabs">
                      <li class="active">
                        <a href="#pending" data-toggle="tab">
                          <i class="material-icons">face</i>
                          Flowers
                        </a>
                      </li>
                      <li>
                        <a href="#done" data-toggle="tab">
                          <i class="material-icons">chat</i>
                          Acessories
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="content-header">
                <div class="tab-content text-center">
                  <div class="tab-pane active" id="pending">                 
                    <div class="box">
                      <!-- /.box-header -->
                      <div class="box-body">
                        <table id="BouqFlowerstable" class="table table-bordered table-striped">
                          <thead>
                          <h4> <b>Flowers of BQT-{{ $BouquetDet->bouquet_ID}}</b> </h4>
                          <tr>

                            <th>Flower ID </th>
                            <th>Name </th>
                            <th>Image</th>
                            <th>Quantity</th>
                            <th>Price </th>
                            <th>Total Amount</th>
                            <th>Actions</th>
                          </tr>
                          </thead>
                        <tbody>
                         <!--foreach here -->   
      @foreach($BouqFlowers as $BFlowers)   
                            <tr>
                              <th> FLWR-{{$BFlowers->flower_ID}} </th>
                              <th> {{$BFlowers->flower_name}} </th>
							  <th align="center">
							  	<img src="{{ asset('flowerimage/'. $BFlowers->IMG)}}" class ="img-rounded img-raised img-responsive" style="min-width: 80px; max-height: 50px;">
							  </th>	
							  <?php
							  	//this php is for concatenation the id's of the Bouquet and the flowers under that bouquet so that it can pass those id as one to the edit route
							  	$Joined_id =$BouquetDet->bouquet_ID.'_'.$BFlowers->flower_ID.'_'.$final_BAmount;
							  ?>

                              <th> {{$BFlowers->QTY}} pcs.</th>
                              <th> Php {{$BFlowers->Final_SellingPrice}} </th>
                              <th> Php {{$BFlowers->Total_Amount}} </th>
                              <td align="center"> 
                                 <a type = "button" href="{{ route ('bouqAddFlower.edit', $Joined_id ) }}" class = "btn btn-primary btn-sm" ><span class = "glyphicon glyphicon-pencil"></span> 
                                 update Qty
                                 </a>	
                                 <a type = "button" href="{{ route('bouq.DelFlowerBouquet',['bouquet_ID'=>$BouquetDet->bouquet_ID,'flower_ID'=>$BFlowers->flower_ID,'QTY'=>$BFlowers->QTY,'T_PRICE'=>$BFlowers->Total_Amount]) }}" name = "deleteBTN" id = "deleteBTN"
                            		 class = "btn btn-danger btn-sm" > <span class = "glyphicon glyphicon-trash"></span> 
                             		Delete
                          		  </a>

                              </td>
                            </tr>
                        @endforeach 
                      <!--end foreach here-->
                        </tbody>
                       </table>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                  </div>
                      <!-- end of tab pain -->
                  <div class="tab-pane" id="done">
                    <div class="box">
                      <!-- /.box-header -->
                      <div class="box-body">
                        <table id="BouqAcessoriestable" class="table table-bordered table-striped">
                          <h4> <b>Acessories of BQT-{{ $BouquetDet->bouquet_ID}}</b> </h4>
                          <thead>
                          <tr>
                            <th>Item ID </th>
                            <th>Name </th>
                            <th>Image</th>
                            <th>Quantity</th>
                            <th>Price </th>
                            <th>Total Amount</th>
                            <th>Actions</th>
                          </tr>
                          </thead>
                        <tbody>
                         <!--foreach here -->    
      @foreach($BouqAcessoriess as $BAcessoriess)   
                            <tr>
                              <th> ITM-{{$BAcessoriess->Acessory_ID}} </th>
                              <th> {{$BAcessoriess->Name}} </th>
							  <th align="center">
							  	<img src="{{ asset('accimage/'. $BAcessoriess->IMG)}}" class ="img-rounded img-raised img-responsive" style="min-width: 80px; max-height: 50px;">
							  </th>	
						      <?php
							  	//this php is for concatenation the id's of the Bouquet and the flowers under that bouquet so that it can pass those id as one to the edit route

							  	$Joined_id2 =$BouquetDet->bouquet_ID.'_'.$BAcessoriess->Acessory_ID.'_'.$final_BAmount;
							  ?>
                              <th> {{$BAcessoriess->QTY}} pcs.</th>
                              <th>Php {{$BAcessoriess->Price}}</th>
                              <th>Php {{$BAcessoriess->Total_Amt}} </th>
                              <td align="center"> 
                                 <a type = "button" href="{{ route ('bouqAddAcessories.edit', $Joined_id2 ) }}" class = "btn btn-primary btn-sm" ><span class = "glyphicon glyphicon-list-alt"></span> 
                                 update Qty
                                 </a>

                                 <a type = "button" href="{{ route('bouq.DelAcessoryBouquet',['bouquet_ID'=>$BouquetDet->bouquet_ID,'acessory_ID'=>$BAcessoriess->Acessory_ID]) }}" class = "btn btn-danger btn-sm" ><span class = "glyphicon glyphicon-remove"></span> 
                                   Delete
                                 </a>

                              </td>
                            </tr>
                        @endforeach                        
                      <!--end foreach here-->
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
  </section>
    <!-- End Section Tabs -->
@endsection

@section('scripts')

  <script type="text/javascript">
          $(function () {
        $("#example1").DataTable();
        $('#BouqFlowerstable').DataTable({
          "paging": true,
          "info": true,
          "autoWidth": false
        });
        $('#BouqAcessoriestable').DataTable({
          "paging": true,
          "info": true,
          "autoWidth": false
        });
        $('#cancelledtable').DataTable({
          "paging": true,
          "info": true,
          "autoWidth": false
        });
      });
  </script>

  <script>
 $('document').ready(function(){

  
    if($('#flowersField option').val() == '-1'){
      $('#ProceedBTN').attr('disabled',true);
    }else{
      $('#ProceedBTN').attr('disabled',false);
    }//end of if

    if($('#acessoriesSELECT_Field option').val() == '-1'){
      $('#Add_Acessory_BTN').attr('disabled',true);
    }else{
      $('#Add_Acessory_BTN').attr('disabled',false);
    }//end of if
  
  $("#flowersField").change(function(){
    var element =  $(this);
    var price = 'Php' + ' ' + $('option:selected').attr( "data-tag" );
    var price2 = $('option:selected').attr( "data-tag" );
    //var origPrice = 'Php'+ '' price;
    console.log('price2 = '+price2);

    $('#ProceedBTN').attr('disabled',false);
    $('#FlowerPriceField').val(price);
    $('#InputFlowerPriceField').val(price2);
  });//end of function

  $("#acessoriesSELECT_Field").change(function(){
    var element =  $(this);
    var Acprice = 'Php' + ' ' + $('option:selected').attr( "data-tag" );
    var Acprice2 = $('option:selected').attr( "data-tag" );
    //var origPrice = 'Php'+ '' price;
    console.log('price2 = '+Acprice2);

    $('#Add_Acessory_BTN').attr('disabled',false);
    $('#AcessoryPriceField').val(Acprice);
    $('#InputAcessoryPriceField').val(Acprice2);
  });//end of function

       var totalAMT = 0;  
  $('#total_Amounts_field option').each(function(item){
       // console.log(selected) ;
        var element =  $(this) ; 
        totalAMT+=parseInt(element.val());
  }); //end of function
        //console.log(totalAMT);
        console.log(totalAMT);


 	//disabling buttons if there are no more unset flowers
 	if($('#countFlowerField').val() == 0){
 		$('#addFlwrBTN').attr('disabled',true);
 	}
 	else{
 		$('#addFlwrBTN').attr('disabled',false);
 	}
 	//end of if,else

	//disabling buttons if there are no more unset acessories
 	if($('#countAcessoryField').val() == 0){

 		$('#addAcsrBTN').attr('disabled',true).attr('title', "This is Disabled because you've already added all of the items listed, if you want to update the quantity of a specific item just change it's qunatity on the list below");
 		 $("#addAcsrBTN").hover(function() {
 		 	$('#addAcsrBTN').attr('title', "This is Disabled because you've already added all of the items listed, if you want to update the quantity of a specific item just change it's qunatity on the list below");
 		 });//end of function

 	}
 	else{
 		$('#addAcsrBTN').attr('disabled',false);
 	}
 	//end of if,else



    /*$.ajax({
      type:'get',
      url: "{{ url("/InventoryScheduling") }}",
      dataType: 'json',
      success: function(response){
        option = "";

        for(ctr = 0; ctr < response.data.length; ctr++)
        {
          option += `<option value="`+ response.data[ctr].supplier_ID +`">`+ response.data[ctr].supplier_ID +`</option>`; 
          console.log(option);
        }

        $('#supplierField').append(option);
      }
    });//END OF AJAX*/
  });
  </script>

@endsection