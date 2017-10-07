<?php
/**
 * Created by PhpStorm.
 * User: kk
 * Date: 01.03.2017
 * Time: 11:41
 */

namespace frontend\models;


use yii\base\Model;

class Activate extends Model
{
public $input;

public function rules()
{
 return[
     [['input'],'required','message' => 'Нужно ввести код']
 ];
}
}