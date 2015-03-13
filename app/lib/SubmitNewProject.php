<?php
/**
 * Created by PhpStorm.
 * User: prateek
 * Date: 05/02/2015
 * Time: 09:32
 */

class SubmitNewProject {

    protected  $listener ;
    protected $registerUserListener = null;

    protected $projectId = null;
    protected $programId = null;

    public function __construct(RegisterUser $newUser){
        $this->registerUserListener = $newUser;
    }


    public function step1($listen, $data){

        $this->listener = $listen;

        $manager = Manager::where('userId', '=', Auth::user()->id)->first();

        $project = new Project;
        $project->name = $data['pname'];
        $project->description = $data['pdesc'];

        if($project->save()){
            Auth::user()->projects()->attach($project->id);
            $project->programs()->attach($data['prid']);
            $manager->projects()->attach($project->id);
        }else
            return $this->listener->failed();

        return $this->listener->success_step1($project->id);
    }


    public function step2($listen, $data){
        $this->listener = $listen;
        $this->projectId = $data['proj'];


        $manager = Manager::where('userId', '=', Auth::user()->id)->first();
        if($manager != null){
            $officer = User::where('email', '=', $data['email'])
                ->where('role', '=', "officer")
                ->first();
            if($officer == null){
                return $this->registerUserListener->addMembers($this,Input::all());
            }else{
                $officer->projects()->attach($data['proj']);
                $exists = Officer::where('userId', '=', $officer->id)->first();
                $exists->projects()->attach($data['proj']);
                $manager->officers()->attach($exists->id);

                return $this->listener->success_step2();
            }
        }
    }

    public function step3($listen, $data){

        $this->listener = $listen;
        $this->projectId = $data['proj'];


        $manager = Manager::where('userId', '=', Auth::user()->id)->first();

        $check = User::where('email', '=', $data['email'])->first();
        if($check != null){

            switch($check->role){
                Case 'manager':
                                $newManager = Manager::where('userId', '=', $check->id)->first();
                                $newManager->projects()->attach($data['proj']);
                                $check->projects()->attach($data['proj']);
                              //  $check->programs()->attach($data['prog']);
                                break;

                Case 'officer':
                                $officer = Officer::where('userId', '=', $check->id)->first();
                                $manager->officers()->attach($officer->id);
                                $officer->projects()->attach($data['proj']);
                                $check->projects()->attach($data['proj']);
                              //  $check->programs()->attach($data['prog']);
                                break;

                default:        break;
            }

            return $this->listener->success_step2();
        }else{
            return $this->registerUserListener->addMembers($this,Input::all());
        }

    }



    public function success($id){
        $manager = Manager::where('userId', '=', Auth::user()->id)->first();

        $user = User::where('id', '=', $id)->first();

        switch($user->role){

            Case 'manager':
                            $newManager = Manager::where('userId', '=', $id)->first();
                            $newManager->projects()->attach($this->projectId);
                            $user->projects()->attach($this->projectId);
                           // $user->programs()->attach($this->programId);
                            break;

            Case 'officer':
                            $officer = Officer::where('userId', '=', $id)->first();
                            $manager->officers()->attach($officer->id);
                            $officer->projects()->attach($this->projectId);
                            $user->projects()->attach($this->projectId);
                           // $user->programs()->attach($this->programId);
                            break;

            default:        break;


        }



        return $this->listener->success_step2();
    }



    public function failed(){

    }


    public function step3_1($listen, $data){

        $this->listener = $listen;
        $check = Project::where('id', '=', $data['pid'])->first();
        if($check!=null){

            $new = new Funding;
            $new->name = $data['sname'];
            $new->pid = $data['pid'];
            $new->type = $data['type'];
            $new->total = $data['total'];
            $new->save();

            return $this->listener->success_step2();
        }
        return $this->listener->failed();
    }

    public function step4_q_m($listen, $data){
        $this->listener = $listen;

        $etype = $data['entry_type'];
        $pid = $data['pid'];
        $year1 = $data['e_year'];
        $syear = $data['s_year'];

        switch($etype){

            Case 'fund':
                            $ret = Returns::where('Project_id', '=', $pid)
                                ->where('type', '=', "funding")->first();

                            if($ret!=null){

                                $ret->user = Auth::user()->id;
                                $ret->type = "funding";
                                $ret->Project_id = $pid;
                                $ret->record = $data['period'];
                                $ret->start_date = $syear;
                                $ret->end_date = $year1;
                                $ret->save();
                            }else{
                                $return = new Returns;
                                $return->user = Auth::user()->id;
                                $return->type = "funding";
                                $return->Project_id = $pid;
                                $return->record = $data['period'];
                                $return->start_date = $syear;
                                $return->end_date = $year1;
                                $return->track = 1;
                                $return->save();
                            }

                            break;

            Case 'spend':
                            $ret = Returns::where('Project_id', '=', $pid)
                                ->where('type', '=', "spending")->first();

                            if($ret!=null){

                                $ret->user = Auth::user()->id;
                                $ret->type = "spending";
                                $ret->Project_id = $pid;
                                $ret->record = $data['period'];
                                $ret->start_date = $syear;
                                $ret->end_date = $year1;
                                $ret->save();
                            }else{
                                $return = new Returns;
                                $return->user = Auth::user()->id;
                                $return->type = "spending";
                                $return->Project_id = $pid;
                                $return->record = $data['period'];
                                $return->start_date = $syear;
                                $return->end_date = $year1;
                                $return->track = 1;
                                $return->save();
                            }

                            break;

            Case 'targets':
                            $ret = Returns::where('Project_id', '=', $pid)
                                ->where('type', '=', "targets")->first();

                            if($ret!=null){

                                $ret->user = Auth::user()->id;
                                $ret->type = "targets";
                                $ret->Project_id = $pid;
                                $ret->record = $data['period'];
                                $ret->start_date = $syear;
                                $ret->end_date = $year1;
                                $ret->save();
                            }else{
                                $return = new Returns;
                                $return->user = Auth::user()->id;
                                $return->type = "targets";
                                $return->Project_id = $pid;
                                $return->record = $data['period'];
                                $return->start_date = $syear;
                                $return->end_date = $year1;
                                $return->track = 1;
                                $return->save();
                            }
                            break;
        }

        return $this->listener->success_step2();

    }


