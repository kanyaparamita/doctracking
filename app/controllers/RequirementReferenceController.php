<?php

class RequirementReferenceController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$req = Requirement::all();

		return View::make('requirements.references.index')
			->with('requirements', $req);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('requirements.references.create');
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
			'value' => 'required|unique:requirements,value'
		);

		$validator = Validator::make(Input::all(), $rules);

		//process
		if ($validator->fails()) {
			return Redirect::to('reqReferences/create')
				->withErrors($validator)
				->withInput();
		} else {
			// store unit
			$requirement = new Requirement();
			$requirement->value 	 	= Input::get('value');
			$requirement->save();


			// redirect
			Session::flash('message', 'Successfully created requirement');
			return Redirect::to('reqReferences');
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
		$req = Requirement::find($id);
		if(is_null($req)) {
			Session::flash('message', 'Unit with id ' . $id . ' not found!');
			return Redirect::to('reqReferences');
		} else {
			return View::make('requirements.references.show')
				->with('requirement', $req);
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
		$req = Requirement::find($id);
		return View::make('requirements.references.edit')
			->with('requirement', $req);
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
			'value' => 'required|unique:requirements,value,'.$id
		);

		$validator = Validator::make(Input::all(), $rules);

		//process
		if ($validator->fails()) {
			return Redirect::to('reqReferences/create')
				->withErrors($validator)
				->withInput();
		} else {
			// store unit
			$requirement = Requirement::find($id);
			$requirement->value 	 	= Input::get('value');
			$requirement->save();


			// redirect
			Session::flash('message', 'Successfully updated requirement');
			return Redirect::to('reqReferences');
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
		$req = Requirement::find($id)->delete();
		Session::flash('message', 'Successfully deleted requirement');
		return Redirect::to('reqReferences');
	}


}
