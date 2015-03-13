<?php
/**
 * Created by PhpStorm.
 * User: prateek
 * Date: 23/02/2015
 * Time: 11:09
 */

class OfficerArea {

    protected static $user;

    public function __construct(){
        self::$user = Auth::user();
    }

    public static function getLevel(){
        $userLevel = Role::where('level', '=', Auth::user()->level)->first();
        return $userLevel->role;
    }

    public static function getProjects(){
        $officer = Auth::user();
        $project = array();

        foreach($officer->projects as $p)
        {
            $project[] = $p->id;
        }
        return $project;
    }

    public static function getFirstKpi($pid)
    {
        $pr = Project::where('id', '=', $pid)->get();
        foreach($pr as $p) {
            foreach ($p->kpis as $k) {
                    return $k->name;
            }
        }
    }
    public static function getFirstKpid($pid)
    {
        $pr = Project::where('id', '=', $pid)->get();
        foreach($pr as $p) {
            foreach ($p->kpis as $k) {
                return $k->id;
            }
        }
    }

    public static function getProjectStatus($id)
    {
        $total = 0;

        $pr = Project::where('id', '=', $id)->first();
        $status = Status::where('project', '=', $id)->get();
        $count = $status->count();

        foreach($status as $agg){
            $total+=$agg->status;
        }

        $avg = (($total)/($count * 5)) *100 ;

        return $avg;
    }


    public static function getkpi($kpi,$project,$type)
    {
        $proj = Project::where('id', '=', $project)->first();
        $final_target = array();
        $final_spend = array();
        $targets = array();
        $start_date = "";
        $end_date = "";
        $red = "";
        $green = "";
        $total =0;

        $dates = Returns::where('Project_id', '=', $project)
            ->where('type', '=', "targets")
            ->where('track', '=', 0)
            ->where('kpi', '=', $kpi)
            ->first();

        if($dates!=null){

            $sdate = $dates->start_date;
            $edate = $dates->end_date;

            $arr1 = explode('-', $sdate);
            $arr2 = explode('-', $edate);

            $start_date = $arr1[0];
            $end_date = $arr2[0];

            $record = $dates->record;

            if($record == "quarterly"){
                for($i =$start_date; $i<=$end_date; $i++){
                    for($j=1; $j<=4; $j++){
                        $target = Returns::where('Project_id', '=', $project)
                            ->where('type', '=', $type)
                            ->where('track', '=', 0)
                            ->where('kpi', "=", $kpi)
                            ->where('target_date', '=', $j.'-'.$i)->get();

                        foreach($target as $a){
                            foreach($a->targets as $t){
                                $quarter = $j.'-'.$i;
                                $targets[$quarter] = $t->value;
                            }
                        }
                    }
                }
            }
            else if($record == "monthly"){
                for($i =$start_date; $i<=$end_date; $i++){
                    for($j=1; $j<=12; $j++){
                        $tdate = $j.'-'.$i;
                        $target = Returns::where('Project_id', '=', $project)
                            ->where('type', '=', $type)
                            ->where('track', '=', 0)
                            ->where('kpi', "=", $kpi)
                            ->where('target_date', '=', $tdate)->get();

                        foreach($target as $a){
                            foreach($a->targets as $t){
                                $quarter1 = $j.'-'.$i;
                                $targets[$quarter1] = $t->value;
                            }
                        }
                    }
                }
            }
        }
        return $targets;
    }

    public static function getKpiDues($pid)
    {
      $prid = array();
        $ret_id = array();
        $record = "";
        $m = date('M');
        $month = date("n", strtotime($m));
        $year = date('Y');
        $quarter = 0;

        if($month>=1 && $month <=3)
            $quarter = 1;
        else if($month>=4 && $month <=6)
            $quarter = 2;
        else if($month>=7 && $month <=9)
            $quarter = 3;
        else if($month>=10 && $month <=12)
            $quarter = 4;

              $check_return = Returns::where('Project_id', '=', $pid)
                    ->where('type', '=', 'value')
                    ->where('track', '=', 0)->get();

                if($check_return != null){
                    foreach($check_return as $c){

                         $start = $c->target_date;
                         $marray = explode('-', $start);

                         $tmonth = $marray[0];
                         $tyear = $marray[1];

                         if($c->record == 'quarterly')
                            $record =  'quarterly';
                         if($c->record == 'monthly')
                           $record == 'monthly';

                           if($record == 'quarterly'){
                             if($quarter == $tmonth && $year == $tyear)
                             {
                                $target = Target::where('return_id', '=', $c->id)->first();
                                $value = $target->value;

                                if($value == '0' || $value < 0)
                                {
                                       $ret_id[] = $target->id;                              
                                     

                                 }

                             }
                           }  if($record == 'monthly'){
                             if($month == $tmonth && $year == $tyear)
                             {
                                $target = Target::where('return_id', '=', $c->id)->first();
                                $value = $target->value;

                                if($value == '0' || $value < 0)
                                {
                                       $ret_id[] = $target->id;                              
                                     

                                 }

                             }
                           } 
                       }
                    
                }
                

               

                return $ret_id;
    }

    public static function getProjectRecord($id)
    {
        $record = Returns::where('Project_id', '=', $id)
                         ->where('type', '=', 'targets')
                         ->where('track', '=', 1)->first();

        return $record->record;  
    }

   

      public static function getDues($type)
    {

        $uid = Session::get('user_id');
        $user = User::where('id', '=', $uid)->first();
        $notify = 0;
        $record = "";
        $count = 0;
        $prid = array();
        $ret_id = array();

        $m = date('M');
        $month = date("n", strtotime($m));
        $year = date('Y');
        $quarter = 0;

        if($month>=1 && $month <=3)
            $quarter = 1;
        else if($month>=4 && $month <=6)
            $quarter = 2;
        else if($month>=7 && $month <=9)
            $quarter = 3;
        else if($month>=10 && $month <=12)
            $quarter = 4;

        $check_officer = Officer::where('userId', '=', $uid)->first();
        if($check_officer != null)
        {
            foreach($check_officer->projects as $t)
            {
                $pid = $t->id;

                $check_return = Returns::where('Project_id', '=', $pid)
                    ->where('type', '=', 'value')
                    ->where('track', '=', 0)->get();

                if($check_return != null)
                {
                    foreach($check_return as $c){

                        $start = $c->target_date;
                        $marray = explode('-', $start);

                        $tmonth = $marray[0];
                        $tyear = $marray[1];

                        if($c->record == "quarterly")
                            $record = "quarterly";
                        if($c->record == "monthly")
                            $record = "monthly";

                        if($record == "quarterly"){
                            if($quarter == $tmonth && $year == $tyear){
                                $flag = $c->id;

                                $target = Target::where('return_id', '=', $c->id)->first();
                                $value = $target->value;

                                if($value == '-100' || $value < 0){
                                    $notify++;
                                    $project[] = $target->project_id;
                                    $prid[] = $target->project_id;

                                    $ret_id[] = $target->id;


                                }

                            }
                        } if($record == "monthly"){
                            if($month == $tmonth && $year == $tyear){
                                $flag = $c->id;

                                $target = Target::where('return_id', '=', $c->id)->first();
                                $value = $target->value;

                                if($value == '-100' || $value < 0){
                                    $notify++;
                                    $project[] = $target->project_id;
                                    $prid[] = $target->project_id;
                                    $ret_id[] = $target->id;
                                }
                            }
                        }
                    }
                }else{

                }
            }
        }

        if($type == 'project')
            return $prid;
        elseif($type == 'returns')
            return $ret_id;
        elseif($type == 'notify')
            return $notify;

        


    }


}