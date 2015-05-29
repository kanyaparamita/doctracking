<?php
    if (Auth::user() != null)
        $current_setting = Auth::user()->organization->setting;
    else if (Session::get('customer_id') != null)
        $current_setting = Customer::find(Session::get('customer_id'))->organization->setting;
    else
        $current_setting = Organization::first()->setting;
?>
<!-- Header -->
<div id="da-header">

    <div id="da-header-top">

        <!-- Container -->
        <div class="da-container clearfix">

            <!-- Logo Container. All images put here will be vertically centere -->
            <div id="da-logo-wrap">
                <div id="da-logo">
                    <div id="da-logo-img">
                        @if ($current_setting->is_active == 1 && $current_setting->logo != '')
                        <a href="#">
                            {{ HTML::image('img/settings/'.$current_setting->logo )}}
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @if (Auth::check())
            <div id="da-header-toolbar" class="clearfix">
                <div id="da-user-profile">
                    <div id="da-user-avatar">
                        <!-- <img src="images/pp.jpg" alt="" /> -->
                    </div>
                    <div id="da-user-info">
                        {{ Auth::user()->name }}
                        <!-- <span class="da-user-title">{{ Auth::user()->position()->first()->name . ' ' . Auth::user()->unit()->first()->name }}</span> -->
                        <span class="da-user-title">{{  Auth::user()->unit()->first()->name }}</span>
                    </div>
                    <ul class="da-header-dropdown">
                        <li class="da-dropdown-caret">
                            <span class="caret-outer"></span>
                            <span class="caret-inner"></span>
                        </li>
                        <li class="da-dropdown-divider"></li>
                        @if (Auth::user()->can('dashboard_superuser'))
                            <li>{{ link_to('dashboardSuperUser', 'Dashboard Super User')}}</li>
                        @endif
                        @if (Auth::user()->can('dashboard_admin'))
                            <li>{{ link_to('dashboardAdmin', 'Dashboard Admin')}}</li>
                        @endif
                        @if (Auth::user()->can('dashboard_process'))
                            <li>{{ link_to('dashboard', 'Dashboard')}}</li>
                        @endif
                        <li class="da-dropdown-divider"></li>
                        <li>{{ link_to('profile', 'Profile')}}</li>
                        <!-- <li>{{ link_to('setting', 'Setting')}}</li>
                        <li>{{ link_to('change_password', 'Change Password')}}</li> -->
                    </ul>
                </div>
                <div id="da-header-button-container">
                    <ul>
                        <li class="da-header-button logout">
                            {{ link_to('logout', '', array('title' => 'logout'))}}
                        </li>
                    </ul>
                </div>
            </div>
            @endif
            <div style="width=100%;heigh:100% !important;display:block;text-align:center">
                @if ($current_setting->is_active == 1 && $current_setting->title != '')
                    <h1 style="margin-bottom:0px; padding-right:10%; padding-top:10px; color:white; color:{{$current_setting->title_color}}">{{$current_setting->title}}</h1>
                @else
                    <h1 style="margin-bottom:0px; padding-right:10%; padding-top:10px; color:white;">Document Tracking Government</h1>
                @endif
            </div>


        </div>
    </div>
</div>