<?php

class TypeInput extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'type_input';
    public $timestamps = false;

    public function organization() {
        return $this->belongsTo('Organization', 'organization_id');
    }

}
