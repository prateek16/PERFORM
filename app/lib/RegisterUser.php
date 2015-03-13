<?php
/**
 * Created by PhpStorm.
 * User: prateek
 * Date: 03/02/2015
 * Time: 10:04
 */

class RegisterUser {

    protected  $listener ;

    private $firstName = null;
    private $lastName = null;
    private $email = null;
    private $role = null;
    private $id = null;
    private $password = null;
    protected $data = array();
    protected $managerArray = array();
    protected $officerArray = array();


    public function __construct()
    {
        $this->managerArray = ['A', 'B', 'C', 'D'];
        $this->officerArray = ['G', 'H', 'I'];
    }

    public function create(RegisterInterface $listen, $data)
    {
        $this->listener = $listen;
        $user = new User;

        $user->firstName = $data['firstname'];
        $this->firstName = $data['firstname'];

        $user->lastName = $data['lastname'];
        $this->lastName = $data['lastname'];

        $user->email = $data['email'];
        $this->email = $data['email'];

        $user->password = Hash::make($data['password']);
        $this->password = $data['password'];

        if(in_array($data['role_user'], $this->managerArray))
        {
            $user->role = "manager";
            $this->role = "manager";

            $user->level = $data['role_user'];
            self::setDirectory();
        }else
            if(in_array($data['role_user'], $this->officerArray))
            {
                $user->role = "officer";
                $this->role = "officer";

                $user->level = $data['role_user'];
            }


        if($user->save()){
            $this->id = $user->id;
            self::AttachRoleHandler();
            self::sendMail();
        } else
            return $this->listener->RegisterFailed();


        return $this->listener->RegisterSuccessful($this->email,$this->password);
    }


    public function addMembers($listen, $data){

        $this->listener = $listen;

        $check = User::where('email', '=', $data['email'])->first();
        $fname = $data['fname'];
        $lowercase = strtolower($fname);

        if($check == null){
            $user = new User;

            $user->firstName = $data['fname'];
            $this->firstName = $data['fname'];

            $user->lastName = $data['lname'];
            $this->lastName = $data['lname'];

            $user->email = $data['email'];
            $this->email = $data['email'];

            $user->password = Hash::make($lowercase);

            $user->contact = $data['phone'];

            $user->address = $data['address'];

            if(in_array($data['role'], $this->managerArray))
            {
                $user->role = "manager";
                $this->role = "manager";

                $user->level = $data['role'];
                self::setDirectory();
            }else
                if(in_array($data['role'], $this->officerArray))
                {
                    $user->role = "officer";
                    $this->role = "officer";

                    $user->level = $data['role'];
                }

            if($user->save()){
                $this->id = $user->id;
                $user->programs()->attach($data['prog']);
                self::AttachRoleHandler();
            } else
                return $this->listener->failed();

            return $this->listener->success($this->id);
        }else{
            $check->programs()->attach($data['prog']);
            return $this->listener->success($this->id);
        }
    }





    public function setDirectory(){

        $path1 = public_path();
        $parentDir = $path1."/Managers/";

        if(!is_dir($parentDir))
            mkdir($parentDir, 0777);

        $newDir = $parentDir.$this->email."/";

        if(!is_dir($newDir))
            mkdir($newDir, 0777);


    }

    public function AttachRoleHandler(){

        switch($this->role){

            Case 'manager':
                $manager = new Manager;
                $manager->userId = $this->id;
                $manager->save();
                break;

            Case 'officer':
                $officer = new Officer;
                $officer->userId = $this->id;
                $officer->save();
                break;

            default:    break;
        }


    }


    public function sendMail(){
         Mail::send('emails.newAccount', array('firstname'=>$this->firstName, 'lastname'=>$this->lastName, 'email'=>$this->email), function($message){
                 $message->to($this->email)->subject('Welcome to the Dashboard.');
             });
    }

}