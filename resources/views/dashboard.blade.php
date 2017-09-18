  
@extends('main')

@section('content')
   
  <div style="margin-top: 50px;">

  <?php
   $sessionLoginValue = Session::get('loginSession'); 
     Session::remove('loginSession');//determines the addition of new flower
  ?>

  <div hidden>
    <input id = "LoggedInfield" value = "{{$sessionLoginValue}}">
  </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box Subu">
            <div class="inner">
              <h3>150</h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box Lush">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box Sulfur">
            <div class="inner">
              <h3>44</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box Shalala">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

  	
  </div>
 
@endsection
@section('scripts')

<script>
  
  if($("#LoggedInfield").val()=='good'){
    //Show popup
    //swal("Welcome to the admin side!","You have successfully logged in!","success");
   }

    if($("#LoggedInfield").val()=='fail'){
    //Show popup
    //swal("Sorry!","the session might have already been ","warning");
   }

</script>
@endsection