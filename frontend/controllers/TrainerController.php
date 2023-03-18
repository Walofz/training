<?php

namespace frontend\controllers;

use frontend\models\Trainer;
use frontend\models\TrainerSearch;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * TrainnerController implements the CRUD actions for Trainner model.
 */
class TrainerController extends Controller
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
     * Lists all Trainner models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TrainerSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Trainner model.
     * @param string $Trainner_ID Trainner ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($Trainner_ID)
    {
        return $this->render('view', [
            'model' => $this->findModel($Trainner_ID),
        ]);
    }

    /**
     * Creates a new Trainner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Trainer();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'Trainner_ID' => $model->Trainner_ID]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Trainner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param $id
     * @return string|null
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id): ?string
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            return var_export($model);
        } else {
            return $this->renderAjax('_form', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Trainner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Trainner_ID Trainner ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Trainner_ID)
    {
        $this->findModel($Trainner_ID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Trainner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $Trainner_ID Trainner ID
     * @return Trainer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Trainner_ID)
    {
        if (($model = Trainer::findOne(['Trainner_ID' => $Trainner_ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
