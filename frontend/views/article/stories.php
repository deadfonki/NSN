



















<div class="col-md-12 col-sm-12 " style="margin-top: 30px;">

    <?php

    $data = new \yii\data\ActiveDataProvider([
       'query' => \frontend\models\Stories::find()
    ]);
    echo \yii\widgets\ListView::widget([
       'dataProvider' => $data,
        'summary' => false,
        'emptyText' => 'Рассказов пока нет',
        'itemView' => '_raz'
    ]);
    ?>
</div>