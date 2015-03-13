<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">

    <style>
        body{
            font-family: helvetica;

            box-shadow: 0 0 10px .1px #000;
        }
        .logo_small{
            width: 100px;
        }
        .text{
            position: relative;
            margin-top: 50px;
        }
        .text1{
            position: relative;
            margin-left: 45px;
        }
        .margin{
            margin-left: 50px;
        }
        .bold{
            font-weight: bold;
        }
        #wrapper{
            position: relative;
            width: 100%;
            height: 400px;
            /* border-style: solid; */
            color: black;

            /* opacity: 0.6; */
            margin-top: 3%;


        }


    </style>

</head>
<body>
<div id = "wrapper" >
    <div class="logo">
        {{ HTML::image('img/T4i2.png','Logo',  array('class' => 'logo_small')) }}
    </div>
    <div class="margin">
        <div class="text">
            Dear {{$firstname}} {{ $lastname }},<br/>
            <br/><pre>
                                 Thank you for signing up!

                </pre>



        </div>
        <p><br/>


        <p><br/>
            Sincerely,<br/>
            Tech4i2
    </div>

</div>
</body>
</html>