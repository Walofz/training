<?php

use frontend\models\TrainingSearch;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JqueryAsset;
use yii\web\View;

/**
 * @var $this View
 * @var $searchModel TrainingSearch
 * @var $dataProvider ActiveDataProvider
 */
$path = Yii::$app->viewPath;
$uri = Url::base();

$this->title = "";
$this->registerJsFile("{$uri}/js/training/index.js", ['depends' => JqueryAsset::class]);

require_once "{$path}/course/modal/_template.php";
?>
<div class="training">
    <?php try {
        print GridView::widget(config: [
            'dataProvider' => $dataProvider,
            'pjax' => true,
            'bordered' => true,
            'condensed' => false,
            'hover' => true,
            'responsive' => true,
            'panel' => [
                'heading' => '<i class="fas fa-signature"></i>  การอบรม',
                'type' => 'primary',
                'after' => false,
                'before' => $this->render('_search', ['model' => $searchModel])
            ],
            'toolbar' => [],
            'export' => [
                'fontAwesome' => true
            ],
            'columns' => [
                'Course_Name:raw:หลักสูตร',
                'Trainner_Name:raw:วิทยากร',
                'Location_Name:raw:สถานที่',
                'Course_Cost:raw:ค่าใช้จ่าย',
                'Document_ID:raw:เอกสารอ้างอิง',
                'Start_Train_Date:date:วันที่เริ่ม',
                'End_Train_Date:date:ถึงวันที่',
                [
                    'header' => 'จัดการ',
                    'class' => 'yii\grid\ActionColumn',
                    'headerOptions' => ['style' => 'text-align: center'],
                    'contentOptions' => ['style' => 'text-align: center'],
                    'template' => '{update}',
                    'buttons' => [
                        'update' => function ($url, $model) {
                            $opt = [
                                'class' => 'btnedit',
                                'data-var' => "{$model->Course_Name}",
                                'data-url' => Url::toRoute(['training/update', 'id' => $model->Train_Detail_ID]),
                                'onclick' => 'openModal($(this))'
                            ];
                            $ico = "<span class='fas fa-file-alt btn btn-warning btn-sm'></span>";
                            return Html::a($ico, 'javascript:void(0)', $opt);
                        }
                    ]
                ]
            ]
        ]);
    } catch (Throwable $exception) {
        print $exception->getMessage();
    } ?>
</div>