{{ HTML::style('css/home.css') }}
{{ HTML::style('css/new.css') }}

{{ HTML::script('js/jquery-1.6.3.min.js') }}
{{ HTML::script('js/newproject.js') }}

{{ HTML::script('js/formalize.js') }}

<div class="pos-fixed"> <!-- Fixed position for the header -->

    <div class="top-wrapper"> <!-- Contains the header elements -->
        @if(AdminArea::getLogo())
            <div class="logo">

                {{ HTML::image(AdminArea::getDir().'logo.png','Logo',  array('class' => 'logo_small')) }}
            </div>
        @else
            <div class="logo" style="border-style:solid; width: 150px; height: 130px;">

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


        <a href = " {{ URL::to('logout') }}" class="tab_login_1">
            <div class = "back_login_text">
                <span class="text_back">Log Out</span>
            </div>
        </a>
     </div>

    <div id="backgroundPopup"></div>
    <div class ="dashboard_title"><center>Creating a new Programme</center></div>
    <span class="looged_in">You are logged in as: {{$user->firstname}} <br/>
        <span style="float :right; margin-bottom: 10px; margin-top: 10px;" >{{ AdminArea::getLevel() }}</span>
    </span>
    <div class="slider_title">
        <center>

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
        {{ HTML::image('img/right1.png','Home',  array('class' => 'back_btn', 'onclick' => 'Forward()')) }}
    </div>
</div> <!-- Fixed position for the header ends here -->

             {{--No Dependencies--}}


                                {{--Waiting Area--}}



<div class="waiting-area" >

    <div class="loader1"></div>
    <center>
        <div class="wait-text">Please wait while we set up your programme.</div>
        <div class="warning-close">  {{ HTML::image('img/warning.png','Home',  array('class' => 'warning_img')) }} Please Do not refresh or close this window</div></center>
    <div class="progress-bar"> <div class="progress-bar1"></div> </div>
    <div class="progress-text"><center> <span class="progress-per">0</span>% </center></div>

    <div class="progress-status">

        <div class="prog_step1">
            <span class="prog_step1_text"></span>
            <span class="status-done" style="display: none;">Done</span>
        </div>
    </div>


</div>

                        {{--Hidden Program id...Updated through javascript--}}

<input type="text" id="prog_id" value="" style="display:none;"/>


        {{--New Program Form Starts here--}}

<div id="add_new_project" style="display:block">
    <form id="sectional">
        <fieldset>

            <legend>1. Programme Description</legend>
            <div class="form-section">

                <p class="form-help-text">
                    In the boxes below enter the name of the Programme and a short description of approximately 200 words. This description will enable anyone that does not know about your programme to understand what you are doing, the benefits of the project and the timespan for activities.<br/>
                    <br/>
                    <span class="red-class1" style="color: #cd6a50;">*</span>required field</p>
                <div class="field required-field">
                    <label for="sectional-text-1">Programme Name</label>
                    <input name="text1" id="sectional-pname" type="text" required>
                </div>
                <div class="field">
                    <label for="sectional-text-2"> Description</label>
                    {{ Form::textarea('text2', null,['size'=> '20x12', 'id'=>'sectional-desc' , 'class'=>'input-block-level']) }}

                </div>

                <nav class="form-section-nav"> <span class="btn-std form-nav-next">Next</span> </nav>
            </div>
        </fieldset>

        <fieldset>
            <legend>2. Programme Staff</legend>
            <div class="form-section">
                <div class="first-step" style="display : none;"><input type="text" value="1"/></div>
                <p class="form-help-text">

                </p>


                <input type="text" class="total_mem1" value="0" style="display: none" disabled/>
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
                <input type="button" id="add_more1" class="add_more1" value="Add new member"/>
                <nav class="form-section-nav"> <span class="btn-secondary form-nav-prev">Prev</span> <span class="btn-std submit-prog">Submit</span> </nav>
            </div>
        </fieldset>
    </form>
</div>

<script>
    var urlget = "{{ URL::to('admin/createProgram') }}";
    var urlget0 = "{{ URL::to('admin/addProgramMembers') }}";
    var urlget1 = "{{ URL::to('admin') }}";
</script>

{{ HTML::script('js/newProgram.js') }}