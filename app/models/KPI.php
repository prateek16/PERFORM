<?php

class KPI extends \Eloquent {
	protected $fillable = [];


	protected $table='kpis';




	public function target() {
		return $this->hasMany('Target', 'kpi_id');
	}


	public function categories() {
		return $this->hasMany('Category');
	}

	public function themes() {
		return $this->hasMany('Theme');
	}

	public function projects() {

		return $this->belongsToMany('Project' , 'kpi_project', 'kpi_id', 'project_id');
	}
}
