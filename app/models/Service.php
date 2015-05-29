<?php

class Service extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'services';
    public $timestamps = false;

    public function organization() {
        return $this->belongsTo('Organization', 'organization_id');
    }

}
