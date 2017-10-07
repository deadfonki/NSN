<?php
/**
 * Created by PhpStorm.
 * User: kk
 * Date: 13.03.2017
 * Time: 9:26
 */

namespace frontend\models;


use yii\db\ActiveRecord;

class Actions extends ActiveRecord
{

    public static function tableName()
    {
     return 'actions';
    }
}