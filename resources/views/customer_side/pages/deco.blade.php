@extends('customer_side_main')
@section('title', 'Decorations')
@section('css')
    <link href="_CSS/decos.css" rel="stylesheet">
@endsection
@section('content')
        <!-- End Of NavBar-->

        <!-- START OF VIDEOSLIDER -->
        <div class="container wrapper">
		    <div id="myCarousel" class="carousel slide" data-ride="carousel">
		      <!-- Wrapper for slides -->
		      <div class="carousel-inner">
		        <div class="item active size">
		          	<img src="../images/Carousel_Home/Carousel5.jpg">
		           <div class="carousel-caption">
		            <h1 class="h3font">Wedding Ideas</h1>
		            <p class="fontz">Together, find the one that fits your story and wedding style</p>
		            <a  class="label label-danger">Find out more</a>
		          </div>
		        </div><!-- End Item -->
		 
		         <div class="item size">
		          	<img src="../images/Carousel_Home/Carousel5.jpg">
		           <div class="carousel-caption">
		            <h3>Headline</h3>
		            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. <a href="http://sevenx.de/demo/bootstrap-carousel/" target="_blank" class="label label-danger">Bootstrap 3 - Carousel Collection</a></p>
		          </div>
		        </div><!-- End Item -->
		        
		        <div class="item size">
		          <img src="../images/Carousel_Home/Carousel5.jpg">
		           <div class="carousel-caption">
		            <h3>Headline</h3>
		            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. <a href="http://sevenx.de/demo/bootstrap-carousel/" target="_blank" class="label label-danger">Bootstrap 3 - Carousel Collection</a></p>
		          </div>
		        </div><!-- End Item -->
		        
		        <div class="item size">
		          <img src="../images/Carousel_Home/Carousel5.jpg">
		           <div class="carousel-caption">
		            <h3>Headline</h3>
		            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
		          </div>
		        </div><!-- End Item -->
		                
		      </div><!-- End Carousel Inner -->


		    	<ul class="nav nav-pills nav-justified">
		          <li data-target="#myCarousel" data-slide-to="0" class="active fontz"><a href="#">Wedding</a></li>
		          <li data-target="#myCarousel" data-slide-to="1" class="fontz"><a href="#">Debut</a></li>
		          <li data-target="#myCarousel" data-slide-to="2" class="fontz"><a href="#">Party</a></li>
		          <li data-target="#myCarousel" data-slide-to="3" class="fontz"><a href="#">Other Services</a></li>
		        </ul>
		    </div><!-- End Carousel -->
		</div>

		<!-- Services -->
		<div class="container" style="margin-top: 30px;">
			<div class="row">
				<h2 class="text-center txt">Services Offered</h2>
		            <div class="row">
		                <div class="col-md-3 text-center">
		                    <div class="box">
		                        <div class="box-content">
		                            <h1 class="tag-title textfont">Wedding</h1>
		                            <hr />
		                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi pharetra quam sollicitudin nibh aliquam finibus. Etiam efficitur felis vel imperdiet varius. Maecenas bibendum elementum molestie. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris cursus finibus semper. Fusce molestie tincidunt leo vel varius. Nam scelerisque nulla feugiat leo consequat, id dignissim sem tincidunt. Proin elit mauris, hendrerit in varius sed, facilisis sit amet neque.</p>
		                            <br />
		                            <a href="/wedding" class="btn btn-block btn-primary">Learn more</a>
		                        </div>
		                    </div>
		                </div>
		                <div class="col-md-3 text-center">
		                    <div class="box">
		                        <div class="box-content">
		                            <h1 class="tag-title textfont">Debut</h1>
		                            <hr />
		                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi pharetra quam sollicitudin nibh aliquam finibus. Etiam efficitur felis vel imperdiet varius. Maecenas bibendum elementum molestie. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris cursus finibus semper. Fusce molestie tincidunt leo vel varius. Nam scelerisque nulla feugiat leo consequat, id dignissim sem tincidunt. Proin elit mauris, hendrerit in varius sed, facilisis sit amet neque.</p>
		                            <br />
		                            <a href="event.php" class="btn btn-block btn-primary">Learn more</a>
		                        </div>
		                    </div>
		                </div>
		                <div class="col-md-3 text-center">
		                    <div class="box">
		                        <div class="box-content">
		                            <h1 class="tag-title textfont">Party</h1>
		                            <hr />
		                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi pharetra quam sollicitudin nibh aliquam finibus. Etiam efficitur felis vel imperdiet varius. Maecenas bibendum elementum molestie. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris cursus finibus semper. Fusce molestie tincidunt leo vel varius. Nam scelerisque nulla feugiat leo consequat, id dignissim sem tincidunt. Proin elit mauris, hendrerit in varius sed, facilisis sit amet neque.</p>
		                            <br />
		                            <a href="event.php" class="btn btn-block btn-primary">Learn more</a>
		                        </div>
		                    </div>
		                </div>
		                <div class="col-md-3 text-center">
		                    <div class="box">
		                        <div class="box-content">
		                            <h1 class="tag-title textfont">Other</h1>
		                            <hr />
		                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi pharetra quam sollicitudin nibh aliquam finibus. Etiam efficitur felis vel imperdiet varius. Maecenas bibendum elementum molestie. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris cursus finibus semper. Fusce molestie tincidunt leo vel varius. Nam scelerisque nulla feugiat leo consequat, id dignissim sem tincidunt. Proin elit mauris, hendrerit in varius sed, facilisis sit amet neque.</p>
		                            <br />
		                            <a href="event.php" class="btn btn-block btn-primary">Learn more</a>
		                        </div>
		                    </div>
		                </div>
		            </div>       
		        </div>
			</div>

        
        <script>
        	$(document).ready( function() {
		    $('#myCarousel').carousel({
				interval:   4000
			});
			
			var clickEvent = false;
			$('#myCarousel').on('click', '.nav a', function() {
					clickEvent = true;
					$('.nav li').removeClass('active');
					$(this).parent().addClass('active');		
			}).on('slid.bs.carousel', function(e) {
				if(!clickEvent) {
					var count = $('.nav').children().length -1;
					var current = $('.nav li.active');
					current.removeClass('active').next().addClass('active');
					var id = parseInt(current.data('slide-to'));
					if(count == id) {
						$('.nav li').first().addClass('active');	
					}
				}
				clickEvent = false;
			});
		});
        </script>
@endsection