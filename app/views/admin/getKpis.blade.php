<div class="kpi-area2">


    <?php

    $kpi = KPI::where('category_id', '=', $tcode)->get();
    if($kpi == null){
        echo "There are no Kpis for this category...";
    }else{
    foreach($kpi as $t)
    {
    ?>
    <input class="kpi-names" type="checkbox" name="kpi-names" id="kpi-names" value="{{$t->name}}">{{$t->name}}</input><br/>
    <?php
        }
    }
    ?>


</div>