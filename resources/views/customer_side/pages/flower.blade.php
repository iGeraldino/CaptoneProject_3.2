@extends('customer_side_main')
 @section('title', 'Flowers')
 @section('css')
    <link href="_CSS/flower.css" rel="stylesheet">
@endsection
 @section('content')
        <!-- START OF GALLERY -->

        <div class = "container-fluid" style="margin-top: 80px">
            <div class="col-md-12">

        </div>
        <div class="col-xs-12">
            <div class="well wellcolor well-sm">
                <strong>Wonderbloom Flowershop</strong>
            </div>
            @foreach($flowerlist as $flowerlist)
            <div class="item  col-sm-3 ">
                    <div class="thumbnail">
                        <img style="max-width: 250px; max-height: 250px; min-width: 250px; min-height: 250px;" class="group list-group-image" src="{{ asset('flowerimage/'. $flowerlist -> IMG)}}" alt="" />
                        <br>
                        <div class="caption">
                            <h4 class="group inner list-group-item-heading captionx">
                                {{ $flowerlist -> flower_name }}</h4>
                                <hr class="colorgraph">
                            <div class="row">
                                <div class="col-sm-8">
                                    <span class="btn btn-md btn-danger"> Php {{ number_Format($flowerlist -> Final_SellingPrice,2) }}</span>
                                </div>
                                <div class="col-sm-4">
                                    <a class="btn btn-lg btn-success" href="{{ route('product.show', ['id' => $flowerlist -> flower_ID ])}}">  <span class="glyphicon glyphicon-shopping-cart"></span> View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              @endforeach

            </div>
          </div>
    </div>

        <!-- end of flower gallery -->

@endsection
