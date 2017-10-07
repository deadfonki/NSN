<?php




$this->title = 'Активация';
$user = \common\models\User::findOne(['id' => Yii::$app->user->id]);
?>
<script>

</script>
<div class="site-activation">

    <p>Вам на почту <?=$user['email']?> был выслан 5-6 значный  код <span>Пример:<button class="btn"><?=rand(000000,999999)?></button></span> </p>
    <?php
    $model = new \frontend\models\Activate();

$form = \yii\bootstrap\ActiveForm::begin([

]);

echo $form->field($model,'input')->input('text',['placeholder' => 'Введите код','style' => 'width:300px;'])->label('');
echo \yii\bootstrap\Html::submitButton('Отправить',['class' => 'btn btn-success','style' => 'margin-left:100px']);


\yii\bootstrap\ActiveForm::end();
    ?>
</div>
