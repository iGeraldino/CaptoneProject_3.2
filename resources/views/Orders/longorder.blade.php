@extends('main')

@section('content')
   <?php

   $clearBqtSession_Value = Session::get('BqtClearSession');
   Session::remove('BqtClearSession');


   $clearCartSession_Value = Session::get('CartClearSession');
   Session::remove('CartClearSession');

  $sessionValue = Session::get('Added_FlowerToBQT_Order');
  Session::remove('Added_FlowerToBQT_Order');//determines the addition of new flower

  $sessionAcValue = Session::get('Added_AcessoryToBQT_Order');
  Session::remove('Added_AcessoryToBQT_Order');//determines the addition of new acessory

  $sessionUpdateFValue = Session::get('Update_FlowerToBQT_Order');
  Session::remove('Update_FlowerToBQT_Order');//deteremines the qty update of flower*/

  $sessionUpdateAcValue = Session::get('Update_AcessoryToBQT_Order');
  Session::remove('Update_AcessoryToBQT_Order');//deteremines the qty update of acessories*/

  $sessionDelFlowerValue = Session::get('Deleted_FlowerfromBQT_Order');
  Session::remove('Deleted_FlowerfromBQT_Order');//determines the deletion of flower

  $sessionDelAcessoryValue = Session::get('Deleted_AcessoryfromBQT_Order');
  Session::remove('Deleted_AcessoryfromBQT_Order');//determines the deletion of Acessory


  $SavingBouquetsessionValue = Session::get('Save_Bouqet_To_myOrder');
  Session::remove('Save_Bouqet_To_myOrder');//determines the addition of new flower

  $AddingFlowersessionValue = Session::get('AddFlower_To_myOrder');
  Session::remove('AddFlower_To_myOrder');//determines the addition of new flower

  $AddingOrdersessionValue = Session::get('Add_Order_ofCustomer');
  Session::remove('Add_Order_ofCustomer');//determines the addition of new flower

  $CancelOBQTsessionValue = Session::get('Buquet_Cancelation');
  Session::remove('Buquet_Cancelation');//determines the addition of new flower

  $DeletionofFlowerOrderSessionValue = Session::get('Deleted_Flowerfrom_Order');
  Session::remove('Deleted_Flowerfrom_Order');//determines the deletion of a flower flower

    $NewOrderDetailsRows = Session::get('newOrderSession');
    $Flower_Total_Amt = 0;
    $Bqt_Total_Amt = 0;
    $order_ID = 0;

    $final_Amt = str_replace(',','',Cart::instance('Ordered_Flowers')->subtotal()) + str_replace(',','',Cart::instance('Ordered_Bqt')->subtotal());

    //$NewOrderDetailsRows = Session::get('newOrderSession');

	$Flower_Count = 0;//for the count of flowers
   ?>

  @foreach(Cart::instance('OrderedBqt_Flowers')->content() as $Flowersrow)
  <?php
   $Flower_Count += $Flowersrow->qty;
  ?>
  @endforeach
  <div hidden>
  <br>
    <input id = 'count_offlowers_Field' value = "{{$Flower_Count}}">
  </div>

<div hidden>

  <input id = "ClearBqt_result" value = "{{$clearBqtSession_Value}}">
  <input id = "ClearCart_result" value = "{{$clearCartSession_Value}}">

  <input id = "AddFlower_result" value = "{{$sessionValue}}">
  <input id = "AddAcessory_result" value = "{{$sessionAcValue}}">
  <input id = "UpdateFlower_result" value = "{{$sessionUpdateFValue}}">
  <input id = "UpdateAcessory_result" value = "{{$sessionUpdateAcValue}}">
  <input id = "DeleteFlower_result" value = "{{$sessionDelFlowerValue}}">
  <input id = "DeleteAcessory_result" value = "{{$sessionDelAcessoryValue}}">

  <input id = "Delete_FlowerSessionValue" value = "{{$DeletionofFlowerOrderSessionValue}}">
  <input id = "Saving_BouquetSessionValue" value = "{{$SavingBouquetsessionValue}}">
  <input id = "Adding_FlowerSessionValue" value = "{{$AddingFlowersessionValue}}">
  <input id = "Adding_OrderSessionValue" value = "{{$AddingOrdersessionValue}}">
  <input id = "Cancel_BQTSessionValue" value = "{{$CancelOBQTsessionValue}}">
