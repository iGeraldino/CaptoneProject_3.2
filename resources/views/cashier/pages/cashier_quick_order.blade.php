@extends('cashier_design')

@section('content')

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
								<div class="col-sm-3" style="margin-bottom: 3%;">
									<img src="images/flower/pic3.jpg" alt="Raised Image" class="img-rounded img-responsive img-raised">
									<a class="btn btn-sm Lemon" data-toggle="modal" data-target="#flowermodal"> VIEW</a>
	                    		</div>
	                    		<div class="col-sm-3" style="margin-bottom: 3%;">
									<img src="images/flower/pic3.jpg" alt="Raised Image" class="img-rounded img-responsive img-raised">
									<a class="btn btn-sm Lemon" data-toggle="modal" data-target="#flowermodal"> VIEW</a>
	                    		</div>
	                    		<div class="col-sm-3" style="margin-bottom: 3%;">
									<img src="images/flower/pic3.jpg" alt="Raised Image" class="img-rounded img-responsive img-raised">
									<a class="btn btn-sm Lemon" data-toggle="modal" data-target="#flowermodal"> VIEW</a>
	                    		</div>
	                    		<div class="col-sm-3" style="margin-bottom: 3%;">
									<img src="images/flower/pic3.jpg" alt="Raised Image" class="img-rounded img-responsive img-raised">
									<a class="btn btn-sm Lemon" data-toggle="modal" data-target="#flowermodal"> VIEW</a>
	                    		</div>
	                    		<div class="col-sm-3" style="margin-bottom: 3%;">
									<img src="images/flower/pic3.jpg" alt="Raised Image" class="img-rounded img-responsive img-raised">
									<a class="btn btn-sm Lemon" data-toggle="modal" data-target="#flowermodal"> VIEW</a>
	                    		</div>
	                    		
	                    		
							</div>
							<div class="tab-pane" id="Bouquets">
								<div class="col-md-6">
									Flowers
									<div class="row">
										<div class="col-md-6" style="margin-bottom: 3%;">
											<img src="images/flower/pic3.jpg" alt="Raised Image" class="img-rounded img-responsive img-raised">
											<a class="btn btn-sm Lemon" data-toggle="modal" data-target="#flowermodal"> VIEW</a>
										</div>
										<div class="col-md-6" style="margin-bottom: 3%;">
											<img src="images/flower/pic3.jpg" alt="Raised Image" class="img-rounded img-responsive img-raised">
											<a class="btn btn-sm Lemon" data-toggle="modal" data-target="#flowermodal"> VIEW</a>
										</div>
										<div class="col-md-6" style="margin-bottom: 3%;">
											<img src="images/flower/pic3.jpg" alt="Raised Image" class="img-rounded img-responsive img-raised">
											<a class="btn btn-sm Lemon" data-toggle="modal" data-target="#flowermodal"> VIEW</a>
										</div>
										<div class="col-md-6" style="margin-bottom: 3%;">
											<img src="images/flower/pic3.jpg" alt="Raised Image" class="img-rounded img-responsive img-raised">
											<a class="btn btn-sm Lemon" data-toggle="modal" data-target="#flowermodal"> VIEW</a>
										</div>

									</div>
								</div>

								<div class="col-md-6">
									Accessories
									<div class="row">
										<div class="col-md-6" style="margin-bottom: 3%;">
											<img src="images/accessories/vase1.jpg" alt="Raised Image" class="img-rounded img-responsive img-raised">
											<a class="btn btn-sm Lemon" data-toggle="modal" data-target="#accessoriesmodal"> VIEW</a>
										</div>
										<div class="col-md-6" style="margin-bottom: 3%;">
											<img src="images/accessories/vase1.jpg" alt="Raised Image" class="img-rounded img-responsive img-raised">
											<a class="btn btn-sm Lemon" data-toggle="modal" data-target="#accessoriesmodal"> VIEW</a>
										</div>
										<div class="col-md-6" style="margin-bottom: 3%;">
											<img src="images/accessories/vase1.jpg" alt="Raised Image" class="img-rounded img-responsive img-raised">
											<a class="btn btn-sm Lemon" data-toggle="modal" data-target="#accessoriesmodal"> VIEW</a>
										</div>
										<div class="col-md-6" style="margin-bottom: 3%;">
											<img src="images/accessories/vase1.jpg" alt="Raised Image" class="img-rounded img-responsive img-raised">
											<a class="btn btn-sm Lemon" data-toggle="modal" data-target="#accessoriesmodal"> VIEW</a>
										</div>
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
                    			<div class="row"> 
			                        <div class="col-xs-1" style="margin-right: 2%"><img class="img-rounded img-raised img-responsive" style="min-width: 50px; max-height: 50px;" src="images/flower/pic3.jpg">
			                        </div>
			                        <div class="col-xs-2">
			                          <h6 class="product-name"><strong>Flower Name</strong></h6>
			                        </div>
			                        <div class="col-xs-3" style = "color:red; margin-top:3%;">
			                          <h7>Price  <span class="text-muted"><b> x</b></span></h7>
			                        </div>
			                        <div class="col-md-2" style = "margin-top:3%; margin-left:-10%;">
			                          <h7>pcs.</h7>
			                        </div>
			                        <div class="col-xs-2" style = "color:darkviolet; margin-top:3%;">
			                          <h7><b>=</b> Total</h7>
			                        </div>
			                        <div class="col-xs-1">
			                        	<button class="btn Lemon btn-just-icon" data-toggle="tooltip" title="Update Quantity">
											<i class="material-icons">mode_edit</i>
										</button>
			                        </div>
			                        <div class="col-xs-1">
			                        	<button class="btn Love btn-just-icon" data-toggle="tooltip" title="Delete">
											<i class="material-icons">delete</i>
										</button>
			                        </div>
                      			</div>
                    		</div>
                    		<div class="panel-footer">

                    			<a href="#" type="button" class="btn Lemon btn-sm"> PROCEED</a>
                    			<a href="#" type="button" class="btn Love btn-sm"> CLEAR CART</a>
                    			 <h5 class="text-right"><strong>Total Amount:</strong> Php </h4>
                    		</div>
						</div>
					</div>
					<div class="panel">
						<div class="panel">
							<div class="panel-heading Sharp">
                      			<div class="panel-title">
                        			<div class="row">
                          				<div class="col-xs-6">
                            				<h6 style="color: white"><span class="glyphicon glyphicon-user" style="color: white;"></span> Bouquet Content</h6>
                          				</div>
                        			</div>
                      			</div>
                    		</div>
                    		<div class="panel-body">
                    			<div class="row"> 
			                        <div class="col-xs-1" style="margin-right: 2%"><img class="img-rounded img-raised img-responsive" style="min-width: 50px; max-height: 50px;" src="images/flower/pic3.jpg">
			                        </div>
			                        <div class="col-xs-2">
			                          <h6 class="product-name"><strong>Item Name</strong></h6>
			                        </div>
			                        <div class="col-xs-3" style = "color:red; margin-top:3%;">
			                          <h7>Price  <span class="text-muted"><b> x</b></span></h7>
			                        </div>
			                        <div class="col-md-2" style = "margin-top:3%; margin-left:-10%;">
			                          <h7>pcs.</h7>
			                        </div>
			                        <div class="col-xs-2" style = "color:darkviolet; margin-top:3%;">
			                          <h7><b>=</b> Total</h7>
			                        </div>
			                        <div class="col-xs-1">
			                        	<button class="btn Lemon btn-just-icon" data-toggle="tooltip" title="Update Quantity">
											<i class="material-icons">mode_edit</i>
										</button>
			                        </div>
			                        <div class="col-xs-1">
			                        	<button class="btn Love btn-just-icon" data-toggle="tooltip" title="Delete">
											<i class="material-icons">delete</i>
										</button>
			                        </div>
                      			</div>
                    		</div>
                    		<div class="panel-footer">

                    			<a href="#" type="button" class="btn Lemon btn-sm"> PROCEED</a>
                    			<a href="#" type="button" class="btn Love btn-sm"> CLEAR CART</a>
                    			 <h5 class="text-right"><strong>Total Amount:</strong> Php </h4>
                    		</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!--MODAL FLOWER-->

	<!-- Modal Core -->
	<div class="modal fade" id="flowermodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
	    	<div class="modal-content">
	      		<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title text-center" id="myModalLabel">FLOWER DETAILS</h4>
			    </div>
	    		<div class="modal-body">
	        		<div row>
	        			<div class="col-md-6">
	        				<img src="images/flower/pic3.jpg" class="img-rounded img-responsive img-raised">
	        			</div>
	        			<div class="col-md-6">
			        		<h5>Flower ID</h5>
			        		<h5>Flower Name</h5>
			        		<div class="form-group label-floating">
								<label class="control-label">Current Selling Price</label>
								<input type="number" class="form-control">
							</div>
							<div class="togglebutton">
								<label>
							    	<input type="checkbox">
									<b>New Price?</b>
								</label>
								<input type="text" value="" style="margin-top: -10%;" class="form-control" />
							</div>
							<div class="form-group label-floating">
								<label class="control-label">Quantity</label>
								<input type="number" class="form-control">
							</div>
							<h5>Total Amount:</h5>
			        	</div>
	        		</div>
	    		</div>
	      
	    		<div class="modal-footer">
			    	<br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
			    	<br> <br> <br> 
			        <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Close</button>
			        <button type="button" class="btn btn-success btn-simple">Add To Cart</button>
			    </div>
	    	</div>
	  	</div>
	</div>

	<!--MODAL Accessories-->

	<!-- Modal Core -->
	<div class="modal fade" id="accessoriesmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
	    	<div class="modal-content">
	      		<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title text-center" id="myModalLabel">ACCESSORIES DETAILS</h4>
			    </div>
	    		<div class="modal-body">
	        		<div row>
	        			<div class="col-md-6">
	        				<img src="images/accessories/vase1.jpg" class="img-rounded img-responsive img-raised">
	        			</div>
	        			<div class="col-md-6">
			        		<h5>Accessories ID</h5>
			        		<h5>Accessories Name</h5>
			        		<div class="form-group label-floating">
								<label class="control-label">Current Selling Price</label>
								<input type="number" class="form-control">
							</div>
							<div class="togglebutton">
								<label>
							    	<input type="checkbox">
									<b>New Price?</b>
								</label>
								<input type="text" value="" style="margin-top: -10%;" class="form-control" />
							</div>
							<div class="form-group label-floating">
								<label class="control-label">Quantity</label>
								<input type="number" class="form-control">
							</div>
							<h5>Total Amount:</h5>
			        	</div>
	        		</div>
	    		</div>
	      
	    		<div class="modal-footer">
			    	<br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
			    	<br> <br> <br> 
			        <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Close</button>
			        <button type="button" class="btn btn-success btn-simple">Add To Cart</button>
			    </div>
	    	</div>
	  	</div>
	</div>
			
@endsection

