<?php
/**
 * Created by PhpStorm.
 * User: prateek
 * Date: 04/02/2015
 * Time: 11:16
 */

class ProgramLevel {

    protected static $chartListener ;

    protected $listener;

    private $quarter = null;
    private $month = null;
    private $year = null;
    private $projectId = null;
    private $returnId = null;
    private $notifications = null;

    protected static $totalProjects = null;
    protected static $totalFunds = null;

    protected $data = array();
    protected $managerArray = array();
    protected $officerArray = array();


    public function __construct(Charts $chart){
        $this->managerArray = ['A', 'B', 'C', 'D'];
        $this->officerArray = ['G', 'H', 'I'];
        self::$chartListener = $chart;

    }

    public function getCurrentQuarter(){
        $this->month = date("n", strtotime(date('M')));
        $this->year = date('Y');

        if( $this->month>=1 &&  $this->month <=3)
            $this->quarter = 1;
        else if( $this->month>=4 &&  $this->month <=6)
            $this->quarter = 2;
        else if( $this->month>=7 &&  $this->month <=9)
            $this->quarter = 3;
        else if( $this->month>=10 &&  $this->month <=12)
            $this->quarter = 4;

        return $this->quarter;

    }

    public function hasProgram($id){

        $user = User::find(Auth::user()->id);

        foreach($user->programs as $p) {
            if ($p->id == $id)
                return true;
        }

        return false;


    }

    public function getNotifications(){
        return $this->notifications;
    }

    public static function incrementTotalProjects(){
        self::$totalProjects++;
    }

    public static function getTotalProjects(){
        return self::$totalProjects;
    }

    public static function incrementTotalFunds($id){
        self::$totalFunds += self::$chartListener->getTotalFunds($id);

    }

    public static function getTotalFunds(){
        return number_format(self::$totalFunds, 2);
    }

    public function deleteProgram($listen, $data){

        $this->listener = $listen;
        $pid = $data['pid'];

        $uid = Session::get('user_id');

        $program = Program::where('id', '=', $pid)->first();

        if($program!=null)
        {
            foreach($program->projects as $project){
               /**
                * Detach this project from the current program
                */
                $program->projects()->detach($project->id);

                /**
                 * Detach kpis from this project
                 */
                foreach($project->kpis as $kpi)
                    $project->kpis()->detach($kpi->id);

                /**
                 * Detach themes from this project
                 */
                foreach($project->themes as $theme)
                    $project->themes()->detach($theme->id);

                /**
                 * Detach Categories from this project
                 */
                foreach($project->categories as $cat)
                    $project->categories()->detach($cat->id);

                /**
                 * Detach this user from the project
                 */
                $project->users()->detach(Auth::user()->id);

                /**
                 * Delete returns(Targets) attached to this project
                 */

                $ret = Returns::where('user', '=', $uid)
                    ->where('type', '=', "targets")
                    ->where('Project_id', '=', $project->id)
                    ->where('track', '=', "0")
                    ->get();

                foreach($ret as $t){
                    $t->targets()->delete();
                    $t->delete();
                }

                /**
                 * Delete returns(Values) attached to this project
                 */

                $ret2 =  Returns::where('user', '=', $uid)
                    ->where('type', '=', "value")
                    ->where('Project_id', '=', $project->id)
                    ->where('track', '=', "0")
                    ->get();

                foreach($ret2 as $t){
                    $t->targets()->delete();
                    $t->delete();
                }

                /**
                 * Delete returns(Funding) attached to this project
                 */

                $ret3 =  Returns::where('user', '=', $uid)
                    ->where('type', '=', "funding")
                    ->where('Project_id', '=', $project->id)
                    ->where('track', '=', "0")
                    ->get();

                foreach($ret3 as $t){
                    $t->targets()->delete();
                    $t->delete();
                }

                /**
                 * Delete returns(Spending) attached to this project
                 */

                $ret3 =  Returns::where('user', '=', $uid)
                    ->where('type', '=', "spending")
                    ->where('Project_id', '=', $project->id)
                    ->where('track', '=', "0")
                    ->get();

                foreach($ret3 as $t){
                    $t->targets()->delete();
                    $t->delete();
                }

                $ret1 =  Returns::where('user', '=', $uid)
                    ->where('type', '=', "targets")
                    ->where('track', '=', "1")
                    ->where('Project_id', '=', $project->id)->delete();

                $ret4 = Returns::where('user', '=', $uid)
                    ->where('type', '=', "funding")
                    ->where('track', '=', "1")
                    ->where('Project_id', '=', $project->id)->delete();

                $ret5 =  Returns::where('user', '=', $uid)
                    ->where('type', '=', "spending")
                    ->where('track', '=', "1")
                    ->where('Project_id', '=', $project->id)->delete();

                 Project::where('id', '=', $project->id)->delete();
            }

            $program->users()->detach(Auth::user()->id);
            $program->delete();

            return $this->listener->deletedOk();
        }else{
            return $this->listener->error();
        }



    }


}