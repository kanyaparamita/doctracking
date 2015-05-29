<?php

class Requirement extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'requirements';
    public $timestamps = false;

    public function typeOutput() {
        return $this->hasOne('TypeOutput', 'id', 'type_output');
    }

    public function typeInput() {
        return $this->hasOne('TypeInput', 'id', 'type_input');
    }
}
