<?php
/**
 * Created by PhpStorm.
 * User: deadfonki
 * Date: 08.03.17
 * Time: 10:36
 */

namespace frontend\controllers;


use frontend\models\Actions;
use frontend\models\Colors;
use frontend\models\Dialogs;
use frontend\models\Messages;
use frontend\models\Requests;
use frontend\models\Settings;
use yii\db\Query;
use yii\web\Controller;

class AjaxController extends Controller
{

    public function actionRequestfriend()
    {
        if (\Yii::$app->request->isAjax)
        {
            $model = new Requests();
            $id = \Yii::$app->request->post('id');

            $model->sender_id = \Yii::$app->user->id;
            $model->receiver_id = $id;
            $model->save();
        }
    }


    public function actionCancelfriend()
    {
        if (\Yii::$app->request->isAjax)
        {

            $id = \Yii::$app->request->post('id');
            Requests::deleteAll(['receiver_id' => $id,'sender_id' => \Yii::$app->user->id]);
        }
    }


    public function actionSend()
    {
        if (\Yii::$app->request->isAjax)
        {
            $q = new Query();
            $id = \Yii::$app->request->post('id');
            $text = \Yii::$app->request->post('text');
            $d_id = \Yii::$app->request->post('d_id');
            $model = new Messages();
            $d = $q->select('id')->from('dialogs')->where(['id' => $d_id])->all();
            $dial = Dialogs::findOne(['id' => $d_id,'user_1' => \Yii::$app->user->id]);
            $dial2 = Dialogs::findOne(['id' => $d_id,'user_1' => $id]);
            $user = \Yii::$app->request->post('user');
            if (empty($d))
            {

//                $dialog = new Dialogs();
//                $dialog->id = $d_id;
//                $dialog->user_1 = \Yii::$app->user->id;
//                $dialog->user_2 = $id;
//                $dialog->last_mess = $texst;
//                $dialog->save();
//                $dialog->id = $d_id;
//                $dialog->user_1 = $id;
//                $dialog->user_2 = \Yii::$app->user->id;
//                $dialog->last_mess = $text;
//                $dialog->save();

                \Yii::$app->db->createCommand()->insert('dialogs',['id' => $d_id,'user_1' => $id,'user_2' => \Yii::$app->user->id,
                'last_mess' => $text])->execute();
                \Yii::$app->db->createCommand()->insert('dialogs',['id' => $d_id,'user_1' => \Yii::$app->user->id,'user_2' => $id,
                    'last_mess' => $text])->execute();
                $model->message = $text;
                $model->dialog_id = $d_id;
                $model->receiver_id = $user;
                $model->sender_id = \Yii::$app->user->id;
                $model->save();
            }
            else{
                $dial->last_mess = $text;
                $dial->update();
                $dial2->last_mess = $text;
                $dial2->update();
                $model->message = $text;
                $model->dialog_id = $d_id;
                $model->receiver_id = $user;
                $model->sender_id = \Yii::$app->user->id;
                $model->save();
            }
        }
    }

    public function actionClean()
    {
        if (\Yii::$app->request->isAjax) {
            Actions::deleteAll(['user_id' => \Yii::$app->user->id]);
        }
    }

    public function actionDeletemsg()
    {
        if (\Yii::$app->request->isAjax) {
            $id = \Yii::$app->request->post('id');
            Messages::deleteAll(['message_id' => $id]);
        }
    }

    public function actionCleanmsg()
    {
        if (\Yii::$app->request->isAjax) {
            Dialogs::deleteAll(['user_1' => \Yii::$app->user->id]);
        }
    }
    public function actionChangec()
    {
        if (\Yii::$app->request->isAjax) {
            $id = \Yii::$app->request->post('id');
            $color = Colors::findOne(['id' => $id]);
            $q = new Query();
            $userset = $q->select('overlay_color')->from('settings')->where(['user_id' => \Yii::$app->user->id])->all();

            if (empty($userset))
            {
                \Yii::$app->db->createCommand()->insert('settings',['user_id' => \Yii::$app->user->id,'overlay_color' =>
                $color['color']])->execute();
            }
            else{
                \Yii::$app->db->createCommand()->update('settings',['user_id' => \Yii::$app->user->id,'overlay_color' =>
                    $color['color']],['user_id' => \Yii::$app->user->id])->execute();
            }
        }

    }

    public function actionRead()
    {
        if (\Yii::$app->request->isAjax) {
            $id = \Yii::$app->request->post('id');
            $did = \Yii::$app->request->post('dial');

            Messages::updateAll(['is_read' => 1], ['receiver_id' => \Yii::$app->user->id,'dialog_id' => $did]);
        }
    }

}