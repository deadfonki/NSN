<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<style>
    .pagination{
        position: absolute;
        top:50px;
        background: gray;
    }
</style>
<script>
    $(document).ready(function () {
        var ss = $('#ss');
        var s = $('#s');
        s.hide();
    });

        


</script>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    $user = \common\models\User::findOne(['id' => Yii::$app->user->id]);
    NavBar::begin([
        'brandLabel' => 'NSN',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',

        ],
    ]);


?>




            <?php
            $model = new \frontend\models\SearchModel();
            $form = \yii\bootstrap\ActiveForm::begin([
                    'action' => '/user/search',
                'options' => [
                        'style' => 'height:5px'
                ]
            ]);
            echo $form->field($model,'string')->label('')->input('text',['placeholder' => 'Введите логин пользователя','style' => 'width:200px;position:fixed;margin-left:200px;']);
            \yii\bootstrap\ActiveForm::end();
            ?>

    <?php


    if (file_exists(Yii::$app->basePath.'/web/images/'.$user['username'].'/avatar.png'))
    {
        $img = '<img height="30" class="" width="30" src="/images/'.Yii::$app->user->identity->username.'/avatar.png">';
    }
    else{
        $img = '<img height="30" width="30" src="/images/default_avatar.png">';
    }


    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Добро пожаловать','url' => '#'];
    } else {

        $menuItems[] = [
          'label' => $img,
            'items' => [
                    ['label' => 'Профиль','url' => '/user'],
                    ['label' => 'Настройка','url' => '/settings'],
                    ['label' => 'Выйти', 'url' => '/site/logout']
            ],
        ];

    }
    echo Nav::widget([
            'encodeLabels' => false,
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <script>


    </script>
    <ul style="list-style-type: none;display: inline-flex;background: grey;position: fixed;" class="col-sm-10 col-md-10 col-sm-offset-1" id="bar" >
        <li class="col-md-2"><a class="btn" href="/user">Моя страница</a></li>
        <li class="col-md-2"><a class="btn" href="/message">Сообщения</a></li>
        <li class="col-md-2"><a class="btn" href="/friends">Друзья</a></li>
        <li class="col-md-2"><a class="btn" href="/video">Видеозаписи</a></li>
        <li class="col-md-2"><a class="btn" href="/music">Музыка</a></li>
        <li class="col-md-2"><a class="btn" href="/help">Помощь</a></li>

    </ul>
    <div class="container" style="">
        <?php
        if (!Yii::$app->user->isGuest)
        {
            $query = new \yii\db\Query();

            $message = $query->select('message_id')->from('messages')->where(['receiver_id' => Yii::$app->user->id,'is_read' => '0']);
            $message = $message->all();
            $c = count($message);

            if ($c >=1)
            {
                $c = count($message);
            }
            else
            {
                $c = '';
            }


            echo '<ul id="menu" style="list-style-type: none;display: inline-flex;background:#A2DED0;position: fixed;" class="col-sm-10 col-md-10 col-sm-offset-1"  >
        <li class="col-md-2"><a class="btn" href="/user">Моя страница</a></li>
        <li class="col-md-2"><a class="btn" href="/message">Сообщения</a><span  style="position: fixed;z-index: 100">
       '.$c.'
</span></li>
        <li class="col-md-2"><a class="btn" href="/friends">Друзья</a></li>
        <li class="col-md-2"><a class="btn" href="/video">Видеозаписи</a></li>
        <li class="col-md-2"><a class="btn" href="/music">Музыка</a></li>
        <li class="col-md-2"><a class="btn" href="/help">Помощь</a></li>
       

    </ul>';
        }
        ?>


        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; NSN <?= '2016 - '.date('Y')  ?></p>

        <p class="pull-right"><span class="col-md-12 col-sm-12"><a class="btn" href="/article/stories">Рассказы</a></span></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
