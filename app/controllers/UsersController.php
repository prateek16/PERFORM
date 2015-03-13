<?php

class UsersController extends BaseController
{


    protected $layout;// = "layouts.login";
    private $_layout = null;

    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth', array('only' => array('getHome', 'getNewprog', 'getLogout', ' getPrepdashboard', 'addproject')));


    }


    private function _setupLayout()
    {
        if (!is_null($this->_layout)) {
            $this->layout = View::make($this->_layout);
        }
    }


    public function getNewUser(){
        return "ok";
    }



}