<?php

class OfficerController extends BaseController
{


    protected $layout;// = "layouts.login";
    private $_layout = null;
    protected $programListener = null;
    protected $newProjectListener = null;


    public function __construct(ProgramLevel $programLevel, NewProject $project)
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth', array('only' => array('index')));

        $this->programListener = $programLevel;
        $this->newProjectListener = $project;


    }


    private function _setupLayout()
    {
        if (!is_null($this->_layout)) {
            $this->layout = View::make($this->_layout);
        }
    }

    public function index()
    {
        $this->_layout = 'layouts.homeTemplate';
        $this->_setUpLayout();
        $this->layout->content = View::make('officer.home',array('user' => Auth::user()));

    }

     public function projectLevel($id){
        $this->_layout = 'layouts.masterTemplate';
        $this->_setUpLayout();
        $this->layout->content = View::make('officer.projectLevel',array('user' => Auth::user(), 'id'=>$id));
    }

     public function dues(){
        $this->_layout = 'layouts.masterTemplate';
        $this->_setUpLayout();
        $this->layout->content = View::make('officer.dues',array('user' => Auth::user()));
    }

     public function returns($id){
        $this->_layout = 'layouts.masterTemplate';
        $this->_setUpLayout();
        $this->layout->content = View::make('officer.returns',array('user' => Auth::user(), 'id'=>$id));
    }

    public function submitDue(){
    $retid = Input::get('retid');
    $value = Input::get('value');
   

    $returns = Returns::where('id', '=', $retid)->first();
    $target = Target::where('return_id', '=', $retid)->first();

    $target->value = $value;

    $target->save();
    }


}