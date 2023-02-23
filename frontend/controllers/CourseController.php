<?php

namespace frontend\controllers;

use frontend\models\CourseSearch;
use Yii;
use yii\web\Controller;

class CourseController extends Controller
{
    public function actionIndex(): string
    {
        $searchModel = new CourseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

}
