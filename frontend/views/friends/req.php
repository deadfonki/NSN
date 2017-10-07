



<?



$data = new \yii\data\ActiveDataProvider([
    'query' => \frontend\models\Requests::find()->where(['receiver_id' => Yii::$app->user->id]),
]);
echo \yii\widgets\ListView::widget([
    'dataProvider' => $data,
    'itemView' => '_req',
    'emptyText' => '',
    'summary' => false,
]);