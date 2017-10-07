


<script>
function sendRequest(id) {
    var id = id;
    $.ajax({
        url:'/ajax/requestfriend',
        data:({id:id}),
        type:'POST',
        success:function () {
            $('#msg').append('<span>Ваша заявка успешно отправлена</span>');
            $('#msg').fadeOut(4000);
            $('#friendbutton').replaceWith('<button id="friendbutton" class="btn" onclick="cancelRequest(<?=$model->id?>)">Отменить заявку</button>')
        }
    });
}

function cancelRequest(id) {
    var id = id;
    $.ajax({
        url:'/ajax/cancelfriend',
        data:({id:id}),
        type:'POST',
        success:function () {
            $('#friendbutton').replaceWith('<button id="friendbutton" class="btn" onclick="sendRequest(<?=$model->id?>)">В друзья</button>');
        }
    });
}
function rmv(id) {
    $.ajax({
        url:'/friends/rmv',
        data:({id:id}),
        type:'POST',
        success:function (e) {
            if (e == 1) {
                $.pjax.reload({container: '#search'});
            }
        }
    })
}
function accept(id) {
    $.ajax({
        url:'/friends/add',
        data:({id:id}),
        type:'POST',
        success:function (e) {
            if(e == 1)
            {
                $.pjax.reload({container:'#search'})
            }
        }
    })
}
</script>


<div class="search-item col-md-8 col-sm-12" style="border: 1px solid gray;margin-top: 2%">
<div class="img-responsive col-md-2 col-sm-2">
    <?php

    $request = \frontend\models\Requests::findOne(['sender_id' => Yii::$app->user->id,'receiver_id' => $model->id]);
    $request_1 = \frontend\models\Requests::findOne(['sender_id' => $model->id,'receiver_id' => Yii::$app->user->id]);
    $friend = \frontend\models\Friends::findOne(['user_1' => Yii::$app->user->id,'user_2' => $model->id]);
    if (file_exists('images/'.$model->username.'/avatar.png'))
    {
      echo  $img = '<a href="/user/show?id'.$model->id.'"><img class="img-circle img-responsive " src="/images/'.$model->username.'/avatar.png"></a>';
    }
    else{
      echo  $img = '<a href="/user/show?id'.$model->id.'"><img class="img-circle img-responsive" src="/images/default_avatar.png"></a>';
    }
    ?>
</div>
    <div class="panel col-md-10 col-sm-10">
        <?php
        $did = Yii::$app->user->id * $model->id;
        ?>
        <a class="btn" href="/user/show?id=<?=$model->id?>"><span><h3><?=$model->name.' '.$model->last_name?></h3></span></a>
        <div class="actions col-md-12 col-sm-12">
            <?php

            if ($model->id != Yii::$app->user->id) {
                if ($model->id == $request['receiver_id']) {
                    echo '<button id="friendbutton" class="btn" onclick="cancelRequest(' . $model->id . ')">Отменить заявку</button>';
                } elseif($request_1['sender_id'] == $model->id) {

                    echo '<btn class="btn" onclick="accept(' . $model->id . ')">Принять</btn>';

                }
                elseif ($friend['user_2'] == $model->id)
                {
                    echo '<btn class="btn" onclick="rmv('.$model->id.')">Удалить</btn>';
                }
                else
                {
                    echo '<button id="friendbutton" class="btn" onclick="sendRequest(' . $model->id . ')">В друзья</button>';
                }


            }
            ?>

            <?php
            if ($model->id != Yii::$app->user->id)
            {
                echo '<a class="btn" href="/message/dialog?user='.$model->id.'&sel='.$did.'">Написать</a>';
            }
            else
            {
                echo '';
            }
            ?>
        </div>
    </div>
</div>