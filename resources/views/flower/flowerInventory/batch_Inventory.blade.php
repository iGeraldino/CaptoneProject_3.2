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
              <textarea class = "form-control" rows="4" cols="50" disabled">
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
                        <button type="button" data-toggle="modal" data-target="#inventorybatch" rel="tooltip" title="view" class="btn btn-info btn-xs">
                          <i class="glyphicon glyphicon-search"></i>
                        </button>
                        <!-- Modal Core -->
                        <div class="modal fade" id="inventorybatch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                              </div>
                              <div class="modal-body">
                                Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-info btn-simple">Save</button>
                              </div>
                            </div>
                          </div>
                        </div>
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
