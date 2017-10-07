
<?php

$user = \common\models\User::findOne(['id' => Yii::$app->request->getQueryParam('user')]);

$this->title = 'Диалог с '.$user['name'].' '.$user['last_name'];

$d = \frontend\models\Dialogs::findOne(['user_1' => Yii::$app->user->id,'user_2' => Yii::$app->request->getQueryParam('user')]);
$id = Yii::$app->request->getQueryParam('user');
$did = Yii::$app->request->getQueryParam('sel');
?>


<script>
    
    function send(id) {
        var ids = id;
        var text = $('textarea').val();
        if(text != '') {
            $.ajax({
                url: '/ajax/send',
                data: ({id: ids, text: text, d_id: <?=$did?>,user:<?=$id?>}),
                type: 'POST',
                success: function () {
                    $('textarea').val('');
                update();



                },
                error: function (e) {
                    console.log(e);
                }
            });
        }
    }

    function update() {
        $.pjax.reload({container: '#msgs'});
    }
    setInterval('update()',1000);


</script>








<center><div><div class="dialogs" style="margin-top: 10%;display: block;background: white">

    <?php
    $data = new \yii\data\ActiveDataProvider([
        'query' => \frontend\models\Messages::find()->where(['dialog_id' => $did])->orderBy('message_id ASC'),
       'pagination' => false
    ]);
\yii\widgets\Pjax::begin([
   'id' => 'msgs'
]);
    echo \yii\widgets\ListView::widget([
       'dataProvider' => $data,
        'itemView' => '_list',
        'emptyText' => 'Нет сообщений',
        'summary' => false,
        'options' => [
                'class' => 'col-md-6 col-sm-12 col-xs-6 col-md-offset-2',
            'style' => 'top:-50px'
        ]
    ]);

    \yii\widgets\Pjax::end();
    ?>
    </div>
   <center> <div class="col-md-8 col-sm-8" style="position: fixed;bottom: 10%">
        <?php
        echo \yii\bootstrap\Html::textarea('','',[
            'style' => 'resize:none',
            'class' => 'col-md-10 col-sm-12',
            'rows' => '6',
            'cols' => '50',
            'id' => 'msg'
        ]);
        echo \yii\bootstrap\Html::button('Отправить',['class' => 'btn send','onclick' => 'send('.$id.')','style' => 'width:200px']);
        ?>
    </div></center>
</div></center>