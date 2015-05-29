<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	if (Auth::check()) {
        if (Auth::user()->can('dashboard_admin')){
            return Redirect::to('dashboardAdmin');
        } else {
            return Redirect::to('dashboard');
        }

    } else {
        return Redirect::to('login');
    }
});

Route::get('login', array('uses' => 'UserController@showLogin'));
Route::post('login', array('uses' => 'UserController@doLogin'));
Route::get('outsider', array('uses' => 'OutsiderController@index'));
Route::get('outsider/{id}/requirements', array('uses' => 'OutsiderController@showRequirement'));
Route::post('outsider/{id}/start', array('uses' => 'OutsiderController@startService'));
Route::get('outsider/details/{token}', array('uses' => 'OutsiderController@detail')); // untuk fast debuging
Route::post('outsider/details', array('uses' => 'OutsiderController@detail'));
Route::post('customers/find', array('uses' => 'CustomerController@find'));
Route::post('customers/create', array('uses' => 'CustomerController@store'));
Route::get('print/checklist/{token}', array('uses'=>'PrintController@checklist'));

Route::group(array('before' => 'auth'), function() {
    Route::get('logout', array('uses' => 'UserController@doLogout'));
    Route::get('dashboard', array('uses' => 'HomeController@showDashboard'));
    Route::get('dashboardAdmin', array('uses' => 'HomeController@showDashboardAdmin'));
    Route::get('dashboardSuperUser', array('uses' => 'HomeController@showDashboardSuperUser'));

    Route::get('process_task/{se_id}/{bp_id}/process', array('uses' => 'HomeController@showProcessTask'));
    Route::get('process_task/{se_id}/{bp_id}/start', array('uses' => 'HomeController@startProcessTask'));
    Route::get('process_task/{se_id}/{bp_id}/finish', array('uses' => 'HomeController@finishProcessTask'));
    Route::post('process_task/{se_id}/{bp_id}/finish', array('uses' => 'HomeController@finishProcessTask'));
    Route::post('process_task/{se_id}/{bp_id}/store', array('uses' => 'HomeController@storeProcessTask'));
    Route::post('process_task/reject/{se_id}/{bp_id}', array('uses' => 'HomeController@rejectProcessTask'));
    Route::get('requirement/{rs_id}/{file_name}', array('uses' => 'HomeController@openRequirementStorage'));
    Route::get('output/{bpso_id}/{file_name}', array('uses'=> 'HomeController@openBPSO'));

    Route::get('requirements/{service_id}/', array('uses'=>'RequirementController@index'));
    Route::get('requirements/{service_id}/create', array('uses'=>'RequirementController@create'));
    Route::post('requirements/{service_id}/create', array('uses'=>'RequirementController@store'));
    Route::get('requirements/{service_id}/edit/{req_id}', array('uses'=>'RequirementController@edit'));
    Route::put('requirements/{service_id}/update/{req_id}', array('uses'=>'RequirementController@update', 'as'=>'requirements.update'));
    Route::delete('requirements/{service_id}/delete/{req_id}', array('uses'=>'RequirementController@destroy'));

    Route::get('processes/{service_id}/', array('uses'=>'ProcessController@index'));
    Route::get('processes/{service_id}/create', array('uses'=>'ProcessController@create'));
    Route::post('processes/{service_id}/create', array('uses'=>'ProcessController@store'));
    Route::get('processes/{service_id}/edit/{bp_id}', array('uses'=>'ProcessController@edit'));
    Route::put('processes/{service_id}/update/{bp_id}', array('uses'=>'ProcessController@update', 'as'=>'processes.update'));
    Route::delete('processes/{service_id}/delete/{bp_id}', array('uses'=>'ProcessController@destroy'));
    Route::get('processes/{service_id}/view/{bp_id}', array('uses'=>'ProcessController@show'));

    Route::get('process_output/{bp_id}/', array('uses'=>'ProcessOutputController@index'));
    Route::get('process_output/{bp_id}/create', array('uses'=>'ProcessOutputController@create'));
    Route::post('process_output/{bp_id}/create', array('uses'=>'ProcessOutputController@store'));
    Route::get('process_output/{bp_id}/edit/{bpo_id}', array('uses'=>'ProcessOutputController@edit'));
    Route::put('process_output/{bp_id}/edit/{bpo_id}', array('uses'=>'ProcessOutputController@update', 'as'=>'process_output.update'));
    Route::delete('process_output/{bp_id}/delete/{bpo_id}', array('uses'=>'ProcessOutputController@destroy'));
    Route::get('process_output/{bp_id}/view/{bpo_id}', array('uses'=>'ProcessOutputController@show'));

    Route::get('super/se_detail/{token}', array('uses'=>'SuperController@sedetail'));
    Route::get('super/process/{se_id}/{bp_id}', array('uses'=>'SuperController@process'));
    Route::post('super/process/{se_id}/{bp_id}/finish', array('uses'=>'SuperController@finish'));
    Route::post('super/process/{se_id}/{bp_id}/reject', array('uses'=>'SuperController@reject'));

    Route::get('settings/', array('uses'=>'SettingController@show'));
    Route::post('settings/', array('uses'=>'SettingController@update', 'as'=>'settings.update'));
    Route::get('settings/reset', array('uses'=>'SettingController@reset'));
    Route::get('profile', array('uses' => 'UserController@profile'));
    Route::put('profile', array('uses' => 'UserController@profileUpdate', 'as'=>'profile.update'));
    Route::get('chart', array('uses' => 'ChartController@index'));
    Route::post('ajax/getFilterDate', array('uses' => 'AjaxController@getFilterDate'));

    Route::get('fm', array('uses'=>'FileController@index'));
    Route::get('elfinder', 'Barryvdh\Elfinder\ElfinderController@showIndex');
    Route::any('elfinder/connector', 'Barryvdh\Elfinder\ElfinderController@showConnector');

    Route::resource('users', 'UserController');
    Route::resource('units', 'UnitController');
    Route::resource('positions', 'PositionController');
    Route::resource('services', 'ServiceController');
    Route::resource('roles', 'RoleController');
    Route::resource('reqReferences', 'RequirementReferenceController');


});
