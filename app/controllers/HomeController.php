<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}

	public function test() {
		$organizations = User::find(1);
		return View::make('tests.index')
				->with('organizations', $organizations);
	}

	public function showDashboard()
	{
        $service_execution = Executor::populateExecutionList(Auth::user()->role()->role_id);
        return View::make('dashboard')->with('service_execution', $service_execution);
	}

    public function showDashboardAdmin() {
        $service_execution = ServiceExecution::select('service_execution.id as se_id', 'service_execution.service_id as service_id', 'services.name as service_name', 'service_execution.token', 'service_execution.created_at as date', 'customers.*', 'services.estimated_days as estimated_days', 'service_execution.status as status')
                                        ->leftJoin('services', 'services.id', '=', 'service_execution.service_id')
                                        ->leftJoin('riset_operational.customers', 'customers.id', '=', 'service_execution.customer_id')
                                        ->orderBy('service_execution.status', 'asc')
                                        ->orderBy('service_execution.created_at', 'asc')
                                        ->get();
        return View::make('admin_dashboard')->with('service_execution', $service_execution);
    }

    public function showDashboardSuperUser() {
        $service_execution = ServiceExecution::select('service_execution.id as se_id', 'service_execution.service_id as service_id', 'services.name as service_name', 'service_execution.token', 'service_execution.created_at as date', 'customers.*', 'services.estimated_days as estimated_days', 'service_execution.status as status')
                                        ->leftJoin('services', 'services.id', '=', 'service_execution.service_id')
                                        ->leftJoin('riset_operational.customers', 'customers.id', '=', 'service_execution.customer_id')
                                        ->orderBy('service_execution.status', 'asc')
                                        ->orderBy('service_execution.created_at', 'asc')
                                        ->get();
        return View::make('su_dashboard')->with('service_execution', $service_execution);
    }

	public function showProcessTask($se_id, $bp_id) {
		$service = ServiceExecution::find($se_id);
		$requirements = ServiceRequirement::select('service_requirements.*', 'requirements.value as name', 'rs.data', 'rs.id as rs_id')
							->where('service_requirements.service_id', '=', $service->service_id)
                            ->leftJoin('requirements', 'service_requirements.requirement_id', '=', 'requirements.id')
							->leftJoin(DB::raw('(select * from requirement_storages where se_id = \''. $se_id.'\') as rs'),  'rs.requirement_id', '=', 'service_requirements.id')
							->get();
		$bp = BaseProcess::where('id', '=', $bp_id)->first();

		$bps = BaseProcessState::where('se_id', '=', $se_id)
							->where('bp_id', '=', $bp_id)
							->first();

		$bp_output = BaseProcessOutput::where('bp_id', '=', $bp_id)->get();
		$bps_output = BaseProcessStateOutput::where('se_id', '=', $se_id)->get();

        // periksa next bp id, apakah ada pilihan atau tidak
        $next_list = Executor::parseNextBaseProcess($bp->next_bp_id);

		return View::make('process_task')
					->with('service', $service)
					->with('requirements', $requirements)
					->with('bp_output', $bp_output)
					->with('bps', $bps)
					->with('bpso', $bps_output)
					->with('bp', $bp)
                    ->with('next_list', $next_list);
	}

	public function startProcessTask($se_id, $bp_id) {
		$result = Executor::updateStartedByBaseProcessState($se_id, $bp_id, Auth::user()->id);
        if ($result['continue'] == true)
		    return Redirect::to('process_task/'.$se_id.'/'.$bp_id.'/process');
        else
            return Redirect::to('dashboard')->with('preq', $result['message']);
	}

	public function finishProcessTask($se_id, $bp_id) {
		$service = ServiceExecution::find($se_id);
		$bps = BaseProcessState::where('se_id', '=', $se_id)
								->where('bp_id', '=', $bp_id)
								->first();

		$bpo = BaseProcessOutput::where('bp_id', '=', $bp_id)->count();

        if (Request::isMethod('post'))
        {
            $xor = new XorStatus();
            $xor->se_id = $se_id;
            $xor->value = Input::get('xor');
            $xor->status = 0;
            $xor->save();

            // parsing value xor untuk insert bps
            $has_and = Executor::stringContains($xor->value, '&');
            $has_or = Executor::stringContains($xor->value, '/');

            if ($has_and == true && $has_or == false) {
                $nextbp = Executor::splitString($xor->value, '&');
            } elseif ($has_and == false && $has_or == true) {
                $nextbp = Executor::splitString($xor->value, '/');
            } elseif ($has_and == false && $has_or == false) {
                $nextbp[0] = $xor->value;
            }

            $base_process_state = BaseProcessState::where('bp_id', '=', $bp_id)
                                                ->where('se_id', '=', $se_id)
                                                ->where('status', '=', 1)
                                                ->first();

            if (!is_null($base_process_state)) {
                $base_process_state->finished_by = Auth::user()->id;
                $base_process_state->finished_time = Executor::getCurrentDateTime();
                $base_process_state->status = 2;
                $base_process_state->save();

                if ($service->status != 2) {
                    if (Executor::isHaveNextBaseProcess($bp_id) == 1) {
                         //insert semua nextbp
                        foreach ($nextbp as $key => $value) {
                            if ($value != '') { // handling saat ada tanda ; yang menyebabkan bp_id kosong
                                if (!Executor::checkBaseProcessStateExist($se_id, $value)) {
                                    $base_process_state = new BaseProcessState();
                                    $base_process_state->bp_id = $value;
                                    $base_process_state->se_id = $se_id;
                                    $base_process_state->service_id = $service->service_id;
                                    $base_process_state->save();
                                }
                            }
                        }
                    }
                    else {
                        Executor::setServiceExecutionStatus($se_id, 1);
                    }
                }
            }

            return Redirect::to('dashboard')
                            ->with('message', $service->token . ' finished');
        } elseif (Request::isMethod('get')) {
            if ($bpo == 0) {
                Executor::updateFinishedByBaseProcessState($se_id, $bp_id, Auth::user()->id);
                return Redirect::to('dashboard')
                        ->with('message', $service->token . ' finished');
            } else {
                $bpso = BaseProcessStateOutput::where('bps_id', '=', $bps->id)->count();
                if ($bpso == $bpo) {
                    Executor::updateFinishedByBaseProcessState($se_id, $bp_id, Auth::user()->id);
                    return Redirect::to('dashboard')
                            ->with('message', $service->token . ' finished');
                } else {
                    return Redirect::to('process_task/'.$se_id.'/'.$bp_id.'/process')
                        ->with('message', 'Masih ada output yang belum di hasilkan');
                }
            }

        }
	}

	public function storeProcessTask($se_id, $bp_id) {
        $se = ServiceExecution::find($se_id);
		$token = Executor::getServiceExecutionToken($se_id);
		$bpo = BaseProcessOutput::where('bp_id', '=', $bp_id)->get();
        foreach ($bpo as $key => $value) {
            switch ($value->type_input) {
                case 3:
                    # code...
                    break;

                case 2:
                    $data = Input::get('input-'.$value->id);
                    $type = 3;
                    break;

                case 1:
                    // if (Input::hasFile('input-'.$value->id)) {
                        $op = new Dummy();
                        $op->setTable($se->service->tabel);
                        $op = $op::where($se->service->tabel.'.token', '=', $token)
                                ->leftJoin('riset_operational.customers', 'riset_operational.customers.id', '=', 'customer_id')
                                ->first();

                        $file = Input::file('input-'.$value->id);
                        if ($file != null) {
                            $destinationPath = 'files/'.$se->service_id.'/'.$token.'-'.Executor::removeSpecialCharacter($op->nama).'/';
                            $extension = $file->getClientOriginalExtension(); //if you need extension of the file
                            if ($extension == 'pdf') {
                                $type = 1;
                            } else if ($extension == 'jpeg' || $extension == 'png') {
                                $type = 2;
                            }
                            $filename = $token.'-BPSO-'.Executor::removeSpecialCharacter($value->name).'.'.$extension;
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
            	$bps = BaseProcessState::where('se_id', '=', $se_id)
							->where('bp_id', '=', $bp_id)
							->first();

                $bpso = new BaseProcessStateOutput();
                $bpso->bps_id = $bps->id;
                $bpso->se_id = $se_id;
                $bpso->bpo_id = $value->id;
                $bpso->data = $data;
                $bpso->save();

                // save ke database operasional
                $dummy = new Dummy();
                $dummy->setTable($se->service->tabel);
                $dummy = $dummy::where($se->service->tabel.'.token', '=', $token)->first();
                $dummy[$value->field] = $data;
                $dummy->save();

            }
        }

        return Redirect::to('process_task/'.$se_id.'/'.$bp_id.'/process');
	}

	public function rejectProcessTask($se_id, $bp_id) {
		$description = Input::get('description');
		Executor::updateServiceExecutionStatus($se_id, 2, $description);
		Executor::updateFinishedByBaseProcessState($se_id, $bp_id, Auth::user()->id);
		return Redirect::to('dashboard')
					->with('message', 'Rejection complete');
	}


	public function openRequirementStorage($rs_id) {
		$data = RequirementStorage::select('requirement_storages.*',  'requirements.value as name', 'service_requirements.*')
									->where('requirement_storages.id', '=', $rs_id)
                                    ->leftJoin('requirements', 'requirements.id', '=', 'requirement_storages.requirement_id')
									->leftJoin('service_requirements', 'requirement_storages.requirement_id', '=', 'service_requirements.id')
									->first();
        $token = Executor::getServiceExecutionToken($data->se_id);
        $se = ServiceExecution::find($data->se_id);
        $op = new Dummy();
        $op->setTable($se->service->tabel);
        $op = $op::where($se->service->tabel.'.token', '=', $token)
                ->leftJoin('riset_operational.customers', 'riset_operational.customers.id', '=', 'customer_id')
                ->first();

        $file = asset('files/'.$data->service_id.'/'.$token.'-'.Executor::removeSpecialCharacter($op->nama).'/'.$data->data);
        $typeOutput = $data->requirement->typeOutput->value;

    	if ($typeOutput == 'application/pdf') {
            $content = file_get_contents($file);

    		return Response::make($content, 200, array(
                'Content-Type'              => 'application/pdf',
                'Content-Transfer-Encoding' => 'binary',
                // 'Content-Disposition'       => 'inline',
                'Expires'                   => 0,
                'Cache-Control'             => 'must-revalidate, post-check=0, pre-check=0',
                'Pragma'                    => 'public',
                'Content-Length'            => strlen($content)
            ));
    	} elseif ($typeOutput == 'image/jpeg') {
    		// $result = '<img src="'. $file .'">';
            $content = file_get_contents($file);
            return Response::make($content, 200, array(
                'Content-Type'              => 'image/jpeg',
                'Content-Transfer-Encoding' => 'binary',
                // 'Content-Disposition'       => 'inline',
                'Expires'                   => 0,
                'Cache-Control'             => 'must-revalidate, post-check=0, pre-check=0',
                'Pragma'                    => 'public',
                'Content-Length'            => strlen($content)
            ));
    	} elseif ($typeOutput == 'application/zip') {
            $content = file_get_contents($file);
            return Response::make($content, 200, array(
                'Content-Type'              => 'application/zip',
                'Content-Transfer-Encoding' => 'binary',
                // 'Content-Disposition'       => 'inline',
                'Expires'                   => 0,
                'Cache-Control'             => 'must-revalidate, post-check=0, pre-check=0',
                'Pragma'                    => 'public',
                'Content-Length'            => strlen($content)
            ));
        } else {
    		$result = $data->value;
    	}

		return View::make('layouts.blob')
				->with('result', $result);
	}

    public function openBPSO($bpso_id) {
        $data = BaseProcessStateOutput::where('base_process_state_output.id', '=', $bpso_id)
                                    ->first();

        $se = ServiceExecution::find($data->se_id);
        $op = new Dummy();
        $op->setTable($se->service->tabel);
        $op = $op::where($se->service->tabel.'.token', '=', $token)
                ->leftJoin('riset_operational.customers', 'riset_operational.customers.id', '=', 'customer_id')
                ->first();

        $token = Executor::getServiceExecutionToken($data->se_id);
        $file = asset('files/'.$op->service_id.'/'.$token.'-'.Executor::removeSpecialCharacter($op->nama).'/'.$data->data);
        $typeOutput = $data->BaseProcessOutput->typeOutput->value;

        if ($typeOutput == 'application/pdf') {
            $content = file_get_contents($file);

            return Response::make($content, 200, array(
                'Content-Type'              => 'application/pdf',
                'Content-Transfer-Encoding' => 'binary',
                // 'Content-Disposition'       => 'inline',
                'Expires'                   => 0,
                'Cache-Control'             => 'must-revalidate, post-check=0, pre-check=0',
                'Pragma'                    => 'public',
                'Content-Length'            => strlen($content)
            ));
        } elseif ($typeOutput == 'image/jpeg') {
            // $result = '<img src="'. $file .'">';
            $content = file_get_contents($file);
            return Response::make($content, 200, array(
                'Content-Type'              => 'image/jpeg',
                'Content-Transfer-Encoding' => 'binary',
                // 'Content-Disposition'       => 'inline',
                'Expires'                   => 0,
                'Cache-Control'             => 'must-revalidate, post-check=0, pre-check=0',
                'Pragma'                    => 'public',
                'Content-Length'            => strlen($content)
            ));
        } elseif ($typeOutput == 'application/zip') {
            $content = file_get_contents($file);
            return Response::make($content, 200, array(
                'Content-Type'              => 'application/zip',
                'Content-Transfer-Encoding' => 'binary',
                // 'Content-Disposition'       => 'inline',
                'Expires'                   => 0,
                'Cache-Control'             => 'must-revalidate, post-check=0, pre-check=0',
                'Pragma'                    => 'public',
                'Content-Length'            => strlen($content)
            ));
        } else {
            $result = $data->value;
        }

        return View::make('layouts.blob')
                ->with('result', $result);
    }
}
