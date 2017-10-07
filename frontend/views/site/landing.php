<?php

use \yii\bootstrap\ActiveForm;
use \yii\bootstrap\Html;
$this->title = 'Добро пожаловать в NSN';
\frontend\assets\AppAsset::register($this);
?>
<script>
    $(document).ready(function () {
        $('content').css('background','#edeef0')
    })
</script>
<div class="site-landing row" style="background: #edeef0;">
<div class=" col-md-5 col-sm-5 col-xs-5 info" style="margin-top:10%;box-shadow: 1px 1px 1px 5px darkgray">

        <div class="info-block col-md-12 col-xs-12 col-sm-12">
            <h3 >NSN</h3>
            <p>Новостная социальная сеть с авторским контентом.
            Последнее время многие социальные сети утеряли свою уникальность
                так же сообщества в них перестали генерировать контент
                именно по-этому мы разработали для вас социальную сеть
                в которой наши авторы будут создавать для вас уникальный и интересный контент
                Чтобы получить доступ к которому,вам остается только зарегистрироваться
            </p>
        </div>
    <div class="info-block col-md-12 col-xs-12 col-sm-12">
        <h3>Особенности</h3>
        <p>После регистрации вам нужно будет выбрать интересующие вас
        рубрики,а мы в свою очередь будем предоставлять контент по указанным вами категориям
        </p>
    </div>
    <div class="info-block col-md-12 col-xs-12 col-sm-12">

    </div>
</div>
    <div class="user-side col-sm-4 col-md-4 col-xs-4 col-md-offset-3 col-xs-offset-3 col-sm-offset-3">
        <div style="border-bottom: 3px dashed gray">
            <h2>Авторизация</h2>
            <?php
            $model = new \common\models\LoginForm();
            $form = \yii\bootstrap\ActiveForm::begin(['id' => 'login-form','action' => '/site/login']) ?>

            <?= $form->field($model, 'username')->label('Логин')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->label('Пароль')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->label('Запомнить')->checkbox() ?>

<!--            <div style="color:#999;margin:1em 0">-->
<!--                If you forgot your password you can --><?//= Html::a('reset it', ['site/request-password-reset']) ?><!--.-->
<!--            </div>-->

            <div class="form-group">
                <?= \yii\bootstrap\Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button','style' => 'width:100%;']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="" style="">
            <h2>Регистрация</h2>
            <?php
            $model = new \frontend\models\SignupForm();
            $form = ActiveForm::begin(['id' => 'form-signup','action' => '/site/signup']); ?>

            <?= $form->field($model, 'username')->label('Имя пользователя')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'password')->label('Пароль')->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'signup-button','style' => 'width:100%;']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
