<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Entrust\HasRole;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
    use HasRole;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
    public $timestamps = false;

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function organization() {
        return $this->belongsTo('Organization', 'organization_id');
    }

    public function position() {
    	return $this->belongsTo('Position', 'position_id');
    }

    public function unit() {
    	return $this->belongsTo('Unit', 'unit_id');
    }

    public function role() {
    	$role = AssignedRole::select('assigned_roles.*', 'roles.name')
                ->leftJoin('roles', 'roles.id', '=', 'assigned_roles.role_id')
                ->where('user_id', '=', $this->id)
                ->first();
        return $role;
    }
}
