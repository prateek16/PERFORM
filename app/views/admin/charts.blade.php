<?php


////////////////////////////////////////   TOTAL Funds   //////////////////////////////////////////////////////
 function totalfunds($id){

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


////////////////////////////////////////   TOTAL SPEND   //////////////////////////////////////////////////////
 function totalspend($id){
 $total = 0;
$a2 = Returns::where('type', '=', "spending")
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

////////////////////////////////////////   TOTAL KPI   //////////////////////////////////////////////////////

function totalkpi($id){
    
  $project = Project::where('id', '=', $id)->first();
  $total = $project->kpis()->count();
  return $total;
}

////////////////////////////////////////   TOTAL OFFICER   //////////////////////////////////////////////////////
function totalofficer($id){
  $project = Project::where('id', '=', $id)->first();
  $total = $project->officers()->count();
  return $total;
}

////////////////////////////////////////   TOTAL Funding Sources   ////////////////////////////////////////////
function totalfundsource($id){

  $funds = Funding::where('pid', '=', $id)->get();
  $total = $funds->count();
  return $total;
}
////////////////////////////////////////   GET THE KPI   //////////////////////////////////////////////////////
function getkpi($kpi,$project,$type)
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


////////////////////////////////////////   DRAW CHARTS   //////////////////////////////////////////////////////

function drawcharts($data1,$data2,$project,$kpi,$width,$height,$years_bool){
  


  $chd1 = "";
  $chd2 = "";
  $chm = "";
  $chf = "";
  $targets = array();
  $targets = $data1;
  $get_dates = "";
  $values = array();
  $values = $data2;
  $max_amount = 0;
  $start_date = "";
  $end_date = "";
  if($targets != null)
  $max_amount1 = max($targets);
else
   $max_amount1 = 100;

  if($values != null)
  $max_amount2 = max($targets);
else
   $max_amount2 = 100;


  if($max_amount1 > $max_amount2){
    $max_amount = $max_amount1;
  }else{
    $max_amount = $max_amount2;
  }
  
  $numItems = count($targets);
  $i = 0;
   foreach($targets as $key => $value){
    
    if(++$i === $numItems) {
      $chd1 .= $value;
    } else{
      $chd1 .= $value.',';
    }
    
   }

  $numItems1 = count($values);
  $j = 0;
   foreach($values as $key => $value){
    
    if(++$j === $numItems1) {
      $chd2 .= $value;
    } else{
      $chd2 .= $value.',';
    }
    
   }

   $get_dates = Returns::where('Project_id', '=', $project)
         ->where('type', '=', "targets")
         ->where('track', '=', 0)
         ->where('kpi', '=', $kpi)
         ->first();



  if($get_dates!=null){

      $sdate = $get_dates->start_date;
      $edate = $get_dates->end_date;

      $arr1 = explode('-', $sdate);
      $arr2 = explode('-', $edate);

      $start_date = $arr1[0];
      $end_date = $arr2[0];

      $record = $get_dates->record;

    }

  $m = 0;

  
  $i = -1;
  $checkl = "";
  $checkr = "";
  foreach ($targets as $key => $value)
  {
    
      $a1 = $targets[$key];
      $b1 = $values[$key];

      if($b1!="-100" || $b1 > 0){
        $checkl = $a1;
        $checkr = $b1;
      }
    

    if($targets[$key] > $values[$key]){

      $a = $targets[$key];
    $b = $values[$key];
     
        
  
     if($b == "-100" || $b < 0)
      $b1 = 0;

    $diff = $a - $b1;
    $avg = ($a + $b1)/2;
   
    
    if($avg!=0)
    $per = ($diff/$avg)*100;
  else
    $per = 0;
  
   // echo $per.",                ";
  

   
      if(++$m == $numItems1){


          if($per > 20){   ///Red

              if($b == "-100" || $b < 0){
                   $chm.= 'B,EAEAEA,0,'.($i).':'.($i + 1).',0|';
                   $chm.= 'B,EAEAEA,1,'.($i).':'.($i + 1).',0';
              }else{
                 $chm.= 'B,FF7D7D,0,'.($i).':'.($i + 1).',0|';
                 $chm.= 'B,FF7D7D,1,'.($i).':'.($i + 1).',0';
              }
           
           // $chf='bg,s,FFCBCB';

          }else if($per >=11 && $per <=20){   //Pink

             if($b == "-100"  || $b < 0){
                   $chm.= 'B,EAEAEA,0,'.($i).':'.($i + 1).',0|';
                   $chm.= 'B,EAEAEA,1,'.($i).':'.($i + 1).',0';
              }else{
            $chm.= 'B,FFA4A4,0,'.($i).':'.($i + 1).',0|';
            $chm.= 'B,FFA4A4,1,'.($i).':'.($i + 1).',0';
           // $chf='bg,s,FFE5E5';
            }

          }else if($per >0 && $per <11){   //Orange

             if($b == "-100"  || $b < 0){
                   $chm.= 'B,EAEAEA,0,'.($i).':'.($i + 1).',0|';
                   $chm.= 'B,EAEAEA,1,'.($i).':'.($i + 1).',0';
              }else{
            $chm.= 'B,FFC04C,0,'.($i).':'.($i + 1).',0|';
            $chm.= 'B,FFC04C,1,'.($i).':'.($i + 1).',0';
          //  $chf='bg,s,ffd993';
          }

          }else if($per == -1){
            $chm.= 'B,ffffff,0,'.($i).':'.($i + 1).',0|';
            $chm.= 'B,ffffff,1,'.($i).':'.($i + 1).',0';
            $chf='';
          }
          else{

            $chm.= "";

          }
          
        
      }else{   

                if($per > 20){   ///Red
                  if($b =='-100'  || $b < 0){
                    $chm.= 'B,EAEAEA,0,'.($i).':'.($i + 1).',0|';
                    $chm.= 'B,EAEAEA,1,'.($i).':'.($i + 1).',0|';
                  }else{
                     $chm.= 'B,FF7D7D,0,'.($i).':'.($i + 1).',0|';
                    $chm.= 'B,FF7D7D,1,'.($i).':'.($i + 1).',0|';
                  }
            

          }else if($per >=11 && $per <=20){   //Pink
              if($b =='-100'  || $b < 0){
                    $chm.= 'B,EAEAEA,0,'.($i).':'.($i + 1).',0|';
                    $chm.= 'B,EAEAEA,1,'.($i).':'.($i + 1).',0|';
                  }else{
            $chm.= 'B,FFA4A4,0,'.($i).':'.($i + 1).',0|';
            $chm.= 'B,FFA4A4,1,'.($i).':'.($i + 1).',0|';
          }

          }else if($per >0 && $per <11){   //Orange
              if($b =='-100'  || $b < 0){
                    $chm.= 'B,EAEAEA,0,'.($i).':'.($i + 1).',0|';
                    $chm.= 'B,EAEAEA,1,'.($i).':'.($i + 1).',0|';
                  }else{
            $chm.= 'B,FFC04C,0,'.($i).':'.($i + 1).',0|';
            $chm.= 'B,FFC04C,1,'.($i).':'.($i + 1).',0|';
          }

          }else if($per == -1){            
            
          }
          else{

            $chm.= 'B,000000,0,'.($i).':'.($i + 1).',0|';
            $chm.= 'B,000000,1,'.($i).':'.($i + 1).',0|';

          }
   

        }

      
      

    }else if($targets[$key] <= $values[$key]){
        if(++$m == $numItems1){
        $chm.= 'B,6AB56A,1,'.($i).':'.($i + 1).',0|';
      $chm.= 'B,6AB56A,0,'.($i).':'.($i + 1).',0';
      $chf='bg,s,C3E1C3';
      }else{
        $chm.= 'B,6AB56A,1,'.($i).':'.($i + 1).',0|';
      $chm.= 'B,6AB56A,0,'.($i).':'.($i + 1).',0|';
      }                                                                                    
    }
  $i++;


    $diff1 = $checkl - $checkr;
    $avg1 = ($checkl + $checkr)/2;  
    if($avg1 !=0)
    $per1 = ($diff1/$avg1)*100;
  else
    $per1 = -1;
    


     if($per1 > 20){   ///Red
           
            $chf='bg,s,FFCBCB';

            $check = Status::where('kpi', '=', $kpi)
                           ->where('project', '=', $project)->first();

            if($check == null){
                $status = new Status;
            $status->kpi = $kpi;
            $status->project = $project;
            $status->status = 1;
            $status->save();
          }else{

          }

          

          }else if($per1 >=11 && $per1 <=20){   //Pink
          
            $chf='bg,s,FFE5E5';

          }else if($per1 >0 && $per1 <11){   //Orange
           
            $chf='bg,s,ffd993';

            $check = Status::where('kpi', '=', $kpi)
                           ->where('project', '=', $project)->first();

            if($check == null){
                $status = new Status;
            $status->kpi = $kpi;
            $status->project = $project;
            $status->status = 3;
            $status->save();
          }else{
            
          }

          }else if($per1 == -1){
            
             $check = Status::where('kpi', '=', $kpi)
                           ->where('project', '=', $project)->first();
                             if($check == null){
                $status = new Status;
            $status->kpi = $kpi;
            $status->project = $project;
            $status->status = 0;
            $status->save();
          }else{
            
          }           
          }
          else{              //Green

           $chf='bg,s,C3E1C3';

             $check = Status::where('kpi', '=', $kpi)
                           ->where('project', '=', $project)->first();

            if($check == null){
                $status = new Status;
            $status->kpi = $kpi;
            $status->project = $project;
            $status->status = 5;
            $status->save();
          }else{
            
          }

          }

 }

$chd = $chd1.'|'.$chd2;

//Use the $scaleValues array to define my Y Axis 'buffer'
   $YScaleMax =$max_amount;
   $YScaleMin = 0;

   $tot_year = 0;
    for($i = $start_date; $i<=$end_date;$i++){
      $tot_year++;
    }
    $tot_quarters = $tot_year * 4;

    $graphSequence = generateSequence(1, $tot_quarters, "|");
    
    //Set the Google Image Chart API parameters
    $cht = 'lc';//Set the chart type
    $years ="";
    for($i = $start_date; $i<=$end_date;$i++){
      $years .= $i.'|';
    }
    if($years_bool == true)
    $chxl = '1:|' . $graphSequence . '2:||3:|'.$years .'|4:|';
  else
    $chxl = '1:|' . $graphSequence . '2:||3:||4:|';
    //custom axis labels
    $chxp = '2,50|4,50';//Axis Label Positions
    $chxr = '0,' . $YScaleMin . ',' . $YScaleMax . '|1,1,52|3,1,12|5,' . $YScaleMin . ',' . $YScaleMax . '';//Axis Range
    $chxs = '0,252525,10,1,l,676767|1,252525,10,0,l,676767|2,03619d,13|4,03619d,13|5,252525,10,1,l,676767';//Axis Label Styles
    $chxtc = '0,5|1,5|5,5';//Axis Tick Mark Styles
    if($years_bool == true)
    $chxt = 'y,x,y,x';//Visible Axes
  else
    $chxt = 'y,x';//Visible Axes
    $chs = $width.'x'.$height;  //200x100';//Chart Size in px
    $chco = 'FF0000'.','.'76A4FB';//Series Colours
    $chds = '' . $YScaleMin . ',' . $YScaleMax . '';//Custom Scaling
    $chg = '-1,-1,1,5';//Grid lines
    $chls = '1|3';//line styles
    $chdl="Target".'|'."Achieved";
  
    
    //$chm = 'o,252525,0,-1,3';//Shape Markers
   // $chm='B,76A4FB,0,0:4,0';
    //Build the URL
    $googleUrl = 'http://chart.apis.google.com/chart?';
    $rawUrl = $googleUrl . 'cht=' . $cht . '&chxl=' . $chxl . '&chxp=' . $chxp . '&chxr=' . $chxr . '&chxs=' . 
    $chxs . '&chxtc=' . $chxtc . '&chxt=' . $chxt . '&chs=' . $chs . '&chco=' . $chco . '&chd=t:' . $chd . '&chds=' . 
    $chds . '&chg=' . $chg . '&chls=' . $chls . '&chm=' . $chm . '&chf=' . $chf ;

    $output = $rawUrl;
  

 return $output;
}







 //////////////////////////////////////////////////   Line Charts ////////////////////////////////////// 
 ///
 

$output = "";

 function aggfunding($project,$width,$height){


$final_target = array();
$final_spend = array();

$targets = array();

$start_date = "";
$end_date = "";
$red = "";
$green = "";
 $total =0;
 $ret_id = 0;


  $proj = Project::where('id', '=', $project)->first();

$fund = Returns::where('Project_id', '=', $project)
         ->where('type', '=', "funding")
         ->where('track', '=', 0)->get();

$dates = Returns::where('Project_id', '=', $project)
         ->where('type', '=', "funding")
         ->where('track', '=', 1)->first();

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
          $source = Funding::where('pid', '=', $project)
                              ->where('type', '=', "quarter")->get();

          if($source!=null){

            foreach($source as $s){

               $target = Returns::where('Project_id', '=', $project)
                     ->where('type', '=', "funding")
                     ->where('track', '=', 0)
                     ->where('target_date', '=', $j.'-'.$i)
                     ->where('fund_id', '=', $s->id)
                     ->first();

               if($target!=null){

                   $ret_id = $target->id;

                    $value = Target::where('Project_id', '=', $project)
                   ->where('return_id', '=', $ret_id)->first();

                    $val= $value->value;

                    $quarter = $j.'-'.$i;
                    if (array_key_exists($quarter,$targets))
                          {
                            $val+= $targets[$quarter];
                            
                            $targets[$quarter] = $val;

                          }
                        else
                          {
                            
                            $targets[$quarter] = $val;
                          }
                    
              
                  
               }
            }
          }
         

            
           

           

           

        }
        
      }
    }

        else if($record == "monthly"){
      for($i =$start_date; $i<=$end_date; $i++){
        for($j=1; $j<=12; $j++){
           $target = Returns::where('Project_id', '=', $project)
                     ->where('type', '=', "funding")
                     ->where('track', '=', 0)
                     ->where('target_date', '=', $i.'-'.$j)->first();

              
              $ret_id = $target->id;

              $value = Target::where('Project_id', '=', $project)
                     ->where('return_id', '=', $ret_id)->first();

              $val= $value->value;
              $quarter = $j.'-'.$i;
              
              $targets[$quarter] = $val;



        }
        
      }
    }
}    

