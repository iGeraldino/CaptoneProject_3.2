@extends('customer_side_main')
@section('title', 'Product Detail')
@section('css')
    <link href="_CSS/login2.css" rel="stylesheet">
@endsection

@section('content')
<div class="container" style="margin-top: 100px">
	<div class="row">

    <form method="POST" action="{{ route('addtocart.store') }}">

        <div class="col-xs-4 item-photo" style="border-style:solid;">
            <img style="max-width:100%; height:50%; width:100%;" src="{{ asset('flowerimage/'. $prod -> IMG)}}"/>
        </div>
        <div class="col-xs-5" style="border:0px solid gray">
            <!-- Precios -->

            <input type="hidden" name ="id" value="{{ $prod -> flower_ID }}">
            <input type="hidden" name ="fp" value="{{ $prod -> Final_SellingPrice }}">
            <input type="hidden" name ="pic" value="{{ $prod -> IMG}}">
            <h6 class="title-price"><small>Flower Name</small></h6>
            <h3 style="margin-top:0px;" >{{ $prod -> flower_name }}</h3>
            <h6 class="title-price"><small>PRICE</small></h6>
            <h3 style="margin-top:0px;" >PHP {{ $prod -> Final_SellingPrice }}</h3>

            <!-- Detalles especificos del producto -->
            <div class="section">
                <div>
                    <div class="attr" style="width:25px;background:#5a5a5a;"></div>
                    <div class="attr" style="width:25px;background:white;"></div>
                </div>
            </div>
            <div class="section" style="padding-bottom:20px;">
                <h6 class="title-attr"><small>QUANTITY</small></h6>
                <div>
                    <div class="btn-minus"><span class="glyphicon glyphicon-minus"></span></div>
                    <input value="1" name="quantity"/>
                    <div class="btn-plus"><span class="glyphicon glyphicon-plus"></span></div>
                </div>
            </div>
            <!-- Botones de compra -->
            <div class="section" style="padding-bottom:20px;">
                <button type="submit" class="btn btn-success" ><span style="margin-right:20px" class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Add to Cart</button>
            </div>

            {{ csrf_field() }}

        </div>
      </form>


    </div>
</div>
@endsection
@section('script')
<script>
       $(document).ready(function(){
            //-- Click on detail
            $("ul.menu-items > li").on("click",function(){
                $("ul.menu-items > li").removeClass("active");
                $(this).addClass("active");
            })

            $(".attr,.attr2").on("click",function(){
                var clase = $(this).attr("class");

                $("." + clase).removeClass("active");
                $(this).addClass("active");
            })

            //-- Click on QUANTITY
            $(".btn-minus").on("click",function(){
                var now = $(".section > div > input").val();
                if ($.isNumeric(now)){
                    if (parseInt(now) -1 > 0){ now--;}
                    $(".section > div > input").val(now);
                }else{
                    $(".section > div > input").val("1");
                }
            })
            $(".btn-plus").on("click",function(){
                var now = $(".section > div > input").val();
                if ($.isNumeric(now)){
                    $(".section > div > input").val(parseInt(now)+1);
                }else{
                    $(".section > div > input").val("1");
                }
            })
        })
</script>
@endsection
