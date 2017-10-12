<!DOCTYPE html>
<html>
    <head>
    @include('customer_side/partials/_head')
    </head>
        <body>
            @include('customer_side/partials/_nav')
                @yield('css')
                @yield('content')
            @include('customer_side/partials/_footer')
            @include('customer_side/partials/_scripts')
            @include('sweet::alert')
            @yield('script')

        </body>
</html>
