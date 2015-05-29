<?php

class ServiceExecution extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'service_execution';


    public function service() {
        return $this->hasOne('Service', 'id', 'service_id');
    }
}
