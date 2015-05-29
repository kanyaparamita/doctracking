<?php

class Executor {

    /*
        Membuat token untuk setiap execution / permohonan yang digunakan untuk tracking == produceRequestId
        @param
        - length : panjang karakter yang akan dihasilkan

        @result (String)
        - token : random string
    */
    public static function generateToken($length = 8) {
        // get all token
        $all_token = Executor::getAllToken();
        $found = true;
        while($found) {
            // generate token baru 0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ
            $token = substr(str_shuffle("0123456789"), 0, $length);

            // make sure token is unique
            $found = Executor::checkInArray($token, $all_token);
        }

        return $token;
    }


    /*
        Melakukan pemeriksaan apakah sebuah nilai berada dalam array
        @result (boolean)
    */
    public static function checkInArray($needle, $haystack) {
        return in_array($needle, $haystack);
    }

    /*
        Mengambil semua data token yang telah digunakan
        @result (array of String)
    */
    public static function getAllToken() {
        $token = ServiceExecution::select('token')->get();

        return $token->toArray();
    }

    public static function getServiceExecutionToken($se_id) {
        $se = ServiceExecution::find($se_id);

        return $se->token;
    }

    /*
        Cek apakah token tertentu sudah ada di tabel service_execution
        @param
        - token : keyword pembeda untuk setiap execution

        @result (boolean)
    */
    public static function isServiceExecutionExist($token) {
        $service_execution = ServiceExecution::find($token, array('token'));

        return ($service_execution == null) ? false : true;
    }

    /*
        Membuat 1 row baru untuk service execution
        Membuat 1 row baru untuk base proses pertama untuk service tersebut

        @param
        - service_id
        - description : untuk deskripsi tambahan pada sebuah eksekusi service
    */
    public static function initServiceExecution($service_id, $description = "") {
        // generate token
        $token = Executor::generateToken();

        // simpan ke tabel service_execution
        $service_execution = new ServiceExecution();
        $service_execution->service_id = $service_id;
        $service_execution->token = $token;
        $service_execution->status = 0;
        $service_execution->description = $description;
        $service_execution->customer_id = Session::get('customer_id');
        $service_execution->save();


        // tambahkan base proces is_start untuk dari service ke tabel base_process_state
        $base_process = BaseProcess::where('is_start', '=', 1)
                                    ->where('service_id', '=', $service_id)->first();
        $base_process_state = new BaseProcessState();
        $base_process_state->bp_id = $base_process->id;
        $base_process_state->se_id = $service_execution->id;
        $base_process_state->service_id = $service_id;
        $base_process_state->status = 0;
        $base_process_state->save();

        return $token;
    }

    /*
        Mencari next base process
        @param
        - bp_id : base proses id

        @return (array of int)
        - next_bp : array dari id base proses selanjutnya
    */
    public static function getNextBaseProcess($bp_id) {
        $bp = BaseProcess::find($bp_id);
        if (!is_null($bp)) {
            // parsing next bp id from current bp
            if ($bp->is_xor_branch_next == 1) {
                $next_bp = Executor::splitString($bp->next_bp_id, '|');
            } else {
                $next_bp = Executor::splitString($bp->next_bp_id);
            }

            return $next_bp;
        } else {
            dd($bp);
        }
    }

    /*
        Mencari syarat dari base process
        @param
        - bp_id : base proses id

        @return (array of int)
        - preve_bp : array dari id base proses yang menjadi syarat
    */
    public static function getPrevBaseProcess($bp_id) {
        $bp = BaseProcess::find($bp_id);
        if (!is_null($bp)) {
            // parsing next bp id from current bp
            if ($bp->is_xor_branch_prev == 1) {
                $prev_bp = Executor::splitString($bp->pre_con_bp, '|');
            } else {
                $prev_bp = Executor::splitString($bp->pre_con_bp);
            }

            return $prev_bp;
        } else {
            dd($bp);
        }
    }

    /*
        Menambahkan data pada tabel base_process_state sesuai dengan next_bp id dari current bp
    */
    public static function insertNextBaseProcessState($se_id, $bp_id) {
        $service_execution = ServiceExecution::find($se_id);
        $next_bp_id = Executor::getNextBaseProcess($bp_id);
        foreach ($next_bp_id as $key => $value) {
            if ($value != '') { // handling saat ada tanda ; yang menyebabkan bp_id kosong
                if (!Executor::checkBaseProcessStateExist($se_id, $value)) {
                    $base_process_state = new BaseProcessState();
                    $base_process_state->bp_id = $value;
                    $base_process_state->se_id = $se_id;
                    $base_process_state->service_id = $service_execution->service_id;
                    $base_process_state->save();
                }
            }
        }
    }


