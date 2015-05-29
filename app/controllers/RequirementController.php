<?php

class RequirementController extends \BaseController {


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($service_id)
    {
        $requirements = Requirement::orderBy('value')->lists('value', 'id');
        $typeOutput = TypeOutput::lists('name', 'id');
        $typeInput = TypeInput::lists('name', 'id');
        $mandatory = array(0 => 'Tidak', 1 => 'Ya');
        return View::make('requirements.create')
                    ->with('service_id', $service_id)
                    ->with('typeOutput', $typeOutput)
                    ->with('typeInput', $typeInput)
                    ->with('requirements', $requirements)
                    ->with('mandatory', $mandatory);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($service_id)
    {

        $rules = array (
            // 'name' => 'required|unique:service_requirements,name'
        );

        $validator = Validator::make(Input::all(), $rules);

        //process
        if ($validator->fails()) {
            return Redirect::to('requirements/'.$service_id.'/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store Requirements
            $req = new ServiceRequirement();
            $req->requirement_id    = Input::get('requirement_id');
            $req->type_input        = Input::get('type_input');
            $req->type_output       = Input::get('type_output');
            $req->description       = Input::get('description');
            $req->service_id        = $service_id;
            $req->is_required       = Input::get('is_required');
            $req->save();


            // redirect
            Session::flash('message', 'Successfully created requirement');
            return Redirect::to('services/'.$service_id);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($service_id, $req_id)
    {
        $requirements = Requirement::orderBy('value')->lists('value', 'id');
        $typeOutput = TypeOutput::lists('name', 'id');
        $typeInput = TypeInput::lists('name', 'id');
        $req = ServiceRequirement::find($req_id);
        $mandatory = array(0 => 'Tidak', 1 => 'Ya');
        return View::make('requirements.edit')
            ->with('service_id', $service_id)
            ->with('requirement', $req)
            ->with('typeOutput', $typeOutput)
            ->with('typeInput', $typeInput)
            ->with('mandatory', $mandatory)
            ->with('requirements', $requirements);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($service_id, $req_id)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array (
            // 'name' => 'required|unique:service_requirements,name,'.$req_id,
        );

        $validator = Validator::make(Input::all(), $rules);

        //process
        if ($validator->fails()) {
            return Redirect::to('requirements/'. $service_id.'/edit/'. $req_id)
                ->withErrors($validator)
                ->withInput();
        } else {
            // store service
            $req = ServiceRequirement::find($req_id);
            $req->requirement_id    = Input::get('requirement_id');
            $req->type_input        = Input::get('type_input');
            $req->type_output       = Input::get('type_output');
            $req->description       = Input::get('description');
            $req->is_required       = Input::get('is_required');
            $req->save();


            // redirect
            Session::flash('message', 'Successfully updated requirement');
            return Redirect::to('services/'.$service_id);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($service_id, $req_id)
    {
        $req = ServiceRequirement::find($req_id)->delete();
        Session::flash('message', 'Successfully deleted requirement');
        return Redirect::to('services/'.$service_id);
    }


}
