<?php

class ServiceController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$services = Service::all();

		return View::make('services.index')
			->with('services', $services);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('services.create');
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
			'name' => 'required|unique:services,name',
			'estimated_days' => 'required|numeric|min:1'
		);

		$validator = Validator::make(Input::all(), $rules);

		//process
		if ($validator->fails()) {
			return Redirect::to('services/create')
				->withErrors($validator)
				->withInput();
		} else {
			// store service
			$service = new Service();
			$service->name 	 	= Input::get('name');
			$service->estimated_days	= Input::get('estimated_days');
			$service->organization_id = Auth::user()->organization_id;
			$service->is_active = 1;
			$service->database = Input::get('database');
			$service->tabel = Input::get('tabel');
			$service->save();


			// redirect
			Session::flash('message', 'Successfully created service');
			return Redirect::to('services/'.$service->id);
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
		$service = Service::find($id);
		$bp = BaseProcess::where('service_id', '=', $id)->get();
		$requirements = ServiceRequirement::where('service_id', '=', $id)->get();
		if(is_null($service)) {
			$services = Service::all();
			Session::flash('message', 'Service with id ' . $id . ' not found!');
			return View::make('services.index')
				->with('services', $services);
		} else {
			return View::make('services.show')
				->with('service', $service)
				->with('bp', $bp)
				->with('requirements', $requirements);
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
		$service = Service::find($id);
		return View::make('services.edit')
			->with('service', $service);
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
			'name' => 'required|unique:services,name,'.$id,
			'estimated_days' => 'required|numeric|min:1'
		);

		$validator = Validator::make(Input::all(), $rules);

		//process
		if ($validator->fails()) {
			return Redirect::to('services/edit')
				->withErrors($validator)
				->withInput();
		} else {
			// store service
			$service = Service::find($id);
			$service->name 	 	= Input::get('name');
			$service->estimated_days	= Input::get('estimated_days');
			$service->is_active = Input::get('is_active');
			$service->database = Input::get('database');
			$service->tabel = Input::get('tabel');
			$service->save();


			// redirect
			Session::flash('message', 'Successfully updated service');
			return Redirect::to('services');
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
		$service = Service::find($id)->delete();
		Session::flash('message', 'Successfully deleted service');
		return Redirect::to('services');
	}


}
