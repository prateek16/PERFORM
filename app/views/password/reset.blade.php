


<div id = "back_login">
    {{ HTML::linkRoute('home', 'Log In', null ,array('class'=>'tab_login')) }}
</div>


<div id="login-box">


    {{ HTML::image('img/logo1.png','Logo', array('class' => 'logo_class1')) }}
    {{ HTML::image('img/logo.png','Logo', array('class' => 'logo_class')) }}


    <div class="reset-text">
        <h4>Set Your New Password</h4>
    </div>

    {{ Form::open() }}
        <input type="hidden" name="token" value="{{ $token }}">

    <table class="tg1">
        <tr>
            <td class="tg-s6z2 form-elements">{{ Form::label('email', 'Email Address:') }}</td>
            <td class="tg-031e form-elements">{{ Form::email('email', null , array('class'=>'input-block-level boxStyler', 'placeholder'=>'Email')) }}<br/></td>
        </tr>

        <tr>
            <td class="tg-s6z2 form-elements">{{ Form::label('password', 'Password') }}</td>
            <td class="tg-031e form-elements">{{ Form::password('password', array('class'=>'input-block-level boxStyler1', 'placeholder'=>'Password')) }}<br/></td>
        </tr>

        <tr>
            <td class="tg-s6z2 form-elements">{{ Form::label('password_confirmation', 'Password Confirmation') }}</td>
            <td class="tg-031e form-elements">{{ Form::password('password_confirmation', array('class'=>'input-block-level boxStyler1', 'placeholder'=>'Confirm Password')) }}<br/></td>
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

    @endif

</div>