<?php
/**
 * Created by PhpStorm.
 * User: prateek
 * Date: 04/02/2015
 * Time: 12:30
 */

class Charts {


    ////////////////////////////////////////   TOTAL Funds   //////////////////////////////////////////////////////
    public function getTotalFunds($id){

        setlocale(LC_MONETARY, 'en_GB.UTF-8');

        $total = 0;
        $a2 = Returns::where('type', '=', "funding")
            ->where('track', '=', 0)
            ->where('Project_id', '=', $id)
            ->get();

        if($a2!= null)
        {
            foreach($a2 as $a3){

                foreach($a3->targets as $a4){

                    $total += $a4->value;
                }
            }
        }else{
            $total = 0;
        }
        return $total;
    }

    

}