<?php

class BaseController extends Controller {

	protected $managerArray = ['A','B','C','D'];
	protected $officerArray = ['G','H','I'];

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
