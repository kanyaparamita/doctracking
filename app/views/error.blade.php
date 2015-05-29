<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="{{asset('img/icon.png')}}" type="image/x-icon">

<!-- Viewport metatags -->
<meta name="HandheldFriendly" content="true" />
<meta name="MobileOptimized" content="320" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<!-- iOS webapp metatags -->
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />

<!-- iOS webapp icons -->
<link rel="apple-touch-icon" href="touch-icon-iphone.html" />
<link rel="apple-touch-icon" sizes="72x72" href="touch-icon-ipad.html" />
<link rel="apple-touch-icon" sizes="114x114" href="touch-icon-retina.html" />

<!-- CSS Reset -->
{{ HTML::style('css/reset.css', array('media' => 'screen')) }}
<!--  Fluid Grid System -->
{{ HTML::style('css/fluid.css', array('media' => 'screen')) }}
<!-- Theme Stylesheet -->
{{ HTML::style('css/dandelion.theme.css', array('media' => 'screen')) }}
<!--  Main Stylesheet -->
{{ HTML::style('css/dandelion.css', array('media' => 'screen')) }}

<!-- jQuery JavaScript File -->
{{ HTML::script('js/jquery-1.7.2.min.js')}}

<!-- jQuery-UI JavaScript Files -->
{{ HTML::script('jui/js/jquery-ui-1.8.20.min.js')}}
{{ HTML::script('jui/js/jquery.ui.timepicker.min.js')}}
{{ HTML::script('jui/js/jquery.ui.touch-punch.min.js')}}
{{ HTML::style('jui/css/jquery.ui.all.css', array('media' => 'screen'))}}


<!-- Plugin Files -->

<!-- FileInput Plugin -->
{{ HTML::script('js/jquery.fileinput.js')}}
<!-- Placeholder Plugin -->
{{ HTML::script('js/jquery.placeholder.js')}}
<!-- Mousewheel Plugin -->
{{ HTML::script('js/jquery.mousewheel.min.js')}}
<!-- Scrollbar Plugin -->
{{ HTML::script('js/jquery.tinyscrollbar.min.js')}}
<!-- Tooltips Plugin -->
{{ HTML::script('plugins/tipsy/jquery.tipsy-min.js')}}
{{ HTML::style('plugins/tipsy/tipsy.css', array('media' => 'screen')) }}

<!-- DataTables Plugin -->
{{ HTML::script('plugins/datatables/jquery.dataTables.min.js')}}

<!-- Demo JavaScript Files -->
{{ HTML::script('js/demo/demo.tables.js')}}

<!-- Core JavaScript Files -->
{{ HTML::script('js/core/dandelion.core.js')}}

{{ HTML::script('js/core/dandelion.customizer.js')}}

<title>Document Tracking</title>


</head>

<body>

    <!-- Main Wrapper. Set this to 'fixed' for fixed layout and 'fluid' for fluid layout' -->
    <div id="da-wrapper" class="fluid">

        <!-- Content -->
        <div id="da-content">

            <!-- Container -->
            <div class="da-container clearfix">

                <div id="da-error-wrapper">

                    <div id="da-error-pin"></div>
                    <div id="da-error-code">
                        error <span>404</span>
                    </div>

                    <h1 class="da-error-heading">Whoops, it seems you are lost</h1>
                    <!-- <p>Please allow us to guide you out of this place by following <a href="dashboard.html">this link</a></p> -->
                </div>

            </div>

        </div>

        <!-- Footer -->
        <div id="da-footer">
            <div class="da-container clearfix">
                <p>Copyright 2014. Document Tracking Government. All Rights Reserved.
            </div>
        </div>

    </div>

</body>

</html>
