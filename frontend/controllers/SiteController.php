<?php

namespace frontend\controllers;

use Exception;
use frontend\models\Redis;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
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
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return string|Response
     */
    public function actionLogin(): string|Response
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'main-login';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            try {
                if (Yii::$app->ldap->auth($model->username, $model->password)) {
                    (new Redis())->setSession($model->username);
                    return $this->redirect(['site/index']);
                } else {
                    return "Ldap can't find your username.";
                }
            } catch (Exception $exception) {
                return $exception->getMessage();
            }
        } else {
            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @return Response
     */
    public function actionLogoutSession(): Response
    {
        (new Redis())->logoutSession(Yii::$app->session->get('username'));
        return Yii::$app->response->redirect(['site/login']);
    }
}
