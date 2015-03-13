<?php
/**
 * Created by PhpStorm.
 * User: prateek
 * Date: 05/02/2015
 * Time: 09:34
 */

class SubmitNewProjectController extends BaseController{

    protected $layout;// = "layouts.login";
    private $_layout = null;

    protected $submitListener = null;
    protected $newProjectListener = null;

    public function __construct(NewProject $project, SubmitNewProject $newSubmit)
    {
        $this->beforeFilter('csrf-ajax', array('only' => array('step1','step2','step3','step4','step5','step6','step7','step8','step9','step10','step11','step12')));
        $this->beforeFilter('auth', array('only' => array('step1','step2','step3','step4','step5','step6','step7','step8','step9','step10','step11','step12')));

        $this->submitListener = $newSubmit;
        $this->newProjectListener = $project;


    }

    private function _setupLayout()
    {
        if (!is_null($this->_layout)) {
            $this->layout = View::make($this->_layout);
        }
    }



    public function step1(){

        if (Request::ajax())
        {
            return $this->submitListener->step1($this,Input::all());
        }else
        {
            return Response::make('Unauthorized', 401);
        }

    }

    public function success_step1($id){
        return $id;
    }

    public function step2(){

        if (Request::ajax())
        {
              return $this->submitListener->step2($this,Input::all());
        }else
        {
            return Response::make('Unauthorized', 401);
        }

    }

    public function success_step2(){
        return "OK";
    }

    public function success_step3($role){
        return $role;
    }


    public function step3(){

        if (Request::ajax())
        {

            return $this->submitListener->step3($this,Input::all());
        }else
        {
            return Response::make('Unauthorized', 401);
        }

    }

    public function step3_1(){

        if (Request::ajax())
        {

            return $this->submitListener->step3_1($this,Input::all());
        }else
        {
            return Response::make('Unauthorized', 401);
        }

    }

    public function step4_q_m(){

        if (Request::ajax())
        {
            return $this->submitListener->step4_q_m($this,Input::all());
        }else
        {
            return Response::make('Unauthorized', 401);
        }

    }

    public function step5(){

        if (Request::ajax())
        {

            return $this->submitListener->step5($this,Input::all());
        }else
        {
            return Response::make('Unauthorized', 401);
        }

    }

    public function step5_OK(){
        return "ok";
    }

    public function step6(){
        if (Request::ajax())
        {
            return $this->submitListener->step6($this,Input::all());
        }else
        {
            return Response::make('Unauthorized', 401);
        }
    }

    public function step9(){
        if (Request::ajax())
        {
            return $this->submitListener->step9($this,Input::all());
        }else
        {
            return Response::make('Unauthorized', 401);
        }
    }

    public function step10(){
        if (Request::ajax())
        {
            return $this->submitListener->step10($this,Input::all());
        }else
        {
            return Response::make('Unauthorized', 401);
        }
    }

    public function step11(){
        if (Request::ajax())
        {
            return $this->submitListener->step11($this,Input::all());
        }else
        {
            return Response::make('Unauthorized', 401);
        }
    }



    public function failed(){
        return "Failed";
    }










}