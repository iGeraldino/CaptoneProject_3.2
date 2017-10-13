@extends('customer_side_main')
@section('title', 'About Us')
@section('css')
    <link href="_CSS/about1.css" rel="stylesheet">
@endsection
@section('content')
        <!--about -->
        <div class="wrapper">
          <div class="jumbotron text-center" style="background: #6fb98f;">
            <h1 class = "fontx">Wonderbloom Flowershop</h1> 
            <p>We specialize in blablabla</p> 
          </div>


          <!--about -->

          <div class="container" id="features">
            <div class="row">
              <div class="col-md-4 feature">
                    <i class="glyphicon glyphicon-picture"></i>
                      <h3>Fresh Flowers</h3>
                      <div class="title_border"></div>
                      <p style="padding-bottom: 10%;">Wonderbloom Flowershop offered flowers of all varieties, sizes, colors and smells and where freshest flowers in town are being offered </p>
              </div>
                  <div class="col-md-4 feature">
                      <i class="glyphicon glyphicon-globe"></i>
                      <h3>Can deliver Nationwide</h3>
                      <div class="title_border"></div>
                      <p>Wonderbloom Flowershop is engage in wholesaling and retailing quality flowers adn floral arrangements. It always assures the best when it comes in servicing the customer. The flowershop can deliver flowers nationwide.  </p>
              </div>
                  <div class="col-md-4 feature">
                      <i class="glyphicon glyphicon-briefcase"></i>
                      <h3>Secured</h3>
                      <div class="title_border"></div>
                      <p style="padding-bottom: 5%;">The customer's information are well monitored and secured. The system produce accurate and reliable data and serves as an effective tool for storing records and transactions. </p>
              </div>
            </div>
          </div>
        <!-- About End -->
@endsection