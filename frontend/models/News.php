<?php
/**
 * Created by PhpStorm.
 * User: kk
 * Date: 01.03.2017
 * Time: 19:09
 */

namespace frontend\models;


use yii\db\ActiveRecord;

class News extends ActiveRecord
{
    public static function tableName()
    {
     return 'news';
    }
}