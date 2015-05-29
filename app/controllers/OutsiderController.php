<?php

class OutsiderController extends \BaseController {

    // Index untuk apply perizinan
    public function index() {
        $services = Service::where('is_active', '=', 1)->lists('name', 'id');

        return View::make('outsiders.index')
                    ->with('services', $services);
    }

    public function showRequirement($id) {
        if (Session::has('customer_name') == 0) {
            return Redirect::to('login');
        }
        $service = Service::find($id);
        $requirements = ServiceRequirement::select('service_requirements.*', 'requirements.value as name')
                                            ->where('service_requirements.service_id', '=', $id)
                                            ->leftJoin('requirements', 'service_requirements.requirement_id', '=', 'requirements.id')
                                            ->get();
        return View::make('outsiders.requirement')
                    ->with('services', $service)
                    ->with('requirements', $requirements);
    }

    public function startService($id) {
        $token = Executor::initServiceExecution($id);
        $se = ServiceExecution::where('token', '=', $token)->first();
        $requirements = ServiceRequirement::select('service_requirements.*', 'requirements.value as name')
                                            ->where('service_requirements.service_id', '=', $id)
                                            ->leftJoin('requirements', 'service_requirements.requirement_id', '=', 'requirements.id')
                                            ->get();
        foreach ($requirements as $key => $value) {
            switch ($value->typeInput->value) {
                case "text":
                    # code...
                    break;

                case "input":
                    $data = Input::get('input-'.$value->id);
                    $type = 3;
                    break;

                case "file":
                    // if (Input::hasFile('input-'.$value->id)) {
                        $file = Input::file('input-'.$value->id);
                        if ($file != null) {
                            $destinationPath = 'files/'. $id.'/'.$token.'-'. Executor::removeSpecialCharacter(Session::get('customer_name')).'/';
                            $extension = $file->getClientOriginalExtension(); //if you need extension of the file
                            if ($extension == 'pdf') {
                                $type = 1;
                            } else if ($extension == 'jpeg' || $extension == 'png') {
                                $type = 2;
                            } else {
                                $type = 4; // unknown type
                            }
                            $filename = $token.'-Requirement-'.Executor::removeSpecialCharacter($value->name).'.'.$extension;
                            $uploadSuccess = Input::file('input-'.$value->id)->move($destinationPath, $filename);
                            if( $uploadSuccess ) {
                               $data = $filename;
                            }
                        } else {
                            $data = null;
                        }
                    // }
                    break;
            }

            if ($data != null) {
                $requirement_storage = new RequirementStorage();
                $requirement_storage->requirement_id = $value->id;
                $requirement_storage->se_id = $se->id;
                $requirement_storage->data = $data;
                $requirement_storage->save();
            }

        }

        // update tabel opeasional service
        $service = Service::find($id);
        $dummy = new Dummy();
        $dummy->setTable($service->tabel);
        $dummy->token = $token;
        $dummy->service_id = $id;
        $dummy->customer_id = Session::get('customer_id');
        $dummy->status = 0;
        $dummy->save();

        return Redirect::to('outsider/details/'.$token);
    }


    public function detail($token = null)
    {
        if ($token == null) {
            $token = Input::get('token');
        }
        $service_execution = ServiceExecution::where('token', '=', $token)->first();
        if ($service_execution != null) {
            $service = Service::find($service_execution->service_id);
            $base_process = BaseProcess::select('base_process.id as bp_id', 'base_process.display_text as name', 'units.name as unit')
                                            ->where('base_process.service_id', '=', $service_execution->service_id)
                                            ->where('base_process.is_display', '=', 1)
                                            ->leftJoin('units', 'base_process.unit_id', '=', 'units.id')
                                            ->orderBy('bp_id', 'ASC')
                                            ->get();

            return View::make('outsiders.detail')
                    ->with('service', $service)
                    ->with('service_execution', $service_execution)
                    ->with('base_process', $base_process);
        }
        else {
            return View::make('error');
        }
    }
}
