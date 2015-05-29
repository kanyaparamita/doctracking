<?php

class Organization extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'organizations';


    /**
     * Defines a one-to-many relationship.
     *
     * @see http://laravel.com/docs/eloquent#one-to-many
     */
    public function positions()
    {
        return $this->hasMany('Position', 'organization');
    }

    public function roles()
    {
        return $this->hasMany('Role', 'organization');
    }

    public function units()
    {
        return $this->hasMany('Unit', 'organization');
    }

    public function users()
    {
        return $this->hasMany('User', 'organization');
    }

    public function setting() {
        return $this->hasOne('Setting', 'organization_id', 'id');
    }
}
