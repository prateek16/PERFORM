{{ HTML::style('css/home.css') }}
{{ HTML::style('css/new.css') }}

{{ HTML::script('js/jquery-1.6.3.min.js') }}
{{ HTML::script('js/popup.js') }}
{{ HTML::script('js/newproject.js') }}
{{ HTML::script('js/formalize.js') }}

<?php
$program = Program::where('id', '=', $pid)->first();
?>

{{--TOP SECTION--}}

<div class="pos-fixed"> <!-- Fixed position for the header -->

    <div class="top-wrapper"> <!-- Contains the header elements -->
        @if(AdminArea::getLogo())
            <div class="logo">

                {{ HTML::image(AdminArea::getDir().'logo.png','Logo',  array('class' => 'logo_small')) }}
            </div>
        @else
         
        @endif


        <a href = " {{ URL::to('logout') }}" class="tab_login_1">
            <div class = "back_login_text">
                <span class="text_back">Log Out</span>
            </div>
        </a>
    </div>

    <input type="text" value="{{$pid}}" style="display:none;" id="hidden_pid"/>
    <input type="text" value="" style="display:none;" id="hidden_prid"/>
    <div id="backgroundPopup"></div>
    <div class ="dashboard_title"><center>Creating a new Project</center></div>
    <span class="looged_in">You are logged in as: {{$user->firstname}} <br/>
        <span style="float :right; margin-bottom: 10px; margin-top: 10px;" >{{ AdminArea::getLevel() }}</span>
    </span>

    <div class="slider_title">
        <center>
            <span class="new1_prog_name"> This project you are creating will be included in the <b><i> "{{$program->name}}" </b></i> programme. </span>
        </center>
    </div>
    <div id="ajax_overlay" class="ajax_overlay">
        {{ HTML::image('img/ajax-loader.gif', 'loader', array('class' => 'ajax_img')) }}
    </div>
    <div class="go_home2">
        {{ HTML::image('img/left1.png','Back',  array('class' => 'back_btn', 'onclick' => 'Back()')) }}
        <a href=" {{ URL::to('admin') }}"  class="tab_login_1 navbut">
            {{ HTML::image('img/home1.png','Home',  array('class' => 'back_btn')) }}
        </a>
        {{ HTML::image('img/right1.png','Forward',  array('class' => 'back_btn', 'onclick' => 'Forward()')) }}
    </div>
</div> <!-- Fixed position for the header ends here -->


<div class="waiting-area">
    <div class="loader1"></div>
    <center>
        <div class="wait-text">Please wait while we set up your project.</div>
        <div class="warning-close">  {{ HTML::image('img/warning.png','Home',  array('class' => 'warning_img')) }} Please Do not Refresh or close this window</div></center>
    <div class="progress-bar"> <div class="progress-bar1"></div> </div>
    <div class="progress-text"><center> <span class="progress-per">0</span>% </center></div>

    <div class="progress-status">

        <div class="prog_step1">
            <span class="prog_step1_text"></span>
            <span class="status-done" style="display: none;">Done</span>
        </div>
    </div>
</div>


                                            {{--THE MAIN SECTION --}}


