<?php

class BaseProcessOutput extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'base_process_output';
    public $timestamps = false;

    public function service() {
        return $this->belongsTo('BaseProcess', 'bp_id');
    }

    public function typeOutput() {
        return $this->hasOne('TypeOutput', 'id', 'type_output');
    }

    public function typeInput() {
        return $this->hasOne('TypeInput', 'id', 'type_input');
    }

}
