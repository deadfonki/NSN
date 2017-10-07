




<script>
    $(document).ready(function () {
        $('.content').css('position','fixed');
    });

    function writes(id,did) {
        alert(id);
    }


</script>

<div class="col-md-8 col-sm-10" style="margin-top: 200px;">
<?php
$this->title = 'Диалоги';
$q = new \yii\db\Query();
$friends = $q->select('user_2')->from('friends')->where(['user_1' => Yii::$app->user->id])->all();

$c = count($friends);
$users = array();
for ($i = 0;$i < $c;$i++)
{
    $users = $q->select(['name','last_name','id','username'])->from('user')->where(['id' => $friends[$i]['user_2']])->all();

}

    $data = new \yii\data\ActiveDataProvider([
        'query' => \frontend\models\Dialogs::find()->where(['user_1' => Yii::$app->user->id]),
       'pagination' => false
    ]);

if ($data->totalCount > 0) {
    echo \yii\widgets\ListView::widget([
        'dataProvider' => $data,
        'emptyText' => false,
        'summary' => false,
        'itemView' => '_dial'
    ]);
}
else {


}
?>
</div>