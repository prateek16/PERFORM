<?php

class Target extends \Eloquent {
	protected $fillable = array('id', 'kpi_id', 'target', 'value', 'return_id');


	protected $table='targets';

	public function project() {
		return $this->belongsTo('Project');
	}

	public function kpi() {
		return $this->belongsTo('KPI');
	}

	public function returns() {
		return $this->belongsTo('Returns');
	}
}


