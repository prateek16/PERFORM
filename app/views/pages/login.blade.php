




<div class="everything">
    <div class="form-body">
        {{ HTML::image('img/logo1.png','Logo', array('class' => 'logo_class1')) }}
        <div class="form-control-wrapper">
            <div class="form-control">
                <a href = " {{ URL::to('password/remind') }}">
                    <span class="forgot-password">Forgot Password?</span>
                </a>
                {{ Form::open(array('url'=>'login', 'class'=>'form-signin','name'=>'login', 'id'=>'login-form')) }}
                {{ Form::label('email', 'Email',array('class' => 'label')) }}
                {{ Form::email('email', null, array('class'=>'input-block-level boxStyler', 'placeholder'=>'Email')) }}
            </div>

            <div class="form-control">
                {{ Form::label('password', 'Password',array('class' => 'label')) }}
                <input type = 'password' class="input-block-level boxStyler1" placeholder="Password" id="password" name="password"/>
                {{--{{ Form::password('password', array('class'=>'input-block-level boxStyler1', 'placeholder'=>'Password')) }}--}}
            </div>
            {{ Form::submit('Login', array('class'=>'login-button'))}}
            <a href="{{ URL::to('signup') }}" class="signup-button">Sign Up</a>
            {{ Form::close() }}
        </div>
    </div>
</div>




