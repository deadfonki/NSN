

<?php
$this->title ='Поиск';
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
    $model = new \frontend\models\SearchModel();
    $form = \yii\bootstrap\ActiveForm::begin([
        'action' => '/user/search',
        'options' => [
            'style' => 'height:5px;margin-bottom:40px;'
        ]
    ]);
    echo $form->field($model,'string')->label('')->input('text',['placeholder' => 'Введите логин пользователя']);
    \yii\bootstrap\ActiveForm::end();
    $data = new \yii\data\ActiveDataProvider([
        'query' => \common\models\User::find()->where(['username' => $string])->orWhere(['name' => $string])->orWhere(['last_name' => $string]),
    ]);
    echo \yii\widgets\ListView::widget([
        'dataProvider' => $data,
        'summary' => false,
        'emptyText' => 'Ничего не найдено',
        'itemView' => '_list'
    ]);



    \yii\widgets\Pjax::end();
    ?>
</div>
</div>