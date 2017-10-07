<?php
/**
 * Created by PhpStorm.
 * User: kk
 * Date: 22.03.2017
 * Time: 16:31
 */

namespace frontend\models;


use yii\db\ActiveRecord;

class Settings extends ActiveRecord
{
    public static function tableName()
    {
     return 'settings';
    }
}