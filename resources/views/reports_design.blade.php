<html>
    <head>
    @include('customer_side/partials/_head')
    </head>
        <body>
                @yield('css')
                @yield('content')
            @include('customer_side/partials/_scripts')
            @yield('script')

        </body>
</html>
