@extends('main')

@section('content')

  <div class="container" style="margin-top: 50px;">
        <div class="panel panel-primary">
          <div class="panel-heading" style="background-color: #C93756">
            <h3 class="panel-title">Flower Details</h3>
          </div>
          <div class="panel-body">
          <div class = "row">
			<div class="col-md-3">
          	  <div class="col-sm-offset-1">
	 		    <img src="{{ asset('flowerimage/'. $flowerDet->Image)}}" alt="Circle Image" class="img-rounded img-raised img-responsive" style="min-width: 200px; max-height: 200px;">
	          </div>
          	</div><!--end of column-->

            <div class="col-md-3">
              <div class="form-group">
                <div>
                	<label class="control-label">Flower ID: </label>
                    <span class="label" style="font-size: 100%; background-color: #F62459">FLWR-{{$flowerDet->flower_ID}}</span>
                </div>
                <div>
	                <label class="control-label">Flower Name: </label>
	                <span class="label" style="font-size: 100%; background-color: #F62459">{{$flowerDet->flower_name}}</span>
	            </div>
	            <div>
	                <label class="control-label">Date Created: </label>
	                <span class="label" style="font-size: 100%; background-color: #F62459">
	                {{date('M d,Y' , strtotime($flowerDet->date_Created))}}</span>
	            </div>
				<div>
	                <label class="control-label">Default Price: </label>
	                <span class="label" style="font-size: 100%; background-color: #F62459">
	                Php {{number_format($flowerDet->Initial_Price,2)}}</span>
	            </div>
	           </div>
            </div><!--End of column-->
            <div class = "col-md-4">
            	<div class = "form-group">
	                <label class="control-label">Description: </label>
	                <textarea class = "form-control" rows="4" cols="50" disabled style = "color: white; background-color: #F62459;">
                    {{$flowerDet->Description}}
                  </textarea>
	            </div>
            </div>
          </div>

          </div>
        </div>
  </div>

  <div class = "row">
    <div class = "col-md-9">
    <br>
      <span class="label" style="font-size: 120%; background-color: #F62459; margin-left: 10px;">Inventory Per Batch</span>
    </div>
    <div class = "col-md-3">
      <a href=" {{ route ('floweradd.index') }} " class="btn btn-md btn-danger"><span class = "glyphicon glyphicon-return"></span> Return to Flowerlist </a>
    </div>
  </div>
<br>
    <!-- Start of Table-->
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="batch_Tbl" class="table table-hover table-bordered table-striped">
                <thead>
                    <th> Batch ID </th>
                    <th> Unit Cost </th>
                    <th> Selling Price</th>
                    <th> Current Selling Price</th>
                    <th> QTY Recieved</th>
                    <th> QTY Remaining</th>
                    <th> QTY Sold</th>
                    <th> Supplier Name</th>
                    <th> Date Recieved</th>
                    <th> Spoilage Date</th>
                    <th> Life Span</th>
                    <th> Action </th>
                </thead>

                <tbody>
                 @foreach($flowers as $flowersRow)
                    <tr>
                      <th> BATCH-{{$flowersRow->Batch}}  </th>
                      <td style = "color:red;"> {{$flowersRow->UnitCost}} </td>
                      <td style = "color:red;"> Php {{number_format($flowersRow->O_SellingPrice,2)}} </td>
                      <td style = "color:red;"> {{$flowersRow->SellingPrice}} </td>
                      <td> {{$flowersRow->QTYRecieved}} pcs.</td>
                      <td> {{$flowersRow->QTYRemaining}} </td>
                      <td> {{$flowersRow->QTYSold}} </td>
                      <td> {{$flowersRow->FName}} {{$flowersRow->MName}}, {{$flowersRow->LName}}  </td>
                      <td> {{$flowersRow->Date_Recieved}} </td>
                      <td> {{$flowersRow->Spoil_date}} </td>
                      <td> {{$flowersRow->Life_Span}} days </td>
                      <td align="center">
                        <button type="button" rel="tooltip" title="view" class="btn btn-info btn-xs">
                          <i class="glyphicon glyphicon-edit"></i>
                        </button>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
  </div>
@endsection

@section('scripts')
<script>
  $('#batch_Tbl').DataTable();

 $(document).ready(function(){

 });
</script>
@endsection
