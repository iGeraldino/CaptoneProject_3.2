@extends('cashier_design')

@section('content')
   
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h2> LIST OF CUSTOMERS</h2>
    	<div class="col-md-8">
      <button type="button" class="btn twitch btn-lg" data-toggle="modal" data-target="#newCust"> 
        <i class="material-icons md-24"> add_circle_outline</i> Add New Customer 
      </button>
	  	<br>
	 <br>

    <!-- line modal -->
    <div class="modal fade" id="newCust" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
          <h3 class="modal-title" id="lineModalLabel">Create New Customer Record</h3>
        </div>
      
        <div class="modal-body">
                <!-- content goes here -->
                <label>Name: </label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="Cust_FNameField" id="Cust_FNameField"  placeholder="First Name..." required/>
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="Cust_MNameField" id="Cust_MNameField"  placeholder="Middle Name..."/>
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="Cust_LNameField" id="Cust_LNameField"  placeholder="Last Name..." required/>
                </div>

                <div class = "row">
                  <div class = "col-md-4">
                    <label>Type: </label>                
                  </div>

                  <div class = "col-md-4">
                    <label>Contact NUmber: </label>
                  </div>              
                </div>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <select class="form-control" name ="custTypeField" id ="custTypeField" >
                      <option value ="C" > Single </option>
                      <option value ="S" > Shop </option>
                      <option value ="H" > Hotel </option>
                  </select>
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="ContactNumField" id="ContactNumField"  placeholder="+639..." required/>
                </div>


                <div class="form-group" id = "hotelnameDiv" hidden>
                  <label for="HotelNameField">Hotel Name (for hotel customers):</label>
                  <input type="text" class="form-control" id="HotelNameField" name="HotelNameField" placeholder="Hotel Name here...">
                </div>


                <div class="form-group" id = "shopnameDiv" hidden>
                  <label for="ShopNameField">Shop Name (for shop customers):</label>
                  <input type="text" class="form-control" id="ShopNameField" name="ShopNameField" placeholder="Shop Name here...">
                </div>


                <div class="form-group">
                  <label for="emailField">Email address</label>
                  <input type="email" class="form-control" id="emailField" name="emailField" placeholder="Email here...">
                </div>

                <div class="form-group">
                  <label for="addressField">Address Line</label>
                  <input type="text" class="form-control" id="addressField" name="addressField" placeholder="Unit No. or House No.\Street\Baranggay\Town\Porvince" required>
                </div>

                  <div class = "form-group">
                    <label>Baranggay: </label>                
                  <input type="text" class="form-control" name="BaranggayField" id="BaranggayField"  placeholder="Baranggay here..." required/>
                  </div>

                 <div class = "row">
                  <div class = "col-md-6">
                    <label>Province: </label>
                  </div>              

                  <div class = "col-md-6">
                    <label>Town: </label>
                  </div>              
                  

                </div>
                <div class="input-group" id = "AdrsDiv">
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <select class="form-control" name ="ProvinceField" id ="ProvinceField" >
                  </select>
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <select class="form-control" name ="TownField" id ="TownField" >
                  </select>
                </div>
        </div>
        <div class="modal-footer">
          <div class="btn-group" role="group" aria-label="group button">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal"  role="button">Close</button>
            </div>
            <div class="btn-group btn-delete hidden" role="group">
              <button id="delImage" class="btn btn-default btn-hover-red" data-dismiss="modal"  role="button">Delete</button>
            </div>
            <div class="btn-group" role="group">
               <button type = "submit" name = "AddBtn" class = "btn btn-simple btn-success"><span class = "glyphicon glyphicon-floppy-save"></span> Add Customer</button>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </section>



	
        <div class="col-xs-12">
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <th> ID </th>
                    <th> Name </th>
                    <th> Type </th>
                    <th> Phone Number</th>
                    <th> Email Address</th>
                    <th> Address</th>
                    <th> Action </th>
                </thead>

                <tbody>

                </tbody>
       
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>


		
	</div>
@endsection


@section('scripts')
    <script>
      
    </script>
@endsection
