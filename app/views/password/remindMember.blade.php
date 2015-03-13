
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">


<div class="wrap">
    {{--Header--}}
    <div class="header">
        <div class="header-text">
            Programme Level Dashboard
        </div>


        <div class="header-nav">
            <div class="header-admin-role">You are Logged in as:<br/>
                <div class="header-admin-role-text">
                    {{$user->firstName}}<br/>
                    {{AdminArea::getLevel()}}
                </div>
            </div>
            <a href = "{{ URL::to('logout') }}" class="header-logout"> Log out </a>
        </div>
    </div>



    <div class="contents">
        <div class="contents-three-buttons">
            {{ HTML::image('img/left1.png','Back',  array('class' => 'back_btn1', 'onclick' => 'Back()')) }}
            <a href=" {{ URL::to('admin') }}"  class="tab_login_1 navbut">
                {{ HTML::image('img/home1.png','Home',  array('class' => 'back_btn1')) }}
            </a>
            <a href="#" class="tab_login_1 navbut" id="info">
                {{ HTML::image('img/right1.png','Forward',  array('class' => 'back_btn1', 'onclick' => 'Forward()')) }}
            </a>


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




            <div class="password-reset">

                <div class="error_back" style="color: red;">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

                {{ Form::open(array('url'=>'admin/submitPassword', 'class'=>'form-signin')) }}


                <table class="tg1">
                    <tr>
                        <td class="tg-s6z2 form-elements">{{ Form::label('email', 'Email Address:') }}</td>
                        <td class="tg-031e form-elements">{{ Form::email('email', null , array('class'=>'input-block-level boxStyler', 'placeholder'=>'Email')) }}<br/></td>
                    </tr>

                    <tr>
                        <td class="tg-s6z2 form-elements">{{ Form::label('old', 'Old Password:') }}</td>
                        <td class="tg-031e form-elements">{{ Form::password('old', array('class'=>'input-block-level boxStyler', 'placeholder'=>'Old Password')) }}
                            <br/></td>

                    </tr>

                    <tr>
                        <td class="tg-s6z2 form-elements">{{ Form::label('new', 'New Password:') }}</td>
                        <td class="tg-031e form-elements">{{ Form::password('new', array('class'=>'input-block-level boxStyler', 'placeholder'=>'New Password')) }}<br/></td>
                    </tr>

                    <tr>
                        <td class="tg-s6z2 form-elements">{{ Form::label('new1', 'Confirm Password:') }}</td>
                        <td class="tg-031e form-elements">{{ Form::password('new1', array('class'=>'input-block-level boxStyler', 'placeholder'=>'Confirm Password')) }}<br/></td>
                    </tr>

                    <tr>
                        <td class="tg-s6z2 form-elements button-elem" colspan=2 >{{ Form::submit('Reset', array('class'=>'buttonStyler'))}}</td>
                    </tr>



                </table>


                {{ Form::close() }}

            </div>

            <div class="pass-error">
                @if (Session::has('error'))
                    <p style="color: red;"> {{ Session::get('error') }} </p>

                @elseif (Session::has('status'))
                    <p> {{ Session::get('status') }}</p>

                @endif

            </div>

        </div>

        {{--Main Body Ends--}}
        @if(Session::has('message'))
            <p class="alert" style="color: rgb(29, 91, 157); position: relative;
width: 50%;
margin: auto;
text-align: center;">{{ Session::get('message') }}</p>
        @endif




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

    <div class="footer">

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

    </div>
</div>

<script>


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









