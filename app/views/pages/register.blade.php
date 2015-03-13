

<center>






<div class="reg_contents">

    <div id = "back_login">
        <a href = " {{ URL::to('/') }}" class="tab_login">Log In</a>
    </div>

    {{ Form::open(array('url'=>'signup/register', 'class'=>'form-signup')) }}
    {{ HTML::image('img/tech4i2.png') }}


    <div class="error_back">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

    <table class="tg">
        <tr>
            <td class="tg-s6z2 form-elements">{{ Form::label('first_name', 'First Name') }}</td>
            <td class="tg-031e form-elements">{{ Form::text('firstname', null, array('class'=>'input-block-level boxStyler', 'placeholder'=>'First Name')) }}<br/></td>
        </tr>
        <tr>
            <td class="tg-s6z2 form-elements">{{ Form::label('last_name', 'Last Name') }}</td>
            <td class="tg-031e form-elements">{{ Form::text('lastname', null, array('class'=>'input-block-level boxStyler', 'placeholder'=>'Last Name')) }}<br/></td>
        </tr>
        <tr>
            <td class="tg-s6z2 form-elements">{{ Form::label('email', 'Email Address') }}</td>
            <td class="tg-031e form-elements">{{ Form::email('email', null, array('class'=>'input-block-level boxStyler', 'placeholder'=>'Email Address')) }}<br/></td>
        </tr>
        <tr>
            <td class="tg-s6z2 form-elements">  {{ Form::label('password', 'Password') }}</td>
            <td class="tg-031e form-elements">{{ Form::password('password', array('class'=>'input-block-level boxStyler1', 'placeholder'=>'Password')) }}<br/></td>
        </tr>
        <tr>
            <td class="tg-s6z2 form-elements">{{ Form::label('confirm_password', 'Confirm Password') }}</td>
            <td class="tg-031e form-elements">{{ Form::password('password_confirmation', array('class'=>'input-block-level boxStyler1', 'placeholder'=>'Confirm Password')) }}<br/></td>
        </tr>


        <tr>
            <td class="tg-s6z2 form-elements">{{ Form::label('role', 'Role') }}</td>
            <td class="tg-031e form-elements ">


                <select name="role_user">
                    <optgroup label="-------------Programme Management organisation staff------------"></optgroup>
                    <option value="A">Programme Manager</option>
                    <option value="B">Programme Director</option>
                    <option value="C">Other LEP/LA staff</option>
                    <option value="D">LEP/LA Board</option>
                    <option value="E">LA Councillors</option>
                    <option value="F">Partner Organisations</option>
                    <optgroup label="---------Project Staff (Project details)----------"></optgroup>
                    <option value="G">Project Manager</option>
                    <option value="H">Project Org Directors</option>
                    <option value="I">Project other staff</option>
                    <optgroup label="----------Others---------"></optgroup>
                    <option value="J">Local media</option>
                    <option value="K">Citizens</option>

                </select>

                <br/></td>

        </tr>
        <tr>
            <td class="tg-s6z2 form-elements button-elem" colspan=2 >{{ Form::submit('Register', array('class'=>'btn btn-large btn-primary btn-block buttonStyler'))}}</td>

        </tr>
    </table>


    {{ Form::close() }}

</div>

    </center>