@extends('main')

@section('content')

  <div class="container" style="margin-top: 50px;">
    
      <span class="label" style="font-size: 15px; background-color: #F62459">Supplier Name</span>
    

    <!-- Date range -->
    <div class="row">
      <div class="col-sm-2">
        <button class="btn btn-primary dropdown-toggle btn-sm" style="margin-top: 30px;" type="button" data-toggle="dropdown"> Flower
        <span class="caret"></span></button>
        <ul class="dropdown-menu">
          <li><a href="#">Date</a></li>
          <li><a href="#">Flower</a></li>
          <li><a href="#">Price</a></li>
        </ul>
      </div>
      <div class="col-xs-2">
        <label style="margin-top: 40px;">Date Range</label>
      </div>
      <div class="col-sm-3">
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right" id="reservation">
          </div>
          <!-- /.input group -->
        </div>
        <!-- /.form group -->
      </div>
    </div>
  
    <div id=date>
      <!-- Start of Table-->
        <div class="col-xs-11">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table">
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
                      <td align="center"> 
                        <button type="button" rel="tooltip" title="Edit" class="btn btn-info btn-xs"> 
                          <i class="glyphicon glyphicon-edit"></i>
                        </button>
                      </td>
                    </tr>

                    <tr>  
                      <td> 2     </td>
                      <td>       </td>
                      <td>       </td>
                      <td>       </td>
                      <td align="center"> 
                        <button type="button" rel="tooltip" title="Edit" class="btn btn-info btn-xs"> 
                          <i class="glyphicon glyphicon-edit"></i>
                        </button>
                      </td>
                    </tr>

                    <tr>  
                      <td> 3     </td>
                      <td>       </td>
                      <td>       </td>
                      <td>       </td>
                      <td align="center"> 
                        <button type="button" rel="tooltip" title="Edit" class="btn btn-info btn-xs"> 
                          <i class="glyphicon glyphicon-edit"></i>
                        </button>
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

    <div id="flower">

      <div class="col-sm-2">
          <button class="btn btn-primary dropdown-toggle btn-sm" style="margin-top: 30px;" type="button" data-toggle="dropdown"> Flower
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a href="#">Date</a></li>
            <li><a href="#">Flower</a></li>
            <li><a href="#">Price</a></li>
          </ul>
      </div>

      <div class="col-sm-2">
          <button class="btn btn-primary dropdown-toggle btn-sm" style="margin-top: 30px;" type="button" data-toggle="dropdown"> Flowers
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a href="#">Rose</a></li>
            <li><a href="#">Stargazer</a></li>
            <li><a href="#">Tulip</a></li>
          </ul>
      </div>

      <div class="row">
        <div class="col-sm-3">
          <div class="form-group label-floating">
            <label class="control-label">Supplier Name</label>
            <input type="name" class="form-control">
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group label-floating">
            <label class="control-label">Flower Name</label>
            <input type="name" class="form-control">
          </div>
        </div>
      </div>

      <!-- Start of Table-->
        <div class="col-xs-11">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table">
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
                      <td align="center"> 
                        <button type="button" rel="tooltip" title="Edit" class="btn btn-info btn-xs"> 
                          <i class="glyphicon glyphicon-edit"></i>
                        </button>
                      </td>
                    </tr>

                    <tr>  
                      <td> 2     </td>
                      <td>       </td>
                      <td>       </td>
                      <td>       </td>
                      <td>       </td>
                      <td>       </td>
                      <td align="center"> 
                        <button type="button" rel="tooltip" title="Edit" class="btn btn-info btn-xs"> 
                          <i class="glyphicon glyphicon-edit"></i>
                        </button>
                      </td>
                    </tr>

                    <tr>  
                      <td> 3     </td>
                      <td>       </td>
                      <td>       </td>
                      <td>       </td>
                      <td>       </td>
                      <td>       </td>
                      <td align="center"> 
                        <button type="button" rel="tooltip" title="Edit" class="btn btn-info btn-xs"> 
                          <i class="glyphicon glyphicon-edit"></i>
                        </button>
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

    <div id=price>
      <div class="col-sm-3">
          <div class="form-group label-floating">
            <label class="control-label">Supplier Name</label>
            <input type="name" class="form-control">
          </div>
        </div>
      <div class="col-sm-2">
          <button class="btn btn-primary dropdown-toggle btn-sm" style="margin-top: 30px;" type="button" data-toggle="dropdown"> Flower
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a href="#">Date</a></li>
            <li><a href="#">Flower</a></li>
            <li><a href="#">Price</a></li>
          </ul>
      </div>

      <!-- Start of Table-->
        <div class="col-xs-11">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table">
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
                      <td align="center"> 
                        <button type="button" rel="tooltip" title="Edit" class="btn btn-info btn-xs"> 
                          <i class="glyphicon glyphicon-edit"></i>
                        </button>
                      </td>
                    </tr>

                    <tr>  
                      <td> 2     </td>
                      <td>       </td>
                      <td>       </td>
                      <td>       </td>
                      <td>       </td>
                      <td>       </td>
                      <td align="center"> 
                        <button type="button" rel="tooltip" title="Edit" class="btn btn-info btn-xs"> 
                          <i class="glyphicon glyphicon-edit"></i>
                        </button>
                      </td>
                    </tr>

                    <tr>  
                      <td> 3     </td>
                      <td>       </td>
                      <td>       </td>
                      <td>       </td>
                      <td>       </td>
                      <td>       </td>
                      <td align="center"> 
                        <button type="button" rel="tooltip" title="Edit" class="btn btn-info btn-xs"> 
                          <i class="glyphicon glyphicon-edit"></i>
                        </button>
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

<script type="text/javascript">
    //Date range picker
    $('#reservation').daterangepicker();
  </script>

@endsection