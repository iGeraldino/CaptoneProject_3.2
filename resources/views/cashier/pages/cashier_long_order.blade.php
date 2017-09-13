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
							</div><!--end of active pane-->
							<div class="tab-pane" id="Bouquets">
								<div class="col-md-6">
									Flowers
									<div class="row">

									</div>
								</div>

								<div class="col-md-6">
									Accessories
									<div class="row">
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
                                <div class="col-xs-12">
			                          <h5 class="text-right" style = "color:darkviolet"><strong>(Flowers)Total Amount:</strong> Php </h5>
			                    </div>
			                  <hr>
<!-- List Of Bouquets on Cart-->
                   				
                                <div class="col-xs-12">
			                      <h5 class="text-right" style = "color:darkviolet"><strong>(Bouquet)Total Amount:</strong> Php </h5>
			                    </div>
                    		</div>
                    		<div class="panel-footer">
                    			<a id = "checkoutBtn" href="" type="button" class="btn Lemon btn-sm"> Checkout </a>
                    			<a href="" type="button" class="btn Love btn-sm"> CLEAR CART</a>
                    			 <h5 class="text-right"><strong>Total Amount:</strong> Php 
                    			 </h5>
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


                  			
                    			<!---->
                    		</div>
                    		<div class="panel-footer">
                    		</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('scripts')

  <script type="text/javascript">
      
//end of scripts

  });
  </script>

@endsection
