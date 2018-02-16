@extends('main')

@section('content')

  <div class="col-xs-12" style="margin-top: 2.5%">
    <div class="panel panel-primary">
      <div class="panel-heading Subu">
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
              	<span class="control-label"><b>FLOWER ID:</b> </span>
                <span><b>FLWR-{{$flowerDet->flower_ID}}</b></span>
              </div>
              <div>
                <span class="control-label"><b>FLOWER NAME: </b></span>
                <span style="text-transform: uppercase;"><b>{{$flowerDet->flower_name}}</b></span>
            </div>
            <div>
                <span class="control-label"><b>DATE CREATED: </b></span>
                <span style="text-transform: uppercase;">
                <b>{{date('M d,Y' , strtotime($flowerDet->date_Created))}}</b></span>
            </div>
            <div>
                <span class="control-label"><b>DEFAULT PRICE: </b></span>
                <span style="text-transform: uppercase;">
                <b>Php {{number_format($flowerDet->Initial_Price,2)}}</b></span>
            </div>
           </div>
          </div><!--End of column-->
          <div class = "col-md-4">
          	<div class = "form-group">
              <span class="control-label"><b>DESCRIPTION: </b></span>
              <textarea class = "form-control" rows="4" cols="50" disabled>
                {{$flowerDet->Description}}
              </textarea>
            </div>
          </div>
        </div>
        <div class = "row">
          <div class = "col-md-9">
          <br>
            <h3 class="container"><b>INVENTORY PER BATCH</b></h3>
          </div>
          <div class = "col-md-3">
            <a href=" {{ route ('floweradd.index') }} " class="btn btn-md btn-round twitch"><span class = "glyphicon glyphicon-return"></span> Return to Flowerlist </a>
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
                    <th style = "font-weight:bold"> QTY Recieved</th>
                    <th style = "font-weight:bold"> Initial Spoiled</th>
                    <th style = "font-weight:bold"> QTY Remaining</th>
                    <th> Adjusted Spoiled</th>
                    <th> Adjusted Good</th>
                    <th> QTY Sold</th>
                    <th> QTY Spoiled</th>
                    <th> Supplier Name</th>
                    <th> Date Recieved</th>
                    <th> Spoilage Date</th>
                    <th> Life Span</th>
                </thead>

                <tbody>
                  <?php
                    $totalNegative = 0;
                    $totalPositive = 0;
                    $counter = 0;
                  ?>
                 @foreach($flowers as $flowersRow)
                    <tr>
                      <th> BATCH-{{$flowersRow->Batch}}  </th>
                      <td style = " font-weight:bold"> {{$flowersRow->UnitCost}} </td>
                      <td style = " font-weight:bold"> Php {{number_format($flowersRow->O_SellingPrice,2)}} </td>
                      <td style = " font-weight:bold"> {{$flowersRow->SellingPrice}} </td>
                      <td style = "color:blue; font-weight:semi-bold"> {{$flowersRow->QTYRecieved}} pcs.</td>
                      <td style = "color:red; font-weight:semi-bold"> {{$flowersRow->InitQTYSpoiled}} pcs.</td>
                      <td style = "color:blue; font-weight:semi-bold"> {{$flowersRow->QTYRemaining}} </td>

                      <?php
                      $totalNegative = 0;
                      $totalPositive = 0;
                      ?>
                      @foreach($adjustments as $adjust)
                        @if($adjust->Batch_ID == $flowersRow->Batch AND $adjust->Item_ID == $flowerDet->flower_ID)
                        <?php $counter++;?>

                          @if($adjust->SpoiledQ != NULL)
                            <?php
                              $totalNegative += $adjust->SpoiledQ;
                            ?>
                          @endif
                          @if($adjust->GoodQ != NULL)
                            <?php
                              $totalPositive += $adjust->GoodQ;
                            ?>
                          @endif
                        @endif
                      @endforeach
                      <td style = "color:red;"> ({{$totalNegative * -1}} pcs.)</td>
                      <td style = "color:blue;"> {{$totalPositive}} pcs.</td>
                      <td style = "color:green;"> ({{$flowersRow->QTYSold}}) </td>
                      <td style = "color:red;"> ({{$flowersRow->QTYSpoiled}}) </td>
                      <td> {{$flowersRow->FName}} {{$flowersRow->MName}}, {{$flowersRow->LName}}  </td>
                      <td> {{$flowersRow->Date_Recieved}} </td>
                      <td> {{$flowersRow->Spoil_date}} </td>
                      <td> {{$flowersRow->Life_Span}} days </td>
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
        </div>
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
