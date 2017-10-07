















<div>

    <?php
    $data = new \yii\data\ActiveDataProvider([
       'query' => \frontend\models\Friends::find()->where(['user_1' => Yii::$app->user->id]),
    ]);
    echo \yii\widgets\ListView::widget([
         'dataProvider' => $data,
         'itemView' => '_fr',
        'emptyText' => 'Нет друзей :(',
        'summary' => false,
    ]);



    ?>
</div>