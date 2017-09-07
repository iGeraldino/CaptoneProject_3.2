@extends('main')


@section('content')


	<section class="content">
		
		<div class="row">
			<div class="col-md-12">

					

			         {!! Form::model($bou, ['route'=>['bouquet.update', $bou->bouquet_ID],'method'=>'PUT','data-parsley-validate' => ''])!!} 

			         						 <div class="panel panel-default">
						               			 <img src= "{{ asset('bouquetimage/'. $bou -> image) }}" id="imageBox" name="imageBox" style="max-width: 1300px; max-height: 250px; width: 1105px;" >
						              		 </div>


						      				{{ Form::label('price','Bouquet Price:')}}
						      				{{ Form::number('price', $bou -> price, array('class' => 'form-control', 'required' => '')) }}


					      					{{ Form::label('count','Count of Flowers:')}}	
						      				{{ Form::number('count', $bou -> count_ofFlowers, array('class' => 'form-control', 'required' => '', 'maxlength' => '11')) }}

						      		
						      				

						      				{{ Form::submit('Update', array('class' => 'btn btn-success btn-md btn-block', 'style' => 'margin-top: 20px;')) }}

						      				{!! Html::linkRoute('bouquet.show', 'Cancel',array($bou->bouquet_ID),array('class'=>'btn btn-danger btn-md btn-block'))!!}


				{!! Form::close() !!}
				
			</div>
		</div>
	</section>


@endsection