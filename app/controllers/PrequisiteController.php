<?php

class PrequisiteController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($service_id)
	{
		$service = Service::orderBy('name')->lists('name', 'id');
		return View::make('prequisites.create')
                    ->with('service_id', $service_id)
                    ->with('service', $service);		
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($service_id)
	{	
		$prequisite = new Prequisite();
		$prequisite->parent_id = $service_id;
		$prequisite->prequisite_id = Input::get('service_id');
		$prequisite->save();

		// redirect
        Session::flash('message', 'Successfully created prequisite');
        return Redirect::to('services/'.$service_id);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($service_id, $preq_id)
	{
		$service = Service::orderBy('name')->lists('name', 'id');
		return View::make('prequisites.edit')
					->with('service', $service)
					->with('service_id', $service_id)
					->with('prequisite_id', $preq_id);	
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($service_id, $preq_id)
	{
		$prequisite = Prequisite::find($preq_id);
		$prequisite->prequisite_id = Input::get('service_id');
		$prequisite->save();

		// redirect
        Session::flash('message', 'Successfully update prequisite');
        return Redirect::to('services/'.$service_id);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($service_id, $preq_id)
	{
		$service = Prequisite::find($preq_id)->delete();
		Session::flash('message', 'Successfully deleted prequisite');
		return Redirect::to('services/'.$service_id);
	}


}
