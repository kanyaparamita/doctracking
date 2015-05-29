<!DOCTYPE html>
<html>
    <head>
        @yield('additional_header')
    </head>
    <body onload="window.print()">
        <!-- Main Wrapper. Set this to 'fixed' for fixed layout and 'fluid' for fluid layout' -->
            @yield('content')
        @yield('additional_footer')
    </body>
</html>
