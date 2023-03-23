<?php

namespace frontend\controllers;

use frontend\models\Location;
use frontend\models\LocationSearch;
use frontend\models\Redis;
use frontend\models\Session;
use Yii;
use yii\base\Response;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * LocationController implements the CRUD actions for Location model.
 */
class LocationController extends Controller
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
     * Lists all Location models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new LocationSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Location model.
     * @param string $Location_ID Location ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($Location_ID)
    {
        return $this->render('view', [
            'model' => $this->findModel($Location_ID),
        ]);
    }

    /**
     * @return Response|string
     */
    public function actionCreate(): Response|string
    {
        $model = new Location();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->Location_ID = (new Location())->getNewID();
                $model->User_Create = Session::getUserID((new Redis())->getInfo(Yii::$app->session->get('username'), 'user'));
                $model->Date_Create = date('Y-m-d');
                $model->save(false);
                return $this->redirect(['location/index']);
            }
        } else {
            $model->loadDefaultValues();
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Location model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id Location ID
     */
    public function actionUpdate(string $id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->Date_Create = date('Y-m-d');
            $model->save(false);
            $this->redirect(['location/index']);
        } else {
            return $this->renderAjax('_form', ['model' => $model]);
        }
    }

    /**
     * Deletes an existing Location model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Location_ID Location ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Location_ID)
    {
        $this->findModel($Location_ID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Location model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $Location_ID Location ID
     * @return Location the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Location_ID)
    {
        if (($model = Location::findOne(['Location_ID' => $Location_ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
