<?php

class BaseProcessState extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'base_process_state';
    public $timestamps = false;

    public function serviceExecution() {
        return $this->belongsTo('ServiceExecution', 'se_id');
    }

    public function baseProcess() {
        return $this->belongsTo('BaseProcess', 'bp_id');
    }

    public function service() {
        return $this->belongsTo('Service', 'service_id');
    }

    public function startedBy() {
        return $this->belongsTo('User', 'started_by');
    }

    public function finishedBy() {
        return $this->belongsTo('User', 'finished_by');
    }
}
