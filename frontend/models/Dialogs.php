<?php
/**
 * Created by PhpStorm.
 * User: deadfonki
 * Date: 09.03.17
 * Time: 7:53
 */

namespace frontend\models;


use yii\db\ActiveRecord;

class Dialogs extends ActiveRecord
{
    public static function tableName()
    {
     return 'dialogs';
    }
}