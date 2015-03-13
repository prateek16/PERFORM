<?php

class Officer extends \Eloquent {
	protected $fillable = array();


	protected $table = 'officers';

	public function managers() {
		return $this->belongsToMany('Manager', 'manager_officer', 'manager_id', 'officer_id');
	}

	public function projects() {
		return $this->belongsToMany('Project', 'officer_project', 'officer_id', 'project_id');
	}
}