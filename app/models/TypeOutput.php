<?php

class TypeOutput extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'type_output';
    public $timestamps = false;

    public function organization() {
        return $this->belongsTo('Organization', 'organization_id');
    }

}
