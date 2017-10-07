



<?php

$date = explode(' ',$model->date);
$date = explode('-',$date[0]);
$date = $date[0].'.'.$date[1].'.'.$date[2];
?>


<div  class="new-item col-sm-12 col-md-12 " style="box-shadow: 1px 1px 1px 2px darkgray;margin-bottom: 9px;margin-left: 13%">
        <img  src="/new_img/<?=$model->id?>.png" class="img-responsive col-sm-offset-5 col-md-offset-5">

   <center><h3 class=""><?=$model->name?></h3></center>
    <center><h6  ><?=$date?></h6></center>
    <center>  <p><?=$model->short_description?></p>
    <a href="/article?id=<?=$model->id?>">Подробнее</a></center>

</div>