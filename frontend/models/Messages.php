<?php
/**
 * Created by PhpStorm.
 * User: deadfonki
 * Date: 09.03.17
 * Time: 7:12
 */

namespace frontend\models;


use yii\db\ActiveRecord;

class Messages extends ActiveRecord
{

    public static function tableName()
    {
        return 'messages';
    }
}