<?php
namespace frontend\controllers;

use common\fixtures\User;
use frontend\models\Activate;
use frontend\models\SubsModel;
use Yii;
use yii\base\InvalidParamException;
use yii\db\Query;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'only' => ['logout', 'signup'],
//                'rules' => [
//                    [
//                        'actions' => ['signup'],
//                        'allow' => true,
//                        'roles' => ['?'],
//                    ],
//                    [
//                        'actions' => ['logout'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//
//                ],
//            ],
//        ];
//    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {

        $searchs = Yii::$app->request->post('searchs');
        if(Yii::$app->user->isGuest)
        {
            return $this->render('landing');
        }
        else
        {
            return $this->render('index',['searchs' => $searchs]);
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }else
        {
            return $this->goBack();
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSubscribe()
    {
        $model = new SubsModel();
        if ($model->load(Yii::$app->request->post()) && $model->validate()
        ) {
            if (Yii::$app->request->isPost) {
                $user = new User();
                for ($i = 0;$i < count($model->subs);$i++)
                {
                    $u = $i + 1;
                    Yii::$app->db->createCommand()->update('user',['theme_'.$u => $model->subs[$i]],['id' => Yii::$app->user->id])->execute();
                }
                return $this->redirect('/');
            }
        }
            return $this->render('subscribe');

    }

    public function actionActivate()
    {

        $model = new Activate();

        $user = \common\models\User::findOne(['id' => Yii::$app->user->id]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($user['code'] == $model->input) {
                $user->is_active = 'true';
                $user->update();
                return $this->redirect('/');
            } else {
                $rand = rand(000000, 999999);
                $user->code = $rand;
                $user->update();
                \Yii::$app->mailer->compose()
                    ->setFrom('deadfonkI@gmail.com')
                    ->setTo($user['email'])
                    ->setTextBody('Уважаемый ' . $user['username'] . ' ваш новый код:' . $rand)
                    ->setSubject('Регистрация на NSN')
                    ->send();
                return $this->render('activate', ['user' => $user, 'md' => $model->input]);
            }

        }
        if (!$user['is_active'] == 'true') {
            if (!Yii::$app->user->isGuest) {
                return $this->render('activate');
            }
            else
            {
                return $this->redirect('/');
            }
        }
        else
        {
            return $this->redirect('/');
        }
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect('/site/activate');
                }
            }

        }

       return $this->goBack();
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
