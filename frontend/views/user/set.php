


<script>
    $(document).ready(function () {
        $('.content').css('position','fixed');
    });
    function clean() {
        $.ajax({
            url:'/ajax/clean',

        })
    }
    function cleanMsg() {
        $.ajax({
            url:'/ajax/cleanmsg'

        })
    }
</script>



<div class="col-md-12 col-sm-12 col-xs-12">
    <div id="" style="margin-top: 20px;">
        <center><h3 style="filter: invert(100%)">Выберите цвет интерфейса</h3></center>
    <?php
    $this->title = 'Настройки';
    $data = new \yii\data\ActiveDataProvider([
       'query' => \frontend\models\Colors::find(),
        'pagination' => false
    ]);
  echo  \yii\widgets\ListView::widget([
        'dataProvider' => $data,
        'emptyText' => false,
        'summary' => false,
      'itemView' => '_colors',
      'options' => [
          'class' => 'col-md-12 col-sm-12 col-xs-12',
          'style' => 'box-shadow: 1px 1px 1px 2px black;padding:20px;background:'
      ]
    ]);

    ?>
</div>
    <div id="actions " class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
        <button class="btn" onclick="clean()">Очистить стену</button>
        <button class="btn" onclick="cleanMsg()">Очистить диалоги</button>
    </div>
</div>