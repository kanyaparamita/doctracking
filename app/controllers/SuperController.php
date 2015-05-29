<?php

class SuperController extends \BaseController {

    public function sedetail($token = null) {
        if ($token == null) {
            $token = Input::get('token');
        }
        $service_execution = ServiceExecution::where('token', '=', $token)->first();
        if ($service_execution != null) {
            $service = Service::find($service_execution->service_id);
            $base_process = BaseProcess::select('base_process.id as bp_id', 'base_process.display_text as name', 'units.name as unit')
                                            ->where('base_process.service_id', '=', $service_execution->service_id)
                                            // ->where('base_process.is_display', '=', 1)
                                            ->leftJoin('units', 'base_process.unit_id', '=', 'units.id')
                                            ->orderBy('bp_id', 'ASC')
                                            ->get();

            return View::make('super.sedetail')
                    ->with('service', $service)
                    ->with('service_execution', $service_execution)
                    ->with('base_process', $base_process);
        }
        else {
            return View::make('error');
        }
    }

    public function process($se_id, $bp_id) {
        $service = ServiceExecution::find($se_id);
        $bp = BaseProcess::where('id', '=', $bp_id)->first();
        $bps = BaseProcessState::where('se_id', '=', $se_id)
                            ->where('bp_id', '=', $bp_id)
                            ->first();
        $next_list = Executor::parseNextBaseProcess($bp->next_bp_id);
        return View::make('super.process')
                    ->with('service', $service)
                    ->with('bps', $bps)
                    ->with('bp', $bp)
                    ->with('next_list', $next_list);
    }

    public function finish($se_id, $bp_id) {
        $service = ServiceExecution::find($se_id);
        $base_process_state = BaseProcessState::where('bp_id', '=', $bp_id)
                                                ->where('se_id', '=', $se_id)
                                                ->first();

        // check pre requisit
        $result = Executor::updateStartedByBaseProcessState($se_id, $bp_id, Auth::user()->id);
        if ($result['continue'] == true) {
            if(!is_null(Input::get('xor'))) {
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



                if (!is_null($base_process_state)) {
                    $base_process_state->started_by = Auth::user()->id;
                    $base_process_state->started_time = Executor::getCurrentDateTime();
                    $base_process_state->finished_by = Auth::user()->id;
                    $base_process_state->finished_time = Executor::getCurrentDateTime();
                    $base_process_state->status = 3;
                    $base_process_state->comment = Input::get('comment');
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
                            Executor::setServiceExecutionStatus($se_id, 3, Input::get('comment'));
                        }
                    }
                }
            } else {
                if (!is_null($base_process_state)) {
                    $base_process_state->started_by = Auth::user()->id;
                    $base_process_state->started_time = Executor::getCurrentDateTime();
                    $base_process_state->finished_by = Auth::user()->id;
                    $base_process_state->finished_time = Executor::getCurrentDateTime();
                    $base_process_state->comment = Input::get('comment');
                    $base_process_state->status = 3;
                    $base_process_state->save();

                    if ($service->status != 2) {
                        if (Executor::isHaveNextBaseProcess($bp_id) == 1) {
                            Executor::insertNextBaseProcessState($se_id, $bp_id);
                        }
                        else {
                            Executor::setServiceExecutionStatus($se_id, 3, Input::get('comment'));
                        }
                    }
                }
            }

            return Redirect::to('super/se_detail/'.$service->token);
        } else {
            return Redirect::to('super/se_detail/'.$service->token)->with('preq', $result['message']);
        }

    }

    public function reject($se_id, $bp_id) {
        $description = Input::get('description');
        Executor::setServiceExecutionStatus($se_id, 2, $description);
        Executor::updateFinishedByBaseProcessState($se_id, $bp_id, Auth::user()->id);
        return Redirect::to('dashboardSuperUser')
                    ->with('message', 'Rejection complete');
    }
}