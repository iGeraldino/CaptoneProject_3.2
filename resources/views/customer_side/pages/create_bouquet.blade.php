@extends('customer_side_main')
@section('title', 'Create Your Own Bouquet')
@section('css')
    <link href="_CSS/create_bouquets.css" rel="stylesheet">
    <link href="_CSS/flower.css" rel="stylesheet">
@endsection
@section('content')

<?php
    $AddingFlowertoBouquetSession = Session::get('Adding_FlowertoBouquetSession');
    Session::Remove('Adding_FlowertoBouquetSession');

    $UpdatingFlowertoBouquetSession = Session::get('Updating_FlowertoBouquetSession');
    Session::Remove('Updating_FlowertoBouquetSession');

    $DeleteFlowertoBouquetSession = Session::get('Delete_FlowertoBouquetSession');
    Session::Remove('Delete_FlowertoBouquetSession');

    $UpdateAcctoBouquetSession = Session::get('Update_AcctoBouquetSession');
    Session::Remove('Update_AcctoBouquetSession');

    $AddingAcctoBouquetSession = Session::get('Adding_AcctoBouquetSession');
    Session::Remove('Adding_AcctoBouquetSession');

    $DeleteAcctoBouquetSession = Session::get('Delete_AcctoBouquetSession');
    Session::Remove('Delete_AcctoBouquetSession');

  ?>

  <div hidden>
    <input id = "addflowertobouquetSession" value = "{{$AddingFlowertoBouquetSession}}">
    <input id = "updateflowertobouquetSession" value = "{{$UpdatingFlowertoBouquetSession}}">
    <input id = "deleteflowertobouquetSession" value = "{{$DeleteFlowertoBouquetSession}}">
    <input id = "updateacctobouquetSession" value = "{{$UpdateAcctoBouquetSession}}">
    <input id = "addacctobouquetSession" value = "{{$AddingAcctoBouquetSession}}">
    <input id = "deleteacctobouquetSession" value = "{{$DeleteAcctoBouquetSession}}">

