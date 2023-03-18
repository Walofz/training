<?php

namespace frontend\controllers;

use frontend\models\Course;
use frontend\models\CourseSearch;
use frontend\models\Redis;
use frontend\models\Session;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class CourseController extends Controller
{
    public function actionIndex(): string
    {
        $searchModel = new CourseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->Date_Create = date('Y-m-d');
            $model->save(false);
            $this->redirect(['course/index']);
        } else {
            return $this->renderAjax('_form', ['model' => $model]);
        }
    }

    public function actionCreate(): Response|string
    {
        $model = new Course();

        if ($model->load(Yii::$app->request->post())) {
            $model->Course_ID = (new Course())->getNewID();
            $model->User_Create = Session::getUserID((new Redis())->getInfo(Yii::$app->session->get('username'), 'user'));
            $model->Date_Create = date('Y-m-d');
            $model->save(false);
            return $this->redirect(['course/index']);
        } else {
            return $this->renderAjax('_form', ['model' => $model]);
        }
    }

    /**
     * @throws NotFoundHttpException
     */
    protected function findModel($id): ?Course
    {
        if (($model = Course::findOne($id)) != null) {
            return $model;
        }

        throw new NotFoundHttpException('Not no no no no no ~');
    }
}
