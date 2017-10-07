<?php
/**
 * Created by PhpStorm.
 * User: kk
 * Date: 12.03.2017
 * Time: 22:36
 */

namespace frontend\controllers;


use common\models\User;
use frontend\models\Friends;
use frontend\models\Requests;
use yii\web\Controller;

class FriendsController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRmv()
    {
        if (\Yii::$app->request->isAjax)
        {
            $id = \Yii::$app->request->post('id');
            if (Friends::deleteAll(['user_1' => \Yii::$app->user->id,'user_2' => $id])) {
               Friends::deleteAll(['user_2' => \Yii::$app->user->id, 'user_1' => $id]);
                    $friends = User::findOne(['id' => $id]);
                    $user = User::findOne(['id' => \Yii::$app->user->id]);
                    \Yii::$app->db->createCommand()->insert('actions',['user_id' =>\Yii::$app->user->id,
                        'text' => 'Удалил из друзей <a href="/user/show?id="'.$id.'">'.$friends['name'].' '.$friends['last_name'].'</a>'])->execute();
                    \Yii::$app->db->createCommand()->insert('actions',['user_id' =>$id,
                        'text' => 'Удалил из друзей <a href="/user/show?id="'.$user['id'].'">'.$user['name'].' '.$user['name'].'</a>'])->execute();
                    return 1;

            }
        }
        return $this->redirect('/');
    }
    public function actionAdd()
    {
        if (\Yii::$app->request->isAjax)
        {
            $id = \Yii::$app->request->post('id');
            if (Requests::deleteAll(['sender_id' => $id,'receiver_id' => \Yii::$app->user->id]))
            {
                if (\Yii::$app->db->createCommand()->insert('friends',['user_1' => \Yii::$app->user->id,'user_2' => $id])->execute())
                {
                    if (\Yii::$app->db->createCommand()->insert('friends',['user_2' => \Yii::$app->user->id,'user_1' => $id])->execute())
                    {
                        $friends = User::findOne(['id' => $id]);
                        $user = User::findOne(['id' => \Yii::$app->user->id]);
                        \Yii::$app->db->createCommand()->insert('actions',['user_id' =>\Yii::$app->user->id,
                            'text' => 'Добавил в друзья <a href="/user/show?id="'.$id.'">'.$friends['name'].' '.$friends['last_name'].'</a>'])->execute();
                        \Yii::$app->db->createCommand()->insert('actions',['user_id' =>$id,
                            'text' => 'Добавил в друзья <a href="/user/show?id="'.$user['id'].'">'.$user['name'].' '.$user['name'].'</a>'])->execute();
                        return 1;
                    }
                }
            }
        }
        return $this->redirect('/');
    }
}