<?php

class Theme extends \Eloquent {
	protected $fillable = array('id', 'name');


	protected $table = 'themes';

	public function kpi() {
		return $this->belongsTo('KPI');
	}

	public function projects() {

		return $this->belongsToMany('Project' , 'project_theme', 'theme_id', 'project_id');
	}
}