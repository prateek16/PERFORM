<?php
/**
 * Created by PhpStorm.
 * User: prateek
 * Date: 03/02/2015
 * Time: 10:50
 */

class AdminArea {

    protected static $user;

    public function __construct(){
        self::$user = Auth::user();
    }

    public static function getLogo(){

        $path1 = public_path();
        $parentDir = $path1."/Managers/".Auth::user()->email.'/';

        if(file_exists($parentDir."logo.png") || file_exists($parentDir."logo.jpg"))
            return true;

        return false;

    }


    public static function getDir(){

        $path1 = public_path();
        $parentDir = "/Managers/".Auth::user()->email.'/';
        $parentDir1 = $path1."/img/";
        return $parentDir;
    }

    public static function generatePlaces(){

        $pl = 0;

    }

    public static function getLevel(){
        $userLevel = Role::where('level', '=', Auth::user()->level)->first();
        return $userLevel->role;
    }

    public static function getNotifications(){
        return 0;
    }

    public static function getTotalProgrammes(){
        $user = Auth::user();
        return $user->programs->count();
    }

    public static function getProjectName($id)
    {
        $project = Project::where('id', '=', $id)->first();
        return $project->name;        
    }

    public static function getFundingStatus($id){
         $project = Project::where('id', '=', $id)->first();
         return $project->fundingStatus;
    }

    public static function getKpiStatus($kpi,$project){
        $status = Status::where('kpi', '=', $kpi)
                        ->where('project', '=', $project)->first();

        return $status->status;
    }





}