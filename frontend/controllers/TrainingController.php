<?php

namespace frontend\controllers;

use common\models\QryEmpInfoEmpAll;
use common\models\TrainingDetailTb;
use common\models\TrainingTb;
use common\models\UsrpTrainingline;
use frontend\models\Redis;
use frontend\models\Session;
use frontend\models\Training;
use frontend\models\TrainingSearch;
use Throwable;
use Yii;
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
    public function actionIndex(): string
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

    public function actionCreate()
    {
        $model = new Training();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->Train_Detail_ID = (new Training())->getNewRecord();
                $model->User_Total = 0;
                $model->User_Create = Session::getUserID((new Redis())->getInfo(Yii::$app->session->get('username'), 'user'));
                $model->Start_Train_Date = date('Y-m-d', strtotime(str_replace('/', '-', $model->Start_Train_Date)));
                $model->End_Train_Date = date('Y-m-d', strtotime(str_replace('/', '-', $model->End_Train_Date)));
                $model->Date_Create = date('Y-m-d');
                $model->save(false);
                $this->redirect(['training/index']);
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

    protected function findModelEmp($id): array
    {
        if (($model = TrainingTb::findAll(['Train_Detail_ID' => $id])) != null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionUpdateemp($id)
    {
        try {
            $model = $this->findModelEmp($id);
        } catch (Throwable) {
            $model = new TrainingTb();
        }
        return $this->renderAjax('_empform', ['model' => $model, 'mainprod' => $id]);
    }

    public function actionSetempdata()
    {
        $id = $this->request->post('eid');
        $mprodid = $this->request->post('mprod');
        if ($id != "" && $mprodid != "") {
            $mnew = new TrainingTb();
            $mnew->Employee_ID = QryEmpInfoEmpAll::findOne(['PRS_NO' => $id])->EMP_I_CARD ?? "0000000000000";
            $mnew->Train_Detail_ID = $mprodid;
            $mnew->Status = 0;
            $mnew->Created_at = date('Y-m-d H:i:s');
            $mnew->Created_by = Session::getUserID((new Redis())->getInfo(Yii::$app->session->get('username'), 'user'));
            $mnew->save(false);
        }
    }

    public function actionGettabledata($mprodid)
    {
        $formlist = TrainingTb::find()->where(['Train_Detail_ID' => $mprodid])->orderBy(['Created_at' => 4])->all();
        $htmlq = "";
        foreach ($formlist as $item) {
            $fname = QryEmpInfoEmpAll::findOne(['EMP_I_CARD' => $item->Employee_ID]);
            $ischeck = $item->Status == 0 ? "" : "checked";
            $htmlq .= /* @lang */
                "
<tr style='text-align: left;'>
    <td>
        <input type='hidden' readonly name='' id='' class='form-control sid' value='{$item->Employee_ID}'>
        <input type='text' readonly name='' id='' class='form-control sname' value='{$fname->EMP_NAME} {$fname->EMP_SURNME}'>
    </td>
    <td style='text-align: center;'>
        <label class='switch'><input type='checkbox' {$ischeck} onchange='updateStatus({$item->Employee_ID},{$item->Train_Detail_ID})'>
            <span class='slider round'></span>
        </label>
    </td>
    <td>
        <button type='button' class='btn btn-danger btn-sm' onclick='removeData({$item->Employee_ID},{$item->Train_Detail_ID})'>ลบ</button>    
    </td>
</tr>
            ";
        }
        return $htmlq;
    }

    public function actionUpdatestatus(): int
    {
        $id = $this->request->post('id');
        $dc_id = explode(':', base64_decode($id));

        if ($dc_id) {
            if (($models = TrainingTb::findOne(['Employee_ID' => $dc_id[0], 'Train_Detail_ID' => $dc_id[1]]))) {
                $status = ($models->Status == 1) ? 0 : (($models->Status == 0) ? 1 : 0);
                if (TrainingTb::updateAll(['Status' => $status], ['Employee_ID' => $dc_id[0], 'Train_Detail_ID' => $dc_id[1]])) {
                    $counttb = TrainingTb::find()->where(['Train_Detail_ID' => $dc_id[1], 'Status' => 1])->count();
                    TrainingDetailTb::updateAll(['User_Total' => $counttb], ['Train_Detail_ID' => $dc_id[1]]);
                }
                return 1;
            }

//            TrainingTb::updateAll(['Status' => 1], ['Employee_ID' => $dc_id[0], 'Train_Detail_ID' => $dc_id[1]]);
//            $cnt = TrainingTb::find()->where(['Train_Detail_ID' => $dc_id[1]])->count() ?? 0;
//            TrainingDetailTb::updateAll(['User_Total' => $cnt], ['Train_Detail_ID' => $dc_id[1]]);
//            return 1;
        }

        return 0;
    }

    public function actionRemoveemp(): int
    {
        $id = $this->request->post('id');
        $dc_id = explode(':', base64_decode($id));
        TrainingTb::deleteAll(['Employee_ID' => $dc_id[0], 'Train_Detail_ID' => $dc_id[1]]);
        return 1;
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
