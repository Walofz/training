<?php

namespace frontend\controllers;

use frontend\models\Training;
use frontend\models\TrainingSearch;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * TrainingController implements the CRUD actions for Training model.
 */
class TrainingController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Training models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TrainingSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Training model.
     * @param string $Course_ID Course ID
     * @param string $Location_ID Location ID
     * @param int $Train_Detail_ID Train Detail ID
     * @param string $Trainer_ID Trainer ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($Course_ID, $Location_ID, $Train_Detail_ID, $Trainer_ID)
    {
        return $this->render('view', [
            'model' => $this->findModel($Course_ID, $Location_ID, $Train_Detail_ID, $Trainer_ID),
        ]);
    }

    /**
     * Creates a new Training model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Training();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'Course_ID' => $model->Course_ID, 'Location_ID' => $model->Location_ID, 'Train_Detail_ID' => $model->Train_Detail_ID, 'Trainer_ID' => $model->Trainer_ID]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Training model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $Course_ID Course ID
     * @param string $Location_ID Location ID
     * @param int $Train_Detail_ID Train Detail ID
     * @param string $Trainer_ID Trainer ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Course_ID, $Location_ID, $Train_Detail_ID, $Trainer_ID)
    {
        $model = $this->findModel($Course_ID, $Location_ID, $Train_Detail_ID, $Trainer_ID);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Course_ID' => $model->Course_ID, 'Location_ID' => $model->Location_ID, 'Train_Detail_ID' => $model->Train_Detail_ID, 'Trainer_ID' => $model->Trainer_ID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Training model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Course_ID Course ID
     * @param string $Location_ID Location ID
     * @param int $Train_Detail_ID Train Detail ID
     * @param string $Trainer_ID Trainer ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Course_ID, $Location_ID, $Train_Detail_ID, $Trainer_ID)
    {
        $this->findModel($Course_ID, $Location_ID, $Train_Detail_ID, $Trainer_ID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Training model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $Course_ID Course ID
     * @param string $Location_ID Location ID
     * @param int $Train_Detail_ID Train Detail ID
     * @param string $Trainer_ID Trainer ID
     * @return Training the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Course_ID, $Location_ID, $Train_Detail_ID, $Trainer_ID)
    {
        if (($model = Training::findOne(['Course_ID' => $Course_ID, 'Location_ID' => $Location_ID, 'Train_Detail_ID' => $Train_Detail_ID, 'Trainer_ID' => $Trainer_ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
