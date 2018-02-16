
@extends('login_design')
@section('css')
    <link href="{{ URL::asset('_CSS/login_css.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="section-signup colorx">
<?php
	 $sessionLoginValue = Session::get('loginSession');
  	 Session::remove('loginSession');//determines the addition of new flower
?>

  <div hidden>
    <input id = "LoggedInfield" value = "{{$sessionLoginValue}}">
  </div>


	<div class="container">
		 <div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="card card-signup">
					<form class="form" method="POST" action=" {{ route('adminsignin') }} ">
						<div class="header header-primary text-center">
							<h4>LOGIN</h4>
						</div>
						<br>
						<br>
						<div class="content">

							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">face</i>
								</span>
								<input type="text" class="form-control" name="email" placeholder="User Name...">
							</div>

							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">lock_outline</i>
								</span>
								<input type="password" name="password" placeholder = "Password..." class = "form-control"/>
							</div>

							<div class="text-center">
								<button type="submit"  class="btn btn-simple btn-primary btn-lg">Login</button>
							</div>
						</div>
						{{ csrf_field() }}
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="background-wrap">
	<video id="video-ng-elem" preload="auto" autoplay="true" loop="loop" muted="muted">
		<source src="{{ URL::asset('videos/Spring Flower.mp4') }}" type="video/mp4">
	</video>
</div>


@endsection

@section('scripts')
<script>

  if($("#LoggedInfield").val()=='OUT'){
    //Show popup
    swal("Thank you!","You successfully Logged out!","success");
   }

  if($("#LoggedInfield").val()=='fail'){
    //Show popup
    swal("Warning!","You must login your account first!","warning");
   }

    if($("#LoggedInfield").val()=='invalid'){
    //Show popup
    swal("Sorry!","The email and username that you've entered seems to be wrong, please try again","error");
   }

</script>
@endsection
