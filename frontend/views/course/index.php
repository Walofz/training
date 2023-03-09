<?php

use common\models\TrainTypeTb;
use frontend\models\CourseSearch;
use kartik\grid\GridView;
use yii\bootstrap5\Html;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\JqueryAsset;
use yii\web\View;

/**
 * @var $this View
 * @var $searchModel CourseSearch
 * @var $dataProvider ActiveDataProvider
 */
$path = Yii::$app->viewPath;
$uri = Url::base();

$this->title = "";
$this->registerJsFile("{$uri}/js/course/index.js", ['depends' => JqueryAsset::class]);

require_once "{$path}/course/modal/_template.php";
?>
<div class="course" style="font-family: Kanit-Light, serif">
    <?php try {
        print GridView::widget(config: [
            'dataProvider' => $dataProvider,
            'pjax' => true,
            'bordered' => true,
            'condensed' => false,
            'hover' => true,
            'responsive' => true,
            'panel' => [
                'heading' => '<i class="fas fa-archive"></i>  หลักสูตรการอบรม',
                'type' => 'primary',
                'after' => false,
                'before' => $this->render('_search', ['model' => $searchModel])
            ],
            'toolbar' => [],
            'export' => [
                'fontAwesome' => true
            ],
            'columns' => [
                'Course_ID:raw:รหัส',
                'Course_Name:raw:ชื่อ',
                'Document_ID:raw:อ้างอิง',
                [
                    'attribute' => 'Course_Type',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return TrainTypeTb::findOne([$model->Course_Type])->Train_Type_Name_TH ?? "";
                    },
                    'label' => 'ประเภท'
                ],
                [
                    'attribute' => 'Course_Cost',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return number_format($model->Course_Cost, 2);
                    },
                    'label' => 'ค่าใช้จ่าย'
                ],
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
                                'data-url' => Url::toRoute(['course/update', 'id' => $model->Course_ID]),
                                'onclick' => 'openModal($(this))'
                            ];
                            $ico = "<span class='fas fa-file-alt btn btn-warning btn-sm'></span>";
                            return Html::a($ico, 'javascript:void(0)', $opt);
                        }
                    ]
                ]
            ]
        ]);
    } catch (Throwable $e) {
        print $e->getMessage();
    } ?>
</div>