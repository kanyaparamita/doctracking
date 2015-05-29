<?php
    if (Auth::user() != null)
        $current_setting = Auth::user()->organization->setting;
    else if (Session::get('customer_id') != null)
        $current_setting = Customer::find(Session::get('customer_id'))->organization->setting;
    else
        $current_setting = Organization::first()->setting;
?>

<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
@if ($current_setting != null)
    @if ($current_setting->is_active == 1 && $current_setting->logo != '')
        <link rel="icon" href="{{asset('img/settings/'.$current_setting->logo)}}" type="image/x-icon">
    @else
        <link rel="icon" href="{{asset('img/logo-kota.png')}}" type="image/x-icon">
    @endif
@else
    <link rel="icon" href="{{asset('img/logo-kota.png')}}" type="image/x-icon">
@endif

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

@if ($current_setting != null)
    @if ($current_setting->is_active == 1)
        @if ($current_setting->title != '')
            <title>{{ $current_setting->title }}</title>
        @else
            <title>Document Tracking</title>
        @endif

        <!-- Additional style  -->
        <style>
            @if ($current_setting->header_image != '')
                div#da-header #da-header-top {
                    background-image: url({{ asset('img/settings/'.$current_setting->header_image )}}) !important;
                }
            @endif
            @if ($current_setting->background_image != '')
                body {
                    background-image: url({{ asset('img/settings/'.$current_setting->background_image )}}) !important;
                }
            @endif
        </style>
    @else
        <title>Document Tracking</title>
    @endif
@else
    <title>Document Tracking</title>
@endif

<!-- CSS Reset -->
{{ HTML::style('css/reset.css', array('media' => 'screen')) }}
<!--  Fluid Grid System -->
{{ HTML::style('css/fluid.css', array('media' => 'screen')) }}
<!-- Theme Stylesheet -->
{{ HTML::style('css/dandelion.theme.css', array('media' => 'screen')) }}
<!--  Main Stylesheet -->
{{ HTML::style('css/dandelion.css', array('media' => 'screen')) }}

{{ HTML::style('css/custom.css', array('media' => 'screen')) }}

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






