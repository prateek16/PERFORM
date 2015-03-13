
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">



@include('./admin/charts')
<?php

if($user->programs()->count() !=0){
    $aggrkpi = array();
    $aggrkpi = aggtarget($user);

    $aggrkpi1 = array();
    $aggrkpi1 = aggvalues($user);
}
?>
<div class="wrap">
    {{--Header--}}
    <div class="header">
        <div class="header-text">
            Monitoring and Evaluation Dashboard
        </div>

        <div class="header-nav">
            <div class="header-admin-role">You are Logged in as:<br/>
                <div class="header-admin-role-text">
                    {{$user->firstName}}  {{$user->lastName}}<br/>
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
                {{ HTML::image('img/help.png','Home',  array('class' => 'back_btn1')) }}
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


            <div class="kpis">

                @if($user->programs()->count() !=0)
                    @if($user->projects()->count() !=0)
                        <div class="hide_bg" style="display: none;"></div>

                        <table class="tg-view">
                            <?php  $pl = 0; $pe = 0; $bu = 0;?>

                            <tr>
                                @foreach($aggrkpi1 as $key=>$value)
                                    <?php $kpiname = KPI::where('id', '=', $key)->first(); ?>
                                    @if($kpiname->type == "Place")
                                        @if($pl <2)
                                            <?php
                                            $target = getkpitar($user,$kpiname->id);
                                            $ach = getkpival($user,$kpiname->id);
                                            $per = 0;

                                            //$diff = $target - $ach;
                                            //$avg = ($ach + $target)/2;

                                            //if($avg!=0)
                                            if($target != 0)
                                                $per = ($ach/$target)*100;
                                            else
                                                $per = 0;

                                            ?>
                                            <td>
                                                @if($per < 80)
                                                    <div class="kpi_blocks" style=" background: #FC9A9A; "> <!--Red -->
                                                        <div class="kpi_img_red">
                                                            <img class="images" src={{asset('img/places.png')}}  alt="">
                                                        </div>

                                                        <div class="kpi_img_red" style="float: right; left: -6px;">
                                                            <span class="circle1_text">{{$per}}</span><span class="circle_text_per">%</span>
                                                        </div>
                                                        <div class="kpi_img_red1" style="float: right;">

                                                        </div>
                                                        <div class="kpi_img_red2" style="float: right;">
                                                            <span class="circle2_text"> {{getkpival($user,$kpiname->id)}} </span>
                                                        </div>
                                                        @else
                                                            @if($per >=80 && $per <=90)
                                                                <div class="kpi_blocks" style=" background: #FFC487;">   <!--Orange -->
                                                                    <div class="kpi_img_orange">
                                                                        <img class="images" src={{asset('img/places.png')}}  alt="">
                                                                    </div>

                                                                    <div class="kpi_img_orange" style="float: right; left: -6px;">
                                                                        <span class="circle1_text">{{$per}}</span><span class="circle_text_per">%</span>
                                                                    </div>
                                                                    <div class="kpi_img_orange1" style="float: right;">

                                                                    </div>
                                                                    <div class="kpi_img_orange2" style="float: right;">
                                                                        <span class="circle2_text"> {{getkpival($user,$kpiname->id)}} </span>
                                                                    </div>
                                                                    @else

                                                                        @if($per >= 90)
                                                                            <div class="kpi_blocks" style=" background: #c4dc9b;">  <!--Green -->
                                                                                <div class="kpi_img_green">
                                                                                    <img class="images" src={{asset('img/places.png')}}  alt="">
                                                                                </div>
                                                                                <div class="kpi_img_green" style="float: right; left: -6px;">
                                                                                    <span class="circle1_text">{{$per}}</span><span class="circle_text_per">%</span>
                                                                                </div>
                                                                                <div class="kpi_img_green1" style="float: right;">

                                                                                </div>
                                                                                <div class="kpi_img_green2" style="float: right;">
                                                                                    <span class="circle2_text"> {{getkpival($user,$kpiname->id)}} </span>
                                                                                </div>
                                                                                @endif
                                                                                @endif
                                                                                @endif

                                                                                <div class="kpi_info">
                                                                                    @if($kpiname->currency == 0)
                                                                                        <div class="kpi_info_t">{{$kpiname->name }}
                                                                                        </div>

                                                                                        <div class="kpi_info_tt">
                                                                                            (Target in last year: <span class="kpi_info_tt1">{{getkpitar($user,$kpiname->id)}}</span>&nbsp;,
                                                                                            Completed: <span class="kpi_info_tt1">{{getkpival($user,$kpiname->id)}}</span>&nbsp;)

                                                                                        </div>

                                                                                    @else
                                                                                    @endif
                                                                                </div>


                                            </td>


                                            <?php $pl++ ; ?>
                                        @endif
                                    @endif
                                @endforeach
                            </tr>


                            <!-- 										2nd Row 													-->




                            <tr>
                                @foreach($aggrkpi1 as $key=>$value)
                                    <?php $kpiname = KPI::where('id', '=', $key)->first(); ?>
                                    @if($kpiname->type == "People")
                                        @if($pe <2)
                                            <?php
                                            $target = getkpitar($user,$kpiname->id);
                                            $ach = getkpival($user,$kpiname->id);
                                            $per = 0;
                                            //$diff = $target - $ach;
                                            //$avg = ($ach + $target)/2;

                                            //if($avg!=0)
                                                if($target != 0)
                                                $per = ($ach/$target)*100;
                                            else
                                                $per = 0;

                                            ?>
                                            <td>
                                                @if($per < 80)
                                                    <div class="kpi_blocks" style=" background: #FC9A9A; "> <!--Red -->
                                                        <div class="kpi_img_red">
                                                            <img class="images" src={{asset('img/people.png')}}  alt="">
                                                        </div>

                                                        <div class="kpi_img_red" style="float: right; left: -6px;">
                                                            <span class="circle1_text">{{$per}}</span><span class="circle_text_per">%</span>
                                                        </div>
                                                        <div class="kpi_img_red1" style="float: right;">

                                                        </div>
                                                        <div class="kpi_img_red2" style="float: right;">
                                                            <span class="circle2_text"> {{getkpival($user,$kpiname->id)}} </span>
                                                        </div>
                                                        @else
                                                            @if($per >=81 && $per <=90)
                                                                <div class="kpi_blocks" style=" background: #FFC487;">   <!--Orange -->
                                                                    <div class="kpi_img_orange">
                                                                        <img class="images" src={{asset('img/people.png')}}  alt="">
                                                                    </div>

                                                                    <div class="kpi_img_orange" style="float: right; left: -6px;">
                                                                        <span class="circle1_text">{{$per}}</span><span class="circle_text_per">%</span>
                                                                    </div>
                                                                    <div class="kpi_img_orange1" style="float: right;">

                                                                    </div>
                                                                    <div class="kpi_img_orange2" style="float: right;">
                                                                        <span class="circle2_text"> {{getkpival($user,$kpiname->id)}} </span>
                                                                    </div>
                                                                    @else

                                                                        @if($per > 90)
                                                                            <div class="kpi_blocks" style=" background: #c4dc9b;">  <!--Green -->
                                                                                <div class="kpi_img_green">
                                                                                    <img class="images" src={{asset('img/people.png')}}  alt="">
                                                                                </div>
                                                                                <div class="kpi_img_green" style="float: right; left: -6px;">
                                                                                    <span class="circle1_text">{{$per}}</span><span class="circle_text_per">%</span>
                                                                                </div>
                                                                                <div class="kpi_img_green1" style="float: right;">

                                                                                </div>
                                                                                <div class="kpi_img_green2" style="float: right;">
                                                                                    <span class="circle2_text"> {{getkpival($user,$kpiname->id)}} </span>
                                                                                </div>
                                                                                @endif
                                                                                @endif
                                                                                @endif


                                                                                <div class="kpi_info">
                                                                                    @if($kpiname->currency == 0)
                                                                                        <div class="kpi_info_t">{{$kpiname->name }}
                                                                                        </div>

                                                                                        <div class="kpi_info_tt">
                                                                                            (Target in last year: <span class="kpi_info_tt1">{{getkpitar($user,$kpiname->id)}}</span>&nbsp;,
                                                                                            Completed: <span class="kpi_info_tt1">{{getkpival($user,$kpiname->id)}}</span>&nbsp;)

                                                                                        </div>

                                                                                    @else
                                                                                    @endif
                                                                                </div>



                                            </td>


                                            <?php $pe++ ; ?>
                                        @endif
                                    @endif
                                @endforeach
                            </tr>

                            <tr>
                                @foreach($aggrkpi1 as $key=>$value)
                                    <?php $kpiname = KPI::where('id', '=', $key)->first(); ?>
                                    @if($kpiname->type == "Business")
                                        @if($bu <2)
                                            <?php

                                            $target = getkpitar($user,$kpiname->id);
                                            $ach = getkpival($user,$kpiname->id);
                                            $per = 0;
                                            //$diff = $target - $ach;
                                            //$avg = ($ach + $target)/2;

                                            //if($avg!=0)
                                                if($target != 0)
                                                $per = ($ach/$target)*100;
                                            else
                                                $per = 0;

                                            ?>
                                            <td>
                                                @if($per < 80)
                                                    <div class="kpi_blocks" style=" background: #FC9A9A; "> <!--Red -->
                                                        <div class="kpi_img_red">
                                                            <img class="images" src={{asset('img/business.png')}}  alt="">
                                                        </div>

                                                        <div class="kpi_img_red" style="float: right; left: -6px;">
                                                            <span class="circle1_text">{{$per}}</span><span class="circle_text_per">%</span>
                                                        </div>
                                                        <div class="kpi_img_red1" style="float: right;">

                                                        </div>
                                                        <div class="kpi_img_red2" style="float: right;">
                                                            <span class="circle2_text"> {{getkpival($user,$kpiname->id)}} </span>
                                                        </div>
                                                        @else
                                                            @if($per >=80 && $per <=90)
                                                                <div class="kpi_blocks" style=" background: #FFC487;">   <!--Orange -->
                                                                    <div class="kpi_img_orange">
                                                                        <img class="images" src={{asset('img/business.png')}}  alt="">
                                                                    </div>

                                                                    <div class="kpi_img_orange" style="float: right; left: -6px;">
                                                                        <span class="circle1_text">{{$per}}</span><span class="circle_text_per">%</span>
                                                                    </div>
                                                                    <div class="kpi_img_orange1" style="float: right;">

                                                                    </div>
                                                                    <div class="kpi_img_orange2" style="float: right;">
                                                                        <span class="circle2_text"> {{getkpival($user,$kpiname->id)}} </span>
                                                                    </div>
                                                                    @else

                                                                        @if($per > 90)
                                                                            <div class="kpi_blocks" style=" background: #c4dc9b;">  <!--Green -->
                                                                                <div class="kpi_img_green">
                                                                                    <img class="images" src={{asset('img/business.png')}}  alt="">
                                                                                </div>
                                                                                <div class="kpi_img_green" style="float: right; left: -6px;">
                                                                                    <span class="circle1_text">{{$per}}</span><span class="circle_text_per">%</span>
                                                                                </div>
                                                                                <div class="kpi_img_green1" style="float: right;">

                                                                                </div>
                                                                                <div class="kpi_img_green2" style="float: right;">
                                                                                    <span class="circle2_text"> {{getkpival($user,$kpiname->id)}} </span>
                                                                                </div>
                                                                                @endif
                                                                                @endif
                                                                                @endif

                                                                                <div class="kpi_info">
                                                                                    @if($kpiname->currency == 0)
                                                                                        <div class="kpi_info_t">{{$kpiname->name }}
                                                                                        </div>

                                                                                        <div class="kpi_info_tt">
                                                                                            (Target in last year: <span class="kpi_info_tt1">{{getkpitar($user,$kpiname->id)}}</span>&nbsp;,
                                                                                            Completed: <span class="kpi_info_tt1">{{getkpival($user,$kpiname->id)}}</span>&nbsp;)

                                                                                        </div>
                                                                                    @else
                                                                                    @endif
                                                                                </div>



                                            </td>


                                            <?php $bu++ ; ?>
                                        @endif
                                    @endif
                                @endforeach
                            </tr>
                        </table>

                    @else
                        <center>
                            <div class = "noprograms">
                                <div class="nopragram_t">
                                    <center>You do not have any Projects in your Database.<br/><p>
                                            Go To Programmes & Projects to add a new one...</p>
                                    </center>
                                </div>

                            </div>
                        </center>
                    @endif
                @else
                    <center>
                        <div class = "noprograms">
                            <div class="nopragram_t">
                                <center>You do not have any Programmes in your Database.<br/><p>
                                        <a href = " {{ URL::to('admin/newProgram') }}"><span class="noprograms-text">Create a new one Now</span></a></p>
                                </center>
                            </div>

                        </div>
                    </center>
                @endif

                <div id="dialog" title="Welcome to the Monitoring and Evaluation Dashboard">
                    <p>
                        The monitoring and evaluation software is underpinned by European Commission guidelines and UK government HM Treasury best practices in monitoring and evaluation.  It has been developed to be compatible with PRINCE2 methods, it also draws upon over 30 years of Tech4i2’s practical experience in undertaking monitoring and evaluation studies for all tiers of government throughout the world.
                        A key advantage of the software is the simplicity for users in using the dashboard to examine spending and outputs from the strategic level to the details concerning hundreds of individual projects in <i>‘three-clicks’</i>.

                    </p>
                </div>



            </div>

            <div class="dots-repeat">
                  <span class="dots1">
                         <?php
                      for($i=0; $i<100; $i++)
                          echo ".";
                      ?>
                  </span>
            </div>
        </div>

        <div class="three-clicks">
            <center>
                @if($user->programs()->count() !=0)
                    <a href="{{URL::to('admin/fundingLevel')}}" class="funding "><span class="text-cirlce">Funding <br/> and <br/>Sources</span></a>
                    <a href="{{URL::to('admin/programLevel')}}" class="pnp "><span class="text-cirlce">Programmes <br>and <br>Projects</span></a>
                @else
                    <a href="#"  style="cursor: none;" class="funding "><span class="text-cirlce">Funding <br/> and <br/>Sources</span></a>
                    <a href="#" style="cursor: none;" class="pnp "><span class="text-cirlce">Programmes <br>and <br>Projects</span></a>
                @endif

                <a href="{{URL::to('admin/ene')}}" class="ene "><span class="text-cirlce">Efficiency <br>and<br> Effectiveness</span></a>
            </center>
        </div>

        <div class="dots-repeat1">
          <span class="dots2">
                 <?php
              for($i=0; $i<100; $i++)
                  echo ".";
              ?>
          </span>
        </div>
    </div>


    {{--Footer--}}

    <div class="footer">

        <div class="logo-tech4i2" style=" width: 150px;height: 117px;position: relative;left: -52px;display: inline-block;">
            {{ HTML::image('img/footer.png','Logo',  array('class' => 'logo_small_tech4i2')) }}
        </div>


        @if(AdminArea::getLogo())
            <div class="logo" style=" width: 150px; height: 130px; position: relative; left: 250px;display: inline-block;">

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

    var dots = 0;
    var dots1 = 0;

    $(document).ready(function()
    {
        //setInterval (type, 150);
        //setInterval (type1, 150);
    });

    function type()
    {
        if(dots < 100)
        {
            $('.dots1').append('.');
            dots++;
        }
        else
        {
            $('.dots1').html('');
            dots = 0;
        }
    }

    function type1()
    {
        if(dots1 < 100)
        {
            $('.dots2').append('.');
            dots1++;
        }
        else
        {
            $('.dots2').html('');
            dots1 = 0;
        }
    }

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