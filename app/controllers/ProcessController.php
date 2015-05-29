<?php

class ProcessController extends \BaseController {



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($service_id)
	{
		$units = Unit::lists('name', 'id');
		$roles = Role::all();
		$bp = BaseProcess::where('service_id', '=', $service_id)->get();
        $service = Service::where('id', '=', $service_id)->first();
        return View::make('processes.create')
        			->with('service_id', $service_id)
        			->with('units', $units)
        			->with('roles', $roles)
        			->with('bp', $bp)
                    ->with('service', $service);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($service_id)
	{
		$rules = array (
            'name' => 'required'

        );

        $validator = Validator::make(Input::all(), $rules);

        //process
        if ($validator->fails()) {
            return Redirect::to('processes/'.$service_id.'/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store Requirements
            $bp = new BaseProcess();
            $bp->name    		= Input::get('name');
            $bp->description    = Input::get('description');
            $bp->unit_id		= Input::get('unit_id');
            $bp->roles 			= Input::get('roles');
            $bp->next_bp_id		= Input::get('next_bp_id');
            $bp->pre_con_bp		= Input::get('pre_con_bp');
            $bp->is_start 		= Input::get('is_start');
            $bp->is_finish 		= Input::get('is_finish');
            $bp->is_display 	= Input::get('is_display');
            $bp->is_checkpoint	= Input::get('is_checkpoint');
            $bp->display_text   = Input::get('display_text');
            $bp->generate_form_perizinan = Input::get('form_izin');
            $bp->generate_form_pembayaran = Input::get('form_bayar');
            $bp->service_id = $service_id;
            $bp->save();


            // redirect
            Session::flash('message', 'Successfully created base process');
            return Redirect::to('services/'.$service_id);
        }
	}

	public function show($service_id, $bp_id) {
		$bp = BaseProcess::find($bp_id);
		$bpo = BaseProcessOutput::where('bp_id', '=', $bp_id)->get();
        $service = Service::where('id', '=', $service_id)->first();
		return View::make('processes.show')
					->with('bp', $bp)
					->with('bpo', $bpo)
					->with('service_id', $service_id)
                    ->with('service', $service);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($service_id, $bp_id)
	{
		$units = Unit::lists('name', 'id');
		$roles = Role::all();
		$bp = BaseProcess::where('service_id', '=', $service_id)->get();
		$cbp = BaseProcess::find($bp_id);
        $service = Service::where('id', '=', $service_id)->first();
        return View::make('processes.edit')
        			->with('service_id', $service_id)
        			->with('units', $units)
        			->with('roles', $roles)
        			->with('bp', $bp)
        			->with('cbp', $cbp)
                    ->with('service', $service);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($service_id, $bp_id)
	{
		$rules = array (
            'name' => 'required'

        );

        $validator = Validator::make(Input::all(), $rules);

        //process
        if ($validator->fails()) {
            return Redirect::to('processes/'.$service_id.'/edit/'.$bp_id)
                ->withErrors($validator)
                ->withInput();
        } else {
            // store Requirements
            $bp = BaseProcess::find($bp_id);
            $bp->name    		= Input::get('name');
            $bp->description    = Input::get('description');
            $bp->unit_id		= Input::get('unit_id');
            $bp->roles 			= Input::get('roles');
            $bp->next_bp_id		= Input::get('next_bp_id');
            $bp->pre_con_bp		= Input::get('pre_con_bp');
            $bp->is_start 		= Input::get('is_start');
            $bp->is_finish 		= Input::get('is_finish');
            $bp->is_display 	= Input::get('is_display');
            $bp->is_checkpoint	= Input::get('is_checkpoint');
            $bp->display_text   = Input::get('display_text');
            $bp->generate_form_perizinan = Input::get('form_izin');
            $bp->generate_form_pembayaran = Input::get('form_bayar');
            $bp->service_id = $service_id;
            $bp->save();


            // redirect
            Session::flash('message', 'Successfully updated base process');
            return Redirect::to('services/'.$service_id);
        }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($service_id, $bp_id)
    {
        $bp = BaseProcess::find($bp_id)->delete();
        Session::flash('message', 'Successfully deleted base process');
        return Redirect::to('services/'.$service_id);
    }


}
