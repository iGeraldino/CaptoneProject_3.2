@extends('main')


@section('content')

<?php
  $savingSession = Session::get('Save_Bouquet');
	Session::remove('Save_Bouquet');

?>

<div hidden>
	<input id = "AddBqt_result" value = "{{$savingSession}}">
</div>

	<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="col-md-6">
                <h3>LIST OF BOUQUETS IN THE SHOP</h3>
              </div>
              <div class="col-md-offset-6">
                <a  href = "{{route('Admin.Creation_Bouquet')}}" type="button" class="btn btn-round btn-md twitch pull-right">
                Add Bouquet <i class="material-icons">add_circle</i>
              </a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="sam" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th> Bouquet ID </th>
                  <th> Bouquet Image </th>
                  <th> Flower Count </th>
                  <th> Action </th>
                </tr>
                </thead>
           		<tbody>
               @foreach ($bou as $bouq)
                  <tr>
                    <th>BQT-{{ $bouq -> BQT_ID }}</th>
                    <th align="center"><img src="{{ asset('bouquetImage/'. $bouq -> img)}}" style="min-width: 50px; max-height: 50px; margin-left: 100px;">
                    <th>{{ $bouq->countF }} pcs. </th>
                    <th align="center">
                    	<a href=" {{ route ('bouqAddFlower.show', $bouq -> BQT_ID ) }} " class="btn btn-just-icon Subu" rel="tooltip" title="MORE DETAILS"> <i class="material-icons">more_horiz</i></a>
                    </th>
                  </tr>
                @endforeach
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
	  $(function () {
	    $("#example1").DataTable();
	    $('#sam').DataTable({
	      "paging": true,
	      "info": true,
	      "autoWidth": false
	    });
	  });

    function preview_image(event)
  {
   var reader = new FileReader();
   reader.onload = function()
   {
    var output = document.getElementById('imageBox');
    output.src = reader.result;
   }
   reader.readAsDataURL(event.target.files[0]);
  }
	$(document).ready(function(){
		if($('#AddBqt_result').val()=='Successful'){
		 //Show popup
		 swal("Congratuations!","New bouquet has been successfully made!","success");
		}
	});
	</script>

@endsection
