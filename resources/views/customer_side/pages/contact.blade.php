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
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h5 class="panel-title text-center">Wonderbloom Flowershop</h5>
                                    </div>
                                    <div class="panel-body">
                                        <h4 style="font-family: CaviarDreams; text-align: center;"><span class="glyphicon glyphicon-map-marker"></span> <b>1600 DIMASALANG, SAMPALOC MANILA</b></h4>
                                        <h4 style="font-family: CaviarDreams; padding-left: 18%; "><span class="glyphicon glyphicon-envelope" style="padding-right: 2%;"></span><b>wonder.bloom@yahoo.com</b></h4>
                                        <h4 style="font-family: CaviarDreams; padding-left: 18%;"><span class="glyphicon glyphicon-phone-alt"></span>   <b>(02)567-3255</b></h4>
                                        <h4 style="font-family: CaviarDreams; padding-left: 18%;"><span class="glyphicon glyphicon-phone"></span>   <b>09228026806</b></h4>
                                        <h4 style="padding-left: 5%;font-family: CaviarDreams; padding-left: 22%;">   <b>09285525884</b></h4>
                                        <h4 style="padding-left: 5%;font-family: CaviarDreams; padding-left: 22%;">   <b>09175729859</b></h4>
                                    </div>
                                </div>
                            </div>

                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <a href="/home" class="btn btn-lg btn-primary btn-block fontxx">Back</a>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
@endsection