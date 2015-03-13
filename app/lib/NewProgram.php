<?php
/**
 * Created by PhpStorm.
 * User: prateek
 * Date: 03/02/2015
 * Time: 16:36
 */

class NewProgram {

    protected $listener;
    protected $data = array();

    public function create($listen, $name, $desc){

        $this->listener = $listen;

        if(Auth::check()){

            $user = Auth::user();
            $program = new Program;
            $program->name = $name;
            $program->description = $desc;
            $program->save();

            $user->programs()->attach($program->id);

            return $this->listener->success($program->id);
        }


        return $this->listener->failed();


    }

//    public function addMembers($listen, $data){
//        $check = User::where('email', '=', $data['email'])->first();
//        $fname = $data['fname'];
//        $lowercase = strtolower($fname);
//
//        if($check == null){
//            $user = new User;
//            $user->role = $data['role'];
//            $user->firstName = $data['fname'];
//            $user->lastName = $data['lname'];
//            $user->email = $data['email'];
//            $user->password = Hash::make($lowercase);
//            $user->contact = $data['phone'];
//            $user->address = $data['address'];
//            $user->save();
//
//            $user->programs()->attach($data['prog']);
//
//            return $this->listener->success(1);
//        }else{
//            $check->programs()->attach($data['prog']);
//            return $this->listener->success(1);
//        }
//
//
//
//
//
//
//    }

}