    /*
        Mengupdated started_by & status pada base_process_state
        @param
        - bp_id : base proses id
        - se_id : service execution id
        - user_id : current user id

    */
    public static function updateStartedByBaseProcessState($se_id, $bp_id, $user_id) {
        $base_process_state = BaseProcessState::where('bp_id', '=', $bp_id)
                                                ->where('se_id', '=', $se_id)
                                                ->where('status', '=', 0)
                                                ->first();

        // cek pre requisit
        $bp = BaseProcess::find($bp_id);
        $preq = $bp->pre_con_bp;
        // split by ;
        $preq = Executor::splitString($preq);
        $has_and = Executor::stringContains($bp->pre_con_bp, '&');
        $has_or = Executor::stringContains($bp->pre_con_bp, '/');
        $continue = true;
        $message = "";
        if (count($preq) > 1) { // saat ada beberapa kombinasi kemungkinan preq
            // dd($preq);
            // cek tabel xor status yg se id sama, ambil data pertama
            $xor = XorStatus::where('se_id', '=', $se_id)
                                ->where('status', '=', 0)
                                ->first();

            // cek apakah xor value ada di preq
            if(Executor::checkInArray($xor->value, $preq) === true) {
                // jika ada maka parse xor untuk cek apakah requirement sudah terpenuhi
                $_has_and = Executor::stringContains($xor->value, '&');
                $_has_or = Executor::stringContains($xor->value, '/');

                if (($_has_and == true) && ($_has_or == false)) {
                    $preqbp = Executor::splitString($xor->value, '&');

                    foreach ($preqbp as $key => $value) {
                        $bps = BaseProcessState::where('bp_id', '=', $value)
                                                ->where('se_id', '=', $se_id)
                                                ->first();

                        if(!is_null($bps) && (($bps->status == 2) || ($bps->status == 3))) {
                            $continue = $continue & 1;
                        } else {
                            $continue = $continue & 0;
                            $message .= '- '. $bps->baseProcess->name . '</br>';
                        }
                    }
                } elseif (($_has_and == false) && ($_has_or == true)) {
                    $preqbp = Executor::splitString($xor->value, '/');
                    $continue = false;
                    foreach ($preqbp as $key => $value) {
                        $bps = BaseProcessState::where('bp_id', '=', $value)
                                                ->where('se_id', '=', $se_id)
                                                ->where('status', '=', 2, 'OR')
                                                ->where('status', '=', 3)
                                                ->where
                                                ->first();
                        if(!is_null($bps)) {
                            $continue = $continue | 1;
                        }
                    }
                } elseif ($_has_and == false && $_has_or == false) {
                    $preqbp = $xor->value;

                    $bps = BaseProcessState::where('bp_id', '=', $preqbp)
                                                ->where('se_id', '=', $se_id)
                                                ->where('status', '=', 2, 'OR')
                                                ->where('status', '=', 3)
                                                ->first();
                    if(is_null($bps))
                        $continue = false;
                } else {
                    dd($xor);
                }
            } else {
                $continue = false;
            }

            // update status xor
            if ($continue == true) {
                $xor->status = 1;
                $xor->save();
            }

        } elseif ((count($preq) == 1) && ($preq[0] != '') && ($has_and == false) && ($has_or == false)) {
            $bps = BaseProcessState::where('bp_id', '=', $preq[0])
                                                ->where('se_id', '=', $se_id)
                                                ->where('status', '=', 2, 'OR')
                                                ->where('status', '=', 3)
                                                ->first();
            if (is_null($bps))
                $continue = false;

        }



        if (!is_null($base_process_state) && $continue) {
            $base_process_state->started_by = $user_id;
            $base_process_state->started_time = Executor::getCurrentDateTime();
            $base_process_state->status = 1;
            $base_process_state->save();
        }

        $result['continue'] = $continue;
        $result['message'] = $message;
        return $result;
    }

    /*
        Mengupdated finished_by & status pada base_process_state.
        Melakukan penambahan data next base process state
        @param
        - bp_id : base proses id
        - se_id : service execution id
        - user_id : current user id

    */
    public static function updateFinishedByBaseProcessState($se_id, $bp_id, $user_id) {
        $base_process_state = BaseProcessState::where('bp_id', '=', $bp_id)
                                                ->where('se_id', '=', $se_id)
                                                ->where('status', '=', 1)
                                                ->first();

        if (!is_null($base_process_state)) {
            $base_process_state->finished_by = $user_id;
            $base_process_state->finished_time = Executor::getCurrentDateTime();
            $base_process_state->status = 2;
            $base_process_state->save();

            $se = ServiceExecution::find($se_id);
            if ($se->status != 2) {
                if (Executor::isHaveNextBaseProcess($bp_id) == 1) {
                    Executor::insertNextBaseProcessState($se_id, $bp_id);
                }
                else {
                    Executor::setServiceExecutionStatus($se_id, 1);
                }
            }
        }
    }


