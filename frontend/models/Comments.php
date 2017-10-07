<?php
/**
 * Created by PhpStorm.
 * User: kk
 * Date: 01.03.2017
 * Time: 21:14
 */

namespace frontend\models;


use yii\db\ActiveRecord;

class Comments extends ActiveRecord
{
    public static function tableName()
    {
        return 'comments';
    }
}