</div>


	<div class="container">
		<div class="row">
			<div class="col-md-6" style="margin-left: -7px;">
				<div class="title container" style="margin-top: 3%;">
					<h3>WONDERBLOOM FLOWERSHOP ORDERING</h3>
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
								<div class="col-sm-3" style="margin-bottom: 3%;">
									<img id = "Flwr_Image_Field" src="{{ asset('flowerimage/'.$Fdetails->IMG)}}" alt="Raised Image" class="img-rounded img-responsive img-raised Flwr_Image_Field">
									<div hidden>
										<input class = "Flwr_ID_Field" value = "{{ $Fdetails->flower_ID }}">
										<input class = "Flwr_pic_Field" value = "{{ asset('flowerimage/'.$Fdetails->IMG)}}">
										<input class = "Flwr_name_Field" value = "{{ $Fdetails->flower_name}}">
										<input class = "Flwr_currentPrice_Field"
											   value = "{{$Fdetails->Final_SellingPrice}}">
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
										<div class="col-md-6" style="margin-bottom: 3%;">
											<img src="{{ asset('flowerimage/'.$Fdetails->IMG)}}" alt="Raised Image" class="img-rounded img-responsive img-raised">
										<div hidden>
											<input class = "BqtFlwr_ID_Field" value = "{{ $Fdetails->flower_ID }}">
											<input class = "BqtFlwr_pic_Field" value = "{{ asset('flowerimage/'.$Fdetails->IMG)}}">
											<input class = "BqtFlwr_name_Field" value = "{{ $Fdetails->flower_name}}">
											<input class = "BqtFlwr_currentPrice_Field"
											   value = "{{$Fdetails->Final_SellingPrice}}">
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
											<img src="{{ asset('accimage/'.$accessories->image)}}" alt="Raised Image" class="img-rounded img-responsive img-raised">
											<div hidden>
												<input class = "BqtAcrs_ID_Field" value = "{{ $accessories->ACC_ID }}">
												<input class = "BqtAcrs_pic_Field" value = "{{ asset('accimage/'.$accessories->image)}}">
												<input class = "BqtAcrs_imageValue_Field" value = "{{$accessories->image}}">
												<input class = "BqtAcrs_name_Field" value = "{{$accessories->name}}">
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
                    			@foreach(Cart::instance('Ordered_Flowers')->content() as $Flwr)
                    			<div class="row">
			                        <div class="col-xs-1" style="margin-right: 2%"><img class="img-rounded img-raised img-responsive" style="min-width: 40px; max-height: 40px;" src="{{ asset('flowerimage/'.$Flwr->options['image'])}}">
			                        </div>
			                        <div class="col-xs-2">
			                          <h6 class="product-name"><strong>{{$Flwr->name}}</strong></h6>
			                        </div>
			                        <div class="col-xs-3" style = "color:red; margin-top:3%;">
			                          <h7>{{number_format($Flwr->price,2)}} <span class="text-muted"><b> x</b></span></h7>
			                        </div>
			                        <div class="col-md-2" style = "margin-top:3%; margin-left:-10%;">
			                          <label>{{$Flwr->qty}} pcs.</label>
			                        </div>
			                        <div class="col-xs-2" style = "color:darkviolet; margin-top:3%;">
			                          <h7><b>=</b> Php {{number_format($Flwr->qty*$Flwr->price,2)}}</h7>
			                        </div>
			                        <div class="col-xs-1">
			                        	<a href = "{{ route ('Orders_Flowers.edit', $Flwr->id ) }}" class="btn Lemon btn-just-icon" data-toggle="tooltip" title="Update Quantity">
											<i class="material-icons">mode_edit</i>
										</a>
			                        </div>
			                        <div class="col-xs-1">
			                        	<a href = "{{ route('Flowerorder.DelOrderFlowers',['flower_ID'=>$Flwr->id]) }}" class="btn Love btn-just-icon" data-toggle="tooltip" title="Delete">
											<i class="material-icons">delete</i>
										</a>
			                        </div>
                      			</div>
			                    @endforeach
                                      <?php
				                        $Flower_TAmt = str_replace(',','',Cart::instance('Ordered_Flowers')->subtotal());
				                        //$Total_Order_Amt += $Flower_TAmt;
				                        ?>
                                <div class="col-xs-12">
			                          <h5 class="text-right" style = "color:darkviolet"><strong>(Flowers)Total Amount:</strong> Php {{number_format($Flower_TAmt,2)}}</h5>
			                    </div>
			                  <hr>
