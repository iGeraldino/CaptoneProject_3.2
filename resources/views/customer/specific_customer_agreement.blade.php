@extends('main')

@section('content')
    <div class="container">
      <h3> Specific Customer's Agreement</h3>
    	<h4> Customer ID:___________</h4>
    	<h4> Customer Name:_________</h4>
    	
    </div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
    	<div class="col-md-offset-8 col-xs-8">
	    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addagreement">
	  		Add 
	  	</button>
        
        <div class="dropdown col-xs-2">
        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown">Flowers
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a href="#">Price</a></li>
            <li><a href="#">Date</a></li>
            <li><a href="#">Flower</a></li>
          </ul>
     </div>
     </div>

     <!-- Modal -->
        <div class="modal fade" id="addagreement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Agreement</h4>
              </div>
              <div class="modal-body">

                    <div class="container">
                        <h5> Customer ID:___________</h5>
                        <h5> Customer Name:_________</h5>


                        <div class="dropdown col-xs-6">
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown">Choose Flower
                              <span class="caret"></span></button>
                              <ul class="dropdown-menu">
                                <li><a href="#">Daisy</a></li>
                                <li><a href="#">Rose</a></li>
                                <li><a href="#">Flower</a></li>
                              </ul>
                         </div>
                         
                         <h5 class="col-xs-6"> Orig Price:________</h5>
                    </div>

              </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                      
                 </div>
            </div>
        </div>
    </div>
    
	  	

    <div class="row" >
        <div class="col-xs-12">
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <th> Agreement ID </th>
                    <th> Flower Name</th>
                    <th> Price </th>
                    <th> Start Date</th>
                    <th> End Date</th>
                    <th> Status </th>
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
                          <button class="btn btn-info btn-md"> View </button></a>
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
                          <button class="btn btn-info btn-md"> View </button></a>
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
                          <button class="btn btn-info btn-md"> View </button></a>
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
	</section>
@endsection