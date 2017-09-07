@extends('customer_side_main')
@section('title', 'Contact')
@section('css')
    <link href="_CSS/contactx.css" rel="stylesheet">
@endsection
@section('content')
        <!--LOGIN-->

        <div class="container" style="margin-top: 50px;">
            <div class="row" style="margin-top:20px">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                    <form role="form">
                        <fieldset>
                            <h2 class="text-center fontx">Contact Us</h2>
                            <hr class="colorgraph">
                            <div class="row">
                              <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                  <input type="text" name="first_name" id="first_name" class="form-control input-lg fontxx" placeholder="First Name" tabindex="1">
                                </div>
                              </div>
                              <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                  <input type="text" name="last_name" id="last_name" class="form-control input-lg fontxx" placeholder="Last Name" tabindex="2">
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" id="email" class="form-control input-lg fontxx" placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control input-lg fontxx" placeholder="Message">
                            </div>
                            <hr class="colorgraph">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <input type="submit" class="btn btn-lg btn-success btn-block fontxx" value="Send">
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <a href="../index.php" class="btn btn-lg btn-primary btn-block fontxx">Back</a>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
@endsection