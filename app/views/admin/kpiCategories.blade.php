<div class="project-area1">
    <select class="activity_area_select" size = 17>
        <?php
        $cat = Category::where('theme_id', '=', $tid)->get();
        if($cat == null){
            echo "There are no Categories for this Theme...";
        }else{
        foreach($cat as $t)
        {?>
        <option value="{{$t->code}}">{{$t->name}}</option>
        <?php }
        }
        ?>
    </select>
</div>

