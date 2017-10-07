

<?php
$this->title = 'Диалоги';


?>








<div class="col-md-8 col-sm-8 col-sm-offset-1" style="box-shadow:1px 1px 1px 1px black;left: 5%;;top: -140px;width: 100%">
    <?

        $user_2 = \common\models\User::findOne(['id' => $model->user_2]);
        if (file_exists('images/'.$user_2['username'].'/avatar.png'))
        {
            $img = '<img height="50" class="img-responsive col-md-2 col-sm-2 col-md-offset-5 col-sm-offset-5"  src="/images/'.$user_2['username'].'/avatar.png">';
        }
        else{
            $img = '<img style="" height="50" class="img-responsive col-md-2 col-sm-2 col-md-offset-5 col-sm-offset-5"  src="/images/default_avatar.png">';
        }


        echo $img;

        echo '<a class="btn col-md-12 col-sm-12" href="/user/show?id='.$user_2['id'].'">'.$user_2['name'].' '.$user_2['last_name'].'</a>';
        echo '<a class="btn col-md-12 col-sm-12" href="/message/dialog?user='.$model->user_2.'&sel='.$model->id.'">'.$model->last_mess.'</h3>';;





    ?>
</div>