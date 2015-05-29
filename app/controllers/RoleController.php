<?php

class RoleController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$roles = Role::all();

		return View::make('roles.index')
			->with('roles', $roles);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$permissions = Permission::orderBy('display_name', 'asc')->get();
		return View::make('roles.create')
			->with('permissions', $permissions);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array (
			'name' => 'required'
		);

		$validator = Validator::make(Input::all(), $rules);

		//process
		if ($validator->fails()) {
			return Redirect::to('roles/create')
				->withErrors($validator)
				->withInput();
		} else {
			// store unit
			$role = new Role();
			$role->name 	 	= Input::get('name');
			$role->save();

			$permissions = Input::get('permissions');
			if (!is_null($permissions)) {
				//Delete all permission role
				PermissionRole::where('role_id', '=', $role->id)->delete();
				foreach ($permissions as $key => $value) {
					$permission_role = new PermissionRole();
					$permission_role->permission_id = $value;
					$permission_role->role_id = $role->id;
					$permission_role->save();
				}
			}
			// redirect
			Session::flash('message', 'Successfully created role');
			return Redirect::to('roles');
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$role = Role::find($id);
		$permissions = Permission::orderBy('display_name', 'asc')->get();
		$permission_roles = PermissionRole::where('role_id', '=', $id)
								->lists('permission_id');
		if(is_null($role)) {
			Session::flash('message', 'Role with id ' . $id . ' not found!');
			return Redirect::to('roles');
		} else {
			return View::make('roles.show')
				->with('permissions', $permissions)
				->with('permission_roles', $permission_roles)
				->with('role', $role);
		}
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$role = Role::find($id);
		$permissions = Permission::orderBy('display_name', 'asc')->get();
		$permission_roles = PermissionRole::where('role_id', '=', $id)
								->lists('permission_id');
		return View::make('roles.edit')
			->with('permissions', $permissions)
			->with('permission_roles', $permission_roles)
			->with('role', $role);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array (
			'name' => 'required'
		);

		$validator = Validator::make(Input::all(), $rules);

		//process
		if ($validator->fails()) {
			return Redirect::to('roles/create')
				->withErrors($validator)
				->withInput();
		} else {
			// store unit
			$role = Role::find($id);
			$role->name 	 	= Input::get('name');
			$role->save();

			$permissions = Input::get('permissions');
			if (!is_null($permissions)) {
				//Delete all permission role
				PermissionRole::where('role_id', '=', $id)->delete();
				foreach ($permissions as $key => $value) {
					$permission_role = new PermissionRole();
					$permission_role->permission_id = $value;
					$permission_role->role_id = $id;
					$permission_role->save();
				}
			} else {
				//Delete all permission role
				PermissionRole::where('role_id', '=', $id)->delete();
			}

			// redirect
			Session::flash('message', 'Successfully updated role');
			return Redirect::to('roles');
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$role = Role::find($id)->delete();
		Session::flash('message', 'Successfully deleted role');
		return Redirect::to('roles');
	}


}
