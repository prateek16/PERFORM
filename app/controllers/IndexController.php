<?php

class IndexController extends BaseController
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

    public function getIndex()
    {
        $this->_layout = 'layouts.loginTemplate';
        $this->_setUpLayout();
        $this->layout->content = View::make('pages.login');

    }





    public function getHome(){
        $this->_layout = 'layouts.homeTemplate';
        $this->_setUpLayout();
        $this->layout->content = View::make('pages.home');
    }

    public function postLogin(){

        $rules = array(
            'email'    => 'required|email', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:6' // password can only be alphanumeric and has to be greater than 3 characters
        );


        $validator = Validator::make(Input::all(), $rules);

        if($validator->passes()) {

            if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password'))))
            {
                if(!Session::get('user')) {
                    $data = Auth::user();
                    Session::put('user', $data->firstname);
                    Session::put('user_access', $data->access);
                    Session::put('user_id', $data->id);
                    Session::put('email', $data->email);
                    Session::put('role', $data->role);
                }

                return Redirect::to('/home');
            }
            return Redirect::Back()->withInput()->with('message', 'Invalid Username/Password');
        }






    }

}