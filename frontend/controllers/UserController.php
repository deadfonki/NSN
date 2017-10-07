<?php
/**
 * Created by PhpStorm.
 * User: kk
 * Date: 01.03.2017
 * Time: 17:01
 */

namespace frontend\controllers;


use common\models\User;
use frontend\models\SearchModel;
use frontend\models\UserSettings;
use yii\web\Controller;
use yii\web\UploadedFile;

class UserController extends Controller
{



    public function actionIndex()
    {
        $user = User::findOne(['id' => \Yii::$app->user->id]);
        $model = new UserSettings();
        if ($model->load(\Yii::$app->request->post()) && $model->validate())
        {
            $model->updateInfo();
            return $this->redirect('/user');
        }
        return $this->render('index',['user' => $user,'model' => $model]);
    }


    public function actionSearch()
    {
        $model = new SearchModel();
        if ($model->load(\Yii::$app->request->post()) && $model->validate())
        {
            $string = $model->string;
            return $this->render('search',['string' => $string]);
        }
        return $this->render('searchpage');
    }
//    public function actionLoadbg()
//    {
//        if (\Yii::$app->request->isPost) {
//            $src_filename = UploadedFile::getInstanceByName('bg');
//
//            if (!empty($src_filename)) {
//                $path = \Yii::$app->basePath.'/web/images/'.\Yii::$app->user->identity->username.'/background.png';
//                if ($src_filename->saveAs($path)) {
//                    return $this->goBack();
//                }
//            }
//
//        }
//    }

    public function actionLoadbg()
    {
        $model = new UserSettings();
        if (\Yii::$app->request->isPost) {
            $src_filename = UploadedFile::getInstanceByName('bg');

            if (!empty($src_filename)) {
                $path = \Yii::$app->basePath.'/web/images/'.\Yii::$app->user->identity->username.'/background.png';
                if ($src_filename->saveAs($path)) {
                    return $this->redirect('/');
                }
            }

        }
    }


    public function actionSettings()
    {
        return $this->render('set');
    }


    public function actionLoadav()
    {
        if (\Yii::$app->request->isPost) {
            $src_filename = UploadedFile::getInstanceByName('av');

            if (!empty($src_filename)) {
                $path = \Yii::$app->basePath . '/web/images/' . \Yii::$app->user->identity->username . '/avatar.png';
                if ($src_filename->saveAs($path,true)) {

                    return $this->redirect('/user');
                } else {
                    return $this->goBack();
                }
            }
        }
    }

        public function actionShow()
        {
            $id = \Yii::$app->request->getQueryParam('id');
            if ($id == \Yii::$app->user->id) {
                return $this->redirect('/user');
            }
            $user = User::findOne(['id' => $id]);
            $model = new UserSettings();

            return $this->render('show', ['user' => $user]);
        }

//    public function actionFriends()
//    {
//        $id = \Yii::$app->request->getQueryParam('id');
//        $user = User::findOne(['id' => $id]);
//        return $this->render('friends',['user' => $user]);
//    }

    }