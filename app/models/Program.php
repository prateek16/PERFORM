<?php

class Program extends \Eloquent {
	protected $fillable = array('name', 'description');

	protected $table = 'programs';




	public function projects() {

		return $this->belongsToMany('Project' , 'program_project', 'program_id', 'project_id');
	}

	public function users() {

		return $this->belongsToMany('User' , 'program_user', 'program_id', 'user_id');
	}


}