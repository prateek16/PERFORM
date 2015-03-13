<?php

class Returns extends \Eloquent {
	protected $fillable = [];




	protected $table='returns';

	public function project() {
		return $this->belongsTo('Project');
	}


	public function comments() {
		return $this->hasMany('Comment','returns_id');
	}

	public function targets() {
		return $this->hasMany('Target', 'return_id');
	}

}