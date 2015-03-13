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

         .tg_details1{
  border-collapse:collapse;border-spacing:0;border-color:#ccc;width: 100%;
text-align: center;
font-size: 13px;
font-family: Helvetica; 
color: #41467e;


position: absolute;

}
.tg_details1 td{
padding: 3px 9px;
border-style: dotted;
border-width: 1px;
overflow: hidden;
word-break: normal;
border-color: #ccc;
background-color: #fff;

}
.tg_details1  .tg-4eph{background-color:#f2f2f2}


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
            <br/>
                                <!--  A new Issue was raised by the Programme Manager for the project <b>{{$project}}</b> -->
<!-- 
                                 <p>
                                    Issue Details:-

                                     <table class="tg_details1" style="font-size: 12px;">
                                        <th width="50%">Issue</th>
                                        <th>Received</th>
                                        <th>Owner</th>
                                        <th>Resolved</th>
                                        <th>Programme Manager</th>
                                                                     
                                           <tr>
                                              <td>{{$issue}} </td>
                                              <td>{{$rec}}</td>
                                              <td>{{$firstname}} {{$lastname}}</td>
                                              <td>{{$res}}</td>
                                              <td>{{$managerFname}} {{$managerLname }}</td>
                                            </tr>
                                      
                                    </table>
                            </p>  -->


        

                



        </div>
        <p><br/>


        <p><br/>
            Sincerely,<br/>
            Tech4i2
    </div>

</div>
</body>
</html>