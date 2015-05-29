<?php

class BaseProcess extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'base_process';
    public $timestamps = false;

    public function service() {
        return $this->belongsTo('Service', 'service_id');
    }

    public function unit() {
        return $this->belongsTo('Unit', 'unit_id');
    }

    public function role() {
        return $this->belongsTo('Role', 'roles');
    }

}
