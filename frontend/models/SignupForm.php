<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use yii\helpers\BaseFileHelper;
use yii\helpers\FileHelper;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Это имя пользователя занято'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Email уже занят'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $code = rand(000000,999999);
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

//        \Yii::$app->mail->compose()->setTextBody('Уважаемый'.$this->username.',мы очень рады что вы присоединились к нам и зарегитстрировались у нас,для того чтобы подтвердить что вы не робот вам следует ввести данный Код:'.$code.'с любовью команда NSN')
//        ->setTo($this->email)->setFrom(\Yii::$app->params['supportEmail'])->setSubject('NSN Регистрация')->send();
        \Yii::$app->mailer->compose()
            ->setFrom('deadfonkI@gmail.com')
            ->setTo($this->email)
            ->setTextBody('Уважаемый '.$this->username.',мы очень рады что вы присоединились к нам и зарегитстрировались у нас,для того чтобы подтвердить что вы не робот вам следует ввести данный Код:'.$code.' с любовью команда NSN')
            ->setSubject('Регистрация на NSN')
            ->send();
        $user->code = $code;

        $directory = '../web/images/'.$this->username;
        BaseFileHelper::createDirectory($directory,0777,true);
        $user->img_path = 'images/'.$this->username;

        return $user->save() ? $user : null;
    }
}
