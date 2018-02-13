@extends('main')

@section('content')
   <?php
   /*Cart::instance('overallFLowers')->destroy();


     Cart::instance('TobeSubmitted_FlowersQuick')->destroy();
     Cart::instance('TobeSubmitted_BqtQuick')->destroy();
     Cart::instance('TobeSubmitted_Bqt_FlowersQuick')->destroy();

     Cart::instance('QuickOrdered_Flowers')->destroy();

     Cart::instance('QuickFinalBqt_Flowers')->destroy();
     Cart::instance('QuickFinalBqt_Acessories')->destroy();

       Cart::instance('QuickOrderedBqt_Flowers')->destroy();
       Cart::instance('BatchesofFLowers')->destroy();
*/
  $addingFlower_ValueSession = Session::get('AddingFlowerTocartSession');
  Session::remove('AddingFlowerTocartSession');

   $clearBqtSession_Value = Session::get('QuickBqtClearSession');
   Session::remove('QuickBqtClearSession');

   $Updating_BouquetQtyError = Session::get('BqtCount_UpdateSession');
   Session::remove('BqtCount_UpdateSession');

   $QtyError = Session::get('error');
   Session::remove('error');

   $UpdateBqtSessionValue = explode("_",$Updating_BouquetQtyError);

   //dd($UpdateBqtSessionValue);

   $clearCartSession_Value = Session::get('QuickCartClearSession');
   Session::remove('QuickCartClearSession');

  $sessionValue = Session::get('Added_FlowerToBQT_QuickOrder');
  Session::remove('Added_FlowerToBQT_QuickOrder');//determines the addition of new flower

  $sessionAcValue = Session::get('Added_AcessoryToBQT_QuickOrder');
  Session::remove('Added_AcessoryToBQT_QuickOrder');//determines the addition of new acessory

  $sessionUpdateFValue = Session::get('Update_FlowerToBQT_QuickOrder');
  Session::remove('Update_FlowerToBQT_QuickOrder');//deteremines the qty update of flower*/

  $sessionUpdateAcValue = Session::get('Update_AcessoryToBQT_QuickOrder');
  Session::remove('Update_AcessoryToBQT_QuickOrder');//deteremines the qty update of acessories*/

  $sessionDelFlowerValue = Session::get('Deleted_FlowerfromBQT_QuickOrder');
  Session::remove('Deleted_FlowerfromBQT_QuickOrder');//determines the deletion of flower

  $sessionDelAcessoryValue = Session::get('Deleted_AcessoryfromBQT_QuickOrder');
  Session::remove('Deleted_AcessoryfromBQT_QuickOrder');//determines the deletion of Acessory

  $SavingBouquetsessionValue = Session::get('Save_Bouqet_To_myQuickOrder');
  Session::remove('Save_Bouqet_To_myQuickOrder');//determines the addition of new flower

  $AddingFlowersessionValue = Session::get('AddFlower_To_myQuickOrder');
  Session::remove('AddFlower_To_myQuickOrder');//determines the addition of new flower

  $AddingOrdersessionValue = Session::get('Add_Order_ofCustomer');
  Session::remove('Add_Order_ofCustomer');//determines the addition of new flower

  $CancelOBQTsessionValue = Session::get('Buquet_Cancelation');
  Session::remove('Buquet_Cancelation');//determines the addition of new flower

  $DeletionofFlowerOrderSessionValue = Session::get('Deleted_Flowerfrom_QuickOrder');
  Session::remove('Deleted_Flowerfrom_QuickOrder');//determines the deletion of a flower flower

  $UpadteofBouquetOrderSessionValue = Session::get('Update_Bouqet_To_myQuickOrder');
  Session::remove('Update_Bouqet_To_myQuickOrder');//determines the deletion of a flower flower

  $DeletionofBouquetSessionValue = Session::get('Deleted_BouquetFrom_QuickOrder');
  Session::remove('Deleted_BouquetFrom_QuickOrder');//determines the deletion of a flower flower



    $NewOrderDetailsRows = Session::get('newOrderSession');
    $Flower_Total_Amt = 0;
    $Bqt_Total_Amt = 0;
    $order_ID = 0;

    $final_Amt = str_replace(',','',Cart::instance('QuickOrdered_Flowers')->subtotal()) + str_replace(',','',Cart::instance('QuickOrdered_Bqt')->subtotal());

    //$NewOrderDetailsRows = Session::get('newOrderSession');

	$Flower_Count = 0;//for the count of flowers
   ?>

  @foreach(Cart::instance('QuickOrderedBqt_Flowers')->content() as $Flowersrow)
  <?php
   $Flower_Count += $Flowersrow->qty;
  ?>
  @endforeach
  <div hidden>
  <br>
    <input id = 'count_offlowers_Field' value = "{{$Flower_Count}}">
  </div>

<div hidden>


  <input id = "UpdateBqt_invalidresult" value = "{{$UpdateBqtSessionValue[0]}}">
  <input id = "ClearBqt_result" value = "{{$clearBqtSession_Value}}">
  <input id = "ClearCart_result" value = "{{$clearCartSession_Value}}">
  <input id = "DeleteBqt_result" value = "{{$DeletionofBouquetSessionValue}}">


  <input id = "InvalidAddingFlwr_result" value = "{{$addingFlower_ValueSession}}">


  <input id = "AddFlower_result" value = "{{$sessionValue}}">
  <input id = "AddAcessory_result" value = "{{$sessionAcValue}}">
  <input id = "UpdateFlower_result" value = "{{$sessionUpdateFValue}}">
  <input id = "UpdateBouquet_result" value = "{{$UpadteofBouquetOrderSessionValue}}">
  <input id = "UpdateAcessory_result" value = "{{$sessionUpdateAcValue}}">
  <input id = "DeleteFlower_result" value = "{{$sessionDelFlowerValue}}">
  <input id = "DeleteAcessory_result" value = "{{$sessionDelAcessoryValue}}">

  <input id = "Delete_FlowerSessionValue" value = "{{$DeletionofFlowerOrderSessionValue}}">
  <input id = "Saving_BouquetSessionValue" value = "{{$SavingBouquetsessionValue}}">
  <input id = "Adding_FlowerSessionValue" value = "{{$AddingFlowersessionValue}}">
  <input id = "Adding_OrderSessionValue" value = "{{$AddingOrdersessionValue}}">
  <input id = "Cancel_BQTSessionValue" value = "{{$CancelOBQTsessionValue}}">

  <input id = "QtyErrorNoValue" value="{{ $QtyError }}">

