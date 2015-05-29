<?php

class ProcessOutputController extends \BaseController {

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
	public function create($bp_id)
	{
		$typeOutput = TypeOutput::lists('name', 'id');
        $typeInput = TypeInput::lists('name', 'id');
        $mandatory = array(0 => 'No', 1 => 'Yes');
        return View::make('process_output.create')
        			->with('bp_id', $bp_id)
        			->with('typeOutput', $typeOutput)
                    ->with('typeInput', $typeInput)
                    ->with('mandatory', $mandatory);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($bp_id)
	{
		$rules = array(
			'name' => 'required'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('process_output/'.$bp_id.'/create')
							->withError($validator)
							->withInput();
		} else {
			// store bpo
			$bpo = new BaseProcessOutput();
			$bpo->bp_id = $bp_id;
			$bpo->name = Input::get('name');
			$bpo->type_input = Input::get('type_input');
			$bpo->type_output = Input::get('type_output');
			$bpo->is_required = Input::get('is_required');
			$bpo->field = Input::get('field');
			$bpo->save();

			$service_id = Executor::getServiceBaseProcess($bp_id);

			//redirect
			Session::flash('message', 'Successfully created base process output');
            return Redirect::to('processes/'.$service_id.'/view/'.$bp_id);
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
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($bp_id, $bpo_id)
	{
		$bpo = BaseProcessOutput::find($bpo_id);
		$typeOutput = TypeOutput::lists('name', 'id');
        $typeInput = TypeInput::lists('name', 'id');
        $mandatory = array(0 => 'No', 1 => 'Yes');
        return View::make('process_output.edit')
        			->with('bp_id', $bp_id)
        			->with('typeOutput', $typeOutput)
                    ->with('typeInput', $typeInput)
                    ->with('mandatory', $mandatory)
        			->with('bpo', $bpo);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($bp_id, $bpo_id)
	{
		$rules = array(
			'name' => 'required'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('process_output/'.$bp_id.'/edit/'.$bpo_id)
							->withError($validator)
							->withInput();
		} else {
			// store bpo
			$bpo = BaseProcessOutput::find($bpo_id);
			$bpo->name = Input::get('name');
			$bpo->type_input = Input::get('type_input');
			$bpo->type_output = Input::get('type_output');
			$bpo->is_required = Input::get('is_required');
			$bpo->field = Input::get('field');
			$bpo->save();

			$service_id = Executor::getServiceBaseProcess($bp_id);

			//redirect
			Session::flash('message', 'Successfully updated base process output');
            return Redirect::to('processes/'.$service_id.'/view/'.$bp_id);
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($bp_id, $bpo_id)
	{
		$service_id = Executor::getServiceBaseProcess($bp_id);
		$bpo = BaseProcessOutput::find($bpo_id)->delete();
        Session::flash('message', 'Successfully deleted base process output');
        return Redirect::to('processes/'.$service_id.'/view/'.$bp_id);
	}


}
