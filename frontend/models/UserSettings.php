<?php
/**
 * Created by PhpStorm.
 * User: kk
 * Date: 02.03.2017
 * Time: 8:22
 */

namespace frontend\models;



use yii\base\Model;

class UserSettings extends Model
{
    public $name,$last,$bio,$avatar,$background;

    public function rules()
    {
     return [
       [['name','last'],'required','message' => 'Обязательное поле'],
         [['bio'],'safe'],
         [['avatar','background'],'file','extensions' => 'png'],
     ];
    }


    public function updateInfo()
    {
        \Yii::$app->db->createCommand()->update('user',['name' => $this->name,'last_name' => $this->last,'bio' => $this->bio],['id' => \Yii::$app->user->id])->execute();
    }

    public function uploadBg()
    {
        if ($this->validate()) {
            $this->background->saveAs('/images/'.\Yii::$app->user->identity->username.'/background' . $this->background->extension);
            return true;
        } else {
            return false;
        }
    }

}