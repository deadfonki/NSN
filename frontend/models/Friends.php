<?php
/**
 * Created by PhpStorm.
 * User: kk
 * Date: 12.03.2017
 * Time: 22:47
 */

namespace frontend\models;


use yii\db\ActiveRecord;

class Friends extends ActiveRecord
{

    public static function tableName()
    {
     return 'friends';
    }
}