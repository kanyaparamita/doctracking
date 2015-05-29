<?php

class BaseProcessStateOutput extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'base_process_state_output';
    // public $timestamps = false;

    public function businessProcess() {
        return $this->belongsTo('BusinessProcessState', 'bps_id');
    }

    public function baseProcessOutput() {
        return $this->hasOne('BaseProcessOutput', 'id', 'bpo_id');
    }
}
