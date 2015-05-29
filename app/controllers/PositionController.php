<?php

class PositionController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$positions = Position::all();

		return View::make('positions.index')
			->with('positions', $positions);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('positions.create');
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
			'name' => 'required|unique:positions,name'
		);

		$validator = Validator::make(Input::all(), $rules);

		//process
		if ($validator->fails()) {
			return Redirect::to('positions/create')
				->withErrors($validator)
				->withInput();
		} else {
			// store unit
			$position = new Position();
			$position->name 	 	= Input::get('name');
			$position->description	= Input::get('description');
			$position->save();


			// redirect
			Session::flash('message', 'Successfully created position');
			return Redirect::to('positions');
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
		$position = Position::find($id);
		if(is_null($position)) {
			$positions = Unit::all();
			Session::flash('message', 'Position with id ' . $id . ' not found!');
			return View::make('positions.index')
				->with('positions', $positions);
		} else {
			return View::make('positions.show')
				->with('position', $position);
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
		$position= Position::find($id);
		return View::make('positions.edit')
			->with('position', $position);
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
			'name' => 'required|unique:positions,name,'. $id
		);

		$validator = Validator::make(Input::all(), $rules);

		//process
		if ($validator->fails()) {
			return Redirect::to('positions/edit')
				->withErrors($validator)
				->withInput();
		} else {
			// store unit
			$position = Position::find($id);
			$position->name 	 	= Input::get('name');
			$position->description	= Input::get('description');
			$position->save();


			// redirect
			Session::flash('message', 'Successfully created position');
			return Redirect::to('positions');
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
		$position = Position::find($id)->delete();
		Session::flash('message', 'Successfully deleted position');
		return Redirect::to('positions');
	}


}
