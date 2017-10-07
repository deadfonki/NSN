<?php
/**
 * Created by PhpStorm.
 * User: deadfonki
 * Date: 08.03.17
 * Time: 10:44
 */

namespace frontend\models;


use yii\db\ActiveRecord;

class Requests extends ActiveRecord
{

    public static function tableName()
    {
     return 'requests';
    }
}