//////////////////////////////////   Spending function() /////////////////////////////////////
///


$values = array();

$start_date1 = "";
$end_date1 = "";


 $total1 =0;


$spend = Returns::where('Project_id', '=', $project)
         ->where('type', '=', "spending")
         ->where('track', '=', 0)->get();

$dates1 = Returns::where('Project_id', '=', $project)
         ->where('type', '=', "spending")
         ->where('track', '=', 1)->first();

if($dates1!=null){

    $sdate = $dates1->start_date;
    $edate = $dates1->end_date;

    $arr1 = explode('-', $sdate);
    $arr2 = explode('-', $edate);

    $start_date1 = $arr1[0];
    $end_date1 = $arr2[0];

    $record = $dates1->record;

    if($record == "quarterly"){
      for($i =$start_date1; $i<=$end_date1; $i++){
        for($j=1; $j<=4; $j++){
          $target = Returns::where('Project_id', '=', $project)
                     ->where('type', '=', "spending")
                     ->where('track', '=', 0)
                     ->where('target_date', '=', $j.'-'.$i)->first();

            $ret_id = $target->id;

            $value = Target::where('Project_id', '=', $project)
                   ->where('return_id', '=', $ret_id)->first();

            $val= $value->value;
            $quarter = $j.'-'.$i;
              
              $values[$quarter] = $val;

        }
        
      }
    }

       else if($record == "monthly"){
      for($i =$start_date1; $i<=$end_date1; $i++){
        for($j=1; $j<=12; $j++){
          $target = Returns::where('Project_id', '=', $project)
                     ->where('type', '=', "spending")
                     ->where('track', '=', 0)
                     ->where('target_date', '=', $i.'-'.$j)->first();

            $ret_id = $target->id;

            $value = Target::where('Project_id', '=', $project)
                   ->where('return_id', '=', $ret_id)->first();

            $val= $value->value;
            $quarter = $j.'-'.$i;
              
              $values[$quarter] = $val;



        }
        
      }
    }
}

