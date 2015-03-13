<?php
/**
 * Created by PhpStorm.
 * User: prateek
 * Date: 03/02/2015
 * Time: 09:18
 */

class LoginUser {

    protected $listener;

    public function login(LoginInterface $login, $email, $password){

        $this->listener = $login;

        if (Auth::attempt(array('email'=>$email, 'password'=>$password))) {

            self::setSession();
            return $this->listener->loginSuccessful();
        }


        return $this->listener->LoginFailed();
    }


    public function setSession(){

            $data = Auth::user();
            Session::put('user', $data->firstName);
            Session::put('user_id', $data->id);
            Session::put('email', $data->email);
            Session::put('role', $data->role);

    }




}