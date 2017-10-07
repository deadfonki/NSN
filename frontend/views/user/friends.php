<?php
$this->title ='Друзья';
?>



<div class="user-search col-md-12 col-sm-12" style="margin-bottom: 7%;">
    <div id="msg">

    </div>
    <?php
    \yii\widgets\Pjax::begin([
        'id' => 'search',
        'options' => [
            'style' => 'margin-top:20px;'
        ]
    ]);

    $data = new \yii\data\ActiveDataProvider([
        'query' => \common\models\User::find()->where(['id' => $user['id']])
    ]);
    echo \yii\widgets\ListView::widget([
        'dataProvider' => $data,
        'summary' => false,
        'emptyText' => 'Ничего не найдено',
        'itemView' => '_lis'
    ]);



    \yii\widgets\Pjax::end();
    ?>
</div>
</div>
