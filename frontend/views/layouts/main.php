<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
$user = \common\models\User::findOne(['id' => Yii::$app->user->id]);
$model = new \frontend\models\SearchModel();
AppAsset::register($this);

?>


<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <meta name="yandex-verification" content="b71fb629b9acc235" />
    <link rel="stylesheet" href="/css/my.css">
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
    .bar > li :first-child{
       background: #7dc3ff;
        width: 100%;
        margin-bottom: 2px;
        border-radius: 0;
    }
    .bar > li :first-child:hover{
        background: #4395da;
    }

    body{
        overflow-x: hidden;
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

    if (!Yii::$app->user->isGuest)
    {
        $settings = \frontend\models\Settings::findOne(['user_id' => Yii::$app->user->id]);
        if (!empty($settings['overlay_color']))
        {
            $coloru = $settings['overlay_color'];
        }
        else{
            $coloru = 'gray';
        }
        if (!Yii::$app->user->isGuest) {
            $query = new \yii\db\Query();

            $message = $query->select('message_id')->from('messages')->where(['receiver_id' => Yii::$app->user->id, 'is_read' => '0']);
            $message = $message->all();
            $c = count($message);

            if ($c >= 1) {
                $c = '+'.count($message);
            } else {
                $c = '';
            }
        }
        echo '<div class="sidebar col-md-3 col-sm-3 col-xs-3" style="position: fixed;left: 0px;background: '.$coloru.';height: 100%;">
        <center><div class="logo col-md-12 col-sm-12 col-xs-12">
           <a href="/"><img src="/simg/logo.png" height="60" class=" img-circle"></a>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">';

        $model = new \frontend\models\SearchModel();
        $form = \yii\bootstrap\ActiveForm::begin([
            'action' => '/user/search',
            'options' => [
                'style' => '',
                'class' => 'col-md-12 col-sm-9 col-xs-12'
            ]
        ]);
        echo $form->field($model,'string')->label('')->input('text',['placeholder' => 'Введите логин пользователя','style' => 'width:20%;position:fixed;']);
        \yii\bootstrap\ActiveForm::end();
        if (file_exists(Yii::$app->basePath.'/web/images/'.$user['username'].'/avatar.png'))
        {
            $img = '<img height="25" class="img-circle"  src="/images/'.Yii::$app->user->identity->username.'/avatar.png">';
        }
        else{
            $img = '<img height="25" class="img-circle"  src="/images/default_avatar.png">';
        }
        if (file_exists(Yii::$app->basePath.'/web/images/'.$user['username'].'/background.png'))
        {
            $bg = '/images/'.Yii::$app->user->identity->username.'/background.png';
        }
        else{
            $bg = '/images/default_background.png';
        }

        echo '</div>
        <div class="col-lg-12 col-sm-12 col-xs-12 " style="background: url('.$bg.') ;margin-top: 25px;">
            <a class="" style="background:'.$settings['overlay_color'].';box-shadow: 1px 1px 1px 1px gray" href="/user">'.$img.'<strong><span>'.$user['name'].' '.$user['last_name'].'</span></strong></a>
        </div>
            <ul  style="list-style-type: none;display: block;background: transparent;margin-top: 35%" class="col-sm-12 col-md-12 bar" id="bar" >
                <li class="mli col-md-12"><a class="btn" href="/user">Моя страница</a></li>
                <li class="mli col-md-12"><a class="btn" href="/message">Сообщения<span style="border-radius:4px">'.$c.'</span></a></li>
                <li class="mli col-md-12"><a class="btn" href="/friends">Друзья</a></li>
                
                <li class="mli col-md-12"><a class="btn" href="/user/settings">Настройки</a></li>
                <li class="mli col-md-12"><a class="btn" href="/site/logout">Выйти</a></li>
            </ul></center>
    </div>
    <div class="ad col-md-1 col-sm-1 col-sm-offset-3 col-md-offset-3 col-xs-offset-3" style="position: fixed;height: 100%;background:'.$coloru.';">

    </div>

    <div class="content col-md-9 col-sm-8 col-sm-offset-4 col-md-offset-4 col-xs-offset-4" style="position: relative;min-height:1080px;height: 120%;background: '.$coloru.';">';

       echo Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ;

        echo Alert::widget() ;
        echo $content;

        echo '    </div>
</div>';
    }
    else
    {
        echo '<style>
::-webkit-scrollbar
{
  width: 5px;  /* for vertical scrollbars */
}
::-webkit-scrollbar-track
{
  background:#E4F1FE;

}
</style>';
     echo '<div class="content col-md-12 col-sm-12 col-xs-12" style="height: 100%;background: #edeef0;overflow-y: scroll">';
    echo Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ;
    echo Alert::widget() ;
    echo $content;
echo '</div>';


    }
    ?>
</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
