@extends('customer_side_main')
@section('title', 'Cart')
@section('css')
    <link href="_CSS/cart1.css" rel="stylesheet">
@endsection
@section('content')
	<?php
		$AddingFlowertoCartSession = Session::get('Addding_FlowertoCartSession');
		Session::Remove('Addding_FlowertoCartSession');

		$UpdateflowertoCartSession = Session::get('Update_FlowertoCartSession');
		Session::Remove('Update_FlowertoCartSession');

		$DeleteFlowertoCartSession = Session::get('Delete_FlowertoCartSession');
		Session::Remove('Delete_FlowertoCartSession');


	?>
		<!-- cart -->
<div hidden>
		<input id = "addflowerSession" value = "{{$AddingFlowertoCartSession}}">
		<input id = "updateflowerSession" value = "{{$UpdateflowertoCartSession}}">
		<input id = "deleteflowerSession" value = "{{$DeleteFlowertoCartSession}}">
	
</div>
		<div class="container" style="margin-top: 100px;">
		    <div class="row">
		        <div class="col-sm-12 col-md-10 col-md-offset-1">


		            <table class="table table-hover">
		                <thead>
		                    <tr>
		                        <th>Product</th>
		                        <th>Quantity</th>
		                        <th class="text-center">No. of Items</th>
		                        <th class="text-center">Price</th>
		                        <th class="text-center">Total</th>
		                        <th> </th>
		                    </tr>
		                </thead>
		                <tbody>


                      @foreach(Cart::instance('flowerwish')->content() as $cart1)

		                      <tr>
                            {!! Form::model($cart1, ['route'=>['updateflower', 'id' => $cart1->id], 'method'=>'PUT'])!!}

		                        <td class="col-md-6">
		                        <div class="media">
		                            <a class="thumbnail pull-left" href="#"> <img class="media-object" src="{{ asset('flowerimage/'. $cart1 -> options -> image)}}" style="width: 72px; height: 72px;"> </a>
		                            <div class="media-body">
		                                <h4 class="media-heading"><a href="#">{{ $cart1 -> name}}</a></h4>
		                            </div>
		                        </div>
                          </td>
		                        <td class="col-md-1" style="text-align: center">
		                        <input type="number" name="quantity" class="form-control" id="qua" value="{{$cart1 -> qty}}">
                            <input type="hidden" name="id" value="{{ $cart1 -> id}}">
		                        </td>
		                        <td class="col-md-1 text-center"><strong> N/A  </strong></td>
		                        <td class="col-md-1 text-center"><strong> ₱ {{ number_format ($cart1-> qty * $cart1->price,2) }}</strong></td>
		                        <td class="col-md-1">

                            <button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-refresh"></span> Update</button>
                            {!! Form::close() !!}
                            <br>
                            <br>

		                        <a class="btn btn-danger" type="button" href="{{ route('deleteprodinCart', ['id' => $cart1-> id ]) }}">
                              <span class="glyphicon glyphicon-remove"></span> Remove</a>


                          </td>
                      </tr>

                      @endforeach
                      @foreach(Cart::instance('finalboqcart')->content() as $cart1)

		                      <tr>
                            {!! Form::model($cart1, ['route'=>['boqupdate', 'id' => $cart1->id], 'method'=>'PUT'])!!}

		                        <td class="col-md-6">
		                        <div class="media">
		                            <a class="thumbnail pull-left" href="#"> <img class="media-object" src="{{ asset('full/'.'default_Bqt.jpg')}}" onerror="{{ asset('full/'.'default_Bqt.jpg')}}" style="width: 72px; height: 72px;"> </a>
		                            <div class="media-body">
		                                <h4 class="media-heading"><a href="#">{{ $cart1 -> name}}</a></h4>
		                            </div>
		                        </div>
                          </td>
		                        <td class="col-md-1" style="text-align: center">
		                        <input type="number" name="quantity" class="form-control" id="qua" value="{{$cart1 -> qty}}">
                            <input type="hidden" name="id" value="{{ $cart1 -> id}}">
		                        </td>
		                        <td class="col-md-1 text-center"><strong> {{ $cart1 -> options -> count}} </strong></td>
		                        <td class="col-md-1 text-center"><strong> ₱ {{ number_format ($cart1-> qty * $cart1->price,2) }}</strong></td>
		                        <td class="col-md-1">

                            <button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-refresh"></span> Update</button>
                            {!! Form::close() !!}
                            <br>
                            <br>

		                        <a class="btn btn-danger" type="button" href="{{ route('deleteboquet', ['id' => $cart1-> id ]) }}">
                              <span class="glyphicon glyphicon-remove"></span> Remove</a>


                          </td>
                      </tr>

                      @endforeach



		                    <tr>
		                        <td>   </td>
		                        <td>   </td>
		                        <td>   </td>
		                        <td><h5>Total Item </h5></td>
		                        <td class="text-right"><h5><strong>{{ number_format (str_replace(array(','), array(''), Cart::instance('finalboqcart')->count()) + str_replace(array(','), array(''), Cart::instance('flowerwish')->count()), 0 ) }} Pcs</strong></h5></td>
		                    </tr>
		                    <tr>
		                        <td>   </td>
		                        <td>   </td>
		                        <td>   </td>
		                        <td><h3>Total</h3></td>
		                        <td class="text-right"><h3><strong>₱{{ number_format (str_replace(array(','), array(''), Cart::instance('finalboqcart')->subtotal()) + str_replace(array(','), array(''), Cart::instance('flowerwish')->subtotal()), 2) }}</strong></h3></td>
		                    </tr>
		                    <tr>
		                        <td>   </td>
		                        <td>   </td>
		                        <td>   </td>
		                        <td>
		                        <button type="button" class="btn btn-success links">
		                        	<a href= "{{ route('customer_side.pages.flower')}}">Continue Shopping</a>
		                            <span class="glyphicon glyphicon-shopping-cart"></span>
		                        </button></td>
		                        <td>
		                        	<input id="count" value="{{ number_format (str_replace(array(','), array(''), Cart::instance('finalboqcart')->count()) + str_replace(array(','), array(''), Cart::instance('flowerwish')->count()), 0 ) }}" type="hidden">
		                        	<a type="submit" class="btn btn-success links" id="checkout" href="{{ route('checkingregistration')}}">
		                        	  <span class="glyphicon glyphicon-chevron-right"></span>Checkout
		                        </a></td>

		                        </td>
		                    </tr>
		                </tbody>
		            </table>
		        </div>
		    </div>
		</div>
@endsection

@section('script')

	<script>
	if($("#count").val() <= 0){

		$("#checkout").attr('disabled', true);

		$("#checkout").click(function(){
			return false;
		});
	}
	else{
		$("#checkout").click(function(){
			return true;
		});
	}
	
	</script>
	<script>
		$(document).ready(function(){
			if($('#addflowerSession').val() == 'Successful'){
				swal('Success!','the flower was successfully added to the cart','success');
			}

			if($('#updateflowerSession').val() == 'Successful'){
				swal('Take Note!','the quantity was successfully added to the cart','info');
			}else if($('#updateflowerSession').val() == 'Fail'){
				swal('Warning!','the inputted quantity is equal to the previous quantity, therefore no changes was made','warning');
			}

			if($('#deleteflowerSession').val() == 'Successful'){
				swal('Success!','the flower was successfully deleted to the cart','success');
			}
		});
	</script>


@endsection
