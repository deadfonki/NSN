

<?php
$this->title ='Поиск';
?>



<div class="user-search col-md-12 col-sm-12" style="margin-top: 6%">

    <?php
    $model = new \frontend\models\SearchModel();
    $form = \yii\bootstrap\ActiveForm::begin([
        'action' => '/user/search',
        'options' => [
            'style' => 'height:5px'
        ]
    ]);
    echo $form->field($model,'string')->label('')->input('text',['placeholder' => 'Введите логин пользователя']);
    \yii\bootstrap\ActiveForm::end();
    ?>
</div>