</div>
	<div class="container cols" style="margin-top: 60px;">
	    <div class="row">
			<div class="col-md-8">
				<h3>Create Your Own Bouquet</h3>

				<div class="tabbable-panel" >
					<div class="tabbable-line">
						<ul class="nav nav-tabs ">
							<li class="active">
								<a href="#flowers" data-toggle="tab">
								Flowers </a>
							</li>
							<li>
								<a href="#accessories" data-toggle="tab">
								Accessories </a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="flowers">
								<h4 class="container">
									Choose Flowers For Your Bouquet
								</h4>

							<div class="row">


              @foreach($bouqflower as $bouq)
                <div class=" col-sm-3" style="margin-top: 10px;">
									<div class="thumbnail">
										<img style="max-width: 165px; max-height: 165px; min-width: 165px; min-height: 165px;" class="group list-group-image" src={{ asset('flowerimage/'. $bouq-> IMG)}}>
									</div>
									<div class="caption">
                                <span> <h5> {{ $bouq -> flower_name }} </h5> </span>
				                        <hr class="colorgraph">
                                <div class="col-sm-6">
                                    <span class="label label-danger">Php {{ number_format($bouq -> Final_SellingPrice,2)}}</span>
                                </div>
			                          <div class="col-md-6">
			                                <div class="">
			                                    <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#flowermodal{{ $bouq-> flower_ID }}" style="width: 70px;">
                                          <span class="glyphicon glyphicon-ok"></span> Select</a>

			                                </div>
			                          </div>
			            </div>
								</div>
                <div class="modal fade" id="flowermodal{{ $bouq-> flower_ID }}" role="dialog">
          				<div class="modal-dialog modal-md">

          				  <!-- Modal content-->
          				  <div class="modal-content">
          				    <div class="modal-header">
          				      <button type="button" class="close" data-dismiss="modal">&times;</button>
          				      <h4 class="modal-title">Flower Details</h4>
          				    </div>
          				    <div class="modal-body">
                        <form method="POST" action="{{ route('addflowerbouq')}}">
          					    <div class="row">
          					    	<div class="col-md-5">
                            <img src="{{ asset('flowerimage/'. $bouq -> IMG)}}" class="img-thumbnail"  width="200" height="200">
          					    	</div>
          					    	<div class="col-md-4">
          					    		<div class="form-group">
                            <div class = "row">
                              <div class = "col-md-12">
                                <h6><b>FLWR-{{$bouq->flower_ID}}</b></h6>
                              </div>
                            </div>
                            <div class = "row">
                              <div class = "col-md-3">
                                <h6><b>Name: </b></h6>
                              </div>
                              <div class = "col-md-9">
                                <h6>{{$bouq->flower_name}}</h6>
                              </div>
                            </div>
                            <div class = "row">
                              <div class = "col-md-3">
                                <h6><b>Price: </b></h6>
                              </div>
                              <div class = "col-md-9">
                                <h6 style = "color:red;">Php {{number_format($bouq -> Final_SellingPrice,2)}}</h6>
                              </div>
                            </div>
          									<label for="usr">Quantity</label>
                            <input type="hidden" value="{{ $bouq -> Final_SellingPrice }}" name="fp">
                            <input type="hidden" value="{{ $bouq -> flower_ID }}" name="ID" >

                            <input type="number" class="form-control" placeholder="0" name="qty"
                              min = "1" required>

          								</div>
          					    	</div>
          					    </div>

                        <br>
                        <br>

                        <div class="modal-footer">
            				      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            				      <button type="submit" class="btn btn-success"> Add</button></a>
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
							<div class="tab-pane" id="accessories">
								<h4 class="container">
									Choose Accessories For Your Bouquet
								</h4>

								<div class="row">

                  @foreach($bouqacc as $bouqa)

									<div class=" col-sm-3" style="margin-top: 10px;">
										<div class="thumbnail">
											<img style="max-width: 165px; max-height: 165px; min-width: 165px; min-height: 165px;" class="group list-group-image" src="{{ asset('accimage/'. $bouqa -> image)}}">
										</div>
										<div class="caption">
                                  <span> <h5> {{ $bouqa -> name }} </h5> </span>
					                        <hr class="colorgraph">
				                            <div class="row">
                                      <div class="col-sm-6">
                                          <span class="label label-danger"> Php {{ number_format($bouqa -> price,2) }}</span>
                                      </div>
				                                <div class="col-sm-6">
				                                    <a class="btn btn-sm btn-success" href=""  data-toggle="modal" data-target="#accessoriesmodal{{$bouqa -> Accesories_ID}}">  <span class="glyphicon glyphicon-ok"></span> Select</a>
				                                </div>
				                            </div>
				                        </div>
									</div>

                  <div class="modal fade" id="accessoriesmodal{{$bouqa -> Accesories_ID}}" role="dialog">
            				<div class="modal-dialog">

            				  <!-- Modal content-->
            				  <div class="modal-content">
            				    <div class="modal-header">
            				      <button type="button" class="close" data-dismiss="modal">&times;</button>
            				      <h4 class="modal-title">Accessory Details</h4>
            				    </div>
            				    <div class="modal-body">

                          <form method="post" action="{{ route('addaccbouq')}}">

            					    <div class="row">
            					    	<div class="col-md-4">
            					    		<img src="{{ asset('accimage/'. $bouqa->image)}}" class="img-thumbnail"  width="200" height="200">
            					    	</div>
            					    	<div class="col-md-4">
            					    		<div class="form-group">
                              <div class = "row">
                                <div class = "col-md-12">
                                  <h6><b>ACRS-{{$bouqa ->Accesories_ID}}</b></h6>
                                </div>
                              </div>
                              <div class = "row">
                                <div class = "col-md-3">
                                  <h6><b>Name: </b></h6>
                                </div>
                                <div class = "col-md-9">
                                  <h6>{{$bouqa ->name}}</h6>
                                </div>
                              </div>
                              <div class = "row">
                                <div class = "col-md-3">
                                  <h6><b>Price: </b></h6>
                                </div>
                                <div class = "col-md-9">
                                  <h6 style = "color:red;">Php {{number_format($bouqa ->price,2)}}</h6>
                                </div>
                              </div>
            									<label for="usr">Quantity</label>
                              <input type="hidden" value="{{ $bouqa ->price }}" name="fp2">
                              <input type="hidden" value="{{ $bouqa ->Accesories_ID}}" name="ID" >
            									<input type="number" class="form-control" id="usr" name="qty" min = "1">
            								</div>
            					    	</div>
            					    </div>

                          <br>
                         <br>
                         <div class="modal-footer">
                           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                           <button type="submit" class="btn btn-success"> Add</button>
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
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4" style="margin-top: 40px;" class="box box-solid">
        <div class = "row">
          <div class = "col-md-6">
            <h3 class="fonts">Bouquet Summary</h3>
          </div>
          <div class = "col-md-6">
            <?php
                $FlowersTAmt = str_replace(array(','), array(''), Cart::instance('tempflowercart')->subtotal());
                $AcrsTAmt = str_replace(array(','), array(''), Cart::instance('tempacccart')->subtotal());
                $Bqt_Cutrent_TAmt = $FlowersTAmt + $AcrsTAmt;
            ?>
            <label> Current Amount:</label>
            <input class = "form-control input-md" disabled style = "color:red;" value = "Php {{number_format($Bqt_Cutrent_TAmt,2)}}"">
            <!---->
          </div>
        </div>


				<table class="table table-striped" style="overflow-x:auto;" >
				  	<thead>
				    	<tr>

					      <th>Item</th>
					      <th>Price</th>
                <th>Quantity</th>
					      <th>Total</th>
                <th></th>

						</tr>
				  </thead>
				  <tbody>


            @foreach(Cart::instance('tempflowercart')->content() as $row1)
              {!! Form::model($row1, ['route'=>['update_QtyFlower_bqtSession', 'id' => $row1->id], 'method'=>'PUT'])!!}
            <tr>
				      <td>{{ $row1 ->name }}</td>
				      <td>Php {{ number_format($row1->price,2)}}</td>
				      <td class="qty">
                  <div class="form-group">
                    <input type="number" id="quantity" name = "quantity" value="{{ $row1->qty }}" class="form-control input-md" min = "1">
                  </div>
                </td>
              <td>Php {{number_format($row1->qty * $row1->price,2) }} </td>
              <td class = "row">
                <div class = "col-md-6">
                  <button type="submit" class="btn btn-sm btn-success glyphicon glyphicon-refresh"></button>
                </div>
                <div class = "col-md-6">
                  <input type="hidden" value="{{ Cart::instance('tempflowercart')->count() }}" id="check">
                  <a type="button" class="btn btn-sm btn-danger glyphicon glyphicon-trash" href="{{ route('deleteboqFlower_temp', ['id' => $row1->id])}}"></a>
                </div>
              </td>
            </tr>
            {!! Form::close() !!}

           @endforeach

            @foreach(Cart::instance('tempacccart')->content() as $row1)
                {!! Form::model($row1, ['route'=>['updateacc', 'id' => $row1->id], 'method'=>'PUT'])!!}
                <tr>
                    <td>{{ $row1 ->name }}</td>
                    <td>Php {{ number_format($row1->price,2)}}</td>
                    <td class="qty">
                        <div class="form-group">
                            <input type="number" id="quantity" name = "quantity" value="{{ $row1->qty }}" class="form-control input-md" min = "1">
                        </div>
                    </td>
                    <td>Php {{number_format($row1->qty * $row1->price,2) }} </td>
                    <td class = "row">
                        <div class = "col-md-6">
                            <button type="submit" class="btn btn-sm btn-success glyphicon glyphicon-refresh"></button>
                        </div>
                        <div class = "col-md-6">
                            <input type="hidden" value="{{ Cart::instance('tempflowercart')->count() }}" id="check">
                            <a type="button" class="btn btn-sm btn-danger glyphicon glyphicon-trash" href="{{ route('deleteboqAcrs_temp', ['id' => $row1->id])}}"></a>
                        </div>
                    </td>
                </tr>
                {!! Form::close() !!}

            @endforeach


				  </tbody>
				</table>
        <a class="btn btn-success btn-md" href="{{route('finalcheck')}}"  type="submit" id="but1">

          <span class="glyphicon glyphicon-shopping-cart"></span> Add To My Cart

        </a>

         <br>
         {{ csrf_field() }}
         </form>
			</div>
		</div>

		<!-- Modal -->




	</div>




