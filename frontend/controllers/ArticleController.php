<?php
/**
 * Created by PhpStorm.
 * User: kk
 * Date: 01.03.2017
 * Time: 20:40
 */

namespace frontend\controllers;


use common\models\User;
use frontend\models\Comments;
use frontend\models\News;
use yii\web\Controller;

class ArticleController extends Controller
{

    public function actionIndex()
    {
        $id = \Yii::$app->request->getQueryParam('id');
        if (isset($id)) {
            $new = News::findOne(['id' => $id]);
            return $this->render('index', ['new' => $new]);
        }
        else
        {
            return $this->redirect('/');
        }
    }

    public function actionCommadd()
    {
        if (\Yii::$app->request->isAjax)
        {
            $model = new Comments();
            $user = User::findOne(['id' => \Yii::$app->user->id]);
            $text = \Yii::$app->request->post('text');
            $id = \Yii::$app->request->post('id');
            $model->text = $text;
            $model->user_id = \Yii::$app->user->id;
            $model->article_id = $id;
            $model->f_name = $user['name'];
            $model->s_name = $user['last_name'];
            if (file_exists('images/'.\Yii::$app->user->identity->username.'/avatar.png')) {
                $model->avatar_path =  '/images/'.\Yii::$app->user->identity->username.'/avatar.png';
            }
            else
            {
                $model->avatar_path = '/images/default_avatar.png';
            }
            if ($model->save())
            {
                \Yii::$app->db->createCommand()
                    ->insert('actions',['user_id' => \Yii::$app->user->id,
                        'text' => 'Сказал:"-'.$text.'." под <a href="/article?id='.$id.'">Записью</a>'])
                    ->execute();
            }
        }
        else{

        }
    }

    public function actionStories()
    {
        return $this->render('stories');
    }

}