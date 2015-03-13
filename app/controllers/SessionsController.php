<?php



class SessionsController extends BaseController implements LoginInterface
{


    protected $layout;
    private $_layout = null;
    protected $login;

    public function __construct(LoginUser $login)
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth', array('only' => array('destroy')));
        $this->login = $login;
    }


    private function _setupLayout()
    {
        if (!is_null($this->_layout)) {
            $this->layout = View::make($this->_layout);
        }
    }


    public function login(){
        $validator = Validator::make(Input::all(), User::$loginRules);

        if($validator->passes())
            return $this->login->login($this, Input::get('email'), Input::get('password'));

        return Redirect::Back()->withInput()->withErrors($validator);


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



    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(){

        Auth::logout();
        Session::flush();

        return Redirect::to('/')->with('message', 'Logged out successfully.');
    }


}