@if ( count ($errors) > 0)

	<div class="alert alert-danger" role="alert">

		<strong> Errors: </strong>
		<ul>
			
		@foreach ($errors as $error)

			<li> {{$error}}	</li>

		@endforeach
		</ul>
	</div>


@endif