@endsection

@section('script')

    <script>

        $(document).ready(function (){

          if($('#addflowertobouquetSession').val() == 'Successful'){
        swal('Success!','the flower was successfully added to the Bouquet','success');
         }
         if($('#updateflowertobouquetSession').val() == 'Successful'){
        swal('Success!','the quantity was successfully updated to the Bouquet','success');
         }
         if($('#deleteflowertobouquetSession').val() == 'Successful'){
        swal('Success!','the flower was successfully removed to the Bouquet','success');
         }
         if($('#updateacctobouquetSession').val() == 'Successful'){
        swal('Success!','the quantity was successfully updated to the Bouquet','success');
        }
        if($('#addacctobouquetSession').val() == 'Successful'){
        swal('Success!','the accessories was successfully addded to the Bouquet','success');
        }
        if($('#deleteacctobouquetSession').val() == 'Successful'){
        swal('Success!','the accessories was successfully removed to the Bouquet','success');
        }



          $("#but1").attr('disabled',true);


          var quan = $("#check").val();

          console.log(quan);

          if( quan >= 12){
            $("#but1").attr('disabled',false);

          }
          else{
            $("#but1").attr('disabled',true);

          }


        });

        $('#table1').DataTable({
           "paging": true,
          "lengthChange": true,
          "ordering": true,
          "info": true,
          "autoWidth": true
        });


    </script>


@endsection
