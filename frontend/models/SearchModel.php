<?php
/**
 * Created by PhpStorm.
 * User: deadfonki
 * Date: 07.03.17
 * Time: 9:02
 */

namespace frontend\models;


use yii\base\Model;

class SearchModel extends Model
{
    public $string;

    public function rules()
    {
     return [
       [['string'],'safe']
     ];
    }

}