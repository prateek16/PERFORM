<?php
/**
 * Created by PhpStorm.
 * User: prateek
 * Date: 03/02/2015
 * Time: 16:13
 */

class NewProgramController extends BaseController{


    protected $layout;
    private $_layout = null;
    protected $newProgram;
    protected $register;

    public function __construct(NewProgram $program, RegisterUser $registration)
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth', array('only' => array()));
        $this->newProgram = $program;
        $this->register = $registration;
    }


    private function _setupLayout()
    {
        if (!is_null($this->_layout)) {
            $this->layout = View::make($this->_layout);
        }
    }

    public function createProgram(){

        if (Request::ajax()) {
            return $this->newProgram->create($this, Input::get('prname'), Input::get('prdesc'));
        }else{
            return Response::make('Unauthorized', 401);
        }

    }

    public function success($pid){
        return $pid;
    }

    public function failed(){
        return Redirect::Back()->with('message', 'Sorry, Please try again');
    }

    public function addProgramMembers(){

        if (Request::ajax()) {
            return $this->register->addMembers($this,Input::all());
        }else{
            return Response::make('Unauthorized', 401);
        }

    }



}