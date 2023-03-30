<?php

namespace frontend\controllers;

use common\models\UsrpTrainingline;
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
            if ($model->load($this->request->post())) {
                var_export($model);
            }
        } else {
            $model->loadDefaultValues();
            return $this->renderAjax('_form', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Training model.
     * If update is successful, the browser will be redirected to the 'view' page.
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->Start_Train_Date = date('Y-m-d', strtotime(str_replace('/', '-', $model->Start_Train_Date)));
            $model->End_Train_Date = date('Y-m-d', strtotime(str_replace('/', '-', $model->End_Train_Date)));
            $model->Date_Create = date('Y-m-d');
            $model->save(false);
            $this->redirect(['training/index']);
        } else {
            return $this->renderAjax('_form', [
                'model' => $model,
            ]);
        }
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
     * @return Training the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): Training
    {
        if (($model = Training::findOne(['Train_Detail_ID' => $id])) != null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

//    public function actionTransferData()
//    {
//        $model = TrainingTb::find()->select(['Employee_ID'])->where(['len(Employee_ID)' => 13])->distinct()->all();
//        foreach ($model as $item) {
//            //UsrpTrainingline::deleteAll(['emp_i_card' => $item->Employee_ID]);
//            if (UsrpTrainingline::find()->where(['emp_i_card' => $item->Employee_ID])->count() == 0) {
//                $sub1 = TrainingTb::findAll(['Employee_ID' => $item->Employee_ID]);
//                foreach ($sub1 as $subitem1) {
//                    $newmodel = new UsrpTrainingline();
//                    $newmodel->emp_i_card = $subitem1->Employee_ID;
//                    $newmodel->status = 1;
//                    $newmodel->train_detail_recid = $subitem1->Train_Detail_ID;
//                    $newmodel->create_at = date('Y-m-d');
//                    $newmodel->create_user = Session::getUserIDwhash(Yii::$app->session->get('username'));
//                    $newmodel->save(false);
//                }
//            }
//        }
//
//        print "OK";
//    }

//    public function actionGetdetail($id): bool|int|string|null
//    {
//        return TrainingTb::find()->where(['Train_Detail_ID' => $id, 'Status' => 1])->count();
//    }
}
