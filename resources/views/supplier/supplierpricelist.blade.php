@extends('main')

@section('content')

   <div class="container">
      <h3>Supplier Name</h3>

      <div class="dropdown">
		  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Choose One
		  <span class="caret"></span></button>
		  <ul class="dropdown-menu">
		    <li><a href="#">Date</a></li>s
		    <li><a href="#">Flower</a></li>
		    <li><a href="#">Price</a></li>
  		</ul>

		</div>

		<div class="row">
			 <div class="form-group col-xs-2">
                <label>Start Date:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker">
                </div>
                <!-- /.input group -->
         	</div>

         	 <div class="form-group col-xs-2">
                <label>End Date:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker">
                </div>
                <!-- /.input group -->
         </div>
		</div>
        

	<div id= date>
		<div class="row" >
        <div class="col-xs-12">
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <th> Price ID </th>
                    <th> Flower ID </th>
                    <th> Flower Name</th>
                    <th> Price</th>
                    <th> Action </th>
                </thead>

                <tbody>
                    <tr>  
                        <td> 1     </td>
                        <td>       </td>
                        <td>       </td>
                        <td>       </td>
                        <td align="center" > 
                          <button class="btn btn-info btn-md"> Edit </button></a>
                        </td>

                     </tr>

                       <tr>  
                        <td> 2     </td>
                        <td>       </td>
                        <td>       </td>
                        <td>       </td>
                        <td align="center" > 
                          <button class="btn btn-info btn-md"> Edit </button></a>
                        </td>

                     </tr>

                     <tr>  
                        <td> 3     </td>
                        <td>       </td>
                        <td>       </td>
                        <td>       </td>
                        <td align="center" > 
                          <button class="btn btn-info btn-md"> Edit </button></a>
                        </td>

                     </tr>
                </tbody>
       
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          </div>

       </div>


       <div id= flower>
       	<h3>Supplier Name</h3>
       	<h4>Flower Name</h4>
      <div class="dropdown col-xs-2">
		  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Choose One
		  <span class="caret"></span></button>
		  <ul class="dropdown-menu">
		    <li><a href="#">Date</a></li>
		    <li><a href="#">Flower</a></li>
		    <li><a href="#">Price</a></li>
  		  </ul>

		</div>
	 <div class="dropdown col-xs-2">
	 	<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Flowers
		  <span class="caret"></span></button>
		  <ul class="dropdown-menu">
		    <li><a href="#">Rose</a></li>
		    <li><a href="#">Stargazer</a></li>
		    <li><a href="#">Daisy</a></li>
  		  </ul>
	 </div>

	 

		<div class="row" >
        <div class="col-xs-12">
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <th> Price ID </th>
                    <th> Flower ID </th>
                    <th> Flower Name</th>
                    <th> Price</th>
                    <th> Start Date</th>
                    <th> End Date</th>
                    <th> Action </th>

                </thead>

                <tbody>
                    <tr>  
                        <td> 1     </td>
                        <td>       </td>
                        <td>       </td>
                        <td>       </td>
                        <td>       </td>
                        <td>       </td>
                        <td align="center" > 
                          <button class="btn btn-info btn-md"> Edit </button></a>
                        </td>

                     </tr>

                       <tr>  
                        <td> 2     </td>
                        <td>       </td>
                        <td>       </td>
                        <td>       </td>
                        <td>       </td>
                        <td>       </td>
                        <td align="center" > 
                          <button class="btn btn-info btn-md"> Edit </button></a>
                        </td>

                     </tr>

                     <tr>  
                        <td> 3     </td>
                        <td>       </td>
                        <td>       </td>
                        <td>       </td>
                        <td>       </td>
                        <td>       </td>
                        <td align="center" > 
                          <button class="btn btn-info btn-md"> Edit </button></a>
                        </td>

                     </tr>
                </tbody>
       
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          </div>

       </div>

       <div id= price>
       <h3>Supplier Name</h3>

      <div class="dropdown">
		  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Choose One
		  <span class="caret"></span></button>
		  <ul class="dropdown-menu">
		    <li><a href="#">Date</a></li>
		    <li><a href="#">Flower</a></li>
		    <li><a href="#">Price</a></li>
  		</ul>

	</div>


		<div class="row" >
        <div class="col-xs-12">
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <th> Price ID </th>
                    <th> Flower ID </th>
                    <th> Flower Name</th>
                    <th> Price</th>
                    <th> Start Date</th>
                    <th> End Date</th>
                    <th> Action </th>

                </thead>

                <tbody>
                    <tr>  
                        <td> 1     </td>
                        <td>       </td>
                        <td>       </td>
                        <td>       </td>
                        <td>       </td>
                        <td>       </td>
                        <td align="center" > 
                          <button class="btn btn-info btn-md"> Edit </button></a>
                        </td>

                     </tr>

                       <tr>  
                        <td> 2     </td>
                        <td>       </td>
                        <td>       </td>
                        <td>       </td>
                        <td>       </td>
                        <td>       </td>
                        <td align="center" > 
                          <button class="btn btn-info btn-md"> Edit </button></a>
                        </td>

                     </tr>

                     <tr>  
                        <td> 3     </td>
                        <td>       </td>
                        <td>       </td>
                        <td>       </td>
                        <td>       </td>
                        <td>       </td>
                        <td align="center" > 
                          <button class="btn btn-info btn-md"> Edit </button></a>
                        </td>

                     </tr>
                </tbody>
       
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          </div>

       </div>
        
    </div>
@endsection

@section('scripts')

<script>


	 //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

   
    
</script>

@endsection