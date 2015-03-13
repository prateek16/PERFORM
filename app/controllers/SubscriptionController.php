<?php

class SubscriptionController extends BaseController implements RegisterInterface, LoginInterface
{


    protected $layout;// = "layouts.login";
    private $_layout = null;
    protected $registration;
    protected $login;






    public function __construct(RegisterUser $registration, LoginUser $login)
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth', array('only' => array()));

        $this->registration = $registration;
        $this->login = $login;
    }



    private function _setupLayout()
    {
        if (!is_null($this->_layout)) {
            $this->layout = View::make($this->_layout);
        }
    }

    public function index()
    {
        $this->_layout = 'layouts.loginTemplate';
        $this->_setUpLayout();
        $this->layout->content = View::make('pages.register');

    }

    public function register(){

        $validator = Validator::make(Input::all(), User::$rules);

        if($validator->passes())
            return $this->registration->create( $this, Input::all());

        return Redirect::Back()->withInput()->withErrors($validator);
    }

    public function RegisterSuccessful($email,$password){

        return $this->login->login($this,$email,$password);
    }

    public function RegisterFailed(){
        return Redirect::Back()->withInput()->with('message', "Please Try Again...");
    }

    public function loginSuccessful(){

        if(Auth::check())
        {
            $user = Auth::user();
            switch($user->role){
                Case 'manager': return Redirect::to('admin');
                    break;

                Case 'officer': return Redirect::to('officer');
                    break;

                default       :  break;
            }
        }


    }

    public function loginFailed(){
        return Redirect::Back()->withInput()->with('message', "Invalid email/password");
    }






}