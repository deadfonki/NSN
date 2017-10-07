<?php
/**
 * Created by PhpStorm.
 * User: kk
 * Date: 01.03.2017
 * Time: 17:37
 */

namespace frontend\models;


use yii\db\ActiveRecord;

class Themes extends ActiveRecord
{


    public static function tableName()
    {
     return 'themes';
    }
}