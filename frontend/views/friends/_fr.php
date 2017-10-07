



<?php
$friend = \common\models\User::findAll(['id' => $model->user_2]);
?>




<script>
    function rmv(id) {
        $.ajax({
            url:'/friends/rmv',
            data:({id:id}),
            type:'POST',
            success:function (e) {
                if (e == 1) {
                    $.pjax.reload({container: '#fr'});
                }
            }
        })
    }
</script>


<div class="friends"><?php

    ?>
    <?php
    \yii\widgets\Pjax::begin([
       'id' => 'fr'
    ]);
    $s =  count($friend);
    for ($i = 0;$i<$s;$i++)
    {
        $did = Yii::$app->user->id * $friend[$i]['id'];
        echo '<div class="search-item col-md-8 col-sm-12" style="border: 1px solid gray;margin-top: 2%">';
    echo '<div class="img-responsive col-md-2 col-sm-2">';


    if (file_exists('/images/'.$friend[$i]['username'].'/avatar.png'))
    {
        echo  $img = '<a href="/user/show?id'.$friend[$i]['id'].'"><img class="img-circle img-responsive" src="/images/'.$friend[$i]['username'].'/avatar.png"></a>';
    }
    else{
        echo  $img = '<a href="/user/show?id'.$friend[$i]['id'].'"><img class="img-circle img-responsive" src="/images/default_avatar.png"></a>';
    }

 echo '</div>';
        echo '<div class="panel col-md-10 col-sm-10">';
        echo '<a class="btn" href="/user/show?id='.$friend[$i]['id'].'"><span><h3>'.$friend[$i]['name'].' '.$friend[$i]['last_name'].'</h3></span></a>';
        echo '<div class="actions col-md-12 col-sm-12">';
        echo '<a class="btn btn-success" href="/message/dialog?user='.$friend[$i]['id'].'&sel='.$did.'">Написать</a>';
        echo '<btn class="btn" onclick="rmv('.$friend[$i]['id'].')">Удалить</btn>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    \yii\widgets\Pjax::end();
    ?>
</div>