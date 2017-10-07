<?php

?>

<?php
$user = \common\models\User::findOne(['id' => Yii::$app->request->getQueryParam('id')]);
$this->title = $user['name'].' '.$user['last_name'];



?>





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
                $('#friendbutton').replaceWith('<button id="friendbutton" class="btn col-md-12 col-sm-12" onclick="cancelRequest(<?=$user['id']?>)">Отменить заявку</button>')
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
                $('#friendbutton').replaceWith('<button id="friendbutton" class="btn col-md-12 col-sm-12" onclick="sendRequest(<?=$user['id']?>)">В друзья</button>');
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
                    $('#friendbutton').replaceWith('<button id="friendbutton" class="btn col-md-12 col-sm-12" onclick="sendRequest(<?=$user['id']?>)">В друзья</button>');
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
                    $('#friendbutton').replaceWith('<btn id="friendbutton"  class="btn col-md-12 col-sm-12" onclick="rmv(<?=$user['id']?>)">Удалить</btn>');
                    $.pjax.reload({container:'#search'})
                }
            }
        })
    }
</script>


<div class="user-profile" style="margin-top: 50px;margin-left: 1.2%">
    <div class="cent-block" style="height: 200px;border: 1px dashed;z-index: -2;">
        <?php

        if (file_exists('images/'.$user['username'].'/background.png'))
        {
            echo '<img style="position:relative;width:100%;height:200px;" class="" width="30" src="'.Yii::$app->basePath.'/web/images/'.$user['username'].'/background.png">';
        }
        else{
           echo '<img style="position:relative;width:100%;height:200px;" width="30" src="/images/default_background.png">';

        }

        if (file_exists('images/'.$user['username'].'/avatar.png'))
        {
           echo '<img style="position:relative;top:-200px"  class="col-sm-offset-5 col-md-offset-5" height="130" width="130" class="img-circle"" src="/images/'.$user['username'].'/avatar.png">';
        }
        else{
            echo '<img style="position:relative;top:-200px" height="130" width="130" class="col-sm-offset-5 col-md-offset-5 img-circle" src="/images/default_avatar.png">';
        }



        ?>
        <center><h3 style="position: relative;top: -200px;"><?=$user['name'].' '.$user['last_name']?></h3></center>
        <center><p style="position: relative;top: -210px;"><?=$user['bio']?></p></center>
    </div>
    <center><?php
        $did = Yii::$app->user->id * $user['id'];
        echo '<a class="btn btn-success col-md-12 col-sm-12" href="/message/dialog?user='.$user['id'].'&sel='.$did.'">Написать</a>';
        $request = \frontend\models\Requests::findOne(['sender_id' => Yii::$app->user->id,'receiver_id' => $user['id']]);
        $request_1 = \frontend\models\Requests::findOne(['sender_id' => $user['id'],'receiver_id' => Yii::$app->user->id]);
        $friend = \frontend\models\Friends::findOne(['user_1' => Yii::$app->user->id,'user_2' => $user['id']]);
            if ($user['id']== $request['receiver_id']) {
                echo '<button id="friendbutton" class="btn col-md-12 col-sm-12" onclick="cancelRequest(' . $user['id'] . ')">Отменить заявку</button>';
            } elseif($request_1['sender_id'] == $user['id']) {

                echo '<btn id="friendbutton"  class="btn col-md-12 col-sm-12" onclick="accept(' . $user['id'] . ')">Принять</btn>';

            }
            elseif ($friend['user_2'] == $user['id'])
            {
                echo '<btn id="friendbutton"  class="btn col-md-12 col-sm-12" onclick="rmv('.$user['id'].')">Удалить</btn>';
            }
            else
            {
                echo '<button id="friendbutton" class="btn col-md-12 col-sm-12" onclick="sendRequest(' . $user['id'] . ')">В друзья</button>';
            }


        ?>
        <div class="friend-sec col-md-12 col-sm-12" style="box-shadow: 1px 1px 1px 1px;padding: 9px">
<!--            <a  href="/user/friends?id=--><?//=$user['id']?><!--"> <h3 style="border: 1px solid">--><?//='Друзья '.$user['name'].'а '.$user['last_name'].''?><!--</h3></a>-->

            <?php
            $data = new \yii\data\ActiveDataProvider([
                'query' => \frontend\models\Friends::find()->where(['user_1' => $user['id']])->limit(6)
            ]);
            \yii\bootstrap\Modal::begin([
                    'toggleButton' => [
                            'label' => '<h3>Друзья '.$user['name'].'a '.$user['last_name'].'</h3>',
                        'style' => 'background:transparent;border:none'
                    ]
            ]);
            echo \yii\widgets\ListView::widget([
                'dataProvider' => $data,
                'itemView' => '_frl',
                'emptyText' => false,
                'summary' => false,
            ]);
            \yii\bootstrap\Modal::end();

            echo \yii\widgets\ListView::widget([
                'dataProvider' => $data,
                'itemView' => '_fr',
                'emptyText' => false,
                'summary' => false,
            ]);
            ?>
        </div>
        <div class="actions-sec col-md-12 col-sm-12" style="padding: 20px;box-shadow: 1px 1px 1px 3px">
            <?php
            $data = new \yii\data\ActiveDataProvider([
                'query' => \frontend\models\Actions::find()->where(['user_id' => $user['id']])
            ]);
            echo \yii\widgets\ListView::widget([
                'dataProvider' => $data,
                'itemView' => '_ac',
                'emptyText' => false,
                'summary' => false,
            ]);

            ?>
        </div>
    </center>

</div>