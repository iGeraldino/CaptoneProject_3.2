@extends('customer_side_main')
@section('title', 'Bouquets')
@section('css')
    <link href="_CSS/bouquetss.css" rel="stylesheet">
@endsection
@section('content')

        <!-- START OF GALLERY -->

        <div class = "container-fluid" style="margin-top: 80px">

        <div class="col-xs-12">
            <div class="well wellcolor well-sm">
                <strong class="col-xs-offset-5">Bouquet Available</strong>
                <a type="button" class="btn btn-default col-xs-offset-3" href="{{ route('flowerlist') }}"> <i class="material-icons md-18">add_circle_outline</i> Create your Own Bouquet</a>

            </div>
            @foreach($bouquetlist as $bouq)
            <div class="item  col-sm-3 ">
                    <div class="thumbnail">
                        <img class="group list-group-image" src="{{asset('bouquetimage/'. $bouq -> image)}}" alt="" />
                        <br>
                        <div class="caption">
                            <h4 class="group inner list-group-item-heading captionx">
                                BOUQ-{{ $bouq -> bouquet_ID }}</h4>
                                <hr class="colorgraph">
                            <div class="row">
                                <div class="col-sm-4">
                                    <span class="label label-danger"> {{ $bouq-> count_ofFlowers }} pcs</span>
                                </div>
                                <div class="col-sm-4">
                                    <a class="btn btn-sm btn-success" href="{{ route('viewbouquet', ['id' => $bouq -> bouquet_ID ]) }}">  <span class="glyphicon glyphicon-shopping-cart"></span> Add to cart</a>
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
