<!DOCTYPE html>
<html>
    <head>
        @include('includes.head')
        @yield('additional_header')
    </head>
    <body>
        <!-- Main Wrapper. Set this to 'fixed' for fixed layout and 'fluid' for fluid layout' -->
        <div id="da-wrapper" class="fluid">

           @include('includes.header')

            <!-- Content -->
            <div id="da-content">

                <!-- Container -->
                <div class="da-container clearfix">

                    @include('includes.sidebar')

                    <!-- Main Content Wrapper -->
                    <div id="da-content-wrap" class="clearfix">

                        <!-- Content Area -->
                        <div id="da-content-area">

                            @yield('content')

                        </div>

                    </div>

                </div>

            </div>

            <!-- Footer -->
            <div id="da-footer">
                <div class="da-container clearfix">
                    <p>Copyright 2014. Document Tracking. All Rights Reserved.
                </div>
            </div>

        </div>

        @yield('additional_footer')
    </body>
</html>
