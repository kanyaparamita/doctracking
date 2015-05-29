<?php

class UnitController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$units = Unit::all();

		return View::make('units.index')
			->with('units', $units);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('units.create');
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
			'name' => 'required|unique:units,name'
		);

		$validator = Validator::make(Input::all(), $rules);

		//process
		if ($validator->fails()) {
			return Redirect::to('units/create')
				->withErrors($validator)
				->withInput();
		} else {
			// store unit
			$unit = new Unit();
			$unit->name 	 	= Input::get('name');
			$unit->description	= Input::get('description');
			$unit->save();


			// redirect
			Session::flash('message', 'Successfully created unit');
			return Redirect::to('units');
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
		$unit = Unit::find($id);
		if(is_null($unit)) {
			$units = Unit::all();
			Session::flash('message', 'Unit with id ' . $id . ' not found!');
			return View::make('units.index')
				->with('units', $units);
		} else {
			return View::make('units.show')
				->with('unit', $unit);
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
		$unit = Unit::find($id);
		return View::make('units.edit')
			->with('unit', $unit);
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
			'name' => 'required|unique:units,name,' . $id
		);

		$validator = Validator::make(Input::all(), $rules);

		//process
		if ($validator->fails()) {
			return Redirect::to('units/edit')
				->withErrors($validator)
				->withInput();
		} else {
			// store unit
			$unit = Unit::find($id);
			$unit->name 	 	= Input::get('name');
			$unit->description	= Input::get('description');
			$unit->save();


			// redirect
			Session::flash('message', 'Successfully updated unit');
			return Redirect::to('units');
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
		$unit = Unit::find($id)->delete();
		Session::flash('message', 'Successfully deleted unit');
		return Redirect::to('units');
	}


}
