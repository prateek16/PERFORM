<?php

class Manager extends \Eloquent {
	protected $fillable = array();


	protected $table = 'managers';


	public function officers() {
		return $this->belongsToMany('Officer', 'manager_officer', 'manager_id', 'officer_id');
	}

	public function projects() {
		return $this->belongsToMany('Project', 'manager_project', 'manager_id', 'project_id');
	}

}