    public function step5($listen, $data)
    {
        $this->listener = $listen;
        $month = $data['month'];
        $year = $data['year'];
        $pid = $data['pid'];
        $value = $data['value'];
        $type = $data['type'];
        $syear = $data['syear'];
        $eyear = $data['eyear'];
        $etype = $data['entry_type'];

        $target = $month."-".$year;
        $fund = Funding::where('name', '=', $data['sname'])
            ->where('pid', '=', $pid)->first();

        if($etype == "fund"){

            $ret = new Returns;
            $ret->user = Auth::user()->id;
            $ret->type = "funding";
            $ret->Project_id = $pid;
            $ret->record = $type;
            $ret->target_date = $target;
            $ret->fund_id = $fund->id;
            $ret->save();

            $tar = new Target;
            $tar->kpi_id = 14;
            $tar->value = $value;
            $tar->return_id = $ret->id;
            $tar->project_id = $pid;
            $tar->save();

        }


    }

    public function step6($listen, $data){

        $this->listener = $listen;
        $month = $data['month'];
        $year = $data['year'];
        $pid = $data['pid'];
        $value = $data['value'];
        $type = $data['type'];
        $etype = $data['entry_type'];

        $target = $month."-".$year;

            $ret = new Returns;
            $ret->user = Auth::user()->id;
            $ret->type = "spending";
            $ret->Project_id = $pid;
            $ret->record = $type;
            $ret->target_date = $target;
            $ret->save();

            $tar = new Target;
            $tar->kpi_id = 15;
            $tar->value = $value;
            $tar->return_id = $ret->id;
            $tar->project_id = $pid;
            $tar->save();


        return $this->listener->step5_OK();
    }

    public function step9($listen, $data){

        $this->listener = $listen;

        $kpi = $data['kpi'];
        $pid = $data['pid'];

        $c1 =0;
        $c2 = 0;
        $c3 = 0;

        $tid ="";
        $cid = "";
        $kid = "";

        $project = Project::where('id', '=', $pid)->first();
        $k = KPI::where('name', '=', $kpi)->first();

        if($k!=null){

            $tid = $k->theme_id;
            $cid = $k->category_id;
            $kid = $k->id;

        }

//////////////            Attach Project Area( THEME )    /////////////////

        foreach($project->themes as $t)
        {
            if($t->id == $tid)
                $c1++;
        }

        if($c1 == 0)
            $project->themes()->attach($tid);



//////////////            Attach Activity Area( CATEGORY )    /////////////////
        foreach($project->categories as $t1)
        {
            if($t1->id == $cid)
                $c2++;
        }

        if($c2 == 0)
            $project->categories()->attach($cid);



//////////////            Attach  KPIs   /////////////////
        foreach($project->kpis as $t2)
        {
            if($t2->id == $kid)
                $c3++;
        }
        if($c3 == 0)
            $project->kpis()->attach($kid);

        return $this->listener->step5_OK();

    }

    public function step10($listen, $data)
    {
        $this->listener = $listen;

        $uid = Session::get('user_id');
        $type = "targets";
        $pid = $data['pid'];
        $record = $data['record'];
        $sdate  = $data['syear'];
        $edate  = $data['eyear'];
        $tdate  = $data['year'];
        $tmonth = $data['month'];
        $dup = 0;
        $records = "";
        $kpi = $data['kpi'];

        $kpid1 = KPI::where('name', '=', $kpi)->first();
        $kpid = $kpid1->id;

        $value = $data['value'];

        $ret = new Returns;
        $ret->user = $uid;
        $ret->type = $type;
        $ret->Project_id = $pid;

        if($record == "month")
            $records = "monthly";
        else if($record == "quarter")
            $records = "quarterly";

        $ret->start_date = $sdate;
        $ret->end_date = $edate;
        $ret->target_date = $tdate.'-'.$tmonth;
        $ret->record = $records;
        $ret->kpi = $kpid;
        $ret->save();

        $ret1 = new Returns;
        $ret1->user = $uid;
        $ret1->type = "value";
        $ret1->record = $records;
        $ret1->Project_id = $pid;
        $ret1->target_date = $tdate.'-'.$tmonth;
        $ret1->kpi = $kpid;
        $ret1->save();

        $tar = new Target;
        $tar->kpi_id = $kpid;
        $tar->value = $value;
        $tar->return_id = $ret->id;
        $tar->project_id = $pid;
        $tar->save();

        $tar1 = new Target;
        $tar1->kpi_id = $kpid;
        $tar1->value = -100;
        $tar1->return_id = $ret1->id;
        $tar1->project_id = $pid;
        $tar1->save();

        return $this->listener->step5_OK();

    }

    public function step11($listen, $data){
        $this->listener = $listen;

        $pid = $data['pid'];
        $pr = $data['pr'];
        $ir = $data['ir'];
        $mr = $data['mr'];

        $project = Project::where('id', '=', $pid)->first();

        $project->mr = $mr;
        $project->ir = $ir;
        $project->pr = $pr;
        $project->save();

        return $this->listener->step5_OK();

    }





    /**
     * End of Class
     */

}