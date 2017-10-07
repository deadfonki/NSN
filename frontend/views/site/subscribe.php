<?php




$theme = Yii::$app->db->createCommand('SELECT * FROM themes')
    ->queryAll();

$theme = \yii\helpers\ArrayHelper::map($theme,'id','name');

$this->title = 'Подписаться';

?>



<script>
  $('#subs').modal('show');
</script>



<?php
$model = new \frontend\models\SubsModel();

 \yii\bootstrap\Modal::begin([
     'id' => 'subs',
'header' => 'Выберите одну или несколько интересующих вас рубрик',
     'size' => 'modal-lg',
     'toggleButton' => [
       'id' => 'subsbtn',
         'label' => '',
         'style' => 'background:transparent;border:none'
     ],
     'closeButton' => false,
     'clientOptions' => ['show' => true,'keyboard' => false,'backdrop' => 'static']
 ]);

$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'subs')->listBox($theme,['multiple' => true,'style' => 'height:400px'])->label('');

echo \yii\bootstrap\Html::submitButton('Подтвердить выбор',['class' => 'btn btn-success col-sm-offset-5 col-md-offset-5','style' => '']);
\yii\bootstrap\ActiveForm::end();

 \yii\bootstrap\Modal::end();
