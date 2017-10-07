




<?php
$user = \common\models\User::findOne(['id' => $model->sender_id]);
$id = Yii::$app->request->getQueryParam('user');
$did = Yii::$app->request->getQueryParam('sel');
?>










<script>
    function deletemsg(id) {
        $.ajax({
            url:'/ajax/deletemsg',
            data:({id:id}),
            type:'POST',
            success:function () {
                $.pjax.reload({container: '#msgs'});

            }
        })
    }
</script>

<?
if ($model->receiver_id == Yii::$app->user->id)
{
    echo "<script>
    $('document').ready(function () {


            $.ajax({
                url:'/ajax/read',
                data:({id:".$id.",dial:".$did."}),
                type:'POST',
                success:function () {
                    $.pjax.reload({container: '#msgs'});

                }
            })
        });
       

</script>";
}

if ($model->sender_id == Yii::$app->user->id)
{
    $msg = '<button class="" style="height:10px;width:10px;z-index:-1;background:none;border:none;position:relative:right:200px" onclick="deletemsg('.$model->message_id.')">X</button>';
}
else
{
    $msg = '';
}
if ($model->is_read == 0) {

    echo '<div id="msg-string" style="background: gray;box-shadow: 1px 0 1px 5px gray;margin-bottom: 16px" class="col-md-12 col-sm-12">';
    echo '<a href="/user/show?id=' . $model->sender_id . '"><span>' . $user['name'] . ' ' . $user['last_name'] . '</span></a>'.$msg;
    echo '<h5  style="">' . $model->message . '</h5>';
    echo '</div>';

}
else
{
    echo '<div id="msg-string" style="box-shadow: 1px 0 3px 3px gray;margin-bottom: 16px" class="col-md-12 col-sm-12">';
    echo '<a href="/user/show?id=' . $model->sender_id . '"><span>' . $user['name'] . ' ' . $user['last_name'] . '</span></a>'.$msg;
    echo '<h5  style="">' . $model->message . '</h5>';
    echo '</div>';
}
?>





