<!DOCTYPE html>
<html>

@include('partials._head')


<body class="hold-transition skin-blue fixed sidebar-mini">

@if(auth::guard('admins')->user()->type == '2' )
@include('cashier/partials/_nav')
@elseif(auth::guard('admins')->user()->type == '1')
@include('partials._nav')
@elseif(auth::guard('admins')->user()->type == '3')
@include('inventory_side/partials/_nav')

@endif


<div class="content-wrapper">


	@yield('content')


</div> <!-- end of the container -->

@include('partials._javascript')
@yield('scripts')

</body>

</html>