</div>


	<div class="container">
		<div class="row">
			<div class="col-md-6" style="margin-left: -7px;">
				<div class="title container" style="margin-top: 3%;">
					<h3>WONDERBLOOM FLOWERSHOP ORDERING</h3>
					<h4>Make a quick trasaction</h4>
					<h7>You will be obliged to choose from the flowers that are only available for now</h7>
				</div>

				<!-- Tabs with icons on Card -->
				<div class="card card-nav-tabs">
					<div class="header Sharp">
						<!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
						<div class="nav-tabs-navigation">
							<div class="nav-tabs-wrapper">
								<ul class="nav nav-tabs" data-tabs="tabs">
									<li class="active">
										<a href="#Flowers" data-toggle="tab">
											<i class="material-icons">face</i>
											Flowers
										</a>
									</li>
									<li>
										<a href="#Bouquets" data-toggle="tab">
											<i class="material-icons">chat</i>
											Bouquets
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="content">
						<div class="tab-content text-center">
							<div class="tab-pane active" id="Flowers">
							  @foreach($FlowerList as $Fdetails)
									<div class="col-sm-3">
										<img id = "Flwr_Image_Field" src="{{ asset('flowerimage/'.$Fdetails->IMG)}}" alt="Raised Image" class="img-rounded img-responsive img-raised Flwr_Image_Field" style="max-height: 105px; max-width: 105px;min-height: 105px; min-width: 105px;">
										<div hidden>
											<input class = "Flwr_ID_Field" value = "{{ $Fdetails->flower_ID }}">
											<input class = "Flwr_pic_Field" value = "{{ asset('flowerimage/'.$Fdetails->IMG)}}">
											<input class = "Flwr_name_Field" value = "{{ $Fdetails->flower_name}}">
											<input class = "Flwr_currentPrice_Field" value = "{{$Fdetails->Final_SellingPrice}}">
											<input class = "Flwr_QTY_Field" value = "{{$Fdetails->QTY}}">
                      <select class = "Flwr_batches_Field">
                        @foreach($batches as $batch)
                          @if($Fdetails->flower_ID == $batch->flower_ID)
                            <option value = "{{$batch->Batch}}" data-tag = "{{$batch->flower_ID}}" data-qty = "{{$batch->QTYRemaining}}" data-price = "{{$batch->SellingPrice}}">BATCH_({{$batch->Batch}}): Php {{number_format($batch->SellingPrice,2)}}</option>
                          @else
                          @endif
                        @endforeach
                      </select>
										</div>
										<a class="btn btn-sm Lemon Flower_Tab_Btn" data-toggle="modal" data-target="#flowerTab_modal"> QUICK VIEW</a>
	                </div>
                  @endforeach
							</div><!--end of active pane-->
							<div class="tab-pane" id="Bouquets">
								<div class="col-md-6">
									Flowers
                  <div class="row">
							     @foreach($FlowerList as $Fdetails)
										<div class="col-md-6">
											<img id = "bqtFlwr_Image_Field" src="{{ asset('flowerimage/'.$Fdetails->IMG)}}" alt="Raised Image" class="img-rounded img-responsive img-raised" style="max-height: 105px; max-width: 105px;min-height: 105px; min-width: 105px;">
										<div hidden>
											<input class = "BqtFlwr_ID_Field" value = "{{ $Fdetails->flower_ID }}">
											<input class = "BqtFlwr_pic_Field" value = "{{ asset('flowerimage/'.$Fdetails->IMG)}}">
											<input class = "BqtFlwr_name_Field" value = "{{ $Fdetails->flower_name}}">
											<input class = "BqtFlwr_currentPrice_Field" value = "{{$Fdetails->Final_SellingPrice}}">
                      <input class = "BqtFlwr_QTY_Field" value = "{{$Fdetails->QTY}}">
                      <select class = "BqtFlwr_batches_Field">
                        @foreach($batches as $batch)
                          @if($Fdetails->flower_ID == $batch->flower_ID)
                            <option value = "{{$batch->Batch}}" data-tag = "{{$batch->flower_ID}}" data-qty = "{{$batch->QTYRemaining}}" data-price = "{{$batch->SellingPrice}}">BATCH_({{$batch->Batch}}): Php {{number_format($batch->SellingPrice,2)}}</option>
                          @else
                          @endif
                        @endforeach
                      </select>
										</div>
											<a class="btn btn-sm Lemon BqtFlower_Btn" data-toggle="modal" data-target="#Bqtflower_modal"> QUICK VIEW</a>
										</div>
                    @endforeach
                  </div>


								</div>

								<div class="col-md-6">
									Accessories
									<div class="row">
									@foreach($accessories as $accessories)
										<div class="col-md-6" style="margin-bottom: 3%;">
											<img src="{{ asset('accimage/'.$accessories->image)}}" alt="Raised Image" class="img-rounded img-responsive img-raised" style="max-height: 105px; max-width: 105px;min-height: 105px; min-width: 105px;">
											<div hidden>
												<input class = "BqtAcrs_ID_Field" value = "{{ $accessories->ACC_ID }}">
												<input class = "BqtAcrs_pic_Field" value = "{{ asset('accimage/'.$accessories->image)}}">
												<input class = "BqtAcrs_imageValue_Field" value = "{{$accessories->image}}">
                        <input class = "BqtAcrs_name_Field" value = "{{$accessories->name}}">
												<input class = "BqtAcrs_Qty_Field" value = "{{$accessories->qty}}">
												<input class = "BqtAcrs_currentPrice_Field"
												   value = "{{$accessories->price}}">
											</div>
											<a class="btn btn-sm Lemon BqtAcrs_Btn" data-toggle="modal" data-target="#accessoriesmodal"> QUICK VIEW</a>
										</div>
    			         @endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div>
        <div class="col-md-6" style="margin-left: -20px; margin-top: 8%;">
        <div id = "progressDiv">
  					<div class="panel">
  						<div class="panel">
  							<div class="panel-heading Sharp">
              			<div class="panel-title">
                			<div class="row">
                  				<div class="col-xs-6">
                    				<h6 style="color: white"><span class="glyphicon glyphicon-user" style="color: white;"></span> Current Cart Content</h6>
                  				</div>
                			</div>
              			</div>
            		</div>
            		<div class="panel-body">
            		          <?php
                        $Flower_TAmt = 0;
                        $Total_Order_Amt = 0;
                      ?>
            			@foreach(Cart::instance('QuickOrdered_Flowers')->content() as $Flwr)
            			<div class="row">
                      <div class="col-xs-1" style="margin-right: 2%">
                        <img class="img-rounded img-raised img-responsive" style="min-width: 40px; max-height: 40px;" src="{{ asset('flowerimage/'.$Flwr->options['image'])}}">
                      </div>
                      <div class="col-xs-3">
                        <h6 class="product-name">(BATCH_{{$Flwr->options->batchID}}) <strong>{{$Flwr->name}}</strong></h6>
                      </div>
                      <div class="col-xs-3" style = "color:red; margin-top:3%;">
                        <h7>Php {{number_format($Flwr->price,2)}} <span class="text-muted"><b> x</b></span></h7>
                      </div>
                      <div class="col-md-1" style = "margin-top:3%; margin-left:-10%;">
                        <label> {{$Flwr->qty}}</label>
                      </div>
                      <div class="col-xs-2" style = "color:darkviolet; margin-top:3%;">
                        <h7><b>=</b> Php {{number_format($Flwr->qty*$Flwr->price,2)}}</h7>
                      </div>
                      <div class="col-xs-1">
                          <?php
                            $combinedID = $Flwr->options->batchID.'_'.$Flwr->id;
                          ?>
                      	<a href = "{{ route ('QuickOrders_Flowers.edit', $combinedID ) }}" class="btn Lemon btn-just-icon" data-toggle="tooltip" title="Update Quantity">
    											<i class="material-icons">mode_edit</i>
    										</a>
                      </div>
                      <div class="col-xs-1">
                      	<a href = "{{ route('Flowerorder.DelQuickOrderFlowers',['flower_ID'=>$Flwr->id,'batch'=>$Flwr->options->batchID]) }}" class="btn Love btn-just-icon" data-toggle="tooltip" title="Delete">
    											<i class="material-icons">delete</i>
    										</a>
                      </div>
              			</div>
                  @endforeach
                      <?php
                        $Flower_TAmt = str_replace(',','',Cart::instance('QuickOrdered_Flowers')->subtotal());
                        //$Total_Order_Amt += $Flower_TAmt;
                       ?>
                  <div class="col-xs-12">
                    <h5 class="text-right" style = "color:darkviolet"><strong>(Flowers)Total Amount:</strong> Php {{number_format($Flower_TAmt,2)}}</h5>
                  </div>
                <hr>
  <!-- List Of Bouquets on Cart-->
                  <?php
                    $total_BQT_Price = str_replace(',','',Cart::instance('QuickOrdered_Bqt')->subtotal());
                    ?>
           			@foreach(Cart::instance('QuickOrdered_Bqt')->content() as $Bqt)
                {!! Form::model($Bqt, ['route'=>['QuickSession_Bouquet.update', $Bqt->id],'method'=>'PUT'])!!}
                	<div class="row">
                      <div class="col-xs-2">
                        <h6 class="product-name"><strong>Bouquet-{{$Bqt->id}}</strong></h6>
                      </div>
                      <div class="col-xs-3" style = "color:red; margin-top:3%;">
                        <h7>Php {{number_format($Bqt->price,2)}} <span class="text-muted"><b> x</b></span></h7>
                      </div>
                      <div class="col-md-2">
                          <input type = "number" id = 'BouqQuantityField' name = 'BouqQuantityField' type="number" class="form-control input-sm" value="{{$Bqt->qty}}" min = "1" required >
                      </div>
                      <div class="col-xs-2" style = "color:darkviolet; margin-top:3%;">
                        <h7><b>=</b> Php {{number_format($Bqt->qty*$Bqt->price,2)}}</h7>
                      </div>
                      <div class="col-xs-1">
                      	<button type = "submit" class="btn Lemon btn-just-icon" data-toggle="tooltip" title="Update Quantity">
  						            <i class="material-icons">mode_edit</i>
                        </button>
                      </div>
                      <div class="col-xs-1">
                      	<a href = "{{ route('BqtorderSessions.DelQuickBouquet',['Bouquet_ID'=>$Bqt->id]) }}" class="btn Love btn-just-icon" data-toggle="tooltip" title="Delete">
  						           <i class="material-icons">delete</i>
                       </a>
                      </div>
              			</div>
                  {!! Form::close() !!}

                  @endforeach
                        <div class="col-xs-12">
                    <h5 class="text-right" style = "color:darkviolet"><strong>(Bouquet)Total Amount:</strong> Php {{ number_format($total_BQT_Price,2)}}</h5>
                  </div>
            		</div>
            		<div class="panel-footer">

            			<button id = "checkoutBtn" type="button" class="btn Lemon btn-sm"> Checkout </button>
            			<a href="{{route('QuickOrder.ClearCart')}}" type="button" class="btn Love btn-sm"> CLEAR CART</a>
            			 <h5 class="text-right"><strong>Total Amount:</strong> Php {{number_format($final_Amt,2)}}
            			 </h5>
            			 <div class = "hidden">
            			 		<input type = "number" id = "finalAmt_Field" value = {{$final_Amt}}>
            			 </div>
            		</div>
  						</div>
  					</div>
  					<div class="panel">
  						<div class="panel">
  							<div class="panel-heading Sharp">
                        			<div class="panel-title">
                          			<div class="row">
                            				<div class="col-xs-6">
                              				<h6 style="color: white"><span class="glyphicon glyphicon-user" style="color: white;"></span> Current Bouquet Content</h6>
                            				</div>
                          			</div>
                        			</div>
                      		</div>
                      		<div class="panel-body">
                  @foreach(Cart::instance('QuickOrderedBqt_Flowers')->content() as $BQT_Flowers)
          					{!! Form::model($BQT_Flowers, ['route'=>['QuickOrdersSession_Bouquet.update', $BQT_Flowers->id],'method'=>'PUT'])!!}
                      			<div class="row">
  			                        <div class="col-xs-1" style="margin-right: 2%"><img class="img-rounded img-raised img-responsive" style="min-width: 50px; max-height: 50px;" src="{{ asset('flowerimage/'.$BQT_Flowers->options['image'])}}">
  			                        </div>
  			                        <div class="col-xs-3">
  			                          <p class="product-name">(BATCH{{$BQT_Flowers->options->batchID}})</p><p><strong>{{$BQT_Flowers->name}}</strong></p>
  			                        </div>
  			                        <div class="col-xs-3" style = "color:red; margin-top:3%; margin-left:-5%;">
  			                          <h7>Php {{number_format($BQT_Flowers->price,2)}} <span class="text-muted"><b> x</b></span></h7>
  			                        </div>
  			                        <div class="col-md-2" style = "margin-top:-1%; margin-left:-7%;">
  			                          <input id = 'BqtFlwr_QuantityField' name = 'BqtFlwr_QuantityField' type="number" class="form-control input-sm" value="{{$BQT_Flowers->qty}}" min = "1" required>
  			                        </div>
                                <div hidden class="col-md-2">
                                  <input id = 'orig_Field' name = 'orig_Field' class="form-control input-sm" value="{{$BQT_Flowers->options['orig_price']}}">
                                  <input id = 'Decision_Field2' name = 'Decision_Field2' class="form-control input-sm" value="{{$BQT_Flowers->options['priceType']}}">
  			                          <input id = 'batch_Field2' name = 'batch_Field2' class="form-control input-sm" value="{{$BQT_Flowers->options->batchID}}">
  			                        </div>
  			                        <div class="col-xs-2" style = "color:darkviolet; margin-top:3%;  margin-left:-2%;">
  			                          <h7><b>=</b> Php {{number_format($BQT_Flowers->price * $BQT_Flowers->qty,2)}}</h7>
  			                        </div>
  			                        <div class="col-xs-1">
  			                        	<button class="btn Lemon btn-just-icon" data-toggle="tooltip" title="Update Quantity">
              											<i class="material-icons">mode_edit</i>
              										</button>
  			                        </div>

  			                        <div class="col-xs-1">
  			                        	<a class="btn Love btn-just-icon" href ="{{ route('BqtFlowerorderSessions.DelQuickOrderFlowers',['flower_ID'=>$BQT_Flowers->id,'batch'=>$BQT_Flowers->options->batchID]) }}" data-toggle="tooltip" title="Delete">
              											<i class="material-icons">delete</i>
              										</a>
  			                        </div>
                        			</div>
  							{!! Form::close() !!}
                @endforeach
                      			<!---->
  		                @foreach(Cart::instance('QuickOrderedBqt_Acessories')->content() as $BQT_Acessories)
  					        {!! Form::model($BQT_Acessories, ['route'=>['QuickOrdersAcSession_Bouquet.update', $BQT_Acessories->id],'method'=>'PUT'])!!}
                      			<div class="row">
  			                        <div class="col-xs-1" style="margin-right: 2%"><img class="img-rounded img-raised img-responsive" style="min-width: 50px; max-height: 50px;" src="{{ asset('accimage/'.$BQT_Acessories->options['image'])}}">
  			                        </div>,
  			                        <div class="col-xs-2">
  			                          <h6 class="product-name"><strong>{{$BQT_Acessories->name}}</strong></h6>
  			                        </div>
  			                        <div class="col-xs-3" style = "color:red; margin-top:3%;">
  			                          <h7>Php {{number_format($BQT_Acessories->price,2)}} <span class="text-muted"><b> x</b></span></h7>
  			                        </div>
  			                        <div class="col-md-2" style = "margin-left:-5%;">
  				                          <input id = 'AcQuantityField' name = 'AcQuantityField' type="number" class="form-control input-sm" value="{{$BQT_Acessories->qty}}" min = "1" required>
  			                        </div>
                                <div class="col-md-2"  hidden>
                       				    <input id = 'Ac_ID_Field' name = 'Ac_ID_Field' class="form-control input-sm" value="{{$BQT_Acessories->id}}">
                     					    <input id = 'Decision_Field3' name = 'Decision_Field3' class="form-control input-sm" value="{{$BQT_Acessories->options['priceType']}}">
  			                        </div>
  			                        <div class="col-xs-2" style = "color:darkviolet; margin-top:3%;">
  			                          <h7><b>=</b> Php {{number_format($BQT_Acessories->price * $BQT_Acessories->qty,2)}}</h7>
  			                        </div>
  			                        <div class="col-xs-1">
  			                        	<button class="btn Lemon btn-just-icon" data-toggle="tooltip" title="Update Quantity">
              											<i class="material-icons">mode_edit</i>
              										</button>
  			                        </div>

  			                        <div class="col-xs-1">
  			                        	<a class="btn Love btn-just-icon" href ="{{ route('SessionQuickorder.DelAcessories',['Acessory_ID'=>$BQT_Acessories->id]) }}" data-toggle="tooltip" title="Delete">
              											<i class="material-icons">delete</i>
              										</a>
  			                        </div>
                        			</div>
  							{!! Form::close() !!}
                    			@endforeach
                      			<!---->
                      		</div>
                      		<div class="panel-footer">
  		                      <?php
  		                          $Flowers_subtotal = str_replace(array(','), array(''), Cart::instance('QuickOrderedBqt_Flowers')->subtotal());
  		                          $Acessories_subtotal = str_replace(array(','), array(''), Cart::instance('QuickOrderedBqt_Acessories')->subtotal());
  		                        ?>
                      			<a id = "saveBtn" href="{{route('BqtQuickorder.saveNewBouquet')}}" type="button" class="btn Lemon btn-sm" data-toggle="tooltip" data-placement="top" title="This Button will save the bouquet that you have created, also please be noted that if your flowers are less than 12 this button will not submit your Bouquet" data-container="body"> Add to Cart</a>
                      			<a  href = "{{route('QuickOrder.ClearBqt')}}" type="button" class="btn Love btn-sm"> Clear Bouquet</a>
                      			 <h5 class="text-right"><strong>Total Amount:</strong> Php {{number_format($Flowers_subtotal + $Acessories_subtotal,2)}} </h4>
                      		</div>
  						</div>
  					</div>
          </div><!-- end of progress div--->

            <div id = "Customer_Div" hidden>
              <div class="panel">
                <div class="panel">
                  <div class="panel-heading Sharp">
                      <div class="panel-title">
                        <div class="row">
                            <div class="col-xs-6">
                              <h6 style="color: white"><span class="glyphicon glyphicon-user" style="color: white;"></span> Current Cart Content</h6>
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="panel-body">
                  {!! Form::open(array('route' => 'QuickOrderSessionProcess.store', 'data-parsley-validate'=>'', 'method'=>'POST')) !!}
            						<div class="panel-body">
            							<h5 class="text-center">Customer Details</h5>
            							<div class="togglebutton">
            								<label>
            							    	<input type="checkbox" id = 'OnetimecheckBox' name="OnetimecheckBox">
            									One Time Customer?
            								</label>
            							</div>

            							<div hidden>
            								<input id = "Trans_typeField" name = "Trans_typeField" value = 'quick' />
            								<input id = "customer_stat" name = "customer_stat" value = 'old' />
            						 </div>

            							<div id = "Customer_Chooser">
            								<input id = "customerList_Field" class = "form-control"  name="customerList_ID" list="customerList_ID" placeholder="Enter Customer ID/Customer Name"/>
            								<datalist id="customerList_ID">
            									<!--Foreach Loop data Here value = "Name" data-tag = "id"-->
          									@foreach($cust as $Cdetails)
          								    <option value="CUST_{{$Cdetails->Cust_ID}}" data-id = "{{$Cdetails->Cust_ID}}">
          											({{$Cdetails->Cust_FName}} {{$Cdetails->Cust_MName}} {{$Cdetails->Cust_LName}})
          										</option>
          									@endforeach
          									<!--Loop data Here-->
          								</datalist>
          							</div>

          							<div id = 'Customer_TradeDiv' hidden>
          								<select id = 'TradeList' name = 'TradeList' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
          									@foreach($CustTradeAgreements as $CTrade)
          										<option value = 'CUST_{{$CTrade->Customer_ID}}' data-tag ='{{$CTrade->Agreement_ID}}'>
          										{{$CTrade->Customer_ID}}
          										</option>
          									@endforeach
          								</select>
          							</div>

          							<div id = 'Customer_FNameDiv' hidden>
          								<select id = 'customerList_FName' name = 'customerList_FName' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
          									@foreach($cust as $Cdetails)
          										<option value = '{{$Cdetails->Cust_FName}}' data-tag ='CUST_{{$Cdetails->Cust_ID}}'>
          										{{$Cdetails->Cust_FName}}
          										</option>
          									@endforeach
          								</select>
          							</div>

          							<div id = 'Customer_MNameDiv' hidden>
          								<select id = 'customerList_MName' name = 'customerList_MName' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
          									@foreach($cust as $Cdetails)
          										<option value = '{{$Cdetails->Cust_MName}}' data-tag ='CUST_{{$Cdetails->Cust_ID}}'>
          										{{$Cdetails->Cust_MName}}
          										</option>
          									@endforeach
          								</select>
          							</div>

          							<div id = 'Customer_LNameDiv' hidden>
          								<select id = 'customerList_LName' name = 'customerList_LName' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
          									@foreach($cust as $Cdetails)
          										<option value = '{{$Cdetails->Cust_LName}}' data-tag ='CUST_{{$Cdetails->Cust_ID}}'>
          										{{$Cdetails->Cust_LName}}
          										</option>
          									@endforeach
          								</select>
          							</div>

          							<div id = 'Contact_NumDiv' hidden>
          								<select id = 'Contact_NumList_LName' name = 'Contact_NumList_LName' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
          									@foreach($cust as $Cdetails)
          										<option value = '{{$Cdetails->Contact_Num}}' data-tag ='CUST_{{$Cdetails->Cust_ID}}'>
          										 {{$Cdetails->Contact_Num}}
          										</option>
          									@endforeach
          								</select>
          							</div>

          							<div id = 'type_Div' hidden>
          								<select id = 'TypeList' name = 'TypeList' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
          									@foreach($cust as $Cdetails)
          										<option value = '{{$Cdetails->Customer_Type}}' data-tag ='CUST_{{$Cdetails->Cust_ID}}'>
          										 {{$Cdetails->Customer_Type}}
          										</option>
          									@endforeach
          								</select>
          							</div>

          							<div id = 'Email_AddDiv' hidden>
          								<select id = 'Email_AddList_LName' name = 'Email_AddList_LName' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
          									@foreach($cust as $Cdetails)
          										<option value = '{{$Cdetails->Email_Address}}' data-tag ='CUST_{{$Cdetails->Cust_ID}}'>
          										 {{$Cdetails->Email_Address}}
          										</option>
          									@endforeach
          								</select>
          							</div>

          							<div id = 'AdressLine_Div' hidden>
          								<select id = 'AdressLineList' name = 'AdressLineList' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
          									@foreach($cust as $Cdetails)
          										<option value = '{{$Cdetails->Address_Line}}' data-tag ='CUST_{{$Cdetails->Cust_ID}}'>
          										 {{$Cdetails->Address_Line}}
          										</option>
          									@endforeach
          								</select>

          								<select id = 'HotelNameList' name = 'HotelNameList' class = 'btn btn-primary btn-md'>
          									@foreach($cust as $Cdetails)
          										<option value = '{{$Cdetails->Hotel_Name}}' data-tag ='CUST_{{$Cdetails->Cust_ID}}'>
          										 {{$Cdetails->Hotel_Name}}
          										</option>
          									@endforeach
          								</select>

          								<select id = 'ShopNameList' name = 'ShopNameList' class = 'btn btn-primary btn-md'>
          									@foreach($cust as $Cdetails)
          										<option value = '{{$Cdetails->Shop_Name}}' data-tag ='CUST_{{$Cdetails->Cust_ID}}'>
          										 {{$Cdetails->Shop_Name}}
          										</option>
          									@endforeach
          								</select>

          								<select id = 'BrgyList' name = 'BrgyList' class = 'btn btn-primary btn-md' placeholder = "choose Customer ID">
          									@foreach($cust as $Cdetails)
          										<option value = '{{$Cdetails->Baranggay}}' data-tag ='CUST_{{$Cdetails->Cust_ID}}'>
          										 {{$Cdetails->Baranggay}}
          										</option>
          									@endforeach
          								</select>

          							<div class = 'col-md-6'>
          								<select class="form-control" name ="ProvField" id ="ProvField" >
          									@foreach($cust as $Cdetails)
          										<option value ="{{$Cdetails->Province}}" data-tag = "CUST_{{$Cdetails->Cust_ID}}"> {{$Cdetails->Province}} </option>
          									@endforeach
          								</select>
          							</div>

          							<div class = 'col-md-6'>
          								<select name="CityField" id="CityField" class="form-control" disabled>
          									@foreach($cust as $Cdetails)
          										<option value ="{{$Cdetails->Town}}" data-tag = "CUST_{{$Cdetails->Cust_ID}}"> {{$Cdetails->Town}} </option>
          									@endforeach
          								</select>
          							</div>
          							</div>

          							<div hidden>
          								<input id = 'idfield' name = 'idfield' class = 'form-control'>
          							</div>

          							<div class="row">
          								<div class="col-md-4">
          									<div id = "Fnamedisplaydiv" class="form-group label-floating">
          										<label class="control-label">First Name</label>
                              <input type="text" class="form-control" name="Cust_FNameField" id="Cust_FNameField" disabled required>
          										<input type="text" class="hidden form-control" name="Cust_FNameField2" id="Cust_FNameField2" required>
          									</div>
          								</div>
          								<div class="col-md-4">
          									<div id = "Mnamedisplaydiv" class="form-group label-floating">
          										<label class="control-label">Middle Name</label>
                              <input type="text" class="form-control" name="Cust_MNameField" id="Cust_MNameField">
          										<input type="text" class=" hidden form-control" name="Cust_MNameField2" id="Cust_MNameField2">
          									</div>
          								</div>
          								<div class="col-md-4">
          									<div id = "Lnamedisplaydiv" class="form-group label-floating">
          										<label class="control-label">Last Name</label>
                              <input type="text" class="form-control" name="Cust_LNameField" id="Cust_LNameField" disabled required>
          										<input type="text" class="hidden form-control" name="Cust_LNameField2" id="Cust_LNameField2" required>
          									</div>
          								</div>
          							</div>
          							<div class = "row">
                          <div class="col-sm-4">
                              <div id = "Contactdisplaydiv" class="form-group label-floating">
                                <label class="control-label">Number</label>
                                <input type="text" class="form-control" name="ContactNum_Field" id="ContactNum_Field" required/>
                                <input type="text" class="hidden form-control" name="ContactNum_Field2" id="ContactNum_Field2" required/>
                              </div>
                          </div>

                          <div class="col-sm-8">
                              <div id = "emailDisplayDiv" class="form-group label-floating">
                                <label class="control-label">Email Address</label>
                                <input type="text" class="form-control" name="email_Field" id="email_Field"  required/>
                                <input type="text" class="hidden form-control" name="email_Field2" id="email_Field2"/>
                              </div>
                          </div><!--end of column-->

                          <div class="form-group col-sm-12">
                              <label class="control-label">Customer Type:</label>
                                <select class="form-control" names ="custTypeField" id ="custTypeField">
                                    <option value ="C" > Single </option>
                                    <option value ="S" > Shop </option>
                                    <option value ="H" > Hotel </option>
                                </select>
                                <select class="hidden form-control" names ="custTypeField2" id ="custTypeField2">
                                    <option value ="C" > Single </option>
                                    <option value ="S" > Shop </option>
                                    <option value ="H" > Hotel </option>
                                </select>
                                <input class = "hidden" id = "custTypeFieldVal" name = "custTypeFieldVal" value ="C">
                          </div><!--end of column-->

          	              <div id = "HotelNamedisplaydiv" class = "row" hidden>
          	                <div  class="form-group col-md-7">
          	                      <label class="control-label">Hotel Name</label>
                                  <input type="text" class="form-control" name="hotelNameField" id="hotelNameField" disabled/>
          	                      <input type="text" class="hidden form-control" name="hotelNameField2" id="hotelNameField2"/>
          	                </div>
          	              </div><!--end of row-->

          	              <div id = "ShopNamedisplaydiv" class = "row" hidden>
          	                <div  class="form-group col-md-7">
          	                      <label class="control-label">Shop Name</label>
                                  <input type="text" class="form-control" name="shopNameField" id="shopNameField" disabled/>
          	                      <input type="text" class="hidden form-control" name="shopNameField2" id="shopNameField2" />
          	                </div>
          	              </div><!--end of row-->
          						</div>
          					 </div>
                  </div>
                  <div class="panel-footer">
                    <button id = "BackBtn" type="button" class="btn btn-sm btn-danger" > Back</button>
                    <button id = "Cust_Det_NextBtn" type="submit" class="btn btn-sm Lemon" disabled> Next</button>
                  </div>
              {!! Form::close() !!}
                </div>
              </div>
          </div><!--end of customer details-->
  			</div>
			</div>
		</div>
	</div>


	<!--MODAL FLOWER-->

	<!-- Modal Core -->
	<div class="modal fade" id="flowerTab_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
	    	<div class="modal-content">
        {!! Form::open(array('route' => 'QuickOrders_Flowers.store', 'data-parsley-validate'=>'', 'method'=>'POST')) !!}

	      	<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title text-center" id="myModalLabel"><b>FLOWER DETAILS</b></h4>
			    </div>
	    		<div class="modal-body">
	        		<div row>
	        			<div class="col-md-6">
	        				<img id = "FlWR_tab_Image" src="" class="img-rounded img-responsive img-raised">
	        			</div>
	        			<div class="col-md-6 text-left">
                  <div id = "batch_Chooser">
                    <input id = "batch_ID" class = "form-control"  name="batch_ID" list="batch_IDList" placeholder="Enter Batch number of the selected flower"/>
                    <datalist id="batch_IDList">
                    <!--Loop data Here-->
                    </datalist>
                  </div>
                <div id = "details_Div"></div>
                <div id = "sellingPrice_Div" hidden>
                  <button id = "showbatch_Chooser" class = "btn btn-md btn-primary">Choose Other Batch</button>
                  <div class="form-group">
                    <label class="control-label">Current Selling Price</label>
                    <input name="ViewPrice_Field" id="ViewPrice_Field" type="text" class="form-control text-right" style ="color:darkviolet;" value = "" disabled>
                  </div>

                  <div hidden> <!--start of hidden input field-->
                    <input type="number" class="form-control" name="OrigInputPrice_Field" id="OrigInputPrice_Field" step = '0.01'/>
                    <input type="number" class="form-control" name="FlwrID_Field" id="FlwrID_Field"/>

                    <input type="text" class="form-control" name="batch_IDField" id="batch_IDField" value = ""/>

                    <label>The decision</label>
                    <input type="text" class="form-control" name="Decision_Field" id="Decision_Field" value = 'O'/>
                  </div>      <!--end of hidden input field-->
                  <div class="togglebutton">
                    <label>
                      <input type="checkbox" name = "NewPriceCheckBox1" id = "NewPriceCheckBox1">
                      <b>New Price?</b>
                    </label>
                  </div>
                  <div id = 'NewPrice_Div' hidden>
                    <div class="form-group">
                      <label class = 'control-label'>New Price:</label>
                      <input type="number" class="form-control" name="NewPrice_Field" id="NewPrice_Field" value = '' step = "0.01" min = '1.00'/>
                    </div>
                  </div>
                  <div id = 'availableQTYDIV'>
                    <div  class="input-group" >
                      <label class = 'control-label'>Available Quantity:</label>
                      <input type="text" class="form-control" name="AvailableQty_Field" id="AvailableQty_Field" disabled/>
                    </div>
                  </div>
                  <div id = 'QTY_Div'>
                    <div class="form-group label-floating">
                      <label class = 'control-label'>Quantity:</label>
                      <input type="number" class="form-control" name="QTY_Field" id="QTY_Field"  placeholder="" min = '1' required/>
                    </div>
                  </div>
                  <div id = 'TAmt_Div'>
                    <div class="input-group">
                      <label class = 'control-label'>Total Amount: </label>
                      <input type="text" class="form-control text-right" style ="color:darkviolet;" name="total_Amt" id="total_Amt"  value ="Php 0.00" disabled/>
                    </div>
                  </div>
                </div>
			        </div>
	        	</div>
	    		</div>

	    		<div class="modal-footer">
			    	<br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
			    	<br> <br> <br>
			        <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Close</button>
			        <button id = "flwr_AddTocartBTN" type="submit" class="btn btn-success btn-simple">Add To Cart</button>
			    </div>

            {!! Form::close() !!}

	    	</div>
	  	</div>
	</div>


	<!--MODAL Bouquet FLOWER-->

	<!-- Modal Core -->
	<div class="modal fade" id="Bqtflower_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
	    	<div class="modal-content">
    {!! Form::open(array('route' => 'QuickOrdersSession_Bouquet.store', 'data-parsley-validate'=>'', 'files' => 'true', 'method'=>'POST')) !!}

          <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title text-center" id="myModalLabel"><b>FLOWER DETAILS</b></h4>
			    </div>
	    		<div class="modal-body">
	        		<div row>
	        			<div class="col-md-6">
	        				<img id = "BqtFlWR_tab_Image" src="" class="img-rounded img-responsive img-raised">
	        			</div>
	        			<div class="col-md-6 text-left">
                  <div id = "bqtbatch_Chooser">
                    <input id = "bqtbatch_ID" class = "form-control"  name="bqtbatch_ID" list="bqtbatch_IDList" placeholder="Enter Batch number of the selected flower"/>
                    <datalist id="bqtbatch_IDList">
                    <!--Loop data Here-->
                    </datalist>
                  </div>
                  <div id = "bqtdetails_Div"></div>
                  <div  id = "BqtsellingPrice_Div" hidden>
                    <button id = "bqtshowbatch_Chooser" class = "btn btn-md btn-primary">Choose Other Batch</button>
                    <div class="form-group">
                      <label class="control-label">Current Selling Price</label>
                      <input name="BqtViewPrice_Field" id="BqtViewPrice_Field" type="text" class="form-control text-right" style ="color:darkviolet;" value = "" disabled>
                    </div>

                    <div hidden> <!--start of hidden input field-->
                      <input type="number" class="form-control" name="BqtOrigInputPrice_Field" id="BqtOrigInputPrice_Field" step = '0.01'/>
                      <input type="number" class="form-control" name="BqtFlwrID_Field" id="BqtFlwrID_Field"/>

                      <input type="text" class="form-control" name="Bqtbatch_IDField" id="Bqtbatch_IDField" value = ""/>

                      <label>The decision</label>
                      <input type="text" class="form-control" name = "BqtDecision_Field" id = "BqtDecision_Field" value = 'O'/>
                    </div>      <!--end of hidden input field-->
                    <div class="togglebutton">
                      <label>
                        <input type="checkbox" name = "BqtNewPriceCheckBox" id = "BqtNewPriceCheckBox">
                        <b>New Price?</b>
                      </label>
                    </div>
                    <div id = 'BqtNewPrice_Div' hidden>
                      <div class="form-group label-floating">
                        <label class = 'control-label'>New Price:</label>
                        <input type="number" class="form-control" name="BqtNewPrice_Field" id="BqtNewPrice_Field" value = '{{number_format($Fdetails->Final_SellingPrice,2)}}' step = "0.01" min = '0.0'/>
                      </div>
                    </div>
                    <div id = 'BqtavailableQTYDIV'>
                      <div  class="input-group" >
                        <label class = 'control-label'>Available Quantity:</label>
                        <input type="text" class="form-control" name="BqtAvailableQty_Field" id="BqtAvailableQty_Field"  placeholder="" disabled/>
                      </div>
                    </div>
                    <div id = 'BqtQTY_Div'>
                      <div class="form-group label-floating">
                        <label class = 'control-label'>Quantity:</label>
                        <input type="number" class="form-control" name="BqtQTY_Field" id="BqtQTY_Field"  placeholder="" min = '1' required/>
                      </div>
                    </div>
                    <div id = 'BqtTAmt_Div'>
                      <div class="input-group">
                        <label class = 'control-label'>Total Amount: </label>
                        <input type="text" class="form-control text-right" style ="color:darkviolet;" name="Bqttotal_Amt" id="Bqttotal_Amt"  value ="Php 0.00" disabled/>
                      </div>
                    </div>
                  </div><!---->
			        	</div>
	        		</div>
	    		  </div>

	    		<div class="modal-footer">
			    	<br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
			    	<br> <br> <br>
			        <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Close</button>
			        <button id = "Bqtflwr_AddTocartBTN" type="submit" class="btn btn-success btn-simple">Add To Cart</button>
			    </div>
            {!! Form::close() !!}

	    	</div>
	  	</div>
	</div>

	<!--MODAL Accessories-->

	<!-- Modal Core -->
	<div class="modal fade" id="accessoriesmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
	    	<div class="modal-content">
	    	{!! Form::open(array('route' => 'QuickOrdersAcSession_Bouquet.store', 'data-parsley-validate'=>'', 'files' => 'true', 'method'=>'POST')) !!}
	      		<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title text-center" id="myModalLabel">ACCESSORIES DETAILS</h4>
			    </div>
	    		<div class="modal-body">
	        		<div row>
	        			<div class="col-md-6">
	        				<img id = "Acrs_tab_Image" src="" class="img-rounded img-responsive img-raised">
	        			</div>
	        	<div class="col-md-6">
			        <div id = "AcrssellingPrice_Div" class="form-group">
								<label class= "control-label">Current Selling Price</label>
								<input name="AcessoryViewPrice_Field" id="AcessoryViewPrice_Field" type="text" class="form-control text-right" style ="color:darkviolet;" value = "" disabled>
							</div>
							<div hidden> <!--start of hidden input field-->
                    <input type="number" class="form-control" name="AcessoryOrigInputPrice_Field" id="AcessoryOrigInputPrice_Field" step = '0.01'/>

                    <input type="number" class="form-control" name="AcrsID_Field" id="AcrsID_Field"/>

                    <input type="text" class="form-control" name="AcrsName_Field" id="AcrsName_Field"/>

                    <input type="text" class="form-control" name="Acrs_Image_Field" id="Acrs_Image_Field"/>

                    <input type="text" class="form-control" name="Acrs_Availableqty_Field" id="Acrs_Availableqty_Field"/>

                    <label>The decision</label>
                    <input type="text" class="form-control" name = "AcessoryDecision_Field" id = "AcessoryDecision_Field" value = 'O'/>
              </div>      <!--end of hidden input field-->
							<div id = "divToggleBtnforAcessories" class="togglebutton" class="togglebutton">
								<label>
							    	<input type="checkbox" name = "NewAcessoryPriceCheckBox" id = "NewAcessoryPriceCheckBox">
									<b>New Price?</b>
								</label>
							</div>

             	<div id = 'NewPrice_DivforAcessories' hidden>
                 <div class="form-group label-floating">
                    <label class = 'control-label'>New Price:</label>
                    <input type="number" class="form-control" name="AcessoryNewPrice_Field" id="AcessoryNewPrice_Field" value = '1.00' step = "0.01" min = "0.0"/>
                 </div>
             	</div>

							<div id = 'BqtavailableQTYDIV'>
                  <div  class="input-group" >
                    <label class = 'control-label'>Available Quantity:</label>
                    <input type="text" class="form-control" name="AcrsAvailableQty_Field" id="AcrsAvailableQty_Field"  placeholder="" disabled/>
                  </div>
              </div>

	            <div id = 'QTY_Div'>
								<div class="form-group label-floating">
									<label class="control-label">Quantity</label>
									<input type="number" class="form-control" name = "AcessoryQTY_Field" id= "AcessoryQTY_Field" placeholder="" min = '1' required/>
								</div>
	            </div>

              <div id = 'BqtTAmt_Div'>
		             <div class="input-group">
                  		<label class = 'control-label'>Total Amount: </label>
                  		<input type="text" class="form-control text-right" style ="color:darkviolet;"
                        name="Acessorytotal_Amt" id="Acessorytotal_Amt"  value ="Php 0.00" disabled/>
                	</div>
                </div>

			        	</div>
	        		</div>
	    		</div>

	    		<div class="modal-footer">
			    	<br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
			    	<br> <br> <br>
			        <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Close</button>
			        <button type="submit" name = "AddAcessoryBtn" id = "AddAcessoryBtn" class="btn btn-success btn-simple">Add To Cart</button>
			    </div>
            {!! Form::close() !!}

	    	</div>
	  	</div>
	</div>

