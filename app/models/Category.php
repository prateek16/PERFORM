<?php

class Category extends \Eloquent {
	protected $fillable = array('id', 'name');


	protected $table = 'categories';

	public function kpi() {
		return $this->belongsTo('KPI');
	}

	public function projects() {

		return $this->belongsToMany('Project' , 'category_project', 'category_id', 'project_id');
	}
}