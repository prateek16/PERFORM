<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');






	protected $fillable = array('username', 'email', 'password');

	public static $rules = array(
		'firstname' => 'required|alpha|min:2',
		'lastname' => 'required|alpha|min:2',
		'email' => 'required|email|unique:users',
		'password' => 'required|alpha_num|between:6,12|confirmed',
		'password_confirmation' => 'required|alpha_num|between:6,12'
		//'organization' => 'required|alpha|min:2'
	);

	public static $loginRules = [
		'email' => 'required|email',
		'password' => 'required|alpha_num|between:6,12'

	];

	public static $changePassword = [
		'email' => 'required|email',
		'new' => 'required|alpha_num|between:6,12',
		'new1' => 'required|alpha_num|between:6,12',
		'old' => 'required|alpha_num|between:6,12'

	];



	public function projects() {
		return $this->belongsToMany('Project', 'project_user', 'user_id', 'project_id');
	}

	public function programs() {
		return $this->belongsToMany('Program', 'program_user', 'user_id', 'program_id');
	}



}
