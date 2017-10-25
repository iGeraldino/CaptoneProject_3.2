
@extends('login_design')
@section('css')
    <link href="{{ URL::asset('_CSS/login_css.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="section-signup colorx">

	<div class="container">
		 <div class="row">
			<div class="col-md-4 col-md-offset-1">
				<div class="card card-signup">
					<form class="form" method="post" action="{{ route('AdminSignin') }}">
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
			<div class="col-md-6">
				<div class="card card-signup">
						<div class="header header-primary text-center">
							<h4>CREATE ACCOUNT</h4>
						</div>
						<br>
						<br>
						<div class="content">
							<div class="col-md-6">
								<div class="input-group" style="margin-top: -15%;">
									<span class="input-group-addon">
										<i class="material-icons"> person </i>
									</span>
									<input type="text" class="form-control" id="fname" placeholder="First Name..." tabindex="1" required>
								</div>
								<div class="input-group" style="margin-top: -15%;">
									<span class="input-group-addon">
										<i class="material-icons"> phone </i>
									</span>
									<input type="text" class="form-control" id="contno" placeholder="Contact Number..." tabindex="1" maxlength="13" required>
								</div>
								<div class="input-group" style="margin-top: -15%;">
									<span class="input-group-addon">
										<i class="material-icons">lock_outline</i>
									</span>
									<input type="password" id="password" placeholder = "Password..." class = "form-control" tabindex="3"/>
								</div>
								<div class="input-group" style="margin-top: -15%;">
									<span class="input-group-addon">
										<i class="material-icons">email</i>
									</span>
									<input type="email" id="email" placeholder = "Email Address..." class = "form-control" tabindex="2" required/>
								</div>
							</div>
							<div class="col-md-6">
								<div class="input-group" style="margin-top: -15%;">
									<span class="input-group-addon">
										<i class="material-icons"> person </i>
									</span>
									<input type="text" class="form-control" id="lname" placeholder="Last Name..." tabindex="1" required>
								</div>
								<div class="input-group" style="margin-top: -15%;">
									<span class="input-group-addon">
										<i class="material-icons"> person </i>
									</span>
									<input type="text" class="form-control" id="username" placeholder="User Name..." tabindex="1" required>
								</div>
								<div class="input-group" style="margin-top: -15%;">
									<span class="input-group-addon">
										<i class="material-icons">lock_outline</i>
									</span>
									<input type="password"  id="password2" placeholder = "Confirm Password..." class = "form-control" tabindex="4"/>
									<h7 id="error" style="color: red"> Password is not the same</h7>
								</div>
							</div>




							<div class="input-group hidden">
								<span class="input-group-addon">
									<i class="material-icons">people</i>
								</span>
								<select class="form-control" id="admintype" tabindex="5">
									<option value="1"> Admin </option>
								</select>
							</div>


							<div class="text-center">
								<button data-toggle="modal" data-target="#myModal" id="signupbutt" type="submit" class="btn btn-simple btn-primary btn-lg" tabindex="7">Signup</button>
							</div>

						</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Modal Core -->

<!-- Modal Core -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Sign-up Code</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="{{ route('AdminSignup') }}">

				<div class="input-group col-md-6" style="margin-left: 120px;">
								<span class="input-group-addon">
									<i class="material-icons">code</i>
								</span>
					<input type="text" name="randomcode" placeholder = "Signup Code..." class = "form-control" tabindex="1" maxlength="4" required/>
				</div>
					<div hidden>
					<input type="text" name="username" id="username1" value="">
					<input type="text" name="email" id="email1" value="">
					<input type="text" name="password" id="password1" value="">
					<input type="text" name="admintype" id="admintype1" value="">
					<input type="text" name="fname" id="fname1" value="">
					<input type="text" name="lname" id="lname1" value="">
					<input type="text" name="contno" id="contno1" value="">
					</div>

					<div class="input-group col-md-6" style="margin-left: 120px;">
								<span class="input-group-addon">
									<button type="submit" class="btn btn-primary btn-md"> Sign-Up </button>
								</span>
				</div>
					{{ csrf_field() }}
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" type="submit" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>
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

        $(document).ready(function(){

                //called when key is pressed in textbox
            $("#contno").keypress(function (e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    //display error message
                    return false;
                }
            });

           // $('#signupbutt').attr('disabled', true);

			$('#error').hide();

			$('#password').change(function(){

                $('#password2').change(function(){

                    var password = $('#password').val();
                    var password2 = $('#password2').val();


                    if(password == password2){

						$('#error').slideUp();
						$('#signupbutt').attr('disabled', false);

					}
					else{

                        $('#error').slideDown();

					}

            }); //password change script




        }); // password change script


			$('#signupbutt').click(function(){

			     var username = $('#username').val();
			    $('#username1').val(username);
			    var email = $('#email').val();
			    $('#email1').val(email);
			    var password = $('#password').val();
			    $('#password1').val(password);
			    var usertype = $('#admintype').val();
			    $('#admintype1').val(usertype);
			    var fname = $('#fname').val();
			    $('#fname1').val(fname);
			    var lname = $('#lname').val();
			    $('#lname1').val(lname);
			    var contno = $('#contno').val();
			    $('#contno1').val(contno);


			});

      if({{ $validator }} == 0){

        swal("Authentication Code : 1234","Info");

      }
      else if( {{ $validator }} == 1){


      }




        });

	</script>


	@endsection
