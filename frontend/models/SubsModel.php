<?php
/**
 * Created by PhpStorm.
 * User: kk
 * Date: 01.03.2017
 * Time: 17:07
 */

namespace frontend\models;


use yii\base\Model;

class SubsModel extends Model
{
    public $subs;

    public function rules()
    {
     return [
       [['subs'],'required','message' => 'Нужно выбрать что-то']
     ];
    }
}