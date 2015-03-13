<?php

class AdminController extends BaseController
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
        $this->layout->content = View::make('admin.home',array('user' => Auth::user()));


    }

     public function ene()
    {


        $this->_layout = 'layouts.homeTemplate';
        $this->_setUpLayout();
        $this->layout->content = View::make('admin.ene',array('user' => Auth::user()));


    }

    public function fundingLevel()
    {
         $this->_layout = 'layouts.masterTemplate';
         $this->_setUpLayout();
         $this->layout->content = View::make('admin.fundingLevel',array('user' => Auth::user()));
    }

    public function logo1(){
         
          $rules = array(
                'image' => 'required'
          );

         //$file = Input::file('file');
         $file = array('image' => Input::file('image'));

        $validator = Validator::make($file, $rules);

        if($validator->fails()){
            return Redirect::Back()->with('message', 'Not Authorized!');
        }else{

        if (Input::file('image')->isValid()) {
                 $email = Input::get('id');       
                 $dest = public_path().'/Managers/'.$email.'/';
                 $filename = Input::file('file')->getClientOriginalName();
                 $upload =  Input::file('file')->move($dest.'/','logo.png');
                  if($upload)
                        return Redirect::to('admin');
                    else
                        echo "Error";
        }  else{
             return Redirect::Back()->with('message', 'Not Authorized!');
          } 
       
        }  

    }

    public function logo(){
        // getting all of the post data
  $file = array('image' => Input::file('image'));
  // setting up rules
  $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
  // doing the validation, passing post data, rules and the messages
  $validator = Validator::make($file, $rules);
  if ($validator->fails()) {
    // send back to the page with the input data and errors
    return Redirect::Back()->withInput()->withErrors($validator);
  }
  else {
    // checking file is valid.
    if (Input::file('image')->isValid()) {
      $destinationPath = public_path().'/Managers/'.$email.'/';
      $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
      $fileName = 'logo'.'.png'; // renameing image
      Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
      // sending back with message
      Session::flash('success', 'Upload successfully'); 
      return Redirect::to('admin');
    }
    else {
      // sending back with error message.
      Session::flash('error', 'uploaded file is not valid');
      return Redirect::to('admin');
    }
  }

    }

    public function newProgram(){
        $check = Session::get('role');
        if($check == 'manager')
        {
            $this->_layout = 'layouts.newProgramTemplate';
            $this->_setUpLayout();
            $this->layout->content = View::make('admin.newProgram', array('user' => Auth::user()));
        }else
            return Redirect::Back()->with('message', 'Not Authorized!');
    }

    public function programLevel(){

        $this->_layout = 'layouts.masterTemplate';
        $this->_setUpLayout();

        $quarter = $this->programListener->getCurrentQuarter();
        $notifications = $this->programListener->getNotifications();
        $this->layout->content = View::make('admin.programLevel',array('user' => Auth::user(), 'quarter' => $quarter, 'notifications' =>
        $notifications));
    }

    public function addProject($id)
    {

        $this->_layout = 'layouts.newProgramTemplate';
        $this->_setUpLayout();

        $owner = $this->programListener->hasProgram($id);

        if($owner)
            $this->layout->content = View::make('admin.newProject', array('user' => Auth::user(), 'pid' => $id));
        else
            return Redirect::to('admin/programLevel');


    }

    public function checkOfficer(){
        if (Request::ajax())
        {
            $check = User::where('email', '=', Input::get('email'))->first();
            if($check!=null){
                if($check->role == 'officer'){
                    return $check->firstName.','.$check->lastName.','.$check->address.','.$check->contact;
                }
            }else
                return 1;
        }
        else
        {
            return Response::make('Unauthorized', 401);
        }

    }

    public function getCategory(){

        if (Request::ajax())
        {
            $tids = Theme::where('code', '=', Input::get('tcode'))->first();
            return View::make('admin.kpiCategories', array('tid' => $tids->id, 'tname' => $tids->name, 'tcode' => Input::get('tcode')));
        }else
        {
            return Response::make('Unauthorized', 401);
        }

    }

    public function getKpis(){

        if (Request::ajax())
        {
            return View::make('admin.getKpis', array('tcode' => Input::get('tcode'), 'pid' => Input::get('pid')));
        }else
        {
            return Response::make('Unauthorized', 401);
        }

    }

    public function deleteProgram()
    {
        if (Request::ajax())
        {
           return $this->programListener->deleteProgram($this, Input::all());

        }else
        {
            return Response::make('Unauthorized', 401);
        }
    }

    public function deletedOk()
    {
        return "Done";
    }

    public function error(){
        return "Failed";
    }

    /**
     * Display the password reminder view.
     *
     * @return Response
     */
    public function changePassword()
    {
        $this->_layout = 'layouts.masterTemplate';
        $this->_setUpLayout();
        $this->layout->content = View::make('password.remindMember',array('user' => Auth::user()));

    }

    public function renameProject(){
        $name = Input::get('name');
        $pid = Input::get('id');

        $check = Project::where('id', '=', $pid)->first();
        if($check!=null){
            $check->name = $name;
            if($check->save())
                return $name;
        }

    }

    public function projectLevel($id){
        $this->_layout = 'layouts.masterTemplate';
        $this->_setUpLayout();
        $this->layout->content = View::make('admin.projectLevel',array('user' => Auth::user(), 'id'=>$id));
    }

    public function submitPassword()
    {

        $validator = Validator::make(Input::all(), User::$changePassword);

        if($validator->passes())
        {
            $email = Input::get('email');
            $check = User::where('email', '=', $email)->first();
            if($check !=null){
                if(Auth::user() == $check){
                    if(Hash::check(Input::get('old'), $check->password)){
                        $pass1 = Input::get('new');
                        $pass2 = Input::get('new1');

                        if($pass1 == $pass2){
                            $check->password = Hash::make($pass1);
                            $check->save();

                            return Redirect::Back()->with('message', 'Password Changed Successfully!');

                        } else return Redirect::Back()->with('message', 'Passwords do not match.!');

                    }else  return Redirect::Back()->with('message', 'Wrong Password!');

                }
               else return Redirect::Back()->with('message', 'Not Authorized!');
            }
            else return Redirect::Back()->with('message', 'Invalid User!');
        }
        return Redirect::Back()->withInput()->withErrors("All the fields are Required.  Passwords should be Alpha-Numeric and between 6-12 characters long");


    }

    public function submitIssue()

    {
        $pid = Input::get('pid');
        $issue = Input::get('issue');
        $rec = Input::get('rec');
        $res = Input::get('res');
        $own = Input::get('own');

        $user = Auth::user();

        $new = new Issues;
        $new->issue = $issue;
        $new->received = $rec;
        $new->resolved = $res;
        $new->owner = $own;
        $new->project_id = $pid;
        $new->save();

        $project = Project::where('id', '=', $pid)->first();
        $officer = User::where('email', '=', $own)->first();

        // Mail::send('emails.newIssue', array('firstname'=>$officer->firstName, 'lastname'=>$officer->lastName, 'email'=>$own, 'project'=>$project->name, 'issue'=>$issue, 'rec'=>$rec, 'res'=>$res, 'managerFname'=>$user->firstName, 'managerLname'=>$user->lastName, 'managerEmail'=>$user->email), function($message){
        //          $message->to($own)->subject('New Issue Raised.');
        //      });
           
         
        return Redirect::Back()->with('message', 'Saved!');

    }









}