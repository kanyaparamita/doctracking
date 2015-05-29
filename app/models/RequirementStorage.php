<?php

class RequirementStorage extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'requirement_storages';


    public function requirement() {
        return $this->hasOne('ServiceRequirement', 'requirement_id', 'requirement_id');
    }
}