    public static function setServiceExecutionStatus($se_id, $status, $description = "") {
        $service_execution = ServiceExecution::find($se_id);

        if (!is_null($service_execution)) {
            $service_execution->status = $status;
            $service_execution->description = $description;
            $service_execution->save();

            // update operasional
            $dummy = new Dummy();
            $dummy->setTable($service_execution->service->tabel);
            $dummy = $dummy::where('token', '=', $service_execution->token)->first();
            $dummy['status'] = $status;
            $dummy['comment'] = $description;
            $dummy->save();
        }
    }

    public static function checkBaseProcessStateExist($se_id, $bp_id) {
        $base_process_state = BaseProcessState::where('bp_id', '=', $bp_id)
                                                ->where('se_id', '=', $se_id)
                                                ->first();

        return (!is_null($base_process_state)) ? true : false;
    }

    /*
        Memeriksa apakah bp memiliki next bp. Jika ada maka tambahkan data next bp ke base process state
    */
    public static function isHaveNextBaseProcess($bp_id) {
        $next_bp_id = Executor::getNextBaseProcess($bp_id);
        return ($next_bp_id[0] != '') ? 1 : 0;
    }

    /*
        Mengambil role yang bertanggung jawab pada base proses
    */
    public static function getBaseProcessRole($bp_id) {
        $bp = BaseProcess::find($bp_id);
        if (!is_null($bp)) {
            // parsing roles from current bp
            $roles = Executor::splitString($bp->roles);
            return $roles;
        } else {
            dd($bp);
        }
    }

    /*
        Memeriksa apakah base proses available untuk current user
        @param
        - role : user role
    */
    public static function isBaseProcessAvailable($bp_id, $role) {
        $roles = Executor::getBaseProcessRole($bp_id);

        return Executor::checkInArray($role, $roles);
    }

    /*
        Get all service id, service name, token from service execution
        Hanya yang berstatus 0
    */
    public static function getExecutionList() {
        $service_execution = ServiceExecution::select('service_execution.id as se_id', 'service_execution.service_id as service_id', 'services.name as service_name', 'service_execution.token', 'service_execution.created_at as date', 'riset_operational.customers.nama')
                                        ->leftJoin('services', 'services.id', '=', 'service_execution.service_id')
                                        ->leftJoin('riset_operational.customers', 'riset_operational.customers.id', '=', 'service_execution.customer_id')
                                        ->where('service_execution.status', '=', 0)
                                        ->get();

        return $service_execution;
    }

    /*
        Populate task for certain role
        Step
        1. Ambil semua execution list
        2. Looping
            - Cek apakah execution masih base process state yang status nya != 2 dan role nya cocok

    */
    public static function populateExecutionList($role) {
        $service_execution_list = Executor::getExecutionList();
        $populated_result = array();
        foreach ($service_execution_list as $key => $service_execution) {
            // cek apakah bps execution sesuai dengan role
            $se_bps = Executor::getServiceExecutionBaseProcessState($service_execution->se_id);

            foreach ($se_bps as $key => $base_process_state) {
                if (Executor::checkInArray($role, Executor::splitString($base_process_state->roles))) {
                    $data = $service_execution->toArray();
                    $data['bp_id'] = $base_process_state->bp_id;
                    $data['bp_name'] = $base_process_state->baseProcess()->first()->display_text;
                    $data['bp_status'] = $base_process_state->status;
                    $populated_result[] = $data;
                }
            }
        }
        return $populated_result;
    }

    /* Mengambil list base process state yang berstatus != 2 dan role base process*/
    public static function getServiceExecutionBaseProcessState($se_id) {
        $base_process_state = BaseProcessState::select('base_process_state.bp_id as bp_id', 'base_process_state.se_id as se_id', 'base_process_state.status as status', 'base_process.roles')
                                            ->leftJoin('base_process', 'base_process_state.bp_id', '=', 'base_process.id')
                                            ->where('base_process_state.se_id', '=', $se_id)
                                            ->where('base_process_state.status', '<>', 2)
                                            ->where('base_process_state.status', '<>', 3)
                                            ->get();

        return $base_process_state;
    }


