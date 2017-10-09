@extends('main')

@section('content')
	<div class="col-md-6" style="margin-top: 3%;">
		<div class="panel">
			<div class="panel-heading Subu">
				<h3 class="panel-title" style="color: white;">Details</h3>
			</div>
			<div class="panel-body">
				<h4> CUSTOMER ID:</h4>
				<h4> CUSTOMER NAME:</h4>
				<h4> TYPE:</h4>
				<h4> CONTACT NUMBER:</h4>
				<h4> EMAIL ADDRESS:</h4>
				<h4> ADDRESS:</h4>
				<h4> HOTEL NAME:</h4>
				<h4> SHOP NAME:</h4>
			</div>
		</div>
	</div>
	<div class="col-md-6" style="margin-top: 3%;">
		<div class="panel">
			<div class="panel-heading Subu">
				<h3 class="panel-title" style="color: white;">Create Account</h3>
			</div>
			<div class="panel-body">
				<div class="row">
	                <div class="col-xs-6">
	                  	<div class="form-group label-floating">
	                    	<label class="control-label">Username:</label>
	                    	<input type="email" class="form-control">
	                  	</div>
	                </div>
	                <div class="col-xs-6">
	                 	<div class="form-group label-floating">
	                    	<label class="control-label">Email:</label>
	                    	<input type="email" class="form-control">
	                  	</div>
	                </div>
	            </div>
	            <div class="row">
	                <div class="col-xs-6">
	                  	<div class="form-group label-floating">
	                    	<label class="control-label">Password:</label>
	                    	<input type="email" class="form-control">
	                  	</div>
	                </div>
	                <div class="col-xs-6">
	                  	<div class="form-group label-floating">
	                    	<label class="control-label">Confirm Password:</label>
	                    	<input type="email" class="form-control">
	                  	</div>
	                </div>
	             </div>
	             <a href="#" type="button" class="btn btn-sm Lemon pull-right"> Save</a>
	             <a href="#" type="button" class="btn btn-sm Shalala pull-right"> Back</a>
			</div>
		</div>
	</div>


@endsection
