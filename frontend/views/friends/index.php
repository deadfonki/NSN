<?php
$this->title = 'Друзья';

?>






<div class="col-md-12 col-sm-12" style="margin-top: 50px;">
<?php

    echo \yii\bootstrap\Tabs::widget([
'items' => [
    [
        'label' => 'Друзья',
        'content' => $this->renderFile('@app/views/friends/friends.php'),
        'active' => true,
    ],
    [
        'label' => 'Заявки',
        'content' => $this->renderFile('@app/views/friends/req.php'),
    ],

]
    ]);
    ?>
</div>
