<?php

class Issues extends \Eloquent {
	protected $fillable = [];

	protected $table = 'issues';

	public function project() {
		
		return $this->belongsTo('Project', 'issue_project', 'issue_id', 'project_id' );
	}
}