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
            Funding and Sources
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

            <div id="dialog-box" title="Welcome to the Monitoring and Evaluation Dashboard">
            <p>
                The monitoring and evaluation software is underpinned by European Commission guidelines and UK government HM Treasury best practices in monitoring and evaluation.  It has been developed to be compatible with PRINCE2 methods, it also draws upon over 30 years of Tech4i2’s practical experience in undertaking monitoring and evaluation studies for all tiers of government throughout the world.
                A key advantage of the software is the simplicity for users in using the dashboard to examine spending and outputs from the strategic level to the details concerning hundreds of individual projects in <i>‘three-clicks’</i>.

            </p>
        </div>

         <div class="exists_fundLevel" style="display: block">
                <div class = "pr_names1">
                    @if($user->projects()->count() == 0 )
                            <div id ="no_project" class = "no_project" style="top:0;">
                                <span class="no_pr">You do not have any Projects in your Database.<br/>
                               </span>
                            </div>
                    @else
                           
                            <div class="program_wrapper">
                                @foreach($user->projects as $project)                                      
                                   

                                    <div class="program_name">
                                        {{ HTML::image('/img/chart.png','files',  array('class' => 'prog_icon')) }}
                                        <div class="program-name-wrapper">
                                            <span class="prog_name">
                                             <a href = " {{ URL::to('admin/projectLevel',array('pid' => $project->id)) }}" id="tab_login123">
                                                    {{$project->name}}
                                             </a>
                                             </span>
                                        </div>

                                          <div class="fundLevel_wrapper">

                                              <div class="staging-funding-spending1">
                                                    <?php $id = $project->id; $fstatus = AdminArea::getFundingStatus($id);  $img = aggfunding($id,300,180);?>

                                                    @if($fstatus == 1)
                                                        <div class="staging-funding-spending-header funding-red">
                                                             <span class="project-overview-text project-issues-text funding-text">  Aggregate Funding vs Spending  </span>
                                                        </div>
                                                    @elseif($fstatus == 3)
                                                        <div class="staging-funding-spending-header funding-orange">
                                                             <span class="project-overview-text project-issues-text funding-text"> Aggregate Funding vs Spending  </span>
                                                        </div>
                                                    @elseif($fstatus == 5)
                                                        <div class="staging-funding-spending-header funding-green">
                                                            <span class="project-overview-text project-issues-text funding-text"> Aggregate Funding vs Spending  </span>
                                                        </div>
                                                    @elseif($fstatus == 0)
                                                        <div class="staging-funding-spending-header funding-grey">
                                                            <span class="project-overview-text project-issues-text funding-text"> Aggregate Funding vs Spending  </span>
                                                        </div>
                                                    @endif

                                                    <div class="staging-funding-spending-image" style="width:300px;">
                                                         {{ HTML::image($img,'Funding',  array('class' => 'staging-funding-img')) }}       
                                                    </div>

                                                    
                                                     <?php 
                                                        $checkFunding = Funding::where('pid', '=', $id)->get(); 
                                                        if($checkFunding->count() > 1 ){ 
                                                     ?>
                                                     
                                                     

                                                    <?php } ?>

                                               </div>    {{-- Staging funding spending1 --}}

                                               <div class="staging-funding-right">
                                                <div class="funding-sources-details">

                                                    <p class="margin-top-bottom">Total Funding: 
                                                        <span class="style-data">
                                                            £{{ number_format(totalfunds($id), 2) }}m. </span> <br/>
                                                    </p>

                                                    <p class="margin-top-bottom">
                                                    Total Source:  <span class="style-data">{{ $checkFunding->count() }} </span><br/>
                                                     </p>

                                                     <p >
                                                    Funded By: 
                                                    <div class="ul-source-names">
                                                        <ul>
                                                        @foreach($checkFunding as $source)
                                                         
                                                            <li> <span class="style-data"> {{ $source->name }} </span>
                                                            <span class="style-data-1"> (£{{ number_format($source->total, 2) }}m) </span>
                                                            </li>
                                                        @endforeach
                                                        </ul>
                                                   </div>
                                                   </p>


                                                </div>

                                               </div>


                                          </div>

                                    </div>



                                    @endforeach
                                </div>
                    @endif
                     </div>  {{-- prnames --}}
            </div>  {{-- exists --}}




        </div>

        {{ HTML::script('js/programLevel.js') }}