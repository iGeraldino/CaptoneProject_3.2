@extends('main')
@section('content')
	<div class="container" style="margin-top: 50px;">
    	<span class="label" style="font-size: 15px; background-color: #F62459">Shop's Available Bouquets</span>
    </div>

    <div class="container">
    	<button class="btn  btn-round btn-lg" data-toggle="modal" data-target="#addprice">
                <i class="glyphicon glyphicon-plus-sign"></i> Create New
    </div>

    <!-- Start of Table-->
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table">
                <thead>
                <thead>
                    <th class="text-center"> Bouquet ID</th>
                    <th class="text-center"> Image</th>
                    <th class="text-center"> Price</th>
                    <th class="text-center"> Count of Flowers </th>
                    <th class="text-center"> Action </th>
                </thead>

                <tbody>
                    <tr>  
                      <td> 1     </td>
                      <td>       </td>
                      <td>       </td>
                      <td>       </td>
                      <td align="center"> 
                        <button type="button" rel="tooltip" title="Edit" class="btn btn-success btn-xs"> 
                          <i class="glyphicon glyphicon-edit"></i>
                        </button>
                        <button type="button" rel="tooltip" title="Delete" class="btn btn-danger btn-xs"> 
                        <i class="glyphicon glyphicon-remove-sign"></i>
                      </button></a>
                      </td>
                    </tr>

                    <tr>  
                      <td> 2     </td>
                      <td>       </td>
                      <td>       </td>
                      <td>       </td>
                      <td align="center"> 
                        <button type="button" rel="tooltip" title="Edit" class="btn btn-success btn-xs"> 
                          <i class="glyphicon glyphicon-edit"></i>
                        </button>
                        <button type="button" rel="tooltip" title="Delete" class="btn btn-danger btn-xs"> 
                        <i class="glyphicon glyphicon-remove-sign"></i>
                      </button></a>
                      </td>
                    </tr>

                    <tr>  
                      <td> 3     </td>
                      <td>       </td>
                      <td>       </td>
                      <td>       </td>
                      <td align="center"> 
                        <button type="button" rel="tooltip" title="Edit" class="btn btn-success btn-xs"> 
                          <i class="glyphicon glyphicon-edit"></i>
                        </button>
                        <button type="button" rel="tooltip" title="Delete" class="btn btn-danger btn-xs"> 
                        <i class="glyphicon glyphicon-remove-sign"></i>
                      </button></a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
@endsection