<?php
/**
 * Created by PhpStorm.
 * User: kk
 * Date: 22.03.2017
 * Time: 16:34
 */

namespace frontend\models;


use yii\db\ActiveRecord;

class Colors extends ActiveRecord
{

    public static function tableName()
    {
     return 'Colors';
    }
}