<!DOCTYPE html>
<html>
    <head>
    	@include('partials._head')
    </head>
    <body>
        @yield('css')
        @yield('content')
        @include('partials._javascript')
			  @yield('scripts')
    </body>
</html>
