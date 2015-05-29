<?php

class Unit extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'units';
    public $timestamps = false;

    public function organization() {
        return $this->belongsTo('Organization', 'organization_id');
    }

    public function users() {
        return $this->hasMany('User', 'unit_id');
    }
}
