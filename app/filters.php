<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

// Dashboard Filter
Entrust::routeNeedsPermission( 'dashboard', 'dashboard_process', View::make('error') );
Entrust::routeNeedsPermission( 'dashboardAdmin', 'dashboard_admin', View::make('error') );
Entrust::routeNeedsPermission( 'dashboardSuperUser', 'dashboard_superuser', View::make('error') );

// Master data filter
Entrust::routeNeedsPermission( 'units*', 'manage_unit', View::make('error') );
Entrust::routeNeedsPermission( 'users*', 'manage_user', View::make('error') );
Entrust::routeNeedsPermission( 'positions*', 'manage_position', View::make('error') );
Entrust::routeNeedsPermission( 'roles*', 'manage_role', View::make('error') );

// Tracking data filter
Entrust::routeNeedsPermission( 'reqReferences*', 'manage_requirement', View::make('error') );
Entrust::routeNeedsPermission( 'services*', 'manage_service', View::make('error') );
Entrust::routeNeedsPermission( 'fm*', 'manage_file', View::make('error') );

// Service data detail
Entrust::routeNeedsPermission( 'process_task*', 'dashboard_process', View::make('error') );
// Entrust::routeNeedsPermission( 'requirement*', 'manage_service', View::make('error') );
Entrust::routeNeedsPermission( 'output*', 'manage_service', View::make('error') );
Entrust::routeNeedsPermission( 'requirements*', 'manage_service', View::make('error') );
Entrust::routeNeedsPermission( 'processes*', 'manage_service', View::make('error') );
Entrust::routeNeedsPermission( 'process_output*', 'manage_service', View::make('error') );
