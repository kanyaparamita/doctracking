<?php

class Customer extends Eloquent {

    protected $connection = 'mysql2';
    protected $table = 'customers';
    public $timestamps = false;

    public function organization() {
        return $this->belongsTo('Organization', 'organization_id');
    }
}
