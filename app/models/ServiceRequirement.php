<?php

class ServiceRequirement extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'service_requirements';
    public $timestamps = false;

    public function service() {
        return $this->belongsTo('Service', 'service_id');
    }

    public function typeOutput() {
        return $this->hasOne('TypeOutput', 'id', 'type_output');
    }

    public function typeInput() {
        return $this->hasOne('TypeInput', 'id', 'type_input');
    }

    public function requirementReference() {
        return $this->hasOne('Requirement', 'id', 'requirement_id');
    }

}
