
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
{{ HTML::style('css/officer.css') }}


@include('./admin/charts')
<?php

$project = Project::where('id', '=', $id)->first();

?>
<div class="wrap">
                                            {{--Header--}}
    <div class="header">
        <div class="header-text">
            Return Due for {{$project->name}}
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

           
            


            <div class="kpis1">

                    <div class="officer-projects">
                    
                        <?php $prid = array(); $prid = OfficerArea::getKpiDues($id) ;
                        $total_kpis = count($prid);
                              $record = OfficerArea::getProjectRecord($id) ;
                              $year = date('Y');
                               $m = date('M');
                               $month = date("n", strtotime($m));

                               if($month>=1 && $month <=3)
                                    $quarter = 1;
                                else if($month>=4 && $month <=6)
                                    $quarter = 2;
                                else if($month>=7 && $month <=9)
                                    $quarter = 3;
                                else if($month>=10 && $month <=12)
                                    $quarter = 4;
                        ?>
                        

                        <table class="tgg">
                              <tr>
                                <td class="tg-s6z2" style="width:30%; font-weight:bold;">Project Name </td>
                                <td class="tg-031e" style="width:70%">{{$project->name}}</td>
                              </tr>
                              <tr>
                                <td class="tg-031e" style="width:30%; font-weight:bold;">Record Schedule</td>
                                <td class="tg-031e" style="width:70%">
                                  @if($record == 'quarterly')
                                      Quarterly
                                   @else
                                     @if($record == 'monthly')
                                        Monthly
                                  @endif
                                  @endif

                                  </td>
                              </tr>
                              <tr>
                                <td class="tg-031e" style="width:30%; font-weight: bold;">For Period</td>
                                <?php if($record == "quarterly"){ ?>
                                     <td class="tg-031e" style="width:70%">{{$year}} Q{{$quarter}}</td>
                                <?php } else if($record == "monthly") {
                                        $dateObj   = DateTime::createFromFormat('!m', $tmonth);
                                        $monthName = $dateObj->format('F');
                                    ?>
                                   <td class="tg-031e" style="width:70%">{{$year}} {{$monthName}}</td>
                                <?php } ?>
                               
                              </tr>
                            </table>


                        <span class="return-due-text"> Return Due for the following Indicator(s):- </span> <br/>
                        {{-- <div class="leave-blank"> </div>
                        <div class='values-header'> Value </div>    --}} 
                        <div class="return-due-projects">
                           @foreach($prid as $key => $value)
                             <?php $pr = Target::where('id', '=', $value)->first(); 
                                $kpid = $pr->kpi_id;
                                $return_id = $pr->return_id;

                                if($kpid!=0)
                                  $kpi = KPI::where('id','=', $kpid)->first();

                              $returns1 = Returns::where('id', '=', $return_id)->first();
                              $records1 = $returns1->record;

                             ?>
                             <div class="return-project-box">
                                {{ $kpi->name}}
                             </div>

                             <div class="submit-project-due-input">
                              <input type="text" class="V_{{$key}}" id="kpi_value_user" placeholder="Enter the Value"/>
                              <span class="R_{{$key}}" id = "{{$value}}" style="display: none;">{{$return_id}}</span>
                             </div>
                           @endforeach
                        </div>                        
                   </div> 
                    <a href="#" class="submit-all-dues" id="sub-due">Submit</a>

                        <input type = "text" id="kpi_count" value="{{$total_kpis}}" style="display: none;"/>


                <div id="dialog" title="Welcome to the Monitoring and Evaluation Dashboard">
                    <p>
                        The monitoring and evaluation software is underpinned by European Commission guidelines and UK government HM Treasury best practices in monitoring and evaluation.  It has been developed to be compatible with PRINCE2 methods, it also draws upon over 30 years of Tech4i2’s practical experience in undertaking monitoring and evaluation studies for all tiers of government throughout the world.
                        A key advantage of the software is the simplicity for users in using the dashboard to examine spending and outputs from the strategic level to the details concerning hundreds of individual projects in <i>‘three-clicks’</i>.

                    </p>
                </div>



            </div>





        <div class="dots-repeat12">
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



    </div>
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

    $("#sub-due").click(function(){  

    var total = $("#kpi_count").val();
    var userid = $("#usrid").val();
    var home = "{{ URL::to('/officer') }}";

    for($i = 0;$i<total;$i++){

        var retid = $(".R_"+$i).text();
        var value = $(".V_"+$i).val();

        var urlget = "{{ URL::to('officer/dues/submit') }}"; 

         if(value < 0)
               value = -100;
             else if(value == "")
              value = -100;
            else if(isNaN($(".V_"+$i).val())){
              value = -100;
            }

            var dataString = 'value='+value + '&retid='+retid ; 

          $.when(
            $.ajax({
                type: "GET",
                url: urlget,
                data: dataString ,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
                },
                success: function(result)
                {
                    
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Error while Submitting...");
                }
            }).done( function( data ) {

                setTimeout(function() {
                    window.location.href = home;
                }, 100);

            })
                .fail( function( reason ) {

                })
        ).then(function(response){
            });
    }

     setTimeout(function() {
                                            window.location.href = home;
                                            }, 100); 
});

    



</script>