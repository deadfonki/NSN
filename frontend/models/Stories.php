<?php
/**
 * Created by PhpStorm.
 * User: kk
 * Date: 13.03.2017
 * Time: 12:30
 */

namespace frontend\models;


use yii\db\ActiveRecord;

class Stories extends ActiveRecord
{
    public static function tableName()
    {
     return 'stories';
    }
}