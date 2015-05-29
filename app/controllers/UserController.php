<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::orderBy('position_id', 'asc')->get();

		return View::make('users.index')
			->with('users', $users);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$roles = Role::orderBy('name', 'asc')->lists('name', 'id');
		$units = Unit::lists('name', 'id');
		$positions = Position::lists('name','id');
		return View::make('users.create')
			->with('roles', $roles)
			->with('units', $units)
			->with('positions', $positions);
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
			'name' => 'required',
			'email' 	=> 'required|email|unique:users,email,',
			'username' 	=> 'required|unique:users,username,',
			'password'	=> 'required',
			'phone' 	=> 'numeric',
		);

		$validator = Validator::make(Input::all(), $rules);

		//process
		if ($validator->fails()) {
			return Redirect::to('users/create')
				->withErrors($validator)
				->withInput();
		} else {
			// store user
			$user = new User();
			$user->name 	= Input::get('name');
			$user->email 		= Input::get('email');
			$user->phone		= Input::get('phone');
			$user->unit_id		= Input::get('unit_id');
			$user->position_id	= Input::get('position_id');
			$user->organization_id = Auth::user()->organization_id;
			if (Input::has('username')) {
				$user->username 	= Input::get('username');
			}
			if (Input::has('password')) {
				$user->password = Hash::make(Input::get('password'));
			}
			$user->save();

			$role = Role::find(Input::get('role_id'));
			$user->attachRole($role);
			// redirect
			Session::flash('message', 'Successfully created user');
			return Redirect::to('users');
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
		$user = User::find($id);
		if(is_null($user)) {
			$users = User::all();
			Session::flash('message', 'User with id ' . $id . ' not found!');
			return View::make('users.index')
				->with('users', $users);
		} else {
			return View::make('users.show')
				->with('user', $user);
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
		$user = User::find($id);
		$roles = Role::orderBy('name', 'asc')->lists('name', 'id');
		$units = Unit::lists('name', 'id');
		$positions = Position::lists('name','id');
		return View::make('users.edit')
			->with('user', $user)
			->with('roles', $roles)
			->with('units', $units)
			->with('positions', $positions);
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
			'name' => 'required',
			'email' 	=> 'required|email|unique:users,email,'. $id,
			'username' 	=> 'required|unique:users,username,'. $id,
			'phone' 	=> 'numeric',
		);

		$validator = Validator::make(Input::all(), $rules);

		//process
		if ($validator->fails()) {
			return Redirect::to('users/' . $id . '/edit')
				->withErrors($validator)
				->withInput();
		} else {
			// store user
			$user = User::find($id);
			$user->name 	= Input::get('name');
			$user->email 		= Input::get('email');
			$user->phone		= Input::get('phone');
			$user->unit_id		= Input::get('unit_id');
			$user->position_id	= Input::get('position_id');

			if (Input::has('username')) {
				$user->username 	= Input::get('username');
			}
			if (Input::has('password')) {
				$user->password = Hash::make(Input::get('password'));
			}
			$user->save();

			$assigned_role = AssignedRole::where('user_id','=',$user->id)->first();
			$assigned_role->role_id = Input::get('role_id');
			$assigned_role->save();

			// redirect
			Session::flash('message', 'Successfully updated user');
			return Redirect::to('users');
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
		$user = User::find($id)->delete();
		Session::flash('message', 'Successfully deleted user');
		return Redirect::to('users');
	}

	public function showLogin() {
		return View::make('authentications.login');
	}

	public function doLogin() {
		$rules = array(
				'username' => 'required',
				'password' => 'required|min:1'
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('login')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			$user_data = array (
					'username' => Input::get('username'),
					'password' => Input::get('password')
				);
			if (Auth::attempt($user_data)) {
				if (Auth::user()->can('dashboard_superuser')) {
					return Redirect::to('dashboardSuperUser');
				} elseif (Auth::user()->can('dashboard_admin')){
		            return Redirect::to('dashboardAdmin');
		        } else {
		            return Redirect::to('dashboard');
		        }
			} else {
				return Redirect::to('login')
						->with('message', 'Invalid username/password');
			}
		}
	}

	public function doLogout() {
		Auth::logout();
		return Redirect::to('login');
	}

	public function profile() {
		return View::make('profile')->with('user', Auth::user());
	}

	public function profileUpdate() {
		$user = Auth::user();
		// validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array (
			'name' => 'required',
			'email' 	=> 'required|email|unique:users,email,'. $user->id,
			'username' 	=> 'required|unique:users,username,'. $user->id,
			'phone' 	=> 'numeric',
		);

		$validator = Validator::make(Input::all(), $rules);

		//process
		if ($validator->fails()) {
			return Redirect::to('profile')
				->withErrors($validator)
				->withInput();
		} else {
			// store user

			$user->name 	= Input::get('name');
			$user->email 		= Input::get('email');
			$user->phone		= Input::get('phone');

			if (Input::has('username')) {
				$user->username 	= Input::get('username');
			}
			if (Input::has('password')) {
				$user->password = Hash::make(Input::get('password'));
			}
			$user->save();

			// redirect
			Session::flash('message', 'Successfully updated profile');
			return Redirect::to('profile');
		}
	}
}
