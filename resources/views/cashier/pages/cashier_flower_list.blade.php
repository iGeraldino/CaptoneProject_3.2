@extends('cashier_design')


@section('content')
	<section class="content-header">
<h2>FLOWERS THAT ARE BEING OFFERED BY THE SHOP</h2>
	<button type="button" class="btn twitch btn-lg" data-toggle="modal" data-target="#AddModal">
  Add Flower
		</button>

		<!-- Modal -->
		<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel"> Adding Flower </h5>
		       
		      </div>
		      <div class="modal-body">

              

		      </div>
		    
		    </div>
		  </div>
		</div>

	</section>

	<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="sam" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Flower ID </th>
                  <th>Flower Name </th>
                  <th>Flower Image </th>
                  <th>Current Price</th>
                  <th>Quantity onhand</th>
                  <th>Actions</th>

                </tr>
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
      <!-- /.row -->
    </section>

@endsection

@section('scripts')

	<script>
	  
	</script>

@endsection