if(! empty($values))
{

setlocale(LC_MONETARY, 'en_GB.UTF-8');

$fin_array = array();


$chd1 = "";
$chd2 = "";
$chm = "";
$chf = "";

$numItems1 = count($targets);
$m = 0;

  
  $i = -1;
  foreach ($targets as $key => $value)
  {
    
    //if(exists($values[$key])){

    
    if($targets[$key] <= $values[$key]){

      $a = $targets[$key];
    $b = $values[$key];

    $diff = $b - $a;
    $avg = ($a + $b)/2;

    if($avg!=0)
    $per = ($diff/$avg)*100;
  else
    $per = 0;

    $marker = Marker::where('id', '=', '1')->first(); 


    $red = $marker->red;
    $pink = $marker->pink;
    $orange = $marker->orange;

//      
      if(++$m == $numItems1){
          if($per > 20){   ///Red

            $chm.= 'B,FF7D7D,0,'.($i).':'.($i + 1).',0|';
            $chm.= 'B,FF7D7D,1,'.($i).':'.($i + 1).',0';
            $chf='bg,s,FFCBCB';
            $proj->fundingStatus = 1;
            $proj->save();

          }else if($per >=11 && $per <=20){   //Pink

            $chm.= 'B,FFA4A4,0,'.($i).':'.($i + 1).',0|';
            $chm.= 'B,FFA4A4,1,'.($i).':'.($i + 1).',0';
            $chf='bg,s,FFE5E5';

          }else if($per >=0 && $per <11){   //Orange

            $chm.= 'B,FFC04C,0,'.($i).':'.($i + 1).',0|';
            $chm.= 'B,FFC04C,1,'.($i).':'.($i + 1).',0';
            $chf='bg,s,ffd993';
            $proj->fundingStatus = 3;
            $proj->save();

          }else{

            $chm.= 'B,000000,0,'.($i).':'.($i + 1).',0|';
            $chm.= 'B,000000,1,'.($i).':'.($i + 1).',0';
            $proj->fundingStatus = 5;
            $proj->save();

          }
          
        
      }else{
        if($per > 20){   ///Red

            $chm.= 'B,FF7D7D,0,'.($i).':'.($i + 1).',0|';
            $chm.= 'B,FF7D7D,1,'.($i).':'.($i + 1).',0|';

          }else if($per >11 && $per <=20){   //Pink

            $chm.= 'B,FFA4A4,0,'.($i).':'.($i + 1).',0|';
            $chm.= 'B,FFA4A4,1,'.($i).':'.($i + 1).',0|';

          }else if($per >=0 && $per <=11){   //Orange

            $chm.= 'B,FFC04C,0,'.($i).':'.($i + 1).',0|';
            $chm.= 'B,FFC04C,1,'.($i).':'.($i + 1).',0|';

          }else{
                echo $per."   ";
           // $chm.= 'B,000000,0,'.($i).':'.($i + 1).',0|';
          //  $chm.= 'B,000000,1,'.($i).':'.($i + 1).',0|';

          }
      }
      

    }else if($targets[$key] > $values[$key]){
        if(++$m == $numItems1){
        $chm.= 'B,6AB56A,1,'.($i).':'.($i + 1).',0|';
      $chm.= 'B,6AB56A,0,'.($i).':'.($i + 1).',0';
      $chf='bg,s,C3E1C3';
      $proj->fundingStatus = 5;
            $proj->save();
      }else{
        $chm.= 'B,6AB56A,1,'.($i).':'.($i + 1).',0|';
      $chm.= 'B,6AB56A,0,'.($i).':'.($i + 1).',0|';
      }

    }
  $i++;


}

$getmax = array();

 foreach($targets as $key => $value){
  $final_target[] = $value;  
  $getmax[] = $value;     
 }
 foreach($values as $key => $value){
  $final_spend[] = $value;  
  $getmax[] = $value;       
 }

if($getmax != null)
 $max_amount = max($getmax);
else
  $max_amount = '100';


$numItems = count($final_target);
$i = 0;
 foreach($final_target as $key => $value){
  
  if(++$i === $numItems) {
    $chd1 .= $value;
  } else{
    $chd1 .= $value.',';
  }
 }

$numItems1 = count($final_spend);
$j = 0;

    foreach($final_spend as $key => $value)
     {
         if(++$j === $numItems1) {
             $chd2 .= $value;
         } else{
             $chd2 .= $value.',';
         }
     }

$chd = $chd1.'|'.$chd2;


//Use the $scaleValues array to define my Y Axis 'buffer'
   $YScaleMax =$max_amount;
   $YScaleMin = 0;
  //compareArray($targets, $values);

   // $YScaleMax = round(max($scaleValues)) + 5;
   // $YScaleMin = round(min($scaleValues)) - 5;
    //Generate the number of weeks of the year for A Axis labels
    $tot_year = 0;
    for($i = $start_date; $i<=$end_date;$i++){
      $tot_year++;
    }
    $tot_quarters = $tot_year * 4;

    $graphSequence = generateSequence(1, $tot_quarters, "|");
    
    //Set the Google Image Chart API parameters
    $cht = 'lc';//Set the chart type
    $years ="";
    for($i = $start_date; $i<=$end_date;$i++){
      $years .= $i.'|';
    }
    $chxl = '1:|' . $graphSequence . '2:||3:|'.$years.'|4:|Fiscal Year and Quarter';
    //custom axis labels
    $chxp = '2,50|4,50';//Axis Label Positions
    $chxr = '0,' . $YScaleMin . ',' . $YScaleMax . '|1,1,52|3,1,12|5,' . $YScaleMin . ',' . $YScaleMax . '';//Axis Range
    $chxs = '0,252525,10,1,l,676767|1,252525,10,0,l,676767|2,03619d,13|4,03619d,13|5,252525,10,1,l,676767';//Axis Label Styles
    $chxtc = '0,5|1,5|5,5';//Axis Tick Mark Styles
    $chxt = 'y,x,y,x';//Visible Axes
    $chs = $width.'x'.$height;
   // $chs = '400x150';//Chart Size in px
    $chco = 'FF0000'.','.'76A4FB';//Series Colours
    $chds = '' . $YScaleMin . ',' . $YScaleMax . '';//Custom Scaling
    $chg = '-1,-1,1,5';//Grid lines
    $chls = '1|2';//line styles
    $chdl="FUNDING".'|'."SPENDING";
    $chfd = "0,x,0,".$tot_quarters.",0.1,sin(x)*50%2B50";
    
    //$chm = 'o,252525,0,-1,3';//Shape Markers
   // $chm='B,76A4FB,0,0:4,0';
    //Build the URL
    $googleUrl = 'http://chart.apis.google.com/chart?';
    $rawUrl = $googleUrl . 'cht=' . $cht . '&chxl=' . $chxl . '&chxp=' . $chxp . '&chxr=' . $chxr . '&chxs=' . 
    $chxs . '&chxtc=' . $chxtc . '&chxt=' . $chxt . '&chs=' . $chs . '&chco=' . $chco . '&chd=t:' . $chd . '&chds=' . 
    $chds . '&chg=' . $chg . '&chls=' . $chls . '&chm=' . $chm . '&chf=' . $chf ; //.'&chdl=' . $chdl

    $output = $rawUrl;
 return $output;
}
  }

