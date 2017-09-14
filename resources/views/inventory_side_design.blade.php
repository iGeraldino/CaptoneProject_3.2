<!DOCTYPE html>
<html>

@include('partials._head')

<body class="hold-transition skin-blue fixed sidebar-mini">

@include('inventory_side/partials/_nav')

<div class="content-wrapper">


	@yield('content')


</div> <!-- end of the container -->

@include('partials._javascript')
	
	@yield('scripts')

</body>
</html>
