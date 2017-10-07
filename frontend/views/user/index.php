<?php

?>

<?php
$this->title = 'Моя страница';


$users = new \frontend\models\UserSettings();
?>





<script>
    $(document).ready(function () {

    })
</script>


<center><div class="user-profile col-md-9 col-sm-12" style="margin-top: 50px;">
    <div class="cent-block" style="height: 200px;border: 1px dashed;z-index: -2;">
        <?php

        if (file_exists('images/'.$user['username'].'/background.png'))
        {
            \yii\bootstrap\Modal::begin([
                'header' => 'Сменить Фон',
                'toggleButton' => [
                    'tag' => 'div',
                    'label' => '<img style="position:relative;width:100%;height:200px;"   class="" src="/images/'.$user['username'].'/background.png">',
                    'class' => '',
                    'style' => 'height:100%'
                ]
            ]);


            echo \yii\bootstrap\Html::beginForm('/user/loadbg','post',['enctype' => 'multipart/form-data']);
            echo \yii\bootstrap\Html::fileInput('bg');
            echo \yii\bootstrap\Html::submitButton('Сменить Фон');
            echo \yii\bootstrap\Html::endForm();

            \yii\bootstrap\Modal::end();


        }
        else
        {

            \yii\bootstrap\Modal::begin([
                'header' => 'Сменить Фон',
                'toggleButton' => [
                    'tag' => 'div',
                    'label' => '<img style="position:relative;width:100%;height:200px;"   class="" src="/images/default_background.png">',
                    'class' => '',
                    'style' => 'height:100%'
                ]
            ]);

            echo \yii\bootstrap\Html::beginForm('/user/loadbg','post',['enctype' => 'multipart/form-data']);
            echo \yii\bootstrap\Html::fileInput('bg');
            echo \yii\bootstrap\Html::submitButton('Сменить Фон');
            echo \yii\bootstrap\Html::endForm();
            \yii\bootstrap\Modal::end();
        }

        if (file_exists('images/'.$user['username'].'/avatar.png'))
        {
            \yii\bootstrap\Modal::begin([
                'header' => 'Сменить Аватар',
                'toggleButton' => [
                    'tag' => 'a',
                    'label' => '<img class="img-circle" style="" height="130" width="130" class="img-circle" src="'.$user['img_path'].'/avatar.png">',
                    'class' => '',
                    'style' => 'position:relative;top:-200px'

                ]
            ]);


            echo \yii\bootstrap\Html::beginForm('/user/loadav','post',['enctype' => 'multipart/form-data']);
            echo \yii\bootstrap\Html::fileInput('av');
            echo \yii\bootstrap\Html::submitButton('Сменить Аватар');
            echo \yii\bootstrap\Html::endForm();
            \yii\bootstrap\Modal::end();
        }
        else{
            \yii\bootstrap\Modal::begin([
                'header' => 'Сменить Аватар',
                'toggleButton' => [
                        'tag' => 'a',
                        'label' => '<img style="" class="img-circle" src="/images/default_avatar.png">',
                    'class' => '',
                    'style' => 'position:relative;top:-200px'

                ]
            ]);
            echo \yii\bootstrap\Html::beginForm('/user/loadav','post',['enctype' => 'multipart/form-data']);
            echo \yii\bootstrap\Html::fileInput('av');
            echo \yii\bootstrap\Html::submitButton('Сменить Аватар');
            echo \yii\bootstrap\Html::endForm();

            \yii\bootstrap\Modal::end();

        }



        ?>

        <h3 style="background:gray;position: relative;top: -193px;"><?=$user['name'].' '.$user['last_name']?></h3>
        <p style="background:gray;position: relative;top: -203px;"><?=$user['bio']?></p>
    </div>
    <center><?php
        $model = new \frontend\models\UserSettings();
        \yii\bootstrap\Modal::begin([
           'header' => 'Настройки профиля',
            'toggleButton' => [
                'label' => 'Изменить профиль',
                'class' => 'btn',
                'style' => 'border-radius:0px;width:100%'
            ]
        ]);
        $form = \yii\bootstrap\ActiveForm::begin([
            'method' => 'post',
            'options' => ['enctype' => 'multipart/form-data']
        ]);
        echo $form->field($model,'name')->label('')->input('text',['placeholder' => 'Имя','value' => $user['name']]);
        echo $form->field($model,'last')->label('')->input('text',['placeholder' => 'Фамилия','value' => $user['last_name']]);
        echo $form->field($model,'bio')->label('')->textarea(['placeholder' => 'Биография','style' => 'resize:none','value' => $user['bio']]);
        echo \yii\bootstrap\Html::submitButton('Сохранить',['class' => 'btn btn-success']);
        \yii\bootstrap\ActiveForm::end();
        \yii\bootstrap\Modal::end();
        ?>
         <div class="friend-sec col-md-12 col-sm-12" style="box-shadow: 1px 1px 1px 1px;padding: 9px">
<!--             <a href="/user/friends?id=--><?//=$user['id']?><!--"> <h3 style="border: 1px solid">--><?//='Друзья '.$user['name'].'а '.$user['last_name'].''?><!--</h3></a>-->
       <h3>Друзья</h3>
        <?php
        $data = new \yii\data\ActiveDataProvider([
           'query' => \frontend\models\Friends::find()->where(['user_1' => Yii::$app->user->id])->limit(6)
        ]);
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
                'query' => \frontend\models\Actions::find()->where(['user_id' => Yii::$app->user->id])->orderBy('date DESC'),
                'pagination' => [
                        'pageSize' => 5
                ]
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

</div></center>