function generateSequence($min, $max, $seperator = "")
{
    $output = '';
    for ($i = $min; $i <= $max; $i++)
    {
        $output .= $i . $seperator;
    }
    return $output;
}


function getkpitar($user,$kpi){

    $kpiarr =  array();
    $total_t1 = 0;
    $targetkpi = array();
    $check = 0;

    $quarter = 0;
    $month = date('m');
    if($month>=1 && $month <=3)
        $quarter = 1;
    else if($month>=4 && $month <=6)
        $quarter = 2;
    else if($month>=7 && $month <=9)
        $quarter = 3;
    else if($month>=10 && $month <=12)
        $quarter = 4;


    $year = date('Y');

    $allkpi = KPI::all();

    foreach($allkpi as $kn)
        array_push($kpiarr, $kn->id);

    if($user->programs()->count() !=0){

        foreach ($user->programs as $program11){
            foreach($program11->projects as $project11){

                foreach($project11->kpis as $k1){

                    if ($k1->id == $kpi) {

                        $targetx1 = array();
                        $arrdate = array();
                        $arr21 = array();



                        $check1 = Returns::where('user', '=', $user->id)
                                ->where('Project_id', '=', $project11->id)
                                ->where('type', '=', "targets")

                                ->where('track', '=', '1')

                                ->first();

                        $record = $check1->record;


                        $arr21 = getkpi($k1->id,$project11->id,"targets");


                        if($record == "quarterly"){



                            for($k=1;$k<=12;$k++)
                            {
                                if($quarter > 1)
                                {
                                    $quarter--;

                                }else if($quarter ==1)
                                {
                                    $quarter  = 12;
                                    $year--;
                                }

                                foreach($arr21 as $a11=> $value11){

                                    $arrdate = explode('-', $a11);


                                    $start_date = $arrdate[0];
                                    $start_year = $arrdate[1];

                                    if($start_date == $quarter && $start_year == $year){
                                        $targetx1[] = $value11;
                                    }

                                }
                            }

                        }
                        else  if($record == "monthly")
                        {

                            for($k=1;$k<=12;$k++)
                            {
                                if($quarter > 1)
                                {
                                    $quarter--;

                                }else if($quarter ==1)
                                {
                                    $quarter  = 12;
                                    $year--;
                                }

                                foreach($arr21 as $a11=> $value11){

                                    $arrdate = explode('-', $a11);


                                    $start_date = $arrdate[0];
                                    $start_year = $arrdate[1];

                                    if($start_date == $quarter && $start_year == $year){
                                        $targetx1[] = $value11;
                                    }

                                }
                            }


                        }



                        foreach($targetx1 as $key=> $value123)
                        {

                            if($value123 == -100  || $value123 < 0)
                                $value123  = 0;
                            $total_t1+= $value123;

                        }

                        $tar1 = 0;

                        if($k1->currency == 0){
                            $tar1 = number_format($total_t1);
                        }
                        else{
                            $tar1 = "£".$tar1;
                        }

                    }


                }
            }
        }

        return $tar1;
    }

}



 