<div id="add_new_project" style="display:block">
    <form id="sectional">
        <fieldset>

            <legend>1. Project Description</legend>
            <div class="form-section">

                <p class="form-help-text">
                    In the boxes below enter the name of the project and a short description of approximately 500 words. This description will enable anyone that does not know about your project to understand what you are doing, the benefits of the project and the timespan for activities.<br/>
                    <br/>
                    <span class="red-class1" style="color: #cd6a50;">*</span>required field</p>
                <div class="field required-field pname-exists">
                    <label for="sectional-text-1">Project Name</label>
                    <input name="text1" id="sectional-pname" type="text" required>
                </div>
                <div class="field">
                    <label for="sectional-text-2">Project Description</label>
                    {{ Form::textarea('text2', null,['size'=> '20x12', 'id'=>'sectional-desc' , 'class'=>'input-block-level']) }}

                </div>

                <nav class="form-section-nav"> <span class="btn-std form-nav-next">Next</span> </nav>
            </div>
        </fieldset>

        <fieldset>
            <legend>2. Project Staff</legend>
            <div class="form-section">
                <div class="first-step" style="display : none;"><input type="text" value="1"/></div>
                <p class="form-help-text">
                    The information below is required to enable the Local Enterprise Partnership to communicate with relevant people involved in the project in your organisation.<br/><br/>
                    <b>It will be used to send reminders</b> that monitoring information is required and to <b>send emails confirming the receipt</b> of monitoring information after submission.<br/>

                    This information will be held securely by the Local Enterprise Partnership and only used to correspond about the project for which you are entering details.<br/><br/>
                    <span class="red-class1" style="color: #cd6a50;">*</span>required field</p>
                <hr/>
                <p>Enter the details for the person who will be responsible for entering the returns that are due:</p>
                <div class="field" >
                    <label for="sectional-text-4">Role</label>
                    <?php $role = Role::where('level', '=', 'H')->first(); ?>
                    <input name="text4" id="sectional-officer-role" type="text" value="{{$role->role}}" disabled>
                </div>
                <div class="field required-field email-field">
                    <label for="sectional-text-8">Email</label>
                    <input name="text8" id="sectional-officer-email" type="text" required>
                </div>

                <div class="field required-field">
                    <label for="sectional-text-5">First name</label>
                    <input name="text5" id="sectional-officer-fname" type="text" required disabled>
                </div>
                <div class="field required-field">
                    <label for="sectional-text-6">Last name</label>
                    <input name="text6" id="sectional-officer-lname" type="text" required disabled>
                </div>
                <div class="field">
                    <label for="sectional-text-7">Address</label>
                    <input name="text7" id="sectional-officer-add" type="text" required disabled>
                </div>

                <div class="field">
                    <label for="sectional-text-9">Phone</label>
                    <input name="text9" id="sectional-officer-phone" type="text" disabled>
                </div>
                <hr style="width: 100%;"/>
                <p style="position: relative;left: 40%;">Other Members</p>
                <p>Add other key project staff below. Additional staff will include all people who will want to know about the progress of the project. They will include colleagues working on the project, managers or directors of your organisation and partner organisations.</p>
                <input type="text" class="total_mem" value="0" style="display: none" disabled/>
                <div class="add_new_member" style="display: none;">
                    <table class="tg46">
                        <tr >
                            <th class="tg-031e">Role</th>
                            <th class="tg-031e">First name</th>
                            <th class="tg-031e">Last name</th>
                            <th class="tg-031e">Address</th>
                            <th class="tg-031e">Email</th>
                            <th class="tg-031e">Phone</th>
                        </tr>
                    </table>
                </div>
                <input type="button" class="add_more" value="Add new member"/>
                <nav class="form-section-nav"> <span class="btn-secondary form-nav-prev">Prev</span> <span class="btn-std form-nav-next">Next</span> </nav>
            </div>
        </fieldset>

        <fieldset>
            <legend>3. Project Funding</legend>
            <div class="form-section">
                <p class="form-help-text"> </p>
                <span class="red-class1" style="color: #cd6a50;">*</span>required field
                <hr/>

                <div class="field required-field funding-source">
                    <label for="sectional-text-10.0" style="width: 312px;">Total number of funding sources.</label>
                    <select class = "fund_sources fsources" id="fsources" size = 1 required>
                        <option value="">-----</option>
                        <?php
                        for($nu=1;$nu<=10;$nu++)  {
                        ?>
                        <option value="{{$nu}}">{{$nu}}</option>
                        <?php } ?>

                    </select>
                </div><p/>

                <div class="field sources_name" style="display: none;">

                    <table class="tg99">
                       
                    </table>

                </div>

                <div class="field required-field select-month">
                    <label for="sectional-text-10" style="width: 312px;">How frequently will funding be provided?</label>
                    <select class = "monthly_q parentelem" id="monthly_q" size = 1 required>
                        <option value="">-----</option>
                        <option value="month">Monthly</option>
                        <option value="quarter">Quarterly</option>
                        

                    </select>
                </div><p/>
                <div class="field required-field select-year" >
                    <label for="sectional-text-11">Start year</label>
                    <select class = "select_year parentelem1" id="select_year" size = 1 required>
                        <option value = "">-----</option>
                        <?php $year = date("Y");
                        for($i=$year - 4; $i<=$year + 6 ; $i++){ ?>
                        <option value = "{{$i}}">{{$i}}</option>
                        <?php }
                        ?>
                    </select>

                </div><p/>
                <div class="field required-field final-pay" >
                    <label for="sectional-text-12" style="width :360px;">In which year will the final payment be received?</label>
                    <select class = "select_year parentelem2" id="select_year" size = 1 required>
                        <option value = "">-----</option>
                        <?php $year = date("Y");
                        for($i=$year - 4; $i<=$year + 6 ; $i++){ ?>
                        <option value = "{{$i}}">{{$i}}</option>
                        <?php }
                        ?>
                    </select>
                </div><br/>
                <hr/>

                <div class="generate-input" style="display :none;">
                    <p class="form-help-text">
                        The boxes below are required to collect information about funding for your project. You are required to provide information about the regularity of funding and how much funding will be received for each payment.<br/>
                    </p>
                    <a href="#" class="reset-funding"><span class="btn-std">Reset</span></a>
                    <span class="in-millions">(in millions)</span>

                    <div class="all-funding-tables">

                    </div>


                    <div class="total_funds">
                        Total: £<span class="total_funds_1">0</span>m

                    </div>
                </div>
                <nav class="form-section-nav"> <span class="btn-secondary form-nav-prev">Prev</span> <span class="btn-std form-nav-next">Next</span> </nav>
            </div>
        </fieldset>

        <fieldset>
            <legend>4. Project Spending</legend>
            <div class="form-section">
                <p class="form-help-text"></p>
                <span class="red-class1" style="color: #cd6a50;">*</span>required field
                <hr/>
                <div class="field required-field select-month" >
                    <label for="sectional-text-10" style="width: 312px;">How frequently will spending information be provided?</label>
                    <select class = "monthly_q childelem" id="monthly_q" size = 1 required disabled>
                        <option value="">-----</option>
                        <option value="month">Monthly</option>
                        <option value="quarter">Quarterly</option>
                        <option value="other">Other</option>

                    </select>
                </div><p/>
                <div class="field required-field select-year" >
                    <label for="sectional-text-11">Start year</label>
                    <select class = "select_year childelem1" id="select_year" size = 1 required>
                        <option value = "">-----</option>
                        <?php $year = date("Y");
                        for($i=$year - 4; $i<=$year + 6 ; $i++){ ?>
                        <option value = "{{$i}}">{{$i}}</option>
                        <?php }
                        ?>
                    </select>

                </div><p/>
                <div class="field required-field final-pay1" >
                    <label for="sectional-text-12" style="width :360px;">In which year will the final spending information be received?</label>
                    <select class = "select_year childelem2" id="select_year" size = 1 required>
                        <option value = "">-----</option>
                        <?php $year = date("Y");
                        for($i=$year - 4; $i<=$year + 6 ; $i++){ ?>
                        <option value = "{{$i}}">{{$i}}</option>
                        <?php }
                        ?>
                    </select>
                </div><br/>
                <hr/>
                <div class="generate-input1" style="display :none;">
                    <p class="form-help-text">
                        The boxes below are required to collect information about spending for your project. <br/>

                        When the project starts you will be required to provide information about spending on the project. Spending will be compared with the funding you receive. This will enable the Local Enterprise Partnership to monitor project progress. </p>
                    <a href="#" class="reset-spending"><span class="btn-std">Reset</span></a>
                    <span class="in-millions">Estimated spending (in millions)</span>
                    <table class="tg48">

                    </table>
                    <div class="total_funds">
                        Total: £<span class="total_funds_2">0</span>m

                    </div>
                </div>
                <nav class="form-section-nav"> <span class="btn-secondary form-nav-prev">Prev</span> <span class="btn-std form-nav-next">Next</span> </nav>
            </div>
        </fieldset>

        <fieldset>
            <legend>5. Key Performance Indicators</legend>
            <div class="form-section">
                <p class="form-help-text">
                <p>This section collects information about the benefits and Key Performance Indicators your project will create for citizens and the local economy.</p>

                <p>Key Performance Indicators are vital for reporting progress to the Local Enterprise Partnership and other funding organisations that have supported your project.<br/>
                    Local Enterprise Partnership staff will contact you at various times about the outputs you have achieved for each indicator.</p>
                <p>Please enter the time span for the outputs of the project and the regularity with which you will enter this information on this online system.
                </p>
                <span class="red-class1" style="color: #cd6a50;">*</span>required field</p>
                <hr/>
                <div class="field required-field kpi-1" style="width:600px;">
                    <label for="sectional-text-10" style="width: 605px;">How frequently will you provide information about performance for key indicators?</label>
                    <select class = "monthly_q gchildelem" id="monthly_q" size = 1 required style="position: relative;right:140px;">
                        <option value="">-----</option>
                        <option value="month">Monthly</option>
                        <option value="quarter">Quarterly</option>
                        <option value="other">Other</option>

                    </select>
                </div><p/>
                <div class="field required-field kpi-2" >
                    <label for="sectional-text-11">Start year</label>
                    <select class = "select_year gchildelem1" id="select_year" size = 1 required disabled>
                        <option value = "">-----</option>
                        <?php $year = date("Y");
                        for($i=$year - 4; $i<=$year + 6 ; $i++){ ?>
                        <option value = "{{$i}}">{{$i}}</option>
                        <?php }
                        ?>
                    </select>

                </div><p/>
                <div class="field required-field kpi-3" >
                    <label for="sectional-text-12" style="width :360px;">Year in which will the final output be achieved?</label>
                    <select class = "select_year gchildelem2" id="select_year" size = 1 required>
                        <option value = "">-----</option>
                        <?php $year = date("Y");
                        for($i=$year - 4; $i<=$year + 6 ; $i++){ ?>
                        <option value = "{{$i}}">{{$i}}</option>
                        <?php }
                        ?>
                    </select>
                </div>
                <br/>
                <hr/>
                <div class="kpis-section" style="display: none;">
                    <p class="form-help-text">

                    <ol style="position: relative; left: 25px;">
                        <li>Select the Project Area most relevant to your project.</li>
                        <li>Then select the Activity area of the project</li>
                        <li>This will bring up a range of possible Key Performance Indicators.<i>(You can select multiple KPIs)</i></li>
                    </ol>

                    </p>
                    <div class="project_area">
                        <span class="parea_text">Project Area</span>
                        <div class="project-area1">
                            <?php $themes = Theme::all();
                            ?>
                            <select class="project_area_select" size = 17>
                                @foreach($themes as $t)
                                    <?php if($t->id!= 16 && $t->id!=17) {?>
                                    <option value="{{$t->code}}">{{$t->name}}</option>
                                    <?php } ?>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="activity_area" style="display: none;">
                        <span class="parea_text">Activity Area</span>
                        <div class="activity-area1">
                        </div>
                    </div>
                    <div class="kpi_area" style="display: none;">
                        <span class="parea_text1">Key Performance Indicators</span>
                        <div class="kpi-area1">

                        </div>
                    </div>
                </div>
                <center><p class="show_msg" style="display: none;">All your selected KPIs are presented in the box below.</p><br/>
                    <p class="show_msg show_msg1" style="display: none;"> You can add as many project or activity areas that are relevant to your project, simply add the Key Performance Indicators and then repeat the process.<br/>
                       {{--  Click on {{ HTML::image('img/remove.png', 'loader', array('class' => 'remove-png')) }} to remove any Key Performance Indicator from your list. --}} </p></center>
                <div class="kpis-section1" style="display:none;">


                    <div class="stored-kpis">
                        <ol class="ol-kpis">

                        </ol>
                    </div>
                </div>
                <nav class="form-section-nav"> <span class="btn-secondary form-nav-prev">Prev</span> <span class="btn-std form-nav-next">Next</span> </nav>
            </div>
        </fieldset>
        <fieldset>
            <legend>6. Key Performance Indicators / Target</legend>
            <div class="form-section">
                <p class="form-help-text">
                    Listed below are the Key Performance Indicators you have indicated as relevant to your project.<br/>
                    <br/>
                    Please forecast the target of the Key Performance Indicator for each reporting period. The total output for each Key Performance Indicator is calculated as you enter data.<br/>
                    <br/>
                    You will be asked to report on your progress against these forecasts on a regular basis in the future.
                </p>

                <div class="all-kpi-targets">

                </div>

                <nav class="form-section-nav"> <span class="btn-secondary form-nav-prev">Prev</span> <span class="btn-std form-nav-next">Next</span> </nav>
            </div>
        </fieldset>
        <fieldset>
            <legend>7. Risk Assessment</legend>
            <div class="form-section">
                <p class="form-help-text">
                    Identification and management of risks will be important for all projects. Effective risk management requires an informed understanding of relevant risks, an assessment of their relative priority and a rigorous approach to monitoring and controlling them.<br/><br/>

                    Listed below are three key areas for risk assessment. Please assess these factors for the project using a scale from 1 to 10. (1 indicates no or insignificant risk or impact, 10 indicates very significant risk or impact)<br/>
                </p>

                <p>
                <ul>
                    <li><b>Project Risk:</b> (Project risks relate to the level of risk associated with the success of the overall project. Project risks generally arise from the 'external' environment and economy within which the project is operating, e.g. will it be possible to find, engage with and meet targets for the number of people or businesses that provide the focus for the project).</li><br>

                    <li>
                        <b>Management Risks:</b> (Management Risks generally relate to the 'internal' capability of the organisation or partners providing a project. These risks include factors such as management capabilities, access to sufficient suitable resources, financial capability and cashflow issues).
                    </li><br/>

                    <li>
                        <b>Impact:</b> (This risk management component relates to the likely impact of the failure of the project. The assessment should consider the impact of project failure on political, economic, social, legal and environmental factors).
                    </li><br/>
                </ul>
                </p>

                <p>
                    This will affect where the project ranks on your dashboard so that you can monitor your projects effectively.</p>
                <hr/>
                <div class="field">
                    <label for="sectional-text-10">Project Risk:</label>
                    <input name="text10" id="risk1" class="risks" style="width:50px; float: left;" type="text"> <span class="risk_text">/10</span>

                </div>
                <div class="field">
                    <label for="sectional-text-11">Management Risk</label>
                    <input name="text10" id="risk2" class="risks" style="width:50px; float: left;"  type="text"> <span class="risk_text">/10</span>
                </div>
                <div class="field">
                    <label for="sectional-text-12">Impact</label>
                    <input name="text10" id="risk3" class="risks" style="width:50px; float: left;"  type="text"> <span class="risk_text">/10</span>
                </div>
                <nav class="form-section-nav"> <span class="btn-secondary form-nav-prev">Prev</span> <span class="btn-std submit-project">Submit</span> </nav>
            </div>
        </fieldset>
    </form>
</div>


<script>

    var checkOfficer = "{{ URL::to('admin/checkOfficer') }}";
    var getCategory = "{{ URL::to('admin/getCategory') }}";
    var getKpis = "{{ URL::to('admin/getKpis') }}";
    var submitStep1 = "{{ URL::to('admin/newProject/submitStep1') }}";
    var submitStep2 = "{{ URL::to('admin/newProject/submitStep2') }}";
    var submitStep3 = "{{ URL::to('admin/newProject/submitStep3') }}";
    var submitStep3_1 = "{{ URL::to('admin/newProject/submitStep3_1') }}";
    var submitStep4_q_m = "{{ URL::to('admin/newProject/submitStep4_q_m') }}";
    var submitStep5 = "{{ URL::to('admin/newProject/submitStep5') }}";

    var submitStep6 = "{{ URL::to('admin/newProject/submitStep6') }}";
    var submitStep9 = "{{ URL::to('admin/newProject/submitStep9') }}";
    var submitStep10 = "{{ URL::to('admin/newProject/submitStep10') }}";
    var submitStep11 = "{{ URL::to('admin/newProject/submitStep11') }}";

    var home = "{{ URL::to('admin/programLevel') }}";



</script>

{{ HTML::script('js/newProjectAjax.js') }}

