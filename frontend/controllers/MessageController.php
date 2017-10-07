<?php
/**
 * Created by PhpStorm.
 * User: deadfonki
 * Date: 09.03.17
 * Time: 7:02
 */

namespace frontend\controllers;


use yii\web\Controller;

class MessageController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDialog()
    {
        if (\Yii::$app->request->isAjax)
        {

        }
        return $this->render('dial');
    }
}