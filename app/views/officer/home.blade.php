
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
{{ HTML::style('css/officer.css') }}


@include('./admin/charts')
<?php

if($user->programs()->count() !=0){
    $aggrkpi = array();
    $aggrkpi = aggtarget($user);

    $aggrkpi1 = array();
    $aggrkpi1 = aggvalues($user);
}
?>
<div class="wrap">
                                            {{--Header--}}
    <div class="header">
        <div class="header-text">
            Monitoring and Evaluation Dashboard
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
                {{ HTML::image('img/help.png','Home',  array('class' => 'back_btn1')) }}
            </a>

        </div>

        <div class="notifications">

            @if( OfficerArea::getDues('notify') > 0 )
                <a href="officer/dues" id="notify" class="notify-me">
                    <div class="notify notify-red"><span class="symbol icon-error">{{OfficerArea::getDues('notify')}}</span>
                        @if( OfficerArea::getDues('notify') > 1 )
                              new notifications!</div></a>
                        @else
                             new notification!</div></a>
                        @endif
                @else
                <div class="notify notify-green">
                    No new notifications</div>

            @endif

        </div>

        <div class="contents-main-body">
            <div class="dots-repeat">
                <span class="dots">
                    <?php
                    for($i=0; $i<100; $i++)
                        echo ".";
                    ?>
                </span>
            </div>


            <div class="kpis1">
                <?php $projects = array(); $projects = OfficerArea::getProjects(); ?>

                    <div class="officer-number-projects">
                        You are associated with <span class="officer-number-projects-count"> {{ sizeof($projects) }} </span> Projects.<br>
                    </div>

                    <div class="officer-projects">
                        <div class="bounding-box">
                        @foreach($projects as $key=>$value)
                            <?php $project = Project::where('id', '=', $value)->first(); 
                            $pstatus = OfficerArea::getProjectStatus($project->id); ?>
                                
                         <a href = " {{ URL::to('officer/projectLevel',array('pid' => $project->id)) }}" id="tab_login123">
                             @if($pstatus < 10)
                                <div class="projects-box red"> 
                             @elseif($pstatus >10 && $pstatus<70)
                                <div class="projects-box orange">     
                              @else    
                                <div class="projects-box green">  
                              @endif                      


                                 <?php
                                     $target = array();
                                     $values = array();
                                     $kk = array();
                                     $kpi = OfficerArea::getFirstKpi($value);
                                     $kpid = OfficerArea::getFirstKpid($value);
                                     $kk = OfficerArea::getkpi($kpid,$value,"targets");
                                     
                                     foreach($kk as $a=> $value2){
                                         $target[] = $value2;
                                     }
                                     $kk1 = OfficerArea::getkpi($kpid,$value,"value");
                                     foreach($kk1 as $a1=> $value1){
                                         $values[] = $value1;
                                     }
                                     $url = drawcharts($target,$values,$value,$kpid,220,100,false);
                                 ?>

                                 <div class="officer-kpi-img-wrapper">
                                         {{ HTML::image('/img/chart.png','Projects',  array('class' => 'proj_icon', 'id'=>'icon_'.$project->id)) }}                                
                                 </div>

                                 

                                  <div class="officer-project-name ">
                                        {{$project->name}} 
                                 </div>

                                </div>   
                            </a>                         
                        @endforeach
                         </div>

                    </div>




                <div id="dialog" title="Welcome to the Monitoring and Evaluation Dashboard">
                    <p>
                        The monitoring and evaluation software is underpinned by European Commission guidelines and UK government HM Treasury best practices in monitoring and evaluation.  It has been developed to be compatible with PRINCE2 methods, it also draws upon over 30 years of Tech4i2’s practical experience in undertaking monitoring and evaluation studies for all tiers of government throughout the world.
                        A key advantage of the software is the simplicity for users in using the dashboard to examine spending and outputs from the strategic level to the details concerning hundreds of individual projects in <i>‘three-clicks’</i>.

                    </p>
                </div>



            </div>





        <div class="dots-repeat12">
          <span class="dots2">
                 <?php
              for($i=0; $i<100; $i++)
                  echo ".";
              ?>
          </span>
        </div>
    </div>


    {{--Footer--}}

    <div class="footer">



    </div>
 </div>
</div>

<script>

    var dots = 0;
    var dots1 = 0;

    $(document).ready(function()
    {
        //setInterval (type, 150);
        //setInterval (type1, 150);
    });

    function type()
    {
        if(dots < 100)
        {
            $('.dots1').append('.');
            dots++;
        }
        else
        {
            $('.dots1').html('');
            dots = 0;
        }
    }

    function type1()
    {
        if(dots1 < 100)
        {
            $('.dots2').append('.');
            dots1++;
        }
        else
        {
            $('.dots2').html('');
            dots1 = 0;
        }
    }

    $(function() {
        $( "#dialog" ).dialog({
            autoOpen: false,
            show: {
                effect: "blind",
                duration: 1000
            },
            hide: {
                effect: "explode",
                duration: 1000
            }
        });

        $( "#info" ).click(function() {
            $( "#dialog" ).dialog( "open" );
        });
    });

    function Back(){
        window.history.back()
    }

    function Forward(){
        window.history.forward()
    }



</script>