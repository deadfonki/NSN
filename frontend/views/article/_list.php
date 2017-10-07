


<?php

?>




<div class="col-md-7 col-sm-9 comment" style="box-shadow: 1px 1px 1px 1px black;margin-bottom: 6px">
    <img class="col-md-2 col-sm-2 img-responsive" src="<?=$model->avatar_path?>" >
    <a href="/user/show?id=<?=$model->user_id?>"><h6 class="col-sm-9 col-md-9"><?=$model->f_name.' '. $model->s_name?></h6></a>
    <p class="col-md-9 col-sm-9 col-sm-offset-3 col-md-offset-3"><?=$model->text?></p>
</div>