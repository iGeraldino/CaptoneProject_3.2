@extends('main')

@section('content')
	<div class="col-xs-12" style="margin-top: 3%;">
		<div class="panel">
          	<div class="panel-heading Subu">
            	<h3 class="panel-title" style="color: white;">Manage Account</h3>
          	</div>
      		<div class="panel-body">
      			<div class="row">
      				<div class="col-sm-4">
						<div class="form-group label-floating">
							<label class="control-label">First Name</label>
							<input type="email" class="form-control">
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group label-floating">
							<label class="control-label">Last Name</label>
							<input type="email" class="form-control">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group label-floating">
							<label class="control-label">Email Address</label>
							<input type="email" class="form-control">
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group label-floating">
							<label class="control-label">Contact Number</label>
							<input type="email" class="form-control">
						</div>
					</div>
      			</div>
      			<div class="row">
					<div class="col-sm-4">
						<div class="form-group label-floating">
							<label class="control-label">Username</label>
							<input type="email" class="form-control">
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group label-floating">
							<label class="control-label">Password</label>
							<input type="email" class="form-control">
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group label-floating">
							<label class="control-label">Confirm Password</label>
							<input type="email" class="form-control">
						</div>
					</div>
      			</div>
      			<div class="btn-group btn-group-justified" role="group" aria-label="group button">
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-default" href = "#" data-dismiss="modal"  role="button">Cancel</button>
                    </div>
                    <div class="btn-group" role="group">
                       <button type = "submit" name = "AddBtn" class = "btn btn-primary btn-success"><span class = "glyphicon glyphicon-floppy-save"></span> Save changes</button>
                    </div>
                  </div>
      		</div>
		</div>
	</div>


@endsection