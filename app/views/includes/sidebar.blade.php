<?php
    $url = Request::segments();
    $controller = $url[0];

    $masterdata_tree = "closed";
    $trackingdata_tree = "closed";
    $dashboard_tree = "closed";
    $manage_tree = "closed";

    $masterdata_array = array('users', 'units', 'positions', 'roles');
    $trackingdata_array = array('reqReferences', 'services', 'fm', 'processes', 'chart');
    $dashboard_array = array('dashboard', 'dashboardAdmin', 'dashboardSuperUser', 'super');
    $manage_array = array('settings');


    if (in_array($controller, $masterdata_array)) {
        $masterdata_tree = "open";
    } elseif (in_array($controller, $trackingdata_array)){
        $trackingdata_tree = "open";
    } elseif (in_array($controller, $dashboard_array)) {
        $dashboard_tree = "open";
    } elseif (in_array($controller, $manage_array)) {
        $manage_tree = "open";
    }
?>

<!-- Sidebar -->
<div id="da-sidebar-separator"></div>
<div id="da-sidebar" style="z-index:99">

    <!-- Main Navigation -->
    <div id="da-main-nav" class="da-button-container">
        <ul>
            @if (Auth::user()->ability(null, array('dashboard_admin', 'dashboard_process', 'dashboard_superuser')))
            <li
                @if ($dashboard_tree == 'open')
                    class = "active"
                @endif
            >
                <a href="#">
                    <!-- Icon Container -->
                    <span class="da-nav-icon">
                        {{ HTML::image('images/icons/black/32/home.png', 'Dashboard') }}
                    </span>
                    Dashboard
                </a>
                <ul class="{{$dashboard_tree}}">
                    @if (Auth::user()->can('dashboard_superuser'))
                        <li><a href="{{ URL::to('dashboardSuperUser/') }}">{{Lang::get('doctrack.sb_m_super_user') }}</a></li>
                    @endif
                    @if (Auth::user()->can('dashboard_admin'))
                        <li><a href="{{ URL::to('dashboardAdmin/') }}">{{Lang::get('doctrack.sb_m_admin') }}</a></li>
                    @endif
                    @if (Auth::user()->can('dashboard_process'))
                        <li><a href="{{ URL::to('dashboard/') }}">{{Lang::get('doctrack.sb_m_task')}}</a></li>
                    @endif
                </ul>
            </li>
            @endif
            @if (Auth::user()->ability(null, array('manage_user', 'manage_unit', 'manage_position', 'manage_role')))
            <li
                @if ($masterdata_tree == 'open')
                    class = "active"
                @endif
            >
                <a href="#">
                    <!-- Icon Container -->
                    <span class="da-nav-icon">
                        {{ HTML::image('images/requirement.png', 'Requirements') }}
                    </span>
                    Master Data
                </a>
                <ul class="{{$masterdata_tree}}">
                    @if (Auth::user()->can('manage_user'))
                        <li><a href="{{ URL::to('users/') }}">{{Lang::get('doctrack.sb_m_user')}}</a></li>
                    @endif
                    @if (Auth::user()->can('manage_unit'))
                        <li><a href="{{ URL::to('units/') }}">{{Lang::get('doctrack.sb_m_unit')}}</a></li>
                    @endif
                    @if (Auth::user()->can('manage_position'))
                        <li><a href="{{ URL::to('positions/') }}">{{Lang::get('doctrack.sb_m_position')}}</a></li>
                    @endif
                    @if (Auth::user()->can('manage_role'))
                        <li><a href="{{ URL::to('roles/') }}">{{Lang::get('doctrack.sb_m_role')}}</a></li>
                    @endif
                </ul>
            </li>
            @endif
            @if (Auth::user()->ability(null, array('manage_requirement', 'manage_service', 'manage_file', 'manage_chart')))
            <li
                @if ($trackingdata_tree == 'open')
                    class = "active"
                @endif
            >
                <a href="#">
                    <!-- Icon Container -->
                    <span class="da-nav-icon">
                        {{ HTML::image('images/icons/black/32/graph.png', 'Requirements') }}
                    </span>
                    Tracking Data
                </a>
                <ul class="{{$trackingdata_tree}}">
                    @if (Auth::user()->can('manage_requirement'))
                        <li><a href="{{ URL::to('reqReferences/') }}">{{Lang::get('doctrack.sb_m_requirement')}}</a></li>
                    @endif
                    @if (Auth::user()->can('manage_service'))
                        <li><a href="{{ URL::to('services/') }}">{{Lang::get('doctrack.sb_m_service')}}</a></li>
                        <li><a href="{{ URL::to('reportico') }}">{{Lang::get('doctrack.sb_m_report')}}</a></li>
                    @endif
                    @if (Auth::user()->can('manage_file'))
                        <li><a href="{{ URL::to('fm/') }}">{{ Lang::get('doctrack.sb_m_file')}}</a></li>
                    @endif
                    <li><a href="{{ URL::to('chart/') }}"> {{Lang::get('doctrack.sb_m_chart')}}</a></li>
                </ul>
            </li>
            @endif

            @if (Auth::user()->ability(null, array('manage_setting')))
            <li
                @if ($manage_tree == 'open')
                    class = "active"
                @endif
            >
                <a href="#">
                    <!-- Icon Container -->
                    <span class="da-nav-icon">
                        {{ HTML::image('images/icons/black/32/cog_4.png', 'Manage') }}
                    </span>
                    Manage
                </a>
                <ul class="{{$manage_tree}}">
                    @if (Auth::user()->can('manage_setting'))
                        <li><a href="{{ URL::to('settings/') }}">{{Lang::get('doctrack.sb_m_setting')}}</a></li>
                    @endif
                </ul>
            </li>
            @endif
        </ul>
    </div>

</div>