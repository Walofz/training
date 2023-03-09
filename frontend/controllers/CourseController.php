<?php

namespace frontend\controllers;

use frontend\models\Course;
use frontend\models\CourseSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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

        if ($model->load(Yii::$app->request->post())) {
            return var_export($model);
        }

        return $this->renderAjax('_form', ['model' => $model]);
    }

    public function actionCreate()
    {
        $model = new Course();

        if ($model->load(Yii::$app->request->post())) {
            return var_export($model);
        }

        return $this->renderAjax('_form', ['model' => $model]);
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
