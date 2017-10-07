<?php

/* @var $this yii\web\View */

$this->title = 'Главная';

$theme = Yii::$app->db->createCommand('SELECT * FROM themes')
    ->queryAll();

$em = [
        'all' => 'Все'
];
$theme = \yii\helpers\ArrayHelper::map($theme,'id','name');
$theme = \yii\helpers\ArrayHelper::merge($em,$theme);
?>
<script>
    function filter() {
        var q = $('#dd').val();
        location.href = 'http://nsnetwork.tk?query='+q;
        if (q === 'all')
        {
            location.href = 'http://nsnetwork.tk';
        }
    }





</script>
<div class="site-index" style="margin-top: 55px;">

    <div style="top: 52px;right:-5%;position: fixed" class="col-md-2 col-sm-3">
        <?php

        echo \yii\bootstrap\Html::dropDownList('Категории',Yii::$app->request->getQueryParam('query'),$theme,['id' => 'dd','style' => 'width:50%']);
        echo '</br>'.\yii\bootstrap\Html::button('Применить',['class' => 'btn','onclick' => 'filter()','style' => 'width:50%;border:none']);


        ?>
    </div>
    <div class="col-md-8 col-sm-8" style="left: 0">
    <?php

    $user = \common\models\User::findOne(['id' => Yii::$app->user->id]);
    if (Yii::$app->request->getQueryParam('query') != '')
    {
        $q = Yii::$app->request->getQueryParam('query');
        $news = \frontend\models\News::find()->where(['theme' => $q]);
    }
    else
    {
        $news = \frontend\models\News::find();
    }



    $data = new \yii\data\ActiveDataProvider([
            'query' => $news
    ]);

  echo  \yii\widgets\ListView::widget([
       'itemView' => '_list',
      'summary' => false,
      'emptyText' => 'Нет новостей',
        'dataProvider' => $data,
  'options' => [
          'style' => ''
  ]]);
    ?>
    </div>
</div>
