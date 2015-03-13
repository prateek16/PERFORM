
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
{{ HTML::script('js/popup.js') }}
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

@include('./admin/charts')

<div id="backgroundPopup"></div>

<div class="wrap">
    {{--Header--}}
    <div class="header">
        <div class="header-text">
            Programme Level Dashboard
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

        <div class="setting-nav" style="display: none;">
            <center>

            <a href="{{ URL::to('admin/newProgram') }}" class="add_programme_nav "><span class="text-cirlce1">Add a <br/>Programme</span></a>
            {{--<a href="{{ URL::to('') }}" class="change_logo_nav "><span class="text-cirlce1">Change<br>Your <br/>Logo</span></a>--}}
            <a href="{{ URL::to('admin/changePassword') }}" class="change_pass_nav "><span class="text-cirlce1">Change<br>Your <br/>Password</span></a>
            <a href="{{ URL::to('') }}" class="help_nav "><span class="text-cirlce1">Help</span></a>
            <a href="#" class="about_nav " id="about"><span class="text-cirlce1">About</span></a>
           </center>

        </div>

        <div class="notifications1">   <!-- Total Programmes  here -->

            <div class="notify notify-green">
               Total Programmes <span class="symbol1">{{AdminArea::getTotalProgrammes()}}</span>
            </div>

         </div>   <!-- Total Programmes -->


        <div class="notifications">   <!-- notifications starts here -->

                    @if( AdminArea::getNotifications() > 0 )
                        <a href="#" id="notify" class="notify-me">
                            <div class="notify notify-red"><span class="symbol icon-error">{{AdminArea::getNotifications()}}</span>
                                @if( AdminArea::getNotifications() > 1 )
                                    new notifications!</div></a>
                    @else
                        new notification!</div></a>
                    @endif
                    @else
                        <div class="notify notify-green">
                            No new notifications</div>

                    @endif

        </div>   <!-- notifications ends here -->


        <div id="dialog-box" title="Welcome to the Monitoring and Evaluation Dashboard">
            <p>
                The monitoring and evaluation software is underpinned by European Commission guidelines and UK government HM Treasury best practices in monitoring and evaluation.  It has been developed to be compatible with PRINCE2 methods, it also draws upon over 30 years of Tech4i2’s practical experience in undertaking monitoring and evaluation studies for all tiers of government throughout the world.
                A key advantage of the software is the simplicity for users in using the dashboard to examine spending and outputs from the strategic level to the details concerning hundreds of individual projects in <i>‘three-clicks’</i>.

            </p>
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

            {{--<input type = "text" id = "prid" value = "{{$project}}" style="display :none"/>--}}
            {{--<input type = "text" id = "retid" value = "{{$ret_id}}" style="display :none"/>--}}
            <input type = "text" id = "usrid" value = "{{$user->id}}" style="display :none"/>
                            {{--Main Body Starts Here--}}


            <div class="exists" style="display: block">
                <div class = "pr_names1">
                    @if($user->programs()->count() == 0 )
                        <div id ="no_project" class = "no_project">
            <span class="no_pr">You do not have any Programme in your Database.<br/>
            Start by creating a new one now.....</span>
                        </div>
                    @else
                        @foreach ($user->programs as $program)
                            @if($program !=null)
                                @foreach($program->projects as $project1)
                                    {{ ProgramLevel::incrementTotalProjects() }}
                                    {{ ProgramLevel::incrementTotalFunds($project1->id) }}
                                @endforeach

                                <div class="program_wrapper">

                                    <div id="dialog-box-program" title="Program Overview">
                                        <p>
                                            {{$program->description}}

                                        </p>
                                    </div>

                                    <div class="program_name">
                                        {{ HTML::image('/img/files.png','files',  array('class' => 'prog_icon')) }}
                                        <div class="program-name-wrapper">
                                            <span class="prog_name">{{$program->name}} </span>

                                            {{--<a href="#" class="tab_login_1 navbut" id="info_program">--}}
                                                {{--{{ HTML::image('img/help.png','Home',  array('class' => 'back_btn2')) }}--}}
                                            {{--</a>--}}

                                            <div class="prog_infos">
                                                <span class="tot_prog_proj"> Total Projects:
                                                    <span class="total-project-count">{{$program->projects()->count()}} </span>
                                                </span>
                                                <span class="tot_prog_funding"> Total Funding:
                                                   <span class="total-funding-count"> £{{ProgramLevel::getTotalFunds()}}m </span>
                                                </span>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="program_edit" style="position: relative;">
                                        <a href = " {{ URL::to('admin/addProject',array('id' => $program->id )) }}" >
                                            <div class="edit_home_btn1" id="edit_{{$program->id}}" >
                                                Add a project
                                            </div>
                                        </a>

                                        {{--<a class="delete_pr" target="{{$program->id}}">--}}
                                            {{--<div class="edit_home_btn1 edit_home_btn2 " id="edit_{{$program->id}}" >--}}
                                                {{--Remove Programme--}}
                                            {{--</div>--}}
                                        {{--</a>--}}
                                    </div>

                                    @if($user->programs()->count() == 1)
                                      @if($user->projects->count() == 0)
                                         <div class="greet_user">
                                                You just created a new Programme....Now add projects to it by clicking on the "Add a Project" Button.
                                         </div>
                                      @endif
                                    @endif


                                    @foreach ($program->projects as $project)
                                        @if($project->count() !=0)


                                            <div class="project-area-desc" id="project_{{$project->id}}">
                                            <div class="project-area-pname">
                                                <a href = " {{ URL::to('admin/projectLevel',array('pid' => $project->id)) }}" id="tab_login123">
                                                    <div class="project_icon">
                                                         {{ HTML::image('/img/chart.png','Projects',  array('class' => 'proj_icon', 'id'=>'icon_'.$project->id)) }}
                                                     </div>

                                                    <div class="project_headline" id='project_headline_{{$project->id}}'>  {{ $project->name  }}  </div>
                                                </a>
                                            </div>

                                            <?php $pr = $project->pr; $mr = $project->mr; $ir = $project->ir; ?>

                                                                 {{--Project Risk--}}

                                            @if($pr >= 1 && $pr <4)
                                                <div class="project-area-green-prisk">
                                                    <div class="project-area-risk-text">Project Risk </div>
                                                    <div class="circle_green"><span class="circle_text1">{{$pr}}</span></div>
                                                </div>
                                                @else
                                                @if($pr > 3 && $pr < 7)
                                                    <div class="project-area-orange-prisk">
                                                        <div class="project-area-risk-text">Project Risk </div>
                                                        <div class="circle_orange"><span class="circle_text1">{{$pr}}</span></div>
                                                    </div>
                                                    @else
                                                    <div class="project-area-red-prisk">
                                                        <div class="project-area-risk-text">Project Risk </div>
                                                        <div class="circle_red"><span class="circle_text1">{{$pr}}</span></div>
                                                    </div>
                                                @endif
                                            @endif

                                                    {{--Management Risk--}}

                                            @if($mr >= 1 && $mr <4)
                                                <div class="project-area-green-mrisk">
                                                    <div class="project-area-risk-text">Management Risk </div>
                                                    <div class="circle_green"><span class="circle_text1">{{$mr}}</span></div>
                                                </div>
                                            @else
                                                @if($mr > 3 && $mr < 7)
                                                    <div class="project-area-orange-mrisk">
                                                        <div class="project-area-risk-text">Management Risk </div>
                                                        <div class="circle_orange"><span class="circle_text1">{{$mr}}</span></div>
                                                    </div>
                                                @else
                                                    <div class="project-area-red-mrisk">
                                                        <div class="project-area-risk-text">Management Risk </div>
                                                        <div class="circle_red"><span class="circle_text1">{{$mr}}</span></div>
                                                    </div>
                                                @endif
                                            @endif

                                                        {{--Impact--}}

                                            @if($ir >= 1 && $ir <4)
                                                <div class="project-area-green-irisk">
                                                    <div class="project-area-risk-text">Impact </div>
                                                    <div class="circle_green"><span class="circle_text1">{{$ir}}</span></div>
                                                </div>
                                            @else
                                                @if($ir > 3 && $ir < 7)
                                                    <div class="project-area-orange-irisk">
                                                        <div class="project-area-risk-text">Impact </div>
                                                        <div class="circle_orange"><span class="circle_text1">{{$ir}}</span></div>
                                                    </div>
                                                @else
                                                    <div class="project-area-red-irisk">
                                                        <div class="project-area-risk-text">Impact </div>
                                                        <div class="circle_red"><span class="circle_text1">{{$ir}}</span></div>
                                                    </div>
                                                @endif
                                            @endif

                                            <div class="project-area-edit">
                                                <div class="project-area-kpi-count">
                                                Total KPIs  <div class="circle_kpi"><span class="circle_text1">{{ $project->kpis()->count() }}</span></div>
                                                </div>

                                                 <a class="showSingle1" target="{{$project->id}}">
                                                <div class="project-area-edit-btn" id="edit_{{$project->id}}"> Edit
                                                </div>
                                             </a>

                                            </div>



                                            {{--End of Top Headers--}}


                                            <div id="summary_{{$project->id}}" class="targetDiv" style="display:block">
                                                <?php if($project->kpis()->count() > 2){ ?>

                                                <?php  } ?>
                                                <?php
                                                $img = aggfunding($project->id,310,180);
                                                $img1 = aggfunding($project->id,600,500);
                                                ?>

                                                <div class="funding_spending_lc">
                                                    <center>
                                                        <div class="funding_wrapper">
                                                            <span class="fund_spend_head"> Funding vs Spending </span>
                                                            <div class="chart_wrapper">
                                                                <a href="#" class="popup" id="pr_{{$project->id}}">
                                                                    <input type="text" value="{{$img1}}" style="display:none" id="input_pr_{{$project->id}}"/>
                                                                    <input type="text" value="Funding Vs Spending" style="display:none" id="kpi_pr_{{$project->id}}"/>
                                                                    <img src = "{{$img}}"  class="img_charts_def1" style="margin-bottom: 10px;" />

                                                                </a>

                                                                <div class="chart_info">
                                                                    <div class="chart_info1">
                                                                        <span class="chart_info_t">Funding</span>  <br/>
                                                                        <span class="chart_info_t1">£{{ number_format(totalfunds($project->id), 2) }}m</span>
                                                                    </div>
                                                                    <div class="chart_info2">
                                                                        <span class="chart_info_t"> Spending  </span> <br/>
                                                                        <span class="chart_info_t1">£{{ number_format(totalspend($project->id), 2) }}m</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </center>
                                                    {{--<div class="total_funding_source">--}}
                                                            {{--<span class="total_source_text">Total Sources:<span><br/>--}}
                                                                {{--<center>--}}
                                                                    {{--<span class="total_source_text1">{{totalfundsource($project->id)}}</span>--}}
                                                                {{--</center>--}}
                                                    {{--</div>--}}
                                                </div>

                                                <div  class="kpi_display"  id="kpi_display_{{$project->id}}">
                                                    <a href="#" class="bx-prev1" id="{{$project->id}}"> <div class="bx-prev"> </div></a>
                                                    <a href="#" class="bx-next1" id="{{$project->id}}">  <div class="bx-next"> </div></a>
                                                    <div class="kpi_scroller scroller_{{$project->kpis()->count()}}" id="kpi_scroller_{{$project->id}}">
                                                        <input type="text" class="kpi_scroller_{{$project->id}}" id="{{$project->kpis()->count()}}" style="display:none" disabled/>


                                                        <div class="kpis_lc">
                                                            <?php
                                                            $ch = 0;
                                                            $change = "";
                                                            $pr = Project::where('id', '=', $project->id)->get();
                                                            foreach($pr as $p){
                                                            foreach($p->kpis as $k){

                                                            $count = count($p->kpis);
                                                            $targetsx = array();
                                                            $valuesx = array();
                                                            if($count > 3)
                                                                $limit = ($count + 3) - $count;
                                                            else
                                                                $limit = $count;

                                                            $arr2 = array();
                                                            $arr2 = getkpi($k->id,$project->id,"targets");

                                                            foreach($arr2 as $a=> $value){

                                                                $targetsx[] = $value;
                                                            }

                                                            $arr = array();
                                                            $arr=getkpi($k->id,$project->id,"value");
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
                                                            if($k->currency == 0){
                                                                $tar = number_format($total_t);
                                                                $ach = number_format($total_a);
                                                            }
                                                            else{
                                                                $tar = "£".$tar;
                                                                $ach = "£".$ach;
                                                            }
                                                            ?>

                                                            <!--    <a href = " {{ URL::to('/dashboard2',array('pid' => $project->id)) }}" id="tab_login123"> -->
                                                            <?php

                                                            if($ch == $limit)
                                                                break;
                                                            else
                                                                $url = drawcharts($targetsx,$valuesx,$project->id,$k->id,300,180,false);
                                                            $url1 = drawcharts($targetsx,$valuesx,$project->id,$k->id,600,500,true);
                                                            $ch++;
                                                            $asd = "";
                                                            foreach($targetsx as $key=>$value)
                                                                $asd .= $value;
                                                            if($ch %2 == 0)
                                                                $change = 1;
                                                            else
                                                                $change = 2;
                                                            ?>

                                                            <a href="#" class="popup" id="pr_{{$project->id}}_{{$ch}}">
                                                                <input type="text" value="{{$url1}}" style="display:none" id="input_pr_{{$project->id}}_{{$ch}}"/>
                                                                <input type="text" value="{{$k->name}}" style="display:none" id="kpi_pr_{{$project->id}}_{{$ch}}"/>
                                                                <div class="kpi_names_lc_{{$change}} kpis-inline">
                                                                    <center>
                                                                                 <span class="kpi_names_lc_t">
                                                                                         <?php  $string =  $k->name ; ?>
                                                                                     {{ substr($string, 0, 31);  }} <?php if(strlen($string) >32){ echo ".....";} ?>
                                                                                 </span>
                                                                    </center>
                                                                    <img src = "{{$url}}"  class="img_charts_def"  />
                                                                    <br/>
                                                            </a>
                                                            <div class="chart_info_kpi">
                                                                <div class="chart_info1">
                                                                    <center>
                                                                        <span class="chart_info_tt">Target</span>  <br/>
                                                                        <span class="chart_info_t10">{{ $tar }}</span>
                                                                </div>
                                                                </center>
                                                                <div class="chart_info2">
                                                                    <center>
                                                                        <span class="chart_info_tt"> Achieved  </span> <br/>
                                                                        <span class="chart_info_t10"> {{ $ach }} </span>
                                                                    </center>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>   <!-- kpis_lc ends here -->
                                            </div>




                                        </div>


                                </div>    <!-- Program Wrapper Ends Here -->

                                   

                                     


                                    <div id="div_{{$project->id}}" class="targetDiv1" style="display:none; position: relative;
                                        margin-top: -137px;
                                        top: -74px;">
                                        <input type="text" value="{{$project->id}}" id="pid_{{ $project->id }}" style="display:none"/>

                                        <div class="setting-nav" >
                                            <center>                                    

                                                <a href="#" class="add_programme_nav " id="{{$project->id}}" ><span class="text-cirlce1">Rename <br/>Project</span></a>

                                                <a href="#" class="raise_an_issue" id="{{$project->id}}"><span class="text-cirlce1">Raise<br> an <br/>Issue</span></a>

                                                <a href = " {{ URL::to('admin/projectLevel',array('pid' => $project->id)) }}"  class="about_nav" id="tab_login123" ><span class="text-cirlce1">View</span></a>

                                            </center>

                                        </div>

                                    </div>

                                    <div id="rename_{{$project->id}}" class="rename-project-area" style="display:none; position: relative;
                                            margin-top: -104px;
                                            top: -63px;                                            
                                            width: 50%;
                                            height: 100px;
                                            left: 25%;">

                                            <div class='rename-project-header'>
                                                <div class='rename-project-header-title'> Rename Your Project </div>
                                                <div class='rename-project-input' style='position:relative; top: 10px;'>
                                                    <input type='text' class='rename-project-name' id='rename_project_{{$project->id }}' maxlength="50"/> 
                                                    <a href='#' class='rename-submit' id='{{ $project->id }}'> Save </a>

                                                </div>
                                            </div>
                                     </div>

                                    <div id="issue_{{$project->id}}" class="issue-project-area" style="display:none; position: relative;
                                    margin-top: -100px;
                                    top: -147px;
                                    width: 50%;
                                    height: 100px;
                                    /* margin: auto; */
                                    left: 37%;">

                                         


                                            <div class="error_back">
                                                <ul>
                                                    @foreach($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                        <table class="tg">
                                            <tr>
                                                <td class="tg-s6z2 form-elements">{{ Form::label('Issue', 'Issue') }}</td>
                                                <td class="tg-031e form-elements">{{ Form::text('issue', null, array('class'=>'input-block-level boxStyler issue_name_'.$project->id, 'placeholder'=>'Issue')) }}<br/></td>
                                            </tr>
                                            <tr>
                                                <td class="tg-s6z2 form-elements">{{ Form::label('Received', 'Received') }}</td>
                                                <td class="tg-031e form-elements">{{ Form::text('received', null, array('class'=>'input-block-level boxStyler received_issue_'.$project->id,'id'=>'datepicker1' ,'placeholder'=>'(MM-DD-YYYY)')) }}<br/></td>
                                            </tr>
                                            <tr>
                                                <td class="tg-s6z2 form-elements">{{ Form::label('Owner', 'Owner') }}</td>
                                                                                       
                                                    <td class="tg-031e form-elements ">

                                                        <select id="issue_owner_{{$project->id}}">
                                                            @foreach($project->users as $member)
                                                             <option value="{{$member->email}}">{{$member->firstName}} {{$member->lastName}}</option>
                                                             @endforeach

                                                        </select>

                                                        <br/></td>

      
                                            </tr>
                                            <tr>
                                                <td class="tg-s6z2 form-elements">{{ Form::label('Resolved', 'Resolved') }}</td>
                                                <td class="tg-031e form-elements">{{ Form::text('resolved', null, array('class'=>'input-block-level boxStyler resolved_issue_'.$project->id,'id'=>'datepicker2', 'placeholder'=>'(MM-DD-YYYY)')) }}<br/></td>
                                            </tr>                                           

                                          
                                            <tr>
                                                <td class="tg-s6z2 form-elements button-elem" colspan=2 >{{ Form::submit('Submit', array('class'=>'btn btn-large btn-primary btn-block buttonStyler submit_issues', 'id'=>$project->id))}}</td>

                                            </tr>
                                        </table>


                                        {{ Form::close() }}


                                   



                                    </div>




                            @endif
                        @endforeach




                </div>
                @endif
                @endforeach
                @endif
             </div>
            </div>





        <center>
            <?php if($user->projects()->count() != 0){?>
            <div id="toPopup_pr_{{$project->id}}_{{$ch}}" class="toPopup" style="z-index:3000;">
                <div class="close" id="1"></div>
                <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
                <div id="popup_content" style="position:absolute; width:100%;">
                    <center>
                        <span id="kpi_pop"></span>
                    </center>
                    <center>
                        <img src="" class="pop_img" id="change_img"/>
                    </center>
                </div>
            </div>
            <?php }else{
            } ?>
        </center>



                                    {{--Main Body Ends--}}



            <div class="dots-repeat1">
                 <span class="dots">
                     <?php
                      for($i=0; $i<100; $i++)
                          echo ".";
                      ?>
                </span>
            </div>


        </div>






    {{--Footer--}}

  <!--   <div class="footer1">
        <div class="logo-tech4i2" style=" width: 150px;height: 117px;position: relative;left: -52px;display: inline-block;">
            {{ HTML::image('img/footer.png','Logo',  array('class' => 'logo1_small_tech4i2')) }}
        </div>

        @if(AdminArea::getLogo())
            <div class="logo" style=" width: 150px; height: 130px; position: relative; left: 250px;">

                {{ HTML::image(AdminArea::getDir().'logo.png','Logo',  array('class' => 'logo_small')) }}
            </div>
        @else
            <div class="logo" style="border-style:solid; width: 150px; height: 130px; position: relative; left: 250px;" >

                <center>Add your Logo</center>
                <div class="upload_logo">
                    {{ Form::open(array('url'=>'admin/logo', 'class'=>'dropzone1', 'id'=>'my-awesome-dropzone','files'=>true)) }}
                    {{ Form::file('file','',array('id'=>'','class'=>'')) }}
                    <input type="text" class="hidden" name="id" id="id" value="{{ $user->email }}" />
                    <p/>{{ Form::submit('Upload Logo', array('class' => 'submit_timeline')) }}

                    {{ Form::close() }}
                </div>

            </div>
        @endif

    </div> -->

</div>

</div>

<script>
 $(function() {
    $( "#datepicker1" ).datepicker();
    $( "#datepicker2" ).datepicker();
  });

    var deleteProgram = "{{ URL::to('admin/programs/deleteProgram') }}";
    var home = "{{ URL::to('admin/programLevel') }}";
    var renameProject = "{{ URL::to('admin/programs/renameProject') }}";
    var submitIssue = "{{ URL::to('admin/programs/submitIssue') }}";

</script>

{{ HTML::script('js/programLevel.js') }}



