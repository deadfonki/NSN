



<?php

$date = $model->date;
$date = explode(' ',$date);
$date = explode('-',$date[0]);
$date = $date[2].'.'.$date[1].'.'.$date[0];
?>















<div class="col-md-12 col-sm-12" style="box-shadow: 1px 1px 1px 2px;margin-bottom: 10px">
<p><?=$date?></p>
    <h3><?=$model->text?></h3>
</div>