@endsection

@section('scripts')

  <script type="text/javascript">
      $(function () {
        $("#example2").DataTable();
        $('#BouqTable').DataTable({
          "paging": true,
          "info": true,
          "autoWidth": true
        });
        $('#flowersTable').DataTable({
          "paging": true,
          "info": true,
          "autoWidth": true
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

        $("#checkoutBtn").click(function(){
          $("#progressDiv").hide("fold");
          $("#Customer_Div").show("fold");
        });

        $("#BackBtn").click(function(){
          $("#progressDiv").show("fold");
          $("#Customer_Div").hide("fold");
        });


        if($('#count_offlowers_Field').val()<12){
          $('#saveBtn').attr('disabled',true);
          $('#saveBtn').click(function(){
            return false;
         });
        }//determines if the bouquet is at its limit

        if($('#finalAmt_Field').val() == 0){
          $('#checkoutBtn').attr('disabled',true);
          $('#checkoutBtn').click(function(){
            return false;
         });
       }//determines if the cart have items in it


    if($('#UpdateBqt_invalidresult').val()=='Fail'){
      //Show popup
      swal("Oops!","The system detected that you're trying to update the qty of a bouquet that has a flower that might exceed the available quantity of flowers in the inventory,please consider the available flowers in the inventory","error");
     }


    if($('#NewOrderDone_result').val()=='Successful'){
      //Show popup
      swal("Congratulations!","New Order was succesfully done!","success");
     }

	  if($('#ClearBqt_result').val()=='Successful'){
	    //Show popup
	    swal("Note:","Bouquet has Been Successfully Cleared!","info");
	   }

	  if($('#ClearCart_result').val()=='Successful'){
	    //Show popup
	    swal("Note:","Cart has been Successfully Cleared!","info");
	   }

     if($('#DeleteBqt_result').val()=='Successful'){
 	    //Show popup
 	    swal("Note:","Bouquet has been Successfully Deleted!","info");
 	   }


     if($('#InvalidAddingFlwr_result').val()=='Fail'){
 	    //Show popup
 	    swal("Sorry","The request cannot be accepted, this is because the batch that you have chosen to get flowers from cannot cupply the request based on the flowers on the cart!","error");
 	   }


	  if($('#DeleteAcessory_result').val()=='Successful'){
	    //Show popup
	    swal("Good!","Acessory has been removed!","success");
	   }


	  if($('#DeleteFlower_result').val()=='Successful'){
	    //Show popup
	    swal("Good!","Flower has been removed!","success");
	   }


    if($('#UpdateBouquet_result').val()=='Successful'){
      //Show popup
      swal("Good!","Bouquet's quantity has been updated!","success");
    }else if($('#UpdateBouquet_result').val()=='Fail'){
      swal("Sorry!","The quantity that you entered was the same with the previous quantity of the bouquet, no changes has been made!","warning");
    }else if($('#UpdateBouquet_result').val()=='Fail2'){
      swal("Sorry!","The request for an increase in the quantity of bouquet detected that there is a flower under that bouquet which might exceed the available quantity in the inventory!","error");
    }else if($('#UpdateBouquet_result').val()=='Fail3'){
      swal("Sorry!","The request for an increase in the quantity of bouquet detected that there is an accessory under that bouquet which might exceed the available quantity in the inventory!","error");
    }else if($('#UpdateBouquet_result').val()=='Fail4'){
      swal("Sorry!","The request for an increase in the quantity of bouquet detected that there is are accessories and flowers under that bouquet which might exceed the available quantity in the inventory!","error");
    }



	  if($('#UpdateFlower_result').val()=='Successful'){
	    //Show popup
	    swal("Good!","Flower's quantity has been updated!","success");
    }else if($('#UpdateFlower_result').val()=='Fail'){
     	    //Show popup
     	    swal("Sorry!","The quantity that you entered was the same with the previous quantity of the flower, therefore no changes has been made!","warning");
    }else if($('#UpdateFlower_result').val()=='Fail2'){
     	    //Show popup
     	    swal("The quantity requested was greater than the available quantity!","The quantity that you entered has exceeded the available flowers in the inventory. Therefore, no changes has been made!","warning");
     }else if($('#UpdateFlower_result').val()=='Fail3'){
      	    //Show popup
      	    swal("Cannot add flower to order!","The request exceeded the available flowers in the inventory, you cannot add the flower that your requested in your order. This is for the reason that the inventory cannot sustain it anymore!","error");
      }


	  if($('#UpdateAcessory_result').val()=='Successful'){
	    //Show popup
	    swal("Good!","Acessory's quantity has been updated!","success");
	   }

	  if($('#AddFlower_result').val()=='Successful'){
	    //Show popup
	    swal("Good!","Flower has been successfully added to Bouquet!","success");
    }else if($('#AddFlower_result').val()=='Fail2'){
     //Show popup
     swal("The quantity requested was greater than the available quantity!","The quantity that you entered has exceeded the available flowers in the inventory. Therefore, the flower was not added to the list of order.","warning");
   }else if($('#AddFlower_result').val()=='Fail3'){
     //Show popup
      swal("Cannot add flower to order!","The request exceeded the available flowers in the inventory, you cannot add the flower that your requested in your order. This is for the reason that the inventory cannot sustain it anymore!","error");
    }

	  if($('#AddAcessory_result').val()=='Successful'){
	    //Show popup
	    swal("Good!","Acessory has been successfully added to your Bouquet!","success");
    }else if($('#AddAcessory_result').val()=='Fail'){
	    //Show popup
	    swal("Sorry!","The request cannot be accomplished because the inventory could not supply that quantty based on the items that you've listed at at the cart before!","error");
    }

      if($('#Delete_FlowerSessionValue').val()=='Successful'){
         //Show popup
         swal("Good Job!:","Deletion of flower was Successfully done","success");
       }

      if($('#Cancel_BQTSessionValue').val()=='Successful'){
         //Show popup
         swal("Take Note:","Creation of bouquet was cancelled the progress of ceation will be reset","success");
       }

      if($('#Adding_OrderSessionValue').val()=='Successful'){
         //Show popup
         swal("Good Job!","Customer's details was obtained, you may now proceed to adding your desired items","success");
       }

      if($('#Saving_BouquetSessionValue').val()=='Successful'){
         //Show popup
         swal("Good Job!","Bouquet has been successfully made!","success");
       }

      if($('#Adding_FlowerSessionValue').val()=='Successful'){
         //Show popup
         swal("Good Job!","Flower has been successfully added to order!","success");
       }else if($('#Adding_FlowerSessionValue').val()=='Fail2'){
          //Show popup
           swal("The quantity requested was greater than the available quantity!","The quantity that you entered has exceeded the available flowers in the inventory. Therefore, the flower was not added to the list of order!","warning");
        }else if($('#Adding_FlowerSessionValue').val()=='Fail3'){
           //Show popup
           swal("Cannot add flower to order!","The request exceeded the available flowers in the inventory, you cannot add the flower that your requested in your order. This is for the reason that the inventory cannot sustain it anymore!","error");
         }
        //end of functionx



		$(document).on('click', '.BqtAcrs_Btn', function(){
			$("#Acrs_ID").remove();
			$("#Acrs_Name").remove();

			var index = $('.BqtAcrs_Btn').index(this);

			var Acrs_ID = $('.BqtAcrs_ID_Field').eq(index).val();
			var Acrs_IMG = $('.BqtAcrs_pic_Field').eq(index).val();
			var Acrs_Pic = $('.BqtAcrs_imageValue_Field').eq(index).val();
			var Acrs_Name = $('.BqtAcrs_name_Field').eq(index).val();
			var Acrs_Price = $('.BqtAcrs_currentPrice_Field').eq(index).val();
      var Acrs_Qty = $('.BqtAcrs_Qty_Field').eq(index).val();

			$('#AcessoryViewPrice_Field').val("Php " + Acrs_Price);
			$('#AcessoryOrigInputPrice_Field').val(Acrs_Price);
			$('#AcessoryNewPrice_Field').val(Acrs_Price);
			$('#AcrsID_Field').val(Acrs_ID);
			$('#AcrsName_Field').val(Acrs_Name);
			$('#Acrs_tab_Image').attr("src",Acrs_IMG);
      $('#Acrs_Image_Field').val(Acrs_Pic);
      $('#Acrs_Availableqty_Field').val(Acrs_Qty);
			$('#AcrsAvailableQty_Field').val(Acrs_Qty + 'pcs');

      $('#AcessoryQTY_Field').attr('max',Acrs_Qty);

			$('#AcrssellingPrice_Div').prepend('<h5 id = "Acrs_ID">FLWR-'+Acrs_ID+'</h5>'+'<h5 id = "Acrs_Name">'+Acrs_Name+'</h5>');
		});//


		$(document).on('click', '.Flower_Tab_Btn', function(){
      $('#batch_Chooser').show('fold');
      $('#sellingPrice_Div').hide();
      $('#flwr_AddTocartBTN').hide();
			$("#Flwr_ID").remove();
			$("#Flwr_Name").remove();

			var index = $('.Flower_Tab_Btn').index(this);

			var Flwr_ID = $('.Flwr_ID_Field').eq(index).val();
			var Flwr_IMG = $('.Flwr_pic_Field').eq(index).val();
			var Flwr_Name = $('.Flwr_name_Field').eq(index).val();
			//var Flwr_Price = $('.Flwr_currentPrice_Field').eq(index).val();
			//var Flwr_QTY = $('.Flwr_QTY_Field').eq(index).val();

      var options = '';
      document.getElementById('batch_IDList').innerHTML = options;
      $('.Flwr_batches_Field').eq(index).find('option').each(function(){
        options += '<option value = "' +$(this).val()+'" data-tag = "'+$(this).data("tag")+'" data-qty = "'+ $(this).data("qty")+'" data-price = "' + $(this).data("price")+ '"/>Php '+ parseFloat($(this).data("price")).toFixed(2) +'</option>';
      });
      //alert(options);

      document.getElementById('batch_IDList').innerHTML = options;

			$('#FlwrID_Field').val(Flwr_ID);
			$('#FlWR_tab_Image').attr("src",Flwr_IMG);

			$('#details_Div').prepend('<h5 id = "Flwr_ID">FLWR-'+Flwr_ID+'</h5>'+'<h5 id = "Flwr_Name">'+Flwr_Name+'</h5>');
		});


    $('#batch_ID').change(function(){
      var Found = 0;
      var price = 0;
      var qty = 0;
      var batch = 0;
      batchID = $('#batch_ID').val();
      $('#batch_IDList option').each(function(item){
        if(batchID == $(this).val()){
          Found = 1;
          price  = $(this).data("price");
          qty  = $(this).data("qty");
          batch = $(this).val();
        }
      });

      if(Found == 1){

        $('#ViewPrice_Field').val("Php " + parseFloat(price).toFixed(2));
        $('#OrigInputPrice_Field').val(price);
        $('#NewPrice_Field').val(price);
        $('#AvailableQty_Field').val(qty + "pcs");
        $('#QTY_Field').attr('min',1);
        $('#QTY_Field').attr('max',qty);
        $('#batch_IDField').val(batch);
        $('#sellingPrice_Div').show("fold");
        $('#flwr_AddTocartBTN').show('fold');
        $('#flwr_AddTocartBTN').attr('disabled',false);
        $('#batch_Chooser').hide('fold');
      }else{
        //if('')
        //the batch ID that you have chosen does not exist
        $('#ViewPrice_Field').val("");
        $('#OrigInputPrice_Field').val("");
        $('#NewPrice_Field').val("");
        $('#AvailableQty_Field').val("");
        $('#batch_IDField').val("");
        $('#flwr_AddTocartBTN').attr('disabled',true);
        $('#flwr_AddTocartBTN').hide('fold');
        $('#sellingPrice_Div').hide("fold");
      }

    });


    $('#showbatch_Chooser').click(function(){
      $('#sellingPrice_Div').hide("fold");
      $('#batch_Chooser').show('fold');
      $('#flwr_AddTocartBTN').attr('disabled',true);
      $('#flwr_AddTocartBTN').hide('fold');
    });


		$(document).on('click', '.BqtFlower_Btn', function(){
      $('#bqtbatch_Chooser').show('fold');
      $('#BqtsellingPrice_Div').hide();
      $('#Bqtflwr_AddTocartBTN').hide();

			$("#BqtFlwr_ID").remove();
			$("#BqtFlwr_Name").remove();
			var index = $('.BqtFlower_Btn').index(this);

			var Flwr_ID = $('.BqtFlwr_ID_Field').eq(index).val();
			var Flwr_IMG = $('.BqtFlwr_pic_Field').eq(index).val();
			var Flwr_Name = $('.BqtFlwr_name_Field').eq(index).val();
			//var Flwr_Price = $('.BqtFlwr_currentPrice_Field').eq(index).val();
      //var Flwr_Qty = $('.BqtFlwr_QTY_Field').eq(index).val();

      var options = '';
      document.getElementById('bqtbatch_IDList').innerHTML = options;
      $('.BqtFlwr_batches_Field').eq(index).find('option').each(function(){
        options += '<option value = "' +$(this).val()+'" data-tag = "'+$(this).data("tag")+'" data-qty = "'+ $(this).data("qty")+'" data-price = "' + $(this).data("price")+ '"/>Php '+ parseFloat($(this).data("price")).toFixed(2) +'</option>';
      });
      //alert(options);


      document.getElementById('bqtbatch_IDList').innerHTML = options;

      $('#FlwrID_Field').val(Flwr_ID);
      $('#FlWR_tab_Image').attr("src",Flwr_IMG);

      $('#bqtdetails_Div').prepend('<h5 id = "BqtFlwr_ID">FLWR-'+Flwr_ID+'</h5>'+'<h5 id = "BqtFlwr_Name">'+Flwr_Name+'</h5>');

      //$('#BqtAvailableQty_Field').val(Flwr_Qty + 'pcs.');
			//$('#BqtViewPrice_Field').val("Php " + Flwr_Price);
			//$('#BqtOrigInputPrice_Field').val(Flwr_Price);
			//$('#BqtNewPrice_Field').val(Flwr_Price);
			$('#BqtFlwrID_Field').val(Flwr_ID);
			$('#BqtFlWR_tab_Image').attr("src",Flwr_IMG);
			//$('#BqtsellingPrice_Div').prepend('<h5 id = "BqtFlwr_ID">FLWR-'+Flwr_ID+'</h5>'+'<h5 id = "BqtFlwr_Name">'+Flwr_Name+'</h5>');
			//alert(Flwr_IMG+ "---" +Flwr_Name +'----' + Flwr_ID + '---' +  Flwr_Price);
		});


    $('#bqtbatch_ID').change(function(){
      var Found = 0;
      var price = 0;
      var qty = 0;
      var batch = 0;
      bqtbatchID = $('#bqtbatch_ID').val();
      $('#bqtbatch_IDList option').each(function(item){
        if(bqtbatchID == $(this).val()){
          Found = 1;
          price  = $(this).data("price");
          qty  = $(this).data("qty");
          batch = $(this).val();
        }
      });

      if(Found == 1){

        $('#BqtViewPrice_Field').val("Php " + parseFloat(price).toFixed(2));
        $('#BqtOrigInputPrice_Field').val(price);
        $('#BqtNewPrice_Field').val(price);
        $('#BqtAvailableQty_Field').val(qty + "pcs");
        $('#BqtQTY_Field').attr('min',1);
        $('#BqtQTY_Field').attr('max',qty);
        $('#Bqtbatch_IDField').val(batch);
        $('#BqtsellingPrice_Div').show("fold");
        $('#Bqtflwr_AddTocartBTN').show('fold');
        $('#Bqtflwr_AddTocartBTN').attr('disabled',false);
        $('#bqtbatch_Chooser').hide('fold');
      }else{
        //if('')
        //the batch ID that you have chosen does not exist
        $('#BqtViewPrice_Field').val("");
        $('#BqtOrigInputPrice_Field').val("");
        $('#BqtNewPrice_Field').val("");
        $('#BqtAvailableQty_Field').val("");
        $('#bqtbatch_IDField').val("");
        $('#Bqtflwr_AddTocartBTN').attr('disabled',true);
        $('#Bqtflwr_AddTocartBTN').hide('fold');
        $('#BqtsellingPrice_Div').hide("fold");
      }
    });


    $('#bqtshowbatch_Chooser').click(function(){
      $('#BqtsellingPrice_Div').hide("fold");
      $('#bqtbatch_Chooser').show('fold');
      $('#Bqtflwr_AddTocartBTN').attr('disabled',true);
      $('#Bqtflwr_AddTocartBTN').hide('fold');
    });



        $('#OrigInputPrice_Field').change(function(){
           var NewTAmt =  $('#OrigInputPrice_Field').val() * $("#QTY_Field").val();
           var FinalTAmt = 'Php '+ NewTAmt;
           $('#total_Amt').val(FinalTAmt);
            $('#QTY_Field').change(function(){
           var NewTAmt =  $('#OrigInputPrice_Field').val() * $("#QTY_Field").val();
           var FinalTAmt = 'Php '+ NewTAmt;
           $('#total_Amt').val(FinalTAmt);
          });

        });


	    $('#QTY_Field').change(function(){
	      	if($('#Decision_Field').val() == 'O'){
		       var NewTAmt =  $('#OrigInputPrice_Field').val() * $("#QTY_Field").val();
		       var FinalTAmt = 'Php '+ NewTAmt;
		       $('#total_Amt').val(FinalTAmt);
	      	}
	      	else{
	      	   var NewTAmt =  $('#NewPrice_Field').val() * $("#QTY_Field").val();
               var FinalTAmt = 'Php '+ NewTAmt;
               $('#total_Amt').val(FinalTAmt);
	      	}
	    });

        $('#NewPriceCheckBox1').click(function(){
            var Descision = '';
          //$('#Customer_Chooser').fadeToggle(300);
          if($('#NewPriceCheckBox1').is(':checked') == true){
            console.log('pasok');
             Descision = 'N';
               console.log(Descision);

            $('#NewPrice_Div').slideDown();
            $('#NewPrice_Field').attr('required',true);
            $('#Decision_Field').val(Descision);
              $('#NewPrice_Field').change(function(){
               var NewTAmt =  $('#NewPrice_Field').val() * $("#QTY_Field").val();
               var FinalTAmt = 'Php '+ NewTAmt;
               $('#total_Amt').val(FinalTAmt);
              });

              $('#QTY_Field').change(function(){
               var NewTAmt =  $('#NewPrice_Field').val() * $("#QTY_Field").val();
               var FinalTAmt = 'Php '+ NewTAmt;
               $('#total_Amt').val(FinalTAmt);
              });
           }
           else{
            $('#NewPrice_Div').slideUp();
               Descision = 'O';
              $('#NewPrice_Field').attr('required',false);
              $('#Decision_Field').val(Descision);

              $('#OrigInputPrice_Field').change(function(){
               var NewTAmt =  $('#OrigInputPrice_Field').val() * $("#QTY_Field").val();
               var FinalTAmt = 'Php '+ NewTAmt;
               $('#total_Amt').val(FinalTAmt);
              });

              $('#QTY_Field').change(function(){
               var NewTAmt =  $('#OrigInputPrice_Field').val() * $("#QTY_Field").val();
               var FinalTAmt = 'Php '+ NewTAmt;
               $('#total_Amt').val(FinalTAmt);
              });
           }
        }); //end of functionx
//----------------------------------------------------------------------------------------------------------------------------------

	    $('#AcessoryQTY_Field').change(function(){
	      	if($('#AcessoryDecision_Field').val() == 'O'){
		       var NewTAmt =  $('#AcessoryOrigInputPrice_Field').val() * $("#AcessoryQTY_Field").val();
		       var FinalTAmt = 'Php '+ NewTAmt;
		       $('#Acessorytotal_Amt').val(FinalTAmt);
	      	}
	      	else{
	      	   var NewTAmt =  $('#AcessoryNewPrice_Field').val() * $("#AcessoryQTY_Field").val();
               var FinalTAmt = 'Php '+ NewTAmt;
               $('#Acessorytotal_Amt').val(FinalTAmt);
	      	}
	    });

          $('#NewAcessoryPriceCheckBox').click(function(){
            var AcessoryDescision = '';
          //$('#Customer_Chooser').fadeToggle(300);
          if($('#NewAcessoryPriceCheckBox').is(':checked') == true){
              console.log('pasok');
               AcessoryDescision = 'N';
               console.log(AcessoryDescision);

              $('#NewPrice_DivforAcessories').slideDown();
              $('#AcessoryNewPrice_Field').attr('required',true);
              $('#AcessoryDecision_Field').val(AcessoryDescision);
                $('#AcessoryNewPrice_Field').change(function(){
                 var NewTAmt =  $('#AcessoryNewPrice_Field').val() * $("#AcessoryQTY_Field").val();
                 var FinalTAmt = 'Php '+ NewTAmt;
                 $('#Acessorytotal_Amt').val(FinalTAmt);
                });

                $('#AcessoryQTY_Field').change(function(){
                 var NewTAmt =  $('#AcessoryNewPrice_Field').val() * $("#AcessoryQTY_Field").val();
                 var FinalTAmt = 'Php '+ NewTAmt;
                 $('#Acessorytotal_Amt').val(FinalTAmt);
                });
           }//end of if
           else{
            $('#NewPrice_DivforAcessories').slideUp();
               AcessoryDescision = 'O';
               var Defaultprice = $('#AcessoryOrigInputPrice_Field').val();
              $('#AcessoryNewPrice_Field').attr('required',false);
              //$('#AcessoryNewPrice_Field').val(Defaultprice);
              $('#AcessoryDecision_Field').val(AcessoryDescision);

              $('#AcessoryQTY_Field').change(function(){
               var NewTAmt =  $('#AcessoryOrigInputPrice_Field').val() * $("#AcessoryQTY_Field").val();
               var FinalTAmt = 'Php '+ NewTAmt;
               $('#Acessorytotal_Amt').val(FinalTAmt);
              });
            }
      });



//----------------------------------------------------------------------------------------------------------------------------------
        $('#BqtOrigInputPrice_Field').change(function(){
           var NewTAmt =  $('#BqtOrigInputPrice_Field').val() * $("#BqtQTY_Field").val();
           var FinalTAmt = 'Php '+ NewTAmt;
           $('#Bqttotal_Amt').val(FinalTAmt);
            $('#BqtQTY_Field').change(function(){
           var NewTAmt =  $('#BqtOrigInputPrice_Field').val() * $("#BqtQTY_Field").val();
           var FinalTAmt = 'Php '+ NewTAmt;
           $('#Bqttotal_Amt').val(FinalTAmt);
          });

        });


	    $('#BqtQTY_Field').change(function(){
	      	if($('#BqtDecision_Field').val() == 'O'){
		       var NewTAmt =  $('#BqtOrigInputPrice_Field').val() * $("#BqtQTY_Field").val();
		       var FinalTAmt = 'Php '+ NewTAmt;
		       $('#Bqttotal_Amt').val(FinalTAmt);
	      	}
	      	else{
	      	   var NewTAmt =  $('#BqtNewPrice_Field').val() * $("#QTY_Field").val();
               var FinalTAmt = 'Php '+ NewTAmt;
               $('#Bqttotal_Amt').val(FinalTAmt);
	      	}
	    });




        $('#BqtNewPriceCheckBox').click(function(){
            var Descision = '';
          //$('#Customer_Chooser').fadeToggle(300);
          if($('#BqtNewPriceCheckBox').is(':checked') == true){
            console.log('pasok');
             Descision = 'N';
               console.log(Descision);

            $('#BqtNewPrice_Div').slideDown();
            $('#BqtNewPrice_Field').attr('required',true);
            $('#BqtDecision_Field').val(Descision);
              $('#BqtNewPrice_Field').change(function(){
               var NewTAmt =  $('#BqtNewPrice_Field').val() * $("#BqtQTY_Field").val();
               var FinalTAmt = 'Php '+ NewTAmt;
               $('#Bqttotal_Amt').val(FinalTAmt);
              });

              $('#BqtQTY_Field').change(function(){
               var NewTAmt =  $('#BqtNewPrice_Field').val() * $("#BqtQTY_Field").val();
               var FinalTAmt = 'Php '+ NewTAmt;
               $('#Bqttotal_Amt').val(FinalTAmt);
              });
           }
           else{
            $('#BqtNewPrice_Div').slideUp();
               Descision = 'O';
              $('#BqtNewPrice_Field').attr('required',false);
              $('#BqtDecision_Field').val(Descision);

              $('#BqtOrigInputPrice_Field').change(function(){
               var NewTAmt =  $('#BqtOrigInputPrice_Field').val() * $("#BqtQTY_Field").val();
               var FinalTAmt = 'Php '+ NewTAmt;
               $('#Bqttotal_Amt').val(FinalTAmt);
              });

              $('#BqtQTY_Field').change(function(){
               var NewTAmt =  $('#BqtOrigInputPrice_Field').val() * $("#BqtQTY_Field").val();
               var FinalTAmt = 'Php '+ NewTAmt;
               $('#Bqttotal_Amt').val(FinalTAmt);
              });
           }
        }); //end of functionx


//scripts for avoiding invalid characters in a number field
      $('#NewPrice_Field').on('keypress', function(key) {
        if(key.charCode < 48 || key.charCode > 57) return false;
      });

      $('#BqtNewPrice_Field').on('keypress', function(key) {
        if(key.charCode < 48 || key.charCode > 57) return false;
      });


      $('#AcessoryNewPrice_Field').on('keypress', function(key) {
        if(key.charCode < 48 || key.charCode > 57) return false;
      });

      $('#QTY_Field').on('keypress', function(key) {
        if(key.charCode < 48 || key.charCode > 57) return false;
      });

      $('#BqtQTY_Field').on('keypress', function(key) {
        if(key.charCode < 48 || key.charCode > 57) return false;
      });

      $('#AcessoryQTY_Field').on('keypress', function(key) {
        if(key.charCode < 48 || key.charCode > 57) return false;
      });
//end of scripts


//Customer Details Div -->
/*
$(function(){
   $("#Customer_details_Form").submit(function(event){
       event.preventDefault();
       var CustType = $('#custTypeField').val()
       var CustStatus = $('#customer_stat').val()

       $('#customerType').val(CustType);
       $('#customerStat').val(CustStatus);
       $("#Customer_DetailsDiv").hide("fold");//closes the current step the proceeds to the next step
     //resets the radio buttons
       $("#PickUp_Rdo").attr('checked',false);
       $('#Delivery_Rdo').attr('checked',false);
     //close the open forms incase they are open
       $('#pickUp_Div').hide("fold");
       $('#Delivery_Div').hide("fold");
       $("#ShippingMethod_Div").show("fold");
   });
});//end of form
*/

    var newcust = 'old';

    $("#Cust_FNameField").attr('disabled',true);
    $("#Cust_MNameField").attr('disabled',true);
    $("#Cust_LNameField").attr('disabled',true);
    $("#ContactNum_Field").attr('disabled',true);
    $("#email_Field").attr('disabled',true);
    $('#HotelNamedisplaydiv').attr('disabled',true);
    $('#ShopNamedisplaydiv').attr('disabled',true);
    $("#custTypeField").attr('disabled',true);

    var TradeApplication_URL = "{{ url('QuickOrder.Apply_CustTradeAgreement') }}";
    var CurrentPrice_URL = "{{ url('QuickOrder.Remove_CustTradeAgreement') }}";

    $('#customerList_Field').change(function(){
        var CustID = $("#customerList_Field").val();
        var HaveTrade = 0;

        $('#TradeList option').each(function(item){
          if(CustID == $(this).val()){
            HaveTrade = 1;
            swal('Note:','This Customer seem to have an active Trade Agreement in the shop, if ypu wish to select this customer the amount of all the items that you set will be decreased by 10% from its current selling price','warning');
          }
        });
        var Found = 0;
        $('#customerList_ID option').each(function(item){
          if(CustID == $(this).val()){
            Found = 1;
          }
        });

        if(HaveTrade == 1){
          //pag may trade agreement do this
          $.ajax({
              method: 'GET',
              url: typeof(TradeApplication_URL) != 'undefined' ? TradeApplication_URL : '',
              contentType: "application/json",
              success: function(){
                  //alert('May Agreements');
              },
              error: function(xhr, desc, err){
                  console.log('There is an error:'+ err);
              }
          });
        }
        else if(HaveTrade != 1){
          $.ajax({
              method: 'GET',
              url: typeof(CurrentPrice_URL) != 'undefined' ? CurrentPrice_URL : '',
              contentType: "application/json",
              success: function(){
                  //alert('Walang Agreements');
              },
              error: function(xhr, desc, err){
                  console.log('There is an error:'+ err);
              }
          });
        }

        if(Found == 1){
            $('#Cust_Det_NextBtn').attr("disabled",false);

            //alert('found');
            $("#Cust_Det_NextBtn").attr("disabled",false);
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

            $('#FinalCustomer_ID').val(selected);
            console.log($('#FinalCustomer_ID').val());

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


            $("#custTypeField2 option").each(function(item){
              var element =  $(this) ;
              if (element.val() != OptionTypeLine){
                //element.hide() ;
              }
              else{
                $("#custTypeField2 option[value ="+OptionTypeLine+"]").prop('selected',true);
              }
            });//end of function

            $("#custTypeFieldVal").val(OptionTypeLine);

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
          $("#Cust_FNameField2").val(OptionFname);
          $("#Cust_MNameField").val(OptionMname);
          $("#Cust_MNameField2").val(OptionMname);
          $("#Cust_LNameField").val(OptionLname);
          $("#Cust_LNameField2").val(OptionLname);
          $("#ContactNum_Field").val(OptionContactNum);
          $("#ContactNum_Field2").val(OptionContactNum);
          $("#email_Field").val(OptionEmail);
          $("#email_Field2").val(OptionEmail);
          $("#hotelNameField2").val(OptionHotelnameLine);
          $("#hotelNameField").val(OptionHotelnameLine);
          $("#shopNameField").val(OptionShopnameLine);
          $("#shopNameField2").val(OptionShopnameLine);
        }
        else{
          $('#FinalCustomer_ID').val(null);
          //this is for outputing the values of fields so that the labels ae not overlapping to the values
            $('#Fnamedisplaydiv').removeClass("form-group");
            $('#Fnamedisplaydiv').addClass("form-group label-floating");
            $('#Mnamedisplaydiv').removeClass("form-group");
            $('#Mnamedisplaydiv').addClass("form-group label-floating");
            $('#Lnamedisplaydiv').removeClass("form-group");
            $('#Lnamedisplaydiv').addClass("form-group label-floating");
            $('#AdrLinedisplaydiv').removeClass("form-group");
            $('#AdrLinedisplaydiv').addClass("form-group label-floating");
            $('#Brgydisplaydiv').removeClass("form-group");
            $('#Brgydisplaydiv').addClass("form-group label-floating");
            $('#Contactdisplaydiv').removeClass("form-group");
            $('#Contactdisplaydiv').addClass("form-group label-floating");
            $('#emailDisplayDiv').removeClass("form-group");
            $('#emailDisplayDiv').addClass("form-group label-floating");

            $("#idfield").val(null);
            $("#Cust_FNameField").val(null);
            $("#Cust_MNameField").val(null);
            $("#Cust_LNameField").val(null);
            $("#ContactNum_Field").val(null);
            $("#email_Field").val(null);
            $("#Addrs_LineField").val(null);
            $("#brgyField").val(null);
            $("#idfield").val(null);
            $("#Cust_FNameField2").val(null);
            $("#Cust_MNameField2").val(null);
            $("#Cust_LNameField2").val(null);
            $("#ContactNum_Field2").val(null);
            $("#email_Field2").val(null);

          swal('Sorry!','The Customer Id or Customer Name that you entered does not exist','warning')
          $("#Cust_Det_NextBtn").attr("disabled",true);
        }
  });//end of function


    $('#OnetimecheckBox').click(function(){
      if($('#OnetimecheckBox').is(':checked') == true){
        $('#FinalCustomer_ID').val(null);
        $('#Cust_Det_NextBtn').attr("disabled",false);
        $.ajax({
            method: 'GET',
            url: typeof(CurrentPrice_URL) != 'undefined' ? CurrentPrice_URL : '',
            contentType: "application/json",
            success: function(){
                //alert('Walang Agreements');
            },
            error: function(xhr, desc, err){
                console.log('There is an error:'+ err);
            }
        });
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

          $("#custTypeField2 option[value ='C']").prop('selected',true);
          $("#custTypeField option[value ='C']").prop('selected',true);
          $("#custTypeField").attr('disabled',true);
          $("#custTypeFieldVal").val('C');

          $('#HotelNamedisplaydiv').slideUp();
          $('#ShopNamedisplaydiv').slideUp();

          $("#idfield").val(null);
          $("#Cust_FNameField").val(null);
          $("#Cust_MNameField").val(null);
          $("#Cust_LNameField").val(null);
          $("#ContactNum_Field").val(null);
          $("#email_Field").val(null);
          $("#Addrs_LineField").val(null);
          $("#brgyField").val(null);
          $("#idfield2").val(null);
          $("#Cust_FNameField2").val(null);
          $("#Cust_MNameField2").val(null);
          $("#Cust_LNameField2").val(null);
          $("#ContactNum_Field2").val(null);
          $("#email_Field2").val(null);
          $("#Addrs_LineField2").val(null);
          $("#brgyField2").val(null);

          $("#Cust_FNameField").attr('required',true);
          $("#Cust_LNameField").attr('required',true);
          $("#ContactNum_Field").attr('required',true);
          $("#email_Field").attr('required',false);
          $("#ContactNum_Field").attr('required',false);
          $("#Addrs_LineField").attr('required',true);
          $("#brgyField").attr('required',true);

          $('#Fnamedisplaydiv').removeClass("form-group");
          $('#Fnamedisplaydiv').addClass("form-group label-floating");
          $('#Mnamedisplaydiv').removeClass("form-group");
          $('#Mnamedisplaydiv').addClass("form-group label-floating");
          $('#Lnamedisplaydiv').removeClass("form-group");
          $('#Lnamedisplaydiv').addClass("form-group label-floating");
          $('#AdrLinedisplaydiv').removeClass("form-group");
          $('#AdrLinedisplaydiv').addClass("form-group label-floating");
          $('#Brgydisplaydiv').removeClass("form-group");
          $('#Brgydisplaydiv').addClass("form-group label-floating");
          $('#Contactdisplaydiv').removeClass("form-group");
          $('#Contactdisplaydiv').addClass("form-group label-floating");
          $('#emailDisplayDiv').removeClass("form-group");
          $('#emailDisplayDiv').addClass("form-group label-floating");
       }
       else{
         var CustID = $("#customerList_Field").val();
         $('#FinalCustomer_ID').val(CustID);//for checking again
         $('#FinalCustomer_ID').val(null);
         $('#Customer_Chooser').slideDown(300);
         $('#Cust_Det_NextBtn').attr("disabled",true);
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
    $("#idfield").change(function(){
      var value = $("#idfield").val();
      $("#idfield2").val(value);
    });
    $("#Cust_FNameField").change(function(){
      var value = $("#Cust_FNameField").val();
      $("#Cust_FNameField2").val(value);
    });
    $("#Cust_MNameField").change(function(){
      var value = $("#Cust_MNameField").val();
      $("#Cust_MNameField2").val(value);
    });
    $("#Cust_LNameField").change(function(){
      var value = $("#Cust_LNameField").val();
      $("#Cust_LNameField2").val(value);
    });
    $("#ContactNum_Field").change(function(){
      var value = $("#ContactNum_Field").val();
      $("#ContactNum_Field2").val(value);
    });
    $("#email_Field").change(function(){
      var value = $("#email_Field").val();
      $("#email_Field2").val(value);
    });

    if($('#QtyErrorNoValue').val() == "error"){

      swal('Sorry Something Unexpected ');

    }
    else{

    }



  });
  </script>

@endsection
