



<?php
$user = \common\models\User::findAll(['id' => $model->user_2]);
?>













    <?
    $s = count($user);

    for($i = 0;$i < $s;$i++)
    {
        echo '<div class="col-sm-2 col-md-2" style="box-shadow: 1px 1px 1px 1px"><a class="" href="/user/show?id='.$user[$i]['id'].'">';
        if (file_exists('images/'.$user[$i]['username'].'/avatar.png'))
        {
            echo '<img height="40" class="" width="40" src="/images/'.$user[$i]['username'].'/avatar.png">';
        }
        else{
            echo '<img height="40" width="40" src="/images/default_avatar.png">';
        }

        echo ''.$user[$i]['name'].' '.$user[$i]['last_name'].'';

    }
    echo '</a></div>';
    ?>