function getkpival($user,$kpi){

  $kpiarr =  array();
   $total_t1 = 0;
  $targetkpi = array();

    $quarter = 0;
    $month = date('m');
    if($month>=1 && $month <=3)
        $quarter = 1;
    else if($month>=4 && $month <=6)
        $quarter = 2;
    else if($month>=7 && $month <=9)
        $quarter = 3;
    else if($month>=10 && $month <=12)
        $quarter = 4;

    $year = date('Y');

  
    $allkpi = KPI::all();

    foreach($allkpi as $kn)
      array_push($kpiarr, $kn->id);
    
    if($user->programs()->count() !=0){

      foreach ($user->programs as $program11){
        foreach($program11->projects as $project11){

              foreach($project11->kpis as $k1){

                  if ($k1->id == $kpi) {

                    $targetx1 = array();
                    $arrdate = array();
                    $arr21 = array();

                  

                     $check1 = Returns::where('user', '=', $user->id)
                             ->where('Project_id', '=', $project11->id)
                             ->where('type', '=', "targets")

                             ->where('track', '=', '1')

                             ->first();

                     $record = $check1->record;                     


                        $arr21 = getkpi($k1->id,$project11->id,"value");
                      if($record == "quarterly"){


                          for($k=1;$k<=4;$k++)
                          {
                              if($quarter > 1)
                              {
                                  $quarter--;

                              }else if($quarter ==1)
                              {
                                  $quarter  = 4;
                                  $year--;
                              }

                              foreach($arr21 as $a11=> $value11){

                                  $arrdate = explode('-', $a11);


                                  $start_date = $arrdate[0];
                                  $start_year = $arrdate[1];

                                  if($start_date == $quarter && $start_year == $year){
                                      $targetx1[] = $value11;
                                  }

                              }
                          }

                      }
                      else  if($record == "monthly")
                      {

                          for($k=1;$k<=12;$k++)
                          {
                              if($quarter > 1)
                              {
                                  $quarter--;

                              }else if($quarter ==1)
                              {
                                  $quarter  = 12;
                                  $year--;
                              }

                              foreach($arr21 as $a11=> $value11){

                                  $arrdate = explode('-', $a11);


                                  $start_date = $arrdate[0];
                                  $start_year = $arrdate[1];

                                  if($start_date == $quarter && $start_year == $year){
                                      $targetx1[] = $value11;
                                  }

                              }
                          }


                      }



                      foreach($targetx1 as $key=> $value123)
                      {

                          if($value123 == -100  || $value123 < 0)
                              $value123  = 0;
                          $total_t1+= $value123;

                      }

                      $tar1 = 0;

                      if($k1->currency == 0){
                          $tar1 = number_format($total_t1);
                      }
                      else{
                          $tar1 = "£".$tar1;
                      }

                  }


              }
        }
      }

        return $tar1;
    }

}


 function aggtarget($user){


  $kpiarr =  array();

  $targetkpi = array();
  
    $allkpi = KPI::all();

    foreach($allkpi as $kn)
      array_push($kpiarr, $kn->id);
    
  	if($user->programs()->count() !=0){

  		foreach ($user->programs as $program11){
        foreach($program11->projects as $project11){

              foreach($project11->kpis as $k1){

                  if (in_array($k1->id, $kpiarr)) {

                    $targetx1 = array();
                    $valuesx1 = array();


                         $arr21 = array();
                        $arr21 = getkpi($k1->id,$project11->id,"targets");                       
                        foreach($arr21 as $a11=> $value11){
                          $targetx1[] = $value11;
                       }
                       
                      $total_t1 = 0;

                        foreach($targetx1 as $key=> $value123)
                          {

                            if($value123 == -100  || $value123 < 0)
                              $value123  = 0;

                            $total_t1+= $value123;                            
                        
                          }                   
                                               
                        $tar1 = 0;                      

                        if($k1->currency == 0){
                          $tar1 = number_format($total_t1);                         
                        }
                        else{
                          $tar1 = "£".$tar1;                        
                        }

                  }

                    if(array_key_exists($k1->id,$targetkpi)){
                            $kvall = 0;
                            $kvall = $targetkpi[$k1->id];
                            $kvall+=$total_t1;
                            $targetkpi[$k1->id] = $kvall;
                          }else{
                          $targetkpi[$k1->id] = $total_t1;
                        }   
              }
        }
      }

return $targetkpi;
  	}
      
}

