<?php

class Project extends \Eloquent {


	protected $fillable = array('name', 'description');

	protected $table = 'projects';

	public function categories() {
		return $this->belongsToMany('Category', 'category_project', 'project_id', 'category_id');
	}

	public function targets() {
		return $this->hasMany('Target', 'Project_id');
	}

	public function returns() {
		return $this->hasMany('Returns','Project_id');
	}

	public function issues() {
		return $this->hasMany('Issues', 'issue_project', 'project_id', 'issue_id' );
	}


	public function users() {

		return $this->belongsToMany('User' , 'project_user', 'project_id', 'user_id');
	}



	public function kpis() {

		return $this->belongsToMany('KPI' , 'kpi_project', 'project_id', 'kpi_id');
	}

	public function themes() {

		return $this->belongsToMany('Theme' , 'project_theme', 'project_id', 'theme_id');
	}

	public function officers() {

		return $this->belongsToMany('Officer' , 'officer_project', 'project_id', 'officer_id');
	}

	public function managers() {

		return $this->belongsToMany('Manager' , 'manager_project', 'project_id', 'manager_id');
	}

	public function programs() {

		return $this->belongsToMany('Program' , 'program_project', 'project_id', 'program_id');
	}




}