<!-- List Of Bouquets on Cart-->
		                      <?php

		                        $total_BQT_Price = str_replace(',','',Cart::instance('Ordered_Bqt')->subtotal());
		                        ?>
                   				@foreach(Cart::instance('Ordered_Bqt')->content() as $Bqt)
                    			<div class="row">
			                        <div class="col-xs-2">
			                          <h6 class="product-name"><strong>Bouquet-{{$Bqt->id}}</strong></h6>
			                        </div>
			                        <div class="col-xs-3" style = "color:red; margin-top:3%;">
			                          <h7>Php {{number_format($Bqt->price,2)}} <span class="text-muted"><b> x</b></span></h7>
			                        </div>
			                        <div class="col-md-2 " style = "margin-top:3%;">
			                          <label>{{$Bqt->qty}} pcs.</label>
			                        </div>
			                        <div class="col-xs-2" style = "color:darkviolet; margin-top:3%;">
			                          <h7><b>=</b> Php {{number_format($Bqt->qty*$Bqt->price,2)}}</h7>
			                        </div>
			                        <div class="col-xs-1">
			                        	<a class="btn Lemon btn-just-icon" data-toggle="tooltip" title="Update Quantity">
											            <i class="material-icons">mode_edit</i>
                                </a>
			                        </div>
			                        <div class="col-xs-1">
			                        	<button class="btn Love btn-just-icon" data-toggle="tooltip" title="Delete">
											           <i class="material-icons">delete</i>
										            </button>
			                        </div>
                      			</div>
			                    @endforeach
                                <div class="col-xs-12">
			                      <h5 class="text-right" style = "color:darkviolet"><strong>(Bouquet)Total Amount:</strong> Php {{ number_format($total_BQT_Price,2)}}</h5>
			                    </div>
                    		</div>
                    		<div class="panel-footer">

                    			<a id = "checkoutBtn" href="{{route('LongOrder.OrderSummary')}}" type="button" class="btn Lemon btn-sm"> Checkout </a>
                    			<a href="{{route('Order.ClearCart')}}" type="button" class="btn Love btn-sm"> CLEAR CART</a>
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
                    			<!---->


                  			@foreach(Cart::instance('OrderedBqt_Flowers')->content() as $BQT_Flowers)
        					{!! Form::model($BQT_Flowers, ['route'=>['OrdersSession_Bouquet.update', $BQT_Flowers->id],'method'=>'PUT'])!!}
                    			<div class="row">
			                        <div class="col-xs-1" style="margin-right: 2%"><img class="img-rounded img-raised img-responsive" style="min-width: 50px; max-height: 50px;" src="{{ asset('flowerimage/'.$BQT_Flowers->options['image'])}}">
			                        </div>
			                        <div class="col-xs-2">
			                          <h6 class="product-name"><strong>{{$BQT_Flowers->name}}</strong></h6>
			                        </div>
			                        <div class="col-xs-3" style = "color:red; margin-top:3%;">
			                          <h7>Php {{number_format($BQT_Flowers->price,2)}} <span class="text-muted"><b> x</b></span></h7>
			                        </div>
			                        <div class="col-md-2" style = "margin-top:3%; margin-left:-10%;">
			                          <input id = 'QuantityField' name = 'QuantityField' type="number" class="form-control input-sm" value="{{$BQT_Flowers->qty}}">
			                        </div>
                                    <div class="col-md-2"  hidden>
			                          <input id = 'Decision_Field' name = 'Decision_Field' class="form-control input-sm" value="{{$BQT_Flowers->options['priceType']}}">
			                        </div>
			                        <div class="col-xs-2" style = "color:darkviolet; margin-top:3%;">
			                          <h7><b>=</b> Php {{number_format($BQT_Flowers->price * $BQT_Flowers->qty,2)}}</h7>
			                        </div>
			                        <div class="col-xs-1">
			                        	<button class="btn Lemon btn-just-icon" data-toggle="tooltip" title="Update Quantity">
											<i class="material-icons">mode_edit</i>
										</button>
			                        </div>

			                        <div class="col-xs-1">
			                        	<a class="btn Love btn-just-icon" href ="{{ route('BqtFlowerorderSessions.DelOrderFlowers',['flower_ID'=>$BQT_Flowers->id]) }}" data-toggle="tooltip" title="Delete">
											<i class="material-icons">delete</i>
										</a>
			                        </div>
                      			</div>
							{!! Form::close() !!}
                  			@endforeach
                    			<!---->
		                @foreach(Cart::instance('OrderedBqt_Acessories')->content() as $BQT_Acessories)
					        {!! Form::model($BQT_Acessories, ['route'=>['OrdersAcSession_Bouquet.update', $BQT_Acessories->id],'method'=>'PUT'])!!}
                    			<div class="row">
			                        <div class="col-xs-1" style="margin-right: 2%"><img class="img-rounded img-raised img-responsive" style="min-width: 50px; max-height: 50px;" src="{{ asset('accimage/'.$BQT_Acessories->options['image'])}}">
			                        </div>
			                        <div class="col-xs-2">
			                          <h6 class="product-name"><strong>{{$BQT_Acessories->name}}</strong></h6>
			                        </div>
			                        <div class="col-xs-3" style = "color:red; margin-top:3%;">
			                          <h7>Php {{number_format($BQT_Acessories->price,2)}} <span class="text-muted"><b> x</b></span></h7>
			                        </div>
			                        <div class="col-md-2" style = "margin-top:3%; margin-left:-10%;">
				                          <input id = 'AcQuantityField' name = 'AcQuantityField' type="number" class="form-control input-sm" value="{{$BQT_Acessories->qty}}">
			                        </div>
                                    <div class="col-md-2"  hidden>
                     				    <input id = 'Ac_ID_Field' name = 'Ac_ID_Field' class="form-control input-sm" value="{{$BQT_Acessories->id}}">

                   					    <input id = 'Decision_Field' name = 'Decision_Field' class="form-control input-sm" value="{{$BQT_Acessories->options['priceType']}}">
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
			                        	<a class="btn Love btn-just-icon" href ="{{ route('Sessionorder.DelAcessories',['Acessory_ID'=>$BQT_Acessories->id]) }}" data-toggle="tooltip" title="Delete">
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
		                          $Flowers_subtotal = str_replace(array(','), array(''), Cart::instance('OrderedBqt_Flowers')->subtotal());
		                          $Acessories_subtotal = str_replace(array(','), array(''), Cart::instance('OrderedBqt_Acessories')->subtotal());
		                        ?>
                    			<a id = "saveBtn" href="{{route('Bqtorder.saveNewBouquet')}}" type="button" class="btn Lemon btn-sm" data-toggle="tooltip" data-placement="top" title="This Button will save the bouquet that you have created, also please be noted that if your flowers are less than 12 this button will not submit your Bouquet" data-container="body"> Add to Cart</a>
                    			<a  href = "{{route('Order.ClearBqt')}}" type="button" class="btn Love btn-sm"> Clear Bouquet</a>
                    			 <h5 class="text-right"><strong>Total Amount:</strong> Php {{number_format($Flowers_subtotal + $Acessories_subtotal,2)}} </h4>
                    		</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!--MODAL FLOWER-->

	<!-- Modal Core -->
	<div class="modal fade" id="flowerTab_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
	    	<div class="modal-content">
        {!! Form::open(array('route' => 'Orders_Flowers.store', 'data-parsley-validate'=>'', 'method'=>'POST')) !!}

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

			        		<div id = "sellingPrice_Div" class="form-group">
								<label class="control-label">Current Selling Price</label>
								<input name="ViewPrice_Field" id="ViewPrice_Field" type="text" class="form-control text-right" style ="color:darkviolet;" value = "" disabled>
							</div>
                                <div hidden> <!--start of hidden input field-->
                                <input type="number" class="form-control" name="OrigInputPrice_Field" id="OrigInputPrice_Field" step = '0.01'/>
                                <input type="number" class="form-control" name="FlwrID_Field" id="FlwrID_Field"/>

                                <input type="text" class="form-control" name="orderID_Field" id="orderID_Field" value = ""/>

                                <label>The decision</label>
                                <input type="text" class="form-control" name="Decision_Field" id="Decision_Field" value = 'O'/>
                            </div>      <!--end of hidden input field-->
							<div class="togglebutton">
								<label>
							    	<input type="checkbox" name = "NewPriceCheckBox" id = "NewPriceCheckBox">
									<b>New Price?</b>
								</label>
							</div>
							<div id = 'NewPrice_Div' hidden>
                               <div class="form-group">
                                <label class = 'control-label'>New Price:</label>
                                <input type="number" class="form-control" name="NewPrice_Field" id="NewPrice_Field" value = '' step = "0.01" min = '1.00'/>
                               </div>
                            </div>
							<div id = 'availableQTYDIV' hidden>
                                <div  class="input-group" >
                                  <label class = 'control-label'>Available Quantity:</label>
                                  <input type="text" class="form-control" name="AvailableQty_Field" id="AvailableQty_Field"  placeholder="" disabled/>
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

	    		<div class="modal-footer">
			    	<br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
			    	<br> <br> <br>
			        <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Close</button>
			        <button type="submit" class="btn btn-success btn-simple">Add To Cart</button>
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
    {!! Form::open(array('route' => 'OrdersSession_Bouquet.store', 'data-parsley-validate'=>'', 'files' => 'true', 'method'=>'POST')) !!}
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

			        		<div id = "BqtsellingPrice_Div" class="form-group">
								<label class="control-label">Current Selling Price</label>
								<input name="BqtViewPrice_Field" id="BqtViewPrice_Field" type="text" class="form-control text-right" style ="color:darkviolet;" value = "" disabled>
							</div>
                                <div hidden> <!--start of hidden input field-->
                                <input type="number" class="form-control" name="BqtOrigInputPrice_Field" id="BqtOrigInputPrice_Field" step = '0.01'/>
                                <input type="number" class="form-control" name="BqtFlwrID_Field" id="BqtFlwrID_Field"/>

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
                                <input type="number" class="form-control" name="BqtNewPrice_Field" id="BqtNewPrice_Field" value = '{{number_format($Fdetails->Final_SellingPrice,2)}}' step = "0.01"/>
                               </div>
                            </div>
							<div id = 'BqtavailableQTYDIV' hidden>
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
			        	</div>
	        		</div>
	    		</div>

	    		<div class="modal-footer">
			    	<br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
			    	<br> <br> <br>
			        <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Close</button>
			        <button type="submit" class="btn btn-success btn-simple">Add To Cart</button>
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
	    	{!! Form::open(array('route' => 'OrdersAcSession_Bouquet.store', 'data-parsley-validate'=>'', 'files' => 'true', 'method'=>'POST')) !!}
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
	                          <input type="number" class="form-control" name="AcessoryNewPrice_Field" id="AcessoryNewPrice_Field" value = '1.00' step = "0.01"/>
	                         </div>
	                       	</div>

							<div id = 'BqtavailableQTYDIV' hidden>
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
                              		<input type="text" class="form-control text-right" style ="color:darkviolet;" name="Acessorytotal_Amt" id="Acessorytotal_Amt"  value ="Php 0.00" disabled/>
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



	  if($('#ClearBqt_result').val()=='Successful'){
	    //Show popup
	    swal("Note:","Bouquet has Been Successfully Cleared!","info");
	   }

	  if($('#ClearCart_result').val()=='Successful'){
	    //Show popup
	    swal("Note:","Cart has been Successfully Cleared!","info");
	   }


	  if($('#DeleteAcessory_result').val()=='Successful'){
	    //Show popup
	    swal("Good!","Acessory has been removed!","success");
	   }


	  if($('#DeleteFlower_result').val()=='Successful'){
	    //Show popup
	    swal("Good!","Flower has been removed!","success");
	   }


	  if($('#UpdateFlower_result').val()=='Successful'){
	    //Show popup
	    swal("Good!","Flower's quantity has been updated!","success");
	   }

	  if($('#UpdateAcessory_result').val()=='Successful'){
	    //Show popup
	    swal("Good!","Acessory's quantity has been updated!","success");
	   }

	   if($('#AddFlower_result').val()=='Successful'){
	    //Show popup
	    swal("Good!","Flower has been successfully added to Bouquet!","success");
	   }

	  if($('#AddAcessory_result').val()=='Successful'){
	    //Show popup
	    swal("Good!","Acessory has been successfully added to your Bouquet!","success");
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

			$('#AcessoryViewPrice_Field').val("Php " + Acrs_Price);
			$('#AcessoryOrigInputPrice_Field').val(Acrs_Price);
			$('#AcessoryNewPrice_Field').val(Acrs_Price);
			$('#AcrsID_Field').val(Acrs_ID);
			$('#AcrsName_Field').val(Acrs_Name);
			$('#Acrs_tab_Image').attr("src",Acrs_IMG);
			$('#Acrs_Image_Field').val(Acrs_Pic);


			$('#AcrssellingPrice_Div').prepend('<h5 id = "Acrs_ID">FLWR-'+Acrs_ID+'</h5>'+'<h5 id = "Acrs_Name">'+Acrs_Name+'</h5>');
		});//


		$(document).on('click', '.Flower_Tab_Btn', function(){
			$("#Flwr_ID").remove();
			$("#Flwr_Name").remove();

			var index = $('.Flower_Tab_Btn').index(this);

			var Flwr_ID = $('.Flwr_ID_Field').eq(index).val();
			var Flwr_IMG = $('.Flwr_pic_Field').eq(index).val();
			var Flwr_Name = $('.Flwr_name_Field').eq(index).val();
			var Flwr_Price = $('.Flwr_currentPrice_Field').eq(index).val();

			$('#ViewPrice_Field').val("Php " + Flwr_Price);
			$('#OrigInputPrice_Field').val(Flwr_Price);
			$('#NewPrice_Field').val(Flwr_Price);
			$('#FlwrID_Field').val(Flwr_ID);
			$('#FlWR_tab_Image').attr("src",Flwr_IMG);

			$('#sellingPrice_Div').prepend('<h5 id = "Flwr_ID">FLWR-'+Flwr_ID+'</h5>'+'<h5 id = "Flwr_Name">'+Flwr_Name+'</h5>');

			//alert(Flwr_IMG+ "---" +Flwr_Name +'----' + Flwr_ID + '---' +  Flwr_Price);
		});



		$(document).on('click', '.BqtFlower_Btn', function(){
			$("#BqtFlwr_ID").remove();
			$("#BqtFlwr_Name").remove();
			var index = $('.BqtFlower_Btn').index(this);

			var Flwr_ID = $('.BqtFlwr_ID_Field').eq(index).val();
			var Flwr_IMG = $('.BqtFlwr_pic_Field').eq(index).val();
			var Flwr_Name = $('.BqtFlwr_name_Field').eq(index).val();
			var Flwr_Price = $('.BqtFlwr_currentPrice_Field').eq(index).val();

			$('#BqtViewPrice_Field').val("Php " + Flwr_Price);
			$('#BqtOrigInputPrice_Field').val(Flwr_Price);
			$('#BqtNewPrice_Field').val(Flwr_Price);
			$('#BqtFlwrID_Field').val(Flwr_ID);
			$('#BqtFlWR_tab_Image').attr("src",Flwr_IMG);
			$('#BqtsellingPrice_Div').prepend('<h5 id = "BqtFlwr_ID">FLWR-'+Flwr_ID+'</h5>'+'<h5 id = "BqtFlwr_Name">'+Flwr_Name+'</h5>');
			//alert(Flwr_IMG+ "---" +Flwr_Name +'----' + Flwr_ID + '---' +  Flwr_Price);
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

        $('#NewPriceCheckBox').click(function(){
            var Descision = '';
          //$('#Customer_Chooser').fadeToggle(300);
          if($('#NewPriceCheckBox').is(':checked') == true){
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
      $('#NewPrice_Field').live('keypress', function(key) {
        if(key.charCode < 48 || key.charCode > 57) return false;
      });

      $('#BqtNewPrice_Field').live('keypress', function(key) {
        if(key.charCode < 48 || key.charCode > 57) return false;
      });


      $('#AcessoryNewPrice_Field').live('keypress', function(key) {
        if(key.charCode < 48 || key.charCode > 57) return false;
      });

      $('#QTY_Field').live('keypress', function(key) {
        if(key.charCode < 48 || key.charCode > 57) return false;
      });

      $('#BqtQTY_Field').live('keypress', function(key) {
        if(key.charCode < 48 || key.charCode > 57) return false;
      });

      $('#AcessoryQTY_Field').live('keypress', function(key) {
        if(key.charCode < 48 || key.charCode > 57) return false;
      });
//end of scripts

  });
  </script>

@endsection