function aggvalues($user){


  $kpiarr =  array();
  $targetkpi = array();  
  $allkpi = KPI::all();

    foreach($allkpi as $kn)
      array_push($kpiarr, $kn->id);
    
  	if($user->programs()->count() !=0){

  		foreach ($user->programs as $program11){
        foreach($program11->projects as $project11){

              foreach($project11->kpis as $k1){

                  if (in_array($k1->id, $kpiarr)) {                    
                    $valuesx1 = array();
                    $arr21 = array();  
                        $arr22 = array();
                        $arr22=getkpi($k1->id,$project11->id,"value");
                        foreach($arr22 as $a22=> $value22){                          
                          $valuesx1[] = $value22;
                        }                     
                            
                        $total_t1 = 0;                       
                    
                        foreach($valuesx1 as $key=> $value123)
                          { 
                          	if($value123 == -100  || $value123 < 0)
                              $value123  = 0;
                            $total_t1+= $value123;

                          }                            
                        $tar1 = 0;                      

                        if($k1->currency == 0){
                          $tar1 = number_format($total_t1);                         
                        }
                        else{
                          $tar1 = "£".$tar1;                        
                        }

                  }

                    if(array_key_exists($k1->id,$targetkpi)){
                            $kvall = 0;
                            $kvall = $targetkpi[$k1->id];
                            $kvall+=$total_t1;
                            $targetkpi[$k1->id] = $kvall;
                          }else{
                          $targetkpi[$k1->id] = $total_t1;
                        }   
              }
        }
      }

return $targetkpi;
  	}
      
}






?>