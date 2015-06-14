<?php

class OutsiderController extends \BaseController {

    // Index untuk apply perizinan
    public function index() {
        $services = Service::where('is_active', '=', 1)->lists('name', 'id');

        return View::make('outsiders.index')
                    ->with('services', $services);
    }

    public function showRequirement($id, $token) {
        if (Session::has('customer_name') == 0) {
            return Redirect::to('login');
        }
        $service = Service::find($id);
        $requirements = ServiceRequirement::select('service_requirements.*', 'requirements.value as name')
                                            ->where('service_requirements.service_id', '=', $id)
                                            ->leftJoin('requirements', 'service_requirements.requirement_id', '=', 'requirements.id')
                                            ->get();

        // Prequisites                           
        $additionalReq = ServicePrequisite::where('parent_token', '=', $token)->get(); 
        $preq = array();                       
        $i = 0;    
        foreach ($additionalReq as $require) {
            array_push($preq ,ServiceRequirement::select('service_requirements.*', 'requirements.value as name')
                                            ->where('service_requirements.service_id', '=', $require->prequisite_token)
                                            ->leftJoin('requirements', 'service_requirements.requirement_id', '=', 'requirements.id')
                                            ->get());
            $i++;
        }

        //Session::flash('message', $preq[0]);

        return View::make('outsiders.requirement')
                    ->with('services', $service)
                    ->with('requirements', $requirements)
                    ->with('additionalReq', $preq)
                    ->with('token', $token);
    }

    public function showPrequisite($id) {
        if (Session::has('customer_name') == 0) {
            return Redirect::to('login');
        }
        $service = Service::find($id);
        $prequisites = Prequisite::where('parent_id', '=', $id)->get();
        return View::make('outsiders.prequisite')
                    ->with('services', $service)
                    ->with('prequisites', $prequisites);
    }

    public function savePrequisite($id, $prequisite_number) {
        $prequisites = Prequisite::where('parent_id', '=', $id)->get();
        $tempToken = rand(1000, 10000000);

        for ($i= 1; $i <= $prequisite_number; $i++) { 
            if(Input::get('status'.$i)){
                $servicePre = new ServicePrequisite;
                $servicePre->parent_token = $tempToken;
                $servicePre->prequisite_token = $prequisites[$i-1]->prequisite_id;
                $servicePre->save();
            }
        }

        return Redirect::to('outsider/'.$id.'/requirements/'.$tempToken);
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

        return $token;
    }

    public function startAllService($id, $token){
        $baseToken = OutsiderController::startService($id);

        $prequisites = Prequisite::where('parent_id', '=', $id)->get();
        foreach ($prequisites as $prequisite) {
            $preToken = OutsiderController::startService($prequisite->prequisite_id);

            $servicePre = ServicePrequisite::where('parent_token', '=', $token)
                                            ->where('prequisite_token', '=', $prequisite->prequisite_id)
                                            ->first();
            $servicePre->parent_token = $baseToken;
            $servicePre->prequisite_token = $preToken;
            $servicePre->save();   
        }

        return Redirect::to('outsider/details/'.$baseToken);
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
            $prequisiteToken = ServicePrequisite::where('parent_token', '=', $token)->get();                               
            return View::make('outsiders.detail')
                    ->with('service', $service)
                    ->with('service_execution', $service_execution)
                    ->with('base_process', $base_process)
                    ->with('preqToken', $prequisiteToken);
        }
        else {
            return View::make('error');
        }
    }
}
