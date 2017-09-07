@extends('main')

@section('content')
   
<div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">By Price</a></li>
              <li><a href="#tab_2" data-toggle="tab">By Date</a></li>
              <li><a href="#tab_3" data-toggle="tab">By Flower</a></li>
            
              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <h4>Customer ID</h4>
                <h4>Customer Name</h4>

                <form>
                  Choose by      <input type="number" name="number"> to <input type="number" name="number">
                </form>
                <br>
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
                    <th> Action </th>

                </thead>

                <tbody>
                    <tr>  
                        <td> 1     </td>
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
                        <td align="center" > 
                          <button class="btn btn-info btn-md"> View </button></a>
                        </td>

                     </tr>

                     <tr>  
                        <td> 3     </td>
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
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <h4>Customer ID</h4>
                <h4>Customer Name</h4>


                <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <th> Agreement ID </th>
                    <th> Flower Name</th>
                    <th> Start Date </th>
                    <th> End Date </th>
                    <th> Action </th>

                </thead>

                <tbody>
                    <tr>  
                        <td> 1     </td>
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
          

    
              
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">

              <div class="container">
                        
                        <div class="dropdown col-xs-6">
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown">Choose Flower
                              <span class="caret"></span></button>
                              <ul class="dropdown-menu">
                                <li><a href="#">Daisy</a></li>
                                <li><a href="#">Rose</a></li>
                                <li><a href="#">Flower</a></li>
                              </ul>
                         </div>
                         
                         
                    </div>

                <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <th> Agreement ID </th>
                    <th> Flower Name</th>
                    <th> Price </th>
                    <th> Start Date </th>
                    <th> End Date </th>
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
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>

@endsection