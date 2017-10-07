



<?php
$user = \common\models\User::findAll(['id' => $model->user_2]);
?>













    <?


$s = count($user);

for($i = 0;$i < $s;$i++)
{

    if (file_exists('images/'.$user[$i]['username'].'/background.png'))
    {
        $bg = '/images/'.$user[$i]['username'].'/background.png';
    }
    else{
        $bg = '/images/default_background.png';
    }
    echo '<a href="/user/show?id='.$user[$i]['id'].'"><div class="friend" style="width: 100%;height:100px;background: url('.$bg.') no-repeat">';


    if (file_exists('images/'.$user[$i]['username'].'/avatar.png'))
    {
        echo '<img  height="60" width="60" src="/images/'.$user[$i]['username'].'/avatar.png">';
    }
    else{
        echo '<img class="" height="60" width="60" src="/images/default_avatar.png">';
    }

    echo '</div></a>';
}
    ?>
