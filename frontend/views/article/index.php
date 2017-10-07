

<?php

$this->title = $new['name'];
$date = explode(' ',$new['date']);
$date = explode('-',$date[0]);
$date = $date[0].'.'.$date[1].'.'.$date[2];
?>


<script>
    function sendCom() {
        var val = $('#comment').val()
        $.ajax({
            url:'/article/commadd',
            type:'POST',
            data:({text:val,id:<?=$new['id']?>}),
            success:function () {
                $('#al').appendTo('Ваш комментарий был добавлен');
                $.pjax.reload({container:'#comments'});
                $('#comment').text('');
            },
            error:function (e) {
                console.log(e);
            }
        });
        function reload() {
            $.pjax.reload({container:'#comments'});
        }
        setInterval(reload(),100);
    }
</script>

<center style=""><div class="col-md-12 col-sm-12" style="margin-top: 20px;">
    <h2><?=$new['name']?></h2>
        <?php
        $desc = explode('.',$new['description']);
        for($i = 0;$i < count($desc);$i++)
        {
            echo '<p>'.$desc[$i].'</p>';
        }
        ?>

</div>
    <span style="position: relative;top: -100px;"><?=$date?></span>
</center>
<div id="comments-sec " style=";border-top:2px dashed darkgray">
<span id="al"></span>
    <?php
    echo '<div id="form " style="margin-top: 50px;margin-left: 30%;">';
    echo \yii\bootstrap\Html::textarea('comment',null,['placeholder' => 'Ваш комментарий','style' => 'resize:none;width:300px;','id' => 'comment']);
    echo '</br>'.\yii\bootstrap\Html::button('Отправить',['class' => 'btn','style' => 'margin-left: 100px','onclick' => 'sendCom()']);
    echo '</div>';
    echo '<div class="col-sm-12 col-md-6 col-sm-offset-2 col-md-offset-3">';
    \yii\widgets\Pjax::begin([
        'id' => 'comments'
    ]);
    $data = new \yii\data\ActiveDataProvider([
        'query' => \frontend\models\Comments::find()->where(['article_id' => $new['id']])->orderBy('id DESC')
    ]);

    echo \yii\widgets\ListView::widget([
       'dataProvider' => $data,
        'itemView' => '_list',
        'emptyText' => 'Нет комментариев',
        'summary' => false,

    ]);

    \yii\widgets\Pjax::end();
    echo '</div>';
    ?>
</div>