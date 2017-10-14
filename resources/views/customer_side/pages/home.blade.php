@extends('customer_side_main')
@section('title', 'Home')
@section('css')
    <link href="_CSS/index2.css" rel="stylesheet">
@endsection
@section('content')
      <!-- Start Of Carousel-->
        <div class= "carousel slide">
       <?php
        
          $SavingOrderSessionValue = Session::get('OrderSession'); 
          Session::remove('OrderSession');//determines the addition of new flower
       ?>
          <input type = "text" class = "hidden" id = "addingSessionField" value = "{{$SavingOrderSessionValue}}">

            <div id="theCarousel" class="carousel slide" data-ride="carousel">
              <!-- Define how many slides to put in the carousel -->
                <ol class="carousel-indicators">
                    <li data-target="#theCarousel" data-slide-to="0" class="active"> </li >
                    <li data-target="#theCarousel" data-slide-to="1"> </li>
                    <li data-target ="#theCarousel" data-slide-to="2"> </li>
                </ol >
                 
                  <!-- Define the text to place over the image -->
                <div class="carousel-inner">
                    <div class="item active" >
                        <div class ="slide1"></div>
                        <div class="carousel-caption">
                            <h1>Decorate your life with Flowers</h1>
                            <p><a href="/flowers" class="btn btn-danger btn-sm coolvetica">Browse Gallery</a></p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="slide2"></div>
                        <div class="carousel-caption">
                            <h1>Free delivery in metro manila</h1>
                            <p>with  minimum purchase</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="slide3"></div>
                        <div class="carousel-caption">
                            <h1>Thousands of Flowers</h1>
                            <p>Order now at Wonderbloom Flowershop</p>
                        </div>
                    </div>
                </div>
                 
                  <!-- Set the actions to take when the arrows are clicked -->
                <a class="left carousel-control" href="#theCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"> </span>
                </a>
                <a class="right carousel-control" href="#theCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
             </div>
        </div>
        <!-- End Of Carousel-->
        

        <!-- START OF BEST SELLER -->
        <div class=" container feat">
            <h1>BEST SELLERS</h1>
        </div>
        <div class="container" style="margin-top: -20px; margin-bottom: 10px;">
            <div class="row">
                <div class="col-md-4">
                    <div class="product-item">
                      <div class="pi-img-wrapper">
                        <img src="images/flower/pic4.jpg" class="img-responsive" alt="White Bouquets Roses">
                      </div>
                      <h3><a href="shop-item.html"> White Bouquets Roses</a></h3>
                      <div class="pi-price">Php 3,500</div>
                      <a href="/cart" class="btn add2cart">View Details</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="product-item">
                      <div class="pi-img-wrapper">
                        <img src="images/flower/pic3.jpg" class="img-responsive" alt="Carnation Pink Roses">
                      </div>
                      <h3><a href="shop-item.html">Carnation Pink Roses</a></h3>
                      <div class="pi-price">Php 3,000</div>
                      <a href="/cart" class="btn add2cart">View Details</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="product-item">
                      <div class="pi-img-wrapper">
                        <img src="images/flower/pic6.jpg" class="img-responsive" alt="Ecuador White Roses">
                      </div>
                      <h3><a href="shop-item.html">Ecuador White Roses</a></h3>
                      <div class="pi-price">Php 4,500</div>
                      <a href="/cart" class="btn add2cart">View Details</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="product-item">
                      <div class="pi-img-wrapper">
                        <img src="images/flower/pic3.jpg" class="img-responsive" alt="Carnation Pink Roses">
                      </div>
                      <h3><a href="shop-item.html">Carnation Pink Roses</a></h3>
                      <div class="pi-price">Php 3,000</div>
                      <a href="/cart" class="btn add2cart">View Details</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="product-item">
                      <div class="pi-img-wrapper">
                        <img src="images/flower/pic6.jpg" class="img-responsive" alt="Carnation Pink Roses">
                      </div>
                      <h3><a href="shop-item.html">Carnation Pink Roses</a></h3>
                      <div class="pi-price">Php 3,000</div>
                      <a href="/cart" class="btn add2cart">View Details</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="product-item">
                      <div class="pi-img-wrapper">
                        <img src="images/flower/pic4.jpg" class="img-responsive" alt="Carnation Pink Roses">
                        <div>
                          <a href="#" class="btn">View Details</a>
                        </div>
                      </div>
                      <h3><a href="shop-item.html">Carnation Pink Roses</a></h3>
                      <div class="pi-price">Php 3,000</div>
                      <a href="/cart" class="btn add2cart">View Details</a>
                    </div>
                </div>
            </div>
        </div>

@endsection
@section('scripts')
    <script>
    $('#example2').DataTable({

    });
    $('#example3').DataTable({

    });
      $(document).ready(function(){

        
        if($('#addingSessionField').val()=='Successful'){
         //Show popup
         swal("Good Job!:","You have successfully made an Order Please wait for the call of our employee for more information!","success");
       }
   
});



    </script>
@endsection

        