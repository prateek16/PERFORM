<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
{{ HTML::script('js/popup.js') }}

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

@include('./admin/charts')

<div class="wrap">
    {{--Header--}}
    <div class="header">
        <div class="header-text">
            {{ AdminArea::getProjectName($id) }} 
        </div>


        <div class="header-nav">
            <div class="header-admin-role">You are Logged in as:<br/>
                <div class="header-admin-role-text">
                    {{$user->firstName}} {{$user->lastName}}<br/>
                    {{AdminArea::getLevel()}}
                </div>
            </div>
            <a href = "{{ URL::to('logout') }}" class="header-logout"> Log out </a>
        </div>
    </div>

    {{--Main Body--}}

    <div class="contents">
        <div class="contents-three-buttons">
            {{ HTML::image('img/left1.png','Back',  array('class' => 'back_btn1', 'onclick' => 'Back()')) }}
            <a href=" {{ URL::to('admin') }}"  class="tab_login_1 navbut">
                {{ HTML::image('img/home1.png','Home',  array('class' => 'back_btn1')) }}
            </a>
            <a href="#" class="tab_login_1 navbut" id="info">
                {{ HTML::image('img/right1.png','Forward',  array('class' => 'back_btn1', 'onclick' => 'Forward()')) }}
            </a>

            <a href="#" class="tab_login_1 navbut toggle-settings" id="settings">
                {{ HTML::image('img/settings.png','Settings',  array('class' => 'back_btn1')) }}
            </a>

        </div>

        <div class="project-level-risks">

            <?php
            $project = Project::where('id', '=', $id)->first();
            $pr = $project->pr; $mr = $project->mr; $ir = $project->ir; ?>

            {{--Project Risk--}}

            @if($pr >= 1 && $pr <4)
                <div class="project-area-green-prisk" style="width: 30%;top: -15px;left: 0;">
                    <div class="project-area-risk-text">Project Risk </div>
                    <div class="circle_green"><span class="circle_text1">{{$pr}}</span></div>
                </div>
            @else
                @if($pr > 3 && $pr < 7)
                    <div class="project-area-orange-prisk" style="width: 30%;top: -15px;left: 0;">
                        <div class="project-area-risk-text">Project Risk </div>
                        <div class="circle_orange"><span class="circle_text1">{{$pr}}</span></div>
                    </div>
                @else
                    <div class="project-area-red-prisk" style="width: 30%;top: -15px;left: 0;">
                        <div class="project-area-risk-text">Project Risk </div>
                        <div class="circle_red"><span class="circle_text1">{{$pr}}</span></div>
                    </div>
                @endif
            @endif

            {{--Management Risk--}}

            @if($mr >= 1 && $mr <4)
                <div class="project-area-green-mrisk" style="width: 36%;top: -14px;left: 10px;">
                    <div class="project-area-risk-text">Management Risk </div>
                    <div class="circle_green"><span class="circle_text1">{{$mr}}</span></div>
                </div>
            @else
                @if($mr > 3 && $mr < 7)
                    <div class="project-area-orange-mrisk" style="width: 36%;top: -14px;left: 10px;">
                        <div class="project-area-risk-text">Management Risk </div>
                        <div class="circle_orange"><span class="circle_text1">{{$mr}}</span></div>
                    </div>
                @else
                    <div class="project-area-red-mrisk" style="width: 36%;top: -14px;left: 10px;">
                        <div class="project-area-risk-text">Management Risk </div>
                        <div class="circle_red"><span class="circle_text1">{{$mr}}</span></div>
                    </div>
                @endif
            @endif

            {{--Impact--}}

            @if($ir >= 1 && $ir <4)
                <div class="project-area-green-irisk" style="width: 28%;top: -14px;left: 22px;">
                    <div class="project-area-risk-text">Impact </div>
                    <div class="circle_green"><span class="circle_text1">{{$ir}}</span></div>
                </div>
            @else
                @if($ir > 3 && $ir < 7)
                    <div class="project-area-orange-irisk" style="width: 28%;top: -14px;left: 22px;">
                        <div class="project-area-risk-text">Impact </div>
                        <div class="circle_orange"><span class="circle_text1">{{$ir}}</span></div>
                    </div>
                @else
                    <div class="project-area-red-irisk" style="width: 28%;top: -14px;left: 22px;">
                        <div class="project-area-risk-text">Impact </div>
                        <div class="circle_red"><span class="circle_text1">{{$ir}}</span></div>
                    </div>
                @endif
            @endif

        </div>


        <div class="dots-repeat" style="width: 85%; left: 6%; top: 26px;">
            <span class="dots">
                <?php
                    for($i=0; $i<100; $i++)
                        echo ".";
                    ?>
            </span>
        </div>

         <div class="staging-area">
                     <!-- Left Wrapper -->

            <div class="staging-left-wrapper">                               
                <div class="project-overview">
                    <div class="project-overview-header">
                              <span class="project-overview-text">  Project Overview  </span>
                              <div class="project-overview-body"> {{ $project->description }} </div>

                    </div>
                        
                </div>

                 <div class="project-members project-overview">
                    <div class="project-members-header project-overview-header">
                              <span class="project-overview-text project-members-text">  Project Members  </span>
                    </div>

                

                        <table class="tg_details1">
                            <th>Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Phone</th>
                             @foreach($project->users as $member)
                              <?php $level = Role::where('level', '=', $member->level)->first(); ?>
                               <tr>
                                  <td>{{$member->firstName}} {{$member->lastName}}</td>
                                  <td>{{$level->role}}</td>
                                  <td>{{ HTML::mailto($member->email)}}</td>
                                  <td>{{$member->contact}}</td>
                                </tr>
                            @endforeach
                        </table>






                        
                </div>

                <div class="project-issues project-overview" style="width: 195%; top: 15px;" >
                    <div class="project-issues-header project-overview-header">
                              <span class="project-overview-text project-issues-text">  Issues  </span>
                    </div>
                    <?php $issues = Issues::where('project_id', '=', $project->id)->get(); ?>

                        <table class="tg_details1" style="font-size: 12px;">
                            <th width="50%">Issue</th>
                            <th>Received</th>
                            <th>Owner</th>
                            <th>Resolved</th>
                             @foreach($issues as $issue)                              
                               <tr>
                                  <td style="padding: 3px 71px;">{{$issue->issue}} </td>
                                  <td style="padding: 3px 71px;">{{$issue->received}}</td>
                                  <td style="padding: 3px 71px;">{{ $issue->owner}}</td>
                                  <td style="padding: 3px 71px;">{{$issue->resolved}}</td>
                                </tr>
                            @endforeach
                        </table>
                        
                </div>
            </div>

                            <!-- Right Wrapper -->
            <div class="staging-right-wrapper">
                <div class="staging-funding-spending">
                    <?php $fstatus = AdminArea::getFundingStatus($id);  $img = aggfunding($id,450,250);?>

                    @if($fstatus == 1)
                        <div class="staging-funding-spending-header funding-red">
                             <span class="project-overview-text project-issues-text funding-text">  Funding vs Spending  </span>
                        </div>
                    @elseif($fstatus == 3)
                        <div class="staging-funding-spending-header funding-orange">
                             <span class="project-overview-text project-issues-text funding-text">  Funding vs Spending  </span>
                        </div>
                    @elseif($fstatus == 5)
                        <div class="staging-funding-spending-header funding-green">
                            <span class="project-overview-text project-issues-text funding-text">  Funding vs Spending  </span>
                        </div>
                    @elseif($fstatus == 0)
                        <div class="staging-funding-spending-header funding-grey">
                            <span class="project-overview-text project-issues-text funding-text">  Funding vs Spending  </span>
                        </div>
                    @endif

                    <div class="staging-funding-spending-image">
                         {{ HTML::image($img,'Funding',  array('class' => 'staging-funding-img')) }}       
                    </div>

                    <div class="staging-funding-spending-data">
                         @if($fstatus == 1)
                        <div class="staging-funding-data funding-red">
                             <span class="staging-funding-data-text"> Funding </span>
                             <span class="staging-funding-data-text1"> £{{ number_format(totalfunds($id), 2) }}m  </span>                           
                        </div>
                        <div class="staging-spending-data funding-red">
                             <span class="staging-funding-data-text"> Spending </span>
                             <span class="staging-funding-data-text1"> £{{ number_format(totalspend($id), 2) }}m  </span>
                        </div>
                        @elseif($fstatus == 3)
                            <div class="staging-funding-data funding-orange">
                                <span class="staging-funding-data-text"> Funding </span>
                                <span class="staging-funding-data-text1"> £{{ number_format(totalfunds($id), 2) }}m  </span>
                            </div>
                             <div class="staging-spending-data funding-orange">
                                <span class="staging-funding-data-text"> Spending </span>
                                <span class="staging-funding-data-text1"> £{{ number_format(totalspend($id), 2) }}m  </span>
                            </div>
                        @elseif($fstatus == 5)
                            <div class="staging-funding-data funding-green">
                                 <span class="staging-funding-data-text"> Funding </span>
                                <span class="staging-funding-data-text1"> £{{ number_format(totalfunds($id), 2) }}m  </span>
                            </div>
                            <div class="staging-spending-data funding-green">
                                <span class="staging-funding-data-text"> Spending </span>
                                <span class="staging-funding-data-text1"> £{{ number_format(totalspend($id), 2) }}m  </span>
                            </div>
                        @elseif($fstatus == 0)
                            <div class="staging-funding-data funding-grey">
                                <span class="staging-funding-data-text"> Funding </span>
                                <span class="staging-funding-data-text1"> £{{ number_format(totalfunds($id), 2) }}m  </span>
                            </div>
                            <div class="staging-spending-datafunding-grey">
                                <span class="staging-funding-data-text"> Spending </span>
                                <span class="staging-funding-data-text1"> £{{ number_format(totalspend($id), 2) }}m  </span>
                            </div>
                        @endif                       

                     </div>
                     <?php 
                        $checkFunding = Funding::where('pid', '=', $id)->get(); 
                        if($checkFunding->count() > 1 ){ 
                     ?>
                     
                     @if($fstatus == 1)   
                         <div class="staging-funding-all funding-red">
                            <span style="top: 3px;position: relative;">  Click here to see all the different Funding Sources </span>
                         </div>
                     @elseif($fstatus == 3)
                         <div class="staging-funding-all funding-orange">
                             <span style="top: 3px;position: relative;">  Click here to see all the different Funding Sources </span>
                         </div>
                     @elseif($fstatus == 5)
                         <div class="staging-funding-all funding-green">
                             <span style="top: 3px;position: relative;">  Click here to see all the different Funding Sources </span>
                         </div>
                    @elseif($fstatus == 0)
                         <div class="staging-funding-all funding-grey">
                            <span style="top: 3px;position: relative;">  Click here to see all the different Funding Sources </span>
                         </div>
                    @endif

                    <?php } ?>


                </div>
            </div>

            <div class="staging-kpi-wrapper">
                @foreach($project->kpis as $kpi)
                  <?php $status = AdminArea::getKpiStatus($kpi->id,$project->id);                   
                  ?>

                   <?php
                   
                                                           
                                                            $targetsx = array();
                                                            $valuesx = array();
                                                           

                                                            $arr2 = array();
                                                            $arr2 = getkpi($kpi->id,$project->id,"targets");

                                                            foreach($arr2 as $a=> $value){

                                                                $targetsx[] = $value;
                                                            }

                                                            $arr = array();
                                                            $arr=getkpi($kpi->id,$project->id,"value");
                                                            foreach($arr as $a=> $value){
                                                                //echo"ok";
                                                                $valuesx[] = $value;
                                                            }


                                                            $total_t = 0;
                                                            $total_a = 0;
                                                            foreach($targetsx as $key=> $value)
                                                            {
                                                                if($value == -100 || $value < 0)
                                                                    $value  = 0;
                                                                $total_t+= $value;
                                                            }

                                                            foreach($valuesx as $v=> $va)
                                                            {
                                                                if($va == -100 || $va < 0)
                                                                    $va  = 0;
                                                                $total_a+= $va;
                                                            }

                                                            $tar = 0;
                                                            $ach = 0;
                                                            if($kpi->currency == 0){
                                                                $tar = number_format($total_t);
                                                                $ach = number_format($total_a);
                                                            }
                                                            else{
                                                                $tar = "£".$tar;
                                                                $ach = "£".$ach;
                                                            }
                        $url1 = drawcharts($targetsx,$valuesx,$project->id,$kpi->id,450,250,true);
                    ?>
    
                   <div class="staging-kpi-blocks">


                     @if($status == 1)
                        <div class="staging-kpi-header funding-red">
                             <span class="project-overview-text project-issues-text funding-text">  {{$kpi->name }} </span>
                        </div>
                    @elseif($status == 3)
                        <div class="staging-kpi-header funding-orange">
                             <span class="project-overview-text project-issues-text funding-text">  {{$kpi->name }}  </span>
                        </div>
                    @elseif($status == 5)
                        <div class="staging-kpi-header funding-green">
                            <span class="project-overview-text project-issues-text funding-text">  {{$kpi->name }}  </span>
                        </div>
                    @elseif($status == 0)
                        <div class="staging-kpi-header funding-grey">
                            <span class="project-overview-text project-issues-text funding-text">  {{$kpi->name }}  </span>
                        </div>
                    @endif 

                     <div class="staging-kpi-image">
                         {{ HTML::image($url1,'Funding',  array('class' => 'staging-funding-img')) }}       
                    </div> 

                       <div class="staging-funding-spending-data">
                         @if($status == 1)
                        <div class="staging-funding-data funding-red">
                             <span class="staging-funding-data-text"> Target </span>
                             <span class="staging-funding-data-text1"> {{$tar}}  </span>                           
                        </div>
                        <div class="staging-spending-data funding-red">
                             <span class="staging-funding-data-text"> Achieved </span>
                             <span class="staging-funding-data-text1"> {{$ach}}  </span>
                        </div>
                        @elseif($status == 3)
                            <div class="staging-funding-data funding-orange">
                                <span class="staging-funding-data-text"> Target </span>
                                <span class="staging-funding-data-text1"> {{$tar}}   </span>
                            </div>
                             <div class="staging-spending-data funding-orange">
                                <span class="staging-funding-data-text"> Achieved </span>
                                <span class="staging-funding-data-text1"> {{$ach}}   </span>
                            </div>
                        @elseif($status == 5)
                            <div class="staging-funding-data funding-green">
                                 <span class="staging-funding-data-text"> Target </span>
                                <span class="staging-funding-data-text1"> {{$tar}}  </span>
                            </div>
                            <div class="staging-spending-data funding-green">
                                <span class="staging-funding-data-text"> Achieved </span>
                                <span class="staging-funding-data-text1"> {{$ach}}  </span>
                            </div>
                        @elseif($status == 0)
                            <div class="staging-funding-data funding-grey">
                                <span class="staging-funding-data-text"> Target </span>
                                <span class="staging-funding-data-text1"> {{$tar}}  </span>
                            </div>
                            <div class="staging-spending-datafunding-grey">
                                <span class="staging-funding-data-text"> Achieved </span>
                                <span class="staging-funding-data-text1"> {{$ach}}  </span>
                            </div>
                        @endif                       

                     </div>


                        
                    </div>   

                @endforeach

            </div>
                
    </div>



    </div>


</div>

{{ HTML::script('js/programLevel.js') }}