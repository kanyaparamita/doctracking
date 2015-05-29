<?php
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';
    public $timestamps = false;

    public static $rules = array(
      'name' => 'required|between:4,255'
    );

    public function organization() {
        return $this->belongsTo('Organization', 'organization_id');
    }

    public function users() {
        return $this->hasMany('User');
    }
}