    /*
        Dipakai untuk halaman tracking
    */
    public static function getBaseProcessStateStatus($se_id, $bp_id) {
        $base_process_state = BaseProcessState::where('base_process_state.se_id', '=', $se_id)
                                            ->where('base_process_state.bp_id', '=', $bp_id)
                                            ->first();

        return $base_process_state;
    }

    /*
        Mencari service requirement
        @param
        - service_id

        @result (array of service requirement)
    */
    public static function getServiceRequirement($service_id) {
        $service_requirement = ServiceRequirement::select('service_requirements.id as id', 'service_requirements.name as name', 'type_input.name as type')
                                                    ->leftJoin('type_input', 'service_requirements.type', '=', 'type_input.id')
                                                    ->where('service_requirements.service_id', '=', $service_id)
                                                    ->get();

        return $service_requirement->toArray();
    }

    /*
        Mengambil status status dari service execution
    */
    public static function getServiceExecutionStatus($token) {
        $service_execution = ServiceExecution::where('token', '=', $token)->first();

        return $service_execution->status;
    }

    /*
        Menghapus service execution
    */
    public static function deleteServiceExecution($se_id) {
        $service_execution = ServiceExecution::find($se_id);
        if (!is_null($service_execution)) {
            $service_execution->delete();
        }
    }

    /*
        Memeriksa apakah current user merupakan admin
    */
    // public static function isAdmin($user_id) {
    //     $user = User::where('id', '=', $user_id)->first();

    //     return ($user->role()->first()->id == 1) ? true : false ;
    // }

    /*
        Memeriksa apakah bpo telah di hasilkan atau belum
        false : tidak ada bpo yg di hasilkan
        true : ada bpo yg di hasilkan
    */
    public static function checkBaseProcessStateOutputExist($se_id, $bpo_id) {
        $bpso = BaseProcessStateOutput::where('se_id', '=', $se_id)->where('bpo_id', '=', $bpo_id)->first();
        return ($bpso == null) ? false : true;
    }

    public static function getServiceBaseProcess($bp_id) {
        $bp = BaseProcess::find($bp_id);

        return $bp->service_id;
    }

    public static function getServiceExecutionFromToken($token) {
        $se = ServiceExecution::where('token', '=', $token)->first();

        return $se->id;
    }

    public static function stringContains($string, $char) {
        if (strpos($string, $char) !== false)
            return true;
        else
            return false;
    }

    // Fungsi khusus untuk parsing next_bp_id dan roles
    public static function splitString($string, $delimiter = ';') {
        return preg_split('['.$delimiter.']', $string);
    }

    public static function removeSpecialCharacter($string) {
        return preg_replace('/[^a-zA-Z0-9.\']/', '_', $string);
    }

    // get current time
    public static function getCurrentDateTime() {
        return date("Y-m-d h:m:s");
    }

    public static function printRequired($is_required) {
        if ($is_required == 1)
            echo '<span class="required">*</span>';
    }

    public static function dateDiff($date1, $date2) {
        $dt1 = strtotime($date1);
        $dt2 = strtotime($date2);
        $diff = abs($dt2-$dt1);
        $diff = round($diff/86400); // 86400 detik sehari
        return $diff;
    }

    public static function parseNextBaseProcess($next_bp) {
         // periksa next bp id, apakah ada pilihan atau tidak
        $next = Executor::splitString($next_bp);
        $next_list = array();
        if (count($next) > 1) {
            foreach ($next as $key => $value) {
                $has_and = Executor::stringContains($value, '&');
                $has_or = Executor::stringContains($value, '/');
                if ($has_and == true) {
                    $x = Executor::splitString($value, '&');
                    $title = '';
                    $i = 0;
                    foreach ($x as $k => $v) {
                        $_bp = BaseProcess::find($v);
                        $title .= $_bp->name;
                        $i++;
                        if ($i < count($x))
                            $title .= ' & ';
                    }
                    $next_list[$value] = $title;
                } elseif ($has_or == true) {
                    $x = Executor::splitString($value, '/');
                    $title = '';
                    $i = 0;
                    foreach ($x as $k => $v) {
                        $_bp = BaseProcess::find($v);
                        $title .= $_bp->name;
                        $i++;
                        if ($i < count($x))
                            $title .= ' | ';
                    }
                    $next_list[$value] = $title;
                } elseif ($has_and == false && $has_or == false) {
                    $_bp = BaseProcess::find($value);
                    $next_list[$value] = $_bp->name;
                }
            }
        }
        return $next_list;
    }
}